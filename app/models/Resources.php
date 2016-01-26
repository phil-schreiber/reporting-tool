<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * Permissions
 * Stores the permissions by profile
 */
class Resources extends Model
{

    /**
     *
     * @var integer
     */
    public $uid;

    /**
     *
     * @var integer
     */
    public $pid;
	
	/**
     *
     * @var integer
     */
    public $deleted;
	
	/**
     *
     * @var integer
     */
    public $hidden;
	
	/**
     *
     * @var integer
     */
    public $crdate;
	
	/**
     *
     * @var integer
     */
    public $tstamp;
	
	/**
     *
     * @var integer
     */
    public $cruser_id;
	
	
	
    /**
     *
     * @var string
     */
    public $title;

    

    public function initialize()
    {
        $this->belongsTo('uid', 'reportingtool\Models\Permissions', 'resourceid', array(
            'alias' => 'permission'
        ));
		
		
    }
}