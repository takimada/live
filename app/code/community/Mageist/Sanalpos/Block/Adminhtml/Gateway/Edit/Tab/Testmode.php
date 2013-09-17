<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_Testmode extends Mage_Adminhtml_Block_System_Config_Form {

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
        
        $fieldset = $form->addFieldset('sanalpos_form_test_mode', array('legend' => Mage::helper('sanalpos')->__('Test Mode Information')));
        
        
        $fieldset->addField('test_mode', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Test Mode'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'test_mode',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getYesNoCollection(),
        ));
        
        $fieldset->addField('cc_number_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Test Card Number'),
            'name' => 'cc_number_test',
        ));
        
        $fieldset->addField('cc_cvv_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Test Card Cvv Number'),
            'name' => 'cc_cvv_test',
        ));
        
        $fieldset->addField('cc_exp_month_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Test Card Expiration Month'),
            'name' => 'cc_exp_month_test',
        ));
        
        $fieldset->addField('cc_exp_year_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Test Card Expiration Year'),
            'name' => 'cc_exp_year_test',
        ));
        
        $fieldsetCredentials = $form->addFieldset('sanalpos_form_test_mode_credentials', array('legend' => Mage::helper('sanalpos')->__('Gateway Credentials')));

        $fieldName['store_no_test'] = Mage::helper('sanalpos')->__('Store No');
        if($data['gateway_type'] == 'grt') {
            $fieldName['store_no_test'] = Mage::helper('sanalpos')->__('Merchant ID');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['store_no_test'] = Mage::helper('sanalpos')->__('Merchant ID');
        }
        
        $fieldsetCredentials->addField('store_no_test', 'text', array(
            'label' => $fieldName['store_no_test'],
            'name' => 'store_no_test',
        ));
        
        if(in_array($data['gateway_type'], array('grt','ykb', 'vkf'))) {
            $fieldsetCredentials->addField('terminal_no_test', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Terminal ID'),
                'name' => 'terminal_no_test',
            ));
        }
        
        if(in_array($data['gateway_type'], array('ykb'))) {
            $fieldsetCredentials->addField('posnet_id_test', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Posnet ID'),
                'name' => 'posnet_id_test',
            ));
        }
        
        if(in_array($data['gateway_type'], array('vkf'))) {
            $fieldsetCredentials->addField('security_code_test', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Security Code'),
                'name' => 'security_code_test',
            ));
        }
        
        if($data['gateway_type'] == 'grt') {
            $fieldsetCredentials->addField('username_test', 'text', array(
                'label' => Mage::helper('sanalpos')->__('User ID'),
                'name' => 'username_test',
            ));
        }
        
        $fieldName['api_username_test'] = Mage::helper('sanalpos')->__('Api Username');
        if($data['gateway_type'] == 'grt') {
            $fieldName['api_username_test'] = Mage::helper('sanalpos')->__('Provision User');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['api_username_test'] = Mage::helper('sanalpos')->__('Username');
        }
        $fieldsetCredentials->addField('api_username_test', 'text', array(
            'label' => $fieldName['api_username_test'],
            'name' => 'api_username_test',
        ));
        
        $fieldName['api_password_test'] = Mage::helper('sanalpos')->__('Api Password');
        if($data['gateway_type'] == 'grt') {
            $fieldName['api_password_test'] = Mage::helper('sanalpos')->__('Provision Password');
        } elseif($data['gateway_type'] == 'ykb') {
            $fieldName['api_password_test'] = Mage::helper('sanalpos')->__('Password');
        }
        $fieldsetCredentials->addField('api_password_test', 'text', array(
            'label' => $fieldName['api_password_test'],
            'name' => 'api_password_test',
        ));
        
        if($data['gateway_type'] != 'hsb') {
            $fieldName['three_d_store_key_test'] = Mage::helper('sanalpos')->__('3d Store Key');
            if($data['gateway_type'] == 'grt') {
                $fieldName['three_d_store_key_test'] = Mage::helper('sanalpos')->__('3d Store Key');
            } elseif($data['gateway_type'] == 'ykb') {
                $fieldName['three_d_store_key_test'] = Mage::helper('sanalpos')->__('Encryption Key');
            }
            $fieldsetCredentials->addField('three_d_store_key_test', 'text', array(
                'label' => $fieldName['three_d_store_key_test'],
                'name' => 'three_d_store_key_test',
            ));
        }
        
        $fieldsetCredentials->addField('three_d_store_type_test', 'select', array(
            'label' => Mage::helper('sanalpos')->__('3D Store Type'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'three_d_store_type_test',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getThreeDTypeCollection($data['gateway_type']),
        ));
        
        $fieldsetApi = $form->addFieldset('sanalpos_form_test_mode_api', array('legend' => Mage::helper('sanalpos')->__('Gateway Access URLs')));

        
        $fieldsetApi->addField('gateway_api_url_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Api URL'),
            'name' => 'gateway_api_url_test',
        ));
        
        $fieldsetApi->addField('gateway_redirect_url_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Redirection URL'),
            'name' => 'gateway_redirect_url_test',
        ));
        
        $fieldsetApi->addField('gateway_panel_url_test', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Control Panel URL'),
            'name' => 'gateway_panel_url_test',
        ));
        
        $fieldsetApi->addField('gateway_panel_url_test_login', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Control Panel Login'),
            'name' => 'gateway_panel_url_test_login',
        ));
        
        if($data['gateway_type'] == 'grt') {
            $fieldsetApi->addField('gateway_panel_url_test_parole', 'text', array(
                'label' => Mage::helper('sanalpos')->__('Gateway Control Panel Parole'),
                'name' => 'gateway_panel_url_test_parole',
            ));
        }
        
        $fieldsetApi->addField('gateway_panel_url_test_pass', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Control Panel Password'),
            'name' => 'gateway_panel_url_test_pass',
        ));
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
        
        
    }
}