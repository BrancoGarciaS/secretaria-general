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

<?php get_footer(); ?>