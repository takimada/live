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

class AW_Avail_Block_Options extends Mage_Catalog_Block_Product_View_Type_Configurable
{
    /**
     * @return mixed
     */
    public function getAllowProducts()
    {
        if (!$this->hasAllowProducts()) {
            $products = array();
            $allProducts = $this->getProduct()
                ->getTypeInstance(true)
                ->getUsedProducts(null, $this->getProduct())
            ;
            foreach ($allProducts as $product) {
                /* Aw avail rewrite */
                if ($product->getStatus() == 1) {
                    if ($product->getStockItem()->getIsInStock()
                        || Mage::helper('cataloginventory')->isShowOutOfStock()
                    ) {
                        $products[] = $product;
                    }
                }
                /* Aw avail rewrite */
            }
            $this->setAllowProducts($products);
        }
        return $this->getData('allow_products');
    }

    /**
     * Get native json config and adds stock info to it
     * @return jsonconfig
     */
    public function getJsonConfig()
    {
        if ($this->getProduct()->getData('aw_avail_disable') == 1) {
            return parent::getJsonConfig();
        }

        $parentConfig = Mage::helper('core')->jsonDecode(parent::getJsonConfig());
        $options = array();
        foreach ($this->getAllowProducts() as $product) {
            $productId  = $product->getId();
              
           /* Aw avail rewrite */
            $stock = $product->getStockItem()->getStockQty(); 
            if (!$product->getStockItem()->getIsInStock()) {
                $stock = 0;
            }
            foreach ($this->getAllowAttributes() as $attribute) {
                $productAttribute = $attribute->getProductAttribute();
                $attributeValue = $product->getData($productAttribute->getAttributeCode());
                $options[$productAttribute->getId()][$attributeValue][] = $productId;
                $options[$productAttribute->getId()]['stock' . $attributeValue][] = $stock; // aw avail rewirte
            }
        }
        $parentConfig['attributes'] = $this->_getPreparedAttributes($options);
        return Mage::helper('core')->jsonEncode($parentConfig);
    }

    protected function _getPreparedAttributes($options)
    {
        $attributes = array();
        foreach ($this->getAllowAttributes() as $attribute) {
            $productAttribute = $attribute->getProductAttribute();
            $attributeId = $productAttribute->getId();
            $info = array(
                'id'        => $attributeId,
                'code'      => $productAttribute->getAttributeCode(),
                'label'     => $attribute->getLabel(),
                'options'   => array()
            );
            $prices = $attribute->getPrices();
            if (is_array($prices)) {
                foreach ($prices as $value) {
                    if (!$this->_validateAttributeValue($attributeId, $value, $options)) {
                        continue;
                    }
                    $info['options'][] = array (
                        'id'       => $value['value_index'],
                        'label'    => $value['label'],
                        'price'    => $this->_preparePrice($value['pricing_value'], $value['is_percent']),
                        'products' => isset($options[$attributeId][$value['value_index']]) ?
                            $options[$attributeId][$value['value_index']] : array(),
                        'stock'    => isset($options[$attributeId]['stock' . $value['value_index']]) ?
                            $options[$attributeId]['stock' . $value['value_index']] : array() // aw avail rewrite
                    );
                }
            }
            if ($this->_validateAttributeInfo($info)) {
                $attributes[$attributeId] = $info;
            }
        }
        return $attributes;
    }

    /**
     * Return controller url for ajax request
     * @return string
     */
    public function getControllerUrl()
    {
        return $this->getUrl('awavail/data/getdata');
    }
}