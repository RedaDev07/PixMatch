<?php
if (!defined('ABSPATH')) exit;

/**
 * Setup theme
 */
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 120,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Menu principal', 'pixmatch-template'),
    ]);
});

/**
 * AJOUTER UNE CLASSE AU BODY POUR IDENTIFIER LA PAGE
 */
function pixmatch_body_class($classes) {
    if (is_page_template('page-templates/accueil_particuliers.php')) {
        $classes[] = 'page-particuliers';
    }
    if (is_page_template('page-templates/accueil_cdc.php')) {
        $classes[] = 'page-cdc';
    }
    return $classes;
}
add_filter('body_class', 'pixmatch_body_class');

/**
 * CHARGER LES CSS (VERSION SIMPLIFIÉE)
 */
add_action('wp_enqueue_scripts', function () {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800;9..144,900&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null);
    
    // Style principal (toujours chargé)
    wp_enqueue_style(
        'pixmatch-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array(),
        time()
    );
    
    // CSS Accueil Particuliers (toujours chargé mais avec conditions dans le CSS)
    wp_enqueue_style(
        'pixmatch-accueil-particuliers',
        get_template_directory_uri() . '/assets/css/accueil_particuliers.css',
        array('pixmatch-custom'),
        time()
    );
    
    // CSS Accueil Créateurs (toujours chargé mais avec conditions dans le CSS)
    wp_enqueue_style(
        'pixmatch-accueil-cdc',
        get_template_directory_uri() . '/assets/css/accueil_cdc.css',
        array('pixmatch-custom'),
        time()
    );
    // CSS pour la page Couple & Mariage
wp_enqueue_style(
    'pixmatch-couple-mariage',
    get_template_directory_uri() . '/assets/css/couple-mariage.css',
    array('pixmatch-custom'),
    time()
);

    // JavaScript
    wp_enqueue_script(
        'pixmatch-js',
        get_template_directory_uri() . '/assets/js/custom.js',
        array(),
        time(),
        true
    );
    // JavaScript pour le switch sans rechargement
wp_enqueue_script(
    'pixmatch-switch',
    get_template_directory_uri() . '/assets/js/switch.js',
    array('jquery'),
    time(),
    true
);
// JavaScript pour les villes
wp_enqueue_script(
    'pixmatch-villes',
    get_template_directory_uri() . '/assets/js/villes-france.js',
    array(),
    time(),
    true
);

// JavaScript pour le filtre
wp_enqueue_script(
    'pixmatch-filtre',
    get_template_directory_uri() . '/assets/js/filtre.js',
    array('jquery', 'pixmatch-villes'),
    time(),
    true
);
});

/**
 * Include helpers
 */
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/woocommerce.php';
?>