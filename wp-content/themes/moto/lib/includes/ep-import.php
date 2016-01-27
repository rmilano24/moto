<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true); 

// Deactivate wordpress importer plugin
if(is_plugin_active('wordpress-importer/wordpress-importer.php'))
{
	deactivate_plugins(array('wordpress-importer/wordpress-importer.php'));
}

// include wordpress-importer plugin
// Try to use custom version of the plugin
if(!class_exists( 'WP_Import' ))
{
    require_once THEME_INCLUDES . '/wordpress-importer/wordpress-importer.php';
}

if ( class_exists( 'WP_Import' ) ) {
	class Ep_Import extends WP_Import {

		function process_menu_item( $item ) {
			// skip draft, orphaned menu items
			if ( 'draft' == $item['status'] )
				return;

			$menu_slug = false;
			if ( isset($item['terms']) ) {
				// loop through terms, assume first nav_menu term is correct menu
				foreach ( $item['terms'] as $term ) {
					if ( 'nav_menu' == $term['domain'] ) {
						$menu_slug = $term['slug'];
						break;
					}
				}
			}

			//Added to proccess menu
			// Create an array to store all the post meta in
			$menu_item_meta = array();

			foreach ( $item['postmeta'] as $meta ){
				$$meta['key'] = $meta['value'];
				$menu_item_meta[$meta['key']] = $meta['value'];
			} //End of adding code to proccess menu

			// no nav_menu term associated with this menu item
			if ( ! $menu_slug ) {
				return;
			}

			$menu_id = term_exists( $menu_slug, 'nav_menu' );
			if ( ! $menu_id ) {
				printf( __( 'Menu item skipped due to invalid menu slug: %s', 'wordpress-importer' ), esc_html( $menu_slug ) );
				echo '<br />';
				return;
			} else {
				$menu_id = is_array( $menu_id ) ? $menu_id['term_id'] : $menu_id;
			}

			foreach ( $item['postmeta'] as $meta )
				$$meta['key'] = $meta['value'];

			if ( 'taxonomy' == $_menu_item_type && isset( $this->processed_terms[intval($_menu_item_object_id)] ) ) {
				$_menu_item_object_id = $this->processed_terms[intval($_menu_item_object_id)];
			} else if ( 'post_type' == $_menu_item_type && isset( $this->processed_posts[intval($_menu_item_object_id)] ) ) {
				$_menu_item_object_id = $this->processed_posts[intval($_menu_item_object_id)];
			} else if ( 'custom' != $_menu_item_type ) {
				// associated object is missing or not imported yet, we'll retry later
				$this->missing_menu_items[] = $item;
				return;
			}

			if ( isset( $this->processed_menu_items[intval($_menu_item_menu_item_parent)] ) ) {
				$_menu_item_menu_item_parent = $this->processed_menu_items[intval($_menu_item_menu_item_parent)];
			} else if ( $_menu_item_menu_item_parent ) {
				$this->menu_item_orphans[intval($item['post_id'])] = (int) $_menu_item_menu_item_parent;
				$_menu_item_menu_item_parent = 0;
			}

			// wp_update_nav_menu_item expects CSS classes as a space separated string
			$_menu_item_classes = maybe_unserialize( $_menu_item_classes );
			if ( is_array( $_menu_item_classes ) )
				$_menu_item_classes = implode( ' ', $_menu_item_classes );

			$args = array(
				'menu-item-object-id' => $_menu_item_object_id,
				'menu-item-object' => $_menu_item_object,
				'menu-item-parent-id' => $_menu_item_menu_item_parent,
				'menu-item-position' => intval( $item['menu_order'] ),
				'menu-item-type' => $_menu_item_type,
				'menu-item-title' => $item['post_title'],
				'menu-item-url' => $_menu_item_url,
				'menu-item-description' => $item['post_content'],
				'menu-item-attr-title' => $item['post_excerpt'],
				'menu-item-target' => $_menu_item_target,
				'menu-item-classes' => $_menu_item_classes,
				'menu-item-xfn' => $_menu_item_xfn,
				'menu-item-status' => $item['status']
			);

			$id = wp_update_nav_menu_item( $menu_id, 0, $args );
			if ( $id && ! is_wp_error( $id ) )
				$this->processed_menu_items[intval($item['post_id'])] = (int) $id;

			// Add Custom Meta not already covered by $args 
			// Remove all default $args from $menu_item_meta array
			foreach ( $args as $a => $arg ) {
				unset( $menu_item_meta[ '_' . str_replace('-', '_', $a) ]);
			}

			unset ( $menu_item_meta['_menu_item_menu_item_parent'] );

			$menu_item_meta = array_diff_assoc( $menu_item_meta, $args );

			// update any other post meta
			if ( ! empty ( $menu_item_meta ) ) foreach( $menu_item_meta as $key => $value ) {
				update_post_meta( (int) $id, $key, maybe_unserialize( $value ) );
			}

		}
	}

} // class_exists( 'WP_Import' )

?>
