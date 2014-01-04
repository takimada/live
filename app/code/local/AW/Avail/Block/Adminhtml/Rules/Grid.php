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

class AW_Avail_Block_Adminhtml_Rules_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('rule_id');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {        
        $collection = Mage::getModel('avail/rules')->getCollection();       
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('rule_id');
        $this->getMassactionBlock()->setFormFieldName('rule_id');
        $this->getMassactionBlock()->addItem('delete', array(
            'label'    => Mage::helper('avail')->__('Delete'),
            'url'      => $this->getUrl('*/*/massDelete'),
            'confirm'  => Mage::helper('avail')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label'=> Mage::helper('avail')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name'   => 'status',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('avail')->__('Status'),
                    'values' => array(
                        '1' => Mage::helper('avail')->__('Active'),
                        '0' => Mage::helper('avail')->__('Inactive')
                    )
                )
            )
        ));
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('rule_id', array(
            'header'    => Mage::helper('avail')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'rule_id',
        ));

        $this->addColumn('title', array(
            'header'    => Mage::helper('avail')->__('Name'),
            'align'     =>'left',
            'index'     => 'title',
        ));
      
        $this->addColumn('type', array(
            'header'    => Mage::helper('avail')->__('Type'),
            'align'     =>'left',
            'index'     => 'type',
            'sortable' => false,
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('avail')->__('Text only'),
                1 => Mage::helper('avail')->__('Text and image'),
                2 => Mage::helper('avail')->__('Image only')
            )         
        ));
        
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_ids', array(
                'header' => Mage::helper('avail')->__('Store View'),
                'index' => 'store_ids',
                'type' => 'store',
                'store_all' => true,
                'store_view' => true,
                'sortable' => false,
                'filter_condition_callback' => array($this, 'filterStore'),
            ));
        }
        
		$this->addColumn('status', array(
            'header'    => Mage::helper('avail')->__('Status'),
            'align'     =>'left',
			'width'     => '100px',
            'index'     => 'status',
			'type'      => 'options',
            'options'   => array(
                '1' => Mage::helper('avail')->__('Active'),
                '0' => Mage::helper('avail')->__('Inactive')
            ),
        ));

        $this->addColumn('priority', array(
            'header'    => Mage::helper('avail')->__('Priority'),
            'align'     =>'left',
            'width'     => '100px',
            'index'     => 'priority',
        ));

        $this->addColumn('action', array(
            'header'    =>  Mage::helper('avail')->__('Action'),
            'width'     => '100',
            'type'      => 'action',
            'getter'    => 'getRuleId',
            'actions'   => array(
                array(
                    'caption' => Mage::helper('avail')->__('Edit'),
                    'url'     => array('base'=> '*/*/edit'),
                    'field'   => 'id'
                ),
                array(
                    'caption' => Mage::helper('avail')->__('Delete'),
                    'url'     => array('base'=> '*/*/delete'),
                    'confirm' => Mage::helper('avail')->__('Are you sure?'),
                    'field'   => 'id'
                )
            ),
            'filter'    => false,
            'sortable'  => false,
            'index'     => 'stores',
            'is_system' => true,
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getRuleId()));
    }

    protected function filterStore($collection, $column)
    {
        $val = $column->getFilter()->getValue();
        if ($val) {
            $condition = "FIND_IN_SET('$val', {$column->getIndex()}) OR FIND_IN_SET('0', {$column->getIndex()})";
            $collection->getSelect()->where($condition);
        }
        return $this;
    }
}