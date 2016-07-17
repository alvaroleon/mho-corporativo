<?php
/**
 * Template Name: Plantilla de Clientes
 */
if (have_posts()) the_post();

get_header();
?>

    <section>

        <article>
            <div class="banner-principal"><!-- banner-principal -->
                <div class="container">
                    <div class="seven columns">
                        <h1>Clientes</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit fringilla sem, sit amet fermentum lacus ultrices a. Nunc pellentesque vel felis at laoreet. Suspendisse viverra egestas orci viverra tempor.</p>
                    </div>
                </div>
            </div><!-- fin banner-principal -->

        </article>

        <div class="break">
            <div class="clientes"><!-- clientes -->
                <div class="container">
                    <div class="twelve columns">
                        <div class="item-cliente"><!-- item-cliente -->
                            <h2>Inmobiliarias</h2>
                            <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/logo-inmobiliaria.png" draggable="false" border="0" alt="Inmobiliarias" />
                        </div><!-- item-cliente -->

                        <div class="item-cliente"><!-- item-cliente -->
                            <h2>Constructoras</h2>
                            <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/logo-constructora.png" draggable="false" border="0" alt="Constructoras" />
                        </div><!-- item-cliente -->

                        <div class="item-cliente"><!-- item-cliente -->
                            <h2>Comercios</h2>
                            <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/logo-comercio.png" draggable="false" border="0" alt="Comercios" />
                        </div><!-- item-cliente -->

                        <div class="item-cliente"><!-- item-cliente -->
                            <h2>Otros</h2>
                            <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/logo-otros.png" draggable="false" border="0" alt="Otros" />
                        </div><!-- item-cliente -->

                    </div>
                </div>
            </div><!-- fin clientes -->
        </div>

    </section>

<?php get_footer(); ?>