<?php
namespace reportingtool\Helper;
use Phalcon\Mvc\User\Component,
        Phalcon\Image,
	Phalcon\Image\Adapter\GD as GDAdapter;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mailrenderhelpers
 *
 * @author Philipp-PC
 */
class Littlehelpers extends Component{

 public function processDate($rawdate){
     $dateArr=explode(' ',$rawdate);
     $senddate=0;
     if(count($dateArr)>1){
        $dateTimeArr=explode(':',$dateArr[1]);
        $dateDataArr=explode('/',$dateArr[0]);
        $senddate=mktime($dateTimeArr[0],$dateTimeArr[1],0,$dateDataArr[1],$dateDataArr[2],$dateDataArr[0]);
     }
     return $senddate;
 }
 
 public function saveImages($filearray,$controllername,$uid){
     $time=time();
     $saveFilename='';
     foreach ($filearray as $file){
						$nameArray=explode('.',$file->getName());
						$filetype=$nameArray[(count($nameArray)-1)];
						$tmpFile='../app/cache/tmp/'.$time.'_'.$file->getName();
						$file->moveTo($tmpFile);
						
						$thumbFilenameS='../public/media/'.$controllername.'_'.$uid.'_S.'.$filetype;
						$thumbFilenameL='../public/media/'.$controllername.'_'.$uid.'_L.'.$filetype;
						$saveFilename='public/media/'.$controllername.'_'.$uid.'_L.'.$filetype;
						
						$imageS = new GDAdapter($tmpFile);
						$imageS->resize(300,10000);
						$imageS->save($thumbFilenameS);
						$imageL = new GDAdapter($tmpFile);
						$imageL->resize(600,10000);
						$imageL->save($thumbFilenameL);
                      
						 unlink($tmpFile);
              }
     return $saveFilename;
 }
 
}                