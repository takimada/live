<?php

class Mageist_Sanalpos_Model_Source_Settings extends Varien_Object {

    private $_maxInstallmentCount = 24;
    
    private $_threedtypelist = array(
        0 => "Non-3d (Normal Payment)",
        1 => "3D",
        2 => "3DPay",
        3 => "3DPay Full",
        4 => "3DPay Half",
    );
    private $_currencylist = array(
        '036' => 'Australian Dollar',
        '124' => 'Canadian Dollar',
        '208' => 'Danish Krone',
        '392' => 'Yen',
        '414' => 'Kuwaiti Dinar',
        '578' => 'Norwegian Krone',
        '643' => 'Russian Ruble',
        '682' => 'Saudi Riyal',
        '752' => 'Swedish Krona',
        '756' => 'Swiss Franc',
        '826' => 'Great Britain Pound',
        '840' => 'US Dollars',
        '949' => 'Turkish Lira',
        '975' => 'Bulgarian Lev',
        '978' => 'Euro'
    );
    private $_currencysignlist = array(
        '036' => 'AUD',
        '124' => 'CAD',
        '208' => 'DKK',
        '392' => 'JPY',
        '414' => 'KWD',
        '578' => 'NOK',
        '643' => 'RUB',
        '682' => 'SAR',
        '752' => 'SEK',
        '756' => 'CHF',
        '826' => 'GBP',
        '840' => 'USD',
        '949' => 'TRY',
        '975' => 'BGN',
        '978' => 'EUR'
    );
    private $_yesnolist = array(
        0 => "No",
        1 => "Yes",
    );
    private $_paymentmethodlist = array(
        0 => "Auth",
        1 => "Preauth",
    );

    public function getMaxInstallmentCount() {
        return $this->_maxInstallmentCount;
    }

    public function getThreeDTypeCollection($gateway_type = null) {
        $threeDTypeList = $this->_threedtypelist;
        
        $filters = array(
            'grt' => array(0,1,2,3,4),
            'est' => array(0,1,2),
            'ykb' => array(0,1),
            'vkf' => array(0,1),
            'hsb' => array(1)
        );
        
        $currentFilter = $filters[$gateway_type];

        $arr = array();
        foreach ($threeDTypeList as $key => $val) {
            if(in_array($key, $currentFilter)) {
                $arr[] = array(
                    "value" => $key,
                    "label" => Mage::helper("sanalpos")->__($val),
                );
            }
        }
        return $arr;
    }

    public function getCurrencyCollection($availableCurrencies) {
        
        $availableCurrenciesArray = explode("\n", $availableCurrencies);
        $availableCurrenciesCleanArray = array();
        foreach ($availableCurrenciesArray as $key => $currency) {
            $currency = trim(intval($currency));
            if ($currency == '' || $currency == 0) {
                unset($availableCurrenciesArray[$key]);
            } else {
                $availableCurrenciesCleanArray[] = $currency;
            }
        }
            
        $arr = array();
        foreach ($this->_currencylist as $key => $val) {
            if(in_array($key, $availableCurrenciesCleanArray)) {
                $arr[] = array(
                    "value" => $key,
                    "label" => Mage::helper("sanalpos")->__($val),
                );
            }
        }
        return $arr;
    }
    
    public function getCurrencySign($currencyId){
        return isset($this->_currencysignlist[$currencyId])? $this->_currencysignlist[$currencyId] : null;
    }
    
    public function getCurrencyCodeFromSign($currencySign){
        $key = array_search($currencySign, $this->_currencysignlist); 
        return ($key === false) ? null : $key;
    }

    public function getYesNoCollection() {
        $arr = array();
        foreach ($this->_yesnolist as $key => $val) {
            $arr[] = array(
                "value" => $key,
                "label" => Mage::helper("sanalpos")->__($val),
            );
        }
        return $arr;
    }

    public function getPaymentMethodCollection($gateway_type = null) {
        $arr = array();


        $filters = array(
            'grt' => array(0,1),
            'est' => array(0,1),
            'ykb' => array(0,1),
            'vkf' => array(0,1),
            'hsb' => array(0)
        );
        
        $currentFilter = $filters[$gateway_type];

        $arr = array();
        foreach ($this->_paymentmethodlist as $key => $val) {
            if(in_array($key, $currentFilter)) {
                $arr[] = array(
                    "value" => $key,
                    "label" => Mage::helper("sanalpos")->__($val),
                );
            }
        }
        return $arr;
    }

}