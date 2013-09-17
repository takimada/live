<?php

class Mageist_Sanalpos_Model_Gateway extends Mage_Core_Model_Abstract {

    function _construct() {
        $this->_init('sanalpos/gateway');
    }
    
    public function getGateway($gatewayCode) {
        $collection = $this->getCollection(Mage::app()->getStore()->getId())
                ->addFieldToSelect('*')
                ->addFieldToFilter('gateway_code', array('eq' => $gatewayCode));
        if($collection->count() == 0) {
            return null;
        }
        return $collection->getFirstItem();
    }

    public function getActiveGatewayList() {
        $collection = $this->getCollection(Mage::app()->getStore()->getId())
                ->addFieldToFilter('is_active_gateway', array('eq' => 1))
                ->setOrder('sort_order', 'asc');

        return $collection;
    }
    
    public function getBinGateway($binNumber) {
        if(is_numeric ($binNumber) && strlen($binNumber) == 6) {
            $ccTypeRegExpList = array(
                    'VI'  => '/^4[0-9]{5}$/',
                    'MC'  => '/^5[1-5][0-9]{4}$/');
            
            $ccType     = 'visa';
            $ccTypeCode = '';
            foreach ($ccTypeRegExpList as $ccTypeMatch=>$ccTypeRegExp) {
                if (preg_match($ccTypeRegExp, $binNumber)) {
                    $ccTypeCode = $ccTypeMatch;
                    if($ccTypeCode == 'MC') $ccType = 'mastercard';
                    break;
                }
            }
            
            $gateways = Mage::getModel('sanalpos/gateway')->getActiveGatewayList();
            
            $selectedGateway = 'other';
            foreach($gateways as $gateway) {
                $binNumbers = $gateway->getData('bin_numbers');
                
                $binNumbersArray = explode("\n",$binNumbers);
                $binNumbersCleanArray = array();
                foreach($binNumbersArray as $key=>$prefix) {
                    $prefix = trim(intval($prefix));
                    if($prefix == '' || $prefix == 0) {
                        unset($binNumbersArray[$key]);
                    } else {
                        $binNumbersCleanArray[] = $prefix;
                    }
                }
                $canBreak = false;
                foreach($binNumbersCleanArray as $prefix) {
                    if($binNumber == $prefix) {
                        $selectedGateway = $gateway->getData('gateway_code');
                        $canBreak = true;
                        break;
                    }
                }
                if($canBreak) break;
            }
            
            return array("gateway"=>$selectedGateway, "type"=>$ccType, "typecode"=>$ccTypeCode);
        } else {
            return array("gateway"=>"", "type"=>"", "typecode"=>'');
        }
    }

