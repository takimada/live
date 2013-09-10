<?php

class Mageist_Sanalpos_Adminhtml_LoggerController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('sanalpos/logs')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Sanalpos'), Mage::helper('adminhtml')->__('Sanalpos'));
        return $this;
    }

    public function indexAction() {        
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('sanalpos/adminhtml_logger'));
        $this->renderLayout();
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('sanalpos/logger');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sanalpos')->__('Log does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('sanalpos_data', $model);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('sanalpos/adminhtml_logger_edit'))
                ->_addLeft($this->getLayout()->createBlock('sanalpos/adminhtml_logger_edit_tabs'));
        $this->renderLayout();
    }
    
    public function gridAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sanalpos/adminhtml_logger_grid')->toHtml()
        );
    }

    
}