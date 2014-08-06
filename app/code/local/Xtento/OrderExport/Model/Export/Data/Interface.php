<?php

/**
 * Product:       Xtento_OrderExport (1.5.1)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-07-30T12:47:10+00:00
 * Last Modified: 2012-11-18T20:56:11+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Interface.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

interface Xtento_OrderExport_Model_Export_Data_Interface {
    public function getExportData($entityType, $collectionItem);
    public function getConfiguration();
}