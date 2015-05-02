<?php
/**
 * The template for displaying all single posts.
 *
 * @package jaegersound
 */

get_header(); ?>

	<div id="primary" class="content-area row">
		<main id="main" class="site-main large-12 columns" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>



		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
		$term_list = wp_get_post_terms($post->ID, 'technik', array("fields" => "names"));

		if(!empty($term_list)):
	?>
		<div class="techdetails">
			<div class="row">
				<div class="large-8 large-offset-2 columns">
					<h3>Verwendete Technik</h3>
					<ul>
						<?php
						//Returns Array of Term Names for "my_taxonomy"
						$term_list = wp_get_post_terms($post->ID, 'technik', array("fields" => "names"));
						foreach($term_list AS $term)
						   {
						   echo "<li>".$term."</li>";
						   };
						?>
					</ul>	
				</div>
			</div>
		</div>
		<?php
		endif;
	?>
	<?php
	jaegersound_home_news('Weitere Referenzen', $post->ID);
	?>

<?php get_footer(); ?>
