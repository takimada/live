<?php

class Mageist_Kargolar_Block_Adminhtml_Sales_Order_Shipment_Create_Tracking extends Mage_Adminhtml_Block_Sales_Order_Shipment_Create_Tracking {

    public function getCarriers() {
        $carriers = array();
        
        $carriers['custom'] = Mage::helper('sales')->__('Custom Value');
        
        $kargoConf = unserialize(Mage::getStoreConfig('kargolar/kargolar_group/kargo_track', Mage::app()->getStore()));

        foreach($kargoConf as $kc) {
            $carriers[$kc['carrier']] = $kc['carrier'];
        }

        return $carriers;
    }

}