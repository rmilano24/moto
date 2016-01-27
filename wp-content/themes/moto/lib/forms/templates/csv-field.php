<?php
$name = $vars['key'];
$settings = $vars['settings'];
$placeholder = ep_array_value('placeholder', $settings);//Optional value
?>

<div class="field csv-input">
    <div class="text-input clear-after">
        <input type="text" name="csv-value" class="csv-value" placeholder="<?php echo esc_attr($placeholder); ?>" />
        <a href="#" class="btn-add"></a>
    </div>
    <div class="list"></div>
    <input type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr( $this->Ep_GetValue($name) ); ?>" />
</div>