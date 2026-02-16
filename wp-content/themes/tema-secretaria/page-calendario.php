<?php 
/*
 * Template Name: Calendario Académico
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
                <h3 class="qs-subtitle text-teal">Descarga de Calendarios</h3>
                
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    
                    <li style="margin-bottom: 15px;">
                        📥 <a href="http://file///D:/Usach/Desktop/calendario_academico_2025_v3.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2025 (Resolución 10200 del 16 de diciembre de 2024)</a>
                    </li>

                    <li style="margin-bottom: 15px;">
                        📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/f_rex_11012_2023_fija_calendario_de_actividades_universitarias_para_el_a_o_2024_.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2024 (Resolución 11012 del 29 de diciembre 2023)</a>
                    </li>

                    <li style="margin-bottom: 15px;">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/5121-2023.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario modificado 2023 (Resolución 5121 del 29 de junio de 2023)</a>
                    </li>

                    <li style="margin-bottom: 15px;">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/2613-2023.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario modificado 2023 (Resolución 2613 del 5 de mayo 2023)</a>
                    </li>

                    <li style="margin-bottom: 15px;">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/11770-2022.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2023 (Resolución 11770 del 14 de diciembre 2022)</a>
                    </li>

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