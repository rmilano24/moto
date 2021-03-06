<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $product;
?>

<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist', $product_id ) )?>" rel="nofollow" data-product-id="<?php echo $product_id; ?>" data-product-type="<?php echo $product_type?>" class="<?php echo $link_classes ?>" >
    <?php echo esc_attr($icon); ?>
    <?php echo esc_attr($label); ?>
</a>
<!-- added by Epicomedia -->
<div class="blockUI blockOverlay ui-widget-overlay  ajax-loading" style="visibility:hidden;"></div>