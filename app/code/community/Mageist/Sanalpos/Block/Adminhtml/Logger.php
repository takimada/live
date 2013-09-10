<?php

class Mageist_Sanalpos_Block_Adminhtml_Logger extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_logger';
        $this->_blockGroup = 'sanalpos';
        $this->_headerText = Mage::helper('sanalpos')->__('Mageist Sanalpos - Log List');
        parent::__construct();
        $this->_removeButton('add');
    }
}