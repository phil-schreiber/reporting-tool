<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Documentversions
 * 
 */
class Documentversions extends Model
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
        public $filelink = '';     
    public function initialize()
    {
        $this->belongsTo("pid", "reportingtool\Models\Documents", "uid", array('alias' => 'document'));
		//$this->hasMany("uid", "reportingtool\Models\Notes", "pid",array('alias' => 'notes','params'=> array('conditions'=>'notetype=1')));
    }
}