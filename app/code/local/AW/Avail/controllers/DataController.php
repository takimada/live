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

class AW_Avail_DataController extends Mage_Core_Controller_Front_Action
{
    /**
     * This function gets product id, creates validation block base on 
     * AW_Avail_Model_Rules class
     * @return string
     */
    public function getdataAction()
    {
        return $this->getResponse()->setBody(
            $this
                ->_initBlock()
                ->addData(array('product_id' => Mage::app()->getRequest()->getParam('id')))
                ->validateProduct()
                ->toHtml()
        );
    }

    private function _initBlock()
    {
        return Mage::getBlockSingleton('avail/stockinfo');
    }
}