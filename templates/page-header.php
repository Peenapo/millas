<?php if( ! Bw::get_meta('hide_title') ): ?>

    <?php

        $heading_classes = $heading_style = '';
        $top_title = Bw::get_meta('top_title');
        $title = ! empty( Bw::get_meta('custom_page_title') ) ? esc_attr( Bw::get_meta('custom_page_title') ) : get_the_title();
        $sub_title = Bw::get_meta('sub_title');
        $cover_image = Bw::get_meta( 'heading_image' );
        $alignment = Bw::get_meta( 'heading_text_alignment' );
        $heading_bg = Bw::get_meta( 'heading_bg_color' );

        $heading_classes .= Bw::get_meta('light_header_text') ? ' bw-is-text-light' : '';
        $heading_style .= 'text-align:' . ( $alignment ? esc_attr( $alignment ) : 'center' ) . ';';
        $heading_style .= $heading_bg ? 'background-color:' . esc_attr( $heading_bg ) . ';' : '';

    ?>

    <div class="bw-page-header<?php echo $heading_classes; ?>" style="<?php echo $heading_style; ?>">

        <?php
            if( ! empty( $cover_image ) ) {
                $cover_image = Bw::get_image_attachment( 'large', $cover_image );
                echo '<div class="bw-cover-image" style="background-image:url(' . esc_url( $cover_image ) . ');"></div>';
            }
        ?>

        <div class="bw-page-header-inner">
            <div class="bw-row">
                <?php if( ! empty( $top_title ) ) { echo '<span>' . esc_attr( $top_title ) . '</span>'; } ?>
                <h1 class="bw-page-header-title"><?php echo $title; ?></h1>
                <?php if( ! empty( $sub_title ) ) { echo '<p>' . wp_kses_data( $sub_title ) . '</p>'; } ?>
            </div>
        </div>

    </div>

<?php endif; ?>
