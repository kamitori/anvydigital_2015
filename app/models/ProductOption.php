<?php

class ProductOption extends BaseModel {

	protected $table = 'options';

    protected $rules = [
            'name'              => 'required|min:6',
            'option_group_id'   => 'numeric',
    ];

    public function images()
    {
        return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id')
                        ->withPivot('option')
                        ->orderBy('imageables.id', 'desc');
    }

	public function products()
    {
        return $this->morphedByMany('ProductOption', 'optionable', 'optionables', 'optionable_id');
    }

    public function optionGroup()
    {
        return $this->belongsTo('ProductOptionGroup');
    }

    public function beforeDelete($option)
	{
        $option->images()->detach();
		$option->products()->detach();
	}
}