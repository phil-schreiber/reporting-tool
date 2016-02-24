<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Mediacontacts;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class MediacontactsController extends ControllerBase
{
	
        
        public function indexAction(){
            
            
            $projects=Mediacontacts::find(array(
               'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup']
                ),
                'order' => 'tstamp DESC'
            ));
            
            $this->view->setVar('projects',$projects);
            
            
        }
        
         
	
}