<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Invoicepdf
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Model_Entity_Orderpdf extends EaDesign_PdfGenerator_Model_Entity_Pdfgenerator
{

    /**
     * The id of the invoice
     * @var int
     */
    public $orderId;

    public $templateId;

    public function getTheSource()
    {
        $order = Mage::getModel('sales/order')->load($this->orderId);
        return $order;
    }

    /**
     * Get the invoice id and create the vars for teh invoice
     * @param type $invoiceId The invoice id
     */
    public function getThePdf($orderId, $templateId)
    {
        $this->templateId = $templateId;
        $this->orderId = $orderId;
        $this->setVars(Mage::helper('pdfgenerator')->processAllVars($this->collectVars()));
        return $this->getPdf();
    }

    /**
     * Collect the vars for the template to be processed
     * @return array
     */
    public function collectVars()
    {

        $grandTotal = Mage::getModel('eadesign/entity_totals_grandtotal')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTotalsForDisplay();
        $subTotal = Mage::getModel('eadesign/entity_totals_subtotal')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTotalsForDisplay();
        $shippingTotal = Mage::getModel('eadesign/entity_totals_shipping')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTotalsForDisplay();
        // need to check the tax system
        $taxTotal = Mage::getModel('eadesign/entity_totals_tax')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTotalsForDisplay();
        //need to check the discount system
        $discountTotal = Mage::getModel('eadesign/entity_totals_discount')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTotalsForDisplay();

        $leftInfoBlock = Mage::getModel('eadesign/entity_additional_info')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource())
            ->getTheInfoMergedVariables();

        $vars = array_merge($subTotal, $grandTotal, $shippingTotal, $taxTotal, $discountTotal, $leftInfoBlock);
//        echo "<pre>";
//        print_r($vars);
//        exit('test');

        return $vars;
    }

}
