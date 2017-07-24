<?php

# the short name gives a unique element to each options id
$theme_prefix = Bw::$theme_prefix . '_';

# user access level
$capability = 'edit_theme_options';

# here we will set the options we are going to have in the customizer.
$options = array(); // If you delete this line, the sky will fall down! So you better don't.


/* ---------------------------------------------------------------------------------------------------
    Panels (optional - WP 4.0+ only)
--------------------------------------------------------------------------------------------------- */

$options[] = array(
    'title'             => esc_html__( 'General', 'yago' ),
    'id'                => $theme_prefix . 'general',
    'priority'          => 21,
    'theme_supports'    => '',
    'type'              => 'panel'
);

$options[] = array(
    'title'             => esc_html__( 'Fonts', 'yago' ),
    'id'                => $theme_prefix . 'fonts',
    'priority'          => 22,
    'theme_supports'    => '',
    'type'              => 'panel'
);

$options[] = array(
    'title'             => esc_html__( 'Colors', 'yago' ),
    'id'                => $theme_prefix . 'colors',
    'priority'          => 23,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Header', 'yago' ),
    'id'                => $theme_prefix . 'header',
    'priority'          => 24,
    'theme_supports'    => '',
    'type'              => 'panel'
);

$options[] = array(
    'title'             => esc_html__( 'Footer', 'yago' ),
    'id'                => $theme_prefix . 'footer',
    'priority'          => 25,
    'theme_supports'    => '',
    'type'              => 'panel'
);

$options[] = array(
    'title'             => esc_html__( 'Blog', 'yago' ),
    'id'                => $theme_prefix . 'blog',
    'priority'          => 26,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Social', 'yago' ),
    'id'                => $theme_prefix . 'social',
    'priority'          => 27,
    'theme_supports'    => '',
    'type'              => 'section'
);


/* ---------------------------------------------------------------------------------------------------
    Sections
--------------------------------------------------------------------------------------------------- */

$options[] = array(
    'title'             => esc_html__( 'Logo', 'yago' ),
    'panel'             => $theme_prefix . 'general',
    'id'                => $theme_prefix . 'general_logo',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Custom JavaScript', 'yago' ),
    'panel'             => $theme_prefix . 'general',
    'id'                => $theme_prefix . 'custom_js',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Transitions', 'yago' ),
    'panel'             => $theme_prefix . 'general',
    'id'                => $theme_prefix . 'general_transitions',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'General', 'yago' ),
    'panel'             => $theme_prefix . 'footer',
    'id'                => $theme_prefix . 'footer_general',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Body Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_body',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Logo Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_logo',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Navigation Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_navigation',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Headings Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_headings',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Vintage Elements Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_vintage',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);

$options[] = array(
    'title'             => esc_html__( 'Dropcap Font', 'yago' ),
    'panel'             => $theme_prefix . 'fonts',
    'id'                => $theme_prefix . 'fonts_dropcap',
    'priority'          => 10,
    'theme_supports'    => '',
    'type'              => 'section'
);



/* ---------------------------------------------------------------------------------------------------
    Controls
--------------------------------------------------------------------------------------------------- */


$options[] = array(
    'title'             => esc_html__( 'Retina Logo', 'yago' ),
    'description'       => 'Retina Ready Image logo. It should be 2x size of normal logo. For example 200x60px logo will displays at 100x30px',
    'section'           => $theme_prefix . 'general_logo',
    'id'                => $theme_prefix . 'general_logo_img',
    'default'           => '',
    'option'            => 'image',
    'sanitize_callback' => 'esc_url',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Copyright Text Navigation First Line', 'yago' ),
    'section'           => $theme_prefix . 'footer_general',
    'id'                => 'bw_footer_copy_nav',
    'default'           => '',
    'option'            => 'text',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
);

$options[] = array(
    'title'             => esc_html__( 'Copyright Text', 'yago' ),
    'section'           => $theme_prefix . 'footer_general',
    'id'                => 'bw_footer_copy',
    'default'           => '',
    'option'            => 'text',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
);

