<?php

class JTProduct extends JT {

	protected $collection = 'tb_product';

	public static function getOptions($id, $sku = '')
	{
		$arrReturn = [];
		if( strlen($id) == 24 ) {
			$options = self::where('_id', $id)
							->pluck('options');
			$arrReturn = self::getOptionsByData($options);
		} else if( empty($arrReturn) && !empty($sku) ) {
			$options = self::where('sku', $sku)
						->pluck('options');
			$arrReturn = self::getOptionsByData($options);
		}
		return $arrReturn;
	}

	public static function convert($arrData)
	{
		$arrData = self::setDefault($arrData);
		require_once app_path().'/common/MyUnitConverter.php';
		$unitConverter = new MyUnitConverter;
		if( in_array($arrData['sell_by'], ['area', 'permeter']) ){
			$arrData['sizew'] = $unitConverter->myConvert($arrData['sizew'], $arrData['sizew_unit'], 'in', 2);
			$arrData['sizew_unit'] = 'in';
			$arrData['sizeh'] = $unitConverter->myConvert($arrData['sizeh'], $arrData['sizeh_unit'], 'in', 2);
			$arrData['sizeh_unit'] = 'in';
		}
		return $arrData;
	}

	private static function setDefault($arrData, $defaultUnitLength = 'ft')
	{
		$lenghKey=array(
			'Sq. ft.'	=> 'ft',
			'Sq.ft.'	=> 'ft',
			'Sq.in.'	=> 'in',
			'Sq.cm.'	=> 'cm',
			'Sq.m.'		=> 'm',
			'Sq.yard'	=> 'yard',
			'Sq.mm.'	=> 'mm',
		); //default

		$permeterKey=array(
			'Lr. ft.'	=> 'ft',
			'Lr. in.'	=> 'in',
			'Lr. cm.'	=> 'cm',
			'Lr. m.'	=> 'm',
			'Lr. yard'	=> 'yard',
			'Lr. mm.'	=> 'mm',
		); //default
		if(!isset($arrData['sizew_unit']) || $arrData['sizew_unit']=='')
			$arrData['sizew_unit'] = 'in';
		//sizeh_unit
		if(!isset($arrData['sizeh_unit']) || $arrData['sizeh_unit']=='')
			$arrData['sizeh_unit'] = 'in';
		//sizew
		if(isset($arrData['sizew']))
			$arrData['sizew'] = (float)$arrData['sizew'];
		else
			$arrData['sizew'] = 0;
		//sizeh
		if(isset($arrData['sizeh']))
			$arrData['sizeh'] = (float)$arrData['sizeh'];
		else
			$arrData['sizeh'] = 0;

		//oum
		if(!isset($arrData['oum']))
			$arrData['oum'] = 'unit';

		//oum_depend
		if(!isset($arrData['oum_depend']))
			$arrData['oum_depend'] = 'unit';
		if(isset($arrData['oum_depend']) && $arrData['oum_depend']=='Sq. ft.')
			$arrData['oum_depend'] = 'Sq.ft.';

		//sell_price
		if(!isset($arrData['sell_by']))
			$arrData['sell_by'] = '';
		else if($arrData['sell_by']=='area' && isset($arrData['oum']) && isset($lenghKey[$arrData['oum']]))
			$defaultUnitLength = $lenghKey[$arrData['oum']];
		else if($arrData['sell_by']=='lengths' && isset($arrData['oum'])){
			if(!isset($permeterKey[$arrData['oum']]))
				$arrData['oum'] = 'Lr. ft.';
			$defaultUnitLength = $permeterKey[$arrData['oum']];
		}

		//sell_price
		if(isset($arrData['sell_price']))
			$arrData['sell_price'] = (float)$arrData['sell_price'];
		else
			$arrData['sell_price'] = 0;
		return $arrData;
	}

	public static function companyPricebreak($company, $productId)
	{
		$result = ['price_break' =>[], 'sell_category_key' => '', 'discount' => 0];
		if( isset($company['pricing']) ){
			if( is_object($productId) )
				$productId = (string)$productId;
			foreach($company['pricing'] as $value){
				if( isset($value['deleted']) && $value['deleted'] ) continue;
				if( !isset($value['product_id']) || (string)$value['product_id'] != $productId ) continue;
				if( !isset($value['price_break']) ) continue;
				foreach($value['price_break'] as $v){
					if( isset($value['deleted']) && $value['deleted'] ) continue;
						$result['price_break'][] = $v;
				}
			}
		}

		if(isset($company['sell_category_id']))
			$result['sell_category_key'] = $company['sell_category_id'];
		if(isset($company['discount']))
			$result['discount'] = (float)$company['discount'];
		return $result;
	}

