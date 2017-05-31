<?php
class DesignFontsController extends AdminController {

	public function index()
	{
		$this->layout->title = 'Design Fonts';
		$this->layout->content = View::make('admin.design-fonts-all');
	}

	public function listFont()
	{
		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$fonts = DesignFont::select('id', 'name', 'source');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
                $value = ltrim(rtrim($value));
        		$fonts->where($key,'like', '%'.$value.'%');
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$fonts->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $fonts->count();
        if($length > 0) {
			$fonts = $fonts->skip($start)->take($length);
		}
		$fonts = $fonts->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => DesignFont::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($fonts)){
			foreach($fonts as $font){
				$arrReturn['data'][] = array(
	                              ++$start,
	                              $font['id'],
	                              $font['name'],
	                              URL.'/'.$font['source'],
	                              );
			}
		}
		return $arrReturn;
	}

	public function updateFont()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}

		$font = new DesignFont;
		$font->name 	= Input::get('name');
		$font->source 	= Input::file('source');

		$pass = $font->valid();

		if( $pass->passes() ) {
			$file = $font->source;
   			$fileName = Str::slug(str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName())).'.'.date('d-m-y').'.'.$file->getClientOriginalExtension();
   			$path = public_path('assets'.DS.'fonts');
   			$file->move($path, $fileName);
			$font->source   	= 'assets/fonts/'.$fileName;
	     	$font->save();
			$arrReturn = ['status' => 'ok'];
	     	$arrReturn['message'] = $font->name.' has been saved';
		} else {
			$arrReturn['message'] = '';
			$arrErr = $pass->messages()->all();
			foreach($arrErr as $value) {
		    	$arrReturn['message'] .= "$value\n";
			}
		}
		return $arrReturn;
	}

   	public function deleteFont($id)
   	{
   		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$font = DesignFont::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $font->name;
   		    if( $font->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    return $arrReturn;
   		}
   		return App::abort(404);
   	}
}