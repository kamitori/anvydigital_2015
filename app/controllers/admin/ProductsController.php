<?php

class ProductsController extends AdminController {

	public static $table = 'products';

	public function index()
	{
		$this->layout->title = 'Products';
		$this->layout->content = View::make('admin.products-all')->with([
																		'arrCategories' => ProductCategory::getSource()
																	]);
	}

	public function listProduct()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$admin_id = Auth::admin()->get()->id;

		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$products = Product::with('cover')
							->select(DB::raw('id, name, sell_price, short_description, active,
												(SELECT COUNT(*)
													FROM notifications
										         	WHERE notifications.item_id = products.id
										         		AND notifications.item_type = "Product"
														AND notifications.admin_id = '.$admin_id.'
														AND notifications.read = 0 ) as new'));
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
					$products->where($key, $value);
				} else if( $key == 'sell_price' ) {
					$value = trim($value);
					if( strpos($value, '-') !== false ) {
						list($from, $to) = explode('-', $value);
						$products->where($key, '>', (float)$from);
						$products->where($key, '<', (float)$to);
					} else {
						$products->where($key, (float)$value);
					}
				} else if( $key == 'category' && !empty($value) ) {
					if( is_numeric($value) ) {
						$products->whereHas('categories', function($query) use($value) {
							$query->where('categories.id', $value);
						});
					} else if( is_array($value) ) {
						foreach($value as $k => $v) {
							if( empty($v) ) {
								unset($value[$k]);
							}
						}
						if( empty($value) ) continue;
						$products->whereHas('categories', function($query) use($value) {
							$query->whereIn('categories.id', $value);
						});
					} else {
						$products->whereHas('categories', function($query) use($value) {
							$query->where('categories.name', 'like', '%'.$value.'%');
						});
					}
				} else {
					$value = ltrim(rtrim($value));
					$products->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$products->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
		$count = $products->count();
		if($length > 0) {
			$products = $products->skip($start)->take($length);
		}
		$arrProducts = $products->get();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => Product::count(), 'recordsFiltered' => $count, 'data' => []];
		$arrRemoveNew = [];
		if(!empty($arrProducts)){
			$callFromOffers = false;
			if( Input::has('extra.call_from') && Input::get('extra.call_from') == 'offers' ) {
				$callFromOffers = true;
			}
			foreach($arrProducts as $product){
				if( isset($product->cover[0]) ) {
					$image = URL.'/'.str_replace('/images/products', '/images/products/thumbs', $product->cover[0]->path);
				} else {
					$image = URL.'/assets/images/noimage/110x110.gif';
				}
				$name = $product->name;
				if( $product->new ) {
					$name .= '| <span class="badge badge-danger">new</span>';
					$arrRemoveNew[] = $product->id;
				}
				if( empty($product->short_description) ) {
					$product->short_description = '(empty)';
				}
				if( $callFromOffers ) {
					$arrReturn['data'][] = array(
									  ++$start,
									  $product->id,
									  $name,
									  $image,
									  );
				} else {
					$arrReturn['data'][] = array(
									  ++$start,
									  $product->id,
									  $name,
									  $image,
									  $product->short_description,
									  $product->active,
									  );
				}
			}
		}
		if( !empty($arrRemoveNew) ) {
			Notification::whereIn('item_id', $arrRemoveNew)
						->where('item_type', 'Product')
						->where('admin_id', $admin_id)
						->update(['read' => 1]);
		}
		return $arrReturn;
	}

	public function addProduct()
	{
		$this->layout->title = 'Add Product';
		$this->layout->content = View::make('admin.products-one')->with([
															'arrCategories'	=> ProductCategory::getSource(false, 0, true),
															'arrChosenCategories' => [],
															'optionGroups'	=> ProductOptionGroup::getSource(false, true),
															'layouts'		=> Layout::getSource(),
															'product'		=> [
																				'margin_up' => Configure::getMargin(),
																				'tabs'		=> [],
																				'option_groups' => [],
																				'options'	=> []
																			],
															'tabs'			=> ProductTab::getSource(false, true),
															]);
	}

