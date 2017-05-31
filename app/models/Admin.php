<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class Admin extends BaseModel implements UserInterface, RemindableInterface {

    use HasRole;
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'admins';

	protected static $editLink = 'admin/admins/edit-admin';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function images()
	{
		return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id');
	}

    public static function getController()
    {
        $controllerPath = app_path().'/controllers/admin/';
        $allController = glob($controllerPath.'*Controller.php');
        $arrController = [];
        foreach($allController as $controller) {
            $controller = str_replace([$controllerPath,'Controller.php'], '', $controller);
            $controller = trim(preg_replace('/([A-Z])/', ' $1', $controller));
            $controller = strtolower($controller);
            $arrController[] = $controller;
        }
        return $arrController;
    }

    

	public function beforeDelete($admin)
	{
		$admin->images()->detach();
	}

}
