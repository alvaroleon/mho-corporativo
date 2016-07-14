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
$alianzas = get_alianzas(4);
?>
    <style>
        .banner-principal {
            background-image: url("<?php echo $fondo_bajada; ?>");
        }

        .banner-principal::after {
            background-color: rgba(<?php echo $color_principal_rgb; ?>, 0.8);
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