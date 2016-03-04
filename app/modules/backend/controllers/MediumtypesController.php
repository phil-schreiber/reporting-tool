<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Mediumtypes;
	

/**
 * Class ProjecttypesController
 *
 * @package reporting-tool\Controllers
 */
class MediumtypesController extends ControllerBase
{
	public function indexAction(){            
            $mediumTypes=  Mediumtypes::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'tstamp DESC'                  
            ));

            $this->view->setVar('mediumtypes',$mediumTypes);                        
	}
        
        public function createAction(){
            if($this->request->isPost()){
                $time = time();
                $mediumtype = new Mediumtypes();
                $mediumtype->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->session->get('auth')['usergroup'],
                    'time' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title')                   
                ));                
                if(!$mediumtype->save()){
                    $this->flashSession->error($mediumtype->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/mediumtypes/update/'.$mediumtype->uid.'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $mediumtypeUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $mediumtype=Mediumtypes::findFirstByUid($mediumtypeUid);
                if($mediumtype){
                    $mediumtype->assign(array(
                       'tstamp' => time(),
                       'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : ''                       
                    ));
                    if(!$mediumtype->update()){
                        $this->flashSession->error($projecttype->getMessages());
                    }
                }
            }else{
                $mediumtypeUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $mediumtype=Mediumtypes::findFirstByUid($mediumtypeUid);
                $this->view->setVar('mediumtype',$mediumtype);
            }
        }

        public function deleteAction(){
            if($this->request->isPost()){
                    $element=Mediumtypes::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
	
	
}