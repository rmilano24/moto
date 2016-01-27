<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div class="thumbnails zoom-gallery">
	    <div id="product-thumbs">
	        <div class="swiper-container clearfix">
	            <div class="swiper-wrapper">
						<?php

						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

						if ( has_post_thumbnail() )					
						{
							$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
							echo '<div class="swiper-slide">';
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image, $post->ID, $post->ID );
					        echo '</div>';							
						}

						foreach ( $attachment_ids as $attachment_id ) {

							$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
				            echo '<div class="swiper-slide">';
							echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image , $attachment_id, $post->ID);
				            echo '</div>';           
						}

					?>		
				</div>
        	</div>
    	</div>
	</div>
	<?php
}