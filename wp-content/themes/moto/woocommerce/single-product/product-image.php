<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product-> get_gallery_attachment_ids();

$image_num = count($attachment_ids) + ( has_post_thumbnail() ? 1 : 0 );

?>
<div class="images">
    <div id="product-fullview-thumbs" class="<?php if(count($attachment_ids) == 0 ) { echo "no-gallery";} ?>">
    	<div class="zoom-container">
    	<?php
    	if($image_num > 1)
		{
			?>

	        <div class="swiper-container clearfix">
	            <div class="swiper-wrapper">

					<?php
					$zoom = ep_opt('shop-enable-zoom'); // detect side bar position that set in admin panel    

					if ( has_post_thumbnail() )					
					{
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						
						if ($zoom == 1 ) {
							$big_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), 'full' );
							echo '<div class="swiper-slide easyzoom" style="background-image:url(' . $image[0] . ')" data-zoom-image="' . $big_image[0] . '"></div>';
						}
						else
						{
							echo '<div class="swiper-slide" style="background-image:url(' . $image[0] . ')" ></div>';
						}
					
					}

					foreach ( $attachment_ids as $attachment_id ) {

						$image = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );

						if ($zoom == 1 ) {
							$big_image = wp_get_attachment_image_src( $attachment_id, 'full' );
							echo '<div class="swiper-slide easyzoom" style="background-image:url(' . $image[0] . ')" data-zoom-image="' . $big_image[0] . '"></div>';
						}
						else
						{
			            	echo '<div class="swiper-slide" style="background-image:url(' . $image[0] . ')"></div>';
			            }
					}

					?>
				</div>
	    	</div>
	    	<?php
	    }
	    else
	    {

			$zoom = ep_opt('shop-enable-zoom'); // detect side bar position that set in admin panel    

			if ( has_post_thumbnail() )					
			{
				$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
				
				if ($zoom == 1 ) {
					$big_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), 'full' );
					echo '<div class="swiper-slide easyzoom" style="background-image:url(' . $image[0] . ')" data-zoom-image="' . $big_image[0] . '"></div>';
				}
				else
				{
					echo '<div class="swiper-slide" style="background-image:url(' . $image[0] . ')" ></div>';
				}
			
			}

			foreach ( $attachment_ids as $attachment_id ) {

				$image = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );

				if ($zoom == 1 ) {
					$big_image = wp_get_attachment_image_src( $attachment_id, 'full' );
					echo '<div class="swiper-slide easyzoom" style="background-image:url(' . $image[0] . ')" data-zoom-image="' . $big_image[0] . '"></div>';
				}
				else
				{
	            	echo '<div class="swiper-slide" style="background-image:url(' . $image[0] . ')"></div>';
	            }
			}

	    }
	    ?>
		</div>
    </div>
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>


