<?php

class Mageist_Sanalpos_Block_Adminhtml_Gateway extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_gateway';
        $this->_blockGroup = 'sanalpos';
        $this->_headerText = Mage::helper('sanalpos')->__('Mageist Sanalpos - Gateway List');
        parent::__construct();
        $this->_removeButton('add');
    }
}