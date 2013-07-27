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
 * @category Mirasvit
 * @package Mirasvit_SearchIndex
 * @copyright Copyright (C) 2013 Mirasvit (http://mirasvit.com)
 */

class Mirasvit_SearchIndex_Helper_Index extends Mage_Core_Helper_Abstract
{
    protected $_indexes = array(
        'catalog',
        'cms',
        'awblog',
        'maction',
        'category',
        'wordpress',
    );

    public function getIndexes($sorted = false)
    {
        $indexes = array();
        foreach ($this->_indexes as $indexCode){
            $index = $this->getIndexModel($indexCode);
            if ($index->isEnabled()) {
                $indexes[$indexCode] = $index;
            }
        }

        if ($sorted == true) {
            $arPos = array();
            foreach ($indexes as $code => $index) {
                $arPos[$code] = $index->getPosition();
            }
            $arPos['catalog'] = -1;
            asort($arPos);
            foreach ($arPos as $code => $position) {
                $arPos[$code] = $indexes[$code];
            }

            $indexes = $arPos;
        }
        return $indexes;
    }

    public function getIndex($index)
    {
        $indexes = $this->getIndexes();
        if (isset($indexes[$index])) {
            return $indexes[$index];
        }

        return false;
    }

    public function getIndexModel($indexCode)
    {
        return Mage::getSingleton('searchindex/type_'.$indexCode.'_index');
    }
}