<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Clippings
 * 
 */
class Clippings extends Model
{
    public function initialize()
    {
        $this->hasOne('mediumuid', 'reportingtool\Models\Medium', 'uid', array(
            'alias' => 'type'
        ));
                
        
        $this->belongsTo("pid", "reportingtool\Models\Projects", "uid");
        
        $this->belongsTo("documentuid", "reportingtool\Models\Documents", "uid");
		
    }
}