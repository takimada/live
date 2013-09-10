<?php

class Mageist_Sanalpos_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('sanalpos/items')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Sanalpos'), Mage::helper('adminhtml')->__('Sanalpos'));
        return $this;
    }

    public function indexAction() {        
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('sanalpos/adminhtml_gateway'));
        $this->renderLayout();
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('sanalpos/gateway');
        if ($id) {
            $model->load((int) $id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sanalpos')->__('Gateway does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('sanalpos_data', $model);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_addContent($this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit'))
                ->_addLeft($this->getLayout()->createBlock('sanalpos/adminhtml_gateway_edit_tabs'));
        $this->renderLayout();
    }
    
    public function saveAction() {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('sanalpos/gateway');
        $data = $this->getRequest()->getPost();
        
        
        if ($data) {
            
            if(isset($_FILES['gateway_image']['name']) and (file_exists($_FILES['gateway_image']['tmp_name']))) {
                
                $data['gateway_image'] = $this->uploadImage('gateway_image');
                
            } else {
                if(isset($data['gateway_image']['delete']) && $data['gateway_image']['delete'] == 1)
                    $data['gateway_image'] = '';
                else
                    unset($data['gateway_image']);
            }
            
            if(isset($_FILES['gateway_icon']['name']) and (file_exists($_FILES['gateway_icon']['tmp_name']))) {
                $data['gateway_icon'] = $this->uploadImage('gateway_icon');
            } else {
                if(isset($data['gateway_icon']['delete']) && $data['gateway_icon']['delete'] == 1)
                    $data['gateway_icon'] = '';
                else
                    unset($data['gateway_icon']);
            }
            
            for($i = 0; $i < 25; $i++) {
                if($data['installment_'.$i.'_value'] == '') {
                    $data['installment_'.$i.'_value'] = null;
                }
            }
            
            
            $model->load((int) $id);
            $model->setData($data)
                ->setId($id);
            
            
            try {
                
                $model->save();
                
                $message = $this->__('Gateway saved');
                Mage::getSingleton('core/session')->addSuccess($message);
    
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
                }
                
                $this->_redirect('*/*/');
                return;
                
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sanalpos')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }
    
    public function gridAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('sanalpos/adminhtml_gateway_grid')->toHtml()
        );
    }
    
    public function uploadImage($scope)
    {
        $adapter  = new Zend_File_Transfer_Adapter_Http();
        //$adapter->addValidator('ImageSize', true, $this->_imageSize);
        //$adapter->addValidator('Size', true, $this->_maxFileSize);
        if ($adapter->isUploaded($scope)) {
            // validate image
            if (!$adapter->isValid($scope)) {
                Mage::throwException(Mage::helper('sanalpos')->__('Uploaded image is not valid'));
            }
            $upload = new Varien_File_Uploader($scope);
            $upload->setAllowCreateFolders(true);
            $upload->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $upload->setAllowRenameFiles(true);
            $upload->setFilesDispersion(false);
            if ($upload->save(Mage::getBaseDir('media') . DS)) {
                return $upload->getUploadedFileName();
            }
        }
        return false;
    }

    
}