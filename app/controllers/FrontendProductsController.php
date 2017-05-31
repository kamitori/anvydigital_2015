<?php
class FrontendProductsController extends BaseController {

	public function product($categoryName, $productName)
	{
		$product = Product::where('short_name', $productName)
										->first();
		if( !is_object($product) ) {
			return App::abort(404);
		}
		if( $product->short_name !== $productName ) {
			return Redirect::to(URL.'/'.$categoryName.'/'.$product->short_name);
		}
		$data = Cache::tags('products')->remember('frontendProduct-'.$product->id, 30, function() use($product, $categoryName){
			$product['cover'] = $product->cover;
			if( is_object($product['cover']) && isset($product['cover'][0]) ) {
				$image = [
									'thumb' => URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $product['cover'][0]['path']),
									'image' => URL.'/'. $product['cover'][0]['path'],
								];
				unset($product['cover']);
				$product['cover'] = $image;
			} else {
				$product['cover'] = [];
			}

			$product['overview'] = $product->overview;
			if( is_object($product['overview'])  ) {
				$arrImages = [];
				foreach($product['overview'] as $key => $overview) {
					$arrImages[] = [
									'thumb' => URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $overview['path']),
									'image' => URL.'/'.$overview['path'],
								];
				}
				unset($product['overview']);
				$product['overview'] = $arrImages;
			} else {
				$product['overview'] = [];
			}
			$tabs = $product->tabs;
			$optionGroups = $product->optionGroups;
			$options = $product->options;
			$arrTabs = [];
			foreach($tabs as $tab) {
				$tab->name_id = md5($tab->id.'-'.$tab->name);
				$arrTabs[$tab->id] = [
									'tab' => $tab->toArray(),
									'groups' => []
								];
				foreach($optionGroups as $key => $group) {
					if( $group->tab_id == $tab->id ) {
						$arrOptions = [];
						foreach($options as $k => $option) {
							$option['images'] = $option->images;
							if( is_object($option['images']) && isset($option['images'][0]) ) {
								$image = [
													'thumb' => URL.'/'.str_replace('assets/images/product-options', 'assets/images/product-options/thumbs', $option['images'][0]['path']),
													'image' => URL.'/'. $option['images'][0]['path'],
												];
								unset($option['images']);
								$option['images'] = $image;
							} else {
								$option['images'] = [];
							}
							if( $option->option_group_id == $group->id ) {
								$arrOptions[] = $option->toArray();
								unset($options[$k]);
							}
						}
						$group['options'] = $arrOptions;
						$arrTabs[$tab->id]['groups'][] = $group->toArray();
						unset($optionGroups[$key]);
					}
				}
			}
			unset($product['tabs'], $product['optionGroups'], $product['options']);
			$product['tabs'] = $arrTabs;
			$category = ProductCategory::where('short_name', $categoryName)
										->first();
			return ['product' => $product, 'category' => $category];
		});

		$product = $data['product'];
		$category = $data['category'];

		if( $product->meta_title ) {
			$this->layout->metaInfo['title_site'] = $product->meta_title;
		} else {
			$this->layout->metaInfo['title_site'] = $product->name.' | '.$this->layout->metaInfo['title_site'];
		}
		if( $product->meta_description ){
			$this->layout->metaInfo['meta_description'] = $product->meta_description;
		}
		if( is_object($category) ) {
			$this->layout->breakcrumb = [URL .'/'. $category->short_name => $category->name, $product->name];
		}

		$this->layout->content = View::make('frontend'.$this->mobiledir.'.products.product-one')->with([
																				'product' => JTProduct::findJT($product),
																				'user'	  => $this->layout->user,
																				'designLink' => URL.'/design/'.$productName
																			]);

	}

	public function category($categoryName)
	{
		$category = ProductCategory::where('short_name', $categoryName)
										->first();
		if( !is_object($category) ) {
			return App::abort(404);
		}
		if( $category->short_name !== $categoryName ) {
			return Redirect::to(URL.'/'.$category->short_name);
		}
		$categories = $category->categories;
		$arrCategoryId = [];
		$arrCategoryId[] = $category->id;
		foreach($categories as $cate) {
			$arrCategoryId[] = $cate->id;
		}
		$products = Product::select('id', 'name', 'short_name', 'short_description')
									->with('cover')
									->whereRaw('id IN('. DB::raw('SELECT product_id
																	FROM products_categories
																	WHERE category_id in ('.implode(', ', $arrCategoryId).')').')')
									->where('active', 1)
									->orderBy('name', 'asc')
									->get();
		if( !$products->isEmpty() ) {
			$products = $products->toArray();
			foreach($products as $k => $product) {
				$cover = '';
				if( isset($product['cover']) && isset($product['cover'][0]) ) {
					$cover = URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $product['cover'][0]['path']);
				}
				$products[$k]['cover'] = $cover;
				$products[$k]['url'] = URL.'/'.$category->short_name.'/'.$product['short_name'];
			}
		} else {
			$products = [];
		}
		if( $category->meta_title ) {
			$this->layout->metaInfo['title_site'] = $category->meta_title;
		} else {
			$this->layout->metaInfo['title_site'] = $category->name.' | '.$this->layout->metaInfo['title_site'];
		}
		if( $category->meta_description ){
			$this->layout->metaInfo['meta_description'] = $category->meta_description;
		}
		$this->layout->breakcrumb = [$category->name];
		$this->layout->content = View::make('frontend.products.product-all')->with([
																				'products' => $products,
																				'category' => $category->toArray()
																			]);
	}

	public function search()
	{
		$search = Input::get('s');
		if( empty($search) ) {
			return Redirect::to(URL);
		}
		try {
			$products = Product::select('id', 'name', 'short_name', 'short_description')
										->with('cover')
										->OrWhere(function($query) use ($search){
											$query->where('name', 'like', '%'.$search.'%')
												->where('active', 1);
										})
										->OrWhere(function($query) use ($search){
											$query->where('short_description', 'like', '%'.$search.'%')
												->where('active', 1);
										})
										->OrWhere(function($query) use ($search){
											$query->where('description', 'like', '%'.$search.'%')
												->where('active', 1);
										})
										->orderBy('name', 'asc')
										->get()
										->toArray();
			foreach($products as $k => $product) {
				$cover = '';
				if( isset($product['cover']) && isset($product['cover'][0]) ) {
					$cover = URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $product['cover'][0]['path']);
				}
				$products[$k]['cover'] = $cover;
				$products[$k]['url'] = URL.'/products/'.$product['short_name'];
			}
		} catch (Exception $e) {
			$products = [];
		}
		$this->layout->search = $search;
		$this->layout->content = View::make('frontend.products.product-all')->with([
																				'products' => $products,
																				'category' => ['name' => 'Search: '.$search]
																			]);
	}

	public function info()
	{
		$arrReturn = ['status' => 'error', 'message' => 'We cannot find any infomation belong to this product.'];
		if( Input::has('product_id') ){
			$product_id = Input::get( 'product_id' );
			$product = JTProduct::select('_id','name', 'sku', 'sizew', 'sizew_unit', 'sizeh', 'sizeh_unit', 'oum', 'oum_depend', 'sell_by', 'unit_price','options', 'products_upload', 'product_desciption', 'pricing_method')
								->where('_id', '=', new MongoId($product_id))
								->where('deleted', '=', false)
								->first();
			if( is_object($product) ) {
				$product = $product->toArray();
				$product = array_merge([
										'product_desciption' 	=> '',
										'sizew'					=> 12,
										'sizeh'					=> 12,
										'layout_id'				=> 0,
										'options' 				=> [],
									], $product);
				if( Input::has('pid') ) {
					$product['layout_id'] = ProductJTProduct::where('jt_id', $product_id)->where('product_id', Input::get('pid'))->pluck('layout_id');
					if( $product['layout_id'] ) {
						$product = Layout::getLayout($product);
					}
				}
				if( !$product['sizew'] ) {
					$product['sizew'] = 12;
				}
				if( !$product['sizeh'] ) {
					$product['sizeh'] = 12;
				}
 				$image = URL.'/assets/images/noimage/no-image.png';
				if( isset($product['products_upload']) ){
					foreach($product['products_upload'] as $upload){
						if( isset($upload['deleted']) && $upload['deleted'] ) continue;
						if( empty($upload['path']) ) continue;
						$image = JT_URL.$upload['path'];
					}
				}
				$product['image'] = $image;
				$product = JTProduct::convert($product);
				foreach( $product['options'] as $key => $option ) {
					if( isset($option['deleted']) && $option['deleted'] ){
						unset($product['options'][$key]);
						continue;
					}
					if( !is_object($option['product_id']) ) continue;
					$optionProduct = JTProduct::select('name')
												->where('_id', '=', new MongoId($option['product_id']))
												->where('deleted', '=', false)
												->first();
					if( !is_object($optionProduct) ) continue;
					$require = isset( $option['require'] ) && $option['require'] ? 1 : 0;
					$quantity = '';
					if( $require )
						$quantity = 1;
					$product['options'][$key] = array(
								'_id'	=> $optionProduct->_id,
								'name' 	=> $optionProduct->name,
								'group'	=> isset( $option['option_group'] ) ? (string)$option['option_group'] : '',
								'group_type'	=> isset( $option['group_type'] ) && $option['group_type'] == 'Inc' ? 'Inc' : 'Exc',
								'require' 		=> $require,
								'same_parent' 	=> isset( $option['same_parent'] ) && $option['same_parent'] ? 1 : 0,
								'quantity' 	=> $quantity,
								'hidden'	=> isset( $option['hidden']) && $option['hidden'] ? 1 : 0,
						);
				}
				$product['options'] = array_values($product['options']);
				if( !empty($product['options']) ){
					usort($product['options'], function($a , $b){
						if( $a['same_parent'] < $b['same_parent'] )
							return true;
						if( $a['same_parent'] == $b['same_parent'] ){
							if( $a['group'] == $b['group'] ){
								return strcmp($a['name'], $b['name']);
							}
							return strcmp($a['group'], $b['group']);
						}
					});
				}
				$arrReturn = ['status' => 'ok', 'product'=> $product];
			}
		}
		return $arrReturn;
	}

	public function calculate()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$arrReturn = ['status' => 'error', 'message' => 'Not enough infomation to process the calculation.'];
		if( Input::has('_id') ){
			$price = JTProduct::getPrice([
											'_id' 	=> Input::get('_id'),
											'sizew' => Input::get('sizew'),
											'sizeh' => Input::get('sizeh'),
											'fileQuantity' => Input::get('file_qty'),
											'quantity' 	=> Input::get('quantity'),
											'companyId'	=> Auth::user()->get()->company_id,
											'options'	=> Input::has('options') ? Input::get('options') : []
										]);
			$arrReturn = ['status' => 'ok', 'data' => [
												'sell_price' => number_format($price['sell_price'], 2),
												'sub_total'  => number_format($price['sub_total'], 2),
											]];
		}
		return Response::json($arrReturn);
	}

}
