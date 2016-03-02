<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Clippings,
    reportingtool\Models\Usergroups,
    reportingtool\Models\Projects,
    reportingtool\Models\Medium,
    reportingtool\Models\Mediumtypes,
    reportingtool\Models\Clippingsoverview;
	

/**
 * Class ClippingsController
 *
 * @package reporting-tool\Controllers
 */
class ClippingsController extends ControllerBase
{
	public function indexAction(){            
            if($this->request->isPost()){
                $result=$this->getData();
                $output=json_encode($result,true);			
                die($output);
            }else{
                $projects=Projects::find(array(
                    "conditions" => "deleted=0 AND hidden=0 AND usergroup=?1",
                    "bind" => array(1 => $this->session->get('auth')['usergroup'])
                    
                ));  
                $topics=array();
                foreach($projects as $project){
                    array_push($topics, $project->topic);
                }
                $clippingoverviews=Clippingsoverview::find(array(
                   'conditions' => 'deleted = 0 AND hidden = 0 AND usergroup = ?1',
                    'bind' => array(
                        1 => $this->session->get('auth')['usergroup']
                    )
                ));
                $overviewArray=array();
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
                foreach($clippingoverviews as $overview){
                    $overviewArray[$overview->overviewyear][$monthmap[$overview->overviewmonth]]=$overview->filelink;
                }
                $publishableprojecttypes= \reportingtool\Models\Projecttypes::find(array(
                   'conditions'  =>'deleted=0 AND hidden =0 AND publishable=1'
                ));
                $topics=array_unique($topics);
                $this->view->setVar('topics',$topics);
                $this->view->setVar('projects',$projects);
                $this->view->setVar('overviewarray',$overviewArray);
                $this->view->setVar('publishableprojecttypes',$publishableprojecttypes);
                
                        
            }
	}
        
        public function updateAction(){
            $mediumtypeUid = $this->dispatcher->getParam('uid');
            $mediumtype = Mediumtypes::findFirstByUid($mediumtypeUid);
            
            $projects=Projects::find(array(
               'conditions' => 'deleted=0 AND hidden=0 AND usergroup = ?1',
                'bind' => array(
                    1 => $this->session->get('auth')['usergroup']
                )
            ));
            $clippings=new Clippings();
            $clippingstotal=$clippings->countMediumtypeClippings($mediumtypeUid);
            $this->view->setVar('clippingstotal',$clippingstotal);
            $this->view->setVar('projects',$projects);
            $this->view->setVar('mediumtype',$mediumtype);
            
        }
        
         private function getData(){
		$bindArray=array();
		$aColumns=array('projecttitle','projecttopic','mediumtitle','mediumtype','clippingtitle','publicationdate','clippingtype','filelink','projectdate');
        
        $aColumnsSelect=array('clippingtype','filelink');
        $aColumnsFilter=array('projects.title','projects.topic','medium.title','clipping.title');
		$time=time();
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "clipping.uid";

		/* DB table to use */
		$sTable = "reportingtool\Models\Clippings as clipping LEFT JOIN reportingtool\Models\Medium as medium ON clipping.mediumuid = medium.uid LEFT JOIN reportingtool\Models\Projects as projects ON projects.uid = clipping.pid";
			/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_POST['iDisplayStart'] ) && $_POST['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_POST['iDisplayStart'] ).", ".
				intval( $_POST['iDisplayLength'] );
		}


