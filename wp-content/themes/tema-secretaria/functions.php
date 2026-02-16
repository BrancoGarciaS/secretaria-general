<?php
function secretaria_setup() {
    // 1. Permitir imágenes destacadas
    add_theme_support('post-thumbnails');

    // 2. Registrar menús
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

// 4. REGISTRAR PATRÓN DE CONTENIDO PARA "CONSEJO DE DISTINCIONES"
function registrar_patron_consejo() {
    register_block_pattern(
        'tema-secretaria/contenido-consejo', 
        array(
            'title'       => 'Consejo de Distinciones (Texto Base)', // Título claro
            'description' => 'Carga el contenido por defecto del consejo',
            'categories'  => array('text', 'featured'), // Agregado 'featured' para que salga más fácil
            'keywords'    => array('consejo', 'distinciones', 'secretaria'), 
            'content'     => '
                <p>La Universidad de Santiago de Chile cuenta con un Consejo de Distinciones, órgano de carácter consultivo creado en 1989 mediante un reglamento, e integrado por académicos de las más altas jerarquías del Plantel y que representan las distintas áreas del conocimiento institucional. La Secretaria General, Sandra Barrera de Proença, se desempeña como Presidenta.</p>
                <p>Los integrantes de este consejo son:</p>
                <ul>
                    <li><strong>Marcelo Díaz Soto</strong>, de la Facultad de Humanidades;</li>
                    <li><strong>Raúl Berrios Espinoza</strong>, de la Facultad de Administración y Economía;</li>
                    <li><strong>Leonora Mendoza Espínola</strong>, de la Facultad de Química Biología;</li>
                    <li><strong>María José Galotto López</strong>, de la Facultad Tecnológica.</li>
                </ul>
                <p>Entre sus tareas, el Consejo de Distinciones debe sugerir, recomendar e informar al Rector u otras autoridades superiores respecto de decisiones de reconocimientos a personas, así como sobre propuestas para identificar lugares de la Universidad con nombres de miembros de la comunidad que hayan destacado por su trayectoria, con el propósito de proyectar su sello de Universidad Estatal y Pública, fortaleciendo la vinculación con la comunidad y reconociendo sus aportes, que contribuyen al desarrollo de nuestro país.</p>
                ',
        )
    );
}
add_action('init', 'registrar_patron_consejo');



// 5. PATRÓN POLÍTICA DE CALIDAD
function registrar_patron_politica() {
    register_block_pattern(
        'tema-secretaria/contenido-politica',
        array(
            'title'       => 'Política de Calidad (Base)',
            'description' => 'Carga la imagen por defecto',
            'categories'  => array('featured'),
            'keywords'    => array('politica', 'calidad', 'imagen'), // Escribe /politica para ver esto
            'content'     => '
                <p class="has-text-align-center">
                    <img src="' . get_template_directory_uri() . '/images/lamina_calidad_isotools_3.png" alt="Política de Calidad" style="width:100%; max-width:800px; height:auto;"/>
                </p>
                ',
        )
    );
}
add_action('init', 'registrar_patron_politica');

// 6. PATRÓN PROCESOS DISCIPLINARIOS
function registrar_patron_procesos() {
    register_block_pattern(
        'tema-secretaria/contenido-procesos',
        array(
            'title'       => 'Procedimientos Disciplinarios (Texto Completo)',
            'description' => 'Carga todo el texto y enlaces de procedimientos',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('procesos', 'disciplinarios', 'sumarios'), // Escribe /procesos para ver esto
            'content'     => '
                <p>La Unidad de Procedimientos disciplinarios es la encargada de realizar y supervisar los diversos sumarios y procedimientos administrativos de la institución.</p>
                <h3 class="wp-block-heading qs-subtitle text-teal">Funciones</h3>
                <ul>
                    <li>Redactar oportunamente las resoluciones que den inicio a los sumarios administrativos e investigaciones sumarias del sistema de alumnos. Redactar la resolución que aplica medida disciplinaria en cada caso, notificarla al afectado y recibir el recurso administrativo que proceda según la normativa legal. Redactar la resolución de término que aprueba el procedimiento disciplinario, sea sobreseyendo, absolviendo o aplicando una medida disciplinaria.</li>
                    <li>Organizar, coordinar y supervisar la gestión a nivel interno, de la totalidad de los litigios institucionales, tanto a nivel de tribunales como de otros organismos de la administración del Estado.</li>
                    <li>Una vez iniciado un proceso disciplinario, citar a cada fiscal designado a una primera reunión de inducción, con el objeto de dar los insumos y capacitación necesaria para desempeñar su función investigadora.</li>
                    <li>Supervisar la tramitación de los procedimientos disciplinarios por parte de los fiscales, quienes deben realizar reportes periódicos del avance del proceso, manteniendo una comunicación eficaz y fluida con la coordinadora.</li>
                    <li>Apoyar a los fiscales en su labor, proporcionándoles información sobre la normativa legal vigente, dictámenes de Contraloría General de la República, y orientación clara y precisa sobre las etapas del proceso disciplinario.</li>
                    <li>Revisar los expedientes entregados por los fiscales al término de su labor, emitiendo un Informe en Derecho en el cual se comunique al Director Jurídico las sugerencias respecto al resultado de la investigación, dando curso progresivo al proceso disciplinario.</li>
                    <li>Presidir la Comisión Interna contemplada en el Protocolo de Acoso Sexual y de discriminación, la cual tiene por objeto:</li>
                        <ul style="margin-left: 20px; margin-top: 10px; list-style-type: circle;">
                            <li>Apoyar a los fiscales encargados de investigar denuncias sobre estos temas en la Universidad, tanto en el análisis del caso como también en la adopción de medidas preventivas.</li>
                            <li>Implementar medidas preventivas de acoso y discriminación a través de charlas y capacitaciones a funcionarios y estudiantes.</li>
                            <li>Implementar talleres de capacitación a fiscales para realizar su labor investigativa, impartidos por profesionales expertos en la materia (PDI, CAVAS).</li>
                        </ul>
                    <li>Mantener una base de datos informática que contenga la información completa sobre los procedimientos disciplinarios tramitados en Fiscalía, para fines de control y entrega de información cuando corresponda, especialmente para tramitación de juicios, tramitación de renuncias, cancelación de pólizas, entrega de cargos directivos, y entrega de medallas, entre otros.</li>
                </ul>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">
                <p><strong>Manual de procedimientos disciplinarios:</strong> <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/8310-2021_manual_de_procedimientos_disciplinarios.pdf" target="_blank" rel="noreferrer noopener">Hacer clic acá</a></p>
                <p>Descarga el formulario de Denuncia por Acoso Laboral o Violencia en el trabajo (llenar y enviar al correo <a href="mailto:denuncia.acosolaboral@usach.cl">denuncia.acosolaboral@usach.cl</a>)</p>
                <p><strong>Formulario de denuncia en materia de acoso laboral:</strong> <a href="https://view.officeapps.live.com/op/view.aspx?src=https%3A%2F%2Fsecretaria.usach.cl%2Fsites%2Fsecretaria%2Ffiles%2Fpaginas%2Fformulario_de_denuncia_acoso_laboral_de_la_universidad_de_santiago_de_chile_0.docx&wdOrigin=BROWSELINK" target="_blank" rel="noreferrer noopener">Hacer clic acá</a></p>
                <p><strong>Agenda de Atención Psicojurídica:</strong> <a href="https://calendar.app.google/tNNLF3zTSJzdDFGE7" target="_blank" rel="noreferrer noopener">Agendar aquí</a></p>
                <p style="margin-top: 30px; font-size: 0.9em; color: #666;">Cualquier otra denuncia puede ser enviada a través del Sistema de Trazabilidad Documental (STD), a la Unidad de Procedimientos Disciplinarios, perteneciente a la Dirección de Promoción del Cumplimiento o al correo: <a href="mailto:upd@usach.cl" style="color: #00A499;">upd@usach.cl</a></p>
                ',
        )
    );
}
add_action('init', 'registrar_patron_procesos');

// 7. PATRÓN TÍTULOS Y GRADOS
function registrar_patron_titulos() {
    register_block_pattern(
        'tema-secretaria/contenido-titulos',
        array(
            'title'       => 'Títulos y Grados (Texto Completo)',
            'description' => 'Contenido completo con tabla de precios',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('titulos', 'grados', 'precios'), // Comando /titulos
            'content'     => '
                <p>La Unidad de Títulos y Grados de la Secretaría General, es la encargada de los requerimientos en el proceso de otorgamiento de títulos y grados de las y los estudiantes que hayan cumplido con las normas establecidas en la reglamentación vigente de la Institución, junto con la entrega de documentación que requiera el titulado/graduado, tales como legalizaciones, duplicado de diplomas y certificados en trámite.</p>
                <h3 class="wp-block-heading qs-subtitle text-teal">Solicitud y descarga de certificados</h3>
                <p>Puede realizar sus trámites en: <a href="https://serviciosweb.usach.cl/" target="_blank" rel="noreferrer noopener" style="color: #EA7600; font-weight: bold;">https://serviciosweb.usach.cl/</a></p>
                <p>El portal requiere ingresar con el correo Usach. En caso de no tenerla o no recordar su contraseña, puede ingresar con su Clave Única.</p>
                <h4 class="wp-block-heading">Se pueden realizar las siguientes solicitudes:</h4>
                <div style="overflow-x: auto;"> 
                    <table class="price-table">
                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>1ra vez en el año</th>
                                <th>2da vez en el año</th>
                                <th>3ra vez o más</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>Certificado Título profesional</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de grado académico (copia)</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Magíster (copia)</td><td>Exento</td><td>Exento</td><td>$31.000.-</td></tr>
                            <tr><td>Certificado de Doctorado (copia)</td><td>Exento</td><td>Exento</td><td>$31.000.-</td></tr>
                            <tr><td>Certificado de Diplomado (copia)</td><td>Exento</td><td>Exento</td><td>$38.000.-</td></tr>
                            <tr><td>Certificado de Minor (copia)</td><td>Exento</td><td>Exento</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Postítulo (copia)</td><td>Exento</td><td>Exento</td><td>$58.000.-</td></tr>
                            <tr><td>Duplicado de diploma</td><td>$164.000.-</td><td>$164.000.-</td><td>$164.000.-</td></tr>
                            <tr><td>Canje o revalidación</td><td>$245.000.-</td><td>$245.000.-</td><td>$245.000.-</td></tr>
                            <tr><td>Legalizaciones por documento</td><td>$27.000</td><td>$27.000</td><td>$27.000</td></tr>
                            <tr><td>Certificado de Titulo en trámite (copia)</td><td>$17.000.-</td><td>$17.000.-</td><td>$17.000.-</td></tr>
                            <tr><td>Certificado de Grado en trámite (copia)</td><td>$17.000.-</td><td>$17.000.-</td><td>$17.000.-</td></tr>
                        </tbody>
                    </table>
                </div>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">
                <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <h4 style="color: #00A499;">Consultas:</h4>
                        <p>Envíe correo electrónico a <a href="mailto:utg@usach.cl" style="color: #394049; font-weight: bold;">utg@usach.cl</a></p>
                    </div>
                    <div style="flex: 1; min-width: 250px;">
                        <h4 style="color: #00A499;">Atención presencial:</h4>
                        <p><strong>Horario:</strong> Lunes a sábado de 9:00 a 14:00 horas</p>
                        <p><strong>Dirección:</strong> Ruiz Tagle 0140, esquina Víctor Jara (Ex Ecuador). Estación Central. Santiago.</p>
                        <p style="font-size: 0.9em; font-style: italic;">La Oficina de Títulos y Grados no atiende en días festivos ni durante el receso universitario.</p>
                    </div>
                </div>
                ',
        )
    );
}
add_action('init', 'registrar_patron_titulos');

// 8. PATRÓN DOCUMENTACIÓN
function registrar_patron_documentacion() {
    register_block_pattern(
        'tema-secretaria/contenido-documentacion',
        array(
            'title'       => 'Documentación y Resolución (Texto Completo)',
            'description' => 'Contenido completo con requisitos y formatos',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('documentacion', 'resolucion', 'convenios'), // Comando /documentacion
            'content'     => '
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
                ',
        )
    );
}
add_action('init', 'registrar_patron_documentacion');

// 9. PATRÓN COMETIDOS FUNCIONARIOS
function registrar_patron_cometidos() {
    register_block_pattern(
        'tema-secretaria/contenido-cometidos',
        array(
            'title'       => 'Cometidos Funcionarios (Texto Completo)',
            'description' => 'Contenido con información de contacto y descargas',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('cometidos', 'funcionarios', 'viaticos'),
            'content'     => '
                <div class="contact-box" style="background-color: #f9f9f9; border-left: 4px solid #00A499; padding: 15px; margin-bottom: 20px;">
                    <p><strong>Ministra de Fe de los cometidos funcionarios:</strong> Loreto Malebrán Rivera</p>
                    <p><strong>Correo Electrónico:</strong> <a href="mailto:loreto.malebran@usach.cl" style="color: #394049;">loreto.malebran@usach.cl</a></p>
                    <p><strong>Teléfono IP:</strong> 227180135</p>
                </div>

                <h3 class="qs-subtitle text-teal">Requisitos para creación</h3>
                <p>Para la creación de un Cometido Funcionario en General, lo mínimo que deberán adjuntar:</p>
                <ol style="margin-left: 20px; margin-bottom: 20px;">
                    <li>Autorización de la jefatura.</li>
                    <li>Certificado de cargo emitido a la fecha de la solicitud (<a href="https://www.funcionarios.usach.cl/intranet/" target="_blank" style="color: #EA7600;">Intranet Funcionarios</a>).</li>
                    <li>Constancia financiera.</li>
                    <li>Pasajes.</li>
                    <li>Programa de trabajo.</li>
                </ol>
                
                <p>Cabe señalar que la tabla de viáticos desde Junio 2025 es la siguiente (página 4 en ambos estamentos): <a href="https://www.funcionarios.usach.cl/portal/index.php?id=20240105114756" target="_blank" style="color: #EA7600;">Ver Tabla</a></p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Ley 18.834 sobre Estatuto Administrativo</h3>
                <p>De acuerdo al Artículo 99 del DFL 29, que fija el texto refundido, coordinado y sistematizado de la Ley 18.834 sobre Estatuto Administrativo del Ministerio de Hacienda, establece que, el derecho al cobro de las signaciones de un cometido funcionario, prescribirá en el plazo de seis meses contado desde la fecha en que se hicieron exigibles.</p>
                
                <p>Es necesario tener presente que todos los cometidos funcionarios que se realicen, deben considerar el Decreto 90 del Ministerio de Hacienda que define localidades para efecto del pago de viáticos.  En este contexto se infoma que las comunas que no se debe pagar viatico dentro de la Región Metropolitana son:  Santiago, San Miguel, San Joaquín, San Ramón, La Cisterna, San Bernardo, Puente Alto, La Granja, La Pintana, La Florida, Peñalolén, Macul, Ñuñoa, La Reina, Las Condes, Providencia, Conchalí, Quilicura, Renca, Lo Prado, Cerro Navia, Quinta Normal, Pudahuel, Estación Central, Maipú, Cerrillos, El Bosque, Recoleta, Vitacura, Lo Espejo, Independencia, Pedro Aguirre Cerda, Huechuraba, Lo Barnechea, Lampa, Calera de Tango, Padre Hurtado, Peñaflor, El Monte, Isla de Maipo, Buin, Paine, Pirque, y Colina.</p>
                
                <p><em>Excepción de la localidad de Farellones de la comuna de Lo Barnechea y las localidades de Chacabuco, Peldehue y Colina Oriente, de la comuna de Colina que sí puede tener viático.</em></p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Creación de cometidos funcionarios para la Sociedad de Desarrollo Tecnológico (STD)</h3>
                <p>Para estos efectos, la unidad académica o administrativa respectiva deberá solicitar por correo a las Efusach (<a href="mailto:ingresoderequerimientosefusach@usach.cl" style="color: #00A499;">ingresoderequerimientosefusach@usach.cl</a>) la emisión de un certificado de disponibilidad presupuestaria, que acredite que el proyecto dispone de los fondos necesarios, a la fecha de su emisión, los cuales se mantendrán reservados hasta el pago.</p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Normas / Formatos de Resoluciones y Otros</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/dto-262_03-may-1977.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Decreto 262 (03-mayo-1977)</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/decreto-90-exento_21-mar-2018.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Decreto 90 Exento (21-marzo-2018)</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/resolucion_36_de_la_contraloria_general_de_la_republica.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Resolución 36 Contraloría General</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/vistos_y_considerandos_estandar_cometido_funcionario_actualizado_1.docx" target="_blank" style="color: #00A499; font-weight: 700;">Formato de resolución USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_modifica_rectifica_actualizado2025.docx" target="_blank" style="color: #00A499; font-weight: 700;">Formato resolución modifica y rectifica USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/autorizacion_cometidos_funcionarios_actualizado.doc" target="_blank" style="color: #00A499; font-weight: 700;">Formato autorización de Jefatura USACH</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/borrador_res._autoriza_reembolso_noviembre2024.docx" target="_blank" style="color: #00A499; font-weight: 700;">Borrador Autoriza Reembolso (Noviembre 2024)</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_constaciafinanciera_dic.2024.docx" target="_blank" style="color: #00A499; font-weight: 700;">Formato constancia financiera USACH</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/1._cometido_funcionario_r_nacional_matriz_1_0.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Formato resolución SDT</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/3._cometido_funcionario_parcial_nacional_matriz.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Formato resolución SDT (mitad SDT y USACH)</a></li>
                    <li>📝 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/2._rectifica_r_cometido_funcionario_nacional_matriz_1.docx" target="_blank" style="color: #00A499; font-weight: 700;">Formato de rectificación y modificación SDT</a></li>
                    <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formato_certificado_disponibilidad_financiera_sdt.pdf" target="_blank" style="color: #00A499; font-weight: 700;">Certificado disponibilidad financiera SDT (solicitarlo a la SDT)</a></li>
                </ul>
                ',
        )
    );
}
add_action('init', 'registrar_patron_cometidos');

// 10. PATRÓN CONVOCA ELECCIONES
function registrar_patron_elecciones() {
    register_block_pattern(
        'tema-secretaria/contenido-elecciones',
        array(
            'title'       => 'Convoca Elecciones (Texto Completo)',
            'description' => 'Contenido de elecciones con botón destacado',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('elecciones', 'convoca', 'votar'),
            'content'     => '
                <p>El jueves 8 de agosto se llevarán a cabo elecciones en la Universidad de Santiago de Chile, entre ellas, la que busca elegir a un integrante no académico, representante del personal profesional y técnico para conformar el <strong>Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad</strong>.</p>
                
                <p>Es importante señalar que este comité estará integrado por un o una representante del personal académico, un o una representante del profesorado por hora de clases, un o una representante del personal profesional y técnico y dos representantes estudiantiles.</p>

                <p>El Comité Asesor de la Vicerrectoría de Calidad de Vida, Género, Equidad y Diversidad es un órgano consultivo de la Vicerrectoría y tiene como principal objetivo asesorar y/o proponer acciones en temas y/o aspectos que incidan en la calidad de vida de las personas que conforman la comunidad de la Universidad de Santiago de Chile, aportando distintas miradas acerca de la promoción, desarrollo y mantención de su bienestar, velando por sus derechos y promoviendo la equidad.</p>

                <h3 class="qs-subtitle text-teal" style="margin-top: 30px;">Otros procesos eleccionarios del día:</h3>
                Otro proceso que se desarrollará el mismo día, será la elección de <strong>Decano o Decana de la Facultad de Química y Biología.</strong>

                Los otros procesos que también tendrán lugar el jueves 8 de agosto son:
                <ul style="margin-left: 20px; margin-bottom: 20px; list-style-type: disc;">
                    <li>Consejero o Consejera Departamento de Gestión Agraria.</li>
                    <li>Director o Directora del Instituto de Estudios Avanzados.</li>
                    <li>Representante del Estamento Administrativo ante el Consejo de la Facultad de Ingeniería.</li>
                </ul>

                <div style="text-align: center; margin: 30px 0;">
                    <p style="font-size: 1.2em; font-weight: 700;">Para votar debes ingresar al siguiente link:</p>
                    <a href="https://eleccionesusach.cl/" target="_blank" class="highlight-link">IR A ELECCIONESUSACH.CL</a>
                </div>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">

                <h3 class="qs-subtitle text-teal">Documentos y Descargas</h3>
                <ul style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/padron_electores_vicaviged.pdf" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Padrones de electores para representante del personal profesional y técnico para conformar el Comité Asesor VICAVIGED</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/calendario_elecciones_vicaviged_8_de_agosto_def.pdf" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Calendario del proceso de elecciones 8 de agosto 2024</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/formulario_de_inscripcion_de_candidatura_0.docx" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Formulario de inscripción de candidaturas</a></li>
                </ul>

                <div style="background-color: #fff8e1; border-left: 4px solid #EA7600; padding: 15px; margin-top: 20px;">
                    <p>A partir de lo informado en el calendario, el período para impugnar dichas candidaturas finaliza el miércoles 31 de julio 2024. En este caso, los antecedentes deben ser enviados a <a href="mailto:impugnacioneselectorales@usach.cl" style="color: #EA7600;">impugnacioneselectorales@usach.cl</a> junto con señalar los requisitos que se verían eventualmente incumplidos.</p>
                    <p>Se recuerda que quienes los candidatos y candidatas deben cumplir con los siguientes requisitos: Ser funcionarios no académicos y funcionarias no académicas que tengan un nombramiento vigente en propiedad o en la contrata asimilado a planta profesional o técnica, que cuenten con una antigüedad interrumpida de dos años en la Universidad, en esta calidad, al 19 de julio de 2024.</p>
                </div>

                <p style="margin-top: 20px;">
                    <strong>Las candidaturas del Comité Asesor para VICAVIGED pueden ser conocidas aquí:</strong> <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/candidatos_elecciones_vicaviged_8_de_agosto.xlsx" target="_blank" style="color: #EA7600; font-weight: 700; text-decoration: none;">Candidatos a elecciones Comité Asesor de VICAVIGED de las plantas profesionales y técnicos</a>
                </p>
                ',
        )
    );
}
add_action('init', 'registrar_patron_elecciones');

// 11. PATRÓN PREGUNTAS FRECUENTES (FAQ)
function registrar_patron_faq() {
    register_block_pattern(
        'tema-secretaria/contenido-faq',
        array(
            'title'       => 'Preguntas Frecuentes (FAQ Base)',
            'description' => 'Listado de preguntas y respuestas',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('faq', 'preguntas', 'dudas'), // Comando /faq
            'content'     => '
                <h3 class="qs-subtitle text-teal">a) ¿Dónde está ubicada la Secretaría General?</h3>
                <p>La Secretaría General se encuentra ubicada en la oficina 309, tercer piso de la Casa Central. Su dirección es Avenida Libertador Bernardo O´higgins N° 3363, comuna de Estación Central. Región Metropolitana.</p>
                
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

                <h3 class="qs-subtitle text-teal">b) ¿Dónde está ubicada la Unidad de Títulos y Grados?</h3>
                <p>La Unidad de Títulos y Grados está ubicada en la calle Ruiz Tagle 140, comuna de Estación Central. Su horario de atención es de lunes a viernes de 9.00 a 13.00 hrs.</p>

                <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

                <h3 class="qs-subtitle text-teal">c) ¿Cómo puedo obtener una reunión con la Secretaria General?</h3>
                <p>La solicitud de reunión se debe realizar a través de la plataforma de Lobby en el siguiente link: <a href="https://www.leylobby.gob.cl/admin/auth/prelogin?redirect_int=https://www.leylobby.gob.cl/" target="_blank" style="color: #EA7600; font-weight: bold;">Plataforma Ley de Lobby</a></p>
                ',
        )
    );
}
add_action('init', 'registrar_patron_faq');

