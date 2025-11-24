<?php
/*
Plugin Name: Language Taxonomy
Plugin URI: http://www.lostfocus.de/language-taxonomy/
Description: Adds a language taxonomy to posts, pages and other items.
Version: 0.3.1
Author: Dominik Schwind
Author URI: http://www.lostfocus.de/
*/
function create_language_taxonomies(): void {
	$labels = array(
		'name'                       => __( 'Languages', 'language_taxonomy' ),
		'singular_name'              => __( 'Language', 'language_taxonomy' ),
		'search_items'               => __( 'Search Languages', 'language_taxonomy' ),
		'popular_items'              => __( 'Popular Languages', 'language_taxonomy' ),
		'all_items'                  => __( 'All Languages', 'language_taxonomy' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Language', 'language_taxonomy' ),
		'update_item'                => __( 'Update Language', 'language_taxonomy' ),
		'add_new_item'               => __( 'Add New Language', 'language_taxonomy' ),
		'new_item_name'              => __( 'New Language', 'language_taxonomy' ),
		'separate_items_with_commas' => __( 'Separate languages with commas', 'language_taxonomy' ),
		'add_or_remove_items'        => __( 'Add or remove languages', 'language_taxonomy' ),
		'choose_from_most_used'      => __( 'Choose from the most used languages', 'language_taxonomy' )
	);

	register_taxonomy( 'language', array( 'post', 'page' ), array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'lang' ),
	) );

}

function lt_the_language( $id ): void {
	the_terms( $id, 'language' );
}

add_action( 'init', 'create_language_taxonomies', 0 );

/* Load textdomain */
add_action( 'plugins_loaded', 'language_taxonomy_textdomain' );
function language_taxonomy_textdomain(): void {
	load_plugin_textdomain( 'language_taxonomy', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}

add_filter( 'activitypub_locale', static function ( string $lang, mixed $item ) {
	if ( ! $item instanceof \WP_Post ) {
		return $lang;
	}
	$languages = get_the_terms( $item, 'language' );

	if ( is_array( $languages ) ) {
		foreach ( $languages as $language ) {
			if ( ( $language instanceof \WP_Term ) && mb_strlen( $language->slug ) === 2 ) {
				return $language->slug;
			}
		}
	}

	return $lang;
}, 10, 2 );