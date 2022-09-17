<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 1');
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
		<!-- Thumbnails -->
		<div class="thumbnails">
			<div>
				<ul>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/1.JPG" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/14.JPG" width="76" height="100"
							class="page-14">
						<span>14</span>
					</li>
				</ul>
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
				turning: function (event, page, view) {

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

				turned: function (event, page, view) {

					disableControls(page);

					$(this).turn('center');

					if (page == 1) {
						$(this).turn('peel', 'br');
					}

				},

				missing: function (event, pages) {

					// Add pages that aren't in the magazine

					for (var i = 0; i < pages.length; i++)
						addPage(pages[i], $(this));

				}
			}

		});

		// Zoom.js

		$('.magazine-viewport').zoom({
			flipbook: $('.magazine'),

			max: function () {

				return largeMagazineWidth() / $('.magazine').width();

			},

			when: {

				swipeLeft: function () {

					$(this).zoom('flipbook').turn('next');

				},

				swipeRight: function () {

					$(this).zoom('flipbook').turn('previous');

				},

				resize: function (event, scale, page, pageElement) {

					if (scale == 1)
						loadSmallPage(page, pageElement);
					else
						loadLargePage(page, pageElement);

				},

				zoomIn: function () {

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
							}, 500, function () {
								$(this).remove();
							});
					}
				},

				zoomOut: function () {

					$('.exit-message').hide();
					$('.thumbnails').fadeIn();
					$('.made').fadeIn();
					$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

					setTimeout(function () {
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

		$(document).keydown(function (e) {

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
			yep: function (path, parts) {
				var page = parts[1];

				if (page !== undefined) {
					if ($('.magazine').turn('is'))
						$('.magazine').turn('page', page);
				}

			},
			nop: function (path) {

				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', 1);
			}
		});


		$(window).resize(function () {
			resizeViewport();
		}).bind('orientationchange', function () {
			resizeViewport();
		});

		// Events for thumbnails

		$('.thumbnails').click(function (event) {

			var page;

			if (event.target && (page = /page-([0-9]+)/.exec($(event.target).attr('class')))) {

				$('.magazine').turn('page', page[1]);
			}
		});

		$('.thumbnails li').
			bind($.mouseEvents.over, function () {

				$(this).addClass('thumb-hover');

			}).bind($.mouseEvents.out, function () {

				$(this).removeClass('thumb-hover');

			});

		if ($.isTouch) {

			$('.thumbnails').
				addClass('thumbanils-touch').
				bind($.mouseEvents.move, function (event) {
					event.preventDefault();
				});

		} else {

			$('.thumbnails ul').mouseover(function () {

				$('.thumbnails').addClass('thumbnails-hover');

			}).mousedown(function () {

				return false;

			}).mouseout(function () {

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

		$('.next-button').bind($.mouseEvents.over, function () {

			$(this).addClass('next-button-hover');

		}).bind($.mouseEvents.out, function () {

			$(this).removeClass('next-button-hover');

		}).bind($.mouseEvents.down, function () {

			$(this).addClass('next-button-down');

		}).bind($.mouseEvents.up, function () {

			$(this).removeClass('next-button-down');

		}).click(function () {

			$('.magazine').turn('next');

		});

		// Events for the next button

		$('.previous-button').bind($.mouseEvents.over, function () {

			$(this).addClass('previous-button-hover');

		}).bind($.mouseEvents.out, function () {

			$(this).removeClass('previous-button-hover');

		}).bind($.mouseEvents.down, function () {

			$(this).addClass('previous-button-down');

		}).bind($.mouseEvents.up, function () {

			$(this).removeClass('previous-button-down');

		}).click(function () {

			$('.magazine').turn('previous');

		});


		resizeViewport();

		$('.magazine').addClass('animated');

	}

	// Zoom icon

	$('.zoom-icon').bind('mouseover', function () {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).addClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).addClass('zoom-icon-out-hover');

	}).bind('mouseout', function () {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).removeClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).removeClass('zoom-icon-out-hover');

	}).bind('click', function () {

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunotercergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Modales Audios -->
<div id="ModalUnit1AudioPagWelcome" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audioWelcome">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/Welcome.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag3" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio3">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag3.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag4" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio4">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag4.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag5" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio5">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag5.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag6" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio6">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag6.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag7" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio7">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag7.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag8" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio8">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag8.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>


<div id="ModalUnit1AudioPag10" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio10">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag10.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag13" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio13">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag13.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag14" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio14">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag14.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag15" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio15">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag15.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag16" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio16">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag16.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag17" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio17">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag17.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag22" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio22">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag22.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag23" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio23">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag23.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag25" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio25">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag25.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag26" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio26">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag26.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit1AudioPag31" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio31">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit1/pag31.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag32" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio32">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit3/pag32.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<!-- Página 3, actividad 1.1 -->
<div id="ModalUnit1Act1_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">SIMON SAYS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_1" name="points">
											<input type="text" class="d-none" id="idcliente1_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-8" class="form-control"
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

<!-- Página 3, actividad 1.2 -->
<div id="ModalUnit1Act1_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">SIMON SAYS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the correct command</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_2" name="points">
											<input type="text" class="d-none" id="idcliente1_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_2" name="idlibro">
										</div>
									</div>


									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag3/img3_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act1_2-3" class="form-control"
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

<!-- Página 4 -->
<div id="ModalUnit1Act2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MY BODY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-two">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the sentences then draw yourself</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
																																				
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4_1.png">
											</div>											
																						
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-9.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-10.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-11.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-12.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-13.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-14.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/img4-15.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act2-15" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="What is this?"
														autocomplete="off">
											</div>
																					 
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

										canvas2 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn2 {
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
													<input type="color" id="colorPicker2" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker2">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn2">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas2" style="background: url('../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag4/canvas4.png')"
											width="530" height="320">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>

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

<!-- Página 5, actividad 3.1 -->
<div id="ModalUnit1Act3_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">FOOD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3_1" name="points">
											<input type="text" class="d-none" id="idcliente3_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-9.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-10.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-11.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-12.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-13.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-14.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_1-15.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_1-15" class="form-control"
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

<!-- Página 5, actividad 3.2 -->
<div id="ModalUnit1Act3_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">FOOD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the name of each food</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3_2" name="points">
											<input type="text" class="d-none" id="idcliente3_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag5/img5_2-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act3_2-6" class="form-control"
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

<!-- Página 6, actividad 4.1 -->
<div id="ModalUnit1Act4_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">DRINKS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points4_1" name="points">
											<input type="text" class="d-none" id="idcliente4_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro4_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-8" class="form-control"
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

<!-- Página 6, actividad 4.2 -->
<div id="ModalUnit1Act4_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">DRINKS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points4_2" name="points">
											<input type="text" class="d-none" id="idcliente4_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro4_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">																							
											<div class="col ps-5" id="box-act4-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_2-1.png" alt="GWater" id="img-act4-1">
											</div>
											<div class="col ps-5">
												<div id="Orange" class="box-act4 text-center m-3"  style="background-color: #3CB0E0;">
													An orange juice
												</div>
											</div>																					
										</div>	

										<div class="col-md-4 col-sm-6">																																		
											<div class="col ps-5" id="box-act4-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_2-2.png"  alt="Coffee" id="img-act4-2">
											</div>
											<div class="col ps-5">
												<div id="Milk" class="box-act4 text-center m-3"  style="background-color: #3CB0E0;">
													A glass of milk
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-4 col-sm-6">																																		
											<div class="col ps-5" id="box-act4-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_2-3.png"  alt="Milk" id="img-act4-3">
											</div>
											<div class="col ps-5">
												<div id="GWater" class="box-act4 text-center m-3"  style="background-color: #3CB0E0;">
													A glass of water
												</div>
											</div>																					
										</div>
										
										<div class="col-md-4 col-sm-6">																																		
											<div class="col ps-5" id="box-act4-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag6/img6_2-4.png"  alt="Orange" id="img-act4-4">
											</div>
											<div class="col ps-5">
												<div id="Coffee" class="box-act4 text-center m-3"  style="background-color: #3CB0E0;">
													A cup of coffee
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

<!-- Página 7 -->
<div id="ModalUnit1Act5" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">INTERACTING IN SHORT DIALOGUE ABOUT FOOD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-five">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue. Use your personal information.</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag7/img7.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act5-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">: What do you eat for </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-1f" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>													
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act5-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">I eat</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-1ff" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																						
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act5-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">: What do you have for </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-2f" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>													
													<div class="col-1">
														<p class="fst-normal"> ? </p>
													</div>	
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act5-4n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>												
													<div class="col-1">
														<p class="fst-normal">: I have </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-2ff" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 8, actividad 6.1 -->
<div id="ModalUnit1Act6_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points6_1" name="points">
											<input type="text" class="d-none" id="idcliente6_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro6_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act6_1-8" class="form-control"
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

<!-- Página 8, actividad 6.2 -->
<div id="ModalUnit1Act6_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points6_2" name="points">
											<input type="text" class="d-none" id="idcliente6_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro6_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag8/img8_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I eat</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">in the</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act6_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>						
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I wash my</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">before</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act6_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>						
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Do you</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">dinner?</p> 
													</div>											
													<div class="col-1">
														<p class="fst-normal">Yes, I eat</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act6_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>						
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">At</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">is my</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act6_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">time</p> 
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 9, actividad 7.1 -->
<div id="ModalUnit1Act7_1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT DO YOU THING ABOUT THESE HOBBIES IN YOUR FAMILY?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seven_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete these sentences using one of these adjectives</p>
											<input type="text" class="d-none" id="points7_1" name="points">
											<input type="text" class="d-none" id="idcliente7_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_1" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Swimming is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Fishing is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Reading is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Shopping is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>	
												
												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Playing tennis is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Playing football is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Watching TV is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Collecting stamps is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Listening to music is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																									
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
													<div class="col-2">
														<p class="fst-normal">Playing the guitar is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7_1-10" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 9, actividad 7.2 -->
<div id="ModalUnit1Act7_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WHAT DO YOU THINK OF THESE HOBBIES IN YOU FAMILY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seven_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the hobbies</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_2" name="points">
											<input type="text" class="d-none" id="idcliente7_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_9.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag9/img9_10.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-10" class="form-control"
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

<!-- Página 10, actividad 8.1 -->
<div id="ModalUnit1Act8_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EITHER... OR, NEITHER... NOR</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eight_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points8_1" name="points">
											<input type="text" class="d-none" id="idcliente8_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-7" class="form-control"
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

<!-- Página 10, actividad 8.2 -->
<div id="ModalUnit1Act8_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">EITHER... OR, NEITHER... NOR</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eight_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points8_2" name="points">
											<input type="text" class="d-none" id="idcliente8_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag10/img9_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I wear either</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">hat</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act8_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">a cap.</p> 
													</div>				
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Neither Tom</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">David</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act8_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I will eat</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">chicken</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act8_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">fish.</p> 
													</div>				
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Neither she</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">he will</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act8_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 11 -->
<div id="ModalUnit1Act9" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO EAT, TO KEEP</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nine">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to eat"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to keep"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act9-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 12 -->
<div id="ModalUnit1Act10" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO WASH, TO BUY</h5>
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
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to wash"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to buy"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act10-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 13, actividad 11.1 -->
<div id="ModalUnit1Act11_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SENTENCES USING THE VERBS CONJUGATE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points11_1" name="points">
											<input type="text" class="d-none" id="idcliente11_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-8" class="form-control"
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

<!-- Página 13, actividad 11.2 -->
<div id="ModalUnit1Act11_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SENTENCES USING THE VERBS CONJUGATE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points11_2" name="points">
											<input type="text" class="d-none" id="idcliente11_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag13/img13_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My sister</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">tomatoes</p> 
													</div>																														
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My uncle</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-2">
														<p class="fst-normal">in good shape</p> 
													</div>																																			
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-2">
														<p class="fst-normal">a glass of milk</p> 
													</div>																								
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">She likes</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																													
												</div>																			
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I wash</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">before lunch</p> 
													</div>																													
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My mother eats</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act11_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 14, actividad 12.1 -->
<div id="ModalUnit1Act12_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NOUNS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twelve_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points12_1" name="points">
											<input type="text" class="d-none" id="idcliente12_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro12_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act12_1-8" class="form-control"
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

<!-- Página 14, actividad 12.2 -->
<div id="ModalUnit1Act12_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NOUNS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twelve_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points12_2" name="points">
											<input type="text" class="d-none" id="idcliente12_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro12_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act12-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_2-1.png" alt="Bread" id="img-act12-1">
											</div>
											<div class="col ps-5">
												<div id="Dress" class="box-act12 text-center m-3" >
													<p>A dress </p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act12-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_2-2.png"  alt="Dress" id="img-act12-2">
											</div>
											<div class="col ps-5">
												<div id="Table" class="box-act12 text-center m-3" >
													<p>A table </p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act12-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_2-3.png"  alt="Book" id="img-act12-3">
											</div>
											<div class="col ps-5">
												<div id="Book" class="box-act12 text-center m-3" >
													<p>A slice of bread </p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act12-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag14/img14_2-4.png"  alt="Table" id="img-act12-4">
											</div>
											<div class="col ps-5">
												<div id="Table" class="box-act12 text-center m-3" >
													<p>A book </p>
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

<!-- Página 15, actividad 13.1 -->
<div id="ModalUnit1Act13_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ADJECTIVES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points13_1" name="points">
											<input type="text" class="d-none" id="idcliente13_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-8" class="form-control"
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

<!-- Página 15, actividad 13.2 -->
<div id="ModalUnit1Act13_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points13_2" name="points">
											<input type="text" class="d-none" id="idcliente13_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">I am a</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">student</p> 
													</div>																														
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My breakfast is</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																													
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">This shirt</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																		
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act13_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">pretty woman</p> 
													</div>
																																									
												</div>																			
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Her</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">is</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																													
												</div>
												
												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">His dog is</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act13_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 16 -->
<div id="ModalUnit1Act14" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">IDENTIFYING AND NAMING PARTS OF THE BODY AND FODD</h5>
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
											<p class="fs-5 fw-bold">Write two words for each one</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag16/img16.png">
										</div>										
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-4">
													<h4 style="text-align: center; margin-top: 15px;">FOOD</h4>
												</div>

												<div class="col-4">
													<h4 style="text-align: center; margin-top: 15px;">MY BODY</h4>
												</div>
												
												<div class="col-4">
													<h4 style="text-align: center; margin-top: 15px;">DRINK</h4>
												</div>


												<div class="col-4">
													<input type="text" id="input-act14-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"												
														autocomplete="off">
												</div>
												
												<div class="col-4">
													<input type="text" id="input-act14-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"												
														autocomplete="off">
												</div>	

												<div class="col-4">
													<input type="text" id="input-act14-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"													
														autocomplete="off">
												</div>	

												<div class="col-4">
													<input type="text" id="input-act14-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"													
														autocomplete="off">
												</div>
												
												<div class="col-4">
													<input type="text" id="input-act14-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"													
														autocomplete="off">
												</div>	

												<div class="col-4">
													<input type="text" id="input-act14-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"									
														style="margin-bottom: 15px; margin-top: 15px;"														
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

<!-- Página 17, actividad 15.1 -->
<div id="ModalUnit1Act15_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING LIKES AND DISLIKES IN SIMPLE SENTENCES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points15_1" name="points">
											<input type="text" class="d-none" id="idcliente15_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-12 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag17/img17_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-6" class="form-control"
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

<!-- Página 17, actividad 15.2 -->
<div id="ModalUnit1Act15_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">EXPRESSING LIKES AND DISLIKES IN SIMPLE SENTENCES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points15_2" name="points">
											<input type="text" class="d-none" id="idcliente15_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag15/img15_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I eat</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act15_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">and</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act15_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">to be healthy</p> 
													</div>																													
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">My mother</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act15_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">tomatoes, cucumbers,</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act15_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">and onions at a</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 18 -->
<div id="ModalUnit1Act16" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">FIND THE WORDS BELOW</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-1" onclick="checkCells('act16-1')">C</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-2" onclick="checkCells('act16-2')">O</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-3" onclick="checkCells('act16-3')">F</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-4" onclick="checkCells('act16-4')">F</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-5" onclick="checkCells('act16-5')">E</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-6" onclick="checkCells('act16-6')">E</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-7" onclick="checkCells('act16-7')">A</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-8" onclick="checkCells('act16-8')">R</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-9" onclick="checkCells('act16-9')">S</th>
                                        </tr>
										<tr><!-- ROW TWO -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-10" onclick="checkCells('act16-10')">H</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-11" onclick="checkCells('act16-11')">A</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-12" onclick="checkCells('act16-12')">N</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-13" onclick="checkCells('act16-13')">D</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-14" onclick="checkCells('act16-14')">S</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-15" onclick="checkCells('act16-15')">G</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-16" onclick="checkCells('act16-16')">F</th>
											<th class="text-center cell-act16" width="30" height="30"></th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-17" onclick="checkCells('act16-17')">A</th>
                                        </tr>
										<tr><!-- ROW THREE -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-18" onclick="checkCells('act16-18')">I</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-19" onclick="checkCells('act16-19')">O</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-20" onclick="checkCells('act16-20')">R</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-21" onclick="checkCells('act16-21')">A</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-22" onclick="checkCells('act16-22')">N</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-23" onclick="checkCells('act16-23')">G</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-24" onclick="checkCells('act16-24')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-25" onclick="checkCells('act16-25')">A</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-26" onclick="checkCells('act16-26')">L</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-27" onclick="checkCells('act16-27')">C</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-28" onclick="checkCells('act16-28')">U</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-29" onclick="checkCells('act16-29')">C</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-30" onclick="checkCells('act16-30')">U</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-31" onclick="checkCells('act16-31')">M</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-32" onclick="checkCells('act16-32')">B</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-33" onclick="checkCells('act16-33')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-34" onclick="checkCells('act16-34')">R</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-35" onclick="checkCells('act16-35')">A</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-36" onclick="checkCells('act16-36')">K</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-37" onclick="checkCells('act16-37')">F</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-38" onclick="checkCells('act16-38')">O</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-39" onclick="checkCells('act16-39')">O</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-40" onclick="checkCells('act16-40')">D</th>
											<th class="text-center cell-act16" width="30" height="30"></th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-41" onclick="checkCells('act16-41')">T</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-42" onclick="checkCells('act16-42')">M</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-43" onclick="checkCells('act16-43')">D</th>
                                        </tr>
										<tr><!-- ROW SIX -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-44" onclick="checkCells('act16-44')">E</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-45" onclick="checkCells('act16-45')">A</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-46" onclick="checkCells('act16-46')">T</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-47" onclick="checkCells('act16-47')">E</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-48" onclick="checkCells('act16-48')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-49" onclick="checkCells('act16-49')">T</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-50" onclick="checkCells('act16-50')">H</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-51" onclick="checkCells('act16-51')">S</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-52" onclick="checkCells('act16-52')">F</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-53" onclick="checkCells('act16-53')">N</th>
											<th class="text-center cell-act16" width="30" height="30">C</th>
											<th class="text-center cell-act16" width="30" height="30"></th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-54" onclick="checkCells('act16-54')">P</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-55" onclick="checkCells('act16-55')">O</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-56" onclick="checkCells('act16-56')">T</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-57" onclick="checkCells('act16-57')">A</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-58" onclick="checkCells('act16-58')">T</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-59" onclick="checkCells('act16-59')">O</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-60" onclick="checkCells('act16-60')">L</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-61" onclick="checkCells('act16-61')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-62" onclick="checkCells('act16-62')">G</th>
                                            <th class="text-center cell-act16" width="30" height="30"></th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-63" onclick="checkCells('act16-63')">W</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-64" onclick="checkCells('act16-64')">A</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-65" onclick="checkCells('act16-65')">T</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-66" onclick="checkCells('act16-66')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-67" onclick="checkCells('act16-67')">R</th>
                                        </tr>
										<tr><!-- ROW NINE -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-68" onclick="checkCells('act16-68')">B</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-69" onclick="checkCells('act16-69')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-70" onclick="checkCells('act16-70')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-71" onclick="checkCells('act16-71')">F</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-72" onclick="checkCells('act16-72')">S</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-73" onclick="checkCells('act16-73')">T</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-74" onclick="checkCells('act16-74')">E</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-75" onclick="checkCells('act16-75')">A</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-76" onclick="checkCells('act16-76')">K</th>
                                        </tr>
										<tr><!-- ROW TEN -->
											<th class="text-center cell-act16" width="30" height="30" id="act16-77" onclick="checkCells('act16-77')">M</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-78" onclick="checkCells('act16-78')">A</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-79" onclick="checkCells('act16-79')">C</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-80" onclick="checkCells('act16-80')">A</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-81" onclick="checkCells('act16-81')">R</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-82" onclick="checkCells('act16-82')">O</th>
                                            <th class="text-center cell-act16" width="30" height="30" id="act16-83" onclick="checkCells('act16-83')">N</th>
											<th class="text-center cell-act16" width="30" height="30" id="act16-84" onclick="checkCells('act16-84')">I</th>
											<th class="text-center cell-act16" width="30" height="30"></th>
                                        </tr>
                                    </table>
									<div class="row pt-4">
										<p class="text-center">Rewrite the phrases</p>
									</div>
									<div class="row">
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-1" placeholder="Coffee"> 																			
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-2" placeholder="Beefsteak"> 																				
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-3" placeholder="Hands"> 																				
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-4" placeholder="Macaroni"> 																		
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-5" placeholder="Egg"> 																			
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-6" placeholder="Feet"> 																			
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-7" placeholder="Cucumber"> 																			
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-8" placeholder="Orange"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-9" placeholder="Food"> 																			
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-10" placeholder="Ears"> 																		
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-11" placeholder="Eat"> 																			
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-12" placeholder="Chicken"> 																				
										</div>
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-13" placeholder="Teeth"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-14" placeholder="Arms"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-15" placeholder="Potato"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-16" placeholder="Face"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-17" placeholder="Water"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-18" placeholder="Fork"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-19" placeholder="Leg"> 																				
										</div>	
										<div class="col-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act16-20" placeholder="Salad"> 																				
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

<!-- Página 19 -->
<div id="ModalUnit1Act17" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CROSSWORD PUZZLE</h5>
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
											<p class="fs-1 fw-bold">Read the words below and answer the crossword</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<link rel="stylesheet" href="../../app/controllers/BookOneUnitTwo/style.css" />
										<div class="col-md-12 col-xs-12">
											<script src="../../app/controllers/BookOneUnitTwo/polyfill/dialog-polyfill.js"></script>
                        					<!--Se elimino el script main.js aquí ya que tuvo conflicto con el canvas, hizo que dejara de funcionar -->
											<form class="form" autocomplete="off" method="post" novalidate>
												
												<div class="row justify-content-md-center justify-content-sm-center">													
													<div class="col-12">
														<div align="center">    
															<table style="width:50%;">
																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="1">1</label>
																		<input
																			required
																			id="1"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Bb]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="2"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ii]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="3"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="4"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="5"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Hh]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="6"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Dd]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<label class="word-number" for="2">2</label>
																		<input
																			required
																			id="7"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<label class="word-number" for="3">3</label>
																		<input
																			required
																			id="8"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Yy]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>															
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="4">4</label>
																		<input
																			required
																			id="9"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="10"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="11"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Dd]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="12"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ii]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<label class="word-number" for="5">5</label>
																		<input
																			required
																			id="13"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="14"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Hh]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="15"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="16"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	     
																	<td class="cell cell-black" ></td>	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="6">6</label>
																		<input
																			required
																			id="17"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="18"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="19"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="19"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="20"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="21"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="22"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="22"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="7">7</label>
																		<input
																			required
																			id="23"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="24"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="25"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="26"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="27"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<input
																			required
																			id="28"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="29"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	     
																	<td class="cell cell-black" ></td>	  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<input
																			required
																			id="24"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Kk]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="8">8</label>
																		<input
																			required
																			id="25"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Cc]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="26"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="27"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<label class="word-number" for="9">9</label>
																		<input
																			required
																			id="28"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<input
																			required
																			id="29"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="10">10</label>
																		<input
																			required
																			id="30"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ff]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="31"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="32"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="33"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Hh]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="34"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="35"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="36"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="37"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>                
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="11">11</label>
																		<input
																			required
																			id="38"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="39"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ff]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="40"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="41"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="42"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="43"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Uu]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="44"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Dd]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td> 	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="12">12</label>
																		<input
																			required
																			id="45"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="46"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Mm]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="47"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="48"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="49"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="50"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="51"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td> 	
																</tr>
																
																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="13">13</label>
																		<input
																			required
																			id="45"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="46"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="47"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Dd]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="48"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="49"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Yy]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >
																		<label class="word-number" for="14">14</label>
																		<input
																			required
																			id="50"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="51"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="52"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Yy]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td> 	
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td> 	
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td> 	
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black"></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

															</table>
														</div>
													</div>
													<div class="col-9">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag19/img19.png"
														style="margin-top: 15px;">	
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag19/img19_1.png"
														style="margin-top: 15px;">
													</div>
												</div>
												

												<div class="row justify-content-md-center justify-content-sm-center">

													<button class="btn btn-success btn-clear" type="reset" style="margin-top: 10px; margin-bottom: 10px;">
														Clean
													</button>

												</div>
											</form>																				
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

