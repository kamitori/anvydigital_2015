<?php

class Configure extends BaseModel {

	protected $table = 'configures';

	protected $rules = array(
			'cname' 	=> 'required',
			'ckey' 		=> 'required',
			'cvalue' 	=> 'required',

		);

	public static function getFormat()
	{
		if( !Cache::has('vi_format') ) {
			$decimals = self::where('ckey', 'vi_format')->pluck('cvalue');
			if( $decimals ) {
				Cache::forever('vi_format', $decimals);
			} else {
				$decimals = 2;
			}
		} else {
			$decimals = Cache::get('vi_format');
		}
		return $decimals;
	}

	public static function getMargin()
	{
		if( !Cache::has('margin') ) {
			$margin = self::where('ckey', 'margin')->pluck('cvalue');
			if( $margin ) {
				Cache::forever('margin', $margin);
			} else {
				$margin = 5;
			}
		} else {
			$margin = Cache::get('margin');
		}
		return $margin;
	}

	public static function getBackground()
	{
		if( !Cache::has('background') ) {
			$backgrounds = self::select('cvalue')
								->where('active', 1)
								->where('ckey', 'background')
								->get();
			if( !$backgrounds->isEmpty() ) {
				$arrBackgound = [];
				foreach($backgrounds as $bg) {
					$arrBackgound[] = $bg->cvalue;
				}
				Cache::forever('background', $arrBackgound);
			} else {
				$arrBackgound = [URL.'/assets/images/background/bg_wall5.png'];
			}
		} else {
			$arrBackgound = Cache::get('background');
		}
		return $arrBackgound;
	}
	public static function get_google_analytic_id()
	{
		if( Cache::has('google_analytic_id') ) {
			return Cache::get('google_analytic_id');
		} else {
			$googleDrive = self::select('ckey', 'cvalue')
							->where('active', 1)
							->where('ckey', '=', 'google_analytic_id')
							->get();
			if( !$googleDrive->isEmpty() ) {
				$key = '';
				foreach($googleDrive as $key) {
					$key = $key->cvalue;
				}
				Cache::forever('google_analytic_id', $key);
				return $key;
 			}
 			return [];
		}
	}
	public static function getGoogleDrive()
	{
		if( Cache::has('googleDrive') ) {
			return Cache::get('googleDrive');
		} else {
			$googleDrive = self::select('ckey', 'cvalue')
							->where('active', 1)
							->where('ckey', 'like', 'google_drive_%')
							->get();
			if( !$googleDrive->isEmpty() ) {
				$arrData = [];
				foreach($googleDrive as $key) {
					$arrData[$key->ckey] = $key->cvalue;
				}
				Cache::forever('googleDrive', $arrData);
				return $arrData;
 			}
 			return [];
		}
	}

	public static function getHome()
	{
		if( Cache::has('home') ) {
			return Cache::get('home');
		} else {
		 	$homes = self::select('ckey', 'cvalue')
							->where('ckey', 'like', 'home_%')
							->get();
			$arrData = [];
			if( !$homes->isEmpty() ){
				foreach($homes as $home) {
					$key = str_replace('home_', '', $home->ckey);
					$arrData['home'][$key] = e($home->cvalue);
				}
				Cache::forever('home', $arrData);
			}
			return $arrData;
		}
	}

	public static function getAnvyMail()
	{
		if( Cache::has('anvy_mail') ) {
			return Cache::get('anvy_mail');
		} else {
			$mail = self::where('ckey', 'anvy_mail')->pluck('cvalue');
			if( $mail ) {
				Cache::forever('anvy_mail', $mail);
			} else {
				$mail = 'info@anvydigital.com';
			}
			return $mail;
		}
	}

	public static function getSignupNotificationEmails()
	{
		if( Cache::has('signup-notification-emails') ) {
			return Cache::get('signup-notification-emails');
		} else {
			$mail = self::where('ckey', 'signup-notification-emails')->pluck('cvalue');
			if( $mail ) {
				// Cache::forever('signup-notification-emails', $mail);
			} else {
				$mail = 'info@anvydigital.com';
			}
			return $mail;
		}
	}

	public static function getSignupNewsletterEmails()
	{
		if( Cache::has('signup-newsletter-emails') ) {
			return Cache::get('signup-newsletter-emails');
		} else {
			$mail = self::where('ckey', 'signup-newsletter-emails')->pluck('cvalue');
			if( $mail ) {
				// Cache::forever('signup-newsletter-emails', $mail);
			} else {
				$mail = 'info@anvydigital.com';
			}
			return $mail;
		}
	}

	public function images()
	{
		return $this->morphToMany('MyImage', 'imageable', 'imageables', 'imageable_id', 'image_id')
						->withPivot('option')
						->orderBy('imageables.id', 'desc');
	}

	private static function deleteCache($configure)
	{
		switch ($configure->ckey) {
			case 'meta_title':
			case 'meta_description':
			case 'main_logo':
			case 'favicon':
				Cache::forget('meta_info');
				break;
			case 'vi_format':
				Cache::forget('vi_format');
				break;
			case 'margin':
				Cache::forget('margin');
				break;
			case 'google_drive_email':
			case 'google_drive_key_file':
				Cache::flush('googleDrive');
				break;
			case 'background':
				Cache::flush('background');
				break;
			case 'anvy_mail':
				Cache::forget('anvy_mail');
				break;
			default:
				break;
		}
	}

	public function afterSave($configure)
	{
		self::deleteCache($configure);
	}

	public function beforeDelete($configure)
    {
		self::deleteCache($configure);
    }
}