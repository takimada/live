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

class AW_Avail_Model_Observer extends Varien_Object
{
    /**
     * Rewrite type data info for product of specific types
     * see $this->getBlocksForProcess method
     * @param $observer
     *
     * @return $this
     */
    public function coreBlockBeforeToHtml($observer)
    {
        if (Mage::helper('core')->isModuleEnabled('AW_Mobile')
            && !Mage::helper('awmobile')->getDisabledOutput()
            && (Mage::getSingleton('customer/session')->getShowDesktop() === false
                || Mage::helper('awmobile')->getTargetPlatform() == AW_Mobile_Model_Observer::TARGET_MOBILE
            ) || Mage::helper('avail')->isDisabled()
        ) {
            return $this;
        }

        $blockClass = get_class($observer->getBlock());
        if (in_array($blockClass, $this->getBlocksForProcess())
           && !$observer->getBlock()->getProduct()->getData('aw_avail_disable')
        ) {
           $observer->getBlock()->setTemplate('aw_avail/typedata.phtml');
        }
        return $this;
    }
    
    public function getBlocksForProcess()
    {
        return array (
            'Mage_Catalog_Block_Product_View_Type_Configurable',
            'Mage_Catalog_Block_Product_View_Type_Simple',
            'Mage_Catalog_Block_Product_View_Type_Virtual',
            'Mage_Downloadable_Block_Catalog_Product_View_Type'
        );
    }
}