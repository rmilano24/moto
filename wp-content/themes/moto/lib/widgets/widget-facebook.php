<?php

// Widget class
class Ep_Facebook_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Epico_Facebook', // Base ID
            'Epico - Facebook Widget', // Name
            array( 'description' => __('Widget that displays Facebook Like Box', 'epicomedia') ) // Args
        );
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        // Our variables from the widget settings
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
        $page_url = isset( $instance['page_url'] ) ? esc_url( $instance['page_url'] ) : '';
        $show_faces = isset( $instance['show_faces'] ) ? esc_attr( $instance['show_faces'] ) : '';
        $show_stream = isset( $instance['show_stream'] ) ? esc_attr( $instance['show_stream'] ) : '';
        $width = isset( $instance['width'] ) ? esc_attr( $instance['width'] ) : '';
        $height = isset( $instance['height'] ) ? esc_attr( $instance['height'] ) : '';
        

        // Before widget (defined by theme functions file)
        echo $before_widget;

        // Display the widget title if one was input
        if ( $title )
            echo $before_title . $title . $after_title;

        // Display Flickr Photos
		?>

            <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo esc_url($page_url); ?>&amp;width=<?php echo $width; ?>&amp;colorscheme=light&amp;show_faces=<?php if($show_faces) { echo 'true'; } else { echo 'false'; } ?>&amp;border_color&amp;stream=<?php if($show_stream) { echo 'true'; } else { echo 'false'; } ?>&amp;header=false&amp;height=<?php echo $height; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
 
		<?php

        
        // After widget (defined by theme functions file)
        echo $after_widget;

    }

    
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        // Strip tags to remove HTML (important for text inputs)
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['page_url'] = strip_tags( $new_instance['page_url'] );

        // No need to strip tags
        $instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_stream'] = $new_instance['show_stream'];
        $instance['width'] =  $new_instance['width'];
		$instance['height'] = $new_instance['height'] ;
        
        return $instance;
    }
        
    function form( $instance ) {

        // Set up some default widget settings
        $defaults = array(
            'title' => 'Find us on Facebook',
            'page_url' => '',
            'show_faces'=> true , 
            'show_stream' => true , 
            'width' => 300, 
            'height' => 300,
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title : Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'epicomedia') ?></label>           
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <!-- Facebook URL : Text Input -->
        <p>
            <label for="<?php echo esc_url($this->get_field_id( 'page_url' )); ?>"><?php _e('Facebook Page URL :', 'epicomedia') ?> <small"> Example: http://www.facebook.com/envato </small"></small>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'page_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'page_url' )); ?>" value="<?php echo esc_url( $instance['page_url'] ); ?>" />
        </p>
       
        <!-- Show Faces  : Check Box -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>"><?php _e('Show Faces:', 'epicomedia') ?></label>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'show_faces' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_faces' )); ?>" <?php checked( (bool) $instance['show_faces'], true ); ?> />
		</p>
        
        <!-- Show Stream  : Check Box -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show_stream' )); ?>"><?php _e('Show Stream:', 'epicomedia') ?></label>
            <input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'show_stream' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_stream' )); ?>" <?php checked( (bool) $instance['show_stream'], true ); ?> />
		</p>
        
        <!--Like Box Width : Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'width' )); ?>"><?php _e('like box width:', 'epicomedia') ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'width' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'width' )); ?>" value="<?php echo esc_attr( $instance['width'] ); ?>" />
		</p>
        
        <!-- Like Box Height  : Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'height' )); ?>"><?php _e('Like box height :', 'epicomedia') ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'height' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'height' )); ?>" value="<?php echo esc_attr( $instance['height'] ); ?>" />
		</p>
        

        <?php
        }
}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ep_Facebook_Widget" );' ) );