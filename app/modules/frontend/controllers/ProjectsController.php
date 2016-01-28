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
                    $projectType=$this->request->getQuery('type','int');
			$distributors = Distributors::find(array(
				"conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
				"bind" => array(1 => $this->session->get('auth')['usergroup']),
				"order" => "tstamp DESC"
			));
			$environment= $this->config['application']['debug'] ? 'development' : 'production';
			$baseUri=$this->config['application'][$environment]['staticBaseUri'];
			$path=$baseUri.$this->view->language.'/distributors/update/';
			$this->view->setVar('path',$path);
			$this->view->setVar('projects',$projects);
		}
	}

	
	
}