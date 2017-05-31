<?php

class Layout extends BaseModel {

	protected $table = 'layouts';

	protected $rules = array(
			'name' 		=> 'required',
		);

	protected static $editLink = 'admin/layouts/edit-layout';

	public function details()
	{
		return $this->hasMany('LayoutDetail', 'layout_id')
        				->orderBy('layout_details.order_no', 'asc');
	}

	public function shapes()
	{
		return $this->hasMany('LayoutDetail', 'layout_id')
					->where('type', 'path')
					->orderBy('layout_details.order_no', 'asc');
	}

	public function images()
	{
		return $this->hasMany('LayoutDetail', 'layout_id')
					->where('type', 'image')
					->orderBy('layout_details.order_no', 'asc');
	}

	public function text()
	{
		return $this->hasMany('LayoutDetail', 'layout_id')
					->where('type', 'text')
					->orderBy('layout_details.order_no', 'asc');
	}

	public static function getSource($toJson = false)
	{
		$arrReturn = [];
		$arrData = self::select('id', 'name', 'svg_file')->orderBy('name', 'asc')->get();
		if( !$arrData->isEmpty() ) {
			foreach($arrData as $data) {
				if( empty($data->svg_file) ) {
					$data->svg_file = 'assets/images/noimage/35x35.gif';
				}
				$arrReturn[$data->id] = ['value' => $data->id, 'text' => $data->name, 'svg' => $data->svg_file];
			}
		}
		if( $toJson ) {
			$arrReturn = json_encode($arrReturn);
		}
		return $arrReturn;
	}

	public static function getLayout($product)
	{
		if( !isset($product['layout_id']) || !$product['layout_id'] ) {
			return $product;
		}
		$product['design'] = [];
		try {
			$product['layout_id'] = json_decode($product['layout_id']);
			foreach($product['layout_id'] as $layoutId) {
				$productLayout = self::with('shapes')
											->find($layoutId)
											->toArray();
				$layout = [];
				$dpi = 72;
				$max_w = 1000;//pt
				$max_h= 500;//pt
				$svg_bleed = 1;
				$svg_w = ($productLayout['wall_size_w'] + 2*$svg_bleed) * $dpi;
				$svg_h = ($productLayout['wall_size_h'] + 2*$svg_bleed) * $dpi;

				$view_dpi = self::getDPIOption($svg_w, $svg_h, $max_w, $max_h);
				$svg_bleed_pt = $svg_bleed*$dpi*$view_dpi; //pt
				$layout = [];
				$layout['id'] = md5($productLayout['name'].$productLayout['id']);
				$layout['name'] = $productLayout['name'];
				$layout['preview'] = $productLayout['svg_file'];
				$layout['width'] = ($svg_w*$view_dpi + $svg_bleed_pt);
				$layout['height'] = ($svg_h*$view_dpi + $svg_bleed_pt);
				$layout['view_dpi'] = $view_dpi;
				$layout['bleed'] = $svg_bleed_pt;
				$wall_w =  $productLayout['wall_size_w'] * $dpi;
				$wall_h =  $productLayout['wall_size_h'] * $dpi;
				if( $wall_w / $max_w > $wall_h / $max_h ) {
					$w = $max_w;
					$view_dpi  = $wall_w / $w;
					$h = $wall_h / $view_dpi;
				} else {
					$h = $max_h;
					$view_dpi = $wall_h / $h;
					$w = $wall_w / $view_dpi;
				}
				$layout['real_width'] = $w;
				$layout['real_height'] = $h;
				$layout['view_dpi'] = $view_dpi;
				$shapes = $productLayout['shapes'];
				unset( $productLayout['shapes'] );
				foreach($shapes as $key => $shape) {
					$shapes[$key]['bleed'] = ($svg_bleed*$dpi*$view_dpi);
					$shapes[$key]['width'] = ($shape['width']*$dpi*$view_dpi + 2*$shapes[$key]['bleed']) ;
					$shapes[$key]['height'] = ($shape['height']*$dpi*$view_dpi + 2*$shapes[$key]['bleed']) ;
					$shapes[$key]['coor_x'] = ($shape['coor_x']*$dpi*$view_dpi);
					$shapes[$key]['coor_y'] = ($shape['coor_y']*$dpi*$view_dpi);
				}
				$product['design'][] = [
					'layout' => $layout,
					'shapes' => $shapes
				];
			}
		} catch(Exception $e) {

		}
		return $product;
	}

	public static function getDPIOption($true_w, $true_h, $view_w, $view_h)
	{
		if($true_w/$view_w > $true_h/$view_h) {
			return $view_w/$true_w;
		} else {
			return $view_h/$true_h;
		}
	}

	public function beforeDelete($layout)
	{
		$layout->boxs()->delete();
	}
}