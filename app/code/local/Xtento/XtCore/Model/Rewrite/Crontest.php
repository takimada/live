<?php

/**
 * Product:       Xtento_XtCore (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2014-03-16T15:32:05+01:00
 * File:          app/code/local/Xtento/XtCore/Model/Rewrite/Crontest.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_XtCore_Model_Rewrite_Crontest extends TBT_Testsweet_Model_Observer_Crontest
{
    /*
     * After doing the crontest, the SweetTooth testweet module reinit()s the Magento config, causing issues if the Magento configuration was adjusted in realtime. The timestamp saving now happens in the Xtento_XtCore_Model_Observer_Event class.
     */
    public function run()
    {
        if (Mage::helper('xtcore')->hasModuleWithCustomCronConfig()) {
            // Only rewrite this function if a XTENTO extension is installed which uses the custom cron_config method to add cronjobs dynamically
            return $this;
        } else {
            return parent::run();
        }
    }
}