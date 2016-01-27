<?php
$name = $vars['key'];
$settings = $vars['settings'];
$default  = ep_array_value('default', $settings);
$selected = $this->Ep_GetValue($name);
$selected = $selected == '' ? $default : $selected;
$options  = $settings['options'];
$class        = ep_array_value('class', $settings);
$selectAttrs  = ep_array_value('attributes', $settings);
$optionsAttrs = ep_array_value('option-attributes', $settings, array());
$label        = ep_array_value('label', $settings);//Optional value
?>
<div class="field clear-after <?php echo esc_attr($class); ?>">
    <?php if($label != ''){ ?>
        <span class="field-label"><?php echo esc_attr($label); ?></span>
    <?php } ?>
    <div class="select<?php if($label != ''){echo ' has-label';} ?>">
        <div></div>
        <select name="<?php echo esc_attr($name); ?>" <?php echo esc_attr($selectAttrs); ?>>
            <?php
            if(isset($options)) {
                foreach($options as $value => $text)
                {
                    $selectedAttr = $value == $selected ? 'selected="selected"' : '';
                    $attrs = array_key_exists($value, $optionsAttrs) ? $optionsAttrs[$value] : '';
                    ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php echo "$selectedAttr $attrs"; ?>><?php  echo esc_attr($text); ?></option>
                <?php
                }
            }
            ?>
        </select>
    </div>
</div>