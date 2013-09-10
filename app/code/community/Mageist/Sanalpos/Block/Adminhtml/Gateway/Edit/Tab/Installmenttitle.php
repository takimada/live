<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_Installmenttitle extends Mage_Adminhtml_Block_System_Config_Form {

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
        
        $fieldset = $form->addFieldset('sanalpos_form_installment_text', array('legend' => Mage::helper('sanalpos')->__('Installment Title Options')));
            
        $fieldset->addField('installment_0_text', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Cash Title'),
            'name' => 'installment_0_text',
        ));
           
        $maxInstallmentCount = Mage::getModel('sanalpos/source_settings')->getMaxInstallmentCount();
        for($i = 1; $i <= $maxInstallmentCount; $i++) { 
        
            $fieldset->addField('installment_'.$i.'_text', 'text', array(
                'label' => Mage::helper('sanalpos')->__('%s Installment Title', $i),
                'name' => 'installment_'.$i.'_text',
            ));
        
        }
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}