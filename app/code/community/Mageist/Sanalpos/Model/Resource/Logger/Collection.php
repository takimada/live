<?php

class Mageist_Sanalpos_Model_Resource_Logger_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('sanalpos/logger');
    }
}