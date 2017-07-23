<?php

$row_params = array(
    'visibility'                => false,
    'row_layout'                => 'full_width_background',
    'text_color'                => 'inherit',
    'text_alignment'            => 'left',
    'text_custom_color'         => '#333',
    'align_vertically'          => false,
    'static_height'             => false,
    'window_height'             => '100',
    'padding_top'               => '',
    'padding_bottom'            => '',
    'anchor'                    => '',
    'class'                     => ''
);
$background_params = array(
    'background_type'           => 'none',
    // bg color
    'bg_color'                  => '',
    // bg image
    'bg_image_bg_color'         => '',
    'bg_image_overlay'          => '',
    'bg_image'                  => '',
    'bg_image_position'         => 'center center',
    'bg_image_repeat'           => 'no-repeat',
    'bg_image_fullscreen'       => false,
    'bg_image_fixed'            => false,
    // background type - parallax
    'bg_parallax_bg_color'      => 'transparent',
    'bg_parallax_overlay_color' => '',
    'bg_parallax_enable_1'      => false,
    'bg_parallax_image_1'       => '',
    'bg_parallax_speed_1'       => 0,
    // background type - video
    'bg_video_file_mp4'         => '',
    'bg_video_file_webm'        => '',
    'bg_video_file_ogv'         => '',
    'bg_video_preview'          => '',
    'bg_video_overlay'          => '',
    // ribbon
    'enable_ribbon_top'         => false,
    'ribbon_top_image'          => '',
    'top_ribbon_height'         => 30,
    'enable_ribbon_bottom'      => false,
    'ribbon_bottom_image'       => '',
    'bottom_ribbon_height'      => 30,
);
$a = shortcode_atts( array_merge( $row_params, $background_params, array( 'show_on_paging' => false, 'row_enable_right_sidebar' => false, 'row_sidebar' => '', 'will_stuck' => false ) ), $atts );

if( Bw::current_page() >= 2 and ! $a['show_on_paging'] ) { return; }

if( $a['visibility'] == 'true' ) { return; }

$anchor = $a['anchor'] ? "id='{$a['anchor']}'" : '';
$style = $data_attr = '';

if( ! empty( $a['padding_top'] ) ) {
    $style .= substr( $a['padding_top'], -1 ) == '%' ? "padding-top:{$a['padding_top']};" : "padding-top:{$a['padding_top']}px;";
}
if( ! empty( $a['padding_bottom'] ) ) {
    $style .= substr( $a['padding_bottom'], -1 ) == '%' ? "padding-bottom:{$a['padding_bottom']};" : "padding-bottom:{$a['padding_bottom']}px;";
}

if($a['text_color'] !== 'inherit') {
    $palette = array( 'dark' => '#333', 'light' => '#fff' );
    $style .= array_key_exists( $a['text_color'], $palette ) ? "color:{$palette[$a['text_color']]};" : "color:{$a['text_custom_color']};";
}
$style .= "text-align:{$a['text_alignment']};";

$class = '';
if( $a['align_vertically'] ) {
    $class .= ' bwpb-vertical-row-align-' . $a['align_vertically'];
}
$class .= ' ' . $a['class'];
$class .= $a['row_enable_right_sidebar'] === '1' ? ' bwpb-has-sidebar' : '';

if( $a['static_height'] ) {
    $class .= ' static-window-height ';
    $data_attr .= 'data-static-height="' . $a['window_height'] . '"';
}

$bg = Bwpb_front::get_background_data( $a );

$style .= $bg['style'];
$class .= $bg['class'];

$ribbon_top = $a['enable_ribbon_top'] ? "<div class='bwpb-ribbon bwpb-ribbon-top' style='height:{$a['top_ribbon_height']}px;background-image:url({$a['ribbon_top_image']})'></div>" : '';
$ribbon_bottom = $a['enable_ribbon_bottom'] ? "<div class='bwpb-ribbon bwpb-ribbon-bottom' style='height:{$a['bottom_ribbon_height']}px;background-image:url({$a['ribbon_bottom_image']})'></div>" : '';

$output  = "<div class='bwpb-row-holder bwpb-video-holder bwpb-row-{$a['row_layout']} {$bg['class_holder']} {$class}' {$bg['data']} {$data_attr} style='{$bg['style_holder']}'>";
$output .= "{$bg['video']}{$bg['parallax']}{$bg['overlay']}{$bg['multi']}";
$output .= "<div class='bwpb-row'>";
$output .= "<div {$anchor} class='bwpb-row-inner' style='{$style}'>";

if( $a['row_enable_right_sidebar'] === '1' ) { $output .= '<div class="bw-row-content">'; }
$output .= do_shortcode( $content );
if( $a['row_enable_right_sidebar'] === '1' ) { $output .= '</div>'; }
if( $a['row_enable_right_sidebar'] === '1' ) {
    ob_start();
    echo '<div class="bw-sidebar' . ( $a['will_stuck'] ? ' bw-sidebar-will-stuck' : '' ) . '">';
    dynamic_sidebar( $a['row_sidebar'] );
    echo '</div>';
    $dynamic_sidebar = ob_get_clean();
    $output .= $dynamic_sidebar;
}

$output .= "</div>";
$output .= "</div>{$ribbon_top}{$ribbon_bottom}";
$output .= "</div>";

return $output;
