<?php
/**
 * Displays footer image from Customizer on front-page.php
 *
 * @package Twenty Seventeen
 */

?>
<?php
	$footer_image = get_theme_mod( 'twentyseventeen_footer_image' );
	$has_footer_image = '';
	if ( ! empty( $footer_image ) ) {
		$has_footer_image = ' has-footer-image';
	}
	if ( ( ! empty( $footer_image ) || is_customize_preview() ) && twentyseventeen_is_frontpage() ) { ?>
		<div class="footer-image twentyseventeen-panel <?php echo esc_attr( $has_footer_image ); ?>" style="background-image: url( <?php echo esc_url( $footer_image ); ?> )">
			<span class="panel twentyseventeen-footer-settings">
				<span class="twentyseventeen-panel-title"><?php _e( 'Footer Image', 'twentyseventeen' ); ?></span>
			</span>
		</div><!-- .footer-image -->
	<?php }
?>
