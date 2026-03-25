<?php 
/*
 * Template Name: Convoca Elecciones
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
                <p>El jueves 8 de agosto se llevarán a cabo elecciones en la Universidad de Santiago de Chile, entre ellas, la que busca elegir a un integrante no académico, representante del personal profesional y técnico para conformar el <strong>Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad</strong>.</p>
                
                <p>Es importante señalar que este comité estará integrado por un o una representante del personal académico, un o una representante del profesorado por hora de clases, un o una representante del personal profesional y técnico y dos representantes estudiantiles.</p>

                <p>El Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad es un órgano consultivo de la Vicerrectoría y tiene como principal objetivo asesorar y/o proponer acciones en temas y/o aspectos que incidan en la calidad de vida de las personas que conforman la comunidad de la Universidad de Santiago de Chile, aportando distintas miradas acerca de la promoción, desarrollo y mantención de su bienestar, velando por sus derechos y promoviendo la equidad.</p>

                <h3 class="qs-subtitle text-teal margin-top-30">Otros procesos eleccionarios del día:</h3>
                <p>Otro proceso que se desarrollará el mismo día, será la elección de <strong>Decano o Decana de la Facultad de Química y Biología.</strong></p>

                <p>Los otros procesos que también tendrán lugar el jueves 8 de agosto son:</p>
                <ul class="list-disc-spaced">
                    <li>Consejero o Consejera Departamento de Gestión Agraria.</li>
                    <li>Director o Directora del Instituto de Estudios Avanzados.</li>
                    <li>Representante del Estamento Administrativo ante el Consejo de la Facultad de Ingeniería.</li>
                </ul>

                <div class="text-center-spaced">
                    <p class="font-bold margin-bottom-15" style="font-size: 1.2em;">Para votar debes ingresar al siguiente link:</p>
                    <a href="https://eleccionesusach.cl/" target="_blank" class="highlight-link">IR A ELECCIONESUSACH.CL</a>
                </div>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Documentos y Descargas</h3>
                <ul class="list-none-spaced">
                    <li class="list-item-spaced">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/padron_electores_vicaviged.pdf" target="_blank" class="link-orange">Padrones de electores para representante del personal profesional y técnico para conformar el Comité Asesor VICAVIGED</a></li>
                    <li class="list-item-spaced">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/calendario_elecciones_vicaviged_8_de_agosto_def.pdf" target="_blank" class="link-orange">Calendario del proceso de elecciones 8 de agosto 2024</a></li>
                    <li class="list-item-spaced">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formulario_de_inscripcion_de_candidatura_0.docx" target="_blank" class="link-orange">Formulario de inscripción de candidaturas</a></li>
                </ul>

                <div class="box-alert">
                    <p>A partir de lo informado en el calendario, el período para impugnar dichas candidaturas finaliza el miércoles 31 de julio 2024. En este caso, los antecedentes deben ser enviados a <a href="mailto:impugnacioneselectorales@usach.cl" class="link-orange-simple">impugnacioneselectorales@usach.cl</a> junto con señalar los requisitos que se verían eventualmente incumplidos.</p>
                    <p>Se recuerda que quienes los candidatos y candidatas deben cumplir con los siguientes requisitos: Ser funcionarios no académicos y funcionarias no académicas que tengan un nombramiento vigente en propiedad o en la contrata asimilado a planta profesional o técnica, que cuenten con una antigüedad interrumpida de dos años en la Universidad, en esta calidad, al 19 de julio de 2024.</p>
                </div>

                <p class="margin-top-20">
                    <strong>Las candidaturas del Comité Asesor para VICAVIGED pueden ser conocidas aquí:</strong> <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/candidatos_elecciones_vicaviged_8_de_agosto.xlsx" target="_blank" class="link-orange">Candidatos a elecciones Comité Asesor de VICAVIGED de las plantas profesionales y técnicos</a>
                </p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>