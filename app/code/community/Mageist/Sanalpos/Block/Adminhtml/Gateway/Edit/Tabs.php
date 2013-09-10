<?php
 
class Mageist_Sanalpos_Block_Adminhtml_Gateway_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('sanalpos_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sanalpos')->__('Options'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('general_settings', array(
            'label'     => Mage::helper('sanalpos')->__('General Options'),
            'title'     => Mage::helper('sanalpos')->__('General Options'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_general')->toHtml(),
        ));
        $this->addTab('test_mode_settings', array(
            'label'     => Mage::helper('sanalpos')->__('Test Mode Options'),
            'title'     => Mage::helper('sanalpos')->__('Test Mode Options'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_testmode')->toHtml(),
        ));
        $this->addTab('promote_options', array(
            'label'     => Mage::helper('sanalpos')->__('Promote Options'),
            'title'     => Mage::helper('sanalpos')->__('Promote Options'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_promote')->toHtml(),
        ));
        $this->addTab('payment_options', array(
            'label'     => Mage::helper('sanalpos')->__('Payment Options'),
            'title'     => Mage::helper('sanalpos')->__('Payment Options'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_payment')->toHtml(),
        ));
        $this->addTab('installment_options', array(
            'label'     => Mage::helper('sanalpos')->__('Installment Options'),
            'title'     => Mage::helper('sanalpos')->__('Installment Options'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_installment')->toHtml(),
        ));
//        $this->addTab('installment_title_options', array(
//            'label'     => Mage::helper('sanalpos')->__('Installment Title Options'),
//            'title'     => Mage::helper('sanalpos')->__('Installment Title Options'),
//            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tab_installmenttitle')->toHtml(),
//        ));
       
        return parent::_beforeToHtml();
    }
}