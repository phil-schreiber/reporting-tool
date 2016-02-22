<?php
namespace reportingtool\Modules\Modules\Frontend\Controllers;
use reportingtool\Models\Projects,
    reportingtool\Models\Projecttypes,
    reportingtool\Models\Projectstates;
	

/**
 * Class ProjectsController
 *
 * @package reporting-tool\Controllers
 */
class ProjectsController extends ControllerBase
{
	public function indexAction(){
		if($this->request->isPost() && !$this->request->getQuery('statusinfo' )){
                    $result=$this->getData();
                    $output=json_encode($result,true);			
                    die($output);
                }elseif($this->request->isPost() && $this->request->getQuery('statusinfo' )==1){
                    $result=$this->getStatusInfo();
                    $output=json_encode($result,true);			
                    die($output);
                }
                
                
                    $projects = Projects::find(array(
                            "conditions" => "deleted=0 AND hidden=0 AND usergroup = ?1 AND status < ?2",
                            "bind" => array(1 => $this->session->get('auth')['usergroup'],2 => 4),
                            "order" => "crdate DESC"
                    ));
                   $topics=array();
                    foreach($projects as $project){
                        $topics[]=$project->topic;
                    }
                    $topics=array_unique($topics);
                    $preselect=false;
                    if($this->request->getQuery('projecttype' )>0){
                        $preselect=true;
                        
                    }
                    $this->view->setVar('preselected',$this->request->getQuery('projecttype' ));
                    $this->view->setVar('path',$this->path);
                    $this->view->setVar('projects',$projects);
                    $this->view->setVar('topics',$topics);
                    
		
	}
        
        public function updateAction(){
            if($this->request->isPost()){
                $result=$this->getClippingData();
                $output=json_encode($result,true);			
                die($output);
            }else{
                $projectUid=$this->dispatcher->getParam("uid")?$this->dispatcher->getParam("uid"):0;            
                $project=Projects::findFirstByUid($projectUid);
                $projecttypes=Projecttypes::find(array(
                   'conditions' => 'deleted=0 AND hidden=0'
                ));
                $ptypesArr=array();
                foreach($projecttypes as $projecttype){
                    $ptypesArr[$projecttype->uid]=$projecttype->title;
                }
                $this->view->setVar('project',$project);
                $this->view->setVar('projecttypes',$ptypesArr);
                $this->view->setVar('projectstate',array('in Vorbereitung','in Abstimmung','live','abgeschlossen'));
            }
            
            
        }
        
        private function getStatusInfo(){
            $projectuid=$this->request->getPost('projectid');
            $projectstates=  Projectstates::find(array(
               'conditions' => 'deleted=0 AND hidden = 0 AND pid =?1',
                'bind' => array(
                    1 => $projectuid
                ),
                'order' => "active DESC,tstamp DESC"
            ));
            $stateArray=array();
            $counter=0;
            $stateMap=array($this->translate('inpreparation'),$this->translate('incoordination'),$this->translate('live'),$this->translate('completed'));                
                
            foreach($projectstates as $projectstate){
                
                $stateArray[]=array(
                  'type'  => 'smallItem',
                  'label' => date('d.m.Y H:i',$projectstate->tstamp),
                  'shortContent' =>$counter==0 ? '<b>aktueller Status</b>:<br> '.$stateMap[$projectstate->statetype] : $stateMap[$projectstate->statetype],
                  'fullContent' => $projectstate->description,
                  'showMore' =>'>> mehr',
                  'showLess' =>'<< ausblenden'
                );
                $counter++;
            }
            return $stateArray;
        }
        
