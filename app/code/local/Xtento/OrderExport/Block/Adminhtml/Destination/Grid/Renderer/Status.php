<?php

/**
 * Product:       Xtento_OrderExport (1.5.2)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-08-07T08:25:21+00:00
 * Last Modified: 2013-02-10T17:02:34+01:00
 * File:          app/code/local/Xtento/OrderExport/Block/Adminhtml/Destination/Grid/Renderer/Status.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Block_Adminhtml_Destination_Grid_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return Mage::helper('xtento_orderexport')->__('Used in <strong>%d</strong> profile(s)', count($row->getProfileUsage()));
    }
}