<?php

/**
 * Product:       Xtento_OrderExport (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2013-01-08T21:24:44+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Entity/Quote.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Entity_Quote extends Xtento_OrderExport_Model_Export_Entity_Abstract
{
    protected $_entityType = Xtento_OrderExport_Model_Export::ENTITY_QUOTE;

    protected function _construct()
    {
        $this->_collection = Mage::getResourceModel('sales/quote_collection');
        parent::_construct();
    }

    public function setCollectionFilters($filters)
    {
        foreach ($filters as $filter) {
            foreach ($filter as $attribute => $filterArray) {
                if ($attribute == 'increment_id') {
                    $attribute = 'entity_id';
                }
                $this->_collection->addFieldToFilter($attribute, $filterArray);
            }
        }
        return $this->_collection;
    }
}