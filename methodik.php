<?php

/*
    Plugin Name:        Methodik
    Description:        Methodik is a CSS and HTML plugin to faster write your code
    Version:            0.1.0
    Author:             Jérémy Essig
    License:            GPLv2 or later
    License URI:        http://www.gnu.org/licenses/gpl-2.0.html
    Requires PHP:       5.6 or higher
    Requires at least:  4.9 or higher
    Text Domain:        methodik
    Domain Path:        /lang

 */


defined('ABSPATH') || exit;

if (!class_exists('Methodik')) {

    class Methodik
    {

        public $version = '0.1.0';

        public function __construct()
        {
            add_action('admin_menu', array($this, 'mk_options_page'));

            // Problèmes avec le script ci-dessous, ne charge pas !
            add_action('admin_enqueue_scripts', array($this, 'load_css'));
            $this->load_constants();
            $this->load_customizer();

            require_once MK_DIR_PATH . 'config/dynamic-css.php';
        }


        public function load_constants()
        {
            require_once plugin_dir_path(__FILE__) . 'config/const.php';
            //require_once MK_DIR_PATH . 'test.php';
        }

        public function load_css()
        {

            $plugin_url = plugin_dir_url(__FILE__);

            wp_enqueue_style('style', $plugin_url . 'assets/css/mk-control.css');
        }

        /**
         * Defining constants
         *
         * @param      $name
         * @param bool $value
         */
        public function define(string $name, bool $value = true)
        {

            if (!defined($name)) {
                define($name, $value);
            }
        }

        public function load_customizer()
        {
            require_once MK_CUSTOMIZER_DIR . 'mk-customizer.php';
            require_once MK_CUSTOMIZER_DIR . 'control/mk_customize_input_value_and_type_control.php';
            require_once MK_CUSTOMIZER_DIR . 'control/mk_customize_multiple_values.php';
            require_once MK_CUSTOMIZER_DIR . 'mk-customizer-blocks.php';
            require_once MK_CUSTOMIZER_DIR . 'blocks/mk-cutomizer-section.php';
        }

        public function mk_options_page()
        {
            add_menu_page(
                'Methodik',
                'Methodik',
                'manage_options',
                MK_DIR_PATH . 'admin/view.php',
                null,
                plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
                20
            );
        }
    }
}

$methodik = new Methodik();
