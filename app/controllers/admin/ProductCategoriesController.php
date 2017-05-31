<?php

class ProductCategoriesController extends AdminController {

    public static $table = 'categories';
    public static $name = 'Product Categories';

    public function index()
	{
		$this->layout->title = 'Product Categories';
		$this->layout->content = View::make('admin.product-categories-all')->with(['parent' => ProductCategory::getSource(true)]);
	}

	public function listProductCategory()
   	{
   		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$productCategories = ProductCategory::select('categories.id', 'categories.name', 'categories.color', 'categories.menu_id', 'categories.on_home', 'categories.home_description', 'categories.active', 'parent.name as parent_name')
														->with('image')
														->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' || $key == 'on_menu' || $key == 'on_home'  ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
					if( $key == 'active' || $key == 'on_home' ) {
	        			$productCategories->where('categories.'.$key, $value);
					} else {
	        			$productCategories->where('categories.menu_id', '>', 0);
					}
	        	} else if( $key == 'parent_id' ) {
	        		$productCategories->where('categories.'.$key, (int)$value);
				} else {
	                $value = ltrim(rtrim($value));
	        		$productCategories->where('categories.'.$key,'like', '%'.$value.'%');
				}
			}
		}

		$callFromHomes = false;
		if( Input::has('extra.call_from') && Input::get('extra.call_from') == 'homes' ) {
			$callFromHomes = true;
		}
		if( $callFromHomes ) {
	        $productCategories->where('categories.active', 1);
	        $productCategories->where('categories.on_home', 0);
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$productCategories->orderBy('categories.'.$columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $productCategories->count();
        if($length > 0) {
			$productCategories = $productCategories->skip($start)->take($length);
		}
		$arrProductCategories = $productCategories->get();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => ProductCategory::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrProductCategories)){
			foreach($arrProductCategories as $productCategory){
				$image = '';
				if( is_object($productCategory->image) && isset($productCategory->image[0]) ) {
					$image = $productCategory->image[0]->path;
				} else {
					$product = $productCategory->lastestProduct();
					if( is_object($product) && isset($product->cover[0]) ) {
						$image = $product->cover[0]->path;
					}
				}
				$image = str_replace('assets/images/products', 'assets/images/products/thumbs', $image);
				if( $callFromHomes ) {
					$arrReturn['data'][] = array(
		                              ++$start,
		                              $productCategory['id'],
		                              $productCategory['name'],
		                              $image,
		                              $productCategory['home_description'],
		                              );
				} else {
					$arrReturn['data'][] = array(
		                              ++$start,
		                              $productCategory['id'],
		                              $productCategory['name'],
		                              $productCategory['parent_name'],
		                              $image,
		                              $productCategory['color'],
		                              $productCategory['menu_id'] ? 1 : 0,
		                              $productCategory['on_home'] ? 1 : 0,
		                              $productCategory['active'],
		                              );
				}
			}
		}
		return $arrReturn;
   	}

   	public function addProductCategory()
   	{
   		$this->layout->title = 'Add Product Category';
		$this->layout->content = View::make('admin.product-categories-one')->with([
															'parent' 	=> ProductCategory::getSource()
															]);
   	}

   	public function editProductCategory($id)
	{
   		try {
   			$category = ProductCategory::findorFail($id);
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
   		$category = $category->toArray();
   		$this->layout->title = 'Edit Product Category';
		$this->layout->content = View::make('admin.product-categories-one')->with([
															'category'  => $category,
															'parent' 	=> ProductCategory::getSource(false, $id)
															]);
	}

	public function updateProductCategory()
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
   				$category = ProductCategory::findorFail( (int)Input::get('id') );
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   				return App::abort(404);
		    }
            $message = 'has been updated successful';
   		} else {
   			$create = true;
   			$category = new ProductCategory;
            $message = 'has been created successful';
   		}

   		$category->name 		= Input::get('name');
   		$category->short_name 	= Str::slug($category->name);
   		$category->parent_id 	= (int)Input::get('parent_id');
   		$category->order_no 	= (int)Input::get('order_no');
   		$category->color 		= Input::get('color');
   		$category->active 		= Input::has('active') ? 1 : 0;
   		$category->on_home 		= Input::has('on_home') ? 1 : 0;
   		$category->meta_title 	= e(Input::get('meta_title'));
		$category->meta_description   = e(Input::get('meta_description'));
		$category->description   	  = Input::get('description');
		$category->home_description   = Input::get('home_description');
   		$pass = $category->valid();

   		if( $pass->passes() ) {
   			$action = Input::has('on_menu') ? 'add' : 'delete';
   			$category = Menu::updateMenu($category, $action, '', 'product');

   			$category->save();

   			$imageId = 0;
	   		if( Input::hasFile('image') ) {
	   			$imageId = MyImage::upload(Input::file('image'), public_path().DS.'assets'.DS.'images'.DS.'product_categories', 450, false);
	   		} else if( Input::has('choose_image') ) {
	   			$imageId = Input::get('choose_image');
	   		}

	   		if( $imageId ) {
	   			$category->images()->detach();
	   			$category->images()->attach( $imageId );
	   		}

			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/product-categories/edit-category/'.$category->id;
				}
            	return Redirect::to($prevURL)->with('flash_success',"<b>{$category->name}</b> {$message}.");
			}
            return Redirect::to(URL.'/admin/product-categories')->with('flash_success',"<b>{$category->name}</b> {$message}.");
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
   			$category = ProductCategory::findorFail($id);
   			if( $name == 'active' ) {
   				$category->active = (int)$value;
   				$category = Menu::updateMenu($category, 'add', '', 'product');
   			} else if( $name == 'on_menu' ) {
   				$type = $value ? 'add' : 'delete';
   				$category = Menu::updateMenu($category, $type, '', 'product');
   			} else if( $name == 'image'  ) {
   				$category->image()->detach();
				$category->image()->attach( [(int)$value => ['option' => '{"cover":1}', 'imageable_id' => $category->id, 'imageable_type' => 'ProductCategory']] );
				if( $category->on_home ) {
					Cache::forget('homeCategory');
				}
   				return ['status' => 'ok', 'message' => "<b>{$category->name}</b>'s image has been saved."];
   			} else {
   				if($name == 'on_home') {
   					$value = (int)$value;
   				}
   				$category->$name = $value;
   			}
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
	    $pass = $category->valid();
        if($pass->passes()) {
        	$category->save();
   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $category->name.' has been saved';
        } else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
	}

   	public function deleteProductCategory($id)
   	{
   		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$productCategory = ProductCategory::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $productCategory->name;
   		    if( $productCategory->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    return $arrReturn;
   		}
   		return App::abort(404);
   	}

   	public static function imageBrowser($page = 1, $categoryId = 0)
	{
		if( Request::ajax() ) {
			if( Input::has('page') ) {
				$page = Input::get('page');
			}
			return MyImage::imageBrowser('product-categories', $page, ['categoryId' => $categoryId]);
		}
		return App::abort(404);
	}
}