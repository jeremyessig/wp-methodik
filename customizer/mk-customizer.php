<?php

/**
 * CLASSE MERE DU GESTIONNAIRE DE PERSONNALISATION
 * 
 * Ici se trouvent les methodes de sanitarisation
 * 
 * @package     Methodik
 * @author      Methodik
 * @copyright   GPL3  
 * @since       1.0.0
 */


defined('ABSPATH') || exit;

if (!class_exists('MK_Customizer')) {

    class MK_Customizer
    {

        /* Sanitize Inputs */
        public function sanitize_custom_option($input)
        {
            return ($input === "no") ? "no" : "yes";
        }

        public function sanitize_custom_url($input)
        {
            return filter_var($input, FILTER_SANITIZE_URL);
        }
    }
}
