<?php

/**
 * Classe pour gérer la personnalisation globale du site
 * 
 * @since 1.0 
 */

if (!defined('ABSPATH')) {
    exit;
}

class MK_Customizer_intersection extends MK_Customizer_Blocks
{

    public function __construct()
    {
        add_action('customize_register', array($this, 'register_customizer'));
    }

    public function register_customizer($wp_customize)
    {

        parent::create_panel($wp_customize);
        $this->create_block($wp_customize);
    }

    public function create_block($wp_customize)
    {
        $section_name = 'section_block_intersection';

        $wp_customize->add_section(
            $section_name,
            array(
                'title' => __('Intersection', 'methodik'),
                'description' => __('Modify and customise all section-related elements on the site.', 'methodik'),
                'panel' => parent::PANEL
            )
        );

        parent::set_limit_measurement(
            $wp_customize,
            'max',
            'width',
            array(
                'name' => 'intersection',
                'label' => 'Max width',
                'section' => $section_name,
                'default' => 1360,
                'decription' => 'Indicate the maximum width of the intersections'
            )
        );
    }
}

$mk_customizer_intersection = new MK_Customizer_intersection;
