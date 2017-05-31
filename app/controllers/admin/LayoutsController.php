<?php
class LayoutsController extends AdminController {

	public static $table = 'layouts';

	private $data = [
		'dpi'       => 72,
		'view_dpi'  => 1,
		'max_w'     => 1000,
		'max_h'     => 500,
	];

	public function index()
	{
		$this->layout->title = 'Layout';
		$this->layout->content = View::make('admin.shape-layouts-all');
	}
	public function listLayout()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$layouts = Layout::select('id', 'name',  'active', 'svg_file', 'wall_size_h', 'wall_size_w');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
					$layouts->where($key, $value);
				} else {
					$value = ltrim(rtrim($value));
					$layouts->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$layouts->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
		$count = $layouts->count();
		if($length > 0) {
			$layouts = $layouts->skip($start)->take($length);
		}
		$arrLayouts = $layouts->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => Layout::count(), 'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrLayouts)){
			foreach($arrLayouts as $layout){
				if( !File::exists(public_path().DS.str_replace('/', DS, $layout['svg_file'])) ) {
					$layout['svg_file'] = '';
				}
				$arrReturn['data'][] = array(
								  ++$start,
								  $layout['id'],
								  $layout['name'],
								  $layout['svg_file'],
								  $layout['active'],
								  $layout['wall_size_h'] / $layout['wall_size_w']
								  );
			}
		}
		return $arrReturn;
	}
	public function addLayout()
	{
		$this->layout->title = 'Add Layout';
		$this->layout->content = View::make('admin.shape-layouts-one')->with([
															'data'          => $this->data
															]);
	}
	public function editLayout($layoutId)
	{
		try {
			$layout = Layout::with('details')
								->findorFail($layoutId);
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return App::abort(404);
		}
		$layout = $layout->toArray();
		$layout['wall_size_w_pt'] =  $layout['wall_size_w'] * $this->data['dpi'];
		$layout['wall_size_h_pt'] =  $layout['wall_size_h'] * $this->data['dpi'];
		if( $layout['wall_size_w_pt'] / $this->data['max_w'] > $layout['wall_size_h_pt'] / $this->data['max_h'] ) {
			$layout['box_size_w_pt'] = $this->data['max_w'];
			$this->data['view_dpi']  = $layout['wall_size_w_pt'] / $layout['box_size_w_pt'];
			$layout['box_size_h_pt'] = $layout['wall_size_h_pt'] / $this->data['view_dpi'];
		} else {
			$layout['box_size_h_pt'] = $this->data['max_h'];
			$this->data['view_dpi'] = $layout['wall_size_h_pt'] / $layout['box_size_h_pt'];
			$layout['box_size_w_pt'] = $layout['wall_size_w_pt'] / $this->data['view_dpi'];
		}
		$this->layout->title = 'Edit Layout';
		$this->layout->content = View::make('admin.shape-layouts-one')->with([
															'layout'        => $layout,
															'data'          => $this->data
															]);
	}

	public function updateLayout()
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
				$layout = Layout::findorFail( (int)Input::get('id') );
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$message = 'has been updated successful';
		} else {
			$create = true;
			$layout = new Layout;
			$message = 'has been created successful';
		}
		$layout->name           = Input::get('name');
		$layout->wall_size_w    = Input::get('wall_size_w');
		$layout->wall_size_h    = Input::get('wall_size_h');
		$layout->active         = Input::has('active') ? 1 : 0;

		$svgContent = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>'."\n".html_entity_decode(Input::get('svg_content'));

		$fileName = md5($layout->id).'-layout.svg';

		$path = public_path('assets'.DS.'svg');
		if( !File::exists($path) ) {
			File::makeDirectory($path, 0777, true);
		}

		$path = 'assets/svg/'.$fileName;
		if( File::put($path, $svgContent) ) {
			$layout->svg_file = $path;
		}


		$pass = $layout->valid();
		if( $pass ) {
			$layout->save();

			if( Input::has('svg') ) {
				$svg = Input::get('svg');
				$svg = json_decode($svg, true);
				$arrInsert = [];
				$arrDelete = [];
				foreach($svg as $shape) {
					$arr = [
						'width'     => (float)$shape['width'],
						'height'    => (float)$shape['height'],
						'coor_x'    => (float)$shape['x'],
						'coor_y'    => (float)$shape['y'],
						'd'    		=> $shape['d'],
						'empty'    	=> isset($shape['empty']) && $shape['empty'] == 1 ? 1 : 0,
						'type'		=> $shape['type'],
						'order_no'	=> (int)(isset($shape['order_no']) ? $shape['order_no'] : 1),
					];
					if( isset($shape['id']) && is_numeric($shape['id']) ) {
						if( isset($shape['deleted']) ) {
							$arrDelete[] = $shape['id'];
						} else {
							$layout->shapes()->where('layout_details.id', $shape['id'])->update($arr);
						}
					} else {
						$arrInsert[] = new LayoutDetail($arr);
					}
				}

				if( !empty($arrDelete) ) {
					LayoutDetail::destroy($arrDelete);
				}

				if( !empty($arrInsert) ) {
					$layout->shapes()->saveMany($arrInsert);
				}
			}

			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/layouts/edit-layout/'.$layout->id;
				}
				return Redirect::to($prevURL)->with('flash_success',"<b>$layout->name</b> {$message}.");
			}
			return Redirect::to(URL.'/admin/layouts')->with('flash_success',"<b>$layout->name</b> {$message}.");
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
			$layout = Layout::findorFail($id);
			$layout->$name = $value;
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return App::abort(404);
		}
		$pass = $layout->valid();
		if($pass->passes()) {
			$layout->save();
			$arrReturn = ['status' => 'ok'];
			$arrReturn['message'] = $layout->name.' has been saved';
		} else {
			$arrReturn['message'] = '';
			$arrErr = $pass->messages()->all();
			foreach($arrErr as $value)
				$arrReturn['message'] .= "$value\n";
		}
		return $arrReturn;
	}

	public function deleteLayout($id)
	{
		if( Request::ajax() ) {
			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
			try {
				$layout = Layout::findorFail($id);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$name = $layout->name;
			if( $layout->delete() ){
				$arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
			}
			return $arrReturn;
		}
		return App::abort(404);
	}

	public function uploadImage()
	{
		if( !Request::ajax() ){
			return App::abort(404);
		}
		$imageURL = MyImage::upload(Input::file('image'), public_path('assets'.DS.'images'.DS.'layouts'), false, false, false, true);

		return ['status' => 'ok', 'url' => URL.'/'.$imageURL];
	}

    public function imageBrowser($page = 1)
    {
    	if( Request::ajax() ) {
	   		if( Input::has('page') ) {
	   			$page = Input::get('page');
	   		}
			return MyImage::imageBrowser('layouts', $page, false);
		}
   		return App::abort(404);
    }
}