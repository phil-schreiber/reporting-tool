<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Budgets
 * 
 */
class Budgets extends Model
{
    public function initialize()
    {
        $this->belongsTo('uid', 'reportingtool\Models\Usergroups', 'resourceid', array(
            'alias' => 'usergroup'
        ));
		
	$this->hasManyToMany();
    }
}