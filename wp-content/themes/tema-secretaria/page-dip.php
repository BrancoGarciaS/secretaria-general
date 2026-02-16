<?php 
/*
 * Template Name: Declaración de Intereses y Patrimonio
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
                <p>La Ley 20.880 sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, regula el principio de probidad en el ejercicio de la función pública y la prevención y sanción de conflictos de intereses. El principio de probidad en la función pública consiste en observar una conducta funcionaria intachable, un desempeño honesto y leal de la función o cargo con preeminencia del interés general sobre el particular.</p>
                
                <p>De acuerdo a lo dispuesto en la Ley 20.880, sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, corresponde que todos los meses de marzo debe actualizar, según corresponda, la información contenida en la Declaración de Intereses y Patrimonio.</p>
                
                <p>En la Universidad de Santiago de Chile están obligados a efectuar dicha declaración, y por ende a su actualización, las autoridades y personal de planta y a contrata, que sean directivos, profesionales y técnicos que se desempeñen hasta el tercer nivel jerárquico.</p>
                
                <p>Por normativa interna deberán prestar dicha declaración quienes registran nombramiento o contratación desde el grado 5° o superior de la Escala de Remuneraciones Usach, independiente que sean o no jefaturas.</p>
                
                <p>Además, deberán realizar esta declaración aquellas personas que se desempeñen como directivos, sin importar su grado, y también aquellas contratadas a honorarios por un monto bruto mensual superior a <strong>$2.815.631</strong>, y cuyo contrato sea por el plazo mínimo de un año.</p>
                
                <p>También deberán realizar esta declaración aquellas personas que sirvan en más de un empleo y que la suma de sus remuneraciones y/o honorarios alcancen el monto señalado en el párrafo anterior.</p>
                
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Documentos y Enlaces</h3>
                <ul style="margin-left: 20px; margin-bottom: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/instructivo_dip_2023_paso_a_paso.pdf" target="_blank" style="color: #EA7600; font-weight: bold;">Presione aquí para conocer el instructivo, de cómo realizar la declaración de Intereses y Patrimonio</a></li>
                    <li style="margin-bottom: 10px;">📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/manual_dip_2023.pdf" target="_blank" style="color: #EA7600; font-weight: bold;">Presione aquí para conocer el manual de procedimiento de Declaraciones de Intereses y Patrimonio</a></li>
                </ul>

                <div style="text-align: center; margin: 30px 0;">
                    <p style="font-weight: 700; margin-bottom: 10px;">Para realizar su declaración acceda al siguiente link:</p>
                    <a href="https://www.declaracionjurada.cl/dip/" target="_blank" class="highlight-link">IR A DECLARACIONJURADA.CL</a>
                </div>

                <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #00A499; margin-bottom: 20px;">
                    <p>De acuerdo con lo establecido en dicha ley, existe un plazo que vence el <strong>31 de marzo de cada año</strong>, para efectuar las actualizaciones de dichas declaraciones.</p>
                    <p style="margin-top: 10px;"><strong>Contacto:</strong> Unidad de Probidad y Transparencia<br>
                    <p>Para cualquier duda o consulta se puede comunicar con la Unidad de Probidad y Transparencia al IP: 80105 o a su correo electrónico: dip@usach.cl</p>
                    <strong>IP:</strong> 80105<br>
                    <strong>Correo:</strong> <a href="mailto:dip@usach.cl" style="color: #00A499;">dip@usach.cl</a></p>
                </div>

                <h3 class="qs-subtitle text-teal">Infografías de ayuda</h3>
                <div class="infografia-grid">
                    <div class="infografia-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/screenshot_20230330_193316_com.instagram.android_1_0.jpg" alt="Infografía 1">
                    </div>
                    <div class="infografia-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/dip-2024-como-realizar-la-declaracion_-734x1024.png" alt="Infografía 2">
                    </div>
                </div>
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