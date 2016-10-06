<?php
/**
 * Theme: Recall
 *
 * The Template for displaying all single posts.
 *
 * @package recall-parent
 */
?>
<?php get_header(); ?>
<section class="all_page_content">
	<div class="color_wrap">
		<div class="grad_wrapper">
			<div class="container">
				<?php
					$parent_title = get_the_title($post->post_parent);
					$parent_id = get_post($post->ID)->post_parent;
				?>
				<div class="row breadcrumbs">
					<div class="col-xs-12">
						<ol class="breadcrumb">
							<li><a href="/">Home</a></li>
						<?php if($parent_id != '0') { ?>
							<li><a href="<?php echo esc_url( get_permalink( get_page_by_title( $parent_title ) ) ); ?>"><?php echo $parent_title; ?></a></li>
						<?php } ?>
							<li class="active"><?php the_title(); ?></li>
						</ol>
					</div>
				</div><!-- .row .breadcrumbs -->
				<div id="main-grid" class="row">
					<?php get_sidebar(); ?>
					<div id="primary" class="content-area col-xs-12 col-sm-12 col-md-9 col-lg-9">
						<main id="main" class="site-main" role="main">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'content', 'single' ); ?>

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
