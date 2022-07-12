<?php

/**
 * Description of ShippmentTrack
 *
 * @author eadesign
 */
class EaDesign_PdfGenerator_Helper_Shippmentrack extends Mage_Core_Helper_Abstract
{

    public function getTrackTable($tracks)
    {
        $htmlHead = '<table cellspacing="0" align="left">'

            . '<thead>'
            . '<tr>'
            . '<th align="left">' . Mage::helper('sales')->__('Carrier') . '</th>'
            . '<th align="left">' . Mage::helper('sales')->__('Title') . '</th>'
            . '<th align="left">' . Mage::helper('sales')->__('Number') . '</th>'
            . '</tr>'
            . '</thead>';

        $htmlBody = '<tbody>';
        $i = 0;
        foreach ($tracks as $track) {
            $htmlBody .= '<tr>'
                . '<td>' . $this->escapeHtml($this->getCarrierTitle($track->getCarrierCode())) . '</td>'
                . '<td>' . $this->escapeHtml($track->getTitle()) . '</td>'
                . '<td>' . $this->escapeHtml($track->getNumber()) . '</td>'
                . '</tr>';
        }

        $htmlBody .= '</tbody></table>';

        $html = $htmlHead . $htmlBody;

        return $html;
    }

    public function getCarrierTitle($code)
    {
        if ($carrier = Mage::getSingleton('shipping/config')->getCarrierInstance($code)) {
            return $carrier->getConfigData('title');
        } else {
            return Mage::helper('sales')->__('Custom Value');
        }
        return false;
    }

}
