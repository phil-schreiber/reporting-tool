<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);

/**
 * nltool\Models\Usergroups
 * All the profile levels in the application. Used in conjenction with ACL lists
 */
class Usergroups extends Model
{

  public function initialize(){
	$this->hasMany("uid", "reportingtool\Models\Projects", "pid",array('alias' => 'projects'));
        $this->hasMany("uid", "reportingtool\Models\Contractruntime", "usergroup",array('alias' => 'contractruntime'));
    }
}