<?php
class ProductTab extends BaseModel {

	protected $table = 'tabs';

	protected $rules = [
			'name' => 'required|min:6',
	];

	public function optionGroups()
    {
        return $this->hasMany('ProductOptionGroup', 'tab_id')
        				->orderBy('option_groups.name', 'asc');
    }

	public static function getSource($toJson = false, $getOptionGroups = false)
	{
		$arrReturn = [];
		if( !$getOptionGroups ) {
			$arrReturn[] = ['value' => 0, 'text' => ''];
		}
		$arrData = self::select('id', 'name')->orderBy('name', 'asc')->get();
		if( !$arrData->isEmpty() ) {
			foreach($arrData as $data) {
				$optionsData = [];
				if( $getOptionGroups ) {
					$optionGroups = $data->optionGroups()->get();
					if( !$optionGroups->isEmpty() ) {
						foreach($optionGroups as $value) {
							$optionsData[] = ['value' => $value->id, 'text' => $value->name];
						}
					}
				}
				$arrReturn[] = ['value' => $data->id, 'text' => $data->name, 'optionGroups' => $optionsData];
			}
		}
		if( $toJson ) {
			$arrReturn = json_encode($arrReturn);
		}
		return $arrReturn;
	}
}