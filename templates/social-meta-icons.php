<?php

$enable_facebook = Bw::get_theme_option( 'blog_share_facebook' );
$enable_twitter = Bw::get_theme_option( 'blog_share_twitter' );
$enable_pinterest = Bw::get_theme_option( 'blog_share_pinterest' );
$enable_google = Bw::get_theme_option( 'blog_share_google' );

if( $enable_facebook or $enable_twitter or $enable_google or $enable_pinterest ) {
    echo '<span class="bw-social-share">' . esc_html__('Share article:', 'yago') . '</span>';

    $share_link = get_permalink( get_the_ID() );
    $share_title = get_the_title( get_the_ID() );
    $share_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );

    echo '<ul class="bw-social-list">';

    if( $enable_facebook ) {
        $share_href_f = esc_url( 'http://www.facebook.com/share.php?u=' . $share_link . '&title=' . $share_title );
        echo '<li><a target="_blank" class="bw-add-share bw-share-fb" href="' . $share_href_f . '"><i class="bw-icon-facebook"></i>' . esc_html__('Facebook', 'yago') . '</a></li>';
    }

    if( $enable_twitter ) {
        $share_href_t = esc_url( 'http://twitter.com/intent/tweet?status=' . $share_title . '+' . $share_link );
        echo '<li><a target="_blank" class="bw-add-share bw-share-t" href="' . $share_href_t . '"><i class="bw-icon-twitter"></i>' . esc_html__('Twitter', 'yago') . '</a></li>';
    }

    if( $enable_pinterest ) {
        $share_href_p = esc_url( 'https://pinterest.com/pin/create/button/?url=' . $share_link . '&media=' . $share_img . '&description=' . $share_title );
        echo '<li><a target="_blank" class="bw-add-share bw-share-p" href="' . $share_href_p . '"><i class="bw-icon-pinterest"></i>' . esc_html__('Pinterest', 'yago') . '</a></li>';
    }

    if( $enable_google ) {
        $share_href_g = esc_url( 'https://plus.google.com/share?url=' . $share_link );
        echo '<li><a target="_blank" class="bw-add-share bw-share-g" href="' . $share_href_g . '"><i class="bw-icon-google-plus"></i>' . esc_html__('Google', 'yago') . '</a></li>';
    }

    echo '</ul>';

}
