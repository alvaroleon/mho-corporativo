<?php
date_default_timezone_set('America/Santiago');

ini_set('display_errors', 0);
error_reporting(0);

add_theme_support('post-thumbnails');
add_theme_support('menus');
//show_admin_bar(false);

add_image_size("location_list", 304, 223, true);

/**
 * Eliminar logo de usuario
 */
function ajax_remove_logo()
{

}

add_action('wp_ajax_remove-logo', 'ajax_remove_logo');
add_action('wp_ajax_nopriv_remove-logo', 'ajax_remove_logo');

/**
 * Deja al final el snippet de Yoast
 */
function jw_filter_yoast_seo_metabox() {
    return 'low';
}

add_filter( 'wpseo_metabox_prio', 'jw_filter_yoast_seo_metabox', 10, 1 );