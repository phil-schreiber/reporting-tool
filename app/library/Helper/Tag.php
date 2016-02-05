<?php
namespace reportingtool\Helper;

class Tag extends \Phalcon\Tag
{
    static public function roundTwo($input)
    {
       
        return round($input, 2);
    }
    
    static public function arrayKeyExists($key,$array)
    {
       
        return array_key_exists($key, $array);
    }
}