<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

use WP_REST_Request;
use Aleximxp\Autenticar\Autenticar;

class ValidarCodigoEnviado
{
    function validarCorreoConCodigo(WP_REST_Request $request)
    {
        $correo = $request['correo'];
        $codigoInsertado = $request['codigo'];
        global $wpdb;
        $tabla_usuarios = $wpdb->prefix . 'users';
        $nombre_campo = 'BajaCodSeguridad';

        // Verificar si el usuario ya existe
        $usuario_existente = get_user_by('email', $correo);
    
        if ($usuario_existente) {
            //Obtener Id de usuario
            $idUsuarioExistente = $usuario_existente -> ID;
            // Obtener el código almacenado en el campo BajaCodSeguridad
            $codigoAlmacenado = get_user_meta($user_id, 'BajaCodSeguridad', true);
        } 
            //Validar que existe y si existe que sea igual a BajaCodSeguridad
        if ($codigoAlmacenado && $codigoAlmacenado == $codigoInsertado) {
            // Si el código es válido envía código a Denisse
            enviarCorreoDenisse();
        } else {
            // Sino muestra mensaje de Código inválido
            echo 'Código ingresado es inválido, por favor llene nuevamente el formulario para que se le envíe el código';
        }
    } 


    function enviarCorreoDenisse($idUsuario)
    {
        global $wpdb;

        $userData = get_userdata($idUsuario);
        if($userData)
        {
            $userEmail = $userData-> user_email;
        }

        $correoAdmin = 'denisse.marquez@alexim.com';
        $correoDeveloper = 'alan.fermin@alexim.com';
        $correoDev = 'david.galvez@alexim.com';

        //Crear plantilla de correo:
        $to = [$correoAdmin, $correoDeveloper, $correoDev];
        $subject = 'Código de Validación para dar de baja al usuario: '.$userEmail;
        //Sustituir URL por el de producción
        $body = 'El usuario con el id: '.$idUsuario.' y el correo: '.$userEmail.' ha solicitado darse de baja' ;
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail( $to, $subject, $body, $headers );
    }
}

