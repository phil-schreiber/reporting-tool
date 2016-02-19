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
            $coordinations=Coordinations::find(array(
               "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1",
                "bind" => array(
                    1 => $this->session->get('auth')['usergroup']                    
                )
            ));
            if($coordinations){
                $coordinationsarray=array();
                foreach($coordinations as $coordination){
                    
                    $dateArray=getdate($coordination->tstamp);
                    $coordinationsarray[$dateArray['year']][$dateArray['month']][]=$coordination;
                }
                        
              $this->view->setVar('coordinationsarray',$coordinationsarray);
            }
		
	}
        
        

	
	
}