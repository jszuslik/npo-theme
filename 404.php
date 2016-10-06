<?php
/**
 * Theme: Recall
 *
 * The template for displaying 404 pages (Not Found).
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
					<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<main id="main" class="site-main" role="main">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						    <div class="entry-header">
						      <h1 class="entry-title">Oops! That page can't be found</h1>
						    </div>
						    <div class="entry-content">
						      <h3>Or as nerds would say, its a "404 Error"</h3>
						    </div>
						  </article>
						</main>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
