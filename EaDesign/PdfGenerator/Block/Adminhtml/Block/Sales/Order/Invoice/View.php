<?php

/**
 * Description of View
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Block_Adminhtml_Block_Sales_Order_Invoice_View extends Mage_Adminhtml_Block_Sales_Order_Invoice_View
{
    /*
     * The constructor to get the template
     */

    public function __construct()
    {
        parent::__construct();
        if (Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfinv_opt/eadesign_pdfinv_inv')) {
            $this->_addButton('printea', array(
                    'label' => Mage::helper('pdfgenerator')->__('EaDesign Print PDF'),
                    'class' => 'saveea',
                    'onclick' => Mage::helper('pdfgenerator/situation')->getAdminSituation(
                        EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICETEMPLATE,
                        $this->getInvoice(),
                        $this->getEaPrintUrl(),
                        $this->getPrintUrl())
                )
            );
        }
    }

    /*
     * The url for the print template system
     */

    public function getEaPrintUrl()
    {
        return $this->getEaDesignPrintInvoiceUrl();
    }

    private function getEaDesignPrintInvoiceUrl()
    {
        return $this->getUrl('adminpdfgenerator/adminhtml_pdfgeneratorpdf/invoicepdfgenrator', array(
            'invoice_id' => $this->getInvoice()->getId()
        ));
    }
}
