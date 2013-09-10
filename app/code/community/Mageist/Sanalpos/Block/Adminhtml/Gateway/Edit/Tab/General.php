<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_General extends Mage_Adminhtml_Block_System_Config_Form {

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

        $fieldset->addField('gateway_code', 'hidden', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Code'),
            'name' => 'gateway_code'
        ));
        $fieldset->addField('gateway_type', 'hidden', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Type'),
            'name' => 'gateway_type'
        ));
        $fieldset->addField('gateway_name', 'hidden', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Name'),
            'name' => 'gateway_name'
        ));
        $fieldset->addField('supported_currency_list', 'hidden', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Supported Currency list'),
            'name' => 'supported_currency_list'
        ));

        $fieldset->addField('is_active_gateway', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Is Active'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'is_active_gateway',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getYesNoCollection(),
        ));
        
        $fieldset->addField('gateway_title', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Title'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'gateway_title'
        ));
        
        $fieldset->addField('currency', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Currency'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'currency',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getCurrencyCollection($data['supported_currency_list']),
        ));
        
        $fieldset->addField('installment_0_value', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Cash Commission Rate (%)'),
            'name' => 'installment_0_value',
            'class' => 'required-entry',
            'required' => true,
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Sort Order'),
            'name' => 'sort_order',
        ));
        
        $fieldsetCredentials = $form->addFieldset('sanalpos_form_credentials', array('legend' => Mage::helper('sanalpos')->__('Gateway Credentials')));

        $fieldName['store_no'] = Mage::helper('sanalpos')->__('Store No');
        if($data['gateway_type'] == 'grt') {
            $fieldName['store_no'] = Mage::helper('sanalpos')->__('Merchant ID');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['store_no'] = Mage::helper('sanalpos')->__('Merchant ID');
        }
        
        $fieldsetCredentials->addField('store_no', 'text', array(
            'label' => $fieldName['store_no'],
            'name' => 'store_no',
        ));
        
        if(in_array($data['gateway_type'], array('grt','ykb', 'vkf'))) {
            $fieldsetCredentials->addField('terminal_no', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Terminal ID'),
                'name' => 'terminal_no',
            ));
        }
        
        if(in_array($data['gateway_type'], array('ykb'))) {
            $fieldsetCredentials->addField('posnet_id', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Posnet ID'),
                'name' => 'posnet_id',
            ));
        }
        
        if(in_array($data['gateway_type'], array('vkf'))) {
            $fieldsetCredentials->addField('security_code', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Security Code'),
                'name' => 'security_code',
            ));
        }
        
        if($data['gateway_type'] == 'grt') {
            $fieldsetCredentials->addField('username', 'text', array(
                'label' => Mage::helper('sanalpos')->__('User ID'),
                'name' => 'username',
            ));
        }
        
        $fieldName['api_username'] = Mage::helper('sanalpos')->__('Api Username');
        if($data['gateway_type'] == 'grt') {
            $fieldName['api_username'] = Mage::helper('sanalpos')->__('Provision User');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['api_username'] = Mage::helper('sanalpos')->__('Username');
        }
        $fieldsetCredentials->addField('api_username', 'text', array(
            'label' => $fieldName['api_username'],
            'name' => 'api_username',
        ));
        
        $fieldName['api_password'] = Mage::helper('sanalpos')->__('Api Password');
        if($data['gateway_type'] == 'grt') {
            $fieldName['api_password'] = Mage::helper('sanalpos')->__('Provision Password');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['api_password'] = Mage::helper('sanalpos')->__('Password');
        }
        $fieldsetCredentials->addField('api_password', 'text', array(
            'label' => $fieldName['api_password'],
            'name' => 'api_password',
        ));
        
        if($data['gateway_type'] != 'hsb') {
            $fieldName['three_d_store_key'] = Mage::helper('sanalpos')->__('3d Store Key');
            if($data['gateway_type'] == 'grt') {
                $fieldName['three_d_store_key'] = Mage::helper('sanalpos')->__('3d Store Key');
            } elseif($data['gateway_type'] == 'ykb') {
                $fieldName['three_d_store_key'] = Mage::helper('sanalpos')->__('Encryption Key');
            }
            $fieldsetCredentials->addField('three_d_store_key', 'text', array(
                'label' => $fieldName['three_d_store_key'],
                'name' => 'three_d_store_key',
            ));
        }
        
        $fieldsetCredentials->addField('three_d_store_type', 'select', array(
            'label' => Mage::helper('sanalpos')->__('3D Store Type'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'three_d_store_type',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getThreeDTypeCollection($data['gateway_type']),
        ));
        
        $fieldsetApi = $form->addFieldset('sanalpos_form_api', array('legend' => Mage::helper('sanalpos')->__('Gateway Access URLs')));

        
        $fieldsetApi->addField('gateway_api_url', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Api URL'),
            'name' => 'gateway_api_url',
        ));
        
        $fieldsetApi->addField('gateway_redirect_url', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Redirection URL'),
            'name' => 'gateway_redirect_url',
        ));
        
        $fieldsetApi->addField('gateway_panel_url', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Control Panel URL'),
            'name' => 'gateway_panel_url',
        ));
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}