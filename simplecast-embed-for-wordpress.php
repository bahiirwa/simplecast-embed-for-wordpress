<?php
/**
 * Plugin Name: Simplecast Embed for WordPress
 * Plugin URI:  https://www.simplecast.com
 * Author:      Plugin Author Name
 * Author URI:  https://www.simplecast.com
 * Description: Display content using a shortcode to insert in a page or post. eg: [simplecast-embed src="[simplecast/episode/embed/link]"]
 * Version:     0.2.0
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
    class SimpleCastEmbedForWordPress {

		public $version = '1.0.0';

        public function instance() {
			// Define constants.
			define( 'SIMPLECAST_EMBED_FOR_WP_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_BASENAME', plugin_basename( __FILE__ ) );
			define( 'SIMPLECAST_EMBED_FOR_WP_VERSION', $this->version );

			include_once SIMPLECAST_EMBED_FOR_WP_PATH . '/includes/add-shortcode.php';
			include_once SIMPLECAST_EMBED_FOR_WP_PATH . '/includes/embed-block.php';
		}
	}
}

$simplecast_embed_for_wordpress = new SimpleCastEmbedForWordPress();
$simplecast_embed_for_wordpress->instance();