	public function editProduct($productId)
	{
		try {
			$product = Product::with([
									'cover',
									'overview',
									'categories',
									'optionGroups',
									'options',
									'tabs'
								])
								->findorFail($productId)
								->toArray();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return App::abort(404);
		}
		if( isset($product['cover'][0]) && !empty($product['cover'][0]) ) {
			$product['cover'] = [
								'path' => $product['cover'][0]['path'],
								'id' => $product['cover'][0]['id'],
								'image_id' => $product['cover'][0]['pivot']['image_id'],
							];
		}
		foreach(['tabs', 'option_groups', 'options'] as $value) {
			$tmpData = [];
			if( !empty($product[$value]) ){
				foreach($product[$value] as $v) {
					$tmpData[] = $v['id'];
				}
			}
			$product[$value] = $tmpData;
			unset($tmpData);
		}
		$product['sell_price'] = number_format($product['sell_price'], 2);
		$arrCategories = [];
		if( !empty($product['categories']) ) {
			foreach($product['categories'] as $category) {
				$arrCategories[] = $category['id'];
			}
		}
		$product['jt_products'] = [];
		try {
			$jt_products = ProductJTProduct::where('product_id', $product['id'])
								->get()
								->toArray();
			foreach($jt_products as $p) {
				$id = $p['id'];
				$layout_id = $p['layout_id'];
				$p = JTProduct::select('code', 'name', 'product_type', 'category', 'oum', 'sell_by')
							->where('_id', $p['jt_id'])
							->first();
				if( !$p ) continue;
				$p = $p->toArray();
				$p['_id'] = (string)$p['_id'];
				try {
					$p['layout_id'] = json_decode($layout_id);
				} catch(Exception $e) {
					$p['layout_id'] = [];
				}
				$product['jt_products'][] = array_merge(['_id' => '', 'code' => '', 'name' => '', 'product_type' => '', 'category' => '', 'oum' => '', 'sell_by' => '', 'id' => $id], $p);
			}
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		}
		$this->layout->title = 'Edit Product';
		$this->layout->content = View::make('admin.products-one')->with([
															'product' 		=> $product,
															'arrCategories' => ProductCategory::getSource(false, 0, true),
															'arrChosenCategories' => $arrCategories,
															'optionGroups'	=> ProductOptionGroup::getSource(false, true),
															'layouts'		=> Layout::getSource(),
															'tabs'			=> ProductTab::getSource(false, true),
															]);
	}

