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
 * @version    1.2.4
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Avail_Block_Adminhtml_Rules_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$model = Mage::registry('aw_avail_rules_data');
		$form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('avail_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('avail')->__('General')));

        if ($model->getId()) {
        	$fieldset->addField('rule_id', 'hidden', array(
                'name' => 'rule_id',
            ));
        }
    	$fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('avail')->__('Rule Title'),
            'title' => Mage::helper('avail')->__('Rule Title'),
            'required' => true,
        ));
        $fieldset->addField('save_as', 'hidden', array(
            'name' => 'aw_avail_save_as'
        )); 
    	$fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('avail')->__('Status'),
            'title'     => Mage::helper('avail')->__('Status'),
            'name'      => 'status',
            'options'    => array(
                '1' => Mage::helper('avail')->__('Active'),
                '0' => Mage::helper('avail')->__('Inactive'),
            ),
        ));  
        $fieldset->addField('type', 'select', array(
            'label'     => Mage::helper('avail')->__('Type'),
            'title'     => Mage::helper('avail')->__('Type'),
            'name'      => 'type',
            'options'    => array(
                '0' => Mage::helper('avail')->__('Text only'),
                '1' => Mage::helper('avail')->__('Text and image'),
                '2' => Mage::helper('avail')->__('Image only')
            ),
        ));
        $fieldset->addField('priority', 'text', array(
            'name' => 'priority',
            'label' => Mage::helper('avail')->__('Rule Priority'),
            'title' => Mage::helper('avail')->__('Rule Priority'),
            'required' => false,
            'note' => Mage::helper('avail')->__(
                'Rules with greater priority value are processed first'
            )
        ));
        
        if (Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_ids', 'hidden', array(
                'name' => 'store_ids[]',
                'value' => Mage::app()->getStore()->getId(),
            ));
        } else {
            $fieldset->addField('store_ids', 'multiselect', array(
                'name' => 'store_ids[]',
                'label' => Mage::helper('avail')->__('Store view'),
                'title' => Mage::helper('avail')->__('Store view'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }

        $renderer = Mage::getBlockSingleton('adminhtml/widget_form_renderer_fieldset')
            ->setTemplate('promo/fieldset.phtml')
            ->setNewChildUrl($this->getUrl('*/adminhtml_rules/newConditionHtml/form/avail_conditions_fieldset'))
        ;
        $fieldset = $form->addFieldset('conditions_fieldset', array(
            'legend'=>Mage::helper('avail')->__('Conditions'))
        )->setRenderer($renderer);

    	$fieldset->addField('conditions', 'text', array (
            'name' => 'conditions',
            'label' => Mage::helper('avail')->__('Conditions'),
            'title' => Mage::helper('avail')->__('Conditions'),
            'required' => false,
        ))->setRule($model)->setRenderer(Mage::getBlockSingleton('rule/conditions'));
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
