<?php

/**
 * Classe pour gérer la personnalisation globale du site
 * 
 * @since 1.0 
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('MK_Customizer_Blocks')) {
    class MK_Customizer_Blocks extends MK_Customizer
    {
        const PANEL = 'panel_blocks';


        public function create_panel($wp_customize)
        {
            $wp_customize->add_panel(
                self::PANEL,
                array(
                    'title' => __("Blocks", 'methodik'),
                    'description' => __('Blocks settings', 'methodik'),
                    'priority' => 100
                )
            );
        }


        public function set_size($wp_customize, $measurement, $args)
        {
            $units = array(
                'px' => 'px',
                '%' => '%',
                'rem' => 'rem'
            );

            if ($measurement === 'width') {
                $units['vw'] = 'vw';
            } else {
                $units['vh'] = 'vh';
            }

            /**
             * Set limit (min or max) to the measurement 
             * 
             */
            $limit = '';
            if ($args['limit'] != null) {
                $limit = $args['limit'] . '_';
            }

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $limit . $measurement,
                array(
                    'default' => $args['default'],
                    'type' => 'option',
                )
            );

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $limit . $measurement . '_type',
                array(
                    'default'    => 'px',
                    'type'       => 'option',
                )
            );

            $wp_customize->add_control(new MK_Customize_Input_Value_And_Type_Control(
                $wp_customize,
                'control_block_' . $args['name'] . '_' . $limit . $measurement,
                array(
                    'label' => __($args['label'], 'methodik'),
                    'section' => $args['section'],
                    'settings' => [
                        'size' => 'setting_block_' . $args['name'] . '_' . $limit . $measurement,
                        'type' => 'setting_block_' . $args['name'] . '_' . $limit . $measurement . '_type',
                    ],
                    // specify the kind of input field
                    'type' => 'text',
                    'input_attrs' => ['size' => 2, 'maxlength' => 5, 'style' => 'width:auto'],
                    'select_attrs' => ['style' => 'width:auto'],
                    'select_choices' => $units,
                    'description' => __($args['description'], 'methodik'),
                    'priority' => 10,
                    'separator' => $args['separator']
                )
            ));
        }


        /**
         * setting margins and paddings interface to the customizer
         * @since 0.1.0
         */
        public function set_margins_paddings($wp_customize, $cat, $args)
        {
            $units = array(
                'px' => 'px',
                '%' => '%',
                'rem' => 'rem'
            );

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $cat . '_top',
                array(
                    'default' => $args['default'],
                    'type' => 'option',
                )
            );

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $cat . '_left',
                array(
                    'default' => $args['default'],
                    'type' => 'option',
                )
            );

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $cat . '_bottom',
                array(
                    'default' => $args['default'],
                    'type' => 'option',
                )
            );

            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $cat . '_right',
                array(
                    'default' => $args['default'],
                    'type' => 'option',
                )
            );


            $wp_customize->add_setting(
                'setting_block_' . $args['name'] . '_' . $cat . '_unit',
                array(
                    'default'    => 'px',
                    'type'       => 'option',
                )
            );

            $wp_customize->add_control(new MK_Customize_Multiple_Values(
                $wp_customize,
                'control_block_' . $args['name'] . '_' . $cat,
                array(
                    'label' => __($args['label'], 'methodik'),
                    'section' => $args['section'],
                    'settings' => [
                        'top' => 'setting_block_' . $args['name'] . '_' . $cat . '_top',
                        'right' => 'setting_block_' . $args['name'] . '_' . $cat . '_right',
                        'bottom' => 'setting_block_' . $args['name'] . '_' . $cat . '_bottom',
                        'left' => 'setting_block_' . $args['name'] . '_' . $cat . '_left',
                        'unit' =>  'setting_block_' . $args['name'] . '_' . $cat . '_unit'
                    ],
                    'type' => 'text',
                    'input_attrs' => ['size' => 2, 'maxlength' => 4],
                    'select_attrs' => ['style' => 'width:auto; height:30px;'],
                    'select_choices' => $units,
                    'description' => __($args['description'], 'methodik'),
                    'priority' => 10,
                    'separator' => $args['separator']

                )
            ));
        }
    }
}
