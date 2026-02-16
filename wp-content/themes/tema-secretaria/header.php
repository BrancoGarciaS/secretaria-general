<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretaría General - USACH</title>
    <?php wp_head(); ?> 
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>

    <header class="site-header">
        <div class="header-top">
            <div class="logo-container">
                <img src="<?php echo get_template_directory_uri(); ?>/images/Recurso 6 1.png" alt="Logo" class="main-logo">
            </div>
            
            <div class="dropdown-container">
                <button class="btn-recursos">Recursos de Interés ▼</button>
                <div class="dropdown-content">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'menu-interes',
                        'container'      => false,
                        'menu_class'     => '', // Sin clases extra, los estilos de <a> en CSS se aplicarán igual
                        'fallback_cb'    => false,
                        'items_wrap'     => '%3$s', // Esto elimina el <ul> envolvente para que solo salgan los <a>
                        'depth'          => 1
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="header-bottom">
            <nav class="main-nav">
                <?php
                // ESTO REEMPLAZA A TU <ul> HARDCODEADO
                wp_nav_menu(array(
                    'theme_location' => 'menu-principal', // El nombre que registramos en functions.php
                    'container'      => false,            // No queremos que WP agregue un div extra
                    'menu_class'     => '',               // Clase para el <ul> (si la necesitas)
                    'fallback_cb'    => false             // Si no hay menú, no muestres nada
                ));
                ?>
            </nav>
            <div class="accessibility-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/images/settings_accessibility_100dp_00A499_FILL0_wght400_GRAD0_opsz48 1.png" alt="Accesibilidad">
            </div>
        </div>
    </header>