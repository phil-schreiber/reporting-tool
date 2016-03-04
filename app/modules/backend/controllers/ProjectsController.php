<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Projects,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Projectstates;
	

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
                    'starttime' => $this->request->hasPost('starttime') ? $this->littlehelpers->processDateOnly($this->request->getPost('starttime')) : 0,
                    'endtime' => $this->request->hasPost('endtime') ? $this->littlehelpers->processDateOnly($this->request->getPost('endtime')) : 0,                    
                    'deadline' => $this->request->hasPost('deadline') ? $this->littlehelpers->processDateOnly($this->request->getPost('deadline')) : 0,
                    'projecttype' => $this->request->hasPost('projecttype') ? $this->request->getPost('projecttype') : 0,
                    'topic' => $this->request->hasPost('topic') ? $this->request->getPost('topic') : '',
                    'estcost' => $this->request->hasPost('estcost') ? $this->request->getPost('estcost') : 0,
                    'currentcost' => $this->request->hasPost('currentcost') ? $this->request->getPost('currentcost') : 0,
                    'status' => $this->request->hasPost('status') ? $this->request->getPost('status') :0
                ));                
                if(!$project->save()){
                    $this->flash->error($project->getMessages());
                }else{
                    $projectstate=new Projectstates();
                    $projectstate->assign(array(
                        'pid' => $project->uid,
                        'cruser_id' => $this->session->get('auth')['uid'],
                        'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                        'tstamp' => $time,
                        'crdate' => $time,
                        'description' => $this->request->hasPost('projectstatedescription') ? $this->request->getPost('projectstatedescription') : 0,
                        'statetype' => $this->request->hasPost('projectstate') ? $this->request->getPost('projectstate') :0,
                        'active' => 1
                        
                    ));
                            
                    $projectstate->save();
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
                $time=time();
                $projectUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $project=Projects::findFirstByUid($projectUid);
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
                    'status' => $this->request->hasPost('status') ? $this->request->getPost('status') : 0,
                    'deadline' => $this->request->hasPost('deadline') ? $this->littlehelpers->processDateOnly($this->request->getPost('deadline')) : 0,
                    'projecttype' => $this->request->hasPost('projecttype') ? $this->request->getPost('projecttype') : 0,
                    'topic' => $this->request->hasPost('topic') ? $this->request->getPost('topic') : '',
                    'estcost' => $this->request->hasPost('estcost') ? $this->request->getPost('estcost') : 0,
                    'currentcost' => $this->request->hasPost('currentcost') ? $this->request->getPost('currentcost') : 0
                    ));
                    if(!$project->update()){
                        $this->flash->error($project->getMessages());
                    }else{
                        $projectstate=new Projectstates();
                        $projectstate->assign(array(
                            'pid' => $project->uid,
                            'cruser_id' => $this->session->get('auth')['uid'],
                            'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                            'tstamp' => $time,
                            'crdate' => $time,
                            'description' => $this->request->hasPost('projectstatedescription') ? $this->request->getPost('projectstatedescription') : 0,
                            'statetype' => $this->request->hasPost('projectstate') ? $this->request->getPost('projectstate') :0,
                            'active' => 1

                        ));

                        $projectstate->save();
                    }
                    
                }
            }else{
                $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                 
                 
                $project=Projects::findFirstByUid($projectUid);
                $projectstateArr=$project->getProjectstates(array(
                    'conditions' => 'deleted=0 AND hidden=0 AND active=1'
                ));
                $projectstate=$projectstateArr[0];
            }    
            $usergroups=Usergroups::find(array(
                    'conditions' =>array(
                        'deleted=0 AND hidden =0'
                    )
                 ));
            
                $this->tag->setDefault("usergroup", $project->usergroup);
                $this->tag->setDefault("status", $project->status);                
                $this->view->setVar("projectstate", $projectstate);
                $this->view->setVar('usergroups',$usergroups);
                $this->view->setVar('project',$project);
            
        }
        
        public function deleteAction(){
            if($this->request->isPost()){
                    $element=Projects::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }

	
	
}