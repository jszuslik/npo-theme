<?php
/**
 * Theme: Recall
 *
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package recall-parent
 */
?>
<section class="no-results not-found">
  <header class="page-header">
    <h1 class="page-title">Nothing Found</h1>
  </header>
  <div class="page-content">
		<?php if ( is_search() ) : ?>

			<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
			<?php get_search_form(); ?>

		<?php endif; ?>
  </div>
</section>
