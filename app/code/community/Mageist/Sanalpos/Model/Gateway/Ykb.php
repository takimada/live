<?php

class Mageist_Sanalpos_Model_Gateway_Ykb extends Mageist_Sanalpos_Model_Gateway_Abstract {
    
    public $_defaultCurrenyCode  = 'TRY';
    
    public function postProcessPaymentData() {
        
        // MM
        $this->_ccExpMonth = ($this->_ccExpMonth < 10) ? '0'.$this->_ccExpMonth : $this->_ccExpMonth;
        
        // YY
        $this->_ccExpYear = substr($this->_ccExpYear, 2, 2);
        
        // 1.00 = 100
        $this->_amount = intval(100 * $this->_amount);
        
        // if 0, send empty
        $this->_ccInstallment = intval($this->_ccInstallment) == 0 ? '' : '<installment>'.intval($this->_ccInstallment).'</installment>';
        
        // add timestamp to quote id - needs to be 24 chars
        $quoteLength = strlen($this->_quoteId);
        $quoteLength = 23 - $quoteLength;
        $this->_quoteId = substr(md5(time()), 0, $quoteLength). '_' .$this->_quoteId;
        
        
        //$this->_currenyCodeId = $this->convertCurrencyCode($this->_currenyCodeId);
        
    }
    
    public function convertCurrencyCode($code){
        $currencies = array(
            949=>'YT',
            840=>'US',
            978=>'EU'
        );  
        
        return $currencies[$code];
    }
    
    public function setPaymentTypeForGateway() {
        $paymentTypeCode = $this->getGatewayDataField('payment_method');
        if($paymentTypeCode == 0) {
            $this->_paymentType = 'sale';
        } else {
            $this->_paymentType = 'auth';
        }
    }
    
    public function get3DStoreType($storeTypeCode) {
        
        $storeType = '';
        
        switch ( $storeTypeCode ) {
            case 'no_3d'   : $storeType = 'no_3d';  break;
            case '3d'      : $storeType = '3d';     break;
            case '3d_pay'  : $storeType = '3d_pay'; break;
            default        : $storeType = 'no_3d';  break;
        }
        
        return $storeType;
    }
    
    public function prepareNon3D() {
        
        $strMerchantID = $this->_store_no;
        $strTerminalID = $this->_terminal_no;
        $strOrderID = $this->_quoteId;
        $strInstallmentCnt = $this->_ccInstallment;
        $strNumber = $this->_ccNumber;
        $strExpireDate = $this->_ccExpYear.$this->_ccExpMonth;
        $strCVV2 = $this->_ccCvv;
        $strAmount = $this->_amount; 
        $strCurrencyCode = $this->convertCurrencyCode($this->_currenyCodeId);

        $koiCode = '';

        if(Mage::getSingleton('checkout/session')->getKoiValue()) {
            Mage::log('koi katilimi var');
            $koiCode = '<koiCode>2</koiCode>';
        } else {
            Mage::log('koi katilimi yok');
        }
        
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <posnetRequest>
                    <mid>$strMerchantID</mid>
                    <tid>$strTerminalID</tid>
                    <sale>
                            <amount>$strAmount</amount>
                            <ccno>$strNumber</ccno>
                            <currencyCode>$strCurrencyCode</currencyCode>       
                            <cvc>$strCVV2</cvc>
                            <expDate>$strExpireDate</expDate>
                            <orderID>$strOrderID</orderID>
                            $strInstallmentCnt
                            $koiCode
                    </sale>
                </posnetRequest>";
        
        $this->_requestDataApi = "xmldata=".$xml;
    }
    
    public function processNon3D($result = null) {
        
        $returnArray = array(
            'result'    => 0,
            'message'   => ''
        );
                    
        $xmlNotValid = true;
        if ($result !== false) {
            $resultObject = new SimpleXMLElement($result);
            if($resultObject) {
                if(isset($resultObject->approved)) {
                    $xmlNotValid = false;
                    $strResponseValue = $resultObject->approved;
                    if ($strResponseValue == "1") {
                        $returnArray['result'] = 1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Accepted. Code: %s',$resultObject->authCode);
                    } elseif($strResponseValue == "0") { 
                        $returnCode = $resultObject->respCode;
                        $errorString = $this->getErrorMessage($returnCode);
                        $returnArray['result'] = -1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s', $returnCode, $errorString);
                    } else {
                        $returnCode = $resultObject->Transaction->Response->Code;
                        $errorString = $this->getErrorMessage($returnCode);
                        $returnArray['result'] = -2;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s', $returnCode, $errorString);
                    }
                }
            }
        }
        
        if($xmlNotValid) {
            $returnArray['result'] = -3;
            $returnArray['message'] = $this->_getHelper()->__('XML is not valid');
        }
        return $returnArray;
    }    
    
    
    
