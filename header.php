<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <?php
  // Ton header PixMatch ici (tu peux remplacer par ton HTML final)
  get_template_part('template-parts/header', 'pixmatch');
  ?>
</header>

<main class="site-main">
