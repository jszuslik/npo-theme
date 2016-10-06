<?php


//Add thumbnail, automatic feed links and title tag support
add_theme_support( 'post-thumbnails' );
add_image_size( 'funnel-thumb', 388, 209, array('center','center') );
add_image_size( 'event-large', 570, 280, array('center','center') );
add_image_size( 'event-small', 170, 170, array('bottom','left') );
add_image_size( 'stories-thumb', 370, 240, array('center','center') );
add_image_size( 'partners-thumb', 190, 9999, false );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );

/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

//Add content width (desktop default)
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

//Add menu support and register main menu
if ( function_exists( 'register_nav_menus' ) ) {
  	register_nav_menus(
  		array(
  		  'primary_menu' => 'Primary Menu',
				'footer_menu' => 'Footer Menu',
				'sidebar_menu' => 'Sidebar Menu'
  		)
  	);
}

// Register sidebar
add_action('widgets_init', 'theme_register_sidebar');
function theme_register_sidebar() {
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'id' => 'sidebar-1',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h4>',
		    'after_title' => '</h4>',
		 ));
	}
}

// Bootstrap_Walker_Nav_Menu setup

add_action( 'after_setup_theme', 'bootstrap_setup' );

if ( ! function_exists( 'bootstrap_setup' ) ):

	function bootstrap_setup(){

		class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {


			function start_lvl( &$output, $depth = 0, $args = array() ) {

				$indent = str_repeat( "\t", $depth );
				$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

			}

			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

				if (!is_object($args)) {
					return; // menu has not been configured
				}

				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$li_attributes = '';
				$class_names = $value = '';

				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[] = ($args->has_children) ? 'dropdown' : '';
				$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
				$classes[] = 'menu-item-' . $item->ID;


				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
				$class_names = ' class="' . esc_attr( $class_names ) . '"';

				$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
				$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle"' : '';

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= ($args->has_children) ? '</a>' : '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}

			function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

				if ( !$element )
					return;

				$id_field = $this->db_fields['id'];

				//display this element
				if ( is_array( $args[0] ) )
					$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
				else if ( is_object( $args[0] ) )
					$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'start_el'), $cb_args);

				$id = $element->$id_field;

				// descend only when the depth is right and there are childrens for this element
				if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

					foreach( $children_elements[ $id ] as $child ){

						if ( !isset($newlevel) ) {
							$newlevel = true;
							//start the child delimiter
							$cb_args = array_merge( array(&$output, $depth), $args);
							call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
						}
						$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
					}
						unset( $children_elements[ $id ] );
				}

				if ( isset($newlevel) && $newlevel ){
					//end the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
				}

				//end this element
				$cb_args = array_merge( array(&$output, $element, $depth), $args);
				call_user_func_array(array(&$this, 'end_el'), $cb_args);
			}
		}
 	}
endif;


/**
 * Load site scripts.
 */
function bootstrap_theme_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// jQuery.
	// wp_deregister_script( 'jquery' );
	// wp_enqueue_script( 'jquery-2', 'http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js', array(  ), null, true );
	// Bootstrap
	wp_enqueue_script( 'bootstrap-script', $template_url . '/js/bootstrap/bootstrap.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'owl-script', $template_url . '/js/owl_carousel/owl.carousel.min.js', array(  ), null, true );
	// wp_enqueue_script( 'svg-script', $template_url . '/js/plugins/jquery.svgInject.js', array(  ), null, true );

  wp_enqueue_style( 'font-google-roboto-slab', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100' );
	wp_enqueue_style( 'font-google-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,100,300,100italic,300italic,400italic,500,500italic,700,700italic,900italic,900' );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'bootstrap-style', $template_url . '/css/bootstrap/bootstrap.min.css' );
	wp_enqueue_style( 'owl-carousel', $template_url . '/css/owl_carousel/owl.carousel.css' );
	wp_enqueue_style( 'owl-theme', $template_url . '/css/owl_carousel/owl.theme.css' );
	wp_enqueue_style( 'owl-transitions', $template_url . '/css/owl_carousel/owl.transitions.css' );


	//Main Style
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bootstrap_theme_enqueue_scripts', 1 );
add_filter( 'get_the_archive_title', function ( $title ) {
    if( is_category() ) {
      $title = single_cat_title( '', false );
    }
  return $title;
});
/*
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
function of_get_option($name, $default = false) {

  	$optionsframework_settings = get_option('optionsframework');

  	// Gets the unique option id
  	$option_name = $optionsframework_settings['id'];

  	if ( get_option($option_name) ) {
  		$options = get_option($option_name);
  	}

  	if ( isset($options[$name]) ) {
  		return $options[$name];
  	} else {
  		return $default;
  	}
  }
}
function lanex_copyright() {
  global $wpdb;

  $copyright_dates = $wpdb->get_results("
      SELECT
      YEAR(min(post_date_gmt)) AS firstdate,
      YEAR(max(post_date_gmt)) AS lastdate
      FROM
      $wpdb->posts
      WHERE
      post_status = 'publish'
      ");

  $output = '';

  if($copyright_dates) {
    $copyright = "&copy; " . $copyright_dates[0]->firstdate;
    if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
      $copyright .= '-' . $copyright_dates[0]->lastdate;
    }
    $output = $copyright;
  }
return $output;
}
function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if($page){
    return $page->ID;
  } else {
    return null;
  }
}
function lnx_get_att_id_from_image_url( $attachment_url = '' ) {
	global $wpdb;
	$attachment_id = false;
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	}
	return $attachment_id;
}
function lnx_switch_img_url_to_data_string($url, $image_size, $alt_tag = '', $is_inline = false, $width = '', $height = ''){
	$image_id = lnx_get_att_id_from_image_url($url);
	$image_src = wp_get_attachment_image_src($image_id, $image_size);
	$image_data_str = base64_encode(file_get_contents($image_src[0]));
	$image_file_type = image_type_to_mime_type(exif_imagetype($image_src[0]));
	$image_src_string = 'data:';
	$image_src_string .= $image_file_type.';base64,';
	$image_src_string .= $image_data_str;
	$image_tag = '';

	if(!$is_inline){
		$image_tag .= $image_src_string;
	} else {
		$image_tag .= '<img src="';
		$image_tag .= $image_src_string;
		$image_tag .= '" alt="';
		$image_tag .= $alt_tag;
		$image_tag .= '" class="img-responsive" width="';
		if($image_src[1]){
			$width = $image_src[1];
		}
		$image_tag .= $width;
		$image_tag .= '" height="';
		if($image_src[2]){
			$height = $image_src[2];
		}
		$image_tag .= $height;
		$image_tag .= '">';
	}


	echo $image_tag;
}



?>
