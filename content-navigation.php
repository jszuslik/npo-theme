<?php
/**
 * Theme: Recall
 *
 * The template used for paging through the post index, archive, search results
 *
 * @package recall-parent
 */
?>
<nav role="navigation" id="nav-below" class="paging-navigation">
  <?php
  if (is_singular()) {
    // support for pages split by nextpage quicktag
    wp_link_pages();

    if ( comments_open() || get_comments_number() ) :
      comments_template();
    endif;

    // Previous/next post navigation.
    the_post_navigation( array(
      'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
        '<span class="screen-reader-text">' . __( 'Next post:', 'twentyfifteen' ) . '</span> ' .
        '<span class="post-title">%title</span>',
      'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
        '<span class="screen-reader-text">' . __( 'Previous post:', 'twentyfifteen' ) . '</span> ' .
        '<span class="post-title">%title</span>',
    ) );

    // tags anyone?
    the_tags();
  }
  ?>
  <?php if (!is_singular()) : ?>
    <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
    <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>
  <?php endif; ?>
</nav>
