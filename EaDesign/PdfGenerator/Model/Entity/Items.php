<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Model_Entity_Items extends EaDesign_PdfGenerator_Model_Entity_Pdfgenerator
{

    /**
     *  Need to get the system on all optiones
     * @return array
     */
    public function processAllVars()
    {
        /* value and label */
        $varData = array();
        foreach ($this->getTheItems() as $item) {
            $allKeysLabel = array();
            $allKeys = array();
            $allVars = array();
            foreach (array_keys($item) as $v) {
                $allKeysLabel['label_' . $v] = $item[$v]['value'] . ' ' . $item[$v]['label'];
                $allKeys[$v] = $item[$v]['value'];
            }
            $allVars = array_merge($allKeysLabel, $allKeys);
            $varData[] = $allVars;
        }

        return $varData;
    }




    /**
     * Get the items for the source
     * @return array
     */
    public function getTheItems()
    {

        foreach ($this->getSource()->getAllItems() as $item) {

            if ($item instanceof Mage_Sales_Model_Order_Item) {
                $item->setOrderItem($item);
            }


            $this->setItem($item);

            if ($item->getOrderItem()->getParentItem()) {
                $theParent = $item->getOrderItem()->getParentItem();
                if (Mage::helper('pdfgenerator/product')->isConfigurable($theParent->getProductId())) {
                    continue;
                }
                $isChild = true;
            } else {
                $isChild = false;
            }

            $imageData = Mage::helper('pdfgenerator/product')->getTheProductImage($item->getProductId());
            $itemsPriceData = $this->isPriceDisplayOptions($item);

            $userAttributeData = Mage::helper('pdfgenerator/product')->getDataAsVar(
                $item->getProductId(), $this->getOrder()->getStoreId(), $isChild);

            $standardVars = $this->getSandardItemVars($item);

            $productioptions = $this->getItemOptions($item->getProductId());

            if (isset($productioptions)) {
                $attr[] = array_merge($itemsPriceData, $userAttributeData, $standardVars, $productioptions, $imageData);
            } else {
                $attr[] = array_merge($itemsPriceData, $userAttributeData, $standardVars, $imageData);
            }
        }

        return $attr;
    }

    public function getSandardItemVars($item)
    {
        $order = $this->getOrder();
        $nameStyle = $item->getName();
        if ($item->getOrderItem()->getParentItem()) {
            $nameStyle = $this->getValueHtml($item);
            $bunleOptiones = $this->getSelectionAttributes($item);
        }
        if ($item->getTaxAmount() != 0) {
            $taxAmount = $order->formatPriceTxt($item->getTaxAmount());
        } else {
            //$taxAmount = $order->formatPriceTxt(0);
        }
        if ($item->getDiscountAmount() != 0) {
            $discountAmount = $order->formatPriceTxt($item->getDiscountAmount());
        }

        $qty = $item->getQty();

        if ($qty=='0') {
            $qty = $item->getQtyOrdered() * 1;
        }

        $itemSku = str_replace('-', ' - ', $item->getSku());
        $standardVars = array(
            'items_name' => array(
                'value' => $nameStyle,
                'label' => 'Product Name'
            ),
            'bundle_items_option' => array(
                'value' => $bunleOptiones['option_label'],
                'label' => 'Bundle Name'
            ),
            'items_sku' => array(
                'value' => $itemSku,
                'label' => 'SKU'
            ),
            'items_qty' => array(
                'value' => $item->getQty() * 1,
                'label' => 'Qty'
            ),
            'items_qty_ordered' => array(
                'value' => $item->getQtyOrdered() * 1,
                'label' => 'Qty'
            ),
            'items_qty_invoiced' => array(
                'value' => $item->getQtyInvoiced() * 1,
                'label' => 'Qty'
            ),
            'items_qty_shipped' => array(
                'value' => $item->getQtyShipped() * 1,
                'label' => 'Qty'
            ),
            'items_qty_refunded' => array(
                'value' => $item->getQtyRefunded() * 1,
                'label' => 'Qty'
            ),
            'items_qty_canceled' => array(
                'value' => $item->getQtyCanceled() * 1,
                'label' => 'Qty'
            ),
            'items_tax' => array(
                'value' => $taxAmount,
                'label' => 'Tax Amount'
            ),
            'items_discount' => array(
                'value' => $discountAmount,
                'label' => 'Discount Amount'
            )
        );

        return $standardVars;
    }

    /**
     * Get the Item prices for display - need to review this part adn move the item system to do
     * @return array
     */
    public function getItemPricesForDisplay()
    {
        $order = $this->getOrder();
        $item = $this->getItem();

        $prices = array(
            'itemcarpticeexcl' => array(
                'label' => Mage::helper('tax')->__('Price Excl. Tax') . ':',
                'value' => $order->formatPriceTxt($item->getPrice()),
            ),
            'itemcarptice' => array(
                'label' => Mage::helper('tax')->__('Price Incl. Tax') . ':',
                'value' => $order->formatPriceTxt($item->getPriceInclTax()),
            ),
            'itemsubtotal' => array(
                'label' => Mage::helper('tax')->__('Subtotal Excl. Tax') . ':',
                'value' => $order->formatPriceTxt($item->getRowTotal()),
            ),
            'itemcarpticeicl' => array(
                'label' => Mage::helper('tax')->__('Subtotal Incl. Tax') . ':',
                'value' => $order->formatPriceTxt($item->getRowTotalInclTax()),
            ),
        );
        return $prices;
    }

    /**
     * Retrieve item options
     *
     * @return array
     */
    public function getItemOptions($product_id)
    {
        $result = array();
        if ($options = $this->getItem()->getOrderItem()->getProductOptions()) {
            $result = Mage::helper('pdfgenerator/items')->getItemOptions2($options,$product_id);
        }
//        error_log(var_export($deep,true));
        return $result;
    }

    /**
     * Return item Sku
     *
     * @param  $item
     * @return mixed
     */
    public function getSku($item)
    {
        if ($item->getOrderItem()->getProductOptionByCode('simple_sku'))
            return $item->getOrderItem()->getProductOptionByCode('simple_sku');
        else
            return $item->getSku();
    }

    public function isPriceDisplayOptions($item = null)
    {
        if ($item) {
            if ($this->isChildCalculated($item)) {
                return $itemsPriceData = $this->getItemPricesForDisplay();
            } else {
                return $itemsPriceData = array();
            }
        } else {
            return null;
        }
    }

    public function getAttributes()
    {
        return Mage::helper('pdfgenerator/product')->getDataAsVar();
    }

}
