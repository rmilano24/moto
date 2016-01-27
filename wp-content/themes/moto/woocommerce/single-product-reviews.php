<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

# add 'row' that wrap feilds

add_action('comment_form_before_fields', 'ep_comment_before_fields');
add_action('comment_form_after_fields', 'ep_comment_after_fields');

add_action('comment_form_logged_in', 'ep_comment_before_fields');
add_action('comment_form_logged_in_after', 'ep_comment_after_fields');

?>

<div id="reviews">
	<div id="comments">
		<h2><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );
			else
				_e('Reviews', 'woocommerce' );
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php _e('There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
                
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __('Add a review', 'woocommerce' ) : __('Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __('Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
                            
                            // Edit Name feild 
							'author' => '<div class="span5">' .
											'<div class="comment-form-author">' .
												'<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />' .
                                                '<span class="label">'. esc_attr(__('Name', 'woocommerce' )) . '</span>'.
                                                '<span class="graylabel"> '. esc_attr(__('Name', 'woocommerce' )) . '</span>'.
                                            '</div>' .
									'</div>',
                                    
                             // Edit Email feild 
							'email'  => '<div class="span5">' .
											'<div class="form-group comment-form-email">' .
												'<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />' .
                                                '<span class="label">'. esc_attr(__('Email', 'woocommerce' )) . '</span>'.
                                                '<span class="graylabel"> '. esc_attr(__('Email', 'woocommerce' )) . '</span>'.
                                            '</div>' .
									    '</div>',  
						),
						'label_submit'  => __('Submit', 'woocommerce' ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                    
						$comment_form['comment_field'] = '
                        
                            <p class="comment-form-rating">
                                <select name="rating" id="rating">
							        <option value="">' . __('Rate&hellip;', 'woocommerce' ) . '</option>
							        <option value="5">' . __('Perfect', 'woocommerce' ) . '</option>
							        <option value="4">' . __('Good', 'woocommerce' ) . '</option>
							        <option value="3">' . __('Average', 'woocommerce' ) . '</option>
							        <option value="2">' . __('Not that bad', 'woocommerce' ) . '</option>
							        <option value="1">' . __('Very Poor', 'woocommerce' ) . '</option>
						        </select>
                                <label for="rating">' . __('Your Rating', 'woocommerce' ) .'</label>
                            </p>';
					}
                        
                    // Edit Your review textarea feild 
                    $comment_form['comment_field'] .= '<div class="row"><div class="span10"><div class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="form-control autogrow"></textarea>
                                                            <span class="label">'. esc_attr(__('Your Review', 'woocommerce' )) . '</span>
                                                            <span class="graylabel">'. esc_attr(__('Your Review', 'woocommerce' )) . '</span>
                                                        </div></div></div>';

				    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                    
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php _e('Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
