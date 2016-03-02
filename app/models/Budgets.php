<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);
/**
 * reportingtool\Models\Budgets
 * 
 */
class Budgets extends Model
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
	public $amount = 0;
    
        /**
	 * @var integer
	 */
	public $contractruntimeuid = 0;
    
    public function initialize()
    {
        $this->belongsTo('usergroup', 'reportingtool\Models\Usergroups', 'uid', array(
            'alias' => 'usergroup'
        ));
        
        $this->belongsTo('contractruntimeuid', 'reportingtool\Models\Contractruntime', 'uid', array(
            'alias' => 'contractruntime'
        ));
		
	$this->hasManyToMany("uid", "reportingtool\Models\Budgets_projecttypes_lookup", "uid_local","uid_foreign","reportingtool\Models\Projecttypes","uid",array('alias' => 'projecttypes'));
        $this->hasMany("uid", "reportingtool\Models\Budgets_projecttypes_lookup", "uid_local",array('alias' => 'budgetcount'));
    }
    
    
}