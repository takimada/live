<?php

/**
 * Magento
 *
 *  
 *
 * @package     EM_Slideshowresponsive
 * @copyright   Copyright (c) 2009 Quick Solution LT
 * 
 */
class EM_Slideshowresponsive_Block_Hidden extends Mage_Core_Block_Template {

    public function _construct() {
        parent::_construct();
		$this->setTemplate('slideshowresponsive/hidden.phtml');
        // default template location
    }
	
   

}
