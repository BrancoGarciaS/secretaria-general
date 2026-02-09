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

<?php get_footer(); ?>