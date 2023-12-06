<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

class CampoDB
{
    //Función que valida si existe el campo en la base de datos
    public static function agregarCampoBajaCodSeguridad()
    {
        global $wpdb;
        $tabla_usuarios = $wpdb->prefix . 'users';
        $nombre_campo = 'BajaCodSeguridad';

        // Verifica si el campo ya existe
        if ($wpdb->get_var("SHOW COLUMNS FROM $tabla_usuarios LIKE '$nombre_campo'") != $nombre_campo) {
            // Agrega el campo si no existe
            $wpdb->query("ALTER TABLE $tabla_usuarios ADD $nombre_campo VARCHAR(255) DEFAULT NULL");

            // Registro de un mensaje de log (puedes personalizar esto según tus necesidades)
            error_log('Campo BajaCodSeguridad agregado a la tabla de usuarios.');
        }
    }    

    public function registrar ()
    {
        this.agregarCampoBajaCodSeguridad();
    }
}