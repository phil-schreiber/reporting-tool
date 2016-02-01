<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Projects,
    reportingtool\Models\Usergroups;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class ProjectsController extends ControllerBase
{
	public function indexAction(){            
            $projects=  Projects::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'tstamp DESC'                  
            ));
            
            $this->view->setVar('projects',$projects);                        
	}
        
        public function createAction(){
            if($this->request->isPost()){
                $time = time();
               
                $project = new Projects();
                $project->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'tstamp' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->request->hasPost('starttime') ? $this->littlehelpers->processDate($this->request->getPost('starttime')) : 0,
                    'endtime' => $this->request->hasPost('endtime') ? $this->littlehelpers->processDate($this->request->getPost('endtime')) : 0,
                    'status' => $this->request->hasPost('status') ? $this->request->getPost('status') : 0,
                    'deadline' => $this->request->hasPost('deadline') ? $this->littlehelpers->processDate($this->request->getPost('deadline')) : 0,
                    'projecttype' => $this->request->hasPost('projecttype') ? $this->request->getPost('projecttype') : 0,
                    'topic' => $this->request->hasPost('topic') ? $this->request->getPost('topic') : '',
                    'estcost' => $this->request->hasPost('estcost') ? $this->request->getPost('estcost') : 0,
                    'currentcost' => $this->request->hasPost('currentcost') ? $this->request->getPost('currentcost') : 0
                ));                
                if(!$project->save()){
                    $this->flash->error($project->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/projects/update/'.$project->uid.'/'); 
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
                $projectUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $project=Projects::findFirstByUid($projecttypeUid);
                if($project){
                    $project->assign(array(
                       'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'tstamp' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->request->hasPost('starttime') ? $this->littlehelpers->processDate($this->request->getPost('starttime')) : 0,
                    'endtime' => $this->request->hasPost('endtime') ? $this->littlehelpers->processDate($this->request->getPost('endtime')) : 0,
                    'status' => $this->request->hasPost('status') ? $this->request->getPost('status') : 0,
                    'deadline' => $this->request->hasPost('deadline') ? $this->littlehelpers->processDate($this->request->getPost('deadline')) : 0,
                    'projecttype' => $this->request->hasPost('projecttype') ? $this->request->getPost('projecttype') : 0,
                    'topic' => $this->request->hasPost('topic') ? $this->request->getPost('topic') : '',
                    'estcost' => $this->request->hasPost('estcost') ? $this->request->getPost('estcost') : 0,
                    'currentcost' => $this->request->hasPost('currentcost') ? $this->request->getPost('currentcost') : 0
                    ));
                    if(!$project->update()){
                        $this->flash->error($project->getMessages());
                    }
                    
                }
            }else{
                $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                 $usergroups=Usergroups::find(array(
                    'conditions' =>array(
                        'deleted=0 AND hidden =0'
                    )
                 ));
                 
                $project=Projects::findFirstByUid($projectUid);
                $this->tag->setDefault("usergroup", $project->usergroup);
                $this->tag->setDefault("status", $project->status);
                $this->tag->setDefault("projecttype", $project->projecttype);
                $this->view->setVar('usergroups',$usergroups);
                $this->view->setVar('project',$project);
            }
        }

	
	
}