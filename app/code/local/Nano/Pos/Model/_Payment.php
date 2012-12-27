<?php

/**
 * Description of Payment
 *
 * @author roysimkes
 */
class Nano_Pos_Model_Payment extends Mage_Payment_Model_Method_Cc
{
    protected $_isGateway = true;
    protected $_canAuthorize = true;
    protected $_canUseCheckout = true;

    protected $_code = "pos";
    protected $_formBlockType = 'pos/payment_form_pos';

    public function authorize(Varien_Object $payment, $amount)
    {
        $orderId = $payment->getOrder()->getIncrementId();
        try {
            $paymentValues = array("cardType" => $payment->getCcCid(),
								   "expiresMonth" => $payment->getCcExpMonth(),
								   "expiresYear" => $payment->getCcExpYear(),
								   "expiresYear" => $payment->getCcExpYear(),
								   "cardHolderName" => $payment->getCcOwner(),
								   "cardNumber" => $payment->getCcNumber(),
								   "amount" => $amount,
								   "orderId" => $orderId,
								   "bankId" => $payment->getOrder()->getPosBankId(), //Notice how I use the get methods? cc_cid
								   "installment" => $payment->getOrder()->getPosInstallment(),
								  );
			
			/*
			$strMode = "PROD";
			$strVersion = "v0.01";
			$strTerminalID = "10001115";
			$strTerminalID_ = "010001115"; //TerminalID basina 000 ile 9 digit yapilmali
			$strProvUserID = "PROVAUT";
			$strProvisionPassword = "edcRFV2011"; //SanalPos sifreniz
			$strUserID = "APDENEME";
			$strMerchantID = "9247614"; //MerchantID (Uye isyeri no)
			$strCustomerName = "APDENEME";
			$strIPAddress = "192.168.1.1";
			
			$strEmailAddress = $_POST['kunameSon'];
			$strOrderID = $_POST['oidSon']; 
			$strInstallmentCnt = ""; //Taksit Sayisi. Bos gönderilirse taksit yapilmaz
			$strNumber = $_POST['cardnumber'];
			$strExpireDate = $_POST['cardexpiredatemonth'].$_POST['cardexpiredateyear'];
			$strCVV2 = $_POST['cardcvv2'];
			$strAmount =$_POST['amountSon'];
			$strAmount=str_replace(".","",$strAmount);
			$strType = "sales";
			$strCurrencyCode = "949";
			$strCardholderPresentCode = "0";
			$strMotoInd = "N";
			$strHostAddress = "https://sanalposprov.garanti.com.tr/VPServlet";
			$SecurityData = strtoupper(sha1($strProvisionPassword.$strTerminalID_));
			$HashData = strtoupper(sha1($strOrderID.$strTerminalID.$strNumber.$strAmount.$SecurityData));
			*/
            //FIXME: Find a way to define this part in the $payment object which is Magento_Sales_Info or something like that.   
			/*
            if ($bankid == 101) { //Different banks...
                $paymentValues['username'] = "my_bank_username";
                $paymentValues['password'] = "my_secret_password_generally_not_that_secret";
                $paymentValues['clientid'] = "my_clientid_given_to_me_by_the_bank";
            } else if ($bankid == 14) { //... can require different values to be sent to them
                $paymentValues['username'] = "my_second_bank_username";
                $paymentValues['password'] = "my_secret_password_generally_not_that_secret";
                $paymentValues['clientid'] = "my_clientid_given_to_me_by_the_bank";
                $paymentValues['additionalSecondBankField'] = "additional_info";
            } else {
                Mage::throwException("Invalid bankid: $bankid");
            }
			*/
            //Define the url where I'm making the request...                      
            //$urlToPost = "https://my.bank.com/pos/service/address/";
            $urlToPost = "https://sanalposprov.garanti.com.tr/VPServlet";
			//$urlToPost = "https://sanalposprovtest.garanti.com.tr/VPServlet";
			//https://sanalposprov.garanti.com.tr/servlet/gt3dengine
			

            //Now Create the request which I will send via Post Method... 
            //Create a string like: cardType=VI&expiresMonth=12&expiresYear=2011&amount=100.50
            $postData = "";
            foreach ($paymentValues as $key => $val) {
                $postData .= "{$key}=" . urlencode($val) . "&";
            }
			$Mode = "PROD";
			//$Mode = "TEST";
			$Version = "v0.01";
			$TerminalID = "10001115";
			$TerminalID_ = "010001115"; //TerminalID basina 000 ile 9 digit yapilmali
			$ProvUserID = "PROVAUT";
			//$strProvisionPassword = "edcRFV2011"; //SanalPos sifreniz
			$ProvisionPassword = "edcRFV2011"; //SanalPos sifreniz
			$UserID = "APDENEME";
			$MerchantID = "9247614"; //MerchantID (Uye isyeri no)
			$CustomerName = "APDENEME";
			$IPAddress = "192.168.1.1";
			
			$EmailAddress = "gokhan.gursen@gmail.com";//$_POST['kunameSon'];
			$OrderID = $orderId; 
			$InstallmentCnt = ""; //Taksit Sayisi. Bos gönderilirse taksit yapilmaz 
			//$Number = $payment->getCcNumber();
			$Number = "4741510000029037";
			//$ExpireDate = $payment->getCcExpMonth().$payment->getCcExpYear();
			$ExpireDate = "0314";
			//$CVV2 = $payment->getCcCid();
			$CVV2 = "033";
			$Amount = $amount;
			$Amount=str_replace(".","",$Amount);
			$Type = "sales";
			$CurrencyCode = "949";
			$CardholderPresentCode = "0";
			$MotoInd = "N";
			//$strHostAddress = "https://sanalposprov.garanti.com.tr/VPServlet";
			//$SecurityData = strtoupper(hash('sha1', $params['Merchant_Password1'].$terminalIdExtended));
    		//$HashData = strtoupper(hash('sha1', $params['invoiceid'].$params['ID'].$params['cardnum'].$Amount.$SecurityData));
		    $IPAddress = $_SERVER['REMOTE_ADDR'];

			$SecurityData = strtoupper(sha1($ProvisionPassword.$TerminalID_));
			$HashData = strtoupper(sha1($OrderID.$TerminalID.$Number.$Amount.$SecurityData));
/*
	$postData= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>
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
			<Description></Description>
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
*/		
    $postData= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><GVPSRequest><Mode>$Mode</Mode><Version>v0.01</Version><Terminal><ProvUserID>PROVAUT</ProvUserID><HashData>$HashData</HashData><UserID>$UserID</UserID><ID>$TerminalID</ID><MerchantID>$MerchantID</MerchantID></Terminal><Customer><IPAddress>".$IPAddress."</IPAddress><EmailAddress>$EmailAddress</EmailAddress></Customer><Card><Number>$Number</Number><ExpireDate>$ExpireDate</ExpireDate><CVV2>$CVV2</CVV2></Card><Order><OrderID>$OrderID</OrderID><GroupID></GroupID><Description></Description></Order><Transaction><Type>sales</Type><InstallmentCnt>$InstallmentCnt</InstallmentCnt><Amount>$Amount</Amount><CurrencyCode>$CurrencyCode</CurrencyCode><CardholderPresentCode>0</CardholderPresentCode><MotoInd>N</MotoInd><Description></Description><OriginalRetrefNum></OriginalRetrefNum></Transaction></GVPSRequest>";

		//Mage::throwException($postData);die;
            //Let's create a curl request and send the values above to the bank...
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlToPost);
            curl_setopt($ch, CURLOPT_TIMEOUT, 180);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); //Put the created string here in use...
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $data = curl_exec($ch); //This value is the string returned from the bank...
            if (!$data) {
                throw new Exception(curl_error($ch));
            }
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpcode && substr($httpcode, 0, 2) != "20") { //Unsuccessful post request...
                Mage::throwException("Returned HTTP CODE: " . $httpcode . " for this URL: " . $urlToPost);
            }
            curl_close($ch);
        } catch (Exception $e) {
            $payment->setStatus(self::STATUS_ERROR);
            $payment->setAmount($amount);
            $payment->setLastTransId($orderId);
            $this->setStore($payment->getOrder()->getStoreId());
            Mage::throwException($e->getMessage());
        }
        /*
         * Data outputted from the curl request
         *  is generally an xml string.
         * Assume that it is something like:
         *
         * <response>
         *   <isPaymentAccepted>1</isPaymentAccepted>
         *   <bankOrderId>1234233241</bankOrderId>
         * </response>
         *
         * However no bank response is never this simple by the way...
         * But this one gives you a general view of the thing.
         */
        $xmlResponse = new SimpleXmlElement($data); //Simple way to parse xml, Magento might have an equivalent class
        $isPaymentAccepted = $xmlResponse->isPaymentAccepted == 1;
		 //Mage::throwException($data);
        //if ($isPaymentAccepted) {
        if (1==1) {
            $this->setStore($payment->getOrder()->getStoreId());
            $payment->setStatus(self::STATUS_APPROVED);
            $payment->setAmount($amount);
            $payment->setLastTransId($orderId);
			$payment->setCcTransId("123456789");
        } else {
            $this->setStore($payment->getOrder()->getStoreId());
            $payment->setStatus(self::STATUS_ERROR);
            //Throw an exception to fail the current transaction...
            Mage::throwException("Payment is not approved");
        }
        return $this;
    }
}

