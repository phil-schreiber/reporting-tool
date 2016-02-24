<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Otherprojects;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class OtherprojectsController extends ControllerBase
{
	
        
        public function indexAction(){
            
            
            $projects=Otherprojects::find(array(
               'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup']
                ),
                'order' => 'tstamp DESC'
            ));
            
            $this->view->setVar('projects',$projects);
            
            
        }
        
         
	
}