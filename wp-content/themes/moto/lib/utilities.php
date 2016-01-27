<?php

// include simple_html_dom  :: A simple PHP HTML DOM parser written in PHP5+, supports invalid HTML, and provides a very easy way to handle HTML elements.
if (!function_exists('file_get_html')) require_once(THEME_LIB . '/includes/simple_html_dom.php');
if ( is_singular() ) wp_enqueue_script( "comment-reply");

/*---------------------------------
    Gathering Inline-styles of pages of main-page + adding them to main-page
------------------------------------*/
function ep_addVCCustomCss() {

    $shortcodes_custom_css = '';

    //if is main-page
    if(is_page_template('main-page.php')) {
        $page_ids = get_all_page_ids();
        $current_page_id = get_the_ID();

        if( count($page_ids) > 0 ) {
            foreach ($page_ids as $page_id)
            {
                $separate_page = get_post_meta($page_id, "page-position-switch", true);
                
                if ( $separate_page !== "0" && $page_id != $current_page_id ) {
                    $shortcodes_custom_css .= get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
                }
            }
    
            if ( $shortcodes_custom_css != '' ) {
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo $shortcodes_custom_css;
                echo '</style>';
            }
        }
    }
    else
    {
        if(function_exists("is_shop"))
        {
            $shortcodes_custom_css = get_post_meta( woocommerce_get_page_id('shop'), '_wpb_shortcodes_custom_css', true );
            if(is_shop() && $shortcodes_custom_css != '' )
            {
               echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
               echo $shortcodes_custom_css;
               echo '</style>';                
            }
        }

    }
}

add_action( 'wp_head', 'ep_addVCCustomCss' , 1000 );

/*---------------------------------
	Social Link 
------------------------------------*/
function ep_socialLink($optKey, $text, $class , $socialname) {
	$SocialText= $text;
	if(ep_opt($optKey)!=''){
         if(esc_attr($optKey)!='social_custom1_url'&& esc_attr($optKey)!='social_custom2_url')
    { ?>
    
    <li class="socialLinkShortcode textstyle <?php echo esc_attr($socialname); ?>">
        <a  href="<?php ep_eopt($optKey); ?>" target="_blank">
            <span><?php echo esc_attr($SocialText); ?></span>
        </a>
    </li>
        
    <?php
    }elseif(esc_attr($optKey)=='social_custom1_url'|| esc_attr($optKey)=='social_custom2_url')
	{ ?>
	<li class="socialLinkShortcode textstyle <?php echo esc_attr($socialname); ?>">
        <a  href="<?php ep_eopt($optKey); ?>" target="_blank">
            <span><?php echo ep_eopt($SocialText); ?></span>
        </a>
    </li>
	<?php }
	}
}
/*---------------------------------
	Social Icon 
------------------------------------*/
function ep_socialIcon($optKey, $text, $class , $socialname) {
    if(ep_opt($optKey)!=''){
		if(esc_attr($optKey)!='social_custom1_url'&& esc_attr($optKey)!='social_custom2_url'){ ?>
      
    <li class="socialLinkShortcode iconstyle <?php echo esc_attr($socialname); ?>">
        <a  href="<?php ep_eopt($optKey); ?>" target="_blank">
            <span class="icon <?php echo esc_attr($class); ?>"></span>
        </a>
    </li>
        
    <?php
    }elseif(esc_attr($optKey)=='social_custom1_url'|| esc_attr($optKey)=='social_custom2_url')
	{ ?>
	<li class="socialLinkShortcode iconstyle <?php echo esc_attr($socialname); ?>">
        <a  href="<?php ep_eopt($optKey); ?>" target="_blank">
            <span class="icon <?php echo esc_attr($class); ?>"></span>
        </a>
    </li>
	<?php }
	}
}
/*---------------------------------
	 Post - Like - System
------------------------------------*/

    include(THEME_ADMIN . '/post-like.php');

/*---------------------------------
	 Aqua Resizer : This small script will allow you to resize & crop WordPress images uploaded via the media uploader on the fly.
------------------------------------*/

if ( ! function_exists( 'aq_resize' ) ) {
    include(THEME_ADMIN . '/aq_resizer.php');
}

/*---------------------------------
     Font size in text editor
------------------------------------*/
if ( ! function_exists( 'mce_buttons' ) ) {
    function mce_buttons( $buttons ) {
        array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select

        return $buttons;
    }
}
add_filter( 'mce_buttons_2', 'mce_buttons' );


// Customize mce editor font sizes
if ( ! function_exists( 'mce_text_sizes' ) ) {
    function mce_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "12px 13px 14px 15px 16px 17px 18px 19px 20px 21px 22px 24px 26px 28px 36px 40px 48px 60px 72px 80px";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'mce_text_sizes' );

/*---------------------------------
	 Preloader 
------------------------------------*/

if ( ! function_exists ('ep_preloader' ) ) {

	function ep_preloader() {
    
		global $post;

		if ( isset( $post ) ) {

			if ( ! ( is_page() || is_archive() || is_search() ) && has_post_thumbnail( $post->ID ) ) {
		        $thumb = get_post_thumbnail_id( $post->ID );
		        $img_url = wp_get_attachment_url( $thumb, 'full' );  
		        echo aq_resize( $img_url, 200, 200, true ); 
			} else if ( ep_opt( 'preloader-logo' ) != '' ) {
				ep_eopt( 'preloader-logo' );
			} else {
				echo get_template_directory_uri() . '/assets/img/preloader.png';
			}

		} else {

			if ( get_option( 'preloader-logo' ) != '' ) {
				ep_eopt( 'preloader-logor' );
			} else {
				echo get_template_directory_uri() . '/assets/img/preloader.png';
			}

		}

	}
}

/*---------------------------------
    Customizing wp_title
------------------------------------*/

if ( ! function_exists( 'ep_filter_wp_title' ) ) {

	function ep_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;
        
		global $paged, $page;

		if ( is_search() ) {
            
			$title = sprintf( __('Search results for %s', 'epicomedia' ), '"' . get_search_query() . '"' );

			if ( $paged >= 2 ) {
				$title .= " $separator " . sprintf( __('Page %s', 'epicomedia' ), $paged );
			}

			$title .= " $separator " . get_bloginfo('Name', 'display' );

			return $title;

		}

		return $title;

	}
}

add_filter( 'wp_title', 'ep_filter_wp_title', 10, 2 );

/*---------------------------------
    Vertical menu - left And Right position
------------------------------------*/

if (!function_exists('body_class_utility')) {
	
	function body_class_utility($classes) {
        
        //Menu
        $headerPosition = ep_opt('header-position');
        $headerStyle = ep_opt('header-style');

		//is left menu area turned on
		if (isset($headerPosition) && $headerPosition == 2 ) { //left menu
			$classes[] = 'vertical_menu_enabled left_menu_enabled';
		} else if (isset($headerPosition) && $headerPosition == 3 ) { //right menu
            $classes[] = 'vertical_menu_enabled right_menu_enabled';
        }
        
        if (isset($headerPosition) && $headerPosition == 1  && $headerStyle == 'wave-menu' ) { //left menu
			$classes[] = 'wave-menu_enabled';
		}
        

        //Product gallery
        if(function_exists('is_woocommerce')) {
            global $product;
            if(is_product())
            {
                $attachment_ids = $product-> get_gallery_attachment_ids();
                if(count($attachment_ids) > 0)
                {
                    $classes[] = 'have_gallery';
                }
            }
            
        }

        return $classes;
    }

	add_filter('body_class','body_class_utility');
}


