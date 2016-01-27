<?php

// Widget class
class Ep_Woocommerce_Dropdown_Cart_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'woocommerce-dropdown-cart', // Base ID
            'Woocommerce Dropdown Cart', // Name
            array('description' => __('Woocommerce Dropdown Cart.', 'epicomedia')) // Args
        );
    }

    function widget( $args, $instance ) {
        
		global $post;
		extract( $args );
		global $woocommerce;
        
        // Our variables from the widget settings
        $type = isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : '';
       
        
        // Before widget (defined by theme functions file)
        echo $before_widget;
		?>
		
        <div class="shopping_cart_outer">
		<div class="shopping_cart_inner">
		<div class="shopping_cart_header">
        
		<ul class="wc_cart_outer <?php if ( $type == 'light') { ?>light<?php } ?>">
            <li class="wc_shop">
            
                <a class="header_cart" href="<?php echo esc_url($woocommerce-> cart->get_cart_url()); ?>">
                    <span class="header_cart_span">
                        <?php echo esc_attr($woocommerce->cart->cart_contents_count); ?>
                    </span>
                </a>
		
                <?php
	                $cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
	                $list_class = array( 'cart_list', 'product_list_widget' );
                ?>

	                <ul class="<?php echo implode(' ', $list_class); ?>">
                                                
		                <?php if ( !$cart_is_empty ) { ?>

			                <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

				                $_product = $cart_item['data'];

				                // Only display if allowed
				                if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
					                continue;
				                }

				                // Get price
				                $product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

				                $product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
				                ?>
                                <!-- add product id to access directly to this item. used in ajax update -->
				                <li data-productid="<?php echo esc_attr($cart_item['product_id']); ?>">
					                <a href="<?php echo get_permalink( esc_attr($cart_item['product_id']) ); ?>">

						                <?php echo $_product->get_image(); ?>
                                                    
                                        <div class="wc_cart_product_info">
                                            <div class="wc_cart_product_name">
									                <?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                            </div>

                                            <?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
                                                        
                                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">'. sprintf( '%s &nbsp; x &nbsp;',$cart_item['quantity'] ) . '</span><span class="price">' . sprintf( '%s',$product_price ) . '</span>' ,$cart_item ,$cart_item_key ); ?>
                                            
                                        </div>
                                                    
					                </a>
                                </li>

			                <?php endforeach; ?>

		                <?php  } else { ?>

			                <li class="no_products">
                                <span class="no_products_span">
                                    <?php _e('No products in the cart.', 'woocommerce'); ?>
                                </span>
                            </li>

		                <?php }; ?>

                        <li>
                            
                            <div class="total"><?php _e('SUBTOTAL ', 'woocommerce'); ?> : <span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></div>
                             
                            <a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="button cartbtn qbutton white">
                                <?php _e('VIEW CART', 'woocommerce'); ?>
                                
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

                            </a>
                            
                             <a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>" class="chckoutbtn qbutton white">
                                <?php _e('CHECKOUT', 'woocommerce'); ?>
                                

                            </a>
                            
                        </li>
	                </ul>
            </li>
		</ul>
        
        </div>
        </div>
        </div>

        <?php
        // After widget (defined by theme functions file)
        echo $after_widget;
    }
    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['type'] =  strip_tags( $new_instance['type'] );

        return $instance;
    }   

    function form( $instance ) {

        // Set up some default widget settings
        $defaults = array(
            'type' => 'dark',
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Type: Select Box -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'type' )); ?>"><?php _e('Icon style ( dark or light ):', 'epicomedia') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id( 'type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'type' )); ?>" class="widefat">
                <option <?php if ( 'dark' == esc_attr($instance['type']) ) echo 'selected="selected"'; ?>>dark</option>
                <option <?php if ( 'light' == esc_attr($instance['type']) ) echo 'selected="selected"'; ?>>light</option>
            </select>
        </p>

        <?php
    }
    
}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ep_Woocommerce_Dropdown_Cart_Widget" );' ) );