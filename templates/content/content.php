<?php
/**
 * Template part for displaying post content
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header bw-row">
		<div class="category-list">
			<?php echo get_the_category_list(''); ?>
		</div>
        <h1 class="entry-title"><?php the_title(); ?></h1>
		<span class="post-date">
			<a href="<?php the_permalink(); ?>">
				<time class="entry-date"><?php echo get_the_date(); ?></time>
			</a>
		</span>
    </header>

    <?php if( has_post_thumbnail() ): ?>
        <figure class="featured-image bw-row-medium">
            <?php the_post_thumbnail(); ?>
        </figure>
    <?php endif; ?>

	<div class="bw-row-tiny">

		<div class="entry-content bw-row bw-clearfix">
			<?php
				the_content( sprintf(
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'yago' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				));

				wp_link_pages( array(
					'before' => '<div class="bw-paged">' . esc_html__( 'Pages:', 'yago' ),
					'after'  => '</div>',
				));
			?>
		</div>

	    <footer class="entry-footer bw-row">

	        <?php if( Bw::get_theme_option( 'blog_cats' ) ): ?>
	            <div class="cat-links">
	                <div class="bw-tags"><span><?php esc_html_e('Posted in:', 'yago'); ?></span> <?php echo get_the_category_list(', '); ?></div>
	            </div>
	        <?php endif; ?>

	        <?php if( Bw::get_theme_option( 'blog_tags' ) ): ?>
	            <div class="tag-links">
	                <?php echo get_the_tag_list('<div class="bw-tags"><span>' . esc_html__('Tagged as:', 'yago') . '</span> ',', ','</div>'); ?>
	            </div>
	        <?php endif; ?>

	        <?php if( Bw::get_theme_option( 'blog_enable_share' ) ): ?>
	            <?php get_template_part('templates/social-meta-icons'); ?>
	        <?php endif; ?>

	    </footer>

	</div>

    <?php if( Bw::get_theme_option('blog_related') ): ?>
        <?php get_template_part('templates/related-articles'); ?>
    <?php endif; ?>

</article>

<?php if( Bw::get_option( Bw::$theme_prefix . '_blog_author' ) ): ?>
    <?php $author_id = get_the_author_meta( 'ID' ); ?>
    <section class="author-box bw-row">
        <figure class="author-avatar">
            <?php echo Bw::avatar( 100, $author_id ); ?>
        </figure>
        <div class="author-info">
            <h6 class="author-name"><?php the_author_posts_link(); ?></h6>
            <p><?php echo get_the_author_meta( 'description' ); ?></p>
        </div>
    </section>
<?php endif; ?>
