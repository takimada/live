<?php

class Mageist_Sanalpos_Model_Gateway_Grt extends Mageist_Sanalpos_Model_Gateway_Abstract {

    public $_defaultCurrenyCode = 'TRY';

    public function postProcessPaymentData() {

        // MM
        $this->_ccExpMonth = ($this->_ccExpMonth < 10) ? '0' . $this->_ccExpMonth : $this->_ccExpMonth;

        // YY
        $this->_ccExpYear = substr($this->_ccExpYear, 2, 2);

        // 1.00 = 100
        $this->_amount = intval(100 * $this->_amount);

        // if 0, send empty
        $this->_ccInstallment = intval($this->_ccInstallment) == 0 ? '' : intval($this->_ccInstallment);

        // add timestamp to quote id
        $this->_quoteId = substr(md5(time()), 0, 10) . '_' . $this->_quoteId;
    }

    public function setPaymentTypeForGateway() {
        $paymentTypeCode = $this->getGatewayDataField('payment_method');
        if ($paymentTypeCode == 0) {
            $this->_paymentType = 'sales';
        } else {
            $this->_paymentType = 'preauth';
        }
    }

    public function get3DStoreType($storeTypeCode) {
        $storeType = '';

        switch ($storeTypeCode) {
            case 0 : $storeType = 'no_3d';
                break;
            case 1 : $storeType = '3d';
                break;
            case 2 : $storeType = '3d_pay';
                break;
            case 3 : $storeType = '3d_full';
                break;
            case 4 : $storeType = '3d_half';
                break;
            default : $storeType = 'no_3d';
                break;
        }

        return $storeType;
    }

