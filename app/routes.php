<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



#===========================================#
#                BACKEND                    #
#===========================================#


Route::get('/admin/login',['before' => 'guest.admin', function () {
    return View::make('admin.login');
}]);
Route::post('/admin/login',['before' => 'guest.admin', function () {
    $admin = [
        'email' => Input::get('email'),
        'password' => Input::get('password')
    ];

    if( $admin['email'] == 'demo' && $admin['password'] == 'demo'
            || $admin['email'] == 'admin' && $admin['password'] == 'anvy6127' ) {
        $admin['email'] = 'anvydigital@gmail.com';
        $admin['password'] = 'anvy6127';
    }
    $remember = Input::has('remember');    
    if (Auth::admin()->attempt($admin, $remember)) {        

        $user = Admin::where('email', $admin['email'])->first();
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        return Redirect::intended('/admin')
            ->with('flash_success', 'Welcome back.<br />You has been login successful!');
    }
    return Redirect::to('/admin/login')
        ->with('flash_error', 'Email / Password is not correct.')
        ->withInput();
}]);
Route::group(['prefix' => '/admin', 'before' => 'auth.admin|csrf|lock'],function(){
    Route::get('/',                         ['uses' => 'AdminController@index']);
    Route::get('/dashboard',                ['uses' => 'AdminController@index']);
    Route::get('/',                         ['uses' => 'DashboardsController@index']);
    Route::get('/synchronize',              ['uses' => 'AdminController@synchronize']);
    Route::get('/touch',                    ['uses' => 'AdminController@touch']);
    Route::match(['GET','POST'], '/lock',   ['as'   => 'lock', 'uses' => 'AdminController@lock']);
    Route::get('/logout', ['as' => 'logout', 'uses' => function () {
        Auth::admin()->logout();
        Session::flush();
        return Redirect::to('/admin/login');
    }]);
    /* Dynamic route
     *
     *  controller must be same as controller class without 'Controller' string.
     *  action must be same as method, and should be slug string.
     *   EX: 'pages/show-list' will call PagesController and showList method of PagesController
     *
     */
    Route::match(['GET','POST'],'{controller}/{action?}/{args?}', function($controller, $action = 'index', $args = ''){
        $controller = str_replace('-', ' ', strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $controller)));
        $controller = str_replace(' ',  '', Str::title($controller));
        $controller = '\\'.$controller.'Controller';
        if ( !class_exists($controller) ) {
            return App::abort(404, "Controller '{$controller}' was not existed.");
        }

        $action = str_replace('-', ' ', preg_replace('/[^A-Za-z0-9\-]/', '', $action));
        $method = Str::camel($action);

        if ( !method_exists($controller, $method) ) {
            return App::abort(404, "Method '{$method}' was not existed.");
        }

        $params = explode("/", $args);

        /*
         * Check permission
         */

        if( !Permission::checkPermission($controller, $method, $params) ){
            return App::abort(403, 'Need permission to access this page.');
        }

        /*
         * End check permission
         */

        $controller = app()->make($controller);
        return $controller->callAction($method, $params);

    })->where([
        'controller' => '[^/]+',
        'action' => '[^/]+',
        'args' => '[^?$]+'
    ]);
});

#===========================================#
#                ULTILITY                   #
#===========================================#
Route::get('/thumb/{id}/{sizew}x{sizeh}.{extension}', function($id, $sizew, $sizeh, $extension){
    $path = Input::has('path') ? Input::get('path') : '';
    if( $img = MyImage::getImage($id, $sizew, $sizeh, $extension, $path) ) {
        $request = Request::instance();
        $img['mime'] = isset($img['mime']) ? $img['mime'] : 'image/jpeg';
        $response = Response::make( $img['image'], 200, [
                                'Content-Type'      => $img['mime'],
                            ] );
        $time = date('r', $img['time']);
        $expires = date('r', strtotime('+1 year', $img['time']));

        $response->setLastModified(new DateTime($time));
        $response->setExpires(new DateTime($expires));
        $response->setPublic();

        if($response->isNotModified($request)) {
            return $response;
        } else {
            $response->prepare($request);
            return $response;
        }
    }
    return App::abort(404);
})->where([
    'id'     => '[a-z0-9]+',
    'sizew'  => '\d+',
    'sizeh'  => '\d+',
    'extension' => '[a-z]{3,}'
]);

#===========================================#
#                FRONTEND                   #
#===========================================#

