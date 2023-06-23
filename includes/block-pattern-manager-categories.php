<?php
/**
 * Setup block patterns categories.
 *
 * @since      1.0.0
 * @package    BlockPatternManager
 * @subpackage BlockPatternManager/includes
 */

namespace BlockPatternManager\Categories;

/**
 * Add custom block pattern categories.
 */
function register_block_pattern_cateories() {

	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

		register_block_pattern_category(
			'global-pattern',
			[
				'label' => _x( 'Global Pattern', 'Block pattern category', 'wd-block-pattern-manager' ),
			]
		);

	}
}
add_action( 'init', __NAMESPACE__ . '\register_block_pattern_cateories' );
