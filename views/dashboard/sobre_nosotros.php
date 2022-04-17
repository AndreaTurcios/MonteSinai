<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Sobre nosotros');
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center" id="Titulo1">
                <h1 class="center">Sobre nosotros</h1>
            </div>
        </div>
        <br>
    </div><!-- Navbar para los elementos de filtrado y agregar -->
    <div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="blog-card3 spring-fever">
			<div class="title-content">
				<h3><a href="#">Te ayudamos a cumplir metas</a></h3>
				<div class="intro"> <a href="#">Inspiración</a> </div>
			</div>
			<div class="card-info">
				Toda meta que tengas de aprendizaje se te brinda fácilmente con una amplica variedad de libros disponibles.
			</div>
			<div class="gradient-overlay"></div>
			<div class="color-overlay"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="blog-card4 spring-fever">
			<div class="title-content">
				<h3><a href="#">Educación desde la comodidad de tu hogar</a></h3>
				<div class="intro"> <a href="#">Prácticos</a> </div>
			</div>
			<div class="card-info">
				Te ayudamos a aprender desde la comodidad de tu sofá, temas referentes a lo que te agrade, como matemáticas, y lo más importante en el siglo XX... ¡El inglés!
			</div>
			<div class="gradient-overlay"></div>
			<div class="color-overlay"></div>
		</div>
	</div>
</div>
<br><br><br><br><br><br>
</section>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('cont.js');
?>