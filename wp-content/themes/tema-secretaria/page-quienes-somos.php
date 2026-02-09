<?php 
/*
 * Template Name: Quienes Somos
 */
get_header(); 
?>

<div class="qs-layout">
    
    <aside class="qs-sidebar">
        
        <button class="qs-btn active" onclick="openTab(event, 'historia')">Historia</button>
        <button class="qs-btn" onclick="openTab(event, 'mision')">Misión y Visión</button>
        <button class="qs-btn" onclick="openTab(event, 'organigrama')">Organigrama</button>
        <button class="qs-btn" onclick="openTab(event, 'estructura')">Estructura</button>
        
        <div id="submenu-estructura" class="submenu-container">
            <?php 
            $intro_estructura = get_field('tab_estructura'); 
            ?>
            <button class="sub-btn-sidebar active" 
                    onclick="filterStructure('all', this, 'ESTRUCTURA', `<?php echo esc_attr($intro_estructura); ?>`)">
                Todos
            </button>

            <?php 
            $cats_estructura = get_terms(array(
                'taxonomy' => 'categoria_estructura',
                'hide_empty' => true,
                'parent' => 0
            ));
            
            if ( ! empty( $cats_estructura ) && ! is_wp_error( $cats_estructura ) ){
                foreach ( $cats_estructura as $cat ) {
                    $nombre = esc_js($cat->name);
                    $desc = $cat->description ? str_replace(array("\r", "\n"), '', addslashes($cat->description)) : ''; 
                    
                    echo '<button class="sub-btn-sidebar" 
                                  onclick="filterStructure(\'' . $cat->slug . '\', this, \'' . $nombre . '\', \'' . $desc . '\' )">' . $cat->name . '</button>';
                    
                    $hijos = get_terms(array(
                        'taxonomy' => 'categoria_estructura',
                        'parent' => $cat->term_id,
                        'hide_empty' => true
                    ));
                    
                    if(!empty($hijos)) {
                        foreach($hijos as $hijo) {
                            $nombre_hijo = esc_js($hijo->name);
                            $desc_hijo = $hijo->description ? str_replace(array("\r", "\n"), '', addslashes($hijo->description)) : '';
                            
                            echo '<button class="sub-btn-sidebar nivel-3" 
                                          onclick="filterStructure(\'' . $hijo->slug . '\', this, \'' . $nombre_hijo . '\', \'' . $desc_hijo . '\' )">' . $hijo->name . '</button>';

                            $nietos = get_terms(array(
                                'taxonomy' => 'categoria_estructura',
                                'parent' => $hijo->term_id,
                                'hide_empty' => true
                            ));

                            if(!empty($nietos)) {
                                foreach($nietos as $nieto) {
                                    $nombre_nieto = esc_js($nieto->name);
                                    $desc_nieto = $nieto->description ? str_replace(array("\r", "\n"), '', addslashes($nieto->description)) : '';
                                    
                                    echo '<button class="sub-btn-sidebar nivel-4" 
                                                  onclick="filterStructure(\'' . $nieto->slug . '\', this, \'' . $nombre_nieto . '\', \'' . $desc_nieto . '\' )">' . $nieto->name . '</button>';
                                }
                            }
                        }
                    }
                }
            }
            ?>
        </div>

        <button class="qs-btn" onclick="openTab(event, 'equipo')">Equipo de Trabajo</button>
        
        <div id="submenu-equipo" class="submenu-container">
            <?php 
            $intro_equipo = get_field('tab_equipo_intro'); 
            ?>
            <button class="sub-btn-sidebar active" 
                    onclick="filterTeam('all', this, 'SECRETARÍA GENERAL', `<?php echo esc_attr($intro_equipo); ?>`)">
                Todos
            </button>

            <?php 
            $departamentos = get_terms(array(
                'taxonomy' => 'departamento',
                'hide_empty' => true,
                'parent' => 0
            ));
            
            if ( ! empty( $departamentos ) && ! is_wp_error( $departamentos ) ){
                foreach ( $departamentos as $depto ) {
                    $nombre = esc_js($depto->name);
                    $desc = $depto->description ? str_replace(array("\r", "\n"), '', addslashes($depto->description)) : ''; 
                    
                    echo '<button class="sub-btn-sidebar" 
                                  onclick="filterTeam(\'' . $depto->slug . '\', this, \'' . $nombre . '\', \'' . $desc . '\' )">' . $depto->name . '</button>';
                    
                    $hijos = get_terms(array(
                        'taxonomy' => 'departamento',
                        'parent' => $depto->term_id,
                        'hide_empty' => true
                    ));
                    
                    if(!empty($hijos)) {
                        foreach($hijos as $hijo) {
                            $nombre_hijo = esc_js($hijo->name);
                            $desc_hijo = $hijo->description ? str_replace(array("\r", "\n"), '', addslashes($hijo->description)) : '';
                            
                            echo '<button class="sub-btn-sidebar nivel-3" 
                                          onclick="filterTeam(\'' . $hijo->slug . '\', this, \'' . $nombre_hijo . '\', \'' . $desc_hijo . '\' )">' . $hijo->name . '</button>';
                        }
                    }
                }
            }
            ?>
        </div>

    </aside>

    <main class="qs-content-area">
        
        <div class="qs-card">
            
            <div class="close-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/cierre.png" alt="Cerrar"> 
            </div>

            <div id="historia" class="tab-content active-content">
                <div class="qs-text-block"><?php echo get_field('tab_historia'); ?></div>
            </div>

            <div id="mision" class="tab-content">
                <div class="qs-text-block"><?php echo get_field('tab_mision'); ?></div>
            </div>

            <div id="organigrama" class="tab-content">
                <div class="qs-text-block"><?php echo get_field('tab_organigrama'); ?></div>
            </div>

            <div id="estructura" class="tab-content">
                <h2 id="estructura-dynamic-title" class="qs-title uppercase text-teal">ESTRUCTURA</h2>
                <div class="team-intro">
                    <div id="estructura-dynamic-desc" class="qs-text-block">
                        <?php echo get_field('tab_estructura'); ?>
                    </div>
                </div>

                <div class="team-grid">
                    <?php 
                    $estructura_query = new WP_Query(array(
                        'post_type'      => 'area_estructura',
                        'posts_per_page' => -1,
                        'order'          => 'ASC'
                    ));

                    if ($estructura_query->have_posts()) : 
                        while ($estructura_query->have_posts()) : $estructura_query->the_post(); 
                            $rol   = get_field('rol_estructura');
                            $email = get_field('email_estructura');
                            $terms = get_the_terms( get_the_ID(), 'categoria_estructura' );
                            $term_slugs = '';
                            if( $terms && ! is_wp_error( $terms ) ) {
                                foreach( $terms as $term ) {
                                    $term_slugs .= ' ' . $term->slug;
                                }
                            }
                    ?>
                        <div class="team-card filter-item-struct <?php echo $term_slugs; ?>">
                            <div class="photo-frame-wrapper">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/marco.png" class="frame-overlay" alt="marco">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'person-photo')); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/todos.png" class="person-photo" alt="Sin foto">
                                <?php endif; ?>
                            </div>
                            
                            <h4 class="member-name"><?php the_title(); ?></h4>
                            <?php if($rol): ?>
                                <p class="member-role text-teal"><?php echo esc_html($rol); ?></p>
                            <?php endif; ?>
                            <?php if($email): ?>
                                <p class="member-email">
                                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php 
                        endwhile; 
                        wp_reset_postdata(); 
                    else: 
                    ?>
                        <p>No hay roles registrados en Estructura.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div id="equipo" class="tab-content">
                
                <h2 id="equipo-dynamic-title" class="qs-title uppercase text-teal">SECRETARÍA GENERAL</h2>
                
                <div class="team-intro">
                    <div id="equipo-dynamic-desc" class="qs-text-block">
                        <?php echo get_field('tab_equipo_intro'); ?>
                    </div>
                </div>

                <div class="team-grid">
                    <?php 
                    $equipo_query = new WP_Query(array(
                        'post_type'      => 'miembro_equipo',
                        'posts_per_page' => -1,
                        'order'          => 'ASC',
                        'orderby'        => 'date' 
                    ));

                    if ($equipo_query->have_posts()) : 
                        while ($equipo_query->have_posts()) : $equipo_query->the_post(); 
                            // OBTENEMOS LOS CAMPOS: Cargo y ahora el Email
                            $cargo = get_field('cargo_miembro');
                            $email = get_field('email_miembro'); // ¡Nuevo campo!

                            $terms = get_the_terms( get_the_ID(), 'departamento' );
                            $term_slugs = '';
                            if( $terms && ! is_wp_error( $terms ) ) {
                                foreach( $terms as $term ) {
                                    $term_slugs .= ' ' . $term->slug;
                                }
                            }
                    ?>
                        <div class="team-card filter-item <?php echo $term_slugs; ?>">
                            <div class="photo-frame-wrapper">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/marco.png" class="frame-overlay" alt="marco">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'person-photo')); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/todos.png" class="person-photo" alt="Sin foto">
                                <?php endif; ?>
                            </div>
                            
                            <h4 class="member-name"><?php the_title(); ?></h4>
                            
                            <?php if($cargo): ?>
                                <p class="member-role text-teal"><?php echo esc_html($cargo); ?></p>
                            <?php endif; ?>

                            <?php if($email): ?>
                                <p class="member-email">
                                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                </p>
                            <?php endif; ?>

                        </div>
                    <?php 
                        endwhile; 
                        wp_reset_postdata(); 
                    else: 
                    ?>
                        <p>No hay miembros registrados.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div> 
    </main>
