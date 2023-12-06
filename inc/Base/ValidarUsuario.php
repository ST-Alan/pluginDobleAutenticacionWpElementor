<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

use WP_REST_Request;
use Aleximxp\Autenticar\Autenticar;

class ValidarUsuario
{
    private $autenticar;
    private $password;

    function validarCrearUsuarioPorCorreo(WP_REST_Request $request)
    {
        $correo = $request['correo'];
        $nombre = $request['nombre'];
        global $wpdb;
        $tabla_usuarios = $wpdb->prefix . 'users';
        $nombre_campo = 'BajaCodSeguridad';
        // Verificar si el usuario ya existe
        $usuario_existente = get_user_by('email', $correo);

        if ($usuario_existente instanceof WP_User) {
            $this->insertarCodigoUsuario($usuario_existente->ID);
            return ['ok' => 1];
        // if ($usuario_existente) {

        //     $this->insertarCodigoUsuario($usuario_existente->ID);
        //     return ['ok'=> 1];
        } else {
            // El usuario no existe, crearlo
            $nuevo_usuario = wp_insert_user(array(
                'user_login' => $correo,
                'user_email' => $correo,
                'user_pass'  => wp_generate_password(), // Puedes personalizar esto según tus necesidades
            ));
    
            if (!is_wp_error($nuevo_usuario)) {
                // Usuario creado con éxito, devolver su ID
                $this->insertarCodigoUsuario($nuevo_usuario->ID);
                return ['ok'=> 1];
            } 
            // else {
            //     // Hubo un error al crear el usuario, devolver el objeto WP_Error
            //     return ['ok'=> 0];
            // }


            if ( is_wp_error( $nuevo_usuario ) ) 
            {    
                return ['ok'=> 0,'error'=>$nuevo_usuario->get_error_message()];
                // echo $nuevo_usuario->get_error_message();
            }

        }
    }

    function insertarCodigoUsuario($idUsuario)
    {
        global $wpdb;
        $tabla_usuarios = $wpdb->prefix . 'users';
        $nombre_campo = 'BajaCodSeguridad';


        $this->autenticar = new Autenticar();
        $this->password = $this->autenticar->crearDobleAutenticacionElementorPro();
        var_dump($this->password);
            
        // $wpdb->query("UPDATE $tabla_usuarios SET $nombre_campo = $this->password WHERE ID=$idUsuario");
        $wpdb->query($wpdb->prepare("UPDATE $tabla_usuarios SET $nombre_campo = %s WHERE ID = %d", $this->password, $idUsuario));

    }

    function enviarCorreoCodigoUsuario($idUsuario)
    {
        global $wpdb;

        $userData = get_userdata($idUsuario);

        if($userData)
        {
            $userEmail = $userData-> user_email;
        }

        //Crear plantilla de correo:
        $to = $userEmail;
        $subject = 'Código de Validación para dar de baja tu usuario';
        //Sustituir URL por el de producción
        $body = 'Tu código de validación para darte de baja en AleximExpress es: '.$this->password. '<a href="https://dev.aleximexpress.com/validar-codigo-para-dar-de-baja-usuario/" target="blank"> Copia y pega este link para que valides tu código:</a> https://dev.aleximexpress.com/validar-codigo-para-dar-de-baja-usuario/';
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail( $to, $subject, $body, $headers );


    }

}
