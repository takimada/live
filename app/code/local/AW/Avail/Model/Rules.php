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

class AW_Avail_Model_Rules extends Mage_Rule_Model_Rule
{
    const TEXT_ONLY = 0;
    const TEXT_AND_IMAGE = 1;
    const IMAGE_ONLY = 2;

    public function _construct()
    {
        parent::_construct();
        $this->_init('avail/rules');
    }

    public function getConditionsInstance()
    {
        return Mage::getModel('avail/rule_condition_combine');
    }

    /**
     * On successful validation set to data validated rule object
     * @param Varien_Object $product
     *
     * @return bool
     */
    public function validateProductAttributes(Varien_Object $product)
    {
        $ruleCollection = Mage::getModel('avail/rules')->getCollection()
            ->addIsActiveFilter()
            ->addPriorityOrder()
        ;
        foreach ($ruleCollection as $rule) {
            $rule->load($rule->getId()); // Load rule to prepare data
            if ($rule->validate($product)) {
                $this->setData('applied_rule', $rule);
                return true;
            }
            $parentIds = Mage::getModel('catalog/product_type_configurable')->getParentIdsByChild($product->getId());
            if (is_array($parentIds) && count($parentIds) > 0) {
                foreach ($parentIds as $parentId) {
                    $parentProduct = Mage::getModel('catalog/product')->load($parentId);
                    if ($rule->validate($parentProduct)) {
                        $this->setData('applied_rule', $rule);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function awSaveBefore()
    {
        return true;
    }
}
