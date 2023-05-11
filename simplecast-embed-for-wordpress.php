<?php
/**
 * Plugin Name: Simplecast Embed for WordPress
 * Plugin URI:  https://www.omukiguy.com
 * Author:      Plugin Author Name
 * Author URI:  https://www.omukiguy.com
 * Description: Display content using a shortcode to insert in a page or post. eg: [simplecast-embed src="[simplecast/episode/embed/link]"]
 * Version:     1.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: prefix-plugin-name
 *
 * @package SimplecastEmbedForWordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Unauthorized Access!' );
}

if ( ! class_exists( 'SimpleCastEmbedForWordPress' ) ) {
	/**
	 * Simplecast Init Class.
	 */
	class SimpleCastEmbedForWordPress {

		/**
		 * Initialize the class.
		 *
		 * @return void
		 */
		public function instance() {
			// Define constants.
			$plugin_version = get_plugin_data( __FILE__ );
			define( 'SIMPLECAST_EMBED_FOR_WP_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_BASENAME', plugin_basename( __FILE__ ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_VERSION', $plugin_version['version'] );

			include_once SIMPLECAST_EMBED_FOR_WP_PATH . '/includes/add-shortcode.php';

			if ( function_exists( 'register_block_type' ) ) {
				include_once SIMPLECAST_EMBED_FOR_WP_PATH . '/includes/embed-block.php';
			}
		}
	}
}

$simplecast_embed_for_wordpress = new SimpleCastEmbedForWordPress();
$simplecast_embed_for_wordpress->instance();
