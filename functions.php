<?php
/**
 * jaegersound functions and definitions
 *
 * @package jaegersound
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'jaegersound_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jaegersound_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on jaegersound, use a find and replace
	 * to change 'jaegersound' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'jaegersound', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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

	add_action('init','kb_remove_thumbs'); //Disable Thumbnails for Pages
	function kb_remove_thumbs() {
		remove_post_type_support('page','thumbnail');
	}



	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'jaegersound' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', // 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	/*add_theme_support( 'custom-background', apply_filters( 'jaegersound_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );*/
}
endif; // jaegersound_setup
add_action( 'after_setup_theme', 'jaegersound_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
/*function jaegersound_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'jaegersound' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'jaegersound_widgets_init' );
*/
/**
 * Enqueue scripts and styles.
 */
function jaegersound_scripts() {
	//	wp_enqueue_style( 'jaegersound-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'jaegersound-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'jaegersound-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
//add_action( 'wp_enqueue_scripts', 'jaegersound_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Cleanup File.
 */
require get_template_directory() . '/inc/cleanup.php';
/**
 * Add Theme Options Page
 */
require get_template_directory() . '/inc/theme-options.php';
/**
 * Add icons (e.g. touchicon iphone)
 */
require get_template_directory() . '/inc/icons.php';

/**
 * Require Plugins through TGM Plugin Activation http://tgmpluginactivation.com/
 */
require get_template_directory() . '/inc/require-plugin.php';


/**
 * Add Theme specific functions
 */
require get_template_directory() . '/inc/themefunctions.php';


/**
 * Make Wordpress Clientfriendly
 */
require get_template_directory() . '/inc/clientfriendly.php';




//Responsive Video Embedd
//add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
//function my_embed_oembed_html($html, $url, $attr, $post_id) {
//  return '<div class="flex-video widescreen vimeo">' . $html . '</div>';
//}


