<?php

class Macpain_Als_Helper_Data extends Mage_Core_Helper_Data
{
	const COOKIE_NAME = 'als/cookie/name';
	
	public function setLanguageCookie($value)
	{
		Mage::getModel('core/cookie')->set(
			$this->getCookieName(),
			$value,
			30758400
		);
	}
	
	public function getLanguageCookie()
	{
		return Mage::getModel('core/cookie')->get($this->getCookieName());
	}
	
	public function getCookieName()
	{
		return Mage::getStoreConfig(self::COOKIE_NAME);
	}
}