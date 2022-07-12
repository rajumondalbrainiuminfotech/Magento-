<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Sales
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Block of links in Order view page
 *
 * @category    Mage
 * @package     Mage_Sales
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class EaDesign_PdfGenerator_Block_Sales_Order_Info_Buttons extends Mage_Sales_Block_Order_Info_Buttons
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('pdfgenerator/sales/order/info/buttons.phtml');
    }

    public function getPdfPrintButton()
    {
        if ($this->getPdfSituation()) {
            return Mage::getUrl('pdfgenerator/index/orderpdfgenrator', array('order_id' => $this->getOrder()->getId()));
        }
        return false;
    }

    public function getPdfSituation()
    {
        if (!Mage::getStoreConfig('pdfgeneratorconfig_opt/pdford_opt/eadesign_pdfinv_ord_f')) {
            return false;
        }
        return Mage::helper('pdfgenerator/situation')->getCollectionStatus(
            EaDesign_PdfGenerator_Model_Pdfgenerator::ORDERTEMPLATE,
            $this->getOrder()
        );
    }
}