/*---------------------------------
    Remove the excerpt "more"
------------------------------------*/

function ep_new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'ep_new_excerpt_more');


/*---------------------------------
    retrieves the attachment ID from the file URL
------------------------------------*/

function ep_get_image_id($image_url) {
    global $wpdb;
    $prefix = $wpdb->prefix;

    // generate Full size Image URL by removing image size info 
    $image_url = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $image_url); 

    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';",$image_url));

    if(count($attachment))
        return $attachment[0];
    else
        return -1;
}

/*---------------------------------
    Return theme option
------------------------------------*/

function ep_opt($option){
    $opt = get_option(OPTIONS_KEY);

    return stripslashes($opt[$option]);
}

/*---------------------------------
    Echo theme option
------------------------------------*/

function ep_eopt($option){
    echo ep_opt($option);
}

function ep_print_terms($terms, $separatorString) {
    $termIndex = 1;
    if($terms)
    foreach ($terms as $term)
    {
        echo $term->name;

        if(count($terms) > $termIndex)
            echo $separatorString;

        $termIndex++;
    }
}

/*---------------------------------
    Gets array value with specified key, if the key doesn't exist  default value is returned
------------------------------------*/

function ep_array_value($key, $arr, $default='') {
    return array_key_exists($key, $arr) ? $arr[$key] : $default;
}

/*---------------------------------
    Deletes attachment by given url
------------------------------------*/

function ep_delete_attachment( $url ) {
    global $wpdb;
    $prefix = $wpdb->prefix; 
    
    // We need to get the image's meta ID.
    $results = $wpdb->get_results($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " where guid = %s AND post_type = 'attachment" , $url));

    // And delete it
    foreach ( $results as $row ) {
        wp_delete_attachment( $row->ID );
    }
}

/*---------------------------------
    Control the Expert lenght by filter 
------------------------------------*/

