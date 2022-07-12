<?php

/**
 * Description of Config
 *
 * @author eadesign
 */
class EaDesign_PdfGenerator_Model_Config extends Mage_Core_Model_Abstract
{

    public function toOptionArray()
    {
        $data = array(
            array('value' => 0, 'label' => Mage::helper('pdfgenerator')->__('No')),
            array('value' => 1, 'label' => Mage::helper('pdfgenerator')->__('Yes')),
        );
        return $data;
    }
}