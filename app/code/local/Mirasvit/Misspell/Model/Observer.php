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




class Mirasvit_Misspell_Model_Observer
{
    protected $_isFullSearchReindex = false;

    public function onIndexComplete($observer)
    {
        if ($this->_isFullSearchReindex) {
            Mage::getModel('misspell/indexer')->reindexAll();
        }
    }

    public function onIndexStart($observer)
    {
        if ($observer->getData('product_ids') == null) {
            $this->_isFullSearchReindex = true;
        }
    }

    public function onPrepareCollection()
    {
        Mage::helper('catalogsearch')->setSuggestQuery();
    }
}