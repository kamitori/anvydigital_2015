<?php

class ProductTabsController extends AdminController {

	public static $table = 'tabs';
    public static $name = 'Product Tabs';

	public function index()
	{
		$this->layout->title = 'Product Tabs';
		$this->layout->content = View::make('admin.product-tabs-all');
	}

	public function listProductTab()
   	{
   		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$productTabs = ProductTab::select('id', 'name');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
                $value = ltrim(rtrim($value));
        		$productTabs->where($key,'like', '%'.$value.'%');
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$productTabs->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $productTabs->count();
        if($length > 0) {
			$productTabs = $productTabs->skip($start)->take($length);
		}
		$arrTabs = $productTabs->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => ProductTab::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrTabs)){
			foreach($arrTabs as $type){
				$arrReturn['data'][] = array(
	                              ++$start,
	                              $type['id'],
	                              $type['name'],
	                              );
			}
		}
		return $arrReturn;
   	}

   	public function updateProductTab()
   	{
   		if( !Request::ajax() ) {
   			return App::abort(404);
   		}
   		$arrReturn = ['status' => 'error'];
   		if( Input::has('pk') ) {
	   		$id = (int)Input::get('pk');
	   		$name = (string)Input::get('name');
	   		$value = e((string)Input::get('value'));
	   		try {
	   			$type = ProductTab::findorFail($id);
	   			$type->$name = $value;
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
   		} else {
   			$type = new ProductTab;
   			$type->name = Input::get('name');
   		}
	    $pass = $type->valid();
        if($pass->passes()) {
        	$type->save();
   			$arrReturn = ['status' => 'ok'];
        	$arrReturn['message'] = $type->name.' has been saved';
        	$arrReturn['data'] = $type;
        } else {
        	$arrReturn['message'] = '';
        	$arrErr = $pass->messages()->all();
        	foreach($arrErr as $value)
        	    $arrReturn['message'] .= "$value\n";
        }
		return $arrReturn;
   	}

   	public function deleteProductTab($id)
   	{
   		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$type = ProductTab::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $type->name;
   		    if( $type->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    return $arrReturn;
   		}
   		return App::abort(404);
   	}
}