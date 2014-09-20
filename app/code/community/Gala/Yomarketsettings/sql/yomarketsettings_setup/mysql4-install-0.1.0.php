<?php
$pathFile = Mage::getBaseDir('var').DS.'install_galayomarket_sampledata.txt';
if(file_exists($pathFile)){
    echo 'Installing sample data for galayomarket, please come back in some minutes ...';
    exit;
}
$installer = $this;

$installer->startSetup();


####################################################################################################
# ADD THEMEFRAMEWORK LAYOUT
####################################################################################################

$model = Mage::getModel('themeframework/area');

/*1. default store */	
$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '1column',	
	'is_active'      => 1,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:10:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:5:{i:0;s:11:"breadcrumbs";i:1;s:15:"global_messages";i:2;s:6:"area12";i:3;s:7:"content";i:4;s:6:"area13";}}i:6;s:5:"clear";i:7;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area04";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area04";}}i:8;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:0:"";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area05";}}i:9;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:12:"em-tabgroups";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area06";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area06";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:15:"em-listproducts";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area07";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area07";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-left',	
	'is_active'      => 1,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:8:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"19";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"19";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:7;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:12:"em-tabgroups";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area06";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area06";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:15:"em-listproducts";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area07";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area07";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-right',	
	'is_active'      => 1,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:8:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area04";i:3;s:6:"area17";}}i:7;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:12:"em-tabgroups";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area06";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area06";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:15:"em-listproducts";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area07";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area07";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();


$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '3columns',	
	'is_active'      => 1,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:9:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"14";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"14";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:7;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:3:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area17";}}i:8;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:12:"em-tabgroups";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area06";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area06";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:15:"em-listproducts";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area07";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area07";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

/*2. simple store */	
$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '1column',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:7:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:10:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:5:{i:0;s:11:"breadcrumbs";i:1;s:15:"global_messages";i:2;s:6:"area12";i:3;s:7:"content";i:4;s:6:"area13";}}i:6;s:5:"clear";i:7;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area04";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area04";}}i:8;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:0:"";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area05";}}i:9;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-left',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:7:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:8:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"19";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"19";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:7;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-right',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:7:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:8:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area04";i:3;s:6:"area17";}}i:7;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();


$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '3columns',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:7:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:9:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:2:"14";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:16:"em-mainslideshow";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}i:4;s:5:"clear";i:5;a:11:{s:6:"column";s:2:"14";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:6;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"14";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:7;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:3:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area17";}}i:8;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:3;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

/*2. style2 store */	
$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '1column',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style2";s:10:"inner_html";s:44:"<div class="custom-style2">{{content}}</div>";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:3:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:2:"14";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style2";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:6:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:5:{i:0;s:11:"breadcrumbs";i:1;s:15:"global_messages";i:2;s:6:"area12";i:3;s:7:"content";i:4;s:6:"area13";}}i:2;s:5:"clear";i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area04";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area04";}}i:4;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:0:"";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area05";}}i:5;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-left',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style2";s:10:"inner_html";s:44:"<div class="custom-style2">{{content}}</div>";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:3:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:2:"14";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style2";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"19";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:3;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-right',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style2";s:10:"inner_html";s:44:"<div class="custom-style2">{{content}}</div>";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:3:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:2:"14";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style2";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area04";i:3;s:6:"area17";}}i:3;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();


$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '3columns',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style2";s:10:"inner_html";s:44:"<div class="custom-style2">{{content}}</div>";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:3:{i:0;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area01";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area01";}}i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:2:"14";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area03";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area03";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style2";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:5:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"14";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"14";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:3:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area17";}}i:4;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

/*2. style3 store */	
$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '1column',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}i:1;s:5:"clear";}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:6:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:5:{i:0;s:11:"breadcrumbs";i:1;s:15:"global_messages";i:2;s:6:"area12";i:3;s:7:"content";i:4;s:6:"area13";}}i:2;s:5:"clear";i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area04";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area04";}}i:4;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:0:"";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area05";}}i:5;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-left',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:1:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"19";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:3;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '2columns-right',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:1:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"19";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area04";i:3;s:6:"area17";}}i:3;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();


$data = array(
	'package_theme'  => 'default/galayomarket',
	'layout'         => '3columns',	
	'is_active'      => 0,
	'content_decode' => unserialize(<<<EOB
a:9:{i:0;a:6:{s:10:"custom_css";s:9:"em-header";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:6:"header";}}i:1;a:6:{s:10:"custom_css";s:14:"em-main style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:1:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area02";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area02";}}}}i:2;a:6:{s:10:"custom_css";s:23:"em-mainslideshow-style3";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:13:"mainslideshow";}}i:3;a:6:{s:10:"custom_css";s:7:"em-main";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:5:{i:0;s:5:"clear";i:1;a:11:{s:6:"column";s:2:"14";s:4:"push";s:1:"5";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-main";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:6:{i:0;s:11:"breadcrumbs";i:1;s:6:"area12";i:2;s:15:"global_messages";i:3;s:7:"content";i:4;s:6:"area05";i:5;s:6:"area13";}}i:2;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:2:"14";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:8:"col-left";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:4:{i:0;s:6:"area14";i:1;s:4:"left";i:2;s:6:"area04";i:3;s:6:"area15";}}i:3;a:11:{s:6:"column";s:1:"5";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"col-right";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:3:{i:0;s:6:"area16";i:1;s:5:"right";i:2;s:6:"area17";}}i:4;s:5:"clear";}}i:4;a:6:{s:10:"custom_css";s:14:"em-footerbrand";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area08";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area08";}}i:1;s:5:"clear";}}i:5;a:6:{s:10:"custom_css";s:13:"em-footernews";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area09";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area09";}}i:1;s:5:"clear";}}i:6;a:6:{s:10:"custom_css";s:13:"em-footerinfo";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:2:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area10";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area10";}}i:1;s:5:"clear";}}i:7;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:12:"container_24";s:5:"items";a:4:{i:0;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-area11";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"area11";}}i:1;s:5:"clear";i:2;a:11:{s:6:"column";s:2:"24";s:4:"push";s:0:"";s:4:"pull";s:0:"";s:6:"prefix";s:0:"";s:6:"suffix";s:0:"";s:5:"first";b:0;s:4:"last";b:0;s:10:"custom_css";s:9:"em-footer";s:10:"inner_html";s:0:"";s:13:"display_empty";b:0;s:5:"items";a:1:{i:0;s:6:"footer";}}i:3;s:5:"clear";}}i:8;a:6:{s:10:"custom_css";s:12:"em-footerend";s:10:"inner_html";s:0:"";s:10:"outer_html";s:0:"";s:13:"display_empty";b:0;s:4:"type";s:14:"container_free";s:5:"items";a:1:{i:0;s:15:"before_body_end";}}}
EOB
	)
);
$model->setData($data)->setStores(array(0))->save();

####################################################################################################
# INSERT STATIC BLOCKS
####################################################################################################
$helper = Mage::helper('yomarketsettings');
$block = Mage::getModel('cms/block');
$stores = array(0);
$prefixBlock = 'galayomarket_';

//1. Gala YoMarket Area04 Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Area04 Banner',
	'identifier' => $prefixBlock.'area04_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p><a title="hot deals of week" href="#"><img class="fluid" src="{{media url="wysiwyg/home_banner_01.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area04_banner'] = $block->getId();


// 2. Gala YoMarket Area06 Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Area06 Banner',
	'identifier' => $prefixBlock.'area06_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p><a title="fashion" href="#"><img class="fluid" src="{{media url="wysiwyg/home_banner_02.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area06_banner'] = $block->getId();

