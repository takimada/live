<?php
class Gala_Yomarketsettings_Helper_Product {
	function getPreviousNextProducts($product) {
		
		if(!$product->getCategoryIds())
			return; // if product is not in any category, do not display prev-next :)
			
		$cat_ids = $product->getCategoryIds(); // get all categories where the product is located

		$cat = Mage::getModel('catalog/category')->load( $cat_ids[0] ); // load first category, you should enhance this, it works for me
		$order = Mage::getStoreConfig('catalog/frontend/default_sort_by');

		$direction = 'asc'; // asc or desc
		$category_products = $cat->getProductCollection()->addAttributeToSort($order, $direction);

		$category_products->addAttributeToFilter('status',1); // 1 or 2

		$category_products->addAttributeToFilter('visibility',4); // 1.2.3.4
		$cat_prod_ids = $category_products->getAllIds(); // get all products from the category

		$_product_id = $product->getId();
		$_pos = array_search($_product_id, $cat_prod_ids); // get position of current product

		$_next_pos = $_pos+1;

		$_prev_pos = $_pos-1;
		// get the next product url

		if( isset($cat_prod_ids[$_next_pos]) ) {
			$_next_prod = Mage::getModel('catalog/product')->load( $cat_prod_ids[$_next_pos] );
		} 
		else {
			$_next_prod = Mage::getModel('catalog/product')->load( reset($cat_prod_ids) );
		}

		// get the prev product url
		if( isset($cat_prod_ids[$_prev_pos]) ) {
			$_prev_prod = Mage::getModel('catalog/product')->load( $cat_prod_ids[$_prev_pos] );
		} 
		else {
			$_prev_prod = Mage::getModel('catalog/product')->load( end($cat_prod_ids) );
		}
		
		return array($_prev_prod, $_next_prod);
	}
}