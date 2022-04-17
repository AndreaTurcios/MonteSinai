<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Home');
?>
<link rel="stylesheet" type="text/css" href="../../resources/css/demo1.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/bookblock.css" />
<link rel="stylesheet" type="text/css" href="../../resources/css/_sections.scss" />
<script src="../../resources/js/modernizr.custom.js"></script>
<section id="services" class="section">
	<div class="contenedor">
		<main>
			<div class="contenedor-img">
				<img src="../../resources/img/logo_sinai.png" alt="">
			</div>
			<div class="contenedor-texto">
				<h2 class="titulo">¿Quieres aprender <br> <span class="typed"></span> ? </h2>
				<p>MonteSinai es una gran ventana a la formacion en todos los sentidos, nuestros libros le ayudan en la aventura del saber, del conocer, de convivir y descubrir. Es un recurso didáctico elaborado con la intención de facilitar los procesos de enseñanza y aprendizaje. Contamos con un portafolio de libros de texto curriculares y no curriculares</p>

				<a href="../dashboard/login.php" class="btn-link activo">Nuestros Libros</a>
				<a href="../dashboard/sobre_nosotros.php" class="btn-link">Conocenos</a>
			</div>
		</main>
	</div>
</section>
<section class="services-list parallax2">
	<div class="container">
		<div class="typing-demo">
			Ejemplos:
		</div>
		<div class="main clearfix">
			<div class="bb-custom-wrapper">
				<div id="bb-bookblock" class="bb-bookblock">
					<div class="bb-item">
						<a href=""><img src="../../resources/img/1.jpg" alt="image01" /></a>
					</div>
					<div class="bb-item">
						<a href=""><img src="../../resources/img/2.jpg" alt="image02" /></a>
					</div>
					<div class="bb-item">
						<a href=""><img src="../../resources/img/3.jpg" alt="image03" /></a>
					</div>
					<div class="bb-item">
						<a href=""><img src="../../resources/img/4.jpg" alt="image04" /></a>
					</div>
					<div class="bb-item">
						<a href=""><img src="../../resources/img/5.jpg" alt="image05" /></a>
					</div>
				</div>
				<nav>
					<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
					<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
				</nav>
			</div>
		</div>
	</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../../resources/js/jquerypp.custom.js"></script>
<script src="../../resources/js/jquery.bookblock.js"></script>
<script>
	var Page = (function() {
		var config = {
				$bookBlock: $('#bb-bookblock'),
				$navNext: $('#bb-nav-next'),
				$navPrev: $('#bb-nav-prev'),
				$navFirst: $('#bb-nav-first'),
				$navLast: $('#bb-nav-last')
			},
			init = function() {
				config.$bookBlock.bookblock({
					speed: 800,
					shadowSides: 0.8,
					shadowFlip: 0.7
				});
				initEvents();
			},
			initEvents = function() {
				var $slides = config.$bookBlock.children();
				config.$navNext.on('click touchstart', function() {
					config.$bookBlock.bookblock('next');
					return false;
				});

				config.$navPrev.on('click touchstart', function() {
					config.$bookBlock.bookblock('prev');
					return false;
				});

				config.$navFirst.on('click touchstart', function() {
					config.$bookBlock.bookblock('first');
					return false;
				});

				config.$navLast.on('click touchstart', function() {
					config.$bookBlock.bookblock('last');
					return false;
				});

				$slides.on({
					'swipeleft': function(event) {
						config.$bookBlock.bookblock('next');
						return false;
					},
					'swiperight': function(event) {
						config.$bookBlock.bookblock('prev');
						return false;
					}
				});
				// add keyboard events
				$(document).keydown(function(e) {
					var keyCode = e.keyCode || e.which,
						arrow = {
							left: 37,
							up: 38,
							right: 39,
							down: 40
						};

					switch (keyCode) {
						case arrow.left:
							config.$bookBlock.bookblock('prev');
							break;
						case arrow.right:
							config.$bookBlock.bookblock('next');
							break;
					}
				});
			};
		return {
			init: init
		};
	})();
</script>
<script>
	Page.init();
</script>
<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="blog-card spring-fever">
			<div class="title-content">
				<h3><a href="#">Los mejores en educación</a></h3>
				<div class="intro"> <a href="#">Educación</a> </div>
			</div>
			<div class="card-info">
				Tenemos libros desde inglés, matemáticas y todo tema que se te venga a la mente.
			</div>
			<div class="gradient-overlay"></div>
			<div class="color-overlay"></div>
		</div>
	</div>
	<div class="col-md-6 col-sm-6">
		<div class="blog-card2 spring-fever">
			<div class="title-content">
				<h3><a href="#">Enseñanza de primera</a></h3>
				<div class="intro"> <a href="#">Enseñanza</a> </div>
			</div>
			<div class="card-info">
				Los mejores en enseñanza de inglés, además de claro, el mejor material en libros del país.
			</div>
			<div class="gradient-overlay"></div>
			<div class="color-overlay"></div>
		</div>
	</div>
</div>
<br>
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
<section class="static-testimonial parallax5">
	<div class="container">
		<blockquote>
			<i class="fa fa-quote-left"></i>
			<i class="fa fa-quote-right"></i>"Intenta aprender algo sobre todo y todo sobre algo"
			<span>Thomas Huxley</span>
		</blockquote>
	</div>
</section>
<div class="css-xfq28i"></div>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="../../resources/js/main.js"></script>
<link rel="stylesheet" href="../../resources/css/style.css">
</script>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('.js');
?>