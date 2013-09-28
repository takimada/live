<?php

class Macpain_Als_Model_Adminhtml_Observer
{
	/**
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function onAdminSessionUserLoginSuccess(Varien_Event_Observer $observer)
	{
		$request 	 	= Mage::app()->getRequest();
		$locale			= $request->getParam('locale');
		$lang_cookie 	= $request->getParam('lang_cookie');
		$save_user_lang = $request->getParam('save_user_lang');
		$user_id		= $observer->getUser()->getId();
		
		if ($locale) {
			Mage::getSingleton('adminhtml/session')->setLocale($locale);
		}
		
		if ($lang_cookie && $locale) {
			Mage::helper('macpain_als')->setLanguageCookie($locale);
		}
		
		if ($save_user_lang && $locale) {
			$user = Mage::getModel('admin/user')->load($user_id);
			$user->setLocale($locale);
			$user->save();
		}
	}
	
	/**
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function onAminhtmlControllerActionPredispatchStart(Varien_Event_Observer $observer)
	{
		if (Mage::helper('macpain_als')->getLanguageCookie()) {
			Mage::app()->getLocale()->setDefaultLocale(Mage::helper('macpain_als')->getLanguageCookie());
			Mage::app()->getLocale()->setLocaleCode(Mage::helper('macpain_als')->getLanguageCookie());
			//Mage::getSingleton('adminhtml/session')->setLocale(Mage::helper('macpain_als')->getLanguageCookie());
		}
	}
	
	/**
	 *
	 * @param Varien_Event_Observer $observer
	 */
	public function onAdminhtmlBlockHtmlBefore(Varien_Event_Observer $observer)
	{
		$block = $observer->getBlock();
		if (!isset($block)) return;
		
		switch ($block->getType()) {
		
			case 'adminhtml/template':
				$request = Mage::app()->getRequest();
				if (Mage::helper('macpain_als')->getLanguageCookie()) {
					$request->setParam('locale', Mage::helper('macpain_als')->getLanguageCookie());
					Mage::getSingleton('adminhtml/session')->setLocale(Mage::helper('macpain_als')->getLanguageCookie());
				}
				
				break;
				
			/*case 'adminhtml/permissions_user_edit_tab_main':
				$request  = Mage::app()->getRequest();
				$user_id  = $request->getParam('user_id');
				$locale   = Mage::app()->getLocale();
				$form     = $block->getForm();
		        $fieldset = $form->getElement('base_fieldset');
		        
		        if ($user_id) {
		        	$user 		 = Mage::getModel('admin/user')->load($user_id);
		        	$user_locale = $user->getLocale();
		        	if (empty($user_locale)) {
		        		$user_locale = $locale->getLocaleCode();
		        	}
		        } else {
		        	$user_locale = $locale->getLocaleCode();
		        }
		        
		        $fieldset->addField('locale', 'select', array(
		            	'name'   => 'locale',
		            	'label'  => Mage::helper('cms')->__('Language'),
		            	'title'  => Mage::helper('cms')->__('Language'),
		        		'value'  => $user_locale,
		        		'values' => $locale->getTranslatedOptionLocales()
		        	)
		        );
		        
				break;*/
		}
	}
}