<?php

class Mageist_Sanalpos_Model_Sanalpos extends Mage_Payment_Model_Method_Cc {

    protected $_code = 'sanalpos';
    
    /**
     * Here are examples of flags that will determine functionality availability
     * of this module to be used by frontend and backend.
     *
     * @see all flags and their defaults in Mage_Payment_Model_Method_Abstract
     *
     * It is possible to have a custom dynamic logic by overloading
     * public function can* for each flag respectively
     */
     
    /**
     * Is this payment method a gateway (online auth/charge) ?
     */
    protected $_isGateway               = true;
 
    /**
     * Can authorize online?
     */
    protected $_canAuthorize            = false;
 
    /**
     * Can capture funds online?
     */
    protected $_canCapture              = false;
 
    /**
     * Can capture partial amounts online?
     */
    protected $_canCapturePartial       = false;
 
    /**
     * Can refund online?
     */
    protected $_canRefund               = true;
 
    /**
     * Can void transactions online?
     */
    protected $_canVoid                 = true;
 
    /**
     * Can use this payment method in administration panel?
     */
    protected $_canUseInternal          = false;
 
    /**
     * Can show this payment method as an option on checkout payment page?
     */
    protected $_canUseCheckout          = true;
 
    /**
     * Is this payment method suitable for multi-shipping checkout?
     */
    protected $_canUseForMultishipping  = false;
 
    /**
     * Can save credit card information for future processing?
     */
    protected $_canSaveCc = false;
    
    /**
     * Is initialization needed
     */
//    protected $_isInitializeNeeded = false;
    
    
    protected $_formBlockType = 'sanalpos/form_cc';
    protected $_infoBlockType = 'sanalpos/info_cc';
    
    protected $_paymentData = null;

    public function assignData($data) {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }
        $info = $this->getInfoInstance();

        $this->_paymentData = array(
            'ccOwner' => $data->getCcOwner(),
            'ccNumber' => $data->getCcNumber(),
            'ccExpMonth' => $data->getCcExpMonth(),
            'ccExpYear' => $data->getCcExpYear(),
            'ccInstallment' => $data->getCcInstallment(),
            'ccGateway' => $data->getCcGateway(),
            'ccCvv' => $data->getCcCid()
        );
        
        $info->setCcType($data->getCcType())
                ->setCcOwner($data->getCcOwner())
                ->setCcLast4(substr($data->getCcNumber(), -4))
                ->setCcNumber($data->getCcNumber())
                ->setCcCid($data->getCcCid())
                ->setCcExpMonth($data->getCcExpMonth())
                ->setCcExpYear($data->getCcExpYear())
                ->setCcSsIssue($data->getCcSsIssue())
                ->setCcSsStartMonth($data->getCcSsStartMonth())
                ->setCcSsStartYear($data->getCcSsStartYear())
                ->setCcInstallment($data->getCcInstallment())
                ->setCcGateway($data->getCcGateway())
        ;
        
        $info->setAdditionalInformation('installment', $data->getCcInstallment());
        $info->setAdditionalInformation('gateway', $data->getCcGateway());
        
        Mage::getSingleton('checkout/session')->setPaymentData($this->_paymentData);

