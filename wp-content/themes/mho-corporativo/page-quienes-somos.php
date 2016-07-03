<?php
/**
 * Template Name: Plantilla de Quienes somos
 */
if (have_posts()) the_post();

get_header();
?>

    <section>

        <article>
            <div class="break">
                <div class="banner-principal"><!-- banner-principal -->
                    <div class="container">
                        <div class="seven columns">
                            <h1>Quienes Somos</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer suscipit fringilla sem, sit amet fermentum lacus ultrices a. Nunc pellentesque vel felis at laoreet. Suspendisse viverra egestas orci viverra tempor.</p>
                        </div>
                    </div>
                </div><!-- fin banner-principal -->
            </div>

            <div class="break"><!-- break -->
                <div class="content-about-us"><!-- content-about-us -->
                    <div class="container">
                        <div class="six columns">
                            <div class="stylish-img">
                                <img class="img-responsive" draggable="false" src="<?php bloginfo('template_url') ?>/images/ingenieros-consultores.jpg" alt="Ingenieros y Consultores" />
                            </div>
                        </div>
                        <div class="six columns">
                            <h2>Somos expertos <span>Ingenieros y Consultores</span></h2>
                            <p><strong>En julio de 2011, MHO aprueba la auditoría de seguimiento realizada por SGS Chile, confirmando que nuestro sistema interno de gestión de calidad cumple todos los requistos del estandar ISO 9001:2000.</strong></p>
                            <p>Esta certificación demuestra la consolidación del sistema de gestión de calidad de MHO, el cual enfoca sus procesos a los requerimientos del cliente, asegurando así la entrega de un servicio de calidad.</p>
                            <p>Nuestro compromiso frente a nuevos desafíos y la diversificación constante de nuestros servicios nos ha permitido establecernos en Perú, a fin de responder a las crecientes necesidades de nuestro vecino país.</p>
                        </div>
                    </div>

                </div><!-- fin content-about-us -->
            </div>

            <div class="break">
                <div class="banner-clientes"><!-- banner-clientes -->
                    <div class="cover"></div>
                    <div class="container">
                        <div class="deco-clientes animated"><!-- deco-clientes -->
                            <a class="button button-primary" href="#" title="Nuestras Alianzas">Nuestras Alianzas</a>
                        </div><!-- fin deco-clientes -->
                    </div>
                </div><!-- fin banner-clientes -->
            </div>

            <div class="break"><!-- break -->
                <div class="container">
                    <div class="six columns">
                        <div class="stylish-img">
                            <img class="img-responsive" draggable="false" src="<?php bloginfo('template_url') ?>/images/img-mision-vision.jpg" alt="Ingenieros y Consultores" />
                        </div>
                    </div>
                    <div class="three columns">
                        <h2>Misión</h2>
                        <p>Ser una empresa que desarrolla <strong>Consultoría en Ingeniería Vial, Ingeniería Ambiental e Ingeniería de Detalle</strong> dentro de un mercado competitivo, respondiendo a las necesidades de sus clientes, con una adecuada gestión de calidad, dónde su principal activo es el capital humano que posee, logrando de esta manera darle un valor agregado como compañía, lo que nos permite ser reconocidos dentro del mercado como una empresa de excelencia.</p>
                    </div>
                    <div class="three columns">
                        <h2>Visión</h2>
                        <p>Trascender a través del tiempo como la mejor empresa de consultoría en Ingeniería Vial, Ingeniería Ambiental e Ingeniería de Detalle, entregando un servicio de alta calidad, a la hora de desarrollar nuestro trabajo, implementando nuevas tecnologías e innovando día a día en la búsqueda de mejores soluciones para la satisfacción de nuestros clientes.</p>
                    </div>
                </div>
            </div>



        </article>



    </section>

<?php get_footer(); ?>