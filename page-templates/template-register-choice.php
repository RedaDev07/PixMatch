<?php
/**
 * Template Name: PixMatch - Choix Inscription
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

  <link rel="stylesheet" href="<?php echo site_url('/wp-content/themes/pixmatch-template/assets/css/custom.css'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class('pm-auth-page'); ?>>
<?php wp_body_open(); ?>

<div class="pm-choice pm-choice--top">

  <h1 class="pm-choice__title">BONJOUR!</h1>
  <p class="pm-choice__subtitle">Quel type de compte souhaitez vous créer?</p>

  <div class="pm-choice__cards">

    <!-- CARD CLIENT -->
    <a class="pm-card pm-card--client" href="<?php echo esc_url(home_url('/inscription-client')); ?>">
      <h3 class="pm-card__title">CLIENTS</h3>

      <div class="pm-card__icon">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/se-connecter.png" alt="Client">
      </div>

      <span class="pm-card__btn">S’INSCRIRE</span>
    </a>

    <!-- CARD PRO -->
    <a class="pm-card pm-card--pro" href="<?php echo esc_url(home_url('/inscription-professionnel')); ?>">
      <h3 class="pm-card__title">PROFESSIONNELS</h3>

      <div class="pm-card__icon">
        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/icone_objectif.png" alt="Professionnel">
      </div>

      <span class="pm-card__btn">S’INSCRIRE</span>
    </a>

  </div>

  <div class="pm-choice__login">
    <p class="pm-choice__logintext">VOUS AVEZ DEJA UN COMPTE ?</p>

    <a class="pm-choice__loginbtn" href="<?php echo esc_url(home_url('/connexion')); ?>">
      CONNEXION
    </a>
  </div>

</div>


<?php wp_footer(); ?>
</body>
</html>
