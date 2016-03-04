<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Contractruntime,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Budgets,
    reportingtool\Models\Budgets_projecttypes_lookup;
	

/**
 * Class ContractruntimeController
 *
 * @package reporting-tool\Controllers
 */
class ContractruntimeController extends ControllerBase
{
	public function indexAction(){            
            $contractruntime=  Contractruntime::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'tstamp DESC'                  
            ));
            
            $this->view->setVar('contractruntime',$contractruntime);                        
	}
        
        public function createAction(){
            if($this->request->isPost()){
                $time = time();
               
                $contractruntime = new Contractruntime();
                $contractruntime->assign(array(
                    'cruser_id' => $this->session->get('auth')['uid'],
                    'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                    'tstamp' => $time,
                    'crdate' => $time,                    
                    'startdate' => $this->request->hasPost('startdate') ? $this->littlehelpers->processDateOnly($this->request->getPost('startdate')) : 0,
                    'enddate' => $this->request->hasPost('enddate') ? $this->littlehelpers->processDateOnly($this->request->getPost('enddate')) : 0,
                    'active' => $this->request->hasPost('active') ? $this->request->getPost('active') : 0                    
                ));    
                
                
                if(!$contractruntime->save()){
                    $this->flash->error($contractruntime->getMessages());
                }else{
                    $budget=new Budgets();
                    $budget->assign(array(
                        'pid' => $contractruntime->uid,
                        'cruser_id' => $this->session->get('auth')['uid'],
                        'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                        'tstamp' => $time,
                        'crdate' => $time,  
                        'contractruntimeuid' => $contractruntime->uid,
                     ));
                    $budget->save();
                    foreach($this->request->getPost('amount') as $projecttypeuid => $amount){
                        $budgetAmount=new Budgets_projecttypes_lookup();
                        $budgetAmount->assign(array(                                                       
                            'tstamp' => $time,
                            'crdate' => $time,  
                            'uid_local' => $budget->uid,
                            'uid_foreign' => $projecttypeuid,
                            'amount' => $amount
                        ));
                        $budgetAmount->save();
                    }
                    $this->response->redirect('backend/'.$this->view->language.'/contractruntime/update/'.$contractruntime->uid.'/'); 
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
                $contractruntimeUid=$this->request->hasPost('uid') ? $this->request->getPost('uid') : 0;
                $contractruntime=  Contractruntime::findFirstByUid($contractruntimeUid);
                if($contractruntime){
                     $contractruntime->assign(array(
                        'cruser_id' => $this->session->get('auth')['uid'],
                        'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                        'tstamp' => $time,                        
                        'startdate' => $this->request->hasPost('startdate') ? $this->littlehelpers->processDateOnly($this->request->getPost('startdate')) : 0,
                        'enddate' => $this->request->hasPost('enddate') ? $this->littlehelpers->processDateOnly($this->request->getPost('enddate')) : 0,
                        'active' => $this->request->hasPost('active') ? $this->request->getPost('active') : 0                    
                    ));   
                    if(!$contractruntime->update()){
                        $this->flash->error($contractruntime->getMessages());
                    }else{
                        $this->clearBudgetamounts($contractruntime->uid);
                        $budget= Budgets::findFirstByContractruntimeuid($contractruntime->uid);
                        $budget->assign(array(                            
                            'cruser_id' => $this->session->get('auth')['uid'],
                            'usergroup' => $this->request->hasPost('usergroup') ? $this->request->getPost('usergroup') : 0,
                            'tstamp' => $time
                            
                         ));
                        $budget->update();
                        $this->clearBudgetamounts($budget->uid);
                        foreach($this->request->getPost('amount') as $projecttypeuid => $amount){
                            $budgetAmount=new Budgets_projecttypes_lookup();
                            $budgetAmount->assign(array(                                                       
                                'tstamp' => $time,
                                'crdate' => $time,  
                                'uid_local' => $budget->uid,
                                'uid_foreign' => $projecttypeuid,
                                'amount' => $amount
                            ));
                            $budgetAmount->save();
                        }
                        $this->response->redirect('backend/'.$this->view->language.'/contractruntime/update/'.$contractruntime->uid.'/'); 
                        $this->flash->success($this->translate('successCreate'));
                        $this->view->disable();
                    }
                    
                }
            }else{
                $contractruntimeUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;
                
                
                $contractruntime=Contractruntime::findFirstByUid($contractruntimeUid);
               $budget=$contractruntime->getBudget();
                        
                
            }
             
                $budgetspecs=array();
                foreach($budget->getBudgetcount() as $budgetcount){
                    $budgetspecs[$budgetcount->uid_foreign]=$budgetcount->amount;
                }
                  $usergroups=Usergroups::find(array(
                    'conditions' =>array(
                        'deleted=0 AND hidden =0'
                    )
                 ));
                $this->tag->setDefault("usergroup", $contractruntime->usergroup);
                $this->tag->setDefault("active", $contractruntime->active);                
                $this->view->setVar('usergroups',$usergroups);
                $this->view->setVar('contractruntime',$contractruntime);
                $this->view->setVar('budgetspecs',$budgetspecs);
        }
        
        public function deleteAction(){
            if($this->request->isPost()){
                    $element=  Contractruntime::findFirstByUid($this->request->getPost('uid'));
                    $element->deleted=1;
                    $element->save();
                }
           }
        
        private function clearBudgetamounts($cid){
            Budgets_projecttypes_lookup::find(array(
               'conditions' => 'uid_local=?1',
                'bind' =>array(
                    1=>$cid
                )
            ))->delete();
        }

	
	
}