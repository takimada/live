<?php

/**
 * Product:       Xtento_OrderExport (1.5.2)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-08-07T08:25:21+00:00
 * Last Modified: 2013-02-11T16:34:56+01:00
 * File:          app/code/local/Xtento/OrderExport/Model/Destination/Custom.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Model_Destination_Custom extends Xtento_OrderExport_Model_Destination_Abstract
{
    public function testConnection()
    {
        $this->initConnection();
        if (!$this->getDestination()->getBackupDestination()) {
            $this->getDestination()->setLastResult($this->getTestResult()->getSuccess())->setLastResultMessage($this->getTestResult()->getMessage())->save();
        }
        return $this->getTestResult();
    }

    public function initConnection()
    {
        $this->setDestination(Mage::getModel('xtento_orderexport/destination')->load($this->getDestination()->getId()));
        $testResult = new Varien_Object();
        $this->setTestResult($testResult);
        if (!@Mage::getModel($this->getDestination()->getCustomClass())) {
            $this->getTestResult()->setSuccess(false)->setMessage(Mage::helper('xtento_orderexport')->__('Custom class NOT found.'));
        } else {
            $this->getTestResult()->setSuccess(true)->setMessage(Mage::helper('xtento_orderexport')->__('Custom class found and ready to use.'));
        }
        return true;
    }

    public function saveFiles($fileArray)
    {
        if (empty($fileArray)) {
            return array();
        }
        // Init connection
        $this->initConnection();
        // Call custom class
        @Mage::getModel($this->getDestination()->getCustomClass())->saveFiles($fileArray);
        return array_keys($fileArray);
    }
}