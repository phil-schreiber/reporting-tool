<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Documentversions
 * 
 */
class Documentversions extends Model
{
    public function initialize()
    {
        
		$this->hasMany("uid", "reportingtool\Models\Notes", "pid",array('alias' => 'notes','params'=> array('conditions'=>'notetype=1')));
    }
}