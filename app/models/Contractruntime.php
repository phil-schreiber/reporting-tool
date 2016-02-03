<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Contractruntime
 * 
 */
class Contractruntime extends Model
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
	public $active = 0;
        
        /**
	 * @var integer
	 */
	public $startdate = 0;
	
	/**
	 * @var integer
	 */
	public $enddate = 0;
                
    
    public function initialize()
    {
       
		
	//$this->hasManyToMany("uid", "reportingtool\Models\Contractruntime_usergroups_lookup", "uid_local","uid_foreign","reportingtool\Models\Usergroups","uid",array('alias' => 'usergroups'));
        $this->belongsTo('usergroup', 'reportingtool\Models\Usergroups', 'uid', array(
            'alias' => 'usergroup'
        ));
        
        $this->hasOne('uid','reportingtool\Models\Budgets','contractruntimeuid', array('alias'=>'budget'));
    }
    
    
}