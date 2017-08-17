<?php 
if ( ! function_exists( 'proton_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function proton_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Blask, use a find and replace
	 * to change 'proton' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'proton', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_editor_style( array( 'editor-style.css', proton_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'proton-post-thumbnail', 880, 9999, false ); // Large Post Image

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'proton' ),
		'secundary'  => esc_html__( 'Secundary Menu', 'proton' ),
		'social'  => esc_html__( 'Social Menu', 'proton' ),

	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'proton_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // proton_setup
add_action( 'after_setup_theme', 'proton_setup' );
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function proton_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'proton_customize_register' );
/**
 * Register Widgets
 */
function proton_widgets_init() { 	
		register_sidebar( array(
		'name'          => __( 'Widget Area', 'proton' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'proton' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => __( 'Top Header-Widget', 'proton' ),
		'id'            => 'sidebar-header-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'proton' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
		register_sidebar( array(
		'name'          => __( 'Bottom Header-Widget', 'proton' ),
		'id'            => 'sidebar-header-2',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'proton' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'proton_widgets_init' );

/**
 * Register Google Fonts
 */
function proton_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Arimo, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' != _x( 'on', 'Arimo font: on or off', 'proton' ) ) {
		$fonts[] = 'Arimo:400,700,400italic,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Roboto Condensed, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' != _x( 'on', 'Roboto Condensed font: on or off', 'proton' ) ) {
		$fonts[] = 'Roboto Condensed:400,700,400italic,700italic';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'proton' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}


/**
 * Enqueue scripts and styles.
 */
function proton_scripts() {
	wp_enqueue_style( 'proton-style', get_stylesheet_uri() );

	wp_register_style( 'ṕroton-layout-style', get_stylesheet_directory_uri() . '/library/css/proton-layout.css', array(), '', 'all' );

	wp_enqueue_style('ṕroton-layout-style');


}
add_action( 'wp_enqueue_scripts', 'proton_scripts' );

?>
