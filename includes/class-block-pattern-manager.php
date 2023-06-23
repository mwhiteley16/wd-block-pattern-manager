<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    BlockPatternManager
 * @subpackage BlockPatternManager/includes
 *
 * NEED TO FORMAT ALL OF THESE TO BE UNIFORM!
 */
class Block_Pattern_Manager {

	/**
	 * Instance of the class.
	 *
	 * @var instance $instance Instance of class.
	 */
	private static $instance;


	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue' ] );
	}


	/**
	 * Primary instance.
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Block_Pattern_Manager ) ) {
			self::$instance = new Block_Pattern_Manager();
			self::$instance->includes();
		}

		return self::$instance;
	}


	/**
	 * Load includes
	 *
	 * Here is where we will add all of the files that need to load. Add each
	 * appropriate file/folder and reference here as needed.
	 *
	 * @since 1.0.0
	 */
	public function includes() {

		require_once BLOCK_PATTERN_MANAGER_DIR . 'includes/block-pattern-manager-categories.php';
		require_once BLOCK_PATTERN_MANAGER_DIR . 'includes/block-pattern-manager-meta.php';
		require_once BLOCK_PATTERN_MANAGER_DIR . 'includes/block-pattern-manager-patterns.php';
		require_once BLOCK_PATTERN_MANAGER_DIR . 'includes/block-pattern-manager-post-type.php';
	}


	/**
	 * Enqueue Scripts
	 *
	 * Here is where we enqueue and register our scripts. Make sure each script is
	 * conditionally loading only where it is needed.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		global $typenow;

		// Only output script on block patterns CPT.
		if ( $typenow === 'wd_block_pattern' ) {

			// Block pattern meta fields.
			wp_enqueue_script(
				'wd-block-patterns-meta',
				BLOCK_PATTERN_MANAGER_URL . 'assets/js/dist/index-min.js',
				[
					'wp-plugins',
					'wp-edit-post',
					'wp-element',
					'wp-components',
					'wp-data',
					'wp-compose',
				],
				BLOCK_PATTERN_MANAGER_VERSION,
				true
			);
		}
	}
}
