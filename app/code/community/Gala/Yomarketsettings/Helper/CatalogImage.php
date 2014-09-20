<?php
class Gala_Yomarketsettings_Helper_CatalogImage extends Mage_Catalog_Helper_Image {
	
	public function init(Mage_Catalog_Model_Product $product, $attributeName, $imageFile=null) {
		parent::init($product, $attributeName, $imageFile);
		$this->backgroundColor(Mage::helper('yomarketsettings')->getImageBackgroundColor());
		return $this;
	}
}