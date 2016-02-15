<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Medium;
	

/**
 * Class MediumController
 *
 * @package reporting-tool\Controllers
 */
class MediumController extends ControllerBase
{
	public function indexAction(){            
            
            $mediums=  Medium::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'title ASC'                  
            ));
                
            $this->view->setVar('mediums',$mediums);                        
            
	}
        
        public function createAction(){
            if($this->request->isPost()){
                
                $time = time();
                $medium = new Medium();
                $medium->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],                    
                    'tstamp' => $time,
                    'crdate' => $time,
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'reach' =>$this->request->getPost('reach'),
                    'url' =>$this->request->getPost('url'),
                    'mediumtype'=>$this->request->getPost('mediumtype')
                    
                ));                
                if(!$medium->save()){
                    $this->flashSession->error($medium->getMessages());
                }else{
                    $medium->icon =$this->littlehelpers->saveImages($this->request->getUploadedFiles(),'medium',$medium->uid);
                    $medium->update();
                    $this->response->redirect('backend/'.$this->view->language.'/medium/update/'.$medium->uid.'/'); 
                    $this->flashSession->success($this->translate('successCreate'));
                    $this->view->disable();
                }
            }
        }
        
        public function updateAction(){
            if($this->request->isPost()){
                $mediumUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $medium=Medium::findFirstByUid($mediumUid);
                if($medium){
                    $medium->assign(array(
                       'tstamp' => time(),
                       'title' => $this->request->hasPost('title') ? $this->request->getPost('title') : '',
                       'description' => $this->request->hasPost('description') ? $this->request->getPost('description') : '',
                        'icon' =>$this->request->hasPost('icon') ? $this->request->getPost('icon') : '',
                    ));
                    if(!$medium->update()){
                        $this->flashSession->error($medium->getMessages());
                    }
                }
            }else{
                $mediumUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                $medium=Medium::findFirstByUid($mediumUid);
                $this->view->setVar('medium',$medium);
            }
        }

	
	
}