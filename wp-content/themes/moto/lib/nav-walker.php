<?php
class Ep_CustomMenu {

  /**
   * Constructor
   */
  
  static $options = array();
   
  static $fields_template = array(
    'checkbox' => '
      <p class="additional-menu-field-{name} description description-wide">
        <label for="edit-menu-item-{name}-{id}">
          {label}<br>
          <input type="checkbox" id="edit-menu-item-{name}-{id}" class="widefat code edit-menu-item-{name}" name="menu-item-{name}{id}" value="{value}" {checked}>
          <span>{description}</span>
        </label>
      </p>
    ',
  );

  function __construct() {
    // Initialize the menu
    add_action( 'init', array( $this, 'init' ) );
    
    // Add custom field to menu
    add_filter( 'nav_menu_item_additional_fields', array( $this, 'add_fields' ), 10, 5 );
    
    // save menu custom fields
    add_action( 'save_post', array( $this, 'save_post' ) );
    
    // Change walker class used when adding menu items
    add_filter( 'wp_edit_nav_menu_walker', function () {
    
      return 'EP_Walker_Nav_Menu_Edit';
      
    });


  } // end constructor
  
  
  /**
   * Define new fields
   */
  static function init() {
    // Define new fields
    self::$options['fields'] = array(
      'checkbox' => array(
        'name' => 'show-in-menu-switch',
        'label' => __('Menu Display', 'epicomedia' ),
        'description' => __('If you check, this item  will be hide in menu', 'epicomedia' ),
        'container_class' => '',
        'type' => 'checkbox'
      ),
    );
  }
  
  
  /**
   * Add custom fields to menu
   */
  static function add_fields( $new_fields, $item_output, $item, $depth, $args ) {
  
    $schema = self::get_fields_schema();
      $value ='';

      foreach($schema as $field) {
      $value = get_post_meta($item->ID, $field['name'], true);
       
      $field['id'] = $item->ID;
      $new_fields .= str_replace(
        array_map(function($key){ return '{' . $key . '}'; }, array_keys($field)),
        array_values(array_map('esc_attr', $field)),
        self::$fields_template[$field['type']]
      );
      
      if($field['type']=='checkbox')
      {
        $selected = ( $value == true ) ? ' checked' : '';
        $new_fields = str_replace('{checked}',$selected,$new_fields);
        $new_fields = str_replace('{value}',$value,$new_fields);
      }
    }
      
    return $new_fields;
  }
  

  /**
   * Save the schema of field
   */ 
  static function get_fields_schema() {
    $schema = array();
    foreach(self::$options['fields'] as $name => $field) {
      if (empty($field['name'])) {
        $field['name'] = $name;
      }
      $schema[] = $field;
    }
    return $schema;
  }
  
 
  /**
   * Save the fields
   */
  static function save_post($post_id) {
    if (get_post_type($post_id) !== 'nav_menu_item') {
      return;
    }
    $fields_schema = self::get_fields_schema($post_id);
    foreach($fields_schema as $field_schema) {
      $form_field_name = 'menu-item-' . $field_schema['name']. $post_id ;
      
      $key = $field_schema['name'];
      if (isset($_POST[$form_field_name])) {
        
        $value = stripslashes($_POST[$form_field_name]);
        if($field_schema['type'] == 'checkbox')
        {
          $value = true;
        }
      }
      else
      {
        $value = '';
        if($field_schema['type'] == 'checkbox')
        {
          $value = false;
        }
      }
      
      update_post_meta($post_id, $key, $value);
    }
  }

}

// instantiate class
$GLOBALS['Ep_CustomMenu'] = new Ep_CustomMenu();

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
class EP_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit {
  function start_el(&$output, $object, $depth=0, $args= array() , $current_object_id = 0) {
    $item_output = '';
    parent::start_el($item_output, $object, $depth, $args, $current_object_id);
    $new_fields = apply_filters( 'nav_menu_item_additional_fields','', $item_output, $object, $depth, $args, $current_object_id);
    // Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
    if ($new_fields) {
      $item_output = preg_replace('/(?=<p[^>]+class="[^"]*field-move)/', $new_fields, $item_output);
    }
    $output .= $item_output;
  }
}

