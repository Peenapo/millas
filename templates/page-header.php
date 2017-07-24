<?php if( ! Bw::get_meta('hide_title') ): ?>

    <?php
        $title = ! empty( Bw::get_meta('custom_page_title') ) ? esc_attr( Bw::get_meta('custom_page_title') ) : get_the_title();
        $sub_title = Bw::get_meta('sub_title');
        $cover_image = Bw::get_theme_option( 'general_cover_image' );
    ?>

    <div class="bw-page-header">

        <?php
            if( ! empty( $cover_image ) ) {
                echo '<div class="bw-cover-image" style="background-image:url(' . esc_url( $cover_image ) . ');"></div>';
            }
        ?>

        <div class="bw-page-header-inner">
            <div class="bw-row">
                <h1 class="bw-page-header-title"><?php echo $title; ?></h1>
                <?php if( ! empty( $sub_title ) ) { echo '<p>' . esc_attr( $sub_title ) . '</p>'; } ?>
            </div>
        </div>

    </div>

<?php endif; ?>
