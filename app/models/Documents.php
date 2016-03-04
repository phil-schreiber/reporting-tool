<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Documents
 * 
 */
class Documents extends Model
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
	public $doctype = 0;
        
        /*
	 * @var string
	 */
        public $filelink = '';        
        
       
        
    public function initialize()
    {
        $this->hasMany("uid", "reportingtool\Models\Documentversions", "pid",array('alias' => 'versions'));
       
        
        $this->belongsTo("pid", "reportingtool\Models\Projects", "uid", array('alias' => 'project'));
        
    }
}