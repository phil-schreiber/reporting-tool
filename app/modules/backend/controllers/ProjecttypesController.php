<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Projecttypes;
	

/**
 * Class ProjecttypesController
 *
 * @package reporting-tool\Controllers
 */
class ProjecttypesController extends ControllerBase
{
	public function indexAction(){            
            $projectTypes=  Projecttypes::find(array(
                    'conditions' => 'deleted = 0',
                    'order' => 'tstamp DESC'                  
            ));

            $this->view->setVar('projecttypes',$projectTypes);                        
	}
        
        public function createAction(){
            if($this->request->isPost()){
                $time = time();
                $projecttype = new Projecttypes();
                $projecttype->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->session->get('auth')['usergroup'],
                    'tstamp' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'publishable' => $this->request->getPost('publishable'),
                    'icon' =>$this->request->getPost('icon')
                ));                
                if(!$projecttype->save()){
                    $this->flashSession->error($projecttype->getMessages());
                }else{
                   // $this->response->redirect('backend/'.$this->view->language.'/projecttypes/update/'.$projecttype->uid.'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    //$this->view->disable();
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
                        'publishable' => $this->request->getPost('publishable'),
                        'icon' =>$this->request->hasPost('icon') ? $this->request->getPost('icon') : '',
                    ));
                    if(!$projecttype->update()){
                        $this->flashSession->error($projecttype->getMessages());
                    }else{
                        $this->flashSession->success($this->translate('successUpdate'));
                    }
                }
            }else{
                $projecttypeUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $projecttype=Projecttypes::findFirstByUid($projecttypeUid);
                
            }
            $this->view->setVar('projecttype',$projecttype);
        }

        public function deleteAction(){
            if($this->request->isPost()){
                    $element=Projecttypes::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
	
	
}