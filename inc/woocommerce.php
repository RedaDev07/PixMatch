<?php
if (!defined('ABSPATH')) exit;

/**
 * WooCommerce support
 */
add_action('after_setup_theme', function () {
  add_theme_support('woocommerce');
});

/**
 * (Optionnel) Désactiver les styles WooCommerce par défaut
 * Si tu veux que ton CSS PixMatch contrôle tout.
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * (Optionnel) Retirer la sidebar WooCommerce si tu veux du full-width
 */
add_action('wp', function () {
  if (function_exists('is_woocommerce') && is_woocommerce()) {
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
  }
});
add_filter('body_class', function ($classes) {
  if (function_exists('is_woocommerce') && is_woocommerce()) {
    $classes[] = 'pixmatch-woo';
  }
  return $classes;
});
