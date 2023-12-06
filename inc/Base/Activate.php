<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

class Activate{

    public static function activate() 
    {    
        flush_rewrite_rules();     
    }
}
