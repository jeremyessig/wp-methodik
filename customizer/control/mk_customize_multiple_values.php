<?php

//Load WP_Customize_Control
include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

class MK_Customize_Multiple_Values extends WP_Customize_Control
{
    /**
     * Choices/options for the select dropdown.
     *
     * @var array
     */
    public $select_choices = array();


    /**
     * Separate control group
     */
    public $separator;

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
        // Le $this->link permet de lier l'input avec le setting pour enregistrer en base de données
?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>
            <div class="customize-control-inputs-container">
                <div class="customize-control-value-type-container">

                    <?php foreach ($this->settings as $key => $value) : ?>
                        <?php if ($key != 'unit') : ?>
                            <div class="customize-multiple-values-inputs">
                                <label><?php echo esc_html($key); ?></label>
                                <input type="text" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value($key)); ?>" <?php $this->link($key) ?> />
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <select <?php $this->link('unit'); ?> <?php $this->select_attrs(); ?>>
                        <?php
                        foreach ($this->select_choices as $value => $label)
                            echo '<option value="' . esc_attr($value) . '"' . selected($this->value('unit'), $value, false) . '>' . $label . '</option>';
                        ?>
                    </select>
                </div>
            </div>
        </label>

        <?php if ($this->separator === true) : ?>
            <hr class="customize-control-separator">
        <?php endif; ?>

<?php

    }
}
