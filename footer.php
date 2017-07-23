<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #page div and all content after
 */
?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer" role="contentinfo">

        <div class="bw-row bw-relative">
            <p class="bw-copyright-p"><?php echo wp_kses_data( Bw::get_option( 'bw_footer_copy' ) ); ?></p>
        </div>

    </footer>

</div><!-- #page -->

<span class="bw-overlay"></span>

<?php wp_footer(); ?>

</body>
</html>
