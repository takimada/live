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

class AW_Avail_Model_Rule_Condition_Combine extends Mage_Rule_Model_Condition_Combine
{
    public function __construct()
    {
		parent::__construct();
        $this->setType('avail/rule_condition_combine');
    }

    public function getNewChildSelectOptions()
    {
        $productCondition = Mage::getModel('catalogrule/rule_condition_product');
        $productAttributes = $productCondition->loadAttributeOptions()->getAttributeOption();
        $attributes = array();
        foreach ($productAttributes as $code=>$label) {
            $attributes[] = array('value' => 'catalogrule/rule_condition_product|' . $code, 'label' => $label);
        }
        $conditions = parent::getNewChildSelectOptions();
        $conditions = array_merge_recursive($conditions, array(
            array(
                'value' => 'catalogrule/rule_condition_combine',
                'label' => Mage::helper('catalogrule')->__('Conditions Combination')
            ),
            array('label' => Mage::helper('catalogrule')->__('Product Attribute'), 'value' => $attributes),
        ));
        return $conditions;
    }

    public function collectValidatedAttributes($productCollection)
    {
        foreach ($this->getConditions() as $condition) {
            $condition->collectValidatedAttributes($productCollection);
        }
        return $this;
    }

	public function asHtml()
    {
        $html = $this->getTypeElement()->getHtml()
            . Mage::helper('avail')->__("If %s of these order conditions are %s",
                $this->getAggregatorElement()->getHtml(),
                $this->getValueElement()->getHtml()
            )
        ;
        if ($this->getId() != '1') {
            $html .= $this->getRemoveLinkHtml();
        }
        return $html;
    }
}