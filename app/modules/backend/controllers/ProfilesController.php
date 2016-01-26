<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Feusers,
	reportingtool\Models\Profiles,
	reportingtool\Models\Languages,
	reportingtool\Models\Usergroups,
	reportingtool\Models\Permissions,
	reportingtool\Models\Resources;
/**
 * Class FeusersController
 *
 * @package baywa-reportingtool\Controllers
 */

class ProfilesController extends ControllerBase

{
	public function indexAction(){
		
		$this->assets->addJs('js/vendor/profilesInit.js');
		$this->assets->addCss('css/jquery.dataTables.css');
		$profiles=  Profiles::find(array(
			'conditions' => 'deleted=0 AND hidden =0'
		));
		$resources=Resources::find(array(
			'conditions' => 'deleted=0 AND hidden=0'
		));
		
		$permissions=Permissions::find(array(
			'conditions'=> 'deleted=0 AND hidden=0'
		));
		
		$permissionArray=array();
		foreach($permissions as $permission){
			$permissionArray[$permission->profileid][$permission->resourceid][$permission->resourceaction]=1;
		}
		
		$this->view->setVar('permissions',$permissionArray);
		$this->view->setVar('profiles',$profiles);
		$this->view->setVar('resources',$resources);
		
	}
	
	public function updateAction(){
		
		if($this->request->isPost()){
			$action;
			switch($this->request->getPost('resourceaction')){
				case 1:
					$action='index';
					break;
				case 2:
					$action='create';
					break;
				case 3:
					$action='retrieve';
					break;
				case 4:
					$action='update';
					break;
				case 5:
					$action='delete';
					break;
						
			}
			
			$permission=  Permissions::findFirst(array(
				'conditions'=>'profileid = ?1 AND resourceid= ?2 AND resourceaction = ?3',
				'bind' => array(
					1=>$this->request->getPost('profileid'),
					2=>$this->request->getPost('resourceid'),
					3=>$action
				)
			));
			$checked=$this->request->getPost('checked')=='true' ? true:false;
			if($permission){
				if($checked==false){
					$permission->delete();
				}				
			}else{
				if($checked==true){
					$newPermission= new Permissions();
					$newPermission->assign(array(
						'pid' => 0,
						'crdate' => time(),
						'tstamp' => time(),
						'deleted' => 0,
						'hidden' => 0,
						'cruser_id' => $this->session->get('auth')['uid'],
						'profileid' => $this->request->getPost('profileid'),
						'resourceid' => $this->request->getPost('resourceid'),
						'resourceaction' => $action
					));
					$newPermission->save();
				}
			}
			if (file_exists($this->config->application->appsDir .'/cache/acl/data.txt') ){
				unlink( $this->config->application->appsDir .'/cache/acl/data.txt');
			}
			
			die();
		}else{
			$this->assets->addJs('js/vendor/profilesInit.js');
			$this->assets->addCss('css/jquery.dataTables.css');
			$profileUid = $this->dispatcher->getParam("uid");
			$profile = Profiles::findFirstByUid($profileUid);
			
			$resources=Resources::find(array(
				'conditions' => 'deleted=0 AND hidden=0'
			));

			$permissions=Permissions::find(array(
				'conditions'=> 'deleted=0 AND hidden=0'
			));

			$permissionArray=array();
			foreach($permissions as $permission){
				$permissionArray[$permission->profileid][$permission->resourceid][$permission->resourceaction]=1;
			}

			$this->view->setVar('permissions',$permissionArray);			
			$this->view->setVar('resources',$resources);
			$this->view->setVar('profile',$profile);
		}
	}
	
	public function createAction(){
		if($this->request->isPost()){
			$profile=new Profiles();
			$profile->assign(array(
						'pid' => 0,
						'crdate' => time(),
						'tstamp' => time(),
						'cruser_id' => $this->session->get('auth')['uid'],
						'deleted' => 0,
						'hidden' => 0,
						'title' => $this->request->getPost('title')
			));
			if(!$profile->save()){
				$this->flash->error($profile->getMessages());
			}else{
				$this->flash->success($profile->getMessages());
			}
			$this->response->redirect('backend/'.$this->view->language.'/profiles/update/'.$profile->uid.'/'); 
			$this->view->disable(); 
		}
	}
}