	public static function productPricebreak($arrData, $sell_category_key = '')
	{
		$result = [];
		if( isset($arrData['sellprices']) ){
			$result['sell_price'] = '';
			$sell_price_default = 0;
			foreach($arrData['sellprices'] as $value){
				if( isset($value['deleted']) && $value['deleted'] ) continue;
				if( !isset($value['sell_category']) ) continue;
				if($sell_category_key!='' && $value['sell_category'] == $sell_category_key)
					$result['sell_price'] = $value['sell_unit_price'];
				if( isset($value['sell_default']) && (int)$value['sell_default']==1){
					$sell_price_default = $value['sell_unit_price'];
					$sell_category_key_df = $value['sell_category'];
				}
			}
			if($result['sell_price'] == '' && $sell_price_default!='' ){
				$result['sell_price'] = $sell_price_default;
				$sell_category_key = $sell_category_key_df;
			}

		}else if(isset($arrData['sell_price'])){
			$result['sell_price'] = $arrData['sell_price'];
		}
		//tim Price breaks
		if(isset($arrData['pricebreaks']) && is_array($arrData['pricebreaks']) && count($arrData['pricebreaks'])>0){
			foreach($arrData['pricebreaks'] as $key => $value){
				if( isset($value['deleted']) && $value['deleted'] ) continue;
				if( !isset($value['sell_category']) ) continue;
				if( $value['sell_category'] != $sell_category_key ) continue;
				$result['price_break'][$key] = $value;
			}
		}
		return $result;
	}

	public static function priceBreak($arrData, $company)
	{
		$result = [];
		$sell_category = self::companyPricebreak($company,$arrData['_id']);
		if(isset($sell_category['price_break']) && count($sell_category['price_break'])>0)
			$result['company_price_break'] = $sell_category['price_break'];
		if(isset($sell_category['discount']) && $sell_category['discount']!='')
			$result['discount'] = $sell_category['discount'];
		if(!isset($sell_category['sell_category_key']))
			$sell_category['sell_category_key'] = '';
		$sell_break = self::productPricebreak($arrData, $sell_category['sell_category_key']);
		if(isset($sell_break['sell_price']))
			$result['sell_price'] = $sell_break['sell_price'];
		else
			$result['sell_price'] = 0;
		if(isset($sell_break['sell_price_plus']) && $sell_break['sell_price_plus']!='')
			$result['sell_price_plus'] = $sell_break['sell_price_plus'];

		if(isset($sell_break['price_break']) && count($sell_break['price_break'])>0)
			$result['product_price_break'] = $sell_break['price_break'];
		return $result;
	}

	public static function calArea(&$arrData, $unitConverter){
		if(isset($arrData['sizew']) && isset($arrData['sizeh']) && (float)$arrData['sizew']>0 && (float)$arrData['sizeh']>0){
			if(!isset($arrData['sizew_unit']) || $arrData['sizew_unit']=='')
				$arrData['sizew_unit'] = 'in'; //unit default
			if(!isset($arrData['sizeh_unit']) || $arrData['sizeh_unit']=='')
				$arrData['sizeh_unit'] = 'in';//unit default
			$sizew = (float)$arrData['sizew'];
			$sizeh = (float)$arrData['sizeh'];
			$sizew = str_replace(",","",$unitConverter->myConvert($sizew,$arrData['sizew_unit'],'ft',5));
			$sizeh = str_replace(",","",$unitConverter->myConvert($sizeh,$arrData['sizeh_unit'],'ft',5));
			$arrData['area'] =  (float)$sizew * (float)$sizeh;
		}else if(isset($arrData['sell_by']) && $arrData['sell_by']=='unit'){
			$arrData['area'] = 1;
		}else{
			$arrData['area'] = 0;
		}
	}

