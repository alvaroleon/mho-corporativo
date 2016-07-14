<?php
/**
 * Template Name: Plantilla de Equipo
 */
if (have_posts()) the_post();

get_header();

$color_principal = get_field('color_principal');
$color_principal_rgb = hex2rgb($color_principal);
$fondo_bajada = get_field('fondo_bajada');
$fondo_bajada = $fondo_bajada['url'];
$equipo = get_equipo();
$areas = get_areas();
?>
    <style>
        .banner-principal {
            background-image: url("<?php echo $fondo_bajada; ?>");
        }

        .banner-principal::after {
            background-color: rgba(<?php echo $color_principal_rgb; ?>, 0.8);
        }

        <?php
/**
* Creación de CSS
*/
/** @var array $nuestros_servicios */
$total_servicios = count($nuestros_servicios['areas']);
$gradients_color = [];

foreach ($areas as $area) {
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
            <div class="banner-principal"><!-- banner-principal -->
                <div class="container">
                    <div class="seven columns">
                        <h1><?php the_title(); ?></h1>
                        <?php the_field('bajada'); ?>
                    </div>
                </div>
            </div><!-- fin banner-principal -->
        </article>

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
                            <div id="<?php echo $pais_slug; ?>-<?php echo $area_slug; ?>" class="team-area<?php echo $k > 0 ? ' hide-team' : ''; ?>">
                                <div class="current animated">
                                    <?php
                                    foreach ($area['data'] as $j => $integrante) :
                                        ?>
                                        <div id="<?php echo $pais_slug . '-' . $area_slug . '-tab-' . $j ?>" class="team<?php echo $j == 0 ? ' current' : ''; ?>"><!-- tab-1 -->
                                            <div class="container">
                                                <div class="six columns">
                                                    <div class="main-equipo"><!-- main-equipo -->
                                                        <div class="stylish-img">
                                                            <img class="img-responsive" src="<?php echo $integrante['imagen']['sizes']['equipo_big']; ?>" draggable="false" border="0" alt="<?php echo $integrante['nombre'] . ' - ' . $integrante['cargo']; ?>">
                                                        </div>
                                                    </div><!-- fin main-equipo -->
                                                </div>
                                                <div class="six columns">
                                                    <div class="detalle-equipo"><!-- detalle-equipo -->
                                                        <h2>Área <span><?php echo preg_replace([
                                                                        "/área|Área/",
                                                                        "/Ingeniería|ingeniería|ingenieria/i"
                                                                    ], [
                                                                        '',
                                                                        'Ing.'
                                                                    ], $integrante['area']) . ' | ' . $eq['pais']; ?></span>
                                                        </h2>
                                                        <h3><?php echo $integrante['nombre']; ?></h3>
                                                        <h4><?php echo $integrante['titulo']; ?></h4>
                                                        <p><?php echo $integrante['cargo']; ?></p>
                                                        <?php if ($integrante['email']) : ?>
                                                            <a class="button button-primary" href="mailto:<?php echo $integrante['email']; ?>" title="Enviar correo">Enviar correo</a>
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
                                            <div id="equipo-<?php echo $pais_slug; ?>" class="owl-carousel owl-theme">
                                                <?php foreach ($area['data'] as $j => $integrante): ?>
                                                    <div class="item">
                                                        <a href="#" <?php echo $j == 0 ? 'class="current"' : ''; ?> data-tab="<?php echo $pais_slug . '-' . $area_slug . '-tab-' . $j ?>" title="<?php echo $integrante['nombre']; ?>">
                                                            <img src="<?php echo $integrante['imagen_miniatura']['sizes']['equipo_small']; ?>" border="0" draggable="false" alt="<?php echo $integrante['nombre']; ?>"/>
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

                                foreach ($eq['data'] as $area_slug => $area) : ?>
                                    <div class="six columns">
                                        <a class="arrow-btn custom-ar-<?php echo $area_slug; ?>" data-slider="<?php echo $pais_slug; ?>-<?php echo $area_slug; ?>" href="#" title="<?php echo $area['area']; ?>"><?php echo $area['area']; ?></a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <?php
            $i++;
        endforeach; ?>
    </section>

<?php get_footer(); ?>