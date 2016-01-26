<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model\Validator\Uniqueness as UniquenessValidator;
Model::setup(['notNullValidations' => false]);

/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Feusers extends \Phalcon\Mvc\Model{
	
	
	
		
    public function validation()
    {
        $this->validate(new EmailValidator(array(
            'field' => 'email'
        )));
		
        $this->validate(new UniquenessValidator(array(
            'field' => 'email',
            'message' => 'Sorry, The email was registered by another user'
        )));
        $this->validate(new UniquenessValidator(array(
            'field' => 'username',
            'message' => 'Sorry, That username is already taken'
        )));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
	
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

