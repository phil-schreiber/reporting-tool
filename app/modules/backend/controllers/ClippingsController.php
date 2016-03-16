<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Clippings,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Projects,
    reportingtool\Models\Medium;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class ClippingsController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
                $clippings=Clippings::find(array(
                   'conditions'  => 'deleted = 0 AND hidden =0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->request->getPost('usergroup')
                    ),
                    'order' => 'pid ASC, tstamp DESC'
                    
                ));
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                $this->view->setVar('usergroup',$usergroup);   
                $this->view->setVar('clippings',$clippings);   
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
                
                $clipping = new Clippings();
                $clipping->assign(array(
                    'pid' => $this->request->getPost('project'),
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDateOnly($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'clippingtype' =>$this->request->getPost('clippingtype'),                    
                    'mediumuid' => $this->request->getPost('medium'),
                    'url' => $this->request->getPost('url'),
                    'filelink'=>$filename
                ));                
                if(!$clipping->save()){
                    $this->flashSession->error($clipping->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/clippings/create/'.$this->request->getPost('usergroup')); 
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
                
                $medium=Medium::find(array(
                    'conditions' => 'deleted=0 AND hidden=0'
                ));
                
                $this->view->setVar('medium',$medium);
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $time = time();
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                
                $filename=$this->littlehelpers->saveFile($this->request->getUploadedFiles(),$time,$usergroup);
                $clippingUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $clipping=Clippings::findFirstByUid($clippingUid);
                $clipping->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDateOnly($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'clippingtype' =>$this->request->getPost('clippingtype'),                    
                    'mediumuid' => $this->request->getPost('medium'),
                    'url' => $this->request->getPost('url'),
                    'filelink'=>$filename
                ));                
                if(!$clipping->update()){
                    $this->flashSession->error($clipping->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/clippings/update/'.$clipping->uid.'/'); 
                    $this->flashSession->success($this->translate('successUpdate'));
                    $this->view->disable();
                }
            }else{
                $clippingUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $clipping=Clippings::findFirstByUid($clippingUid);
                $usergroup=Usergroups::findFirstByUid($clipping->usergroup);
                $projects= Projects::find(array(
                   'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1',
                   'bind' => array(
                       1=>$usergroup->uid
                   )
                ));
                
                $medium=Medium::find(array(
                    'conditions' => 'deleted=0 AND hidden=0'
                ));
                
                $this->view->setVar('medium',$medium);
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
                $this->view->setVar('clipping',$clipping);
            }
        }

        public function deleteAction(){
            if($this->request->isPost()){
                $clipping=Clippings::findFirstByUid($this->request->getPost('uid'));
                $clipping->deleted=1;
                $clipping->save();
            }
        }
        
        private function saveFile($filearray,$time,$usergroup){
            
            $saveFilename='';
            $filepath='../public/media/clippings/'.$usergroup->title;
            
            if(!is_dir($filepath)){
                mkdir($filepath);
            }
                foreach ($filearray as $file){
                    $nameArray=explode('.',$file->getName());
                    $filetype=array_pop($nameArray);
                    
                    $saveFilename=$filepath.'/'.  str_replace(' ','_',implode('.',$nameArray)).'_'.$time.'.'.$filetype;                    
                    $file->moveTo($saveFilename);
                }
            return substr($saveFilename,2);
        }
	
}