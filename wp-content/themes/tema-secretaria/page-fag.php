<?php 
/*
 * Template Name: Preguntas Frecuentes (FAQ)
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
                <h3 class="qs-subtitle text-teal">a) ¿Dónde está ubicada la Secretaría General?</h3>
                <p>La Secretaría General se encuentra ubicada en la oficina 309, tercer piso de la Casa Central. Su dirección es Avenida Libertador Bernardo O´higgins N° 3363, comuna de Estación Central. Región Metropolitana.</p>
                
                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">b) ¿Dónde está ubicada la Unidad de Títulos y Grados?</h3>
                <p>La Unidad de Títulos y Grados está ubicada en la calle Ruiz Tagle 140, comuna de Estación Central. Su horario de atención es de lunes a viernes de 9.00 a 13.00 hrs.</p>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">c) ¿Cómo puedo obtener una reunión con la Secretaria General?</h3>
                <p>La solicitud de reunión se debe realizar a través de la plataforma de Lobby en el siguiente link: <a href="https://www.leylobby.gob.cl/admin/auth/prelogin?redirect_int=https://www.leylobby.gob.cl/" target="_blank" class="link-orange font-bold">Plataforma Ley de Lobby</a></p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>



<?php get_footer(); ?>