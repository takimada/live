<?php

/**
 * Product:       Xtento_OrderExport (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2014-02-15T16:37:17+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Custom/Order/AWPoints.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Custom_Order_AWPoints extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        return array(
            'name' => 'aheadWorks Points Summary Export',
            'category' => 'Order',
            'description' => 'Export point summary of the aheadWorks Points & Rewards extension',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_ORDER, Xtento_OrderExport_Model_Export::ENTITY_INVOICE, Xtento_OrderExport_Model_Export::ENTITY_SHIPMENT, Xtento_OrderExport_Model_Export::ENTITY_CREDITMEMO, Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER),
            'third_party' => true,
            'depends_module' => 'AW_Points',
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();
        $this->_writeArray = & $returnArray['aw_points'];

        if (!$this->fieldLoadingRequired('aw_points')) {
            return $returnArray;
        }

        try {
            if ($entityType == Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER) {
                $pointsSummary = Mage::getModel('points/summary')->loadByCustomerID($collectionItem->getObject()->getId());
            } else {
                $pointsSummary = Mage::getModel('points/summary')->loadByCustomerID($collectionItem->getOrder()->getCustomerId());
            }
            if ($pointsSummary->getId()) {
                foreach ($pointsSummary->getData() as $key => $value) {
                    $this->writeValue($key, $value);
                }
            }
        } catch (Exception $e) {

        }

        // Done
        return $returnArray;
    }
}