<?php
class Gala_Yomarketsettings_Model_Observer {
	
	public function beforeGenerateBlocks(Varien_Event_Observer $observer) {
		if((Mage::getSingleton('core/design_package')->getPackageName() == 'default') && (Mage::getDesign()->getTheme('frontend') == 'galayomarket')){
			# Disable default magento navigation
			if ((Mage::helper('yomarketsettings')->getGeneral_DisableDefaultNav())&&(Mage::getConfig()->getModuleConfig('EM_Megamenupro')->is('active', 'true'))) {
				$blocks = $observer->getLayout()->getXpath('//block[@name="galayomarket.catalog.topnav"]');
				if (!empty($blocks))
					$blocks[0]->addAttribute('ignore', true);
			}
			
			if ((Mage::helper('yomarketsettings')->getGeneral_DisableDefaultNav())&&(Mage::getConfig()->getModuleConfig('EM_Megamenupro')->is('active', 'true'))) {
				$blocks = $observer->getLayout()->getXpath('//block[@name="galayomarket.catalog.topnav.left"]');
				if (!empty($blocks))
					$blocks[0]->addAttribute('ignore', true);
			}
			
			# Disable Gala variation module on frontend
			if (Mage::helper('yomarketsettings')->getGeneral_DisableFrontendVariation()) {
				$blocks = $observer->getLayout()->getXpath('//block[@name="em_variation_tpl" or @name="mobile_view"]');
				foreach ($blocks as $block)
					$block->addAttribute('ignore', true);
			}
			
			# Disable default Magento footer links
			if (Mage::helper('yomarketsettings')->getGeneral_DisableFooterLinks()) {
				$blocks = $observer->getLayout()->getXpath('//block[@name="footer_links"]');
				if (!empty($blocks))
					$blocks[0]->addAttribute('ignore', true);
			}
		}
	}
	
	public function beforeCatalogProductCollectionLoad(Varien_Event_Observer $observer) {
		$alt_img = Mage::helper('yomarketsettings')->getProductsGrid_AltImg();
		if ($alt_img == 'image')
			$observer->getEvent()->getCollection()->addAttributeToSelect('image');
	}
}
