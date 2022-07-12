<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items
 *
 * @author Ea Design
 */
class EaDesign_PdfGenerator_Helper_Items extends Mage_Core_Helper_Abstract {

	private static $_trans = array(
		'Materiaali' => array('en' => 'Material', 'cn' => '材料'),
		'Väri' => array('cn' => '颜色', 'en' => 'Color'),
		'Mallikoodi' => array('en' => 'Model No.', 'cn' => '型号代码'),
		'Lisätietoja malliin ja yksityiskohtiin liittyen' => array('en' => 'Additional information for the model and details', 'cn' => '了解有关模型和细节的更多信息'),
		'Lisää liite' => array('en' => 'Additional info attach', 'cn' => '添加附件'),
		'Kiinnitys' => array('en' => 'Fastening', 'cn' => '后背的扣法'),
		'Glitter efekti' => array('en' => 'Glitter effects', 'cn' => '闪光效果'),
		'Helman malli' => array('en' => "Hem's model", 'cn' => '下摆型号'),
		'Yksi-tai kaksiosainen' => array('en' => 'One or two piece', 'cn' => '一两件'),
		'Olkaimet' => array('en' => 'Shoulder straps', 'cn' => '肩带'),
		'Olkaimen sijoittelu' => array('en' => 'Strap placement', 'cn' => 'käännös?'),
		'Puvun tyyli (pituus)' => array('en' => 'Lenght', 'cn' => '长度'),
		'Laahus' => array('en' => 'Train', 'cn' => '拖尾'),
		'Halkio' => array('en' => 'Slit', 'cn' => '狭缝'),
		'Yläosan tyyli' => array('en' => 'Upper style', 'cn' => '顶级风格'),
		'Rintamuksen tyyli' => array('en' => 'Bust style', 'cn' => '胸围风格'),
		'Takaosan tyyli' => array('en' => 'Black style', 'cn' => '背式'),
		'Vuorikangas' => array('en' => 'Inner lining', 'cn' => '内衬'),
		'Koristelut (On/Off)' => array('en' => 'Decorations (On/OFF)', 'cn' => '装饰（开/关'),
		'Vyökoriste' => array('en' => 'Waist decorations', 'cn' => '腰饰'),
		'Taskut' => array('en' => 'Pockets', 'cn' => '口袋'),
		'Extra kankaita ja koristeita' => array('en' => 'Extra fabric and decorations', 'cn' => '额外的面料和装饰品'),
		'Irrotettava laahus' => array('en' => 'Detachable train', 'cn' => '可拆卸拖尾'),
		'Koristelu' => array('en' => 'Embroidery', 'cn' => '更多的信息'),
		'Koko' => array('en' => 'Size', 'cn' => '尺码'),
		'Lukio' => array('en' => 'last', 'cn' => '可拆卸拖尾'),
		'Lisätietoja toimitukseen liittyen' => array('en' => 'More information about delivery', 'cn' => '
有关交付的更多信息', ),

		'Pituutesi' => array('en' => 'Your lenght (without shoes)', 'cn' => '长度'),
		'Vaatekokosi' => array('en' => 'Your normal size', 'cn' => 'käännös?'),
		'Rinnanympärys' => array('en' => 'Bust', 'cn' => '胸围'),
		'Vyötärö' => array('en' => 'Waist', 'cn' => '腰围'),
		'Lantio' => array('en' => 'Hip', 'cn' => '臀围'),
		'Olkapäästä vyötäröön' => array('en' => 'From shoulder to waist ', 'cn' => '臀肩到腰'),
		'Vyötäröstä helmaan' => array('en' => 'From waist to hem ', 'cn' => '腰到底边'),
		'Hartiasta rintaan' => array('en' => 'From shoulder to nipple', 'cn' => '肩到胸距离'),
		'Rinnasta rintaan' => array('en' => 'From nipple to nipple', 'cn' => '胸距'),
		'Olkapäästä olkapäähän' => array('en' => 'From shoulder to shoulder', 'cn' => '肩宽'),
		'Kainalon ympärys' => array('en' => 'Arm\'s eye', 'cn' => '袖洞'),
		'Käden ympärys' => array('en' => 'Arm circumference', 'cn' => '大臂'),
		'Hihan pituus' => array('en' => 'Sleeve lenght', 'cn' => '袖长'),
		'Hihan päättymiskohdan ympärys' => array('en' => 'Sleeve circumference (end point) ', 'cn' => '袖口'),
		'Nännistä kaulan takaa nänniin' => array('en' => 'From nipple, behind the neck, to nipple', 'cn' => 'Käännös?'),
		'Kaulan ympärys' => array('en' => 'Neck circumference', 'cn' => '脖子'),
		'Toimitusaika' => array('en' => 'Delivery time', 'cn' => '出货期'),
		'Juhla' => array('en' => 'Party', 'cn' => '晚宴'),
		'Juhlan ajankohta' => array('en' => 'The date of the party', 'cn' => '晚宴日期'),
		'Lisätietoa' => array('en' => 'Additional information:', 'cn' => '更多的信息'),
		'Paketti' => array('en' => 'Accessories package', 'cn' => '配件包装'),
		'Rusetti' => array('en' => 'Bow tie', 'cn' => '弓'),
		'Taskuliina' => array('en' => 'Pocket square', 'cn' => '手帕'),
		'Käsilaukku' => array('en' => 'Handbag', 'cn' => '手提包'),
		'Keeppi' => array('en' => 'Shawl', 'cn' => '小ler碱'),
		'Huivi' => array('en' => 'Scarf', 'cn' => '披肩'),
		'Huntu' => array('en' => 'Veil', 'cn' => '头纱'),
		'Juhlakäsineet' => array('en' => 'Dress gloves', 'cn' => '手套'),
		'Pukupussi' => array('en' => 'Garment bag', 'cn' => '防尘罩'),
		'Vannealushame' => array('en' => 'Petticoat', 'cn' => '蓬裙'),
		'Huivi erikseen' => array('en' => 'Scarf separately', 'cn' => '披肩'),
		'Juhlakäsineet erikseen' => array('en' => 'Dress gloves separately', 'cn' => '手套'),
		'Vannealushame erikseen' => array('en' => 'Petticoat separately', 'cn' => '蓬裙'),
		'Huntu erikseen' => array('en' => 'Veil separately', 'cn' => '头纱'),
		'Pukupussi erikseen' => array('en' => 'Garment bag separately', 'cn' => '防尘罩'),
		'Haluan pukuni silitettynä (suositus)' => array('en' => 'Iron', 'cn' => '熨烫'),
		'Haluan mekon lisäksi kangasta ja extra koristeita' => array('en' => 'Extra fabric and decorations', 'cn' => '额外的面料和材料'),

	);
	private static $_trans_value = array(
		'Vetoketju' => 'Zipper',
		'Nyöritys' => 'Lacing',
		'Vetoketju+napit' => 'Zipper+decorative buttons',
		'Olkaimeton' => 'Strapless',
		'Spagetti' => 'Spaghetti',
		'Molemmat' => 'Both',
		'Oikea' => 'Right',
		'Vasen' => 'Left',
		'Lyhyenä juhlamekkona' => 'Short as a cocktail dress',
		'Pitkänä iltapukuna' => 'Long as an evening dress',
		'Ei laahusta' => 'No train',
		'Lyhyt: 0,5m' => 'Short: 0,5m',
		'Normaali: 1m' => 'Normal: 1m',
		'Pitkä: 1,5m' => 'Long: 1,5m',
		'Ei' => 'No',
		'Kyllä' => 'Yes',
		'Ei halkiota' => 'No slit',
		'Eteen oikealle' => 'Center right',

		'Vasen sivu' => 'Left side',
		'Oikea sivu' => 'Right side',
		'Eteen keskelle' => 'Center front',
		'Eteen vasemmalle' => 'Center left',
		'Taake keskelle' => 'Center back',

		'Muu' => 'Other',
		'Yksi' => 'One',
		'Kaksi' => 'Two',
		'1m2 jokaista kangasta ja kourallinen koristeita' => '1m2 piece of each fabric and handful of decorations',
		'Omat mitat' => 'Custom size',
		'Ilmainen toimitus n. 21 päivää' => 'Free delivery approx. 21 days',
		'Pika n. 10 päivää' => 'Express approx. 10 days',
		'Häät' => 'Wedding',
		'Karonkka' => 'Shindig',
		'Rippijuhla' => 'Confirmation party',
		'Valmistujaiset' => 'Graduation',
		'Vanhojentanssit' => 'Prom',
		'Vuosijuhla' => 'Anniversary',
		'Muu juhla' => 'Other',
		'Gaala' => 'Gala',
		'Juhlamekkopaketti +49,90€' => 'Cocktail dress package',
		'Iltapukupaketti +69,90€' => 'Evening dress package',
		'Vanhojentanssipaketti +109,90€' => 'Prom dress package',
		'Basic Hääpaketti +59,90€' => 'Basic wedding package',
		'Premium Hääpaketti +109,90€' => 'Wedding package',
		'Pukuun sopiva' => 'Which matches the dress',
		'Lyhyt: 1,5m' => 'Short: 1,5m',
		'Normaali: 2m' => 'Normal: 2m',
		'Pitkä: 2,5m' => 'Long: 2,5m',
		'Harmaat' => 'Gray',
		'Luonnonvalkoiset' => 'Off white',
		'Mustat' => 'Black',
		'Valkoiset' => 'White',
		'Pieni' => 'Small',
		'Iso' => 'Large',
		'Merenneito' => 'Maremaid',
		'Huivi' => 'Scarf',
		'Pukupussi' => 'Garment bag',
		'Valitse' => '-',
		'Ei pakettia' => 'No package',
		'Ei valittu' => '-',
		'Choose' => '-',
	);

	/**
	 * Get the part for the item processing system
	 * @param string $src
	 * @param string $start
	 * @param string $end
	 * @return string
	 */
	public function getTheItemsFromBetwin($src, $start, $end) {
		$txt = explode($start, $src);
		$txt2 = explode($end, $txt[1]);
		return trim($txt2[0]);
	}

	/**
	 *
	 * @return \SimpleHtmlDoom_SimpleHtmlDoomLoad
	 */
	public function getTheSimpleHtmlDom() {
		$htmlProcessor = new SimpleHtmlDoom_SimpleHtmlDoomLoad;
		return $htmlProcessor;
	}

	/**
	 * Process the items html.
	 * @param string $tempmplateForHtmlProcess
	 * @return string
	 */
	public function processHtml($tempmplateForHtmlProcess) {
		$htmlProcessor = $this->getTheSimpleHtmlDom()
			->load($tempmplateForHtmlProcess);

		foreach ($htmlProcessor->find('tr') as $e) {

			$numtd = $e->find('td');
			$td = count($numtd);
			if ($td == 1) {
				$e->innertext = '';
				$delteTd = true;
			}
			foreach ($htmlProcessor->find('td') as $e) {
				$plaintext = $e->innertext;
				if ($plaintext == EaDesign_PdfGenerator_Model_Entity_Pdfgenerator::THE_START) {
					$e->parent->outertext = '';
				}
				if ($plaintext == EaDesign_PdfGenerator_Model_Entity_Pdfgenerator::THE_END) {
					$e->parent->outertext = '';
				}
			}
		}
		$htmlProcessorFinish = $htmlProcessor;
		return $htmlProcessorFinish;
	}

	public function getOpts($product_id) {
		$product = Mage::getModel('catalog/product')->load($product_id);
		$options = $product->getOptions();
		return $options;
	}

	/**
	 * Retrieve item options
	 *
	 * @return array
	 */
	public function getItemOptions($options) {
		$result = array();
		if ($options) {
			if (isset($options['options'])) {
				$result = array_merge($result, $options['options']);
			}
			if (isset($options['additional_options'])) {
				$result = array_merge($result, $options['additional_options']);
			}
			if (isset($options['attributes_info'])) {
				$result = array_merge($result, $options['attributes_info']);
			}
		}

		/* Will will be able to split in three */

		foreach ($result as $option => $value) {
			if (isset(self::$_trans[$value['label']]) && isset(self::$_trans[$value['label']]['en'])) {
				$data .= self::$_trans[$value['label']]['en'] . ': ' . $value['value'] . '<br>';
			} else {
				$data .= $value['label'] . ': ' . $value['value'] . '<br>';
			}

		}
		if (isset($data)) {
			$productOptionesLabeled = array(
				'product_options' => array(
					'value' => $data,
					'label' => Mage::helper('pdfgenerator')->__('Product options'),
				),
			);
		}
		return $productOptionesLabeled;
	}

	public function getItemOptions2($options, $product_id) {
		$productOptions = $this->getOpts($product_id);
		$result = array();
		if ($options) {
			if (isset($options['options'])) {
				$result = array_merge($result, $options['options']);
			}
			if (isset($options['additional_options'])) {
				$result = array_merge($result, $options['additional_options']);
			}
			if (isset($options['attributes_info'])) {
				$result = array_merge($result, $options['attributes_info']);
			}
		}

		/* Will will be able to split in three */
/*             foreach ($productOptions as $o)
error_log($o->option_id . ':' .$o->getDefaultTitle() . ':' .$o->getTitle());
 */$data = '<table border="0">';
		foreach ($result as $option => $value) {

			foreach ($productOptions as $o) {

				if ($value['option_id'] == $o->option_id) {
					$name = $value['value'];
					$name = trim(preg_replace("/\(.+\)/", "", $name));
					if ($value['option_type'] == 'radio') {
						$vals = $o->getValues();
						foreach ($vals as $x) {
							if ($x->getOptionTypeId() == $value['option_value']) {

								$name = trim(preg_replace("/\(.+\)/", "", $value['value']));

								if (isset(self::$_trans_value[$name])) {
									$name = self::$_trans_value[$name];
								}

								if ($o->getDefaultTitle() != 'Paketti' && $x->getSku() != 'not_selected') {
									if ($o->getDefaultTitle() == 'Haluan pukuni silitettynä (suositus)' || $o->getDefaultTitle() == 'Väri') {
										$name .= '<br><img src="' . str_replace('https://www.mecco.fi/', '', Mage::getBaseUrl('skin')) . '/frontend/rwd/vista/images/' . $x->getSku() . '.jpg">';
									}

								}

							}
						}
					} else {
						if (isset(self::$_trans_value[$name])) {
							$name = self::$_trans_value[$name];
						}

					}
					if (isset(self::$_trans[$o->getDefaultTitle()]['en'])) {
						$data .= '<tr><td><span style="font-family:sun-extA;">' . self::$_trans[$o->getDefaultTitle()]['cn'] . '</span> / ' . self::$_trans[$o->getDefaultTitle()]['en'] . '</td><td>' . $name . '</td></tr>';
					} else {
						$data .= '<tr><td>' . $o->getDefaultTitle() . '</td><td>' . $name . '</td></tr>';
					}

				}
			}
/*
error_log($value['option_id']. ':' . $value['label'] . ': ' . $value['value']);
if (isset(self::$_trans[$value['label']]) && isset(self::$_trans[$value['label']]['en']))
$data .= self::$_trans[$value['label']]['en'] . ': ' . $value['value'] . '<br>';
else*/
		}
		$data .= '</table>';
		if (isset($data)) {
			$productOptionesLabeled = array(
				'product_options' => array(
					'value' => $data,
					'label' => Mage::helper('pdfgenerator')->__('Product options'),
				),
			);
		}
		return $productOptionesLabeled;
	}

	/**
	 * Retrieve item options
	 *
	 * @return array
	 */

	public function substrCount($haystack, $needle) {
		if (isset($haystack) && isset($needle)) {
			return substr_count($haystack, $needle);
		}
		return false;
	}

}
