<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Otherprojects,
    reportingtool\Models\Usergroups;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class OtherprojectsController extends ControllerBase
{
	public function indexAction(){            
            $projects=  Otherprojects::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'tstamp DESC'                  
            ));
            
            $this->view->setVar('projects',$projects);                        
	}
        
        public function createAction(){
            if($this->request->isPost()){
                $time = time();
               
                $project = new Otherprojects();
                $project->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'tstamp' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->request->hasPost('starttime') ? $this->littlehelpers->processDateOnly($this->request->getPost('starttime')) : 0,
                    'endtime' => $this->request->hasPost('endtime') ? $this->littlehelpers->processDateOnly($this->request->getPost('endtime')) : 0
                    
                ));                
                if(!$project->save()){
                    $this->flash->error($project->getMessages());
                }else{
                    
                    $this->response->redirect('backend/'.$this->view->language.'/otherobjects/update/'.$project->uid.'/'); 
                    $this->flash->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }else{
                $usergroups=Usergroups::find(array(
                    'conditions' =>array(
                        'deleted=0 AND hidden =0'
                    )
                 ));
                 $this->view->setVar('usergroups',$usergroups);
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $time=time();
                $projectUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $project=Otherprojects::findFirstByUid($projectUid);
                $projectstates=$project->getProjectstates();
                foreach($projectstates as $projecthistory){
                    $projecthistory->active=0;
                    $projecthistory->update();
                }
                if($project){
                    $project->assign(array(
                       'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'tstamp' =>time(),                    
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->request->hasPost('starttime') ? $this->littlehelpers->processDateOnly($this->request->getPost('starttime')) : 0,
                    'endtime' => $this->request->hasPost('endtime') ? $this->littlehelpers->processDateOnly($this->request->getPost('endtime')) : 0,
                    'status' => $this->request->hasPost('status') ? $this->request->getPost('status') : 0
                    
                    ));
                    if(!$project->update()){
                        $this->flash->error($project->getMessages());
                    }
                    
                }
            }else{
                $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                 
                 
                $project=Otherprojects::findFirstByUid($projectUid);
                $projectstateArr=$project->getProjectstates(array(
                    'conditions' => 'deleted=0 AND hidden=0 AND active=1'
                ));
                $projectstate=$projectstate[0];
            }    
            $usergroups=Usergroups::find(array(
                    'conditions' =>array(
                        'deleted=0 AND hidden =0'
                    )
                 ));
                $this->tag->setDefault("usergroup", $project->usergroup);
                $this->tag->setDefault("status", $project->status);
                $this->tag->setDefault("projectstate", $projectstate->statetype);
                $this->tag->setDefault("projecttype", $project->projecttype);
                $this->view->setVar('projectstatedesc',$projectstate->description);
                $this->view->setVar('usergroups',$usergroups);
                $this->view->setVar('project',$project);
            
        }

	
	
}