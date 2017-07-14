<div class="atelier-content">
  <div class="atelier-img-left">
    <img src="<?php echo get_field ('image_gauche'); ?>"alt=""/>
  </div>
  <div class="atelier-text">
    <div>
      <?php echo get_field ('texte'); ?>
    </div>

    <img src="<?php echo get_field ('image_bas'); ?>"alt=""/>
  </div>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
