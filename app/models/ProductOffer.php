<?php
class ProductOffer extends BaseModel {

	protected $table = 'offers';

	protected $rules = [
			'name' 		=> 'required|min:6|unique:offers',
			'parent_id' => 'numeric'
	];

	protected static $editLink = 'admin/product-offers/edit-offer';

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

	public function products()
	{
		return $this->belongsToMany('Product', 'products_offers', 'offer_id', 'product_id')
									->withPivot('description')
									->orderBy('products.id', 'desc');
	}

	public function home()
	{
		return $this->belongsTo('Home', 'home_id');
	}

	public function beforeDelete($offer)
    {
		$offer->products()->detach();
		$offer->home()->delete();
	   	Cache::forget('homeLink');
    }

	public function afterSave($offer)
	{
	   	Cache::forget('homeLink');
	}
}