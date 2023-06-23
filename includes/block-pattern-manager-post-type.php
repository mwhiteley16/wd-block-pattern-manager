<?php
/**
 * Setup block patterns post type.
 *
 * @since      1.0.0
 * @package    BlockPatternManager
 * @subpackage BlockPatternManager/includes
 */

namespace BlockPatternManager\PostType;

/**
 * Register Block Patterns Custom Post Type.
 */
function register_cpt() {

	$labels = [
		'name'               => _x( 'Block Pattern', 'post type general name', 'ren-network-2023' ),
		'singular_name'      => _x( 'Block Pattern', 'post type singular name', 'ren-network-2023' ),
		'menu_name'          => _x( 'Block Patterns', 'admin menu', 'ren-network-2023' ),
		'name_admin_bar'     => _x( 'Block Pattern', 'add new on admin bar', 'ren-network-2023' ),
		'add_new'            => _x( 'Add New', 'Block Pattern', 'ren-network-2023' ),
		'add_new_item'       => __( 'Add New Block Pattern', 'ren-network-2023' ),
		'new_item'           => __( 'New Block Pattern', 'ren-network-2023' ),
		'edit_item'          => __( 'Edit Block Pattern', 'ren-network-2023' ),
		'view_item'          => __( 'View Block Pattern', 'ren-network-2023' ),
		'all_items'          => __( 'All Block Patterns', 'ren-network-2023' ),
		'search_items'       => __( 'Search Block Patterns', 'ren-network-2023' ),
		'parent_item_colon'  => __( 'Parent Block Patterns:', 'ren-network-2023' ),
		'not_found'          => __( 'No Block Patterns found.', 'ren-network-2023' ),
		'not_found_in_trash' => __( 'No Block Patterns found in Trash.', 'ren-network-2023' ),
	];

	$args = [
		'labels'              => $labels,
		'description'         => __( 'Block Patterns.', 'ren-network-2023' ),
		'public'              => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => 290,
		'menu_icon'           => 'dashicons-screenoptions',
		'show_in_rest'        => true,
		'supports'            => [
			'title',
			'editor',
			'revisions',
			'custom-fields',
		],
		'rewrite'             => [
			'slug'       => 'block-pattern',
			'with_front' => false,
		],
	];

	register_post_type(
		'wd_block_pattern',
		$args
	);
}
add_action( 'init', __NAMESPACE__ . '\register_cpt' );


/**
 * Redirect single posts to home page ensure these pages are never accessible directly in the browser.
 */
function redirect_single_block_pattern() {

	if ( is_singular( 'wd_block_pattern' ) ) {
		wp_safe_redirect( get_home_url() );
		exit;
	}
}
add_action( 'template_redirect', __NAMESPACE__ . '\redirect_single_block_pattern' );
