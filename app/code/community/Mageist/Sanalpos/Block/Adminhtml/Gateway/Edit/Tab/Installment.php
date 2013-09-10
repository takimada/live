<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_Installment extends Mage_Adminhtml_Block_System_Config_Form {

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

        $fieldset = $form->addFieldset('sanalpos_form_installment_options', array('legend' => Mage::helper('sanalpos')->__('Installment Options')));
        
        $fieldset->addField('is_installment_active', 'select', array(
            'label' => Mage::helper('sanalpos')->__('Is Installment Active'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'is_installment_active',
            'values' => Mage::getSingleton("sanalpos/source_settings")->getYesNoCollection(),
        ));
        
        $fieldsetCommission = $form->addFieldset('sanalpos_form_installment_commission', array('legend' => Mage::helper('sanalpos')->__('Installment Commission Options')));

        $maxInstallmentCount = Mage::getModel('sanalpos/source_settings')->getMaxInstallmentCount();
        for($i = 1; $i <= $maxInstallmentCount; $i++) { 
        
            $fieldsetCommission->addField('installment_'.$i.'_value', 'text', array(
                'label' => Mage::helper('sanalpos')->__('%s Installment (%%)', $i),
                'name' => 'installment_'.$i.'_value',
            ));
        
        }
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}