<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;

Model::setup(['notNullValidations' => false]);

/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Feusers extends \Phalcon\Mvc\Model{
	
	
	
		
    
	
	public function initialize(){
		$this->hasOne('profileid', 'reportingtool\Models\Profiles', 'uid', array(
            'alias' => 'profile'
        ));
		$this->hasOne('usergroup', 'reportingtool\Models\Usergroups', 'uid', array(
            'alias' => 'usergroup'
        ));
		$this->hasOne('userlanguage','reportingtool\Models\Languages','uid',array(
			'alias'=>'userlanguage'
		));
		$this->hasMany("uid", "reportingtool\Models\Review", "cruser_id",array('alias' => 'reviews'));
		
		
	}
}

