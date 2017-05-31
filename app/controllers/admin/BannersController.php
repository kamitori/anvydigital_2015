<?php

class BannersController extends AdminController {

	public static $table = 'banners';

	public function index()
	{
		$this->layout->title = 'Banners';
		$this->layout->content = View::make('admin.banners-all');
	}

	public function listBanner()
	{
   		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$banners = Banner::select('id', 'name', 'description', 'link', 'order_no', 'active')
														->with('images');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
	        		$banners->where($key, $value);
	        	} else {
	                $value = ltrim(rtrim($value));
	        		$banners->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$banners->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $banners->count();
        if($length > 0) {
			$banners = $banners->skip($start)->take($length);
		}
		$arrBanners = $banners->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => Banner::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrBanners)){
			foreach($arrBanners as $banner){
				$image = '';
				if( !empty($banner['images']) ) {
					$image = reset($banner['images']);
					$image = $image['path'];
				}
				$arrReturn['data'][] = array(
	                              ++$start,
	                              $banner['id'],
	                              $banner['name'],
	                              $banner['description'],
	                              $banner['link'],
	                              $image,
	                              $banner['order_no'],
	                              $banner['active'],
	                              );
			}
		}
		return $arrReturn;
	}

	public function updateBanner()
	{
		if( Input::has('pk') ) {
   			if( !Request::ajax() ) {
	   			return App::abort(404);
	   		}
	   		return self::updateQuickEdit();
		} else if( !Request::ajax() ) {
   			return App::abort(404);
   		}

   		$arrReturn = ['status' => 'error'];

   		$banner = new Banner;
   		$banner->name = Input::get('name');
   		$banner->description = e(Input::get('description'));
   		$banner->link = Input::get('link');
   		$banner->order_no = (int)Input::get('order_no');
   		$banner->active = Input::has('active') ? 1 : 0;

   		$pass = $banner->valid();

   		if( $pass ) {

   			$banner->save();
   			$imageId = 0;
			if( Input::has('choose') ) {
				$imageId = Input::get('choose');
			} else if (Input::hasFile('image')) {
				$imageId = MyImage::upload(Input::file('image'), public_path().DS.'assets'.DS.'images'.DS.'banners', 1380, false);
			}

			if( $imageId ) {
	   			$banner->images()->attach( $imageId );

				$arrReturn = ['status' => 'ok'];
    			$arrReturn['message'] = $banner->name.'\'s image has been saved';
	   		}

   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $banner->name.' has been saved';
        	$arrReturn['data'] = $banner;
   		} else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
	}

	public function updateQuickEdit()
	{
   		$arrReturn = ['status' => 'error'];
   		$id = (int)Input::get('pk');
   		$name = (string)Input::get('name');
   		try {
   			$banner = Banner::findorFail($id);
   			if( $name == 'image' ) {
   				if( Input::has('choose') ) {
	   				$imageId = Input::get('choose');
   				} else if (Input::hasFile('image')) {
   					$imageId = MyImage::upload(Input::file('image'), public_path().DS.'assets'.DS.'images'.DS.'banners', 1380, false);
   				}
   				if( $imageId ) {
		   			$banner->images()->detach();
		   			$banner->images()->attach( $imageId );
		   			$image = $banner->images()->first();

   					$arrReturn = ['status' => 'ok'];
        			$arrReturn['message'] = $banner->name.'\'s image has been saved';
        			$arrReturn['path'] = URL.'/'.$image->path;
		   		}
   				$response = Response::json($arrReturn);
				$response->header('Content-Type', 'application/json');
				return $response;
   			} else {
   				$value = Input::get('value');
   				if( $name == 'active' ) {
   					$banner->active = (int)$value;
   				} else {
   					$banner->$name = $value;
   				}
   			}
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
	    $pass = $banner->valid();
        if($pass->passes()) {
        	$banner->save();
   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $banner->name.' has been saved';
        } else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
	}

	public function imageBrowser($page = 1)
    {
    	if( Request::ajax() ) {
	   		if( Input::has('page') ) {
	   			$page = Input::get('page');
	   		}
	   		$response = Response::json(MyImage::imageBrowser('banners', $page, false));
			$response->header('Content-Type', 'application/json');
			return $response;
		}
   		return App::abort(404);
    }

    public function deleteBanner($id)
   	{
   		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$banner = Banner::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $banner->name;
   		    if( $banner->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    $response = Response::json($arrReturn);
   		    $response->header('Content-Type', 'application/json');
   		    return $response;
   		}
   		return App::abort(404);
   	}
}