    public function prepareNon3D() {

        $strMode = $this->_mode;
        $strVersion = "v0.01";
        $strTerminalID = $this->_terminal_no;
        $strTerminalID_ = sprintf("%09s", $this->_terminal_no);
        $strProvUserID = $this->_api_username;
        $strProvisionPassword = $this->_api_password;
        $strUserID = $this->_username;
        $strMerchantID = $this->_store_no;

        $strIPAddress = $this->_customerIpAddress;
        $strEmailAddress = $this->_customerEmailAddress;
        $strOrderID = $this->_quoteId;
        $strInstallmentCnt = $this->_ccInstallment;
        $strOwner = $this->_ccOwner;
        $strNumber = $this->_ccNumber;
        $strExpireDate = $this->_ccExpMonth . $this->_ccExpYear;
        $strCVV2 = $this->_ccCvv;
        $strAmount = $this->_amount;
        $strType = $this->_paymentType;
        $strCurrencyCode = $this->_currenyCodeId;
        $strCardholderPresentCode = "0";
        $strMotoInd = "N";

        $SecurityData = strtoupper(sha1($strProvisionPassword . $strTerminalID_));
        $HashData = strtoupper(sha1($strOrderID . $strTerminalID . $strNumber . $strAmount . $SecurityData));
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <GVPSRequest>
                    <Mode>$strMode</Mode>
                    <Version>$strVersion</Version>
                    <Terminal>
                        <ProvUserID>$strProvUserID</ProvUserID>
                        <HashData>$HashData</HashData>
                        <UserID>$strUserID</UserID>
                        <ID>$strTerminalID</ID>
                        <MerchantID>$strMerchantID</MerchantID>
                    </Terminal>
                    <Customer>
                        <IPAddress>$strIPAddress</IPAddress>
                        <EmailAddress>$strEmailAddress</EmailAddress>
                    </Customer>
                    <Card>
                        <Number>$strNumber</Number>
                        <ExpireDate>$strExpireDate</ExpireDate>
                        <CVV2>$strCVV2</CVV2>
                    </Card>
                    <Order>
                        <OrderID>$strOrderID</OrderID>
                        <GroupID></GroupID>
                        <AddressList>
                            <Address>
                                <Type>S</Type>
                                <Name></Name>
                                <LastName></LastName>
                                <Company></Company>
                                <Text></Text>
                                <District></District>
                                <City></City>
                                <PostalCode></PostalCode>
                                <Country></Country>
                                <PhoneNumber></PhoneNumber>
                            </Address>
                        </AddressList>
                    </Order>
                    <Transaction>
                        <Type>$strType</Type>
                        <InstallmentCnt>$strInstallmentCnt</InstallmentCnt>
                        <Amount>$strAmount</Amount>
                        <CurrencyCode>$strCurrencyCode</CurrencyCode>
                        <CardholderPresentCode>$strCardholderPresentCode</CardholderPresentCode>
                        <MotoInd>$strMotoInd</MotoInd>
                        <Description></Description>
                        <OriginalRetrefNum></OriginalRetrefNum>
                    </Transaction>
                </GVPSRequest>";

        $this->_requestDataApi = "data=" . $xml;
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
                if(!isset($resultObject->Error)) {
                    $xmlNotValid = false;
                    $strResponseValue = $resultObject->Transaction->Response->Message;
                    if ($strResponseValue == "Approved") {
                        $returnArray['result'] = 1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Accepted. Code: %s',$resultObject->Transaction->AuthCode);
                    } elseif ($strResponseValue == "Declined") {
                        $returnCode = $resultObject->Transaction->Response->Code;
                        $errorString = $this->getErrorMessage($returnCode);
                        $returnArray['result'] = -1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s , ErrorMessage: %s , SysErrorMessage: %s ',
                                $returnCode, $errorString, $resultObject->Transaction->Response->ErrorMsg, $resultObject->Transaction->Response->SysErrMsg);
                       
                    } else {
                        $returnCode = $resultObject->Transaction->Response->Code;
                        $errorString = $this->getErrorMessage($returnCode);
                        $returnArray['result'] = -2;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s , ErrorMessage: %s , SysErrorMessage: %s ',
                                $returnCode, $errorString, $resultObject->Transaction->Response->ErrorMsg, $resultObject->Transaction->Response->SysErrMsg);
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
        switch ($status) {
            case "01" : $msg = "Kredi kartınız için bankanız provizyon talep etmektedir. İşlem sonuçlanmamıştır.";
                break;
            case "02" : $msg = "Kredi kartınız için bankanız provizyon talep etmektedir. İşlem sonuçlanmamıştır.";
                break;
            case "04" : $msg = "Bu kredi kartı ile alışveriş yapamazsınız. Başka bir kartla tekrar deneyiniz.";
                break;
            case "05" : $msg = "İşlem onaylanmadı. Kredi kartınız ile işlem limitini aşmış olabilirsiniz. Bankanızı arayınız.";
                break;
            case "09" : $msg = "Kredi kartınız yenilenmiştir. Yenilenmiş kartınız ile tekrar deneyiniz.";
                break;
            case "10" : $msg = "İşlem onaylanmadı. Başka bir kredi kartı ile işlem yapmayı deneyiniz.";
                break;
            case "14" : $msg = "Kredi kart numaranız hatalıdır. Kart bilgilerinizi kontrol edip tekrar deneyiniz.";
                break;
            case "16" : $msg = "Kredi kartınızın bakiyesi yetersiz. Başka bir kredi kartı ile tekrar deneyiniz.";
                break;
            case "30" : $msg = "Bankanıza ulaşılamadı. Tekrar denemenizi tavsiye ediyoruz.";
                break;
            case "36" : $msg = "Kredi kartınız kayıp veya çalıntı olarak bildirilmiştir.";
                break;
            case "41" : $msg = "Kredi kartınız kayıp veya çalıntı olarak bildirilmiştir.";
                break;
            case "43" : $msg = "Kredi kartınız kayıp veya çalıntı olarak bildirilmiştir.";
                break;
            case "51" : $msg = "Kredi kartınızın bakiyesi yetersiz. Başka bir kredi kartı ile tekrar deneyiniz.";
                break;
            case "54" : $msg = "İşlem onaylanmadı. Kartınızı kontrol edip tekrar deneyiniz.";
                break;
            case "57" : $msg = "İşlem onaylanmadı. Başka bir kredi kartı ile işlem yapmayı deneyiniz.";
                break;
            case "58" : $msg = "Yetkisiz bir işlem yapıldı. Örn: Kredi kartınızın ait olduğu banka dışında bir bankadan taksitlendirme yapıyor olabilirsiniz. Başka bir kredi kartı ile işlem yapmayı deneyiniz.";
                break;
            case "62" : $msg = "İşlem onaylanmadı. Başka bir kredi kartı ile işlem yapmayı deneyiniz.";
                break;
            case "65" : $msg = "Kredi kartınızın günlük işlem limiti dolmuştur. Başka bir kredi kartı ile deneyiniz.";
                break;
            case "77" : $msg = "İşlem onaylanmadı. Başka bir kredi kartı ile işlem yapmayı deneyiniz.";
                break;
            case "82" : $msg = "İşlem onaylanmadı. Kart bilgilerinizi kontrol edip tekrar deneyiniz.";
                break;
            case "91" : $msg = "Bankanıza ulaşılamıyor. Başka bir kredi kartı ile tekrar deneyiniz.";
                break;
            case "99" : $msg = "İşlem onaylanmadı. Kart bilgilerinizi kontrol edip tekrar deneyiniz.";
                break;
            default : $msg = "Lütfen bilgilerinizi kontrol ediniz..";
                break;
        }
        return $msg;
    }

