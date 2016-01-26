<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);

/**
 * Description of fe_users
 *
 * @author Philipp Schreiber
 */
class Feuserscategories extends \Phalcon\Mvc\Model{
	
	 public function initialize()
    {		      
	  $this->hasManyToMany("uid", "reportingtool\Models\Addresses_feuserscategories_lookup", "uid_foreign","uid_local","reportingtool\Models\Addresses","uid",array('alias' => 'addresses'));
    }

}
