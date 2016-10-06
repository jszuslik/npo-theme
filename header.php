<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <title><?php wp_title(''); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
	</head>

  <body <?php body_class(); ?>>
    <!-- Desktop Header -->
    <div class="desktop social-wrapper">
      <div class="container no-padding">
        <?php if ( of_get_option('facebook_link') || of_get_option('linkedin_link') ) : ?>
          <ul class="social-menu">
            <?php if ( of_get_option('facebook_link') ) : ?>
              <li class="social-item">
                <a href="<?php echo of_get_option('facebook_link'); ?>" target="_blank">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
            <?php endif; ?>
            <?php if ( of_get_option('linkedin_link') ) : ?>
              <li class="social-item">
                <a href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
      </div><!-- /.container -->
    </div><!-- /.desktop brand-wrapper -->
    <div class="desktop brand-wrapper">
      <div class="container no-padding">
        <div class="site-logo">
          <a href="/">
            <img src="<?php echo of_get_option('logo_uploader'); ?>" alt="Recall Foundation Logo" >
          </a>
        </div>
        <div class="col-sm-2 col-sm-offset-10 col-md-2 col-md-offset-10 no-padding">
          <div class="donate-button">
            <a href="/donate">Donate</a>
          </div>
        </div>
      </div>
    </div>
    <?php if (!is_home() && !is_front_page()){ ?>
      <div class="desktop navigation-bar nav-border">
    <?php } else { ?>
      <div class="desktop navigation-bar">
    <?php } ?>
      <div class="container no-padding">
        <?php wp_nav_menu(
                        array(
                          'menu' => 'Primary Menu',
                          'menu_class' => 'nav navbar-nav',
                          'depth'=> 3,
                          'container'=> false,
                          'walker'=> new Bootstrap_Walker_Nav_Menu
                        )
                      );
                ?>
                <?php get_search_form(); ?>

      </div>
    </div>
    <!-- /Desktop Header -->
    <!-- Mobile Menu -->
    <div class="mobile social-wrapper">
      <nav class="mobile-nav navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <?php
          $sitename = get_bloginfo( 'name' );
          $first_word = substr($sitename, 0, strpos($sitename, ' '));
        ?>
        <a href="<?php echo home_url(); ?>"><img src="<?php echo of_get_option('mobile_logo_uploader'); ?>" alt="Recall Foundation Logo" ></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php if ( of_get_option('facebook_link') || of_get_option('linkedin_link') ) : ?>
          <ul class="social-menu">
            <?php if ( of_get_option('facebook_link') ) : ?>
              <li class="social-item">
                <a href="<?php echo of_get_option('facebook_link'); ?>" target="_blank">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
            <?php endif; ?>
            <?php if ( of_get_option('linkedin_link') ) : ?>
              <li class="social-item linkedin">
                <a href="<?php echo of_get_option('linkedin_link'); ?>" target="_blank">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>

      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse">
        <?php wp_nav_menu(
                array(
                  'menu' => 'Mobile',
                  'menu_class' => 'nav navbar-nav navbar-right',
                  'depth'=> 3,
                  'container'=> false,
                  'walker'=> new Bootstrap_Walker_Nav_Menu
                )
              );
        ?>
      </div><!-- /.navbar-collapse -->
    </nav>
    </div><!-- /.mobile brand-wrapper -->