// 12. PATRÓN CALENDARIO ACADÉMICO
function registrar_patron_calendario() {
    register_block_pattern(
        'tema-secretaria/contenido-calendario',
        array(
            'title'       => 'Calendario Académico (Base)',
            'description' => 'Lista de calendarios para descargar',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('calendario', 'academico', 'fechas'), // Comando /calendario
            'content'     => '
                <h3 class="qs-subtitle text-teal">Descarga de Calendarios</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 15px;">📥 <a href="http://file///D:/Usach/Desktop/calendario_academico_2025_v3.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2025 (Resolución 10200 del 16 de diciembre de 2024)</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/f_rex_11012_2023_fija_calendario_de_actividades_universitarias_para_el_a_o_2024_.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2024 (Resolución 11012 del 29 de diciembre 2023)</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/5121-2023.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario modificado 2023 (Resolución 5121 del 29 de junio de 2023)</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/2613-2023.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario modificado 2023 (Resolución 2613 del 5 de mayo 2023)</a></li>
                    <li style="margin-bottom: 15px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/11770-2022.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Calendario Académico 2023 (Resolución 11770 del 14 de diciembre 2022)</a></li>
                </ul>
                ',
        )
    );
}
add_action('init', 'registrar_patron_calendario');
// 13. PATRÓN DECLARACIÓN DE INTERESES (DIP) - CORREGIDO
function registrar_patron_dip() {
    // Obtenemos la URL del tema ANTES de meterla en el string
    $theme_url = get_template_directory_uri(); 

    register_block_pattern(
        'tema-secretaria/contenido-dip',
        array(
            'title'       => 'Declaración Intereses y Patrimonio (Texto Completo)',
            'description' => 'Contenido sobre la ley 20.880 y enlaces DIP',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('dip', 'declaracion', 'intereses', 'patrimonio'),
            'content'     => '
                <p>La Ley 20.880 sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, regula el principio de probidad en el ejercicio de la función pública y la prevención y sanción de conflictos de intereses. El principio de probidad en la función pública consiste en observar una conducta funcionaria intachable, un desempeño honesto y leal de la función o cargo con preeminencia del interés general sobre el particular.</p>
                <p>De acuerdo a lo dispuesto en la Ley 20.880, sobre Probidad en la Función Pública y Prevención de los Conflictos de Intereses, corresponde que todos los meses de marzo debe actualizar, según corresponda, la información contenida en la Declaración de Intereses y Patrimonio.</p>
                <p>En la Universidad de Santiago de Chile están obligados a efectuar dicha declaración, y por ende a su actualización, las autoridades y personal de planta y a contrata, que sean directivos, profesionales y técnicos que se desempeñen hasta el tercer nivel jerárquico.</p>
                <p>Por normativa interna deberán prestar dicha declaración quienes registran nombramiento o contratación desde el grado 5° o superior de la Escala de Remuneraciones Usach, independiente que sean o no jefaturas.</p>
                <p>Además, deberán realizar esta declaración aquellas personas que se desempeñen como directivos, sin importar su grado, y también aquellas contratadas a honorarios por un monto bruto mensual superior a <strong>$2.815.631</strong>, y cuyo contrato sea por el plazo mínimo de un año.</p>
                <p>También deberán realizar esta declaración aquellas personas que sirvan en más de un empleo y que la suma de sus remuneraciones y/o honorarios alcancen el monto señalado en el párrafo anterior.</p>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">
                <h3 class="wp-block-heading qs-subtitle text-teal">Documentos y Enlaces</h3>
                <ul>
                    <li>📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/instructivo_dip_2023_paso_a_paso.pdf" target="_blank" rel="noreferrer noopener" style="color:#EA7600;font-weight:bold">Presione aquí para conocer el instructivo, de cómo realizar la declaración de Intereses y Patrimonio</a></li>
                    <li>📄 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/manual_dip_2023.pdf" target="_blank" rel="noreferrer noopener" style="color:#EA7600;font-weight:bold">Presione aquí para conocer el manual de procedimiento de Declaraciones de Intereses y Patrimonio</a></li>
                </ul>
                <div class="wp-block-group has-text-align-center" style="margin:30px 0">
                    <p style="font-weight:700;margin-bottom:10px">Para realizar su declaración acceda al siguiente link:</p>
                    <a class="highlight-link" href="https://www.declaracionjurada.cl/dip/" target="_blank" rel="noreferrer noopener">IR A DECLARACIONJURADA.CL</a>
                </div>
                <div class="wp-block-group has-background" style="background-color:#f9f9f9;border-left:4px solid #00A499;padding:15px;margin-bottom:20px">
                    <p>De acuerdo con lo establecido en dicha ley, existe un plazo que vence el <strong>31 de marzo de cada año</strong>, para efectuar las actualizaciones de dichas declaraciones.</p>
                    <p style="margin-top:10px"><strong>Contacto:</strong> Unidad de Probidad y Transparencia<br>Para cualquier duda o consulta se puede comunicar con la Unidad de Probidad y Transparencia al IP: 80105 o a su correo electrónico: dip@usach.cl<br><strong>IP:</strong> 80105<br><strong>Correo:</strong> <a href="mailto:dip@usach.cl" style="color:#00A499">dip@usach.cl</a></p>
                </div>
                <h3 class="wp-block-heading qs-subtitle text-teal">Infografías de ayuda</h3>
                <div class="infografia-grid">
                    <div class="infografia-item">
                        <img src="' . $theme_url . '/images/screenshot_20230330_193316_com.instagram.android_1_0.jpg" alt="Infografía 1">
                    </div>
                    <div class="infografia-item">
                        <img src="' . $theme_url . '/images/dip-2024-como-realizar-la-declaracion_-734x1024.png" alt="Infografía 2">
                    </div>
                </div>
                ',
        )
    );
}
add_action('init', 'registrar_patron_dip');
// 14. PATRÓN LEY DE TRANSPARENCIA (CORREGIDO SPANS)
function registrar_patron_transparencia() {
    $theme_url = get_template_directory_uri(); 

    register_block_pattern(
        'tema-secretaria/contenido-transparencia',
        array(
            'title'       => 'Ley de Transparencia (Completo)',
            'description' => 'Contenido con botones de imagen y enlaces',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('transparencia', 'ley', 'saip'), 
            'content'     => '
                <p>De acuerdo a la Ley 20.285 sobre Acceso a la Información Pública, todas las personas tienen derecho a solicitar información a cualquier organismo del Estado, existiendo, además, un organismo como el Consejo para la Transparencia que vela por el derecho ciudadano, estableciendo las formas y los tiempos de respuesta de la solicitudes de información, como así también exigir y regular las publicaciones que cada entidad debe tener en sus sitios electrónicos (Transparencia Activa), preparados para dicho ejercicio.</p>
                <p>La Universidad de Santiago de Chile, como institución pública, debe tener a disposición de las personas el sitio web de Transparencia Activa (TA):</p>
                <div style="text-align: center; margin: 30px 0;"><a href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=UN008" target="_blank" class="transparencia-btn"><img src="' . $theme_url . '/images/folder.png" alt="Icono Carpeta" class="btn-icon"><span class="btn-text-group"><span class="line-main">TRANSPARENCIA ACTIVA</span><span class="line-sub">Ley de Transparencia</span></span></a></div>
                <p>Además de un link a un formulario de Solicitud de Acceso a la Información Pública (SAIP):</p>
                <div style="text-align: center; margin: 30px 0;"><a href="https://www.portaltransparencia.cl/PortalPdT/ingreso-sai-v2?idOrg=1086" target="_blank" class="transparencia-btn"><img src="' . $theme_url . '/images/info.png" alt="Icono Info" class="btn-icon"><span class="btn-text-group"><span class="line-main">SOLICITUD DE INFORMACIÓN</span><span class="line-sub">Ley de Transparencia</span></span></a></div>
                <hr class="wp-block-separator"/>
                <h3 class="wp-block-heading qs-subtitle text-teal">Link de interés</h3>
                <ul class="download-list">
                    <li>🔗 <a href="https://www.secretaria.usach.cl/instructivo-para-solicitar-una-informacion-publica" target="_blank" style="color: #00A499; font-weight: 700;">Instructivo para solicitar una información Pública</a></li>
                    <li>🔗 <a href="https://www.secretaria.usach.cl/como-funciona-la-ley-ndeg20285-sobre-acceso-la-informacion-publica" target="_blank" style="color: #00A499; font-weight: 700;">¿Cómo funciona la Ley 20.285 sobre Acceso a la Información Pública?</a></li>
                    <li>🔗 <a href="https://www.portaltransparencia.cl/PortalPdT/directorio-de-organismos-regulados/?org=UN008" target="_blank" style="color: #00A499; font-weight: 700;">Sitio de Transparencia Activa de la Universidad de Santiago de Chile</a></li>
                    <li>🔗 <a href="https://www.consejotransparencia.cl/" target="_blank" style="color: #00A499; font-weight: 700;">Consejo para la Transparencia</a></li>
                    <li>🔗 <a href="https://extranet.consejotransparencia.cl/Web_SCL2/PaginasP/FormularioSR_New.aspx" target="_blank" style="color: #00A499; font-weight: 700;">¿Cómo y dónde realizar un reclamo por denegación de acceso a la información?</a></li>
                </ul>
                <h3 class="wp-block-heading qs-subtitle text-teal">Descargas</h3>
                <ul class="download-list">
                    <li>📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/transparencia-en-3-pasos.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Transparencia en 3 pasos</a></li>
                    <li>📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/manual-de-la-ciudadania-para-un-buen-uso-de-la-ley-de-transparencia.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Manual para un buen uso de la Ley de Transparencia</a></li>
                    <li>📥 <a href="https://www.secretaria.usach.cl/sites/secretaria/files/paginas/procedimiento_saip_usach.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Procedimiento SAIP USACH</a></li>
                </ul>
                ',
        )
    );
}
add_action('init', 'registrar_patron_transparencia');

