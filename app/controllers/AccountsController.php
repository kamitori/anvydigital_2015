<?php
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
class AccountsController extends BaseController {

    public function index()
    {
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.accounts.manage');
    }

    public function register()
    {
        if( Request::isMethod('post') ) {
            $captcha = Input::get('captcha');
            $originCaptcha = Session::pull('image-captcha');
            if ($captcha != $originCaptcha) {
                return Redirect::to('/account/register')->with('flash_error', "Please input valid captcha to continue.")->withInput();
            }
            $user = new User;

            $password = Input::get('password');
            $user->password = $password;
            $user->password_confirmation = Input::get('password_confirmation');
            $user->email        = Input::get('email');
            $user->first_name   = Input::get('first_name');
            $user->last_name    = Input::get('last_name');
            $user->phone        = Input::get('phone');
            $user->fb_id        = Input::has('fb_id')?Input::get('fb_id'):"";
            $user->company_name = Input::get('company_name');
            $user->subscribe    = Input::has('subscribe') ? 1 : 0;
            $user->subscribe_at = date("Y-m-d H:i:s");
            $user->active       = 0;

            $pass = $user->valid();

            if( $pass->passes() ) {
                if( isset($user->password_confirmation) ) {
                    unset($user->password_confirmation);
                }
                if( isset($password) ) {
                    $user->password = Hash::make($password);
                }
                $user->save();
                BackgroundProcess::approvalMail([
                        'user_id' => $user->id
                    ]);
                BackgroundProcess::waitactiveMail([
                        'user_id' => $user->id
                    ]);

                if($user->subscribe=='1')
                {
                    BackgroundProcess::newsletterMail([
                        'email' => $user->email,
                        'name' => $user->first_name.' '.$user->last_name
                    ]);
                }
                return Redirect::to('/')->with('flash_success', 'Success! You are now registered with Anvy Digital.<br />Please check your email to activate account.');
            }
            return Redirect::to('/account/register')->with('flash_error', $pass->messages()->all())->withInput();
        }
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.accounts.register');
    }

    public function detail()
    {
        $user =  Auth::user()->get();
        $arrData = [];
        if (Request::isMethod('post')) {
            $validation = Validator::make(
                [
                    'email' => Input::get('email'),
                    'password' => Input::get('password'),
                    'password_confirmation' => Input::get('password_confirm'),
                ],
                [
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'password' => 'min:6|confirmed',
                    'password_confirmation' => 'min:6|required_with:password',
                ]
            );
            if ($validation->fails()) {
                $arrData = ['errors' => $validation->messages()->all()];
            } else {
                $user->email = Input::get('email');
                $user->first_name = Input::get('first_name');
                $user->last_name = Input::get('last_name');
                $user->company_name = Input::get('company_name');
                if (Input::has('password')) {
                    $user->password = Hash::make(Input::get('password'));
                }
                $subscribe = Input::has('subscribe');
                if($subscribe != $user->subscribe)
                {
                    if ($subscribe) $user->subscribe = 1;
                    else $user->subscribe = 0;    
                    
                    $data = [
                        'email' => $user->email,
                        'name' => $user->first_name.' '.$user->last_name
                    ];
                    if($subscribe == 0)
                    {
                        $data['unsubscribe'] = 1;
                    }

                    BackgroundProcess::newsletterMail($data);
                }
                $user->save();
                return Redirect::to('/account/detail')->with('flash_success', 'Save Success!');
            }
        }
        $user = $user->toArray();
        if (strlen($user['company_id']) == 24) {
            $user['company'] = JTCompany::where('_id', new MongoId($user['company_id']))->remember(60)->pluck('name');
        } else {
            $user['company'] = '';
        }
        $arrData = array_merge($arrData, ['user' => $user]);
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.accounts.detail')->with($arrData);
    }

