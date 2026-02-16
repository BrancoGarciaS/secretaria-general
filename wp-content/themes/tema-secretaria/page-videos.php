<?php 
/*
 * Template Name: Página de Videos
 */
get_header(); 
?>

<section class="section-title-bar" style="margin-top: 40px;">
    <h2>GALERÍA DE VIDEOS</h2>
</section>

<section class="videos-section">
    <div class="videos-grid">
        <?php
        // Consulta para traer TODOS los videos (-1)
        $args = array(
            'post_type'      => 'video_destacado',
            'posts_per_page' => -1,    
            'order'          => 'DESC', 
            'orderby'        => 'date'
        );
        
        $todos_videos = new WP_Query($args);

        if ($todos_videos->have_posts()) : 
            while ($todos_videos->have_posts()) : $todos_videos->the_post(); 
                
                $url_video = get_field('link_video_youtube');
                $video_id = obtener_id_youtube($url_video);
                
                if($video_id) {
                    $thumbnail = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
                } else {
                    $thumbnail = get_template_directory_uri() . '/images/video-placeholder.png'; 
                }
        ?>
            <div class="video-item">
                <a href="<?php echo esc_url($url_video); ?>" target="_blank" rel="noopener noreferrer">
                    
                    <h3 class="video-title" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </h3>

                    <div class="video-thumbnail-wrapper">
                        <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title(); ?>" class="video-thumb">
                        <div class="play-icon">▶</div>
                    </div>
                    
                </a>
            </div>

        <?php 
            endwhile; 
            wp_reset_postdata(); 
        else : 
        ?>
            <p style="text-align:center; width:100%;">No hay videos para mostrar.</p>
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