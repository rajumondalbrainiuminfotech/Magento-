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
class EaDesign_PdfGenerator_Block_Sales_Order_Invoice_Items extends Mage_Sales_Block_Order_Invoice_Items
{

    public function getPdfPrintInvoiceUrl($invoice)
    {
        if ($this->getPdfSituation()) {
            return Mage::getUrl('pdfgenerator/index/invoicepdfgenrator', array('invoice_id' => $invoice->getId()));
        }
    }

    /**
     * Need to move the check to a helper - also added to mail
     * @return type
     */
    public function getPdfSituation()
    {
        if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfinv_opt/eadesign_pdfinv_inv_f')) {
            return false;
        }

        return Mage::helper('pdfgenerator/situation')->getCollectionStatus(
            EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICETEMPLATE,
            $this->getOrder()
        );
    }
}
