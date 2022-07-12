<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Productpdf
 *
 * @author eadesign
 */
class EaDesign_PdfGenerator_Model_Entity_Productpdf extends EaDesign_PdfGenerator_Model_Entity_Pdfgenerator
{

    public $productId;

    /**
     * Get the invoice id and create the vars for teh invoice
     * @param type $invoiceId The invoice id
     */
    public function getThePdf($productId)
    {
        $this->productId = $productId;
        $productVars = Mage::helper('pdfgenerator')->processAllVars($this->collectVars());
        $this->setVars($productVars);

        return $this->getPdf();
    }

    /**
     * Collect the vars for the template to be processed
     * @return array
     */
    public function collectVars()
    {
        $vars = array(
            Mage::helper('pdfgenerator/product')->getDataAsVar($this->productId),
            Mage::helper('pdfgenerator/product')->getTheProductAttributes($this->productId),
            Mage::helper('pdfgenerator/product')->getProductViewImages($this->productId),
            Mage::helper('pdfgenerator/product')->getProductViewPrice($this->productId),
            Mage::helper('pdfgenerator/product')->getProductViewAdditional($this->productId)
        );
        return $vars;
    }

}

?>
