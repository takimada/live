<?php
class Mageist_Sanalpos_Block_Info_Cc extends Mage_Payment_Block_Info_Cc
{
    protected function _construct()
    {
        parent::_construct();
    }

    /**
     * Prepare credit card related payment info
     *
     * @param Varien_Object|array $transport
     * @return Varien_Object
     */
    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        $transport = parent::_prepareSpecificInformation($transport);
        $data = array();
        $ccType = $this->getCcTypeName();
        //if ($ccType) {
        //    $data[Mage::helper('sanalpos')->__('Credit Card Type')] = $ccType;
        //}
        //if ($this->getInfo()->getCcLast4()) {
        //    $data[Mage::helper('sanalpos')->__('Credit Card Number')] = sprintf('xxxx-%s', $this->getInfo()->getCcLast4());
        //}

        $installment = $this->getInfo()->getAdditionalInformation('installment');

        $gateway = $this->getInfo()->getAdditionalInformation('gateway');

        $data[Mage::helper('sanalpos')->__('Installment')] =
            (intval($installment) <= 0) ?
                Mage::helper('sanalpos')->__('Single Installment') :
                Mage::helper('sanalpos')->__('%s Installment', intval($installment));

        $data[Mage::helper('sanalpos')->__('Gateway')] = $gateway;

        if($gateway == 'yapikredi') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Yapı Kredi';
        } elseif($gateway == 'garanti') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Garanti Bankası';
        } elseif($gateway == 'anadolubank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Anadolu Bankası';
        } elseif($gateway == 'cardplus') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Cardplus Kıbrıs';
        } elseif($gateway == 'citibank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Citibank';
        } elseif($gateway == 'denizbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Denizbank';
        } elseif($gateway == 'finansbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Finansbank';
        } elseif($gateway == 'halkbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Halkbank';
        } elseif($gateway == 'ingbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'ING Bank';
        } elseif($gateway == 'kuveytturk') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Kuveyt Turk';
        } elseif($gateway == 'vakifbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Vakıfbank';
        } elseif($gateway == 'hsbc') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'HSBC';
        } elseif($gateway == 'akbank') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Akbank';
        } elseif($gateway == 'teb') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'TEB';
        } elseif($gateway == 'isbankasi') {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'İş Bankası';
        } else {
            $data[Mage::helper('sanalpos')->__('Gateway')] = 'Diğer';
        }


        return $transport->setData(array_merge($data, $transport->getData()));
    }
}
