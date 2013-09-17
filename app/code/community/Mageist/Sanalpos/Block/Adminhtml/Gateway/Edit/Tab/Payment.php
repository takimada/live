<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_Payment extends Mage_Adminhtml_Block_System_Config_Form {

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

        $fieldset = $form->addFieldset('sanalpos_form_payment', array('legend' => Mage::helper('sanalpos')->__('Payment Information')));
        
        $fieldset->addField('payment_method', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Payment Method'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'payment_method',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getPaymentMethodCollection($data['gateway_type']),
        ));
        
        $fieldset->addField('successful_order_status', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Successful Order Status'),
            'name' => 'successful_order_status',
            'required' => true,
            'class' => 'required-entry',
            'values' => Mage::getSingleton("adminhtml/system_config_source_order_status")->toOptionArray(),
        ));
        
        $fieldset->addField('notification_email', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Notification Email'),
            'name' => 'notification_email',
        ));
        $fieldset->addField('bin_numbers', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('Bin Numbers'),
            'name' => 'bin_numbers',
        ));
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}