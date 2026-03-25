<?php 
/*
 * Template Name: Junta Directiva
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
                // CONTENIDO POR DEFECTO
                ?>
                <p>La Junta Directiva es la máxima autoridad colegiada y su principal rol es supervisar y aprobar la política global de desarrollo de la Universidad de Santiago de Chile, sus planes de mediano y largo plazo, la estructura orgánica de la institución y sus modificaciones; la creación y modificación de grados académicos y títulos profesionales; el presupuesto anual de la Corporación; y el nombramiento de los directivos superiores, entre otras materias.</p>
                
                <h3 class="qs-subtitle text-teal margin-top-30 margin-bottom-20">Integran la Junta Directiva:</h3>

                <div class="grid-junta">
                    
                    <div>
                        <h4 class="text-teal font-extra-bold margin-bottom-5">Presidente</h4>
                        <p class="margin-bottom-15">Sr. Gonzalo Salgado Barros</p>

                        <h4 class="text-teal font-extra-bold margin-bottom-5">Rector</h4>
                        <p class="margin-bottom-15">Dr. Rodrigo Alejandro Vidal Rojas</p>

                        <h4 class="text-teal font-extra-bold margin-bottom-5">Secretario de la Junta Directiva</h4>
                        <p>Sr. Eduardo Enrique Pérez Contreras</p>
                    </div>

                    <div>
                        <h4 class="text-teal font-extra-bold margin-bottom-10">Directores(as)</h4>
                        <ul class="list-disc-spaced">
                            <li>Dra. María Jesús Aguirre Quintana</li>
                            <li>Sr. Víctor Alexis Salas Opazo</li>
                            <li>Dr. Gonzalo Javier Gutiérrez Gallardo</li>
                            <li>Dra. Roxana Antonina Cristal Pey Tumanoff</li>
                            <li>Dra. Soledad del Carmen Ramírez Gatica</li>
                        </ul>
                    </div>

                </div>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Documentos y Actas</h3>
                <ul class="download-list list-none-spaced">
                    <li class="margin-bottom-10">🔗 <a href="https://www.secretaria.usach.cl/actas-de-la-junta-directiva" target="_blank" class="link-teal font-bold">Actas de la Junta Directiva - Haga clic acá</a></li>
                    <li class="margin-bottom-10">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/nombramiento_integrantes_junta_directiva.pdf" target="_blank" class="link-orange font-bold">Nombramiento directores internos - Haga clic acá</a></li>
                    <li class="margin-bottom-10">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/decreto_supremo_153_de_2022.pdf" target="_blank" class="link-orange font-bold">Nombramiento directores externos - Haga clic acá</a></li>
                </ul>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>



<?php get_footer(); ?>