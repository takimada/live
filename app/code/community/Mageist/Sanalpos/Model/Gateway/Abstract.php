<?php

abstract class Mageist_Sanalpos_Model_Gateway_Abstract extends Varien_Object {
    
    
    const OTHER_GATEWAY = 'other';
    
    public function _getHelper() {
        return Mage::helper('sanalpos');
    }
    
    public function log($message, $cancel = false, $debugLevel = Zend_Log::INFO) {
        if($cancel) {
            $cancelMessage  = $this->_getHelper()->__('CANCELLED: '); 
            $message        = $cancelMessage . $message;
        }
        $this->_bankModel->log($message, $debugLevel);
    }
    
    public function logToDb($transaction, $message) {
        $this->_bankModel->logToDb($transaction, $message);
        $this->log($message);
    }
    
    

    /*
     * Get the gateway information from database, and fill the variables with it
     */
    public function initialize($gatewayData, $bankModel, $origGatewayName) {
        $this->_gateway     = $gatewayData;
        $this->_code        = $gatewayData['gateway_code'];
        $this->_type        = $gatewayData['gateway_type'];
        $this->_bankModel   = $bankModel;
    }
    
    /*
     * Get the transaction method:
     *      no_3d
     *      3d
     *      3d_pay
     *      3d_full
     *      3d_half
     */
    public function getTransactionMethod() {
        $transactionMethods = array(
            0 => "no_3d",
            1 => "3d",
            2 => "3d_pay",
            3 => "3d_full",
            4 => "3d_half"
        );
        
        $isTest = $this->isTestMode();
        
        if(!$isTest)
            return $transactionMethods[$this->_gateway['three_d_store_type']];
        else
            return $transactionMethods[$this->_gateway['three_d_store_type_test']];
        
    }
    
    
    public function checkIfInstallmentActive($paymentData) {
        
        $this->_is_installment_active   = $this->getGatewayDataField('is_installment_active');
        $this->_ccInstallment           = $paymentData['ccInstallment'];
        $this->_ccGateway               = $paymentData['ccGateway'];
        
        if($this->_ccGateway == self::OTHER_GATEWAY) {
            $this->_is_installment_active = false;
        }
        
        if($this->_ccInstallment != '') {
            $this->_ccInstallment = intval($this->_ccInstallment);
            
            if($this->_ccInstallment > 0) {

                if($this->_is_installment_active != true) {
                    $this->log($this->_getHelper()->__('Installment option %s is not active for that gateway.', $this->_ccInstallment), true);
                    return null;
                }
                
                if($this->getGatewayDataField('installment_' . $this->_ccInstallment . '_value') === null) {
                    $this->log($this->_getHelper()->__('Installment value %s is not valid for that gateway.', $this->_ccInstallment), true);
                    return null;
                }
            }
        }
        
        return true;
    }
    
    
    /*
     * Get required payment data into array
     */
    public function preparePaymentData() {
        
        $this->log($this->_getHelper()->__('Payment data: Preparing'));
        
        $quote = Mage::getSingleton('checkout/session')->getQuote();

        $shippingAddresses = $quote->getShippingAddress();

        $quoteData = array(
            'id'            => $quote->getId(),
            'remoteIp'      => $quote->getRemoteIp(),
            'customerEmail' => $quote->getCustomer()->getEmail(),
            'remoteIp'      => $quote->getRemoteIp(),
            'shippingPrice' => $shippingAddresses['shipping_amount'],
            'baseGrandTotal'=> Mage::helper('core')->currency($quote->getBaseGrandTotal(), false, false)
        );
        
        $paymentData = Mage::getSingleton('checkout/session')->getPaymentData();
        
        //See below
        $this->setCredentialData();
        
        //See below
        $this->setCreditCardData($quoteData, $paymentData);
        
        //See below
        $this->setPriceInformation($quoteData);
        
        //See below
        $this->setCurrencies();
        
        /*
         * Abstract method. Process payment data to be used in
         * current gateway. GATEWAY DEPENDENT
         */
        $this->postProcessPaymentData();
        
        $this->log($this->_getHelper()->__('Payment data: Prepared'));
        return $this;
    }
    
