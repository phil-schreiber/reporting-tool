<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Budgets
 * 
 */
class Budgets_projecttypes_lookup extends Model
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
    public $uid_local = 0;

    /**
     * @var integer
     */
    public $uid_foreign = 0;

    /**
     * @var integer
     */
    public $amount = 0;

    
	
    public function initialize(){
		$this->belongsTo('uid_local', 'reportingtool\Models\Budgets', 'uid', 
            array('alias' => 'budgets')
        );
        $this->belongsTo('uid_foreign', 'reportingtool\Models\Projecttypes', 'uid', 
            array('alias' => 'projecttypes')
        );
    }
}