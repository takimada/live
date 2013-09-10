<?php

class Mageist_Sanalpos_Model_Gateway_Vkf extends Mageist_Sanalpos_Model_Gateway_Abstract {

    public $_defaultCurrenyCode = 'TRY';

    public function postProcessPaymentData() {

        // MM
        $this->_ccExpMonth = ($this->_ccExpMonth < 10) ? '0' . $this->_ccExpMonth : $this->_ccExpMonth;

        // YY
        $this->_ccExpYear = substr($this->_ccExpYear, 2, 2);

        // 1.00 = 1.00
        $this->_amount = intval(100 * $this->_amount);
        $this->_amount = str_pad($this->_amount, 12, "0", STR_PAD_LEFT);

        // if 0, send empty
        $this->_ccInstallment = intval($this->_ccInstallment) == 0 ? '00' : str_pad(intval($this->_ccInstallment), 2, "0", STR_PAD_LEFT);

        // add timestamp to quote id
        $this->_quoteId = substr(md5(time()), 0, 10) . 'XXXXXX' . $this->_quoteId;

    }

    public function setPaymentTypeForGateway() {
        $paymentTypeCode = $this->getGatewayDataField('payment_method');
        if ($paymentTypeCode == 0) {
            $this->_paymentType = 'PRO';
        } else {
            $this->_paymentType = 'OPR';
        }
    }

    public function get3DStoreType($storeTypeCode) {
        $storeType = '';

        switch ($storeTypeCode) {
            case 0 : $storeType = 'no_3d';
                break;
            case 1 : $storeType = '3d';
                break;
            default : $storeType = 'no_3d';
                break;
        }

        return $storeType;
    }

    public function prepareNon3D() {


        $strProvUserID = $this->_api_username;
        $strProvisionPassword = $this->_api_password;
        $strMerchantID = $this->_store_no;
        $strTerminalID = $this->_terminal_no;

        $strIPAddress = $this->_customerIpAddress;
        $strOrderID = $this->_quoteId;
        $strInstallmentCnt = $this->_ccInstallment;
        $strNumber = $this->_ccNumber;
        $strExpireDate = $this->_ccExpYear . $this->_ccExpMonth;
        $strCVV2 = $this->_ccCvv;
        $strAmount = $this->_amount;
        
        $strSecurityCode = $this->_security_code;

        $strType = $this->_paymentType;
        
        $xml  = 'kullanici='.$strProvUserID;
        $xml .= '&sifre='.$strProvisionPassword;
        $xml .= '&islem='.$strType;
        $xml .= '&uyeno='.$strMerchantID;
        $xml .= '&posno='.$strTerminalID;
        $xml .= '&kkno='.$strNumber;
        $xml .= '&gectar='.$strExpireDate;
        $xml .= '&cvc='.$strCVV2;
        $xml .= '&tutar='.$strAmount;
        $xml .= '&provno=000000';
        $xml .= '&taksits='.$strInstallmentCnt;
        $xml .= '&islemyeri=I';
        $xml .= '&uyeref='.$strOrderID;
        $xml .= '&vbref=0';
        $xml .= '&khip='.$strIPAddress;
        $xml .= '&xcip='.$strSecurityCode;

        $this->_requestDataApi = $xml;
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
                if(isset($resultObject->Msg)) {
                    $xmlNotValid = false;
                    $strResponseValue = $resultObject->Msg->Kod;
                    
                    $valid = false;
                    if ($strResponseValue == "00") {
                        $strResponseStatusValue = $resultObject->Msg->Status;
                        if($strResponseStatusValue == "00") {
                            $valid = true;
                            $returnArray['result'] = 1;
                            $returnArray['message'] = $this->_getHelper()->__('Credit card Accepted. Code: %s',$resultObject->Msg->ProvNo);
                        }
                    }
                    
                    if(!$valid) {
                        $returnCode = $resultObject->Msg->Kod;
                        $errorString = $this->getErrorMessage($returnCode);
                        
                        $bkmCode = '';
                        if(isset($resultObject->Msg->BKMKod)) {
                            $bkmCode    = $resultObject->Msg->BKMKod;
                        }
                        $returnArray['result'] = -2;
                        $returnArray['message'] = $this->_getHelper()->__('Credit card Declined. Code: %s, ErrorText: %s, BKM Code: %s', $returnCode, $errorString, $bkmCode);
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
            case "02" : $msg = "Kartla ilgili problem. Bankanızı arayınız.";
                break;
            case "69" : $msg = "Eksik Parametre. Kart bilgilerinizi kontrol edip tekrar deneyiniz.";
                break;
            case "68" : $msg = "Hatalı İşlem Tipi. Lütfen sorunu yönetime bildirin.";
                break;
            case "67" : $msg = "Parametre uzunluklarında uyuşmazlık. Lütfen bilgilerinizi kontrol ediniz.";
                break;
            case "66" : $msg = "Numeric deger hatası. Nümerik değerlerden oluşması gereken alanlardan biri veya bırkaçı hatalı.";
                break;
            case "64" : $msg = "İşlem tipi taksit e uygun değil.";
                break;
            case "63" : $msg = "Request mesajinda illegal karakter var.";
                break;
            case "62" : $msg = "Yetkisiz ya da tanımsız kullanıcı.";
                break;
            case "61" : $msg = "Hatalı Tarih.";
                break;
            case "60" : $msg = "Hareket Bulunamadi.";
                break;
            case "59" : $msg = "Gunsonu yapilacak hareket yok/GS Yapilmis.";
                break;
            case "90" : $msg = "Kayıt bulunamadı.";
                break;
            case "91" : $msg = "Begin Transaction error.";
                break;
            case "92" : $msg = "Insert Update Error.";
                break;
            case "96" : $msg = "DLL registration error.";
                break;
            case "97" : $msg = "IP Hatası.";
                break;
            case "98" : $msg = "H. Iletisim hatası.";
                break;
            case "99" : $msg = "DB Baglantı hatası.";
                break;
            case "70" : $msg = "XCIP hatalı.";
                break;
            case "71" : $msg = "Üye İşyeri blokeli ya da tanımsız.";
                break;
            case "72" : $msg = "Tanımsız POS.";
                break;
            case "73" : $msg = "POS table update error.";
                break;
            case "76" : $msg = "Taksit e kapalı.";
                break;
            case "74" : $msg = "Hatalı taksit sayısı.";
                break;
            case "75" : $msg = "Illegal State.";
                break;
            case "85" : $msg = "Kayit Reversal Durumda.";
                break;
            case "86" : $msg = "Kayit Degistirilemez.";
                break;
            case "87" : $msg = "Kayit Iade Durumda.";
                break;
            case "88" : $msg = "Kayit Iptal Durumda.";
                break;
            case "89" : $msg = "Geçersiz kayıt.";
                break;
            case "01" : $msg = "Eski kayıt. Bir önceki siparişle aynı sipariş numarası girildi.";
                break;
            default: $msg = "Lütfen bilgilerinizi kontrol ediniz..";
        }
        return $msg;
    }

    public function prepare3DPost() {
        
    }

    public function get3DResult($postData) {
        
    }

    public function checkHashData($result) {
        
    }

    public function prepare3DApiCall($postData) {

    }

    public function process3D($result = null) {
        
    }

}

