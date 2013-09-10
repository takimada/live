<?php
class Mageist_Sanalpos_Block_Form_Cc extends Mage_Payment_Block_Form_Cc
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mageist_sanalpos/form/cc.phtml');
    }
    
    public function getInstallmentTable($basePrice = 0) {
        Mage::getModel('sanalpos/gateway')->getInstallmentTable($basePrice);
    }
}
