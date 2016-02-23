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
    
     public  function countMediumtypeClippings($mediumtype){
        $config =  \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');
        $modelsManager=$this->getDi()->getShared('modelsManager');		
        $phql='SELECT COUNT(clippings.uid) as clippingscount FROM reportingtool\Models\Clippings as clippings LEFT JOIN reportingtool\Models\Medium as medium ON medium.uid=clippings.mediumuid WHERE medium.mediumtype = ?1';
        $sQuery=$modelsManager->createQuery($phql);
	$rResults = $sQuery->execute(array(            
            1 => $mediumtype
        ));
        
        return $rResults[0]->clippingscount;
    }
}