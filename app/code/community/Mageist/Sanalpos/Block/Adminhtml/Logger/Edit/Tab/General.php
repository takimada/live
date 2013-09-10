<?php

class Mageist_Sanalpos_Block_Adminhtml_Logger_Edit_Tab_General extends Mage_Adminhtml_Block_System_Config_Form {

    protected function _prepareForm() {

        if (Mage::getSingleton('adminhtml/session')->getSanalposData()) {
            $data = Mage::getSingleton('adminhtml/session')->getSanalposData();
            Mage::getSingleton('adminhtml/session')->setSanalposData(null);
        } elseif (Mage::registry('sanalpos_data')) {
            $data = Mage::registry('sanalpos_data')->getData();
        } else {
            $data = array();
        }
        
        $form = new Varien_Data_Form();

        $fieldset = $form->addFieldset('sanalpos_form', array('legend' => Mage::helper('sanalpos')->__('Gateway Information')));

        $fieldset->addField('gateway_code', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Code'),
            'name' => 'gateway_code',
            'readonly' => true
        ));
        $fieldset->addField('gateway_type', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Type'),
            'name' => 'gateway_type',
            'readonly' => true
        ));
        $fieldset->addField('gateway_name', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Name'),
            'name' => 'gateway_name',
            'readonly' => true
        ));
        $fieldset->addField('status', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Status'),
            'name' => 'status',
            'readonly' => true
        ));
        $fieldset->addField('real_order_id', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Real Order Id'),
            'name' => 'real_order_id',
            'readonly' => true
        ));
        $fieldset->addField('order_id', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Order Id'),
            'name' => 'order_id',
            'readonly' => true
        ));
        $fieldset->addField('amount', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Amount'),
            'name' => 'amount',
            'readonly' => true
        ));
        $fieldset->addField('currency', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Currency'),
            'name' => 'currency',
            'readonly' => true
        ));
        $fieldset->addField('api_request', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('Api Request'),
            'name' => 'api_request',
            'readonly' => true
        ));
        $fieldset->addField('api_result', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('Api Result'),
            'name' => 'api_result',
            'readonly' => true
        ));
        $fieldset->addField('threed_request', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('3D Request'),
            'name' => 'threed_request',
            'readonly' => true
        ));
        $fieldset->addField('threed_result', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('3D Result'),
            'name' => 'threed_result',
            'readonly' => true
        ));
        $fieldset->addField('ip_address', 'text', array(
            'label' => Mage::helper('sanalpos')->__('IP Address'),
            'name' => 'ip_address',
            'readonly' => true
        ));
        $fieldset->addField('customer_id', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Customer ID'),
            'name' => 'customer_id',
            'readonly' => true
        ));
        $fieldset->addField('message', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Message'),
            'name' => 'message',
            'readonly' => true
        ));
        $fieldset->addField('created_at', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Created At'),
            'name' => 'created_at',
            'readonly' => true
        ));

        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}