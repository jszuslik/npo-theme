<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
<section class="all_page_content">
	<div class="color_wrap">
		<div class="grad_wrapper">
			<div class="container">
				<div id="main-grid" class="row">
					<div id="primary" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :?>
		<section class="all_page_content">
			<div class="color_wrap">
				<div class="grad_wrapper">
					<div class="container">
						<div id="main-grid" class="row">
							<div id="primary" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
								<main id="main" class="site-main" role="main">
									No Results Found
								</main>
							</div>
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php endif;
		?>
	</main>
	</div>
	<?php get_sidebar(); ?>
	</div>
	</div>
	</div>
	</div>
	</section>
<?php get_footer(); ?>