<!-- Página 20 -->
<div id="ModalUnit1Act18" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">FRUIT CROSSWORD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eighteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Answer the crossword</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<link rel="stylesheet" href="../../app/controllers/BookOneUnitTwo/style.css" />
										<div class="col-md-12 col-xs-12">
											<script src="../../app/controllers/BookOneUnitTwo/polyfill/dialog-polyfill.js"></script>
                        					<!--Se elimino el script main.js aquí ya que tuvo conflicto con el canvas, hizo que dejara de funcionar -->
											<form class="form" autocomplete="off" method="post" novalidate>
												
												<div class="row justify-content-md-center justify-content-sm-center">													
													<div class="col-12">
														<div align="center">    
															<table style="width:50%;">
																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="1">1</label>
																		<input
																			required
																			id="1"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Gg]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>															
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="2"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	            
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="3"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="2">2</label>
																		<input
																			required
																			id="4"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Bb]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	           
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="5"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="4">4</label>
																		<input
																			required
																			id="6"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="7"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="8"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="9"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="10"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="11"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="12"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="4">4</label>
																		<input
																			required
																			id="13"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="5">5</label>
																		<input
																			required
																			id="14"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ss]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="15"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="16"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="17"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="18"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ww]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="19"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Bb]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="20"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="21"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="22"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="23"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Yy]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="24"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="25"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="6">6</label>
																		<input
																			required
																			id="26"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="27"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="28"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="29"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Rr]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="30"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>
																
																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="31"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="32"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Gg]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="33"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Uu]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="7">7</label>
																		<input
																			required
																			id="34"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="35"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="36"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Mm]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="37"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="39"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="40"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Mm]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="41"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ii]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="42"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Mm]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="43"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>		  	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	
																</tr>

															</table>
														</div>
													</div>
													<div class="col-9">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag20/img20.png"
														style="margin-top: 15px;">															
													</div>
												</div>
												

												<div class="row justify-content-md-center justify-content-sm-center">

													<button class="btn btn-success btn-clear" type="reset" style="margin-top: 10px; margin-bottom: 10px;">
														Clean
													</button>

												</div>
											</form>																				
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