	//tính chu vi
	public static function calPerimeter(&$arrData, $unitConverter){
		if(isset($arrData['sizew']) && isset($arrData['sizeh']) && (float)$arrData['sizew']>0 && (float)$arrData['sizeh']>0){
			if(!isset($arrData['sizew_unit']) || $arrData['sizew_unit']=='')
				$arrData['sizew_unit'] = 'in'; //unit default
			if(!isset($arrData['sizeh_unit']) || $arrData['sizeh_unit']=='')
				$arrData['sizeh_unit'] = 'in';//unit default
			$sizew = (float)$arrData['sizew'];
			$sizeh = (float)$arrData['sizeh'];
			$sizew = $unitConverter->myConvert($sizew,$arrData['sizew_unit'],'ft',5);
			$sizeh = $unitConverter->myConvert($sizeh,$arrData['sizeh_unit'],'ft',5);
			$arrData['perimeter'] =  2*((float)$sizew + (float)$sizeh);

		}else if(isset($arrData['sell_by']) && $arrData['sell_by']=='unit'){
			$arrData['perimeter'] = 1;
		}else{
			$arrData['perimeter'] = 0;
		}
	}

	public static function calAdjQty(&$arrData){
		if(isset($arrData['sell_by']) && strtolower($arrData['sell_by'])=='area'){
			$arrData['adj_qty'] = (float)$arrData['quantity']*(float)$arrData['area'];
		}else if(isset($arrData['sell_by']) && strtolower($arrData['sell_by'])=='lengths'){
			$arrData['adj_qty'] = (float)$arrData['quantity']*(float)$arrData['perimeter'];
		}else{
			$arrData['adj_qty'] = (float)$arrData['quantity'];
		}
	}

	public static function calPriceBreak(&$arrData){
		$price_break = isset($arrData['price_break']) ? $arrData['price_break'] : [];
		if( isset($price_break['company_price_break']) ){
			usort($price_break['company_price_break'], function($a, $b){
				return $a['range_from'] > $b['range_from'];
			});
			foreach($price_break['company_price_break'] as $keys=>$value){
				if($arrData['adj_qty']<=(float)$value['range_to'] && $arrData['adj_qty']>=(float)$value['range_from']){
					//neu thoa dieu kien
					if(!isset($value['unit_price']))
						$value['unit_price'] = 0;
					$arrData['sell_price'] = (float)$value['unit_price'];
					return true;
				}
			}
		}
		if( isset($price_break['product_price_break']) ){
			usort($price_break['product_price_break'], function($a, $b){
				return $a['range_from'] > $b['range_from'];
			});
			foreach($price_break['product_price_break'] as $keys=>$value){
				if($arrData['adj_qty']<=(float)$value['range_to'] && $arrData['adj_qty']>=(float)$value['range_from']){
					if(!isset($value['unit_price']))
						$value['unit_price'] = 0;
					$arrData['sell_price'] = (float)$value['unit_price'];
					self::discount($arrData); //và tính discount
					$arrData['price_break_from_to'] = $price_break; //luu lai bang price_break da sort
					return true;
				}
			}
		}
		if(isset($price_break['sell_price'])){
			$arrData['sell_price'] = (float)$price_break['sell_price'];
			self::discount($arrData); //và tính discount
			return true;
		}
	}

	public static function discount(&$arrData){
		if(isset($arrData['price_break_from_to']['discount']))
			$arrData['sell_price'] = (1-((float)$arrData['price_break_from_to']['discount']/100))*$arrData['sell_price'];
	}

	public static function calUnitPrice(&$arrData){
		if($arrData['sell_by']=='unit' || $arrData['sell_by']=='Unit')
			$arrData['unit_price'] = (float)$arrData['sell_price'];
		else if($arrData['sell_by']=='lengths' && $arrData['sell_price']!='' && isset($arrData['perimeter']))
			$arrData['unit_price'] = (float)$arrData['sell_price']*(float)$arrData['perimeter'];
		else if($arrData['sell_by']=='area' && $arrData['sell_price']!='' && isset($arrData['area']))
			$arrData['unit_price'] = (float)$arrData['sell_price']*(float)$arrData['area'];
		else if($arrData['sell_by']=='combination')
			$arrData['unit_price'] = (float)$arrData['sell_price']*(float)$arrData['area'];
		else
			$arrData['unit_price'] = 0;
	}

