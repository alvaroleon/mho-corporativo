<?php
if (have_posts()) the_post();

get_header();

/**
 * Capa lógica
 */

$color_principal = get_field('color_principal');
$color_principal_rgb = hex2rgb($color_principal);
$brochure = get_field('brochure');
$contenido = get_field('contenido')[0];
$servicios = get_field('servicios');
$fondo_bajada = get_field('fondo_bajada');
$fondo_bajada = $fondo_bajada['url'];
?>
    <style>
        section.vial .cover-button::after {
            background-color: <?php echo $color_principal; ?>
        }

        section.vial .banner-principal::after {
            background-color: rgba(<?php echo $color_principal_rgb; ?>, 0.8);
        }

        .banner-principal {
            background-image: url("<?php echo $fondo_bajada; ?>") !important;
        }

        section.vial .cover-button {
            background-color: <?php echo $color_principal; ?>
        }

        section.vial h1 span {
            color: <?php echo $color_principal; ?>;
        }

        section.vial .bloque ul li {
            color: <?php echo $color_principal; ?>;
        }
    </style>
    <section class="vial">
        <article>
            <div class="banner-principal"><!-- banner-principal -->
                <div class="container">
                    <div class="three columns">
                        <div class="cover-button">
                            <?php if ($brochure): ?>
                                <a class="button button-primary" href="<?php echo $brochure['url']; ?>" target="_blank" title="Descarga nuestro brochure">Descarga nuestro brochure</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="seven offset-by-one columns">
                        <div class="">
                            <h1><?php the_title(); ?></h1>
                            <?php echo get_field('bajada'); ?>
                        </div>
                    </div>
                </div>
            </div><!-- fin banner-principal -->

        </article>

        <article>
            <div class="container">
                <div class="twelve columns">
                    <h1><?php echo $contenido['titulo'][0]['texto_superior']; ?>
                        <span><?php echo $contenido['titulo'][0]['texto_inferior']; ?></span></h1>
                </div>
            </div>
            <div class="container">
                <div class="six columns list-style-wrap">
                    <?php echo $contenido['contenido'][0]['izquierda']; ?>
                </div>
                <div class="six columns list-style-wrap">
                    <?php echo $contenido['contenido'][0]['derecha']; ?>
                </div>
            </div>

            <?php foreach ($servicios as $servicio) : ?>
                <div class="bloque">
                    <div class="container">
                        <div class="six columns">
                            <img class="img-responsive" src="<?php echo $servicio['imagen']['sizes']['servicio_img']; ?>" draggable="false" border="0" alt="<?php echo $servicio['titulo']; ?>">
                        </div>
                        <div class="six columns">
                            <h2><?php echo $servicio['titulo']; ?></h2>
                            <?php echo $servicio['contenido']; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </article>

        <?php
        $q = new WP_Query([
            'post_type' => 'servicio',
            'post__not_in' => array(get_the_ID()),
            'showposts' => 2,
            'orderby' => 'menu_order'
        ]);
        ?>
        <div class="container">
            <div class="twelve columns">
                <div class="paginador-text">
                    <ul>
                        <?php
                        $i = 0;
                        while ($q->have_posts()) :
                            $q->the_post();
                            $color_area = get_field('color_principal');
                            ?>
                            <li>
                                <a class="<?php echo $i == 0 ? 'prev' : 'next'; ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php if ($i == 0) : ?>
                                        <span>
                                            <svg width="20px" height="8px">
                                                <polygon fill="<?php echo $color_area; ?>" points="19.531,4.698 5.448,4.719 6.177,7.469 0,3.828 6.177,0 5.448,2.698 19.531,2.698 ">
                                            </svg>
                                        </span>
                                    <?php endif; ?>
                                    <?php the_title(); ?>
                                    <?php if ($i == 1) : ?>
                                        <span>
                                            <svg width="20px" height="8px">
                                                <polygon fill="<?php echo $color_area; ?>" points="0,2.771 14.083,2.75 13.354,0 19.531,3.641 13.354,7.469 14.083,4.771 0,4.771 ">
                                            </svg>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php
                            $i++;
                        endwhile;
                        wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>