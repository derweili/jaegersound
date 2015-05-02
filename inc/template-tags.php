<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jaegersound
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'jaegersound' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'jaegersound' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'jaegersound' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'jaegersound' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


if ( ! function_exists( 'jaegersound_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jaegersound_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'jaegersound' ) );
		if ( $categories_list && jaegersound_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'jaegersound' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'jaegersound' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'jaegersound' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'jaegersound' ), __( '1 Comment', 'jaegersound' ), __( '% Comments', 'jaegersound' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'jaegersound' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'jaegersound' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'jaegersound' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'jaegersound' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'jaegersound' ), get_the_date( _x( 'Y', 'yearly archives date format', 'jaegersound' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'jaegersound' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'jaegersound' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'jaegersound' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'jaegersound' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'jaegersound' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'jaegersound' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'jaegersound' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'jaegersound' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'jaegersound' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function jaegersound_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'jaegersound_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'jaegersound_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so jaegersound_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so jaegersound_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in jaegersound_categorized_blog.
 */
function jaegersound_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'jaegersound_categories' );
}
add_action( 'edit_category', 'jaegersound_category_transient_flusher' );
add_action( 'save_post',     'jaegersound_category_transient_flusher' );


if ( ! function_exists( 'jaegersound_home_slider' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jaegersound_home_slider() {
	// Hide category and tag text for pages.
	global $post;  
    $the_query = array(
      'posts_per_page'   => '22',
      'post_type'     => 'slider',
      'orderby'          => 'date',
      'order'            => 'DESC',
      'suppress_filters' => false,
    );
    $posts = get_posts( $the_query );  
    if(!empty($posts)):
		echo '<div class="jcarousel">
	    	<div class="slides_wrap">';

	    	$postcount = '1';
	            foreach( $posts as $post ): setup_postdata( $post );
	            echo '<div class="slide">'.get_the_post_thumbnail().'
		      		<div class="caption">
		              <!--<h2>'.get_the_title().'</h2>
		              <p>Beschreibung Content</p>-->
		            </div>
		        </div>';
		        $postcount ++;
            	endforeach;

		echo '</div>
		    <div class="jcarousel-pagination"></div>
		</div>';
	endif;
}
endif;

if ( ! function_exists( 'jaegersound_home_news' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jaegersound_home_news($a, $b) {
	// Hide category and tag text for pages.
	if(empty($a)){$a = 'Referenzen';}
	global $post;  
    $the_query = array(
      'posts_per_page'   => '3',
      'post_type'     => 'post',
      'orderby'          => 'date',
      'order'            => 'DESC',
      'category_name'    => 'startseite',
      'exclude'			=> $b,
      'suppress_filters' => false,
    );
    $posts = get_posts( $the_query );  
    if(!empty($posts)):
		echo '<div class="related-posts">
		<div class="row">
				<h3>'.$a.'</h3>';

	    	$postcount = 1;
	            foreach( $posts as $post ): setup_postdata( $post );
	            echo '
	            <div class="large-4 medium-4 small-12 columns">
					<a href="'.get_permalink().'">'.get_the_post_thumbnail( get_the_ID(), 'jaegersound-medium-thumb').'</a>
					<h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4>
				</div>
	            ';
		        $postcount ++;
            	endforeach;

		echo '</div>';
		
		$options = get_option('jaegersound_theme_options');

		?>
		<div class="row" style="text-align:center; margin-top:40px;">
			<a class="buttom" href="<?php echo $options['referenzlink']; ?>">Alle Referenzen</a>
		</div>
		</div>
		<?php
	endif;
}
endif;


if ( ! function_exists( 'jaegersound_home_tech' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function jaegersound_home_tech() {
	//Returns Array of Term Names for "my_taxonomy"
	?>
	<div class="techdetails">
		<div class="row">
			<div class="large-8 large-offset-2 columns">
				<h3>Unsere Leistungen</h3>
				<ul>
					<?php
					    $args = array(
							'show_option_all'    => '',
							'orderby'            => 'name',
							'order'              => 'ASC',
							'style'              => 'list',
							'show_count'         => 0,
							'hide_empty'         => 0,
							'use_desc_for_title' => 1,
							'child_of'           => 0,
							'feed'               => '',
							'feed_type'          => '',
							'feed_image'         => '',
							'exclude'            => '',
							'exclude_tree'       => '',
							'include'            => '',
							'hierarchical'       => 0,
							'title_li'           => __( '' ),
							'show_option_none'   => __( '' ),
							'number'             => null,
							'echo'               => 1,
							'depth'              => 0,
							'current_category'   => 0,
							'pad_counts'         => 0,
							'taxonomy'           => 'technik',
							'walker'             => null
						);
				    	wp_list_categories( $args ); 
					?>

				</ul>	
			</div>
		</div>
	</div>
	<?php

}
endif;
