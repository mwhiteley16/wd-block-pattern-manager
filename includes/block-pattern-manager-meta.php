<?php
/**
 * Setup block patterns meta.
 *
 * @since      1.0.0
 * @package    BlockPatternManager
 * @subpackage BlockPatternManager/includes
 */

namespace BlockPatternManager\Meta;

/**
 * Registers the custom_post_meta field.
 *
 * @return void
 */
function register_block_patterns_meta() {

	register_post_meta(
		'wd_block_pattern',
		'wd_enable_page_creation_pattern',
		[
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'boolean',
		]
	);

	register_post_meta(
		'wd_block_pattern',
		'wd_wd_block_pattern_pattern_display',
		[
			'show_in_rest' => true,
			'single'       => true,
			'type'         => 'boolean',
		]
	);

	// Get all available post types.
	$post_types = get_post_types( [ 'public' => true ], 'names' );

	// Regsiter meta for each post type so it is availalbe in the block editor API.
	foreach ( $post_types as $post_type ) {
		$post_type_key = 'wd_' . sanitize_key( $post_type ) . '_pattern_display';

		register_post_meta(
			'wd_block_pattern',
			$post_type_key,
			[
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'boolean',
			]
		);
	}

	// Get all registered block patterns.
	$block_pattern_categories = \WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();

	// Regsiter meta for each block pattern so it is availalbe in the block editor API.
	foreach ( $block_pattern_categories as $pattern_category ) {
		$pattern_category_key = 'wd_' . sanitize_key( $pattern_category['name'] ) . '_pattern_category';

		register_post_meta(
			'wd_block_pattern',
			$pattern_category_key,
			[
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'boolean',
			]
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\register_block_patterns_meta' );