// 15. PATRÓN LOBBY
function registrar_patron_lobby() {
    register_block_pattern(
        'tema-secretaria/contenido-lobby',
        array(
            'title'       => 'Lobby USACH (Texto Completo)',
            'description' => 'Información y enlaces sobre Ley de Lobby',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('lobby', 'ley', 'reuniones'), // Comando /lobby
            'content'     => '
                <p>El 8 de marzo de 2014, se publicó la Ley 20.730, que regula el lobby y las gestiones que representen intereses particulares ante las autoridades y funcionarios, constituyéndose en un gran avance para suministrar a la actividad pública herramientas que hagan más transparente su ejercicio.</p>
                <p>La entrada en vigencia de esta ley representa un profundo cambio en la relación entre el Estado y las personas, estableciendo como deber de las autoridades y los funcionarios públicos (que tengan la calidad de “sujetos pasivos”), el registrar y dar publicidad a:</p>
                <ul>
                    <li>Las <strong>reuniones</strong> y audiencias solicitadas por lobbistas y gestores de intereses particulares que tengan como finalidad influir en una decisión pública.</li>
                    <li>Los <strong>viajes</strong> que realicen en el ejercicio de sus funciones.</li>
                    <li>Los <strong>regalos</strong> que reciban en cuanto autoridad o funcionario.</li>
                </ul>
                <hr class="wp-block-separator"/>
                <h3 class="wp-block-heading qs-subtitle text-teal">Accesos Directos</h3>
                <ul>
                    <li>🔗 <a href="http://www.leylobby.gob.cl/instituciones/UN008" target="_blank" rel="noreferrer noopener" style="color:#00A499;font-weight:700">Para revisar aquellas reuniones de los sujetos pasivos de la Universidad haga clic acá</a></li>
                    <li>🔗 <a href="https://www.leylobby.gob.cl/instituciones/UN008" target="_blank" rel="noreferrer noopener" style="color:#00A499;font-weight:700">Si requiere una reunión con una de las autoridades señaladas haga clic acá</a></li>
                    <li>📥 <a href="http://www.leylobby.gob.cl/files/manual_ciudadano%20ley_lobby.pdf" target="_blank" rel="noreferrer noopener" style="color:#EA7600;font-weight:700">Si desea ver o descargar el manual ciudadano de Lobby haga clic acá</a></li>
                    <li>📥 <a href="http://www.leylobby.gob.cl/files/manual_juridico%20ley_lobby.pdf" target="_blank" rel="noreferrer noopener" style="color:#EA7600;font-weight:700">Para acceder y descargar el manual jurídico de Lobby haga clic acá</a></li>
                    <li>📄 <a href="https://drive.google.com/file/d/1I5zI5ZvEHZ-61bPoZ1Hau4L8kRcQONRR/view?usp=drive_link" target="_blank" rel="noreferrer noopener" style="color:#EA7600;font-weight:700">Resolución Exenta N° 5823 (Aprueba Nómina de sujetos pasivos) - Haga clic acá</a></li>
                </ul>
                ',
        )
    );
}
add_action('init', 'registrar_patron_lobby');

