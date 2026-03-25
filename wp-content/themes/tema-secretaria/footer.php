<?php
// --- DETECCIÓN AUTOMÁTICA DEL ID CONFIGURACIÓN ---
$pagina_config = get_page_by_path('configuracion-footer'); 
$footer_id = $pagina_config ? $pagina_config->ID : false;

// --- DETECTAR PÁGINA ACTUAL (Para marcar activo) ---
// Obtenemos la URL de la página que el usuario está viendo ahora mismo
$url_actual = get_permalink( get_queried_object_id() );
?>

    <?php 
    // CONDICIONAL: Solo mostrar esto si NO (!) es la página frontal
    if ( ! is_front_page() ) : 
    ?>
        <hr class="separator-line">

        <section class="quick-links-container">
            <?php 
            $mis_botones = new WP_Query(array('post_type' => 'boton_home', 'posts_per_page' => -1, 'order' => 'ASC'));
            
            if ($mis_botones->have_posts()) : while ($mis_botones->have_posts()) : $mis_botones->the_post(); 
                $enlace = get_field('enlace_boton');
                $icono  = get_field('icono_boton');
                
                // LÓGICA DE COMPARACIÓN:
                // Limpiamos las barras finales '/' para evitar errores de coincidencia (ej: /contacto/ vs /contacto)
                $es_activo = (untrailingslashit($enlace) === untrailingslashit($url_actual));
                
                // Si coinciden, agregamos la clase 'active'
                $clase_extra = $es_activo ? ' active' : '';
            ?>
                <a href="<?php echo esc_url($enlace); ?>" class="quick-link-item<?php echo $clase_extra; ?>">
                    <div class="icon-wrapper">
                        <div class="bg-icon"></div> 
                        <?php if($icono): ?><img src="<?php echo esc_url($icono); ?>" alt="Icono"><?php else: ?><img src="<?php echo get_template_directory_uri(); ?>/images/workspace_premium_37dp_00A499_FILL0_wght400_GRAD0_opsz40 1.png" alt="Icono"><?php endif; ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                </a>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </section>
    <?php 
    endif; // Fin del condicional
    ?>

    <footer class="site-footer">
        <div class="footer-container">
            
            <div class="footer-logo">
                <?php 
                $logo_custom = get_field('logo_footer', $footer_id);
                if( $logo_custom ) {
                    echo '<img src="' . esc_url($logo_custom['url']) . '" alt="' . esc_attr($logo_custom['alt']) . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images/Recurso 8 1.png" alt="Logo Universidad">';
                }
                ?>
            </div>
            
            <div class="footer-info">
                <h3><?php echo get_field('titulo_footer', $footer_id) ?: 'Secretaría General'; ?></h3>
                <p>Teléfono: <?php echo get_field('telefono_footer', $footer_id) ?: '56-2-27180104'; ?></p>
                <p><?php echo get_field('nombre_universidad_footer', $footer_id) ?: 'Universidad de Santiago de Chile'; ?></p>
                <p><?php echo get_field('direccion_footer', $footer_id) ?: "Avenida Libertador Bernardo O'Higgins 3363 | Estación Central | Santiago | Chile"; ?></p>
                <p><?php echo get_field('unidad_footer', $footer_id) ?: 'Unidad de Partes, Informaciones y Archivo'; ?></p>
            </div>

            <div class="footer-partner">
                <?php 
                $partner_custom = get_field('logo_partner_footer', $footer_id);
                if( $partner_custom ) {
                    echo '<img src="' . esc_url($partner_custom['url']) . '" alt="' . esc_attr($partner_custom['alt']) . '">';
                } else {
                    echo '<img src="' . get_template_directory_uri() . '/images/footer_logo_dei.png" alt="Logo Segic">';
                }
                ?>
            </div>
            
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>