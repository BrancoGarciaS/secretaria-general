<?php 
/*
 * Template Name: Procedimientos Disciplinarios
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
                <p>La Unidad de Procedimientos disciplinarios es la encargada de realizar y supervisar los diversos sumarios y procedimientos administrativos de la institución.</p>

                <h3 class="qs-subtitle text-teal margin-top-30">Funciones</h3>
                
                <ul class="list-disc-spaced">
                    <li>Redactar oportunamente las resoluciones que den inicio a los sumarios administrativos e investigaciones sumarias del sistema de alumnos. Redactar la resolución que aplica medida disciplinaria en cada caso, notificarla al afectado y recibir el recurso administrativo que proceda según la normativa legal. Redactar la resolución de término que aprueba el procedimiento disciplinario, sea sobreseyendo, absolviendo o aplicando una medida disciplinaria.Organizar, coordinar y supervisar la gestión a nivel interno, de la totalidad de los litigios institucionales, tanto a nivel de tribunales como de otros organismos de la administración del Estado. </li>
                    <li>Una vez iniciado un proceso disciplinario, citar a cada fiscal designado a una primera reunión de inducción, con el objeto de dar los insumos y capacitación necesaria para desempeñar su función investigadora. </li>
                    <li>Supervisar la tramitación de los procedimientos disciplinarios por parte de los fiscales, quienes deben realizar reportes periódicos del avance del proceso, manteniendo una comunicación eficaz y fluida con la coordinadora.</li>
                    <li>​Apoyar a los fiscales en su labor, proporcionándoles información sobre la normativa legal vigente, dictámenes de Contraloría General de la República, y orientación clara y precisa sobre las etapas del proceso disciplinario.</li>
                    <li>Revisar los expedientes entregados por los fiscales al término de su labor, emitiendo un Informe en Derecho en el cual se comunique al Director Jurídico las sugerencias respecto al resultado de la investigación, dando curso progresivo al proceso disciplinario.</li>
                    <li>Presidir la Comisión Interna contemplada en el Protocolo de Acoso Sexual y de discriminación, la cual tiene por objeto:
                        <ul class="list-circle-spaced">
                            <li>Apoyar a los fiscales encargados de investigar denuncias sobre estos temas en la Universidad, tanto en el análisis del caso como también en la adopción de medidas preventivas.</li>
                            <li>Implementar medidas preventivas de acoso y discriminación a través de charlas y capacitaciones a funcionarios y estudiantes.</li>
                            <li>Implementar talleres de capacitación a fiscales para realizar su labor investigativa, impartidos por profesionales expertos en la materia (PDI, CAVAS)</li>
                        </ul>
                    </li>
                    <li>Mantener una base de datos informática que contenga la información completa sobre los procedimientos disciplinarios tramitados en Fiscalía, para fines de control y entrega de información cuando corresponda, especialmente para tramitación de juicios, tramitación de renuncias, cancelación de pólizas, entrega de cargos directivos, y entrega de medallas, entre otros.</li>
                </ul>

                <hr class="separator-line">

                <p><strong>Manual de procedimientos disciplinarios:</strong> <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/8310-2021_manual_de_procedimientos_disciplinarios.pdf" target="_blank" class="link-orange">Hacer clic acá</a></p>
                
                <p>Descarga el formulario de Denuncia por Acoso Laboral o Violencia en el trabajo (llenar y enviar al correo <a href="mailto:denuncia.acosolaboral@usach.cl" class="link-teal">denuncia.acosolaboral@usach.cl</a>)</p>

                <p><strong>Formulario de denuncia en materia de acoso laboral:</strong> <a href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fsecretaria.usach.cl%2Fsites%2Fsecretaria%2Ffiles%2Fpaginas%2Fformulario_de_denuncia_acoso_laboral_de_la_universidad_de_santiago_de_chile_0.docx&wdOrigin=BROWSELINK" target="_blank" class="link-orange">Hacer clic acá</a></p>
                
                <p><strong>Agenda de Atención Psicojurídica:</strong> <a href="https://calendar.app.google/tNNLF3zTSJzdDFGE7" target="_blank" class="link-teal">Agendar aquí</a></p>
                
                <p class="text-small-gray margin-top-30">Cualquier otra denuncia puede ser enviada a través del Sistema de Trazabilidad Documental (STD), a la Unidad de Procedimientos Disciplinarios, perteneciente a la Dirección de Promoción del Cumplimiento o al correo: <a href="mailto:upd@usach.cl" class="link-teal">upd@usach.cl</a></p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>



<?php get_footer(); ?>