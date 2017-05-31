<?php

class Product extends BaseModel {

	protected $table = 'products';

	protected $rules = [
			'name' 		=> 'required|min:2|unique:products',
			'price' 	=> 'integer',
			'active' 	=> 'integer',
	];

	protected static $editLink = 'admin/products/edit-product';

	public function valid()
    {
        $arr = $this->toArray();
        if(isset($arr['id'])) {
            $this->rules['name'] .= ',name,'.$arr['id'];
        }
        return Validator::make(
            $arr,
            $this->rules
        );
    }

	public function overview()
	{
		return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id')
						->withPivot('option')
						->where('imageables.option', 'like', '%"overview":1%')
						->orderBy('imageables.id', 'desc');
	}

	public function cover()
	{
		return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id')
						->withPivot('option')
						->where('imageables.option', 'like', '%"cover":1%');
	}

	public function options()
	{
		return $this->morphedByMany('ProductOption', 'optionable', 'optionables', 'product_id')
						->withPivot('option')
						->orderBy('options.id', 'asc');
	}

	public function optionGroups()
	{
		return $this->morphedByMany('ProductOptionGroup', 'optionable', 'optionables', 'product_id')
						->withPivot('option')
						->orderBy('option_groups.name', 'asc');
	}

	public function categories()
	{
		return $this->belongsToMany('ProductCategory', 'products_categories', 'product_id', 'category_id');
	}

	public function tabs()
	{
        return $this->belongsToMany('ProductTab', 'products_tabs', 'product_id', 'tab_id');
	}

	public function priceBreaks()
    {
        return $this->hasMany('PriceBreak', 'product_id')
        				->orderBy('price_breaks.range_from', 'asc');
    }

    public function sizeLists()
    {
        return $this->hasMany('SizeList', 'product_id')
        				->orderBy('size_lists.sizew', 'asc')
        				->orderBy('size_lists.sizeh', 'asc');
    }

    public function layout()
	{
		return $this->belongsTo('Layout', 'svg_layout_id');
	}

	public static function getSource($toJson = false)
	{
		$arrReturn = [];
		$arrReturn[] = ['value' => 0, 'text' => '', 'short_name' => ''];
		$arrData = self::select('id', 'name', 'short_name')->where('active', 1)->orderBy('name', 'asc')->get();
		if( !$arrData->isEmpty() ) {
			foreach($arrData as $data) {
				$arrReturn[$data->id] = ['value' => $data->id, 'text' => $data->name, 'short_name' => $data->short_name];
			}
		}
		if( $toJson ) {
			$arrReturn = json_encode($arrReturn);
		}
		return $arrReturn;
	}

	public static function getPrice($data)
	{
		if( isset($data->products) ) {
			return JTProduct::getPriceByManyProducts($data);
		}

		return JTProduct::getPrice($data);
	}

	public static function viFormat($number)
	{
		return number_format($number, Configure::getFormat());
	}

	public function afterSave($product)
	{
		Cache::tags(['menu', 'product'])->flush();
		Cache::tags(['products', 'frontendProduct-'.$product->id])->flush();
	}

	public function beforeDelete($product)
	{
		Cache::tags(['menu', 'product'])->flush();
		Cache::tags(['products', 'frontendProduct-'.$product->id])->flush();
		$product->images()->detach();
		$product->categories()->detach();
		$product->options()->detach();
		$product->optionGroups()->detach();
		$product->priceBreaks()->delete();
		$product->sizeLists()->delete();
	}

	public function afterCreate($product)
	{
		Cache::tags(['menu', 'product'])->flush();
		Notification::add($product->id, 'Product');
	}

}