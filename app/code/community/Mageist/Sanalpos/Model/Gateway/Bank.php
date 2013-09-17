<?php

class Mageist_Sanalpos_Model_Gateway_Bank extends Varien_Object {
 
    public function selectGateway($gatewayName) {
        $gatewayModel = Mage::getModel('sanalpos/gateway');
        
        $origGatewayName = $gatewayName;
        
        if($gatewayName == 'other') {
            $gatewayName = Mage::getStoreConfig("payment/sanalpos/single_payment_bank");
        }
        
        $selectedGateway = $gatewayModel->getGateway($gatewayName);
        if(!$selectedGateway) {
            $this->log('SANALPOS: Gateway ' . $gatewayName . ' not found on database as active.', Zend_Log::ERR);
            return null;
        }
        
        $gatewayData = $selectedGateway->getData();
        $gatewayType = $gatewayData['gateway_type'];

        if(!$gatewayData['is_active_gateway']) {
            $this->log('SANALPOS: Gateway ' . $gatewayName . ' is not active.', Zend_Log::ERR);
            return null;
        }
        
        try {
            if(class_exists('Mageist_Sanalpos_Model_Gateway_'.$gatewayType)) {
                $gateway = Mage::getModel('sanalpos/gateway_'.$gatewayType);
                $gateway->initialize($gatewayData, $this, $origGatewayName);
                return $gateway;
            }
        } catch (Exception $e) {
            $this->log('SANALPOS: Gateway class for ' . $gatewayType . ' not found.', Zend_Log::ERR);
            return null;
        }
        
    }
    
    public function isInstallmentValid($gateway, $installment, $gatewayType) {
        $installment = intval($installment);
        
        if($gatewayType == 'other') {
            if($installment > 0) {
                return false;
            } else {
                return true;
            }
        }
        
        if($gateway->getData('is_installment_active') != true) {
            if($installment > 0) {
                return false;
            } else {
                return true;
            }
        }
        
        $installmentValue = $gateway->getData('installment_' . $installment . '_value');
        
        if($installmentValue === null) {
            return false;
        }
        
        if(trim($installmentValue) === '') {
            return false;
        }
        
        return true;
    }
    
    public function log($message, $debugLevel = Zend_Log::INFO) {
        //TODO: here, we need additional check for debug type
        //one, needs to open debug, other needs to show it detailed

        $logEnabled = Mage::getStoreConfig("payment/sanalpos/debug_detailed");
        if($logEnabled) {
            Mage::log($message, $debugLevel);    
        }
    }
    
    public function logToDb($transaction, $message) {
        
    }
}

?>
