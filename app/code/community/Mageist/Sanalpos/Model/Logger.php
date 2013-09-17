<?php

class Mageist_Sanalpos_Model_Logger extends Mage_Core_Model_Abstract {

    function _construct() {
        $this->_init('sanalpos/logger');
    }

    public function save()
    {
        $logEnabled = Mage::getStoreConfig("payment/sanalpos/debug");
        if($logEnabled) {
            return parent::save();    
        }
    }
}