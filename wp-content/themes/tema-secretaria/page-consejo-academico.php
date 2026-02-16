<?php 
/*
 * Template Name: Consejo Académico (Híbrida)
 */
get_header(); 
?>

<section class="section-title-bar" style="margin-top: 40px;">
    <h2><?php the_title(); ?></h2>
</section>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php 
    if ( get_the_content() ) {
        // Si el usuario edita la página, mostramos su contenido (el patrón insertado)
        ?>
        <div style="max-width: 1400px; margin: 40px auto; padding: 0 20px;">
            <?php the_content(); ?>
        </div>
        <?php
    } else {
        // --- CONTENIDO POR DEFECTO (Estructura de Pestañas) ---
        ?>
        <div class="qs-layout" style="margin-top: 40px; margin-bottom: 40px;">
            
            <aside class="qs-sidebar">
                <button class="qs-btn active" onclick="openTab(event, 'consejo')">Consejo Académico</button>
                <button class="qs-btn" onclick="openTab(event, 'integrantes')">Integrantes</button>
                <button class="qs-btn" onclick="openTab(event, 'actas')">Actas</button>
                <button class="qs-btn" onclick="openTab(event, 'audios')">Audios</button>
            </aside>

            <main class="qs-content-area">
                <div class="qs-card" style="min-height: 500px;">
                    
                    <div id="consejo" class="tab-content active-content">
                        <h3 class="qs-subtitle text-teal">Consejo Académico</h3>
                        <div class="qs-text-block">
                            <p>El Consejo Académico es un organismo colegiado que asesora y actúa como cuerpo consultivo del Rector en materias de carácter académico. Tiene la particularidad que sus integrantes son elegidos democráticamente, a través de votaciones, por sus pares y representan a los tres estamentos de la Universidad: académico, administrativo y estudiantil.</p>
                        </div>
                    </div>

                    <div id="integrantes" class="tab-content">
                        <h3 class="qs-subtitle text-teal">Integrantes del Consejo Académico</h3>
                        <div class="qs-text-block">
                            <div style="overflow-x: auto;">
                                <table class="price-table">
                                    <thead><tr><th colspan="2">Autoridades</th></tr></thead>
                                    <tbody>
                                        <tr><td>Rector (Presidente del Consejo)</td><td>Sr. Rodrigo Vidal Rojas</td></tr>
                                        <tr><td>Vicerrectora Académica</td><td>Sra. Leonora Mendoza Espínola</td></tr>
                                        <tr><td>Vicerrector Investigación, Innovación y Creación</td><td>Sr. Alberto Monsalve González</td></tr>
                                        <tr><td>Decano Facultad de Ingeniería</td><td>Sr. Cristián Vargas Riquelme</td></tr>
                                        <tr><td>Decano Facultad de Ciencias Médicas</td><td>Sr. Alejandro Guajardo Córdoba</td></tr>
                                        <tr><td>Decano Facultad de Química y Biología</td><td>Sr. Bernardo Morales Muñoz</td></tr>
                                        <tr><td>Decano Facultad Tecnológica</td><td>Sr. Alvaro Aguirre Boza</td></tr>
                                        <tr><td>Decano Facultad de Ciencia</td><td>Sr. Juan Escrig Murúa</td></tr>
                                        <tr><td>Decana Facultad de Humanidades</td><td>Sra. Cristina Moyano Barahona</td></tr>
                                        <tr><td>Decano Facultad de Administración y Economía</td><td>Sr. Raúl Berríos Espinoza</td></tr>
                                        <tr><td>Decano Facultad de Derecho</td><td>Sr. Jaime Bustos Maldonado</td></tr>
                                        <tr><td>Decano Facultad de Arquitectura y Ambiente Construido</td><td>Sr. Rodolfo Jiménez Cavieres</td></tr>
                                        <tr><td>Secretaria General (Ministro de Fe)</td><td>Sra. Sandra Barrera de Proença</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th>Consejeros Académicos Representantes del Cuerpo de Profesores Titulares</th></tr></thead>
                                    <tbody>
                                        <tr><td>Sr. Miguel Reyes Parada</td></tr>
                                        <tr><td>Sr. Claudio Urrea Oñate</td></tr>
                                        <tr><td>Sr. Claudio Martínez Fernández</td></tr>
                                        <tr><td>Sr. Hernán Neira Barrera</td></tr>
                                        <tr><td>Sr. José Noguera Santaella</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th colspan="2">Académicos Representantes de las Facultades</th></tr></thead>
                                    <tbody>
                                        <tr><td>Facultad de Humanidades</td><td>Sr. Sergio González Rodríguez</td></tr>
                                        <tr><td>Facultad de Ingeniería</td><td>Sr. Juan Carlos Espinoza Ramírez</td></tr>
                                        <tr><td>Facultad Tecnológica</td><td>Sr. Gumercindo Vilca Cáceres</td></tr>
                                        <tr><td>Facultad de Química y Biología</td><td>Sra. Maria Angélica Rubio Campos</td></tr>
                                        <tr><td>Facultad de Ciencias Médicas</td><td>Sra. Margarita Baeza Fuentes</td></tr>
                                        <tr><td>Facultad de Ciencia</td><td>Sr. Víctor Salinas Torres</td></tr>
                                        <tr><td>Facultad de Adm. y Economía</td><td>Sr. Héctor Ponce Arias</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th>Representantes Funcionarios No Académicos</th></tr></thead>
                                    <tbody>
                                        <tr><td>Sra. Betsy Saavedra Flores</td></tr>
                                        <tr><td>Sr. Takuri Tapia Muñoz</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th>Representantes Estudiantiles</th></tr></thead>
                                    <tbody>
                                        <tr><td>Sra. Camila Bergaglio Miranda</td></tr>
                                        <tr><td>Sra. Ayllalí Guzmán Sarmiento</td></tr>
                                        <tr><td>Sra. Gabriela Lobo Contreras</td></tr>
                                        <tr><td>Sra. Camila Vargas Vivanco</td></tr>
                                        <tr><td>Sra. Daniela Torres Torres</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th>Representante de Programa de Bachillerato</th></tr></thead>
                                    <tbody>
                                        <tr><td>Sra. Verushka Fuentes Stipicevic</td></tr>
                                    </tbody>
                                </table>
                                <table class="price-table">
                                    <thead><tr><th>Representante de los Profesores y Profesoras por Hora de Clases</th></tr></thead>
                                    <tbody>
                                        <tr><td>Sr. Bruno Jerardino Wiesenborn</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="actas" class="tab-content">
                        <h3 class="qs-subtitle text-teal">Actas del Consejo Académico</h3>
                        
                        <div class="qs-text-block">
                            <h4 style="margin-top: 20px; font-weight: 800;">Actas 2024</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>📄 <a href="https://drive.google.com/file/d/1KfT4PM19hocna8JFOWOSAHKdBy4G6d8a/view?usp=drive_link" target="_blank">Sesión Ordinaria N°1</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1iig9BnhhvaZ2yTeMIq3362X7QjDQIKhk/view?usp=drive_link" target="_blank">Sesión Ordinaria N°2</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1ACbWGSooQ7RfePZaVWAKun2cMpUtfa2j/view?usp=drive_link" target="_blank">Sesión Ordinaria N°3</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1o2-TDkzj3FvA1d5v5HmJh-Q2GChHPJQd/view?usp=drive_link" target="_blank">Sesión Ordinaria N°4</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1Isp7lFPDUQ02HuImpJTBqniK11GXS4N5/view" target="_blank">Sesión Ordinaria N°5</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/15CulCz5OZjqAZa89G5H00T_CM_b3HikO/view" target="_blank">Sesión Ordinaria N°6</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1NwTwSphl15Uunf2GFbu0SAoVXidorUWV/view" target="_blank">Sesión Ordinaria N°7</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1lomoD40Q4LgyaDkvxIMdiXnCLx6ylll8/view?usp=drive_link" target="_blank">Sesión Ordinaria N°8</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1TtD4CnuTSZSf-8LjEdRNnXFPPn_GDAIG/view?usp=drive_link" target="_blank">Sesión Ordinaria N°9</a></li>
                                <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/010_acta_ordinaria_de_consejo_academico_20.11.2024.pdf" target="_blank">Sesión Ordinaria N°10</a></li>
                                <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/011_acta_ordinaria_de_consejo_academico_11.12.2024_1.pdf" target="_blank">Sesión Ordinaria N°11</a></li>
                                <li>📄 <a href="https://secretaria.usach.cl/sites/secretaria/files/paginas/012_acta_ordinaria_de_consejo_academico_18.12.2024.pdf" target="_blank">Sesión Ordinaria N°12</a></li>
                                <li style="margin-top: 10px;">📄 <a href="http://drive.google.com/file/d/1TeM4jbx_oTT4pQDdgwfaXQDnI7H_lkWX/view?usp=drive_link" target="_blank">Sesión Extraordinaria N°1</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1Sm-U_bRwPAkhxSIOe3zDvMzJ6-rLwAR6/view?usp=drive_link" target="_blank">Sesión Extraordinaria N°3</a></li>
                            </ul>

                            <h4 style="margin-top: 20px; font-weight: 800;">Actas 2023</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>📄 <a href="https://drive.google.com/file/d/1_jil4FAcyiPMdYaGZiqM5mMLxWA145mF/view?usp=sharing" target="_blank">Sesión Ordinaria N°1</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1I7ckdQd7qXmoebnEqteJcbvrMiDJPH69/view?usp=sharing" target="_blank">Sesión Ordinaria N°2</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1p1WAFIqOOah5BRRUXgwXbrLl_IJW5ws2/view?usp=drive_link" target="_blank">Sesión Ordinaria N°3</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1XcJH7Cy1bhLWRx8QpT7OeOsqaicfpPEw/view?ts=64b560b0" target="_blank">Sesión Ordinaria N°4</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1fqOCNs9PHjPn0t0zCJkQ0Giw4UlaakOq/view" target="_blank">Sesión Ordinaria N°5</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/16--RNqARoQphYpfW62g-1pYyd6937_UG/view?usp=drive_link" target="_blank">Sesión Ordinaria N°6</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/18jcptWQX1VND90lorrzqy_zMpDLoFKTd/view?usp=drive_link" target="_blank">Sesión Ordinaria N°7</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1xGe9nixgeBHJR-n7d_ZLe3zfR63VkTgF/view?usp=drive_link" target="_blank">Sesión Ordinaria N°8</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1dO4c_Us5nXotmZgn-jgucPhI9V9_wfou/view?usp=drive_link" target="_blank">Sesión Ordinaria N°9</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1lJFbKuB3yjce4XggpdAj7zXV3B6DNB4l/view?usp=drive_link" target="_blank">Sesión Ordinaria N°9a</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1ra45XfBug3dCyr694hf_h8_4cN3NqYlW/view?usp=drive_link" target="_blank">Sesión Ordinaria N°10</a></li>
                                <li style="margin-top: 10px;">📄 <a href="http://drive.google.com/file/d/1BHtkpLnQkei13kAIh5PaBE8y-na3ebjz/view?usp=drive_link" target="_blank">Sesión Extraordinaria N°1</a></li>
                                <li>📄 <a href="https://drive.google.com/file/d/1jqh6HcKtm4__4i5pOeVxMRpdFJ__HKNV/view?usp=drive_link" target="_blank">Sesión Extraordinaria N°2</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="audios" class="tab-content">
                        <h3 class="qs-subtitle text-teal">Audios del Consejo Académico</h3>
                        
                        <div class="qs-text-block">
                            <h4 style="margin-top: 20px; font-weight: 800;">Sesiones Extraordinarias 2025</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>🔊 <a href="https://drive.google.com/file/d/1QqPvXUopALJN-X8HEmiZtrAHEkg-bLbS/view?usp=drive_link" target="_blank">Audio Sesión 1 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1xaEovtJkMdTsqI7tuMQJmbcgAtpj2ouy/view?usp=drive_link" target="_blank">Audio Sesión 2 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1X5Kb1ahTjHem5ZpSxmunFoLzB_ViZJ0_/view?usp=drive_link" target="_blank">Audio Sesión 3 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1w6orsprMh0hpQUSPJtIfNnaSX2tu0B3Q/view?usp=drive_link" target="_blank">Audio Sesión 4 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1ezdPsMS1t4ygrUPBjWb_yMfmEzZ7SVnG/view?usp=drive_link" target="_blank">Audio Sesión 5 Ext.</a></li>
                            </ul>

                            <h4 style="margin-top: 20px; font-weight: 800;">Sesiones Ordinarias 2024</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>🔊 <a href="https://drive.google.com/file/d/12lU3R70cWlHor5UUhg4QG1UqoPnWmbhv/view" target="_blank">Audio Sesión 1</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1psR06cnnlvDDg661_okvKpMFx8Jng_zu/view?usp=drive_link" target="_blank">Audio Sesión 2</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/11WYH3-eUpYxyAd0JyE0tI_8R_89OzqsR/view?usp=drive_link" target="_blank">Audio Sesión 3</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1NQXfFvyJLK1jWHJwcs1R1KATcU4U9-KP/view?usp=drive_web" target="_blank">Audio Sesión 4</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/19OA6JviFAYH7Ap9hARzzeuUGpidWINTW/view?usp=drive_link" target="_blank">Audio Sesión 5</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1nNVdH_z-09H1-MedboEd5t8ZcqyTRbG9/view" target="_blank">Audio Sesión 6</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/12I3A28-nSu_cZeS-QYu6Tx0mEFWZR80L/view" target="_blank">Audio Sesión 7</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1wWIGgZXMaYfTsIXiWcXMiitRejHrWZVd/view?usp=sharing" target="_blank">Audio Sesión 8</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1BboJj94yjtGbYyu9wrmq9fmMAQf0C-bU/view" target="_blank">Audio Sesión 9</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1_khmRnhTv1-Fmva9idm77MbKDUSAxQg1/view?usp=drive_link" target="_blank">Audio Sesión 10</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1xX3JteC4Ah_qQ44Z-nRbdYFRIfrm8Ziw/view?usp=drive_link" target="_blank">Audio Sesión 11</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1wvLfxXmbkrP-UcYKDVLkpgcOsTB9zJPf/view?usp=drive_link" target="_blank">Audio Sesión 12</a></li>
                            </ul>

                            <h4 style="margin-top: 20px; font-weight: 800;">Sesiones Extraordinarias 2024</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>🔊 <a href="https://drive.google.com/file/d/1BfeNwdyESh5-99g9_s1xrZMKGtURSPoC/view?usp=drive_link" target="_blank">Audio Sesión 1 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1i7DEFdX-JkM1xlNNeh7-27PQUObwGkqQ/view?usp=drive_link" target="_blank">Audio Sesión 2 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1oR33lAWKloY0McXCYcSDuQLeJV5IT8Fk/view?usp=drive_link" target="_blank">Audio Sesión 3 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1O-8mRG-T9TVTmIecgYTk3lIA3z8ssp1x/view?usp=drive_link" target="_blank">Audio Sesión 4 Ext.</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/18Od-CaHKonOIL1puqu2RCjAXCMW2NrJe/view?usp=drive_link" target="_blank">Audio Sesión 5 Ext. Parte 1</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/13LwLguwiawOOLUP_NL_vBtR8pKGKxXHa/view?usp=drive_link" target="_blank">Audio Sesión 5 Ext. Parte 2</a></li>
                            </ul>

                            <h4 style="margin-top: 20px; font-weight: 800;">Sesiones Ordinarias 2023</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>🔊 <a href="https://drive.google.com/file/d/1JWfWPaX4eChaCNPU0eNKmQzTA2WIgHd6/view?usp=sharing" target="_blank">Audio Sesión 1</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1ZhYqUZyFOwAoZj9lquCRyWQicPJtvfqq/view?usp=sharing" target="_blank">Audio Sesión 2</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1wHP8v82NgnUPqiFg8JD9LAllpif0bJnh/view?usp=sharing" target="_blank">Audio Sesión 3</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1NttBm582Zmz5VQ2TpLkhk7DfckKmzpV3/view?usp=drive_link" target="_blank">Audio Sesión 4</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/122Xn6k8M3gciLNt2noTAiBmhk6LfgMrc/view" target="_blank">Audio Sesión 5</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1-fatdVWs-IBRafZ-iBhJDNwt3x2Ot9OD/view?usp=drive_link" target="_blank">Audio Sesión 6</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1N4iriQZYbBTZbJvoiFnmkrdlXddYy3zZ/view?usp=drive_link" target="_blank">Audio Sesión 7</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/159QmlXN2BOP8trOyPEjH8Q9PVvkr-stH/view?usp=drive_link" target="_blank">Audio Sesión 8</a></li>
                                <li>🔊 <a href="http://drive.google.com/file/d/18IREQoT4MiKCydJkq_hi7q1IymgndSSQ/view?usp=drive_link" target="_blank">Audio Sesión 9</a></li>
                                <li>🔊 <a href="http://drive.google.com/file/d/1qecDxwVHcd-JtRFzccGgpd3oIXRAj1_P/view?usp=drive_link" target="_blank">Audio Sesión 9a</a></li>
                                <li>🔊 <a href="https://www.youtube.com/watch?v=IeCMO9MrSDM&ab_channel=ComunicacionesVRA" target="_blank">Audio Sesión 10 (YouTube)</a></li>
                                <li>🔊 <a href="https://drive.google.com/file/d/1RGi6H2eO8TtyCMpRzhvQH-FhbC3oPkB-/view?usp=drive_link" target="_blank">Audio Sesión 11</a></li>
                            </ul>

                            <h4 style="margin-top: 20px; font-weight: 800;">Sesiones Extraordinarias 2023</h4>
                            <ul class="download-list" style="margin-left: 20px;">
                                <li>🔊 <a href="https://drive.google.com/file/d/185J6s9iYZKlTBRtV-4EdXbxBF1EKTzyH/view?ts=64b95d86" target="_blank">Audio Sesión 1 Ext.</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </main>
        </div>

        <script>
            // Función para cambiar de pestañas (Tabulación)
            function openTab(evt, tabName) {
                // 1. Ocultar todos los contenidos
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tab-content");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                
                // 2. Quitar la clase "active" de todos los botones
                tablinks = document.getElementsByClassName("qs-btn");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].classList.remove("active");
                }

                // 3. Mostrar el contenido actual y activar el botón clickeado
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.classList.add("active");
            }
        </script>
        <?php
    }
    ?>

<?php endwhile; endif; ?>

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