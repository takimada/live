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
			
            //Define the url where I'm making the request...                      
            $urlToPost = "https://sanalposprov.garanti.com.tr/VPServlet";
			//$urlToPost = "https://sanalposprovtest.garanti.com.tr/VPServlet";
			//https://sanalposprov.garanti.com.tr/servlet/gt3dengine
			

            //Now Create the request 
            $postData = "";
			$Mode = "PROD";
			//$Mode = "TEST";
			$Version = "v0.01";
			$TerminalID = "10001115";
			$TerminalID_ = "010001115"; //TerminalID basina 000 ile 9 digit yapilmali
			$ProvUserID = "PROVAUT";
			$ProvisionPassword = "edcRFV2011"; //SanalPos sifreniz
			$UserID = "APDENEME";
			$MerchantID = "9247614"; //MerchantID (Uye isyeri no)
			$CustomerName = "APDENEME";
			$Type = "sales";
			$CurrencyCode = "949";
			$CardholderPresentCode = "0";
			$MotoInd = "N";
			$EmailAddress = Mage::getSingleton('customer/session')->getCustomer()->getEmail(); 
			$OrderID = "koz_".$orderId; 
			$InstallmentCnt = ""; 
			$Number = $payment->getCcNumber();
			//$Number = "4741510000029037";
			$ExpireMonth = "";
			if(strlen($payment->getCcExpMonth()) < 2)
			{
				$ExpireMonth = "0".$payment->getCcExpMonth();
			}
			else
			{
				$ExpireMonth = $payment->getCcExpMonth();
			}
			$ExpireYear = substr($payment->getCcExpYear(), -2);
			$ExpireDate = $ExpireMonth.$ExpireYear;
			//$ExpireDate = "0314";
			$CVV2 = $payment->getCcCid();
			//$CVV2 = "033";
			
			$Amount = number_format($amount,2);
			//$Amount = $amount;
			$Amount=str_replace(".","",$Amount);

			$IPAddress = $_SERVER['REMOTE_ADDR'];
			$SecurityData = strtoupper(sha1($ProvisionPassword.$TerminalID_));
			$HashData = strtoupper(sha1($OrderID.$TerminalID.$Number.$Amount.$SecurityData));
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
		$posObj = new SimpleXMLElement((string)trim($data));

		$response = array(
			'success'=> ( 0 == (int)$posObj->Transaction->Response->ReasonCode ? true : false ),
			'type'=> "Sale",
			'CcUser'=> $posObj->Transaction->CardHolderName,
			'UserEmail'=> $posObj->Customer->EmailAddress,
			'ReasonCode' => (string)$posObj->Transaction->Response->ReasonCode,
			'Code' => (string)$posObj->Transaction->Response->Code,
			'RetrefNum' => (string)$posObj->Transaction->RetrefNum,
			'Message' => (string)$posObj->Transaction->Response->Message,
			'ErrorMessage' => (string)$posObj->Transaction->Response->ErrorMsg,
			'SystemErrorMessage' => (string)$posObj->Transaction->Response->SysErrMsg,
			'AuthCode' => (string)$posObj->Transaction->AuthCode,
			'BatchNum' => (string)$posObj->Transaction->BatchNum,
			'SequenceNum' => (string)$posObj->Transaction->SequenceNum,
			'ProvDate' => (string)$posObj->Transaction->ProvDate,
		);
	
		if (true == $response['success']) {
			$this->setStore($payment->getOrder()->getStoreId());
            $payment->setStatus(self::STATUS_APPROVED);
            $payment->setAmount($amount);
            $payment->setLastTransId($orderId);
			$payment->setCcTransId($response['AuthCode']);
			$payment->setCcOwner($response['CcUser']);
			$payment->setCcApproval($response['Message']);
		}
		else {
            $this->setStore($payment->getOrder()->getStoreId());
            $payment->setStatus(self::STATUS_ERROR);
            //Throw an exception to fail the current transaction...
            Mage::throwException($response['ErrorMessage']);
		}

		return $this;
    }
}

