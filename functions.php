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
		'aside', // 'image', 'video', 'quote', 'link',
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
	wp_enqueue_style( 'jaegersound-style', get_stylesheet_uri() );

	wp_enqueue_script( 'jaegersound-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'jaegersound-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'jaegersound_scripts' );

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
 * Make Wordpress Clientfriendly
 */
require get_template_directory() . '/inc/clientfriendly.php';




add_filter('post_gallery', 'my_post_gallery', 10, 2); //replace Wordpress Gallery
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        $imggallerycount = 1; //Count the numer of the picture
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"slideshow-wrapper\">\n";
    $output .= "<div class='row'><div class='large-12 columns'><ul class='clearing-thumbs small-block-grid-4' data-clearing>";
    //$output .= "<ul data-orbit>\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
      	$img = wp_prepare_attachment_for_js($id);

		// If you want a different size change 'large' to eg. 'medium'
		$url = $img['sizes']['thumbnail']['url'];
		$urlfull = $img['sizes']['full']['url'];
		$height = $img['sizes']['medium']['height'];
		$width = $img['sizes']['medium']['width'];
		$alt = $img['alt'];
		// Store the caption
    	$caption = $img['caption'];

        $output .= "<li class='pciturenumber-".$imggallerycount."'>\n";
        $output .= "<a href=\"{$urlfull}\"><img data-caption=\"{$caption}\" src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\" /></a>\n";
        $output .= "</li>\n";
        $imggallerycount ++;
    }
    $output .= "</div></div></div>\n";

    return $output;
}


//Post Types hinzufügen
add_action( 'init', 'jaegersound_register_slider' );
function jaegersound_register_slider() {
	$labels = array(
		"name" => "Slider",
		"singular_name" => "Slider",
		);

	$args = array(
		"labels" => $labels,
		"description" => "Bilderslider auf der Startseite",
		"public" => false,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => false,
						"supports" => array( "title", "thumbnail" ),			);
	register_post_type( "slider", $args );

// End of cptui_register_my_cpts()
}


//Tadonomie hinzufügen
add_action( 'init', 'jaegersound_register_technik' );
function jaegersound_register_technik() {

	$labels = array(
		"name" => "Technik",
		"label" => "Technik",
			);

	$args = array(
		"labels" => $labels,
		"hierarchical" => true,
		"label" => "Technik",
		"show_ui" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'technik', 'with_front' => true ),
		"show_admin_column" => false,
	);
	register_taxonomy( "technik", array( "post" ), $args );

// End cptui_register_my_taxes

}

add_action( 'after_setup_theme', 'jaegersound_theme_setup' );
function jaegersound_theme_setup() {
	 add_image_size( 'jaegersound-thumb', 640, 427, true ); // 300 pixels wide (and unlimited height)
	 add_image_size( 'jaegersound-medium-thumb', 183, 122, true ); // 300 pixels wide (and unlimited height)
	 add_image_size( 'jaegersound-archive', 610 ); //  pixels wide (and unlimited height)

	}


//Kommentare deaktivieren
function disable_comments_status()
	{
	return false;
	}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);
function disable_comments_post_types_support()
	{
	$post_types = get_post_types();
	foreach($post_types as $post_type)
		{
		if (post_type_supports($post_type, 'comments'))
			{
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
			}
		}
	}
add_action('admin_init', 'disable_comments_post_types_support');
function disable_comments_hide_existing_comments($comments)
	{
	$comments = array();
	return $comments;
	}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);
function disable_comments_admin_menu()
	{
	remove_menu_page('edit-comments.php');
	}
add_action('admin_menu', 'disable_comments_admin_menu');
function disable_menus_admin_bar_render()
	{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	}
add_action('wp_before_admin_bar_render', 'disable_menus_admin_bar_render');

//CSS Klassen von Bildern entfernen
function jaegersound_remove_class($output)
	{
	$output = preg_replace('//', '', $output);
	return $output;
	}
add_filter('post_thumbnail_html', 'jaegersound_remove_class');
add_filter('the_content', 'jaegersound_remove_class');


//Responsive Video Embedd
//add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
//function my_embed_oembed_html($html, $url, $attr, $post_id) {
//  return '<div class="flex-video widescreen vimeo">' . $html . '</div>';
//}

add_filter( 'category_rewrite_rules', 'filter_category_rewrite_rules' ); //Delete Category from Permalink http://fastwp.de/3540/
function filter_category_rewrite_rules( $rules ) {
 
    $categories = get_categories( array( 'hide_empty' => false ) );
 
    if ( is_array( $categories ) && ! empty( $categories ) ) {
        $slugs = array();
 
        foreach ( $categories as $category ) {
            if ( is_object( $category ) && ! is_wp_error( $category ) ) {
                if ( 0 == $category->category_parent )
                    $slugs[] = $category->slug;
                else
                    $slugs[] = trim( get_category_parents( $category->term_id, false, '/', true ), '/' );
            }
        }
 
        if ( ! empty( $slugs ) ) {
            $rules = array();
 
            foreach ( $slugs as $slug ) {
                $rules[ '(' . $slug . ')/feed/(feed|rdf|rss|rss2|atom)?/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
                $rules[ '(' . $slug . ')/(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
                $rules[ '(' . $slug . ')(/page/(\d)+/?)?$' ] = 'index.php?category_name=$matches[1]&paged=$matches[3]';
            }
        }
    }
    return $rules;
}

function filter_ptags_on_images($content) //remove p-tags from imagesavealpha(image, saveflag)
	{
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
add_filter('the_content', 'filter_ptags_on_images');


function remove_class($output) //remoce css classes from images
	{
	$output = preg_replace('//', '', $output);
	return $output;
	}
add_filter('post_thumbnail_html', 'remove_class');
add_filter('the_content', 'remove_class');


//Login Logo
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/site-login-logo.png);
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/site-login-logo.svg);
            padding-bottom: 0px;
            margin-bottom: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
