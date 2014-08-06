<?php

/**
 * Product:       Xtento_OrderExport (1.5.1)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-07-30T12:47:10+00:00
 * Last Modified: 2012-12-02T17:53:37+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Mysql4/History/Collection.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Mysql4_History_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('xtento_orderexport/history');
    }
}