<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected static $editLink = 'admin/users/edit-user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array(/*'password', */'remember_token');

	protected $rules = array(
            'password' 	=> 'required|min:6',
            'email'     => 'required|email|unique:users',
            'first_name'=> 'required',
		);

	public function valid()
    {
        $arr = $this->toArray();
        if(isset($arr['id'])) {
            $this->rules['email'] .= ',email,'.$arr['id'];
            if(!isset($arr['password'])) {
                unset($this->rules['password']);
            } else {
                $this->rules['password'] .= '|confirmed';
                $this->rules['password_confirmation'] = 'required|min:6';
            }
        } else {
            $this->rules['password'] .= '|confirmed';
            $this->rules['password_confirmation'] = 'required|min:6';
        }

        return Validator::make(
            $arr,
            $this->rules
        );
    }

	public function images()
	{
		return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id');
	}

	public function address()
	{
        return $this->hasMany('Address', 'user_id')
        				->orderBy('addresses.id', 'asc');
    }

	public function beforeDelete($user)
	{
		$user->images()->detach();
	}

	public function afterCreate($user)
	{
		Notification::add($user->id, 'User');
	}

    public function beforeSave($user)
    {
        if (isset($user->subscribe) && $user->subscribe) {
            if (!isset($user->id) || self::where('id', $user->id)->where('subscribe', 0)->pluck('id')) {
                $this->subscribe_at = date('Y-m-d H:i:s');
            }
        }
    }

}
