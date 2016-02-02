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
		if($this->request->isPost()){
			$distributors = Distributors::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$distributorsArray = array();
			foreach($distributors as $distributor){
				$distributorAddresses=$distributor->countAddresses();
				/*$folders=$distributor->getAddressfolders();
				if($folders){
					foreach($folders as $folder){
						$distributorAddresses+=$folder->countAddresses();
					}
				}
				$segments=$distributor->getSegments();
				if($segments){
					foreach($segments as $segment){
						$distributorAddresses+=$segment->countAddresses();
					}
				}*/
				
				$distributorsArray[]=array(
					'uid'=>$distributor->uid,
					'title'=>$distributor->title,
					'date' =>date('d.m.Y',$distributor->tstamp),
					'addresscount'=>$distributorAddresses
				);
						
			}
			$returnJson=json_encode($distributorsArray);
			echo($returnJson);
			die();
		}else{
                    
                    $projects = Projects::find(array(
                            "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND status < ?2",
                            "bind" => array(1 => $this->session->get('auth')['usergroup'],2 => 4),
                            "order" => "crdate DESC"
                    ));
                   
                    $this->view->setVar('path',$this->path);
                    $this->view->setVar('projects',$projects);
		}
	}
        
        public function updateAction(){
            $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
            
            $project=Projects::findFirstByUid($projectUid);
            
            $this->view->setVar('project',$project);
            
        }

	
	
}