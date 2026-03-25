<?php 
/*
 * Template Name: Quienes Somos
 */
get_header(); 
?>

<div class="qs-layout">
    
    <aside class="qs-sidebar">
        
        <div class="qs-main-buttons-container">
            <button class="qs-btn active" onclick="openTab(event, 'historia')">
                <?php echo get_field('titulo_btn_historia') ?: 'Historia'; ?>
            </button>

            <button class="qs-btn" onclick="openTab(event, 'mision')">
                <?php echo get_field('titulo_btn_mision') ?: 'Misión y Visión'; ?>
            </button>
            
            <button class="qs-btn" onclick="openTab(event, 'organigrama')">
                <?php echo get_field('titulo_btn_organigrama') ?: 'Organigrama'; ?>
            </button>
            
            <button class="qs-btn" onclick="openTab(event, 'estructura')">
                <?php echo get_field('titulo_btn_estructura') ?: 'Estructura'; ?>
            </button>
            
            <div id="submenu-estructura" class="submenu-container">
                <?php 
                $intro_estructura = get_field('tab_estructura'); 
                $titulo_estructura = get_field('titulo_btn_estructura') ?: 'ESTRUCTURA';
                ?>
                <button class="sub-btn-sidebar nivel-1 active" data-id="all"
                        onclick="toggleSubMenu(this, 'all', 'categoria_estructura', '<?php echo esc_js($titulo_estructura); ?>', `<?php echo esc_attr($intro_estructura); ?>`)">
                    Todos
                </button>

                <?php 
                $cats_estructura = get_terms([
                    'taxonomy' => 'categoria_estructura',
                    'hide_empty' => true,
                    'parent' => 0
                ]);

                if ($cats_estructura && !is_wp_error($cats_estructura)) {
                    foreach ($cats_estructura as $cat) {

                        $nombre = esc_js($cat->name);
                        $desc = $cat->description ? str_replace(["\r","\n"],'',addslashes($cat->description)) : '';

                        echo '<button class="sub-btn-sidebar nivel-1 parent-'.$cat->term_id.'" 
                                data-id="'.$cat->term_id.'"
                                onclick="toggleSubMenu(this, \''.$cat->slug.'\', \'categoria_estructura\', \''.$nombre.'\', \''.$desc.'\')">
                                '.$cat->name.'
                              </button>';

                        $hijos = get_terms([
                            'taxonomy'=>'categoria_estructura',
                            'parent'=>$cat->term_id,
                            'hide_empty'=>true
                        ]);

                        foreach($hijos as $hijo){

                            $nombre_hijo = esc_js($hijo->name);
                            $desc_hijo = $hijo->description ? str_replace(["\r","\n"],'',addslashes($hijo->description)) : '';

                            echo '<button class="sub-btn-sidebar nivel-2 child-of-'.$cat->term_id.' parent-'.$hijo->term_id.'" 
                                    data-id="'.$hijo->term_id.'" 
                                    style="display:none;"
                                    onclick="toggleSubMenu(this, \''.$hijo->slug.'\', \'categoria_estructura\', \''.$nombre_hijo.'\', \''.$desc_hijo.'\')">
                                    '.$hijo->name.'
                                  </button>';

                            $nietos = get_terms([
                                'taxonomy'=>'categoria_estructura',
                                'parent'=>$hijo->term_id,
                                'hide_empty'=>true
                            ]);

                            foreach($nietos as $nieto){

                                $nombre_nieto = esc_js($nieto->name);
                                $desc_nieto = $nieto->description ? str_replace(["\r","\n"],'',addslashes($nieto->description)) : '';

                                echo '<button class="sub-btn-sidebar nivel-3 child-of-'.$hijo->term_id.'" 
                                        data-id="'.$nieto->term_id.'" 
                                        style="display:none;"
                                        onclick="toggleSubMenu(this, \''.$nieto->slug.'\', \'categoria_estructura\', \''.$nombre_nieto.'\', \''.$desc_nieto.'\')">
                                        '.$nieto->name.'
                                      </button>';
                            }
                        }
                    }
                }
                ?>
            </div>

            <button class="qs-btn" onclick="openTab(event, 'equipo')">
                <?php echo get_field('titulo_btn_equipo') ?: 'Equipo de Trabajo'; ?>
            </button>
            
            <div id="submenu-equipo" class="submenu-container">
                <?php 
                $intro_equipo = get_field('tab_equipo_intro'); 
                $titulo_equipo = get_field('titulo_btn_equipo') ?: 'SECRETARÍA GENERAL';
                ?>
                <button class="sub-btn-sidebar nivel-1 active" data-id="all" 
                        onclick="toggleSubMenu(this, 'all', 'departamento', '<?php echo esc_js($titulo_equipo); ?>', `<?php echo esc_attr($intro_equipo); ?>`)">
                    Todos
                </button>

                <?php 
                $departamentos = get_terms([
                    'taxonomy'=>'departamento',
                    'hide_empty'=>true,
                    'parent'=>0
                ]);

                foreach($departamentos as $depto){

                    $nombre = esc_js($depto->name);
                    $desc = $depto->description ? str_replace(["\r","\n"],'',addslashes($depto->description)) : '';

                    echo '<button class="sub-btn-sidebar nivel-1 parent-'.$depto->term_id.'" 
                            data-id="'.$depto->term_id.'"
                            onclick="toggleSubMenu(this, \''.$depto->slug.'\', \'departamento\', \''.$nombre.'\', \''.$desc.'\')">
                            '.$depto->name.'
                          </button>';

                    $hijos = get_terms([
                        'taxonomy'=>'departamento',
                        'parent'=>$depto->term_id,
                        'hide_empty'=>true
                    ]);

                    foreach($hijos as $hijo){

                        $nombre_hijo = esc_js($hijo->name);
                        $desc_hijo = $hijo->description ? str_replace(["\r","\n"],'',addslashes($hijo->description)) : '';

                        echo '<button class="sub-btn-sidebar nivel-2 child-of-'.$depto->term_id.'" 
                                data-id="'.$hijo->term_id.'" 
                                style="display:none;"
                                onclick="toggleSubMenu(this, \''.$hijo->slug.'\', \'departamento\', \''.$nombre_hijo.'\', \''.$desc_hijo.'\')">
                                '.$hijo->name.'
                              </button>';
                    }
                }
                ?>
            </div>
        </div>
    </aside>

    <main class="qs-content-area">
        <div class="qs-card">
            

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
                <h2 id="estructura-dynamic-title" class="qs-title uppercase text-teal">
                    <?php echo get_field('titulo_btn_estructura') ?: 'ESTRUCTURA'; ?>
                </h2>
                <div class="team-intro">
                    <div id="estructura-dynamic-desc" class="qs-text-block">
                        <?php echo get_field('tab_estructura'); ?>
                    </div>
                </div>
                <div class="team-grid">
                    <?php 
                    $estructura_query = new WP_Query(array('post_type' => 'area_estructura', 'posts_per_page' => -1, 'order' => 'ASC'));
                    if ($estructura_query->have_posts()) : 
                        while ($estructura_query->have_posts()) : $estructura_query->the_post(); 
                            $rol   = get_field('rol_estructura');
                            $email = get_field('email_estructura');
                            $terms = get_the_terms( get_the_ID(), 'categoria_estructura' );
                            $term_slugs = '';
                            if( $terms && ! is_wp_error( $terms ) ) {
                                foreach( $terms as $term ) { $term_slugs .= ' ' . $term->slug; }
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
                            <?php if($rol): ?><p class="member-role text-teal"><?php echo esc_html($rol); ?></p><?php endif; ?>
                            <?php if($email): ?><p class="member-email"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p><?php endif; ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); else: ?><p>No hay roles registrados en Estructura.</p><?php endif; ?>
                </div>
            </div>

            <div id="equipo" class="tab-content">
                <h2 id="equipo-dynamic-title" class="qs-title uppercase text-teal">
                    <?php echo get_field('titulo_btn_equipo') ?: 'Equipo de trabajo'; ?>
                </h2>
                <div class="team-intro">
                    <div id="equipo-dynamic-desc" class="qs-text-block">
                        <?php echo get_field('tab_equipo_intro'); ?>
                    </div>
                </div>
                <div class="team-grid">
                    <?php 
                    $equipo_query = new WP_Query(array('post_type' => 'miembro_equipo', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'));
                    if ($equipo_query->have_posts()) : 
                        while ($equipo_query->have_posts()) : $equipo_query->the_post(); 
                            $cargo = get_field('cargo_miembro');
                            $email = get_field('email_miembro');
                            $terms = get_the_terms( get_the_ID(), 'departamento' );
                            $term_slugs = '';
                            if( $terms && ! is_wp_error( $terms ) ) {
                                foreach( $terms as $term ) { $term_slugs .= ' ' . $term->slug; }
                            }
                    ?>
                        <div class="team-card filter-item-equipo <?php echo $term_slugs; ?>">
                            <div class="photo-frame-wrapper">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/marco.png" class="frame-overlay" alt="marco">
                                <?php if(has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'person-photo')); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/todos.png" class="person-photo" alt="Sin foto">
                                <?php endif; ?>
                            </div>
                            <h4 class="member-name"><?php the_title(); ?></h4>
                            <?php if($cargo): ?><p class="member-role text-teal"><?php echo esc_html($cargo); ?></p><?php endif; ?>
                            <?php if($email): ?><p class="member-email"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p><?php endif; ?>
                        </div>
                    <?php endwhile; wp_reset_postdata(); else: ?><p>No hay miembros registrados.</p><?php endif; ?>
                </div>
            </div>

        </div> 
    </main>
</div>
<script>

const MOBILE_BP = 1024;
function isMobile() { return window.innerWidth <= MOBILE_BP; }

/* ==============================================================
   SETUP MOBILE NAV: Envolver botones principales en fila scroll
   ============================================================== */
function setupMobileNav() {
    const container = document.querySelector('.qs-main-buttons-container');
    if (!container || container.querySelector('.mobile-main-row')) return;

    const mainRow = document.createElement('div');
    mainRow.className = 'mobile-main-row';

    // Mover todos los .qs-btn (hijos directos) a la fila
    const btns = Array.from(container.querySelectorAll(':scope > .qs-btn'));
    btns.forEach(btn => mainRow.appendChild(btn));

    container.insertBefore(mainRow, container.firstChild);

    // Si hay un submenú visible, reconstruir sus filas
    container.querySelectorAll('.submenu-container').forEach(sub => {
        if (sub.style.display === 'flex') {
            rebuildMobileSubRows(sub);
        }
    });
}

/* ==============================================================
   TEARDOWN: Restaurar DOM original para escritorio
   ============================================================== */
function teardownMobileNav() {
    const container = document.querySelector('.qs-main-buttons-container');
    if (!container) return;

    const mainRow = container.querySelector('.mobile-main-row');
    if (!mainRow) return;

    // 1. Limpiar filas de sub-botones dentro de submenus
    container.querySelectorAll('.submenu-container').forEach(sub => {
        sub.querySelectorAll('.mobile-sub-row').forEach(row => {
            Array.from(row.children).forEach(child => sub.appendChild(child));
            row.remove();
        });
    });

    // 2. Devolver botones principales al container
    const btns = Array.from(mainRow.querySelectorAll('.qs-btn'));
    btns.forEach(btn => container.insertBefore(btn, mainRow));
    mainRow.remove();

    // 3. Re-ubicar submenu-containers después de su botón padre
    const subEst = document.getElementById('submenu-estructura');
    const subEq  = document.getElementById('submenu-equipo');
    const allBtns = Array.from(container.querySelectorAll(':scope > .qs-btn'));

    allBtns.forEach(btn => {
        const match = btn.getAttribute('onclick')?.match(/openTab\(event,\s*'(\w+)'\)/);
        if (match) {
            if (match[1] === 'estructura' && subEst) btn.after(subEst);
            if (match[1] === 'equipo'     && subEq)  btn.after(subEq);
        }
    });
}

/* ==============================================================
   REBUILD MOBILE SUB ROWS: Crear filas scroll dentro del submenú
   ============================================================== */
function rebuildMobileSubRows(submenuContainer) {
    if (!submenuContainer) return;

    // Limpiar filas previas (devolver botones al container)
    submenuContainer.querySelectorAll('.mobile-sub-row').forEach(row => {
        Array.from(row.children).forEach(btn => submenuContainer.appendChild(btn));
        row.remove();
    });

    const nivel1 = Array.from(submenuContainer.querySelectorAll('.nivel-1'));
    const nivel2 = Array.from(submenuContainer.querySelectorAll('.nivel-2'));
    const nivel3 = Array.from(submenuContainer.querySelectorAll('.nivel-3'));

    // FILA 2 (nivel-1): Siempre visible cuando el submenú está abierto
    if (nivel1.length > 0) {
        const rowN1 = document.createElement('div');
        rowN1.className = 'mobile-sub-row row-nivel1';
        nivel1.forEach(btn => { btn.style.display = ''; rowN1.appendChild(btn); });
        submenuContainer.appendChild(rowN1);
    }

    // FILA 3 (nivel-2): Solo hijos del nivel-1 activo
    if (nivel2.length > 0) {
        const rowN2 = document.createElement('div');
        rowN2.className = 'mobile-sub-row row-nivel2';

        const activeN1 = submenuContainer.querySelector('.nivel-1.active');
        const activeId = activeN1 ? activeN1.getAttribute('data-id') : null;
        let hasVisible = false;

        nivel2.forEach(btn => {
            if (activeId && activeId !== 'all' && btn.classList.contains('child-of-' + activeId)) {
                btn.style.display = '';
                hasVisible = true;
            } else {
                btn.style.display = 'none';
            }
            rowN2.appendChild(btn);
        });

        rowN2.style.display = hasVisible ? 'flex' : 'none';
        submenuContainer.appendChild(rowN2);
    }

    // FILA 4 (nivel-3): Solo hijos del nivel-2 activo (si existe)
    if (nivel3.length > 0) {
        const rowN3 = document.createElement('div');
        rowN3.className = 'mobile-sub-row row-nivel3';

        const activeN2 = submenuContainer.querySelector('.nivel-2.active');
        const activeN2Id = activeN2 ? activeN2.getAttribute('data-id') : null;
        let hasVisibleN3 = false;

        nivel3.forEach(btn => {
            if (activeN2Id && btn.classList.contains('child-of-' + activeN2Id)) {
                btn.style.display = '';
                hasVisibleN3 = true;
            } else {
                btn.style.display = 'none';
            }
            rowN3.appendChild(btn);
        });

        rowN3.style.display = hasVisibleN3 ? 'flex' : 'none';
        submenuContainer.appendChild(rowN3);
    }
}

/* ==============================================================
   LIMPIAR TODAS LAS FILAS MÓVILES: Devolver botones y destruir wrappers
   ============================================================== */
function cleanupAllMobileSubRows() {
    document.querySelectorAll('.submenu-container').forEach(sub => {
        sub.querySelectorAll('.mobile-sub-row').forEach(row => {
            Array.from(row.children).forEach(btn => sub.appendChild(btn));
            row.remove();
        });
    });
}

/* ==============================================================
   OPEN TAB: Botones principales (Historia, Estructura, etc.)
   ============================================================== */
function openTab(evt, tabName) {

    // Ocultar todos los contenidos
    let tabcontent = document.getElementsByClassName('tab-content');
    for (let i = 0; i < tabcontent.length; i++)
        tabcontent[i].style.display = 'none';

    // Desactivar todos los botones principales
    let tablinks = document.getElementsByClassName('qs-btn');
    for (let i = 0; i < tablinks.length; i++)
        tablinks[i].classList.remove('active');

    // MÓVIL: Limpiar todas las filas de sub-botones de TODOS los submenús
    if (isMobile()) {
        cleanupAllMobileSubRows();
    }

    // Ocultar TODOS los submenús (ambos: estructura y equipo)
    document.querySelectorAll('.submenu-container').forEach(sub => {
        sub.style.display = 'none';
    });

    // Mostrar contenido seleccionado
    document.getElementById(tabName).style.display = 'block';
    evt.currentTarget.classList.add('active');

    // Mostrar submenú asociado SOLO si existe para esta pestaña
    let targetSubmenu = document.getElementById('submenu-' + tabName);
    if (targetSubmenu) {
        targetSubmenu.style.display = 'flex';

        if (isMobile()) {
            rebuildMobileSubRows(targetSubmenu);
        }
    }
}

/* ==============================================================
   TOGGLE SUBMENU: Sub-botones (nivel-1, nivel-2, nivel-3)
   ============================================================== */
function toggleSubMenu(clickedBtn, slug, taxonomy, title, desc) {
    let container = clickedBtn.closest('.submenu-container');
    if (!container) return;

    let tabName = container.id.replace('submenu-', ''); // 'estructura' o 'equipo'

    // Determinar nivel del botón clickeado
    let nivel = clickedBtn.classList.contains('nivel-1') ? 1 :
                clickedBtn.classList.contains('nivel-2') ? 2 : 3;

    let parentId = clickedBtn.getAttribute('data-id');

    if (nivel === 1) {
        // Desactivar TODOS los sub-botones
        container.querySelectorAll('.sub-btn-sidebar').forEach(btn => btn.classList.remove('active'));
        // Ocultar nivel-2 y nivel-3
        container.querySelectorAll('.nivel-2, .nivel-3').forEach(btn => { btn.style.display = 'none'; });
        // Mostrar hijos nivel-2 del botón clickeado (si no es "Todos")
        if (parentId && parentId !== 'all') {
            container.querySelectorAll('.child-of-' + parentId).forEach(btn => {
                if (btn.classList.contains('nivel-2')) btn.style.display = '';
            });
        }
    } else if (nivel === 2) {
        // Desactivar nivel-2 y nivel-3
        container.querySelectorAll('.nivel-2, .nivel-3').forEach(btn => btn.classList.remove('active'));
        // Ocultar nivel-3
        container.querySelectorAll('.nivel-3').forEach(btn => { btn.style.display = 'none'; });
        // Mostrar hijos nivel-3 del botón clickeado
        if (parentId) {
            container.querySelectorAll('.child-of-' + parentId).forEach(btn => { btn.style.display = ''; });
        }
    } else {
        // Nivel 3: solo desactivar hermanos nivel-3
        container.querySelectorAll('.nivel-3').forEach(btn => btn.classList.remove('active'));
    }

    // Activar botón clickeado
    clickedBtn.classList.add('active');

    // Actualizar título y descripción dinámicos
    let titleEl = document.getElementById(tabName + '-dynamic-title');
    let descEl  = document.getElementById(tabName + '-dynamic-desc');
    if (titleEl) titleEl.textContent = title;
    if (descEl)  descEl.innerHTML = desc;

    // Filtrar tarjetas
    let cardClass = (tabName === 'estructura') ? 'filter-item-struct' : 'filter-item-equipo';
    let cards = document.querySelectorAll('.' + cardClass);
    cards.forEach(card => {
        card.style.display = (slug === 'all' || card.classList.contains(slug)) ? '' : 'none';
    });

    // Actualizar filas en MÓVIL
    if (isMobile()) {
        updateMobileRows(container, nivel);
    }
}

/* ==============================================================
   UPDATE MOBILE ROWS: Mostrar/ocultar filas 2 y 3 tras click
   ============================================================== */
function updateMobileRows(container, clickedNivel) {

    if (clickedNivel === 1) {
        // Actualizar fila nivel-2 según nivel-1 activo
        const activeN1 = container.querySelector('.nivel-1.active');
        const activeId = activeN1 ? activeN1.getAttribute('data-id') : null;

        const rowN2 = container.querySelector('.row-nivel2');
        if (rowN2) {
            let hasVisible = false;
            rowN2.querySelectorAll('.sub-btn-sidebar').forEach(btn => {
                if (activeId && activeId !== 'all' && btn.classList.contains('child-of-' + activeId)) {
                    btn.style.display = '';
                    hasVisible = true;
                } else {
                    btn.style.display = 'none';
                }
                btn.classList.remove('active');
            });
            rowN2.style.display = hasVisible ? 'flex' : 'none';
        }

        // Ocultar fila nivel-3
        const rowN3 = container.querySelector('.row-nivel3');
        if (rowN3) {
            rowN3.style.display = 'none';
            rowN3.querySelectorAll('.sub-btn-sidebar').forEach(btn => btn.classList.remove('active'));
        }

    } else if (clickedNivel === 2) {
        // Actualizar fila nivel-3 según nivel-2 activo
        const activeN2 = container.querySelector('.nivel-2.active');
        const activeN2Id = activeN2 ? activeN2.getAttribute('data-id') : null;

        const rowN3 = container.querySelector('.row-nivel3');
        if (rowN3) {
            let hasVisible = false;
            rowN3.querySelectorAll('.sub-btn-sidebar').forEach(btn => {
                if (activeN2Id && btn.classList.contains('child-of-' + activeN2Id)) {
                    btn.style.display = '';
                    hasVisible = true;
                } else {
                    btn.style.display = 'none';
                }
                btn.classList.remove('active');
            });
            rowN3.style.display = hasVisible ? 'flex' : 'none';
        }
    }
    // Clicks en nivel-3 no necesitan actualizar filas
}

/* ==============================================================
   RESPONSIVE: Detectar cambio mobile <-> desktop
   ============================================================== */
let lastWasMobile = null;

function handleResize() {
    const mobile = isMobile();
    if (mobile === lastWasMobile) return;
    lastWasMobile = mobile;

    if (mobile) {
        setupMobileNav();
    } else {
        teardownMobileNav();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    handleResize();
    window.addEventListener('resize', handleResize);
});

</script>

<?php get_footer(); ?>