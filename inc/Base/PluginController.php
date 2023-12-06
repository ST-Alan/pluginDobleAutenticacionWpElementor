<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

class PluginController{

    protected $plugin;
    protected $pluginPath;
    protected $pluginUrl;


    /**
     * Controla las variables globales del plugin
     * @param string $plugin nombre único de la ruta del plugin
     */
    public function __construct(string $plugin)
    {
        
        $this->plugin=$plugin;        
        $this->pluginPath=plugin_dir_path(dirname( __FILE__, 2 ) );
        $this->pluginUrl=plugin_dir_url( dirname( __FILE__, 2 ) );
    }
}