<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #page div and all content after
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">

        <?php if( Bw::get_theme_option('footer_widgets_enable') ): ?>
            <div class="bw-footer-widgets-outer">
                <div class="bw-row">
                    <?php if( Bw::get_theme_option('footer_widgets_logo') ): ?>
                        <div class="bw-footer-logo">
                            <span><?php echo get_bloginfo('name'); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="bw-footer-widgets">
                        <?php if ( is_active_sidebar( 'footer_1' ) and Bw::get_theme_option('footer_widgets_enable_col_1') ) :  ?>
                            <div class="bw-footer-widget">
                                <?php dynamic_sidebar( 'footer_1' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer_2' ) and Bw::get_theme_option('footer_widgets_enable_col_2') ) :  ?>
                            <div class="bw-footer-widget">
                                <?php dynamic_sidebar( 'footer_2' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer_3' ) and Bw::get_theme_option('footer_widgets_enable_col_3') ) :  ?>
                            <div class="bw-footer-widget">
                                <?php dynamic_sidebar( 'footer_3' ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'footer_4' ) and Bw::get_theme_option('footer_widgets_enable_col_4') ) :  ?>
                            <div class="bw-footer-widget">
                                <?php dynamic_sidebar( 'footer_4' ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bw-row bw-relative bw-align-center">
            <div class="bw-copyright">
                <?php if( Bw::get_theme_option('footer_bottom_back_top') ): ?>
                    <div class="bw-back-top-outer">
                        <span class="bw-back-top"><i></i></span>
                    </div>
                <?php endif; ?>
                <p class="bw-copyright-p"><?php echo wp_kses_data( Bw::get_option( 'bw_footer_copy' ) ); ?></p>
            </div>
        </div>

    </footer>

</div><!-- #page -->

<span class="bw-overlay"></span>

<?php wp_footer(); ?>

</body>
</html>
