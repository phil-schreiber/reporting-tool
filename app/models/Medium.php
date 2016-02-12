<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Medium
 * 
 */
class Medium extends Model
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
        
        /*
	 * @var string
	 */
        public $description = '';        
        
        /**
	 * @var integer
	 */
	public $reach = 0;
        
        /*
	 * @var string
	 */
        public $url = '';        
        
        /**
	 * @var integer
	 */
	public $mediumtype = 0;
        
        /*
	 * @var string
	 */
        public $icon = ''; 
    
    public function initialize()
    {
        
		
    }
}