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
class EaDesign_PdfGenerator_Block_Sales_Order_Shipment_Items extends Mage_Sales_Block_Order_Shipment_Items
{

    public function getPdfPrintInvoiceUrl($invoice)
    {
        if ($this->getPdfSituation()) {
            return Mage::getUrl('pdfgenerator/index/shipmentpdfgenrator', array('shipment_id' => $invoice->getId()));
        }
    }

    /**
     * Need to move the check to a helper - also added to mail
     * @return type
     */
    public function getPdfSituation()
    {
        if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfsp_opt/eadesign_pdfinv_sp_f')) {
            return false;
        }

        return Mage::helper('pdfgenerator/situation')->getCollectionStatus(
            EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENTTEMPLATE,
            $this->getOrder()
        );
    }
}
