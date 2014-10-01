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
 * @version    1.2.4
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Avail_Helper_Data extends Mage_Core_Helper_Abstract
{
    const RESIZED_IMAGES_FOLDER = 'resized';
    const IMAGE_WIDTH = 200;
    const IMAGE_HEIGHT = 20;
    const CATALOG_PRODUCT_ATTRIBUTE_CODE = "aw_avail_disable";

    /**
     *
     * Get filesystem path to extension media dir
     * @param bool $fullPath
     * @param null|bool $params
     * @param bool $media
     * @return string 
     * 
     */
    public static function getImgDir($fullPath = true, $params = null, $media = true)
    {
        if (!$media) {
            return 'aw_avail' . DS . 'labels' . DS . $params;
        }
        if (!$fullPath) {
            return Mage::getBaseDir('media') . DS;
        }
        $path = Mage::getBaseDir('media') . DS . 'aw_avail' . DS . 'labels' . DS;
        if ($params) {
            $path .= $params;
        }
        return $path;
    }

    /**
     * Get URL path to stock label
     * @param string $route
     * @return string
     * 
     */
    public static function getImgUrl($route)
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "aw_avail/labels/{$route}";
    }

    public function isDisabled()
    {
        return (bool)Mage::getStoreConfig('advanced/modules_disable_output/AW_Avail');
    }

    public function resizeImg($fileName, $width = self::IMAGE_WIDTH, $height = self::IMAGE_HEIGHT, $aspectRadio = true)
    {
        $baseImagePath = $this->getImgDir(true) . DS . $fileName;
        $resizedImageFolder = self::RESIZED_IMAGES_FOLDER . DS . $width . "_" . $height;
        $resizedImagePath = $this->getImgDir(true) . $resizedImageFolder . DS . $fileName;
        if (file_exists($baseImagePath) && !file_exists($resizedImagePath) && $baseImagePath) {
            $imageProcessor =  new Varien_Image($baseImagePath);
            $imageProcessor->constrainOnly(false);
            $imageProcessor->keepAspectRatio($aspectRadio);
            $imageProcessor->keepFrame(true);
            $imageProcessor->keepTransparency(true);
            $imageProcessor->backgroundColor(array(255, 255, 255));
            $imageProcessor->quality(90);
            $imageProcessor->resize($width, $height);
            $imageProcessor->save($resizedImagePath);
        }
        return $this->getImgUrl($resizedImageFolder . DS . $fileName);
    }
}