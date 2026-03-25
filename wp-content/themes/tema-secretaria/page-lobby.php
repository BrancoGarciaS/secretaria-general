<?php 
/*
 * Template Name: Lobby USACH
 */
get_header(); 
?>

<section class="section-title-bar">
    <h2><?php the_title(); ?></h2>
</section>

<main class="simple-layout">
    
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class="qs-text-block">
            <?php 
            if ( get_the_content() ) {
                the_content(); 
            } else {
                // CONTENIDO POR DEFECTO
                ?>
                <p>El 8 de marzo de 2014, se publicó la Ley 20.730, que regula el lobby y las gestiones que representen intereses particulares ante las autoridades y funcionarios, constituyéndose en un gran avance para suministrar a la actividad pública herramientas que hagan más transparente su ejercicio.</p>
                
                <p>La entrada en vigencia de esta ley representa un profundo cambio en la relación entre el Estado y las personas, estableciendo como deber de las autoridades y los funcionarios públicos (que tengan la calidad de “sujetos pasivos”), el registrar y dar publicidad a:</p>
                
                <ul class="list-disc-spaced">
                    <li>Las <strong>reuniones</strong> y audiencias solicitadas por lobbistas y gestores de intereses particulares que tengan como finalidad influir en una decisión pública.</li>
                    <li>Los <strong>viajes</strong> que realicen en el ejercicio de sus funciones.</li>
                    <li>Los <strong>regalos</strong> que reciban en cuanto autoridad o funcionario.</li>
                </ul>
                
                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Accesos Directos</h3>
                <ul class="list-none-spaced">
                    <li class="margin-bottom-15">🔗 <a href="http://www.leylobby.gob.cl/instituciones/UN008" target="_blank" class="link-teal font-bold">Para revisar aquellas reuniones de los sujetos pasivos de la Universidad haga clic acá</a></li>
                    <li class="margin-bottom-15">🔗 <a href="https://www.leylobby.gob.cl/instituciones/UN008" target="_blank" class="link-teal font-bold">Si requiere una reunión con una de las autoridades señaladas haga clic acá</a></li>
                    <li class="margin-bottom-15">📥 <a href="http://www.leylobby.gob.cl/files/manual_ciudadano%20ley_lobby.pdf" target="_blank" class="link-orange font-bold">Si desea ver o descargar el manual ciudadano de Lobby haga clic acá</a></li>
                    <li class="margin-bottom-15">📥 <a href="http://www.leylobby.gob.cl/files/manual_juridico%20ley_lobby.pdf" target="_blank" class="link-orange font-bold">Para acceder y descargar el manual jurídico de Lobby haga clic acá</a></li>
                    <li class="margin-bottom-15">📄 <a href="https://drive.google.com/file/d/1I5zI5ZvEHZ-61bPoZ1Hau4L8kRcQONRR/view?usp=drive_link" target="_blank" class="link-orange font-bold">Para acceder a la Resolución Exenta N° 5823, de 20 de octubre de 2025... haga clic acá</a></li>
                </ul>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>