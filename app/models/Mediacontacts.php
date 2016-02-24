<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Projects
 * 
 */
class Mediacontacts extends Model
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
	
        /**
	 * @var integer
	 */
	public $medium = 0;
        
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
        
       
    
    public function initialize()
    {
       
        
        $this->belongsTo("pid", "reportingtool\Models\Usergroups", "uid");
        $this->hasOne('medium', 'reportingtool\Models\Medium', 'uid', array(
            'alias' => 'medium'
        ));
    }
    
        
}