	public static function calSubTotal(&$arrData){
		if(isset($arrData['unit_price']) && $arrData['unit_price']!='' && isset($arrData['quantity']))
			$arrData['sub_total'] = round((float)$arrData['unit_price']*(float)$arrData['quantity'],3);
		else
			$arrData['sub_total'] = 0;
	}

	public static function calSmallArea(&$arrData)
	{
		$hook = JTHook::where('deleted', false)
									->where('name', 'Small area')
									->pluck('options');
		if( !empty($hook) ) {
			usort($hook, function($a, $b){
				return $a['area_limit'] > $b['area_limit'] ;
			});
		} else {
			$hook = [];
		}
		foreach($hook as $smallArea){
			if($arrData['area'] <= (float)$smallArea['area_limit']){
				$arrData['sell_price'] = $arrData['unit_price'] += (float)$arrData['unit_price']*$smallArea['up_price']/100;
				return true;
			}
		}
	}

	public static function calPrice(&$arrData, $calPriceBreak = true)
	{
		require_once app_path().'/common/MyUnitConverter.php';
		$unitConverter = new MyUnitConverter;
		$arrData = self::setDefault($arrData);
		$innerBleed = false;
		if( isset($arrData['bleed_sizew']) && isset($arrData['bleed_sizeh']) ) {
			$innerBleed = true;
			$arrData['sizew'] += $arrData['bleed_sizew'];
			$arrData['sizeh'] += $arrData['bleed_sizeh'];
		}
		self::calArea($arrData, $unitConverter);
		self::calPerimeter($arrData, $unitConverter);
		self::calAdjQty($arrData);
		$bleed = [];
		if( !$innerBleed ) {
			$bleed = self::calBleed($arrData);
		}
		if ($calPriceBreak) {
			self::calPriceBreak($arrData);
		}
		self::calUnitPrice($arrData);
		if( isset($arrData['plus_sell_price']) ){
			$arrData['sell_price'] = $arrData['unit_price'];
			$arrData['sell_price'] += $arrData['plus_sell_price'];
			$arrData['unit_price'] = $arrData['sell_price'];
		}
		if( isset($arrData['sell_by']) && $arrData['sell_by'] == 'area'
				&& isset($arrData['pricing_method']) && $arrData['pricing_method'] == 'small_area'  )
			self::calSmallArea($arrData);
		self::calSubTotal($arrData);
		if( !empty($bleed) ) {
			$arrData['adj_qty'] = $bleed['adj_qty'];
			$arrData['area'] = $bleed['area'];
			$arrData['perimeter'] = $bleed['perimeter'];
		} else if( $innerBleed ) {
			$arrData['sizew'] -= $arrData['bleed_sizew'];
			$arrData['sizeh'] -= $arrData['bleed_sizeh'];
			$arrData['bleed'] = true;
			self::calArea($arrData, $unitConverter);
			self::calPerimeter($arrData, $unitConverter);
			self::calAdjQty($arrData);
		}
	}

	public static function calTax(&$arrData){
		if(isset($arrData['taxper']) && is_numeric($arrData['taxper']) && isset($arrData['sub_total']))
			$arrData['tax'] = round(((float)$arrData['taxper']/100)*(float)$arrData['sub_total'],3);
		else
			$arrData['tax'] = 0;
	}

	public static function calAmount(&$arrData){
		$arr = $arrData;
		if(isset($arrData['sub_total']) && isset($arrData['tax']))
			$arrData['amount'] = round((float)$arrData['sub_total']+(float)$arrData['tax'],3);
	}

	public static function netDiscount(&$sum, $discount)
	{
		$discountPrice = 0;
		if( $discount ) {
			$discount = (float)$discount;
			$discountPrice = round(( $sum * $discount ) / 100, 3);
			$sum -= $discountPrice;
		}
		return $discountPrice;
	}

