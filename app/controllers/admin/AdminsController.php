<?php

class AdminsController extends AdminController {

	public static $table = 'admins';

	public function index()
	{
		$this->layout->title = 'Dashboard';
		$this->layout->content = View::make('admin.admins-all');
	}

	public function listAdmin()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$admins = Admin::select('id', 'first_name', 'last_name', 'email', 'active','last_login')->with('images');
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
					$admins->where($key, $value);
				} else {
					$value = ltrim(rtrim($value));
					$admins->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$admins->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
		$count = $admins->count();
		if($length > 0) {
			$admins = $admins->skip($start)->take($length);
		}
		$arrAdmins = $admins->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => Admin::count(),'recordsFiltered' => $count, 'data' => []];
		if(!empty($arrAdmins)){
			foreach($arrAdmins as $admin){
				$avatar = '';
				if( !empty($admin['images']) ) {
					$avatar = reset($admin['images']);
					$avatar = $avatar['path'];
				}
				$arrReturn['data'][] = array(
								  ++$start,
								  $admin['id'],
								  $admin['first_name'],
								  $admin['last_name'],
								  $admin['email'],
								  $avatar,
								  $admin['active'],
								  $admin['last_login']
								  );
			}
		}
		return $arrReturn;
	}

	public function addAdmin()
	{
		$this->layout->title = 'Add Admin';
		$this->layout->content = View::make('admin.admins-one')->with([
																	'arrRoles' => Role::getSource()
																]);
	}

	public function editAdmin($id)
	{
		try {
			$admin = Admin::with('images')
								->findorFail($id);
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return App::abort(404);
		}
		$admin = $admin->toArray();
		$admin['images'] = reset($admin['images']);
		$this->layout->title = 'Edit Admin';
		$this->layout->content = View::make('admin.admins-one')->with([
															'admin' 		=> $admin,
															'arrRoles' => Role::getSource()
															]);
	}

	public function updateAdmin()
	{
		if( Request::ajax() && Input::has('pk') ) {
			$arrPost = Input::all();
			if( $arrPost['name'] == 'active' ) {
				$arrPost['value'] = (int)$arrPost['value'];
			}
			Admin::where('id', $arrPost['pk'])
					->update([$arrPost['name'] => $arrPost['value']]);
			return ['status' => 'ok'];
		}

		$prevURL = Request::header('referer');
		if( !Request::isMethod('post') ) {
			return App::abort(404);
		}
		if( Input::has('id') ) {
			$create = false;
			try {
				$admin = Admin::findorFail( (int)Input::get('id') );
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$message = 'has been updated successful';

			unset( $admin->password );

			if( Input::has('password') ) {
				if( Input::has('password') && Input::has('password_confirmation') ) {
					$password = Input::get('password');
					$admin->password = Input::get('password');
					$admin->password_confirmation = Input::get('password_confirmation');
				}
			}
		} else {
			$create = true;
			$admin = new Admin;
			$message = 'has been created successful';
			$password = Input::get('password');
			$admin->password = $password;
			$admin->password_confirmation = Input::get('password_confirmation');
		}

		$admin->email 		= Input::get('email');
		$admin->first_name 	= Input::get('first_name');
		$admin->last_name 	= Input::get('last_name');
		$admin->active 		= Input::has('active') ? 1 : 0;
		$admin->subject = Input::get('subject');
		$oldRole = 0;
		if( isset($admin->role_id) && $admin->role_id ) {
			$oldRole = $admin->role_id;
		}
		$admin->role_id       = Input::has('role_id') ? Input::get('role_id') : 0;

		$pass = $admin->valid();

		if( $pass->passes() ) {
			if( isset($admin->password_confirmation) ) {
				unset($admin->password_confirmation);
			}
			if( isset($password) ) {
				$admin->password = Hash::make($password);
			}

			$admin->save();

			if( $oldRole != $admin->role_id ) {
				if( $oldRole ) {
					$admin->roles()->detach( $oldRole );
				}
				if( $admin->role_id ) {
					$admin->roles()->attach( $admin->role_id );
				}
			}

			$imageId = 0;

			if( Input::hasFile('image') ) {
				$imageId = MyImage::upload(Input::file('image'), public_path().DS.'assets'.DS.'images'.DS.'admins', 110, false);
			} else if( Input::has('choose_image') ) {
				$imageId = Input::get('choose_image');
			}

			if( $imageId ) {
				$admin->images()->detach();
				$admin->images()->attach( $imageId );
			}

			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/admins/edit-admin/'.$admin->id;
				}
				return Redirect::to($prevURL)->with('flash_success',"<b>{$admin->first_name} {$admin->last_name}</b> {$message}.");
			}
			return Redirect::to(URL.'/admin/admins')->with('flash_success',"<b>{$admin->first_name} {$admin->last_name}</b> {$message}.");
		}

		return Redirect::to($prevURL)->with('flash_error',$pass->messages()->all())->withInput();
	}

	public function imageBrowser($page = 1)
	{
		if( Request::ajax() ) {
			if( Input::has('page') ) {
				$page = Input::get('page');
			}
			return MyImage::imageBrowser('admins', $page, false);
		}
		return App::abort(404);
	}

	public function deleteAdmin($id)
	{
		if( Request::ajax() ) {
			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
			try {
				$admin = Admin::findorFail($id);
			} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
				return App::abort(404);
			}
			$name = $admin->first_name.' '.$admin->last_name;
			if( $admin->delete() )
				$arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
			return $arrReturn;
		}
		return App::abort(404);
	}

	public function changeTheme()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$arrReturn = ['status' => 'error'];
		if( Input::has('type') && Input::has('value') ) {
			$arrThemes = ['default', 'darkblue', 'blue', 'light', 'light2'];
			$type = Input::get('type');
			$value = Input::get('value');
			$theme = Cookie::has('theme') ? (array)Cookie::get('theme') : [];
			if( $type == 'color' ) {
				if( !in_array($value, ['default', 'darkblue', 'blue', 'light', 'light2']) ) {
					$arrReturn = ['status' => 'error', 'message' => 'Please choose a valid theme color.'];
				} else {
					$arrReturn = ['status' => 'ok'];
				}
			} else if( $type == 'style' ) {
				$arrReturn = ['status' => 'ok'];
				if( !in_array($value, ['square', 'rounded']) ) {
					$arrReturn = ['status' => 'error', 'message' => 'Please choose a valid theme style.'];
				} else {
					$arrReturn = ['status' => 'ok'];
					if( $value == 'rounded' ) {
						$value = 'components-rounded';
					} else {
						$value = 'components';
					}
				}
			} else if( $type == 'sidebar' || $type == 'footer' ) {
				if( !in_array($value, ['default', 'fixed']) ) {
					$arrReturn = ['status' => 'error', 'message' => 'Please choose a valid theme style.'];
				} else {
					$arrReturn = ['status' => 'ok'];
				}
			} else {
				$arrReturn = ['status' => 'error', 'message' => 'This theme option is not existed!'];
			}
			if( $arrReturn['status'] == 'ok' ) {
				$theme = array_merge( $theme, [$type => $value] );
				Cookie::queue('theme', $theme, 43200);
			}
		}
		return $arrReturn;
	}

	public function viewChat()
	{
	    $arrReturn = [];
	    if( Input::has('chatter_id') ){
	        $chatterId = Input::get('chatter_id');
	        if( strlen($chatterId) == 24 ) {
	            return Response::json(Chat::getChat($chatterId));
	        }
	    }
	    return $arrReturn;
	}

	public function updateRead()
	{
	    if( Input::has('chatter_id') ){
	        $chatterId = Input::get('chatter_id');
	        Chat::updateRead($chatterId);
	        return Response::json(Chat::countNewMessage());
	    }
	}

	public function getAlerts()
	{
		if( !Request::ajax() ) {
			return App::abort(404);
		}
		$adminId = Auth::admin()->get()->id;
		$general = Input::has('general') ? true: false;
		$system  = Input::has('system') ? true: false;
		if( $general ) {
			$alerts = DB::table('notifications')->where('admin_id', $adminId)
							->where('item_type', 'like', 'General%')
							->orderBy('id')
							->take(10)
							->get();
		} else if( $system ) {
			$alerts = DB::table('notifications')->where('admin_id', $adminId)
							->where('item_type', 'like', 'System%')
							->orderBy('id')
							->take(10)
							->get();
		} else if($general && $system) {
			$alerts = DB::table('notifications')->where('admin_id', $adminId)
							->where('item_type', 'like', 'System%')
							->orderBy('id')
							->take(10)
							->unionAll(
								DB::table('notifications')->where('admin_id', $adminId)
									->where('item_type', 'like', 'General%')
									->orderBy('id')
									->take(10)
							)
							->get();
		} else {
			$alerts = null;
		}

		$arrReturn = [];
		if( $alerts ) {
			foreach($alerts as $alert) {
				list($type, $subType) = explode('||', $alert->item_type);
				$arrReturn[strtolower($type)][] = [
											'message' => $alert->description,
											'type' => $subType,
											'time' => (new DateTime($alert->created_at))->format('c')
										];
			}
		}
		return $arrReturn;
	}
}