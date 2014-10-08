<?php

/**
 * Product:       Xtento_OrderExport (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2013-02-10T16:57:50+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/System/Config/Source/Destination/Type.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_System_Config_Source_Destination_Type
{
    public function toOptionArray()
    {
        return Mage::getSingleton('xtento_orderexport/destination')->getTypes();
    }

    public function getName($type) {
        foreach ($this->toOptionArray() as $optionType => $name) {
            if ($optionType == $type) {
                return $name;
            }
        }
        return '';
    }
}