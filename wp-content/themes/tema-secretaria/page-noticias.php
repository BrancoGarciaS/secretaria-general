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

<?php get_footer(); ?>