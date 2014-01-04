<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Avail
 * @version    1.2.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Avail_Block_Adminhtml_Rules_Edit_Tab_Labels_List extends Mage_Adminhtml_Block_Template
{
    const DEFAULT_LABEL_KEY      = 'default';
    const OUT_OF_STOCK_LABEL_KEY = 'out_of_stock';

    public function __construct()
    {
        $this->setTemplate('aw_avail/labels/list.phtml');
    }

    protected function _toHtml()
    {
        $ruleData = Mage::registry('aw_avail_rules_data');
        if (!$ruleData) {
            $this->setLabels($this->getDefaultLabelsData());
            return parent::_toHtml();
        }
        if (!$ruleData->getLabelsSerialized()) {
            $this->setLabels($this->getDefaultLabelsData());
            return parent::_toHtml();
        }
        $unserialized = unserialize($ruleData->getLabelsSerialized());
        $this->setLabels($unserialized);
        return parent::_toHtml();
    }

    public function getDefaultKey()
    {
        return self::DEFAULT_LABEL_KEY;
    }

    public function getOutOfStockKey()
    {
        return self::OUT_OF_STOCK_LABEL_KEY;
    }

    public function getDefaultLabelsData()
    {
        return array(
            self::DEFAULT_LABEL_KEY => array(
                'text' => '%qty% items left',
                'image' => ''
            ),
            self::OUT_OF_STOCK_LABEL_KEY => array(
                'text' => '%product% is not available now',
                'image' => ''
            )
        );
    }

    public function getInputElementByType($type = 'image', $key = 'default', $additional = array())
    {
        if (!$labels = $this->getLabels()) {
            return null;
        }

        if (!isset($labels[$key]) && !isset($additional['mock'])) {
            return null;
        }
        @$label = $labels[$key];
        $value = $type == 'image' ? $label['image'] : $label['text'];

        /* Add ext specific path to images aw_licensing/labels/ */
        if ($type == 'image' && !empty($value)) {
            $value = Mage::helper('avail')->resizeImg($value, null, 22, false);
        }
        $data = array(
            'value'   => $value,
            'html_id' => $key,
            'name'    => "labels[$key][$type]",
            'class'   => 'input-text'
        );

        /* Merge element data with custom params */
        $data = array_merge($data, $additional);

        /* Dynamic call element class text | image */
        $elemClass = "Varien_Data_Form_Element_".ucfirst($type);
       
        /* This is rewrite rule for name for elements of the same type */
        if (isset($additional['rewriteName'])) {
            $data['name'] = "labels[$key][{$additional['rewriteName']}]";
            $data['value'] = $label[$additional['rewriteName']];
        }
        $image = new $elemClass($data);
        $image->setForm(new Varien_Object());
        return $image->getElementHtml();
    }

    protected function _prepareLayout()
    {
        $this->setChild('deleteButton', $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'   => Mage::helper('avail')->__('Delete'),
                'onclick' => 'answer.del(this)',
                'class'   => 'delete'
            ))->toHtml()
        );

        $this->setChild('addButton', $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'label'   => Mage::helper('avail')->__('Add New Rule'),
                'onclick' => 'answer.add(this)',
                'class'   => 'add'
            ))->toHtml()
        );
        return parent::_prepareLayout();
    }

    public function getDefaultLabels()
    {
        return array(
            self::DEFAULT_LABEL_KEY,
            self::OUT_OF_STOCK_LABEL_KEY
        );
    }

    public function getLastIndexKey()
    {
        $keys = array_keys($this->getLabels());
        if ($key = end($keys)) {
            if (in_array($key, $this->getDefaultLabels())) {
               return 0;
            }
            return $key;
        }
        return false;
    }

    public function isDefaultLabel($key)
    {
        return in_array($key, $this->getDefaultLabels());
    }

    public function getDeleteButtonHtml()
    {
        return $this->getChildHtml('deleteButton');
    }

    public function getAddButtonHtml()
    {
        return $this->getChildHtml('addButton');
    }
}