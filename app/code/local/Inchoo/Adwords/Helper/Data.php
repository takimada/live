<?php
/**
 *
 * @category   Inchoo
 * @package    Inchoo Google Adwords
 * @author     Domagoj Potkoc, Inchoo Team <domagoj.potkoc@surgeworks.com>
 */
class Inchoo_Adwords_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getOrderTotal()
    {
        $order = Mage::getModel('sales/order')->loadByIncrementId(Mage::getSingleton('checkout/session')->getLastRealOrderId());

        $grandTotal = $order->getGrandTotal();

        if($grandTotal > 0)
            return round($grandTotal,2);
        else
            return 1;
    }


    public function isTrackingAllowed()
    {
        return Mage::getStoreConfigFlag('adwordsmodule/inchoad/enabled');
    }
}