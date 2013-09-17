<?php

class Mageist_Sanalpos_Model_Gateway_Est extends Mageist_Sanalpos_Model_Gateway_Abstract {

    public $_defaultCurrenyCode = 'TRY';

    public function postProcessPaymentData() {

        // MM
        $this->_ccExpMonth = ($this->_ccExpMonth < 10) ? '0' . $this->_ccExpMonth : $this->_ccExpMonth;

        // YY
        $this->_ccExpYear = substr($this->_ccExpYear, 2, 2);

        // 1.00 = 1.00
        $this->_amount = number_format($this->_amount, 2, '.', '');

        // if 0, send empty
        $this->_ccInstallment = intval($this->_ccInstallment) == 0 ? '' : intval($this->_ccInstallment);

        // add timestamp to quote id
        $this->_quoteId = substr(md5(time()), 0, 10) . '_' . $this->_quoteId;

    }

    public function setPaymentTypeForGateway() {
        $paymentTypeCode = $this->getGatewayDataField('payment_method');
        if ($paymentTypeCode == 0) {
            $this->_paymentType = 'Auth';
        } else {
            $this->_paymentType = 'PreAuth';
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
            default : $storeType = 'no_3d';
                break;
        }

        return $storeType;
    }

    public function getCardType() {
        $ccTypeRegExpList = array(
            'VI' => '/^4[0-9]{15}$/',
            'MC' => '/^5[1-5][0-9]{14}$/');

        $ccType = 1;
        $ccTypeCode = 'VI';
        foreach ($ccTypeRegExpList as $ccTypeMatch => $ccTypeRegExp) {
            if (preg_match($ccTypeRegExp, $this->_ccNumber)) {
                $ccTypeCode = $ccTypeMatch;
                if ($ccTypeCode == 'MC')
                    $ccType = 2;
                break;
            }
        }

        $this->_card_type = $ccType;
    }

    public function prepareNon3D() {


        $strProvUserID = $this->_api_username;
        $strProvisionPassword = $this->_api_password;
        $strMerchantID = $this->_store_no;

        $strIPAddress = $this->_customerIpAddress;
        $strEmailAddress = $this->_customerEmailAddress;
        $strOrderID = $this->_quoteId;
        $strInstallmentCnt = $this->_ccInstallment;
        $strOwner = $this->_ccOwner;
        $strNumber = $this->_ccNumber;
        $strExpireDate = $this->_ccExpMonth . '/' . $this->_ccExpYear;
        $strCVV2 = $this->_ccCvv;
        $strAmount = $this->_amount;

        $strType = $this->_paymentType;
        $strCurrencyCode = $this->_currenyCodeId;

        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <CC5Request>
                    <Name>$strProvUserID</Name>
                    <Password>$strProvisionPassword</Password>
                    <ClientId>$strMerchantID</ClientId>
                    <IPAddress>$strIPAddress</IPAddress>
                    <Email>$strEmailAddress</Email>
                    <Mode>P</Mode>
                    <OrderId>$strOrderID</OrderId>
                    <GroupId></GroupId>
                    <TransId></TransId>
                    <UserId></UserId>
                    <Type>$strType</Type>
                    <Number>$strNumber</Number>
                    <Expires>$strExpireDate</Expires>
                    <Cvv2Val>$strCVV2</Cvv2Val>
                    <Total>$strAmount</Total>
                    <Currency>$strCurrencyCode</Currency>
                    <Taksit>$strInstallmentCnt</Taksit>
                    <BillTo>
                        <Name>$strOwner</Name>
                        <Street1></Street1>
                        <Street2></Street2>
                        <Street3></Street3>
                        <City></City>
                        <StateProv></StateProv>
                        <PostalCode></PostalCode>
                        <Country>Turkey</Country>
                        <Company></Company>
                        <TelVoice></TelVoice>
                    </BillTo>
                    <ShipTo>
                        <Name></Name>
                        <Street1></Street1>
                        <Street2></Street2>
                        <Street3></Street3>
                        <City></City>
                        <StateProv></StateProv>
                        <PostalCode></PostalCode>
                        <Country>Turkey</Country>
                    </ShipTo>
                </CC5Request>";

        $this->_requestDataApi = "DATA=" . $xml;
    }

