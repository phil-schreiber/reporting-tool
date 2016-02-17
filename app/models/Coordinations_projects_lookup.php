<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Budgets
 * 
 */
class Coordinations_projects_lookup extends Model
{
    
     /**
     * @var integer
     */
    public $uid;

    	    

    /**
     * @var integer
     */
    public $uid_local = 0;

    /**
     * @var integer
     */
    public $uid_foreign = 0;

   
    
	
    public function initialize(){
	$this->belongsTo('uid_local', 'reportingtool\Models\Coordinations', 'uid', 
            array('alias' => 'coordinations')
        );
        $this->belongsTo('uid_foreign', 'reportingtool\Models\Projects', 'uid', 
            array('alias' => 'projects')
        );
                 
    }
}