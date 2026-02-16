<?php 
/*
 * Template Name: Lobby USACH
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
                <p>El 8 de marzo de 2014, se publicó la Ley 20.730, que regula el lobby y las gestiones que representen intereses particulares ante las autoridades y funcionarios, constituyéndose en un gran avance para suministrar a la actividad pública herramientas que hagan más transparente su ejercicio.</p>
                
                <p>La entrada en vigencia de esta ley representa un profundo cambio en la relación entre el Estado y las personas, estableciendo como deber de las autoridades y los funcionarios públicos (que tengan la calidad de “sujetos pasivos”), el registrar y dar publicidad a:</p>
                
                <ul style="margin-left: 20px; list-style-type: disc;">
                    <li>Las <strong>reuniones</strong> y audiencias solicitadas por lobbistas y gestores de intereses particulares que tengan como finalidad influir en una decisión pública.</li>
                    <li>Los <strong>viajes</strong> que realicen en el ejercicio de sus funciones.</li>
                    <li>Los <strong>regalos</strong> que reciban en cuanto autoridad o funcionario.</li>
                </ul>
                
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Accesos Directos</h3>
                <ul style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 15px;">🔗 <a href="http://www.leylobby.gob.cl/instituciones/UN008" target="_blank" style="color: #00A499; font-weight: 700;">Para revisar aquellas reuniones de los sujetos pasivos de la Universidad haga clic acá</a></li>
                    <li style="margin-bottom: 15px;">🔗 <a href="https://www.leylobby.gob.cl/instituciones/UN008" target="_blank" style="color: #00A499; font-weight: 700;">Si requiere una reunión con una de las autoridades señaladas haga clic acá</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="http://www.leylobby.gob.cl/files/manual_ciudadano%20ley_lobby.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Si desea ver o descargar el manual ciudadano de Lobby haga clic acá</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="http://www.leylobby.gob.cl/files/manual_juridico%20ley_lobby.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Para acceder y descargar el manual jurídico de Lobby haga clic acá</a></li>
                    <li style="margin-bottom: 15px;">📄 <a href="https://drive.google.com/file/d/1I5zI5ZvEHZ-61bPoZ1Hau4L8kRcQONRR/view?usp=drive_link" target="_blank" style="color: #EA7600; font-weight: 700;">Para acceder a la Resolución Exenta N° 5823, de 20 de octubre de 2025, del Rector de la Universidad de Santiago de Chile, que Aprueba Nómina que individualiza a sujetos pasivos de Lobby y/o de gestión de intereses particulares de esta Universidad, en concordancia con la Ley N° 20.730, haga clic acá </a></li>
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