<?php
namespace reportingtool\Models;
use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);

/**
 * Description of Addresses
 *
 * @author Philipp-PC
 */
class Addresses extends Model{
	public function initialize(){
		
		$this->belongsTo('pid', 'reportingtool\Models\Projects', 'uid', 
            array('alias' => 'projects')
        );
		
		$this->hasManyToMany("uid", "reportingtool\Models\Addresses_feuserscategories_lookup", "uid_local","uid_foreign","reportingtool\Models\Feuserscategories","uid",array('alias' => 'categories'));
	}
}