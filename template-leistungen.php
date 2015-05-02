<?php
/*
Template Name: Leistungen
*/
get_header(); ?>
<div class="jcarousel-wrapper" id="">
	<?php
		jaegersound_home_tech(); //Technik einfügen
	?>
	<div id="primary" class="content-area row">
		<main id="main" class="site-main large-12 columns" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
		jaegersound_home_news('Referenzen', $post->ID); //Referenzen einfügen
?>

<?php get_footer(); ?>
