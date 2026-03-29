<?php
/**
 * Template Name: PixMatch - Inscription Client
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

<body <?php body_class('pm-auth-page'); ?>>
<?php wp_body_open(); ?>

<div class="pm-auth pm-auth--client">

  <!-- LEFT -->
  <div class="pm-auth__left">
    <div class="pm-auth__logo-wide">
      <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/02/logo.png" alt="PixMatch">
    </div>

    <h2 class="pm-auth__slogan">Quand Le Feeling Fait Clic</h2>
  </div>

  <!-- RIGHT -->
  <div class="pm-auth__right">
    <div class="pm-auth__card">

      <div class="pm-auth__form-logo">
        <?php the_custom_logo(); ?>
      </div>

      <?php echo do_shortcode('[ultimatemember form_id="563"]'); ?>

      <div class="pm-auth__footer-logo-wide">
  <img src="https://pixmatch.formationsuniversitaires.fr/wp-content/uploads/2026/02/logo.png" alt="PixMatch">

  <p class="pm-auth__footer-text">
    Trouvez le professionnel de l'image idéal pour vos moments uniques avec PixMatch.
  </p>
</div>


    </div>
  </div>

</div>

<?php wp_footer(); ?>
</body>
</html>
