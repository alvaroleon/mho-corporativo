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
$video_bajada = get_field('video_bajada');
$fondo_bajada_principal = get_field('fondo_bajada_principal');

$quienes_somos = [
    'contenido' => get_field('contenido')[0],
    'mision_vision' => get_field('mision_vision')[0]
];
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
            <div class="break">
                <div class="banner-principal"><!-- banner-principal -->
                    <div class="container">
                        <div class="seven columns">
                            <h1><?php the_title(); ?></h1>
                            <?php echo get_field('bajada'); ?>
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