<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Clippingsoverview,
    reportingtool\Models\Usergroups;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class ClippingsoverviewController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
                $clippings=Clippingsoverview::find(array(
                   'conditions'  => 'deleted = 0 AND hidden =0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->request->getPost('usergroup')
                    ),
                    'order' => 'tstamp DESC,pid ASC'
                    
                ));
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                $this->view->setVar('usergroup',$usergroup);   
                $this->view->setVar('clippingsoverviews',$clippings);   
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
                
                $filename=$this->littlehelpers->saveFile($this->request->getUploadedFiles(),$time,$usergroup);
                
                $clipping = new Clippingsoverview();
                $clipping->assign(array(                    
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDate($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'overviewyear' => $this->request->getPost('overviewyear'),
                    'overviewmonth' => $this->request->getPost('overviewmonth'),
                    'filelink'=>$filename
                ));                
                if(!$clipping->save()){
                    $this->flashSession->error($clipping->getMessages());
                }else{
                    //$this->response->redirect('backend/'.$this->view->language.'/clippingsoverview/update/'.$clipping->uid.'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }else{
                $usergroupUid=$this->dispatcher->getParam("uid");
                $usergroup=Usergroups::findFirstByUid($usergroupUid);
                
                $this->view->setVar('usergroup',$usergroup);
             
            }
        }
        
          public function deleteAction(){
            if($this->request->isPost()){
                    $element=Clippingsoverview::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
        
        public function updateAction(){
            if($this->request->isPost()){
                $time = time();
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                
                $filename=$this->littlehelpers->saveFile($this->request->getUploadedFiles(),$time,$usergroup);
                $clippingUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $clipping=Clippingsoverview::findFirstByUid($clippingUid);
                $clipping->assign(array(                   
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDate($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'overviewyear' => $this->post('overviewyear'),
                    'overviewmonth' => $this->post('overviewmonth'),
                    'filelink'=>$filename
                ));           
                if(!$clipping->update()){
                    $this->flashSession->error($clipping->getMessages());
                }else{
                    //$this->response->redirect('backend/'.$this->view->language.'/clippings/update/'.$clipping->uid.'/'); 
                    $this->flashSession->success($this->translate('successUpdate'));
                    //$this->view->disable();
                }
            }else{
                $clippingUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $clipping=Clippingsoverview::findFirstByUid($clippingUid);
                $usergroup=Usergroups::findFirstByUid($clipping->usergroup);
                
                
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('clipping',$clipping);
            }
        }

        
	
}