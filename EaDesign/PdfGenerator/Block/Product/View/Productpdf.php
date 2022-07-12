<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductPdf
 *
 * @author eadesign
 */
class EaDesign_PdfGenerator_Block_Product_View_Productpdf extends Mage_Core_Block_Template
{

    public function checkUrl()
    {
        if ($this->_getThePdfSituation()) {
            return true;
        }
    }

    public function getPdfPrintProductUrl()
    {
        if ($this->_getThePdfSituation()) {
            return Mage::getUrl('pdfgenerator/index/productpdfgenrator', array('product_id' => $this->getProductId()));
        }
    }

    public function getProductId()
    {
        if (Mage::registry('current_product')->getId()) {
            return Mage::registry('current_product')->getId();
        }
    }

    private function _getThePdfSituation()
    {
        if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfinv_opt_prod/eadesign_pdfprod')) {
            return false;
        }
        $templateCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();
        $templateCollection->addFieldToSelect('*')
            ->addFieldToFilter('pdft_type', EaDesign_PdfGenerator_Model_Pdfgenerator::PRODUCTTEMPLATE)
            ->addFieldToFilter('pdft_attribute_set', $this->getAttributeSet())
            ->addFieldToFilter('template_store_id', $this->getSoreId())
            ->addFieldToFilter('pdft_is_active', 1);

        $templateId = $templateCollection->getData('pdftemplate_id');

        $checkMbstrings = extension_loaded('mbstring');

        if (!$checkMbstrings) {
            return false;
        }

        if (!empty($templateId)) {
            return true;
        }
        return false;
    }

    public function getAttributeSet()
    {
        if ($attributeSet = Mage::registry('current_product')->getAttributeSetId()) {
            return array($attributeSet, 0);
        }
        return 0;
    }

    public function getSoreId()
    {
        if ($storeId = Mage::app()->getStore()->getId()) {
            return array($storeId, 0);
        }
    }

}

