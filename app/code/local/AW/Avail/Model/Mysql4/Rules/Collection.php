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

class AW_Avail_Model_Mysql4_Rules_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
		parent::_construct();
        $this->_init('avail/rules');
    }
    
    protected function _afterLoad()
    {
        parent::_afterLoad();
        foreach ($this->getItems() as $item) {
            $item->setData('store_ids', explode(',', $item->getData('store_ids')));
        }
        return $this;
    }
    
    public function addIsActiveFilter()
    {
        $this
            ->getSelect()
            ->where('main_table.status = 1')
            ->where(
                'FIND_IN_SET(?, main_table.store_ids) or FIND_IN_SET(0, main_table.store_ids)',
                Mage::app()->getStore()->getId()
            )
        ;
        return $this;
    }
    
    public function addPriorityOrder()
    {
        $this->getSelect()->order('main_table.priority DESC');
        return $this;
    }
    
    public function addStoreFilter($storeIds)
    {
        $query = null;
        sort($storeIds);
        foreach ($storeIds as $key => $storeId) {
            $query .= "FIND_IN_SET({$storeId},main_table.store_ids)";
            if ($key != count($storeIds) - 1) {
                $query .= " OR ";
            }
        }
        $this->getSelect()->where($query);
        return $this;
    }
}