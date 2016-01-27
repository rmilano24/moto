<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// include wordpress-importer plugin
require 'includes/ep-import.php';

class Ep_Importer{

    private $demos = array("demo1","demo2","demo3","demo4","demo5","demo6","demo7","demo8","demo9","demo10");
    private $media_ids = array();
    private $medias = array();

    function __construct() {
        // Initialize the menu
        add_action( 'admin_enqueue_scripts', array( $this, 'init_admin' ) );
        
        // Add menu item in admin
        add_action('admin_menu', array( $this,'menu_init'));

        // Set ajax callback to import data
        add_action( 'wp_ajax_importer_callback', array( $this,'importer_callback') );
        add_action('wp_ajax_nopriv_importer_callback', array( $this,'importer_callback'));

    } // end constructor


    function init_admin() {

        wp_enqueue_style('theme-admin-css',THEME_URI . '/lib/admin/css/style.css', false, '1.0.0', 'screen' );
        wp_enqueue_script( 'sweet-alert-js', THEME_ADMIN_URI . '/scripts/sweet-alert.min.js',array('jquery'), '0.4.1' );
        wp_enqueue_script('theme-admin-script', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery','sweet-alert-js'), '1.0.0');


    }

    function menu_init() {
    
        add_submenu_page( 'themes.php' , 'Demo Importer' , 'Demo Importer' , 'manage_options' , 'demo_importer' , array( $this,'importer_page') );
    
    }

    function importer_callback() 
    {
        global $wpdb; 
        $demo_name = "";

        if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
        
        if ( isset($_REQUEST) ) {
            $demo_name = sanitize_file_name($_REQUEST['demo_name']);
        }
        
        if($demo_name == '' || !in_array($demo_name, $this->demos)) {
            echo 0;
            die();
        }

        // Get the xml file from directory 
        $import_path = THEME_LIB ."/admin/dummydata/".$demo_name ."/" ;
        $import_xml_filepath = $import_path . $demo_name .".xml" ;
        $import_json_filepath = $import_path . $demo_name .".json" ;

        if(!is_file($import_xml_filepath) || !is_file($import_json_filepath))
        {
            echo 0;
            die();
        }

        /* Start the process of importing */

        //Import data
        $this->importData($import_xml_filepath);

        // Set Reading Options
        $this->setReadingOptions();

        //Set default placeholder images
        $this->add_attachment($import_xml_filepath);

        //Import revolution slider
        $this->importRevSlider($demo_name);

        //Update theme options
        $this->setThemeOptions($import_json_filepath);

        //Set Primary Navigation        
        $this->setNavigationMenu();

        /* import was successful */
        echo 1;
        die();
    }

    function importData($import_xml_filepath)
    {
        if ( class_exists( 'Ep_Import' ) ) {

            $Ep_Import = new Ep_Import();

            $Ep_Import->fetch_attachments = false;

            $Ep_Import->import($import_xml_filepath);

        }
    }

    function setThemeOptions($import_json_filepath)
    {
        $theme_options_json = file_get_contents( $import_json_filepath);
        $theme_data = json_decode( $theme_options_json , true );
        foreach($theme_data["options"] as $key => $value)
        {
            $option_values = maybe_unserialize( $value);
            if($key == "theme_vertex_options")
            {
                $options = array();
                foreach($option_values as $optionkey => $option_value)
                {
                    $media_url = wp_get_attachment_url($this->medias[0] );
                    $option_value = str_replace('EPICO_DEMO_IMAGE', $media_url, $option_value);
                    $options[$optionkey] = $option_value;
                }

                update_option(OPTIONS_KEY, $options);
            }
            else
            {
                $option_values = stripslashes_deep($option_values);
                update_option($key, $option_values);
            }
        }

    }

    function importRevSlider($demo_name )
    {
        // Get the xml file from directory 
        $import_path = THEME_LIB ."/admin/dummydata/".$demo_name ."/" ;
        $import_rev_slider = $import_path ."revslider.zip";

        # Import Layer Slider
        if(is_file($import_rev_slider) && class_exists('RevSlider'))
        {
            $slider = new RevSlider();
            ob_start();
            $response = $slider->importSliderFromPost(true, true, $import_rev_slider);
            $content = ob_get_clean();
        }
    }

    function setNavigationMenu()
    {
        $locations = get_theme_mod( 'nav_menu_locations' ); 
        $menus = wp_get_nav_menus(); 
        
        if( count($menus) >= 1 ) {
            $locations['primary-nav'] = (int)($menus[0]->term_id);
        }

        set_theme_mod( 'nav_menu_locations', $locations );

    }

    function setReadingOptions()
    {

        $mainPage = get_posts(array(
            'post_type'        => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'main-page.php'
        ));

        $homepage   = $mainPage[0]->ID;
        wp_reset_postdata();

        $blogPages = get_posts(array(
            'post_type'        => 'page',
            'meta_key' => 'page-type-switch',
            'meta_value' => 'blog-section'
        ));

        foreach ( $blogPages as $blog ) : setup_postdata( $blog );
            $blogType = get_post_meta($blog->ID,"blog-type-switch",true);
            if($blogType == 1)
                $posts_page = $blog->ID;
        endforeach;
        wp_reset_postdata();
            
        update_option('show_on_front', 'page');

        if( isset($homepage) ) {
            update_option('page_on_front',  $homepage);
        }

        if( isset($posts_page) ) {
            update_option('page_for_posts', $posts_page);
        }
    }

    function add_attachment($import_xml_filepath) {

        if ( !class_exists( 'Ep_Import' ) )
            return;

        $Ep_Import = new Ep_Import();

        //Get post IDs for add attachements to them
        $paresdXML = $Ep_Import->parse($import_xml_filepath);

        if ( is_wp_error( $paresdXML ) ) {
            die();
        }

        $posts = $paresdXML['posts'];
        $postIDs = array();

        foreach ( $posts as $post ) {

            if($post['post_type'] == 'post' || $post['post_type'] == 'page' || $post['post_type'] == 'slider' || $post['post_type'] == 'portfolio' || $post['post_type'] == 'product')
                $postIDs[] = $post['post_id'];
        }

        define('IMGPATH', THEME_LIB . '/admin/dummydata/img/placeholders/');
        $directory  = THEME_LIB_URI . '/admin/dummydata/img/placeholders/';
        $path       = wp_upload_dir();
        $images     = glob(IMGPATH.'{*.jpg,*.JPG,*.png}', GLOB_BRACE);
        $attach_urls = array();

        foreach ($images as $image) {
            $filename     = basename($image);
            $media_exists = get_page_by_title($filename, 'OBJECT', 'Attachment');
            if ($media_exists == null) {
                if(wp_mkdir_p($path['path'])) {
                    $file = $path['path'] . '/' . $filename;
                } else {
                    $file = $path['basedir'] . '/' . $filename;
                }
                $image_data   = file_get_contents($image);
                file_put_contents($file, $image_data);
                $wp_filetype = wp_check_filetype($filename, null );
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => sanitize_file_name($filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );
                $attach_id   = wp_insert_attachment( $attachment, $file);
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                wp_update_attachment_metadata( $attach_id, $attach_data );      
                $this->media_ids[] =  $attach_id;
                $attachment_url = wp_get_attachment_url($attach_id );
                $attach_urls[] = $attachment_url;
                $this->medias[] = $attachment_url;
            } else {
                $query_images_args = array(
                    'post_type' => 'attachment',
                    'post_mime_type' =>'image',
                    'post_status' => 'inherit',
                    'posts_per_page' => -1,
                );
                $query_images = new WP_Query( $query_images_args );
                foreach ( $query_images->posts as $image) {
                    $image_url = wp_get_attachment_url( $image->ID );
                    if (strpos($image_url,'placeholder')!== false) {
                        $attach_id = $image->ID;
                        $this->media_ids[] = $attach_id;
                        $attach_urls[] = $image_url;
                        $this->medias[] = $image_url;

                    }
                }
                wp_reset_query();
            }

        }

        foreach ($postIDs as $post_id) {
            $attach_id = $this->media_ids[array_rand($this->media_ids)];


            //set featured images
            if(has_post_thumbnail($post_id))
                set_post_thumbnail($post_id, $attach_id);
        }

        foreach ( $posts as $post ) {

            if($post['post_type'] == 'post' || $post['post_type'] == 'page' || $post['post_type'] == 'slider' || $post['post_type'] == 'portfolio' || $post['post_type'] == 'product')
            {
                //Update shortcodes images
                $postContent = $this->preg_replace_plus('/EPICO_DEMO_IMAGE_ID/' , $this->media_ids  , $post['post_content']);
                $postContent = $this->preg_replace_plus('/EPICO_DEMO_IMAGE/' , $this->medias ,   $postContent);

                $new_post = array(
                    'ID'           => $post['post_id'],
                    'post_type'    => $post['post_type'],
                    'post_content' => $postContent,
                );

                wp_update_post( $new_post );


                //Update options
                $metas = get_post_meta($post['post_id']);
                foreach ($metas as $key => $values) {
                    $images = array();

                    for($i = 0; $i< count($values); $i++) {
                        if (strpos($values[$i],'EPICO_DEMO_IMAGE') !== false) {
                            $attach_url = $attach_urls[array_rand($attach_urls)];
                            $images[] = $attach_url;
                        }
                    }

                    if(count($images)==1)
                    {
                        delete_post_meta($post['post_id'], $key);
                        update_post_meta($post['post_id'], $key,$images[0]);
                    }
                    elseif(count($images) > 1)
                    {
                        delete_post_meta($post['post_id'], $key);
                        update_post_meta($post['post_id'], $key,$images);
                    }

                    unset($images);

                }

            }
        }

    }

    function preg_replace_plus($search_pattern,$replacement, $subject) {
        return preg_replace_callback($search_pattern, function($matches) use (&$replacement) {
            return $replacement[array_rand($replacement)];
        }, $subject);
    }

    function importer_page() { ?>
        
        <div id="ep-importer-box">
            <div class="box-title">
                <h2><?php _e( 'Demo Importer' , 'epicomedia' ); ?> </h2>
                <p>Install each one of these demos, just click on the one you like and nothing else.</p>
            </div>
            <div class="alert-box">
                <div class="loader">
                    <ul class="stones">
                        <li class="one"></li>
                        <li class="two"></li>
                        <li class="three"></li>
                        <li class="four"></li>
                        <li class="five"></li>
                    </ul>
                </div>
                <div class="success">
                    <div class="sa-icon sa-success">
                         <span class="sa-line sa-tip animateSuccessTip"></span>
                         <span class="sa-line sa-long animateSuccessLong"></span>
                         <div class="sa-placeholder"></div> <div class="sa-fix"></div>
                     </div>
                </div>
                <div class="fail">
                    <div class="sa-icon sa-error animateErrorIcon" style="display: block;">
                        <span class="sa-x-mark animateXMark">
                            <span class="sa-line sa-left"></span>
                            <span class="sa-line sa-right"></span>
                        </span>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Display demos -->
            <div id="demo-container">
                <!--demo 1 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 1</h3>
                        <p>One page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo1" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo1">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo1.jpg" />  
                </div>
                <!--demo 2 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 2</h3>
                        <p>One page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo2" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo2">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo2.jpg" />  
                </div>
                <!--demo 3 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 3</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo3" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo3">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo3.jpg" />  
                </div>
                <!--demo 4 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 4</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo4" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo4">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo4.jpg" />  
                </div>
               <!--demo 5 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 5</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo5" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo5">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo5.jpg" />  
                </div>
               <!--demo 6 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 6</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo6" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo6">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo6.jpg" />  
                </div>
               <!--demo 7 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 7</h3>
                        <p>One page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo7" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo7">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo7.jpg" />  
                </div>
               <!--demo 8 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 8</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo8" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo8">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo8.jpg" />  
                </div>
               <!--demo 9 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 9</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo9" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo9">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo9.jpg" />  
                </div>
               <!--demo 10 -->
                <div class="demo">
                    <div class="description">
                        <h3 class="demo-name">Demo 10</h3>
                        <p>Multi page</p>
                        <a target="_blank" href="#" class="button import"><?php _e('Import' , 'epicomedia'); ?></a>
                        <a target="_blank" href="http://www.epicomedia.net/vertex-demo10" class="button"><?php _e('Preview' , 'epicomedia'); ?></a>
                        <input type="hidden" id="demo_name" name="demo_name" value="demo10">
                    </div>
                    <div class="overlay"></div>
                    
                    <img src="<?php echo THEME_LIB_URI; ?>/admin/dummydata/img/demo10.jpg" />  
                </div>
                
     <?php
    
    }

}

// instantiate class
$GLOBALS['Ep_Importer'] = new Ep_Importer();

?>