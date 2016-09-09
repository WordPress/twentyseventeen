<?php
$twentyseventeen_header_top_text_1 = get_theme_mod( 'twentyseventeen_header_top_text_1' );
$twentyseventeen_header_top_text_2 = get_theme_mod( 'twentyseventeen_header_top_text_2' );

if ( ( ! empty( $twentyseventeen_header_top_text_1 ) || ! empty( $twentyseventeen_header_top_text_2 ) ) || is_customize_preview() ) : ?>
	<div class="site-top-content">
		<?php
			echo '<span class="site-top-content-1">' . wp_kses_post( $twentyseventeen_header_top_text_1 ) . '</span>';
			if ( ! empty( $twentyseventeen_header_top_text_2 ) || is_customize_preview() ) {
				echo '<span class="site-top-content-2">' . wp_kses_post( $twentyseventeen_header_top_text_2 ) . '</span>';
			} ?>
	</div>
<?php endif; ?>