$options[] = array( 'title' => esc_html__( 'Background Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'footer_general',
    'id'                => $theme_prefix . 'footer_general_bg_color',
    'default'           => '#f7f7f7',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'background-color',
        'selector'          => '.site-footer',
        'unit'              => ''
    )
);

$options[] = array( 'title' => esc_html__( 'Text Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'footer_general',
    'id'                => $theme_prefix . 'footer_general_text_color',
    'default'           => '#000',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'color',
        'selector'          => '.site-footer p',
        'unit'              => ''
    )
);

$options[] = array(
    'title'             => esc_html__( 'Footer Padding', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'footer_general',
    'id'                => $theme_prefix . 'footer_general_padding',
    'default'           => 10,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 0,
        'max'   => 250,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'padding-top',
            'selector'          => '.bw-copyright-p',
            'unit'              => 'px'
        ),
        array(
            'property'          => 'padding-bottom',
            'selector'          => '.bw-copyright-p',
            'unit'              => 'px'
        )
    )
);

$options[] = array(
    'title'             => esc_html__( 'Header', 'yago' ),
    'section'           => $theme_prefix . 'custom_js',
    'id'                => $theme_prefix . 'custom_js_header',
    'default'           => '',
    'option'            => 'css_editor',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'description'       => 'Add your Custom Javascript code. This code will be loaded in the <head> section.',
);

$options[] = array(
    'title'             => esc_html__( 'Footer', 'yago' ),
    'section'           => $theme_prefix . 'custom_js',
    'id'                => $theme_prefix . 'custom_js_footer',
    'default'           => '',
    'option'            => 'css_editor',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'description'       => 'You can paste here your Google Analytics tracking code (or for what matters any tracking code) and it will appear on every page.',
);

$options[] = array(
    'title'             => esc_html__( 'Enable Back To Top Button', 'yago' ),
    'section'           => $theme_prefix . 'back_top',
    'id'                => $theme_prefix . 'back_top_enable',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control',
);

$options[] = array(
    'title'             => esc_html__( 'Text', 'yago' ),
    'section'           => $theme_prefix . 'back_top',
    'id'                => $theme_prefix . 'back_top_text',
    'default'           => '',
    'option'            => 'text',
    'sanitize_callback' => '',
    'type'              => 'control',
);