    /*
     * Get the card entered information
     */
    public function setCreditCardData($quoteData, $paymentData) {
        
        $this->_customerIpAddress       = $quoteData['remoteIp'];
        $this->_customerEmailAddress    = $quoteData['customerEmail'];
        $this->_quoteId                 = $quoteData['id'];
        
        
        $this->_ccOwner                 = $paymentData['ccOwner'];
        $this->_ccNumber                = $paymentData['ccNumber'];
        $this->_ccExpMonth              = $paymentData['ccExpMonth'];
        $this->_ccExpYear               = $paymentData['ccExpYear'];
        $this->_ccCvv                   = $paymentData['ccCvv'];
        $this->_ccInstallment           = $paymentData['ccInstallment'];
        $this->_ccGateway               = $paymentData['ccGateway'];
        
        if($this->_ccGateway == self::OTHER_GATEWAY) {
            $this->_is_installment_active = false;
        }
        
    }
    
    /*
     * Set Price related information
     */
    public function setPriceInformation($quoteData) {
                
        /*
         * Get price information
         */
        $basePrice              = $quoteData['baseGrandTotal'];
        $shippingPrice          = $quoteData['shippingPrice'];
        
        /*
         * Calculate new price with installment rate
         */
        //$isShippingIncluded     = Mage::getStoreConfig("payment/sanalpos/include_shipment_to_installment");
        $isShippingIncluded     = true;
        
        if($isShippingIncluded == false) {
            $basePrice -= $shippingPrice;
        } else {
            $shippingPrice = 0;
        }
        
        
        //TODO: not sure if all cases are covered!!
        $installmentPrice = 0;        
        if($this->_ccInstallment != '') {
            $this->_ccInstallment = intval($this->_ccInstallment);
            if($this->_ccGateway == self::OTHER_GATEWAY) {
                $installmentValue = Mage::getStoreConfig("payment/sanalpos/single_payment_commission");
                $this->_ccInstallment = 0;
            } elseif($this->getGatewayDataField('installment_' . $this->_ccInstallment . '_value') !== null) {
                $installmentValue = $this->getGatewayDataField('installment_' . $this->_ccInstallment . '_value');
            } elseif($this->_ccInstallment == 0) {
                $installmentValue = 0;
            }
            $installmentPrice = (($basePrice * $installmentValue) / 100);
            $basePrice = $basePrice + $installmentPrice;
        } else {
            $this->_ccInstallment = 0;
        }
        
        $this->_amount = $basePrice + $shippingPrice;
        $this->_original_amount = $basePrice + $shippingPrice;
        
        return true;
    }
    
    /*
     * Currency conversion if necessary
     */
    public function setCurrencies() {
        $currentCurrencyCode = Mage::app()->getStore()->getCurrentCurrencyCode();
        $prefferedCurrency =  $this->getGatewayDataField('currency');

        $prefferedCurrencyCode = Mage::getModel('sanalpos/source_settings')->getCurrencySign($prefferedCurrency);
        if($prefferedCurrencyCode === null) {
            $prefferedCurrencyCode = $this->_defaultCurrenyCode;
        }
        
        $this->_currenyCode = $prefferedCurrencyCode;
        $this->_currenyCodeId = Mage::getModel('sanalpos/source_settings')->getCurrencyCodeFromSign($prefferedCurrencyCode);
        if($currentCurrencyCode != $prefferedCurrencyCode) {
            $this->_amount          = Mage::helper('directory')->currencyConvert($this->_amount, $currentCurrencyCode, $prefferedCurrencyCode);
            $this->_original_amount = Mage::helper('directory')->currencyConvert($this->_original_amount, $currentCurrencyCode, $prefferedCurrencyCode);
        }
    }
    
