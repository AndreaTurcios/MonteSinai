<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Home');
?>

<div class="contenedor">
          <main>
               <div class="contenedor-img">
                    <img src="../../resources/img/logo_sinai.png" alt="">
               </div>
               <div class="contenedor-texto">
					<h2 class="titulo">¿Quieres aprender <br>  <span class="typed"></span> ? </h2>
                    <p>MonteSinai es una gran ventana a la formacion en todos los sentidos, nuestros libros le ayudan en la aventura del saber, del conocer, de convivir y descubrir. Es un recurso didáctico elaborado con la intención de facilitar los procesos de enseñanza y aprendizaje. Contamos con un portafolio de libros de texto curriculares y no curriculares</p>

                    <a href="#" class="btn-link activo">Reserva ahora</a>
                    <a href="#" class="btn-link">Conocenos</a>
               </div>
          </main>
     </div>

	 <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
     <script src="../../resources/js/main.js"></script>
     <script src="../../resources/css/style.css"></script>


<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('main.js');
?>