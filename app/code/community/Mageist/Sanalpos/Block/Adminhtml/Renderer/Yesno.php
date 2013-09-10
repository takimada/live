<?php

class Mageist_Sanalpos_Block_Adminhtml_Renderer_Yesno extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $value = $row->getData($this->getColumn()->getIndex());
        if($value == 1) {
            return Mage::helper('sanalpos')->__('Yes');
        }
        
        return Mage::helper('sanalpos')->__('No');
    }

}

?>