    public function forgot()
    {
        if( Request::isMethod('post') ) {
            $lastTry = Session::get('lastTry');
            if (!$lastTry || $lastTry['time'] < time() - 1800) {
                $lastTry = [
                    'time'  => time(),
                    'count' => 1
                ];
            }
            switch ($lastTry['count']) {
                case 1:
                case 2:
                    break;
                case 3:
                case 4:
                    sleep(2);
                    break;
                default:
                    sleep(4);
                    break;
            }
            $response = Password::user()->remind(Input::only('email'), function($message) {
                            $message->subject('Password reminder');
                        });
            $lastTry = [
                    'time'  => time(),
                    'count' => $lastTry['count']++
                ];
            switch ($response ) {
                case Password::INVALID_USER:
                    $message = 'This email did not exist in our system';
                    break;
                case Password::REMINDER_SENT:
                    $lastTry = [
                        'time'  => time(),
                        'count' => 1
                    ];
                    $message = 'We sent you an email to reset your password.';
                    break;
            }
            $lastTry = Session::set('lastTry', $lastTry);
            return ['message' => $message];
        }
        $this->layout->content = View::make('frontend'.$this->mobiledir.'.accounts.forgot');
    }

    public function resetPassword($token)
    {
        $arrReturn = [];
        if( Request::isMethod('post') ) {
            $credentials = array(
                            'email'             => Input::get('email'),
                            'password'          => Input::get('password'),
                            'password_confirmation' => Input::get('password_confirmation'),
                            'token'             => $token
                        );

            $response = Password::user()->reset($credentials, function($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            });
            switch ($response) {
                case Password::INVALID_TOKEN:
                    $arrReturn['error'] = 'Token is expired or not valid.';
                    break;
                case Password::INVALID_PASSWORD:
                    $arrReturn['error'] = 'Password was not match.';
                    break;
                case Password::INVALID_USER:
                    $arrReturn['error'] = 'This email did not exist in our system.';
                    break;
                case Password::PASSWORD_RESET:
                    return Redirect::to('/')->with('flash_success', 'You has been reset your password successfully.');
            }
        }
        $this->layout->content = View::make('frontend.accounts.reset')->with($arrReturn);
    }

    public function logout()
    {
    }

    public function unsubscribe($token = '')
    {
        if (empty($token)) {
            return App::abort(404);
        }
        $email = Crypt::decrypt($token);
        $validator = Validator::make(
            array('email' => $email),
            array('email' => 'required|email')
        );

        if ($validator->fails()) {
            return App::abort(404);
        }

        $user = User::where('email', $email)
                        ->first();

        if (!$user) {
            return App::abort(404);
        }

        $user->subscribe = 0;
        $user->save();
        return Redirect::to('/')->with('flash_success', 'Email ['. $email .'] has been unsubscribed successfully.');
    }

    public function active($token){
        $token = explode("--", base64_decode(str_rot13($token)));
        $email = $token[0];
        $id = $token[1];
        $user = User::find($id);
        if($user->email == $email){
            $user->active = 1;
            if($user->save())
                return Redirect::to('/')->with('flash_success', 'Your account has been activated.');
        }
        return Response::make("Something is error.");
    }

    public function checkLogin(){
        $email = Input::get('email');
        $fb_id = Input::get('fb_id');
        $arr_return = [
            "login" => 0,
            "message"=>""
        ];
        $user = User::where("email","=",$email)->first();
        if($user){
            $user->fb_id = $fb_id;
            $user->save();
            if($user->active == 1){
                Auth::user()->loginUsingId($user->id);
                $arr_return["login"]=1;
            }else{
                $arr_return["message"]="Your account has not been activated yet.";
            }
            
        }
        return $arr_return;
    }

    public function testMail($userId){
        BackgroundProcess::waitactiveMail([
                        'user_id' => $userId
                    ]);
        // $user = User::find($userId);
        // if (!$user) {
        //     return $this->error('Missing user_id field.');
        // }
        // $user = $user->toArray();
        // unset($user['password'],
        //     $user['created_by'],
        //     $user['updated_by'],
        //     $user['company_id'],
        //     $user['jt_id']);
        // $user['token'] = str_rot13(base64_encode($user['email'].'--'.$user['id']));
        // $arrData = ['user' => $user];
        // $subject = '[ANVYDIGITAL]You have been registered.';

        // $signupNotificationEmails = Configure::getSignupNotificationEmails();
        // $arrEmailsCC = explode(",", $signupNotificationEmails);
        // $arrEmailsCC = array_map('trim',$arrEmailsCC);

        // Mail::send('emails.auth.waitactivate', $arrData, function($message) use($user, $subject, $arrEmailsCC) {
        //     $message->to($user['email'])->cc($arrEmailsCC)->subject($subject);
        // });
    }
}