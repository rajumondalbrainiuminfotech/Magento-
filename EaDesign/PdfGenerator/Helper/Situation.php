<?php

/**
 * Created by IntelliJ IDEA.
 * User: eadesignpc
 * Date: 12/5/2014
 * Time: 1:15 PM
 */
class EaDesign_PdfGenerator_Helper_Situation
{

    /**
     * The situations for admin system
     * Need more validation on model line 82
     */
    public function getAdminSituation($type, $source, $eaUrl, $defUrl)
    {
        $templateData = $this->getCollectionStatus($type, $source);

        if (!$this->checkMbstring()) {
            $messege = Mage::helper('pdfgenerator')->__('You do not have mbstrings library active. You will get the default Magento Print');
            return $location = "confirmSetLocation('{$messege}', '{$defUrl}')";
        }

        if ($templateData) {
            return $location = 'setLocation(\'' . $eaUrl . '\')';
        }
        $messege = Mage::helper('pdfgenerator')->__('You do not have a template selected for this invoice. You will get the default Magento Print');
        return $location = "confirmSetLocation('{$messege}', '{$defUrl}')";
    }

    public function checkMbstring()
    {
        if (extension_loaded('mbstring')) {
            return true;
        }
        return false;
    }

    public function getCollectionStatus($type, $source)
    {
        $templateCollection = Mage::getModel('eadesign/pdfgenerator')->getCollection();
        $templateCollection->addFieldToSelect('pdftemplate_id')
            ->addFieldToFilter('pdft_type', $type)
            ->addFieldToFilter('template_store_id', $this->getOrderStore($source))
            ->addFieldToFilter('pdft_is_active', 1);

        $col = $templateCollection->getData();
        if (empty($col)) {
            return false;
        }

        return true;
    }

    private function getOrderStore($source)
    {
        if ($source instanceof Mage_Sales_Model_Order) {
            $storeId = $source->getStore()->getId();
        } else {
            $storeId = $source->getOrder()->getStore()->getId();
        }
        if ($storeId) {
            return array(0, $storeId);
        }
        return array(0);

    }
}