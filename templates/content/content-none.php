<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bad Weather
 */
?>

<section class="no-results">
	
	<div class="page">
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( esc_html__( 'Nothing was found! Publish your first post.', 'yago' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'yago' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'yago' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
