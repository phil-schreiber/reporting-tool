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
		
	$this->hasManyToMany("uid", "nltool\Models\Segmentobjects_addresses_lookup", "uid_foreign","uid_local","nltool\Models\Segmentobjects","uid",array('alias' => 'segments'));
        $this->hasMany("uid", "nltool\Models\Sendoutobjects", "campaignuid",array('alias' => 'sendoutobjects'));
    }
}