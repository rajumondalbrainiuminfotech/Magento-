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
class EaDesign_PdfGenerator_Model_Entity_Creditmemopdf extends EaDesign_PdfGenerator_Model_Entity_Pdfgenerator
{

    /**
     * The id of the creditMemo
     * @var int
     */
    public $creditMemoId;

    public $templateId;

    public function getTheSource()
    {
        $creditMemo = Mage::getModel('sales/order_creditmemo')->load($this->creditMemoId);
        return $creditMemo;
    }

    /**
     * Get the creditMemo id and create the vars for teh creditMemo
     * @param type $creditMemoId The creditMemo id
     */
    public function getThePdf($creditMemoId, $templateId)
    {
        $this->templateId = $templateId;
        $this->creditMemoId = $creditMemoId;
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
            ->setSource($this->getTheSource())->setOrder($this->getTheSource()->getOrder())
            ->getTotalsForDisplay();
        $subTotal = Mage::getModel('eadesign/entity_totals_subtotal')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource()->getOrder())
            ->getTotalsForDisplay();
        $shippingTotal = Mage::getModel('eadesign/entity_totals_shipping')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource()->getOrder())
            ->getTotalsForDisplay();
        // need to check the tax system 
        $taxTotal = Mage::getModel('eadesign/entity_totals_tax')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource()->getOrder())
            ->getTotalsForDisplay();
        //need to check the discount system
        $discountTotal = Mage::getModel('eadesign/entity_totals_discount')
            ->setSource($this->getTheSource())->setOrder($this->getTheSource()->getOrder())
            ->getTotalsForDisplay();

        $leftInfoBlock = Mage::getModel('eadesign/entity_additional_info')
            ->setSource($this->getTheSource())
            ->setOrder($this->getTheSource()->getOrder())
            ->getTheInfoMergedVariables();

        $vars = array_merge($subTotal, $grandTotal, $shippingTotal, $taxTotal, $discountTotal, $leftInfoBlock);

        return $vars;
    }

}
