<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package jaegersound
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.css" />
<link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,700' rel='stylesheet' type='text/css'>
<!--<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/vendor/jquery.js"></script>-->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.png" />
<?php wp_enqueue_script( "jquery" ); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jcarousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/touchswipe.min.js"></script>
<?php
	 $options = get_option('jaegersound_theme_options');
	  echo $options['analytics'];
?>
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/theme.css">

</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.3&appId=822229774537276";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jaegersound' ); ?></a>

		<div class="contain-to-grid fixed">
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
				    <li class="name">
				    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/jaegersound.jpg" style="max-width:152px;margin-top:8px;"/></a>
				    </li>
					<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				    <li class="toggle-topbar"><a href="#"><span>Menü</span></a></li>
				 </ul>
				<section class="top-bar-section">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'right' ) ); ?>
					<!-- Left Nav Section -->
				    
				</section>
			</nav><!-- #site-navigation -->
		</div>

	<div id="content" class="site-content">