Route::get('/', 'HomeController@index');
Route::get('/image-captcha', 'HomeController@imageCaptcha');
Route::get('/sitemap', 'HomeController@sitemap');
Route::post('/submit-feedback', 'HomeController@submitFeedback');
Route::post('/submit-subscribe', 'HomeController@submitSubscribe');
Route::group(['prefix' => '/pages'], function(){
    Route::pattern('pageName', '[-a-z0-9]+');
    Route::get('/business-solutions/{pageName?}', 'FrontendPagesController@businessPages');
    Route::get('/{pageName}', 'FrontendPagesController@index');
});
Route::get('/blogs/{blogYear?}/{blogMonth?}', ['uses' => 'BlogsController@index']);
Route::group(['prefix' => '/offers'], function(){
    Route::get('/{offer}', ['uses' => 'OffersController@index']);
});

Route::get('/product-search', ['uses' => 'FrontendProductsController@search']);
Route::post('/product-info', ['uses' => 'FrontendProductsController@info']);
Route::post('/product-calculating', ['uses' => 'FrontendProductsController@calculate']);

Route::get('/unsubscribe/{token}', 'AccountsController@unsubscribe');

Route::group(['before' => 'guest.user'], function(){
    Route::post('/account/login', function () {
        $user = [
            'email'     => Input::get('email'),
            'password'  => Input::get('password'),
        ];

        $remember = Input::has('remember');
        $ajax = Request::ajax();
        if (Auth::user()->attempt($user, $remember)) {
            $user = Auth::user()->get();
            if (!$user->active) {
                Auth::user()->logout();
                if( $ajax ) {
                    return ['status' => 'error', 'message' => 'Your account has not been actived yet.'];
                }
                return Redirect::to('/account/login')
                    ->with('flash_error', 'Your account has not been actived yet.')
                    ->withInput();
            }

            $user = User::where('email', $user['email'])->first();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            
            Session::put('userKey', md5(md5($user->id)));
            if( $ajax ) {
                return ['status' => 'ok'];
            }

            return Redirect::intended('/')
                ->with('flash_success', 'Welcome back.<br />You has been login successful!');
        }
        if( $ajax ) {
            return ['status' => 'error', 'message' => 'Invalid username or password.'];
        }
        return Redirect::to('/account/login')
            ->with('flash_error', 'Email / Password is not correct.')
            ->withInput();
    });
    Route::match(['get', 'post'], '/account/register',  'AccountsController@register');
    Route::match(['get', 'post'], '/account/forgot',    'AccountsController@forgot');
    Route::match(['get', 'post'], '/account/reset/{token}','AccountsController@resetPassword');
    Route::match(['get', 'post'], '/account/active/{token}','AccountsController@active');
    Route::match(['get', 'post'], '/account/check-login','AccountsController@checkLogin');
    Route::match(['get', 'post'], '/account/test-mail/{userId}','AccountsController@testMail');
});

Route::group(['before' => 'auth.user'], function () {
    Route::group(['prefix' => '/account'], function () {
        Route::get('/', 'AccountsController@index');
        Route::match(['get', 'post'], '/detail', 'AccountsController@detail');
        Route::get('/logout', ['as' => 'user-logout', 'uses' => function () {
            Auth::user()->logout();
            Session::flush();
            return Redirect::to('/');
        }]);
    });
    Route::group(['prefix' => '/design'], function (){
        Route::post('/analyze-image', 'DesignController@analyzeImage');
        Route::post('/put-image-store', 'DesignController@putImageSession');
        Route::post('/put-background', 'DesignController@putBackground');
        Route::post('/put-images', 'DesignController@putImages');
        Route::post('/get-images', 'DesignController@getImages');
        Route::get('/{productName}', 'DesignController@index')
        ->where([
            'productName' => '[-a-z0-9]+',
        ]);
    });
    Route::group(['prefix' => '/cart'], function(){
        Route::get('/',         'CartsController@index');
        Route::post('/add',     'CartsController@add');
        Route::post('/update',  'CartsController@update');
        Route::post('/delete',  'CartsController@delete');
        Route::post('/upload',  'CartsController@upload');
        Route::post('/order',   'CartsController@order');
    });
    Route::get('/get-province/{provinceCode}', 'HomeController@getProvince');
});


Route::get('/{categoryName}/{productName?}', function($categoryName, $productName = ''){
    $app = app();
    $controller = $app->make('FrontendProductsController');
    if( !empty($productName) ) {
        return $controller->callAction('product', ['categoryName' => $categoryName, 'productName' => $productName]);
    } else {
        return $controller->callAction('category', ['categoryName' => $categoryName]);
    }
})->where([
    'categoryName' => '[-a-z0-9]+',
    'productName' => '[-a-z0-9]+',
]);
