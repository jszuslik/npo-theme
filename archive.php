<?php
/**
 * Theme: Recall
 *
 * The template for displaying all archives.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package recall-parent
 */

get_header(); ?>

<div class="container">
	<div id="main-grid" class="row">
		<?php get_sidebar(); ?>
		<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-9 col-lg-9">
		    <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'recall-parent' ),
				'next_text'          => __( 'Next page', 'recall-parent' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'recall-parent' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
      </main>
    </div>

  </div>
</div>
<?php get_footer(); ?>
