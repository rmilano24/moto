<?php
// Widget class
class Ep_Woocommerce_Wishlist_Widget extends WP_Widget {

	public function __construct() {
        parent::__construct(
            'woocommerce-wishlist', // Base ID
            'Woocommerce Wishlist button', // Name
            array('description' => __('Woocommerce Wishlist button.', 'epicomedia' )) // Args
        );
    }
    function widget( $args, $instance ) {
        
		global $post;
		extract( $args );
		global $woocommerce;
        global $yith_wcwl;
        // Our variables from the widget settings
        $type = isset( $instance['type'] ) ? esc_attr( $instance['type'] ) : '';
        
        // Before widget (defined by theme functions file)
        echo $before_widget;
		?>
		<?php if (class_exists('YITH_WCWL')) : ?>
        <a href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>" class="tools_button <?php if ( $type == 'light') { ?> light <?php } ?>">
            <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>
        </a>
        <?php endif; ?>
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
add_action( 'widgets_init', create_function( '', 'register_widget( "Ep_Woocommerce_Wishlist_Widget" );'));