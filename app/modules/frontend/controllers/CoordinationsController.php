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
                $monthmap=array(
                  1 => 'Januar',
                  2 => 'Februar',
                  3 => 'März',
                  4 => 'April',
                  5 => 'Mai',
                  6 => 'Juni',
                  7 => 'Juli',
                  8 => 'August',
                  9 => 'September',
                  10 => 'Oktober',
                  11 => 'November',
                  12 => 'Dezember'
                );
                $coordinationsarray=array();
                foreach($coordinations as $coordination){
                    
                    $dateArray=getdate($coordination->tstamp);
                    $coordinationsarray[$dateArray['year']][$monthmap[$dateArray['mon']]][]=$coordination;
                }
                        
              $this->view->setVar('coordinationsarray',$coordinationsarray);
            }
		
	}
        
        

	
	
}