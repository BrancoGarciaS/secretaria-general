<?php 
/*
 * Template Name: Junta Directiva
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
                <p>La Junta Directiva es la máxima autoridad colegiada y su principal rol es supervisar y aprobar la política global de desarrollo de la Universidad de Santiago de Chile, sus planes de mediano y largo plazo, la estructura orgánica de la institución y sus modificaciones; la creación y modificación de grados académicos y títulos profesionales; el presupuesto anual de la Corporación; y el nombramiento de los directivos superiores, entre otras materias.</p>
                
                <h3 class="qs-subtitle text-teal" style="margin-top: 30px; margin-bottom: 20px;">Integran la Junta Directiva:</h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px;">
                    
                    <div>
                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Presidente</h4>
                        <p style="margin-bottom: 15px;">Sr. Gonzalo Salgado Barros</p>

                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Rector</h4>
                        <p style="margin-bottom: 15px;">Dr. Rodrigo Alejandro Vidal Rojas</p>

                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Secretario de la Junta Directiva</h4>
                        <p>Sr. Eduardo Enrique Pérez Contreras</p>
                    </div>

                    <div>
                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 10px;">Directores(as)</h4>
                        <ul style="margin-left: 20px; list-style-type: disc;">
                            <li>Dra. María Jesús Aguirre Quintana</li>
                            <li>Sr. Víctor Alexis Salas Opazo</li>
                            <li>Dr. Gonzalo Javier Gutiérrez Gallardo</li>
                            <li>Dra. Roxana Antonina Cristal Pey Tumanoff</li>
                            <li>Dra. Soledad del Carmen Ramírez Gatica</li>
                        </ul>
                    </div>

                </div>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Documentos y Actas</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.secretaria.usach.cl/actas-de-la-junta-directiva" target="_blank" style="color: #00A499; font-weight: 700;">Actas de la Junta Directiva - Haga clic acá</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/nombramiento_integrantes_junta_directiva.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Nombramiento directores internos - Haga clic acá</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/decreto_supremo_153_de_2022.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Nombramiento directores externos - Haga clic acá</a></li>
                </ul>
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