    public function getErrorMessage($status) {
    switch ( $status )
    {
       case "0003": $msg = "Banka online bağlantısında bir sorun oluştu. Sorun sistem yöneticilerine iletilmiştir. MID,TID,IP HATALI girilmiş olabilir"; break;
       case "0095": $msg = "İşlem onaylanmadı. Kart bilgilerinden (KK No, SKT, CVV) biri yada birkaçı hatalı girilmiş veya Worldcard için bankaca tanımlanmış günlük limitiniz aşılmış olabilir. Kredi kartınızla günde en fazla 3 internet alışverişi yapılabilir."; break;
       case "0100": $msg = "İşlem tamamlanamadı. Banka ile bağlantıda sorun oluştu. Bir süre sonra tekrar deneyiniz."; break;
       case "0110": $msg = "İşlem onaylanmadı. Kredi kart limitini aşmış olabilirsiniz. Bankanızı arayınız."; break;
       case "0124": $msg = "İşlem onaylanmadı. Muhtemelen bankada teknik bir çalışma olabilir. Daha sonra tekrar deneyebilir veya başka bir banka kredi kartı ile işlem yapabilirsiniz."; break;
       case "0129": $msg = "Geçersiz kredi kartı. Bankanızı arayınız."; break;
       case "0170": $msg = "Kartınız onaylanmadı. Bankanızı arayıp provizyon alınamadığını bildiriniz, veya başka kart deneyiniz."; break;
       case "0173": $msg = "Kartınız internet üzerinden alışverişe uygun görünmüyor. Bankanızı arayıp durumu kontrol ediniz veya başka bir kartla deneyiniz."; break;
       case "0213": $msg = "Kartınızın limiti yetersiz görünüyor. Bankanızı arayarak kontrol ediniz."; break;
       case "0217": $msg = "Kullanılan kredi kartı kayıp veya çalıntı olarak bildirilmiştir !! Bilgiler kaydedilmiştir."; break;
       case "0225": $msg = "Kredi kart numaranız hatalıdır. Kart bilgilerinizi kontrol edip tekrar deneyiniz."; break;
       case "0229": $msg = "Geçersiz İşlem. Taksitli işlemlerde Yapı Kredi kredi kartlarından birini kullandığınıza emin olunuz."; break;
       case "0267": $msg = "Kredi kart numaranız hatalıdır. Kart bilgilerinizi kontrol edip tekrar deneyiniz."; break;
       case "0360": $msg = "Kredi kartınız bu tip işleme izin vermiyor veya kartın kredisi yetersiz. Kartı veren bankayı arayın."; break;
       case "0363": $msg = "Kredi kart numaranız hatalıdır. Kart bilgilerinizi kontrol edip tekrar deneyiniz."; break;
       case "0400": $msg = "Yapı Kredi kredi kartları merkezinde teknik bir sorun var. Daha sonra tekrar deneyiniz."; break;
       case "0534": $msg = "Bu kartla işlem yapamazsınız."; break;
       case "0551": $msg = "Numara bir kredi kartına ait değil."; break;
       case "0876": $msg = "Kart bilgilerinden (KK No, SKT, CVV) biri yada birkaçı hatalı girilmiş veya Worldcard'lar için bankaca tanımlanmış günlük limitler aşılmış olabilir."; break;
       case "0877": $msg = "Kredi kartınızın arkasında bulunan 3 haneli CVC kodu girilmedi veya yanlış."; break;
       case "0995": $msg = "Kartı veren (issuer) banka ile iletişimde zaman aşımı oldu (bankadan zamanında yanıt alınamadı). Tekrar deneyiniz. Sorun devam ederse, kartı veren bankayı arayıp, bir sanal pos işleminde bu hatanın alındığını belirtiniz."; break;
       default:     $msg = "Bir hata oluştu (Hata no:".$status.") Tekrar deneyiniz. Sorun devam ederse lütfen bizimle temasa geçiniz."; break;
    }
    return $msg;
    }

