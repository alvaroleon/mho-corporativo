<?php
/**
 * Template Name: Plantilla de Alianzas
 */
if (have_posts()) the_post();

get_header();

$color_principal = get_field('color_principal');
$color_principal_rgb = hex2rgb($color_principal);
$fondo_bajada = get_field('fondo_bajada');
$fondo_bajada = $fondo_bajada['url'];
$video_bajada = get_field('video_bajada');
$fondo_bajada_principal = get_field('fondo_bajada_principal');

$alianzas = get_alianzas(4);
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
            <div class="partners"><!-- partners -->
                <?php foreach ($alianzas as $alianzas_list) : ?>
                    <div class="container margin-bottom-20">
                        <?php foreach ($alianzas_list as $alianza) :
                            $url_component = parse_url($alianza['sitio_web']);
                            ?>
                            <div class="three columns animated">
                                <div class="box-partner"><!-- box-partner -->
                                    <img class="img-responsive" src="<?php echo $alianza['imagen']; ?>" draggable="false" border="0" alt="<?php echo $alianza['title']; ?>"/>
                                    <h2><?php echo $alianza['title']; ?></h2>
                                    <p>
                                        <a href="<?php echo $alianza['sitio_web']; ?>" target="_blank" title="<?php echo $url_component['host']; ?>"><?php echo $url_component['host']; ?></a>
                                    </p>
                                </div><!-- fin box-partner -->
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div><!-- fin partners -->
        </div>

    </section>

<?php get_footer(); ?>