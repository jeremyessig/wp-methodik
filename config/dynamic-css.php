<?php

defined('ABSPATH') || exit;

class MK_Dynamic_CSS
{

    const CSS_WIDTH_VALUE = array('auto', 'fit-content', 'inherit', 'initial', 'max-content', 'min-content', 'revert', 'unset', 'none');

    public function __construct()
    {
        add_action('wp_head', array($this, 'init'));
        //add_action('customize_controls_head', array($this, 'init'));
    }

    public function init()
    {
        $this->generate_theme_option_css();
    }



    private function generate_theme_option_css()
    { ?>
        <style type="text/css" id="methodik-theme-option-css">
            <?php $this->define_css_variables(); ?>
        </style>

<?php
    }

    private function define_css_variables()
    {

        $css = ':root {';

        $css .= '--mk-section-max-width: ' . $this->set_width_height('setting_block_section_max_width', 'setting_block_section_max_width_type') . ';';
        $css .= '--mk-section-max-height: ' . $this->set_width_height('setting_block_section_max_height', 'setting_block_section_max_height_type') . ';';
        $css .= '--mk-section-min-width: ' . $this->set_width_height('setting_block_section_min_width', 'setting_block_section_min_width_type') . ';';
        $css .= '--mk-section-min-height: ' . $this->set_width_height('setting_block_section_min_height', 'setting_block_section_min_height_type') . ';';

        $css .= '--mk-section-width: ' . $this->set_width_height('setting_block_section_width', 'setting_block_section_width_type') . ';';
        $css .= '--mk-section-height: ' . $this->set_width_height('setting_block_section_height', 'setting_block_section_height_type') . ';';

        $css .= '--mk-section-background-color: ' . get_option('setting_block_section_bg_color') . ';';

        $css .= '--mk-intersection-max-width: ' . $this->set_width_height('setting_block_intersection_max_width', 'setting_block_intersection_max_width_type') . ';';
        $css .= '--mk-intersection-max-height: ' . $this->set_width_height('setting_block_intersection_max_height', 'setting_block_intersection_max_height_type') . ';';

        $css .= '--mk-section-padding-top: ' . $this->set_width_height('setting_block_section_padding_top', 'setting_block_section_padding_unit') . ';';
        $css .= '--mk-section-padding-left: ' . $this->set_width_height('setting_block_section_padding_left', 'setting_block_section_padding_unit') . ';';
        $css .= '--mk-section-padding-bottom: ' . $this->set_width_height('setting_block_section_padding_bottom', 'setting_block_section_padding_unit') . ';';
        $css .= '--mk-section-padding-right: ' . $this->set_width_height('setting_block_section_padding_right', 'setting_block_section_padding_unit') . ';';

        $css .= '}';

        echo $css;
    }

    /**
     * SANITIZE CSS WIDTH AND CSS MAX-WIDTH
     */

    private function set_width_height($value, $type): string
    {
        $value = get_option($value);
        $type = get_option($type, 'px');


        if (in_array($value, self::CSS_WIDTH_VALUE)) {
            return $value;
        }

        if ($type === 'px') {
            return intval($value) . $type;
        }
        return floatval($value) . $type;
    }
}

$mk_dynamic_css = new MK_Dynamic_CSS();
