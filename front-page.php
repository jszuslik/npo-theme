<?php
/**
 * Theme: Recall
 *
 * Template Name: Homepage
 *
 * @package recall-parent
 */
?>
<?php get_header(); ?>
  <section id="home-main">
    <div class="container shadow">
      <div class="row">
        <?php
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 2,
            'meta_query' => array('key' => '_start_ts', 'value' => current_time('timestamp'), 'compare' => '>=', 'type'=>'numeric'),
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => '_start_ts',
            'meta_value' => current_time('timestamp'),
            'meta_value_num' => current_time('timestamp'),
            'meta_compare' => '>='
        );

        $events = new WP_Query($args);
        if ($events->have_posts()) { ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
          <p class="event-banner-head">Upcoming Events</p>
          <ul class="events-banner">
              <?php while($events->have_posts() ) : $events->next_post() ;
                $id = $events->post->ID;
                $event_url = get_permalink($id);
                $event_title = get_the_title($id);
                $date_noformat = date_create(get_post_meta($id, '_event_start_date', true));
                $date = date_format($date_noformat, 'l, F jS, Y' );
                echo '<li><a href="'.$event_url.'">'.$event_title.', '.$date.'</a></li>';
              endwhile; ?>
          </ul>
        </div>
        <?php } else { ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 no-padding">
          <p class="event-banner-head">More Events Coming Soon</p>
        </div>
        <?php } wp_reset_query(); ?>
        <?php $home_ID = $post->ID; ?>
        <?php if( have_rows('home_slider', $home_ID) ): ?>
        <div class="hidden-xs col-sm-12 col-md-12 col-lg-12 no-padding">
          <div id="home-owl" class="owl-carousel owl-theme">
            <?php $rows = 0; ?>
            <?php while ( have_rows('home_slider', $home_ID) ) : the_row(); ?>
              <?php $image = get_sub_field('slide_image', $home_ID); ?>

              <div class="item" style="background-image: url(<?php lnx_switch_img_url_to_data_string($image['url'], 'full'); ?>); background-size: contain; background-repeat: no-repeat">
                <?php if(get_sub_field('slide_caption', $home_ID) && get_sub_field('slide_text', $home_ID) ) : ?>
                <div class="caption-box">
                  <p>
                    <span class="caption-title">
                      <?php the_sub_field('slide_caption', $home_ID) ?>
                    </span><br>
                    <?php the_sub_field('slide_text', $home_ID) ?>
                  </p>
                  <a class="caption-button" href="<?php the_sub_field('slide_link', $home_ID); ?>">Learn More</a>
                </div>
                <?php endif; ?>
              </div>
              <?php $rows++; ?>
            <?php endwhile; ?>
          </div>
          <?php if($rows > 1): ?>
            <div class="slide-navigation">
              <a class="homeprev"><i class="fa fa-arrow-circle-o-left"></i></a>
              <a class="homenext"><i class="fa fa-arrow-circle-o-right"></i></a>
            </div>
          <?php endif; ?>
        </div>

      <?php endif; ?>

        <?php $funnel_1 = get_field('funnel_page_1'); ?>
        <?php $funnel_2 = get_field('funnel_page_2'); ?>
        <?php $funnel_3 = get_field('funnel_page_3'); ?>
        <?php // echo '<pre>'; var_dump($funnel_1); echo '</pre'; ?>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">
          <?php if($funnel_1) : ?>
            <?php
              $fun_1_ID = $funnel_1->ID;
              $fun_1_thumb_id = get_post_thumbnail_id($fun_1_ID);
              $fun_1_thumb_url = wp_get_attachment_image_src($fun_1_thumb_id, 'funnel-thumb', true);
              // echo '<pre>'; var_dump($fun_1_thumb_url); echo '</pre';
            ?>
            <a href="<?php the_permalink($fun_1_ID); ?>">
            <div class="funnel-item red" style="background-image: url('<?php echo $fun_1_thumb_url[0]; ?>');">
              <div class="overlay-wrapper">
                <h2><?php echo $funnel_1->post_title; ?></h2>
              </div>
            </div></a>
          <?php endif; ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">
          <?php if($funnel_2) : ?>
            <?php
              $fun_2_ID = $funnel_2->ID;
              $fun_2_thumb_id = get_post_thumbnail_id($fun_2_ID);
              $fun_2_thumb_url = wp_get_attachment_image_src($fun_2_thumb_id, 'funnel-thumb', true);
              // echo '<pre>'; var_dump($fun_1_thumb_url); echo '</pre';
            ?>
            <a href="<?php the_permalink($fun_2_ID); ?>">
            <div class="funnel-item green" style="background-image: url('<?php echo $fun_2_thumb_url[0]; ?>');">
              <div class="overlay-wrapper">
                <h2><?php echo $funnel_2->post_title; ?></h2>
              </div>
            </div></a>
          <?php endif; ?>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding">
          <?php if($funnel_3) : ?>
            <?php
              $fun_3_ID = $funnel_3->ID;
              $fun_3_thumb_id = get_post_thumbnail_id($fun_3_ID);
              $fun_3_thumb_url = wp_get_attachment_image_src($fun_3_thumb_id, 'funnel-thumb', true);
              // echo '<pre>'; var_dump($fun_1_thumb_url); echo '</pre';
            ?>
            <a href="<?php the_permalink($fun_3_ID); ?>">
            <div class="funnel-item red last"  style="background-image: url('<?php echo $fun_3_thumb_url[0]; ?>');">
              <div class="overlay-wrapper">
                <h2><?php echo $funnel_3->post_title; ?></h2>
              </div>
            </div></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
  <section id="mission">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mission-content">
          <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          <div class="more-btns">
            <div class="mission-btns">
              <a class="hollow-btn" href="about-us">Learn More</a>
            </div>
            <div class="mission-btns">
              <a class="red-btn" href="/donate">Make A Donation</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="upcoming">
    <div class="container no-padding">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h2 class="upcoming-events">Upcoming Events</h2>
        </div>
        <?php
          $args = array(
            'post_type' => 'event',
            'posts_per_page' => 3,
            'meta_query' => array('key' => '_start_ts', 'value' => current_time('timestamp'), 'compare' => '>=', 'type'=>'numeric'),
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_key' => '_start_ts',
            'meta_value' => current_time('timestamp'),
            'meta_value_num' => current_time('timestamp'),
            'meta_compare' => '>='
          );

          $up_events = new WP_Query($args);
          while($up_events->have_posts() ) : $up_events->the_post() ;
            $ID[] = $up_events->post->ID;
            $title[] = get_the_title();
            $content[] = get_the_excerpt();
            $url[] = get_the_permalink();
            $time_ID = $up_events->post->ID;
            $date_noformat = date_create(get_post_meta($time_ID, '_event_start_date', true));
            $date = date_format($date_noformat, 'M jS' );
            $start_time_noformat = date_create(get_post_meta($time_ID, '_event_start_time', true));
            $start_time = date_format($start_time_noformat, 'g:i a' );
            $end_time_noformat = date_create(get_post_meta($time_ID, '_event_end_time', true));
            $end_time = date_format($end_time_noformat, 'g:i a' );
            $event_date[] = $date;
            $event_start_time[] = $start_time;
            $event_end_time[] = $end_time;
            // echo '<li><a href="#">'.$event_title.', '.$date.'</li>';
          endwhile;
          wp_reset_query();
        ?>
        <?php if(isset($ID[0])) { ?>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 large-event">
            <div class="first-event">
              <a href="<?php echo $url[0]; ?>">
              <?php echo get_the_post_thumbnail($ID[0], 'event-large'); ?>
              <h3><?php echo $title[0]; ?></h3>
              <h5><?php echo $event_date[0].', '.$event_start_time[0].' - '.$event_end_time[0]; ?></h5>
              <p><?php echo $content[0]; ?></p></a>
            </div>
          </div>




          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 large-event">
            <div class="row">
            <?php if(isset($ID[1])) { ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 small-event">
                <div class="row">
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <a href="<?php echo $url[1]; ?>">
                      <?php echo get_the_post_thumbnail($ID[1], 'event-small'); ?>
                    </a>
                  </div>
                  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <a href="<?php echo $url[1]; ?>">
                    <h4><?php echo $title[1]; ?></h4>
                    <h6><?php echo $event_date[1].', '.$event_start_time[1].' - '.$event_end_time[1]; ?></h6>
                    <p><?php echo $content[1]; ?></p></a>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php if(isset($ID[2])) { ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 small-event">
                <div class="row">
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <a href="<?php echo $url[2]; ?>">
                      <?php echo get_the_post_thumbnail($ID[2], 'event-small'); ?>
                    </a>
                  </div>
                  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <a href="<?php echo $url[2]; ?>">
                    <h4><?php echo $title[2]; ?></h4>
                    <h6><?php echo $event_date[2].', '.$event_start_time[2].' - '.$event_end_time[2]; ?></h6>
                    <p><?php echo $content[2]; ?></p></a>
                  </div>
                </div>
              </div>
            <?php } ?>
            <?php if(!isset($ID[1]) || !isset($ID[2])) { ?>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 small-event">
                <h4 style="text-align:center; margin-top: 20px;margin-bottom:20px">More Events Coming Soon</h4>
              </div>
            <?php } ?>
            </div>
          </div>
        <?php } else { ?>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 large-event">
            <h4 style="text-align:center; margin-top: 20px;margin-bottom:20px">More Events Coming Soon</h4>
          </div>
        <?php } ?>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="events-btn">
            <a class="red-btn" href="/events">See All Events</a>
          </div>
        </div>
        <?php  //echo '<pre>'; var_dump($up_events); echo '</pre>'; ?>
      </div>
    </div>
  </section>
  <section id="stories">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h2 class="stories-title">Stories</h2>
        </div>
        <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => '3'
          );
          $loop = null;
          $loop = new WP_Query($args);
          while ($loop->have_posts()) : $loop->the_post() ;
        ?>
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 story">
            <?php
            $stories_thumb_id = get_post_thumbnail_id($post);
            $stories_thumb_url = wp_get_attachment_image_src($stories_thumb_id, 'stories-thumb', true);
            ?>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <div class="stories-outer" style="background-image: url('<?php echo $stories_thumb_url[0]; ?>');background-size: contain;">
                  <div class="stories-inner">
                    <a href="<?php the_permalink(); ?>">
                      <i class="fa fa-angle-right custom-icon"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
                <h4><?php echo get_the_title(); ?></h4>
                <h6><?php echo get_the_author(); ?></h6>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_query(); ?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="stories-btn">
            <a class="red-btn" href="/stories">Read More Stories</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="partners">
    <div class="container partner-wrapper">
      <div class="row">
        <div id="partner-owl" class="owl-carousel owl-theme">
          <?php $partners_page = get_page_by_title( 'Partners' ); ?>
          <?php // echo '<pre>'; var_dump($partners_page); echo '</pre>'; ?>
          <?php $partnersID = $partners_page->ID; ?>
          <?php $partner_rows = 0; ?>
          <?php while(have_posts($partnersID)) : the_post($partnersID) ;?>
            <?php while ( have_rows('partners', $partnersID) ) : the_row(); ?>
              <?php $partner_name = get_sub_field('partner_name', $partnersID); ?>
              <?php $partner_logo = get_sub_field('partner_logo', $partnersID); ?>
              <?php // echo '<pre>'; var_dump($partner_logo); echo '</pre>'; ?>
          <a href="<?php the_permalink($partnersID); ?>">
              <div class="item">

                <span class="helper">
                  <?php
                    lnx_switch_img_url_to_data_string($partner_logo['url'], 'full', $partner_logo['alt'], true);
                  ?>
                </span>
              </div></a>
              <?php $partner_rows++ ?>
            <?php endwhile; ?>
          <?php endwhile; ?>

        </div>
      </div>
    </div>
    <?php if($partner_rows > 5): ?>
      <div class="partner-slide-navigation">
        <a class="partnerprev"><i class="fa fa-angle-left"></i></a>
        <a class="partnernext"><i class="fa fa-angle-right"></i></i></a>
      </div>
    <?php endif; ?>
  </section>
<?php get_footer(); ?>
