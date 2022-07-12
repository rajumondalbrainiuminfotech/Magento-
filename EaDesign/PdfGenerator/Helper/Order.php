<?php

/**
 * Description of Order
 *
 * @author EaDesign
 */
class EaDesign_PdfGenerator_Helper_Order extends Mage_Catalog_Helper_Product
{

    public function getOrderChildren($ordersId, $templateId)
    {

        $template = Mage::getModel('eadesign/pdfgenerator')->load($templateId);
        $templateType = $template->getData('pdft_type');

        $ids = array();
        foreach ($ordersId as $id) {
            if ($templateType == EaDesign_PdfGenerator_Model_Pdfgenerator::ORDERTEMPLATE) {
                $ids[] = $id;
                $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::ORDER_ENT;
            }

            $order = Mage::getModel('sales/order')->load($id);

            if ($templateType == EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICETEMPLATE) {
                if ($order->hasInvoices()) {
                    foreach ($order->getInvoiceCollection() as $invoiceCollection) {
                        $ids[] = $invoiceCollection->getData('entity_id');
                        $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::INVOICE_ENT;
                    }
                }
            }

            if ($templateType == EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENTTEMPLATE) {
                if ($order->hasShipments()) {
                    foreach ($order->getShipmentsCollection() as $invoiceCollection) {
                        $ids[] = $invoiceCollection->getData('entity_id');
                        $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::SHIPPMENT_ENT;
                    }
                }
            }

            if ($templateType == EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMOTEMPLATE) {
                if ($order->hasCreditmemos()) {
                    foreach ($order->getCreditmemosCollection() as $invoiceCollection) {
                        $ids[] = $invoiceCollection->getData('entity_id');
                        $redirect = EaDesign_PdfGenerator_Model_Pdfgenerator::CMEMO_ENT;
                    }
                }
            }
        }

        if (!empty($ids)) {
            $orderItems = new Varien_Object;

            $orderItems->setData('ids', $ids);
            $orderItems->setData('redirect', $redirect);

            return $orderItems;
        }

        return false;
    }

}
