<?php 
/*
 * Template Name: Documentación y Resoluciones
 */
get_header(); 
?>

<section class="section-title-bar" style="margin-top: 40px;">
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
                <h2>Alcances para la creación de una resolución o convenio</h2>
                <p>La Unidad de Estudios de la Secretaría General, ha realizado algunos alcances y recomendaciones para la elaboración de resoluciones y convenios.</p>
                
                <h3 class="qs-subtitle text-teal" style="margin-top: 30px;">Requisitos para trámites Unidad de Estudios</h3>
                <p style="font-style: italic;">(Esto es sin perjuicio que se soliciten otros antecedentes y/o aclaraciones para cada caso en particular)</p>
                
                <ul style="margin-left: 20px; list-style-type: disc;">
                    <li><strong>Convenios para firma:</strong> documento en PDF; documentos de personerías; si se cita convenio previo o se hace alusión a otro convenio, acompañar el documento.</li>
                    <li><strong>Resolución que aprueba convenio:</strong> convenio firmado por todas las partes; documentos de personerías; borrador de resolución.</li>
                    <li><strong>Contratos de arriendo de inmuebles:</strong> documento en PDF; documentos de personerías y cédulas de identidad; certificado de dominio vigente del arrendador.</li>
                    <li><strong>Resolución que aprueba arrendamiento de inmuebles:</strong> contrato firmado por las partes; documentos de personerías y cédulas de identidad; certificado de dominio vigente del arrendador; certificado de disponibilidad presupuestaria; borrador de resolución.</li>
                    <li><strong>Estudio de título:</strong> Copia de inscripción de dominio; certificado de hipotecas y gravámenes; certificado de no expropiación; certificado de avalúo fiscal; certificado de Tesorería General de la República de pago de contribuciones; certificado de inscripción de la posesión efectiva si corresponde; certificado de pago de derechos de aseo (derechos municipales); certificado de número y certificado de deslindes; certificado de matrimonio si el dueño del inmuebles es una persona casada; personería en el caso de persona jurídica con antigüedad máxima de un año.</li>
                    <li><strong>Compraventa de inmuebles:</strong> Contrato en formato PDF; documentos que se acompañaron para el estudio de título.</li>
                    <li><strong>Reembolsos:</strong> borrador de resolución; documento(s) que acrediten el gasto; cédula de identidad de quien pretende el reembolso de gastos; certificado de disponibilidad presupuestaria; en caso de que se haya efectuado el pago mediante tarjeta de crédito y/o débito se requiere, además, que se acredite que el pago fue efectuado por el/la funcionario/a respecto del cual se está solicitando el reembolso. Por ejemplo, se puede acompañar estado de cuenta o estado de movimientos de la tarjeta en cuestión donde conste el nombre del funcionario/a. En el caso de que se haya efectuado una compra mediante tarjeta de crédito internacional, para efectos de determinar el valor de tipo de cambio, se estará a la fecha de transacción/operación, es decir, la fecha en que se adquirió el bien o servicio contratado; en los casos que no se pueda determinar, el valor de tipo de cambio será aquel indicado por el Banco Central, de acuerdo a la fecha de transacción. En el caso de una transacción efectuada en un día inhábil (feriados y fines de semana), se deberá́ considerar el valor de tipo de cambio fijado para el día hábil anterior a aquel inhábil, ya que el Banco Central no publica información en días inhábiles. A modo de ejemplo: Para efectos de determinar el valor de tipo de cambio de una transacción realizada con fecha 21, 22 o 23 de mayo de 2021, se tendría que recurrir al valor de tipo de cambio que el Banco Central fijó para el jueves 20 de mayo de 2021. En el caso de transacciones efectuadas en moneda extranjera se recomienda acompañar documento, como captura de pantalla, que dé cuenta del valor del tipo de cambio que establece el Banco Central para la fecha de transacción del bien o servicio adquirido; En el caso de reembolso por pago de artículos científicos o papers se debe acompañar algún documento que dé cuenta de dicha publicación; En el caso de que los documentos acompañados no permitan acreditar que el bien o servicio ha sido adquirido por la persona cuyo reembolso se pretende, se debe acompañar respaldo de jefe/a de servicio, director/a de proyecto u otro, con el detalle del pago hecho por funcionario/a. No obstante, se recomienda acompañar dicho respaldo en toda ocasión, toda vez que permite que la tramitación del acto administrativo sea más eficiente, en caso de que falte algún dato en los documentos adjuntos. Adicionalmente, se podrá acompañar:</li>
                    <ol>
                        <li>Carta del jefe/a de servicio, director/a de proyecto u otro entregando antecedentes respecto del reembolso en cuestión.</li>
                        <li>Cualquier otro documento que la Unidad estime conveniente y que otorgue antecedentes para la correcta tramitación del reembolso.</li>
                    </ol>
                    <li><strong>Reintegros en proyectos:</strong> borrador de resolución que autoriza traspaso de fondos a xxx para el cierre del proyecto xxx; carta o certificado de solicitud de reintegro; cartola que indique el valor que corresponde reintegrar; convenio y resolución que aprueba el proyecto original.</li>
                    <li><strong>Adendas o modificaciones de contratos para firma:</strong> documento en PDF; documentos de personerías; convenio original que se modifica.</li>
                    <li><strong>Resolución que aprueba modificaciones de convenios:</strong> borrador de resolución, convenio original que se modifica, documentos de personerías.</li>
                    <li>Añadir el centro de costo a todo lo que implique gastos o ingresos.</li>
                </ul>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 40px 0;">

                <h3 class="qs-subtitle text-teal">Sugerencias de Cláusulas para Convenios</h3>
                
                <h4 style="margin-top: 20px; font-weight: 700;">Resolución de conflictos</h4>
                <ul style="margin-left: 20px;">
                    <li><strong>Convenios internacionales:</strong> La resolución de cualquier disputa relacionada con la interpretación y/o ejecución de este Acuerdo y/o las actividades del proyecto relacionadas con él, se resolverá en primer lugar por negociación amistosa directa entre las partes, a través de sus contrapartes técnicas. A falta de una solución amistosa, las partes acuerdan someter los desacuerdos o conflictos derivados del presente Acuerdo al conocimiento de los tribunales de justicia del domicilio del demandado.</li>
                    <li><strong>Convenios nacionales:</strong> La resolución de cualquier disputa relacionada con la interpretación y/o ejecución de este Acuerdo y/o las actividades del proyecto relacionadas con él, se resolverá en primer lugar por negociación amistosa directa entre las partes, a través de sus contrapartes técnicas. A falta de una solución amistosa, las partes acuerdan someter los desacuerdos o conflictos derivados del presente Acuerdo al conocimiento de los tribunales de justicia del domicilio del demandado.</li>
                </ul>

                <h4 style="margin-top: 20px; font-weight: 700;">Propiedad Intelectual</h4>
                <p>La resolución de cualquier disputa relacionada con la interpretación y/o ejecución de este Acuerdo y/o las actividades del proyecto relacionadas con él, se resolverá en primer lugar por negociación amistosa directa entre las partes, a través de sus contrapartes técnicas. A falta de una solución amistosa, las partes acuerdan someter los desacuerdos o conflictos derivados del presente Acuerdo al conocimiento de los tribunales de justicia del domicilio del demandado.</p>
                <p>La titularidad de los derechos de autor, propiedad intelectual e industrial surgidos con ocasión del desarrollo de trabajos, proyectos o actividades conjuntas en el marco del presente Convenio y que no sean específicamente de propiedad de una de las partes distinguible al efecto como un derecho de propiedad independiente, serán de propiedad conjunta del “XXX” y de la “Universidad” y se aplicarán las normas de propiedad intelectual e industrial vigentes o cualquier otra que rija estas materias en el futuro. </p>

                <h4 style="margin-top: 20px; font-weight: 700;">Secreto y Confidencialidad</h4>
                <p>El Prestador se compromete a guardar secreto y confidencialidad respecto de toda información, verbal o escrita, documentación, correos electrónicos, y cualquier otro antecedente a que tenga acceso en ejercicio de las actividades objeto del presente convenio y que esté sujeta a reserva legal, o que contenga datos de carácter personal, en conformidad a lo dispuesto en la Constitución Política de la República, la Ley Nº 20.285, sobre Acceso a la Información Pública y a las normas pertinentes de la Ley Nº 19.628, sobre Protección de la Vida Privada.</p>

                <h4 style="margin-top: 20px; font-weight: 700;">Clausula sobre el abordaje de la Violencia de Género</h4>
                <p>La Universidad de Santiago de Chile y (nombre de la institución con la que se celebra el contrato o convenio) declaran conocer, comprender y aceptar la aplicación de la Ley 21.369 que Regula el Acoso Sexual, la Violencia y la Discriminanción de Género en el Ámbito de la Educación Superior, así como la normativa interna en materia de acoso sexual, violencia, discriminación de género contenida en la Resolución Exenta N°9011/2023, denominada Politica Integral para el Abordaje de la Violencia de Género de la Universidad de Santiago de Chile, que se anexa a este instrumento.</p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 40px 0;">

                <h3 class="qs-subtitle text-teal">Formato Genérico Vistos</h3>
                <p class="vistos-box">
                    (Sin perjuicio de la agregación de la normativa atingente que rige la materia de la resolución). El Decreto con Fuerza de Ley 29, de 2023, del Ministerio de Educación sobre Estatuto Orgánico de la Universidad de Santiago de Chile; el Decreto con Fuerza de Ley 1-19.653 de 2000, del Ministerio Secretaría General de la Presidencia que fija el texto refundido, coordinado y sistematizado de la Ley 18.575 Orgánica Constitucional de Bases Generales de la Administración del Estado; el Decreto con Fuerza de Ley 29 de 2004, que fija el texto refundido, coordinado y sistematizado de la Ley 18.834 que fija el Estatuto Administrativo; la Ley 21.094 sobre Universidades Estatales; el Decreto Supremo 136, de 2022, del Ministerio de Educación sobre nombramiento del Rector de la Universidad de Santiago de Chile; las Resoluciones Exentas 6 y 7 de 2019 y 14 de 2022, de la Contraloría General de la República.
                </p>
                <?php
            }
            ?>
        </div>

    <?php endwhile; endif; ?>

</main>

<hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

<section class="quick-links-container">
    <?php 
    $mis_botones = new WP_Query(array('post_type' => 'boton_home', 'posts_per_page' => -1, 'order' => 'ASC'));
    if ($mis_botones->have_posts()) : while ($mis_botones->have_posts()) : $mis_botones->the_post(); 
        $enlace = get_field('enlace_boton');
        $icono  = get_field('icono_boton');
    ?>
        <a href="<?php echo esc_url($enlace); ?>" class="quick-link-item">
            <div class="icon-wrapper">
                <div class="bg-icon"></div> 
                <?php if($icono): ?><img src="<?php echo esc_url($icono); ?>" alt="Icono"><?php else: ?><img src="<?php echo get_template_directory_uri(); ?>/images/workspace_premium_37dp_00A499_FILL0_wght400_GRAD0_opsz40 1.png" alt="Icono"><?php endif; ?>
            </div>
            <h3><?php the_title(); ?></h3>
        </a>
    <?php endwhile; wp_reset_postdata(); endif; ?>
</section>


<?php get_footer(); ?>