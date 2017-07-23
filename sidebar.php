<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    	<?php dynamic_sidebar( 'sidebar' ); ?>
    <?php endif; ?>
</aside><!-- #secondary -->
