<?php

use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DatabaseConnection;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Mvc\Model\Metadata\Files as MetaDataAdapter;
use Phalcon\Mvc\Model\Metadata\Memory as MemoryMetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Cache\Backend\File as FileCache;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use reportingtool\Notifications\Checker as NotificationsChecker;
//use Sum\Oauth2 AS Oauth2;
use reportingtool\Auth\Auth;
use reportingtool\Acl\Acl;
use reportingtool\Helper\Littlehelpers;



/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set(
    'url',
    function () use ($config) {
        $url = new UrlResolver();
        if (!$config->application->debug) {
            $url->setBaseUri($config->application->production->baseUri);
            $url->setStaticBaseUri($config->application->production->staticBaseUri);
        } else {
            $url->setBaseUri($config->application->development->baseUri);
            $url->setStaticBaseUri($config->application->development->staticBaseUri);
        }
        return $url;
    },
    true
);
	
$di->set('tag', function() {
	
    return new reportingtool\Helper\Tag();
});

$di->set('modelsManager', function() {
      return new Phalcon\Mvc\Model\Manager();
 });


/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->set(
    'db',
    function () use ($config) {

        

        $debug = $config->application->debug;
        if ($debug) {
			$connection = new DatabaseConnection($config->database->debug->toArray());
            $eventsManager = new EventsManager();

            

            //Listen all the database events
            
			  $logger = new FileLogger(APP_PATH . "/app/logs/db.log");
			  $eventsManager->attach(
                'db',
                function ($event, $connection) use ($logger) {
                    
                    if ($event->getType() == 'beforeQuery') {
                         
							$logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
						
                    }
                }
            );

            //Assign the eventsManager to the db adapter instance
            $connection->setEventsManager($eventsManager);
		}else{
			$connection = new DatabaseConnection($config->database->production->toArray());
		}

        return $connection;
    }
);



/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->set(
    'modelsMetadata',
    function () use ($config) {

        if ($config->application->debug) {
            return new MemoryMetaDataAdapter();
        }

        return new MetaDataAdapter(array(
            'metaDataDir' => APP_PATH . '/app/cache/metaData/'
        ));

    },
    true
);



/**
 * Router
 */
$di->set(
    'router',
    function () {
	include APP_PATH . "/app/config/routes.php";
        return $router;
    }
);

/**
 * Register the configuration itself as a service
 */
$di->set('config', $config);

/**
* Register the flash service with custom CSS classes
*/
$di->set('flash', function(){
   return new Phalcon\Flash\Direct(array(
	   'error' => 'alert alert-error',
	   'success' => 'alert alert-success',
	   'notice' => 'alert alert-info',
	   'loggedin'=>'alert alert-loggedin'
   ));
});

$di->set('flashSession',
         function(){
         $flash = new \Phalcon\Flash\Session(
                    array(
                        'error' => 'alert alert-danger',
                        'success' => 'alert alert-success',
                        'notice' => 'alert alert-info',
                        'warning' => 'alert alert-warning',
                    )
                );
          return $flash;
});

/*$di->set(
    'dispatcher',
    function () {
        $dispatcher = new MvcDispatcher();
        $dispatcher->setDefaultNamespace('reportingtool\Controllers');
        return $dispatcher;
    }
);*/

$di->set('security', function(){

    $security = new Phalcon\Security();

    //Set the password hashing factor to 12 rounds
    $security->setWorkFactor(12);

    return $security;
}, true);


$di->set('session', function() {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
});
/**
 * View cache
 */
$di->set(
    'viewCache',
    function () use ($config) {
		
        
            $frontCache = new \Phalcon\Cache\Frontend\None();
            return new Phalcon\Cache\Backend\Memory($frontCache);
		if ($config->application->debug) {
        } else {
            //Cache data for one day by default
			
            $frontCache = new \Phalcon\Cache\Frontend\Output(array(
                "lifetime" => 86400 * 30
            ));

            return new FileCache($frontCache, array(
                "cacheDir" => APP_PATH . "/app/cache/views/",
                "prefix"   => "reportingtool-cache-"
            ));
        }
    }
);

/**
 * Cache
 */
$di->set(
    'modelsCache',
    function () use ($config) {

        if ($config->application->debug) {

            $frontCache = new \Phalcon\Cache\Frontend\None();
            return new Phalcon\Cache\Backend\Memory($frontCache);
        } else {

            //Cache data for one day by default
            $frontCache = new \Phalcon\Cache\Frontend\Data(array(
                "lifetime" => 86400 * 30
            ));

            return new \Phalcon\Cache\Backend\File($frontCache, array(
                "cacheDir" => APP_PATH . "/app/cache/data/",
                "prefix"   => "forum-cache-data-"
            ));
        }
    }
);
/**
 * Real-Time notifications checker
 */
$di->set(
    'notifications',
    function () {
        return new NotificationsChecker();
    },
    true
);

 
$di->set('auth', function () {
    return new Auth();
});

$di->set('acl', function(){
	return new Acl();
});

$di->set('littlehelpers', function(){
	return new Littlehelpers();
});



$di->set('triggerevents',function(){
	$eventsManager = new EventsManager();
	$subscriptioneEvents = new \reportingtool\Modules\Modules\Frontend\Controllers\SubscriptionController();
	$subscriptioneEvents->setEventsManager($eventsManager);
	$eventsManager->attach('SubscriptionController', new \reportingtool\Modules\Modules\Frontend\Controllers\TriggereventsController());
	$timebasedEvents=new \reportingtool\Modules\Modules\Frontend\Controllers\PolleventsController();
	$timebasedEvents->setEventsManager($eventsManager);
	$eventsManager->attach('PolleventsController', new \reportingtool\Modules\Modules\Frontend\Controllers\TriggereventsController());
	return $eventsManager;
	
});

/*$di->set('oauth', function() use ($config) {
		$oauthdb = new Phalcon\Db\Adapter\Pdo\Mysql($config->database->oauth->toArray());
		
		 $server = new \League\OAuth2\Server\Authorization(
				 
			 new Oauth2\Server\Storage\Pdo\Mysql\Client($oauthdb),
			 new Sum\Oauth2\Server\Storage\Pdo\Mysql\Session($oauthdb),
			 new Sum\Oauth2\Server\Storage\Pdo\Mysql\Scope($oauthdb)
		 );

		 # Not required as it called directly from original code
		 # $request = new \League\OAuth2\Server\Util\Request();

		 # add these 2 lines code if you want to use my own Request otherwise comment it
		 $request = new \Sum\Oauth2\Server\Storage\Pdo\Mysql\Request(); 
		 $server->setRequest($request);

		 $server->setAccessTokenTTL(86400);
		 $server->addGrantType(new League\OAuth2\Server\Grant\ClientCredentials());
		 return $server;
	 });
	 
$di->set('resource' , function () use ($config) {
    $oauthdb = new DbAdapter(
        $config->database->oauth->toArray()
    );
    $resource = new League\OAuth2\Server\Resource(
        new \Sum\Oauth2\Server\Storage\Pdo\Mysql\Session($oauthdb)
    );
    ##only exist on my develop fork
    #$resource->setMsg([
    #    'invalidToken' => 'Token tidak benar',
    #    'missingToken' => 'Token tidak ditemukan'
    #]);
    $resource->setRequest(new \Sum\Oauth2\Server\Storage\Pdo\Mysql\Request());

    return $resource;
});*/
