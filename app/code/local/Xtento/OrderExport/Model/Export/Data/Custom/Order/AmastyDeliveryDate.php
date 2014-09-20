<?php

/**
 * Product:       Xtento_OrderExport (1.5.2)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-08-07T08:25:21+00:00
 * Last Modified: 2014-02-08T16:41:14+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Custom/Order/AmastyDeliveryDate.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Custom_Order_AmastyDeliveryDate extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        return array(
            'name' => 'Amasty Delivery Date Export',
            'category' => 'Order',
            'description' => 'Export delivery date/comment of the Amasty Delivery Date extension',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_ORDER, Xtento_OrderExport_Model_Export::ENTITY_INVOICE, Xtento_OrderExport_Model_Export::ENTITY_SHIPMENT, Xtento_OrderExport_Model_Export::ENTITY_CREDITMEMO),
            'third_party' => true,
            'depends_module' => 'Amasty_Deliverydate',
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();
        $this->_writeArray = & $returnArray['amasty_deliverydate']; // Write on "amasty_deliverydate" level
        // Fetch fields to export
        $order = $collectionItem->getOrder();

        if (!$this->fieldLoadingRequired('amasty_deliverydate')) {
            return $returnArray;
        }

        try {
            $deliveryDate = Mage::getModel('amdeliverydate/deliverydate');
            $deliveryDate->load($order->getId(), 'order_id');
            if ($deliveryDate->getId()) {
                foreach ($deliveryDate->getData() as $key => $value) {
                    $this->writeValue($key, $value);
                }
            }
        } catch (Exception $e) {

        }

        // Done
        return $returnArray;
    }
}