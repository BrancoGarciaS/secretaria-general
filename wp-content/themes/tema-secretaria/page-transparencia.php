<?php 
/*
 * Template Name: Ley de Transparencia
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
                <p>De acuerdo a la Ley 20.285 sobre Acceso a la Información Pública, todas las personas tienen derecho a solicitar información a cualquier organismo del Estado...</p>
                
                <p>La Universidad de Santiago de Chile, como institución pública, debe tener a disposición de las personas el sitio web de Transparencia Activa (TA):</p>

                <div class="text-center-spaced">
                    <a href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=UN008" target="_blank" class="transparencia-btn">
                        <div class="transparencia-content">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/folder.png" alt="" class="btn-icon">
                            <div class="btn-text-group">
                                <span class="line-main">TRANSPARENCIA ACTIVA</span>
                                <span class="line-sub">Ley de Transparencia</span>
                            </div>
                        </div>
                    </a>
                </div>

                <p>Además de un link a un formulario de Solicitud de Acceso a la Información Pública (SAIP):</p>

                <div class="text-center-spaced">
                    <a href="https://www.portaltransparencia.cl/PortalPdT/ingreso-sai-v2?idOrg=1086" target="_blank" class="transparencia-btn">
                        <div class="transparencia-content">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/info.png" alt="" class="btn-icon">
                            <div class="btn-text-group">
                                <span class="line-main">SOLICITUD DE INFORMACIÓN</span>
                                <span class="line-sub">Ley de Transparencia</span>
                            </div>
                        </div>
                    </a>
                </div>

                <hr class="separator-line margin-y-40">

                <h3 class="qs-subtitle text-teal">Link de interés</h3>
                <ul class="list-none-spaced">
                    <li class="margin-bottom-10">🔗 <a href="https://www.secretaria.usach.cl/instructivo-para-solicitar-una-informacion-publica" target="_blank" class="link-teal font-bold">Instructivo para solicitar una información Pública</a></li>
                    <li class="margin-bottom-10">🔗 <a href="https://extranet.consejotransparencia.cl/Web_SCL2/PaginasP/FormularioSR_New.aspx" target="_blank" class="link-teal font-bold">¿Cómo y dónde realizar un reclamo por denegación de acceso a la información?</a></li>
                </ul>

                <h3 class="qs-subtitle text-teal margin-top-30">Descargas</h3>
                <ul class="list-none-spaced">
                    <li class="margin-bottom-10">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/transparencia-en-3-pasos.pdf" target="_blank" class="link-orange font-bold">Transparencia en 3 pasos</a></li>
                    <li class="margin-bottom-10">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/procedimiento_saip_usach.pdf" target="_blank" class="link-orange font-bold">Procedimiento SAIP USACH</a></li>
                </ul>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>