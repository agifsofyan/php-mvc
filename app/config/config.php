<?php
    // Database Params
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','Laruno');
    define('DB_CHARSET','utf8');

    // App Root
    define('APP_ROOT', dirname(dirname(__FILE__)));
    // URL Root
    define('PROJECT_DIR', dirname(dirname(__DIR__)));
    define('PUBLIC_DIR', PROJECT_DIR . '/public');
    define('URL_ROOT','http://127.0.0.1/php-mvc');
    // Site Name
    define('SITE_NAME', 'Laruno');
    // App Version
    define('APP_VERSION', '1.0.1');
    define('APP_DATE', 'AUG 02, 2020');
    define('APP_DATE_TIME_FORMAT', 'd/m/Y H:i:s');

    $NORMAL_USER = array('admin', 'cs');
    $SUPER_USER = array('supervisor', 'superadmin');
    
    define('NORMAL_USER', $NORMAL_USER);
    define('SUPER_USER', $SUPER_USER);