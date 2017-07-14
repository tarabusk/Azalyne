<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav class="nav-primary">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
      endif;
      ?>
    </nav>
    <div class="header-account">
      <?php if ( is_user_logged_in() ) { ?>
       	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Mon compte">Mon compte</a>
       <?php }
       else { ?>
       	<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="Se connecter">Se connecter</a>
       <?php } ?>
       <?php
       global $woocommerce;
      //if ( sizeof( $woocommerce->cart->cart_contents) > 0 ) :
        	echo '<a href="' . $woocommerce->cart->get_cart_url() . '" title="' . __( 'Checkout' ) . '">PANIER</a>';
      //  endif;
       ?>
    </div>
    <div class="clear-layout"></div>
  </div>
</header>
