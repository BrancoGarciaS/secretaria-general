<?php get_header(); ?>

<main class="single-news-container">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
            
            <header class="article-header">
                
                <h1 class="article-title"><?php the_title(); ?></h1>
                
                <div class="article-meta">
                    Publicado el <?php the_time('m/d/Y - H:i'); ?>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="article-featured-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <?php if ( has_excerpt() ) : ?>
                <div class="article-excerpt-wrapper">
                    <h3 class="excerpt-label">Resumen:</h3>
                    <div class="article-lead">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="article-content qs-text-block"> 
                <?php the_content(); ?>
            </div>

        </article>

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