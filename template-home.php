<?php
/*
Template Name: Home
*/
get_header(); ?>
<div class="jcarousel-wrapper" id="">
	<?php
		jaegersound_home_slider(); //Home Slider
	?>
	<div id="primary" class="content-area row">
		<main id="main" class="site-main large-12 columns" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
		<div style="width:100%; max-width:500px; margin: 0 auto 2rem;">
			<h5>Auf Facebook auf dem Laufenden bleiben:</h5>
<div class="fb-page" data-href="https://www.facebook.com/jaegersoundsinsheim" data-width="640" data-height="350" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jaegersoundsinsheim"><a href="https://www.facebook.com/jaegersoundsinsheim">JaegerSound</a></blockquote></div></div>		</div>
	</div><!-- #primary -->
	<?php
		jaegersound_home_tech(); //Technik einfügen
		jaegersound_home_news('Referenzen', $post->ID, 'Referenzen'); //Referenzen einfügen
	?>

<?php get_footer(); ?>
