<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);
/**
 * reportingtool\Models\Clippings
 * 
 */
class Clippingsoverview extends Model
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
	public $overviewyear = 0;
        
        /**
	 * @var integer
	 */
	public $overviewmonth = 0;
    
        /**
	 * @var integer
	 */
	public $title = '';
        
        /**
	 * @var integer
	 */
	public $filelink = '';
    public function initialize()
    {
       
       
		
    }
}