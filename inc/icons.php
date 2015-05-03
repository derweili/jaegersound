<?php
add_action('wp_head','jaegersound_icons');
function jaegersound_icons()
{
?>
<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/manifest.json">

<!--Hide Browser UI iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">

<!-- icon in the highest resolution we need it for -->
<link rel="icon" sizes="228x228" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/icon.png">
<!-- reuse same icon for Safari -->
<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/icons/ios-icon.png">
<!-- multiple icons for IE -->
<meta name="msapplication-square70x70logo" content="<?php echo get_stylesheet_directory_uri(); ?>/icons/smalltile.png">
<meta name="msapplication-square150x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/icons/mediumtile.png">
<meta name="msapplication-wide310x150logo" content="<?php echo get_stylesheet_directory_uri(); ?>/icons/widetile.png">
<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri(); ?>/icons/largetile.png">

<meta name="application-name" content="<?php bloginfo('name'); ?>">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">


<!-- Colors -->
<!-- Chrome & Firefox OS -->
<meta name="theme-color" content="#0267B2">
<!-- Windows Phone -->
<meta name="msapplication-navbutton-color" content="#0267B2">
<!-- iOS Safari -->


<!-- Startup Image- -->

<!-- iOS 6 & 7 iPad (retina, portrait) -->
<!--<link href="/static/images/apple-touch-startup-image-1536x2008.png"
     media="(device-width: 768px) and (device-height: 1024px)
        and (orientation: portrait)
        and (-webkit-device-pixel-ratio: 2)"
     rel="apple-touch-startup-image">-->

<!-- iOS 6 & 7 iPad (retina, landscape) -->
<!--<link href="/static/images/apple-touch-startup-image-1496x2048.png"
     media="(device-width: 768px) and (device-height: 1024px)
        and (orientation: landscape)
        and (-webkit-device-pixel-ratio: 2)"
     rel="apple-touch-startup-image">-->

<!-- iOS 6 iPad (portrait) -->
<!--<link href="/static/images/apple-touch-startup-image-768x1004.png"
     media="(device-width: 768px) and (device-height: 1024px)
        and (orientation: portrait)
        and (-webkit-device-pixel-ratio: 1)"
     rel="apple-touch-startup-image">-->

<!-- iOS 6 iPad (landscape) -->
<!--<link href="/static/images/apple-touch-startup-image-748x1024.png"
     media="(device-width: 768px) and (device-height: 1024px)
        and (orientation: landscape)
        and (-webkit-device-pixel-ratio: 1)"
     rel="apple-touch-startup-image">-->

<!-- iOS 6 & 7 iPhone 5 -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-touch-startup-image-640x1096.png"
     media="(device-width: 320px) and (device-height: 568px)
        and (-webkit-device-pixel-ratio: 2)"
     rel="apple-touch-startup-image">

<!-- iOS 6 & 7 iPhone (retina) -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-touch-startup-image-640x920.png"
     media="(device-width: 320px) and (device-height: 480px)
        and (-webkit-device-pixel-ratio: 2)"
     rel="apple-touch-startup-image">

<!-- iOS 6 iPhone -->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/icons/apple-touch-startup-image-320x460.png"
     media="(device-width: 320px) and (device-height: 480px)
        and (-webkit-device-pixel-ratio: 1)"
     rel="apple-touch-startup-image">
<?php
}