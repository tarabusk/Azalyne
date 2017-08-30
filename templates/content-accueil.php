<div class="accueil-blocs">
  <?php while ( have_rows('blocs_accueil') ) : the_row(); ?>
    <?php
    if (get_sub_field ('image_ou_texte') == 'Image') {
      $background = get_sub_field('home_bloc_image');
      $output     = '';
    } else {
      $output     = get_sub_field('home_bloc_texte');
      $background = '';
    }
    ?>
    <div class="bloc-accueil" style="background-image:url(<?php echo $background; ?>)">
      <?php echo $output; ?>
    </div>
    <?php
    endwhile;
    ?>
</div>
