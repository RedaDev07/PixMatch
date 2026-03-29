<?php
/**
 * Template Name: PixMatch - Connexion
 */

wp_enqueue_style(
  'pixmatch-custom',
  get_stylesheet_directory_uri() . '/assets/css/custom.css',
  array(),
  time()
);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class('pm-auth-page pm-auth--login'); ?>>
<?php wp_body_open(); ?>

<div class="pm-auth pm-auth--login">

  <!-- LEFT -->
  <div class="pm-auth__left">
    <div class="pm-auth__logo-wide">
      <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/02/logo.png" alt="PixMatch">
    </div>

    <h2 class="pm-auth__slogan">Quand Le Feeling Fait Clic</h2>
  </div>

  <!-- RIGHT -->
  <div class="pm-auth__right">
    <div class="pm-auth__card pm-auth__card--login">

      <h1 class="pm-auth__title">Se connecter</h1>

      <?php echo do_shortcode('[ultimatemember form_id="1769"]'); ?>

      <div class="pm-auth__footer-logo-wide">
        <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/02/logo.png" alt="PixMatch">
      </div>

    </div>
  </div>

</div>

<?php wp_footer(); ?>
</body>
</html>