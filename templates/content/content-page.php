<?php
/**
 * Template part for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="bw-paged">' . esc_html__( 'Pages:', 'yago' ),
				'after'  => '</div>',
			));
		?>
	</div>

</article>
