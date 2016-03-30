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
        $dateDataArr=explode('.',$dateArr[0]);
        $senddate=mktime($dateTimeArr[0],$dateTimeArr[1],0,$dateDataArr[1],$dateDataArr[0],$dateDataArr[2]);
     }
     return $senddate;
 }
 
 public function getCurrentYear(){
    $currentyear=date('Y');
    $starttstamp=mktime(0,0,0,1,1 ,$currentyear);
    $endtstamp=$starttstamp+(365*24*60*60);
    return array($starttstamp,$endtstamp);
 }
 
 public function processDateOnly($rawdate){
     
       
        $dateDataArr=explode('.',$rawdate);
        if(count($dateDataArr)==3){
        $senddate=mktime(0,0,0,$dateDataArr[1],$dateDataArr[0],$dateDataArr[2]);
        }else{
            $senddate=0;
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
						$imageS->resize(300,1000);
						$imageS->save($thumbFilenameS);
						$imageL = new GDAdapter($tmpFile);
						$imageL->resize(600,1000);
						$imageL->save($thumbFilenameL);
                      
						 unlink($tmpFile);
              }
     return $saveFilename;
 }
 
 private function sonderzeichen($string)
{
$search = array("Ä", "Ö", "Ü", "ä", "ö", "ü", "ß", "´");
$replace = array("Ae", "Oe", "Ue", "ae", "oe", "ue", "ss", "");
return str_replace($search, $replace, $string);
}
public function saveFile($filearray,$time,$usergroup){
            
            $saveFilename='';
            $filepath='../public/media/clippings/'.$usergroup->title;
            
            if(!is_dir($filepath)){
                mkdir($filepath);
            }
                foreach ($filearray as $file){
                    $nameArray=explode('.',$this->sonderzeichen($file->getName()));
                    $filetype=array_pop($nameArray);
                    
                    $saveFilename=$filepath.'/'.  str_replace(' ','_',implode('.',$nameArray)).'_'.$time.'.'.$filetype;                    
                    $file->moveTo($saveFilename);
                }
            return substr($saveFilename,2);
        }
 
}                