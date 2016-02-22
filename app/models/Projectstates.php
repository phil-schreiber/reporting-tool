<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);
/**
 * reportingtool\Models\Projecttypes
 * 
 */
class Projectstates extends Model
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
        public $description = '';        
        
        /**
	 * @var integer
	 */
	public $statetype = 0;
        
        /**
	 * @var integer
	 */
	public $active = 0;
    
    public function initialize()
    {
        $this->belongsTo("pid", "reportingtool\Models\Projects", "uid");
		
		
    }
}