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

abstract class MK_Customizer
{

    //abstract protected function register_customizer($wp_customize);

    /* Sanitize Inputs */
    public function sanitize_custom_option($input)
    {
        return ($input === "no") ? "no" : "yes";
    }

    public function sanitize_custom_url($input)
    {
        return filter_var($input, FILTER_SANITIZE_URL);
    }


    // public function display_sections($wp_customize, string $panel, array $sections)
    // {
    //     $wp_customize->add_section(
    //         'section_display_sections',
    //         array(
    //             'title' => 'Affichage',
    //             'priority' => 1,
    //             'description' => "Gérer l'affichage des sections",
    //             'panel' => $panel,
    //         )
    //     );

    //     foreach ($sections as $name => $label) {

    //         $wp_customize->add_setting(
    //             'setting_' . $name . '_display',
    //             array(
    //                 'default' => 'yes',
    //                 'sanitize_callback' => array($this, 'sanitize_custom_option')
    //             )
    //         );

    //         $wp_customize->add_control(
    //             new WP_Customize_Control(
    //                 $wp_customize,
    //                 'control_' . $name . '_display',
    //                 array(
    //                     'label' => $label,
    //                     'section' => 'section_display_sections',
    //                     'settings' => 'setting_' . $name . '_display',
    //                     'type' => 'select',
    //                     'choices' => array('no' => 'Non', 'yes' => 'Oui')
    //                 )
    //             )
    //         );
    //     }
    // }
}