//3. Gala YoMarket Area06 Tab01
$dataBlock = array(
	'title' => 'Gala YoMarket Area06 Tab01',
	'identifier' => $prefixBlock.'area06_tab01',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_24 alpha omega">
<div class="grid_12 alpha"><a><img class="fluid" src="{{media url='wysiwyg/home_banner_03.png'}}" alt="" /></a></div>
<div class="grid_12 omega">
<div class="grid_12 alpha omega">{{widget type="newproducts/list" limit_count="3" order_by="name asc" item_width="150" item_spacing="20" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_new_products/new_grid.phtml"}}</div>
<div class="grid_11 alpha omega" style="margin-bottom: 15px; padding: 0 10px;">
<h1 style="font: bold 32px/1.15 helvetica,arial,sans-serif; color: #15aecc; margin-bottom: 0;">IPOD TOUCH</h1>
<p style="font: bold 18px/1.35 arial,helvetica,sans-serif; color: #121212; margin-bottom: 0;">Nullam convallis faucibus feugiat</p>
<p style="font: 12px/1.35 Arial, Helvetica, sans-serif; color: #686868;">Quisque iaculis congue nulla sed sagittis massa non urna molestie elementum. Etiam sed dui turpiis massa lorem ispums lorem ispum sed</p>
</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area06_tab01'] = $block->getId();

// 4. Gala YoMarket Area06 Tab02
$dataBlock = array(
	'title' => 'Gala YoMarket Area06 Tab02',
	'identifier' => $prefixBlock.'area06_tab02',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_24 alpha omega">
<div class="grid_12 alpha"><a><img class="fluid" src="{{media url='wysiwyg/home_banner_04.png'}}" alt="" /></a></div>
<div class="grid_12 omega">
<div class="grid_12 alpha omega">{{widget type="newproducts/list" limit_count="3" order_by="name asc" item_width="150" item_spacing="20" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_new_products/new_grid.phtml"}}</div>
<div class="grid_11 alpha omega" style="margin-bottom: 15px; padding: 0 10px;">
<h1 style="font: bold 32px/1.15 helvetica,arial,sans-serif; color: #63666d; margin-bottom: 0;">MACBOOK</h1>
<p style="font: bold 18px/1.35 arial,helvetica,sans-serif; color: #121212; margin-bottom: 0;">Fusce non massa non urna molestie</p>
<p style="font: 12px/1.35 Arial, Helvetica, sans-serif; color: #686868;">Quisque iaculis congue nulla sed sagittis massa non urna molestie elementum. Etiam sed dui turpis. Nullam convallis faucibus urna molestie elementu</p>
</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area06_tab02'] = $block->getId();

// 5. Gala YoMarket Area06 Tab03
$dataBlock = array(
	'title' => 'Gala YoMarket Area06 Tab03',
	'identifier' => $prefixBlock.'area06_tab03',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_24 alpha omega">
<div class="grid_12 alpha"><a><img class="fluid" src="{{media url='wysiwyg/home_banner_05_tab.png'}}" alt="" /></a></div>
<div class="grid_12 omega">
<div class="grid_11 alpha omega" style="margin-top: 20px; padding: 0 10px;">
<h1 style="font: bold 32px/1.15 helvetica,arial,sans-serif; color: #cf282b; margin-bottom: 0;">PELLENTESQUE</h1>
<p style="font: bold 20px/1.35 arial,helvetica,sans-serif; color: #121212; margin-bottom: 0;">Quisque iaculis congue sagittis nulla</p>
<p style="font: 12px/1.35 Arial, Helvetica, sans-serif; color: #686868;">Quisque iaculis congue nulla sed sagittis massa non urna molestie elementum. Etiam sed dui turpis. Nullam convallis faucibus urna molestie elementu</p>
</div>
<div class="grid_12 alpha omega">{{widget type="newproducts/list" limit_count="2" order_by="name asc" item_width="180" item_spacing="30" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_new_products/new_grid.phtml"}}</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area06_tab03'] = $block->getId();


// 6. Gala YoMarket Area06 Tab04
$dataBlock = array(
	'title' => 'Gala YoMarket Area06 Tab04',
	'identifier' => $prefixBlock.'area06_tab04',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_24 alpha omega">
<div class="grid_12 alpha"><a><img class="fluid" src="{{media url='wysiwyg/home_banner_06.png'}}" alt="" /></a></div>
<div class="grid_12 omega">
<div class="grid_11 alpha omega" style="margin-top: 20px; padding: 0 10px;">
<h1 style="font: bold 32px/1.15 helvetica,arial,sans-serif; color: #a4a4a4; margin-bottom: 0;">CRAS ULTRICIES</h1>
<p style="font: bold 20px/1.35 arial,helvetica,sans-serif; color: #121212; margin-bottom: 0;">Quisque iaculis congue sagittis nulla</p>
<p style="font: 12px/1.35 Arial, Helvetica, sans-serif; color: #686868;">Quisque iaculis congue nulla sed sagittis massa non urna molestie elementum. Etiam sed dui turpis. Nullam convallis faucibus urna molestie elementu</p>
</div>
<div class="grid_12 alpha omega">{{widget type="newproducts/list" limit_count="4" order_by="name asc" item_width="120" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_new_products/new_grid.phtml"}}</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area06_tab04'] = $block->getId();

// 7. Gala YoMarket Area07 Bestseller
$dataBlock = array(
	'title' => 'Gala YoMarket Area07 Bestseller',
	'identifier' => $prefixBlock.'area07_bestseller',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_5 alpha"><span class="h3">BEST SELLERS</span>
<div class="box" style="border-color: #ebabbf;">{{widget type="bestsellerproducts/list" order_by="name asc" limit_count="10" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_bestseller_products/bestseller_grid_slider.phtml"}}<br />
<p><a class="viewmore small" href="#">View more</a></p>
</div>
</div>
<div class="grid_19 omega">
<div class="grid_14 alpha"><span class="h3" style="color: #df4c79;">FOR WOMEN</span>
<div class="box" style="border-top: 2px solid #df4c79;">
<div class="grid_5 alpha omega"><a title="" href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_08.jpg'}}" alt="" /></a></div>
<div class="grid_9 omega">{{widget type="saleproducts/list" new_category="3" order_by="name asc" limit_count="100" thumbnail_width="100" thumbnail_height="100" show_product_name="true" show_thumbnail="true" show_description="false" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_grid_custom.phtml"}}</div>
</div>
</div>
<div class="grid_5 omega"><span class="h3" style="color: #df4c79;">FOR BABY</span>
<div class="box">{{widget type="saleproducts/list" new_category="3" order_by="name asc" limit_count="100" custom_class="custom-sale" thumbnail_width="80" thumbnail_height="80" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_list_custom.phtml"}}</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area07_bestseller'] = $block->getId();

// 8. Gala YoMarket Area07 Hot Products
$dataBlock = array(
	'title' => 'Gala YoMarket Area07 Hot Products',
	'identifier' => $prefixBlock.'area07_hotproducts',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_5 alpha"><span class="h3">HOT PRODUCTS</span>
<div class="box" style="border-color: #98bed4;">{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Hot" limit_count="10" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_featured_products/featured_grid_slider.phtml"}}<br />
<p><a class="viewmore small" href="#">View more</a></p>
</div>
</div>
<div class="grid_19 omega">
<div class="grid_14 alpha"><span class="h3" style="color: #0d76b1;">FOR MEN</span>
<div class="box" style="border-top: 2px solid #4397c9;">
<div class="grid_5 alpha omega"><a href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_09.jpg'}}" alt="" /></a></div>
<div class="grid_9 omega">{{widget type="saleproducts/list" new_category="3" order_by="name asc" limit_count="100" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_grid_custom.phtml"}}</div>
</div>
</div>
<div class="grid_5 omega"><span class="h3" style="color: #0d76b1;">SHOES</span>
<div class="box">{{widget type="saleproducts/list" new_category="3" order_by="name asc" limit_count="100" custom_class="custom-sale" thumbnail_width="90" thumbnail_height="90" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_list_custom.phtml"}}</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area07_hotproducts'] = $block->getId();

// 9. Gala YoMarket Area07 Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Area07 Banner',
	'identifier' => $prefixBlock.'area07_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p><a title="egestas" href="#"><img class="fluid" src="{{media url="wysiwyg/home_banner_05.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area07_banner'] = $block->getId();

// 10. Gala YoMarket Area07 Most Popular
$dataBlock = array(
	'title' => 'Gala YoMarket Area07 Most Popular',
	'identifier' => $prefixBlock.'area07_most_popular',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_5 alpha"><span class="h3">MOST POPULAR</span>
<div class="box" style="border-color: #b6b6b6;">{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Deal" limit_count="10" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="true" choose_template="em_featured_products/featured_grid_slider.phtml"}}<br />
<p><a class="viewmore small" href="#">View more</a></p>
</div>
</div>
<div class="grid_19 omega">
<div class="grid_14 alpha"><span class="h3">SMARTPHONE</span>
<div class="box" style="border-top: 2px solid #898989;">
<div class="grid_5 alpha omega"><a title="" href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_10.jpg'}}" alt="" /></a></div>
<div class="grid_9 omega">{{widget type="saleproducts/list" new_category="3" order_by="name asc" limit_count="100" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="false" show_price="false" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_grid_custom.phtml"}}</div>
</div>
</div>
<div class="grid_5 omega"><span class="h3">LAPTOP &amp; COMPUTER</span>
<div class="box">{{widget type="saleproducts/list" order_by="name asc" limit_count="10" custom_class="custom-sale" thumbnail_width="90" thumbnail_height="90" show_product_name="true" show_thumbnail="true" show_description="false" show_price="true" show_reviews="false" show_addtocart="false" show_addto="false" show_label="false" choose_template="em_sale_products/sale_list_custom.phtml"}}</div>
</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area07_most_popular'] = $block->getId();

// 11. Gala YoMarket Area07 Banner02
$dataBlock = array(
	'title' => 'Gala YoMarket Area08 Banner',
	'identifier' => $prefixBlock.'area08_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p><a title="free shipping" href="#"><img class="fluid" src="{{media url="wysiwyg/home_banner_07.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area07_banner02'] = $block->getId();

// 12. Gala YoMarket Area08 Brand
$dataBlock = array(
	'title' => 'Gala YoMarket Area08 Brand',
	'identifier' => $prefixBlock.'area08_brand',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="horizontal carousel flexslider">
<ul id="footer-brand" class="slides">
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
<li class="itemslider"><a href="#"><img title="logo brand" src="{{skin url="images/media/slideshow/brand.jpg"}}" alt="" /></a></li>
</ul>
</div>
<script type="text/javascript">// <![CDATA[
jQuery(window).load(function(){
	if(jQuery('#footer-brand').length){
jQuery('#footer-brand').parent().csslider();
	} 
});
// ]]></script>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area08_brand'] = $block->getId();

// 13. Gala YoMarket Area09 News
$dataBlock = array(
	'title' => 'Gala YoMarket Area09 News',
	'identifier' => $prefixBlock.'area09_news',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div><span class="h5">LOREM IPSUM DOLOR</span>
<div class="grid_8 alpha hide-lte0"><a href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_11.jpg'}}" alt="" /></a></div>
<div class="grid_8 hide-lte0"><a href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_12.jpg'}}" alt="" /></a></div>
<div class="grid_8 omega hide-lte0"><a href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_13.jpg'}}" alt="" /></a></div>
<div class="clear">&nbsp;</div>
<div class="grid_16 alpha hide-lte0"><a href="#"><img class="fluid" src="{{media url='wysiwyg/home_banner_14.jpg'}}" alt="" /></a></div>
<div class="grid_8 omega">{{block type="newsletter/subscribe" name="footer.newsletter" template="newsletter/subscribe.phtml"}}</div>
<div class="clear">&nbsp;</div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area09_news'] = $block->getId();

// 14. Gala YoMarket Area10 Information
$dataBlock = array(
	'title' => 'Gala YoMarket Area10 Information',
	'identifier' => $prefixBlock.'area10_information',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_6 alpha small hide-lte0">
<p class="h5">LATEST NEW</p>
<ul class="none">
<li><a href="#">Consectetur adipiscing</a></li>
<li><a href="#">Mauris tincidunt </a></li>
<li><a href="#">Suspendisse lorem</a></li>
<li><a href="#">Vivamus quam</a></li>
<li><a href="#">Nam fermentum eros</a></li>
<li><a href="#">Elementum vel </a></li>
</ul>
</div>
<div class="grid_6 small">
<p class="h5">INFORMATION</p>
<ul class="none">
<li><a href="{{store direct_url='about-magento-demo-store'}}">About Us</a></li>
<li><a href="{{store direct_url='contacts'}}">Contact Us</a></li>
<li><a href="{{store direct_url='customer-service'}}">Customer Service</a></li>
<li><a href="{{store direct_url='catalog/seo_sitemap/category/'}}">Site Map</a></li>
<li><a href="{{store direct_url='catalogsearch/term/popular/'}}">Search Term</a></li>
<li><a href="{{store direct_url='catalogsearch/advanced/'}}">Advanced Search</a></li>
</ul>
</div>
<div class="grid_6 small">
<p class="h5">SERVICE &amp; SUPPORT</p>
<ul class="none">
<li><a href="#">Help &amp; FAQs</a></li>
<li><a href="#">Call Center</a></li>
<li><a href="#">Gift Cards</a></li>
<li><a href="#">California Sales Information</a></li>
<li><a href="#">Shop by Brand</a></li>
<li><a href="#">Hard to Find Parts</a></li>
<li><a href="#">Report a Bug on This Page</a></li>
</ul>
</div>
<div class="grid_6 omega small">
<p class="h5">ABOUT STORE</p>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
<p>{{config path="general/store_information/address"}}</p>
<p>Tel: {{config path="general/store_information/phone"}}</p>
<p>Email: {{config path="trans_email/ident_general/email"}}</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area10_information'] = $block->getId();

// 15. Gala YoMarket Area11 Payment Social
$dataBlock = array(
	'title' => 'Gala YoMarket Area11 Payment Social',
	'identifier' => $prefixBlock.'area11_payment_social',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="grid_12 alpha">
<p class="h5">PAYMENT METHOD</p>
<p><span class="custom-logo paymentmethods">Paypal - Visa - American Express - MasterCard - Skrill</span></p>
</div>
<div class="grid_12 omega">
<p class="h5">FOLLOW US ON</p>
<p><a title="Facebook" href="#"><span class="icon followus facebook">Facebook</span></a> <a title="Twitter" href="#"><span class="icon followus twitter">Twitter</span></a> <a title="Vimeo" href="#"><span class="icon followus vimeo">Vimeo</span></a> <a title="Feed" href="#"><span class="icon followus feed">Feed</span></a></p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area11_payment_social'] = $block->getId();

// 16. Gala YoMarket Left Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Left Banner',
	'identifier' => $prefixBlock.'left_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p><a title="new" href="#"><img class="fluid" src="{{media url="wysiwyg/left_banner.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['left_banner'] = $block->getId();

// 17. Gala YoMarket Checkout Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Checkout Banner',
	'identifier' => $prefixBlock.'checkout_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p class="box"><a title="banner" href="#"><img class="fluid" src="{{media url="wysiwyg/checkout_banner.jpg"}}" alt="" /></a></p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['checkout_banner'] = $block->getId();

// 19. Gala YoMarket Login Left Banner
$dataBlock = array(
	'title' => 'Gala YoMarket Login Left Banner',
	'identifier' => $prefixBlock.'login_left_banner',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="block block-login">
<div class="block-title"><strong><span>Account Protection</span></strong></div>
<div class="block-content box">
<p>Your account are being Protected</p>
<a href="#"><img src="{{media url='wysiwyg/login_banner.jpg'}}" alt="" /></a></div>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['login_left_banner'] = $block->getId();


// 20. Gala YoMarket Product Collateral Sample
$dataBlock = array(
	'title' => 'Gala YoMarket Product Collateral Sample',
	'identifier' => $prefixBlock.'product_collateral_sample',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<p>A sample of additional collateral tabs that you can insert as a widget in static the backend.</p>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['product_collateral_sample'] = $block->getId();

// 21. Gala YoMarket Area12 Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Area12 Sample Block',
	'identifier' => $prefixBlock.'area12_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position EM Area 12. You can add your own content by insert widget into position EM Area 12</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area12_sample_block'] = $block->getId();

// 22. Gala YoMarket Area13 Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Area13 Sample Block',
	'identifier' => $prefixBlock.'area13_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position EM Area 13. You can add your own content by insert widget into position EM Area 13</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area13_sample_block'] = $block->getId();

// 23. Gala YoMarket Area14 Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Area14 Sample Block',
	'identifier' => $prefixBlock.'area14_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position EM Area 14. You can add your own content by insert widget into position EM Area 14</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area14_sample_block'] = $block->getId();

// 24. Gala YoMarket Area15 Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Area15 Sample Block',
	'identifier' => $prefixBlock.'area15_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position EM Area 15. You can add your own content by insert widget into position EM Area 15</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['area15_sample_block'] = $block->getId();


// 25. Gala YoMarket Details Alert Url Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Details Alert Url Sample Block',
	'identifier' => $prefixBlock.'details_alert_url_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position Alert Urls. You can add your own content by insert widget into position Alert Urls.</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['details_alert_url_sample_block'] = $block->getId();

// 26. Gala YoMarket Details Extra Hint Sample Block
$dataBlock = array(
	'title' => 'Gala YoMarket Details Extra Hint Sample Block',
	'identifier' => $prefixBlock.'details_extra_hint_sample_block',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position Extra Hint. You can add your own content by insert widget into position Extra Hint</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['details_extra_hint_sample_block'] = $block->getId();


// 27. Gala YoMarket Detais Product View Short Description After
$dataBlock = array(
	'title' => 'Gala YoMarket Detais Product View Short Description After',
	'identifier' => $prefixBlock.'details_product_view_short_description_after',
	'stores' => $stores,
	'is_active' => 1,
	'content'	=> <<<EOB
<div class="box" style="background-color: #f8fcc5;">
<p>Sample Block Here ...</p>
<p>This is a sample content in position Product View Short Description After. You can add your own content by insert widget into position Product View Short Description After.</p>
</div>
EOB
);
$block = $helper->insertStaticBlock($dataBlock);
$block_id['details_product_view_short_description_after'] = $block->getId();

####################################################################################################
# INSERT PAGE
####################################################################################################
 
$prefixPage = 'galayomarket_';
$page = Mage::getModel('cms/page');

// Home
$dataPage = array(
	'title'				=> 'Gala YoMarket Magento Theme - Home page',
	'identifier' 		=> $prefixPage.'home',
	'stores'			=> $stores,
	'content_heading'	=> '',
	'root_template'		=> 'one_column',
	'content'			=> <<<EOB
<p>&nbsp;</p>
EOB
);
$helper->insertPage($dataPage);

// Typography
$dataPage = array(
	'title'				=> 'Gala YoMarket Typography',
	'identifier' 		=> 'typography',
	'stores'			=> $stores,
	'content_heading'	=> 'Gala YoMarket Typography',
	'root_template'		=> 'one_column',
	'content'			=> <<<EOB
<h2>General Elements</h2>
<h1>Heading 1</h1>
<h2>Heading 2</h2>
<h3>Heading 3</h3>
<h4>Heading 4</h4>
<h5>Heading 5</h5>
<ul>
<li>Bullet List 1</li>
<ul>
<li>Bullet List 1.1</li>
<li>Bullet List 1.2</li>
<li>Bullet List 1.3</li>
<li>Bullet List 1.4</li>
</ul>
<li>Bullet List 2</li>
<li>Bullet List 3</li>
<li>Bullet List 4</li>
</ul>
<ol>
<li>Number List 1</li>
<ol>
<li>Number List 1.1</li>
<li>Number List 1.2</li>
<li>Number List 1.3</li>
<li>Number List 1.4</li>
</ol>
<li>Number List 2</li>
<li>Number List 3</li>
<li>Number List 4</li>
</ol><dl><dt>Definition title dt</dt><dd>Defination description dd</dd><dt>Definition title dt</dt><dd>Defination description dd</dd></dl>
<p><code>Code tag:&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</code></p>
<blockquote>
<p>block quote&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</blockquote>
<div class="box f-left">element with class <strong>.f-left</strong></div>
<div class="box f-right">element with class <strong>.f-right</strong></div>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<h2>Tables</h2>
<p>Table with class <strong>.data-table</strong></p>
<table class="data-table" style="width: 100%;" border="0">
<thead>
<tr><th>THEAD TH</th><th>THEAD TH</th><th>THEAD TH</th><th>THEAD TH</th><th>THEAD TH</th></tr>
</thead>
<tbody>
<tr>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
</tr>
<tr>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
</tr>
<tr>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
<td>TBODY TD</td>
</tr>
</tbody>
</table>
<h2>Custom CSS Classes</h2>
<p class="normal">this is a paragraph with class <strong>.normal</strong></p>
<p class="primary">this is a paragraph with class <strong>.primary</strong></p>
<p class="secondary">this is a paragraph with class <strong>.secondary</strong></p>
<p class="secondary2">this is a paragraph with class <strong>.secondary2</strong></p>
<p class="small">tag <strong>small</strong> and class <strong>.small</strong></p>
<p class="underline">element with class <strong>.underline</strong></p>
<p><strong>ul.none</strong> and <strong>ol.none</strong>:</p>
<ul class="none">
<li>Bullet List 1</li>
<ul>
<li>Bullet List 1.1</li>
<li>Bullet List 1.2</li>
<li>Bullet List 1.3</li>
<li>Bullet List 1.4</li>
</ul>
<li>Bullet List 2</li>
<li>Bullet List 3</li>
<li>Bullet List 4</li>
</ul>
<p><strong>ul.hoz</strong> and <strong>ol.hoz</strong>:</p>
<ul class="hoz">
<li>Bullet List 1</li>
<li>Bullet List 2</li>
<li>Bullet List 3</li>
<li>Bullet List 4</li>
</ul>
<div class="box">
<p>paragraph with class <strong>.box</strong>:</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<p class="bottom">Paragraph with class <strong>.bottom</strong> always has margin-bottom = 0.</p>
<p>Add class <strong>.hide-lte2</strong> to hide element when screen's width less than 1280px.</p>
<p class="box hide-lte2">This block will disappear when resize window less than 1280px</p>
<p>Add class <strong>.hide-lte1</strong> to hide element when screen's width less than 980px.</p>
<p class="box hide-lte1">This block will disappear when resize window less than 980px</p>
<p>Add class <strong>.hide-lte0</strong> to hide element when screen's width less than 760px.</p>
<p class="box hide-lte0">This block will disappear when resize window less than 760px</p>
<h2>Icons</h2>
<table class="data-table" border="0">
<tbody>
<tr>
<td align="center" valign="top">
<p>.icon.top-link-cart</p>
<p><span class="icon top-link-cart">span.icon.top-link-cart</span></p>
</td>
<td align="center" valign="top">
<p>.icon.success-msg</p>
<p><span class="icon success-msg">span.icon.text</span></p>
</td>
</tr>
</tbody>
</table>
<h2>Logo</h2>
<table class="data-table" border="0">
<tbody>
<tr>
<td align="center" valign="top">
<p>.custom-logo.paymentmethods</p>
<p><span class="custom-logo paymentmethods">span.custom-logo.paymentmethods</span></p>
</td>
<td align="center" valign="top">
<p>.custom-logo.shippingmethods</p>
<p><span class="custom-logo followus">span.custom-logo.followus</span></p>
</td>
</tr>
</tbody>
</table>
<p>image with class <strong>.fluid</strong>:</p>
<p><img class="fluid" title="image with class .fluid" src="{{skin url="images/media/slide_3.jpg"}}" alt="image with class .fluid" /></p>
EOB
);
$helper->insertPage($dataPage);

// Demo Widgets
$dataPage = array(
	'title'				=> 'Demo Widgets',
	'identifier' 		=> 'widgets',
	'stores'			=> $stores,
	'content_heading'	=> '',
	'root_template'		=> 'one_column',
	'content'			=> <<<EOB
<h2>Demo EM Slideshow Widget</h2>
<div class="grid_14">{{widget type="slideshowresponsive/create" text1="<span>Slide 1</span>" url1="#" image1="slide1.jpg" text2="<span>Slide 2</span>" url2="#" image2="slide2.jpg" text3="<span>Slide 3</span>" url3="#" image3="slide3.jpg" effect="random" slices="15" boxcols="8" boxrows="4" animspeed="500" pausetime="5000" directionnav="true" controlnav="true" controlnavthumbs="false" pauseonhover="true" prevtext="Prev" nexttext="Next" randomstart="true"}}</div>
<div class="clear">&nbsp;</div>
<hr />
<h2>Demo EM Featured Products Widget</h2>
<div class="container_24">
<div class="grid_12 alpha">
<h3>Grid View</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="3" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_grid.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>Grid View with column count = 3</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="6" column_count="3" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_grid.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
<hr />
<div class="grid_12 alpha">
<h3>List View</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="3" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_list.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>List View with column count = 2</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="4" column_count="2" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_list.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
<hr />
<div class="grid_12 alpha">
<h3>Custom Grid View</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="3" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_grid_custom.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>Custom Grid View With Slider</h3>
<p>{{widget type="dynamicproducts/dynamicproducts" order_by="name asc" featured_choose="Featured" limit_count="4" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_featured_products/featured_grid_slider.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
</div>
<hr />
<h2>Demo EM Bestseller Products Widget</h2>
<div class="container_24">
<div class="grid_12 alpha">
<h3>Grid View</h3>
<p>{{widget type="bestsellerproducts/list" order_by="name asc" limit_count="3" frontend_title="Bestseller Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_bestseller_products/bestseller_grid.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>List View</h3>
<p>{{widget type="bestsellerproducts/list" order_by="name asc" limit_count="3" frontend_title="Bestseller Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_bestseller_products/bestseller_list.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
</div>
<hr />
<h2>Demo EM New Products Widget</h2>
<div class="container_24">
<div class="grid_12 alpha">
<h3>Grid View</h3>
<p>{{widget type="newproducts/list" limit_count="3" order_by="name asc" frontend_title="New Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_new_products/new_grid.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>List View</h3>
<p>{{widget type="newproducts/list" limit_count="3" order_by="name asc" frontend_title="New Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_new_products/new_list.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
</div>
<hr />
<h2>Demo EM Sale Products Widget</h2>
<div class="container_24">
<div class="grid_12 alpha">
<h3>Grid View</h3>
<p>{{widget type="saleproducts/list" order_by="name asc" limit_count="3" frontend_title="Sale Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_sale_products/sale_grid.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>List View</h3>
<p>{{widget type="saleproducts/list" order_by="name asc" limit_count="3" frontend_title="Sale Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_sale_products/sale_list.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
<hr />
<div class="grid_12 alpha">
<h3>Custom Grid View</h3>
<p>{{widget type="saleproducts/list" order_by="name asc" limit_count="12" frontend_title="Sale Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_sale_products/sale_grid_custom.phtml"}}</p>
</div>
<div class="grid_12 omega">
<h3>Custom List View</h3>
<p>{{widget type="saleproducts/list" order_by="name asc" limit_count="9" frontend_title="Sale Products" thumbnail_width="150" thumbnail_height="150" show_product_name="true" show_thumbnail="true" show_description="true" show_price="true" show_reviews="true" show_addtocart="true" show_addto="true" show_label="true" choose_template="em_sale_products/sale_list_custom.phtml"}}</p>
</div>
<div class="clear">&nbsp;</div>
</div>
<hr />
<h2>Demo EM Slider Widget</h2>
<div class="grid_5 alpha">
<h3>Vertical Sliding</h3>
<div>{{widget type="sliderwidget/slide" instance="4" direction="vertical" container=".products-grid" keyboard="1" items_per_slide="1"}}</div>
</div>
<div class="grid_19 omega">
<h3>Horizontal Sliding</h3>
<div>{{widget type="sliderwidget/slide" instance="4" direction="horizontal" container=".products-grid" keyboard="1" items_per_slide="1"}}</div>
</div>
<hr />
<h2>Demo EM Tabs Widget</h2>
<div class="grid_24">{{widget type="tabs/group" title_1="YTo0OntpOjA7czo1OiJUYWIgMSI7aToxO3M6MDoiIjtpOjM7czowOiIiO2k6MjtzOjA6IiI7fQ==" block_1="6" title_2="YTo0OntpOjA7czo1OiJUYWIgMiI7aToxO3M6MDoiIjtpOjM7czowOiIiO2k6MjtzOjA6IiI7fQ==" block_2="5" title_3="YTo0OntpOjA7czo1OiJUYWIgMyI7aToxO3M6MDoiIjtpOjM7czowOiIiO2k6MjtzOjA6IiI7fQ==" block_3="6" template="emtabs/group.phtml"}}</div>
EOB
);
$helper->insertPage($dataPage);

####################################################################################################
# INSERT WIDGET INSTANCE
####################################################################################################

$widgetInstance = Mage::getModel('widget/widget_instance');
$package_theme  = 'default/galayomarket';

// 1. Gala YoMarket Main Slideshow
$widget = array(
	'title' => 'Gala YoMarket Main Slideshow',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:50:{s:5:"text1";s:183:"<p class="title">OMEGA</p><p class="small">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage1";s:0:"";s:4:"url1";s:14:"furniture.html";s:6:"image1";s:10:"slide1.jpg";s:5:"text2";s:182:"<p class="title">HTC MOBILE</p><p class="small">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage2";s:0:"";s:4:"url2";s:12:"apparel.html";s:6:"image2";s:10:"slide2.jpg";s:5:"text3";s:181:"<p class="title">LUMIS GH2</p><p class="small">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage3";s:0:"";s:4:"url3";s:19:"apparel/shirts.html";s:6:"image3";s:10:"slide3.jpg";s:5:"text4";s:0:"";s:12:"thumbsimage4";s:0:"";s:4:"url4";s:0:"";s:6:"image4";s:0:"";s:5:"text5";s:0:"";s:12:"thumbsimage5";s:0:"";s:4:"url5";s:0:"";s:6:"image5";s:0:"";s:5:"text6";s:0:"";s:12:"thumbsimage6";s:0:"";s:4:"url6";s:0:"";s:6:"image6";s:0:"";s:5:"text7";s:0:"";s:12:"thumbsimage7";s:0:"";s:4:"url7";s:0:"";s:6:"image7";s:0:"";s:5:"text8";s:0:"";s:12:"thumbsimage8";s:0:"";s:4:"url8";s:0:"";s:6:"image8";s:0:"";s:5:"text9";s:0:"";s:12:"thumbsimage9";s:0:"";s:4:"url9";s:0:"";s:6:"image9";s:0:"";s:6:"effect";s:6:"random";s:6:"slices";s:2:"15";s:7:"boxcols";s:1:"8";s:7:"boxrows";s:1:"4";s:9:"animspeed";s:3:"500";s:9:"pausetime";s:4:"6000";s:10:"startslide";s:1:"0";s:12:"directionnav";s:4:"true";s:10:"controlnav";s:4:"true";s:16:"controlnavthumbs";s:5:"false";s:12:"pauseonhover";s:4:"true";s:8:"prevtext";s:4:"Prev";s:8:"nexttext";s:4:"Next";s:11:"randomstart";s:4:"true";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"56";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"56";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:13:"mainslideshow";}}}
EOB
	)
);
$widgetInstance->setData($widget)->setType('slideshowresponsive/create')->setPackageTheme($package_theme)->save();

// 1. Gala YoMarket Main Slideshow Simple Style
$widget = array(
	'title' => 'Gala YoMarket Main Slideshow Simple Style',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:50:{s:5:"text1";s:183:"<p class="title">OMEGA</p><p class="small">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage1";s:0:"";s:4:"url1";s:14:"furniture.html";s:6:"image1";s:12:"slide4_1.jpg";s:5:"text2";s:182:"<p class="title">HTC MOBILE</p><p class="small">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage2";s:0:"";s:4:"url2";s:12:"apparel.html";s:6:"image2";s:12:"slide4_2.jpg";s:5:"text3";s:181:"<p class="title">LUMIS GH2</p><p class="small">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse</p> <p><a href="#" title="shop now"><span>SHOP NOW</span></a></p>";s:12:"thumbsimage3";s:0:"";s:4:"url3";s:19:"apparel/shirts.html";s:6:"image3";s:12:"slide4_3.jpg";s:5:"text4";s:0:"";s:12:"thumbsimage4";s:0:"";s:4:"url4";s:0:"";s:6:"image4";s:0:"";s:5:"text5";s:0:"";s:12:"thumbsimage5";s:0:"";s:4:"url5";s:0:"";s:6:"image5";s:0:"";s:5:"text6";s:0:"";s:12:"thumbsimage6";s:0:"";s:4:"url6";s:0:"";s:6:"image6";s:0:"";s:5:"text7";s:0:"";s:12:"thumbsimage7";s:0:"";s:4:"url7";s:0:"";s:6:"image7";s:0:"";s:5:"text8";s:0:"";s:12:"thumbsimage8";s:0:"";s:4:"url8";s:0:"";s:6:"image8";s:0:"";s:5:"text9";s:0:"";s:12:"thumbsimage9";s:0:"";s:4:"url9";s:0:"";s:6:"image9";s:0:"";s:6:"effect";s:6:"random";s:6:"slices";s:2:"15";s:7:"boxcols";s:1:"8";s:7:"boxrows";s:1:"4";s:9:"animspeed";s:3:"500";s:9:"pausetime";s:4:"6000";s:10:"startslide";s:1:"0";s:12:"directionnav";s:4:"true";s:10:"controlnav";s:4:"true";s:16:"controlnavthumbs";s:5:"false";s:12:"pauseonhover";s:4:"true";s:8:"prevtext";s:4:"Prev";s:8:"nexttext";s:4:"Next";s:11:"randomstart";s:4:"true";}
EOB
	,
	'page_groups'=>	null
);
$widgetInstance->setData($widget)->setType('slideshowresponsive/create')->setPackageTheme($package_theme)->save();


// 2. Gala YoMarket Area03 Hot Products
$widget = array(
	'title' => 'Gala YoMarket Area03 Hot Products',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:23:{s:8:"order_by";s:8:"name asc";s:12:"new_category";a:1:{i:0;s:1:"3";}s:15:"featured_choose";s:3:"Hot";s:11:"limit_count";s:2:"30";s:12:"column_count";s:0:"";s:12:"custom_class";s:11:"hot-product";s:14:"frontend_title";s:12:"Hot Products";s:20:"frontend_description";s:0:"";s:10:"item_width";s:0:"";s:11:"item_height";s:0:"";s:12:"item_spacing";s:0:"";s:15:"thumbnail_width";s:3:"150";s:16:"thumbnail_height";s:3:"150";s:17:"show_product_name";s:4:"true";s:14:"show_thumbnail";s:4:"true";s:16:"show_description";s:5:"false";s:10:"show_price";s:4:"true";s:12:"show_reviews";s:5:"false";s:14:"show_addtocart";s:5:"false";s:10:"show_addto";s:5:"false";s:10:"show_label";s:5:"false";s:15:"choose_template";s:47:"em_featured_products/featured_grid_custom.phtml";s:14:"cache_lifetime";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
$widgetInstance->setData($widget)->setType('dynamicproducts/dynamicproducts')->setPackageTheme($package_theme)->save();
$widget_id = $widgetInstance->getId();

// 3. Gala YoMarket Area03 Slider Hot Products
$widget = array(
	'title' => 'Gala YoMarket Area03 Slider Hot Products',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:6:{s:8:"instance";s:1:"4";s:12:"static_block";s:0:"";s:9:"direction";s:10:"horizontal";s:9:"container";s:16:"ul.products-grid";s:9:"css_class";s:9:"hide-lte0";s:15:"items_per_slide";s:1:"1";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:1:"4";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:1:"4";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area03";}}}
EOB
	)
);
galayomarket_install_fix_widget_instance_id($widget, $widget_id);
$widgetInstance->setData($widget)->setType('sliderwidget/slide')->setPackageTheme($package_theme)->save();

// 4. Gala YoMarket Area04 Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area04 Banner',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:1:"6";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:17:"Hot Deals Of Week";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:1:"5";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:1:"5";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area04";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area04_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 5. Gala YoMarket Area05 Featured Products
$widget = array(
	'title' => 'Gala YoMarket Area05 Featured Products',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:23:{s:8:"order_by";s:8:"name asc";s:12:"new_category";a:1:{i:0;s:1:"3";}s:15:"featured_choose";s:8:"Featured";s:11:"limit_count";s:2:"10";s:12:"column_count";s:0:"";s:12:"custom_class";s:4:"box3";s:14:"frontend_title";s:17:"Featured Products";s:20:"frontend_description";s:0:"";s:10:"item_width";s:0:"";s:11:"item_height";s:0:"";s:12:"item_spacing";s:0:"";s:15:"thumbnail_width";s:3:"150";s:16:"thumbnail_height";s:3:"150";s:17:"show_product_name";s:4:"true";s:14:"show_thumbnail";s:4:"true";s:16:"show_description";s:5:"false";s:10:"show_price";s:4:"true";s:12:"show_reviews";s:5:"false";s:14:"show_addtocart";s:5:"false";s:10:"show_addto";s:5:"false";s:10:"show_label";s:4:"true";s:15:"choose_template";s:40:"em_featured_products/featured_grid.phtml";s:14:"cache_lifetime";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
$widgetInstance->setData($widget)->setType('dynamicproducts/dynamicproducts')->setPackageTheme($package_theme)->save();
$widget_id = $widgetInstance->getId();

// 6. Gala YoMarket Area05 Slider Featured Products
$widget = array(
	'title' => 'Gala YoMarket Area05 Slider Featured Products',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:6:{s:8:"instance";s:1:"7";s:12:"static_block";s:0:"";s:9:"direction";s:10:"horizontal";s:9:"container";s:14:".products-grid";s:9:"css_class";s:9:"em-area05";s:15:"items_per_slide";s:1:"1";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:1:"7";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:1:"7";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area05";}}}
EOB
	)
);
galayomarket_install_fix_widget_instance_id($widget, $widget_id);
$widgetInstance->setData($widget)->setType('sliderwidget/slide')->setPackageTheme($package_theme)->save();

// 7. Gala YoMarket Area06 Tab01
$widget = array(
	'title' => 'Gala YoMarket Area06 Tab01',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:1:"8";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area06_tab01']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();
$widget_id1 = $widgetInstance->getId();

// 8. Gala YoMarket Area06 Tab02
$widget = array(
	'title' => 'Gala YoMarket Area06 Tab02',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:1:"9";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area06_tab02']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();
$widget_id2 = $widgetInstance->getId();

// 9. Gala YoMarket Area06 Tab03
$widget = array(
	'title' => 'Gala YoMarket Area06 Tab03',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"10";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area06_tab03']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();
$widget_id3 = $widgetInstance->getId();

// 10. Gala YoMarket Area06 Tab04
$widget = array(
	'title' => 'Gala YoMarket Area06 Tab04',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"11";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	null
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area06_tab04']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();
$widget_id4 = $widgetInstance->getId();

// 11. Gala YoMarket Area06 Tabs
$widget = array(
	'title' => 'Gala YoMarket Area06 Tabs',
	'store_ids' => $stores,
	'sort_order' => 1,
	'widget_parameters'	=> <<<EOB
a:31:{s:7:"title_1";a:4:{i:0;s:17:"Iphone &amp; Ipad";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_1";s:0:"";s:10:"instance_1";s:2:"14";s:7:"title_2";a:4:{i:0;s:21:"Computer &amp; Laptop";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_2";s:0:"";s:10:"instance_2";s:2:"15";s:7:"title_3";a:4:{i:0;s:7:"Fashion";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_3";s:0:"";s:10:"instance_3";s:2:"16";s:7:"title_4";a:4:{i:0;s:11:"Accessories";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_4";s:0:"";s:10:"instance_4";s:2:"17";s:7:"title_5";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_5";s:0:"";s:10:"instance_5";s:0:"";s:7:"title_6";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_6";s:0:"";s:10:"instance_6";s:0:"";s:7:"title_7";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_7";s:0:"";s:10:"instance_7";s:0:"";s:7:"title_8";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_8";s:0:"";s:10:"instance_8";s:0:"";s:7:"title_9";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:7:"block_9";s:0:"";s:10:"instance_9";s:0:"";s:8:"title_10";a:4:{i:0;s:0:"";i:1;s:0:"";i:3;s:0:"";i:2;s:0:"";}s:8:"block_10";s:0:"";s:11:"instance_10";s:0:"";s:8:"instance";s:2:"13";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:1:"8";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:5:{s:7:"page_id";s:1:"8";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area06";s:8:"template";s:18:"emtabs/group.phtml";}}}
EOB
	)
);
galayomarket_install_fix_tabwidget_instance_id($widget, $widget_id1, $widget_id2, $widget_id3, $widget_id4);
function galayomarket_install_fix_tabwidget_instance_id(&$widget, $instance_id1, $instance_id2, $instance_id3,$instance_id4) {
	$package_theme  = 'default/galayomarket';
	$widgetInstance = Mage::getModel('widget/widget_instance');
	$widgetInstance->setData($widget)->setType('tabs/group')->setPackageTheme($package_theme)->save();
	$id = $widgetInstance->getId();
	$params = unserialize($widget['widget_parameters']);	
	$params['instance_1'] = $instance_id1;
    $params['instance_2'] = $instance_id2;
    $params['instance_3'] = $instance_id3;
    $params['instance_4'] = $instance_id4;
	$params['instance'] = $id;
	$widget['widget_parameters'] = serialize($params);
	$widgetInstance->setData($widget)->setType('tabs/group')->setPackageTheme($package_theme)->setId($id)->save();
}

// 12. Gala YoMarket Area06 Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area06 Banner',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:1:"7";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:1:"9";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:1:"9";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area06";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area06_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 13. Gala YoMarket Area07 Bestseller
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area07 Bestseller',
	'store_ids' => $stores,
	'sort_order' => 1,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"12";s:12:"custom_class";s:11:"cms-area-07";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"10";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"10";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area07";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area07_bestseller']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 14. Gala YoMarket Area07 Hot Products
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area07 Hot Products',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"13";s:12:"custom_class";s:11:"cms-area-07";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"11";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"11";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area07";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area07_hotproducts']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

 
// 15.  Gala YoMarket Area07 Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area07 Banner',
	'store_ids' => $stores,
	'sort_order' => 3,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"14";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"12";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"12";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area07";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area07_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 16. Gala YoMarket Area07 Most Popular
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area07 Most Popular',
	'store_ids' => $stores,
	'sort_order' => 4,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"15";s:12:"custom_class";s:11:"cms-area-07";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"13";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"13";s:3:"for";s:3:"all";s:13:"layout_handle";s:15:"cms_index_index";s:5:"block";s:6:"area07";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area07_most_popular']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 17. Gala YoMarket Area08 Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area08 Banner',
	'store_ids' => $stores,
	'sort_order' => 1,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"16";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:9:"all_pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:4:{s:7:"page_id";s:2:"16";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";s:5:"block";s:6:"area08";}s:5:"pages";a:3:{s:7:"page_id";s:2:"16";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area07_banner02']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 18. Gala YoMarket Area08 Brand
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area08 Brand',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"17";s:12:"custom_class";s:3:"box";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:9:"all_pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:4:{s:7:"page_id";s:2:"55";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";s:5:"block";s:6:"area08";}s:5:"pages";a:3:{s:7:"page_id";s:2:"55";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area08_brand']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();
$widget_id = $widgetInstance->getId();


// 21. Gala YoMarket Area09 News
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area09 News',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"18";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:9:"all_pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:4:{s:7:"page_id";s:2:"17";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";s:5:"block";s:6:"area09";}s:5:"pages";a:3:{s:7:"page_id";s:2:"17";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area09_news']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 22. Gala YoMarket Area10 Information
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area10 Information',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"19";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:9:"all_pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:4:{s:7:"page_id";s:2:"18";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";s:5:"block";s:6:"area10";}s:5:"pages";a:3:{s:7:"page_id";s:2:"18";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area10_information']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 23. Gala YoMarket Area11 Payment Social
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area11 Payment Social',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"20";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:9:"all_pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:4:{s:7:"page_id";s:2:"19";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";s:5:"block";s:6:"area11";}s:5:"pages";a:3:{s:7:"page_id";s:2:"19";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area11_payment_social']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 24. Gala YoMarket Left Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Left Banner',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"21";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:9:"hide-lte0";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:3:{i:2;a:12:{s:10:"page_group";s:17:"anchor_categories";s:17:"anchor_categories";a:7:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"22";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"22";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}i:1;a:12:{s:10:"page_group";s:20:"notanchor_categories";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:7:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"21";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"21";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"20";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"20";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['left_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 25. Gala YoMarket Checkout Account Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Checkout Account Banner',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"22";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:4:{i:3;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"39";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"39";s:3:"for";s:3:"all";s:13:"layout_handle";s:23:"customer_account_create";s:5:"block";s:4:"left";}}i:2;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"36";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"36";s:3:"for";s:3:"all";s:13:"layout_handle";s:16:"customer_account";s:5:"block";s:4:"left";}}i:1;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"35";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"35";s:3:"for";s:3:"all";s:13:"layout_handle";s:22:"customer_account_login";s:5:"block";s:4:"left";}}i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"23";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"23";s:3:"for";s:3:"all";s:13:"layout_handle";s:22:"checkout_onepage_index";s:5:"block";s:4:"left";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['left_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 27. Gala YoMarket Left Latest Review
$widget = array(
	'title' => 'Gala YoMarket Left Latest Review',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> <<<EOB
a:18:{s:8:"order_by";s:8:"name asc";s:11:"limit_count";s:1:"2";s:15:"thumbnail_width";s:2:"90";s:12:"column_count";s:0:"";s:16:"thumbnail_height";s:2:"90";s:12:"custom_class";s:0:"";s:14:"frontend_title";s:13:"Latest Review";s:10:"item_width";s:0:"";s:11:"item_height";s:0:"";s:12:"item_spacing";s:0:"";s:14:"show_addtocart";s:5:"false";s:10:"show_label";s:4:"true";s:17:"show_product_name";s:4:"true";s:14:"show_thumbnail";s:4:"true";s:10:"show_price";s:4:"true";s:10:"show_addto";s:5:"false";s:14:"cache_lifetime";s:0:"";s:15:"choose_template";s:48:"em_recentviewproducts/list_products_simple.phtml";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:3:{i:2;a:12:{s:10:"page_group";s:20:"notanchor_categories";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:7:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"34";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"34";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}i:1;a:12:{s:10:"page_group";s:17:"anchor_categories";s:17:"anchor_categories";a:7:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"33";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"33";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:4:"left";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"32";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"32";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
$widgetInstance->setData($widget)->setType('recentreviewproducts/list')->setPackageTheme($package_theme)->save();

// 28. Gala YoMarket Login Left Banner
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Login Left Banner',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"24";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:3:{i:2;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"40";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"40";s:3:"for";s:3:"all";s:13:"layout_handle";s:21:"customer_account_edit";s:5:"block";s:4:"left";}}i:1;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"38";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"38";s:3:"for";s:3:"all";s:13:"layout_handle";s:22:"customer_account_login";s:5:"block";s:4:"left";}}i:0;a:12:{s:10:"page_group";s:5:"pages";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"37";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:4:{s:7:"page_id";s:2:"37";s:3:"for";s:3:"all";s:13:"layout_handle";s:23:"customer_account_create";s:5:"block";s:4:"left";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['login_left_banner']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 29. Gala YoMarket Area12 Sample Block
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area12 Sample Block',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"26";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:6:"area12";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"46";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"46";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area12_sample_block']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// 29. Gala YoMarket Area13 Sample Block
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area13 Sample Block',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"27";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:6:"area13";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"47";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"47";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area13_sample_block']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 29. Gala YoMarket Area14 Sample Block
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area14 Sample Block',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"28";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:6:"area14";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"48";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"48";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area14_sample_block']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// 29. Gala YoMarket Area15 Sample Block
$widget = array(
	'type' => 'cmswidget/widget_block',
	'title' => 'Gala YoMarket Area15 Sample Block',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"29";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:0:"";}
EOB
	,
	'page_groups'=>	unserialize(<<<EOB
a:1:{i:0;a:12:{s:10:"page_group";s:12:"all_products";s:17:"anchor_categories";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:32:"default,catalog_category_layered";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"1";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:20:"notanchor_categories";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:32:"default,catalog_category_default";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:1:"0";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:12:"all_products";a:7:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:28:"default,catalog_product_view";s:3:"for";s:3:"all";s:5:"block";s:6:"area15";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:0:"";s:8:"entities";s:0:"";}s:15:"simple_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_simple";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"simple";s:8:"entities";s:0:"";}s:16:"grouped_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_grouped";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"grouped";s:8:"entities";s:0:"";}s:21:"configurable_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_configurable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"configurable";s:8:"entities";s:0:"";}s:16:"virtual_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:49:"default,catalog_product_view,PRODUCT_TYPE_virtual";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:7:"virtual";s:8:"entities";s:0:"";}s:15:"bundle_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:48:"default,catalog_product_view,PRODUCT_TYPE_bundle";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:6:"bundle";s:8:"entities";s:0:"";}s:21:"downloadable_products";a:6:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:54:"default,catalog_product_view,PRODUCT_TYPE_downloadable";s:3:"for";s:3:"all";s:14:"is_anchor_only";s:0:"";s:15:"product_type_id";s:12:"downloadable";s:8:"entities";s:0:"";}s:9:"all_pages";a:3:{s:7:"page_id";s:2:"49";s:13:"layout_handle";s:7:"default";s:3:"for";s:3:"all";}s:5:"pages";a:3:{s:7:"page_id";s:2:"49";s:3:"for";s:3:"all";s:13:"layout_handle";s:0:"";}}}
EOB
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['area15_sample_block']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// Gala YoMarket Details Alert Url Sample Block
$widget = array(
	'title' => 'Gala YoMarket Details Alert Url Sample Block',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> serialize(array(
		'block_id' => $block_id['details_alert_url_sample_block'],
		'custom_class' => '',
		'custom_html_wrapper_class' => '',
		'custom_html_wrapper_id' => '',
		'block_title' => '',
	)),
	'page_groups'=> array(
		array(
			'page_group' => 'all_products',
			'all_products' => array(
				'layout_handle' => 'default,catalog_product_view',
				'for' => 'all',
				'block' => 'alert.urls'
			)
		)
	)
);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// Gala YoMarket Details Extra Hint Sample Block
$widget = array(
	'title' => 'Gala YoMarket Details Extra Hint Sample Block',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> serialize(array(
		'block_id' => $block_id['details_extra_hint_sample_block'],
		'custom_class' => '',
		'custom_html_wrapper_class' => '',
		'custom_html_wrapper_id' => '',
		'block_title' => '',
	)),
	'page_groups'=> array(
		array(
			'page_group' => 'all_products',
			'all_products' => array(
				'layout_handle' => 'default,catalog_product_view',
				'for' => 'all',
				'block' => 'product.info.extrahint'
			)
		)
	)
);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// Gala YoMarket Detais Product View Short Description After 
$widget = array(
	'title' => 'Gala YoMarket Detais Product View Short Description After',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> serialize(array(
		'block_id' => $block_id['details_product_view_short_description_after'],
		'custom_class' => '',
		'custom_html_wrapper_class' => '',
		'custom_html_wrapper_id' => '',
		'block_title' => '',
	)),
	'page_groups'=> array(
		array(
			'page_group' => 'all_products',
			'all_products' => array(
				'layout_handle' => 'default,catalog_product_view',
				'for' => 'all',
				'block' => 'product.info.short_des_after'
			)
		)
	)
);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


// Gala YoMarket Product Collateral Sample
$widget = array(
	'title' => 'Gala YoMarket Product Collateral Sample',
	'store_ids' => $stores,
	'sort_order' => 1,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"33";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:13:"Custome Tab 1";}
EOB
	,
	'page_groups'=> array(
		array(
			'page_group' => 'all_products',
			'all_products' => array(
				'layout_handle' => 'default,catalog_product_view',
				'for' => 'all',
				'block' => 'product.info.additonal_collateral'
			)
		)
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['product_collateral_sample']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();

// Gala YoMarket Product Collateral Sample 2
$widget = array(
	'title' => 'Gala YoMarket Product Collateral Sample 2',
	'store_ids' => $stores,
	'sort_order' => 2,
	'widget_parameters'	=> <<<EOB
a:5:{s:8:"block_id";s:2:"33";s:12:"custom_class";s:0:"";s:25:"custom_html_wrapper_class";s:0:"";s:22:"custom_html_wrapper_id";s:0:"";s:11:"block_title";s:12:"Custom Tab N";}
EOB
	,
	'page_groups'=> array(
		array(
			'page_group' => 'all_products',
			'all_products' => array(
				'layout_handle' => 'default,catalog_product_view',
				'for' => 'all',
				'block' => 'product.info.additonal_collateral'
			)
		)
	)
);
galayomarket_install_fix_widget_block_id($widget, $block_id['product_collateral_sample']);
$widgetInstance->setData($widget)->setType('cmswidget/widget_block')->setPackageTheme($package_theme)->save();


function galayomarket_install_fix_widget_block_id(&$widget, $block_id) {
	$params = unserialize($widget['widget_parameters']);
	$params['block_id'] = $block_id;
	$widget['widget_parameters'] = serialize($params);
}

function galayomarket_install_fix_widget_instance_id(&$widget, $instance_id) {
	$params = unserialize($widget['widget_parameters']);
	$params['instance'] = $instance_id;
	$widget['widget_parameters'] = serialize($params);
}

####################################################################################################
# ADD MEGAMENU PRO
####################################################################################################

$installer->run("
CREATE TABLE IF NOT EXISTS {$this->getTable('megamenupro')} (
  `megamenupro_id` int(11) unsigned NOT NULL auto_increment, 
  `name` varchar(255) NOT NULL default '',
  `type` smallint(6) NOT NULL default '0',
  `content` text NOT NULL default '', 
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`megamenupro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");

# create menu of theme Gala YoMarket
$model = Mage::getModel('yomarketsettings/megamenupro');
$model->setData(array(
	'name' => "Vertical Mega Menu",
	'type' => "1",
	'content' => <<<EOB
a:39:{i:0;a:8:{s:4:"type";s:4:"link";s:5:"label";s:17:"Fashion for women";s:8:"sublabel";s:0:"";s:3:"url";s:24:"electronics/cameras.html";s:6:"target";s:0:"";s:9:"css_class";s:15:"icon-menu women";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:1;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:2;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:3;a:5:{s:4:"type";s:4:"text";s:4:"text";s:292:"PGg1PlZlc3RpYnVsdW0gbG9yZTwvaDU+Cnt7YmxvY2sgdHlwZT0ibWVnYW1lbnVwcm8vY2F0YWxvZ25hdmlnYXRpb24iIG5hbWU9Im1haW5tZWdhbWVudSIgY2F0ZWdvcnlfaWQ9IjE1In19CjxoNT5WZXN0aWJ1bHVtIGxvcmU8L2g1Pgp7e2Jsb2NrIHR5cGU9Im1lZ2FtZW51cHJvL2NhdGFsb2duYXZpZ2F0aW9uIiBuYW1lPSJtYWlubWVnYW1lbnUiIGNhdGVnb3J5X2lkPSIxNSJ9fQ==";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:4;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:5;a:5:{s:4:"type";s:4:"text";s:4:"text";s:612:"PGg1PlN1c3BlbmRpc3NlIHJpc3VzPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTIifX17e3dpZGdldCB0eXBlPSJuZXdwcm9kdWN0cy9saXN0IiBuZXdfY2F0ZWdvcnk9IjMiIGxpbWl0X2NvdW50PSIxIiBvcmRlcl9ieT0ibmFtZSBhc2MiIHRodW1ibmFpbF93aWR0aD0iMTUwIiB0aHVtYm5haWxfaGVpZ2h0PSIxNTAiIHNob3dfcHJvZHVjdF9uYW1lPSJ0cnVlIiBzaG93X3RodW1ibmFpbD0idHJ1ZSIgc2hvd19kZXNjcmlwdGlvbj0idHJ1ZSIgc2hvd19wcmljZT0idHJ1ZSIgc2hvd19yZXZpZXdzPSJ0cnVlIiBzaG93X2FkZHRvY2FydD0idHJ1ZSIgc2hvd19hZGR0bz0idHJ1ZSIgc2hvd19sYWJlbD0idHJ1ZSIgY2hvb3NlX3RlbXBsYXRlPSJlbV9uZXdfcHJvZHVjdHMvbmV3X2dyaWQucGh0bWwifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:6;a:8:{s:4:"type";s:4:"link";s:5:"label";s:5:"Watch";s:8:"sublabel";s:0:"";s:3:"url";s:12:"apparel.html";s:6:"target";s:0:"";s:9:"css_class";s:15:"icon-menu watch";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:7;a:8:{s:4:"type";s:4:"link";s:5:"label";s:15:"Fashion for men";s:8:"sublabel";s:0:"";s:3:"url";s:0:"";s:6:"target";s:0:"";s:9:"css_class";s:13:"icon-menu men";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:8;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:9;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:10;a:5:{s:4:"type";s:4:"text";s:4:"text";s:356:"PGg1PlZlc3RpYnVsdW0gbG9yZTwvaDU+Cnt7YmxvY2sgdHlwZT0ibWVnYW1lbnVwcm8vY2F0YWxvZ25hdmlnYXRpb24iIG5hbWU9Im1haW5tZWdhbWVudSIgY2F0ZWdvcnlfaWQ9IjE1In19CjxoNT5WZXN0aWJ1bHVtIGxvcmU8L2g1Pgp7e2Jsb2NrIHR5cGU9Im1lZ2FtZW51cHJvL2NhdGFsb2duYXZpZ2F0aW9uIiBuYW1lPSJtYWlubWVnYW1lbnUiIGNhdGVnb3J5X2lkPSIxNSJ9fQo8aDU+UGVsbGVudGVzcXVlPC9oNT4KPGg1Pk1hZWNlbmFzIGRpZ25pc2ltPC9oNT4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:11;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:12;a:5:{s:4:"type";s:4:"text";s:4:"text";s:612:"PGg1PlN1c3BlbmRpc3NlIHJpc3VzPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTIifX0Ke3t3aWRnZXQgdHlwZT0ibmV3cHJvZHVjdHMvbGlzdCIgbmV3X2NhdGVnb3J5PSIzIiBsaW1pdF9jb3VudD0iMSIgb3JkZXJfYnk9Im5hbWUgYXNjIiB0aHVtYm5haWxfd2lkdGg9IjE1MCIgdGh1bWJuYWlsX2hlaWdodD0iMTUwIiBzaG93X3Byb2R1Y3RfbmFtZT0idHJ1ZSIgc2hvd190aHVtYm5haWw9InRydWUiIHNob3dfZGVzY3JpcHRpb249InRydWUiIHNob3dfcHJpY2U9InRydWUiIHNob3dfcmV2aWV3cz0idHJ1ZSIgc2hvd19hZGR0b2NhcnQ9InRydWUiIHNob3dfYWRkdG89InRydWUiIHNob3dfbGFiZWw9InRydWUiIGNob29zZV90ZW1wbGF0ZT0iZW1fbmV3X3Byb2R1Y3RzL25ld19ncmlkLnBodG1sIn19";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:13;a:8:{s:4:"type";s:4:"link";s:5:"label";s:10:"Gift / Toy";s:8:"sublabel";s:0:"";s:3:"url";s:12:"apparel.html";s:6:"target";s:0:"";s:9:"css_class";s:14:"icon-menu gift";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:14;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:15;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_4 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:16;a:5:{s:4:"type";s:4:"text";s:4:"text";s:292:"PGg1PlZlc3RpYnVsdW0gbG9yZTwvaDU+Cnt7YmxvY2sgdHlwZT0ibWVnYW1lbnVwcm8vY2F0YWxvZ25hdmlnYXRpb24iIG5hbWU9Im1haW5tZWdhbWVudSIgY2F0ZWdvcnlfaWQ9IjE1In19CjxoNT5WZXN0aWJ1bHVtIGxvcmU8L2g1Pgp7e2Jsb2NrIHR5cGU9Im1lZ2FtZW51cHJvL2NhdGFsb2duYXZpZ2F0aW9uIiBuYW1lPSJtYWlubWVnYW1lbnUiIGNhdGVnb3J5X2lkPSIxNSJ9fQ==";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:17;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_4 omega alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:18;a:5:{s:4:"type";s:4:"text";s:4:"text";s:528:"e3t3aWRnZXQgdHlwZT0iYmVzdHNlbGxlcnByb2R1Y3RzL2xpc3QiIG5ld19jYXRlZ29yeT0iMyIgb3JkZXJfYnk9Im5hbWUgYXNjIiBsaW1pdF9jb3VudD0iMSIgZnJvbnRlbmRfdGl0bGU9IkJlc3Qgc2VsbGVyIiB0aHVtYm5haWxfd2lkdGg9IjUwIiB0aHVtYm5haWxfaGVpZ2h0PSI1MCIgc2hvd19wcm9kdWN0X25hbWU9InRydWUiIHNob3dfdGh1bWJuYWlsPSJ0cnVlIiBzaG93X2Rlc2NyaXB0aW9uPSJ0cnVlIiBzaG93X3ByaWNlPSJ0cnVlIiBzaG93X3Jldmlld3M9InRydWUiIHNob3dfYWRkdG9jYXJ0PSJ0cnVlIiBzaG93X2FkZHRvPSJ0cnVlIiBzaG93X2xhYmVsPSJ0cnVlIiBjaG9vc2VfdGVtcGxhdGU9ImVtX2Jlc3RzZWxsZXJfcHJvZHVjdHMvYmVzdHNlbGxlcl9saXN0LnBodG1sIn19";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:19;a:8:{s:4:"type";s:4:"link";s:5:"label";s:17:"Laptop / Computer";s:8:"sublabel";s:0:"";s:3:"url";s:41:"electronics/computers/build-your-own.html";s:6:"target";s:0:"";s:9:"css_class";s:16:"icon-menu laptop";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:20;a:8:{s:4:"type";s:4:"link";s:5:"label";s:18:"Camera / Camcorder";s:8:"sublabel";s:0:"";s:3:"url";s:26:"furniture/living-room.html";s:6:"target";s:0:"";s:9:"css_class";s:16:"icon-menu camera";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:21;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:22;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:23;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:24;a:5:{s:4:"type";s:4:"text";s:4:"text";s:144:"PGg1PlZlc3RpYnVsdW0gbG9yZTwvaDU+Cnt7YmxvY2sgdHlwZT0ibWVnYW1lbnVwcm8vY2F0YWxvZ25hdmlnYXRpb24iIG5hbWU9Im1haW5tZWdhbWVudSIgY2F0ZWdvcnlfaWQ9IjE1In19";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"4";}i:25;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:26;a:5:{s:4:"type";s:4:"text";s:4:"text";s:144:"PGg1PlZlc3RpYnVsdW0gbG9yZTwvaDU+Cnt7YmxvY2sgdHlwZT0ibWVnYW1lbnVwcm8vY2F0YWxvZ25hdmlnYXRpb24iIG5hbWU9Im1haW5tZWdhbWVudSIgY2F0ZWdvcnlfaWQ9IjE1In19";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"4";}i:27;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:28;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:29;a:5:{s:4:"type";s:4:"text";s:4:"text";s:132:"PGEgaHJlZj0iIyIgdGl0bGU9IiI+PGltZyBjbGFzcz0iZmx1aWQgIiBzcmM9Int7bWVkaWEgdXJsPSJ3eXNpd3lnL2ltZ19tZW51MS5qcGcifX0iIGFsdD0iIiAvPjwvYT4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"4";}i:30;a:8:{s:4:"type";s:4:"link";s:5:"label";s:20:"Iphone / Ipod / Ipad";s:8:"sublabel";s:0:"";s:3:"url";s:0:"";s:6:"target";s:0:"";s:9:"css_class";s:16:"icon-menu iphone";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:31;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:18:"grid_8 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:32;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:33;a:5:{s:4:"type";s:4:"text";s:4:"text";s:568:"PHA+CjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+CjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+CjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+CjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+CjxhIGNsYXNzPSJ0ZXh0IiBocmVmPSIjIj48c3Bhbj5TaG9wIEJ5IEJyYW5kczwvc3Bhbj48L2E+PC9wPgo=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:34;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_4 omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:35;a:5:{s:4:"type";s:4:"text";s:4:"text";s:604:"PHA+PGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT4gPGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT48YSBocmVmPSIjIj48aW1nIHRpdGxlPSJsb2dvIGJyYW5kIiBzcmM9Int7bWVkaWEgdXJsPSJ3eXNpd3lnL2JyYW5kLmpwZyJ9fSIgYWx0PSIiIC8+PC9hPjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+PGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT48L3A+";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:36;a:8:{s:4:"type";s:4:"link";s:5:"label";s:17:"Mother &amp; baby";s:8:"sublabel";s:0:"";s:3:"url";s:14:"furniture.html";s:6:"target";s:0:"";s:9:"css_class";s:16:"icon-menu mother";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:37;a:5:{s:4:"type";s:4:"text";s:4:"text";s:140:"e3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMyIgY3NzX2NsYXNzPSJ2ZXJ0aWNhbCJ9fQ==";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:38;a:8:{s:4:"type";s:4:"link";s:5:"label";s:9:"Cosmetics";s:8:"sublabel";s:0:"";s:3:"url";s:19:"apparel/shirts.html";s:6:"target";s:0:"";s:9:"css_class";s:19:"icon-menu cosmetics";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}}
EOB
	,
	'status' => "1"
))->setCreatedTime(now())->setUpdateTime(now())->save();
$menu_id = $model->getId();

# Mega Menu widget instance
$widget = array(
	'title' => 'Gala YoMarket Area01 Vertical Mega Menu',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> serialize(array(
		'menu' => $menu_id
	)),
	// a:1:{s:4:"menu";s:1:"1";}
	'page_groups' => array(
		array(
			'page_group' => 'all_pages',
			'all_pages' => array(
				'page_id' => 0,
				'layout_handle' => 'default',
				'for' => 'all',
				'block' => 'top.menu.left'
			)
		)
	),
);
$widgetInstance->setData($widget)->setType('megamenupro/megamenupro')->setPackageTheme($package_theme)->save();


// Horizontal Mega Menu
$model = Mage::getModel('yomarketsettings/megamenupro');
$model->setData(array(
	'name' => "Gala YoMarket Area02 Horizontal Mega Menu",
	'type' => "0",
	'content' => <<<EOB
a:36:{i:0;a:8:{s:4:"type";s:4:"link";s:5:"label";s:6:"Onsale";s:8:"sublabel";s:0:"";s:3:"url";s:1:"#";s:6:"target";s:0:"";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:1;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:19:"grid_19 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:2;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_6";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:3;a:5:{s:4:"type";s:4:"text";s:4:"text";s:868:"PGgzPlNPTlk8L2gzPgo8cD5OYW0gdmVoaWN1bGEsIGR1aSBpbiB1bHRyaWNpZXMgcG9ydHRpdG9ydWUgbm9uIGR1aWVnZXQgYWVuZWFuPC9wPgo8cD5OYW0gdmVoaWN1bGEsIGR1aSBpbiB1bHRyaWNpZXMgcG9ydHRpdG9ydWUgbm9uIGR1aWVnZXQgYWVuZWFuIGxhb3JlZXQgc2FwaWVuIGlkIHVybmEgcGxhY2VyYXQgc29sbGljaXR1ZGlucyBlcmF0IHZvbHV0cGF0LiA8L3A+CjxwPkN1cmFiaXR1ciBwcmV0aXVtIG5pc2kgdml0YWUgcHJldGl1bWVvIHZvbHV0cGF0LCBsaWd1bGEgZWxpdCBzdXNjaXBpdCBsaWJlcm8sIGV0IGZyaW5naWxsYSBlbmltbnUgRXRpYW0gc2l0IGFtZXQgc2VtIG5pYmgsIGlkIHRpbmNpZHVudCBkaWFtIHVsbGFtY29ycGVyIHZlbmVuYXRpcyBsaWd1bGEgZmF1Y2lidXMgcXVhbSwgbmVjIHNjZWxlcmlzcXVlIGp1c3RvIHR1cnBpcyBncmF2aWRhIGFyY3UgYWMganVzdG8gZGlnbmlzc2ltIHJob25jdXMuPC9wPgo8cD4gTnVsbGFtIHNjZWxlcmlzcXVlIGdyYXZpZGEgcGxhY2VyYXQgZWxpdCBhbGlxdWV0IGF0LiBQcm9pbiBzY2VsZXJpc3F1ZSBhdWd1ZSBwZWxsZW50ZXNxdWUgc2FwaWVuIHN1c2NpcGl0IGFsaXF1YW0uIEluIHZlbCBzZW1wZXIgb3JjaS4gQWxpcXVhbSBtYXVyaXMgaXBzdW0gdmFyaXVzIHF1aXM8L3A+";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:4;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:5;a:5:{s:4:"type";s:4:"text";s:4:"text";s:612:"PGg1PlNBTVBMRSBMSU5LUzwvaDU+Cjx1bD4KPGxpPjxhIGhyZWY9IiMiPmNvbnNlY3RldHVyIGFkaXBpc2ljaW5nPC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5laXVzbW9kIHRlbXBvcjwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JlIGV0IGRvbG9yZTwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JpcyBuaXNpIHV0PC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5EdWlzIGF1dGUgaXJ1cmU8L2E+PC9saT4KPGxpPjxhIGhyZWY9IiMiPmNvbnNlY3RldHVyIGFkaXBpc2ljaW5nPC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5laXVzbW9kIHRlbXBvcjwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JlIGV0IGRvbG9yZTwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JpcyBuaXNpIHV0PC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5EdWlzIGF1dGUgaXJ1cmU8L2E+PC9saT4KPC91bD4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:6;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:7;a:5:{s:4:"type";s:4:"text";s:4:"text";s:612:"PGg1PlNBTVBMRSBMSU5LUzwvaDU+Cjx1bD4KPGxpPjxhIGhyZWY9IiMiPmNvbnNlY3RldHVyIGFkaXBpc2ljaW5nPC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5laXVzbW9kIHRlbXBvcjwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JlIGV0IGRvbG9yZTwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JpcyBuaXNpIHV0PC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5EdWlzIGF1dGUgaXJ1cmU8L2E+PC9saT4KPGxpPjxhIGhyZWY9IiMiPmNvbnNlY3RldHVyIGFkaXBpc2ljaW5nPC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5laXVzbW9kIHRlbXBvcjwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JlIGV0IGRvbG9yZTwvYT48L2xpPgo8bGk+PGEgaHJlZj0iIyI+bGFib3JpcyBuaXNpIHV0PC9hPjwvbGk+CjxsaT48YSBocmVmPSIjIj5EdWlzIGF1dGUgaXJ1cmU8L2E+PC9saT4KPC91bD4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:8;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:9;a:5:{s:4:"type";s:4:"text";s:4:"text";s:504:"PHA+e3t3aWRnZXQgdHlwZT0iYmVzdHNlbGxlcnByb2R1Y3RzL2xpc3QiIG5ld19jYXRlZ29yeT0iMyIgb3JkZXJfYnk9Im5hbWUgYXNjIiBsaW1pdF9jb3VudD0iMSIgdGh1bWJuYWlsX3dpZHRoPSIxNTAiIHRodW1ibmFpbF9oZWlnaHQ9IjE1MCIgc2hvd19wcm9kdWN0X25hbWU9InRydWUiIHNob3dfdGh1bWJuYWlsPSJ0cnVlIiBzaG93X2Rlc2NyaXB0aW9uPSJmYWxzZSIgc2hvd19wcmljZT0idHJ1ZSIgc2hvd19yZXZpZXdzPSJ0cnVlIiBzaG93X2FkZHRvY2FydD0idHJ1ZSIgc2hvd19hZGR0bz0idHJ1ZSIgc2hvd19sYWJlbD0idHJ1ZSIgY2hvb3NlX3RlbXBsYXRlPSJlbV9iZXN0c2VsbGVyX3Byb2R1Y3RzL2Jlc3RzZWxsZXJfZ3JpZC5waHRtbCJ9fTwvcD4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:10;a:8:{s:4:"type";s:4:"link";s:5:"label";s:17:"Clothes For Women";s:8:"sublabel";s:0:"";s:3:"url";s:1:"#";s:6:"target";s:0:"";s:9:"css_class";s:19:"hide-lte1 hide-lte2";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:11;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:28:"grid_19 alpha omega menu_img";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:12;a:5:{s:4:"type";s:4:"text";s:4:"text";s:840:"PHA+PGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT48YSBocmVmPSIjIj48aW1nIHRpdGxlPSJsb2dvIGJyYW5kIiBzcmM9Int7bWVkaWEgdXJsPSJ3eXNpd3lnL2JyYW5kLmpwZyJ9fSIgYWx0PSIiIC8+PC9hPjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+PGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT48YSBocmVmPSIjIj48aW1nIHRpdGxlPSJsb2dvIGJyYW5kIiBzcmM9Int7bWVkaWEgdXJsPSJ3eXNpd3lnL2JyYW5kLmpwZyJ9fSIgYWx0PSIiIC8+PC9hPjxhIGhyZWY9IiMiPjxpbWcgdGl0bGU9ImxvZ28gYnJhbmQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvYnJhbmQuanBnIn19IiBhbHQ9IiIgLz48L2E+PGEgaHJlZj0iIyI+PGltZyB0aXRsZT0ibG9nbyBicmFuZCIgc3JjPSJ7e21lZGlhIHVybD0id3lzaXd5Zy9icmFuZC5qcGcifX0iIGFsdD0iIiAvPjwvYT48L3A+";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:13;a:8:{s:4:"type";s:4:"link";s:5:"label";s:15:"Clothes For Men";s:8:"sublabel";s:0:"";s:3:"url";s:1:"#";s:6:"target";s:0:"";s:9:"css_class";s:9:"hide-lte1";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:14;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_6";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:15;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_3 alpha";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:16;a:5:{s:4:"type";s:4:"text";s:4:"text";s:136:"PGg1PkNvbXB1dGVyPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTUifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:17;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:12:"grid_3 omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:18;a:5:{s:4:"type";s:4:"text";s:4:"text";s:272:"PGg1PkNhbWVyYXM8L2g1Pgp7e2Jsb2NrIHR5cGU9Im1lZ2FtZW51cHJvL2NhdGFsb2duYXZpZ2F0aW9uIiBuYW1lPSJtYWlubWVnYW1lbnUiIGNhdGVnb3J5X2lkPSIxMiJ9fQo8aDU+RnVybml0dXJlPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTAifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:19;a:8:{s:4:"type";s:4:"link";s:5:"label";s:17:"Computer & Laptop";s:8:"sublabel";s:0:"";s:3:"url";s:0:"";s:6:"target";s:0:"";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:20;a:5:{s:4:"type";s:4:"text";s:4:"text";s:112:"e3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMyJ9fQ==";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:21;a:8:{s:4:"type";s:4:"link";s:5:"label";s:20:"Mobile & Accessories";s:8:"sublabel";s:0:"";s:3:"url";s:1:"#";s:6:"target";s:0:"";s:9:"css_class";s:4:"last";s:13:"container_css";s:0:"";s:5:"depth";s:1:"0";}i:22;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:19:"grid_19 alpha omega";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:23;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:24;a:5:{s:4:"type";s:4:"text";s:4:"text";s:136:"PGg1PkNvbXB1dGVyPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTUifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:25;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:26;a:5:{s:4:"type";s:4:"text";s:4:"text";s:136:"PGg1PkNvbXB1dGVyPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTUifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:27;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:28;a:5:{s:4:"type";s:4:"text";s:4:"text";s:136:"PGg1PkNvbXB1dGVyPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTUifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:29;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_4";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:30;a:5:{s:4:"type";s:4:"text";s:4:"text";s:136:"PGg1PkNvbXB1dGVyPC9oNT4Ke3tibG9jayB0eXBlPSJtZWdhbWVudXByby9jYXRhbG9nbmF2aWdhdGlvbiIgbmFtZT0ibWFpbm1lZ2FtZW51IiBjYXRlZ29yeV9pZD0iMTUifX0=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:31;a:7:{s:4:"type";s:4:"hbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"1";}i:32;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_9";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:33;a:5:{s:4:"type";s:4:"text";s:4:"text";s:116:"PGEgaHJlZj0iIyI+PGltZyBjbGFzcz0iZmx1aWQiIHNyYz0ie3ttZWRpYSB1cmw9Ind5c2l3eWcvaW1nbWVudS5naWYifX0iIGFsdD0iIiAvPjwvYT4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}i:34;a:7:{s:4:"type";s:4:"vbox";s:5:"width";s:0:"";s:6:"height";s:0:"";s:7:"spacing";s:0:"";s:9:"css_class";s:6:"grid_9";s:13:"container_css";s:0:"";s:5:"depth";s:1:"2";}i:35;a:5:{s:4:"type";s:4:"text";s:4:"text";s:552:"PHA+TG9yZW0gaXBzdW0gZG9sb3Igc2l0ICBpcnVyZSBkb2xvciBpbiByZXByZWhlbmRlcml0IGluIHZvbHVwdGF0ZSB2ZWxpdCBlc3NlIGNpbGx1bSBkb2xvcmUgZXUgZnVnaWF0IG51bGxhIHBhcmlhdHVyLiBFeGNlcHRldXIgc2ludCBvY2NhZWNhdCBjdXBpZGF0YXQgbm9uIHByb2lkZW50LCBzdW50IGluIGN1bHBhIHF1aSBvZmZpY2lhIGRlc2VydW50IG1vbGxpdCBhbmltIGlkIGVzdCBsYWJvcnVtLjwvcD4KCjxwPkxvcmVtIGlwc3VtIGRvbG9yIHNpdCBhbWV0LCBjb25zZWN0ZXQgYWxpcXVhLiBVdCBlbmltIGFkIG1pbmltIHZlbmlhbSwgcXVpcyBub3N0cnVkIGV4ZXJjaXRhdGlvbiB1bGxhbWNvIGxhYm9yaXMgbmlzaSB1dCBhbGlxdWlwIGV4IGVhIGNvbW1vZG8gY29uc2VxdWF0LiBEdWlzIGF1dGUgaXJ1cmUgLjwvcD4=";s:9:"css_class";s:0:"";s:13:"container_css";s:0:"";s:5:"depth";s:1:"3";}}
EOB
	,
	'status' => "1"
))->setCreatedTime(now())->setUpdateTime(now())->save();
$menu_id_h = $model->getId();

# Mega Menu widget instance
$widget = array(
	'title' => 'Gala YoMarket Area02 Horizontal Mega Menu',
	'store_ids' => $stores,
	'sort_order' => 0,
	'widget_parameters'	=> serialize(array(
		'menu' => $menu_id_h
	)),
	// a:1:{s:4:"menu";s:1:"1";}
	'page_groups' => array(
		array(
			'page_group' => 'all_pages',
			'all_pages' => array(
				'page_id' => 0,
				'layout_handle' => 'default',
				'for' => 'all',
				'block' => 'top.menu'
			)
		)
	),
);
$widgetInstance->setData($widget)->setType('megamenupro/megamenupro')->setPackageTheme($package_theme)->save();

$installer->endSetup();
unlink($pathFile);