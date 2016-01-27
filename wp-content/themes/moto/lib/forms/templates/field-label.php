<?php
$settings = $vars['settings'];
$desc     = ep_array_value('desc', $settings);//Optional value
$title    = ep_array_value('title', $settings);//Optional value
$class    = ep_array_value('label-class', $settings);//Optional value
?>
<div class="ep-input-label <?php echo esc_attr($class); ?>">
    <strong><?php echo esc_attr($title); ?></strong>
    <?php if(strlen($desc)){ ?>
    <span><?php echo esc_attr($desc); ?></span>
    <?php } ?>
</div>