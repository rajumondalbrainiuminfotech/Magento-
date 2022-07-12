<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PdfgeneratorPdfConstroller
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Adminhtml_PdfgeneratorpdfController extends Mage_Adminhtml_Controller_Action
{

    public function orderpdfgenratorAction()
    {
        if (!$orderId = $this->getRequest()->getParam('order_id')) {
            return false;
        }
        try {
            $pdfModel = Mage::getSingleton('eadesign/entity_orderpdf');
            $pdfFile = $pdfModel->getThePdf((int)$orderId, false);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }
    }

    public function invoicepdfgenratorAction()
    {

        if (!$invoiceId = $this->getRequest()->getParam('invoice_id')) {
            return false;
        }
        try {
            $pdfFile = Mage::getSingleton('eadesign/entity_invoicepdf')->getThePdf((int)$invoiceId, false);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }
    }

    public function credimemopdfgenratorAction()
    {

        if (!$creditmemoId = $this->getRequest()->getParam('creditmemo_id')) {
            return false;
        }
        try {
            $pdfFile = Mage::getSingleton('eadesign/entity_creditmemopdf')->getThePdf((int)$creditmemoId, false);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }
    }

    public function shipmentpdfgenratorAction()
    {

        if (!$shipmentId = $this->getRequest()->getParam('shipment_id')) {
            return false;
        }
        try {
            $pdfFile = Mage::getSingleton('eadesign/entity_shipmentpdf')->getThePdf((int)$shipmentId, false);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }
    }

    public function sourcespdfmassAction()
    {

        $templateId = $this->getRequest()->getPost('template');
        $error = Mage::helper('sales')->__('You have no templates selected or you have no items to print!');

        if ($ordersId = $this->getRequest()->getPost('order_ids')) {
            $orderHelper = Mage::helper('pdfgenerator/order')->getOrderChildren($ordersId, $templateId);

            if (!$orderHelper) {
                $templateId = false;
                $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::ORDER_ENT;
            } else {
                $ids = $orderHelper->getData('ids');
                $redirect = $orderHelper->getData('redirect');
            }
        }

        if ($idso = $this->getRequest()->getPost('order_ids')) {
            $ids = $idso;
            $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::ORDER_ENT;
        }
        if ($idsi = $this->getRequest()->getPost('invoice_ids')) {
            $ids = $idsi;
            $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICE_ENT;
        }
        if ($idss = $this->getRequest()->getPost('shipment_ids')) {
            $ids = $idss;
            $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENT_ENT;
        }
        if ($idsc = $this->getRequest()->getPost('creditmemo_ids')) {
            $ids = $idsc;
            $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMO_ENT;
        }

        if (!$templateId) {
            $this->_redirect('adminhtml/sales_' . $redirect);
            Mage::getSingleton('core/session')->addError($error);
            return;
        }

        $pdfData = Mage::getSingleton('eadesign/entity_masspdf')->getPdfData($ids, $templateId, $redirect);
        $this->_prepareDownloadResponse('ea_' . $redirect . '_mass_print' .
            '.pdf', $pdfData, 'application/pdf');
    }

}
