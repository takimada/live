<?php

/**
 * Product:       Xtento_OrderExport (1.5.5)
 * ID:            eU7gEH+h/ha3m78KAXkNw7kVeZg5IvKmLAK5E8BVIb8=
 * Packaged:      2014-09-29T17:50:22+00:00
 * Last Modified: 2014-09-03T20:57:26+02:00
 * File:          app/code/local/Xtento/OrderExport/Block/Adminhtml/Destination/Edit/Tab/Type/Email.php
 * Copyright:     Copyright (c) 2014 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

class Xtento_OrderExport_Block_Adminhtml_Destination_Edit_Tab_Type_Email
{
    // E-Mail Configuration
    public function getFields($form)
    {
        $model = Mage::registry('destination');
        // Set default values
        if (!$model->getId()) {
            $model->setEmailAttachFiles(1);
        }

        $fieldset = $form->addFieldset('config_fieldset', array(
            'legend' => Mage::helper('xtento_orderexport')->__('E-Mail Export Configuration'),
        ));

        $fieldset->addField('email_sender', 'text', array(
            'label' => Mage::helper('xtento_orderexport')->__('E-Mail From Address'),
            'name' => 'email_sender',
            'note' => Mage::helper('xtento_orderexport')->__('Enter the email address that should be set as the sender of the email. '),
            'required' => true
        ));
        $fieldset->addField('email_recipient', 'text', array(
            'label' => Mage::helper('xtento_orderexport')->__('E-Mail Recipient Address'),
            'name' => 'email_recipient',
            'note' => Mage::helper('xtento_orderexport')->__('Enter the email address where exports should be sent to. Separate multiple emails using a comma.'),
            'required' => true
        ));
        $fieldset->addField('email_subject', 'text', array(
            'label' => Mage::helper('xtento_orderexport')->__('E-Mail Subject'),
            'name' => 'email_subject',
            'note' => Mage::helper('xtento_orderexport')->__('Subject of email. Available variables: %d%, %m%, %y%, %Y%, %h%, %i%, %s%, %recordcount%, %lastexportedincrementid%, %exportid%'),
        ));
        $fieldset->addField('email_body', 'textarea', array(
            'label' => Mage::helper('xtento_orderexport')->__('E-Mail Text'),
            'name' => 'email_body',
            'note' => Mage::helper('xtento_orderexport')->__('Email text (body text). Available variables: %d%, %m%, %y%, %Y%, %h%, %i%, %s%, %exportid%, %lastexportedincrementid%, %recordcount%, %content% (%content% contains the data generated by the export)'),
        ));
        $fieldset->addField('email_attach_files', 'select', array(
            'label' => Mage::helper('xtento_orderexport')->__('Attach exported files to email'),
            'name' => 'email_attach_files',
            'values' => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
            'note' => Mage::helper('xtento_orderexport')->__('Should exported files be attached to the email sent?'),
        ));
    }
}