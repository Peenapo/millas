<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) { return; }
?>

<div id="comments" class="comments-area">
	<div class="bw-row-tiny">

		<div class="bw-align-center">
			<a href="#" class="bw-comment-toggle"><?php comments_number( 'No comments', 'One comment', '% comments' ); ?></a>
		</div>

		<div class="bw-comment-inner">
			<?php
			// you can start editing here - including this comment!
			if ( have_comments() ) : ?>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'yago' ); ?></h2>
					<div class="nav-links">

						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'yago' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'yago' ) ); ?></div>

					</div>
				</nav>
				<?php endif; ?>

				<ol class="comment-list">
					<?php
					wp_list_comments( array(
						'style' => 'ol',
						'short_ping' => true,
					));
					?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'yago' ); ?></h2>
					<div class="nav-links">

						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'yago' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'yago' ) ); ?></div>

					</div>
				</nav>
				<?php
				endif;

			endif;


			// if comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'yago' ); ?></p>
			<?php
			endif;

			comment_form();
			?>
		</div>

	</div>
</div><!-- #comments -->
