<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 3');
?>
<!--  ----------------------------------------- fin plantilla header --------------------------------  -->


<div id="canvas">
	<div class="zoom-icon zoom-icon-in"></div>
	<div class="magazine-viewport">
		<div class="container">
			<div class="magazine">
				<!-- Next button -->
				<div ignore="1" class="next-button"></div>
				<!-- Previous button -->
				<div ignore="1" class="previous-button"></div>
			</div>
		</div>		
	</div>
</div>


<script type="text/javascript">
	function loadApp() {

		$('#canvas').fadeIn(1000);

		var flipbook = $('.magazine');

		// Check if the CSS was already loaded

		if (flipbook.width() == 0 || flipbook.height() == 0) {
			setTimeout(loadApp, 10);
			return;
		}

		// Create the flipbook

		flipbook.turn({

			// Magazine width

			width: 922,

			// Magazine height

			height: 600,

			// Duration in millisecond

			duration: 1000,

			// Hardware acceleration

			acceleration: !isChrome(),

			// Enables gradients

			gradients: true,

			// Auto center this flipbook

			autoCenter: true,

			// Elevation from the edge of the flipbook when turning a page

			elevation: 50,

			// The number of pages,

			pages: 44,

			// Events

			when: {
				turning: function(event, page, view) {

					var book = $(this),
						currentPage = book.turn('page'),
						pages = book.turn('pages');

					// Update the current URI

					Hash.go('/page/' + page).update();

					// Show and hide navigation buttons

					disableControls(page);


					$('.thumbnails .page-' + currentPage).
					parent().
					removeClass('current');

					$('.thumbnails .page-' + page).
					parent().
					addClass('current');


					//var estados = page
					//alert(page);
					//alert("CurrentPage"+currentPage+"Página"+page );


				},

				turned: function(event, page, view) {

					disableControls(page);

					$(this).turn('center');

					if (page == 1) {
						$(this).turn('peel', 'br');
					}

				},

				missing: function(event, pages) {

					// Add pages that aren't in the magazine

					for (var i = 0; i < pages.length; i++)
						addPage(pages[i], $(this));

				}
			}

		});

		// Zoom.js

		$('.magazine-viewport').zoom({
			flipbook: $('.magazine'),

			max: function() {

				return largeMagazineWidth() / $('.magazine').width();

			},

			when: {

				swipeLeft: function() {

					$(this).zoom('flipbook').turn('next');

				},

				swipeRight: function() {

					$(this).zoom('flipbook').turn('previous');

				},

				resize: function(event, scale, page, pageElement) {

					if (scale == 1)
						loadSmallPage(page, pageElement);
					else
						loadLargePage(page, pageElement);

				},

				zoomIn: function() {

					$('.thumbnails').hide();
					$('.made').hide();
					$('.magazine').removeClass('animated').addClass('zoom-in');
					$('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');

					if (!window.escTip && !$.isTouch) {
						escTip = true;

						$('<div />', {
							'class': 'exit-message'
						}).
						html('<div>Press ESC to exit</div>').
						appendTo($('body')).
						delay(2000).
						animate({
							opacity: 0
						}, 500, function() {
							$(this).remove();
						});
					}
				},

				zoomOut: function() {

					$('.exit-message').hide();
					$('.thumbnails').fadeIn();
					$('.made').fadeIn();
					$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

					setTimeout(function() {
						$('.magazine').addClass('animated').removeClass('zoom-in');
						resizeViewport();
					}, 0);

				}
			}
		});

		// Zoom event

		if ($.isTouch)
			$('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
		else
			$('.magazine-viewport').bind('zoom.tap', zoomTo);


		// Using arrow keys to turn the page

		$(document).keydown(function(e) {

			var previous = 37,
				next = 39,
				esc = 27;

			switch (e.keyCode) {
				case previous:

					// left arrow
					$('.magazine').turn('previous');
					e.preventDefault();

					break;
				case next:

					//right arrow
					$('.magazine').turn('next');
					e.preventDefault();

					break;
				case esc:

					$('.magazine-viewport').zoom('zoomOut');
					e.preventDefault();

					break;
			}
		});

		// URIs - Format #/page/1 

		Hash.on('^page\/([0-9]*)$', {
			yep: function(path, parts) {
				var page = parts[1];

				if (page !== undefined) {
					if ($('.magazine').turn('is'))
						$('.magazine').turn('page', page);
				}

			},
			nop: function(path) {

				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', 1);
			}
		});


		$(window).resize(function() {
			resizeViewport();
		}).bind('orientationchange', function() {
			resizeViewport();
		});

		// Events for thumbnails

		$('.thumbnails').click(function(event) {

			var page;

			if (event.target && (page = /page-([0-9]+)/.exec($(event.target).attr('class')))) {

				$('.magazine').turn('page', page[1]);
			}
		});

		$('.thumbnails li').
		bind($.mouseEvents.over, function() {

			$(this).addClass('thumb-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('thumb-hover');

		});

		if ($.isTouch) {

			$('.thumbnails').
			addClass('thumbanils-touch').
			bind($.mouseEvents.move, function(event) {
				event.preventDefault();
			});

		} else {

			$('.thumbnails ul').mouseover(function() {

				$('.thumbnails').addClass('thumbnails-hover');

			}).mousedown(function() {

				return false;

			}).mouseout(function() {

				$('.thumbnails').removeClass('thumbnails-hover');

			});

		}


		// Regions

		if ($.isTouch) {
			$('.magazine').bind('touchstart', regionClick);
		} else {
			$('.magazine').click(regionClick);
		}

		// Events for the next button

		$('.next-button').bind($.mouseEvents.over, function() {

			$(this).addClass('next-button-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('next-button-hover');

		}).bind($.mouseEvents.down, function() {

			$(this).addClass('next-button-down');

		}).bind($.mouseEvents.up, function() {

			$(this).removeClass('next-button-down');

		}).click(function() {

			$('.magazine').turn('next');

		});

		// Events for the next button

		$('.previous-button').bind($.mouseEvents.over, function() {

			$(this).addClass('previous-button-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('previous-button-hover');

		}).bind($.mouseEvents.down, function() {

			$(this).addClass('previous-button-down');

		}).bind($.mouseEvents.up, function() {

			$(this).removeClass('previous-button-down');

		}).click(function() {

			$('.magazine').turn('previous');

		});


		resizeViewport();

		$('.magazine').addClass('animated');

	}

	// Zoom icon

	$('.zoom-icon').bind('mouseover', function() {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).addClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).addClass('zoom-icon-out-hover');

	}).bind('mouseout', function() {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).removeClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).removeClass('zoom-icon-out-hover');

	}).bind('click', function() {

		if ($(this).hasClass('zoom-icon-in'))
			$('.magazine-viewport').zoom('zoomIn');
		else if ($(this).hasClass('zoom-icon-out'))
			$('.magazine-viewport').zoom('zoomOut');

	});

	$('#canvas').hide();


	// Load the HTML4 version if there's not CSS transform

	yepnope({
		test: Modernizr.csstransforms,
		yep: ['../../resources/js/turnjs4/lib/turn.js'],
		nope: ['../../resources/js/turnjs4/lib/turn.html4.min.js'],
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadtresprimergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Modales Audios -->
<div id="ModalUnit3AudioPag70" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio70">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/Unit3.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag72" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio72">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag72.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag73" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio73">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag73.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag74" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio74">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag74.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag75" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio75">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag75.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag76" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio76">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag76.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag77" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio77">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag77.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag78" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio78">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag78.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag79" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio79">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag79.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag80" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio80">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag80.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag81" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio81">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag81.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag82" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio82">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag82.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag83" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio83">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag83.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag84" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio84">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag84.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag85" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio85">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag85.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag86" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio86">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag86.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag88" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio88">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag88.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag89" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio89">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag89.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag90" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio90">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag90.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag91" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio91">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag91.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag92" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio92">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag92.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag93" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio93">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag93.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag94" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio94">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag94.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag95" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio95">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag95.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag96" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio96">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag96.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag97" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio97">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag97.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag98" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio98">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit3/pag98.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<!-- Página 72 -->
<div id="ModalUnit3Act1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">IDENTIFYING NAMES OF CLASSROOM OBJECTS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-9.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag72/img72-10.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 73 -->
<div id="ModalUnit3Act2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING NAMES OF CLASSROOM OBJECTS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-two">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the names of classroom objects</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="row justify-content-md-center justify-content-sm-center">
											<div class="col-md-6 col-sm-12 col-xs-12">
												<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag73/img73.png"
												class="rounded mx-auto d-block">																				
											</div>
										</div>
										
										<div class="col-md-8 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Board"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Clock"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Map"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Desk"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Chair"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act2-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Book"
														autocomplete="off">
												</div>	
												<div class="col-6">
													<input type="text" id="input-act2-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Notebook"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act2-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Pen"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act2-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Eraser"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act2-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Pencil"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act2-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="Pencil sharpener"
														autocomplete="off">
												</div>												

											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 74 -->
<div id="ModalUnit3Act3" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">SENTENCES ABOUT CLASSROOM OBJECTS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag74/img74-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag74/img74-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag74/img74-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag74/img74-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 75 -->
<div id="ModalUnit3Act4" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">IDENTIFYING NAMES OF TRADITIONAL GAMES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag75/img75-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag75/img75-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag75/img75-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag75/img75-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 76 -->
<div id="ModalUnit3Act5" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PLAYING TRADITIONAL GAMES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-five">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag76/img76-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act5-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag76/img76-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act5-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag76/img76-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act5-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag76/img76-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act5-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 77 -->
<div id="ModalUnit3Act6" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING LIKES AND DISLIKES IN SIMPLE SENTENCES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag77/img77-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag77/img77-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag77/img77-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag77/img77-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 78  -->
<div id="ModalUnit3Act7" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">THE DEFINITE ARTICLE THE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Color the images and rewrite the sentences</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>									

									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');*/

										/* Reset defaults */
										* {
											margin: 0;
											padding: 0;
											border: 0;
											outline: 0;
											font-size: 100%;
											vertical-align: baseline;
										}

										html {
										font-family: "Roboto";
										}

										header {
										width: 85%;
										margin: auto;
										padding-top: 50px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 25%;
										justify-content: center;	
										margin-top: 30px;
										}

										h1 {
										color: rgba(0, 0, 0, 0.7.5);
										font-size: 56px;
										font-weight: 700;
										letter-spacing: 0.5px;
										text-align: center;
										}

										header p {
										color: rgba(0, 0, 0, 0.6);
										font-size: 22px;
										font-weight: 700;
										letter-spacing: 0.2px;
										text-align: center;
										margin-bottom: 30px;
										}

										.colorPickerWrapper, .strokeWidthPickerWrapper {
										text-align: center;
										}

										.colorPickerWrapper input {
										width: 75px;
										}

										.container {
										width: 100%;
										margin: auto;
										height: 500px;
										text-align: center;
										}

										canvas3 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn7 {
										color: white;
										font-size: 20px;
										font-weight: 700;
										letter-spacing: 0.5px;
										padding: 10px 50px;
										background-color: #55D0ED;
										border-radius: 10px;
										text-decoration: none;
										}
									</style>

									<header>
										<h1>Draw with your mouse</h1>
										<div class="grid">
											<div class="color">
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker7" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker7">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn7">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas7" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitThree/Pag78/img78.png')"
											width="560" height="540">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>

								<div class="row justify-content-md-center justify-content-sm-center">		
									
									<div class="col-md-8 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act7-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="The sun"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act7-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="The moon"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act7-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="The rose"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act7-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="The carnation"
														autocomplete="off">
												</div>

											</div>	

										</div>

								</div>
							</div>
							<br>
						</div>
						<br>
						<!-- Botones de Control -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn waves-effect blue tooltipped"
								data-tooltip="Guardar">Submit</button>
							<br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 79 -->
<div id="ModalUnit3Act8" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">WORKING A CROSSWORD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eight">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
                                            <th class="text-center cell-act8" width="30" height="30">U</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-1" onclick="checkCells('act8-1')">P</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-2" onclick="checkCells('act8-2')">M</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-3" onclick="checkCells('act8-3')">O</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-4" onclick="checkCells('act8-4')">U</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-5" onclick="checkCells('act8-5')">S</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-6" onclick="checkCells('act8-6')">E</th>
                                            <th class="text-center cell-act8" width="30" height="30">T</th>
                                        </tr>
										<tr><!-- ROW TWO -->
											<th class="text-center cell-act8" width="30" height="30">A</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-7" onclick="checkCells('act8-7')">I</th>
                                            <th class="text-center cell-act8" width="30" height="30">S</th>
                                            <th class="text-center cell-act8" width="30" height="30">S</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-8" onclick="checkCells('act8-8')">G</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-9" onclick="checkCells('act8-9')">O</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-10" onclick="checkCells('act8-10')">A</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-11" onclick="checkCells('act8-11')">T</th>
                                        </tr>
										<tr><!-- ROW THREE -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-12" onclick="checkCells('act8-12')">B</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-13" onclick="checkCells('act8-13')">G</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-14" onclick="checkCells('act8-14')">D</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-15" onclick="checkCells('act8-15')">U</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-16" onclick="checkCells('act8-16')">C</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-17" onclick="checkCells('act8-17')">K</th>
                                            <th class="text-center cell-act8" width="30" height="30">T</th>
                                            <th class="text-center cell-act8" width="30" height="30">K</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-18" onclick="checkCells('act8-18')">I</th>
                                            <th class="text-center cell-act8" width="30" height="30">I</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-19" onclick="checkCells('act8-19')">S</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-20" onclick="checkCells('act8-20')">H</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-21" onclick="checkCells('act8-21')">E</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-22" onclick="checkCells('act8-22')">E</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-23" onclick="checkCells('act8-23')">P</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-24" onclick="checkCells('act8-24')">C</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-25" onclick="checkCells('act8-25')">R</th>
                                            <th class="text-center cell-act8" width="30" height="30">M</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-26" onclick="checkCells('act8-26')">H</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-27" onclick="checkCells('act8-27')">O</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-28" onclick="checkCells('act8-28')">R</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-29" onclick="checkCells('act8-29')">S</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-30" onclick="checkCells('act8-30')">E</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-31" onclick="checkCells('act8-31')">A</th>
                                        </tr>
										<tr><!-- ROW SIX -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-32" onclick="checkCells('act8-32')">D</th>
                                            <th class="text-center cell-act8" width="30" height="30">W</th>
                                            <th class="text-center cell-act8" width="30" height="30">U</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-33" onclick="checkCells('act8-33')">F</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-34" onclick="checkCells('act8-34')">I</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-35" onclick="checkCells('act8-35')">S</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-36" onclick="checkCells('act8-36')">H</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-37" onclick="checkCells('act8-37')">T</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-38" onclick="checkCells('act8-38')">C</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-39" onclick="checkCells('act8-39')">H</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-40" onclick="checkCells('act8-40')">I</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-41" onclick="checkCells('act8-41')">C</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-42" onclick="checkCells('act8-42')">K</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-43" onclick="checkCells('act8-43')">E</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-44" onclick="checkCells('act8-44')">N</th>
                                            <th class="text-center cell-act8" width="30" height="30">X</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
											<th class="text-center cell-act8" width="30" height="30" id="act8-45" onclick="checkCells('act8-45')">C</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-46" onclick="checkCells('act8-46')">O</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-47" onclick="checkCells('act8-47')">W</th>
                                            <th class="text-center cell-act8" width="30" height="30">N</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-48" onclick="checkCells('act8-48')">D</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-49" onclick="checkCells('act8-49')">O</th>
                                            <th class="text-center cell-act8" width="30" height="30" id="act8-50" onclick="checkCells('act8-50')">G</th>
                                            <th class="text-center cell-act8" width="30" height="30">E</th>
                                        </tr>
                                    </table>
									<div class="row pt-4">
										<p class="text-center">Write the definite article THE before each name</p>
									</div>
									<div class="row">
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-1"> 
											<p class="text-center">cat</p>										
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-2"> 
											<p class="text-center">dog</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-3"> 
											<p class="text-center">cow</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-4"> 
											<p class="text-center">goat</p>										
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-5"> 
											<p class="text-center">horse</p>										
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-6"> 
											<p class="text-center">pig</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-7"> 
											<p class="text-center">duck</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-8"> 
											<p class="text-center">chicken</p>										
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-9"> 
											<p class="text-center">sheep</p>										
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-10"> 
											<p class="text-center">fish</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-11"> 
											<p class="text-center">bird</p>										
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act8-12"> 
											<p class="text-center">mouse</p>										
										</div>									
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script  src="../../app/controllers/BookTwoUnitOne/wordfindpage7.js"></script>
</div>

<!-- Página 80 -->
<div id="ModalUnit3Act9" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">RESOLUTION OF THE CROSSWORD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nine">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw and color each animal</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>									

									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');*/

										/* Reset defaults */
										* {
											margin: 0;
											padding: 0;
											border: 0;
											outline: 0;
											font-size: 100%;
											vertical-align: baseline;
										}

										html {
										font-family: "Roboto";
										}

										header {
										width: 85%;
										margin: auto;
										padding-top: 50px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 25%;
										justify-content: center;	
										margin-top: 30px;
										}

										h1 {
										color: rgba(0, 0, 0, 0.7.5);
										font-size: 56px;
										font-weight: 700;
										letter-spacing: 0.5px;
										text-align: center;
										}

										header p {
										color: rgba(0, 0, 0, 0.6);
										font-size: 22px;
										font-weight: 700;
										letter-spacing: 0.2px;
										text-align: center;
										margin-bottom: 30px;
										}

										.colorPickerWrapper, .strokeWidthPickerWrapper {
										text-align: center;
										}

										.colorPickerWrapper input {
										width: 75px;
										}

										.container {
										width: 100%;
										margin: auto;
										height: 500px;
										text-align: center;
										}

										canvas3 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn9 {
										color: white;
										font-size: 20px;
										font-weight: 700;
										letter-spacing: 0.5px;
										padding: 10px 50px;
										background-color: #55D0ED;
										border-radius: 10px;
										text-decoration: none;
										}
									</style>

									<header>
										<h1>Draw with your mouse</h1>
										<div class="grid">
											<div class="color">
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker9" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker9">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn9">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas9" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitThree/Pag80/img80.png')"
											width="650" height="540">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>
							</div>
							<br>
						</div>
						<br>
						<!-- Botones de Control -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn waves-effect blue tooltipped"
								data-tooltip="Guardar">Submit</button>
							<br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 81 -->
<div id="ModalUnit3Act10" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">IDENTIFYING VERBS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-ten">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag81/img81-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act10-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag81/img81-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act10-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag81/img81-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act10-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag81/img81-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act10-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 82 -->
<div id="ModalUnit3Act11" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PRONOUN: IT</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>		
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence">
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag82/img82-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence">
											</div>
																					
										</div>											

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 83 -->
<div id="ModalUnit3Act12" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PRONOUN: WE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twelve">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>		
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag83/img83-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 84 -->
<div id="ModalUnit3Act13" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ADJECTIVES: BIG, SMALL, OLD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>		
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag84/img84-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	
										
									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 85 -->
<div id="ModalUnit3Act14" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PREPOSITION: AT</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag85/img85-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act14-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag85/img85-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act14-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag85/img85-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act14-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag85/img85-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act14-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>		
									</div>											
								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 86 -->
<div id="ModalUnit3Act15" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PREPOSITION: IN</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag86/img86-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag86/img86-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag86/img86-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag86/img86-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	
									</div>											
								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 88, actividad 16.1 -->
<div id="ModalUnit3Act16_1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">I LIKE TO PLAY DOLL</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Color the doll and write the sentences</p>
											<input type="text" class="d-none" id="points16_1" name="points">
											<input type="text" class="d-none" id="idcliente16_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro16_1" name="idlibro">
										</div>
									</div>									

									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');*/

										/* Reset defaults */
										* {
											margin: 0;
											padding: 0;
											border: 0;
											outline: 0;
											font-size: 100%;
											vertical-align: baseline;
										}

										html {
										font-family: "Roboto";
										}

										header {
										width: 85%;
										margin: auto;
										padding-top: 50px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 25%;
										justify-content: center;	
										margin-top: 30px;
										}

										h1 {
										color: rgba(0, 0, 0, 0.7.5);
										font-size: 56px;
										font-weight: 700;
										letter-spacing: 0.5px;
										text-align: center;
										}

										header p {
										color: rgba(0, 0, 0, 0.6);
										font-size: 22px;
										font-weight: 700;
										letter-spacing: 0.2px;
										text-align: center;
										margin-bottom: 30px;
										}

										.colorPickerWrapper, .strokeWidthPickerWrapper {
										text-align: center;
										}

										.colorPickerWrapper input {
										width: 75px;
										}

										.container {
										width: 100%;
										margin: auto;
										height: 500px;
										text-align: center;
										}

										canvas16 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn16 {
										color: white;
										font-size: 20px;
										font-weight: 700;
										letter-spacing: 0.5px;
										padding: 10px 50px;
										background-color: #55D0ED;
										border-radius: 10px;
										text-decoration: none;
										}
									</style>

									<header>
										<h1>Draw with your mouse</h1>
										<div class="grid">
											<div class="color">
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker16" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker16">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn16">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12 justify-content-center">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas16" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitThree/Pag87/img87.png')"
											width="290" height="290">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>
								
								<div class="row justify-content-md-center justify-content-sm-center">		
									
									<div class="col-md-8 col-sm-12 col-xs-12">

										<div class="row justify-content-md-center justify-content-sm-center">

											<div class="col-6">
												<input type="text" id="input-act16_1-1" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Yellow shirt">
											</div>
											
											<div class="col-6">
												<input type="text" id="input-act16_1-2" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Purple pants">
											</div>

											<div class="col-6">
												<input type="text" id="input-act16_1-3" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px;"
													placeholder="Blue shoes">
											</div>
											
											<div class="col-6">
												<input type="text" id="input-act16_1-4" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px;"
													placeholder="Green socks">
											</div>

										</div>	

									</div>

								</div>
							</div>
							<br>
						</div>
						<br>
						<!-- Botones de Control -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn waves-effect blue tooltipped"
								data-tooltip="Guardar">Submit</button>
							<br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	

<!-- Página 88, actividad 16.2 -->		
<div id="ModalUnit3Act16_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">I LIKE TO PLAY DOLL</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence</p>
											<input type="text" class="d-none" id="points16_2" name="points">
											<input type="text" class="d-none" id="idcliente16_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro16_2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag87/img87-1.png">
											</div>											
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act16_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="I like yellow"
														autocomplete="off">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act16_2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="I do not like purple"
														autocomplete="off">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act16_2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Blue is my favorite color"
														autocomplete="off">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act16_2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Green is beautiful"
														autocomplete="off">
											</div>
																					 
										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 89 -->
<div id="ModalUnit3Act17" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">THE COLORS OF MY TOYS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seventeen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Color the images and write the words</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>									

									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');*/

										/* Reset defaults */
										* {
											margin: 0;
											padding: 0;
											border: 0;
											outline: 0;
											font-size: 100%;
											vertical-align: baseline;
										}

										html {
										font-family: "Roboto";
										}

										header {
										width: 85%;
										margin: auto;
										padding-top: 50px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 25%;
										justify-content: center;	
										margin-top: 30px;
										}

										h1 {
										color: rgba(0, 0, 0, 0.7.5);
										font-size: 56px;
										font-weight: 700;
										letter-spacing: 0.5px;
										text-align: center;
										}

										header p {
										color: rgba(0, 0, 0, 0.6);
										font-size: 22px;
										font-weight: 700;
										letter-spacing: 0.2px;
										text-align: center;
										margin-bottom: 30px;
										}

										.colorPickerWrapper, .strokeWidthPickerWrapper {
										text-align: center;
										}

										.colorPickerWrapper input {
										width: 75px;
										}

										.container {
										width: 100%;
										margin: auto;
										height: 500px;
										text-align: center;
										}

										canvas17 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn17 {
										color: white;
										font-size: 20px;
										font-weight: 700;
										letter-spacing: 0.5px;
										padding: 10px 50px;
										background-color: #55D0ED;
										border-radius: 10px;
										text-decoration: none;
										}
									</style>

									<header>
										<h1>Draw with your mouse</h1>
										<div class="grid">
											<div class="color">
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker17" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker17">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn17">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12 justify-content-center">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas17" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitThree/Pag88/img88.png')"
											width="590" height="500">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>
								
								<div class="row justify-content-md-center justify-content-sm-center">		
									
									<div class="col-md-8 col-sm-12 col-xs-12">

										<div class="row justify-content-md-center justify-content-sm-center">

											<div class="col-12">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag88/img88-1.png" style="margin-top: 25px;">
											</div>

											<div class="col-3">
												<input type="text" id="input-act17-1" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Blue"
													autocomplete="off">
											</div>
											
											<div class="col-3">
												<input type="text" id="input-act17-2" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Yellow"
													autocomplete="off">
											</div>

											<div class="col-3">
												<input type="text" id="input-act17-3" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Green"
													autocomplete="off">
											</div>
											
											<div class="col-3">
												<input type="text" id="input-act17-4" class="form-control"
													aria-label="Sizing example input" maxlength="100"												
													style="margin-bottom: 15px; margin-top: 15px;"
													placeholder="Purple"
													autocomplete="off">
											</div>

										</div>	

									</div>

								</div>
							</div>
							<br>
						</div>
						<br>
						<!-- Botones de Control -->
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
							<button type="submit" class="btn waves-effect blue tooltipped"
								data-tooltip="Guardar">Submit</button>
							<br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 90 -->
<div id="ModalUnit3Act18" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE DAYS OF THE WEEK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eighteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	


										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag89/img89-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					
										</div>	

									</div>											
								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 91 -->
<div id="ModalUnit3Act19" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NOUNS: BOY AND GIRL</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="row justify-content-md-center justify-content-sm-center">
											<div class="col-md-6 col-sm-12 col-xs-12">
												<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag90/img90.png"	>
											</div>
										</div>
										
										<div class="col-md-8 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act19-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Boris is a ____"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act19-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Susan is a ____"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act19-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="The ____ is a masculine"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act19-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="The ____ is a feminine"
														autocomplete="off">
												</div>
												
											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 92 -->
<div id="ModalUnit3Act20" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CARDINAL NUMBERS FROM ONE TO FIFTEEN</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twenty">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag91/img91.png"	>
										</div>										
										
										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act20-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="1. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="2. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="3. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="4. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="5. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="6. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="7. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="8. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="9. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="10. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="11. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="12. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="13. ________"
														autocomplete="off">
												</div>

												<div class="col-6">
													<input type="text" id="input-act20-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="14. ________"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act20-15" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"
														placeholder="15. ________"
														autocomplete="off">
												</div>

											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 93 -->
<div id="ModalUnit3Act21" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">VERBS: GO AND DRAW</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyone">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag92/img92-1.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act21-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag92/img92-2.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act21-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 94 -->
<div id="ModalUnit3Act22" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">POSSESIVE ADJECTIVES: HIS, HER</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentytwo">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag93/img93.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<h4 style="text-align: center; margin-top: 15px;">HER</h4>
												</div>

												<div class="col-6">
													<h4 style="text-align: center; margin-top: 15px;">HIS</h4>
												</div>

												<div class="col-6">
													<input type="text" id="input-act22-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is her book"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act22-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is his book"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is her pencil"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is his pencil"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act22-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="That is her toy"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is his toy"
														autocomplete="off">
												</div>	
													
												<div class="col-6">
													<input type="text" id="input-act22-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="That is her umbrella"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act22-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="That is his umbrella"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is her watch"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="This is his watch"
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<input type="text" id="input-act22-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="That is her flower"
														autocomplete="off">
												</div>	

												<div class="col-6">
													<input type="text" id="input-act22-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="That is his flower"
														autocomplete="off">
												</div>																									
										
											</div>								

										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 95 -->
<div id="ModalUnit3Act23" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PREPOSITION: WITH</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentythree">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag94/img94-1.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act23-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag94/img94-2.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<input type="text" id="input-act23-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 96 -->
<div id="ModalUnit3Act24" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSIONS: TODAY, ON</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyfour">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sentences</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag95/img95-1.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-8">
													<input type="text" id="input-act24-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag95/img95-2.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-8">
													<input type="text" id="input-act24-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag95/img95-3.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-8">
													<input type="text" id="input-act24-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the sentence"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 97 -->
<div id="ModalUnit3Act25" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">WORKING A CROSSWORD OF CHIRSTMAS DAY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyfive">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
                                            <th class="text-center cell-act25" width="30" height="30">L</th>
                                            <th class="text-center cell-act25" width="30" height="30">L</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-1" onclick="checkCells('act25-1')">T</th>
                                            <th class="text-center cell-act25" width="30" height="30">Y</th>
                                            <th class="text-center cell-act25" width="30" height="30">G</th>
                                            <th class="text-center cell-act25" width="30" height="30">E</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-2" onclick="checkCells('act25-2')">F</th>
                                            <th class="text-center cell-act25" width="30" height="30">I</th>
                                        </tr>
										<tr><!-- ROW TWO -->
											<th class="text-center cell-act25" width="30" height="30">W</th>
                                            <th class="text-center cell-act25" width="30" height="30">O</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-3" onclick="checkCells('act25-3')">U</th>
                                            <th class="text-center cell-act25" width="30" height="30">P</th>
                                            <th class="text-center cell-act25" width="30" height="30">J</th>
                                            <th class="text-center cell-act25" width="30" height="30">I</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-4" onclick="checkCells('act25-4')">O</th>
                                            <th class="text-center cell-act25" width="30" height="30">M</th>
                                        </tr>
										<tr><!-- ROW THREE -->
											<th class="text-center cell-act25" width="30" height="30">K</th>
                                            <th class="text-center cell-act25" width="30" height="30">G</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-5" onclick="checkCells('act25-5')">R</th>
                                            <th class="text-center cell-act25" width="30" height="30">E</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-6" onclick="checkCells('act25-6')">T</th>
                                            <th class="text-center cell-act25" width="30" height="30">U</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-7" onclick="checkCells('act25-7')">O</th>
                                            <th class="text-center cell-act25" width="30" height="30">C</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
											<th class="text-center cell-act25" width="30" height="30">H</th>
                                            <th class="text-center cell-act25" width="30" height="30">H</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-8" onclick="checkCells('act25-8')">K</th>
                                            <th class="text-center cell-act25" width="30" height="30">N</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-9" onclick="checkCells('act25-9')">H</th>
                                            <th class="text-center cell-act25" width="30" height="30">V</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-10" onclick="checkCells('act25-10')">D</th>
                                            <th class="text-center cell-act25" width="30" height="30">O</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
											<th class="text-center cell-act25" width="30" height="30" id="act25-11" onclick="checkCells('act25-11')">Y</th>
                                            <th class="text-center cell-act25" width="30" height="30">Z</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-12" onclick="checkCells('act25-12')">E</th>
                                            <th class="text-center cell-act25" width="30" height="30">T</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-13" onclick="checkCells('act25-13')">A</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-14" onclick="checkCells('act25-14')">H</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-15" onclick="checkCells('act25-15')">A</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-16" onclick="checkCells('act25-16')">M</th>
                                        </tr>
										<tr><!-- ROW SIX -->
											<th class="text-center cell-act25" width="30" height="30" id="act25-17" onclick="checkCells('act25-17')">A</th>
                                            <th class="text-center cell-act25" width="30" height="30">V</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-18" onclick="checkCells('act25-18')">Y</th>
                                            <th class="text-center cell-act25" width="30" height="30">C</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-19" onclick="checkCells('act25-19')">N</th>
                                            <th class="text-center cell-act25" width="30" height="30">M</th>
                                            <th class="text-center cell-act25" width="30" height="30">S</th>
                                            <th class="text-center cell-act25" width="30" height="30">U</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
											<th class="text-center cell-act25" width="30" height="30" id="act25-20" onclick="checkCells('act25-20')">M</th>
                                            <th class="text-center cell-act25" width="30" height="30">P</th>
                                            <th class="text-center cell-act25" width="30" height="30">I</th>
                                            <th class="text-center cell-act25" width="30" height="30">X</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-21" onclick="checkCells('act25-21')">K</th>
                                            <th class="text-center cell-act25" width="30" height="30">A</th>
                                            <th class="text-center cell-act25" width="30" height="30">I</th>
                                            <th class="text-center cell-act25" width="30" height="30">L</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
											<th class="text-center cell-act25" width="30" height="30">Y</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-22" onclick="checkCells('act25-22')">P</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-23" onclick="checkCells('act25-23')">I</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-24" onclick="checkCells('act25-24')">E</th>
                                            <th class="text-center cell-act25" width="30" height="30" id="act25-25" onclick="checkCells('act25-25')">S</th>
                                            <th class="text-center cell-act25" width="30" height="30">W</th>
                                            <th class="text-center cell-act25" width="30" height="30">O</th>
                                            <th class="text-center cell-act25" width="30" height="30">V</th>
                                        </tr>
                                    </table>
									<div class="row pt-4">
										<p class="text-center">Write the words of the crosswords</p>
									</div>
									<div class="row">
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Ham"class="form-control mb-3" id="input-act25-1"> 										
										</div>	 
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Yam" class="form-control mb-3" id="input-act25-2"> 																
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Pie" class="form-control mb-3" id="input-act25-3"> 									
										</div>
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Turkey" class="form-control mb-3" id="input-act25-4"> 							
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Food" class="form-control mb-3" id="input-act25-5"> 						
										</div>	
										<div class="col-4">
											<input autocomplete="off" type="text" placeholder="Thanks" class="form-control mb-3" id="input-act25-6"> 						
										</div>								
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script  src="../../app/controllers/BookTwoUnitOne/wordfindpage7.js"></script>
</div>

<!-- Página 98 -->
<div id="ModalUnit3Act26" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">AUTUMN</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentysix">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">What's the name of the poem?</p>
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitThree/Pag97/img97.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-5">
													<input type="text" id="input-act26-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the name of the poem"
														autocomplete="off">
												</div>																								
																								
											</div>	

										</div>										

									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped"
							data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro1_u3.js');
?>