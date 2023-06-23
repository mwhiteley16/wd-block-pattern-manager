<?php
/**
 * Setup block patterns.
 *
 * @since      1.0.0
 * @package    BlockPatternManager
 * @subpackage BlockPatternManager/includes
 */

namespace BlockPatternManager\Patterns;

/**
 * Register Block Patterns.
 */
function register_block_patterns() {

	if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

		$loop = new \WP_Query(
			[
				'post_type'      => 'wd_block_pattern',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			],
		);

		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) :
				$loop->the_post();

				// Standard post meta.
				$post_title   = get_the_title();
				$post_slug    = str_replace( ' ', '-', strtolower( $post_title ) );
				$post_content = get_the_content();

				/**
				 * Setting the blockTypes argument to 'core/post-content' will enable the creation pattern UI.
				 * When left blank, it does nothing.
				 */
				$enable_starter_pattern = get_post_meta( get_the_ID(), 'wd_enable_page_creation_pattern', true );
				$block_types            = $enable_starter_pattern === '1' ? 'core/post-content' : '';

				// Set up pattern categories.
				$block_pattern_categories           = [];
				$available_block_pattern_categories = \WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();
				foreach ( $available_block_pattern_categories as $pattern_category ) {

					// Set up post meta key.
					$pattern_category_key = 'wd_' . sanitize_key( $pattern_category['name'] ) . '_pattern_category';

					// Get the post meta.
					$post_meta = get_post_meta( get_the_ID(), $pattern_category_key, true );

					// If this cateogry is enabled, add it to the array.
					if ( ! empty( $post_meta ) && $post_meta === '1' ) {
						$block_pattern_categories[] = $pattern_category['name'];
					}
				}

				// Pattern location logic.
				$post_types           = [];
				$available_post_types = get_post_types( [ 'public' => true ], 'names' );
				foreach ( $available_post_types as $post_type ) {

					// Set up post meta key.
					$post_type_key = 'wd_' . sanitize_key( $post_type ) . '_pattern_display';

					// Get the post meta.
					$post_meta = get_post_meta( get_the_ID(), $post_type_key, true );

					// If this post type exists and is enabled, add it to the array.
					if ( ! empty( $post_meta ) && $post_meta === '1' ) {
						$post_types[] = $post_type;
					}
				}

				register_block_pattern(
					'wd/' . $post_slug,
					[
						'title'      => $post_title,
						'blockTypes' => [ $block_types ], // for page creation patterns.
						'postTypes'  => $post_types,
						'content'    => trim( $post_content ),
						'categories' => $block_pattern_categories,
						'keywords'   => [
							$post_title,
							'pattern',
							'block pattern',
						],
					],
				);

			endwhile;
		endif;
		wp_reset_postdata();
	}
}
add_action( 'init', __NAMESPACE__ . '\register_block_patterns' );
