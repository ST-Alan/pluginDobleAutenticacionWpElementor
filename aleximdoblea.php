<?php
/**
 * @package Aleximxp
 */

 
/*
Plugin Name: AleximExpress Doble Autenticación
Plugin URI: https://github.com/ST-Alan/pluginDobleAutenticacionWpElementor
Description: Autenticar usuario antes de pedir su baja en el sistema
Version: 1.0.16
Author: Alan Fermin | David Gálvez
Author URI: https://alanfermin.com
License: GPL3 or later
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: aleximxp
*/

defined('ABSPATH') or die("Acceso restringido");

if(file_exists(dirname(__FILE__)."/vendor/autoload.php"))
{
  require_once(dirname(__FILE__)."/vendor/autoload.php");
}
else 
{
	echo '-----------------------------------error al cargar autoload---------------------------------------------------------------------';
}
use Aleximxp\Base\Activate;
// use Aleximxp\Base\PluginController;


/**
 * Metodo que se ejecuta en la activación del plugin
 */
function activar_Aleximxp_plugin() {
	Activate::activate();
}

/**
 * Metodo que se ejecuta en la desactivación del plugin
 */
function desactivar_Aleximxp_plugin() {
	Aleximxp\Base\Deactivate::deactivate();
}

register_activation_hook( __FILE__, 'activar_Aleximxp_plugin' );
register_deactivation_hook( __FILE__, 'desactivar_Aleximxp_plugin' );

/**
 * Inicializo las clases core del plugin
 */

if ( class_exists( 'Aleximxp\Init' ) ) {
 
 // $control= new PluginController(__FILE__);
  
	Aleximxp\Init::registrar_servicios(plugin_basename(__FILE__));
}else{
  echo "-------------------------->Alexim express--------------------";
}