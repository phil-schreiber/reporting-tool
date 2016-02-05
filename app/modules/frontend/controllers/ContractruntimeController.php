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
               'conditions' => 'deleted=0 AND hidden =0 AND usergroup =?1',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup']
                )
            ));
            $budget=$contract->getBudget();
            $specs=$budget->getBudgetcount();
            foreach($specs as $spec){
                var_dump($spec->amount);
                
                var_dump($spec->getProjecttype()->title);
            }
            
            $this->view->setVar('contract',$contract);
		
	}
        
        

	
	
}