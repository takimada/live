<?php
 
class Mageist_Sanalpos_Block_Adminhtml_Logger_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
               
        $this->_objectId = 'id';
        $this->_blockGroup = 'sanalpos';
        $this->_controller = 'adminhtml_logger';
        $this->_removeButton('save');
        $this->_removeButton('delete');
        
    }
 
    public function getHeaderText()
    {
        return Mage::helper('sanalpos')->__('Log Details');
    }
}