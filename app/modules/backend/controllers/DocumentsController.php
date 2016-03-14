<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Documents,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Projects,
    reportingtool\Models\Documentversions;
	

/**
 * Class DocumentsController
 *
 * @package reporting-tool\Controllers
 */
class DocumentsController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                
                $documents=Documents::find(array(
                   'conditions'  => 'deleted = 0 AND hidden =0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->request->getPost('usergroup')
                    ),
                    'order' => 'tstamp DESC,pid ASC'
                    
                ));
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                $this->view->setVar('usergroup',$usergroup);   
                $this->view->setVar('documents',$documents);   
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
                
                $document = new Documents();
                $document->assign(array(
                    'pid' => $this->request->getPost('pid'),
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDateOnly($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),                                                            
                    'filelink'=>$filename
                ));                
                if(!$document->save()){
                    $this->flashSession->error($document->getMessages());
                }else{
                    $this->response->redirect('backend/'.$this->view->language.'/documents/create/'.$this->request->getPost('usergroup').'/'); 
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
                
               
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $time = time();
                $usergroup=Usergroups::findFirstByUid($this->request->getPost('usergroup'));
                
                $filename=$this->littlehelpers->saveFile($this->request->getUploadedFiles(),$time,$usergroup);
                $documentUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $document=Documents::findFirstByUid($documentUid);
                $oldfile=$document->filelink;
                $document->assign(array(
                    'pid' => $this->request->getPost('pid'),
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->getPost('usergroup'),
                    'tstamp' => $this->littlehelpers->processDateOnly($this->request->getPost('tstamp')),
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),                                                            
                    'filelink'=>$filename
                ));
                $this->createOldVersion($document->uid,$oldfile,$time);
                if(!$document->update()){
                    $this->flashSession->error($document->getMessages());
                }else{
                    //$this->response->redirect('backend/'.$this->view->language.'/documents/update/'.$document->uid.'/'); 
                    $this->flashSession->success($this->translate('successUpdate'));
                    $this->view->disable();
                }
            }else{
                $documentUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $document=Documents::findFirstByUid($documentUid);
                $usergroup=Usergroups::findFirstByUid($document->usergroup);
                $projects= Projects::find(array(
                   'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1',
                   'bind' => array(
                       1=>$usergroup->uid
                   )
                ));
                
              
                $this->view->setVar('usergroup',$usergroup);
                $this->view->setVar('projects',$projects);
                $this->view->setVar('document',$document);
            }
        }

        public function deleteAction(){
            if($this->request->isPost()){
                    $element=Documents::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
        
        private function createOldVersion($documentid,$oldfile,$time){
            $documentversion=new Documentversions();
            $documentversion->assign(array(
              'pid' => $documentid,
                'cruser_id' => $this->session->get('auth')['uid'],                
                'tstamp' => $time,
                'crdate' => $time,                
                'filelink'=>$oldfile   
            ));
            $documentversion->save();
        }
        
        
        private function saveFile($filearray,$time,$usergroup){
            
            $saveFilename='';
            $filepath='../public/media/documents/'.$usergroup->title;
            
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