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

class AW_Avail_Block_Stockinfo extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        $this->setTemplate('aw_avail/stockinfo.phtml');
    }

    /**
     * Rule validation for product object
     * On failure standard Magento type message appears Instock / Out of stock 
     * @return AW_Avail_Block_Stockinfo 
     * 
     */
    public function validateProduct()
    {
        $product = $this->getProduct();
        if (!$product->getId()) {
            return $this;
        }
        $validationModel = $this->getRuleModel();
        if (!$validationModel->validateProductAttributes($product)) {
            $this->setTemplate('aw_avail/default.phtml');
            return $this;
        }
        $this->prepareRule($validationModel->getAppliedRule());
        return $this;
    }

    /**
     * Load product by id. Note, id isset on block creation
     * For more info see class AW_Avail_DataController
     * @return Varien_Object 
     */
    public function getProduct()
    {
        if (!$this->getData('product')) {
            $product = Mage::getModel('catalog/product')->load($this->getProductId());
            if (!$product->getId()) {
                return new Varien_Object();
            }
            $this->setData('product', $product);
        }
        return $this->getData('product');
    }

    /**
     * 1. Unserialize and sort labels data labels data
     * 2. Write info to data 1). Appliced rule 2). stock labels
     * @param AW_Avail_Model_Rules $rule 
     * return void
     * 
     */
    public function prepareRule($rule)
    {
        $labelsData = @unserialize($rule->getLabelsSerialized());
        uasort($labelsData, array($this, 'addSortOrder')); // sort and maintain keys assoc 
        $labelsWrapper = new Varien_Object();
        $labelsWrapper->addData($labelsData);
        $this->setData('stock_labels', $labelsWrapper);
        $this->setData('applied_rule', $rule);
    }

    /**
     * Get applied stock labels out of scope of available labels
     * @return array 
     *       
     */
    public function getAppliedStockLabel()
    {
        if (!$this->getProduct()->getStockItem()->getIsInStock()) {
            return $this->getStockLabels()->getOutOfStock();
        }

        if ($this->getProduct()->isConfigurable()) {
            $qty = $this->getProduct()->getStockItem()->getStockQty();
        } else {
            $qty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($this->getProduct())->getQty();
        }
        $labelsScope = new AW_Avail_Block_Adminhtml_Rules_Edit_Tab_Labels_List();
        foreach ($this->getStockLabels()->getData() as $scope => $data) {
            /* Skip default labels */
            if ($scope == $labelsScope->getDefaultLabel() || $scope == $labelsScope->getOutOfStockKey()) {
                continue;
            }
            if (isset($data['qty'])) {
                if ($qty <= $data['qty']) {
                    return $data;
                }
            }
        }
        return $this->getStockLabels()->getDefault();
    }

    /**
     * Parse labels vars %qty% and %product%
     * @param array $label
     * @return array
     * 
     */
    public function parseVars($label)
    {
        $label['text'] = preg_replace("#%product%#is", $this->getProduct()->getName(), $label['text']);
        if ($this->getProduct()->isConfigurable()) {
            $qty = $this->getProduct()->getStockItem()->getStockQty();
        } else {
            $qty = (int) Mage::getModel('cataloginventory/stock_item')->loadByProduct($this->getProduct())->getQty();
        }
        $label['text'] = preg_replace("#%qty%#is", $qty, $label['text']);
        return $label;
    }

    public function getRuleModel()
    {
        return Mage::getModel('avail/rules');
    }

    /**
     * uasort function to sort labels by qty in accending order
     * @param type array
     * @param type array
     * @return int
     * 
     */
    public function addSortOrder($a, $b)
    {
        if (isset($a['qty']) && isset($b['qty'])) {
            if ($a['qty'] == $b['qty']) {
                return 0;
            }
            return ($a['qty'] < $b['qty']) ? -1 : 1;
        }
        return -1;
    }
}