<?php
/**
 * Render block.
 *
 * @package SimplecastEmbedForWordPress
 */

?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
	<?php echo do_shortcode( '[simplecast-embed src="' . esc_url( $attributes['link'] ) . '" mode="' . $attributes['isDark'] . '"]' ); ?>
</div>
