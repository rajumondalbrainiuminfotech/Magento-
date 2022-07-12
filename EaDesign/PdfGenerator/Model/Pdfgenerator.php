<?php

/**
 * Description of PdfGenerator
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Model_Pdfgenerator extends Mage_Core_Model_Abstract
{

    CONST PRODUCTTEMPLATE = 'productpdftemplate';
    CONST ORDERTEMPLATE = 'orderpdftemplate';
    CONST INVOICETEMPLATE = 'invoicepdftemplate';
    CONST CMEMOTEMPLATE = 'cmemopdftemplate';
    CONST SHIPPMENTTEMPLATE = 'shippmentpdftemplate';
    CONST STATUS_ENABLED = 1;
    CONST STATUS_DISABLED = 0;

    CONST INVOICE_ENT = 'invoice';
    CONST CMEMO_ENT = 'creditmemo';
    CONST SHIPPMENT_ENT = 'shipment';
    CONST ORDER_ENT = 'order';


    public function _construct()
    {
        $this->_init('eadesign/pdfgenerator');
    }

    public function getAvailableStatuses()
    {
        $statuses = new Varien_Object(array(
            self::STATUS_ENABLED => Mage::helper('pdfgenerator')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('pdfgenerator')->__('Disabled'),
        ));

        return $statuses->getData();
    }

    public function getAttributeSets()
    {
        $entityTypeId = Mage::getModel('eav/entity')
            ->setType('catalog_product')
            ->getTypeId();

        $attributeSetCollection = Mage::getResourceModel('eav/entity_attribute_set_collection')
            ->setEntityTypeFilter($entityTypeId)
            ->toOptionHash();
        $allAttributes = array(0 => 'All Attributes');

        $attributesData = $allAttributes + $attributeSetCollection;
        return $attributesData;
    }

}
