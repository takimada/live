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


/*******************************************
Mirasvit
This source file is subject to the Mirasvit Software License, which is available at http://mirasvit.com/license/.
Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
If you wish to customize this module for your needs
Please refer to http://www.magentocommerce.com for more information.
@category Mirasvit
@copyright Copyright (C) 2012 Mirasvit (http://mirasvit.com.ua), Vladimir Drok <dva@mirasvit.com.ua>, Alexander Drok<alexander@mirasvit.com.ua>
*******************************************/

class Mirasvit_SearchSphinx_Model_Observer
{
    /**
     * run sphinx reindex
     */
    public function reindex()
    {
        Mage::getModel('searchsphinx/engine_sphinx')->reindex();
    }

    public function reindexDelta()
    {
        Mage::getModel('searchsphinx/engine_sphinx')->reindexDelta();
    }

    public function onMisspellIndexerPrepare($observer)
    {
        $obj = $observer->getObj();
        $string = '';

        $synonyms = unserialize(Mage::getStoreConfig('searchsphinx/advanced/synonyms'));
        foreach ($synonyms as $data) {
            $string .= $data['word'].' '.$data['synonyms'];
        }

        $obj->setSearchSphinxSynonyms($string);
    }
}