    /*
     * 0: Auth
     * 1: Preauth
     */
    abstract public function setPaymentTypeForGateway();
    
    
    /*
     * Process payment data according to the selected gateway
     */
    abstract public function postProcessPaymentData();
    
    /*
     * Set credential data necessary for gateway
     */
    public function setCredentialData(){
        $this->_mode = 'PROD';
        $this->_est_mode = 'P';
        $this->_username            = $this->getGatewayDataField('username');
        $this->_api_username        = $this->getGatewayDataField('api_username');
        $this->_api_password        = $this->getGatewayDataField('api_password');
        $this->_store_no            = $this->getGatewayDataField('store_no');
        $this->_posnet_id           = $this->getGatewayDataField('posnet_id');
        $this->_security_code       = $this->getGatewayDataField('security_code');
        $this->_terminal_no         = $this->getGatewayDataField('terminal_no');
        $this->_three_d_store_key   = $this->getGatewayDataField('three_d_store_key');
        $this->_three_d_store_type  = $this->getGatewayDataField('three_d_store_type');
        $this->_store_type          = $this->get3DStoreType($this->_three_d_store_type);
        $this->setPaymentTypeForGateway();
        
        
        $this->_gatewayApiUrl               = $this->getGatewayDataField('gateway_api_url');
        $this->_gatewayApiUrlTest           = $this->getGatewayDataField('gateway_api_url_test');
        $this->_gatewayRedirectUrl          = $this->getGatewayDataField('gateway_redirect_url');
        $this->_gatewayRedirectUrlTest      = $this->getGatewayDataField('gateway_redirect_url_test');
    }
    
    /* Non3D Related Functions */
    
        
    /*
     * Get the result values from Non-3D Transaction
     */
    public function getNon3DResult() {
        $this->log($this->_getHelper()->__('Transaction (Non3D) : Started'));
        $returnArray = array(
            'result'    => 0,
            'message'   => ''
        );
                
        /*
         * Set gateway information for test mode if necessary
         */
        if($this->isTestMode()) {   
            
            $this->overrideCreditCardData();
            $this->overrideCredentialData();
            
        }
        
        $this->prepareNon3D();
        
        $returnArray['_requestXML'] = $this->_requestDataApi;
        $returnArray['_requestXML'] = str_replace($this->_ccNumber, 
                                                    substr($this->_ccNumber, 0, 2). '**********'.  substr($this->_ccNumber, -4),
                                                    $returnArray['_requestXML']);
        
        $returnArray['_requestXML'] = str_replace('>'.$this->_ccCvv.'<', 
                                                    '>'.substr($this->_ccCvv, 0, 1). '**<',
                                                    $returnArray['_requestXML']);
        
        $this->log($this->_getHelper()->__('Transaction (Non3D) : XML Prepared'));
        $this->log($returnArray['_requestXML']);
        
        $result = $this->sendCurlRequest($this->_gatewayApiUrl, $this->_requestDataApi, $this->_type);
        if($result === false) {   
            $returnArray['result'] = -1;
            $returnArray['message'] = $this->_getHelper()->__('Could not connect to gateway.');
            $this->log($returnArray['message'], true);
        } else { 
            $returnArray['_resultXML'] = $result;
            
            $this->log($this->_getHelper()->__('Transaction (Non3D) : Result XML arrived'));
            $this->log($returnArray['_resultXML']);

            $finalResult = $this->processNon3D($result);
            if($finalResult['result'] < 1) {
                $returnArray['result'] = -2;
                $returnArray['message'] = $this->_getHelper()->__('Credit card declined. Please try again.');
                $this->log($finalResult['message'], true);
            } else {
                $returnArray['result'] = 1;
                $returnArray['message'] = $this->_getHelper()->__('Transaction (Non3D) : Success');
                $this->log($finalResult['message']);
                $this->log($returnArray['message']);
            }
        }
        
        $this->log($this->_getHelper()->__('Transaction (Non3D) : Ended'));
        return $returnArray;
    }
    
    
    /*
     * Prepare for Non-3D payment.
     * Get the required information from stored variables
     * Assign these variables create api XML 
     */
    abstract public function prepareNon3D();
    