class Ep_Nav_Walker extends Walker_Nav_Menu
{
    private $navIdPrefix = '';

    public function __construct($idPrefix='menu-item-')
    {
        $this->navIdPrefix = $idPrefix;
    }

    function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {

       global $wp_query;

       $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

       $class_names = $value = '';

       $classes = empty( $object->classes ) ? array() : (array) $object->classes;
       $classes = array_slice($classes,1);

       $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
       $class_names = ' class="'. esc_attr( $class_names ) . '"';


       $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
       $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
       $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        
       $attributesexternal = '';
       
       if($object->object == 'page') {
            $varpost = get_post($object->object_id);
            $separate_page = get_post_meta($object->object_id, "page-position-switch", true);
           
            $disable_menu = get_post_meta($object->ID, "show-in-menu-switch", true);
            $current_page_id = get_option('page_on_front');

            $isHome = ($varpost->ID == $current_page_id)? true : false;

            if($varpost->ID == $current_page_id ) // set it to prevent unwanted value saved in home-page
                $separate_page = "0";

            if ( ( $disable_menu != true )) {

                $output .= $indent . '<li ' . $value . $class_names .'><span class="spanHover"></span>';
                if ( $separate_page == "0" ) { // seperate page 0 = Page open in external page
                  if($isHome ) // Link to home
                  {
                    $attributes .= ' class="locallink home" data-hash="home"  href="' . home_url() . '/#home"';
                    $attributesexternal .= ' class="externalLink" href="' . home_url() . '"'; // External Link In External Page

                  }
                  else
                  {
                    $attributes .= ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';
                  }

                } else if ( $separate_page == "1"){ // seperate page 1 = Page open in main page
                    if (is_front_page()) {
                         $attributes .= ' class="locallink" data-hash="'. $varpost->post_name . '" href="' . home_url() . '/?locaklink"'; //  locallink In main Page
                         $attributesexternal .= ' class="externalLink" data-hash="'. $varpost->post_name . '" href="' . home_url() . '/?sectionid='.$varpost->post_name.'"'; // External Link In External Page
                     } else {
                         $attributes .= ' class="locallink" data-hash="'. $varpost->post_name . '" href="' . home_url() . '/?locaklink"'; //  locallink In main Page
                         $attributesexternal .= ' class="externalLink" data-hash="'. $varpost->post_name . '" href="' . home_url() . '/?sectionid='.$varpost->post_name.'"'; // External Link In External Page
                     }

                } else {
                     $attributes .= ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';
                }
                
                $object_output = $args->before;
                
                $object_output .= '<a'. $attributes .'>';
                $object_output .= '<span class="verticalspanHover"></span>';
                $object_output .= $args->link_before .'<span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';
                $object_output .= $args->link_after;
                $object_output .= '</a>';
                
                // this Part Of Code not generate for seperate page
                if ( $separate_page == "1" ||  $isHome ) {
                    $object_output .= '<a'. $attributesexternal .'>';
                    $object_output .= '<span class="verticalspanHover"></span>';
                    $object_output .= $args->link_before . '<span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';
                    $object_output .= $args->link_after;
                    $object_output .= '</a>';
                }

                $object_output .=  ''.$args->after;
                
                $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
                
                $object_output .=  '</li>';
            }
       } else {

            $output .= $indent . '<li ' . $value . $class_names .'><span class="spanHover"></span>';

            $attributes .= ! empty( $object->url ) ? ' href="' . esc_attr( $object->url ) .'"' : '';

            $object_output = $args->before;
            
            $object_output .= '<a'. $attributes .'>';
            $object_output .= '<span class="verticalspanHover"></span>';
            $object_output .= $args->link_before . '<span>' . apply_filters( 'the_title', $object->title, $object->ID ) . '</span>';
            $object_output .= $args->link_after;
            $object_output .= '</a>';
            
            $object_output .=  ''.$args->after;
            
           
            $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
           
            $object_output .=  '</li>';
        }
    }
    
    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "";
    }
}