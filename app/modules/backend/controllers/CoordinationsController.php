<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Coordinations,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Projects,
    reportingtool\Models\Coordinations_projects_lookup;
	

/**
 * Class CoordinationsController
 *
 * @package reporting-tool\Controllers
 */
class CoordinationsController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
                $coordinations=Coordinations::find(array(
                   'conditions'  => 'deleted = 0 AND hidden =0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->request->getPost('usergroup')
                    ),
                    'order' => 'tstamp DESC,pid ASC'
                    
                ));
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                $this->view->setVar('usergroup',$usergroup);   
                $this->view->setVar('coordinations',$coordinations);   
                $this->view->setVar('customerselect',false);   
            }else{
                $usergroups=  Usergroups::find(array(
                        'conditions' => 'deleted = 0 AND hidden = 0',
                        'order' => 'title ASC'                  
                ));
                $this->view->setVar('customerselect',true);                        
                $this->view->setVar('usergroups',$usergroups);                        
            }
	}
        
       public function createAction(){
            if($this->request->isPost()){
                $time = time();
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                                
                
                $coordination = new Coordinations();
                $coordination->assign(array(                    
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDateOnly($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'comments' => $this->request->getPost('comments')                    
                ));                
                if(!$coordination->save()){
                    $this->flashSession->error($coordination->getMessages());
                }else{
                    foreach($this->request->getPost('projects') as $projectid){
                        $lookupEntry=new Coordinations_projects_lookup();
                        $lookupEntry->assign(array(
                           'uid_local' => $coordination->uid,
                           'uid_foreign' => $projectid
                        ));
                        $lookupEntry->save();
                    }
                    
                    $this->response->redirect('backend/'.$this->view->language.'/coordinations/create/'.$this->request->getPost('usergroup').'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }else{
                $usergroupUid=$this->dispatcher->getParam("uid");
                $usergroup=Usergroups::findFirstByUid($usergroupUid);
                
                $projects= Projects::find(array(
                   'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1',
                   'bind' => array(
                       1=>$usergroupUid
                   )
                ));
                
                
                
                
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
            }
        }
        public function deleteAction(){
            if($this->request->isPost()){
                    $element=  Coordinations::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
        public function updateAction(){
            if($this->request->isPost()){
                $coordinationsUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $coordination=Coordinations::findFirstByUid($coordinationsUid);
                if($coordination){
                    $coordination->assign(array(
                       'tstamp' => time(),
                       'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
                       'description' => $this->request->hasPost('description') ? $this->request->getPost('description') : '',
                        'icon' =>$this->request->hasPost('icon') ? $this->request->getPost('icon') : '',
                    ));
                    if(!$coordination->update()){
                        $this->flashSession->error($medium->getMessages());
                    }else{
                         $this->flashSession->success($this->translate('successUpdate'));
                    }
                }
            }else{
                $coordinationsUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $coordination=Coordinations::findFirstByUid($coordinationsUid);
                $projectsArray=array();
                foreach($coordination->getProjects() as $project){
                    
                    $projectsArray[]=$project->uid;
                }
                  $projects= Projects::find(array(
                   'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1',
                   'bind' => array(
                       1=>$coordination->usergroup
                   )
                ));
                
                
                 
                $usergroup=Usergroups::findFirstByUid($coordination->usergroup);
                $this->view->setVar('coordination',$coordination);
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
                $this->view->setVar('projectsarray',$projectsArray);
                
            }
        }

	
	
}