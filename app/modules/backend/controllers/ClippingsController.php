<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Medium;
	

/**
 * Class ProjecttypesController
 *
 * @package reporting-tool\Controllers
 */
class MediumController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
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
                $projecttype = new Projecttypes();
                $projecttype->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->session->get('auth')['usergroup'],
                    'time' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'icon' =>$this->request->getPost('icon')
                ));                
                if(!$projecttype->save()){
                    $this->flashSession->error($projecttype->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/projecttypes/update/'.$projecttype->uid.'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $projecttypeUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $projecttype=Projecttypes::findFirstByUid($projecttypeUid);
                if($projecttype){
                    $projecttype->assign(array(
                       'tstamp' => time(),
                       'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
                       'description' => $this->request->hasPost('description') ? $this->request->getPost('description') : '',
                        'icon' =>$this->request->hasPost('icon') ? $this->request->getPost('icon') : '',
                    ));
                    if(!$projecttype->update()){
                        $this->flashSession->error($projecttype->getMessages());
                    }
                }
            }else{
                $projecttypeUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $projecttype=Projecttypes::findFirstByUid($projecttypeUid);
                $this->view->setVar('projecttype',$projecttype);
            }
        }

	
	
}