<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;


/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Failedlogins extends \Phalcon\Mvc\Model{
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
	public $userid = 0;
        
        /**
	 * @var string
	 */
	public $ipaddress = ' ';
        
        /**
	 * @var integer
	 */
	public $attempted = 0;
        
        /**
	 * @var string
	 */
	public $useragent = ' ';
}

