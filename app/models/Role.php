<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public static $rules = array(
        'name' => 'required|between:4,128|unique:roles'
    );

    protected static $editLink = 'admin/roles/edit-role';

    public static function boot()
    {
        try {
            $admin = Auth::admin()->get();
        } catch(Exception $e) {
            $admin = [];
        }
        parent::boot();
        self::creating(function($model) use ($admin) {
            $model->created_by = $model->updated_by = $admin['id'];
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
            $model->updated_by = $admin['id'];
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

    public function afterCreate($model)
    {
    }

    public function afterSave($model)
    {
    }

    public static function getSource($toJson = false)
    {
        $arrReturn = [];
        $arrReturn[] = ['value' => 0, 'text' => ''];
        $arrData = self::select('id', 'name')->orderBy('name', 'asc')->get();
        if( !$arrData->isEmpty() ) {
            foreach($arrData as $data) {
                $arrReturn[] = ['value' => $data->id, 'text' => $data->name];
            }
        }
        if( $toJson ) {
            $arrReturn = json_encode($arrReturn);
        }
        return $arrReturn;
    }

    public function valid()
    {
        $arr = $this->toArray();
        $rules = self::$rules;
        if(isset($arr['id'])) {
            $rules['name'] = 'required|between:4,128|unique:roles,name,'.$arr['id'];
        }
        return Validator::make(
            $arr,
            $rules
        );
    }
}