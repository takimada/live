<?php
class Gala_Yomarketsettings_Adminhtml_Yomarketsettings_LinkController extends Mage_Adminhtml_Controller_Action
{

	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	
	public function faqsAction() {
		$this->getResponse()->setRedirect('http://www.galathemes.com/faqs.html');
	}
	
	public function requestinstallationAction() {
		$this->getResponse()->setRedirect('http://galathemes.com/request-installation.html');
	}
	
	public function technicalsupportAction() {
		$this->getResponse()->setRedirect('http://galathemes.com/support.html');
	}
	
	public function contactusAction(){
		$this->getResponse()->setRedirect('http://galathemes.com/contact.html');
	}

	public function service_moreAction() {
		$this->getResponse()->setRedirect('http://galathemes.com/services.html');
	}
}