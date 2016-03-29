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
            $projectArr=array();
            foreach($projects as $project){
                if(isset($projectCount[$project->projecttype])){
                    $projectCount[$project->projecttype]=$projectCount[$project->projecttype]+1;
                }else{
                    $projectCount[$project->projecttype]=1;
                }
                $projectArr[$project->projecttype][]=$project;
            }
            
            
            $budget=$contract->getBudget();
            $specs=$budget->getBudgetcount();
            $specscount=array();
            foreach($specs as $spec){
                $projecttype=$spec->getProjecttype();
                if($projecttype->deleted==0){
                    
                
                $title=$projecttype->title;
                
                $specscount[$spec->uid_foreign]=array(
                  'amount' => $spec->amount,
                  'title' => $title
                );
                }
                
            }
            $this->view->setVar('projects',$projectArr);
            $this->view->setVar('projectcount',$projectCount);
            $this->view->setVar('contract',$contract);
            $this->view->setVar('specscount',$specscount);
            }else{
                $this->view->setVar('projectcount',$projectCount= array());
            $this->view->setVar('contract',$contract = array());
            $this->view->setVar('specscount',$specscount = array());
            }
		
	}
	  
	
}