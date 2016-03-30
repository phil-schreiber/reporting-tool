<?php
namespace reportingtool\Models;

use Phalcon\Mvc\Model;
Model::setup(['notNullValidations' => false]);
/**
 * reportingtool\Models\Clippings
 * 
 */
class Clippings extends Model
{
    
     /**
     * @var integer
     */
    public $uid;

    /**
     * @var integer
     */
    public $pid = 0;

    /**
     * @var integer
     */
    public $tstamp = 0;
	
	/**
	 * @var integer
	 */
	public $crdate = 0;
	
	/**
	 * @var integer
	 */
	public $cruser_id = 0;
	
	/**
	 * @var integer
	 */
	public $deleted = 0;
        
        /**
	 * @var integer
	 */
	public $usergroup = 0;
	
	/**
	 * @var integer
	 */
	public $hidden = 0;
	
	/*
	 * @var string
	 */
	public $title = '';
        
        /*
	 * @var string
	 */
        public $description = '';        
        
        /**
	 * @var integer
	 */
	public $documentuid = 0;
        
        /**
	 * @var integer
	 */
	public $clippingtype = 0;
        
        /**
	 * @var integer
	 */
	public $mediumuid = 0;
        
        /*
	 * @var string
	 */
        public $url = '';        
        
        /*
	 * @var string
	 */
        public $filelink = '';        
        
        /**
	 * @var integer
	 */
	public $doctype = 0;
        
        
    public function initialize()
    {
        $this->hasOne('mediumuid', 'reportingtool\Models\Medium', 'uid', array(
            'alias' => 'type'
        ));
                
        
        $this->belongsTo("pid", "reportingtool\Models\Projects", "uid", array(
            'alias' => 'project'
        ));
        
        $this->belongsTo("documentuid", "reportingtool\Models\Documents", "uid");
		
    }
    
     public  function countMediumtypeClippings($mediumtype){
        $config =  \Phalcon\DI\FactoryDefault::getDefault()->getShared('config');
        $modelsManager=$this->getDi()->getShared('modelsManager');		
        $phql='SELECT COUNT(clippings.uid) as clippingscount, SUM(medium.reach) as mediumreach FROM reportingtool\Models\Clippings as clippings LEFT JOIN reportingtool\Models\Medium as medium ON medium.uid=clippings.mediumuid WHERE medium.mediumtype = ?1';
        $sQuery=$modelsManager->createQuery($phql);
	$rResults = $sQuery->execute(array(            
            1 => $mediumtype
        ));
        
        return $rResults[0];
    }
}