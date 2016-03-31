<?php
namespace reportingtool\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use reportingtool\Modules\Modules\Frontend\Controllers\ControllerBase as ControllerBase;
use reportingtool\Models\Profiles;
use reportingtool\Models\Usergroups;
use reportingtool\Models\Languages;


class FeusersForm extends Form
{

    public function initialize($entity = null, $options = null)
    {

        // In edition the id is hidden
        if (isset($options['edit']) && $options['edit']) {
            $uid = new Hidden('uid');
        } else {
            $uid = new Text('uid');
        }

        $this->add($uid);

        $username = new Text('username', array(
            
        ));

        $username->addValidators(array(
            new PresenceOf(array(
                'message' => 'The name is required'
            ))
        ));

        $this->add($username);

        $password = new Password('password', array(
            
        ));

        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Password is required'
            ))
        ));

        $this->add($password);
		
		$last_name = new Text('last_name', array(
            
        ));

        $last_name->addValidators(array(
            new PresenceOf(array(
                'message' => 'The lastname is required'
            ))
        ));

        $this->add($last_name);
		
		 $first_name = new Text('first_name', array(
            
        ));

        $first_name->addValidators(array(
            new PresenceOf(array(
                'message' => 'The firstname is required'
            ))
            
        ));

        $this->add($first_name);
		
		$title = new Text('title', array(
            
        ));

        $title->addValidators(array(
            new PresenceOf(array(
                'message' => 'The title is required'
            ))
        ));

        $this->add($title);
		
		 $email = new Text('email', array(
            
        ));

        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'The email is required'
            )),
            new Email(array(
                'message' => 'The email is not valid'
            ))
        ));

        $this->add($email);

		$phone = new Text('phone', array(
            
        ));

        

        $this->add($phone);
		
		$address = new Text('address', array(            
        ));        
        $this->add($address);
		
		$city = new Text('city', array(            
        ));        
        $this->add($city);
		
		$zip = new Text('zip', array(            
        ));        
        $this->add($zip);
		
		$company = new Text('company', array(            
        ));        
        $this->add($company);
		
		$this->add(new Select("profileuid", Profiles::find(array('conditions'=>'deleted=0 AND hidden=0')), array(
            'using' => array('uid', 'title')
        )));
		

        $this->add(new Select("usergroup", Usergroups::find(array('conditions'=>'deleted=0 AND hidden=0')), array(
            'using' => array('uid', 'title')
        )));
		
		$this->add(new Select("userlanguage", Languages::find(array('conditions'=>'deleted=0 AND hidden=0')), array(
            'using' => array('uid', 'title')
        )));
		
		$this->add(new Select('superuser', array(
			'0' => ControllerBase::translate('no'),
            '1' => ControllerBase::translate('yes')			
        )));

        

        
    }
}