// 16. PATRÓN JUNTA DIRECTIVA
function registrar_patron_junta() {
    register_block_pattern(
        'tema-secretaria/contenido-junta',
        array(
            'title'       => 'Junta Directiva (Texto Completo)',
            'description' => 'Listado de autoridades y directores',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('junta', 'directiva', 'autoridades'), // Comando /junta
            'content'     => '
                <p>La Junta Directiva es la máxima autoridad colegiada y su principal rol es supervisar y aprobar la política global de desarrollo de la Universidad de Santiago de Chile, sus planes de mediano y largo plazo, la estructura orgánica de la institución y sus modificaciones; la creación y modificación de grados académicos y títulos profesionales; el presupuesto anual de la Corporación; y el nombramiento de los directivos superiores, entre otras materias.</p>
                <h3 class="qs-subtitle text-teal" style="margin-top: 30px; margin-bottom: 20px;">Integran la Junta Directiva:</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px;">
                    <div>
                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Presidente</h4>
                        <p style="margin-bottom: 15px;">Sr. Gonzalo Salgado Barros</p>

                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Rector</h4>
                        <p style="margin-bottom: 15px;">Dr. Rodrigo Alejandro Vidal Rojas</p>

                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 5px;">Secretario de la Junta Directiva</h4>
                        <p>Sr. Eduardo Enrique Pérez Contreras</p>
                    </div>
                    <div>
                        <h4 style="color: #00A499; font-weight: 800; margin-bottom: 10px;">Directores(as)</h4>
                        <ul style="margin-left: 20px; list-style-type: disc;">
                            <li>Dra. María Jesús Aguirre Quintana</li>
                            <li>Sr. Víctor Alexis Salas Opazo</li>
                            <li>Dr. Gonzalo Javier Gutiérrez Gallardo</li>
                            <li>Dra. Roxana Antonina Cristal Pey Tumanoff</li>
                            <li>Dra. Soledad del Carmen Ramírez Gatica</li>
                        </ul>
                    </div>
                </div>
                <hr style="border: 0; border-top: 1px solid #ddd; margin: 30px 0;">
                <h3 class="qs-subtitle text-teal">Documentos y Actas</h3>
                <ul class="download-list" style="margin-left: 20px; list-style: none;">
                    <li style="margin-bottom: 10px;">🔗 <a href="https://www.secretaria.usach.cl/actas-de-la-junta-directiva" target="_blank" style="color: #00A499; font-weight: 700;">Actas de la Junta Directiva - Haga clic acá</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/nombramiento_integrantes_junta_directiva.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Nombramiento directores internos - Haga clic acá</a></li>
                    <li style="margin-bottom: 10px;">📥 <a href="https://www.transparenciaactiva.usach.cl/sites/default/files/paginas/decreto_supremo_153_de_2022.pdf" target="_blank" style="color: #EA7600; font-weight: 700;">Nombramiento directores externos - Haga clic acá</a></li>
                </ul>
                ',
        )
    );
}
add_action('init', 'registrar_patron_junta');

