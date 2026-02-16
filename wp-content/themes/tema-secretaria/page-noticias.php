<?php 
/*
 * Template Name: Página de Noticias
 */
get_header(); 
?>

<section class="section-title-bar" style="margin-top: 40px;">
    <h2>TODAS LAS NOTICIAS</h2>
</section>

<section class="news-section">
    <div class="news-grid">
        <?php
        // 1. Consulta para traer TODAS las noticias
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,    // -1 muestra todo (sin paginación)
            'order'          => 'DESC', // De la más nueva a la más vieja
            'orderby'        => 'date'
        );
        
        $todas_noticias = new WP_Query($args);

        if ($todas_noticias->have_posts()) : 
            while ($todas_noticias->have_posts()) : $todas_noticias->the_post(); 
        ?>
            <article class="news-card">
                <div class="news-image-placeholder" style="overflow:hidden;">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', ['style' => 'width:100%; height:100%; object-fit:cover;']);
                    } ?>
                </div>
                
                <h3 class="news-title"><?php the_title(); ?></h3>
                
                <div class="news-summary">
                    <?php 
                    // Misma lógica inteligente que pusimos antes: Resumen manual o automático
                    if ( has_excerpt() ) {
                        the_excerpt(); 
                    } else {
                        echo wp_trim_words( get_the_content(), 20, '...' );
                    }
                    ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="btn-read-more">Seguir Leyendo</a>
            </article>

        <?php 
            endwhile; 
            wp_reset_postdata(); 
        else : 
        ?>
            <p style="text-align:center; width:100%;">No hay noticias para mostrar.</p>
        <?php endif; ?>
    </div>
</section>

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