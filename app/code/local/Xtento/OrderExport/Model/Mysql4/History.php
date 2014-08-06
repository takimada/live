<?php

/**
 * Product:       Xtento_OrderExport (1.5.1)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-07-30T12:47:10+00:00
 * Last Modified: 2013-02-10T15:47:26+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Mysql4/History.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Mysql4_History extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('xtento_orderexport/history', 'history_id');
    }
}