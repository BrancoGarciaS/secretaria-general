<?php 
/*
 * Template Name: Preguntas Frecuentes (FAQ)
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
                // Si el usuario edita la página, muestra su contenido
                the_content(); 
            } else {
                // CONTENIDO POR DEFECTO (HTML ORIGINAL MEJORADO)
                ?>
                
                <h3 class="qs-subtitle text-teal">a) ¿Dónde está ubicada la Secretaría General?</h3>
                <p>La Secretaría General se encuentra ubicada en la oficina 309, tercer piso de la Casa Central. Su dirección es Avenida Libertador Bernardo O´higgins N° 3363, comuna de Estación Central. Región Metropolitana.</p>
                
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

                <h3 class="qs-subtitle text-teal">b) ¿Dónde está ubicada la Unidad de Títulos y Grados?</h3>
                <p>La Unidad de Títulos y Grados está ubicada en la calle Ruiz Tagle 140, comuna de Estación Central. Su horario de atención es de lunes a viernes de 9.00 a 13.00 hrs.</p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

                <h3 class="qs-subtitle text-teal">c) ¿Cómo puedo obtener una reunión con la Secretaria General?</h3>
                <p>La solicitud de reunión se debe realizar a través de la plataforma de Lobby en el siguiente link: <a href="https://www.leylobby.gob.cl/admin/auth/prelogin?redirect_int=https://www.leylobby.gob.cl/" target="_blank" style="color: #EA7600; font-weight: bold;">Plataforma Ley de Lobby</a></p>

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