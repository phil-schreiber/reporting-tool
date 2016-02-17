<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Projects
 * 
 */
class Coordinations extends Model
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
        
                      
        /**
	 * @var string
	 */
	public $comments = '';
        
        /**
	 * @var integer
	 */
	public $usergroup = 0;
        
        
    
    public function initialize()
    {
        $this->hasManyToMany("uid", "reportingtool\Models\Coordinations_projects_lookup", "uid_local","uid_foreign","reportingtool\Models\Projects","uid",array('alias' => 'projects'));
		
    }
}