function custom_excerpt_length( $length ) {
	return 110;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*---------------------------------
    get page meta
------------------------------------*/

function ep_get_meta($key, $single = true)
{
    $pid = null;

    if(in_the_loop() || is_single() || (is_page() && !is_home()))
    {
        $pid = get_the_ID();
    }
    //Special case for blog page
    elseif(is_home() && !is_front_page())
    {
        $pid = get_option('page_for_posts');
    }

    if(null == $pid)
        return '';

    return get_post_meta($pid, $key, $single);
}

/*---------------------------------
    Get video url from known sources such as youtube and vimeo 
------------------------------------*/

function ep_extract_video_info($string)
{
    //check for youtube video url
    if(preg_match('/https?:\/\/(?:www\.)?youtube\.com\/watch\?v=[^&\n\s"<>]+/i', $string, $matches ))
    {
        $url = parse_url($matches[0]);
        parse_str($url['query'], $queryParams);

        return array('type'=>'youtube', 'url'=> $matches[0], 'id' => $queryParams['v']);
    }
    //Vimeo
    else if(preg_match('/https?:\/\/(?:www\.)?vimeo\.com\/\d+/i', $string, $matches))
    {
        $url = parse_url($matches[0]);

        return array('type'=>'vimeo', 'url'=> $matches[0], 'id' => ltrim($url['path'], '/'));
    }

    return null;
}

/*---------------------------------
    Get Audio url from soundcloud
------------------------------------*/

function ep_extract_audio_info($string)
{
    //check for soundcloud url
    if(preg_match('/https?:\/\/(?:www\.)?soundcloud\.com\/[^&\n\s"<>]+\/[^&\n\s"<>]+\/?/i', $string, $matches ))
    {
        return array('type'=>'soundcloud', 'url'=> $matches[0]);
    }

	return null;
}


function ep_get_video_meta(array &$video)
{
    if($video['type']  != 'youtube' && $video['type'] != 'vimeo')
        return null;

    $ret = ep_get_url_content($video['url']/*, '127.0.0.1:8080'*/);

    if(is_array($ret))
        return 'Server Error: ' . $ret['error'] . " \nError No: " . $ret['errorno'];

    if(trim($ret) == '')
        return 'Error: got empty response from youtube';

    $html = str_get_html($ret);
    $vW   = $html->find('meta[property="og:video:width"]');
    $vH   = $html->find('meta[property="og:video:height"]');

    if(count($vW) && count($vH))
    {
        $video['width']  = $vW[0]->content;
        $video['height'] = $vH[0]->content;
    }

    return null;
}

function ep_soundcloud_get_embed($url)
{
    $json = ep_get_url_content("http://soundcloud.com/oembed?format=json&url=$url"/*, '127.0.0.1:86'*/);

    if(is_array($json))
        return 'Server Error: ' . $json['error'] . " \nError No: " . $json['errorno'];

    if(trim($json) == '')
        return 'Error: got empty response from soundcloud';

    //Convert the response string to PHP object
    $data = json_decode($json);

    if(NULL == $data)
        return "Cant decode the soundcloud response \nData: $json" ;

    //TODO: add additional error checks

    return $data->html;
}

/*---------------------------------
    downloads data from given url
------------------------------------*/

function ep_get_url_content($url, $proxy='')
{
    $ch = curl_init();

    // set URL and other appropriate options
    $options = array( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true );

    if($proxy != '')
        $options[CURLOPT_PROXY] = $proxy;

    // set URL and other appropriate options
    curl_setopt_array($ch, $options);

    $ret = curl_exec($ch);

    if(curl_errno($ch))
        $ret = array('error' => curl_error($ch), 'errorno' => curl_errno($ch));

    curl_close($ch);
    return $ret;
}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below


/*---------------------------------
    Revolution slider
------------------------------------*/

function ep_get_revolutionSlider_slides() {

    $files = scandir(WP_PLUGIN_DIR);
    $revolutionSlider = false;
    $revolutionSliderDirectory = "";
    foreach($files as $file ){
        if($file != '.' && $file != '..' && $revolutionSlider != true && is_dir(WP_PLUGIN_DIR.'/'.$file)){
            $filename = WP_PLUGIN_DIR.'/'.$file.'/revslider.php';
            if (file_exists($filename)) {
                $revolutionSlider = true;
                $revolutionSliderDirectory  =  $file ;
            }
        }
    }

    if ($revolutionSlider) {
    
        if (is_plugin_active($revolutionSliderDirectory.'/revslider.php')) {
    
            // Get WPDB Object
            global $wpdb;

            // Table name
            $prefix = $wpdb->prefix;

            // Get sliders
            $sliders = $wpdb->get_results( "SELECT * FROM " . $prefix . "revslider_sliders" . "
                                                ORDER BY id ASC LIMIT 100" );                  
            $items = array('no-slider'=>__('No slider','epicomedia'));

            // Iterate over the sliders
            foreach($sliders as $key => $item) {
                $items[$item->alias] = $item->alias;
            }
            return $items;
        }
   }
   
}


/*---------------------------------
    Generate Portfolio Skill array 
------------------------------------*/

function ep_generate_portfolio_skill()
{
    $portfolioTerms = get_terms('skills');
    $skillsArray = array();

    foreach($portfolioTerms as $term) {
        $skillArray = array(
                            'type' => 'checkbox',
                            'checked' => true,
                            'value' => 'visible',
                            'label' => $term->name
                        );

        $skillsArray["term-".$term->term_id] = $skillArray;
    }
    return $skillsArray;
}

/*---------------------------------
   Generate Portfolio Skill options list 
------------------------------------*/

function  ep_generate_portfolio_skill_option ($fields)
{
    $portfolioTerms = get_terms('skills');
    $SkillOption = array();

    foreach($portfolioTerms as $term) {

        $SkillOption = $fields['term-'. $term-> term_id];

        $SkillOptions["term-".$term->term_id] = $SkillOption;
    }

    return $SkillOptions;
}

/*---------------------------------
    Portfolio Skill
------------------------------------*/

function ep_get_Portfolio_skills()
{
    $portfolioTerms = get_terms('skills');
    $portfolioSlugs = array();

    foreach($portfolioTerms as $term) {
        $portfolioSlugs[$term->slug] = $term->name;
    }

    return $portfolioSlugs;
}

/*---------------------------------
    CF7
------------------------------------*/

function ep_get_contact_form7_forms()
{
    // Get WPDB Object
    global $wpdb;

    // Table name
    $table_name = $wpdb->prefix . "posts";

    // Get forms
    $forms = $wpdb->get_results( "SELECT * FROM $table_name
                                  WHERE post_type='wpcf7_contact_form'
                                  LIMIT 100" );

    $items = array('no-form'=>'');

    // Iterate over the sliders
    foreach($forms as $key => $item) {
        $items[$item->ID] = $item->post_title;
    }

    return $items;
}

/*---------------------------------
    post pagination Search And Archive page!
------------------------------------*/

function ep_get_pagination($query = null, $range = 3) {
    global $paged, $wp_query;

    $q = $query == null ? $wp_query : $query;
    $output = '';

    // pages that exist
    if ( !isset($max_page) ) {
        $max_page = $q->max_num_pages;
    }

    // We need the pagination only if there is more than 1 page
    if ( $max_page < 2 )
        return $output;

    $output .= '<div class="post-pagination">';

    if ( !$paged ) $paged = 1;

    // To the previous page
    if($paged > 1)
        $output .= '<a class="prev-page-link" href="' . get_pagenum_link($paged-1) . '">'. __('Prev', 'epicomedia') .'</a>';

    if ( $max_page > $range + 1 ) {
        if ( $paged >= $range )
            $output .= '<a href="' . get_pagenum_link(1) . '">1</a>';
        if ( $paged >= ($range + 1) )
            $output .= '<span class="page-numbers">&hellip;</span>';
    }

    // We need the sliding effect only if there are more pages than is the sliding range
    if ( $max_page > $range ) {
        // When closer to the beginning
        if ( $paged < $range ) {
            for ( $i = 1; $i <= ($range + 1); $i++ ) {
                $output .= ( $i != $paged ) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
            }
            // When closer to the end
        } elseif ( $paged >= ($max_page - ceil(($range/2))) ) {
            for ( $i = $max_page - $range; $i <= $max_page; $i++ ) {
                $output .= ( $i != $paged ) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
            }
            // Somewhere in the middle
        } elseif ( $paged >= $range && $paged < ($max_page - ceil(($range/2))) ) {
            for ( $i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++ ) {
                $output .= ($i != $paged) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
            }
        }
        // Less pages than the range, no sliding effect needed
    } else {
        for ( $i = 1; $i <= $max_page; $i++ ) {
            $output .= ($i != $paged) ? '<a href="' . get_pagenum_link($i) .'">'.$i.'</a>' : '<span class="this-page">'.$i.'</span>';
        }
    }

    if ( $max_page > $range + 1 ){
        // On the last page, don't put the Last page link
        if ( $paged <= $max_page - ($range - 1) )
            $output .= '<span class="page-numbers">&hellip;</span><a href="' . get_pagenum_link($max_page) . '">' . $max_page . '</a>';
    }

    // Next page
    if($paged < $max_page)
        $output .= '<a class="next-page-link" href="' . get_pagenum_link($paged+1) . '">'. __('Next', 'epicomedia') .'</a>';

    $output .= '</div><!-- post-pagination -->';

    echo $output;
}


/*---------------------------------
    add  Feature image Column in Admin panel
------------------------------------*/

add_filter('manage_posts_columns', 'ep_add_post_thumbnail_column', 5); // Add the posts columns filter.
add_filter('manage_pages_columns', 'ep_add_post_thumbnail_column', 5); // Add the pages columns filter.

/*---------------------------------
     Add the column
------------------------------------*/

function ep_add_post_thumbnail_column($cols){
  $cols['ep_post_thumb'] = __('Featured', 'epicomedia');
  return $cols;
}

/*---------------------------------
    Hook into the posts an pages column managing. Sharing function callback again.
------------------------------------*/

add_action('manage_posts_custom_column', 'ep_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'ep_display_post_thumbnail_column', 5, 2);

/*---------------------------------
    Grab featured-thumbnail size post thumbnail and display it.
------------------------------------*/

function ep_display_post_thumbnail_column($col, $id){
  switch($col){
    case 'ep_post_thumb':
        if( function_exists('the_post_thumbnail') ) {
        
            echo the_post_thumbnail( 'admin-list-thumb' );
           
        } else {
            echo 'Not supported in theme';
        }
      break;
  }
}

/*---------------------------------
    Search Pages by content 
------------------------------------*/

function ep_search_pages_by_content($cnt)
{
    // Get WPDB Object
    global $wpdb;

    $sql = $wpdb->prepare( "SELECT * FROM $wpdb->posts WHERE post_type='page' AND post_status='publish' AND post_content LIKE %s",
        '%' . $wpdb->esc_like($cnt) . '%' );

    // Get forms
    $pages = $wpdb->get_results( $sql );

    return $pages;
}


/*---------------------------------
    Custom Login Logo 
------------------------------------*/

function ep_login_logo() {

    $login_logo = ( ep_opt('login-logo') ? ep_opt('login-logo') : THEME_ADMIN_URI . '/img/wp_login_logo.png' );
    echo '<style type="text/css"> h1 a { background: url(' . $login_logo . ') center no-repeat !important; width:302px !important; height:67px !important; } </style>';
}
add_action('login_head', 'ep_login_logo');


/*---------------------------------
    Sidebar widget count 
------------------------------------*/

function ep_count_sidebar_widgets( $sidebar_id, $echo = false ) {
    $sidebars = wp_get_sidebars_widgets();

    if( !isset( $sidebars[$sidebar_id] ) )
        return -1;

    $cnt = count( $sidebars[$sidebar_id] );

    if( $echo )
        echo $cnt;
    else
        return $cnt;
}

/*---------------------------------
    Use shortcodes in text widgets.
------------------------------------*/
add_filter('widget_text', 'do_shortcode');

/*---------------------------------
    Get Sidebar 
------------------------------------*/

function ep_get_sidebar($id = 1, $class='') {
    $sidebarClass = "sidebar widget-area";

    if('' != $class)
        $sidebarClass .= " $class";

    if(ep_count_sidebar_widgets($id) < 1)
        $sidebarClass .= ' no-widgets';
?>
    <div class="<?php echo $sidebarClass; ?>"><?php dynamic_sidebar($id); ?></div>
<?php
}

/*---------------------------------
     woocomerce
------------------------------------*/

	// Ensure cart contents update when products are added to the cart via AJAX 
	function ep_cart_fragments( $fragments ) {
		
	    global $woocommerce;
	    
	    ob_start();
	    ?>

		<li class="wc_shop">
			<a class="header_cart" href="<?php echo esc_url($woocommerce-> cart->get_cart_url()); ?>">
				<span class="header_cart_span">
					<?php echo esc_attr($woocommerce->cart->cart_contents_count); ?>
				</span>

				<div class="triangle"></div>
			</a>
	
			<?php
				$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
				$list_class = array( 'cart_list', 'product_list_widget' );
			?>

			<ul class="<?php echo implode(' ', $list_class); ?>" style="transition: all 0s ease; -webkit-transition: all 0s ease; display: none;">
										
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
							<a href="<?php echo get_permalink( esc_attr($cart_item['product_id'] )); ?>">

								<?php echo $_product->get_image(); ?>
											
								<div class="wc_cart_product_info">
									<div class="wc_cart_product_name">
											<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
									</div>

									<?php echo $woocommerce->cart->get_item_data( $cart_item ); ?>
                                       
                                    <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity_price"><span class="quantity">'. sprintf( '%s x',$cart_item['quantity'] ) . '</span><span class="price">' . sprintf( '%s',$product_price ) .'</span></span>',$cart_item ,$cart_item_key ); ?>
                                            
								</div>
							</a>
						</li>

					<?php endforeach; ?>

				<?php  } else { ?>

					<li class="no_products">
						<span class="no_products_span">
							<?php _e('No products in the cart.', 'woocommerce' ); ?>
						</span>
					</li>

				<?php }; ?>

				<li>
					
					<div class="total"><?php _e('SUBTOTAL ', 'woocommerce' ); ?> : <span><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></div>
					 
					<a href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>" class="button cartbtn qbutton white">
						<?php _e('VIEW CART', 'woocommerce' ); ?>
                        
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
						<?php _e('CHECKOUT', 'woocommerce' ); ?>
					</a>
					
				</li>
			</ul>
		</li>
		
	    <?php

	    $fragments['li.wc_shop'] = ob_get_clean();
	    return $fragments;
	}
	
	add_filter('add_to_cart_fragments', 'ep_cart_fragments');

    // Adds theme support for woocommerce 
	add_theme_support('woocommerce');

    // Redefine woocommerce_get_product_thumbnail 

	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post;

		if ( has_post_thumbnail() )
			return "<div class=\"imageswrap productthumbnail\"><div class=\"imageHOpacity\"></div>".get_the_post_thumbnail( $post->ID, $size )."</div>";
		elseif ( wc_placeholder_img_src() )
			return wc_placeholder_img( $size );
	}

    if(function_exists('is_woocommerce')) {

        function woo_hide_page_title() {
            
            return false;
            
        }
        
        if(ep_opt('shop-title-display') == 0)
            add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );

    }


    // change priotity for woocomerce single price in shop loops
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
    add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 ); 

    // Display 12 products per page.
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
    
    function woocommerce_social_share()
    {
        global $post;
        // try getting featured image -  pinterest icon 
        $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
        if( ! $featured_img )
        {
            $featured_img = '';
        }
        else
        {
            $featured_img = $featured_img[0];
        }
    
        $output =   '
                    <div class="socialShareContainer">
                        <div class="social_share_toggle">
                            <i class="icon-share2"></i>
                            <div class="social_links">
                                <ul class="social_links_list">
                                    <!-- facebook Social share button -->
                                    <li>
                                        <a href="http://www.facebook.com/sharer.php?u=' . urlencode(get_permalink(get_the_ID())) . '" onclick="return popitup(this.href, this.title)" title="' . __("Share on Facebook!",'epicomedia') .'">
                                            <i class="icon-facebook3"></i>
                                        </a>
                                    </li>
                                                                
                                    <!-- google plus social share button -->
                                    <li>
                                        <a href="https://plus.google.com/share?url=' . urlencode(get_permalink(get_the_ID())) . '" onclick="return popitup(this.href, this.title)" title="' . __("Share on Google+!",'epicomedia') . '">
                                            <i class="icon-googleplus2"></i>
                                        </a>
                                    </li>
                                                                
                                    <!-- twitter icon  --> 
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?original_referer=' . urlencode(get_permalink(get_the_ID())) . '&amp;source=tweetbutton&amp;text=' . urlencode(get_the_title()) . '&amp;url=' . urlencode(get_permalink(get_the_ID())) . '" onclick="return popitup(this.href, this.title)"
                                            title="' . __("Share on Twitter!", 'epicomedia') . '">
                                            <i class="icon-twitter2"></i>
                                        </a>
                                    </li>
                                                    
                                    <!-- pinterest icon --> 
                                    <li>
                                        <a href="http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink(get_the_ID())) . '&amp;media=' . esc_attr($featured_img) . '&amp;description=' . urlencode(get_the_title()) . '" 
                                            class="pin-it-button" 
                                            count-layout="horizontal">
                                                <i class="icon-pinterest2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>';

        echo $output;
    }

    // deregister wc-price-slider - rewrte this function
    function my_scripts_method() {
        wp_deregister_script('wc-price-slider');
    }  
    
    add_action('wp_enqueue_scripts', 'my_scripts_method');


    /*-----------------------------------------------------------------*/
    /* Get all exception pages of ajax
    /*-----------------------------------------------------------------*/
    function no_ajax_pages() {

        $no_ajax_pages = array();

        //get all woocommerce pages and products and merge with main array
        $no_ajax_pages = array_merge($no_ajax_pages, woocommerce_pages());

        //get wishlist page
        $no_ajax_pages = array_merge($no_ajax_pages, wishlist_page());

        //get translation pages for current page and merge with main array
        $no_ajax_pages = array_merge($no_ajax_pages, get_wpml_pages_of_current_page());

        //add logout url to main array
        $no_ajax_pages[] = htmlspecialchars_decode(wp_logout_url());

        return $no_ajax_pages;
    }

    function get_wpml_pages_of_current_page() {
        $wpml_pages_of_current_page = array();

        if(defined('ICL_SITEPRESS_VERSION')) {
            $language_pages = icl_get_languages('skip_missing=0');

            foreach($language_pages as $key => $language_page) {
                $wpml_pages_of_current_page[] = $language_page["url"];
            }
        }

        return $wpml_pages_of_current_page;
    }

    function wishlist_page() {
        global $yith_wcwl;
        $wishlist_page = array();
        if (class_exists('YITH_WCWL'))
        {
            $wishlist_page[] = $yith_wcwl->get_wishlist_url();
        }
            

        return $wishlist_page;
    }

    function woocommerce_pages() {
        $woo_pages = array();

        if(function_exists('is_woocommerce')) {
            if(get_option('woocommerce_pay_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_pay_page_id'));

            if(get_option('woocommerce_thanks_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_thanks_page_id'));

            if(get_option('woocommerce_myaccount_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_myaccount_page_id'));

            if(get_option('woocommerce_edit_address_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_edit_address_page_id'));

            if(get_option('woocommerce_view_order_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_view_order_page_id'));

            if(get_option('woocommerce_terms_page_id') != '')
                $woo_pages[] = get_permalink(get_option(' woocommerce_terms_page_id'));

            if(get_option('woocommerce_shop_page_id') != '')
                $woo_pages[] = get_permalink(get_option('woocommerce_shop_page_id'));

            if(get_option('woocommerce_cart_page_id') != '')
                $woo_pages[] = get_permalink(get_option('woocommerce_cart_page_id'));

            if(get_option('woocommerce_checkout_page_id') != '')
                $woo_pages[] = get_permalink(get_option('woocommerce_checkout_page_id'));

            $woo_products = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );

            foreach($woo_products as $product) {
                $woo_pages[] = get_permalink($product->ID);
            }
        }

        return $woo_pages;
    }

    /*-----------------------------------------------------------------*/
    /* Woocommerce number of columns for shop page with sidebar
    /*-----------------------------------------------------------------*/

    if (class_exists('Woocommerce')) {
	    $page_id = woocommerce_get_page_id('shop');
        $sidebar = ep_opt('shop-sidebar-position'); // detect side bar position that set in admin panel
    
	    if (!(0 == $sidebar)) { // if shop page not be widthout sidebar below code run.
		    add_filter( 'loop_shop_columns', 'wc_loop_shop_columns', 1, 10 );
		    function wc_loop_shop_columns( $number_columns ) {
			    return 3;
		    }
	    }
    }

    //Add share buttons to single product page
    add_action( 'woocommerce_single_product_summary', 'woocommerce_social_share', 32 );

    // Display 12 products per page.
    add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );
    

    if (class_exists('YITH_WCWL')){
        add_action('woocommerce_after_shop_loop_item','shop_page_wishlist_button',11);
    }

    function shop_page_wishlist_button() {
        global $product;
        global $yith_wcwl;

        $default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;

        if( ! empty( $default_wishlists ) ){
            $default_wishlist = $default_wishlists[0]['ID'];
        }
        else{
            $default_wishlist = false;
        }

        $output = '<a href="'. esc_url( add_query_arg( "add_to_wishlist", $product->id ) ) .'" rel="nofollow" data-product-id="' .$product->id . '" data-product-type="' . $product->product_type . '" class="add_to_wishlist shop_wishlist_button ' .($yith_wcwl->is_product_in_wishlist($product->id , $default_wishlist) == true ? "exist_in_wishlist ": "") .'"></a>';
        $output .= '<a href="'. esc_url($yith_wcwl->get_wishlist_url()) . '" rel="nofollow" class="wishlist-link shop_wishlist_button" style="' .($yith_wcwl->is_product_in_wishlist($product->id , $default_wishlist) == true ? "display:block; ": "") .'"></a>';
        $output .= '<div class="blockUI blockOverlay ui-widget-overlay  ajax-loading" style="visibility:hidden;"></div>';

        echo $output;
    }

    // Update wishlist widget
    add_action('wp_ajax_get_card_quantity', 'get_card_quantity');
    add_action('wp_ajax_nopriv_get_card_quantity', 'get_card_quantity');

    function get_card_quantity() {
        global $woocommerce;

        $nonce = $_REQUEST['ajax_nonce'];
         
        // check to see if the submitted nonce matches with the
        // generated nonce we created earlier
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
           die ( 'Failed!');

        $data = array(
            'card_count_products' => $woocommerce->cart->cart_contents_count
        );
        wp_send_json($data);
    }

    // Update wishlist widget
    add_action('wp_ajax_get_wishlist_quantity', 'get_wishlist_quantity');
    add_action('wp_ajax_nopriv_get_wishlist_quantity', 'get_wishlist_quantity');

    function get_wishlist_quantity() {
        global $yith_wcwl;

        $nonce = $_REQUEST['ajax_nonce'];

        // check to see if the submitted nonce matches with the
        // generated nonce we created earlier
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
           die ( 'Failed!');

        $data = array(
            'wishlist_count_products' => yith_wcwl_count_products()
        );
        wp_send_json($data);
    }

    // add 'row' that wrap feilds
    function ep_comment_before_fields () {
        echo '<div class="row">';
    }
    
    function ep_comment_after_fields () {
        echo '</div>';
    }
    
    