// 17. PATRÓN CONSEJO ACADÉMICO (LAYOUT CORREGIDO)
function registrar_patron_consejo_academico() {
    register_block_pattern(
        'tema-secretaria/contenido-consejo-academico',
        array(
            'title'       => 'Consejo Académico (Completo con Pestañas)',
            'description' => 'Estructura de pestañas con integrantes, actas y audios',
            'categories'  => array('text', 'featured'),
            'keywords'    => array('consejo', 'academico', 'actas', 'audios'),
            'content'     => '
                <div class="qs-layout" style="margin-top: 40px; margin-bottom: 40px;"><aside class="qs-sidebar"><button class="qs-btn active" onclick="openTab(event, \'consejo\')">Consejo Académico</button><button class="qs-btn" onclick="openTab(event, \'integrantes\')">Integrantes</button><button class="qs-btn" onclick="openTab(event, \'actas\')">Actas</button><button class="qs-btn" onclick="openTab(event, \'audios\')">Audios</button></aside><main class="qs-content-area"><div class="qs-card" style="min-height: 500px;"><div id="consejo" class="tab-content active-content" style="display:block;"><h3 class="qs-subtitle text-teal">Consejo Académico</h3><div class="qs-text-block"><p>El Consejo Académico es un organismo colegiado que asesora y actúa como cuerpo consultivo del Rector en materias de carácter académico. Tiene la particularidad que sus integrantes son elegidos democráticamente, a través de votaciones, por sus pares y representan a los tres estamentos de la Universidad: académico, administrativo y estudiantil.</p></div></div><div id="integrantes" class="tab-content" style="display:block;"><h3 class="qs-subtitle text-teal">Integrantes del Consejo Académico</h3><div class="qs-text-block"><div style="overflow-x: auto;"><table class="price-table"><thead><tr><th colspan="2">Autoridades</th></tr></thead><tbody><tr><td>Rector (Presidente del Consejo)</td><td>Sr. Rodrigo Vidal Rojas</td></tr><tr><td>Vicerrectora Académica</td><td>Sra. Leonora Mendoza Espínola</td></tr><tr><td>Vicerrector Investigación, Innovación y Creación</td><td>Sr. Alberto Monsalve González</td></tr><tr><td>Decano Facultad de Ingeniería</td><td>Sr. Cristián Vargas Riquelme</td></tr><tr><td>Decano Facultad de Ciencias Médicas</td><td>Sr. Alejandro Guajardo Córdoba</td></tr><tr><td>Decano Facultad de Química y Biología</td><td>Sr. Bernardo Morales Muñoz</td></tr><tr><td>Decano Facultad Tecnológica</td><td>Sr. Alvaro Aguirre Boza</td></tr><tr><td>Decano Facultad de Ciencia</td><td>Sr. Juan Escrig Murúa</td></tr><tr><td>Decana Facultad de Humanidades</td><td>Sra. Cristina Moyano Barahona</td></tr><tr><td>Decano Facultad de Administración y Economía</td><td>Sr. Raúl Berríos Espinoza</td></tr><tr><td>Decano Facultad de Derecho</td><td>Sr. Jaime Bustos Maldonado</td></tr><tr><td>Decano Facultad de Arquitectura y Ambiente Construido</td><td>Sr. Rodolfo Jiménez Cavieres</td></tr><tr><td>Secretaria General (Ministro de Fe)</td><td>Sra. Sandra Barrera de Proença</td></tr></tbody></table><table class="price-table"><thead><tr><th>Consejeros Académicos</th></tr></thead><tbody><tr><td>Sr. Miguel Reyes Parada</td></tr><tr><td>Sr. Claudio Urrea Oñate</td></tr><tr><td>Sr. Claudio Martínez Fernández</td></tr><tr><td>Sr. Hernán Neira Barrera</td></tr><tr><td>Sr. José Noguera Santaella</td></tr></tbody></table></div></div></div><div id="actas" class="tab-content" style="display:block;"><div class="qs-text-block"><h3 class="qs-subtitle text-teal">Actas del Consejo Académico</h3><h4 style="margin-top: 20px; font-weight: 800;">Actas 2024</h4><ul class="download-list" style="margin-left: 20px;"><li>📄 <a href="https://drive.google.com/file/d/1KfT4PM19hocna8JFOWOSAHKdBy4G6d8a/view?usp=drive_link" target="_blank">Sesión Ordinaria N°1</a></li><li>📄 <a href="https://drive.google.com/file/d/1iig9BnhhvaZ2yTeMIq3362X7QjDQIKhk/view?usp=drive_link" target="_blank">Sesión Ordinaria N°2</a></li><li>📄 <a href="https://drive.google.com/file/d/1ACbWGSooQ7RfePZaVWAKun2cMpUtfa2j/view?usp=drive_link" target="_blank">Sesión Ordinaria N°3</a></li><li>📄 <a href="https://drive.google.com/file/d/1o2-TDkzj3FvA1d5v5HmJh-Q2GChHPJQd/view?usp=drive_link" target="_blank">Sesión Ordinaria N°4</a></li><li>📄 <a href="https://drive.google.com/file/d/1Isp7lFPDUQ02HuImpJTBqniK11GXS4N5/view" target="_blank">Sesión Ordinaria N°5</a></li><li>📄 <a href="https://drive.google.com/file/d/15CulCz5OZjqAZa89G5H00T_CM_b3HikO/view" target="_blank">Sesión Ordinaria N°6</a></li></ul></div></div><div id="audios" class="tab-content" style="display:block;"><div class="qs-text-block"><h3 class="qs-subtitle text-teal">Audios del Consejo Académico</h3><h4 style="margin-top: 20px; font-weight: 800;">Sesiones Ordinarias 2024</h4><ul class="download-list" style="margin-left: 20px;"><li>🔊 <a href="https://drive.google.com/file/d/12lU3R70cWlHor5UUhg4QG1UqoPnWmbhv/view" target="_blank">Audio Sesión 1</a></li><li>🔊 <a href="https://drive.google.com/file/d/1psR06cnnlvDDg661_okvKpMFx8Jng_zu/view?usp=drive_link" target="_blank">Audio Sesión 2</a></li></ul></div></div></div></main></div>
                ',
        )
    );
}
add_action('init', 'registrar_patron_consejo_academico');
?>