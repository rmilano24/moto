<?php

// Widget class
class Ep_Video_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'Epico_Video', // Base ID
            'Epico - Video', // Name
            array( 'description' => __('A widget that displays your YouTube or Vimeo Video.', 'epicomedia') ) // Args
        );
    }

    function widget( $args, $instance ) {
        extract( $args );

        // Our variables from the widget settings
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title']);
        $vid   = isset( $instance['vid'] ) ? esc_attr( $instance['vid'] ) : '';
        $desc   = isset( $instance['desc'] ) ? esc_attr( $instance['desc'] ) : '';

        // Before widget (defined by theme functions file)
        echo $before_widget;

        // Display the widget title if one was input
        if ( $title )
            echo $before_title . $title . $after_title;

        //Parse the content for the first occurrence of video url
        $video = ep_extract_video_info($vid);

        if($video != null)
        {
            $w = 270; $h = 151;
            ep_get_video_meta($video);

            if(array_key_exists('width', $video))
            {
                $w = $video['width'];
                $h = $video['height'];
            }

            //Extract video ID
            ?>
            <div class="video-frame">
                <?php
                if($video['type'] == 'youtube')
                    $src = "http://www.youtube.com/embed/" . $video['id'];
                else
                    $src = "http://player.vimeo.com/video/" . $video['id'] . "?color=ff4c2f";
                ?>
                <iframe src="<?php echo esc_url($src); ?>" width="<?php echo esc_attr($w); ?>" height="<?php echo esc_attr($h); ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
            </div>
        <?php
        }
        if( esc_attr ($desc) != ''){?>
            <div class="video-description"><?php echo esc_attr ($desc); ?></div>
        <?php
        }

        // After widget (defined by theme functions file)
        echo $after_widget;
    }


    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        // Strip tags to remove HTML (important for text inputs)
        $instance['title']   = strip_tags( $new_instance['title'] );
        $instance['vid']     = strip_tags( $new_instance['vid'] );
        $instance['desc']    = strip_tags( $new_instance['desc'] );

        return $instance;
    }

    function form( $instance ) {

        // Set up some default widget settings
        $defaults = array(
            'title' => 'Video',
            'vid' => '',
            'desc' => ''
        );

        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'epicomedia') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr ($instance['title']); ?>" />
        </p>


        <!-- Video ID: Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'vid' )); ?>"><?php _e('Video URL:', 'epicomedia') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'vid' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vid' )); ?>" value="<?php echo esc_attr ($instance['vid']); ?>" />
        </p>

        <!-- Video Description: Text Input -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php _e('Video Description:', 'epicomedia') ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>" value="<?php echo esc_attr ($instance['desc']); ?>" />
        </p>
        <?php
        }
}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "Ep_Video_Widget" );' ) );