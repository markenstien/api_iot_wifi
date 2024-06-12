<?php

    #################################################
	##             THIRD-PARTY APPS                ##
    #################################################

    define('DEFAULT_REPLY_TO' , '');

    const MAILER_AUTH = [
        'username' => 'main@medicad.store',
        'password' => 'tmKcD#t3o@Y@',
        'host'     => 'medicad.store',
        'name'     => 'Medicad',
        'replyTo'  => 'main@medicad.store',
        'replyToName' => 'Medicad'
    ];



    const ITEXMO = [
        'key' => '',
        'pwd' => ''
    ];

	#################################################
	##             SYSTEM CONFIG                ##
    #################################################


    define('GLOBALS' , APPROOT.DS.'classes/globals');

    define('SITE_NAME' , 'korpee.app');

    define('COMPANY_NAME' , '');

    define('COMPANY_NAME_ABBR', '');
    define('COMPANY_EMAIL', '');
    define('COMPANY_TEL', '');
    define('COMPANY_ADDRESS', '');
    define('APP_NAME', 'IOT WIFI');

    define('KEY_WORDS' , '');
    define('DESCRIPTION' , '#############');
    define('AUTHOR' , '');
    define('APP_KEY' , '');


    const HEADING_META = [
        'keywords' => '',
        'description' => '',
        'og:type' => 'web',
        'og:url' => URL,
        'og:title' => 'Payroll Management System',
        'og:description' => '',
        'og:image' => URL.'/public/uploads/banner.jpg',
        'favicon' => URL.'/public/uploads/favicon.jpg',
    ];
?>
