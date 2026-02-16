<?php 
/*
 * Template Name: Consejo de Distinciones
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
            // LOGICA HÍBRIDA INTELIGENTE
            
            // 1. Verificamos si el usuario escribió algo en el editor
            if ( get_the_content() ) {
                
                // CASO A: El usuario escribió -> Mostramos SU contenido
                the_content(); 
                
            } else {
                
                // CASO B: El editor está vacío -> Mostramos el HTML POR DEFECTO
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