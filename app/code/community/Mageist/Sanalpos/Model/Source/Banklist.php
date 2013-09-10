<?php
class Mageist_Sanalpos_Model_Source_Banklist extends Varien_Object
{
  public function toOptionArray()
  {
      $gateways = Mage::getModel('sanalpos/gateway')->getCollection()
            ->addFieldToSelect('gateway_code')
            ->addFieldToSelect('gateway_name');
      $returnArray = array();
      $returnArray[] = array('value' => '', 'label' =>'');
      foreach ($gateways as $gateway) {
          $returnArray[] = array('value' => $gateway->getGatewayCode(), 'label' => $gateway->getGatewayName());
      }
      
      return $returnArray;
  }
}
