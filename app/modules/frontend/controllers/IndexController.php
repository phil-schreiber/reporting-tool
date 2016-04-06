<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;

/**
 * Class IndexController
 *
 * @package baywa-reportingtool\Controllers
 */

class IndexController extends ControllerBase

{
	private $_loginForm;
	
	

    /**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function indexAction()
    {		
		$auth = $this->session->get('auth');
		$this->_loginForm = new LoginForm();
		if(!$auth){			
			
			$this->view->form = $this->_loginForm;
			/*$this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "index"
        ));*/
		}else{
			//$this->flashSession->success('Willkommen '.$auth['username']);
			$this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "overview"
				));
			
		}
		
        
        
    }
	
	
	private function getRunningJobs(){
		$content='ACL geprüfter und mehrsprachiger Content';
		return $content;
	}
	
	
	
	/**
     * @return \Phalcon\Http\ResponseInterface
     */
    public function overviewAction()
	{
		/*$runningJobs=$this->getRunningJobs();
			
                $this->view->setVar('runningJobs',$runningJobs);*/
                 $contract=  \reportingtool\Models\Contractruntime::findFirst(array(
               "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND active =1 AND (enddate > ?2 OR enddate = 0)",
                "bind" => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => time()
                )
            ));
            if($contract){
            $projects=  \reportingtool\Models\Projects::find(array(
               'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1 AND crdate > ?2',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => $contract->startdate
                    
                )
            ));
            
            $projectCount=array();
            $projectPrepCount=array();
            $projectArr=array();
            foreach($projects as $project){
                if(!empty($project->getProjectstate())){
                    if($project->getProjectstate()->statetype >=2){
                        
                        if(isset($projectCount[$project->projecttype])){
                                
                                $projectCount[$project->projecttype]=$projectCount[$project->projecttype]+1;                    
                        }else{
                            $projectCount[$project->projecttype]=1;
                        }
                    }else{
                        if(isset($projectPrepCount[$project->projecttype])){

                                $projectPrepCount[$project->projecttype]=$projectPrepCount[$project->projecttype]+1;                    
                        }else{
                            $projectPrepCount[$project->projecttype]=1;
                        }
                    }
                }
                $projectArr[$project->projecttype][]=$project;
            }
            
            
            $budget=$contract->getBudget();
            $specs=$budget->getBudgetcount();
            $specscount=array();
            foreach($specs as $spec){
                $projecttype=$spec->getProjecttype();
                if($projecttype->deleted==0 && $projecttype->hidden==0){
                    
                
                $title=$projecttype->title;
                
                $specscount[$spec->uid_foreign]=array(
                  'amount' => $spec->amount,
                  'title' => $title
                );
                }
                
            }
            $lastProject= \reportingtool\Models\Projects::findFirst(array(
               'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1 AND crdate > ?2',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => $contract->startdate
                    
                ),
                'order' => 'tstamp DESC'
            ));
            
            $lastClipping = \reportingtool\Models\Clippings::findFirst(array(
               'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1 AND crdate > ?2',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => $contract->startdate
                    
                ),
                'order' => 'tstamp DESC'
            ));
            
            $this->view->setVar('projects',$projectArr);            
            $this->view->setVar('projectprepcount',$projectPrepCount);
            $this->view->setVar('projectcount',$projectCount);
            $this->view->setVar('contract',$contract);
            $this->view->setVar('specscount',$specscount);
            $this->view->setVar('lastupdate',$lastClipping->tstamp > $lastProject->tstamp ? date('d.m.Y H:i',$lastClipping->tstamp) : date('d.m.Y H:i',$lastProject->tstamp));
            }else{
                $this->view->setVar('projectprepcount',$projectPrepCount=array());
                $this->view->setVar('projectcount',$projectCount= array());
            $this->view->setVar('contract',$contract = array());
            $this->view->setVar('specscount',$specscount = array());
            }
		
	}
	  
	
}