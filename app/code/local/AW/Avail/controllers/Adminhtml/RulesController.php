<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Avail
 * @version    1.2.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Avail_Adminhtml_RulesController extends Mage_Adminhtml_Controller_Action
{
    /**
     * @var $int
    */
    protected $_ruleId = null;

    public function indexAction()
    {
        $this->_title($this->__('Custom Stock Display'));
        $this
            ->loadLayout()
            ->_setActiveMenu('catalog')
            ->renderLayout()
        ;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('avail/rules')->load($id)->delete();
                $this->_clearOldData($id);
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('avail')->__('Rule was successfully deleted')
                );
                return $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                return $this->_redirect('*/*/');
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('avail')->__('Delete error'));
        return $this->_redirect('*/*/');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('avail/rules');
        $act = 'New Rule';
        if ($id) {
            $act = 'Edit Rule';
            $model->load($id);
            if (!$model->getRuleId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('avail')->__('This rule no longer exists')
                );
                return $this->_redirect('*/*');
            }
        }
        $this->_title($this->__($act))->_title($this->__('Custom Stock Display'));
        $model->getConditions()->setJsFormObject('avail_conditions_fieldset');
        Mage::register('aw_avail_rules_data', $model);
        $this->loadLayout();
        $this->_setActiveMenu('catalog');

        $block = $this->getLayout()
            ->createBlock('avail/adminhtml_rules_edit')
            ->setData('action', $this->getUrl('*/avail_rules/save'))
        ;
        $this->getLayout()->getBlock('head')
            ->setCanLoadExtJs(true)
            ->setCanLoadRulesJs(true)
        ;
        $this
            ->_addContent($block)
            ->_addLeft($this->getLayout()->createBlock('avail/adminhtml_rules_edit_tabs'))
            ->renderLayout()
        ;
        return $this;
    }

    /**
     * Save rule data:
     * 1. Rule serialized
     * 2. Labels serialized
     *
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('avail/rules');
                $data['conditions'] = $data['rule']['conditions'];
                unset($data['rule']);
                
                if ($this->getRequest()->getParam('aw_avail_save_as', false)) {
                    if (isset($data['rule_id'])) {
                        unset($data['rule_id']);
                    }
                }
                $model->setData($data)->save();
                $this->_ruleId = $model->getId(); 
                $model
                    ->loadPost($data)
                    ->setLabelsSerialized($this->serializeImageData())
                    ->save()
                ;
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('avail')->__('Rule was successfully saved')
                );

                if ($this->getRequest()->getParam('back')) {
                    return $this->_redirect('*/*/edit',
                        array(
                             'id'  => $model->getId(),
                             'tab' => Mage::app()->getRequest()->getParam('tab')
                        )
                    );
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setPageData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('rule_id')));
                return $this;
            }
        }
        $this->_redirect('*/*/');
        return $this;
    }

    /**
     * At the beginning of function we write top level info to $_FILES array as
     * Varien_Uploader searches related to file info there and cannot work with 
     * Assoc arrays of level 2,3,4 etc.
     * @param string $scope
     * @param string $newValue 
     * 
     */
    public function _uploadFiles($scope, $newValue)
    {
        $_FILES['scope_' . $scope] = array(
            'tmp_name' => $_FILES['labels']['tmp_name'][$scope]['image'],
            'name' => $_FILES['labels']['name'][$scope]['image']
        );
        $uploader = new Varien_File_Uploader('scope_' . $scope);
        $uploader->setAllowedExtensions($this->getAllowedFileExtensions());
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);
        $path = AW_Avail_Helper_Data::getImgDir(true); //full path          
        $uploader->save($path, $newValue);
    }

    /**
     * Returns serialized array of labels
     * Image data is processed on every save process
     * @return array
     * 
     */
    public function serializeImageData()
    {
        /* Clear garbage left after deleted elements */
        $this->_clearOldData();
        $normalized = $this->getRequest()->getPost('labels');
        $newValue = null;

        /* Normalize image data */
        foreach ($normalized as $scope => &$data) {
            if (isset($_FILES['labels']['name'][$scope]['image'])) {
                $newValue = $_FILES['labels']['name'][$scope]['image'];
            }

            /* Process file upload if new value is set and delete is not selected */
            if (!empty($newValue) && !isset($data['image']['delete'])) {
                $newValue = $this->_generateImageName($newValue);
                if (!empty($newValue)) {
                    $this->_deleteOldFile($data); // delete old file
                    $data['image'] = $newValue; // Set new file value
                    $this->_uploadFiles($scope, $newValue);
                }
                continue;
            }

            /* Set old value if !newValue and !delete old value */
            if (empty($newValue) && !isset($data['image']['delete'])) {
                $data['image'] = $this->_getImageName(@$data['image']['value']);
                continue;
            }

            /* Try to delete old file, reset image name anyway */
            if (isset($data['image']['delete']) && !empty($data['image']['value'])) {
                $this->_deleteOldFile($data);
                $data['image'] = null;
            }
        }
        return @serialize($normalized);
    }

    /* Clear old files */
    private function _clearOldData($id = false)
    {
        $mediaPath = AW_Avail_Helper_Data::getImgDir(true);
        if ($deleted = Mage::app()->getRequest()->getParam('aw_avail_deleted_elemes')) {
            $deleted = explode("|", $deleted);
            foreach ($deleted as $file) {
                $file = base64_decode($file);
                @unlink($mediaPath . $file);
            }
        }
        if ($id) {
            foreach (glob("{$mediaPath}*wavail__rule-{$id}*") as $img) {
                @unlink($img);
            }
        }
    }
    
    private function _deleteOldFile($data)
    {
        if (isset($data['image']['value'])) {
            $mediaPath = AW_Avail_Helper_Data::getImgDir(true);
            $imgDel = $mediaPath . $this->_getImageName($data['image']['value']);
            if (file_exists($imgDel)) {
                @unlink($imgDel);
            }
        }
    }
    
    private function _generateImageName($rawVal)
    {
        $mediaPath = AW_Avail_Helper_Data::getImgDir(true);
        $newValue = preg_replace("#[^a-zA-Z0-9_.-]#is", "", $rawVal); // sanitaze image name
        if (in_array(substr($newValue, 1), $this->getAllowedFileExtensions())) {
            // if all symbols are disallowed randomize image name
            $newValue = rand() . $newValue;
        }
        if (is_numeric($this->_ruleId)) {
            $newValue = "awavail__rule-{$this->_ruleId}-".$newValue;
        }
        if (file_exists($mediaPath . $newValue)) {
            $newValue = rand() . $newValue;
        }
        return $newValue;
    }

    public function getAllowedFileExtensions()
    {
        return array('jpg', 'jpeg', 'gif', 'png');
    }

    /**
     * Get the last element after url path separator (/)
     * @param $url
     * @return mixed|null
     */
    protected function _getImageName($url)
    {
        if (!$url) {
            return null;
        }
        $urlData = explode('/', $url);
        return array_pop($urlData);
    }

    public function newConditionHtmlAction()
    {
        $id = $this->getRequest()->getParam('id');
        $typeArr = explode('|', str_replace('-', '/', $this->getRequest()->getParam('type')));
        $type = $typeArr[0];
        $model = Mage::getModel($type)
            ->setId($id)
            ->setType($type)
            ->setRule(Mage::getModel('avail/rules'))
            ->setPrefix('conditions')
        ;
        if (!empty($typeArr[1])) {
            $model->setAttribute($typeArr[1]);
        }

        if ($model instanceof Mage_Rule_Model_Condition_Abstract) {
            $model->setJsFormObject($this->getRequest()->getParam('form'));
            $html = $model->asHtmlRecursive();
        } else {
            $html = '';
        }
        $this->getResponse()->setBody($html);
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/aw_avail_rules');
    }

    public function massDeleteAction()
    {
        $ruleIds = $this->getRequest()->getParam('rule_id');
        if (!is_array($ruleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($ruleIds as $ruleId) {
                    Mage::getModel('avail/rules')->load($ruleId)->delete();
                    $this->_clearOldData($ruleId);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($ruleIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $ruleIds = $this->getRequest()->getParam('rule_id');
        if (!is_array($ruleIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($ruleIds as $ruleId) {
                    $model = Mage::getModel('avail/rules')->load($ruleId);
                    $model->setData('status', $this->getRequest()->getParam('status'));
                    $model->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully updated', count($ruleIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->_title('')->_title($this->__('Custom Stock Display'));
        $this->loadLayout();
        $this->getResponse()->setBody($this->getLayout()->createBlock('avail/adminhtml_rules_grid')->toHtml());
    }
}