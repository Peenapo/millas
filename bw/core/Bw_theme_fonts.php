<?php

class Bw_theme_fonts {

    static $google_fonts;
    static $font_declarations = '';

    static function init() {

        add_action( 'wp_enqueue_scripts', array( 'Bw_theme_fonts', 'enqueue_google_fonts' ) );

    }

    static function enqueue_google_fonts() {

         wp_enqueue_style( 'bw-google-fonts', Bw_theme_fonts::output_google_font(), array('bw-style-theme') );

         wp_add_inline_style( 'bw-google-fonts', self::$font_declarations );

    }

    static function output_google_font() {

        $font_url = $family_variants = '';
        $subsets_final = array();

        foreach( Bw_theme_fonts::$google_fonts as $font_key => $opts ) {

            $font = json_decode( get_option( $font_key ) );

            if( isset( $font_key['default']['self'] ) ) {
                self::collect_font_declaration( $opts['selectors'], $opts['default'] );
                continue;
            }

            if( ! isset( $font->family ) or empty( $font->family ) ) {
                $font = (object)$opts['default'];
            }

            if( ! ( isset( $font->self ) and $font->self == true ) ) {
                $family_variants .= '|' . $font->family;

                if( isset( $font->variants ) and ! empty( $font->variants ) ) {
                    $family_variants .= ':' . $font->variants;
                }
            }

            if( isset( $font->subsets ) and ! empty( $font->subsets ) ) {
                $subsets_arr = array_filter( explode( ',', $font->subsets ) );
                foreach( $subsets_arr as $subset ) {
                    if( ! in_array( $subset, $subsets_final ) ) {
                        $subsets_final[] = $subset;
                    }
                }
            }

            if( isset( $opts['selectors'] ) ) {
                self::collect_font_declaration( $opts['selectors'], $font );
            }
        }

        if( empty( $family_variants ) ) { return; }

        $subsets_final = ( count( $subsets_final ) > 0 ? '&' : '' ) . implode( ',', $subsets_final );
        if( ! empty( $family_variants ) ) { $family_variants = ltrim( $family_variants, '|' ); }

        $font_url = add_query_arg( 'family', urlencode( $family_variants ) . $subsets_final, "//fonts.googleapis.com/css" );
        return $font_url;

    }

    static function variants( $variant ) {

        switch( $variant ) {
            case is_numeric( $variant ):
                return 'font-weight:' . $variant . ';'; break;
            case $variant == 'regular':
                return 'font-weight:400;'; break;
            case $variant == 'italic':
                return 'font-weight:400;font-style:italic;'; break;
            case substr( $variant, -1 ) == 'i' or substr( $variant, -6 ) == 'italic':
                return 'font-weight:' . $variant . ';font-style:italic;'; break;
            default:
                return 'font-weight:' . $variant . ';';
        }

    }

    static function collect_font_declaration( $selectors, $font_obj ) {
        if( is_array( $font_obj ) ) { $font_obj = (object)$font_obj; }
        $variants = '';
        if( isset( $font_obj->variants ) ) {
            $variants .= self::variants( $font_obj->variants );
        }
        self::$font_declarations .= $selectors . '{font-family:"' . esc_html( $font_obj->family ) . '";' . esc_attr( $variants ) . '}';

    }
}
Bw_theme_fonts::init();
