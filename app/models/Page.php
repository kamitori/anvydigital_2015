<?php

class Page extends BaseModel {

	protected $table = 'pages';

	protected $rules = [
					'name' => 'required'
	];

	protected static $editLink = 'admin/pages/edit-page';

	public function menu()
	{
		return $this->belongTo('Menu', 'menu_id');
	}

	public function beforeDelete($page)
    {
		$page->menu()->delete();
    }
}