/*---------------------------------
    Add FeatureImage Boxes In Portfolio
------------------------------------*/

require_once(THEME_LIB . '/includes/multi-post-thumbnails.php');

if (class_exists('MultiPostThumbnails')) { 

   $featureImageNum = 4;
   $counter = 2;

    while ( $counter < ($featureImageNum)) {
    
        // Add Slides in Portfolio Items
        new MultiPostThumbnails(
            array(
                'label' => 'Featured Image ' . $counter,
                'id' => $counter . '-slide',
                'post_type' => 'portfolio'
            ));
    
    $counter++;
    
    }
}

function portfolio_detail_query_vars( $qvars ) {
  $qvars[] = 'inner';
  return $qvars;
}
add_filter( 'query_vars', 'portfolio_detail_query_vars' , 10, 1 );


/*---------------------------------
    Add NEXT/PREV item in portfolio detail
------------------------------------*/

add_action('wp_ajax_load_pd_navigation', 'load_portfolio_detail_navigation');
add_action('wp_ajax_nopriv_load_pd_navigation', 'load_portfolio_detail_navigation');

function load_portfolio_detail_navigation() {
    $skill_ids;
    $back_url;
    $id;

    if ( isset($_REQUEST) ) {

        $nonce = $_REQUEST['ajax_nonce'];
        $id = wp_filter_nohtml_kses($_REQUEST['pid']);
        $skill_ids = explode(" ", wp_filter_nohtml_kses($_REQUEST['skill_ids']));
        $back_url = wp_filter_nohtml_kses($_REQUEST['back_url']);


        // check to see if the submitted nonce matches with the
        // generated nonce we created earlier
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
           die ( 'Failed!');

        if($skill_ids[0] == 'all')
        {
            $tax_query = array();
        }
        else
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'skills',
                    'field' => 'id',
                    'terms' => $skill_ids
                )
            );
        }
        $args = array( 
        'fields' =>'ids', //we don't really need all post data so just id wil do fine.
        'posts_per_page' => -1, //-1 to get all post
        'post_type' => 'portfolio', 
        'tax_query' => $tax_query
        );

        $post_ids = get_posts( $args );
  
        $thisindex = array_search($id, $post_ids);

        if( $thisindex == 0 )
        {
            $previd = "";
        }
        else
        {
            $previd = $post_ids[$thisindex-1];
        }


        if( $thisindex == count($post_ids) -1 )
        {
            $nextid = "";
        }
        else
        {
            $nextid = $post_ids[$thisindex+1];
        }


    ?>
        <div class="container">
            <div class="row ">
                <div class="span12">

                    <!-- Prev Arrows -->
                    <?php
                    if ( !empty( $previd ) ):
                        $thumb = wp_get_attachment_url( get_post_thumbnail_id($previd) );
                        $checkTitle = get_post_meta( $previd , "title-bar", true );
                        $title = get_post_meta( $previd, "title-text", true );
                        if ( ( $checkTitle == 0 ) || empty( $title )) {
                            $title = get_the_title($previd);
                        }
                    ?>

                        <a href="<?php echo get_permalink( $previd ); ?>" title="<?php _e('PREV', 'epicomedia'); ?>" class="portfolioDetailNavLink" data-pid="<?php echo $previd; ?>" data-skills="<?php echo implode(" ",$skill_ids); ?>">
                            <div class="arrows-button-prev no-select <?php if(!$thumb) { echo 'noTHumbnavigation';  } ?>">
                                <div class="pArrowsButtonThumb" style="<?php if($thumb != false) { echo 'background:url(' . $thumb . ')';  } ?>"></div>
                                <span class="text">
                                    <span>
                                        <?php echo esc_attr($title); ?>
                                    </span>
                                </span>
                            </div>
                        </a>

                    <?php endif; ?>


                    <!-- Back to portfolio -->
                    <a id="PDbackToPortfolio" href="<?php echo esc_url($back_url); ?>" title="<?php _e('Back to portfolio', 'epicomedia'); ?>" class="<?php if ( empty( $previd ) ) { echo "noPrev"; }?> <?php if ( empty( $nextid ) ) { echo "noNext"; }?>">
                        <div>
                            <span class="icon-grid2" data-name="grid2"></span>
                        </div>
                    </a>

                    <!-- Next Arrows -->
                    <?php
                    
                    if ( !empty( $nextid ) ):
                        $thumb = wp_get_attachment_url( get_post_thumbnail_id($nextid) );
                        $checkTitle = get_post_meta( $nextid, "title-bar", true );
                        $title = get_post_meta( $nextid, "title-text", true );
                        if ( ( $checkTitle == 0 ) || empty( $title )) {
                            $title = get_the_title( $nextid );
                        }
                        
                         ?>
                        <a href="<?php echo get_permalink( $nextid ); ?>" title="<?php _e('NEXT', 'epicomedia'); ?>"  class="portfolioDetailNavLink" data-pid="<?php echo $nextid; ?>" data-skills="<?php echo implode(" ",$skill_ids); ?>">
                            <div class="arrows-button-next no-select <?php if(!$thumb) { echo 'noTHumbnavigation';  } ?>">
                                <div class="pArrowsButtonThumb" style="<?php if($thumb  != false) { echo 'background:url( '. $thumb . ')';  } ?>"></div>
                                <span class="text">
                                    <span>
                                        <?php echo esc_attr($title); ?>
                                    </span>
                                </span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
    }
    die();
}

