<?php
date_default_timezone_set('America/Santiago');

ini_set('display_errors', 0);
error_reporting(0);

add_theme_support('post-thumbnails');
add_theme_support('menus');
//show_admin_bar(false);

add_image_size("equipo_big", 555, 390, true);
add_image_size("equipo_small", 150, 150, true);
add_image_size("quienes_somos_big", 494, 339, true);
add_image_size("alianzas", 240, 220, true);
add_image_size("servicio_img", 555, 400, true);
add_image_size("logo_img", 140, 132, false);

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
function jw_filter_yoast_seo_metabox()
{
    return 'low';
}

add_filter('wpseo_metabox_prio', 'jw_filter_yoast_seo_metabox', 10, 1);

/**
 * Agrega a la tabla de Equipo
 * @param array $taxonomies
 * @return array
 */
function equipo_tax_columns($taxonomies)
{
    $taxonomies[] = 'pais';
    return $taxonomies;
}

add_filter('manage_taxonomies_for_equipo_columns', 'equipo_tax_columns');


/**
 * Personalizar cabecera de columna (sin valor)
 * @param array $columns
 * @return array
 */

function edit_equipo_columns($columns)
{

    $columns['taxonomy-pais'] = 'País';
    $columns['area'] = 'Área';
    //return $columns;
    return [
        'cb' => $columns['cb'],
        'title' => 'Nombre',
        'cargo' => 'Cargo',
        'area' => 'Área',
        'taxonomy-pais' => 'País',
        'date' => $columns['date'],
    ];
}

add_filter('manage_edit-equipo_columns', 'edit_equipo_columns');

/**
 * Agrega valor a las columnas
 * @param string $column
 * @param int $post_id
 * @return array
 */
function equipo_area_columns($column, $post_id)
{

    if ($column == 'area') {
        $area = get_field('area', $post_id);

        if (!$area)
            echo 'Sin área';
        else
            echo $area->post_title;
    }

    if ($column == 'cargo') {
        $cargo = get_field('cargo', $post_id);

        if (!$cargo)
            echo 'Sin cargo';
        else
            echo $cargo;
    }
}

add_filter('manage_equipo_posts_custom_column', 'equipo_area_columns', 10, 2);

/**
 * Obtiene el equipo en orden de país y área
 * @return array
 */
function get_equipo()
{
    $q = new WP_Query([
        'post_type' => 'equipo',
        'showposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'asc'
    ]);

    $equipo_aux = [];

    while ($q->have_posts()) {
        $q->the_post();
        /**
         * @var WP_Term $pais
         * @var WP_Post $area
         */
        $pais = get_the_terms($q->post, 'pais')[0];
        $area = get_field('area');

        $equipo_aux[$pais->slug]['pais'] = $pais->name;
        $equipo_aux[$pais->slug]['data'][$area->post_name]['area'] = $area->post_title;
        $equipo_aux[$pais->slug]['data'][$area->post_name]['area_url'] = get_permalink($area);
        $equipo_aux[$pais->slug]['data'][$area->post_name]['area_color'] = get_field('color_principal', $area->ID);

        $equipo_aux[$pais->slug]['data'][$area->post_name]['data'][] = [
            'nombre' => $q->post->post_title,
            'cargo' => get_field('cargo'),
            'area' => $area->post_title,
            'titulo' => get_field('titulo'),
            'email' => get_field('email'),
            'imagen' => get_field('imagen'),
            'imagen_miniatura' => get_field('imagen_miniatura'),
        ];
    }
    wp_reset_query();

    /** @noinspection PhpInternalEntityUsedInspection */
    $paises = get_terms([
        'taxonomy' => 'pais'
    ]);

    /* Todo: Por mientras se ordena solo por países
     * $areas = get_posts([
        'post_type' => 'servicio',
        'order' => 'menu_order',
        'showposts' => -1
    ]);*/

    $equipo = [];

    //Ordena por país
    foreach ($paises as $pais) {
        $equipo[$pais->slug] = $equipo_aux[$pais->slug];
    }

    return $equipo;
}

function get_alianzas()
{
    $q = new WP_Query([
        'post_type' => 'alianza',
        'showposts' => -1,
        'orderby' => 'menu_order'
    ]);

    $i = 0;
    $alianzas = [];
    $j = 0;

    while ($q->have_posts()) {
        $q->the_post();

        $alianzas[$j][] = [
            'title' => get_the_title(),
            'sitio_web' => get_field('sitio_web'),
            'imagen' => get_the_post_thumbnail_url(null, 'alianzas'),
        ];

        if (($i + 1) % 3 == 0 && $i != 0) { // Se agrupa el array de 3 en 3
            $j++;
        }

        $i++;
    }
    wp_reset_query();

    return $alianzas;
}

function hex2rgb($hex_str, $return_as_string = true, $seperator = ',') {
    $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hex_str) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hex_str);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hex_str) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $return_as_string ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}