	public function updateProduct()
	{
   		if( Input::has('pk') ) {
   			if( !Request::ajax() ) {
	   			return App::abort(404);
	   		}
	   		return self::updateQuickEdit();
		}
		$prevURL = Request::header('referer');
		if( !Request::isMethod('post') ) {
			return App::abort(404);
		}
		if( Input::has('id') ) {
			$create = false;
			try {
				$product = Product::findorFail( (int)Input::get('id') );
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$message = 'has been updated successful';
		} else {
			$create = true;
			$product = new Product;
			$message = 'has been created successful';
		}
		if( !Input::has('categories') ) {
			return Redirect::to($prevURL)->with('flash_error',['Please choose at least one category.'])->withInput();
		}
		$product->name 			= Input::get('name');
		$product->short_name 	= Str::slug($product->name);
		$product->sell_price  	= Input::has('sell_price') ? round((float)str_replace(',', '', Input::get('sell_price')), 2) : 0;
		$product->margin_up  	= (float)Input::get('margin_up');
		$product->order_no  	= (int)Input::get('order_no');
		$product->custom_size  	= Input::has('custom_size') ? 1 : 0;
		$product->active  	  	= Input::has('active') ? 1 : 0;
		$product->meta_title 	 	 = e(Input::get('meta_title'));
		$product->meta_description   = e(Input::get('meta_description'));
		$product->short_description  = e(Input::get('short_description'));
		$product->working_time  = e(Input::get('working_time'));
		$product->description   = Input::get('description');
		$product->specification = Input::get('specification');
		$product->technical   	= Input::get('technical');

		$product->svg_layout_id 	= Input::has('svg_layout_id') ? Input::get('svg_layout_id') : 0;
		$product->pinterest 		= Input::get('pinterest');

		$pass = $product->valid();

		if( Input::hasFile('svg_file') ) {
			$file = Input::file('svg_file');
			// if( $file->getMimeType() === 'image/svg+xml' ) {
				$path = public_path().DS.'assets'.DS.'svg';
				if( !File::exists($path) ) {
					File::makeDirectory($path);
				}
				$fileName = md5($file->getClientOriginalName()).'.svg';
				if( $file->move($path, $fileName) ) {
					if( isset($product->svg_file) && File::exists(public_path().DS.$product->svg_file) ) {
						File::delete($product->svg_file);
					}
					$product->svg_file = 'assets/svg/'.$fileName;
				}
			/*} else {
				return Redirect::to($prevURL)->with('flash_error',['SVG file is not valid.'])->withInput();
			}*/
		}

		if( $pass->passes() ) {
			$product->save();
			// Category, Option Group, Option ==================================================================
			$arr = ['categories' => 'categories', 'tabs' => 'tab_id', 'optionGroups' => 'option_group_id', 'options' => 'option_id'];
			foreach($arr as $key => $value) {
				$old = $product->$key->toArray();
				$arrData = Input::has($value) ? Input::get($value) : [];
				$arrOld = $remove = $add = [];
				if( !empty($old) ) {
					foreach($old as $val) {
						$arrOld[] = $val['id'];
						if( !in_array($val['id'], $arrData) ) {
							$remove[] = $val['id'];
						}
					}
				}

				foreach($arrData as $id) {
					if( !in_array($id, $arrOld) ) {
						$add[] = $id;
					}
				}

				if( !empty($remove) ) {
					$product->$key()->detach( $remove );
				}
				if( !empty($add) ) {
					$product->$key()->attach( $add );
				}
			}
			// End ==============================================================================================
			// Images ===========================================================================================
			$path = public_path('assets'.DS.'images'.DS.'products');
			$coverId = Input::has('cover_id') ? (int)Input::get('cover_id') : 0;
			$coverId = (int)MyImage::where('id', $coverId)
										->pluck('id');
			$image_id = 0;
			$data = json_encode(['cover' => 1]);

			if( Input::hasFile('cover') ) {
				$image_id = 
MyImage::upload(Input::file('cover'), $path, 960,true);
			} else if( Input::has('cover_choose') ) {
				$image_id = Input::get('cover_choose');
			}
			if( $coverId ) {
				$product->cover()->updateExistingPivot( $coverId, ['image_id' => $image_id, 'option' =>  $data] );
			} else {
				$product->cover()->attach( [$image_id => ['option' => $data, 'imageable_id' => $product->id, 'imageable_type' => 'Product']] );
			}

			foreach(['overview' => 'overview'] as $imageKey => $function) {
				if( Input::has($imageKey) ) {
					$removeImages = $createImages = [];
					$images = Input::get($imageKey);
					foreach($images as $key => $image) {
						$data = [$imageKey => 1];
						if( isset($image['delete']) && $image['delete'] ){
							$removeImages[] = $image['id'];
							unset($images[$key]);
							continue;
						}
						$data = json_encode($data);
						$image_id = 0;
						if( Input::hasFile("{$imageKey}.$key.file") ){
							$file = Input::file("{$imageKey}.$key.file");
							$image_id = MyImage::upload($file, $path, 960,true);

						} else if( isset($image['choose_image']) ) {
							$image_id = $image['choose_image'];
						}
						if( $image_id != 0 ) {
							if( isset($image['id']) ) {
								$product->$function()->updateExistingPivot( $image['id'], ['image_id' => $image_id, 'option' =>  $data] );
							} else {
								$createImages[$image_id] = ['option' => $data, 'imageable_id' => $product->id, 'imageable_type' => 'Product'];
							}
						} else {
							if( isset($image['new']) ) {
								continue;
							} else {
								$product->$function()->updateExistingPivot( $image['id'], ['option' =>  $data] );
							}
						}
					}
					if( !empty($removeImages) ) {
						$product->$function()->detach( $removeImages );
					}
					if( !empty($createImages) ) {
						$product->$function()->attach( $createImages );
					}
				}
			}
			// End ==============================================================================================
			// JTProduct ======================================================================================
			if( Input::has('jt_products') ) {
				$removeJT = $createJT = [];
				$jt_products = Input::get('jt_products');
				foreach($jt_products as $p) {
					if( !isset($p['product_id'])
						|| strlen($p['product_id']) != 24 ) {
						continue;
					}
					$layoutId = isset($p['layout_id']) ? (array)$p['layout_id'] : [];
					$layoutId = json_encode(array_map('intval', $layoutId));
					if( isset($p['id']) ) {
						if( isset($p['delete']) && $p['delete'] ) {
							$removeJT[] = $p['id'];
						} else {
							DB::statement('UPDATE `products_jtproducts` SET `layout_id` = "'. $layoutId .'" WHERE `id` = '.$p['id']);
						}
					} else {
						$createJT[] = '('.$product->id.', "'.$p['product_id'].'", "'. $layoutId .'")';
					}
				}

				if( !empty($removeJT) ) {
					ProductJTProduct::destroy($removeJT);
				}

				if( !empty($createJT)  ) {
					DB::statement('INSERT INTO `products_jtproducts` (`product_id`, `jt_id`, `layout_id`)  VALUES '.implode(', ', $createJT));
				}
			}
			// End ==============================================================================================
			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/products/edit-product/'.$product->id;
				}
				return Redirect::to($prevURL)->with('flash_success',"<b>$product->name</b> {$message}.");
			}
			return Redirect::to(URL.'/admin/products')->with('flash_success',"<b>$product->name</b> {$message}.");
		}

