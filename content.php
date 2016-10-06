
<?php if(is_single() || is_page()) { ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-header">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
    </div>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </article>
<?php } else { ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <?php echo get_the_post_thumbnail($post, 'event-small'); ?>
      </div>
      <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
        <div class="entry-header">
          <h1 class="entry-title">
            <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?></a>
          </h1>
        </div>
        <div class="entry-content">
          <a href="<?php the_permalink(); ?>">
          <?php the_excerpt(); ?></a>
        </div>
      </div>
    </div>
    <hr>
  </article>
<?php }