/*---------------------------------
    Add NEXT/PREV item in portfolio detail
------------------------------------*/

add_action('wp_ajax_load_cpd_navigation', 'load_creative_portfolio_detail_navigation');
add_action('wp_ajax_nopriv_load_cpd_navigation', 'load_creative_portfolio_detail_navigation');

function load_creative_portfolio_detail_navigation() {
    $skill_ids;
    $back_url;
    $id;

    if ( isset($_REQUEST) ) {
        $nonce = $_REQUEST['ajax_nonce'];
        $id = wp_filter_nohtml_kses($_REQUEST['pid']);
        $skill_ids = explode(" ", wp_filter_nohtml_kses($_REQUEST['skill_ids']));
        $back_url = wp_filter_nohtml_kses($_REQUEST['back_url']);

        // check to see if the submitted nonce matches with the
        // generated nonce we created earlier
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
           die ( 'Failed!');


        if($skill_ids[0] == 'all')
        {
            $tax_query = array();
        }
        else
        {
            $tax_query = array(
                array(
                    'taxonomy' => 'skills',
                    'field' => 'id',
                    'terms' => $skill_ids
                )
            );
        }

        $args = array( 
        'fields' =>'ids', //we don't really need all post data so just id wil do fine.
        'posts_per_page' => -1, //-1 to get all post
        'post_type' => 'portfolio', 
        'tax_query' => $tax_query
        );

        $post_ids = get_posts( $args );
  
        $thisindex = array_search($id, $post_ids);

        if( $thisindex == 0 )
        {
            $previd = "";
        }
        else
        {
            $previd = $post_ids[$thisindex-1];
        }


        if( $thisindex == count($post_ids) -1 )
        {
            $nextid = "";
        }
        else
        {
            $nextid = $post_ids[$thisindex+1];
        }
    ?>

        <!-- Next Arrows -->
        <?php
        
        if ( !empty($nextid )):
             ?>
            <a href="<?php echo get_permalink( $nextid ); ?>" title="<?php _e('NEXT', 'epicomedia'); ?>"  class="portfolioDetailNavLink" data-pid="<?php echo $nextid; ?>" data-skills="<?php echo implode(" ",$skill_ids); ?>">
                <div class="arrows-button-next no-select">
                    <span class="text">
                        <?php _e('NEXT', 'epicomedia'); ?>
                    </span>
                </div>
            </a>
        <?php endif; ?>

        <!-- Back to portfolio -->
        <a id="PDbackToPortfolio" href="<?php echo esc_url($back_url); ?>" title="<?php _e('Back to portfolio', 'epicomedia'); ?>" class="<?php if ( empty( $nextid ) ) { echo "noNext"; }?>">
            <div>
                <span class="backToPortfolio" data-name="grid2"></span>
            </div>
        </a>

        <!-- Prev Arrows -->
        <?php
        if ( !empty( $previd ) ):
        ?>

            <a href="<?php echo get_permalink( $previd ); ?>" title="<?php _e('PREV', 'epicomedia'); ?>" class="portfolioDetailNavLink" data-pid="<?php echo $previd; ?>" data-skills="<?php echo implode(" ",$skill_ids); ?>">
                <div class="arrows-button-prev no-select">
                    <span class="text">
                        <?php _e('PREV', 'epicomedia'); ?>
                    </span>
                </div>
            </a>

        <?php endif;
    }
    die();
}

