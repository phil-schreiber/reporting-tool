<?php
namespace reportingtool\Helper;

class Tag extends \Phalcon\Tag
{
    static public function roundTwo($input)
    {
       
        return round($input, 2);
    }
}