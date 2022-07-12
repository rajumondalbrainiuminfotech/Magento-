<?php

/**
 * We need to chege this one to the front. We will see!!!
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_IndexController extends Mage_Sales_Controller_Abstract
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Need to redo this part - cleaner code
     * @return null
     */

    public function orderpdfgenratorAction()
    {
        $orderId = (int)$this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($orderId);


        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
        } else {
            if (Mage::getSingleton('customer/session')->isLoggedIn()) {
                $this->_redirect('sales/order/history/');
            } else {
                $this->_redirect('sales/guest/form');
            }
        }


        try {
            $pdfFile = Mage::getSingleton('eadesign/entity_orderpdf')->getThePdf((int)$orderId, false);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }
    }

    public function invoicepdfgenratorAction()
    {

        $invoiceId = (int)$this->getRequest()->getParam('invoice_id');
        if ($invoiceId) {
            $invoice = Mage::getModel('sales/order_invoice')->load($invoiceId);
            $order = $invoice->getOrder();
        } else {
            $orderId = (int)$this->getRequest()->getParam('order_id');
            $order = Mage::getModel('sales/order')->load($orderId);
        }


        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
            if (isset($invoice)) {
                Mage::register('current_invoice', $invoice);
            }
        } else {
            if (Mage::getSingleton('customer/session')->isLoggedIn()) {
                $this->_redirect('sales/order/history/');
            } else {
                $this->_redirect('sales/guest/form');
            }
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

        $creditmemoId = (int)$this->getRequest()->getParam('creditmemo_id');
        if ($creditmemoId) {
            $creditmemo = Mage::getModel('sales/order_creditmemo')->load($creditmemoId);
            $order = $creditmemo->getOrder();
        } else {
            $orderId = (int)$this->getRequest()->getParam('order_id');
            $order = Mage::getModel('sales/order')->load($orderId);
        }


        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
            if (isset($creditmemo)) {
                Mage::register('current_creditmemo', $creditmemo);
            }
        } else {
            if (Mage::getSingleton('customer/session')->isLoggedIn()) {
                $this->_redirect('sales/order/history/');
            } else {
                $this->_redirect('sales/guest/form');
            }
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

        $shipmentId = (int)$this->getRequest()->getParam('shipment_id');
        if ($shipmentId) {
            $shipment = Mage::getModel('sales/order_shipment')->load($shipmentId);
            $order = $shipment->getOrder();
        } else {
            $orderId = (int)$this->getRequest()->getParam('order_id');
            $order = Mage::getModel('sales/order')->load($orderId);
        }


        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
            if (isset($shipment)) {
                Mage::register('current_shipment', $shipment);
            }
        } else {
            if (Mage::getSingleton('customer/session')->isLoggedIn()) {
                $this->_redirect('sales/order/history/');
            } else {
                $this->_redirect('sales/guest/form');
            }
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

    public function productpdfgenratorAction()
    {
        $productId = (int)$this->getRequest()->getParam('product_id');

        if ($productId) {
            $product = Mage::getSingleton('eadesign/entity_productpdf')->getThePdf((int)$productId);
        }

        try {
            $pdfFile = Mage::getSingleton('eadesign/entity_productpdf')->getThePdf((int)$productId);
            $this->_prepareDownloadResponse($pdfFile->getData('filename') .
                '.pdf', $pdfFile->getData('pdfbody'), 'application/pdf');
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            return null;
        }


    }

}
