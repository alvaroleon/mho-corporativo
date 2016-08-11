<?php
if (have_posts()) the_post();

get_header();

/**
 * Inicio Capa lógica
 */
$bienvenida = get_field('bienvenida')[0];
$is_quienes_somos = get_field('mostrar_quienes_somos');
$quienes_somos = get_field('quienes_somos')[0];
$is_servicios = get_field('mostrar_nuestros_servicios');
$is_equipo = get_field('mostrar_nuestro_equipo');
$is_alianzas = get_field('mostrar_alianzas');
$video_bajada = $bienvenida['video'];
$fondo_bajada_principal = $bienvenida['fondo_principal'];

$paginas = [];

if ($is_quienes_somos) {
    $quienes_somos = [
        'contenido' => $quienes_somos['contenido'][0],
        'mision_vision' => $quienes_somos['mision_vision'][0]
    ];
}

if ($is_servicios) {
    $nuestros_servicios = get_field('nuestros_servicios')[0];
}

if ($is_equipo) {
    $equipo = get_equipo();
}

if ($is_alianzas) {
    $alianzas = get_alianzas();
}

//Fin capa lógica
?>
    <style>
        <?php if ($fondo_bajada_principal == 'Imagen') { ?>
        .principal {
            background-image: url('<?php echo $bienvenida['imagen']['url']; ?>');
        }

        <?php } else { ?>
        .principal {
            background-image: none !important;
        }
        <?php } ?>
        <?php
/**
* Creación de CSS
*/
/** @var array $nuestros_servicios */
$total_servicios = count($nuestros_servicios['areas']);
$gradients_color = [];

foreach ($nuestros_servicios['areas'] as $area) {
    $color = get_field('color_principal', $area->ID);
    $gradients_color[] = $color;

    echo ".custom-btn-{$area->post_name} {
                                    color: {$color};
                                }\n";

    echo ".custom-btn-{$area->post_name}:hover {
                                    border-color: {$color};
                                }\n";

    echo ".custom-ar-{$area->post_name} {
        color: {$color};
    }";

    echo ".custom-ar-{$area->post_name}:hover {
        border-color: {$color};
    }";
};

$i = 0;

foreach (array_reverse($gradients_color) as $color) {
    $percentage = 100 / $total_servicios * $i;
    $next_percentage = 100 / $total_servicios * ($i + 1);
    $str_gradient .= "{$color} {$percentage}%,{$color} {$next_percentage}%,";
    $i++;
}

$str_gradient = substr($str_gradient, 0, strlen($str_gradient) - 1);

