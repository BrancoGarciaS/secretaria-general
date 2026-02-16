<?php 
/*
 * Template Name: Ley de Transparencia
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
                <p>De acuerdo a la Ley 20.285 sobre Acceso a la Información Pública, todas las personas tienen derecho a solicitar información a cualquier organismo del Estado, existiendo, además, un organismo como el Consejo para la Transparencia que vela por el derecho ciudadano, estableciendo las formas y los tiempos de respuesta de la solicitudes de información, como así también exigir y regular las publicaciones que cada entidad debe tener en sus sitios electrónicos (Transparencia Activa), preparados para dicho ejercicio.</p>
                
                <p>La Universidad de Santiago de Chile, como institución pública, debe tener a disposición de las personas el sitio web de Transparencia Activa (TA):</p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=UN008" target="_blank" class="transparencia-btn">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/folder.png" alt="Icono Carpeta" class="btn-icon">
                        <div class="btn-text-group">
                            <span class="line-main">TRANSPARENCIA ACTIVA</span>
                            <span class="line-sub">Ley de Transparencia</span>
                        </div>
                    </a>
                </div>

                <p>Además de un link a un formulario de Solicitud de Acceso a la Información Pública (SAIP):</p>

                <div style="text-align: center; margin: 30px 0;">
                    <a href="https://www.portaltransparencia.cl/PortalPdT/ingreso-sai-v2?idOrg=1086" target="_blank" class="transparencia-btn">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/info.png" alt="Icono Info" class="btn-icon">
                        <div class="btn-text-group">
                            <span class="line-main">SOLICITUD DE INFORMACIÓN</span>
                            <span class="line-sub">Ley de Transparencia</span>
                        </div>
                    </a>
                </div>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 40px 0;">

                <h3 class="qs-subtitle text-teal">Link de interés</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.secretaria.usach.cl/instructivo-para-solicitar-una-informacion-publica" target="_blank" style="color: #00A499; font-weight: 700;">Instructivo para solicitar una información Pública</a></li>
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.secretaria.usach.cl/como-funciona-la-ley-ndeg20285-sobre-acceso-la-informacion-publica" target="_blank" style="color: #00A499; font-weight: 700;">¿Cómo funciona la Ley 20.285 sobre Acceso a la Información Pública?</a></li>
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=UN008" target="_blank" style="color: #00A499; font-weight: 700;">Sitio de Transparencia Activa de la Universidad de Santiago de Chile</a></li>
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.consejotransparencia.cl/" target="_blank" style="color: #00A499; font-weight: 700;">Consejo para la Transparencia</a></li>
                    <li style="margin-bottom: 10px;">🔗 <a href="https://extranet.consejotransparencia.cl/Web_SCL2/PaginasP/FormularioSR_New.aspx" target="_blank" style="color: #00A499; font-weight: 700;">¿Cómo y dónde realizar un reclamo por denegación de acceso a la información?</a></li>
                </ul>

                <h3 class="qs-subtitle text-teal" style="margin-top: 30px;">Descargas</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/transparencia-en-3-pasos.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Transparencia en 3 pasos</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/manual-de-la-ciudadania-para-un-buen-uso-de-la-ley-de-transparencia.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Manual para un buen uso de la Ley de Transparencia</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/procedimiento_saip_usach.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Procedimiento SAIP USACH</a></li>
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