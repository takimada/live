<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Quote
 *
 * @author eren
 */
class Mageist_Sanalpos_Model_Quote_Address  extends Mage_Sales_Model_Quote_Address_Total_Abstract {
    public function __construct()
    {
        //parent::__construct();
        $this->setCode('sanalpos');
    }
    
    /**
     * Collect totals information about wrapping
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Mageist_Sanalpos_Model_Quote_Address
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }
        parent::collect($address);

        // ... Some your api calls to retrive amount ...

        // Set base amount of your custom fee
        
       
        $returnVal = Mage::getModel('sanalpos/gateway_bank')->getInstallmentPrice();
        if($returnVal !== null) {
            $calculatedAmount = Mage::getModel('checkout/session')->getInstallmentPrice();
            if($calculatedAmount === null) {
                return $this; 
            }
            Mage::getModel('checkout/session')->setInstallmentPrice($calculatedAmount);

            $this->_setBaseAmount($calculatedAmount);

            // Set amount of your custom fee in displayed currency
            $this->_setAmount(
                $address->getQuote()->getStore()->convertPrice($calculatedAmount, false)
            );
            
        } else {
            Mage::getModel('checkout/session')->setInstallmentPrice(null);
        }

        
        return $this;
    }
    
    /**
     * Add shipping totals information to address object
     *
     * @param   Mage_Sales_Model_Quote_Address $address
     * @return  Mageist_Sanalpos_Model_Quote_Address
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }
        
        $amount = Mage::getModel('checkout/session')->getInstallmentPrice();
        if($amount === null) {
            return $this; 
        }
        Mage::getModel('checkout/session')->setInstallmentPrice(null);
        if ($amount != 0) {
            $title = Mage::helper('sanalpos')->__('Installment Interest');
            $address->addTotal(array(
                'code' => $this->getCode(),
                'title' => $title,
                'value' => $amount
            ));
        }

        return $this;
    }

    /**
     * Get "Installment Interest" label
     *
     * @return string
     */
    public function getLabel()
    {
        return Mage::helper('sanalpos')->__('Installment Interest');
    }
}

?>