<!-- Página 22, actividad 19.1 -->
<div id="ModalUnit1Act19_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">INTERACTING GREETINGS IN ORAL AND WRITTEN FORM</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points19_1" name="points">
											<input type="text" class="d-none" id="idcliente19_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro19_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag22/img22_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Good morning, Francisco."
															autocomplete="off">
													<input type="text" id="input-act19_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Good morning, teacher!"
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag22/img22_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Good evening, dear son!"
															autocomplete="off">
													<input type="text" id="input-act19_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Good evening father!"
															autocomplete="off">
												</div>	
											</div>
																																										 
										</div>		

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag22/img22_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="How are you, Manuel?"
															autocomplete="off">
													<input type="text" id="input-act19_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Fine, thank you and, you?"
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>		


										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag22/img22_1-4.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Hello! I'm glad to see you."
															autocomplete="off">
													<input type="text" id="input-act19_1-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Hi! I'm glad to see you too."
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

<!-- Página 22, actividad 19.2 -->
<div id="ModalUnit1Act19_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">INTERACTING GREETINGS IN ORAL AND WRITTEN FORM</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points19_2" name="points">
											<input type="text" class="d-none" id="idcliente19_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro19_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag22/img22_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Good</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act19_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">, father.</p> 
													</div>																																											
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Good</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act19_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">, teacher.</p> 
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act19_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">, mother.</p> 
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act19_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">, my friend.</p> 
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">How</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act19_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">, Manuel?</p> 
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-2">
														<input type="text" id="input-act19_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">you, and you?</p> 
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 23, actividad 20.1 -->
<div id="ModalUnit1Act20_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING GREETING EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twenty_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points20_1" name="points">
											<input type="text" class="d-none" id="idcliente20_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro20_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag23/img23_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act20_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="How are you, Claudia?"
															autocomplete="off">
													<input type="text" id="input-act20_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Not to bad, thanks."
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag23/img23_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act20_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="How do you do Mrs. Chacón?"
															autocomplete="off">
													<input type="text" id="input-act20_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="I’m fine, thank you."
															autocomplete="off">
												</div>	
											</div>
																																										 
										</div>		

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag23/img23_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act20_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="What’s new, David?"
															autocomplete="off">
													<input type="text" id="input-act20_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Not much, James."
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>		


										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag23/img23_1-4.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act20_1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="See you later, Héctor."
															autocomplete="off">
													<input type="text" id="input-act20_1-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="See you, my friend."
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

