<?php 
/*
 * Template Name: Convoca Elecciones
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
                <p>El jueves 8 de agosto se llevarán a cabo elecciones en la Universidad de Santiago de Chile, entre ellas, la que busca elegir a un integrante no académico, representante del personal profesional y técnico para conformar el <strong>Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad</strong>.</p>
                
                <p>Es importante señalar que este comité estará integrado por un o una representante del personal académico, un o una representante del profesorado por hora de clases, un o una representante del personal profesional y técnico y dos representantes estudiantiles.</p>

                <p>El Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad es un órgano consultivo de la Vicerrectoría y tiene como principal objetivo asesorar y/o proponer acciones en temas y/o aspectos que incidan en la calidad de vida de las personas que conforman la comunidad de la Universidad de Santiago de Chile, aportando distintas miradas acerca de la promoción, desarrollo y mantención de su bienestar, velando por sus derechos y promoviendo la equidad.</p>

                <h3 class="qs-subtitle text-teal" style="margin-top: 30px;">Otros procesos eleccionarios del día:</h3>
                Otro proceso que se desarrollará el mismo día, será la elección de <strong>Decano o Decana de la Facultad de Química y Biología.</strong>

                Los otros procesos que también tendrán lugar el jueves 8 de agosto son:
                <ul style="margin-left: 20px; margin-bottom: 20px; list-style-type: disc;">
                    <li>Consejero o Consejera Departamento de Gestión Agraria.</li>
                    <li>Director o Directora del Instituto de Estudios Avanzados.</li>
                    <li>Representante del Estamento Administrativo ante el Consejo de la Facultad de Ingeniería.</li>
                </ul>

                <div style="text-align: center; margin: 30px 0;">
                    <p style="font-size: 1.2em; font-weight: 700;">Para votar debes ingresar al siguiente link:</p>
                    <a href="https://eleccionesusach.cl/" target="_blank" class="highlight-link">IR A ELECCIONESUSACH.CL</a>
                </div>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Documentos y Descargas</h3>
                <ul style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/padron_electores_vicaviged.pdf" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Padrones de electores para representante del personal profesional y técnico para conformar el Comité Asesor VICAVIGED</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/calendario_elecciones_vicaviged_8_de_agosto_def.pdf" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Calendario del proceso de elecciones 8 de agosto 2024</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formulario_de_inscripcion_de_candidatura_0.docx" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Formulario de inscripción de candidaturas</a></li>
                </ul>

                <div style="background-color: #fff8e1; border-left: 4px solid #EA7600; padding: 15px; margin-top: 20px;">
                    <p>A partir de lo informado en el calendario, el período para impugnar dichas candidaturas finaliza el miércoles 31 de julio 2024. En este caso, los antecedentes deben ser enviados a <a href="mailto:impugnacioneselectorales@usach.cl" style="color: #EA7600;">impugnacioneselectorales@usach.cl</a> junto con señalar los requisitos que se verían eventualmente incumplidos.</p>
                    <p>Se recuerda que quienes los candidatos y candidatas deben cumplir con los siguientes requisitos: Ser funcionarios no académicos y funcionarias no académicas que tengan un nombramiento vigente en propiedad o en la contrata asimilado a planta profesional o técnica, que cuenten con una antigüedad interrumpida de dos años en la Universidad, en esta calidad, al 19 de julio de 2024.</p>
                </div>

                <p style="margin-top: 20px;">
                    <strong>Las candidaturas del Comité Asesor para VICAVIGED pueden ser conocidas aquí:</strong> <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/candidatos_elecciones_vicaviged_8_de_agosto.xlsx" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Candidatos a elecciones Comité Asesor de VICAVIGED de las plantas profesionales y técnicos</a>
                </p>
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