</div>

<script>
    // 1. Gestión de Pestañas Principales
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        
        var tablinks = document.getElementsByClassName("qs-btn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        var submenus = document.getElementsByClassName("submenu-container");
        for (i = 0; i < submenus.length; i++) {
            submenus[i].style.display = "none";
        }

        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.classList.add("active");

        var targetSubmenu = document.getElementById("submenu-" + tabName);
        if (targetSubmenu) {
            targetSubmenu.style.display = "flex";
        }
    }

    // 2. Filtro para EQUIPO DE TRABAJO
    function filterTeam(category, btnElement, title, desc) {
        var items = document.getElementsByClassName("filter-item");
        
        if(title) document.getElementById("equipo-dynamic-title").innerHTML = title;
        if(desc)  document.getElementById("equipo-dynamic-desc").innerHTML = desc;

        var container = btnElement.parentNode;
        var btns = container.getElementsByClassName("sub-btn-sidebar");
        for (var i = 0; i < btns.length; i++) {
            btns[i].classList.remove("active");
        }
        btnElement.classList.add("active");

        for (var i = 0; i < items.length; i++) {
            if (category === 'all') {
                items[i].style.display = "flex";
            } else {
                if (items[i].classList.contains(category)) {
                    items[i].style.display = "flex";
                } else {
                    items[i].style.display = "none";
                }
            }
        }
    }

    // 3. Filtro para ESTRUCTURA
    function filterStructure(category, btnElement, title, desc) {
        var items = document.getElementsByClassName("filter-item-struct");
        
        if(title) document.getElementById("estructura-dynamic-title").innerHTML = title;
        if(desc)  document.getElementById("estructura-dynamic-desc").innerHTML = desc;

        var container = btnElement.parentNode;
        var btns = container.getElementsByClassName("sub-btn-sidebar");
        for (var i = 0; i < btns.length; i++) {
            btns[i].classList.remove("active");
        }
        btnElement.classList.add("active");

        for (var i = 0; i < items.length; i++) {
            if (category === 'all') {
                items[i].style.display = "flex";
            } else {
                if (items[i].classList.contains(category)) {
                    items[i].style.display = "flex";
                } else {
                    items[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php get_footer(); ?>