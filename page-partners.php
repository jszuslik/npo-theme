<?php
/**
 * Theme: Recall
 *
 * The template for displaying full width pages.
 *
 * Template Name: Partners
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
							<div class="row">
								<?php while ( have_rows('partners') ) : the_row(); ?>
									<?php $partner_name = get_sub_field('partner_name'); ?>
		              <?php $partner_logo = get_sub_field('partner_logo'); ?>
									<?php $partner_url = get_sub_field('partner_url'); ?>
									<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 partner_div">
										<span class="helper">
										<img class="partner_logo" src="<?php echo $partner_logo['sizes']['partners-thumb']; ?>" alt="<?php echo $partner_logo['alt']; ?>" > </span>
										<?php echo '<a href="'.$partner_url.'" target="_blank"><h4 style="text-align:center">'.$partner_name.'</h4></a>'; ?>
									</div>
								<?php endwhile; // end of the loop. ?>
							</div>
							<?php endwhile; // end of the loop. ?>

						</main>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>
