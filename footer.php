<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package jaegersound
 */
?>

	</div><!-- #content -->

	<footer id="footer" class="site-footer" role="contentinfo">
		<h3>Kontakt</h3>
    <?php 
    $options = get_option('jaegersound_theme_options');
    echo do_shortcode( $options['footershortcode'] ); ?>
<!--<form action="#kontakt" method="post">
<div class="row">
	<div class="large-4 columns">
		<input type="text" placeholder="Name"/>
		<input type="email" placeholder="Email"/>
	</div>
	<div class="large-5 columns">
		<textarea placeholder="Nachricht"></textarea>
	</div>
	<div class="large-3 columns">
		<input type="submit" class="submit" />
	</div>
</div><!-- .site-info -->
		</form>
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/foundation.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/foundation/foundation.topbar.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/foundation/foundation.clearing.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jcarousel.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/touchswipe.min.js"></script>

<script>
jQuery(document).foundation();
</script>

<!-- Startseite Slider Script -->
<script type="text/javascript"> 
    //width des slider containers holen (gleichzeitig browserwidth)
    var sliderWidth = jQuery('.jcarousel').width();

    (function(jQuery) {
      
        jQuery(function() {
            jQuery('.jcarousel')
                .jcarousel({
                   wrap: 'circular'
                })
              .jcarouselAutoscroll({
                  interval: 8000,
                  target: '+=1',
                  autostart: true
              });

        jQuery('.jcarousel-pagination')
          .on('jcarouselpagination:active', 'span', function() {
              jQuery(this).addClass('active');
          })
          .on('jcarouselpagination:inactive', 'span', function() {
              jQuery(this).removeClass('active');
          })
          .jcarouselPagination({
              'perPage' : 1,
              'item': function(page, carouselItems) {
                    return '<span class="bullet"></span>';
            }
          });
        });

        //bei pageload width der einzelnen slide an container width anpassen
        jQuery('.jcarousel .slide').css('width', sliderWidth );

    })(jQuery); 

    //bei resize width der einzelnen slide an container width anpassen
    jQuery(window).resize(function(event) {

      //neue container width holen
      sliderWidth = jQuery('.jcarousel').width();

      jQuery('.jcarousel .slide').css('width', sliderWidth );
    });
    //
    //swipe aktivieren
    //
    jQuery(function() {      
        jQuery(".jcarousel-wrapper").swipe( {
          swipeLeft:function(event, direction, distance, duration, fingerCount, fingerData) {
            jQuery('.jcarousel').jcarousel('scroll', '+=1');  
          },
          swipeRight:function(event, direction, distance, duration, fingerCount, fingerData) {
            jQuery('.jcarousel').jcarousel('scroll', '-=1');  
          },
          //Default is 75px
           threshold: 50
        });
    });


  </script>
<?php wp_footer(); ?>

</body>
</html>