    public function getInstallmentTable($basePrice = null, $shippingPrice = null, $isShippingIncluded = null) {
                
        $quote = Mage::getModel('checkout/session')->getQuote();
        if($basePrice === null) {
            $basePrice = $quote->getBaseGrandTotal();
        }
        
        if($shippingPrice === null) {
            $shippingAddresses = $quote->getShippingAddress();
            $shippingPrice = $shippingAddresses['shipping_amount'];
        }
        
        if($isShippingIncluded == null) {
            //$isShippingIncluded = Mage::getStoreConfig("payment/sanalpos/include_shipment_to_installment");
            $isShippingIncluded = true;
        }
        
        if($isShippingIncluded == false) {
            $basePrice -= $shippingPrice;
        } else {
            $shippingPrice = 0;
        }

        $collection = $this->getActiveGatewayList();
        $single_payment_bank = Mage::getStoreConfig("payment/sanalpos/single_payment_bank");
        $single_payment_title = Mage::getStoreConfig("payment/sanalpos/single_payment_title");
        $single_payment_commission = Mage::getStoreConfig("payment/sanalpos/single_payment_commission");

        $gatewayList = array();
        $activeInstallments = array();

        $highestInstallment = 0;
        foreach ($collection as $gateway) {
            $singleGateway = array();
            $singleGateway['gateway_type'] = $gateway->getData('gateway_type');
            $singleGateway['gateway_name'] = $gateway->getData('gateway_name');
            $singleGateway['gateway_title'] = $gateway->getData('gateway_title');
            $singleGateway['gateway_code'] = $gateway->getData('gateway_code');
            $singleGateway['gateway_image'] = $gateway->getData('gateway_image');
            $singleGateway['gateway_icon'] = $gateway->getData('gateway_icon');
            $singleGateway['gateway_color_dark'] = $gateway->getData('gateway_color_dark');
            $singleGateway['gateway_color_light'] = $gateway->getData('gateway_color_light');
            $singleGateway['gateway_color_text'] = $gateway->getData('gateway_color_text');
            $singleGateway['top_text'] = $gateway->getData('top_text');
            $singleGateway['bottom_text'] = $gateway->getData('bottom_text');
            $singleGateway['is_installment_active'] = $gateway->getData('is_installment_active');
            $singleGateway['is_active_gateway'] = $gateway->getData('is_active_gateway');

            $binNumbersArray = explode("\n", $gateway->getData('bin_numbers'));
            $binNumbersCleanArray = array();
            foreach ($binNumbersArray as $key => $prefix) {
                $prefix = trim(intval($prefix));
                if ($prefix == '' || $prefix == 0) {
                    unset($binNumbersArray[$key]);
                } else {
                    $binNumbersCleanArray[] = $prefix;
                }
            }

            $singleGateway['bin_numbers'] = $binNumbersArray;

            $maxInstallmentCount = Mage::getModel('sanalpos/source_settings')->getMaxInstallmentCount();
            
            $singleGateway['installment'] = array();
            
            $highestInstallmentForThis = 0;
            for ($i = 0; $i <= $maxInstallmentCount; $i++) {
                $installmentValue = trim($gateway->getData('installment_' . $i . '_value'));
                if ($installmentValue != null && $installmentValue != '') {
                    
                    if($i > 0 && $singleGateway['is_installment_active'] == 0) {
                        break;
                    }
                    
                    $activeInstallments[] = $i;
                    
                    $singleInstallment = array();
                    $singleInstallment['installment'] = $i;
                    $highestInstallmentForThis = $i;
                    
                    $installmentValue = floatval($installmentValue);
                    $singleInstallment['value'] = $installmentValue;
                    
                    $newBasePrice = $basePrice + (($basePrice * $installmentValue) / 100) + $shippingPrice;
                    if($i == 0) {
                        $monthlyPrice = $newBasePrice;
                    }
                    else {
                        $monthlyPrice = $newBasePrice / $i;
                    }
                    
                    
                    $singleInstallment['monthly'] = Mage::helper('core')->currency($monthlyPrice,true,false);
                    $singleInstallment['total'] = Mage::helper('core')->currency($newBasePrice,true,false);
                    
                    $singleInstallment['text'] = trim($gateway->getData('installment_' . $i . '_text'));
                    if ($singleInstallment['text'] == '') {
                        if($i == 0) {
                            $singleInstallment['text'] = Mage::helper("sanalpos")->__('Cash');
                        } else {
                            $singleInstallment['text'] = Mage::helper("sanalpos")->__('%s Installment', $i);
                        }
                    }
                    $singleGateway['installment'][$i] = $singleInstallment;
                }
                

            }

            if ($highestInstallmentForThis > $highestInstallment) {
                $highestInstallment = $highestInstallmentForThis;
            }

            $gatewayList[] = $singleGateway;
        }

        $singlePayment = null;
        
        if ($single_payment_bank != '') {
            $singlePayment = array();
            $singlePayment['gateway'] = $single_payment_bank;
            $singlePayment['title'] = ($single_payment_title != ''? $single_payment_title : Mage::helper("sanalpos")->__('Cash'));
            $singlePayment['commission'] = floatval($single_payment_commission);
            $singlePayment['total'] = $basePrice + (($basePrice * $singlePayment['commission']) / 100) + $shippingPrice;
            $singlePayment['total'] = Mage::helper('core')->currency($singlePayment['total'],true,false);
            
        }

        $activeInstallments = array_unique($activeInstallments);
        asort($activeInstallments);
        return array('gatewaylist' => $gatewayList, 'singlePayment' => $singlePayment, 'highestInstallment' => $highestInstallment, 'activeInstallments' => $activeInstallments);
    }

}