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

        private $plugin_url;

        /**
         * Disabling the constructor to create a singleton ! 
         */
        public function __construct()
        {
            // Silence is gold and we agree
        }

        /**
         * Initialize the plugin
         * Because we are in a singleton, we create this method to replace the constructor
         * We returning a Methodik instance to use the fluent pattern.
         * 
         * @return Methodik
         */
        public function init(): Methodik
        {
            $this->plugin_url = plugin_dir_url(__FILE__);

            add_action('admin_menu', array($this, 'mk_options_page'));

            add_action('admin_print_styles', array($this, 'load_admin_css'));
            add_action('wp_enqueue_scripts', array($this, 'load_methodik_css'));
            $this->load_constants();
            $this->load_customizer();

            require_once MK_DIR_PATH . 'config/dynamic-css.php';

            return $this;
        }


        public function load_constants(): void
        {
            require_once plugin_dir_path(__FILE__) . 'config/const.php';
            //require_once MK_DIR_PATH . 'test.php';
        }

        /**
         * Loading CSS for WP customizer admin panel. 
         *
         * @return void
         */
        public function load_admin_css(): void
        {
            wp_enqueue_style('mk-control', $this->plugin_url . 'assets/css/mk-control.css');
        }

        /**
         * Loading Methodik SCSS Framework
         *
         * @return void
         */
        public function load_methodik_css(): void
        {
            wp_enqueue_style('methodik-style', $this->plugin_url . 'assets/css/methodik.css');
        }

        /**
         * Defining constants
         *
         * @param      $name
         * @param bool $value
         */
        public function define(string $name, bool $value = true): void
        {

            if (!defined($name)) {
                define($name, $value);
            }
        }

        /**
         * Loading all classes needed to use the customizer !
         *
         * @return void
         */
        public function load_customizer(): void
        {
            require_once MK_CUSTOMIZER_DIR . 'mk-customizer.php';
            require_once MK_CUSTOMIZER_DIR . 'control/mk_customize_input_value_and_type_control.php';
            require_once MK_CUSTOMIZER_DIR . 'control/mk_customize_multiple_values.php';
            require_once MK_CUSTOMIZER_DIR . 'mk-customizer-blocks.php';
            require_once MK_CUSTOMIZER_DIR . 'blocks/mk-cutomizer-section.php';
        }

        public function mk_options_page(): void
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


$methodik = (new Methodik())->init();
