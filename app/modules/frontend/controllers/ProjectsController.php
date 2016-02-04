<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Projects;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class ProjectsController extends ControllerBase
{
	public function indexAction(){
		
                    $projects = Projects::find(array(
                            "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND status < ?2",
                            "bind" => array(1 => $this->session->get('auth')['usergroup'],2 => 4),
                            "order" => "crdate DESC"
                    ));
                   
                    $this->view->setVar('path',$this->path);
                    $this->view->setVar('projects',$projects);
		
	}
        
        public function updateAction(){
            $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
            
            $project=Projects::findFirstByUid($projectUid);
            
            $this->view->setVar('project',$project);
            
        }

	
	
}