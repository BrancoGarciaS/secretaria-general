<?php get_header(); ?>

    <section class="hero-section">
        <?php 
        $imagen_hero = get_field('imagen_hero'); 
        if( $imagen_hero ): ?>
            <img src="<?php echo esc_url($imagen_hero['url']); ?>" alt="<?php echo esc_attr($imagen_hero['alt']); ?>" class="hero-image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/diapos-inicio-03 1.png" alt="Imagen Principal" class="hero-image">
        <?php endif; ?>
    </section>

    <section class="quick-links-container">
        
        <?php 
        // 1. LA CONSULTA: "Traeme todos los botones que haya creado"
        $mis_botones = new WP_Query(array(
            'post_type'      => 'boton_home', // El nombre que pusimos en functions.php
            'posts_per_page' => -1,           // -1 significa "TODOS" (sin límite)
            'order'          => 'ASC'         // Orden ascendente de creación
        ));

        // 2. EL BUCLE
        if ($mis_botones->have_posts()) : 
            while ($mis_botones->have_posts()) : $mis_botones->the_post(); 
                
                // Obtenemos los campos de ESTE botón específico
                $enlace = get_field('enlace_boton');
                $icono  = get_field('icono_boton');
            ?>

                <a href="<?php echo esc_url($enlace); ?>" class="quick-link-item">
                    <div class="icon-wrapper">
                        <div class="bg-icon"></div> 
                        
                        <?php if($icono): ?>
                            <img src="<?php echo esc_url($icono); ?>" alt="Icono">
                        <?php else: ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/workspace_premium_37dp_00A499_FILL0_wght400_GRAD0_opsz40 1.png" alt="Icono">
                        <?php endif; ?>
                    </div>
                    
                    <h3><?php the_title(); ?></h3>
                </a>

            <?php 
            endwhile; 
            wp_reset_postdata(); // Importante: Limpiar después de usar
        else: 
        ?>
            <p>No hay botones configurados.</p>
        <?php endif; ?>

    </section>

    <section class="news-section">
        <div class="section-title-bar">
            <h2>NOTICIAS</h2>
        </div>
        
        <div class="news-grid">
            <?php
            $mis_noticias = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3 
            ));

            if ($mis_noticias->have_posts()) : 
                while ($mis_noticias->have_posts()) : $mis_noticias->the_post(); 
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
                        // 1. Preguntamos si tiene un resumen manual (Extracto)
                        if ( has_excerpt() ) {
                            the_excerpt(); 
                        } else {
                            // 2. Si no tiene, cortamos el contenido a 20 palabras y agregamos "..."
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
                <p>No hay noticias publicadas aún.</p>
            <?php endif; ?>
        </div>
    </section>

<?php get_footer(); ?>