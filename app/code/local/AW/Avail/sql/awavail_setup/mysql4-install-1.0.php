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

$installer = $this;
$installer->startSetup();
  
$installer->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('avail/rules')} (
  `rule_id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `store_ids` text NOT NULL,
  `priority` int(10) NOT NULL,
  `conditions_serialized` mediumtext NOT NULL,
  `labels_serialized` mediumtext NOT NULL, 
   PRIMARY KEY  (`rule_id`)
)  ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO {$this->getTable('avail/rules')} (`rule_id`, `title`, `status`, `type`, `store_ids`, `priority`, `conditions_serialized`, `labels_serialized`)
 VALUES
(1, 'Sample Rule', 1, 2, '0', 1, 'a:6:{s:4:\"type\";s:28:\"avail/rule_condition_combine\";s:9:\"attribute\";N;s:8:\"operator\";N;s:5:\"value\";s:1:\"1\";s:18:\"is_value_processed\";N;s:10:\"aggregator\";s:3:\"all\";}',
 'a:8:{s:7:\"default\";a:2:{s:4:\"text\";s:16:\"%qty% items left\";s:5:\"image\";s:6:\"a4.png\";}s:12:\"out_of_stock\";a:2:{s:4:\"text\";s:30:\"%product% is not available now\";s:5:\"image\";s:6:\"a1.png\";}i:1;a:3:{s:3:\"qty\";s:2:\"10\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:6:\"a2.png\";}i:2;a:3:{s:3:\"qty\";s:2:\"20\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:8:\"a2_2.png\";}i:3;a:3:{s:3:\"qty\";s:2:\"30\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:6:\"a3.png\";}i:4;a:3:{s:3:\"qty\";s:2:\"40\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:8:\"a3_2.png\";}i:5;a:3:{s:3:\"qty\";s:2:\"50\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:16:\"1122672035a4.png\";}i:6;a:3:{s:3:\"qty\";s:2:\"60\";s:4:\"text\";s:0:\"\";s:5:\"image\";s:6:\"a5.png\";}}');
 ");
$installer->endSetup();