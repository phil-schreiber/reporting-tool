<?php
namespace reportingtool\Modules\Modules\Backend\Controllers;
use reportingtool\Models\Projecttypes;
	

/**
 * Class ProjecttypesController
 *
 * @package reporting-tool\Controllers
 */
class ProjecttypesController extends ControllerBase
{
	public function indexAction(){
            if($this->request->isPost()){
                
            }else{
                $projectTypes=  Projecttypes::find(array(
                    'conditions' => 'deleted = 0 AND hidden = 0',
                    'order' => 'tstamp DESC'                  
                ));

                $this->view->setVar('projecttypes',$projectTypes);
            }
            
	}

	
	
}