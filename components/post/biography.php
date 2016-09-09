<div class="entry-author">
	<div class="author-avatar">
		<?php
			$author_bio_avatar_size = apply_filters( 'twentyseventeen_author_bio_avatar_size', 100 );
			echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div>

	<div class="author-heading">
		<h2 class="author-title"><?php _e( 'Published by', 'twentyseventeen' ); ?> <?php echo get_the_author(); ?></h2>
	</div><!-- .author-heading -->

	<p class="author-bio">
		<?php the_author_meta( 'description' ); ?>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( __( 'View all posts by %s', 'twentyseventeen' ), get_the_author() ); ?>
		</a>
	</p>
</div><!-- .entry-author -->