<?php ?>
<footer>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <?php wp_nav_menu(
                        array(
                          'menu' => 'Footer Menu',
                          'menu_class' => 'footer-nav',
                          'depth'=> 3,
                          'container'=> false,
                          'walker'=> new Bootstrap_Walker_Nav_Menu
                        )
                      );
                ?>
                <ul class="blog-menu">
                  <li class="menu-item">
                    <a href="/stories">Blog</a>
                  </li>
                  <li class="menu-item">
                    <a href="/become-a-sponsor">Become a Sponsor</a>
                  </li>
                  <li class="menu-item">
                    <a href="/newsletter">Newsletter Sign-up</a>
                  </li>
                </ul>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="donate-btn">
          <a class="donate-footer" href="/donate">Make A Donation</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
        <p class="copyright">Copyright <?php echo lanex_copyright(); ?> <?php echo get_bloginfo(); ?> All Rights Reserved.</p>
      </div>
      <div class="col-xs-15 col-sm-15 col-md-5 col-lg-5">
        <a href="http://www.lanex.com" target="_blank">
          <img class="lanex-logo" src="/wp-content/themes/recall-parent/images/lanex-logo.png" alt="Lanex, LLC Logo" >
        </a>
      </div>
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript">

jQuery(document).ready(function($) {


  var slider = $('#home-owl')

  slider.owlCarousel({

      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      transitionStyle : "fade",
      pagination: false

  });
  // Custom Navigation Events
  $(".homenext").click(function(){
    slider.trigger('owl.next');
  })
  $(".homeprev").click(function(){
    slider.trigger('owl.prev');
  })

  var partner_slide = $('#partner-owl');
  partner_slide.owlCarousel({
    pagination: false,
    autoPlay: 3000,
    items : 5,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3]
  });
  $(".partnernext").click(function(){
    partner_slide.trigger('owl.next');
  })
  $(".partnerprev").click(function(){
    partner_slide.trigger('owl.prev');
  })

});
</script>

</body>
</html>
