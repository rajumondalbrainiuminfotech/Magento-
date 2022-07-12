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
class EaDesign_PdfGenerator_Model_Entity_Shipmentpdf extends EaDesign_PdfGenerator_Model_Entity_Pdfgenerator
{

    /**
     * The id of the shipment
     * @var int
     */
    public $shipmentId;

    public $templateId;

    public function getTheSource()
    {
        $shipment = Mage::getModel('sales/order_shipment')->load($this->shipmentId);
        return $shipment;
    }

    /**
     * Get the shipment id and create the vars for teh shipment
     * @param type $shipmentId The shipment id
     */
    public function getThePdf($shipmentId, $templateId)
    {
        $this->templateId = $templateId;
        $this->shipmentId = $shipmentId;
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
