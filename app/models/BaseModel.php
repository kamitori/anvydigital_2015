<?php

class BaseModel extends \Eloquent {

    protected $guarded = array('id');

    protected $rules = array();

    protected static $editLink = '';

	public static function boot()
    {
        try {
            $admin = Auth::admin()->get();
        } catch(Exception $e) {
            $admin = [];
        }
        parent::boot();
        self::creating(function($model) use ($admin) {
            $model->created_by = $model->updated_by = isset($admin['id']) ? $admin['id'] : 0;
        });
        self::created(function($model) use ($admin) {
            $model->afterCreate($model);
            try {
                $editLink = self::$editLink;
            } catch(Exception $e) {
                $editLink = '';
            }
            self::addNotification($model, $admin, 'created', $editLink);
        });
        self::updating(function($model) use ($admin) {
            $model->updated_by = isset($admin['id']) ? $admin['id'] : 0;
        });
        self::deleting(function($model) use ($admin) {
            $model->beforeDelete($model);
            try {
                $editLink = self::$editLink;
            } catch(Exception $e) {
                $editLink = '';
            }
            self::addNotification($model, $admin, 'deleted', $editLink);
        });
        self::saving(function($model) {
            $model->beforeSave($model);
        });
        self::saved(function($model) use ($admin) {
            $model->afterSave($model);
            try {
                $editLink = self::$editLink;
            } catch(Exception $e) {
                $editLink = '';
            }
            self::addNotification($model, $admin, 'updated', $editLink);
        });

    }

    public static function addNotification($model, $admin, $action, $link = '')
    {
        $adminName = '<b>'.$admin['first_name'].' '.$admin['last_name'].'</b> &lt;'.$admin['email'].'&gt;';
        $className = get_class($model);
        if( !empty($link) && $action != 'deleted' ) {
            $message = $className.' <span class="label label-sm label-success"><a href="'.URL.'/'.$link.'/'.$model->id.'" target="_blank">ID: '.$model->id.'</a></span>';
        } else {
            $message = $className.' <span class="label label-sm label-success">ID: '.$model->id.'</span>';
        }
        Notification::add($model->id, 'General||'.$className.'-'.ucfirst( $action ), $message.' was '. $action .' by '.$adminName);
    }

    public function valid()
    {
    	return Validator::make(
            $this->toArray(),
            $this->rules
        );
    }

    public function afterCreate($model)
    {
    }

    public function beforeSave($model)
    {
    }

    public function afterSave($model)
    {
    }

    public function beforeDelete($model)
    {
    }
}