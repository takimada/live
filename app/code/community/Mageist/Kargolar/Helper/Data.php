<?php

/**
 * @author     Berkan Düzgün <berkanduzgun@gmail.com>
 */
class Mageist_Kargolar_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getShippingDetails($order) {
        $shipmentCollection = Mage::getResourceModel('sales/order_shipment_collection')
                ->setOrderFilter($order)
                ->load();

        foreach ($shipmentCollection as $shipment) {
            foreach ($shipment->getAllTracks() as $trackNum) {
                return array('carrier' => $trackNum->getCarrierCode(), 'trackingNumber' => $trackNum->getNumber());
            }
        }
    }
    
    public function getTrackConf($carrier) {
        $allTrackConf = Mage::getStoreConfig('kargolar/kargolar_group/kargo_track', Mage::app()->getStore());
        $allTrackConf = unserialize($allTrackConf);

        foreach ($allTrackConf as $c) {
            if ($c['carrier'] == $carrier) {
                return $c;
            }
        }
    }

}

