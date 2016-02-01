<?php


$router = new Phalcon\Mvc\Router(true);

$router->setDefaultModule("frontend");
$router->removeExtraSlashes(TRUE);

$router->add(
	'/:controller/:action[/]{0,1}', 
	array(	
		'module'=>'frontend',
		'controller' => 1,
		'action' => 2,
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
	)
);
$router->add(
	'/{language:[a-z]{2}}/:controller[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => "index",
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/{language:[a-z]{2}}/:controller/:action[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => 3,		
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
	)
);

$router->add(
	'/{language:[a-z]{2}}/:controller/:action/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => 3,
		'uid'=>4,
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
	)
);



$router->add(
    '/',
    array(		
		'controller' => 'index',
		'action'     => 'index',
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/index/',
    array(
		'controller' => 'session',
		'action'     => 'index',
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/start[/]{0,1}',
    array(
       'controller' => 'session',
       'action'     => 'start',
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
    )
);

$router->add(
    '/session/logout[/]{0,1}',
    array(
       'controller' => 'session',
       'action'     => 'logout',
		'module'=>'frontend',
		'namespace'  => 'reportingtool\Modules\Modules\Frontend\Controllers',
    )
);



$router->add(
	'/backend/{language:[a-z]{2}}/:controller[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => "index",
		'module'=>'backend',
		'namespace'  => 'reportingtool\Modules\Modules\Backend\Controllers',
	)
);
$router->add(
	'/backend/{language:[a-z]{2}}/:controller/:action[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => 3,		
		'module'=>'backend',
		'namespace'  => 'reportingtool\Modules\Modules\Backend\Controllers',
	)
);

$router->add(
	'/backend/{language:[a-z]{2}}/:controller/:action/:int[/]{0,1}', 
	array(
		'language' => 1,
		'controller' => 2,
		'action' => 3,
		'uid'=>4,
		'module'=>'backend',
		'namespace'  => 'reportingtool\Modules\Modules\Backend\Controllers',
	)
);



$router->add(
	'/backend', 
	array(		
		'controller' => 'index',
		'action' => 'index',		
		'module'=>'backend',
		'namespace'  => 'reportingtool\Modules\Modules\Backend\Controllers',
	)
);



$router->handle();
return $router;