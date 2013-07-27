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
class Mirasvit_SearchSphinx_Block_Adminhtml_System_Synonym extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    public function __construct()
    {
        $this->addColumn('word', array(
            'label' => Mage::helper('adminhtml')->__('Word'),
            'style' => 'width:120px',
        ));
        $this->addColumn('synonyms', array(
            'label' => Mage::helper('adminhtml')->__('Words to Replace (comma delimiter)'),
            'style' => 'width:300px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add Synonyms');
        parent::__construct();
    }
}