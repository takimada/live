<?php

class Mageist_Sanalpos_Model_Resource_Logger extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('sanalpos/logger', 'id');
    }
}