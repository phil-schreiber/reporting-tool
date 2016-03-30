<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Coordinations;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class CoordinationsController extends ControllerBase
{
	public function indexAction(){	       
            $currentyear=$this->littlehelpers->getCurrentYear();
            
            $coordinations=Coordinations::find(array(
               "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND tstamp >= ?2 AND tstamp <= ?3",
                "bind" => array(
                    1 => $this->session->get('auth')['usergroup'],
                    2 => $currentyear[0],
                    3 => $currentyear[1]
                ),
                "order" => "tstamp DESC"
            ));
            
                        
             $this->view->setVar('coordinations',$coordinations);
            
		
	}
        
        

	
	
}