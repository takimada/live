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
class Mirasvit_SearchSphinx_Model_System_Config_Source_MatchMode
{
    public function toOptionArray()
    {
        return array(
            array('value' => 0, 'label'=>Mage::helper('searchsphinx')->__('Matches all query words')),
            array('value' => 1, 'label'=>Mage::helper('searchsphinx')->__('Matches any of the query words')),
            array('value' => 2, 'label'=>Mage::helper('searchsphinx')->__('Matches query as a phrase, requiring perfect match')),
            array('value' => 3, 'label'=>Mage::helper('searchsphinx')->__('Matches query as a boolean expression')),
            array('value' => 4, 'label'=>Mage::helper('searchsphinx')->__('Matches query as an expression in Sphinx internal query language')),
        );
    }

    public function toArray()
    {
        return array(
            0 => Mage::helper('searchsphinx')->__('Matches all query words'),
            1 => Mage::helper('searchsphinx')->__('Matches any of the query words'),
            2 => Mage::helper('searchsphinx')->__('Matches query as a phrase, requiring perfect match'),
            3 => Mage::helper('searchsphinx')->__('Matches query as a boolean expression'),
            4 => Mage::helper('searchsphinx')->__('Matches query as an expression in Sphinx internal query language'),
        );
    }

}
