<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Observer
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Model_Observer
{

    public $observerObject;
    public $sourceId;

    public function beforeSendInvoice($observer)
    {

        $this->observerObject = $observer->getEvent()->getObject();

        $sourceId = $observer->getEvent()->getObject()->getId();

        $this->sourceId = $sourceId;
        if ($this->getPdfSituation()) {
            if ($sourceId) {
                if ($this->filterByType() == 'orderpdftemplate') {
                    if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdford_opt/eadesign_pdford_mail')) {
                        return false;
                    }
                    $pdfFile = Mage::getSingleton('eadesign/entity_orderpdf')->getThePdf((int)$sourceId, false);
                }

                if ($this->filterByType() == 'invoicepdftemplate') {
                    if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfinv_opt/eadesign_pdfinv_mail')) {
                        return false;
                    }
                    $pdfFile = Mage::getSingleton('eadesign/entity_invoicepdf')->getThePdf((int)$sourceId, false);
                }

                if ($this->filterByType() == 'cmemopdftemplate') {
                    if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfcm_opt/eadesign_pdfcm_mail')) {
                        return false;
                    }
                    $pdfFile = Mage::getSingleton('eadesign/entity_creditmemopdf')->getThePdf((int)$sourceId, false);
                }

                if ($this->filterByType() == 'shippmentpdftemplate') {
                    if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdfsp_opt/eadesign_pdfsp_mail')) {
                        return false;
                    }
                    $pdfFile = Mage::getSingleton('eadesign/entity_shipmentpdf')->getThePdf((int)$sourceId, false);
                }
            }

            $mailObj = $observer->getEvent()->getTemplate();

            $mailObj->getMail()->createAttachment(
                $pdfFile->getData('pdfbody')
                , 'application/pdf'
                , Zend_Mime::DISPOSITION_ATTACHMENT
                , Zend_Mime::ENCODING_BASE64
                , $pdfFile->getData('filename') . '.pdf'
            );
        }
    }

    public function getPdfSituation()
    {
        return Mage::helper('pdfgenerator/situation')->getCollectionStatus(
            $this->filterByType(),
            $this->observerObject
        );
    }

    public function filterByType()
    {
        if ($this->observerObject instanceof Mage_Sales_Model_Order) {
            return EaDesign_PdfGenerator_Model_Pdfgenerator::ORDERTEMPLATE;
        }
        if ($this->observerObject instanceof Mage_Sales_Model_Order_Invoice) {
            return EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICETEMPLATE;
        }

        if ($this->observerObject instanceof Mage_Sales_Model_Order_Creditmemo) {
            return EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMOTEMPLATE;
        }

        if ($this->observerObject instanceof Mage_Sales_Model_Order_Shipment) {
            return EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENTTEMPLATE;
        }
    }

}

