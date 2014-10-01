<?php

/**
 * Product:       Xtento_OrderExport (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2014-02-05T21:27:07+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Export/Data/Custom/Order/AitocCustomerFields.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Export_Data_Custom_Order_AitocCustomerFields extends Xtento_OrderExport_Model_Export_Data_Abstract
{
    public function getConfiguration()
    {
        return array(
            'name' => 'Aitoc Customer Fields Export',
            'category' => 'Customer',
            'description' => 'Export custom customer attributes of Aitoc Checkout Fields Manager extension',
            'enabled' => true,
            'apply_to' => array(Xtento_OrderExport_Model_Export::ENTITY_CUSTOMER),
            'third_party' => true,
            'depends_module' => 'Aitoc_Aitcheckoutfields',
        );
    }

    public function getExportData($entityType, $collectionItem)
    {
        // Set return array
        $returnArray = array();

        if (!$this->fieldLoadingRequired('aitoc_aitcustomerfields')) {
            return $returnArray;
        }

        try {
            $customer = $collectionItem->getObject();
            if ($customer->getId()) {
                $oAitcheckoutfields = Mage::getModel('aitcheckoutfields/aitcheckoutfields');
                $this->_writeArray = & $returnArray['aitoc_aitcustomerfields']; // Write on "aitoc_aitcustomerfields" level
                $customAttrList = $oAitcheckoutfields->getCustomerData($customer->getId(), $customer->getStoreId(), true);
                foreach ($customAttrList as $aCustomAttrList) {
                    if (isset($aCustomAttrList['code']) && isset($aCustomAttrList['value'])) {
                        if (!empty($aCustomAttrList['code'])) $this->writeValue($aCustomAttrList['code'], $aCustomAttrList['value']);
                    }
                }
            }
        } catch (Exception $e) {

        }

        // Done
        return $returnArray;
    }
}