<?php
 
class Mageist_Sanalpos_Block_Adminhtml_Logger_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
 
    public function __construct()
    {
        parent::__construct();
        $this->setId('sanalpos_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('sanalpos')->__('Details'));
    }
 
    protected function _beforeToHtml()
    {
        $this->addTab('general_settings', array(
            'label'     => Mage::helper('sanalpos')->__('General'),
            'title'     => Mage::helper('sanalpos')->__('General'),
            'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_logger_edit_tab_general')->toHtml(),
        ));
        // $this->addTab('test_mode_settings', array(
        //     'label'     => Mage::helper('sanalpos')->__('Api Logs'),
        //     'title'     => Mage::helper('sanalpos')->__('Api Logs'),
        //     'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_logger_edit_tab_api')->toHtml(),
        // ));
        // $this->addTab('promote_options', array(
        //     'label'     => Mage::helper('sanalpos')->__('3D Logs'),
        //     'title'     => Mage::helper('sanalpos')->__('3D Logs'),
        //     'content'   => $this->getLayout()->createBlock('sanalpos/adminhtml_logger_edit_tab_threed')->toHtml(),
        // ));
        return parent::_beforeToHtml();
    }
}