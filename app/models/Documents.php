<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;

/**
 * reportingtool\Models\Documents
 * 
 */
class Documents extends Model
{
    public function initialize()
    {
        $this->hasMany("uid", "reportingtool\Models\Documentversions", "pid",array('alias' => 'versions'));
        $this->hasMany("uid", "reportingtool\Models\Clippings", "documentuid",array('alias' => 'versions'));
        
        $this->belongsTo("pid", "reportingtool\Models\Projects", "uid", array('alias' => 'project'));
        
    }
}