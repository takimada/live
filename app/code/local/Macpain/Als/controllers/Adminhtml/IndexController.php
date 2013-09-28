<?php
require_once 'Mage/Adminhtml/controllers/IndexController.php';
class Macpain_Als_Adminhtml_IndexController extends Mage_Adminhtml_IndexController
{
	/**
	 * Admin area entry point
	 * Always redirects to the startup page url
	 */
	public function indexAction()
	{
		$session = Mage::getSingleton('admin/session');
		$url = $session->getUser()->getStartupPageUrl();
		if ($session->isFirstPageAfterLogin()) {
			$locale = Mage::getSingleton('adminhtml/session')->getLocale();
			if ($locale) {
				Mage::getSingleton('adminhtml/session')->setLocale($locale);
			}
			// retain the "first page after login" value in session (before redirect)
			$session->setIsFirstPageAfterLogin(true);
		}
		$this->_redirect($url);
	}
	
	/**
	 * Administrator login action
	 */
	public function loginAction()
	{
		if (Mage::getSingleton('admin/session')->isLoggedIn()) {
			$this->_redirect('*');
			return;
		}
		
		$locale = $this->getRequest()->getParam('locale');
		if ($locale) {
			Mage::getSingleton('adminhtml/session')->setLocale($locale);
			$this->_redirect('*');
			return;
		}
		
		$loginData = $this->getRequest()->getParam('login');
		$username = (is_array($loginData) && array_key_exists('username', $loginData)) ? $loginData['username'] : null;
	
		$this->loadLayout();
		$this->getLayout()->getBlock('content')->setTemplate('macpain/als/login.phtml');
		$this->renderLayout();
	}
	
	/**
	 * Administrator logout action
	 */
	public function logoutAction()
	{
		/** @var $adminSession Mage_Admin_Model_Session */
		$adminSession = Mage::getSingleton('admin/session');
		$adminSession->unsetAll();
		$adminSession->getCookie()->delete($adminSession->getSessionName());
		$adminSession->addSuccess(Mage::helper('adminhtml')->__('You have logged out.'));
		
		$this->_redirect('*', array('locale' => Mage::getSingleton('adminhtml/session')->getLocale()));
	}
}