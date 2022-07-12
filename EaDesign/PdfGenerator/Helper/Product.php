<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Helper_Product extends Mage_Catalog_Helper_Product
{

    /**
     * Get the non system attributes for the variables
     * @return array
     */
    public function getAllNonSystemAttributes()
    {
        $productAttrs = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('is_user_defined', '1');

        $attrs = array();

        foreach ($productAttrs as $attribute) {
            $attrs[$attribute->getData('attribute_code')] = array(
                'label' => $attribute->getData('frontend_label'),
            );
        }
        return $attrs;
    }

    /**
     *
     * @return type
     */
    public function loadTheProduct()
    {
        return Mage::getModel('catalog/product');
    }

    /**
     *
     * @param integer $productId
     * @return boolean
     */
    public function isConfigurable($productId)
    {
        if ($this->loadTheProduct()->load($productId)->getData('type_id') == 'configurable') {
            return true;
        }
    }

    /**
     * Get the product id ti get the user added attributes
     * @param integer $productId
     * @return array
     *
     * Need to add store selection for the labels ! IMPORTANT
     */
    public function getDataAsVar($productId, $storeId, $child = false)
    {
        $product = $this->loadTheProduct()->load($productId);
        $data = array();

        $gettingTheVariablesFromArrayKey = array_keys($this->getAllNonSystemAttributes());
        $gettingTheLabelsFromArrayKey = $this->getAllNonSystemAttributes();

        foreach ($gettingTheVariablesFromArrayKey as $variables) {
            if ($product->getAttributeText($variables)) {
                $data[$variables] = array(
                    'value' => $product->getAttributeText($variables),
                    'label' => $gettingTheLabelsFromArrayKey[$variables]['label']
                );
            } else {
                if ($product->getData($variables)) {
                    $data[$variables] = array(
                        'value' => $product->getData($variables),
                        'label' => $gettingTheLabelsFromArrayKey[$variables]['label']
                    );
                }
            }

            $data['weight'] = array(
                'value' => $product->getData('weight'),
                'label' => Mage::helper('pdfgenerator')->__('Product weight')
            );
            $data['description'] = array(
                'value' => $product->getData('description'),
                'label' => Mage::helper('pdfgenerator')->__('Product description')
            );
            $data['short_description'] = array(
                'value' => $product->getData('short_description'),
                'label' => Mage::helper('pdfgenerator')->__('Product short description')
            );
            if (!$child) {
                $data['url_path'] = array(
                    'value' => Mage::app()->getStore($storeId)
                            ->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK)
                        . $product->getData('url_path'),
                    'label' => Mage::helper('pdfgenerator')->__('Product url path')
                );
            }
        }
        return $data;
    }

    /**
     * Get the product image - need to add the user options here
     * @param type $productId
     * @return array getPlaceholder no_selection
     */
    public function getTheProductImage($productId)
    {
        $_product = $this->loadTheProduct()->load($productId);

        $imageFile = $_product->getData('small_image');

        if ($imageFile !== 'no_selection' && isset($imageFile)) {
            $_image = Mage::helper('catalog/image')->init($_product, 'image', $imageFile)->resize(200);
/*
        $imageFile = $_product->getData('small_image');

        if ($imageFile !== 'no_selection' && isset($imageFile)) {
            $_image = Mage::helper('catalog/image')->init($_product, 'small_image', $imageFile)->resize(77, 77);
*/
            $image = array(
                'productimage' => array(
                    'value' => '<img src="' . str_replace('https://www.mecco.fi/','',$_image->__toString()) . '" />',
                    'label' => Mage::helper('pdfgenerator')->__('Product image')
                ),
            );

        } else {
            $image = array(
                'productimage' => array(
                    'value' => '',
                    'label' => ''
                ),
            );
        }
        return $image;
    }

    public function getTheProductAttributes($productId)
    {
        $data = array();
        $product = $this->loadTheProduct()->load($productId);
        $attributes = $product->getAttributes();
        $_helper = Mage::helper('catalog/output');
        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisibleOnFront() && !in_array($attribute->getAttributeCode())) {
                $value = $attribute->getFrontend()->getValue($product);

                if (!$product->hasData($attribute->getAttributeCode())) {
                    $value = Mage::helper('catalog')->__('N/A');
                } elseif ((string)$value == '') {
                    $value = Mage::helper('catalog')->__('No');
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = Mage::app()->getStore()->convertPrice($value, true);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = array(
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'code' => $attribute->getAttributeCode()
                    );
                }
            }
        }

        $html = '<table class="data-table" id="product-attribute-specs-table">' .
            '<col width="25%" />' .
            '<col />' .
            '<tbody>';
        foreach ($data as $_data) {
            $html .= '<tr>' .
                '<th class="label">' . $this->__($_data['label']) . '</th>' .
                '<td class="data">' . $_helper->productAttribute($product, $_data['value'], $_data['code']) . '</td>' .
                '</tr>';
        }
        $html .= '</tbody>' . '</table>';

        $attributesData = array(
            'productviewattributes' => array(
                'value' => $html,
                'label' => $this->__('Additional Information')
            ),
        );

        return $attributesData;
    }

    public function getProductViewImages($productId)
    {
        $_product = $this->loadTheProduct()->load($productId);
        $imageFile = $_product->getData('small_image');

        if ($imageFile !== 'no_selection' && isset($imageFile)) {
            $_image = Mage::helper('catalog/image')->init($_product, 'image', $imageFile)->resize(300);

            $image = array(
                'productimageview' => array(
                    'value' => '<img src="' . str_replace('https://www.mecco.fi/','',$_image->__toString()) . '" />',
                    'label' => Mage::helper('pdfgenerator')->__('Product image')
                ),
            );

        } else {
            $image = array(
                'productimageview' => array(
                    'value' => '',
                    'label' => ''
                ),
            );
        }
        return $image;
    }

    public function getProductViewPrice($productId)
    {
        $_product = $this->loadTheProduct()->load($productId);
        $productPrice = Mage::helper('tax')->getPrice($_product, $_product->getPrice(), true);
        $productSpecialPrice = Mage::helper('tax')->getPrice($_product, $_product->getSpecialPrice(), true);

        $productPriceExc = Mage::helper('tax')->getPrice($_product, $_product->getPrice(), null);
        $productSpecialPriceExc = Mage::helper('tax')->getPrice($_product, $_product->getSpecialPrice(), null);


        $prices = array(
            'productprice' => array(
                'label' => Mage::helper('tax')->__('Price Incl. Tax') . ':',
                'value' => Mage::helper('core')->currency($productPrice, true, false),
            ),
            'productspecialprice' => array(
                'label' => Mage::helper('tax')->__('Special Price') . ':',
                'value' => Mage::helper('core')->currency($productSpecialPrice, true, false),
            ),
            'productpriceexc' => array(
                'label' => Mage::helper('tax')->__('Price Excl. Tax') . ':',
                'value' => Mage::helper('core')->currency($productPriceExc, true, false),
            ),
            'productspecialpriceexc' => array(
                'label' => Mage::helper('tax')->__('Special Price Excl. Tax') . ':',
                'value' => Mage::helper('core')->currency($productSpecialPriceExc, true, false),
            ),
            'producttaxammount' => array(
                'label' => Mage::helper('tax')->__('Tax') . ':',
                'value' => Mage::helper('core')->currency($productPrice - $productPriceExc, true, false),
            ),
            'producttaxammountspecial' => array(
                'label' => Mage::helper('tax')->__('Special Price Tax') . ':',
                'value' => Mage::helper('core')->currency($productSpecialPrice - $productSpecialPriceExc, true, false),
            ),
        );
        return $prices;
    }

    public function getProductViewAdditional($productId)
    {
        $_product = $this->loadTheProduct()->load($productId);

        $additional = array(
            'productname' => array(
                'label' => Mage::helper('tax')->__('Product name') . ':',
                'value' => $_product->getData('name'),
            ),
            'productdescription' => array(
                'label' => Mage::helper('tax')->__('Product description') . ':',
                'value' => $_product->getData('description'),
            ),
            'productshortdescription' => array(
                'label' => Mage::helper('tax')->__('Product short description') . ':',
                'value' => $_product->getData('short_description'),
            ),
            'productweight' => array(
                'label' => Mage::helper('tax')->__('Product weight') . ':',
                'value' => $_product->getData('weight'),
            ),
            'productsku' => array(
                'label' => Mage::helper('tax')->__('Product SKU') . ':',
                'value' => $_product->getData('sku'),
            ),
            /**
             * Need to get the category if category exists - works ok for base product url
             */
            'producturl' => array(
                'label' => Mage::helper('tax')->__('Product url path') . ':',
                'value' => $_product->getProductUrl(),
            ),
        );

        return $additional;
    }


    /**
     * Need to get this ok
     * @param type $productId
     * @return array
     */
    public function getProductOptiones($productId)
    {
        $_product = $this->loadTheProduct()->load($productId);
        $productAttributeOptions = $_product->getTypeInstance(true)->getConfigurableAttributesAsArray($_product);
        $attributeOptions = array();


        foreach ($productAttributeOptions as $productAttribute) {
            foreach ($productAttribute['values'] as $attribute) {
                $attributeOptions[$productAttribute['label']][$attribute['value_index']] = $attribute['store_label'];
            }
        }

        return $productAttribute;
    }

}