    /*
     * Process the Non-3D payment
     * Assign variables for return values
     */
    abstract public function processNon3D($result = null);
    
    
    /*
     * Process after the Non-3D payment
     * Set some variables, order status, and send notification email
     */
    public function postProcessNon3D($payment) {
        $this->log($this->_getHelper()->__('Transaction (Non3D) : Finalizing'));
        
        $stateMessage = $this->_getHelper()->__('Order with total %s %s successfully processed with order id: %s', $this->_original_amount, $this->_currenyCode, $this->_quoteId);
        
        $notificationEmail = $this->getGatewayDataField('notification_email');
        
        $order = $payment->getOrder();
        
        //TODO: Can the order state change ?
        $order->setState($this->getFinalState(), true, $stateMessage);
        //$order->sendNewOrderEmail();
        $order->setEmailSent(true);
        
        $order->save();

        $session = Mage::getSingleton('checkout/session');
        $session->unsQuoteId();
        $session->unsLastRealOrderId();

        if($notificationEmail != '') {
            //TODO: 
        }
        $this->log($this->_getHelper()->__('Transaction (Non3D) : Finalized'));
    }
    
    public function postProcess3D($order, $state, $additionalInformation) {
        $this->log($this->_getHelper()->__('Transaction (3D) : Finalizing'));
        $stateMessage = $this->_getHelper()->__('Order with total %s %s successfully processed with order id: %s', $additionalInformation['finalPrice'], $additionalInformation['finalCurrency'], $this->_quoteId);
        
        $notificationEmail = $this->getGatewayDataField('notification_email');
        
        //TOTAL PAID FIX!!!! - START
        if ($order->getTotalPaid() == 0) {
            $_totalData =$order->getData();
            $_grand = $_totalData['grand_total'];
            $order->setTotalPaid($_grand);
        }
        //TOTAL PAID FIX!!!! - END
        
        //TODO: Can the order state change ?
        $order->setState($state, true, $stateMessage);
        $order->sendNewOrderEmail();
        $order->setEmailSent(true);

        $order->save();

        $session = Mage::getSingleton('checkout/session');
        $session->unsQuoteId();
        $session->unsLastRealOrderId();

        if($notificationEmail != '') {
            //TODO: 
        }
        $this->log($this->_getHelper()->__('Transaction (3D) : Finalized'));
    }
    
    
    /* Non3D Related Functions */
    
    
    /*
     * Prepare for 3D payment types (all except Non-3D).
     * Get the required information from stored variables
     * Assign these variables to prepare form to be posted
     */
    abstract public function prepare3DPost();
    