/*---------------------------------
    Get Portfolio Slides
------------------------------------*/

if (!function_exists('ep_thumbnail_post_slideshow')) :

    function ep_thumbnail_post_slideshow ($image_size, $id ,$post_name , $pDTargetCheck , $terms , $isLink , $pLink ) {

        // Add slideshow javascript
        global $add_slider;
        $add_slider = true;

        $maxthumbnum = 3;

        // Set the slideshow variable
        $slideshow = '';

        // Get The Post Type
        $posttype = get_post_type( $id );

        // Check whether the slide should link
        $permalink = get_permalink($id);
        $title = get_the_title($id); // get the item title
        
        //For custom taxonomy use this line below
        $terms = wp_get_object_terms( $id , 'skills' );
        $term_names = array();
        foreach( $terms as $term )
            $term_names[] = $term->name;

        
        if ( $isLink == true) {
        
              $permalink = '<a href="'.  $pLink .'"  title="'.$title.'" class="portfolioLink overlay thumbnail-'.$image_size.'" target="_blank">';
        
        } else {
        
                if ( $pDTargetCheck == 'portfolio_detail_inner' ) { //portfolio Ajax enable
                    
                    if(is_home()){ // If Your Portfolio item in Home Page - Portfolio link for fetch Ajax is below form
                          
                        $permalink = '<a href="'.home_url().'/#!portfolio-detail/'.$post_name.'"  title="'.$title.'" class="no_djax portfolioLink overlay thumbnail-'.$image_size.'">';
                        
                    } else {
                          $permalink = '<a href="'.   $_SERVER["REQUEST_URI"] .'#!portfolio-detail/'.$post_name.'"  title="'.$title.'" class="no_djax portfolioLink overlay thumbnail-'.$image_size.'">';
                          
                    }
                    
                } else { //portfolio Ajax Disable
                    $permalink = '<a href="'. home_url() .'/?portfolio='.$post_name.'"  title="'.$title.'" class="portfolioLink overlay thumbnail-'.$image_size.'" data-pid="'.$id .'">';
                }

        }
        
        $permalinkend = '</a>';

        $counter = 2; //start counter at 2

        $full = get_post_meta($id,'_thumbnail_id',false); // Get Image ID

        $image_size = 'ep_thumbnail-'.$image_size;

        // Get all slides
        while ($counter <= ($maxthumbnum)) {

            ${"full" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id); // Get Image ID

            ${"alt" . $counter} = get_post_meta(${"full" . $counter} , '_wp_attachment_image_alt', true); // Alt text of image
            ${"full" . $counter} = wp_get_attachment_image_src(${"full" . $counter}, false); // URL of Second Slide Full Image

            ${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id);
            ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, $image_size, false); // URL of next Slide


        $counter++;

        }

        //number of entered thumbnails
        $maxthumbnumset = 0;
        if($full)
            $maxthumbnumset = 1;

        if(isset($thumb2[0]) && $thumb2[0] != '')
            $maxthumbnumset++;

        if(isset($thumb3[0]) && $thumb3[0] != '')
            $maxthumbnumset++;

        // If there's a featured image
        if($maxthumbnumset > 0) {
            $thumb = '';
            if($full)
            {
                $alt = get_post_meta($full, '_wp_attachment_image_alt', true); // Alt text of image

                $thumb = get_post_meta($id,'_thumbnail_id',false);
                $thumb = wp_get_attachment_image_src($thumb[0], $image_size, false);  // URL of Featured first slide
            }

            $slideshow .= $permalink.'<div class="hoverContent">';
            $slideshow .= '<div class="frame top">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame right">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame bottom">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame left">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="icon-wrap"><div class="icon-type"></div></div><div class="center-line"></div><div class="title-wrap"><div class="titleContainer"><div class="hover-title">'.get_the_title($id).'</div><div class="hover-subtitle">'. implode( ', ', $term_names ). '</div></div></div>';
            $slideshow .= '</div>';
            $slideshow .=  $permalinkend;
            $slideshow .= '<div class="like">' . getPostLikeLink($id). '</div>';
            // If there's more than one slide and the device is not iPad
            if($maxthumbnumset > 1 && isset($_SERVER['HTTP_USER_AGENT']) && !strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') )
                $slideshow .= '<div class="portfolioswiper swiper-container"><div class="swiper-wrapper">';

            $thumb1 = $thumb;

            // Loop through thumbnails and set them
            $tcounter = 1;
            while ( $tcounter <= $maxthumbnum ){
                if ( ${'thumb' . $tcounter}){

                    //If there is just 1 thumb or it is ipad
                    if($maxthumbnumset == 1 || (isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) )
                    {
                        $slideshow .= '<div class="pSlide" style="background-image: url('. ${'thumb' . $tcounter}[0]  .');"></div>';
                        break;
                    }
                    else
                    {
                        $slideshow .= '<div class="pSlide swiper-slide" style="background-image: url('. ${'thumb' . $tcounter}[0]  .');"></div>';
                    }

                }
                $tcounter++;
            }

            if($maxthumbnumset > 1 && isset($_SERVER['HTTP_USER_AGENT']) && !strstr($_SERVER['HTTP_USER_AGENT'], 'iPad') )
                $slideshow .= '</div></div>';


        } else {


            $slideshow .= '<div class="pSlide"></div>';
            $slideshow .= $permalink.'<div class="hoverContent">';
            $slideshow .= '<div class="frame top">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame right">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame bottom">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame left">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="icon-wrap"><div class="icon-type"></div></div><div class="center-line"></div><div class="title-wrap"><div class="titleContainer"><div class="hover-title">'.get_the_title($id).'</div><div class="hover-subtitle">'. implode( ', ', $term_names ). '</div></div></div></div>';
            $slideshow .=  $permalinkend;
            $slideshow .= '<div class="like">' . getPostLikeLink($id). '</div>';
            
        } // End if $full

        return $slideshow;

    }
