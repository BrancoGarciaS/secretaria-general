<?php 
/*
 * Template Name: Cometidos Funcionarios 
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
                <div class="box-highlight">
                    <p><strong>Ministra de Fe de los cometidos funcionarios:</strong> Loreto Malebrán Rivera</p>
                    <p><strong>Correo Electrónico:</strong> <a href="mailto:loreto.malebran@usach.cl" class="link-dark-simple">loreto.malebran@usach.cl</a></p>
                    <p><strong>Teléfono IP:</strong> 227180135</p>
                </div>

                <h3 class="qs-subtitle text-teal">Requisitos para creación</h3>
                <p>Para la creación de un Cometido Funcionario en General, lo mínimo que deberán adjuntar:</p>
                <ol class="list-decimal-spaced">
                    <li>Autorización de la jefatura.</li>
                    <li>Certificado de cargo emitido a la fecha de la solicitud (<a href="https://www.funcionarios.usach.cl/intranet/" target="_blank" class="link-orange-simple">Intranet Funcionarios</a>).</li>
                    <li>Constancia financiera.</li>
                    <li>Pasajes.</li>
                    <li>Programa de trabajo.</li>
                </ol>
                
                <p>Cabe señalar que la tabla de viáticos desde Junio 2025 es la siguiente (página 4 en ambos estamentos): <a href="https://www.funcionarios.usach.cl/portal/index.php?id=20240105114756" target="_blank" class="link-orange-simple">Ver Tabla</a></p>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Ley 18.834 sobre Estatuto Administrativo</h3>
                <p>De acuerdo al Artículo 99 del DFL 29, que fija el texto refundido, coordinado y sistematizado de la Ley 18.834 sobre Estatuto Administrativo del Ministerio de Hacienda, establece que, el derecho al cobro de las signaciones de un cometido funcionario, prescribirá en el plazo de seis meses contado desde la fecha en que se hicieron exigibles.</p>
                
                <p>Es necesario tener presente que todos los cometidos funcionarios que se realicen, deben considerar el Decreto 90 del Ministerio de Hacienda que define localidades para efecto del pago de viáticos.  En este contexto se infoma que las comunas que no se debe pagar viatico dentro de la Región Metropolitana son:  Santiago, San Miguel, San Joaquín, San Ramón, La Cisterna, San Bernardo, Puente Alto, La Granja, La Pintana, La Florida, Peñalolén, Macul, Ñuñoa, La Reina, Las Condes, Providencia, Conchalí, Quilicura, Renca, Lo Prado, Cerro Navia, Quinta Normal, Pudahuel, Estación Central, Maipú, Cerrillos, El Bosque, Recoleta, Vitacura, Lo Espejo, Independencia, Pedro Aguirre Cerda, Huechuraba, Lo Barnechea, Lampa, Calera de Tango, Padre Hurtado, Peñaflor, El Monte, Isla de Maipo, Buin, Paine, Pirque, y Colina.</p>
                
                <p class="font-italic">Excepción de la localidad de Farellones de la comuna de Lo Barnechea y las localidades de Chacabuco, Peldehue y Colina Oriente, de la comuna de Colina que sí puede tener viático.</p>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Creación de cometidos funcionarios para la Sociedad de Desarrollo Tecnológico (STD)</h3>
                <p>Para estos efectos, la unidad académica o administrativa respectiva deberá solicitar por correo a las Efusach (<a href="mailto:ingresoderequerimientosefusach@usach.cl" class="link-teal-simple">ingresoderequerimientosefusach@usach.cl</a>) la emisión de un certificado de disponibilidad presupuestaria, que acredite que el proyecto dispone de los fondos necesarios, a la fecha de su emisión, los cuales se mantendrán reservados hasta el pago.</p>

                <hr class="separator-line">

                <h3 class="qs-subtitle text-teal">Normas / Formatos de Resoluciones y Otros</h3>
                <ul class="download-list list-none-spaced">
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/dto-262_03-may-1977.pdf" target="_blank" class="link-teal">Decreto 262 (03-mayo-1977)</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/decreto-90-exento_21-mar-2018.pdf" target="_blank" class="link-teal">Decreto 90 Exento (21-marzo-2018)</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/resolucion_36_de_la_contraloria_general_de_la_republica.pdf" target="_blank" class="link-teal">Resolución 36 Contraloría General</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/vistos_y_considerandos_estandar_cometido_funcionario_actualizado_1.docx" target="_blank" class="link-teal">Formato de resolución USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_modifica_rectifica_actualizado2025.docx" target="_blank" class="link-teal">Formato resolución modifica y rectifica USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/autorizacion_cometidos_funcionarios_actualizado.doc" target="_blank" class="link-teal">Formato autorización de Jefatura USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/borrador_res._autoriza_reembolso_noviembre2024.docx" target="_blank" class="link-teal">Borrador Autoriza Reembolso (Noviembre 2024)</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_constaciafinanciera_dic.2024.docx" target="_blank" class="link-teal">Formato constancia financiera USACH</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/1._cometido_funcionario_r_nacional_matriz_1_0.pdf" target="_blank" class="link-teal">Formato resolución SDT</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/3._cometido_funcionario_parcial_nacional_matriz.pdf" target="_blank" class="link-teal">Formato resolución SDT (mitad SDT y USACH)</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/2._rectifica_r_cometido_funcionario_nacional_matriz_1.docx" target="_blank" class="link-teal">Formato de rectificación y modificación SDT</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_certificado_disponibilidad_financiera_sdt.pdf" target="_blank" class="link-teal">Certificado disponibilidad financiera SDT (solicitarlo a la SDT)</a></li>
                </ul>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>


<?php get_footer(); ?>