		return Redirect::to($prevURL)->with('flash_error',$pass->messages()->all())->withInput();
	}

	public function updateQuickEdit()
	{
   		$arrReturn = ['status' => 'error'];
   		$id = (int)Input::get('pk');
   		$name = (string)Input::get('name');
   		$value = Input::get('value');
   		try {
   			$product = Product::findorFail($id);
   			$product->$name = $value;
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
	    $pass = $product->valid();
        if($pass->passes()) {
        	$product->save();
   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $product->name.' has been saved';
        } else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
	}

	public static function imageBrowser($page = 1)
	{
		if( Request::ajax() ) {
			if( Input::has('page') ) {
				$page = Input::get('page');
			}
			return MyImage::imageBrowser('products', $page);
		}
		return App::abort(404);
	}

	public function deleteProduct($id)
	{
		if( Request::ajax() ) {
			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
			try {
				$product = Product::findorFail($id);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$name = $product->name;
			if( $product->delete() )
				$arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
			return $arrReturn;
		}
		return App::abort(404);
	}

	public function listJtProducts()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$products = JTProduct::select('_id', 'code', 'sku', 'name', 'product_type', 'product_category', 'oum', 'sell_by', 'sell_price', 'product_base')
								->where('deleted', false)
								->where('name', 'not regexp', '/^blank/i');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				$value = ltrim(rtrim($value));
				if( $key == 'code' ) {
					$products->where($key, (int)$value);
				} else {
					$products->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$products->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
		$count = $products->count();
		if($length > 0) {
			$products = $products->skip($start)->take($length);
		}
		$arrProducts = $products->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => JTProduct::where('deleted', false)->count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrProducts)){
			foreach($arrProducts as $product){
				$arrReturn['data'][] = array(
								  ++$start,
								  $product['_id'],
								  isset($product['code']) ? $product['code'] : '',
								  $product['sku'],
								  isset($product['name']) ? $product['name'] : '',
								  isset($product['product_type']) ? $product['product_type'] : '',
								  isset($product['product_category']) ? $product['product_category'] : '',
								  isset($product['oum']) ? $product['oum'] : '',
								  isset($product['sell_by']) ? $product['sell_by'] : '',
								  isset($product['product_base']) ? $product['product_base'] : '',
								  number_format((float)$product['sell_price'], 2),
								  );
			}
		}
		return $arrReturn;
	}
}
