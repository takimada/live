<?php
class Mageist_Sanalpos_Block_Adminhtml_Gateway_Grid extends Mage_Adminhtml_Block_Widget_Grid
{   
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('gateGrid');
        // This is the primary key of the database
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('sanalpos/gateway')->getCollection()
            ->addFieldToSelect('id')
            ->addFieldToSelect('gateway_type')
            ->addFieldToSelect('gateway_name')
            ->addFieldToSelect('is_active_gateway');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
 
        $this->addColumn('gateway_name', array(
            'header'    => Mage::helper('sanalpos')->__('Gateway Name'),
            'align'     =>'left',
            'index'     => 'gateway_name',
        ));
 
        $this->addColumn('is_active_gateway', array(
            'header'    => Mage::helper('sanalpos')->__('Is Active'),
            'align'     =>'left',
            'index'     => 'is_active_gateway',
            'width'     => '50',
            'renderer'  => 'Mageist_Sanalpos_Block_Adminhtml_Renderer_Yesno',
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