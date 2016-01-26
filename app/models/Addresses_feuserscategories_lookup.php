<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);

/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Addresses_feuserscategories_lookup extends \Phalcon\Mvc\Model{
	
	public function initialize(){		
        $this->belongsTo('uid_local', 'reportingtool\Models\Addresses', 'uid', 
            array('alias' => 'feusers')
        );
		
		$this->belongsTo('uid_foreign', 'reportingtool\Models\Feuserscategories', 'uid', 
            array('alias' => 'categories')
        );
	}

}
