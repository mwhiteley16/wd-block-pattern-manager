<?php
/**
 * Plugin Name:       Block Pattern Manager
 * Plugin URI:        https://github.com/mwhiteley16/wd-block-pattern-manager
 * Description:       Easily manage block patterns without touching code.
 * Version:           1.0.0
 * Author:            Whiteley Designs
 * Author URI:        https://whiteleydesigns.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wd-block-pattern-manager
 *
 * @since             1.0.0
 * @package           BlockPatternManager
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define constants.
 */

// Version.
define( 'BLOCK_PATTERN_MANAGER_VERSION', '1.0.0' );

// Directory path.
define( 'BLOCK_PATTERN_MANAGER_DIR', plugin_dir_path( __FILE__ ) );

// Directory URL.
define( 'BLOCK_PATTERN_MANAGER_URL', plugin_dir_url( __FILE__ ) );


/**
 * Load primary class.
 */
require_once BLOCK_PATTERN_MANAGER_DIR . 'includes/class-block-pattern-manager.php';


/**
 * The function provides access to the methods.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @since 1.0.0
 */
function run_block_pattern_manager() {
	return Block_Pattern_Manager::instance();
}
run_block_pattern_manager();

// Add admin columns for categories, post types, creation patterns
// Settings page
// Allow user to add categories
// Store patterns in transient
// Consistent doc comments in all file
// Clean up file strucutre