		/*
		 * Ordering
		 */
		$sOrder = "";
		if ( isset( $_POST['iSortCol_0'] ) )
		{
			$dateSort=false;
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_POST['iSortingCols'] ) ; $i++ )
			{
				if ( $_POST[ 'bSortable_'.intval($_POST['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_POST['iSortCol_'.$i] ) ]." ".
						($_POST['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
					if('date'==$aColumns[ intval( $_POST['iSortCol_'.$i] ) ]){
						$dateSort=true;
					}

				}
			}

			$sOrder=  substr($sOrder, 0,-2).' ';
			
		}


		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
			

		$sWhere = "WHERE clipping.deleted=0 AND clipping.hidden=0 AND projects.deleted=0 AND projects.hidden =0 AND clipping.usergroup = :usergroup: ";
		if ( isset($_POST['sSearch']) && $_POST['sSearch'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumnsFilter) ; $i++ )
			{
				$sWhere .= "".$aColumnsFilter[$i]." LIKE :searchTerm: OR "; //$_POST['sSearch']
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
                
                $filterArray=array(
                    'topics'=> array(
                        'colname'=>'projects.topic',
                        'type' => 4
                        ),                    
                    'startdate' => array(
                        'colname' => 'projects.starttime',
                        'type' => 2
                        ),
                    'enddate' => array(
                        'colname'=>'projects.endtime',
                        'type' => 3
                        ),
                    'projects' => array(
                        'colname' => 'projects.uid',
                        'type' => 1
                        ),
                    'projecttype' => array(
                        'colname' => 'projects.projecttype',
                        'type' => 1
                        ));
                
                foreach($filterArray as $postname => $columnname){
                    if($this->request->hasPost($postname) && $this->request->getPost($postname)){
                        if(is_array($this->request->getPost($postname)) && count($this->request->getPost($postname))>1 ){
                            switch($columnname['type']){
                                case 1:
                                    $sWhere.=" AND ".$columnname['colname']." IN (".implode(',',$this->request->getPost($postname)).')';
                                break;                            
                                case 4:
                                    $sWhere.=" AND ".$columnname['colname'].' IN ("'.implode('","',$this->request->getPost($postname)).'")';
                                    break;
                            }                                                                                        
                        }else{
                            switch($columnname['type']){                                
                                 case 1:
                                    $sWhere.=" AND ".$columnname['colname']." = ".implode(',',$this->request->getPost($postname)).'';
                                break;
                                case 2:
                                    $sWhere.=" AND ".$columnname['colname']." > ".$this->littlehelpers->processDateOnly($this->request->getPost($postname));
                                break;
                                case 3:
                                    $sWhere.=" AND ".$columnname['colname']." < ".$this->littlehelpers->processDateOnly($this->request->getPost($postname));
                                break;  
                                case 4:
                                    $sWhere.=" AND ".$columnname['colname']." LIKE '".$this->request->getPost($postname)[0]."'";
                                    break;
                            }
                        }
                        
                    }
                }
                
                
                

		
		

		/*
		 * SQL queries
		 * Get data to display
		 */
		$phql = "SELECT ".str_replace(" , ", " ", implode(", ", $aColumnsSelect)).", clipping.uid as clippinguid, medium.title AS mediumtitle,mediumtype,clipping.tstamp as publicationdate, clipping.title AS clippingtitle, clipping.url as clippingurl, projects.title AS projecttitle, projects.starttime AS projectdate,projects.topic as projecttopic FROM $sTable ".$sWhere." ".$sOrder." ".$sLimit;
		
		
		
		$bindArray['usergroup']=$this->session->get('auth')['usergroup'];
		if($this->request->getPost('sSearch') != ''){
			$bindArray['searchTerm']='%'.$this->request->getPost('sSearch').'%';
		}
		
		$sQuery=$this->modelsManager->createQuery($phql);
		$rResults = $sQuery->execute($bindArray);		
		$resultSet=array();
                $clippingtypes=array('online','print','newsletter');
		foreach ( $rResults as $aRow )
		{	
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
			
                                        
					/* General output */
					$rowArray=(array)$aRow;
                                        if( $aColumns[$i] == 'publicationdate'){
                                            $row[] = date('d/m/Y',$rowArray[ $aColumns[$i] ]);
                                        }elseif($aColumns[$i] == 'clippingtype'){
                                            $row[]=$clippingtypes[$rowArray[ $aColumns[$i] ]];
                                        }elseif($aColumns[$i] == 'filelink'){
                                            $row[]='<a href="'.$this->host.$this->baseUri.$rowArray[ $aColumns[$i] ].'" target="_blank">Download</a>';
                                        }elseif($aColumns[$i]== 'projectdate'){
                                             $row[] = date('d/m/Y',$rowArray[ $aColumns[$i] ]);
                                        }elseif($aColumns[$i]== 'mediumtype'){
                                            $mediumtype= \reportingtool\Models\Mediumtypes::findFirstByUid($rowArray[ $aColumns[$i] ]);
                                             $row[] = $mediumtype->title;
                                        }
                                        else{
                                            $row[] = $rowArray[ $aColumns[$i] ];
                                        }
					
				
			
					
			}
			$resultSet[] = $row;
		}
		
		/* Data set length after filtering */		
		
		$rResultFilterTotal = count($resultSet);
		
		/* Total data set length */
		$lphql = "SELECT COUNT(".$sIndexColumn.") AS countids FROM $sTable	".$sWhere;
		$lQuery=$this->modelsManager->createQuery($lphql);
		$rResultTotal = $lQuery->execute($bindArray);        
		foreach ( $rResultTotal as $aRow )
		{
				$iTotal = (array)$aRow;
		}
		$iTotal=$iTotal['countids'];
	//$GLOBALS['TYPO3_DB']->sql_fetch_assoc($rResultTotal);
		
		/*
		 * Output
		 */
		$output = array(
			"sEcho" => intval($_POST['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => $resultSet
		);
		
		
		
		
		
	return  $output;
        
    }
      
	
}