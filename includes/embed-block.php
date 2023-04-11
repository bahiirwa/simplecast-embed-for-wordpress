<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 *
 * @package SimplecastEmbedForWordPress
 */

 /**
  * Registers the block.
  */
function scefwp_embed_block_block_init() {
	register_block_type( SIMPLECAST_EMBED_FOR_WP_PATH . '/build' );
}

add_action( 'init', 'scefwp_embed_block_block_init' );
