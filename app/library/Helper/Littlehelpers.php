<?php
namespace reportingtool\Helper;
use Phalcon\Mvc\User\Component;


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
}                