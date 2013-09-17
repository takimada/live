<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tab_Promote extends Mage_Adminhtml_Block_System_Config_Form {

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

        $fieldset = $form->addFieldset('sanalpos_form', array('legend' => Mage::helper('sanalpos')->__('Promotion Options')));
        
//        $fieldset->addField('is_promoted_gateway', 'select', array(
//            'label' => Mage::helper('sanalpos')->__('Is Promoted Gateway'),
//            'class' => 'required-entry',
//            'required' => true,
//            'name' => 'is_promoted_gateway',
//            'values' => Mage::getSingleton("sanalpos/source_settings")->getYesNoCollection(),
//        ));
        
        $fieldset->addField('gateway_image', 'image', array(
              'label'     => Mage::helper('sanalpos')->__('Gateway Image'),
              'required'  => false,
              'name'      => 'gateway_image',
        ));
        
        $fieldset->addField('gateway_icon', 'image', array(
              'label'     => Mage::helper('sanalpos')->__('Gateway Icon'),
              'required'  => false,
              'name'      => 'gateway_icon',
        ));
        
        $fieldset->addField('gateway_color_dark', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Background Color - Dark'),
            'required' => false,
            'name' => 'gateway_color_dark'
        ));
        
        $fieldset->addField('gateway_color_light', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Background Color - Light'),
            'required' => false,
            'name' => 'gateway_color_light'
        ));
        
        $fieldset->addField('gateway_color_text', 'text', array(
            'label' => Mage::helper('sanalpos')->__('Gateway Text Color'),
            'required' => false,
            'name' => 'gateway_color_text'
        ));
        
        $fieldset->addField('gateway_color_preview', 'note', array(
            'label' => Mage::helper('sanalpos')->__('Preview'),
            'required' => false,
            'name' => 'gateway_color_preview',
            'text' => '<table id="color_preview_table"><tr><td class="head" style="background-color: #'.
            
                $data['gateway_color_dark'].'; color: #'.$data['gateway_color_text'].'">'.
                Mage::helper('sanalpos')->__('Total Amount').
                '</td></tr><tr><td class="body" style="background-color: #'.
            
                $data['gateway_color_light'].'; color: #'.$data['gateway_color_text'].'">'.
                Mage::helper('sanalpos')->__('1.25 TL').
                '</td></tr></table>'
        ));
        
        $fieldset->addField('top_text', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('Top Text'),
            'after_element_html' => "<p class=\"note\"><span>".Mage::helper('sanalpos')->__('Top Text Under Image, HTML Allowed') . "</span></p>",
            'name' => 'top_text',
        ));
        
        $fieldset->addField('bottom_text', 'textarea', array(
            'label' => Mage::helper('sanalpos')->__('Bottom Text'),
            'after_element_html' => "<p class=\"note\"><span>".Mage::helper('sanalpos')->__('Bottom Text Below The List, HTML Allowed') . "</span></p>",
            'name' => 'bottom_text',
        ));
        
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}