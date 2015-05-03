<?php
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
                        "supports" => array( "title", "thumbnail" ),            );
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





//Login Logo
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php bloginfo('template_directory'); ?>/img/site-login-logo.png);
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/site-login-logo.svg);
            padding-bottom: 0px;
            margin-bottom: 0;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

//Remove category base from Permalink http://fastwp.de/3540/
add_filter( 'category_rewrite_rules', 'filter_category_rewrite_rules' ); 
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

//Register Scripts
function jaegersound_register_scripts() {
    /*Header Script*/
    wp_register_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array( 'jquery' ), 1.0);
    wp_register_script( 'jcarousel', get_template_directory_uri() . '/js/jcarousel.min.js', array( 'jquery' ), 1.0, true);
    wp_register_script( 'touchswipe', get_template_directory_uri() . '/js/touchswipe.min.js', array( 'jquery' ), 1.0, true);
    wp_register_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), 1.0, true);
    wp_register_script( 'foundation-topbar', get_template_directory_uri() . '/js/foundation/foundation.topbar.js', array( 'jquery', 'foundation' ), 1.0, true);
    wp_register_script( 'foundation-clearing', get_template_directory_uri() . '/js/foundation/foundation.clearing.js', array( 'jquery', 'foundation' ), 1.0, true);
 
    wp_register_style( 'foundation', get_template_directory_uri() . '/css/foundation.css', array(), 1.0, 'screen' );
    wp_register_style( 'JosefinSlab', 'http://fonts.googleapis.com/css?family=Josefin+Slab:400,700', array(), 1.0, 'screen' );
    wp_register_style( 'JosefinSans', 'http://fonts.googleapis.com/css?family=Josefin+Sans:400,700', array(), 1.0, 'screen' );
    wp_register_style( 'theme-css', get_template_directory_uri() . '/css/theme.css', array('foundation'), 1.0, 'screen' );
}
 
add_action( 'wp_enqueue_scripts', 'jaegersound_register_scripts' );


function jaegersound_enqueue_scripts() {
    wp_enqueue_script( "jquery" );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'jcarousel' );
    wp_enqueue_script( 'touchswipe' );
    wp_enqueue_script( 'foundation' );
    wp_enqueue_script( 'foundation-topbar' );
    wp_enqueue_script( 'foundation-clearing' );

    wp_enqueue_style( 'foundation' );
    wp_enqueue_style( 'theme-css' );
    wp_enqueue_style( 'JosefinSlab' );
    wp_enqueue_style( 'JosefinSans' );
}
 
add_action( 'wp_enqueue_scripts', 'jaegersound_enqueue_scripts' );

?>