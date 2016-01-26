<?php
namespace nltool\Models;

use Phalcon\Mvc\Model;

/**
 * nltool\Models\Profiles
 * All the profile levels in the application. Used in conjenction with ACL lists
 */
class Usergroups extends Model
{

  public function initialize(){
		$this->hasManyToMany("uid", "nltool\Models\Templateobjects_usergroups_lookup", "uid_foreign", "uid_local", "nltool\Models\Templateobjects", "uid",array('alias' => 'templateobjects'));
	}
}