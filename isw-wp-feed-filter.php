<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://instileweb.com
 * @since             1.0.0
 * @package           Isw-wp-feed-filter
 *
 * @wordpress-plugin
 * Plugin Name:       Wp feed filter
 * Plugin URI:        http://instileweb.com/wp-feed-filter
 * Description:       
 * Version:           1.0.0
 * Author:            inStileWeb
 * Author URI:        http://instileweb.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       isw-wp-feed-filter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/Isw_wp_feed_filter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_isw_wp_feed_filter() {

	$plugin = new Isw_wp_feed_filter();
	$plugin->run();

}
run_isw_wp_feed_filter();
