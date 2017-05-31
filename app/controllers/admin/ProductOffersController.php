<?php
class ProductOffersController extends AdminController {

    public static $table = 'offers';
    public static $name = 'Product Offers';

    public function index()
	{
		$this->layout->title = 'Product Offers';
		$this->layout->content = View::make('admin.product-offers-all');
	}

	public function listOffer()
	{
		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$offers = ProductOffer::select('id', 'name', 'description', 'image', 'menu_id', 'home_id', 'active');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
					if( $key == 'active' ) {
	        			$offers->where($key, $value);
					} else if( $key == 'on_menu' ) {
	        			$offers->where('menu_id', '>', 0);
					} else {
	        			$offers->where('home_id', '>', 0);
					}
	        	} else if( $key == 'parent_id' ) {
	        		$offers->where($key, (int)$value);
				} else {
	                $value = ltrim(rtrim($value));
	        		$offers->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$offers->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $offers->count();
        if($length > 0) {
			$offers = $offers->skip($start)->take($length);
		}
		$arrOffers = $offers->get();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => ProductOffer::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrOffers)){
			foreach($arrOffers as $offer){
				$arrReturn['data'][] = array(
	                              ++$start,
	                              $offer['id'],
	                              $offer['name'],
	                              $offer['image'],
	                              $offer['description'],
	                              $offer['menu_id'] ? 1 : 0,
	                              $offer['home_id'] ? 1 : 0,
	                              $offer['active'],
	                            );
			}
		}
		return $arrReturn;
	}

	public function addOffer()
	{
		$this->layout->title = 'Add Product Offer';
		$this->layout->content = View::make('admin.product-offers-one');
	}

	public function editOffer($id)
	{
		try {
   			$offer = ProductOffer::with('products')
   								->findorFail($id);
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
	    $products = [];
	    if( is_object($offer->products) ) {
	    	foreach($offer->products as $product) {
	    		$cover = $product->cover;
	    		if( is_object($cover) && isset($cover[0]) )  {
	    			$cover = URL.'/'.$cover[0]->path;
	    		} else {
	    			$cover = URL.'/assets/images/noimage/110x110.gif';
	    		}
	    		$products[] = [
	    					'id' => $product->id,
	    					'name' => $product->name,
	    					'image' => $cover,
	    					'description' => $product->pivot->description
	    		];
	    	}
	    }
		$offer = $offer->toArray();
		$offer['products'] = $products;
   		$this->layout->title = 'Edit Product Offer';
		$this->layout->content = View::make('admin.product-offers-one')->with([
															'offer'  => $offer,
															]);
	}

	public function updateOffer()
	{
		if( Input::has('pk') ) {
   			if( !Request::ajax() ) {
	   			return App::abort(404);
	   		}
	   		return self::updateQuickEdit();
		}
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

   		$oldHomeId = 0;
   		if( Input::has('id') ) {
   			$create = false;
   			try {
   				$offer = ProductOffer::findorFail( (int)Input::get('id') );
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   				return App::abort(404);
		    }
            $message = 'has been updated successful';
   			$oldHomeId = $offer->home_id;
   		} else {
   			$create = true;
   			$offer = new ProductOffer;
            $message = 'has been created successful';
   		}

   		$offer->name 		= Input::get('name');
   		$offer->short_name 	= Str::slug($offer->name);
   		$offer->active 		= Input::has('active') ? 1 : 0;
   		$offer->meta_title 	= e(Input::get('meta_title'));
		$offer->meta_description   	= e(Input::get('meta_description'));
		$offer->description   		= Input::get('description');
		$offer->home_description   	= e(Input::get('home_description'));
   		$pass = $offer->valid();

   		if( $pass->passes() ) {

	   		if( Input::hasFile('image') ) {
	   			$file = Input::file('image');
	   			$fileName = Str::slug(str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName())).'.'.date('d-m-y').'.'.$file->getClientOriginalExtension();
	   			$path = public_path('assets'.DS.'images'.DS.'product-offers');
	   			$file->move($path, $fileName);
	   			BackgroundProcess::resize(450, $path, $fileName);
				$offer->image   	= 'assets/images/product-offers/'.$fileName;
	   		}

   			$onHome = Input::has('on_home') ? 1 : 0;
   			if( $oldHomeId ) {
   				if( $onHome ) {
   					$offer->home()->update([
   								'name' 	=> $offer->name,
   								'image' => $offer->image,
   								'description' => $offer->home_description,
   								'link' 	=> '/offers/'.$offer->short_name,
   								'type'	=> 'home-link'
   						]);
   				} else {
					$offer->home()->delete();
   					$offer->home_id = 0;
   				}
   			} else {
   				if( $onHome ) {
   					$offer->home_id = Home::insertGetId([
   							'name' 	=> $offer->name,
   							'image' => $offer->image,
   							'description' => $offer->home_description,
   							'link' 	=> '/offers/'.$offer->short_name,
   							'type'	=> 'home-link'
   						]);
   				}
   			}


   			$action = Input::has('on_menu') ? 'add' : 'delete';
   			$offer = Menu::updateMenu($offer, $action, 'offers/');

   			$offer->save();

   			if( Input::has('products') ) {
   				$old = $offer->products->toArray();
				$products = Input::has('products') ? Input::get('products') : [];
				$arrId = $remove = $add = $sync = [];
				foreach($products as $product) {
					$description = e($product['description']);
					$exists = false;
					foreach($old as $key => $value) {
						if( $value['id'] == $product['id'] ) {
							$exists = true;
							break;
						}
					}
					if( $exists ) {
						if( isset($product['delete']) && $product['delete'] ) {
							$remove[] = $product['id'];
						} else {
							$sync[$product['id']] = ['description' => $description];
						}
					} else if( !isset($product['delete']) || !$product['delete']) {
						$sync[$product['id']] = ['description' => $description];
					}
				}
				if( !empty($remove) ) {
					$offer->products()->detach( $remove );
				}
				if( !empty($sync) ) {
					$offer->products()->sync( $sync );
				}
   			}

			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/product-offers/edit-offer/'.$offer->id;
				}
            	return Redirect::to($prevURL)->with('flash_success',"<b>{$offer->name}</b> {$message}.");
			}
            return Redirect::to(URL.'/admin/product-offers')->with('flash_success',"<b>{$offer->name}</b> {$message}.");
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
   			$offer = ProductOffer::findorFail($id);
   			if( $name == 'active' ) {
   				$offer->active = (int)$value;
   				$offer = Menu::updateMenu($offer, 'add', 'offers/');
   			} else if( $name == 'on_home' ) {
   				$onHome = (int)$value;
   				$oldHomeId = $offer->home_id;
	   			if( $oldHomeId ) {
	   				if( $onHome ) {
	   					$offer->home()->update([
	   								'name' 	=> $offer->name,
	   								'image' => $offer->image,
	   								'description' => $offer->home_description,
	   								'link' 	=> '/offers/'.$offer->short_name,
	   								'type'	=> 'home-link'
	   						]);
	   				} else {
						$offer->home()->delete();
	   					$offer->home_id = 0;
	   				}
	   			} else {
	   				if( $onHome ) {
	   					$offer->home_id = Home::insertGetId([
	   							'name' 	=> $offer->name,
	   							'image' => $offer->image,
	   							'description' => $offer->home_description,
	   							'link' 	=> '/offers/'.$offer->short_name,
	   							'type'	=> 'home-link'
	   						]);
	   				}
	   			}
   			} else if( $name == 'on_menu' ) {
   				$type = $value ? 'add' : 'delete';
   				$offer = Menu::updateMenu($offer, $type, 'offers/');
   			} else {
   				$offer->$name = $value;
   			}
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
	    $pass = $offer->valid();
        if($pass->passes()) {
        	$offer->save();
   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $offer->name.' has been saved';
        } else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
	}

	public function deleteOffer($id)
	{
		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$offer = ProductOffer::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $offer->name;
   		    if( $offer->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    return $arrReturn;
   		}
   		return App::abort(404);
	}
}