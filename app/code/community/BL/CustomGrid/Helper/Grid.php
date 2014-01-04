<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   BL
 * @package    BL_CustomGrid
 * @copyright  Copyright (c) 2012 Benoît Leulliette <benoit.leulliette@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class BL_CustomGrid_Helper_Grid
    extends Mage_Core_Helper_Abstract
{
    protected $_checkFrom16 = null;
    
    protected $_baseVerifyCallbacks = array(
        'block' => array(
            'adminhtml/catalog_product_grid' => '_verifyCatalogProductGridBlock',
            'adminhtml/sales_order_grid'     => '_verifySalesOrderGridBlock',
        ),
        'collection' => array(
            'adminhtml/catalog_product_grid' => '_verifyCatalogProductGridCollection',
            'adminhtml/sales_order_grid'     => '_verifySalesOrderGridCollection',
        ),
    );
    protected $_additionalVerifyCallbacks = array(
        'block' => array(),
        'collection' => array(),
    );
    
    public function addVerifyGridElementCallback($type, $blockType, $callback, $params=array(), $addNative=true)
    {
         $this->_additionalVerifyCallbacks[$type][$blockType][] = array(
            'callback'   => $callback,
            'params'     => $params,
            'add_native' => $addNative,
        );
        return $this;
    }
    
    public function shouldCheckFrom16()
    {
        if (is_null($this->_checkFrom16)) {
            $this->_checkFrom16 = Mage::helper('customgrid')->isMageVersionGreaterThan(1, 5);
        }
        return $this->_checkFrom16;
    }
    
    protected function _verifyGridElement($type, $blockType, $element, $model)
    {
        $checkFrom16 = $this->shouldCheckFrom16();
        $isVerified  = true;
        
        if (isset($this->_baseVerifyCallbacks[$type][$blockType])) {
            $isVerified = (bool) call_user_func(
                array($this, $this->_baseVerifyCallbacks[$type][$blockType]),
                $element,
                $model,
                $checkFrom16
            );
        }
        if ($isVerified && isset($this->_additionalVerifyCallbacks[$type][$blockType])) {
            foreach ($this->_additionalVerifyCallbacks[$type][$blockType] as $callback) {
                $isVerified = (bool) call_user_func_array(
                    $callback['callback'],
                    array_merge(
                        array_values($callback['params']),
                        ($callback['add_native']? array($element, $model, $checkFrom16) : array())
                    )
                );
                if (!$isVerified) {
                    break;
                }
            }
        }
        
        return $isVerified;
    }
    
    public function verifyGridBlock($block, $model)
    {
        if (($block instanceof Mage_Adminhtml_Block_Widget_Grid)
            && Mage::helper('customgrid')->isRewritedGrid($block)) {
            return $this->_verifyGridElement('block', $block->getBlockType(), $block, $model);
        }
        return false;
    }
    
    public function verifyGridCollection($block, $model)
    {
        if (($collection = $block->getCollection())
            && ($collection instanceof Varien_Data_Collection_Db)) {
            return $this->_verifyGridElement('collection', $block->getBlockType(), $collection, $model);
        }
        return false;
    }
    
    protected function _verifyCatalogProductGridBlock($block, $model, $checkFrom16)
    {
        return ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid);
    }
    
    protected function _verifyCatalogProductGridCollection($collection, $model, $checkFrom16)
    {
        if ($checkFrom16) {
            return ($collection instanceof Mage_Catalog_Model_Resource_Product_Collection);
        }
        return ($collection instanceof Mage_Catalog_Model_Resource_Eav_Mysql4_Product_Collection);
    }
    
    protected function _verifySalesOrderGridBlock($block, $model, $checkFrom16)
    {
        return ($block instanceof Mage_Adminhtml_Block_Sales_Order_Grid);
    }
    
    protected function _verifySalesOrderGridCollection($collection, $model, $checkFrom16)
    {
        if ($checkFrom16) {
            return ($collection instanceof Mage_Sales_Model_Resource_Order_Grid_Collection);
        }
        return ($collection instanceof Mage_Sales_Model_Mysql4_Order_Grid_Collection);
    }
    
    public function isEavEntityGrid($block, $model)
    {
        return ($block->getCollection() instanceof Mage_Eav_Model_Entity_Collection_Abstract);
    }
    
    public function getGridDisplayableColumns($block)
    {
        $columns = $block->getColumns();
        
        foreach ($columns as $key => $column) {
            if ($column->getBlcgFilterOnly()) {
                unset($columns[$key]);
            }
        }
        
        return $columns;
    }
}