    public function get3DResult($postData) {
        $this->log($this->_getHelper()->__('Transaction (3D) : Returned'));
        $this->log($postData);
        
        $this->setCredentialData();

        /*
         * Set gateway information for test mode if necessary
         */
        if ($this->isTestMode()) {

            $this->overrideCreditCardData();
            $this->overrideCredentialData();
        }
        

        $returnArray = array(
            'result'    => 0,
            'message'   => ''
        );
        
        if($this->_type == 'est') {
            $strMDStatus = $postData["mdStatus"];
            $response    = @$postData['Response'];
            $errMsg      = @$postData['ErrMsg'];
        } elseif($this->_type == 'grt') {
            $strMDStatus = $postData["mdstatus"]; 
            $response    = @$postData['response']; 
            $errMsg      = @$postData['errmsg'];  
        }
        
        if ($strMDStatus == "1" || $strMDStatus == "2" || $strMDStatus == "3" || $strMDStatus == "4") {
            $this->log($this->_getHelper()->__('MD Status Successful : %s', $strMDStatus));
            if ($this->checkHashData($postData)) {                
                if ($this->getTransactionMethod() != '3d') {
                    if($response == 'Approved') {
                        $returnArray['result'] = 1;
                        $returnArray['message'] = $this->_getHelper()->__('Successful.');
                        $this->log($this->_getHelper()->__('Transaction (3D) : Successful %s transaction',$this->getTransactionMethod()));
                    } else {
                        $returnArray['result'] = -2;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card declined.');
                        $this->log($this->_getHelper()->__('Transaction (3D) : Card Declined. Error message: %s',$errMsg));
                    }
                } else {
                    $this->prepare3DApiCall($postData);

                    $returnArray['_requestApiXML'] = $this->_requestData3DApi;
                    $this->log($this->_getHelper()->__('Transaction (3D) : XML Prepared'));

                    $this->log($returnArray['_requestApiXML']);

                    $result = $this->sendCurlRequest($this->_gatewayApiUrl, $this->_requestData3DApi);
                    
                    if ($result === false) {
                        $returnArray['result'] = -1;
                        $returnArray['message'] = $this->_getHelper()->__('Could not connect to gateway.');
                        $this->log($returnArray['message'], true);
                        
                    } else {
                        $returnArray['_resultApiXML'] = $result;
                        $this->log($this->_getHelper()->__('Transaction (3D) : Result XML arrived'));
                        $this->log($returnArray['_resultApiXML']);
                        
                        $finalResult = $this->process3D($result);

                        if($finalResult['result'] < 1) {
                            $returnArray['result'] = -3;
                            $returnArray['message'] = 'Credit card declined. Please try again.';
                            $this->log($finalResult['message'], true);
                        } else {
                            $returnArray['result'] = 1;
                            $returnArray['message'] = $this->_getHelper()->__('Transaction (3D) : Success');
                            $this->log($finalResult['message']);
                            $this->log($returnArray['message']);
                        }
                    }
                }
                
            } else {
                $returnArray['result'] = -4;
                $returnArray['message'] = $this->_getHelper()->__('Hash data is not valid.');
                $this->log($this->_getHelper()->__('Transaction (3D) : %s',$returnArray['message']));
            }
        } else {
            $returnArray['result'] = -2;
            $returnArray['message'] = $this->_getHelper()->__('MD Status Error : %s', $strMDStatus);
            $this->log($this->_getHelper()->__('Transaction (3D) : %s',$returnArray['message']));
        }
        
        return $returnArray;
        
    }
    
    
    
    /*
     * Prepare for 3D payment api call.
     * Get the required information from $postData
     * Assign these variables create api XML 
     */
    abstract public function prepare3DApiCall($postData);
    
    /*
     * Process the 3D payment Api Call
     * Assign variables for return values
     */
    abstract public function process3D($result = null);
    
    
    /* Helper functions */
    
    
    public function getQuoteId() {
        return $this->_quoteId;
    }
    public function setQuoteId($quoteId) {
        $this->_quoteId = $quoteId;
    }
    
    public function getFinalState() {
        return $this->getGatewayDataField('successful_order_status');
    }
    
    public function getFinalCurrency(){
        return $this->_currenyCode;
    }
    
    public function getFinalAmount(){
        return $this->_original_amount;
    }
    
    /*
     * Get Gateway Type
     */
    public function getType() {
        return $this->_type;
    }
    
    /*
     * Get Gateway Name
     */
    public function getCode() {
        return $this->_code;
    }
    
    /*
     * Get Gateway
     */
    public function getGateway() {
        return $this->_gateway;
    }
    
    /*
     * Check if gateway is in test mode or not
     */
    public function isTestMode() {
        return ($this->getGatewayDataField('test_mode') == 1) ? true : false;
    }
    
    
    /*
     * Check if gateway needs redirection
     */
    public function getIsRedirectionNeeded() {
        return ($this->_gateway['three_d_store_type'] == 0 ? false : true);
    }
    
