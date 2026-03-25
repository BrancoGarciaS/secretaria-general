<?php 
/*
 * Template Name: Títulos y Grados
 */
get_header(); 
?>

<section class="section-title-bar">
    <h2><?php the_title(); ?></h2>
</section>

<main class="simple-layout">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class="qs-text-block">
            <?php 
            if ( get_the_content() ) {
                the_content(); 
            } else {
                // CONTENIDO POR DEFECTO (HTML ORIGINAL LIMPIO)
                ?>
                <p>La Unidad de Títulos y Grados de la Secretaría General, es la encargada de los requerimientos en el proceso de otorgamiento de títulos y grados de las y los estudiantes que hayan cumplido con las normas establecidas en la reglamentación vigente de la Institución, junto con la entrega de documentación que requiera el titulado/graduado, tales como legalizaciones, duplicado de diplomas y certificados en trámite.</p>
                
                <h3 class="qs-subtitle text-teal margin-top-30">Solicitud y descarga de certificados</h3>
                <p>Puede realizar sus trámites en: <a href="https://serviciosweb.usach.cl/" target="_blank" class="link-orange font-bold">https://serviciosweb.usach.cl/</a></p>
                <p>El portal requiere ingresar con el correo Usach. En caso de no tenerla o no recordar su contraseña, puede ingresar con su Clave Única.</p>
                
                <h4 class="margin-top-20 font-bold">Se pueden realizar las siguientes solicitudes:</h4>

                <div class="table-responsive"> 
                    <table class="price-table">
                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>1ra vez en el año</th>
                                <th>2da vez en el año</th>
                                <th>3ra vez o más</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Certificado Título profesional</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de grado académico (copia)</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Magíster (copia)</td><td>Exento</td><td>Exento</td><td>$31.000.-</td></tr>
                            <tr><td>Certificado de Doctorado (copia)</td><td>Exento</td><td>Exento</td><td>$31.000.-</td></tr>
                            <tr><td>Certificado de Diplomado (copia)</td><td>Exento</td><td>Exento</td><td>$38.000.-</td></tr>
                            <tr><td>Certificado de Minor (copia)</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Postítulo (copia)</td><td>Exento</td><td>Exento</td><td>$58.000.-</td></tr>
                            <tr><td>Duplicado de diploma</td><td>$164.000.-</td><td>$164.000.-</td><td>$164.000.-</td></tr>
                            <tr><td>Canje o revalidación</td><td>$245.000.-</td><td>$245.000.-</td><td>$245.000.-</td></tr>
                            <tr><td>Legalizaciones por documento</td><td>$27.000</td><td>$27.000</td><td>$27.000</td></tr>
                            <tr><td>Certificado de Titulo en trámite (copia)</td><td>$17.000.-</td><td>$17.000.-</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Grado en trámite (copia)</td><td>$17.000.-</td><td>$17.000.-</td><td>$17.000.-</td></tr>
                        </tbody>
                    </table>
                </div>

                <hr class="separator-line">

                <div class="flex-gap-40">
                    <div class="flex-item-min-250">
                        <h4 class="text-teal">Consultas:</h4>
                        <p>Envíe correo electrónico a <a href="mailto:utg@usach.cl" class="link-dark">utg@usach.cl</a></p>
                    </div>
                    <div class="flex-item-min-250">
                        <h4 class="text-teal">Atención presencial:</h4>
                        <p><strong>Horario:</strong> Lunes a sábado de 9:00 a 14:00 horas</p>
                        <p><strong>Dirección:</strong> Ruiz Tagle 0140, esquina Víctor Jara (Ex Ecuador). Estación Central. Santiago.</p>
                        <p class="text-small-gray font-italic">La Oficina de Títulos y Grados no atiende en días festivos ni durante el receso universitario.</p>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>



<?php get_footer(); ?>