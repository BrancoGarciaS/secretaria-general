<?php 
/*
 * Template Name: Página de Noticias
 */
get_header(); 
?>

<section class="section-title-bar">
    <h2>TODAS LAS NOTICIAS</h2>
</section>

<section class="news-section">
    <div class="news-grid">
        <?php
        // Obtener el número de página actual (solo para desktop)
        $paged = max(1, get_query_var('paged'));
        
        // IMPORTANTE: Cargar TODAS las noticias sin limitación
        // La paginación se mostrará/ocultará automáticamente según sea necesario
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,    // -1 = cargar TODAS
            'order'          => 'DESC', 
            'orderby'        => 'date'
        );
        
        $todas_noticias = new WP_Query($args);

        if ($todas_noticias->have_posts()) : 
            while ($todas_noticias->have_posts()) : $todas_noticias->the_post(); 
        ?>
            <article class="news-card">
                <div class="news-image-placeholder">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium', ['class' => 'img-cover-card']);
                    } ?>
                </div>
                
                <h3 class="news-title"><?php the_title(); ?></h3>
                
                <div class="news-summary">
                    <?php 
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
            
            // ===== PAGINACIÓN (Manejada por JavaScript en Desktop) =====
            if ($todas_noticias->found_posts > 6) :
                ?>
                <div class="news-pagination" id="news-pagination">
                    <button class="pagination-btn pagination-prev" id="prev-page" aria-label="Página anterior">
                        <span class="pagination-arrow">←</span>
                    </button>
                    <div id="pagination-numbers"></div>
                    <button class="pagination-btn pagination-next" id="next-page" aria-label="Página siguiente">
                        <span class="pagination-arrow">→</span>
                    </button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const newsCards = Array.from(document.querySelectorAll('.news-card'));
                    const pagination = document.getElementById('news-pagination');
                    const paginationNumbers = document.getElementById('pagination-numbers');
                    const prevBtn = document.getElementById('prev-page');
                    const nextBtn = document.getElementById('next-page');
                    
                    if (!pagination || newsCards.length <= 6) return;
                    
                    const itemsPerPage = 6;
                    const totalPages = Math.ceil(newsCards.length / itemsPerPage);
                    let currentPage = 1;
                    
                    // Crear números de página
                    for (let i = 1; i <= totalPages; i++) {
                        const pageNum = document.createElement('span');
                        pageNum.className = 'pagination-num';
                        if (i === 1) pageNum.classList.add('pagination-current');
                        pageNum.textContent = i;
                        pageNum.setAttribute('aria-current', i === 1 ? 'page' : 'false');
                        pageNum.setAttribute('aria-label', 'Ir a la página ' + i);
                        pageNum.style.cursor = 'pointer';
                        pageNum.onclick = () => {
                            if (window.innerWidth > 1024) goToPage(i);
                        };
                        paginationNumbers.appendChild(pageNum);
                    }
                    
                    // Función que construye la vista según el dispositivo
                    function applyResponsivePagination() {
                        const isMobile = window.innerWidth <= 1024;
                        
                        if (isMobile) {
                            // En móvil: Ocultamos los botones y mostramos TODAS las tarjetas
                            pagination.style.display = 'none';
                            newsCards.forEach(card => card.style.display = 'flex');
                        } else {
                            // En PC: Mostramos los botones y aplicamos la página actual
                            pagination.style.display = 'flex'; // o block, según tu css
                            showPage(currentPage, false); 
                        }
                    }

                    function showPage(page, doScroll = true) {
                        currentPage = Math.max(1, Math.min(page, totalPages));
                        const start = (currentPage - 1) * itemsPerPage;
                        const end = start + itemsPerPage;
                        
                        newsCards.forEach((card, idx) => {
                            card.style.display = idx >= start && idx < end ? 'flex' : 'none';
                        });
                        
                        // Actualizar números
                        document.querySelectorAll('.pagination-num').forEach((num, idx) => {
                            if (idx + 1 === currentPage) {
                                num.classList.add('pagination-current');
                                num.setAttribute('aria-current', 'page');
                            } else {
                                num.classList.remove('pagination-current');
                                num.setAttribute('aria-current', 'false');
                            }
                        });
                        
                        // Actualizar botones
                        prevBtn.disabled = currentPage === 1;
                        nextBtn.disabled = currentPage === totalPages;
                        prevBtn.classList.toggle('pagination-disabled', currentPage === 1);
                        nextBtn.classList.toggle('pagination-disabled', currentPage === totalPages);
                        
                        // Scroll suave hacia arriba solo si el usuario hizo clic
                        if(doScroll) {
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    }
                    
                    function goToPage(page) {
                        showPage(page, true);
                    }
                    
                    prevBtn.onclick = () => {
                        if (window.innerWidth > 1024) goToPage(currentPage - 1);
                    };
                    nextBtn.onclick = () => {
                        if (window.innerWidth > 1024) goToPage(currentPage + 1);
                    };
                    
                    // Iniciar la configuración al cargar y al cambiar de tamaño de ventana
                    applyResponsivePagination();
                    window.addEventListener('resize', applyResponsivePagination);
                });
                </script>
                <?php
            endif;
            
            wp_reset_postdata(); 
        else : 
        ?>
            <p class="text-empty">No hay noticias para mostrar.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>