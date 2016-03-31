<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Projects
 * 
 */
class Projects extends Model
{
    /**
     * @var integer
     */
    public $uid;

    /**
     * @var integer
     */
    public $pid = 0;

    /**
     * @var integer
     */
    public $tstamp = 0;
	
	/**
	 * @var integer
	 */
	public $crdate = 0;
	
	/**
	 * @var integer
	 */
	public $cruser_id = 0;
	
	/**
	 * @var integer
	 */
	public $deleted = 0;
	
	/**
	 * @var integer
	 */
	public $hidden = 0;
        
        /**
	 * @var integer
	 */
	public $usergroup = 0;
	
	/*
	 * @var string
	 */
	public $title = '';
        
        /*
	 * @var string
	 */
        public $description = '';   
        
        /**
	 * @var integer
	 */
	public $starttime = 0;
	
	/**
	 * @var integer
	 */
	public $endtime = 0;
        
        /**
	 * @var integer
	 */
	public $status = 0;
	
	/**
	 * @var integer
	 */
	public $deadline = 0;
        
        /**
	 * @var integer
	 */
	public $projecttype = 0;
        
        /**
	 * @var string
	 */
	public $topic = '';
        
        /**
	 * @var integer
	 */
	public $estcost = 0;
        
        /**
	 * @var integer
	 */
	public $currentcost = 0;
    
    public function initialize()
    {
        $this->hasOne('projecttype', 'reportingtool\Models\Projecttypes', 'uid', array(
            'alias' => 'type'
        ));		
        
        $this->hasMany("uid", "reportingtool\Models\Clippings", "pid",array('alias' => 'clippings'));
        
        $this->hasMany("uid", "reportingtool\Models\Documents", "pid",array('alias' => 'documents'));
        $this->hasMany("uid", "reportingtool\Models\Notes", "pid",array('alias' => 'notes','params'=> array('conditions'=>'notetype=0')));
        
        $this->belongsTo("usergroup", "reportingtool\Models\Usergroups", "uid",array('alias' => 'usergroup'));
        $this->hasMany("uid", "reportingtool\Models\Projectstates", "pid",array('alias' => 'projectstates'));
    }
    public function getProjectstate(){
        $projectstate=  $this->getProjectstates(array(
            'conditions' => "deleted = 0 AND hidden =0 AND active =1"
        ));
        
        return $projectstate->getFirst();
    }
    public function countMediumtypeClippings($mediumtype){
        $config =  \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');
        $modelsManager=$this->getDi()->getShared('modelsManager');	
        $phql='SELECT COUNT(clippings.uid) as clippingscount FROM reportingtool\Models\Clippings as clippings LEFT JOIN reportingtool\Models\Medium as medium ON medium.uid=clippings.mediumuid WHERE clippings.pid = ?1 AND medium.mediumtype = ?2';
        $sQuery=$modelsManager->createQuery($phql);
	$rResults = $sQuery->execute(array(
            1 => $this->uid,
            2 => $mediumtype
        ));
        
        return $rResults[0]->clippingscount;
    }
}