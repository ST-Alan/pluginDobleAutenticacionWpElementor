<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

class Deactivate{

    /**
     * Desactiva el plugin y remueve las configuraciones creadas
     */
    public static function deactivate() 
    {
        flush_rewrite_rules();
    }
}