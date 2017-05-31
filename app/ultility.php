<?php
    defined('DS')       || define('DS', DIRECTORY_SEPARATOR);
    defined('APP_PATH') || define('APP_PATH', __DIR__);
    defined('ARTISAN')  || define('ARTISAN', APP_PATH.DS.'..'.DS.'artisan');
    defined('PHAMTOM_CONVERT') || define('PHAMTOM_CONVERT', APP_PATH.DS.'phantomjs'.DS.'phantomjs '.APP_PATH.DS.'phantomjs'.DS.'rasterize.js');
    //=================================================================================
    $info = getInfo();
    defined('DEBUG')    || define('DEBUG', $info['debug']);

    defined('URL')      || define('URL', $info['url']);
    defined('DB_HOST')  || define('DB_HOST', $info['db_host']);
    defined('JT_DB')    || define('JT_DB', $info['jt_db']);
    defined('JT_URL')   || define('JT_URL', $info['jt_url']);
    defined('JT_IP')   || define('JT_IP', '50.99.42.160');
    defined('PHP_PATH')   || define('PHP_PATH', $info['php_path']);
    defined('JT_USERNAME')   || define('JT_USERNAME', 'sadmin');
    defined('JT_PASS')   || define('JT_PASS', '2016Anvy!');

    defined('SOCKET_URL')    || define('SOCKET_URL', $info['socket_url']);

    defined('PUSHER_APP_ID') || define('PUSHER_APP_ID', $info['pusher_api_id']);
    defined('PUSHER_KEY')    || define('PUSHER_KEY', $info['pusher_key']);
    defined('PUSHER_SECRET') || define('PUSHER_SECRET', $info['pusher_secret']);
    //=================================================================================

    function pr($value)
    {
        echo    '<pre>';
        print_r($value);
        echo    '</pre>';
    }

    function getInfo()
    {
        $server_name = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';
        $arrInfo = [];
        $arrConfigs = [
            //Pusher cua Tung
            'anvy2015.com'                   => [
                                            'url'       => 'http://anvy2015.com',
                                            'db_host'   => 'anvy2015.com',
                                            'jt_db'     => 'anvyonline.com',
                                            'jt_url'    => 'http://jobtraq.anvyonline.com',
                                            'php_path'  =>  'php',
                                            'socket_url' => 'localhost',

                                            'pusher_api_id' => '127430',
                                            'pusher_key'    => 'b4a871dfbb8c58f7d3de',
                                            'pusher_secret' => '02670a76fc4aea2fa762',
                                        ],

            'anvydigital.anvyonline.com'         => [
                                            'url'       => 'http://anvydigital.anvyonline.com',
                                            'db_host'   => 'anvydigital.anvyonline.com',
                                            'jt_db'     => 'jobtraq.anvyonline.com',
                                            'jt_url'    => 'http://jobtraq.anvyonline.com',
                                            'php_path'  =>  '/usr/local/bin/php',
                                            'socket_url' => 'localhost',

                                            'pusher_api_id' => '127430',
                                            'pusher_key'    => 'b4a871dfbb8c58f7d3de',
                                            'pusher_secret' => '02670a76fc4aea2fa762',
                                        ],
            'test.anvyonline.com'         => [
                                            'url'       => 'http://test.anvyonline.com',
                                            'db_host'   => 'test.anvyonline.com',
                                            'jt_db'     => 'jobtraq.anvyonline.com',
                                            'jt_url'    => 'http://jobtraq.anvyonline.com',
                                            'php_path'  =>  'php',
                                            'socket_url' => 'localhost',

                                            'pusher_api_id' => '127430',
                                            'pusher_key'    => 'b4a871dfbb8c58f7d3de',
                                            'pusher_secret' => '02670a76fc4aea2fa762',
                                        ],
			'anvydigital.com'         => [
                                            'url'       => 'http://anvydigital.com',
                                            'db_host'   => 'test.anvyonline.com',
                                            'jt_db'     => 'jobtraq.anvyonline.com',
                                            'jt_url'    => 'http://jobtraq.anvyonline.com',
                                            'php_path'  =>  '/usr/local/bin/php',
                                            'socket_url' => 'localhost',

                                            'pusher_api_id' => '127430',
                                            'pusher_key'    => 'b4a871dfbb8c58f7d3de',
                                            'pusher_secret' => '02670a76fc4aea2fa762',
                                        ],
			'www.anvydigital.com'         => [
                                            'url'       => 'http://www.anvydigital.com',
                                            'db_host'   => 'test.anvyonline.com',
                                            'jt_db'     => 'jobtraq.anvyonline.com',
                                            'jt_url'    => 'http://jobtraq.anvyonline.com',
                                            'php_path'  =>  '/usr/local/bin/php',
                                            'socket_url' => 'localhost',

                                            'pusher_api_id' => '127430',
                                            'pusher_key'    => 'b4a871dfbb8c58f7d3de',
                                            'pusher_secret' => '02670a76fc4aea2fa762',
                                        ],
        ];
        if( php_sapi_name() === 'cli' ) {
            if( DS == '\\' ) {
                $arrInfo = $arrConfigs['anvy2015.com'];
            } else {
                if (strpos(__DIR__, 'anvydigital_2015-test') !== false) {
                    $arrInfo = $arrConfigs['test.anvyonline.com'];
                } else {
                    $arrInfo = $arrConfigs['anvydigital.com'];
                }
            }
        } else {
            $arrInfo = $arrConfigs[$server_name];
        }

        if( in_array($server_name, ['anvy2015.com', '']) ) {
            $arrInfo['debug'] = true;
        } else {
            $arrInfo['debug'] = false;
        }

        return $arrInfo;
    }

    function showQuery($last = false)
    {
        $queries = DB::getQueryLog();
        if ($last) {
            pr( end($queries) );
        } else {
            pr( $queries );
        }
    }
?>