	public static function calBleed(&$arrData, $callFromOutside = false)
	{
		if( $callFromOutside )
			$arrData = self::setDefault($arrData);
		if(( $callFromOutside || (!isset($arrData['same_parent']) || !$arrData['same_parent']) )
			&& isset($arrData['sizew']) && isset($arrData['sizeh']) ) {
			$productBleed = self::select('pricing_bleed')
						->where('_id', new MongoId($arrData['_id']) )
						->first();
			if( isset($productBleed['pricing_bleed'])  && is_numeric($productBleed['pricing_bleed']) ) {
				require_once app_path().'/common/MyUnitConverter.php';
				$unitConverter = new MyUnitConverter;
				$productBleed = $productBleed['pricing_bleed'];
				$bleed = JTStuff::select('option')
						->where('value', 'bleed_type')
						->first();
				if( isset($bleed['option']) ) {
					$bleed = array_filter($bleed['option'], function($arrData) use($productBleed){
						return $arrData['key'] == $productBleed;
					});
					if( empty($bleed) )
						return array();
					$bleed = reset($bleed);
					if( !isset($arrData['sizew_unit']) || empty($arrData['sizew_unit']) )
						$arrData['sizew_unit'] = 'in'; //unit default
					if( !isset($arrData['sizeh_unit']) || empty($arrData['sizeh_unit']) )
						$arrData['sizeh_unit'] = 'in';//unit default
					$bleedw = (float)str_replace(",","",$unitConverter->myConvert($bleed['sizew'],$bleed['sizew_unit'],$arrData['sizew_unit'],5));
					$bleedh = (float)str_replace(",","",$unitConverter->myConvert($bleed['sizeh'],$bleed['sizeh_unit'],$arrData['sizeh_unit'],5));
					$arr_return = array();
					if( $callFromOutside ) {
						$arr_return = array(
								'bleed_sizew' => $bleedw,
								'bleed_sizeh' => $bleedh,
							);
					} else if($arrData['sell_by'] != 'unit') {
						$sizew = str_replace(",","",$unitConverter->myConvert($arrData['sizew'],$arrData['sizew_unit'],'ft',5));
						$sizeh = str_replace(",","",$unitConverter->myConvert($arrData['sizeh'],$arrData['sizeh_unit'],'ft',5));
						$area = ($sizew + $bleedw) * ($sizeh + $bleedh);
						$perimeter = (($sizew + $bleedw) + ($sizeh + $bleedh)) / 2;
						$oldAdjQty = $arrData['adj_qty'];
						$oldArea = $arrData['area'];
						$oldPerimeter= $arrData['perimeter'];
						$arrData['area'] = $area;
						$arrData['perimeter'] = $perimeter;
						$arrData['adj_qty'] = (float)$arrData['quantity']* $area;
						$arrData['bleed'] = true;
						$arr_return = array('adj_qty' => $oldAdjQty, 'area' => $oldArea, 'perimeter' => $oldPerimeter);
					}
					return $arr_return;
				}
			}
		}
		$arrData['bleed'] = false;
		return array();
	}

	public static function getDefaultPrice($product)
	{
		if( isset($product->sku) ) {
			$sell_price = self::where('sku', $product->sku)->where('deleted', false)->pluck('sell_price');
			return (float)$sell_price;
		}
		return 0;
	}

	public static function getOptionsByData($options)
	{
		$arrReturn = [];
		if( !empty($options) && is_array($options) ) {
			foreach($options as $key => $option) {
				if( !isset($option['deleted']) || $option['deleted'] ) continue;
				if( !isset($option['product_id']) || !is_object($option['product_id']) ) continue;
				if( !isset($products[(string)$option['product_id']]) ) {
					$product = self::select('code', 'sku', 'name', 'sell_price', 'oum')
							->where('_id', $option['product_id'])
							->first()
							->toArray();
					if( strpos($product['name'], 'Wrap Depth') !== false ) continue;
					$products[(string)$option['product_id']] = $product;
				} else {
					$product = $products[(string)$option['product_id']];
				}
				$option = array_merge($product, $option);
				unset($option['_id']);
				$option['id'] = $key;
				$option['unit_price'] = isset($option['unit_price']) ? $option['unit_price'] : $product['sell_price'];
				$option['discount'] = isset($option['discount']) ? $option['discount'] : 0;
				$option['sub_total'] = $option['unit_price'] * $option['quantity'];
				$option['sub_total'] = $option['sub_total'] - ($option['sub_total'] * $option['discount']) / 100;
				$option['unit_price'] = number_format((float)$option['unit_price'], 2);
				$option['discount'] = number_format((float)$option['discount'], 2);
				$option['sub_total'] = number_format((float)$option['sub_total'], 2);
				$arrReturn[$key] = $option;
			}
			unset($products, $options);
		}
		return $arrReturn;
	}