    public function prepare3DPost() {
        $this->log($this->_getHelper()->__('Transaction (3D) : Started'));
        /*
         * Set gateway information for test mode if necessary
         */
        if ($this->isTestMode()) {

            $this->overrideCreditCardData();
            $this->overrideCredentialData();
        }

        $storeType = strtoupper($this->_store_type);

        $strMode = $this->_mode;
        $strApiVersion = "v0.01";
        $strTerminalProvUserID = $this->_api_username;
        $strType = $this->_paymentType;
        $strAmount = $this->_amount;
        $strCurrencyCode = $this->_currenyCodeId;
        $strInstallmentCount = $this->_ccInstallment;
        $strTerminalUserID = $this->_username;
        $strOrderID = $this->_quoteId;
        $strCustomeripaddress = $this->_customerIpAddress;
        $strcustomeremailaddress = $this->_customerEmailAddress;
        $strTerminalID = $this->_terminal_no;
        $strTerminalID_ = sprintf("%09s", $this->_terminal_no); //Başına 0 eklenerek 9 digite tamamlanmalıdır.
        $strTerminalMerchantID = $this->_store_no; //Üye İşyeri Numarası
        $strStoreKey = $this->_three_d_store_key; //3D Secure şifreniz
        $strProvisionPassword = $this->_api_password; //TerminalProvUserID şifresi
        $strSuccessURL = Mage::getUrl('sanalpos/payment/response', array(
                    '_secure' => true,
                    'o' => $strOrderID));
        $strErrorURL = Mage::getUrl('sanalpos/payment/response', array(
                    '_secure' => true,
                    'o' => $strOrderID));
        $SecurityData = strtoupper(sha1($strProvisionPassword . $strTerminalID_));
        $HashData = strtoupper(sha1($strTerminalID . $strOrderID . $strAmount . $strSuccessURL . $strErrorURL . $strType . $strInstallmentCount . $strStoreKey . $SecurityData));
        $HashData = strtoupper(sha1($strTerminalID.$strOrderID.$strAmount.$strSuccessURL.$strErrorURL.$strType.$strInstallmentCount.$strStoreKey.$SecurityData));



        $postFields = array(
            'cardnumber' => $this->_ccNumber,
            'cardcvv2' => $this->_ccCvv,
            'cardexpiredateyear' => $this->_ccExpYear,
            'cardexpiredatemonth' => $this->_ccExpMonth,
            'secure3dsecuritylevel' => $storeType,
            'mode' => $strMode,
            'apiversion' => $strApiVersion,
            'terminalprovuserid' => $strTerminalProvUserID,
            'terminaluserid' => $strTerminalUserID,
            'terminalmerchantid' => $strTerminalMerchantID,
            'txntype' => $strType,
            'txnamount' => $strAmount,
            'txncurrencycode' => $strCurrencyCode,
            'txninstallmentcount' => $strInstallmentCount,
            'orderid' => $strOrderID,
            'terminalid' => $strTerminalID,
            'successurl' => $strSuccessURL,
            'errorurl' => $strErrorURL,
            'customeremailaddress' => $strcustomeremailaddress,
            'customeripaddress' => $strCustomeripaddress,
            'secure3dhash' => $HashData
        );

        $dataFields = array(
            '_formurl' => $this->_gatewayRedirectUrl
        );
        
        $returnArray = array('data' => $dataFields, 'post' => $postFields);
        $this->log($returnArray);
        Mage::getModel('checkout/session')->set3DPostData($returnArray);
    }

    public function checkHashData($result) {
        $isValidHash = false;
        $storekey = $this->_three_d_store_key;

        $responseHashparams = $result['hashparams'];
        $responseHash = $result['hash'];


        if ($responseHashparams !== NULL && $responseHashparams !== "") {
            $digestData = "";
            $paramList = explode(":", $responseHashparams);
            foreach ($paramList as $param) {
                if($param != '') {
                    $value = $result[strtolower($param)];
                    if ($value == null) {
                        $value = "";
                    }
                    $digestData .= $value;
                }
            }
            $digestData .= $storekey;

            $hashCalculated = base64_encode(pack('H*', sha1($digestData)));

            if ($responseHash == $hashCalculated) {
                $isValidHash = true;
            }
        }
        return $isValidHash;
    }

