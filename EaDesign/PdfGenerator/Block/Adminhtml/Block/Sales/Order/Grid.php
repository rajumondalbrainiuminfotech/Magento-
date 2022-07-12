<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grid
 *
 * @author eadesignpc
 */
class EaDesign_PdfGenerator_Block_Adminhtml_Block_Sales_Order_Grid extends Mage_Adminhtml_Block_Sales_Order_Grid
{

    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('order_ids');
        $this->getMassactionBlock()->setUseSelectAll(false);

        $orderTemplatesCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();

        $orderTemplates = $orderTemplatesCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('pdft_type'
                , EaDesign_PdfGenerator_Model_Pdfgenerator::ORDERTEMPLATE)
            ->addFieldToFilter('pdft_is_active', 1);

        $invoiceTemplatesCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();

        $invoiceTemplates = $invoiceTemplatesCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('pdft_type'
                , EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICETEMPLATE)
            ->addFieldToFilter('pdft_is_active', 1);

        $cmemoTemplatesCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();

        $cmemoTemplates = $cmemoTemplatesCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('pdft_type'
                , EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMOTEMPLATE)
            ->addFieldToFilter('pdft_is_active', 1);

        $shipmentTemplatesCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();

        $shipmentTemplates = $shipmentTemplatesCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('pdft_type'
                , EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENTTEMPLATE)
            ->addFieldToFilter('pdft_is_active', 1);

        $oTemplates[0] = Mage::helper('sales')->__('Select');
        $iTemplates[0] = Mage::helper('sales')->__('Select');
        $cTemplates[0] = Mage::helper('sales')->__('Select');
        $sTemplates[0] = Mage::helper('sales')->__('Select');

        foreach ($orderTemplates as $collection1) {
            $oTemplates[$collection1->getData('pdftemplate_id')] = $collection1->getData('pdftemplate_name');
        }

        foreach ($invoiceTemplates as $collection1) {
            $iTemplates[$collection1->getData('pdftemplate_id')] = $collection1->getData('pdftemplate_name');
        }

        foreach ($cmemoTemplates as $collection) {
            $cTemplates[$collection->getData('pdftemplate_id')] = $collection->getData('pdftemplate_name');
        }

        foreach ($shipmentTemplates as $collection) {
            $sTemplates[$collection->getData('pdftemplate_id')] = $collection->getData('pdftemplate_name');
        }

        $this->getMassactionBlock()->addItem('pdforders_ordereaorder', array(
            'label' => Mage::helper('sales')->__('EaDesgin PDF Orders'),
            'url' => $this->getUrl('adminpdfgenerator/adminhtml_pdfgeneratorpdf/sourcespdfmass', array('_current' => true)),
            'values' => 'order_only',
            'additional' => array(
                'visibility' => array(
                    'name' => 'template',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Template to print'),
                    'values' => $oTemplates,
                )
            )
        ));

        $this->getMassactionBlock()->addItem('pdforders_ordereainvoice', array(
            'label' => Mage::helper('sales')->__('EaDesgin PDF Invoices'),
            'url' => $this->getUrl('adminpdfgenerator/adminhtml_pdfgeneratorpdf/sourcespdfmass', array('_current' => true)),
            'values' => 'invoice',
            'additional' => array(
                'visibility' => array(
                    'name' => 'template',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Template to print'),
                    'values' => $iTemplates,
                )
            )
        ));

        $this->getMassactionBlock()->addItem('pdforders_ordereacmemo', array(
            'label' => Mage::helper('sales')->__('EaDesgin PDF Credit memo'),
            'url' => $this->getUrl('adminpdfgenerator/adminhtml_pdfgeneratorpdf/sourcespdfmass', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'template',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Template to print'),
                    'values' => $cTemplates,
                )
            )
        ));

        $this->getMassactionBlock()->addItem('pdforders_ordereashipment', array(
            'label' => Mage::helper('sales')->__('EaDesgin PDF Shipment'),
            'url' => $this->getUrl('adminpdfgenerator/adminhtml_pdfgeneratorpdf/sourcespdfmass', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'template',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Template to print'),
                    'values' => $sTemplates
                )
            )
        ));

        parent::_prepareMassaction();

        return $this;
    }

}
