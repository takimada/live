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
class Mirasvit_SearchSphinx_Model_System_Config_Source_SearchTemplate
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'and',
                'label' => Mage::helper('searchsphinx')->__('AND matching (word1 & word2 & word3...)')
            ),
            array(
                'value' => 'or',
                'label' => Mage::helper('searchsphinx')->__('OR matching (word1 | word2 | word3...)')
            ),
            array(
                'value' => 'quorum',
                'label' => Mage::helper('searchsphinx')->__('Quorum matching ("query" / n)')
            ),
        );
    }
}
