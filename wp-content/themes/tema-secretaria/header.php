<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretaría General - USACH</title>
    <?php wp_head(); ?> 
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body <?php body_class(); ?>>

<?php
// --- DETECCIÓN AUTOMÁTICA DE LA PÁGINA DE CONFIGURACIÓN ---
$pagina_config = get_page_by_path('configuracion-header'); 
$config_id = $pagina_config ? $pagina_config->ID : false;
?>
<header class="site-header">
        <div class="header-top">
            <div class="logo-container">
                <a href="<?php echo home_url(); ?>">
                    <?php 
                    $logo_header = get_field('logo_header', $config_id);
                    if( $logo_header ) {
                        echo '<img src="' . esc_url($logo_header['url']) . '" alt="' . esc_attr($logo_header['alt']) . '" class="main-logo">';
                    } else {
                        // Imagen por defecto
                        echo '<img src="' . get_template_directory_uri() . '/images/Recurso 6 1.png" alt="Logo" class="main-logo">';
                    }
                    ?>
                </a>
            </div>
            
            <div class="dropdown-container">
                <button class="btn-recursos">Recursos de Interés ▼</button>
                <div class="dropdown-content">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-interes',
                        'container'      => false,
                        'menu_class'     => '', 
                        'fallback_cb'    => false,
                        'items_wrap'     => '%3$s', 
                        'depth'          => 1
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <button class="menu-toggle" aria-label="Abrir menú">☰ Menú</button>
            
            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal', 
                    'container'      => false,            
                    'menu_class'     => '',               
                    'fallback_cb'    => false             
                ));
                ?>
            </nav>
            
            <div class="accessibility-icon">
                <?php 
                $icon_access = get_field('icono_accesibilidad', $config_id);
                if( $icon_access ) {
                    echo '<img src="' . esc_url($icon_access['url']) . '" alt="' . esc_attr($icon_access['alt']) . '">';
                } else {
                    // Imagen por defecto
                    echo '<img src="' . get_template_directory_uri() . '/images/settings_accessibility_100dp_00A499_FILL0_wght400_GRAD0_opsz48 1.png" alt="Accesibilidad">';
                }
                ?>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const menuToggle = document.querySelector('.menu-toggle');
                const mainNavUl = document.querySelector('.main-nav ul');
                
                if(menuToggle && mainNavUl) {
                    menuToggle.addEventListener('click', function() {
                        mainNavUl.classList.toggle('mostrar-menu');
                    });
                }
            });
        </script>
    </header>