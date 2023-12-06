<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Autenticar;

use \Aleximxp\Base\PluginController;

class Autenticar extends PluginController
{
    /**
     * Generar contraseña aleatoria de 6 digitos para validar
     */
    public function crearDobleAutenticacionElementorPro()
    {
        return wp_generate_password(6, false);
    }
}