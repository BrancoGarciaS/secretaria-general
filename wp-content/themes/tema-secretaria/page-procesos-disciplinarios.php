<?php 
/*
 * Template Name: Procedimientos Disciplinarios
 */
get_header(); 
?>

<section class="section-title-bar" style="margin-top: 40px;">
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

                <h3 class="qs-subtitle text-teal" style="margin-top: 30px;">Funciones</h3>
                
                <ul style="margin-left: 20px; list-style-type: disc;">
                    <li>Redactar oportunamente las resoluciones que den inicio a los sumarios administrativos e investigaciones sumarias del sistema de alumnos. Redactar la resolución que aplica medida disciplinaria en cada caso, notificarla al afectado y recibir el recurso administrativo que proceda según la normativa legal. Redactar la resolución de término que aprueba el procedimiento disciplinario, sea sobreseyendo, absolviendo o aplicando una medida disciplinaria.</li>
                    <li>Organizar, coordinar y supervisar la gestión a nivel interno, de la totalidad de los litigios institucionales, tanto a nivel de tribunales como de otros organismos de la administración del Estado.</li>
                    <li>Una vez iniciado un proceso disciplinario, citar a cada fiscal designado a una primera reunión de inducción, con el objeto de dar los insumos y capacitación necesaria para desempeñar su función investigadora.</li>
                    <li>Supervisar la tramitación de los procedimientos disciplinarios por parte de los fiscales, quienes deben realizar reportes periódicos del avance del proceso, manteniendo una comunicación eficaz y fluida con la coordinadora.</li>
                    <li>Apoyar a los fiscales en su labor, proporcionándoles información sobre la normativa legal vigente, dictámenes de Contraloría General de la República, y orientación clara y precisa sobre las etapas del proceso disciplinario.</li>
                    <li>Revisar los expedientes entregados por los fiscales al término de su labor, emitiendo un Informe en Derecho en el cual se comunique al Director Jurídico las sugerencias respecto al resultado de la investigación, dando curso progresivo al proceso disciplinario.</li>
                    <li>Presidir la Comisión Interna contemplada en el Protocolo de Acoso Sexual y de discriminación, la cual tiene por objeto:
                        <ul style="margin-left: 20px; margin-top: 10px; list-style-type: circle;">
                            <li>Apoyar a los fiscales encargados de investigar denuncias sobre estos temas en la Universidad, tanto en el análisis del caso como también en la adopción de medidas preventivas.</li>
                            <li>Implementar medidas preventivas de acoso y discriminación a través de charlas y capacitaciones a funcionarios y estudiantes.</li>
                            <li>Implementar talleres de capacitación a fiscales para realizar su labor investigativa, impartidos por profesionales expertos en la materia (PDI, CAVAS).</li>
                        </ul>
                    </li>
                    <li>Mantener una base de datos informática que contenga la información completa sobre los procedimientos disciplinarios tramitados en Fiscalía, para fines de control y entrega de información cuando corresponda, especialmente para tramitación de juicios, tramitación de renuncias, cancelación de pólizas, entrega de cargos directivos, y entrega de medallas, entre otros.</li>
                </ul>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <p><strong>Manual de procedimientos disciplinarios:</strong> <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/8310-2021_manual_de_procedimientos_disciplinarios.pdf" target="_blank" style="color: #EA7600;">Hacer clic acá</a></p>
                
                <p>Descarga el formulario de Denuncia por Acoso Laboral o Violencia en el trabajo (llenar y enviar al correo <a href="mailto:denuncia.acosolaboral@usach.cl" style="color: #00A499;">denuncia.acosolaboral@usach.cl</a>)</p>

                <p><strong>Formulario de denuncia en materia de acoso laboral:</strong> <a href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fsecretaria.usach.cl%2Fsites%2Fsecretaria%2Ffiles%2Fpaginas%2Fformulario_de_denuncia_acoso_laboral_de_la_universidad_de_santiago_de_chile_0.docx&wdOrigin=BROWSELINK" target="_blank" style="color: #EA7600;">Hacer clic acá</a></p>
                
                <p><strong>Agenda de Atención Psicojurídica:</strong> <a href="https://calendar.app.google/tNNLF3zTSJzdDFGE7" target="_blank" style="color: #00A499;">Agendar aquí</a></p>
                
                <p style="margin-top: 30px; font-size: 0.9em; color: #666;">Cualquier otra denuncia puede ser enviada a través del Sistema de Trazabilidad Documental (STD), a la Unidad de Procedimientos Disciplinarios, perteneciente a la Dirección de Promoción del Cumplimiento o al correo: <a href="mailto:upd@usach.cl" style="color: #00A499;">upd@usach.cl</a></p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>

<hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

<section class="quick-links-container">
    <?php 
    $mis_botones = new WP_Query(array('post_type' => 'boton_home', 'posts_per_page' => -1, 'order' => 'ASC'));
    if ($mis_botones->have_posts()) : while ($mis_botones->have_posts()) : $mis_botones->the_post(); 
        $enlace = get_field('enlace_boton');
        $icono  = get_field('icono_boton');
    ?>
        <a href="<?php echo esc_url($enlace); ?>" class="quick-link-item">
            <div class="icon-wrapper">
                <div class="bg-icon"></div> 
                <?php if($icono): ?><img src="<?php echo esc_url($icono); ?>" alt="Icono"><?php else: ?><img src="<?php echo get_template_directory_uri(); ?>/images/workspace_premium_37dp_00A499_FILL0_wght400_GRAD0_opsz40 1.png" alt="Icono"><?php endif; ?>
            </div>
            <h3><?php the_title(); ?></h3>
        </a>
    <?php endwhile; wp_reset_postdata(); endif; ?>
</section>

<?php get_footer(); ?>