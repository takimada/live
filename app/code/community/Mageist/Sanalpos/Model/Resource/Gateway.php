<?php

class Mageist_Sanalpos_Model_Resource_Gateway extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('sanalpos/gateway', 'id');
    }
}