    /*
     * Get fields from gateway data
     */
    public function getGatewayDataField($field) {
        if(isset($this->_gateway[$field])) return trim($this->_gateway[$field]);
        return null;
    }
    
    /*
     * Send curl request
     */
    public function sendCurlRequest($host, $data, $gatewayType = NULL) {
        
        
        
        $ch=curl_init();
        
        if($gatewayType == 'vkf') {
            $host = $host . '?' . $data;
        } else {
            curl_setopt($ch, CURLOPT_POST, 1) ;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        
        $this->log('Curl request to:'.$host);
        
        curl_setopt($ch, CURLOPT_URL, $host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);

        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        //curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:1500');

        $result = curl_exec($ch);

        if (curl_errno($ch))
        {
           $this->log('Curl error.' . curl_error($ch));
           curl_close($ch);
           unset($ch);
           return false;
        }
        curl_close($ch);
        unset($ch);
        
        $this->log('Curl request completed.');
        
        return $result;
    }
    

    /* Override functions */
    
    
    /*
     * if user didn't enter any ccNumber (in test mode, validation is disabled)
     * then check if we have any values on database.
     * If they are also empty, check the defaul values, and set them
     * 
     */
    public function overrideCreditCardData() {
        if($this->_ccNumber == '') {
            $this->_ccNumber        = $this->getGatewayDataField('cc_number_test');
            $this->_ccExpMonth      = $this->getGatewayDataField('cc_exp_month_test');
            $this->_ccExpYear       = $this->getGatewayDataField('cc_exp_year_test');
            $this->_ccCvv           = $this->getGatewayDataField('cc_cvv_test');
        }
    }
    
    
    /*
     * Override credential data necessary for gateway with test values
     */
    public function overrideCredentialData(){
        $this->_mode = 'TEST';
        $this->_est_mode = 'T';
        $this->_username            = $this->getGatewayDataField('username_test');
        $this->_api_username        = $this->getGatewayDataField('api_username_test');
        $this->_api_password        = $this->getGatewayDataField('api_password_test');
        $this->_store_no            = $this->getGatewayDataField('store_no_test');
        $this->_terminal_no         = $this->getGatewayDataField('terminal_no_test');
        $this->_posnet_id           = $this->getGatewayDataField('posnet_id_test');
        $this->_security_code       = $this->getGatewayDataField('security_code_test');
        $this->_three_d_store_key   = $this->getGatewayDataField('three_d_store_key_test');
        $this->_three_d_store_type  = $this->getGatewayDataField('three_d_store_type_test');
        $this->_store_type          = $this->get3DStoreType($this->_three_d_store_type);
        
        $this->_gatewayApiUrl       = $this->_gatewayApiUrlTest;
        $this->_gatewayRedirectUrl  = $this->_gatewayRedirectUrlTest;
    }
    
    public function getMdStatusText($strMDStatus) {
        $mdStatus = '';
        if ($strMDStatus == 1) {
            $mdStatus = "Tam Doğrulama";
        } elseif ($strMDStatus == 2) {
            $mdStatus = "Kart Sahibi veya bankası sisteme kayıtlı değil";
        } elseif ($strMDStatus == 3) {
            $mdStatus = "Kartın bankası sisteme kayıtlı değil";
        } elseif ($strMDStatus == 4) {
            $mdStatus = "Doğrulama denemesi, kart sahibi sisteme daha sonra kayıt olmayı seçmiş";
        } elseif ($strMDStatus == 5) {
            $mdStatus = "Doğrulama yapılamıyor";
        } elseif ($strMDStatus == 7) {
            $mdStatus = "Sistem Hatası";
        } elseif ($strMDStatus == 8) {
            $mdStatus = "Bilinmeyen Kart No";
        } elseif ($strMDStatus == 0) {
            $mdStatus = "Doğrulama Başarısız, 3-D Secure imzası geçersiz.";
        }
        return $mdStatus;
    }
    
}

?>
