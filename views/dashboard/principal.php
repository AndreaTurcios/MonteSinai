<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Home');
?>
		<link rel="stylesheet" type="text/css" href="../../resources/css/demo1.css" />
        <link rel="stylesheet" type="text/css" href="../../resources/css/bookblock.css" />
		<script src="../../resources/js/modernizr.custom.js"></script>
        <script src="../../resources/js/principal.js"></script>


<div class="contenedor">
          <main>
               <div class="contenedor-img">
                    <img src="../../resources/img/logo_sinai.png" alt="">
               </div>
               <div class="contenedor-texto">
					<h2 class="titulo">¿Quieres aprender <br>  <span class="typed"></span> ? </h2>
                    <p>MonteSinai es una gran ventana a la formacion en todos los sentidos, nuestros libros le ayudan en la aventura del saber, del conocer, de convivir y descubrir. Es un recurso didáctico elaborado con la intención de facilitar los procesos de enseñanza y aprendizaje. Contamos con un portafolio de libros de texto curriculares y no curriculares</p>

                    <a href="../dashboard/login.php" class="btn-link activo">Nuestros Libros</a>
                    <a href="../dashboard/sobre_nosotros.php" class="btn-link">Conocenos</a>
               </div>
          </main>
</div>
<div class="css-xfq28i"></div>
<br>
<div class="container">
			<div class="main clearfix">
				<div class="bb-custom-wrapper">
					<div id="bb-bookblock" class="bb-bookblock">
						<div class="bb-item">
							<a href=""><img src="../../resources/img/1.jpg" alt="image01"/></a>
						</div>
						<div class="bb-item">
							<a href=""><img src="../../resources/img/2.jpg" alt="image02"/></a>
						</div>
						<div class="bb-item">
							<a href=""><img src="../../resources/img/3.jpg" alt="image03"/></a>
						</div>
						<div class="bb-item">
							<a href=""><img src="../../resources/img/4.jpg" alt="image04"/></a>
						</div>
						<div class="bb-item">
							<a href=""><img src="../../resources/img/5.jpg" alt="image05"/></a>
						</div>
					</div>
					<nav>
						<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
						<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
						<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
						<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
					</nav>
				</div>
			</div>
		</div><!-- /container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="../../resources/js/jquerypp.custom.js"></script>
		<script src="../../resources/js/jquery.bookblock.js"></script>
		<script>
			var Page = (function() {
				
				var config = {
						$bookBlock : $( '#bb-bookblock' ),
						$navNext : $( '#bb-nav-next' ),
						$navPrev : $( '#bb-nav-prev' ),
						$navFirst : $( '#bb-nav-first' ),
						$navLast : $( '#bb-nav-last' )
					},
					init = function() {
						config.$bookBlock.bookblock( {
							speed : 800,
							shadowSides : 0.8,
							shadowFlip : 0.7
						} );
						initEvents();
					},
					initEvents = function() {
						
						var $slides = config.$bookBlock.children();

						// add navigation events
						config.$navNext.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'next' );
							return false;
						} );

						config.$navPrev.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'prev' );
							return false;
						} );

						config.$navFirst.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'first' );
							return false;
						} );

						config.$navLast.on( 'click touchstart', function() {
							config.$bookBlock.bookblock( 'last' );
							return false;
						} );
						
						$slides.on( {
							'swipeleft' : function( event ) {
								config.$bookBlock.bookblock( 'next' );
								return false;
							},
							'swiperight' : function( event ) {
								config.$bookBlock.bookblock( 'prev' );
								return false;
							}
						} );

						// add keyboard events
						$( document ).keydown( function(e) {
							var keyCode = e.keyCode || e.which,
								arrow = {
									left : 37,
									up : 38,
									right : 39,
									down : 40
								};

							switch (keyCode) {
								case arrow.left:
									config.$bookBlock.bookblock( 'prev' );
									break;
								case arrow.right:
									config.$bookBlock.bookblock( 'next' );
									break;
							}
						} );
					};

					return { init : init };

			})();
		</script>
		<script>
				Page.init();
		</script>
        <div class="css-xfq28i"></div>
        <br>
      

    <!-- quick cache hack -->
    <img src="../../resources/img/1.jpg" style="display: none">
    <img src="../../resources/img/2.jpg" style="display: none">
    <img src="../../resources/img/3.jpg" style="display: none">
    <img src="../../resources/img/4.jpg" style="display: none">
    <img src="../../resources/img/5.jpg" style="display: none">



	 <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
     <script src="../../resources/js/main.js"></script>
     <link rel="stylesheet" href="../../resources/css/style.css"></script>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('main.js');
?>