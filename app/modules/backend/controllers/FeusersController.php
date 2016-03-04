<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Feusers,
	reportingtool\Models\Profiles,
	reportingtool\Models\Languages,
	reportingtool\Models\Usergroups,
	reportingtool\Forms\FeusersForm;
/**
 * Class FeusersController
 *
 * @package baywa-reportingtool\Controllers
 */

class FeusersController extends ControllerBase

{
	public function indexAction(){
		$this->assets->addCss('css/jquery.dataTables.css');
		$feusers=Feusers::find(array(
				'conditions' => 'deleted=0'
			));
		
		$environment= $this->config['application']['debug'] ? 'development' : 'production';
		$baseUri=$this->config['application'][$environment]['staticBaseUri'];
		$path=$baseUri.'/backend/'.$this->view->language.'/feusers/update/';
		
		$this->view->setVar('path',$path);
		$this->view->setVar('feusers',$feusers);
	}
	public function updateAction(){
		if(!$this->request->isPost()){
			$feuserUid = $this->dispatcher->getParam("uid");
			$feuserRecord = Feusers::findFirstByUid($feuserUid);
		}else{
			$feuserUid = $this->request->getPost("uid");
			$feuserRecord = Feusers::findFirstByUid($feuserUid);
			
			$feuserRecord->assign(array(
				'tstamp' => time(),				
				'cruser_id' => $this->session->get('auth')['uid'],								
				'username' => $this->request->getPost('username'),
				'password' => $this->myhash($this->request->getPost('password'), $this->unique_salt()),
				'first_name' => $this->request->getPost('first_name'),
				'last_name' => $this->request->getPost('last_name'),				
				'title' => $this->request->getPost('title'),
				'email' => $this->request->getPost('email'),
				'phone' => $this->request->getPost('phone'),
				'address' => $this->request->getPost('address'),
				'city' => $this->request->getPost('city'),
				'zip' => $this->request->getPost('zip'),
				'company' => $this->request->getPost('company'),
				'profileid' => $this->request->getPost('profileuid'),
				'usergroup' => $this->request->getPost('usergroup'),
				'superuser' => $this->request->getPost('superuser'),
				'userlanguage' => $this->request->getPost('userlanguage')
			));
			$feuserRecord->update();
		}
		$this->view->form = new FeusersForm($feuserRecord, array(
            'edit' => true
        ));
	}
	public function createAction(){
		if($this->request->isPost()){
			$time=time();
			$feuser=new Feusers();
			$feuser->assign(array(
				"pid" => 0,
				'tstamp' => $time,
				'crdate' => $time,
				'cruser_id' => $this->session->get('auth')['uid'],
				'deleted' => 0,
				'hidden' => 0,				
				'username' => $this->request->getPost('username'),
				'password' => $this->myhash($this->request->getPost('password'), $this->unique_salt()),
				'first_name' => $this->request->getPost('first_name'),
				'last_name' => $this->request->getPost('last_name'),				
				'title' => $this->request->getPost('title'),
				'email' => $this->request->getPost('email'),
				'phone' => $this->request->getPost('phone'),
				'address' => $this->request->getPost('address'),
				'city' => $this->request->getPost('city'),
				'zip' => $this->request->getPost('zip'),
				'company' => $this->request->getPost('company'),
				'profileid' => $this->request->getPost('profileuid'),
				'usergroup' => $this->request->getPost('usergroup'),
				'superuser' => $this->request->getPost('superuser'),
				'userlanguage' => $this->request->getPost('userlanguage')
				
			));
			if(!$feuser->save()){
				$this->flash->error($feuser->getMessages());
			}else{
				$this->flash->success("Feuser was created successfully");
			}
			
			/*Forces to rewrite ACL list on next request*/
			unlink('../app/cache/acl/data.txt');
			
		}
		$profiles=Profiles::find(array(
			'conditions' => 'deleted=0 AND hidden=0'
		));
		$languages=Languages::find(array(
			'conditions' => 'deleted=0 AND hidden=0'
		));
		$usergroups=Usergroups::find(array(
			'conditions' => 'deleted=0 AND hidden=0'
		));

		$this->view->setVar('profiles',$profiles);
		$this->view->setVar('languages',$languages);
		$this->view->setVar('usergroups',$usergroups);
		
	}
	public function deleteAction(){
            if($this->request->isPost()){
                    $element=Feusers::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
	private function myhash($password, $unique_salt) {
		return crypt($password, '$2a$10$'.$unique_salt);
	}
	private function unique_salt() {
		return substr(sha1(mt_rand()),0,22);
	}
}