<?php

class Mageist_Sanalpos_PaymentController extends Mage_Core_Controller_Front_Action {

    // The redirect action is triggered when someone places an order
    public function redirectAction() {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'sanalpos', array('template' => 'mageist_sanalpos/redirect.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }

    // The response action is triggered when your gateway sends back a response after processing the customer's payment
    public function responseAction() {
        
//        $orderId = '100000061';
//        
//        $order = Mage::getModel('sales/order');
//        $quote = Mage::getModel('sales/quote');
//        
//        $order->loadByIncrementId($orderId);
//        $quoteId = $order->getQuoteId();
//        
//        $payment = $order->getPayment();
//        $quote->loadByIdWithoutStore($quoteId);
//        
//        var_dump($quote);
//        var_dump($payment->getAdditionalInformation());
//        
//        die();
        
        
        
//        echo '<table>';
//	foreach($_POST as $key => $value)
//        {  
//                echo "<tr><td>".$key."</td><td>".$value."</td></tr>";
//        }echo '</table>';
//        die();
        
        
        //TODO: Burayı tekrardan getLastRealOrderId ile yapmalı.

        $quoteId = Mage::app()->getRequest()->getParam('o');
        if($this->getRequest()->isPost() && isset($quoteId)) {
            
            $order = Mage::getModel('sales/order');
            $quote = Mage::getModel('sales/quote');
            $oQuoteId = $quoteId;
            $quoteArray = explode('_', $quoteId);

            $quoteId = $quoteArray[count($quoteArray) - 1];
            
            
            //Vakifbank
            $quoteId = explode('XXXXXX', $quoteId);
            $quoteId = $quoteId[count($quoteId) - 1];
            
            $quote->load($quoteId);
            
            //TODO: What else can be the order id ?
            $orderId = $quote->getReservedOrderId();

            $order->loadByIncrementId($orderId);
        
            $payment = $order->getPayment();

            $additionalInformation = $payment->getAdditionalInformation();

            $_POST['taksit'] = $additionalInformation['installment'];



            $loggerId = Mage::getSingleton('checkout/session')->getLoggerId();

            $logger = Mage::getModel('sanalpos/logger')->load($loggerId);

            $logger->setData('threed_result', print_r($_POST, true));
            $logger->save();


            if ($order) {

                $gateway = Mage::getModel('sanalpos/gateway_bank')->selectGateway($additionalInformation['gateway']);

                if($gateway) {
                    //TODO: this will be called with some data in it
                    $returnArray = $gateway->get3DResult($_POST);
                    if($returnArray['result'] == 1) {         

                        $state = $gateway->getFinalState();
                        $gateway->setQuoteId($oQuoteId);
//                        $grandTotal = Mage::helper('core')->currency($order->getBaseGrandTotal(), false, false);
//                        $payment->setTransactionId(-1)->
//                                setIsTransactionClosed(1)
//                                ->setIsPaid(true)
//                                ->registerCaptureNotification($grandTotal);
                        $order->save();
                        

                        $logger->setData('status', 3);
                        if(isset($returnArray['_requestApiXML'])) {
                            $logger->setData('api_request', $returnArray['_requestApiXML']);
                        }
                        if(isset($returnArray['_resultApiXML'])) {
                            $logger->setData('api_result', $returnArray['_resultApiXML']);
                        }
                        if(isset($returnArray['message'])) {
                            $logger->setData('message', $returnArray['message']);
                        }
                        $logger->save();

                        $gateway->postProcess3D($order, $state, $additionalInformation);

//                        $session = $this->_getSession();
//                        $session->unsQuoteId();

//                        $quote = Mage::getModel('sales/quote')
//                            ->load($order->getQuoteId());
//                        $quote->setIsActive(false)
//                        ->save();
                        
//                        $session->unsQuote();

                        return $this->_redirect('checkout/onepage/success', array('_secure' => true));

                    } else {
                        $errorMsg = $returnArray['message'];

                        $logger->setData('status', 2);
                        if(isset($returnArray['_requestApiXML'])) {
                            $logger->setData('api_request', $returnArray['_requestApiXML']);
                        }
                        if(isset($returnArray['_resultApiXML'])) {
                            $logger->setData('api_result', $returnArray['_resultApiXML']);
                        }
                        if(isset($returnArray['message'])) {
                            $logger->setData('message', $returnArray['message']);
                        }
                        $logger->save();

                    }

                } else {
                    $errorMsg = Mage::helper('sanalpos')->__('Gateway not found or not active.');
                    $logger->setData('status', 2);
                    $logger->setData('message', $errorMsg);
                    $logger->save();
                }
            } else {
                $errorMsg = Mage::helper('sanalpos')->__('Error occured');
                $logger->setData('status', 2);
                $logger->setData('message', $errorMsg);
                $logger->save();
            }

            

            if($errorMsg) {
                $this->_getErrorPage($errorMsg, $order);
            }
        }
        else {
            return $this->_redirect('', array('_secure' => true));
        }
    }

    public function cancelAction($message = null) {
        if ($this->_getSession()->getLastRealOrderId()) {
            $order = Mage::getModel('sales/order')->loadByIncrementId($this->_getSession()->getLastRealOrderId());
            if ($order->getId()) {
                $order->cancel()->setState(Mage_Sales_Model_Order::STATE_CANCELED, true, $message)->save();
            }
        }
    }
    
    public function _getSession() {
        return Mage::getSingleton('checkout/session');
    }
    
    public function _reactivateQuote($order) {
        $session = $this->_getSession();
        
        $quote = Mage::getModel('sales/quote')
            ->load($order->getQuoteId());
        $quote->setIsActive(1)
        ->setReservedOrderId(NULL)
        ->save();
        
        $session->replaceQuote($quote);
    }
    
    public function _getErrorPage($message, $order) {
        
        $session = $this->_getSession();
        $this->cancelAction($message);
        
        $logEnabled = Mage::getStoreConfig("payment/sanalpos/debug_detailed");
        if($logEnabled) {
            Mage::Log($message);   
        }
        
        $this->_reactivateQuote($order);
        
        $session->setGatewayError($message);
        
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mage_Core_Block_Template', 'sanalpos', array('template' => 'mageist_sanalpos/error.phtml'));
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }
    
    public function checkbinAction(){
        $binNumber = Mage::app()->getRequest()->getParam('bin');
        $binNumberArray = Mage::getModel('sanalpos/gateway')->getBinGateway($binNumber);
        echo json_encode($binNumberArray);
        die();
    }

    public function checkkoiAction() {
        $ccNumber = Mage::app()->getRequest()->getParam('cc');

        $gateway = Mage::getModel('sanalpos/gateway_bank')->selectGateway('yapikredi');

        $gateway->setCredentialData();

        $result = $gateway->checkJoker($ccNumber);

        $approved = false;
        if($result) {
            $resultObject = new SimpleXMLElement($result);
            if(isset($resultObject->approved)) {
                if($resultObject->approved == 1) {
                    $approved = true;
                }
            }
        } 

        if(!$approved) {
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('appr'=>0)));
        } else {
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('appr'=>1, 'message'=>'')));
        }
    }

    public function tableAction() {
        $this->loadLayout()->renderLayout();
    }

    public function valuesAction() {
        $installmentTable = Mage::getModel('sanalpos/gateway')->getInstallmentTable();
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode(array('data'=>$installmentTable)));
    }

}