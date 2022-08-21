<?php

/**
 * 
 * 
 * @since 0.1.0 
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('MK_Customizer_section')) {

    class MK_Customizer_section extends MK_Customizer_Blocks
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
            $section_name = 'section_block_section';

            $wp_customize->add_section(
                $section_name,
                array(
                    'title' => __('Section', 'methodik'),
                    'description' => __('Modify and customise all section-related elements on the site.', 'methodik'),
                    'panel' => parent::PANEL
                )
            );

            parent::set_size(
                $wp_customize,
                'width',
                array(
                    'name' => 'section',
                    'label' => 'Max width',
                    'section' => $section_name,
                    'limit' => 'max',
                    'default' => 1360,
                    'decription' => 'Indicate the maximum width of the sections'
                )
            );

            parent::set_size(
                $wp_customize,
                'width',
                array(
                    'name' => 'section',
                    'label' => 'Min width',
                    'section' => $section_name,
                    'limit' => 'min',
                    'default' => 440,
                    'decription' => 'Indicate the minimum width of the sections'
                )
            );

            parent::set_size(
                $wp_customize,
                'height',
                array(
                    'name' => 'section',
                    'label' => 'Max Height',
                    'section' => $section_name,
                    'default' => 'auto',
                    'limit' => 'max',
                    'decription' => 'Indicate the maximum height of the sections'
                )
            );

            parent::set_size(
                $wp_customize,
                'height',
                array(
                    'name' => 'section',
                    'label' => 'Min Height',
                    'section' => $section_name,
                    'default' => 'auto',
                    'limit' => 'min',
                    'decription' => 'Indicate the minimum height of the sections'
                )
            );

            parent::set_size(
                $wp_customize,
                'width',
                array(
                    'name' => 'section',
                    'label' => 'Width',
                    'section' => $section_name,
                    'default' => 'auto',
                    'decription' => 'Indicate the width of the sections'
                )
            );

            parent::set_size(
                $wp_customize,
                'height',
                array(
                    'name' => 'section',
                    'label' => 'Height',
                    'section' => $section_name,
                    'default' => 'auto',
                    'decription' => 'Indicate the height of the sections',
                    'separator' => true
                )
            );



            /**
             * PADDING AND MARGIN
             * @since 0.1.0
             */

            $this->set_margins_paddings(
                $wp_customize,
                'margin',
                array(
                    'name' => 'section',
                    'label' => 'Margins',
                    'section' => $section_name,
                    'default' => 0,
                    'description' => 'Set the margins of the sections',

                )
            );

            $this->set_margins_paddings(
                $wp_customize,
                'padding',
                array(
                    'name' => 'section',
                    'label' => 'Paddings',
                    'section' => $section_name,
                    'default' => 0,
                    'description' => 'Set the paddings of the sections',
                    'separator' => true

                )
            );


            /**
             * SECTION BACKGROUND COLOR
             * @since 0.1.0
             */
            $wp_customize->add_setting(
                'setting_block_section_bg_color',
                array(
                    'default' => '#ffffff',
                    'type' => 'option'
                )
            );

            $wp_customize->add_control(
                new WP_Customize_Color_Control(
                    $wp_customize,
                    'control_block_section_bg_color',
                    array(
                        'label' => __('Sections background color', 'methodik'),
                        'description' => __('Background colour applied to all sections', 'methodik'),
                        'section' => $section_name,
                        'settings' => 'setting_block_section_bg_color'
                    )
                )
            );
        }
    }
}

$mk_customizer_section = new MK_Customizer_section;
