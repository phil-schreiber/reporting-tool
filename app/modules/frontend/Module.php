<?php
namespace Modules\Modules\Frontend;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	
	private $config;
    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders( \Phalcon\DiInterface $di = NULL  )
    {
		


/**
 * Read the configuration
 */
$this->config = include APP_PATH . "/app/config/config.php";

	/**
	 * Include the loader
	 */
		require	"config/loader.php";
		
        
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices( \Phalcon\DiInterface $di = NULL )
    {
        /**
         * Read configuration
         */
        /**
 * Setting up the view component
 */
		$config=$this->config;
		
$di->set(
    'view',
    function () use ($config) {

        $view = new View();

        $view->setViewsDir($config->application->frontendViewsDir);

        $view->registerEngines(
            array(
                ".volt" => 'volt'
            )
        );

        return $view;
    },
    true
);
	
	/**
 * Setting up volt
 */
$di->set(
    'volt',
    function ($view, $di) use ($config) {

        $volt = new Volt($view, $di);

        $volt->setOptions(
            array(
                "compiledPath"      => APP_PATH . "/app/cache/volt/",
                "compiledSeparator" => "_",
                "compileAlways"     => $config->application->debug
            )
        );
		$volt->getCompiler()->addFunction('tr', function ($key) {
			return "reportingtool\Modules\Modules\Frontend\Controllers\ControllerBase::translate({$key})";
		});
		 $volt->getCompiler()->addFunction(
                    'roundTwo',
                    function ($resolvedArgs, $exprArgs) {
                        return 'reportingtool\Helper\Tag::roundTwo(' . $resolvedArgs . ')';
                    }
                );
                $volt->getCompiler()->addFunction(
                    'arrayKeyExists',
                    function ($resolvedArgs, $exprArgs) {
                        return 'reportingtool\Helper\Tag::arrayKeyExists(' . $resolvedArgs . ')';
                    }
                );
                $volt->getCompiler()->addFunction(
                    'isset',
                    'isset'
                );
                $volt->getCompiler()->addFunction(
                    'isempty',
                    'empty'
                );
                
        $volt->getCompiler()->addFunction('number_format', function($resolvedArgs) {
            return 'number_format(' . $resolvedArgs . ')';
        });
		
		$volt->getCompiler()->addFunction('linkAllowed', function($args) {
			return "reportingtool\Acl\Acl::linkAllowed({$args})";
		});

        return $volt;
    },
    true
);

      

    }

}