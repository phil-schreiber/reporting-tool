<?php


$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
		'reportingtool\Models'        => $this->config->application->modelsDir,
		'reportingtool\Forms'        => $this->config->application->formsDir,		
		'reportingtool\Controllers'   => $this->config->application->controllersDir,
		'reportingtool\Modules\Modules\Frontend'=>$this->config->application->frontendDir,
		'reportingtool\Modules\Modules\Frontend\Controllers'=>$this->config->application->frontendControllersDir,
		'reportingtool\Modules\Modules\Backend'=>$this->config->application->backendDir,
		'reportingtool\Modules\Modules\Backend\Controllers'=>$this->config->application->backendControllersDir,
		'reportingtool\app' => $this->config->application->appsDir,
		'reportingtool' => $this->config->application->libraryDir,	
		'Sum' => $this->config->application->libraryDir
    )
);

 $loader->registerDirs(array(
        $this->config->application->frontendControllersDir,
        $this->config->application->modelsDir
    ));

$loader->register();