	public static function calJTBleed(&$jt_product, $options, $bleed)
	{
		if( $bleed > 0 ) {
		    $bleed      += 1; // JT dung cong thuc (bleed + 1)*2 khi ung voi VI
		}
		//=============Cal-Bleed=============
		$jt_product['bleed_sizew'] = $bleed * 2;
		$jt_product['bleed_sizeh'] = $bleed * 2;
		$lineBleed = self::calBleed($jt_product, true);
		if( !empty($lineBleed) ){
		    $jt_product['bleed_sizew'] += $jt_product['bleed_sizew'];
		    $jt_product['bleed_sizeh'] += $jt_product['bleed_sizeh'];
		}
		//=============End Cal-Bleed=========
		//=============Loop option bleed=============
		if( !empty($options)  ) {
		    foreach($options as $option){
		        if(isset($option['deleted']) && $option['deleted']) continue;
		        if( !isset($option['product_id']) || !is_object($option['product_id']) ) continue;
		        if(isset($option['same_parent'])&&$option['same_parent']){
		                $option['_id'] = $option['product_id'];
		                $option['sizew'] = $jt_product['sizew'];
		                $option['sizeh'] = $jt_product['sizeh'];
		                $option['sizew_unit'] = $option['sizeh_unit'] = 'in';
		                $optionBleed = self::calBleed($option, true);
		                if( !empty($optionBleed) ) {
		                    $jt_product['bleed_sizew'] += $optionBleed['bleed_sizew'];
		                    $jt_product['bleed_sizeh'] += $optionBleed['bleed_sizeh'];
		                }
		        }
		    }
		}
		//=============Loop option bleed=========
		//=============Check bleed=============
		if( isset($jt_product['bleed_sizew']) && !$jt_product['bleed_sizew'] ) unset($jt_product['bleed_sizew']);
		if( isset($jt_product['bleed_sizeh']) && !$jt_product['bleed_sizeh'] ) unset($jt_product['bleed_sizeh']);
		//=============End Check bleed=========
	}

	public static function calPlusPrice(&$jt_product, $options, $company = [])
	{
		$plus_sell_price = $totalOtherLine = 0;
		if( !empty($options) ) {
		    foreach($options as $option){
		        if( !isset($option['same_parent']) )
		            $option['same_parent'] = 0;
		        else
		            $option['same_parent'] = 1;
		        $option['sizew'] = $jt_product['sizew'];
		        $option['sizeh'] = $jt_product['sizeh'];
		        $option['sizew_unit'] = $jt_product['sizew_unit'];
		        $option['quantity'] = isset($option['quantity']) ? $option['quantity'] : 0;
		        $option['price_break'] = self::priceBreak($option, $company);
		        if( $option['same_parent'] ){
		            if( isset($jt_product['bleed_sizew']) ) {
		                $option['bleed_sizew'] = $jt_product['bleed_sizew'];
		            }
		            if( isset($jt_product['bleed_sizeh']) ) {
		                $option['bleed_sizeh'] = $jt_product['bleed_sizeh'];
		            }
		            $tmpOpt = $option;
		            $tmpOpt['quantity'] *= $jt_product['quantity'];
		            self::calPrice($tmpOpt);
		            $option['sell_price'] = $tmpOpt['sell_price'];
		            unset($tmpOpt);
		        }
		        self::calPrice($option);
		        if( !$option['same_parent'] && isset($company['net_discount']) ){
		            $tmpPrice = $option['sell_price'];
		            self::netDiscount($option['sub_total'], $company['net_discount']);
		            self::netDiscount($option['sell_price'], $company['net_discount']);
		            $option['unit_price'] = $option['sell_price'];
		        }
	            if( $option['same_parent'] ){
	                $plus_sell_price += $option['sub_total'];
	            }else {
					if( isset($company['net_discount']) ){
						self::netDiscount($option['sub_total'], $company['net_discount']);
					}
					$totalOtherLine += $option['sub_total'];
				}
		    }
		}
		$jt_product['plus_sell_price'] = $plus_sell_price;
		$jt_product['total_other_line'] = $totalOtherLine;
	}

