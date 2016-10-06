<?php
/**
 * Theme: Recall
 *
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package recall-parent
 */
?>
<?php get_header(); ?>
<section class="all_page_content">
	<div class="color_wrap">
		<div class="grad_wrapper">
			<div class="container">
				<div id="main-grid" class="row">
					<?php get_sidebar(); ?>
					<div id="primary" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<main id="main" class="site-main" role="main">
							<?php if( have_posts() ) : ?>
								<?php /* Start the loop */ ?>
								<?php while ( have_posts() ) : the_post(); ?>

									<?php
										/* Include the Post-Format-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Format name) and that will be used instead.
										*/
									 	get_template_part( 'content', get_post_format() );
									?>
								<?php endwhile; ?>
								<?php get_template_part( 'content', 'navigation' ); ?>
							<?php else : ?>
								<?php get_template_part( 'no-results', 'index' ); ?>
							<?php endif; ?>
						</main>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