    public function prepare3DPost() {
        //post edilecek datalari olustur

        $this->log($this->_getHelper()->__('Transaction (3D) : Started'));
        $this->getCardType();

        /*
         * Set gateway information for test mode if necessary
         */
        if ($this->isTestMode()) {

            $this->overrideCreditCardData();
            $this->overrideCredentialData();
        }

        //oncelikle, posnet'e data gönderiliyor

        $strMerchantID = $this->_store_no;
        $strTerminalID = $this->_terminal_no;
        $strOrderID = $this->_quoteId;
        $strXID = substr($this->_quoteId, -20);
        $posnetID = $this->_posnet_id;
        $strInstallmentCnt = $this->_ccInstallment;

        if($strInstallmentCnt == '') {
            $strInstallmentCnt = '<installment>00</installment>';
        }

        $strCardHolderName = $this->_ccOwner;

        $strNumber = $this->_ccNumber;
        $strExpireDate = $this->_ccExpYear.$this->_ccExpMonth;
        $strCVV2 = $this->_ccCvv;
        $strAmount = $this->_amount;
        $strCurrencyCode = $this->convertCurrencyCode($this->_currenyCodeId);

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <posnetRequest>
                    <mid>$strMerchantID</mid>
                    <tid>$strTerminalID</tid>
                    <oosRequestData>
                        <posnetid>$posnetID</posnetid>
                        <amount>$strAmount</amount>
                        <ccno>$strNumber</ccno>
                        <currencyCode>$strCurrencyCode</currencyCode>
                        <cvc>$strCVV2</cvc>
                        <expDate>$strExpireDate</expDate>
                        $strInstallmentCnt
                        <XID>$strXID</XID>
                        <cardHolderName>$strCardHolderName</cardHolderName>
                        <tranType>Sale</tranType>
                    </oosRequestData>
                </posnetRequest>";

        $this->_preRequestDataApi = "xmldata=".$xml;

        $ccCode = 'XXXXXXXXXXXX' . substr($this->_ccNumber, -4);
        $requestDataForLog = str_replace($this->_ccNumber, $ccCode, $this->_preRequestDataApi);
        $this->log('YKB Pre 3D Request: '. $requestDataForLog);

        $result = $this->sendCurlRequest($this->_gatewayApiUrl, $this->_preRequestDataApi, 'ykb');

        $this->log('YKB Pre 3D Result: '.$result);

        $xmlNotValid = true;
        if ($result !== false) {
            $resultObject = new SimpleXMLElement($result);
            if($resultObject) {
                if(isset($resultObject->approved)) {
                    $strResponseValue = $resultObject->approved;
                    if ($strResponseValue == "1") {
                        $xmlNotValid = false;
                        $oosRequestData = $resultObject->oosRequestDataResponse;

                        $strData1 = (string)$oosRequestData->data1;
                        $strData2 = (string)$oosRequestData->data2;
                        $strSign  = (string)$oosRequestData->sign;

                    }
                }
            }
        }

        if($xmlNotValid) {
            Mage::throwException('İşlem sırasında hata oluştu. Lütfen tekrar deneyiniz.');
        }

        $strOkUrl = Mage::getUrl('sanalpos/payment/response', array(
            '_secure' => true,
            'o' => $strOrderID));
        $strFailUrl = Mage::getUrl('sanalpos/payment/response', array(
            '_secure' => true,
            'o' => $strOrderID));

        $postFields = array(
            'posnetData' => $strData1,
            'posnetData2' => $strData2,
            'digest' => $strSign,
            'mid' => $strMerchantID,
            'posnetID' => $posnetID,
            'merchantReturnURL' => $strOkUrl,
        );

        $dataFields = array(
            '_formurl' => $this->_gatewayRedirectUrl
        );

        $returnArray = array('data' => $dataFields, 'post' => $postFields);
        $this->log($returnArray);
        Mage::getModel('checkout/session')->set3DPostData($returnArray);

    }

    public function prepare3DApiCall($postData) {
        //post icin xml olustur

        $this->_requestData3DApi = "xmldata=" . $xml;
    }

