<?php
date_default_timezone_set('America/Santiago');

ini_set('display_errors', 0);
error_reporting(0);

add_theme_support('post-thumbnails');
add_theme_support('menus');
add_image_size("equipo_big", 555, 390, true);
add_image_size("equipo_small", 150, 150, true);
add_image_size("quienes_somos_big", 494, 339, true);
add_image_size("alianzas", 240, 220, true);
add_image_size("servicio_img", 555, 400, true);
add_image_size("logo_img", 140, 132, false);

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
        $array_index = $pais->slug;

        if (!$pais->slug) {
            $array_index = 'none';
        }

        $equipo_aux[$array_index]['pais'] = $pais->name;
        $equipo_aux[$array_index]['data'][$area->post_name]['area'] = $area->post_title;
        $equipo_aux[$array_index]['data'][$area->post_name]['area_url'] = get_permalink($area);
        $equipo_aux[$array_index]['data'][$area->post_name]['area_color'] = get_field('color_principal', $area->ID);

        $equipo_aux[$array_index]['data'][$area->post_name]['data'][] = [
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

    if (count($equipo_aux['none'])) {
        $equipo['none'] = $equipo_aux['none'];
    }

    return $equipo;
}

/**
 * Convierte un número en palabra para columnas del HTML
 * @param int $num
 * @return null|string
 */
function columns_number_converter($num)
{
    switch ($num) {
        case 0:
            return null;
        case 1:
            return 'one';
        case 2:
            return 'two';
        case 3:
            return 'three';
        case 4:
            return 'four';
        case 5:
            return 'five';
        case 6:
            return 'six';
        case 7:
            return 'seven';
        case 8:
            return 'eight';
        case 9:
            return 'nine';
        case 10:
            return 'ten';
        case 11:
            return 'eleven';
        case 12:
            return 'twelve';
        default:
            return null;
    }
}

/**
 * Obtiene las Alianzas separado en filas por n columnas
 * @param int $columns
 * @return array
 */
function get_alianzas($columns = 3)
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

        if (($i + 1) % $columns == 0 && $i != 0) { // Se agrupa el array de $columns en $columns
            $j++;
        }

        $i++;
    }
    wp_reset_query();

    return $alianzas;
}

/**
 * Obtiene las áreas
 * @return array
 */
function get_areas()
{
    $q = new WP_Query([
        'post_type' => 'servicio',
        'showposts' => -1,
        'orderby' => 'menu_order',
        'order' => 'asc'
    ]);

    $areas = [];

    while ($q->have_posts()) {
        $q->the_post();

        $areas[] = $q->post;
    }
    wp_reset_query();

    return $areas;
}

/**
 * Transforma un color de hex a rgb
 * @param string $hex_str
 * @param bool $return_as_string
 * @param string $seperator
 * @return array|bool|string
 */
function hex2rgb($hex_str, $return_as_string = true, $seperator = ',')
{
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

/**
 * Para ocultar editor en Quienes somos
 */
function hide_editor()
{
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    if (!isset($post_id)) return;

    if ($post_id == 6) {
        remove_post_type_support('page', 'editor');
    }
}

add_action('admin_init', 'hide_editor');

/**
 * Agrega los formatos de video y pdf al admin
 * @param array $existing_mimes
 * @return array
 */
function my_theme_custom_upload_mimes( $existing_mimes ) {
    $existing_mimes['webm'] = 'video/webm';
    $existing_mimes['mp4'] = 'video/mp4';
    $existing_mimes['ogv'] = 'video/ogg';

    return $existing_mimes;
}
add_filter( 'mime_types', 'my_theme_custom_upload_mimes' );

function is_mobile()
{
    return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|bo‌​ost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}