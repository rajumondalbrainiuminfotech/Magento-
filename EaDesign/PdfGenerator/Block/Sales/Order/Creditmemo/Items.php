<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Invoice
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Block_Sales_Order_Creditmemo_Items extends Mage_Sales_Block_Order_Creditmemo_Items
{

    public function getPdfPrintInvoiceUrl($creditmemo)
    {
        if ($this->getPdfSituation()) {
            return Mage::getUrl('pdfgenerator/index/credimemopdfgenrator', array('creditmemo_id' => $creditmemo->getId()));
        }
    }

    /**
     * Need to move the check to a helper - also added to mail
     * @return type
     */
    public function getPdfSituation()
    {
        if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfcm_opt/eadesign_pdfinv_cm_f')) {
            return false;
        }

        return Mage::helper('pdfgenerator/situation')->getCollectionStatus(
            EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMOTEMPLATE,
            $this->getOrder()
        );
    }
}