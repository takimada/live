<?php

class EM_Megamenupro_Model_Megamenupro extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('megamenupro/megamenupro');
    }
	
	public function toOptionArray()
    {
        return $this->getAttributeSetList();
    }
    public function getAttributeSetList()
    {
		$collection = $this->getCollection()->addFieldToFilter("status",1);
		$data	=	$collection->getData();
		$result	= array();
		$result[] = array('value' => '','label' => 'Please choose menu');
		foreach($data as $value)
			$result[] = array('value' => $value['megamenupro_id'],'label' => $value['name']);
		return $result;
	}
}