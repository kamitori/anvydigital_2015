<?php
use Jenssegers\Agent\Agent;
class HomeController extends BaseController {

	public function index()
	{
        if( Input::has('search') ) {
            return Redirect::to(URL.'/product-search?s='.Input::get('search'));
        }
		$this->layout->content = View::make('frontend'.$this->mobiledir.'.homes.index')->with([
												'banner' 		=> Home::getBanner(),
												'home'			=> Configure::getHome(),
												'homeCategory'  => Home::getCategory(),
												'homeLink'		=> Home::getHomeLink(),
												'homeSocial'	=> Home::getHomeSocial(),
											]);
	}

    public function submitFeedback()
    {
        /*
        # ***********
        # ReCaptcha
        # ***********
        $captcha = Input::get('g-recaptcha-response');
        if (empty($captcha)) {
            return ['status' => 'error', 'message' => 'Are you human? :)'];
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL , 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
                                                        'secret' => '6LeMhQ4TAAAAADN667PLMR8KY_aeCMAGEauVdsSd',
                                                        'response' => $captcha
                                                    ]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $response  = json_decode(curl_exec($curl), true);
        curl_close($curl);
        if (!$response['success']) {
            return ['status' => 'error', 'message' => 'Please click captcha before submit you feedback'];
        }
        */

        $captcha = Input::get('captcha');
        $originCaptcha = Session::pull('image-captcha');
        if ($captcha != $originCaptcha) {
            return ['status' => 'error', 'message' => 'Please input valid captcha to continue.'];
        }
        $feedback = new Contact;
        $feedback->first_name = Input::get('first_name');
        $feedback->last_name = Input::get('last_name');
        $feedback->company = Input::get('company');
        $feedback->phone = Input::get('phone');
        $feedback->email = Input::get('email');
        $feedback->subject = Input::get('subject');
        $feedback->message = nl2br(e(Input::get('message')));
        $feedback->save();

        $admins = Admin::select('email')->where('subject',$feedback->subject)->get();
        $arr_email_admin = $admins->toArray();
        foreach ($arr_email_admin as $key => $email_admin) {
            BackgroundProcess::feedBackMail(['feedback_id' => $feedback->id],$email_admin['email']);
        }
        return ['status' => 'ok', 'message' => 'Your feedback has been sent to server.'];
    }

    public function imageCaptcha()
    {
        $subjects = [
            'a' => rand(1, 45),
            'b' => rand(15, 70),
        ];

        $subjects['result'] = $subjects['a'] + $subjects['b'];

        Session::put('image-captcha', $subjects['result']);
        return (new \Intervention\Image\ImageManager(['driver' => 'gd']))->canvas(125, 35, '#000')
                        ->text("{$subjects['a']} + {$subjects['b']} = ", 65, 17, function($font) {
                            $font->color('#fff');
                            $font->align('center');
                            $font->valign('middle');
                            $font->file(5);
                        })
                        ->response('jpg', 70);
    }

    public function getProvince($countryID)
    {
        return JTSetting::getAllProvinceByCountry($countryID);
    }

    public function submitSubscribe()
    {
        $email = Input::get('email');
        $name = Input::get('name');
        $arr_name = explode(" ", $name);
        $first_name = ucwords($arr_name[0]);
        $last_name = ucwords(str_replace($first_name." ", "", $name));
        $subscribe_at = date("Y-m-d H:i:s");
        if( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
            $notification = 1;
            try{
                DB::statement('INSERT INTO `users`(`first_name`,`last_name`, `email`, `password`, `subscribe`, `active`,`subscribe_at`) VALUES ("'.$first_name.'","'.$last_name.'", "'. $email .'", "'.Hash::make(str_random(15)).'", 1, 0,"'.$subscribe_at.'")');
            } catch(Exception $e) {
                $notification = 0;
            }
            $arrReturn = ['status' => 'ok', 'message' => 'Thank you for subscribing to our newsletter.<br /> You have been successfully added to our mailing list, keeping you up-to-date with our latest news.'];

            if($notification == 1)
            {
                BackgroundProcess::newsletterMail([
                        'email' => $email,
                        'name' => $name
                    ]);       
            }
    
        } else {
            $arrReturn = ['status' => 'error', 'message' => 'Please enter valid email.'];
        }


        return $arrReturn;
    }

    public function sitemap()
    {
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.pages.sitemap')->with([
                                                                        'sitemap' => Home::getSitemap()
                                                                    ]);
    }

	public static function errors($code = 404, $title = '', $message = '')
    {
        $ajax = Request::ajax();
        if( !$code ) {
            $code = 500;
            $title = 'Internal Server Error';
            $message = 'We got problems over here. Please try again later!';
        } else if( $code == 404 ) {
            $title = 'Oops! You\'re lost.';
            $message = 'We can not find the page you\'re looking for.';
        }
        if( Request::ajax() ) {
            return Response::json([
                'error' => [
                    'message' => $message
                    ]
            ],$code);
        }
	$agent = new Agent();
	$mobiledir = '';
        if($agent->isMobile() && !$agent->isTablet())
        {
            //Is Mobile Agent, not Tablet
            $mobiledir = '.mobile';
	}
        return View::make('frontend'.$mobiledir.'.layout.default')->with([
                                                        'metaInfo'      => array_merge(Home::getMetaInfo(), ['meta_title' => $title]),
                                                        'headerMenu'    => Menu::getCache(['header' => true]),
                                                        'productMenu'   => Menu::getCache(['product' => true]),
                                                        'footerMenu'    => Menu::getCache(['footer' => true]),
                                                        'footerSocial'  => Home::getFooterSocial(),
            											'user'         	=> Auth::user()->get(),
                                                        'cartQuantity'  => Cart::count(),
                                                        'content'       => View::make('frontend.errors.error')->with([
                                                                                                        'title' => $title,
                                                                                                        'code'  => $code,
                                                                                                        'message' => $message
                                                                                                    ])
                                                    ]);
    }
}
