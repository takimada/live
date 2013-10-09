<?php

/**
 * @author     Berkan Düzgün <berkanduzgun@gmail.com>
 */
class Mageist_Kargolar_Block_Adminhtml_System_Config_Form_Field_Kargotrack extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract {

    protected $_carrierFieldRenderer;
    protected $_requestMethodFieldRenderer;
    protected $_popupApiFieldRenderer;

    public function __construct() {
        $this->addColumn('carrier', array(
            'label' => Mage::helper('kargolar')->__('Carrier'),
        ));
        $this->addColumn('url', array(
            'label' => Mage::helper('kargolar')->__('URL'),
            'style' => 'width:120px',
        ));
        $this->addColumn('requestMethod', array(
            'label' => Mage::helper('kargolar')->__('Request Method'),
        ));
        $this->addColumn('queryString', array(
            'label' => Mage::helper('kargolar')->__('Query String'),
            'style' => 'width:120px',
        ));
        $this->addColumn('popupApi', array(
            'label' => Mage::helper('kargolar')->__('Popup/API'),
        ));
        $this->_addAfter = false;
        //$this->_addButtonLabel = Mage::helper('sendloop')->__('Add field');
        parent::__construct();
    }

    protected function _prepareArrayRow(Varien_Object $row) {
        $row->setData(
                'option_extra_attr_' . $this->_carrierFieldRenderer->calcOptionHash(
                        $row->getData('carrier')), 'selected="selected"'
        );
        $row->setData(
                'option_extra_attr_' . $this->_popupApiFieldRenderer->calcOptionHash(
                        $row->getData('popupApi')), 'selected="selected"'
        );
        $row->setData(
                'option_extra_attr_' . $this->_requestMethodFieldRenderer->calcOptionHash(
                        $row->getData('requestMethod')), 'selected="selected"'
        );
    }

    protected function setDropdownFieldRenderers() {
        if (empty($this->_carrierFieldRenderer)) {
            $this->_carrierFieldRenderer = $this->getLayout()
                    ->createBlock('core/html_select')
                    ->setIsRenderToJsTemplate(true);
            $this->_requestMethodFieldRenderer = $this->getLayout()
                    ->createBlock('core/html_select')
                    ->setIsRenderToJsTemplate(true);
            $this->_popupApiFieldRenderer = $this->getLayout()
                    ->createBlock('core/html_select')
                    ->setIsRenderToJsTemplate(true);
        }
    }

    protected function _renderCellTemplate($columnName) {

        $this->setDropdownFieldRenderers();

        $inputName = $this->getElement()->getName() . '[#{_id}][' . $columnName . ']';

        switch ($columnName) {
            /*
            case 'carrier':
                return $this->_carrierFieldRenderer
                                ->setName($inputName)
                                ->setTitle($columnName)
                                ->setExtraParams('style="width:120px"')
                                ->setOptions(Mage::helper('kargolar')->getShippingMethodOptions())
                                ->toHtml();
                break;
             */
            case 'requestMethod':
                return $this->_requestMethodFieldRenderer
                                ->setName($inputName)
                                ->setTitle($columnName)
                                ->setExtraParams('style="width:120px"')
                                ->setOptions(
                                        array(
                                            'get' => Mage::helper('kargolar')->__('GET'),
                                            'post' => Mage::helper('kargolar')->__('POST'),
                                        )
                                )
                                ->toHtml();
                break;
            case 'popupApi':
                return $this->_popupApiFieldRenderer
                                ->setName($inputName)
                                ->setTitle($columnName)
                                ->setExtraParams('style="width:120px"')
                                ->setOptions(
                                        array(
                                            'popup' => Mage::helper('kargolar')->__('Popup'),
                                            'popupWithAlert' => Mage::helper('kargolar')->__('Popup With Alert'),
                                            'api' => Mage::helper('kargolar')->__('API')
                                        )
                                )
                                ->toHtml();
                break;
            default:
                return parent::_renderCellTemplate($columnName);
                break;
        }
    }

}