<div class="philo-content">
  <div class="philo-img-left" style="background-image: url(<?php echo get_field ('image_gauche'); ?>)">

  </div>
  <div class="philo-text">
    <div>
      <?php echo get_field ('colonne_1'); ?>
    </div>
    <div>
      <?php echo get_field ('colonne_2'); ?>
    </div>
    <img src="<?php echo get_field ('image_bas'); ?>"alt=""/>
  </div>
</div>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
