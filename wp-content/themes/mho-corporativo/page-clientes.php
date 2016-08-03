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
$clientes = get_field('grupo_clientes');
?>
    <style>
        .banner-principal {
            background-image: url("<?php echo $fondo_bajada; ?>") !important;
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