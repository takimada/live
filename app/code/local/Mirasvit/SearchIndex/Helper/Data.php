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

class Mirasvit_SearchIndex_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getSearchEngine()
    {
        $engine = null;

        if (Mage::helper('core')->isModuleEnabled('Mirasvit_SearchSphinx')) {
            $engine = Mage::helper('searchsphinx')->getEngine();
        } elseif (Mage::helper('core')->isModuleEnabled('Mirasvit_SearchShared')) {
            $engine = Mage::getSingleton('searchshared/engine_fulltext');
        }

        return $engine;
    }

    public function prepareString($string)
    {
        $string = strip_tags($string);
        $string = str_replace('|', ' ', $string);
        $string = ' '.$string.' ';

        return $string;
    }
}