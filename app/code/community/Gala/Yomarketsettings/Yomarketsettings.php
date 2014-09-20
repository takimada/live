<?php
/**
 * @deprecated use Mage::helper('yomarketsettings') instead
 * @methods:
 * - get[Section]_[ConfigName]($defaultValue = '')
 */
class Gala_Yomarketsettings_Yomarketsettings
{
	static function __callStatic($name, $args) {
		if (method_exists(self, $name))
			call_user_func_array(array(self, $name), $args);
			
		elseif (preg_match('/^get([^_][a-zA-Z0-9_]+)$/', $name, $m)) {
			$segs = explode('_', $m[1]);
			foreach ($segs as $i => $seg)
				$segs[$i] = strtolower(preg_replace('/([^A-Z])([A-Z])/', '$1_$2', $seg));

			$value = Mage::getStoreConfig('yomarket/'.implode('/', $segs));
			if (!$value) $value = @$args[0];
			return $value;
		}
		
		else 
			call_user_func_array(array(self, $name), $args);
	}

	
	/**
	 * @return array
	 */
	public function getAllCssConfig() {
		$page_bg_image = Mage::getStoreConfig('yomarket/typography/page_bg_file') ? Mage::getBaseUrl('media').'background/'.Mage::getStoreConfig('yomarket/typography/page_bg_file')
			: (Mage::getStoreConfig('yomarket/typography/page_bg_image') ? '../images/stripes/'.Mage::getStoreConfig('yomarket/typography/page_bg_image') : '');
			
		return array(
			'general_color' => Mage::getStoreConfig('yomarket/typography/general_color'),
			'primary_color' => Mage::getStoreConfig('yomarket/typography/primary_color'),
			'secondary_color' => Mage::getStoreConfig('yomarket/typography/secondary_color'),
			'secondary2_color' => Mage::getStoreConfig('yomarket/typography/secondary2_color'),
			'negative_color' => Mage::getStoreConfig('yomarket/typography/negative_color'),
            'negative2_color' => Mage::getStoreConfig('yomarket/typography/negative2_color'),
			'line_color' => Mage::getStoreConfig('yomarket/typography/line_color'),
			'primary_bgcolor' => Mage::getStoreConfig('yomarket/typography/primary_bgcolor'),
			'secondary_bgcolor' => Mage::getStoreConfig('yomarket/typography/secondary_bgcolor'),
            'secondary2_bgcolor' => Mage::getStoreConfig('yomarket/typography/secondary2_bgcolor'),
            'negative_bgcolor' => Mage::getStoreConfig('yomarket/typography/negative_bgcolor'),
			'page_bg_image' => $page_bg_image,
			'button1' => Mage::getStoreConfig('yomarket/typography/button1'),
			'button2' => Mage::getStoreConfig('yomarket/typography/button2'),
			'button3' => Mage::getStoreConfig('yomarket/typography/button3'),
			'general_font' => Mage::getStoreConfig('yomarket/typography/general_font'),
			'h1_font' => Mage::getStoreConfig('yomarket/typography/h1_font'),
			'h2_font' => Mage::getStoreConfig('yomarket/typography/h2_font'),
			'h3_font' => Mage::getStoreConfig('yomarket/typography/h3_font'),
			'h4_font' => Mage::getStoreConfig('yomarket/typography/h4_font'),
			'h5_font' => Mage::getStoreConfig('yomarket/typography/h5_font'),
			'box_shadow' => Mage::getStoreConfig('yomarket/typography/box_shadow'),
			'rounded_corner' => Mage::getStoreConfig('yomarket/typography/rounded_corner'),
			'additional_css_file' => Mage::getStoreConfig('yomarket/typography/additional_css_file'),
            'custom_css' => Mage::getStoreConfig('yomarket/typography/custom_css'),
		);
	}  
}