	public static function getPrice($data)
	{
		$arrReturn = ['sell_price'=> 0, 'sub_total'=> 0];
		if( !isset($data['_id']) || strlen($data['_id']) != 24 ) {
			return $arrReturn;
		}

		$sizeW = isset($data['sizew']) ? $data['sizew'] : '';
		$sizeH = isset($data['sizeh']) ? $data['sizeh'] : '';
		$quantity 	= isset($data['quantity']) ? $data['quantity'] : '';
		$fileQuantity = isset($data['fileQuantity']) ? $data['fileQuantity'] : '';
		$company_id = isset($data['companyId']) ? $data['companyId'] : '';
		$options 	= isset($data['options']) ? $data['options'] : [] ;

		$product = self::select('_id', 'name', 'sell_by', 'sell_price','options', 'pricebreaks', 'sellprices', 'pricing_method')
							->where('_id', '=', new MongoId( $data['_id'] ))
							->where('deleted', '=', false)
							->first();
		if( is_object($product) ) {
			$product = $product->toArray();
			$product['sizew'] = $sizeW;
			$product['sizeh'] = $sizeH;
			$product['sizew_unit'] = $product['sizeh_unit'] = 'in';
			$product['quantity'] = $quantity;
			$company = [];
			if( !empty($company_id) && strlen($company_id) == 24 ){
				$company = JTCompany::select('sell_category','sell_category_id','pricing','discount', 'net_discount')
									->where('deleted', '=', false)
									->where('_id', '=', new MongoId($company_id))
									->first();
				if( is_object($company) )
					$company = $company->toArray();
				else
					$company = [];
			}
			$product['price_break'] = self::priceBreak($product, $company);
			if( !isset($product['options']) ) {
				$product['options'] = [];
			}
			$arrOptions = [];
			foreach($options as $option_id => $option){
				foreach($product['options'] as $opt_k => $opt){
					if( isset($opt['deleted']) && $opt['deleted'] || !is_object($opt['product_id']) ){
						unset($product['options'][$opt_k]); continue;
					}
					if( (string)$opt['product_id'] == $option_id ){
						$tmpOpt = self::select('name', 'sell_price','sell_by', 'pricebreaks', 'sellprices', 'pricing_method')
							->where('_id', '=', new MongoId( $opt['product_id']  ))
							->where('deleted', '=', false)
							->first();
						if( is_object($tmpOpt) ){
							$tmpOpt = $tmpOpt->toArray();
							$opt = array_merge($opt, $tmpOpt);
						}
						$opt = array_merge($opt, $option);
						if( !isset($opt['same_parent']) || !$opt['same_parent'] ){
							$opt['same_parent'] = 0;
							$opt['quantity'] = isset($opt['quantity']) && $opt['quantity'] ? $opt['quantity'] : 1;
						} else {
							$opt['quantity'] = isset($opt['quantity']) && $opt['quantity'] ? $opt['quantity'] : 1;
						}
						$opt['require'] = isset( $opt['require'] ) ? $opt['require'] : 0;
						//get file_qty for Digital File Process and Print
						if( in_array($option_id, ['5284a3ee222aad54140002fa','5284a42e222aad54140003c1']) && $opt['require'] ){
							$opt['quantity'] = $fileQuantity;
							if ( $opt['quantity']<=0 ) {
								unset($product['options'][$opt_k]);
								continue 2;
							}
						}
						$opt['choose'] = isset($option['choose']) ? 1 : 0;
						$arrOptions[] = $opt;
						unset($product['options'][$opt_k]);
						break;
					}
				}
			}
			$plusSellPrice = $totalOtherLine = 0;
			//=============Cal-Bleed=============
			$lineBleed = self::calBleed($product, true);
			if( !empty($lineBleed) ){
            	$product['bleed_sizew'] = $lineBleed['bleed_sizew'];
            	$product['bleed_sizeh'] = $lineBleed['bleed_sizeh'];
        	} else {
        		$product['bleed_sizew'] = $product['bleed_sizeh'] = 0;
        	}
            //=============End Cal-Bleed=========
			//=============Loop option bleed=============
        	foreach($arrOptions as $option) {
        		if(isset($option['same_parent'])&&$option['same_parent']
        			&& $option['choose']){
        				$option['sizew'] = $sizeW;
        				$option['sizeh'] = $sizeH;
        				$option['sizew_unit'] = $option['sizeh_unit'] = 'in';
						$optionBleed = self::calBleed($option, true);
						if( !empty($optionBleed) ) {
		                	$product['bleed_sizew'] += $optionBleed['bleed_sizew'];
		                	$product['bleed_sizeh'] += $optionBleed['bleed_sizeh'];
						}
        		}
        	}
            //=============Loop option bleed=========
			//=============Check bleed=============
            if( isset($product['bleed_sizew']) && !$product['bleed_sizew'] ) unset($product['bleed_sizew']);
            if( isset($product['bleed_sizeh']) && !$product['bleed_sizeh'] ) unset($product['bleed_sizeh']);
            //=============End Check bleed=========
			foreach($arrOptions as $option) {
				if( isset($option['same_parent']) && $option['same_parent'] ){
					$option['sizew'] = $sizeW;
					$option['sizeh'] = $sizeH;
					$option['sizew_unit'] = $option['sizeh_unit'] = 'in';
					if( isset($product['bleed_sizew']) ) {
						$option['bleed_sizew'] = $product['bleed_sizew'];
					}
					if( isset($product['bleed_sizeh']) ) {
						$option['bleed_sizeh'] = $product['bleed_sizeh'];
					}
					$tmp = $option;
					$tmp['price_break'] = self::priceBreak($tmp, $company);
					$tmp['quantity'] *= $quantity;
					self::calPrice($tmp);
					$option['sell_price'] = $tmp['sell_price'];
					unset($tmp);
				} else {
					$option['price_break'] = self::priceBreak($option, $company);
				}
				self::calPrice($option);

				if( !$option['choose'] ) continue;
				if( $option['same_parent'] ) {
					$plusSellPrice += $option['sub_total'];//S.P thi cong don de nhan qty line chinh
				}
				else {
					$totalOtherLine += $option['sub_total'];//khong phai SP thi tinh rieng va total lai
				}
			}
			//=============Check bleed=============
            if( isset($product['bleed_sizew']) && !$product['bleed_sizew'] ) unset($product['bleed_sizew']);
            if( isset($product['bleed_sizeh']) && !$product['bleed_sizeh'] ) unset($product['bleed_sizeh']);
            //=============End Check bleed=========
			$product['plus_sell_price'] = $plusSellPrice;
			self::calPrice($product, 1);
			if( isset($company['net_discount']) ){
				self::netDiscount($product['sub_total'], $company['net_discount']);
				self::netDiscount($product['sell_price'], $company['net_discount']);
				$product['unit_price'] = $product['sell_price'];
			}
			if( $quantity )
				$product['sell_price'] += $totalOtherLine/$quantity;
			$product['sub_total'] += $totalOtherLine;
			if( !$quantity )
				$product['sell_price'] = $product['sub_total'] = 0;
			$arrReturn = [
						'sell_price' 	=> $product['sell_price'],
						'sub_total' 	=> $product['sub_total'],
					];
		}

		if( isset($data['fields']) ) {
			foreach($data['fields'] as $field) {
				$arrReturn[ $field ] = isset($product[$field]) ? $product[$field] : '';
			}
		}

		return $arrReturn;
	}

	public static function findJT($product)
	{
		$product['jt_products'] = [];
		if( is_object($product) ) {
			$product = $product->toArray();
		}
		try {
			$product['jt_products'] = ProductJTProduct::select('jt_id')
														->where('product_id', $product['id'])
														->get()
														->toArray();
			foreach($product['jt_products'] as $key => $p) {
				$product['jt_products'][$key]['name'] = $product['name'];
				$p = array_merge(['name' => '', 'products_upload' => []], $p);
				$jt_product = self::select('name', 'products_upload')->where('_id', new MongoId($p['jt_id']))->first();
				if( is_object($jt_product) ) {
					$p = array_merge($p, $jt_product->toArray());
				}
				$product['jt_products'][$key]['name'] = $p['name'];
				$product['jt_products'][$key]['image'] = '';
				foreach ($p['products_upload'] as $image) {
					if(	!$image['deleted'] && !empty($image['path']) ) {
						$product['jt_products'][$key]['image'] = JT_URL.$image['path'];
						break;
					}
				}

			}
		} catch(Exception $e) {

		}
		return $product;
	}
}
