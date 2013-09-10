<?php
 
class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'sanalpos';
        $this->_controller = 'adminhtml_gateway';
        $this->_addButton('save_and_continue', array(
                  'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                  'onclick' => 'saveAndContinueEdit()',
                  'class' => 'save',
        ), -100);
        $this->_updateButton('save', 'label', Mage::helper('sanalpos')->__('Save Gateway'));
        $this->_removeButton('delete');
        
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }
 
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
        
        
    }
 
    public function getHeaderText()
    {
        if( Mage::registry('sanalpos_data') && Mage::registry('sanalpos_data')->getId() ) {
            return Mage::helper('sanalpos')->__('Edit Gateway %s', $this->htmlEscape(Mage::registry('sanalpos_data')->getGatewayName()));
        } else {
            return Mage::helper('sanalpos')->__('Edit Gateway');
        }
    }
}