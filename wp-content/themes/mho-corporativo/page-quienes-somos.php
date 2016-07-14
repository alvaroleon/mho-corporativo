<?php
/**
 * Template Name: Plantilla de Quienes somos
 */
if (have_posts()) the_post();

get_header();

$color_principal = get_field('color_principal');
$color_principal_rgb = hex2rgb($color_principal);
$fondo_bajada = get_field('fondo_bajada');
$fondo_bajada = $fondo_bajada['url'];

$quienes_somos = [
    'contenido' => get_field('contenido')[0],
    'mision_vision' => get_field('mision_vision')[0]
];
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
            <div class="break">
                <div class="banner-principal"><!-- banner-principal -->
                    <div class="container">
                        <div class="seven columns">
                            <h1><?php the_title(); ?></h1>
                            <?php echo get_field('bajada'); ?>
                        </div>
                    </div>
                </div><!-- fin banner-principal -->
            </div>

            <div class="break"><!-- break -->
                <div class="container-about-us">
                    <div class="container">
                        <div class="six columns">
                            <div class="stylish-img">
                                <img class="img-responsive" draggable="false" src="<?php echo $quienes_somos['contenido']['imagen']['sizes']['quienes_somos_big']; ?>" alt="Ingenieros y Consultores"/>
                            </div>
                        </div>
                        <div class="six columns">
                            <h2><?php
                                /** @var array $quienes_somos */
                                echo $quienes_somos['contenido']['titulo'][0]['texto_superior'];
                                ?> <span><?php echo $quienes_somos['contenido']['titulo'][0]['texto_inferior']; ?></span>
                            </h2>
                            <?php echo $quienes_somos['contenido']['contenido']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="break">
                <div class="banner-clientes"><!-- banner-clientes -->
                    <div class="cover"></div>
                    <div class="container">
                        <div class="deco-clientes animated"><!-- deco-clientes -->
                            <a class="button button-primary" href="<?php the_permalink(16) ?>" title="Nuestras Alianzas">Nuestras Alianzas</a>
                        </div><!-- fin deco-clientes -->
                    </div>
                </div><!-- fin banner-clientes -->
            </div>

            <div class="break"><!-- break -->
                <div class="container">
                    <div class="six columns">
                        <div class="stylish-img">
                            <img class="img-responsive" draggable="false" src="<?php echo $quienes_somos['mision_vision']['imagen']['sizes']['quienes_somos_big']; ?>" alt="Ingenieros y Consultores"/>
                        </div>
                    </div>

                    <?php foreach ($quienes_somos['mision_vision']['informacion'] as $info) : ?>
                        <div class="three columns">
                            <h2><?php echo $info['titulo']; ?></h2>
                            <?php echo $info['texto']; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </article>
    </section>
<?php get_footer(); ?>