endif;
/*---------------------------------
    Get Gallery Slides
------------------------------------*/

if (!function_exists('ep_thumbnail_gallery_slideshow')) :

    function ep_thumbnail_gallery_slideshow ($image_size, $id ,$post_name , $terms , $isLink , $pLink ) {

        // Add slideshow javascript
        global $add_slider;
        $add_slider = true;

        $maxthumbnum = 3;

        // Set the slideshow variable
        $slideshow = '';

        // Get The Post Type
        $posttype = get_post_type( $id );

        // Check whether the slide should link
        $permalink = get_permalink($id);
        $title = get_the_title($id); // get the item title
        
        //For custom taxonomy use this line below
        $terms = wp_get_object_terms( $id , 'gallery_cat' );
        $term_names = array();
        foreach( $terms as $term )
        $term_names[] = $term->name;

        
        if ( $isLink == true) {
        
              $permalink = '<div class="galleryItem" data-sub-html=" <h4> '.get_the_title($id).'</h4><p>'.get_post_meta( $id , "subtitle-text", true ).'</p>" data-src="'.  $pLink .'"><a href="'.  $pLink .'"  title="'.$title.'" class="portfolioLink overlay thumbnail-'.$image_size.'">';
        
        } else {
						  $gallery_url='';
						  $gallery_url = get_post_meta($id,'_thumbnail_id',false);
                          $gallery_url = wp_get_attachment_image_src($gallery_url[0], $image_size, false);
                          $permalink = '<div class="galleryItem" data-sub-html=" <h4> '.get_the_title($id).'</h4><p>'.get_post_meta( $id , "subtitle-text", true ).'</p>" data-src="'.$gallery_url[0].'"><a href="'.$gallery_url[0].'"  title="'.$title.'" class=" portfolioLink overlay thumbnail-'.$image_size.'">';
               }

        
        $permalinkend = '</a></div>';
        $counter = 2; //start counter at 2

        $full = get_post_meta($id,'_thumbnail_id',false); // Get Image ID

        $image_size = 'ep_thumbnail-'.$image_size;

        // Get all slides

            ${"full" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id); // Get Image ID

            ${"alt" . $counter} = get_post_meta(${"full" . $counter} , '_wp_attachment_image_alt', true); // Alt text of image
            ${"full" . $counter} = wp_get_attachment_image_src(${"full" . $counter}, false); // URL of Second Slide Full Image

            ${"thumb" . $counter} = MultiPostThumbnails::get_post_thumbnail_id($posttype, $counter . '-slide', $id);
            ${"thumb" . $counter} = wp_get_attachment_image_src(${"thumb" . $counter}, $image_size, false); // URL of next Slide

        //number of entered thumbnails
            $maxthumbnumset = 1;

        // Show featured image
            $thumb = '';
            if($full)
            {
                $alt = get_post_meta($full, '_wp_attachment_image_alt', true); // Alt text of image

                $thumb = get_post_meta($id,'_thumbnail_id',false);
                $thumb = wp_get_attachment_image_src($thumb[0], $image_size, false);  // URL of Featured first slide
            }

            $slideshow .= $permalink.'<div class="hoverContent">';
            $slideshow .= '<div class="frame top">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame right">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame bottom">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="frame left">';
            $slideshow .= '<div></div>';
            $slideshow .= '</div>';
            $slideshow .= '<div class="icon-wrap"><div class="icon-type"></div></div><div class="center-line"></div><div class="title-wrap"><div class="titleContainer"><div class="hover-title" >'.get_the_title($id).'</div><div class="hover-subtitle">'. implode( ', ', $term_names ). '</div></div></div>';
            $slideshow .= '</div>';
            $slideshow .=  $permalinkend;
            $slideshow .= '<div class="like">' . getPostLikeLink($id). '</div>';
            

            $thumb1 = $thumb;

            // Loop through thumbnails and set them
            $tcounter = 1;
            while ( $tcounter <= $maxthumbnum ){
                if ( ${'thumb' . $tcounter}){

                    //If there is just 1 thumb or it is ipad
                    if($maxthumbnumset == 1 || (isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')) )
                    {
                        $slideshow .= '<div class="pSlide" style="background-image: url('. ${'thumb' . $tcounter}[0]  .');"><a href="'. ${'thumb' . $tcounter}[0]  .'" ></a></div>';
                        break;
                    }
                    else
                    {
                        $slideshow .= '<div class="pSlide" style="background-image: url('. ${'thumb' . $tcounter}[0]  .');"><a href="'. ${'thumb' . $tcounter}[0]  .'"></a></div>';
                    }

                }
                $tcounter++;
            }

        return $slideshow;

    }
endif;
/*-----------------------------------------------------------------*/
/* Add Seo meta tags to header
/*-----------------------------------------------------------------*/
    
add_action( 'wp_head', 'ep_add_meta_tags' , 2 );

function ep_add_meta_tags() {
    global $post;
    
	if ( is_single() )
	{
		$id = get_the_ID();
		
        $postSeoDescription = get_post_meta($id, 'seo_description', true);
		$metakeywords= get_post_meta($id, 'seo_keywords', true);
		
		$author=$post->post_author;
		$author = get_userdata($author)->display_name;
		$title=$post->post_title;
		$link=get_permalink();
		$language = get_bloginfo( 'language'); 
		$sitetitle=get_bloginfo("name");
		$format = get_post_format($id) ? get_post_format($id) : "article" ;
		$posttags = get_the_tags($id);
		$date_published=$post->post_date;
		$date_modified=$post->post_modified;
		
		//retrieving post feature image url 
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url = $thumb_url_array[0];
		
		
		
		//Get post type to determine which term we should use in get the terms function
		$type= get_post_type();
		if("post"==$type){
			$tags=get_the_terms( $id, "post_tag" );
		}	
		if("portfolio"==$type){
			$tags=get_the_terms( $id, "skills" );
		}
		if("gallery"==$type){
			$tags=get_the_terms( $id, "gallery_cat" );
		}
		//Convert the tags array to comma separated list
		$portfolioSlugs = array();
        if(!empty($tags))
        {
            foreach($tags as $term) {
                $portfolioSlugs[$term->slug] = $term->name;
            }
        }
		$posttags=implode(",",$portfolioSlugs);
	
		
		//Printing the meta tags in header	
        echo '<meta name="description" content="' .  $postSeoDescription . '" />' . "\n";
        echo '<meta name="keywords" content="' . $metakeywords . '" />' . "\n";
		echo '<meta name="author" content="' . $author . '" />' . "\n";
		echo '<meta property="og:title"content="' . $title . '" />' . "\n";
		echo '<meta property="og:url" content="' . $link . '"  />' . "\n";
		echo '<meta property="og:image" content="' . $thumb_url . '" />' . "\n";
		echo '<meta property="og:image:url" content="' . $thumb_url . '" />' . "\n";
		echo '<meta property="og:locale" content="' . $language . '" />' . "\n";
		echo '<meta property="og:description" content="' .  $postSeoDescription . '" />' . "\n";
		echo '<meta property="og:site_name" content="' .  $sitetitle . '" />' . "\n";
		echo '<meta property="og:type" content="' .  $format . '" />'."\n";
		echo '<meta property="article:published_time" content="' .  $date_published . '" />'."\n";
		echo '<meta property="article:modified_time" content="' .  $date_modified . '" />'."\n";
		echo '<meta property="article:author" content="' .  $author . '" />'."\n";
		echo '<meta property="article:tag" content="' .  $posttags . '" />'."\n";
		echo '<meta itemprop="name" content="' .  $sitetitle . '">'."\n";
		echo '<meta itemprop="description" content="' .  $postSeoDescription . '">'."\n";
		echo '<meta itemprop="image" content="' . $thumb_url . '">'."\n";
    }
	
	if(is_page())
	{
		$id=get_the_ID();
		$postSeoDescription = get_post_meta($id, 'seo_description', true);
		$metakeywords= get_post_meta($id, 'seo_keywords', true);
		$author=$post->post_author;
		$author = get_userdata($author)->display_name;
		$title=$post->post_title;
		$link=get_permalink();
		$language = get_bloginfo( 'language'); 
		$sitetitle=get_bloginfo("name");
		$format = "article" ;
		$posttags = get_the_tags($id);
		$date_published=$post->post_date;
		$date_modified=$post->post_modified;
		//retrieving post feature image url 
		$thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
		$thumb_url = $thumb_url_array[0];
		
		
		//Printing the meta tags in header	
        echo '<meta name="description" content="' .  $postSeoDescription . '" />' . "\n";
        echo '<meta name="keywords" content="' . $metakeywords . '" />' . "\n";
		echo '<meta name="author" content="' . $author . '" />' . "\n";
		echo '<meta property="og:title" content="' . $title . '" />' . "\n";
		echo '<meta property="og:url" content="' . $link . '"  />' . "\n";
		echo '<meta property="og:locale" content="' . $language . '" />' . "\n";
		echo '<meta property="og:description" content="' .  $postSeoDescription . '" />' . "\n";
		echo '<meta property="og:site_name" content="' .  $sitetitle . '" />' . "\n";
		echo '<meta property="og:type" content="' .  $format . '" />'."\n";
		echo '<meta property="article:published_time" content="' .  $date_published . '" />'."\n";
		echo '<meta property="article:modified_time" content="' .  $date_modified . '" />'."\n";
		echo '<meta property="article:author" content="' .  $author . '" />'."\n";
		echo '<meta property="article:tag" content="' .  $metakeywords . '" />'."\n";
		echo '<meta property="og:image" content="' . $thumb_url . '" />' . "\n";
		echo '<meta property="og:image:url" content="' . $thumb_url . '" />' . "\n";
		echo '<meta itemprop="name" content="' .  $sitetitle . '">'."\n";
		echo '<meta itemprop="description" content="' .  $postSeoDescription . '">'."\n";
		echo '<meta itemprop="image" content="' . $thumb_url . '">'."\n";
	}
}

/*-----------------------------------------------------------------*/
// This will ensure that the proper doctype is added to our HTML for opengraph support
/*-----------------------------------------------------------------*/

function doctype_opengraph($output) {
    return $output . '
    itemscope 
    itemtype="http://schema.org/WebPage"
    prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');