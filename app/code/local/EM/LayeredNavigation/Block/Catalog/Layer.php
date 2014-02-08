<?php
class EM_LayeredNavigation_Block_Catalog_Layer extends Mage_Catalog_Block_Layer_View
{
	protected $_defaultDisplay = 'text';
	
	protected $_filterTemplates = array();
	
	protected $_displayConfig = null;
	
    protected function _initBlocks() {
		parent::_initBlocks();

		$helper = Mage::helper('layerednavigation');
		$helper->setupRootCategory();
		$this->_filterTemplates = $helper->getFilterTemplate();
		$this->_categoryBlockName = 'layerednavigation/catalog_filter_category';

		$config = $this->_getDisplayConfig();
		if (isset($config['price']) && $config['price']=='slider')
			$this->_priceFilterBlockName = 'layerednavigation/catalog_filter_price';
	}

	protected function _toHtml() {
		// set custom template for filter
		$filterableAttributes = $this->_getFilterableAttributes();
		foreach ($filterableAttributes as $attribute) {
			$this->getChild($attribute->getAttributeCode() . '_filter')
				->setTemplate($this->_getFilterTemplate($attribute->getAttributeCode()));
		}

		return parent::_toHtml();
	}

	protected function _getDisplayConfig() {
		if (!$this->_displayConfig)
			$this->_displayConfig =  Mage::getModel('layerednavigation/filter')->getCollection()->getDisplayConfigs();
		return $this->_displayConfig;
	}

	protected function _getFilterTemplate($code) {
		// get template for filter has been configured in admin
		$config = $this->_getDisplayConfig();
		$template = isset($config[$code]) && in_array($config[$code], array_keys($this->_filterTemplates)) ? 
			$this->_filterTemplates[$config[$code]] : 
			$this->_filterTemplates[$this->_defaultDisplay];
		return $template;
	}
}
