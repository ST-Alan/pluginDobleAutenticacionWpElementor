<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp;

final class Init{
    
    /**
     * Almacena las clases en un array
     * @return array array de clases almacenadas
     */
    public static function obtener_servicios()
    {
        return [           
            Base\Enqueue::class,
            Base\CampoDB::class,
            Base\ValidarUsuario::class,
            Base\ApiEndpoints::class,
        ];
    }

    /**
     * Genera una instancia de cada clase almacenada e invoca al método registrar() en caso exista
     * @param string $plugin Ruta única del plugin que servirá como identificador se debe enviar del valor de plugin_basename(__FILE__) del archivo raiz del plugin
     */
    public static function registrar_servicios(string $plugin)
    {
        foreach(self::obtener_servicios() as $clase)
        {
            $servicio=self::instanciar_clase($clase,$plugin);
            if(method_exists($servicio,'registrar'))
            {
                $servicio->registrar();
            }
        }
    }

    /**
     * Crea una nueva instancia de la clase que recibe como parámetro
     * @param class $clase  a instanciar
     * @param string $plugin ruta unica del plugin 
     * @return object Retorna una instancia de la clase
     */
    private static function instanciar_clase($clase,$plugin)
    {
        $servicio = new $clase($plugin);
        return $servicio;
    }
}