    public function prepare3DApiCall($postData) {


        $strProvisionPassword = $this->_api_password; //Terminal UserID şifresi

        $strMode = $postData['mode'];
        $strVersion = $postData['apiversion'];
        $strTerminalID = $postData['clientid'];
        $strTerminalID_ = "0" . $postData['clientid'];
        $strProvUserID = $postData['terminalprovuserid'];
        $strUserID = $postData['terminaluserid'];
        $strMerchantID = $postData['terminalmerchantid'];
        $strIPAddress = $postData['customeripaddress'];
        $strEmailAddress = $postData['customeremailaddress'];
        $strOrderID = $postData['orderid'];
        $strAmount = $postData['txnamount'];
        $strCurrencyCode = $postData['txncurrencycode'];
        $strInstallmentCount = $postData['txninstallmentcount'];
        $strCardholderPresentCode = "13"; //3D Model işlemde bu değer 13 olmalı
        $strType = $postData['txntype'];
        $strMotoInd = "N";
        $strAuthenticationCode = $postData['cavv'];
        $strSecurityLevel = urlencode($postData['eci']);
        $strTxnID = urlencode($postData['xid']);
        $strMD = urlencode($postData['md']);
        $SecurityData = strtoupper(sha1($strProvisionPassword . $strTerminalID_));
        $HashData = strtoupper(sha1($strOrderID . $strTerminalID . $strAmount . $SecurityData)); //Daha kısıtlı bilgileri HASH ediyoruz.

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <GVPSRequest>
                    <Mode>$strMode</Mode>
                    <Version>$strVersion</Version>
                    <ChannelCode></ChannelCode>
                    <Terminal>
                        <ProvUserID>$strProvUserID</ProvUserID>
                        <HashData>$HashData</HashData>
                        <UserID>$strUserID</UserID>
                        <ID>$strTerminalID</ID>
                        <MerchantID>$strMerchantID</MerchantID>
                    </Terminal>
                    <Customer>
                        <IPAddress>$strIPAddress</IPAddress>
                        <EmailAddress>$strEmailAddress</EmailAddress>
                    </Customer>
                    <Card>
                        <Number></Number>
                        <ExpireDate></ExpireDate>
                        <CVV2></CVV2>
                    </Card>
                    <Order>
                        <OrderID>$strOrderID</OrderID>
                        <GroupID></GroupID>
                        <AddressList><Address>
                        <Type>B</Type>
                        <Name></Name>
                        <LastName></LastName>
                        <Company></Company>
                        <Text></Text>
                        <District></District>
                        <City></City>
                        <PostalCode></PostalCode>
                        <Country></Country>
                        <PhoneNumber></PhoneNumber>
                        </Address></AddressList>
                    </Order>
                    <Transaction>
                        <Type>$strType</Type>
                        <InstallmentCnt>$strInstallmentCount</InstallmentCnt>
                        <Amount>$strAmount</Amount>
                        <CurrencyCode>$strCurrencyCode</CurrencyCode>
                        <CardholderPresentCode>$strCardholderPresentCode</CardholderPresentCode>
                        <MotoInd>$strMotoInd</MotoInd>
                        <Secure3D>
                            <AuthenticationCode>$strAuthenticationCode</AuthenticationCode>
                            <SecurityLevel>$strSecurityLevel</SecurityLevel>
                            <TxnID>$strTxnID</TxnID>
                            <Md>$strMD</Md>
                        </Secure3D>
                    </Transaction>
            </GVPSRequest>";

        $this->_requestData3DApi = "data=" . $xml;
    }

    public function process3D($result = null) {
//        if ($result !== false) {
//            $resultObject = new SimpleXMLElement($result);
//            $strResponseValue = $resultObject->Transaction->Response->Message;
//
//            if ($strResponseValue == "Approved") {
//                Mage::log('Credit card Accepted. Code: ' . $resultObject->Transaction->AuthCode, Zend_Log::ERR);
//                return true;
//            } elseif ($strResponseValue == "Declined") {
//                $returnCode = $resultObject->Transaction->Response->Code;
//                $errorString = $this->getErrorMessage($returnCode);
//                Mage::log('Credit card Declined. Code: ' . $returnCode . ', ErrorText: ' . $errorString
//                        . ', ErrorMessage: ' . $resultObject->Transaction->Response->ErrorMsg
//                        . ', SysErrorMessage: ' . $resultObject->Transaction->Response->SysErrMsg, Zend_Log::ERR);
//                return false;
//            } else {
//                $returnCode = $resultObject->Transaction->Response->Code;
//                $errorString = $this->getErrorMessage($returnCode);
//                Mage::log('Credit card Declined. Code: ' . $returnCode . ', ErrorText: ' . $errorString
//                        . ', ErrorMessage: ' . $resultObject->Transaction->Response->ErrorMsg
//                        . ', SysErrorMessage: ' . $resultObject->Transaction->Response->SysErrMsg, Zend_Log::ERR);
//                return false;
//            }
//        }
//        return false;
        return $this->processNon3D($result);
    }
    

}
