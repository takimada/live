<?php
class Mageist_Sanalpos_Block_Adminhtml_Logger_Grid extends Mage_Adminhtml_Block_Widget_Grid
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('loggerGrid');
        // This is the primary key of the database
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sanalpos/logger')->getCollection()
            ->addFieldToSelect('id')
            ->addFieldToSelect('gateway_type')
            ->addFieldToSelect('gateway_name')
            ->addFieldToSelect('status')
            ->addFieldToSelect('order_id')
            ->addFieldToSelect('message')
            ->addFieldToSelect('real_order_id')
            ->addFieldToSelect('created_at');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {

        $this->addColumn('gateway_name', array(
            'header'    => Mage::helper('sanalpos')->__('Gateway Name'),
            'align'     =>'left',
            'index'     => 'gateway_name',
            'width' => '100px',
        ));
        $this->addColumn('order_id', array(
            'header'    => Mage::helper('sanalpos')->__('Order ID'),
            'align'     =>'left',
            'index'     => 'order_id',
            'width' => '100px',
        ));
        $this->addColumn('status', array(
            'header'    => Mage::helper('sanalpos')->__('Status'),
            'align'     =>'left',
            'index'     => 'status',
            'width' => '100px',
        ));
        $this->addColumn('message', array(
            'header'    => Mage::helper('sanalpos')->__('Message'),
            'align'     =>'left',
            'index'     => 'message',
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('sanalpos')->__('Created At'),
            'align'     =>'right',
            'type' => 'datetime',
            'width' => '100px',
            'index'     => 'created_at',
        ));

        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId(), 'type' => $row->getType()));
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}