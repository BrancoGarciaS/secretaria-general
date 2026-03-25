<?php 
/*
 * Template Name: Declaración de Intereses y Patrimonio
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
                <p>La Ley 20.880 sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, regula el principio de probidad en el ejercicio de la función pública y la prevención y sanción de conflictos de intereses. El principio de probidad en la función pública consiste en observar una conducta funcionaria intachable, un desempeño honesto y leal de la función o cargo con preeminencia del interés general sobre el particular.</p>
                
                <p>De acuerdo a lo dispuesto en la Ley 20.880, sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, corresponde que todos los meses de marzo debe actualizar, según corresponda, la información contenida en la Declaración de Intereses y Patrimonio.</p>
                
                <p>En la Universidad de Santiago de Chile están obligados a efectuar dicha declaración, y por ende a su actualización, las autoridades y personal de planta y a contrata, que sean directivos, profesionales y técnicos que se desempeñen hasta el tercer nivel jerárquico.</p>
                
                <p>Por normativa interna deberán prestar dicha declaración quienes registran nombramiento o contratación desde el grado 5° o superior de la Escala de Remuneraciones Usach, independiente que sean o no jefaturas.</p>
                
                <p>Además, deberán realizar esta declaración aquellas personas que se desempeñen como directivos, sin importar su grado, y también aquellas contratadas a honorarios por un monto bruto mensual superior a <strong>$2.815.631</strong>, y cuyo contrato sea por el plazo mínimo de un año.</p>
                
                <p>También deberán realizar esta declaración aquellas personas que sirvan en más de un empleo y que la suma de sus remuneraciones y/o honorarios alcancen el monto señalado en el párrafo anterior.</p>
                
                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Documentos y Enlaces</h3>
                <ul class="list-none-spaced">
                    <li class="list-item-spaced">📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/instructivo_dip_2023_paso_a_paso.pdf" target="_blank" class="link-orange font-bold">Presione aquí para conocer el instructivo, de cómo realizar la declaración de Intereses y Patrimonio</a></li>
                    <li class="list-item-spaced">📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/manual_dip_2023.pdf" target="_blank" class="link-orange font-bold">Presione aquí para conocer el manual de procedimiento de Declaraciones de Intereses y Patrimonio</a></li>
                </ul>

                <div class="text-center-spaced">
                    <p class="font-bold margin-bottom-15">Para realizar su declaración acceda al siguiente link:</p>
                    <a href="https://www.declaracionjurada.cl/dip/" target="_blank" class="highlight-link">IR A DECLARACIONJURADA.CL</a>
                </div>

                <div class="box-highlight">
                    <p>De acuerdo con lo establecido en dicha ley, existe un plazo que vence el <strong>31 de marzo de cada año</strong>, para efectuar las actualizaciones de dichas declaraciones.</p>
                    <p class="margin-top-20"><strong>Contacto:</strong> Unidad de Probidad y Transparencia</p>
                    <p>Para cualquier duda o consulta se puede comunicar con la Unidad de Probidad y Transparencia al IP: 80105 o a su correo electrónico: dip@usach.cl</p>
                    <p><strong>IP:</strong> 80105</p>
                    <p><strong>Correo:</strong> <a href="mailto:dip@usach.cl" class="link-teal-simple">dip@usach.cl</a></p>
                </div>

                <h3 class="qs-subtitle text-teal">Infografías de ayuda</h3>
                <div class="infografia-grid">
                    <div class="infografia-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/screenshot_20230330_193316_com.instagram.android_1_0.jpg" alt="Infografía 1">
                    </div>
                    <div class="infografia-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/dip-2024-como-realizar-la-declaracion_-734x1024.png" alt="Infografía 2">
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>



<?php get_footer(); ?>