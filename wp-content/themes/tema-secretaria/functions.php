<?php
function secretaria_setup() {
    // 1. Permitir imágenes destacadas en las noticias
    add_theme_support('post-thumbnails');

    // 2. Registrar el menú del header para que aparezca en el admin
    register_nav_menus(array(
        'menu-principal' => 'Menú Principal Header',
        'menu-interes'   => 'Menú Recursos de Interés'
    ));
}
add_action('after_setup_theme', 'secretaria_setup');

function registrar_botones_home() {
    register_post_type('boton_home', array(
        'labels' => array(
            'name'          => 'Botones Home',
            'singular_name' => 'Botón'
        ),
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-grid-view', // Un icono bonito para el menú
        'supports'    => array('title') // Solo usaremos el Título (el texto del botón)
    ));
}
add_action('init', 'registrar_botones_home');

function registrar_equipo_trabajo() {
    register_post_type('miembro_equipo', array(
        'labels' => array(
            'name'          => 'Equipo de Trabajo',
            'singular_name' => 'Miembro'
        ),
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-groups', // Icono de personitas
        'supports'    => array('title', 'thumbnail') // Usaremos Título (Nombre) y Thumbnail (Foto)
    ));
}
add_action('init', 'registrar_equipo_trabajo');

// 1. TAXONOMÍA PARA EL EQUIPO (Para poder clasificarlos por departamento)
function registrar_departamentos_equipo() {
    register_taxonomy(
        'departamento', // Nombre interno (slug)
        'miembro_equipo', // A qué Post Type se lo asignamos
        array(
            'label' => 'Departamentos',
            'rewrite' => array('slug' => 'departamento'),
            'hierarchical' => true, // True = Como categorías (checkbox), False = Como etiquetas
            'show_in_rest' => true // Para que salga en el editor nuevo
        )
    );
}
add_action('init', 'registrar_departamentos_equipo');

// 2. NUEVO POST TYPE: ESTRUCTURA (Para los botones de "Estructura")
function registrar_areas_estructura() {
    register_post_type('area_estructura', array(
        'labels' => array(
            'name'          => 'Áreas Estructura',
            'singular_name' => 'Área'
        ),
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-building', // Icono de edificio
        'supports'    => array('title', 'editor') // Título y el Editor WYSIWYG para el contenido
    ));
}
add_action('init', 'registrar_areas_estructura');

// PERMITIR HTML EN LAS DESCRIPCIONES DE CATEGORÍA
remove_filter('pre_term_description', 'wp_filter_kses');
remove_filter('term_description', 'wp_kses_data');

// 1. NUEVA TAXONOMÍA PARA ESTRUCTURA (Para el árbol de menús)
function registrar_categorias_estructura() {
    register_taxonomy(
        'categoria_estructura', // Nombre interno
        'area_estructura',      // A qué post type pertenece
        array(
            'label' => 'Categorías Estructura',
            'rewrite' => array('slug' => 'categoria-estructura'),
            'hierarchical' => true, // Permite Padre > Hijo > Nieto
            'show_in_rest' => true
        )
    );
}
add_action('init', 'registrar_categorias_estructura');

// 2. ACTUALIZAR EL POST TYPE ESTRUCTURA (Para activar fotos)
// Usamos prioridad 20 para sobreescribir la configuración anterior
function actualizar_soporte_estructura() {
    register_post_type('area_estructura', array(
        'labels' => array(
            'name'          => 'Roles Estructura',
            'singular_name' => 'Rol'
        ),
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-building',
        'supports'    => array('title', 'editor', 'thumbnail') // ¡Agregamos thumbnail!
    ));
}
add_action('init', 'actualizar_soporte_estructura', 20);

// 2. FUNCIÓN PARA MOSTRAR EDITOR VISUAL EN TAXONOMÍAS
function habilitar_editor_visual_taxonomias($term, $taxonomy) {
    ?>
    <tr class="form-field term-description-wrap">
        <th scope="row"><label for="description">Descripción (Visual)</label></th>
        <td>
            <?php 
            $settings = array(
                'media_buttons' => false, 
                'textarea_name' => 'description',
                'textarea_rows' => 10,
                'teeny'         => false, // CAMBIO: false para ver todas las herramientas (H1, H2, etc.)
                'quicktags'     => true 
            );
            
            $content = htmlspecialchars_decode($term->description);
            wp_editor($content, 'description_editor', $settings); 
            ?>
            <p class="description">Usa este editor para dar formato al texto.</p>
            
            <script>
                jQuery(document).ready(function($){
                    var originalTextArea = $('#edittag').find('textarea#description');
                    var originalRow = originalTextArea.closest('.form-field');
                    if(originalTextArea.length > 0) {
                        originalRow.remove(); 
                    }
                });
            </script>
        </td>
    </tr>
    <?php
}

// 3. APLICAR A TUS TAXONOMÍAS ESPECÍFICAS
// Hook para Departamentos (Equipo)
add_action('departamento_edit_form_fields', 'habilitar_editor_visual_taxonomias', 10, 2);

// Hook para Categorías de Estructura
add_action('categoria_estructura_edit_form_fields', 'habilitar_editor_visual_taxonomias', 10, 2);

// 1. REGISTRAR POST TYPE PARA VIDEOS
function registrar_videos_destacados() {
    register_post_type('video_destacado', array(
        'labels' => array(
            'name'          => 'Videos Destacados',
            'singular_name' => 'Video'
        ),
        'public'      => true,
        'has_archive' => false, // Cambia a true si luego quieres una página de archivo automática
        'menu_icon'   => 'dashicons-video-alt3', // Icono de video
        'supports'    => array('title') // Solo necesitamos el título, el link va por ACF/SCF
    ));
}
add_action('init', 'registrar_videos_destacados');

// 2. FUNCIÓN AUXILIAR: EXTRAER ID DE YOUTUBE
// Esta función convierte "https://www.youtube.com/watch?v=AbCdEfGh" en "AbCdEfGh"
function obtener_id_youtube($url) {
    $pattern = '%^# Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x';
    $result = preg_match($pattern, $url, $matches);
    if ($result) {
        return $matches[1];
    }
    return false;
}
?>