$options[] = array( 'title'  => esc_html__( 'Body Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_body',
    'id'                => $theme_prefix . 'fonts_body_font',
    'default'           => json_encode( array('family' => 'Merriweather' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array( 'title' => esc_html__( 'Logo Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_logo',
    'id'                => $theme_prefix . 'fonts_logo_font',
    'default'           => json_encode( array( 'family' => '' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Logo Font Weight', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_logo',
    'id'                => $theme_prefix . 'fonts_logo_font_weight',
    'default'           => '700',
    'option'            => 'select',
    'choices'           => array(
        '100'           => 'Thin',
        '400'           => 'Regular',
        '700'           => 'Bold',
        '900'           => 'Black',
    ),
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'font-weight',
        'selector'          => '.site-branding .site-title',
        'unit'              => ''
    ),
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Logo Font Size', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_logo',
    'id'                => $theme_prefix . 'fonts_logo_font_size',
    'default'           => 60,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 30,
        'max'   => 150,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'font-size',
        'selector'          => '.site-branding .site-title',
        'unit'              => 'px'
    )
);

/*$options[] = array(
    'title'             => esc_html__( 'Logo padding', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_logo',
    'id'                => $theme_prefix . 'fonts_logo_height',
    'default'           => 30,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 0,
        'max'   => 60,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'padding-top',
            'selector'          => '.site-branding',
            'unit'              => 'px'
        ),
        array(
            'property'          => 'padding-bottom',
            'selector'          => '.site-branding',
            'unit'              => 'px'
        ),
    )
);*/

$options[] = array(
    'title'             => esc_html__( 'Text Transform', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_logo',
    'id'                => $theme_prefix . 'fonts_logo_transform',
    'default'           => 'none',
    'option'            => 'select',
    'sanitize_callback' => '',
    'choices'           => array(
        'none'              => 'None',
        'capitalize'        => 'Capitalize',
        'uppercase'         => 'Uppercase',
        'lowercase'         => 'Lowercase',
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'text-transform',
        'selector'          => '.site-branding .site-title',
        'unit'              => ''
    )
);

$options[] = array( 'title' => esc_html__( 'Navigation Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_font',
    'default'           => json_encode( array( 'family' => '' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Navigation Font Size', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_size',
    'default'           => 14,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 10,
        'max'   => 70,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'font-size',
        'selector'          => '.main-navigation ul li a',
        'unit'              => 'px'
    )
);

$options[] = array(
    'title'             => esc_html__( 'Navigation Font Height', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_height',
    'default'           => 100,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 30,
        'max'   => 140,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'line-height',
            'selector'          => '.main-navigation ul.menu > li',
            'unit'              => 'px'
        ),
    )
);

$options[] = array(
    'title'             => esc_html__( 'Text Transform', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_transform',
    'default'           => 'uppercase',
    'option'            => 'select',
    'sanitize_callback' => '',
    'choices'           => array(
        'none'              => 'None',
        'capitalize'        => 'Capitalize',
        'uppercase'         => 'Uppercase',
        'lowercase'         => 'Lowercase',
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'text-transform',
        'selector'          => '.main-navigation ul li a',
        'unit'              => ''
    )
);

$options[] = array(
    'title'             => esc_html__( 'Navigation Font Space', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_space',
    'default'           => 0,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => -2,
        'max'   => 15,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'letter-spacing',
        'selector'          => '.main-navigation ul li a',
        'unit'              => 'px'
    )
);

$options[] = array(
    'title'             => esc_html__( 'Navigation Menu Item Space', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_menu_item_space',
    'default'           => 0,
    'option'            => 'range',
    'sanitize_callback' => '',
    'input_attrs'       => array(
        'min'   => 5,
        'max'   => 30,
        'step'  => 1,
    ),
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'padding-left',
            'selector'          => '.main-navigation ul li',
            'unit'              => 'px'
        ),
        array(
            'property'          => 'padding-right',
            'selector'          => '.main-navigation ul li',
            'unit'              => 'px'
        ),
    )
);

$options[] = array(
    'title'             => esc_html__( 'Headings Font Weight', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_navigation',
    'id'                => $theme_prefix . 'fonts_navigation_font_weight',
    'default'           => '400',
    'option'            => 'select',
    'choices'           => array(
        '100'           => 'Thin',
        '400'           => 'Regular',
        '700'           => 'Bold',
        '900'           => 'Black',
    ),
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'font-weight',
        'selector'          => '.main-navigation .menu > li > a',
        'unit'              => ''
    ),
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array( 'title' => esc_html__( 'Headings Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_headings',
    'id'                => $theme_prefix . 'fonts_headings_font',
    'default'           => json_encode( array( 'family' => '' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Headings Font Weight', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_headings',
    'id'                => $theme_prefix . 'fonts_headings_font_weight',
    'default'           => '400',
    'option'            => 'select',
    'choices'           => array(
        '400'           => 'Regular',
        '700'           => 'Bold',
    ),
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'font-weight',
        'selector'          => 'h1,h2,h3,h4,h5,h6',
        'unit'              => ''
    ),
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array( 'title' => esc_html__( 'Vintage Elements Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_vintage',
    'id'                => $theme_prefix . 'fonts_vintage_font',
    'default'           => json_encode( array( 'family' => '' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Larger Fonts Size for Vintage Elemenets', 'yago' ),
    'section'           => $theme_prefix . 'fonts_vintage',
    'id'                => $theme_prefix . 'fonts_vintage_bigger',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array( 'title' => esc_html__( 'Dropcap Font', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'fonts_dropcap',
    'id'                => $theme_prefix . 'fonts_dropcap_font',
    'default'           => json_encode( array( 'family' => '' ) ),
    'option'            => 'font',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array( 'title' => esc_html__( 'Accent Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_main',
    'default'           => '#ffd09d',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'color',
            'selector'          => 'a, .bw-carousel-slide .bw-carousel-text p, .bw-social li a:hover, .entry-title a:hover, .entry-caption, .gallery-caption, .wp-caption .wp-caption-text, .author-name a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .bw-page-header .bw-blog-description, .bw-page-header p',
            'unit'              => ''
        ),
        array(
            'property'          => 'background-color',
            'selector'          => '.entry-meta .category-list a:hover, .bw-page-header .entry-meta .category-list a:hover'.
                                    ', .menu-toggle i, .menu-toggle i:before, .menu-toggle i:after, .main-navigation ul li > .bw-menu-next i:after',
            'unit'              => ''
        ),
        array(
            'property'          => 'border-color',
            'selector'          => '',
            'unit'              => ''
        ),
        array(
            'property'          => 'border-left-color',
            'selector'          => '.main-navigation ul li > .bw-menu-next i:before',
            'unit'              => ''
        ),
    )
);

$options[] = array( 'title' => esc_html__( 'Post Accent Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_post_main',
    'default'           => '#c97c8d',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'color',
            'selector'          => '.bw-intro, blockquote, blockquote p, blockquote:after',
            'unit'              => ''
        ),
        array(
            'property'          => 'border-color',
            'selector'          => 'blockquote',
            'unit'              => ''
        ),
    )
);

$options[] = array( 'title' => esc_html__( 'Dropcap Text Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_dropcap_text',
    'default'           => '#c97c8d',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
);

$options[] = array( 'title' => esc_html__( 'Dropcap Shadow Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_dropcap_shadow',
    'default'           => '#efd9dd',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
);

$options[] = array( 'title' => esc_html__( 'Tag Background Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_tag_bg',
    'default'           => '#f5f5f5',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'background-color',
        'selector'          => '.entry-meta .category-list a',
        'unit'              => ''
    )
);

$options[] = array( 'title' => esc_html__( 'Tag Text Color', 'yago' ),
    'description'       => '',
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_tag_text',
    'default'           => '#000',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'color',
        'selector'          => '.entry-meta .category-list a',
        'unit'              => ''
    )
);

$options[] = array(
    'title'             => esc_html__( 'Buttons Background Color', 'yago' ),
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_buttons_bg',
    'default'           => '#111',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        'property'          => 'background-color',
        'selector'          => '.form-submit input[type="submit"], .wpcf7-form .cf7-form-row .wpcf7-submit',
        'unit'              => ''
    )
);

$options[] = array(
    'title'             => esc_html__( 'Menu Background Color', 'yago' ),
    'section'           => $theme_prefix . 'colors',
    'id'                => $theme_prefix . 'colors_menu_bg',
    'default'           => '#fff',
    'option'            => 'color',
    'sanitize_callback' => '',
    'type'              => 'control',
    'transport'         => 'postMessage',
    'css'               => array(
        array(
            'property'          => 'background-color',
            'selector'          => '.bw-side-nav-cover, .main-navigation ul li a:after',
            'unit'              => ''
        ),
        array(
            'property'          => 'fill',
            'selector'          => '.bw-side-nav-cover .bw-side-edge #bw-svg-enge svg',
            'unit'              => ''
        )
    )
);

$options[] = array(
    'title'             => esc_html__( 'Display Dropcap', 'yago' ),
    'section'           => $theme_prefix . 'blog',
    'id'                => $theme_prefix . 'blog_dropcap',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Display Author', 'yago' ),
    'section'           => $theme_prefix . 'blog',
    'id'                => $theme_prefix . 'blog_author',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Display Categories', 'yago' ),
    'section'           => $theme_prefix . 'blog',
    'id'                => $theme_prefix . 'blog_cats',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Display Tags', 'yago' ),
    'section'           => $theme_prefix . 'blog',
    'id'                => $theme_prefix . 'blog_tags',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

$options[] = array(
    'title'             => esc_html__( 'Display Related Articles', 'yago' ),
    'section'           => $theme_prefix . 'blog',
    'id'                => $theme_prefix . 'blog_related',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

    $options[] = array(
        'title'             => esc_html__( 'Enable Article Share', 'yago' ),
        'section'           => $theme_prefix . 'blog',
        'id'                => $theme_prefix . 'blog_enable_share',
        'default'           => '',
        'option'            => 'checkbox',
        'sanitize_callback' => '',
        'type'              => 'control'
    );

        $options[] = array(
            'title'             => esc_html__( 'Enable Share With Facebook', 'yago' ),
            'section'           => $theme_prefix . 'blog',
            'id'                => $theme_prefix . 'blog_share_facebook',
            'default'           => '',
            'option'            => 'checkbox',
            'sanitize_callback' => '',
            'type'              => 'control'
        );

        $options[] = array(
            'title'             => esc_html__( 'Enable Share With Twitter', 'yago' ),
            'section'           => $theme_prefix . 'blog',
            'id'                => $theme_prefix . 'blog_share_twitter',
            'default'           => '',
            'option'            => 'checkbox',
            'sanitize_callback' => '',
            'type'              => 'control'
        );

        $options[] = array(
            'title'             => esc_html__( 'Enable Share With Pinterest', 'yago' ),
            'section'           => $theme_prefix . 'blog',
            'id'                => $theme_prefix . 'blog_share_pinterest',
            'default'           => '',
            'option'            => 'checkbox',
            'sanitize_callback' => '',
            'type'              => 'control'
        );

        $options[] = array(
            'title'             => esc_html__( 'Enable Share With Google', 'yago' ),
            'section'           => $theme_prefix . 'blog',
            'id'                => $theme_prefix . 'blog_share_google',
            'default'           => '',
            'option'            => 'checkbox',
            'sanitize_callback' => '',
            'type'              => 'control'
        );

$options[] = array(
    'title'             => esc_html__( 'Enable Header Social Icons', 'yago' ),
    'section'           => $theme_prefix . 'social',
    'id'                => $theme_prefix . 'social_header_enable',
    'default'           => '',
    'option'            => 'checkbox',
    'sanitize_callback' => '',
    'type'              => 'control'
);

global $bw_social_arr;
$bw_social_arr = array(
    'facebook'      => esc_html__( 'Facebook', 'yago' ),
    'twitter'       => esc_html__( 'Twitter', 'yago' ),
    'google-plus'   => esc_html__( 'Google Plus', 'yago' ),
    'linkedin'      => esc_html__( 'Linkedin', 'yago' ),
    'youtube'       => esc_html__( 'Youtube', 'yago' ),
    'vimeo'         => esc_html__( 'Vimeo', 'yago' ),
    'instagram'     => esc_html__( 'Instagram', 'yago' ),
    'flickr'        => esc_html__( 'Flickr', 'yago' ),
    'dribbble'      => esc_html__( 'Dribbble', 'yago' ),
    'github'        => esc_html__( 'Github', 'yago' ),
    'pinterest'     => esc_html__( 'Pinterest', 'yago' ),
    'behance'       => esc_html__( 'Behance', 'yago' ),
    'xing'          => esc_html__( 'Xing', 'yago' ),
    '500px'         => esc_html__( '500px', 'yago' ),
);

foreach( $bw_social_arr as $social => $label ) {
    $options[] = array(
        'title'             => $label,
        'section'           => $theme_prefix . 'social',
        'input_attrs' => array(
            'placeholder' => 'http://',
        ),
        'id'                => 'social_icons[' . $social . ']',
        'default'           => '',
        'option'            => 'text',
        'sanitize_callback' => '',
        'type'              => 'control',
        'transport'         => 'postMessage',
    );
}



/* ---------------------------------------------------------------------------------------------------
    End Control Options
--------------------------------------------------------------------------------------------------- */

# do not edit or delete below, this will include any child theme options
if ( file_exists( get_stylesheet_directory() .'/customizer.php' ) ) {
    include get_stylesheet_directory() . '/customizer.php';
}
