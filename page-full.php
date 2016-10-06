<?php
/**
 * Theme: Recall
 *
 * The template for displaying full width pages.
 *
 * Template Name: Full Width Page (no sidebar)
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
					<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<main id="main" class="site-main" role="main">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'content', 'page' ); ?>

								<?php
									// If comments are open or we have at least one comment, load up the comment template
									if ( comments_open() || '0' != get_comments_number() )
										comments_template();
								?>

							<?php endwhile; // end of the loop. ?>

						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
