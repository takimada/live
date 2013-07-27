<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Sphinx Search Ultimate
 * @version   2.2.8
 * @revision  277
 * @copyright Copyright (C) 2013 Mirasvit (http://mirasvit.com/)
 */


/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   Mirasvit_SearchIndex
 * @copyright Copyright (C) 2013 Mirasvit (http://mirasvit.com)
 */


/**
 * Represent Index model for Mage_Catalog Category
 *
 * @category Mirasvit
 * @package  Mirasvit_SearchIndex
 */
class Mirasvit_SearchIndex_Model_Type_Category_Index extends Mirasvit_SearchIndex_Model_Index_Abstract
{
    const INDEX_CODE = 'category';

    public function getCode()
    {
        return self::INDEX_CODE;
    }

    public function getPrimaryKey()
    {
        return 'entity_id';
    }

    public function getAvailableAttributes()
    {
         $result = array(
            'name'             => Mage::helper('searchindex')->__('Name'),
            'meta_title'       => Mage::helper('searchindex')->__('Meta Title'),
            'meta_keywords'    => Mage::helper('searchindex')->__('Meta Keywords'),
            'meta_description' => Mage::helper('searchindex')->__('Meta Description'),
            'description'      => Mage::helper('searchindex')->__('Description'),
        );

        return $result;
    }

    public function getCollection()
    {
        $collection = Mage::getModel('catalog/category')->getCollection()
            ->addNameToResult();
        $collection->addFieldToFilter('is_active', 1);
        if ($collection instanceof Mage_Catalog_Model_Resource_Category_Flat_Collection) {
            $this->joinMatched($collection, 'main_table.entity_id');
        } else {
            $this->joinMatched($collection, 'e.entity_id');
        }

        return $collection;
    }
}