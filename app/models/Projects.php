<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Projects
 * 
 */
class Projects extends Model
{
    public function initialize()
    {
        $this->hasOne('projecttype', 'reportingtool\Models\Projecttypes', 'uid', array(
            'alias' => 'type'
        ));		
		
    }
}