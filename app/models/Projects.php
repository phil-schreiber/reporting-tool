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
	
	/*
	 * @var string
	 */
	public $title = '';
        
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
        
        $this->belongsTo("pid", "reportingtool\Models\Usergroups", "uid");
		
    }
}