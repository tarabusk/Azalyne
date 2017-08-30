<?php
/**
 * Template Name: Atelier
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'atelier'); ?>
<?php endwhile; ?>