         private function getData(){
		$bindArray=array();
		$aColumns=array('projectttitle','starttime','projecttstamp','topic','typetitle','estcost','statetype','active','statedescription','statetstamp');
        
        $aColumnsSelect=array('clippingtype','filelink');
        $aColumnsFilter=array('projects.title','medium.title','clipping.title');
		$time=time();
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "projects.uid";

		/* DB table to use */
		$sTable = "reportingtool\Models\Projects as projects LEFT JOIN reportingtool\Models\Projecttypes as projecttype ON projecttype.uid = projects.projecttype LEFT JOIN reportingtool\Models\Projectstates as states ON states.pid=projects.uid";
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
			

		$sWhere = "WHERE projects.deleted=0 AND projects.hidden =0 AND projects.usergroup = :usergroup: ";
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
		$phql = "SELECT projects.uid AS projectid,projects.title AS projectttitle,projects.starttime AS starttime, projects.tstamp AS projecttstamp, topic, projecttype.title AS typetitle, estcost,statetype, active, states.description AS statedescription, states.tstamp AS statetstamp FROM $sTable ".$sWhere." ".$sOrder." ".$sLimit;
		
		
		
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
                                        
                                        if( $aColumns[$i] == 'starttime'){
                                            $row[] = date('d/m/Y',$rowArray[ $aColumns[$i] ]);
                                        }elseif($aColumns[$i] == 'projecttstamp'){
                                              $row[] = date('d/m/Y H:i',$rowArray[ $aColumns[$i] ]);
                                        }elseif($aColumns[$i] == 'statetype'){
                                            $row[]='<button class="statehistory" value="'.$rowArray['projectid'].'" data-toggle="modal" data-target="#myModal">Status</button>';
                                        }elseif($aColumns[$i]== 'projectdate'){
                                             $row[] = date('d/m/Y',$rowArray[ $aColumns[$i] ]);
                                        }
                                        else{
                                            
                                            $row[] = $rowArray[ $aColumns[$i] ];
                                        }
					
				
			
					
			}
			$resultSet[$rowArray['projectid']] = $row;
		}
		$cleanResults=array_values($resultSet);
		/* Data set length after filtering */		
		
		$rResultFilterTotal = count($cleanResults);
		
		/* Total data set length */
		$lphql = "SELECT COUNT(".$sIndexColumn.") AS countids FROM $sTable	".$sWhere." GROUP BY projects.uid";
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
			"aaData" => $cleanResults
		);
		
		
		
		
		
	return  $output;
        
    }
        
        private function getClippingData(){
		$bindArray=array();
		$aColumns=array('publicationdate','mediumtitle','clippingtitle','clippingtype','filelink','clippingurl');
        
        $aColumnsSelect=array('clippingtype','filelink');
        $aColumnsFilter=array('clippingtype','filelink');
		$time=time();
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "clipping.uid";

		/* DB table to use */
		$sTable = "reportingtool\Models\Clippings as clipping LEFT JOIN reportingtool\Models\Medium as medium ON clipping.mediumuid = medium.uid";
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
			

		$sWhere = "WHERE clipping.deleted=0 AND clipping.hidden=0 AND clipping.pid = :pid: AND clipping.usergroup = :usergroup: ";
		if ( isset($_POST['sSearch']) && $_POST['sSearch'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "".$aColumnsFilter[$i]." LIKE :searchTerm: OR "; //$_POST['sSearch']
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_POST['bSearchable_'.$i]) && $_POST['bSearchable_'.$i] == "true" && $_POST['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}

				$sWhere .= "".$aColumnsFilter[$i]." LIKE '%:".$aColumnsFilter[$i].'_'.$i."%' "; //$_POST['sSearch_'.$i]
				$bindArray[$aColumnsFilter[$i].'_'.$i]=$this->request->getPost('sSearch_'.$i);
			}
		}

		
		

		/*
		 * SQL queries
		 * Get data to display
		 */
		$phql = "SELECT ".str_replace(" , ", " ", implode(", ", $aColumnsSelect)).", clipping.uid as clippinguid, medium.title AS mediumtitle,clipping.tstamp as publicationdate, clipping.title AS clippingtitle, clipping.url as clippingurl FROM $sTable ".$sWhere." ".$sOrder." ".$sLimit;
		
		
		
		$bindArray['pid']=$this->request->getPost('projectuid');
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
                                            $row[]='<a href="'.$this->baseUri.$rowArray[ $aColumns[$i] ].'" target="_blank">Download</a>';
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