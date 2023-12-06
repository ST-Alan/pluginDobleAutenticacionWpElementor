<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;

use Aleximxp\Base\ValidarUsuario;
use Aleximxp\Base\ValidarCodigoEnviado;


class ApiEndpoints extends PluginController
{
    private $apiRoutes;
    private $validarUsuario;
    private $validarCodigoEnviado;


    public function registrar()
    {
        //Setea la ruta
       $this->setApiRoutes();
       //Registra la ruta
        add_action( 'rest_api_init', array($this,'registerApiRoutes'));
    }


    private function setApiRoutes()
    {
        $this->validarUsuario = new ValidarUsuario();
        $this->validarCodigoEnviado = new ValidarCodigoEnviado();
        $this->apiRoutes=array
        (
            array
            (//Validacion si existe usuario                   
                "nameSpace" => 'bajaUsuario/v1',
                "route"=>'/validarUsuario',
                "args" =>array
                    (
                    'methods' => 'POST',
                    'callback' => array($this->validarUsuario,'validarCrearUsuarioPorCorreo')
                    )
            ),
            array
            (//Validacion si existe usuario
                "nameSpace" => 'bajaUsuario/v1',                   
                "route"=>'/validarCodigoEnviado',
                "args" =>array
                    (
                    'methods' => 'POST',
                    'callback' => array($this->validarCodigoEnviado,'validarCorreoConCodigo')
                    )
            ),                     
        );
    }


    public function registerApiRoutes()
    {
        foreach($this->apiRoutes as $route)
        {
               register_rest_route($route["nameSpace"], $route["route"], $route["args"]);
        } 
    }
    


}