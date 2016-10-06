<?php
/*
 * Default Events List Template
 * This page displays a list of events, called during the em_content() if this is an events list page.
 * You can override the default display settings pages by copying this file to yourthemefolder/plugins/events-manager/templates/ and modifying it however you need.
 * You can display events however you wish, there are a few variables made available to you:
 *
 * $args - the args passed onto EM_Events::output()
 *
 */

// $args = array(
//   'limit' => 2
// );

$args = apply_filters('em_content_events_args', $args);

//echo '<pre>'; var_dump($args); echo '</pre>';


if( get_option('dbem_css_evlist') ) echo "<div class='css-events-list'>";

$EM_Events = EM_Events::get( $args );
// echo '<pre>'; var_dump($EM_Events); echo '</pre>';
echo '<div class="row">';
foreach($EM_Events as $event) {
  $start_date_nofor = date_create($event->start_date);
  $start_date = date_format($start_date_nofor, 'l, F jS, Y');
  $start_time_nofor = date_create($event->event_start_time);
  $start_time = date_format($start_time_nofor, 'g:i a');
  $end_time_nofor = date_create($event->event_end_time);
  $end_time = date_format($end_time_nofor, 'g:i a');
  $times = $start_time.' - '.$end_time;
  $event_all_day = $event->event_all_day;
  $event_url = get_the_permalink($event);
  echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 small-event">';
    echo '<div class="row">';
      echo '<a href="'.$event_url.'">';
        echo '<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">';
          echo get_the_post_thumbnail($event, 'event-small');
        echo '</div>';
      echo '</a>';
        echo '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">';
          echo '<h4>'.$event->event_name.'</h4>';
          echo '<h6>'.$start_date.'</h6>';
          if ($event_all_day == '1'){
            echo '<h6>All Day Event</h6>';
          } else {
            echo '<h6>'.$times.'</h6>';
          }
          echo '<p>'.$event->post_content.'</p>';
        echo '</div>';
    echo '</div>';

  echo '</div>';
}
echo '<div>';


if( get_option('dbem_css_evlist') ) echo "</div>";
