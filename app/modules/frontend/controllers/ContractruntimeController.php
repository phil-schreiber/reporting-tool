<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Contractruntime,
    reportingtool\Models\Projects;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class ContractruntimeController extends ControllerBase
{
	public function indexAction(){	       
            $contract=Contractruntime::findFirst(array(
               "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND active =1 AND (enddate > ?2 OR enddate = 0)",
                "bind" => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => time()
                )
            ));
            $projects=Projects::find(array(
               'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1 AND crdate > ?2',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => $contract->startdate
                    
                ),
                'columns' => "count(uid) AS count,projecttype",
                'group' => 'projecttype'
            ));
            
            $projectCount=array();
            foreach($projects as $project){
                
                $projectCount[$project->projecttype]=$project->count;
            }
            
            $budget=$contract->getBudget();
            $specs=$budget->getBudgetcount();
            $specscount=array();
            foreach($specs as $spec){
                $title=$spec->getProjecttype()->title;
                
                $specscount[$spec->uid_foreign]=array(
                  'amount' => $spec->amount,
                  'title' => $title
                );
                
            }
            
            $this->view->setVar('projectcount',$projectCount);
            $this->view->setVar('contract',$contract);
            $this->view->setVar('specscount',$specscount);
		
	}
        
        

	
	
}