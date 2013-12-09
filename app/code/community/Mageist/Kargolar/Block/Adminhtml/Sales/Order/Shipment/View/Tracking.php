<?php

class Mageist_Kargolar_Block_Adminhtml_Sales_Order_Shipment_View_Tracking extends Mage_Adminhtml_Block_Sales_Order_Shipment_View_Tracking {

    public function getCarriers() {
        $carriers = array();
        
        $carriers['custom'] = Mage::helper('sales')->__('Custom Value');
        
        $kargoConf = unserialize(Mage::getStoreConfig('kargolar/kargolar_group/kargo_track', Mage::app()->getStore()));

        foreach($kargoConf as $kc) {
            $carriers[$kc['carrier']] = $kc['carrier'];
        }

        return $carriers;
    }

    public function getCarrierTitle($code)
    {

        $kargoConf = unserialize(Mage::getStoreConfig('kargolar/kargolar_group/kargo_track', Mage::app()->getStore()));

        foreach($kargoConf as $kc) {
            if($kc['carrier'] == $code) {
                return $code;
            }
        }

        return parent::getCarrierTitle($code);
    }

}