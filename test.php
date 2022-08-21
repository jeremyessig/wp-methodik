<?php

//Load WP_Customize_Control
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class WP_Customize_Schedule_Fields_Control extends WP_Customize_Control
{
    /**
     * Choices/options for the select dropdown.
     *
     * @var array
     */
    public $select_choices = array();

    /**
     * HTML Attributes to add to the <select> tag
     *
     * @var array
     */
    public $select_attrs = array();

    //ublic $type = 'email_notification_schedule';

    public function select_attrs()
    {
        foreach ($this->select_attrs as $attr => $value) {
            echo $attr . '="' . esc_attr($value) . '" ';
        }
    }

    public function render_content()
    {
?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <input type="<?php echo esc_attr($this->type); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value('size')); ?>" <?php $this->link('size'); ?> />
            <select <?php $this->link('type'); ?> <?php $this->select_attrs(); ?>>
                <?php
                foreach ($this->select_choices as $value => $label)
                    echo '<option value="' . esc_attr($value) . '"' . selected($this->value('type'), $value, false) . '>' . $label . '</option>';
                ?>
            </select>
        </label>

        <?php if (!empty($this->description)) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <hr>
<?php endif;
    }
}


add_action('customize_register', 'register_schedule');


function register_schedule($wp_customize)
{
    $wp_customize->add_section(
        'notification_settings_section',
        array(
            'title' => 'TEST',
            'label' => 'Section'
        )
    );

    $wp_customize->add_setting('schedule_digit_setting', array(
        'default' => '',
        'type' => 'option',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_setting('schedule_type_setting', array(
        'default' => 'px',
        'type' => 'option',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Schedule_Fields_Control(
        $wp_customize,
        'email_notification_schedule',
        array(
            'label' => __('Schedule Email Campaign'),
            'section' => 'notification_settings_section',
            'settings' => [
                'size' => 'schedule_digit_setting',
                'type' => 'schedule_type_setting'
            ],
            // specify the kind of input field
            'type' => 'text',
            'input_attrs' => ['size' => 2, 'maxlength' => 5, 'style' => 'width:auto'],
            'select_attrs' => ['style' => 'width:auto'],
            'select_choices' => [
                'px' => __('px'),
                'rem' => __('rem'),
                '%' => __('%'),
            ],
            'description' => __('Configure when email newsletter will be sent out after publication.'),
            'priority' => 80
        )
    ));
}
