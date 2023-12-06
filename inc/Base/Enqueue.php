<?php
/**
 * @package Aleximxp
 */
namespace Aleximxp\Base;


class Enqueue extends PluginController{

    /**
     * Registra el método para incluir los javascripts y estilos del plugin
     */
    public function registrar() 
    {
        add_action('wp_enqueue_scripts', array($this,'enqueue'));            
    }
    
    /**
     * Incluye los javascripts y estilos del plugin
     */
    public function enqueue($hook) 
    {
        $this->enqueueFormularioRegistro($hook);
        $this->enqueueValidarCodigoEnBD($hook);
    }

    public function enqueueFormularioRegistro($hook)
    {
        global $wp;
        //Cambiar esto según el slug de donde se encuentre el form
        $slugDeFormulario = "eliminar-cuentas-y-datos-asociados";

        $current_slug = add_query_arg( array(), $wp->request );
		if($current_slug==$slugDeFormulario)
        {    
            wp_enqueue_script( 'registroJS', $this->pluginUrl.'/assets/js/datosFormBajaUsuario.js', array(),false,true);
        }
    }
    public function enqueueValidarCodigoEnBD($hook)
    {
        global $wp;
        //Cambiar esto según el slug de donde se encuentre el form
        $slugDeFormulario = "validar-codigo-para-dar-de-baja-usuario";

        $current_slug = add_query_arg( array(), $wp->request );
		if($current_slug==$slugDeFormulario)
        {    
            wp_enqueue_script( 'registroJS', $this->pluginUrl.'/assets/js/datosFormBajaUsuario.js', array(),false,true);
        }
    }
}