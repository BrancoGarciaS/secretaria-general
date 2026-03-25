<?php 
/*
 * Template Name: Calendario Académico
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
                <h3 class="qs-subtitle text-teal">Descarga de Calendarios</h3>
                
                <ul class="download-list list-none-spaced">
                    
                    <li class="list-item-spaced">
                        📥 <a href="http://file///D:/Usach/Desktop/calendario_academico_2025_v3.pdf" target="_blank" class="link-orange">Calendario Académico 2025 (Resolución 10200 del 16 de diciembre de 2024)</a>
                    </li>

                    <li class="list-item-spaced">
                        📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/f_rex_11012_2023_fija_calendario_de_actividades_universitarias_para_el_a_o_2024_.pdf" target="_blank" class="link-orange">Calendario Académico 2024 (Resolución 11012 del 29 de diciembre 2023)</a>
                    </li>

                    <li class="list-item-spaced">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/5121-2023.pdf" target="_blank" class="link-orange">Calendario modificado 2023 (Resolución 5121 del 29 de junio de 2023)</a>
                    </li>

                    <li class="list-item-spaced">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/2613-2023.pdf" target="_blank" class="link-orange">Calendario modificado 2023 (Resolución 2613 del 5 de mayo 2023)</a>
                    </li>

                    <li class="list-item-spaced">
                        📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/11770-2022.pdf" target="_blank" class="link-orange">Calendario Académico 2023 (Resolución 11770 del 14 de diciembre 2022)</a>
                    </li>

                </ul>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>