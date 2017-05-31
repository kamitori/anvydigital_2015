<?php
class DesignFont extends BaseModel {

	protected $table = 'design_fonts';

	protected $rules = array(
		'name' 		=> 'required',
	);

	public static function getFonts()
	{
		return Cache::get('fonts', function() {
			$fonts = self::select('name', 'source')
						->orderBy('name')
						->get();
			if( !$fonts->isempty() ) {
				$arrData = [];
				foreach($fonts as $font) {
					$arrData[] = [
								'name' => $font->name,
								'source' => URL.'/'.$font->source
							];
				}
				return $arrData;
			}
			return [];
		});
	}

	public function beforeDelete($font)
	{
		$file = public_path( str_replace(['/', DS], DS, $font->source) );
		if( File::exists($file) ) {
			File::delete($file);
		}
		Cache::forget('fonts');
	}

	public function afterSave($font)
	{
		Cache::forget('fonts');
	}

}