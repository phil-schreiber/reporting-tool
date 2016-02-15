<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;

use Phalcon\Mvc\Controller as Controller,
	Phalcon\Mvc\Dispatcher,
	Phalcon\DI\FactoryDefault as PhDi,
	Phalcon\Exception,
	reportingtool\Models\Languages as Languages,
        reportingtool\Models\Projecttypes;


class ControllerBase extends Controller
{
	public function initialize(){
		
		if(intval($this->session->get('auth')['superuser'])!==1){			
			throw new Exception('Access denied');
		}
		$conditions = "deleted = :deleted: AND hidden = :hidden:";
		$parameters = array(
			"deleted" => 0,
			"hidden" => 0
		);
		
		$languages=array();
		foreach (Languages::find(array(	$conditions,"bind" => $parameters)) as $languageRow) {
			$languages[$languageRow->shorttitle]=$languageRow->title;
		}
		$this->config->languages=$languages;
                
                
                
		
	}
	public function requestInitialize($controllerName)
	{
	
		$this->view->setTemplateAfter('main');
		$this->view->setVars(array(
            'version' => $this->config->application->version
            
        ));
		
		if($this->config->application->debug){
			$baseUrl = $this->config->application->development->baseUri;
		}else{
			$baseUrl = $this->config->application->production->baseUri;
		}
		

		/**
		 * Docs path and CDN url
		 */
		$lang = $this->getUriParameter('language');
		
		$lang = ($lang) ? $lang : 'de';

		/**
		 * Find the languages available
		 */
		$languages           = $this->config->languages;
		$languagesAvailable  = '';
		$selected            = '';
		$url                 = $this->request->getScheme() . '://'
							 . $this->request->getHttpHost()
							 . $baseUrl;
		$uri                 = $this->router->getRewriteUri();
		foreach ($languages as $key => $value) {
			$selected = ($key == $lang) ? " selected='selected'" : '';
			$href     = $url .  str_replace("/{$lang}", "{$key}", $uri);
			$languagesAvailable .= "<option value='{$href}'{$selected}>{$value}</option>";
		}
                $projectTypes = Projecttypes::find(array(
                   'conditions' => 'deleted =0 AND hidden =0'
                ));
                
                $this->view->setVar('projecttypes',$projectTypes);
		$this->view->setVar('controller', $controllerName);
		$this->view->setVar('language', $lang);
		$this->view->setVar('baseurl', $baseUrl);
                
		$this->view->setVar('languages_available', $languagesAvailable);
		
		
		
	}

	/**
	 * @param Dispatcher $dispatcher
	 *
	 * @return bool
	 */
	public function beforeExecuteRoute(Dispatcher $dispatcher)
	{
		
		$returnVal=true;
		
			$lang = $this->getUriParameter('language');
			
		$controllerName = $dispatcher->getControllerName();
		
		if ('1' != $this->config->application->debug) {

			$lang = $this->getUriParameter('language');
        	$lang = ($lang) ? $lang : 'en';
			
			$key = preg_replace(
				'/[^a-zA-Z0-9\_]/',
				'',
				$lang . '-' . $dispatcher->getControllerName() . '-' . $dispatcher->getActionName() . '-' . implode('-' , $dispatcher->getParams())
			);
			$this->view->cache(array('key' => $key));
			if ($this->view->getCache()->exists($key)) {
				$returnVal= false;
			}
		}
			
		$auth = $this->session->get('auth');
		$identity=$this->auth->getIdentity();
		
		
		if (!$auth) {
            $role = 'Guests';
		}else{
			$role=$identity['profile'];
		}
		
		  
		
		 // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            
            $environment= $this->config['application']['debug'] ? 'development' : 'production';
            $this->baseUri=$this->config['application'][$environment]['staticBaseUri'];
            $this->path=$this->baseUri.'backend/'.$lang.'/'.$controllerName;
		$this->view->setVar('path', $this->path);	
            if (!$this->acl->isAllowed($role, $controllerName, $actionName)) {

                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                    $dispatcher->forward(array(
                        'controller' => $controllerName,
                        'action' => 'index'
                    ));
                } 

                $returnVal= false;
			}else{
				$this->requestInitialize($controllerName);
			}
		
		
		return $returnVal;
	}

	protected function getUriParameter($parameter)
	{
		
		return $this->dispatcher->getParam($parameter);
	}

	/**
     * Translates a string
     *
     * @return string
     */
    public static function translate()
    {
        $return     = '';
        $messages   = array();
        $argCount   = func_num_args();
        $di         = PhDi::getDefault();
        $session    = $di['session'];
        $config     = $di['config'];
        $dispatcher = $di['dispatcher'];
        $lang       = $dispatcher->getParam('language');

        if (function_exists('apc_store')) {
            $phrases    = apc_fetch($lang . '-phrases');
            $language   = apc_fetch($lang . '-language');
        } else {
            $phrases    = $session->get('phrases');
            $language   = $session->get('language');
        }
		
        $changed = false;
        if (!$phrases || $language != $lang || ('1' == $config->application->debug)) {

            require $config->application->messagesDir . 'de.php';

            /**
             * Messages comes from the above require statement. Not the best
             * way of doing it but we need this for Transilex
             */
            $english = $messages;
            $phrases = $english;
            if ('de' !== $lang) {
                if (file_exists($config->application->messagesDir . $lang . '.php')) {

                    /**
                     * Cleanup
                     */
                    $messages = array();
                    require $config->application->messagesDir. $lang . '.php';

                    
                    $custom  = $messages;

                    foreach ($english as $key => $value) {
                        $phrases[$key] = (!empty($custom[$key])) ? $custom[$key] : $value;
                    }
                }

                $changed = true;
            }

            if ($changed) {
                if (function_exists('apc_store')) {
                    apc_store($lang . '-phrases', $phrases);
                    apc_store($lang . '-language', $lang);
                } else {
                    $session->set('phrases', $phrases);
                    $session->set('language', $lang);
                }
            }

        }

        // If parameters were passed process them, otherwise return an
        // empty string
        if ($argCount > 0) {
            $arguments = func_get_args();

            // The first argument is the key
            $key = $arguments[0];

            if (isset($phrases[$key])) {
                $return = $phrases[$key];

                // Any subsequent arguments need to replace placeholders
                // in the target string. Unset the key and process the
                // rest of the arguments one by one.
                unset($arguments[0]);

                foreach ($arguments as $key => $argument) {
                    $return = str_replace(":{$key}:", $argument, $return);
                }
            }
        }

        return $return;
    }
	protected function forward($uri){
    	$uriParts = explode('/', $uri);
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
    	);
    }
	
}
