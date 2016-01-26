<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Profiles
 * All the profile levels in the application. Used in conjenction with ACL lists
 */
class Profiles extends Model
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

    

    /**
     * Define relationships to Users and Permissions
     */
    public function initialize()
    {
        $this->hasMany('uid', 'reportingtool\Models\Feusers', 'profileid', array(
            'alias' => 'feusers',
            'foreignKey' => array(
                'message' => 'Profile cannot be deleted because it\'s used on Users'
            )
        ));

        $this->hasMany('uid', 'reportingtool\Models\Permissions', 'profileid', array(
            'alias' => 'permissions'
        ));
    }
}