    public function processNon3D($result = null) {
        
        $returnArray = array(
            'result'    => 0,
            'message'   => 'def'
        );
                    
        $xmlNotValid = true;
        if ($result !== false) {
            $resultObject = new SimpleXMLElement($result);
            if($resultObject) {
                if(!isset($resultObject->Error)) {
                    $xmlNotValid = false;
                    $strResponseValue = $resultObject->Response;
                    if ($strResponseValue == "Approved") {
                        $returnArray['result'] = 1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Accepted. Code: %s',$resultObject->AuthCode);
                    } elseif ($strResponseValue == "Declined") {
                        $returnCode = $resultObject->ProcReturnCode;
                        $errorString = $this->getErrorMessage($returnCode);
                        $returnArray['result'] = -1;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s', $returnCode, $errorString);
                    } else {
                        $returnCode = $resultObject->ProcReturnCode;
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
        $this->getCardType();

        /*
         * Set gateway information for test mode if necessary
         */
        if ($this->isTestMode()) {

            $this->overrideCreditCardData();
            $this->overrideCredentialData();
        }

        $strMerchantID = $this->_store_no;

        $strEmailAddress = $this->_customerEmailAddress;
        $strOrderID = $this->_quoteId;
        $strAmount = $this->_amount;

        $strCurrencyCode = $this->_currenyCodeId;

        $random = time();

        $strStoreKey = $this->_three_d_store_key;

        $strStoreType = $this->_store_type;
        
        $strPaymentType = $this->_paymentType;

        $strInstallmentCnt = $this->_ccInstallment;
        if ($strInstallmentCnt == '' || $strInstallmentCnt == 0) {
            $strInstallmentCnt = '';
        }

        $strOkUrl = Mage::getUrl('sanalpos/payment/response', array(
                    '_secure' => true,
                    'o' => $strOrderID));
        $strFailUrl = Mage::getUrl('sanalpos/payment/response', array(
                    '_secure' => true,
                    'o' => $strOrderID));
        
        if($strStoreType != '3d' && $strStoreType != '3D') {
            
            $hashstr = $strMerchantID . $strOrderID . $strAmount . $strOkUrl . $strFailUrl . $strPaymentType . $strInstallmentCnt . $random . $strStoreKey;
        } else {
            $hashstr = $strMerchantID . $strOrderID . $strAmount . $strOkUrl . $strFailUrl . $random . $strStoreKey;
            //$hashstr = $strMerchantID . $strOrderID . $strAmount . $strOkUrl . $strFailUrl . $strInstallmentCnt . $random . $strStoreKey;
        }
        
        $strHash = base64_encode(pack('H*', sha1($hashstr)));

        $postFields = array(
            'pan' => $this->_ccNumber,
            'cv2' => $this->_ccCvv,
            'Ecom_Payment_Card_ExpDate_Year' => $this->_ccExpYear,
            'Ecom_Payment_Card_ExpDate_Month' => $this->_ccExpMonth,
            'cardType' => $this->_card_type,
            'clientid' => $strMerchantID,
            'amount' => $strAmount,
            'oid' => $strOrderID,
            'okUrl' => $strOkUrl,
            'failUrl' => $strFailUrl,
            'rnd' => $random,
            'hash' => $strHash,
            'storetype' => $strStoreType,
            'currency' => $strCurrencyCode,
            'email' => $strEmailAddress,
        );

        if($this->_code == 'hsbc') {
            $postFields['returnURL'] = $strOkUrl;
        }


        if($strStoreType != '3D' && $strStoreType != '3d') {
            $postFields['islemtipi'] = $strPaymentType;
            $postFields['taksit'] = $strInstallmentCnt;
        }

        $dataFields = array(
            '_formurl' => $this->_gatewayRedirectUrl
        );

        $returnArray = array('data' => $dataFields, 'post' => $postFields);
        $this->log($returnArray);
        Mage::getModel('checkout/session')->set3DPostData($returnArray);
    }

    public function get3DResult($postData) {
        $this->getCardType();
        return parent::get3DResult($postData);
    }

    public function checkHashData($result) {
        
        $storekey = $this->_three_d_store_key;
        
        $hashparams = $result["HASHPARAMS"];
        $hashparamsval = $result["HASHPARAMSVAL"];
        $hashparam = $result["HASH"];
        $paramsval = "";
        
        $hashArray = explode(':', $hashparams);
        foreach($hashArray as $hashData) {
            if(isset($result[$hashData]) && $hashData != '') {
                $paramsval .= $result[$hashData];
            }
        }
        
        $hashval = $paramsval . $storekey;
        $hash = base64_encode(pack('H*', sha1($hashval)));

        if ($paramsval != $hashparamsval) {
            $this->log($this->_getHelper()->__('Transaction (3D) : Hash Params does not match.'));
            return false;
        }
        
        if($hashparam != $hash) {
            $this->log($this->_getHelper()->__('Transaction (3D) : Hash does not match.'));
            return false;
        }        

        return true;
    }

    public function prepare3DApiCall($postData) {

        
        $strOwner = $this->_ccOwner;

        $strProvisionUser = $this->_api_username; //Terminal UserID şifresi
        $strProvisionPassword = $this->_api_password; //Terminal UserID şifresi

        $mode = $this->_est_mode;           //P olursa gerçek islem, T olursa test islemi yapar
        $type = $this->_paymentType;        //Auth: Satış PreAuth: Ön Otorizasyon

        $name = $strProvisionUser;         //is yeri kullanic adi
        $password = $strProvisionPassword;      //Is yeri sifresi

        $clientid = $postData["clientid"];    //Is yeri numarasi
        $tutar = $postData["amount"];                // Islem tutari
        $taksit = (!isset($postData["taksit"]) ? '' : ((intval($postData["taksit"]) == 0) ? '' : $postData["taksit"]));
        //Taksit sayisi Pesin satislarda bos gonderilmelidir, "0" gecerli sayilmaz.
        $oid = $postData['oid'];   //Siparis numarasy her islem icin farkli olmalidir ,
        //bos gonderilirse sistem bir siparis numarasi üretir.
        $lip = $postData['clientIp'];   //Son kullanici IP adresi
        $email = $postData['email'];      //Email
        //Provizyon alinamadigi durumda taksit sayisi degistirilirse sipari numarasininda
        //degistirilmesi gerekir.
        
        // 3d Decure işleminin sonucu başarısız ise işlemi provizyona göndermeyiniz (XML göndermeyiniz).
        $xid = $postData['xid'];                 // 3d Secure özel alani PayerTxnId
        $eci = $postData['eci'];                 // 3d Secure özel alani PayerSecurityLevel
        $cavv = $postData['cavv'];               // 3d Secure özel alani PayerAuthenticationCode
        $md = $postData['md'];                   // Eğer 3D işlembaşarılısya provizyona kart numarası yerine md değeri gönderilir.
        $currency = $postData['currency'];                   
        // Son kullanma tarihi ve cvv2 gönderilmez.

        $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>
                <CC5Request>
                    <Name>$name</Name>
                    <Password>$password</Password>
                    <ClientId>$clientid</ClientId>
                    <IPAddress>$lip</IPAddress>
                    <Email>$email</Email>
                    <Mode>$mode</Mode>
                    <OrderId>$oid</OrderId>
                    <GroupId></GroupId>
                    <TransId></TransId>
                    <UserId></UserId>
                    <Type>$type</Type>
                    <Number>$md</Number>
                    <Expires></Expires>
                    <Cvv2Val></Cvv2Val>
                    <Total>$tutar</Total>
                    <Currency>$currency</Currency>
                    <Taksit>$taksit</Taksit>
                    <PayerTxnId>$xid</PayerTxnId>
                    <PayerSecurityLevel>$eci</PayerSecurityLevel>
                    <PayerAuthenticationCode>$cavv</PayerAuthenticationCode>
                    <CardholderPresentCode>13</CardholderPresentCode>
                    <BillTo>
                        <Name>$strOwner</Name>
                        <Street1></Street1>
                        <Street2></Street2>
                        <Street3></Street3>
                        <City></City>
                        <StateProv></StateProv>
                        <PostalCode></PostalCode>
                        <Country></Country>
                        <Company></Company>
                        <TelVoice></TelVoice>
                    </BillTo>
                    <ShipTo>
                        <Name></Name>
                        <Street1></Street1>
                        <Street2></Street2>
                        <Street3></Street3>
                        <City></City>
                        <StateProv></StateProv>
                        <PostalCode></PostalCode>
                        <Country></Country>
                    </ShipTo>
                    <Extra></Extra>
                </CC5Request>";

        $this->_requestData3DApi = "DATA=" . $xml;
    }

    public function process3D($result = null) {
//        Mage::log($result);
//        if ($result !== false) {
//            $resultObject = new SimpleXMLElement($result);
//            if($resultObject) {
//                if(isset($resultObject->Error)) {
//                    Mage::log('XML Parsing error - wrong format: ' . $result);
//                    return false;
//                }
//                $strResponseValue = $resultObject->Response;
//
//                if ($strResponseValue == "Approved") {
//                    Mage::log('Credit card Accepted. Code: ' . $resultObject->AuthCode, Zend_Log::ERR);
//                    return true;
//                } elseif ($strResponseValue == "Declined") {
//                    $returnCode = $resultObject->ProcReturnCode;
//                    $errorString = $this->getErrorMessage($returnCode);
//                    Mage::log('Credit card Declined. Code: ' . $returnCode . ', ErrorText: ' . $errorString
//                            . ', ErrorMessage: ' . $resultObject->ErrMsg, Zend_Log::ERR);
//                    return false;
//                } else {
//                    $returnCode = $resultObject->ProcReturnCode;
//                    $errorString = $this->getErrorMessage($returnCode);
//                    Mage::log('Credit card Declined. Code: ' . $returnCode . ', ErrorText: ' . $errorString
//                            . ', ErrorMessage: ' . $resultObject->ErrMsg, Zend_Log::ERR);
//                    return false;
//                }
//            } else {
//                Mage::log('XML Parsing error : ' . $result);
//                return false;
//            }
//        }
//        return false;
        return $this->processNon3D($result);
    }

}
