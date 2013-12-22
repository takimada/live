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

class AW_Avail_Block_Adminhtml_Rules_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
		$this->_objectId = 'id';
        $this->_blockGroup = 'avail';
        $this->_controller = 'adminhtml_rules';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('avail')->__('Save Rule'));
        $this->_updateButton('delete', 'label', Mage::helper('avail')->__('Delete Rule'));
        $this->_addButton('saveandcontinue', array(
            'label'   => Mage::helper('avail')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit(\'' . $this->_getSaveAndContinueUrl() . '\')',
            'class'   => 'save',
        ), -100);
        
        $this->_addButton('save_as', array(
            'label'     => $this->__('Save As'),
            'onclick'   => 'awAvailSaveAs()',
            'class'     => 'save'
        ), -90);

        $this->_formScripts[] = "
            function saveAndContinueEdit(url) {
               editForm.submit(url.replace(/{{tab_id}}/ig,rule_idJsTabs.activeTab.id));
            }

            var _promptVar1 = '" . $this->__('Please enter new rule name') ."';
            var _promptVar2 = '" . $this->__('Copy %s', $this->getRuleName()) . "';
            function awAvailSaveAs() {
                value = prompt(_promptVar1, _promptVar2);
                if(!value) return false;
                $('avail_title').value = value;
                $('avail_save_as').value = 1;
                editForm.submit();
            }
        ";
    }

	public function getHeaderText()
    {    
        $rule = Mage::registry('aw_avail_rules_data');
        if ($rule->getRuleId()) {
            return Mage::helper('avail')->__("Edit Rule '%s'", $this->htmlEscape($rule->getTitle()));
        } else {
            return Mage::helper('avail')->__('New Stock Rule');
        }
    }
    
    public function getRuleName()
    {
        $rule = Mage::registry('aw_avail_rules_data');
        if ($rule->getRuleId()) {
            return $this->htmlEscape($rule->getTitle());
        }
        return '';
    }

    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', array(
            '_current' => true,
            'back'     => 'edit',
            'tab'      => '{{tab_id}}'
        ));
    }
}