    public function process3D($result = null) {
        return $this->processNon3D($result);
    }

    public function checkJoker($cc) {
        $strMerchantID = $this->_store_no;
        $strTerminalID = $this->_terminal_no;
        
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <posnetRequest>
                    <mid>$strMerchantID</mid>
                    <tid>$strTerminalID</tid>
                    <koiCampaignQuery>
                            <ccno>$cc</ccno>
                    </koiCampaignQuery>
                </posnetRequest>";
        
        $data = "xmldata=".$xml;

        $result = $this->sendCurlRequest($this->_gatewayApiUrl, $data, 'ykb');

        return $result;
    }

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

        $returnArray['_requestApiXML'] = '';
        $returnArray['_requestApiXML'] = '';

        //sign kontrolu

        $merchantData = $postData['MerchantPacket'];
        $bankData = $postData['BankPacket'];
        $sign = $postData['Sign'];
        $WPAmount = $postData['Amount'];
        $key = $this->_three_d_store_key;

        if($merchantData == "" || $bankData == "" || $sign == "")
        {
            $returnArray['result'] = 2;
            $returnArray['message'] = "GECERSIZ DATA ( Merchant Data=".$merchantData." - Bank Data=".$bankData." - Sign=".$sign." )";
            return $returnArray;
        }



        $data = $merchantData.$bankData.$key;
        $hash = strtoupper(md5($data));
        if (strcmp($hash, $sign) != 0) {
            $returnArray['result'] = 2;
            $returnArray['message'] = "IMZA GECERLI DEGIL (".$hash.")";
            return $returnArray;
        }

        require_once('posnet_enc.php');

        $posnetENC = new PosnetENC();
        //Decrypt Data
        $decryptedData = $posnetENC->Decrypt($merchantData, $key);
        $posnetENC->DeInit();

        if ($decryptedData == "") {
            $returnArray['result'] = 2;
            $returnArray['message'] = $posnetENC->error;
            return $returnArray;
        }

        $strMerchantID = $this->_store_no;
        $strTerminalID = $this->_terminal_no;


        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <posnetRequest>
                    <mid>$strMerchantID</mid>
                    <tid>$strTerminalID</tid>
                    <oosTranData>
                        <bankData>$bankData</bankData>
                        <merchantData>$merchantData</merchantData>
                        <sign>$sign</sign>
                        <wpAmount>$WPAmount</wpAmount>
                    </oosTranData>
                </posnetRequest>";

        $this->_postRequestDataApi = "xmldata=".$xml;

        $this->log('YKB Pre 3D Request: '. $this->_postRequestDataApi);

        $result = $this->sendCurlRequest($this->_gatewayApiUrl, $this->_postRequestDataApi, 'ykb');

        $this->log('YKB Pre 3D Result: '.$result);

        if ($result !== false) {
            $resultObject = new SimpleXMLElement($result);
            if($resultObject) {
                if(isset($resultObject->approved)) {
                    $strResponseValue = $resultObject->approved;
                    if ($strResponseValue == "1") {
                        $oosResolveMerchantDataResponse = $resultObject->oosResolveMerchantDataResponse;

                        $returnArray['result'] = 1;
                        $returnArray['message'] = 'İşlem başarılı. XID : '. $oosResolveMerchantDataResponse->xid;
                        return $returnArray;

                    } else {
                        $returnArray['result'] = 2;
                        $returnArray['message'] = $resultObject->respText;
                        return $returnArray;
                    }
                } else {
                    $returnArray['result'] = 2;
                    $returnArray['message'] = 'İşlem sırasında hata oluştu. Lütfen tekrar deneyiniz. (1)';
                    return $returnArray;
                }
            } else {

                $returnArray['result'] = 2;
                $returnArray['message'] = 'İşlem sırasında hata oluştu. Lütfen tekrar deneyiniz. (2)';
                return $returnArray;
            }
        } else {

            $returnArray['result'] = 2;
            $returnArray['message'] = 'İşlem sırasında hata oluştu. Lütfen tekrar deneyiniz. (4)';
            return $returnArray;
        }

        $returnArray['result'] = 2;
        $returnArray['message'] = 'İşlem sırasında hata oluştu. Lütfen tekrar deneyiniz. (4)';
        return $returnArray;

    }

}