echo ".servicios::after,.banner-clientes::before, .banner-clientes::after { background: linear-gradient(to right, {$str_gradient}); }";
?>
    </style>

    <section>
        <article>
            <div class="principal">
                <div class="container">
                    <div class="six columns">
                        <h1><?php echo $bienvenida['titulo'][0]['texto_superior']; ?>
                            <span><?php echo $bienvenida['titulo'][0]['texto_inferior']; ?></span></h1>

                        <?php echo $bienvenida['bajada']; ?>

                        <?php if ($bienvenida['entrada_asociada']): ?>
                            <a class="button button-primary" href="<?php echo $bienvenida['entrada_asociada']; ?>"
                               title="Leer más">Leer más</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($fondo_bajada_principal == 'Video' && !is_mobile()): ?>
                    <video src="<?php echo $video_bajada; ?>"
                           width="100%" height="100%" autoplay="autoplay" loop muted>
                        <code>Video</code>
                        Tu navegador no soporta video HTML, por favor actualizar a las últimas versiones.
                    </video>
                <?php endif; ?>
            </div>
        </article>

        <?php if ($is_quienes_somos) : ?>
            <article>
                <div class="container">
                    <div class="twelve columns">
                        <h1><?php
                            /** @var array $quienes_somos */
                            echo $quienes_somos['contenido']['titulo'][0]['texto_superior'];
                            ?> <span><?php echo $quienes_somos['contenido']['titulo'][0]['texto_inferior']; ?></span>
                        </h1>
                    </div>
                </div>
                <div class="break"><!-- break -->
                    <div class="container">
                        <div class="six columns animated">
                            <?php echo $quienes_somos['contenido']['contenido']; ?>
                        </div>

                        <div class="six columns animated">
                            <div class="stylish-img">
                                <img class="img-responsive" draggable="false"
                                     src="<?php echo $quienes_somos['contenido']['imagen']['sizes']['quienes_somos_big']; ?>"
                                     alt="Ingenieros y Consultores"/>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="break"><!-- break -->
                    <div class="container">
                        <div class="six columns animated">
                            <div class="stylish-img">
                                <img class="img-responsive" draggable="false"
                                     src="<?php echo $quienes_somos['mision_vision']['imagen']['sizes']['quienes_somos_big']; ?>"
                                     alt="Ingenieros y Consultores"/>
                            </div>
                        </div>

                        <?php foreach ($quienes_somos['mision_vision']['informacion'] as $info) : ?>
                            <div class="three columns animated">
                                <h2><?php echo $info['titulo']; ?></h2>
                                <?php echo $info['texto']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div><!-- fin break -->

            </article>
        <?php endif; ?>

        <?php if ($is_servicios) :
            ?>
            <div class="break">
                <div class="servicios"><!-- servicios -->
                    <article>
                        <div class="container">
                            <div class="four columns animated">
                                <h1>Nuestros Servicios</h1>
                                <?php /** @var array $nuestros_servicios */
                                if ($nuestros_servicios['brochure']) : ?>
                                    <a class="button button-primary"
                                       href="<?php echo $nuestros_servicios['brochure']['url']; ?>" target="_blank"
                                       title="Descarga nuestro brochure">Descarga nuestro brochure</a>
                                <?php endif; ?>
                            </div>

                            <div class="eight columns">
                                <ul class="servicios-list">
                                    <?php foreach ($nuestros_servicios['areas'] as $area) :
                                        /**
                                         * @var WP_Post $area
                                         */
                                        ?>
                                        <li class="animated">
                                            <a class="btn-ar custom-btn-<?php echo $area->post_name; ?>"
                                               href="<?php the_permalink($area); ?>"
                                               title="<?php echo $area->post_title; ?>">
                                                <?php echo preg_replace("/Ingeniería|ingeniería|ingenieria/i", '', $area->post_title); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div><!-- fin servicios -->
            </div>
        <?php endif; ?>

        <?php if ($is_equipo) : ?>
            <?php
            $i = 0;
            /** @var array $equipo */
            foreach ($equipo as $pais_slug => $eq) : ?>
                <div class="break">
                    <div class="equipo animated">
                        <article>
                            <?php if ($i == 0) : ?>
                                <div class="container">
                                    <div class="twelve columns animated">
                                        <h1>Nuestro <span>equipo</span></h1>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            $k = 0;
                            foreach ($eq['data'] as $area_slug => $area) : ?>
                                <div id="<?php echo $pais_slug; ?>-<?php echo $area_slug; ?>"
                                     class="team-area<?php echo $k > 0 ? ' hide-team' : ''; ?>">
                                    <div class="current animated">
                                        <?php
                                        foreach ($area['data'] as $j => $integrante) :
                                            ?>
                                            <div id="<?php echo $pais_slug . '-' . $area_slug . '-tab-' . $j ?>"
                                                 class="team<?php echo $j == 0 ? ' current' : ''; ?>"><!-- tab-1 -->
                                                <div class="container">
                                                    <div class="six columns">
                                                        <div class="main-equipo"><!-- main-equipo -->
                                                            <div class="stylish-img">
                                                                <img class="img-responsive"
                                                                     src="<?php echo $integrante['imagen']['sizes']['equipo_big']; ?>"
                                                                     draggable="false" border="0"
                                                                     alt="<?php echo $integrante['nombre'] . ' - ' . $integrante['cargo']; ?>">
                                                            </div>
                                                        </div><!-- fin main-equipo -->
                                                    </div>
                                                    <div class="six columns">
                                                        <div class="detalle-equipo"><!-- detalle-equipo -->
                                                            <h2><?php echo $area_slug != 'administracion' ? 'Área' : ''; ?>
                                                                <span><?php echo preg_replace([
                                                                        "/área|Área/",
                                                                        "/Ingeniería|ingeniería|ingenieria/i"
                                                                    ], [
                                                                        '',
                                                                        'Ing.'
                                                                    ], $integrante['area']);
                                                                    echo $area_slug != 'administracion' ? ' | ' . $eq['pais'] : ''; ?></span>
                                                            </h2>
                                                            <h3><?php echo $integrante['nombre']; ?></h3>
                                                            <h4><?php echo $integrante['titulo']; ?></h4>
                                                            <p><?php echo $integrante['cargo']; ?></p>
                                                            <?php if (trim($integrante['email'])) : ?>
                                                                <a class="button button-primary"
                                                                   href="mailto:<?php echo $integrante['email']; ?>"
                                                                   title="Enviar correo">Enviar correo</a>
                                                            <?php endif; ?>
                                                        </div><!-- fin detalle-equipo -->
                                                    </div>
                                                </div>
                                            </div><!-- fin tab-1 -->
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="full-equipo"><!-- full-equipo -->
                                        <div class="container">
                                            <div class="twelve columns">
                                                <div id="equipo-<?php echo $pais_slug; ?>"
                                                     class="owl-carousel owl-theme">
                                                    <?php foreach ($area['data'] as $j => $integrante): ?>
                                                        <div class="item">
                                                            <a href="#" <?php echo $j == 0 ? 'class="current"' : ''; ?>
                                                               data-tab="<?php echo $pais_slug . '-' . $area_slug . '-tab-' . $j ?>"
                                                               title="<?php echo $integrante['nombre']; ?>">
                                                                <img
                                                                    src="<?php echo $integrante['imagen_miniatura']['sizes']['equipo_small']; ?>"
                                                                    border="0" draggable="false"
                                                                    alt="<?php echo $integrante['nombre']; ?>"/>
                                                            </a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div><!-- fin full-equipo -->
                                </div>
                                <?php
                                $k++;
                            endforeach; ?>

                            <div class="double-btn-container">
                                <div class="container">
                                    <?php
                                    //                                    $areas_invert = array_reverse($eq['data']);
                                    $total_sections = count($eq['data']);

                                    if ($total_sections > 1) {
                                        foreach ($eq['data'] as $area_slug => $area) :
                                            $column_num = 12 / $total_sections;
                                            $column = columns_number_converter($column_num);
                                            ?>
                                            <div class="<?php echo $column; ?> columns">
                                                <a class="arrow-btn custom-ar-<?php echo $area_slug; ?>"
                                                   data-slider="<?php echo $pais_slug; ?>-<?php echo $area_slug; ?>"
                                                   href="#"
                                                   title="<?php echo $area['area']; ?>"><?php echo $area['area']; ?></a>
                                            </div>
                                        <?php endforeach;
                                    }
                                    ?>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <?php
                $i++;
            endforeach; ?>
        <?php endif; ?>

        <div class="break">
            <div class="banner-clientes"><!-- banner-clientes -->
                <div class="cover"></div>
                <div class="container">
                    <div class="deco-clientes animated"><!-- deco-clientes -->
                        <a class="button button-primary" href="#" title="Nuestros Clientes">Nuestros Clientes</a>
                    </div><!-- fin deco-clientes -->
                </div>
            </div><!-- fin banner-clientes -->
        </div>

        <?php
        /** @var array $alianzas */
        if (count($alianzas)) :
            ?>
            <div class="break">
                <div class="partners"><!-- partners -->
                    <div class="container margin-bottom-20">
                        <div class="three columns animated">
                            <div class="box-partner title-no-border"><!-- box-partner -->
                                <h1>Business <span>Partners</span></h1>
                            </div><!-- fin box-partner -->
                        </div>

                        <?php foreach ($alianzas[0] as $alianza) :
                            $url_component = parse_url($alianza['sitio_web']);
                            ?>
                            <div class="three columns animated">
                                <div class="box-partner"><!-- box-partner -->
                                    <img class="img-responsive" src="<?php echo $alianza['imagen']; ?>"
                                         draggable="false" border="0" alt="<?php echo $alianza['title']; ?>"/>
                                    <h2><?php echo $alianza['title']; ?></h2>
                                    <p>
                                        <a href="<?php echo $alianza['sitio_web']; ?>" target="_blank"
                                           title="<?php echo $url_component['host']; ?>"><?php echo $url_component['host']; ?></a>
                                    </p>
                                </div><!-- fin box-partner -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php foreach ($alianzas as $i => $alianza_list) :
                        if ($i == 0) continue;
                        ?>
                        <div class="container margin-bottom-20">
                            <?php foreach ($alianza_list as $j => $alianza) {
                                $url_component = parse_url($alianza['sitio_web']);
                                ?>
                                <div class="three <?php echo $j == 0 ? 'offset-by-three' : ''; ?> columns animated">
                                    <div class="box-partner"><!-- box-partner -->
                                        <img class="img-responsive" src="<?php echo $alianza['imagen']; ?>"
                                             draggable="false" border="0" alt="<?php echo $alianza['title']; ?>"/>
                                        <h2><?php echo $alianza['title']; ?></h2>
                                        <p>
                                            <a href="<?php echo $alianza['sitio_web']; ?>" target="_blank"
                                               title="<?php echo $url_component['host']; ?>"><?php echo $url_component['host']; ?></a>
                                        </p>
                                    </div><!-- fin box-partner -->
                                </div>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div><!-- fin partners -->
            </div>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>