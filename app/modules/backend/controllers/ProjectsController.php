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
                $project = new Projecttypes();
                $project->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'time' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description')
                ));                
                if(!$projecttype->save()){
                    $this->flash->error($projecttype->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/projecttypes/update/'.$projecttype->uid.'/'); 
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
                $projecttypeUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $projecttype=Projecttypes::findFirstByUid($projecttypeUid);
                if($projecttype){
                    $projecttype->assign(array(
                       'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
                       'description' => $this->request->hasPost('description') ? $this->request->getPost('description') : ''
                    ));
                }
            }else{
                $projecttypeUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $projecttype=Projecttypes::findFirstByUid($projecttypeUid);
                $this->view->setVar('projecttype',$projecttype);
            }
        }

	
	
}