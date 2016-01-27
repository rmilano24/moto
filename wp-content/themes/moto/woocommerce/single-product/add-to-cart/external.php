<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<div class="cart">

	 	<a class="single_add_to_cart_button button alt" href="<?php echo esc_url( $product_url ); ?>" rel="nofollow">
            <div class="frame top">
                <div></div>
            </div>
            <div class="frame right">
                <div></div>
            </div>
            <div class="frame bottom">
                <div></div>
            </div>
            <div class="frame left">
                <div></div>
            </div>

            <span class="txt">
                    <?php echo esc_html( $button_text ); ?>
	        </span>
        </a>

</div>

<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
