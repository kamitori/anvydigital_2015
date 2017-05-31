<?php

class UsersController extends AdminController {

	public static $table = 'users';

	public function index()
	{    
		$this->layout->title = 'Users';    
		$this->layout->content = View::make('admin.users-all');
	}

	public function listUser()
	{
		if( !Request::ajax() ) {
            return App::abort(404);
        }
		$admin_id = Auth::admin()->get()->id;

		$start = Input::has('start') ? (int)Input::get('start') : 0;
		$length = Input::has('length') ? Input::get('length') : 10;
		$search = Input::has('search') ? Input::get('search') : [];
		$users = User::with('images')
						->select(DB::raw('id, first_name, last_name, email, active,vip, subscribe, subscribe_at,last_login,
											(SELECT COUNT(*)
												FROM notifications
									         	WHERE notifications.item_id = users.id
									         		AND notifications.item_type = "User"
													AND notifications.admin_id = '.$admin_id.'
													AND notifications.read = 0 ) as new'));
		if(!empty($search)){
			foreach($search as $key => $value){
				if(empty($value)) continue;
				if( $key == 'active' || $key == 'subscribe' || $key=='vip' ) {
					if( $value == 'yes' ) {
						$value = 1;
					} else {
						$value = 0;
					}
	        		$users->where($key, $value);
				} else {
	                $value = ltrim(rtrim($value));
	        		$users->where($key,'like', '%'.$value.'%');
				}
			}
		}
		$order = Input::has('order') ? Input::get('order') : [];
		if(!empty($order)){
			$columns = Input::has('columns') ? Input::get('columns') : [];
			foreach($order as $value){
				$column = $value['column'];
				if( !isset($columns[$column]['name']) || empty($columns[$column]['name']) )continue;
				$users->orderBy($columns[$column]['name'], ($value['dir'] == 'asc' ? 'asc' : 'desc'));
			}
		}
        $count = $users->count();
        if($length > 0) {
			$users = $users->skip($start)->take($length);
		}
		$arrUsers = $users->get()->toArray();
		$arrReturn = ['draw' => Input::has('draw') ? Input::get('draw') : 1, 'recordsTotal' => User::count(),'recordsFiltered' => $count, 'data' => []];
		$arrRemoveNew = [];
		if(!empty($arrUsers)){
			foreach($arrUsers as $user){
				$avatar = '';
				if( !empty($user['images']) ) {
					$avatar = reset($user['images']);
					$avatar = $avatar['path'];
				}
				$firstName = $user['first_name'];
				if ( $user['new'] ) {
					$firstName .= '| <span class="badge badge-danger">new</span>';
					$arrRemoveNew[] = $user['id'];
				}

                if ($user['subscribe'] && $user['subscribe_at'] != null) {
                    $user['subscribe_at'] = date('d M, Y H:i', strtotime($user['subscribe_at']));
                } else {
                    $user['subscribe_at'] = '';
                }

				$arrReturn['data'][] = array(
	                              ++$start,
	                              $user['id'],
	                              $firstName,
	                              $user['last_name'],
	                              $user['email'],
	                              $avatar,
                                  $user['active'],
                                  $user['vip'],
	                              $user['subscribe_at'],
                                $user['last_login']
	                              );
			}
		}
		if( !empty($arrRemoveNew) ) {
			Notification::whereIn('item_id', $arrRemoveNew)
						->where('item_type', 'User')
						->where('admin_id', $admin_id)
						->update(['read' => 1]);
		}
		return $arrReturn;
	}

	public function addUser()
	{
   		$this->layout->title = 'Add User';
		$this->layout->content = View::make('admin.users-one');
	}

	public function editUser($userId)
	{
   		try {
   			$user = User::with('images')
   								->findorFail($userId);
	    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
	        return App::abort(404);
	    }
   		$user = $user->toArray();
   		$user['images'] = reset($user['images']);
   		$this->layout->title = 'Edit User';
		$this->layout->content = View::make('admin.users-one')->with([
																	'user' 		=> $user,
																]);
	}
  public function ExportUser(){    
    $v_file_name = 'ListUser-'.date('d-M-Y');
    if(file_exists(public_path().'/excel/exports/'.$v_file_name.'.xls')){
      return Response::json(['status' => 'ok', 'message' => URL.'/excel/exports/ListUser-'.date('d-M-Y').'.xls']);
    }else{
      Excel::create($v_file_name, function($excel) {
      $arr_user = User::all()->toArray();
      $v_path = public_path().DS.'excel';
      if(!file_exists($v_path)) @mkdir($v_path,0777);
      $v_path .= DS.'exports';
      if(!file_exists($v_path)) @mkdir($v_path,0777);    
      $excel->sheet('FullInformation', function($sheet) use($arr_user) {        
          $sheet->setOrientation('landscape');
          $sheet->setPageMargin(0.25);
          $sheet->setAutoFilter();
          $sheet->setAutoSize(true);
          $sheet->cell('A1:H1', function($cells) {

              $cells->setBackground('#000000');
              $cells->setFontColor('#ffffff');
              $cells->setFontFamily('Calibri');
              $cells->setFontSize(16);
              $cells->setFontWeight('bold');
              $cells->setFont(array(
                  'family'     => 'Calibri',
                  'size'       => '16',
                  'bold'       =>  true
              ));
              $cells->setAlignment('center');
          });
          // $sheet->setFont(array(
          //     'family'     => 'Calibri',
          //     'size'       => '15',
          // ));
          $sheet->row(1, array(
               'First name', 'Last name','Email','Company name','Phone','Status','Subcribe at','Last login'
          ));        
          $v_run = 2;
          foreach($arr_user as $arr){
            $v_status = $arr['active'] ? "Active":"Not Active";
            $v_sub = $arr['subscribe_at'] !='' ?"Yes":"";
            $sheet->row($v_run++, array(
                $arr['first_name'], $arr['last_name'] , $arr['email'] , $arr['company_name'] , $arr['phone'] , $v_status,$v_sub ,$arr['last_login']
            ));
          }
        });
      })->store('xls',public_path().DS.'excel'.DS.'exports');
      return Response::json(['status' => 'ok', 'message' => URL.'/excel/exports/ListUser-'.date('d-M-Y').'.xls']);
    }    
  }
	public function updateUser()
    {
        if( Request::ajax() && Input::has('pk') ) {
            $arrPost = Input::all();
            $message = '';
            if( $arrPost['name'] == 'active' ) {
            	$arrPost['value'] = (int)$arrPost['value'];
                if ($arrPost['value']) {
                    $user =  User::where('id', $arrPost['pk'])
                                    ->first();
                    $additional_address = [];
                    BackgroundProcess::welcomeMail([
                                'send_address'  => $user->email,
                                'send_name'     => $user->first_name.' '.$user->last_name,
                                'user_id'       => $user->id,
                            ]);


                    $message = 'A welcome email has been sent to '.$user->email;
                }
            }
            User::where('id', $arrPost['pk'])
            		->update([$arrPost['name'] => $arrPost['value']]);
            return Response::json(['status' => 'ok', 'message' => $message]);
        }

        $prevURL = Request::header('referer');
        if( !Request::isMethod('post') ) {
   			return App::abort(404);
   		}
   		if( Input::has('id') ) {
   			$create = false;
   			try {
   				$user = User::findorFail( (int)Input::get('id') );
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
   				return App::abort(404);
		    }
            $message = 'has been updated successful';

            unset( $user->password );

            if( Input::has('password') ) {
                $password = Input::get('password');
                if( Input::has('password') && Input::has('password_confirmation') ) {
                	$password = Input::get('password');
                    $user->password = Input::get('password');
                    $user->password_confirmation = Input::get('password_confirmation');
                }
            }
   		} else {
   			$create = true;
   			$user = new User;
            $message = 'has been created successful';

            $password = Input::get('password');
            $user->password = $password;
            $user->password_confirmation = Input::get('password_confirmation');
   		}

   		$user->email 		= Input::get('email');
   		$user->first_name 	= Input::get('first_name');
        $user->last_name    = Input::has('last_name')?Input::get('last_name'):"";
        $user->company_name = Input::get('company_name');
   		$user->phone 	    = Input::get('phone');
        $user->active       = Input::has('active') ? 1 : 0;
        $user->vip       = Input::has('vip') ? 1 : 0;

      $new_subscribe = Input::has('subscribe') ? 1 : 0;
      $change_subscribe = 0;
      if($user->subscribe != $new_subscribe) $change_subscribe = 1;

   		$user->subscribe 	= $new_subscribe;

   		$pass = $user->valid();

   		if( $pass->passes() ) {
   			if( isset($user->password_confirmation) ) {
   				unset($user->password_confirmation);
   			}
   			if( isset($password) ) {
   				$user->password = Hash::make($password);
   			}

   			$result = $user->save();
        if($result)
        {
          if($change_subscribe)
          {
              $data = [
                  'email' => $user->email,
                  'name' => $user->first_name.' '.$user->last_name
              ];
              if($user->subscribe == 0)
              {
                  $data['unsubscribe'] = 1;
              }
              BackgroundProcess::newsletterMail($data);
          }
        }

   			$imageId = 0;
	   		if( Input::hasFile('image') ) {
	   			$imageId = MyImage::upload(Input::file('image'), public_path().DS.'assets'.DS.'images'.DS.'users', 110, false);
	   		} else if( Input::has('choose_image') ) {
	   			$imageId = Input::get('choose_image');
	   		}

	   		if( $imageId ) {
	   			$user->images()->detach();
	   			$user->images()->attach( $imageId );
	   		}

			if( Input::has('continue') ) {
				if( $create ) {
					$prevURL = URL.'/admin/users/edit-user/'.$user->id;
				}
            	return Redirect::to($prevURL)->with('flash_success',"<b>{$user->first_name} {$user->last_name}</b> {$message}.");
			}
            return Redirect::to(URL.'/admin/users')->with('flash_success',"<b>{$user->first_name} {$user->last_name}</b> {$message}.");
   		}

   		return Redirect::to($prevURL)->with('flash_error',$pass->messages()->all())->withInput();
    }

    public function imageBrowser($page = 1)
    {
    	if( Request::ajax() ) {
	   		if( Input::has('page') ) {
	   			$page = Input::get('page');
	   		}
			return MyImage::imageBrowser('users', $page, false);
		}
   		return App::abort(404);
    }

    public function deleteUser($id)
   	{
   		if( Request::ajax() ) {
   			$arrReturn = ['status' => 'error', 'message' => 'Please refresh and try again.'];
   			try {
	   			$user = User::findorFail($id);
		    } catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
		        return App::abort(404);
		    }
		    $name = $user->first_name.' '.$user->last_name;
   		    if( $user->delete() )
   		        $arrReturn = ['status' => 'ok', 'message' => "<b>{$name}</b> has been deleted."];
   		    return $arrReturn;
   		}
   		return App::abort(404);
   	}

    public function activeAccount($token = '')
    {
        if (empty($token)) {
            return App::abort(404);
        }
        $approval = DB::table('approved_code')
                            ->where('token', $token)
                            ->first();
        if ($approval) {
            $user = User::where('email', $approval->email)
                            ->where('active', 0)
                            ->first();
            if ($user) {
                BackgroundProcess::welcomeMail([
                            'send_address'  => $user->email,
                            'send_name'     => $user->first_name.' '.$user->last_name,
                            'user_id'       => $user->id,
                        ]);
                return Redirect::to(URL.'/admin/users')->with('flash_success', 'A welcome email has been sent to '.$user->email);
            }
            return Redirect::to(URL.'/admin/users')->with('flash_error', ['This account ['.$approval->email.'] had been actived.']);
        }
        return Redirect::to(URL.'/admin/users')->with('flash_error', ['This token did not exist.']);
    }
}