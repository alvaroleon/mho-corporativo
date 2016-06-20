<?php
/**
 * Template Name: Plantilla de Área ambiental
 */
if (have_posts()) the_post();

get_header();
?>

    <section class="ambiental">

        <article>

            <div class="banner-principal"><!-- banner-principal -->
                <div class="container">
                    <div class="three columns">
                        <div class="cover-button">
                            <a class="button button-primary" href="#" title="Descarga nuestro brochure">Descarga nuestro brochure</a>
                        </div>
                    </div>
                    <div class="seven offset-by-one columns">
                        <h1><?php the_title(); ?></h1>
                        <p>Nuestro trabajo está orientado a la Gestión de Ingeniería Ambiental, dando respuestas eficientes frente a la normativa medioambiental vigente. Evaluamos ambientalmente el proyecto y elaboramos documentos necesarios para que sean sometido al proceso de Evaluación de Impacto Ambiental y obtengan su Resolución de Calificación Ambiental favorable. Contamos con un equipo multidisciplinario conformado por profesionales de amplia experiencia y consultores externos especializados en ésta área, capaces de responder las inquietudes del titular y las necesidades de la autoridad ambiental, indistintamente.</p>
                    </div>
                </div>
            </div><!-- fin banner-principal -->

        </article>

        <article>
            <div class="container">
                <div class="twelve columns">
                    <h1>Nuestros <span>principales proyectos</span></h1>
                </div>
            </div>
            <div class="container">
                <div class="six columns">
                    <ul class="list-style">
                        <li>Consulta de pertinencia de ingreso al sistema de evaluación de impacto ambiental (SEIA)</li>
                        <li>Estudios de Impacto Ambiental (EIA)</li>
                        <li>Declaraciones de impacto ambiental (DIA)</li>
                        <li>Calificación técnica industrial (CTI)</li>
                    </ul>
                </div>
                <div class="six columns">
                    <ul class="list-style">
                        <li>Programas de compensación de emisiones</li>
                        <li>Seguimiento ambiental</li>
                        <li>Informe de cumplimiento en Obra</li>
                        <li>Tramitaciones de permisos sectoriales</li>
                    </ul>
                </div>
            </div>

            <div class="bloque"><!-- bloque1 -->
                <div class="container">
                    <div class="six columns">
                        <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/img-ambiental.jpg" draggable="false" border="0" alt="Ambiental" />
                    </div>
                    <div class="six columns">
                        <h2>ESTUDIO DE IMPACTO AMBIENTAL</h2>
                        <p>Corresponde a un documento que describe detalladamente las características de un proyecto o actividad que se pretenda llevar a cabo o su modificación. Debe proporcionar antecedentes fundados para identificar, predecir o interpretar el impacto ambiental asociado a las obras de construcción u operación del mimo, debiendo describir las acciones que serán ejecutadas para impedir o mitigar los efectos adversos significativos que su puesta en marcha pueda ocasionar.</p>
                        <h3>Un Estudio de Impacto Ambiental debe contener:</h3>
                        <ul>
                            <li>A) Una descripción del proyecto y de todas sus fases.</li>
                            <li>B) Determinación y Justificación del área de influencia.</li>
                            <li>C) Una línea de base que deberá describir detalladamente el área de influencia del proyecto.</li>
                            <li>D) Una predicción y evaluación del impacto ambiental del proyecto.</li>
                            <li>E) Una descripción pormenorizada de aquellos efectos, características y circunstancias que dan origen a la necesidad de elaborar un Estudio de Impacto Ambiental.</li>
                            <li>F) Un Plan de Medidas de Mitigación, Reparación y Compensación.</li>
                            <li>G) Un Plan de seguimiento de las variable ambientales relevantes.</li>
                            <li>H) Descripción del contenido de los compromisos ambientales voluntarios.</li>
                            <li>I) La descripción de las acciones realizadas previamente a la presentación del Estudio de Impacto Ambiental con organizaciones ciudadanas interesadas.</li>
                        </ul>
                    </div>
                </div>
            </div><!-- fin bloque1 -->


            <div class="bloque"><!-- bloque2 -->
                <div class="container">
                    <div class="six columns">
                        <img class="img-responsive" src="<?php bloginfo('template_url') ?>/images/img-ambiental.jpg" draggable="false" border="0" alt="Ambiental" />
                    </div>
                    <div class="six columns">
                        <h2>DECLARACIÓN DE IMPACTO AMBIENTAL</h2>
                        <p>Corresponde a un documento, elaborado en base a una Declaración Jurada firmada por parte del representante legal, en donde se acredita que un proyecto o actividad que se pretende realizar, o de las modificaciones que se le introducirán, cumple con la legislación ambiental vigente y cuyos contenidos permiten al organismo competente evaluar si su impacto ambiental se ajusta a las normas ambientales vigentes.</p>
                        <h3>Una Declaración de Impacto Ambiental debe contener a lo menos:</h3>
                        <ul>
                            <li>A) Una descripción del proyecto y de todas sus fases.</li>
                            <li>B) Los Antecedente necesarios que justifiquen la inexistencia de aquellos efectos, características y circunstancias que puedan dar origen a la presentación de un Estudio de Impacto Ambiental.</li>
                            <li>C) Un plan de cumplimiento de la Legislación Ambiental Vigente.</li>
                            <li>D)La descripción de aquellos compromisos ambientales voluntarios (si los hubiera).</li>
                            <li>E) Una ficha de resumen.</li>
                            <li>F) Un listado de los nombres de los participantes de la DIA.</li>
                        </ul>
                    </div>
                </div>
            </div><!-- fin bloque2 -->

        </article>

        <div class="container">
            <div class="twelve columns">
                <div class="paginador-text">
                    <ul>
                        <li><a class="prev" href="#" title="Área de ingenería de detalle">Área de ingenería de detalle</a></li>
                        <li><a class="next" href="#" title="Área Vial">Área Vial</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </section>

<?php get_footer(); ?>