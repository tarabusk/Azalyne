<?php use Roots\Sage\Titles; ?>
<?php
  $img_header = get_field ('header_image');
  if ($img_header) { ?>
    <div class="page-header-image" style="background-image:url(<?php echo get_field ('header_image'); ?>)">
      <div class="main">
        <h1><?= Titles\title(); ?></h1>
      </div>
    </div>
  <?php
  }
 ?>