<!-- Página 23, actividad 20.2 -->
<div id="ModalUnit1Act20_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">INTERACTING GREETINGS IN ORAL AND WRITTEN FORM</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twenty_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points20_2" name="points">
											<input type="text" class="d-none" id="idcliente20_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro20_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag23/img23_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">How are</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act20_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																																											
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">Not too bad,</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act20_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-1">
														<p class="fst-normal">How do</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act20_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">do</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act20_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<p class="fst-normal">I'm fine, </p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act20_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
																																																																																			
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-2">
														<p class="fst-normal">What's new,</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act20_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																																																																							
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-1">
														<p class="fst-normal">Not much,</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act20_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 24, actividad 21.1 -->
<div id="ModalUnit1Act21_1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DRAW AND WRITE ABOUT YOU</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyone_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw yourself and asnwer the questions</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
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

										canvas21 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn21 {
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
													<input type="color" id="colorPicker21" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker21">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn21">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas21" style="background: url('../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag24/img24.png')"
											width="300" height="350">

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
													<p>What's your name?</p>
													<input type="text" id="input-act21_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"														
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<p>What's your favorite color?</p>
													<input type="text" id="input-act21_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"														
														autocomplete="off">
												</div>

												<div class="col-6">
													<p>How old are you?</p>
													<input type="text" id="input-act21_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"														
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<p>Where are you from?</p>
													<input type="text" id="input-act21_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"														
														autocomplete="off">
												</div>

												<div class="col-6">
													<p>Where do you live?</p>
													<input type="text" id="input-act21_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"														
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<p>When's your birthday?</p>
													<input type="text" id="input-act21_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px;"														
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

<!-- Página 24, actividad 21.2 -->
<div id="ModalUnit1Act21_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DRAW AND WRITE ABOUT YOU</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyone_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw your family members</p>
											<input type="text" class="d-none" id="points21_2" name="points">
											<input type="text" class="d-none" id="idcliente21_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro21_2" name="idlibro">
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

										canvas21_2 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn21_2 {
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
													<input type="color" id="colorPicker21_2" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker21_2">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn21_2">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas21_2" style="background: url('../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag24/img24_2.png')"
											width="900" height="425">

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

<!-- Página 25, actividad 22.1 -->
<div id="ModalUnit1Act22_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MY FAMILY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentytwo_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points22_1" name="points">
											<input type="text" class="d-none" id="idcliente22_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro22_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-1.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">								
											</div>																																	
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-2.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"		
														placeholder="Rewrite the sentence"												
														autocomplete="off">												
											</div>												
																																										 
										</div>		

										<div class="col-md-6 col-sm-6">
																				
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-3.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>																															
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
								
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-4.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">													
											</div>	
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-5.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"														
														autocomplete="off">								
											</div>	
																				 
										</div>											
										
										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-6.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"												
														autocomplete="off">												
											</div>	
																																									 
										</div>		

										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-7.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>	
																				 
										</div>		

										<div class="col-md-6 col-sm-6">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_1-8.png">
											</div>
											<div class="col">
												<input type="text" id="input-act22_1-8" class="form-control"
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

<!-- Página 25, actividad 22.2 -->
<div id="ModalUnit1Act22_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MY FAMILY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentytwo_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points22_2" name="points">
											<input type="text" class="d-none" id="idcliente22_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro22_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag25/img25_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act22_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">is always</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																											
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Gloria is my</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act22_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">Pacita</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act22_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">my</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">Benjamin is my</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">We are his</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act22_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act22_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">is Francisco.</p> 
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 26, actividad 23.1 -->
<div id="ModalUnit1Act23_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PROFESSIONS/OCCUPATIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentythree_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points23_1" name="points">
											<input type="text" class="d-none" id="idcliente23_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro23_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-1.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">								
											</div>																																	
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-2.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"												
														autocomplete="off">												
											</div>												
																																										 
										</div>		

										<div class="col-md-6 col-sm-6">
																				
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-3.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>																															
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
								
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-4.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">													
											</div>	
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-5.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"														
														autocomplete="off">								
											</div>	
																				 
										</div>											
										
										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-6.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"												
														autocomplete="off">												
											</div>	
																																									 
										</div>		

										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-7.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>	
																				 
										</div>		

										<div class="col-md-6 col-sm-6">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_1-8.png">
											</div>
											<div class="col">
												<input type="text" id="input-act23_1-8" class="form-control"
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

<!-- Página 26, actividad 23.2 -->
<div id="ModalUnit1Act23_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">PROFESSIONS/OCCUPATIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentythree_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points23_2" name="points">
											<input type="text" class="d-none" id="idcliente23_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro23_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag26/img26_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My sister-in-law</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act23_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">a</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act23_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																											
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">His niece is a good</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act23_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act23_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">grandma is a</p> 
													</div>																											
													<div class="col-2">
														<input type="text" id="input-act23_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">I am a</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act23_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act23_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">brother-in-law is a</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act23_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																																	
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-3">
														<p class="fst-normal">Manuel is the new</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act23_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 27 -->
<div id="ModalUnit1Act24" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO WANT, TO TYPE</h5>
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
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to want"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to type"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act24-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 28 -->
<div id="ModalUnit1Act25" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO DRIVE, TO FIX</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyfive">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to drive"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to fix"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act25-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 29 -->
<div id="ModalUnit1Act26" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO BE, TO STUDY</h5>
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
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to be"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to study"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act26-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 30 -->
<div id="ModalUnit1Act27" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO PROTECT, TO LOVE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyseven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points27" name="points">
											<input type="text" class="d-none" id="idcliente27" name="idcliente">
											<input type="text" class="d-none" id="idlibro27" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to protect"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to love"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act27-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 31, actividad 28.1 -->
<div id="ModalUnit1Act28_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WORK PLACES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyeight_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points28_1" name="points">
											<input type="text" class="d-none" id="idcliente28_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro28_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-3.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-4.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-5.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-6.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-7.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_1-8.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act28_1-8" class="form-control"
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

<!-- Página 31, actividad 28.2 -->
<div id="ModalUnit1Act28_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WORK PLACES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyeight_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points28_2" name="points">
											<input type="text" class="d-none" id="idcliente28_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro28_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act28-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_2-1.png" alt="Barbershop" id="img-act28-1">
											</div>
											<div class="col ps-5">
												<div id="Cityhall" class="box-act28 text-center m-3" >
													<p>City Hall </p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act28-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_2-2.png"  alt="Cityhall" id="img-act28-2">
											</div>
											<div class="col ps-5">
												<div id="Barbershop" class="box-act28 text-center m-3" >
													<p>Barber shop </p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act28-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag31/img31_2-3.png"  alt="Shoppingcenter" id="img-act28-3">
											</div>
											<div class="col ps-5">
												<div id="Shoppingcenter" class="box-act28 text-center m-3" >
													<p>Shopping center</p>
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

<!-- Página 31, actividad 29.1 -->
<div id="ModalUnit1Act29_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES USING THE CONJUGATED VERBS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentynine_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points29_1" name="points">
											<input type="text" class="d-none" id="idcliente29_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro29_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-1.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">								
											</div>																																	
																					 
										</div>											
										
										<div class="col-md-6 col-sm-6">
																										
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-2.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"		
														placeholder="Rewrite the sentence"											
														autocomplete="off">												
											</div>												
																																										 
										</div>		

										<div class="col-md-6 col-sm-6">
																				
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-3.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>																															
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
								
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-4.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"													
														autocomplete="off">													
											</div>	
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-5.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"														
														autocomplete="off">								
											</div>	
																				 
										</div>											
										
										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-6.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"												
														autocomplete="off">												
											</div>	
																																									 
										</div>		

										<div class="col-md-6 col-sm-6">
											
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-7.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"	
														placeholder="Rewrite the sentence"															
														autocomplete="off">													
											</div>	
																				 
										</div>		

										<div class="col-md-6 col-sm-6">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_1-8.png">
											</div>
											<div class="col">
												<input type="text" id="input-act29_1-8" class="form-control"
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

<!-- Página 31, actividad 29.2 -->
<div id="ModalUnit1Act29_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES USING THE CONJUGATED VERBS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentynine_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points29_2" name="points">
											<input type="text" class="d-none" id="idcliente29_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro29_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitOne/Pag32/img32_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My grandpa</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act29_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-1">
														<p class="fst-normal">a bus</p> 
													</div>																																																							
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act29_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">my grandchildren</p>
													</div>																																																																																			
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act29_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">the new</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act29_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">Armando</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act29_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>			
													<div class="col-1">
														<p class="fst-normal">an old</p> 
													</div>																																																																																	
													<div class="col-2">
														<input type="text" id="input-act29_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">You</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act29_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">very intelligent</p> 
													</div>																																																																																		
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-2">
														<p class="fst-normal">My nephew</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act29_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">to be a</p> 
													</div>								
													<div class="col-2">
														<input type="text" id="input-act29_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
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
				</div>
			</form>
		</div>
	</div>
</div>
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro3_u1.js');
?>