<?php
namespace reportingtool\Acl;

use Phalcon\Mvc\User\Component,
Phalcon\Acl\Adapter\Memory as AclMemory,
Phalcon\Acl\Role as AclRole,
Phalcon\Acl\Resource as AclResource,
reportingtool\Models\Profiles as Profiles,
reportingtool\Models\Resources as Resources;

/**
 * nltest\Acl\Acl
 */
class Acl extends Component
{

    /**
     * The ACL Object
     *
     * @var \Phalcon\Acl\Adapter\Memory
     */
    private $acl;

    /**
     * The filepath of the ACL cache file from $this->config->application->appsDir
     *
     * @var string
     */
    private $filePath = '/cache/acl/data.txt';

    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    private $privateResources = array(
        'backend' => array(
            'index',
            'create',
            'retrieve',
            'update',
            'delete'
            
        ),
		'index' => array(    
			'index',
            'create',
            'retrieve',
            'update',
            'delete'
            
        ),
        'compose' => array(
            'index',
            'create',
            'retrieve',
            'update',
            'delete'
        ),
		'notifications' => array(
            'index',
            'create',
            'retrieve',
            'update',
            'delete'
        ),
		'feusers' => array(
            'index',
            'create',
            'retrieve',
            'update',
            'delete'
        ),
		'report' =>array(
			'index',
			'create',
			'retrieve',
			'update',
			'delete'
		),
		'images' => array(
			'index',
			'create'
		),
		'files' => array(
			'index',
			'create'
		),
		'session'=>array()
    );
	
	private $publicResources = array(
		'index' => array(
			 'index'
		),
		'session' => array(
			'index',
			'start'
		),
		'triggersend'=>array(
			'index'
		),
		'subscription'=>array(
			'subscribe',
			'unsubscribe'
			
		)
		
	);

    /**
     * Human-readable descriptions of the actions used in {@see $privateResources}
     *
     * @var array
     */
    private $actionDescriptions = array(
        'index' => 'Access',        
        'create' => 'Create',
		'retrieve' => 'List',
        'update' => 'Edit',
        'delete' => 'Delete'
        
    );

    /**
     * Checks if a controller is private or not
     *
     * @param string $controllerName
     * @return boolean
     */
    public function isPrivate($controllerName)
    {
		
        return isset($this->privateResources[$controllerName]);
    }

    /**
     * Checks if the current profile is allowed to access a resource
     *
     * @param string $profile
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isAllowed($profile, $controller, $action)
    {
		
        return $this->getAcl()->isAllowed($profile, $controller, $action);
    }
	
	public static function linkAllowed($auth,$controller,$action){
		
		$acl=new Acl();
		
		return $acl->getAcl()->isAllowed($auth['profile'], $controller, $action);
	}
	
    /**
     * Returns the ACL list
     *
     * @return Phalcon\Acl\Adapter\Memory
     */
    public function getAcl()
    {
        // Check if the ACL is already created
        if (is_object($this->acl)) {
            return $this->acl;
        }

        // Check if the ACL is in APC
        if (function_exists('apc_fetch')) {
            $acl = apc_fetch('reportingtool-acl');
            if (is_object($acl)) {
                $this->acl = $acl;
                return $acl;
            }
        }

        // Check if the ACL is already generated
        if (!file_exists($this->config->application->appsDir . $this->filePath)) {
            $this->acl = $this->rebuild();
            return $this->acl;
        }

        // Get the ACL from the data file
        $data = file_get_contents($this->config->application->appsDir . $this->filePath);
        $this->acl = unserialize($data);

        // Store the ACL in APC
        if (function_exists('apc_store')) {
            apc_store('reportingtool-acl', $this->acl);
        }

        return $this->acl;
    }

    

    

    /**
     * Returns the action description according to its simplified name
     *
     * @param string $action
     * @return $action
     */
    public function getActionDescription($action)
    {
        if (isset($this->actionDescriptions[$action])) {
            return $this->actionDescriptions[$action];
        } else {
            return $action;
        }
    }

    /**
     * Rebuilds the access list into a file
     *
     * @return \Phalcon\Acl\Adapter\Memory
     */
    public function rebuild()
    {
        $acl = new AclMemory();

        $acl->setDefaultAction(\Phalcon\Acl::DENY);
		
        // Register roles
        $profiles = Profiles::find('deleted = 0 AND hidden=0');
		
        foreach ($profiles as $profile) {
			
            $acl->addRole(new AclRole($profile->title));
        }

        foreach ($this->privateResources as $resource => $actions) {
            $acl->addResource(new AclResource($resource), $actions);
        }
		 foreach ($this->publicResources as $resource => $actions) {
            $acl->addResource(new AclResource($resource), $actions);
        }

        // Grant acess to private area to role Users
		
        foreach ($profiles as $profile) {
            
            foreach ($profile->getPermissions() as $permission) {
				$resource=$permission->getResource();	
				
				
				$acl->addResource(new AclResource($resource->title), $permission->resourceaction);
				$acl->allow($profile->title, $resource->title, $permission->resourceaction);
				
				foreach($this->privateResources as $privateResources => $actions){
					$acl->allow($profile->title, $privateResources, $actions);
				}
				
				foreach($this->publicResources as $publicresource => $actions){
					$acl->allow($profile->title, $publicresource, '*');
				}
                
            }

            // Always grant these permissions
            
        }
		$roles = array(			
			'guests' => new AclRole('Guests')
		);
		foreach ($roles as $role) {
			$acl->addRole($role);
		}
		foreach ($roles as $role) {
		foreach ($this->publicResources as $resource => $actions) {
			$acl->allow($role->getName(), $resource, '*');
		}
	}

        if (touch($this->config->application->appsDir . $this->filePath) && is_writable($this->config->application->appsDir . $this->filePath)) {

            file_put_contents($this->config->application->appsDir . $this->filePath, serialize($acl));

            // Store the ACL in APC
            if (function_exists('apc_store')) {
                apc_store('reportingtool-acl', $acl);
            }
        } else {
            $this->flash->error(
                'The user does not have write permissions to create the ACL list at ' . $this->config->application->appsDir . $this->filePath
            );
        }

        return $acl;
    }
}