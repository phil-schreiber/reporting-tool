<?php

return new \Phalcon\Config(array(

    
    'application' => array(        
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'viewsDir'       => APP_PATH . '/app/views/',
		'frontendViewsDir'       => APP_PATH . '/app/modules/frontend/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
		'messagesDir'     => APP_PATH . '/app/messages/',
		'frontendDir'     => APP_PATH . '/app/modules/frontend/',
		'frontendControllersDir'     => APP_PATH . '/app/modules/frontend/controllers',
		'formsDir'     => APP_PATH . '/app/forms',
		'backendDir'     => APP_PATH . '/app/modules/backend/',
		'backendControllersDir'     => APP_PATH . '/app/modules/backend/controllers',
		'backendViewsDir'       => APP_PATH . '/app/modules/backend/views/',
		'appsDir' => APP_PATH.'/app/',
        'development'    => array(
            'staticBaseUri' => '/reporting-tool/',
            'baseUri'       => '/reporting-tool/'
        ),
        'production'     => array(
            'staticBaseUri' => '/',
            'baseUri'       => '/'
        ),
        'debug'          => true,
		'dontSendReally' => false,
		'dontSendDuplicates' => true,
		'version' => '1.0 alpha'
    ),    
    'defaults' => array(
        'plaintextFallbackText' => 'Bitte wechseln Sie in den HTML-Modus, um diese Mail korrekt betrachten zu können. Vielen Dank für Ihr Verständnis.'
    ),
    'smtp'        => array(
        'host'     => "smtp.iq-pi.org",
        'port'     => 25,
        'security' => "tls",
        'username' => "mailing@iq-pi.org",
        'password' => "hpkYhxr&mdm7", //
		'mailcycle' => 300
    ),
	
	'languages'=>array(
		'de' => 'Deutsch',
		'en' => 'English'
	),
	'admin' => array(
		'email' => 'philipp.schreiber@denkfabrik-group.com',
		'name' => 'denkfabrik reporting tool - support'
	),
	'database'=>array(
		'production'=>array(
			'adapter'  => 'Mysql',
			'host'     => '002.mysql.db.fge.5hosting.com',
			'username' => 'u1272_reportingtool',
			'password' => 'b8A1uy1Hhz',
			'dbname'   => 'db1272_reportingtool',
			'charset'  => 'utf8'
		),
		'debug'=>array(
			'adapter'  => 'Mysql',
			'host'     => 'localhost',
			'username' => 'root',
			'password' => '',
			'dbname'   => 'reportingtool',
			'charset'  => 'utf8'
		)
		
	)
    
));

