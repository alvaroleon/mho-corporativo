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
            <div class="container">
                <div class="three columns animated">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

    </section>

<?php get_footer(); ?>