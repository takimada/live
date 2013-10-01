<?php

class Mageist_Kargolar_Block_Adminhtml_Sales_Order_View extends Mage_Adminhtml_Block_Sales_Order_View {

    public function __construct() {

        parent::__construct();

        $order = $this->getOrder();
        $trackingUrl = Mage::helper('shipping')->getTrackingPopUpUrlByOrderId($order->getId());
        
        $shippingDetails = Mage::helper('kargolar')->getShippingDetails($order);

        if(!empty($shippingDetails['trackingNumber'])) {
            $this->_addButton('kargo_track', array(
                'label' => Mage::helper('kargolar')->__('Track'),
                'onclick' => 'popWin(\''.$trackingUrl.'\',\'trackorder\',\'width=800,height=600,resizable=yes,scrollbars=yes\')',
                'class' => 'go'
                    ), 0, 100, 'header', 'header');
        }
    }
}