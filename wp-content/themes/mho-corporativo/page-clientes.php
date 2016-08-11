<?php
/**
 * Template Name: Plantilla de Clientes
 */
if (have_posts()) the_post();

get_header();

$color_principal = get_field('color_principal');
$color_principal_rgb = hex2rgb($color_principal);
$fondo_bajada = get_field('fondo_bajada');
$fondo_bajada = $fondo_bajada['url'];
$video_bajada = get_field('video_bajada');
$fondo_bajada_principal = get_field('fondo_bajada_principal');
$clientes = get_field('grupo_clientes');
?>
    <style>
        <?php if ($fondo_bajada_principal == 'Imagen') { ?>
        .banner-principal {
            background-image: url("<?php echo $fondo_bajada; ?>");
        }
        <?php } else { ?>
        .banner-principal {
            background-image: none !important;
        }
        <?php } ?>

        .banner-principal::after {
            background-color: <?php echo is_mobile() ? $color_principal : "rgba({$color_principal_rgb}, 0.4);"; ?>
        }
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
                <?php if ($fondo_bajada_principal == 'Video' && !is_mobile()): ?>
                    <video src="<?php echo $video_bajada; ?>"
                           width="100%" height="100%" autoplay="autoplay" controls="false" loop muted>
                        <code>Video</code>
                        Tu navegador no soporta video HTML, por favor actualizar a las últimas versiones.
                    </video>
                <?php endif; ?>
            </div><!-- fin banner-principal -->

        </article>

        <div class="break">
            <div class="clientes"><!-- clientes -->
                <div class="container">
                    <div class="twelve columns">
                        <?php if (count($clientes)): ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <div class="item-cliente">
                                    <h2><?php echo $cliente['tipo_clientes']; ?></h2>
                                    <img class="img-responsive" src="<?php echo $cliente['imagen']['url']; ?>" draggable="false" border="0" alt="Inmobiliarias"/>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div><!-- fin clientes -->
        </div>

    </section>

<?php get_footer(); ?>