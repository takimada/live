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

class AW_Avail_Block_Adminhtml_Rules_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('rule_id');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('avail')->__('Custom Stock Display Rules'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('main_section', array(
            'label'     => Mage::helper('avail')->__('General'),
            'title'     => Mage::helper('avail')->__('General'),
            'content'   => $this->getLayout()->createBlock('avail/adminhtml_rules_edit_tab_main')->toHtml(),
            'active'    => ( $this->getRequest()->getParam('tab') == 'rule_id_main_section' ) ? true : false,
        ));
        
        $this->addTab('answers_section', array(
            'label'     => Mage::helper('avail')->__('Labels'),
            'title'     => Mage::helper('avail')->__('Labels'),
            'content'   => $this->getLayout()->createBlock('avail/adminhtml_rules_edit_tab_labels')
                            ->append($this->getLayout()->createBlock('avail/adminhtml_rules_edit_tab_labels_list'))
                            ->toHtml(),
            'active'    => ( $this->getRequest()->getParam('tab') == 'rule_id_answers_section' ) ? true : false,
        ));
         return parent::_beforeToHtml();
    }
}