        return $this;
    }
    
    public function validate() {
        $this->_gateway = $gateway = null;
        parent::validate();
        
        $info = $this->getInfoInstance();
        $errorMsg = false;

        $installmentType = $info->getAdditionalInformation('installment');
        
        if($installmentType == '') {
            $errorMsg = $this->_getHelper()->__('Please Select Installment');
        }
        
        $gateway = Mage::getModel('sanalpos/gateway_bank')->selectGateway($info->getAdditionalInformation('gateway'));
        if($gateway) {
            if($gateway->getTransactionMethod() == 'no_3d') {
                $this->_canCapture = true;
            } 
            
            $paymentData = Mage::getSingleton('checkout/session')->getPaymentData();
            
            if($gateway->checkIfInstallmentActive($paymentData)) {
                $gateway->preparePaymentData();
                $finalPrice = $gateway->getFinalAmount();
                $finalCurrency = $gateway->getFinalCurrency();
                
                $info->setAdditionalInformation('finalPrice', $finalPrice);
                $info->setAdditionalInformation('finalCurrency', $finalCurrency);
                
                $this->_gateway = $gateway;


            } else {
                $errorMsg = $this->_getHelper()->__('Selected installment option is not valid for this gateway.');
            }
            
        } else {
            $errorMsg = $this->_getHelper()->__('Gateway not found or not active.');
        }
        
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        
        return $this;
        
    }

    /**
     * this method is called if we are just authorising
     * a transaction
     */
    public function authorize(Varien_Object $payment, $amount) {
        $this->_debug('authorize');
    }

    /**
     * this method is called if we are authorising AND
     * capturing a transaction
     */
    public function capture(Varien_Object $payment, $amount) {
        
        $this->_order_status = null;
        
        $gateway = $this->_gateway;
      
        $returnArray = $gateway->getNon3DResult();

        if($returnArray['result'] == 1) {
            $state = $gateway->getFinalState();
            $this->_order_status = $state;
            $gateway->postProcessNon3D($payment);
        
            $logger = Mage::getModel('sanalpos/logger');

            $logger->setData('gateway_type', $gateway->getGatewayDataField('gateway_type'));
            $logger->setData('gateway_code', $gateway->getGatewayDataField('gateway_code'));
            $logger->setData('gateway_name', $gateway->getGatewayDataField('gateway_name'));
            $logger->setData('amount', $gateway->getFinalAmount());
            $logger->setData('currency', $gateway->getFinalCurrency());

            $logger->setData('api_request', $returnArray['_requestXML']);
            $logger->setData('api_result', $returnArray['_resultXML']);
            $logger->setData('status', 3);  //Completed succesfully [1:waiting, 2:error, 3:completed]

            $order = $payment->getOrder();

            $logger->setData('order_id', $order->getIncrementId());
            $logger->setData('real_order_id', $order->getId());

            $logger->setData('ip_address', $gateway->_customerIpAddress);

            if($order->getCustomerId() !== NULL){
                //$name =  $order->getBillingAddress()->getFirstname() . ' ' . $order->getBillingAddress()->getLastname();
                $logger->setData('customer_id', $order->getCustomerId());
            }

            $logger->setData('created_at', $order->getCreatedAt());

            $logger->save();

        } else {
            Mage::throwException($returnArray['message']);
        }
        return $this;
    }

    /**
     * called if refunding
     */
    public function refund(Varien_Object $payment, $amount) {
        $this->_debug('refund');
    }

    /**
     * called if voiding a payment
     */
    public function void(Varien_Object $payment) {
        $this->_debug('void');
    }
    

    public function getOrderPlaceRedirectUrl() {
        
        $gateway = $this->_gateway;

        if($gateway->getTransactionMethod() == 'no_3d') {
            return false;
        }  else {
            $gateway->prepare3DPost();

            $logger = Mage::getModel('sanalpos/logger');

            $logger->setData('gateway_type', $gateway->getGatewayDataField('gateway_type'));
            $logger->setData('gateway_code', $gateway->getGatewayDataField('gateway_code'));
            $logger->setData('gateway_name', $gateway->getGatewayDataField('gateway_name'));
            $logger->setData('amount', $gateway->getFinalAmount());
            $logger->setData('currency', $gateway->getFinalCurrency());
            $logger->setData('ip_address', $gateway->_customerIpAddress);

            $requestDataArray = Mage::getModel('checkout/session')->get3DPostData();


            $requestData = print_r($requestDataArray, true);
            $requestData = str_replace($gateway->_ccNumber, 
                                                    substr($gateway->_ccNumber, 0, 2). '**********'.  substr($gateway->_ccNumber, -4),
                                                    $requestData);

            $logger->setData('threed_request', $requestData);
            $logger->setData('status', 1);  //Completed succesfully [1:waiting, 2:error, 3:completed]

            $logger->save();

            Mage::getSingleton('checkout/session')->setLoggerId($logger->getId());


            return Mage::getUrl('sanalpos/payment/redirect', array('_secure' => true));
        }
    }
    
    public function getConfigData($field, $storeId = null)
    {
        if($field == 'order_status' && $this->_order_status !== null) {
            return $this->_order_status;
        }
        
        if (null === $storeId) {
            $storeId = $this->getStore();
        }
        $path = 'payment/'.$this->getCode().'/'.$field;
        return Mage::getStoreConfig($path, $storeId);
    }

}

?>