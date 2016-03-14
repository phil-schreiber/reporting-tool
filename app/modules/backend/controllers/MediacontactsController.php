<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Mediacontacts,
    reportingtool\Models\Medium,
    reportingtool\Models\Usergroups;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class MediacontactsController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
                $mediacontacts=Mediacontacts::find(array(
                   'conditions'  => 'deleted = 0 AND hidden =0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->request->getPost('usergroup')
                    ),
                    'order' => 'tstamp DESC,pid ASC'
                    
                ));
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                $this->view->setVar('usergroup',$usergroup);   
                $this->view->setVar('mediacontacts',$mediacontacts);   
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
                                                
                $mediacontacts = new Mediacontacts();
                $mediacontacts->assign(array(                    
                    'tstamp' => $time,
                    'crdate' => $time,
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),                                        
                    'medium' => $this->request->getPost('medium'),
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->littlehelpers->processDate($this->request->getPost('starttime')),
                    'endtime' => $this->littlehelpers->processDate($this->request->getPost('endtime'))
                ));                
                if(!$mediacontacts->save()){
                    $this->flashSession->error($clipping->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/mediacontacts/create/'.$this->request->getPost('usergroup').'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }else{
                $usergroupUid=$this->dispatcher->getParam("uid");
                $usergroup=Usergroups::findFirstByUid($usergroupUid);
                $medium=Medium::find(array(
                   'conditions' => 'deleted=0 AND hidden=0'
                ));
                
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('medium',$medium);
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $time = time();
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                
                
                $mediacontactsUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $mediacontacts=  Mediacontacts::findFirstByUid($mediacontactsUid);
                $mediacontacts->assign(array(                    
                    'tstamp' => $time,
                    'crdate' => $time,
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),                                        
                    'medium' => $this->request->getPost('medium'),
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'starttime' => $this->littlehelpers->processDate($this->request->getPost('starttime')),
                    'endtime' => $this->littlehelpers->processDate($this->request->getPost('endtime'))
                ));              
                if(!$mediacontacts->update()){
                    $this->flashSession->error($mediacontacts->getMessages());
                }else{
                    $this->flashSession->success($this->translate('successUpdate'));
                }
            }else{
                $mediacontactsUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $mediacontacts=Mediacontacts::findFirstByUid($mediacontactsUid);
                $usergroup=Usergroups::findFirstByUid($mediacontacts->usergroup);
               
                
               
            }
              $medium=Medium::find(array(
                   'conditions' => 'deleted=0 AND hidden=0'
                ));
             $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('mediacontact',$mediacontacts);
                $this->view->setVar('medium',$medium);
        }

        
	public function deleteAction(){
            if($this->request->isPost()){
                    $element=Mediacontacts::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
}