<?php 
/*
 * Template Name: Consejo de Distinciones
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
                <p>La Universidad de Santiago de Chile cuenta con un Consejo de Distinciones, órgano de carácter consultivo creado en 1989 mediante un reglamento, e integrado por académicos de las más altas jerarquías del Plantel y que representan las distintas áreas del conocimiento institucional. La Secretaria General, Sandra Barrera de Proença, se desempeña como Presidenta.</p>
                
                <p>Los integrantes de este consejo son:</p>
                
                <ul>
                    <li><strong>Marcelo Díaz Soto</strong>, de la Facultad de Humanidades;</li>
                    <li><strong>Raúl Berrios Espinoza</strong>, de la Facultad de Administración y Economía;</li>
                    <li><strong>Leonora Mendoza Espínola</strong>, de la Facultad de Química Biología;</li>
                    <li><strong>María José Galotto López</strong>, de la Facultad Tecnológica.</li>
                </ul>

                <p>Entre sus tareas, el Consejo de Distinciones debe sugerir, recomendar e informar al Rector u otras autoridades superiores respecto de decisiones de reconocimientos a personas, así como sobre propuestas para identificar lugares de la Universidad con nombres de miembros de la comunidad que hayan destacado por su trayectoria, con el propósito de proyectar su sello de Universidad Estatal y Pública, fortaleciendo la vinculación con la comunidad y reconociendo sus aportes, que contribuyen al desarrollo de nuestro país.</p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>