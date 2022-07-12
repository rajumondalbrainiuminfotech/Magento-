<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Optiones
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Model_Variables_Optiones extends Mage_Core_Model_Variable_Config
{

    /**
     * Wysiwyg plugin overwide
     * @config array
     */
    public function getWysiwygPluginSettings($config)
    {
        return parent::getWysiwygPluginSettings($config);
    }

    /**
     *
     * @return url
     *
     * Need to add here some more stuff to chage this one
     */
    public function getVariablesWysiwygActionUrl()
    {
        $model = mage::registry('pdfgenerator_template');
        if ($model->getData('pdft_type') == EaDesign_PdfGenerator_Model_Pdfgenerator::PRODUCTTEMPLATE) {
            return Mage::getSingleton('adminhtml/url')->getUrl('*/adminhtml_variable/wysiwygProductPlugin');
        }
        return Mage::getSingleton('adminhtml/url')->getUrl('*/adminhtml_variable/wysiwygPlugin');
    }

}

?>
