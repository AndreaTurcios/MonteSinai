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
		<!-- Thumbnails -->
		<div class="thumbnails">
			<div>
				<ul>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/1.JPG" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/14.JPG" width="76" height="100"
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadtrestercergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Modales Audios -->
<div id="ModalUnit3AudioPagWelcome" class="modal fade" tabindex="-2">	
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

<div id="ModalUnit3AudioPag65" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio65">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit3/pag65.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag66" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio66">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit3/pag66.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag67" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio67">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit3/pag67.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit3AudioPag71" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio71">
						
				<audio controls style="margin-right: 100px;">
					<source src="../../resources/audio/ingles_tercero/Unit3/pag71.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag72.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag73.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag74.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag75.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag76.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag78.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag79.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag80.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag83.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag84.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag85.mp3" type="audio/mp3">
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
					<source src="../../resources/audio/ingles_tercero/Unit3/pag86.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>
<!-- Página 65, actividad 1.1 -->
<div id="ModalUnit3Act1_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN CLOCK</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_1" name="points">
											<input type="text" class="d-none" id="idcliente1_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act1_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act1_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
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

<!-- Página 65, actividad 1.2 -->
<div id="ModalUnit3Act1_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN THE CLOCK</h5>
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
											<p class="fs-1 fw-bold">Match the hour with the clock</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_2" name="points">
											<input type="text" class="d-none" id="idcliente1_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act1-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-1.png" alt="Six" id="img-act1-1">
											</div>
											<div class="col ps-5">
												<div id="Six" class="box-act1 text-center m-3" >
													<p>6:30</p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-2.png"  alt="Nine" id="img-act1-2">
											</div>
											<div class="col ps-5">
												<div id="Eleven" class="box-act1 text-center m-3" >
													<p>11:45</p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-3.png"  alt="Ten" id="img-act1-3">
											</div>
											<div class="col ps-5">
												<div id="Three" class="box-act1 text-center m-3" >
													<p>3:50</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-4.png"  alt="Eleven" id="img-act1-4">
											</div>
											<div class="col ps-5">
												<div id="Nine" class="box-act1 text-center m-3" >
													<p>9:55</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-5.png"  alt="Three" id="img-act1-5">
											</div>
											<div class="col ps-5">
												<div id="Ten" class="box-act1 text-center m-3" >
													<p>10:15</p>
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

<!-- Página 66 -->
<div id="ModalUnit3Act2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MEALS</h5>
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
											<p class="fs-1 fw-bold">Match the activity with the clock</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act2-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-1.png" alt="Seven" id="img-act2-1">
											</div>
											<div class="col ps-5">
												<div id="Twelve" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img661.png">
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-2.png"  alt="Six" id="img-act2-2">
											</div>
											<div class="col ps-5">
												<div id="Nine" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img662.png">
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-3.png"  alt="Eleven" id="img-act2-3">
											</div>
											<div class="col ps-5">
												<div id="Eleven" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img663.png">
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-4.png"  alt="Nine" id="img-act2-4">
											</div>
											<div class="col ps-5">
												<div id="Six" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img664.png">
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-5.png"  alt="Twelve" id="img-act2-5">
											</div>
											<div class="col ps-5">
												<div id="Seven" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img665.png">
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

<!-- Página 67, actividad 3.1 -->
<div id="ModalUnit3Act3_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN CLOCK</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3_1" name="points">
											<input type="text" class="d-none" id="idcliente3_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-12 col-sm-12">
												
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-1.png">
												</div>

												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>
											</div>												
																					 
										</div>											
										
                                        <div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-2.png">
												</div>
												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>
											</div>
                                           
                                                                                        
                                        </div>	

									    <div class="col-md-12 col-sm-12">
													
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-3.png">
												</div>

												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
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

<!-- Página 67, actividad 3.2 -->
<div id="ModalUnit3Act3_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">THE TIME IN CLOCK</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points3_2" name="points">
											<input type="text" class="d-none" id="idcliente3_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">What</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">do you have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>													
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">I have breakfast at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act3_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">time do you</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
                                                    <div class="col-1">
														<p class="fst-normal">lunch?</p> 
													</div>																							
												</div>

                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
                                                    <div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
                                                    <div class="col-2">
														<input type="text" id="input-act3_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																								
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">What time</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									
                                                    <div class="col-1">
														<p class="fst-normal">have dinner?</p> 
													</div>
												</div>	
                                                
                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
                                                    <div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
                                                    <div class="col-2">
														<input type="text" id="input-act3_2-10" class="form-control"
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

<!-- Página 68 -->
<div id="ModalUnit3Act4" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO WAKE, TO GET</h5>
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
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to wake"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact49-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-12" class="form-control"
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
																<input type="text" id="input-act4-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to get"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-36" class="form-control"
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
																<input type="text" id="input-act4-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-48" class="form-control"
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

<!-- Página 69 -->
<div id="ModalUnit3Act5" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO HAVE, TO GO</h5>
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
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to have"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact59-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-12" class="form-control"
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
																<input type="text" id="input-act5-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to go"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-36" class="form-control"
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
																<input type="text" id="input-act5-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-48" class="form-control"
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

<!-- Página 70 -->
<div id="ModalUnit3Act6" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO LIKE, TO DO</h5>
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
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to like"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact69-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-12" class="form-control"
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
																<input type="text" id="input-act6-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to do"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-36" class="form-control"
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
																<input type="text" id="input-act6-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-48" class="form-control"
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

<!-- Página 71, actividad 7.1 -->
<div id="ModalUnit3Act7_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING VOCABULARY RELATED TO THE TIME</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_1" name="points">
											<input type="text" class="d-none" id="idcliente7_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>
																																										 
										</div>		

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
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

<!-- Página 71, actividad 7.2 -->
<div id="ModalUnit3Act7_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING VOCABULARY RELATED TO THE TIME</h5>
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
											<p class="fs-1 fw-bold">Answer the questions</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_2" name="points">
											<input type="text" class="d-none" id="idcliente7_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">	
												<div class="col-12">
													<p>What time do you go to bed?</p>
												</div>										
												<div class="col-8">
													<input type="text" id="input-act7_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Answer the question"
															autocomplete="off">													
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">											
												<div class="col-12">
													<p>What time do you have breakfast?</p>
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Answer the question"
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

<!-- Página 72, actividad 8.1 -->
<div id="ModalUnit3Act8_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES USING THE VERBS: WAKE UP, GET UP, DO, GO</h5>
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
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	
									
										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-5.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-5" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-6.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-6" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
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

<!-- Página 72, actividad 8.2 -->
<div id="ModalUnit3Act8_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES USING THE VERBS: WAKE UP, GET UP, DO, GO</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points8_2" name="points">
											<input type="text" class="d-none" id="idcliente8_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">at five</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																							
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My father</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">ten</p> 
													</div>																							                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">to get up late on</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		                                                   																							
												</div>

												<hr>

                                               	<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">my homework at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-8" class="form-control"
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
														<input type="text" id="input-act8_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">to school at 7 a.m.</p> 
													</div>												                                                   																							
												</div>
												
												<hr>
                                                
                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">He</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-10" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	                                                  
													<div class="col-3">
														<p class="fst-normal">his homework on time</p> 
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

<!-- Página 73  -->
<div id="ModalUnit3Act9" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES USING THE VERBS: WAKE UP, GET UP, DO, GO</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag73/img73.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">soccer in</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																							
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">We</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">out homework</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																					                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">They</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">their homework</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		                                                   																							
												</div>

												<hr>

                                               	<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">It is six</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">in</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		                                                   																							
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">It is nine</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act9-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">at</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9-10" class="form-control"
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

<!-- Página 74, actividad 10.1 -->
<div id="ModalUnit3Act10_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ADJECTIVES/ADVERBS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-ten_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentences</p>
											<input type="text" class="d-none" id="points10_1" name="points">
											<input type="text" class="d-none" id="idcliente10_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro10_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																							
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
													<h4 style="text-align: center; margin-top: 15px;">ADJECTIVES: They describe a noun or pronoun</h4>
												</div>

												<div class="col-6">
													<h4 style="text-align: center; margin-top: 15px;">ADVERBS: They modify verbs, adjectives, or adverbs</h4>
												</div>																						


												<div class="col-6">
													<img style="margin-top: 25px;"class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag74/img74_1-1.png">
													<input type="text" id="input-act10_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"	
														placeholder="Rewrite the sentences"								
														style="margin-bottom: 15px; margin-top: 15px;"												
														autocomplete="off">
												</div>
												
												<div class="col-6">
													<img style="margin-top: 25px;"class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag74/img74_1-2.png">
													<input type="text" id="input-act10_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"	
														placeholder="Rewrite the sentences"										
														style="margin-bottom: 15px; margin-top: 15px;"												
														autocomplete="off">
												</div>	

												<div class="col-6">
													<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag74/img74_1-3.png">
													<input type="text" id="input-act10_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"	
														placeholder="Rewrite the sentences"										
														style="margin-bottom: 15px; margin-top: 15px;"													
														autocomplete="off">
												</div>	

												<div class="col-6">
													<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag74/img74_1-4.png">
													<input type="text" id="input-act10_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"	
														placeholder="Rewrite the sentences"										
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

<!-- Página 74, actividad 10.2  -->
<div id="ModalUnit3Act10_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES/ADVERBS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-ten_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue</p>
											<input type="text" class="d-none" id="points10_2" name="points">
											<input type="text" class="d-none" id="idcliente10_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro10_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag74/img74_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I'll</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">the</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">train.</p> 
													</div>																						
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I awoke</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">this</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																					                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I'm</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">the</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">film</p> 
													</div>                                                   																							
												</div>

												<hr>

                                               	<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act10_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">train arrived</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		          
													<div class="col-2">
														<p class="fst-normal">, as usual</p> 
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

<!-- Página 75, actividad 11.1 -->
<div id="ModalUnit3Act11_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES RELATED TO THE TIME</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentences</p>
											<input type="text" class="d-none" id="points11_1" name="points">
											<input type="text" class="d-none" id="idcliente11_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																							
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag75/img75_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act11_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act11_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>							

										</div>		
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag75/img75_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act11_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act11_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>							

										</div>	

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag75/img75_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act11_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act11_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
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

<!-- Página 75, actividad 11.1 -->
<div id="ModalUnit3Act11_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES RELATED TO THE TIME</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the questions</p>
											<input type="text" class="d-none" id="points11_2" name="points">
											<input type="text" class="d-none" id="idcliente11_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																															

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">What time is it?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act11_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																		
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">What time do you go to bed?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act11_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="I go to bed at..."
															autocomplete="off">
													</div>																																		
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">What time do you wake up in the morning?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act11_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="I wake up at..."
															autocomplete="off">
													</div>																																		
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

<!-- Página 76-->
<div id="ModalUnit3Act12" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES RELATED TO THE TIME</h5>
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
											<p class="fs-5 fw-bold">Complete the table</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																							
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">CLASSMATES</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">BREAKFAST</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">LUNCH</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">DINNER</p> 
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">Mauricio</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">6 a.m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">1 p.m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">6 p.m.</p> 
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">Lorena</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">6.30 p.m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">12 m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">7 p.m.</p> 
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">Lorena</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">6.30 p.m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">12 m.</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">7 p.m.</p> 
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<p class="fst-normal text-center">Your classmate</p> 
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<select class="form-select form-select-sm mt-3 mb-3" id="input-act12-1" name="input-act12-1">

																	<option disabled selected></option>
																	<option value="6 a.m.">6 a.m.</option>
																	<option value="7 a.m.">7 a.m.</option>
																	<option value="8 a.m.">8 a.m.</option>
																	<option value="9 a.m.">9 a.m.</option>
																	<option value="10 a.m.">10 a.m.</option>
																	<option value="11 a.m.">11 a.m.</option>
																	<option value="12 m.">12 m.</option>
																	<option value="1 p.m.">1 p.m.</option>
																	<option value="2 p.m.">2 p.m.</option>
																	<option value="3 p.m.">3 p.m.</option>
																	<option value="4 p.m.">4 p.m.</option>
																	<option value="5 p.m.">5 p.m.</option>
																	<option value="6 p.m.">6 p.m.</option>
																	<option value="7 p.m.">7 p.m.</option>
																	<option value="8 p.m.">8 p.m.</option>

																</select>	
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<select class="form-select form-select-sm mt-3 mb-3" id="input-act12-2" name="input-act12-2">

																	<option disabled selected></option>
																	<option value="6 a.m.">6 a.m.</option>
																	<option value="7 a.m.">7 a.m.</option>
																	<option value="8 a.m.">8 a.m.</option>
																	<option value="9 a.m.">9 a.m.</option>
																	<option value="10 a.m.">10 a.m.</option>
																	<option value="11 a.m.">11 a.m.</option>
																	<option value="12 m.">12 m.</option>
																	<option value="1 p.m.">1 p.m.</option>
																	<option value="2 p.m.">2 p.m.</option>
																	<option value="3 p.m.">3 p.m.</option>
																	<option value="4 p.m.">4 p.m.</option>
																	<option value="5 p.m.">5 p.m.</option>
																	<option value="6 p.m.">6 p.m.</option>
																	<option value="7 p.m.">7 p.m.</option>
																	<option value="8 p.m.">8 p.m.</option>

																</select>	
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-4">
																<select class="form-select form-select-sm mt-3 mb-3" id="input-act12-3" name="input-act12-3">

																	<option disabled selected></option>
																	<option value="6 a.m.">6 a.m.</option>
																	<option value="7 a.m.">7 a.m.</option>
																	<option value="8 a.m.">8 a.m.</option>
																	<option value="9 a.m.">9 a.m.</option>
																	<option value="10 a.m.">10 a.m.</option>
																	<option value="11 a.m.">11 a.m.</option>
																	<option value="12 m.">12 m.</option>
																	<option value="1 p.m.">1 p.m.</option>
																	<option value="2 p.m.">2 p.m.</option>
																	<option value="3 p.m.">3 p.m.</option>
																	<option value="4 p.m.">4 p.m.</option>
																	<option value="5 p.m.">5 p.m.</option>
																	<option value="6 p.m.">6 p.m.</option>
																	<option value="7 p.m.">7 p.m.</option>
																	<option value="8 p.m.">8 p.m.</option>

																</select>	
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

<!-- Página 78, actividad 13.1 -->
<div id="ModalUnit3Act13_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">DAILY ACTIVITIES</h5>
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

                                        <div class="col-md-6 col-sm-12">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">													
											</div>												
																					
										</div>											
										
                                        <div class="col-md-6 col-sm-12">
													                                        
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">													
											</div>                                          
                                        </div>	

									    <div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>	

										</div>	    
										
										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-4.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>

										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag78/img78_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-6" class="form-control"
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

<!-- Página 78, actividad 13.2 -->
<div id="ModalUnit3Act13_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">DAILY ACTIVITIES</h5>
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
											<p class="fs-1 fw-bold">Match the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points13_2" name="points">
											<input type="text" class="d-none" id="idcliente13_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-12 col-sm-12">
												
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-1" name="input-act13_2-1">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>
														
													</select>	
												</div>

												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at five thirty a.m.</p> 								
												</div>
											</div>												
																					 
										</div>											
										
                                        <div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-2" name="input-act13_2-2">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at five twenty a.m.</p> 											
												</div>
											</div>
                                           
                                                                                        
                                        </div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-3" name="input-act13_2-3">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at five twenty-five a.m.</p> 											
												</div>
											</div>
											
																						
										</div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-4" name="input-act13_2-4">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at six o'clock a.m.</p> 											
												</div>
											</div>
											
																						
										</div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-5" name="input-act13_2-5">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at five fifty a.m.</p> 											
												</div>
											</div>
											
																						
										</div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-6" name="input-act13_2-6">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at six thirty a.m.</p> 											
												</div>
											</div>
											
																						
										</div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-7" name="input-act13_2-7">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at seven o'clock a.m.</p> 											
												</div>
											</div>
											
																						
										</div>	

										<div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-6">
													<select class="form-select form-select-md mb-1" id="input-act13_2-8" name="input-act13_2-8">

														<option disabled selected></option>
														<option value="I wake up">I wake up</option>
														<option value="I get up">I get up</option>
														<option value="I brush my teeth">I brush my teeth</option>
														<option value="I take my shower">I take my shower</option>
														<option value="I go to buy tortillas">I go to buy tortillas</option>
														<option value="I have breafast">I have breafast</option>
														<option value="I walk to school">I walk to school</option>
														<option value="I get to school">I get to school</option>

													</select>	
												</div>
												<div class="col-6 justify-content-center">
													<p class="fst-normal text-center">at six forty-five a.m.</p> 											
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

<!-- Página 79, actividad 14.1 -->
<div id="ModalUnit3Act14_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WH... QUESTIONS: WHERE, WHEN, WHY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen_1">
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
											<input type="text" class="d-none" id="points14_1" name="points">
											<input type="text" class="d-none" id="idcliente14_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro14_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-12">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">													
											</div>											
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-12">
													                                        
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">													
											</div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>	    
										
										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-4.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>	
										
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-6" class="form-control"
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

<!-- Página 79, actividad 14.2  -->
<div id="ModalUnit3Act14_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WH... QUESTIONS: WHERE, WHEN, WHY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue</p>
											<input type="text" class="d-none" id="points14_2" name="points">
											<input type="text" class="d-none" id="idcliente14_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro14_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag79/img79_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act14_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-3">
														<p class="fst-normal">you have lunch, Melissa?</p> 
													</div>																					
												</div>																								
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act14_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">lunch at a good restaurant</p> 
													</div>																																																                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																						
													<div class="col-2">
														<input type="text" id="input-act14_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">you go to Europe, Brayina?</p> 
													</div>												                                   																							
												</div>											

                                               	<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
												   <div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act14_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">to Europe on August</p> 
													</div>													                                      																							
												</div>		
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																						
													<div class="col-2">
														<input type="text" id="input-act14_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-3">
														<p class="fst-normal">Franciso so happy today?</p> 
													</div>												                                   																							
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
												   <div class="col-2">
														<p class="fst-normal">Because he</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act14_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">a pretty girl.</p> 
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

<!-- Página 80, actividad 15.1 -->
<div id="ModalUnit3Act15_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">DAYS OF THE WEEK</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences and write the days of the week</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points15_1" name="points">
											<input type="text" class="d-none" id="idcliente15_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-12">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">													
											</div>											
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-12">
													                                        
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">													
											</div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>	    
										
										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-4.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>	
										
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_1-7.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					
										</div>

										<hr>

										<div class="col-md-2 col-sm-12">
																							
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="SUNDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="MONDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="TUESDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="WEDNESDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="THURSDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="FRIDAY"
														autocomplete="off">											
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="SATURDAY"
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

<!-- Página 80, actividad 15.2  -->
<div id="ModalUnit3Act15_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DAYS OF THE WEEK</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue</p>
											<input type="text" class="d-none" id="points15_2" name="points">
											<input type="text" class="d-none" id="idcliente15_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag80/img80_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">I go to church on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>																								
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-3">
														<p class="fst-normal">You begin to study on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-3">
														<p class="fst-normal">She goes to the movies on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>	
												
												<hr>												

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-3">
														<p class="fst-normal">I clean my bedroom on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>			
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">We go swimming on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-3">
														<p class="fst-normal">They play basketball on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">Students enjoy every</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act15_2-7" class="form-control"
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

<!-- Página 81 -->
<div id="ModalUnit3Act16" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO BRUSH, TO WATCH</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to brush"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact269-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-12" class="form-control"
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
																<input type="text" id="input-act16-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to watch"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-36" class="form-control"
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
																<input type="text" id="input-act16-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act16-48" class="form-control"
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

<!-- Página 82 -->
<div id="ModalUnit3Act17" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO WALK, TO HELP</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seventeen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to walk"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact269-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-12" class="form-control"
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
																<input type="text" id="input-act17-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to help"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-36" class="form-control"
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
																<input type="text" id="input-act17-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act17-48" class="form-control"
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

<!-- Página 83, actividad 18.1 -->
<div id="ModalUnit3Act18_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES ABOUT SCHOOL CHILDREN ACTIVITIES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eighteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences.</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points18_1" name="points">
											<input type="text" class="d-none" id="idcliente18_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro18_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-12">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act18_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">													
											</div>											
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-12">
													                                        
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_1-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act18_1-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">													
											</div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act18_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>	    
										
										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_1-4.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act18_1-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence"
														autocomplete="off">											
											</div>
																					 
										</div>

										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act18_1-5" class="form-control"
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

<!-- Página 83, actividad 18.2  -->
<div id="ModalUnit3Act18_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES ABOUT SCHOOL CHILDREN ACTIVITIES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eighteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue</p>
											<input type="text" class="d-none" id="points18_2" name="points">
											<input type="text" class="d-none" id="idcliente18_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro18_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag81/img81_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">Where do you</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">Maricela?</p> 
													</div>																		
												</div>																								
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">When will you</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">with us?</p> 
													</div>		
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">class</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act18_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">the second floor</p> 
													</div>		
												</div>	
												
												<hr>												

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">I will</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">at 7 p.m.</p> 
													</div>																			
												</div>			
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">This cake is</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">the students.</p> 
													</div>	
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-3">
														<p class="fst-normal">They play basketball on</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
																																	
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">Students enjoy every</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act18_2-7" class="form-control"
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

<!-- Página 84, actividad 11.1 -->
<div id="ModalUnit3Act19_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">RECOGNIZING AND WRITING VOCABULARY RELATED WITH CHILDREN ACTIVITIES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentences</p>
											<input type="text" class="d-none" id="points19_1" name="points">
											<input type="text" class="d-none" id="idcliente19_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro19_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																							
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag84/img84_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act19_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>							

										</div>		
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag84/img84_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act19_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>							

										</div>	

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag84/img84_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act19_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>							

										</div>	

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag84/img84_1-4.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act19_1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act19_1-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
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

<!-- Página 84, actividad 11.1 -->
<div id="ModalUnit3Act19_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">RECOGNIZING AND WRITING VOCABULARY RELATED WITH CHILDREN ACTIVITIES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the questions</p>
											<input type="text" class="d-none" id="points19_2" name="points">
											<input type="text" class="d-none" id="idcliente19_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro19_2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																																
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">Do you walk to school, Maricela?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act19_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Answer the question"
															autocomplete="off">
													</div>																																		
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">Do you buy tortillas for lunch?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act19_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Answer the question"
															autocomplete="off">
													</div>																																		
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">What time do you get up, José?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act19_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Answer the question"
															autocomplete="off">
													</div>																																		
												</div>	
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<p class="fst-normal text-end">Can you help me with my homework?</p> 
													</div>
													<div class="col-6">
														<input type="text" id="input-act19_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Answer the question"
															autocomplete="off">
													</div>																																		
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

<!-- Página 85 -->
<div id="ModalUnit3Act20" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">INTERACTING IN SHORT DIALOGUE ABOUT SCHOOL CHILDREN ACTIVITIES</h5>
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
											<p class="fs-5 fw-bold">Write the correct question</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">																																																
										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag85/img85.png" style="margin-bottom: 20px;">
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-6">
														<input type="text" id="input-act20-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Write the question"
															autocomplete="off">
													</div>		
													<div class="col-6">
														<p class="fst-normal text-end">?  I do my homework on Saturday.</p> 
													</div>																																
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<input type="text" id="input-act20-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Write the question"
															autocomplete="off">
													</div>		
													<div class="col-6">
														<p class="fst-normal text-end">?  My sister plays jumping rope at recess time.</p> 
													</div>																																		
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-6">
														<input type="text" id="input-act20-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="Write the question"
															autocomplete="off">
													</div>		
													<div class="col-6">
														<p class="fst-normal text-end">?  I play soccer with my classmates at the playground</p> 
													</div>																																	
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

<!-- Página 86  -->
<div id="ModalUnit3Act21" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">RIDDLES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyone">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Who Am I?</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-12">
												
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag86/img86-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act21-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="RWho Am I?"
														autocomplete="off">													
											</div>											
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-12">
													                                        
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag86/img86-2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act21-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Who Am I?"
														autocomplete="off">													
											</div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag86/img86-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act21-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Who Am I?"
														autocomplete="off">											
											</div>
																					 
										</div>	    
										
										<div class="col-md-6 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag86/img86-4.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act21-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Who Am I?"
														autocomplete="off">											
											</div>
																					 
										</div>

										<div class="col-md-12 col-sm-12">
													
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag86/img86-5.png">
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

<!-- Página 87  -->
<div id="ModalUnit3Act22" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">SAN VICENTE'S DONKEY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentytwo">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the poem</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag87/img87.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">"San Vicente's</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">carries</p> 
													</div>																		
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act22-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">load and doesn't</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">it"</p> 
													</div>		
																																	
												</div>	
									
												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<p class="fst-normal">Would</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">like to</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act22-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">the fairies?</p> 
													</div>		
												</div>	
											
												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act22-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">will lend</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">my lens</p> 
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

<!-- Página 88  -->
<div id="ModalUnit3Act23" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">LITTLE SNOW WHITE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentythree">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag88/img88.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">Soon afterwards</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act23-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">little</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act23-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-4">
														<p class="fst-normal">came, to her, who was</p> 
													</div>																
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-1">
														<input type="text" id="input-act23-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">as</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act23-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">, rosy as</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act23-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">blood, and whose</p> 
													</div>		
													<div class="col-1">
														<input type="text" id="input-act23-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">was as</p> 
													</div>																		
												</div>	
									
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<input type="text" id="input-act23-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">as ebony - so</p> 
													</div>		
													<div class="col-1">
														<input type="text" id="input-act23-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">was called</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act23-9" class="form-control"
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

<!-- Página 89  -->
<div id="ModalUnit3Act24" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ANIMAL CROSSWORD</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyfour">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Answer the crossword</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
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

																	<td class="cell cell-black" ></td>																	
																	<td class="cell" >
																		<label class="word-number" for="1">1</label>
																		<input
																			required
																			id="1"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Jj]"
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
																		<label class="word-number" for="2">2</label>
																		<input
																			required
																			id="2"
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
																			id="3"
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
																			id="4"
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
																			id="5"
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
																			id="6"
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
																	<td class="cell" >
																		<label class="word-number" for="3">3</label>
																		<input
																			required
																			id="7"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Cc]"
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
																		<label class="word-number" for="4">4</label>
																		<input
																			required
																			id="8"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Kk]"
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
																			pattern="[Aa]"
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
																			pattern="[Nn]"
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
																			pattern="[Gg]"
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
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >																	
																		<input
																			required
																			id="13"
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
																			id="14"
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
																			id="15"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>

																	<td class="cell cell-black" ></td>																
																	<td class="cell" >																	
																		<input
																			required
																			id="16"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ff]"
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
																			id="17"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ww]"
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
																			id="16"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ff]"
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

																	<td class="cell cell-black" ></td>																
																	<td class="cell" >	
																		<label class="word-number" for="5">5</label>																
																		<input
																			required
																			id="17"
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
																			id="18"
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
																			id="19"
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
																			id="20"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >	
																		<label class="word-number" for="6">6</label>																
																		<input
																			required
																			id="21"
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
																			id="22"
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
																			id="23"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="25"
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="26"
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="27"
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
																	<td class="cell" >		
																		<label class="word-number" for="7">7</label>		
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="30"
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
																			id="31"
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
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag89/img89.png"
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

<!-- Página 90  -->
<div id="ModalUnit3Act25" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">FARMYARD CROSSWORD</h5>
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
											<p class="fs-1 fw-bold">Answer the crossword</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
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
																			pattern="[Cc]"
																			data-down="1"
																		/>
																	</td>																	
																	<td class="cell" >																	
																		<input
																			required
																			id="1"
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
																			id="2"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td><td class="cell" >																	
																		<input
																			required
																			id="3"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ww]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="2">2</label>
																		<input
																			required
																			id="4"
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
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>																
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="3">3</label>
																		<input
																			required
																			id="6"
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
																			id="7"
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
																			id="9"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ll]"
																			data-down="1"
																		/>
																	</td>															
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="4">4</label>
																		<input
																			required
																			id="10"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
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
																			id="12"
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
																			id="13"
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
																			id="14"
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
																			id="15"
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
																			id="16"
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
																			id="17"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>

																	<td class="cell cell-black" ></td>																
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="18"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Aa]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="19"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Pp]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="6">6</label>
																		<input
																			required
																			id="20"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Ff]"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>

																	<td class="cell" >
																		<label class="word-number" for="7">7</label>
																		<input
																			required
																			id="21"
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
																			id="22"
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
																			id="23"
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
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="25"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>

																	<td class="cell" >																	
																		<input
																			required
																			id="26"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Oo]"
																			data-down="1"
																		/>
																	</td>																
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																																	
																		<input
																			required
																			id="27"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Tt]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >	
																		<label class="word-number" for="8">8</label>	
																		<input
																			required
																			id="28"
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
																			id="29"
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
																			id="30"
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
																			id="31"
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
																			id="32"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>

																	<td class="cell" >	
																		<label class="word-number" for="9">9</label>	
																		<input
																			required
																			id="33"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Gg]"
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
																			pattern="[Oo]"
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
																			pattern="[Oo]"
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
																			pattern="[Ss]"
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
																			pattern="[Ee]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell cell-black" ></td>	
																	<td class="cell cell-black" ></td>	
																	<td class="cell cell-black" ></td>	
																	<td class="cell" >																																		
																		<input
																			required
																			id="38"
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="39"
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
																			id="40"
																			class="letter"
																			type="text"
																			maxlength="1"
																			pattern="[Nn]"
																			data-down="1"
																		/>
																	</td>
																	<td class="cell" >	
																		<label class="word-number" for="10">10</label>																																	
																		<input
																			required
																			id="41"
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
																			id="42"
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
																			id="43"
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="27"
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
																	<td class="cell" >		
																		<label class="word-number" for="7">7</label>		
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
																	<td class="cell" >																																		
																		<input
																			required
																			id="30"
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
																			id="31"
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
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag90/img90.png"
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

<!-- Página 91  -->
<div id="ModalUnit3Act26" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">THE WEATHER!</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentysix">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
											<th class="text-center cell-act26" width="30" height="30">O</th>
                                            <th class="text-center cell-act26" width="30" height="30">I</th>
                                            <th class="text-center cell-act26" width="30" height="30">K</th>
                                            <th class="text-center cell-act26" width="30" height="30">M</th>
                                            <th class="text-center cell-act26" width="30" height="30">M</th>
                                            <th class="text-center cell-act26" width="30" height="30">X</th>
                                            <th class="text-center cell-act26" width="30" height="30">L</th>
											<th class="text-center cell-act26" width="30" height="30">M</th>
											<th class="text-center cell-act26" width="30" height="30">P</th>
											<th class="text-center cell-act26" width="30" height="30">O</th>
											<th class="text-center cell-act26" width="30" height="30">K</th>
											<th class="text-center cell-act26" width="30" height="30">T</th>
                                        </tr>
										<tr><!-- ROW TWO -->
											<th class="text-center cell-act26" width="30" height="30">D</th>
                                            <th class="text-center cell-act26" width="30" height="30">Q</th>
                                            <th class="text-center cell-act26" width="30" height="30">A</th>
                                            <th class="text-center cell-act26" width="30" height="30">B</th>
                                            <th class="text-center cell-act26" width="30" height="30">T</th>
                                            <th class="text-center cell-act26" width="30" height="30">P</th>
                                            <th class="text-center cell-act26" width="30" height="30">K</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-1" onclick="checkCells('act26-1')">S</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-2" onclick="checkCells('act26-2')">L</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-3" onclick="checkCells('act26-3')">E</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-4" onclick="checkCells('act26-4')">E</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-5" onclick="checkCells('act26-5')">T</th>
                                        </tr>
										<tr><!-- ROW THREE -->
											<th class="text-center cell-act26" width="30" height="30">E</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-6" onclick="checkCells('act26-6')">R</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-7" onclick="checkCells('act26-7')">A</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-8" onclick="checkCells('act26-8')">I</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-9" onclick="checkCells('act26-9')">N</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-10" onclick="checkCells('act26-10')">B</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-11" onclick="checkCells('act26-11')">O</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-12" onclick="checkCells('act26-12')">W</th>
											<th class="text-center cell-act26" width="30" height="30">I</th>
											<th class="text-center cell-act26" width="30" height="30">X</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-13" onclick="checkCells('act26-13')">C</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-14" onclick="checkCells('act26-14')">S</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
											<th class="text-center cell-act26" width="30" height="30">V</th>
                                            <th class="text-center cell-act26" width="30" height="30">M</th>
                                            <th class="text-center cell-act26" width="30" height="30">V</th>
                                            <th class="text-center cell-act26" width="30" height="30">E</th>
                                            <th class="text-center cell-act26" width="30" height="30">R</th>
                                            <th class="text-center cell-act26" width="30" height="30">W</th>
                                            <th class="text-center cell-act26" width="30" height="30">P</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-15" onclick="checkCells('act26-15')">H</th>
											<th class="text-center cell-act26" width="30" height="30">P</th>
											<th class="text-center cell-act26" width="30" height="30">P</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-16" onclick="checkCells('act26-16')">L</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-17" onclick="checkCells('act26-17')">U</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
											<th class="text-center cell-act26" width="30" height="30">N</th>
                                            <th class="text-center cell-act26" width="30" height="30">C</th>
                                            <th class="text-center cell-act26" width="30" height="30">E</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-18" onclick="checkCells('act26-18')">T</th>
                                            <th class="text-center cell-act26" width="30" height="30">F</th>
                                            <th class="text-center cell-act26" width="30" height="30">A</th>
                                            <th class="text-center cell-act26" width="30" height="30">L</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-19" onclick="checkCells('act26-19')">A</th>
											<th class="text-center cell-act26" width="30" height="30">U</th>
											<th class="text-center cell-act26" width="30" height="30">D</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-20" onclick="checkCells('act26-20')">O</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-21" onclick="checkCells('act26-21')">N</th>
                                        </tr>
										<tr><!-- ROW SIX -->
											<th class="text-center cell-act26" width="30" height="30">X</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-22" onclick="checkCells('act26-22')">S</th>
                                            <th class="text-center cell-act26" width="30" height="30">U</th>
                                            <th class="text-center cell-act26" width="30" height="30">H</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-23" onclick="checkCells('act26-23')">H</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-24" onclick="checkCells('act26-24')">R</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-25" onclick="checkCells('act26-25')">W</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-26" onclick="checkCells('act26-26')">I</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-27" onclick="checkCells('act26-27')">N</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-28" onclick="checkCells('act26-28')">D</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-29" onclick="checkCells('act26-29')">U</th>
											<th class="text-center cell-act26" width="30" height="30">G</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
											<th class="text-center cell-act26" width="30" height="30" id="act26-30" onclick="checkCells('act26-30')">F</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-31" onclick="checkCells('act26-31')">T</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-32" onclick="checkCells('act26-32')">S</th>
                                            <th class="text-center cell-act26" width="30" height="30">N</th>
                                            <th class="text-center cell-act26" width="30" height="30">Q</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-33" onclick="checkCells('act26-33')">U</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-34" onclick="checkCells('act26-34')">A</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-35" onclick="checkCells('act26-35')">L</th>
											<th class="text-center cell-act26" width="30" height="30">U</th>
											<th class="text-center cell-act26" width="30" height="30">D</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-36" onclick="checkCells('act26-36')">D</th>
											<th class="text-center cell-act26" width="30" height="30">E</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
											<th class="text-center cell-act26" width="30" height="30" id="act26-37" onclick="checkCells('act26-37')">O</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-38" onclick="checkCells('act26-38')">O</th>
                                            <th class="text-center cell-act26" width="30" height="30">T</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-39" onclick="checkCells('act26-39')">N</th>
                                            <th class="text-center cell-act26" width="30" height="30">M</th>
                                            <th class="text-center cell-act26" width="30" height="30">E</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-40" onclick="checkCells('act26-40')">N</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-41" onclick="checkCells('act26-41')">I</th>
											<th class="text-center cell-act26" width="30" height="30">F</th>
											<th class="text-center cell-act26" width="30" height="30">G</th>
											<th class="text-center cell-act26" width="30" height="30">O</th>
											<th class="text-center cell-act26" width="30" height="30">L</th>
                                        </tr>
										<tr><!-- ROW NINE -->
											<th class="text-center cell-act26" width="30" height="30" id="act26-42" onclick="checkCells('act26-42')">G</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-43" onclick="checkCells('act26-43')">R</th>
                                            <th class="text-center cell-act26" width="30" height="30">X</th>
                                            <th class="text-center cell-act26" width="30" height="30">R</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-44" onclick="checkCells('act26-44')">O</th>
                                            <th class="text-center cell-act26" width="30" height="30">H</th>
                                            <th class="text-center cell-act26" width="30" height="30">Y</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-45" onclick="checkCells('act26-45')">D</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-46" onclick="checkCells('act26-46')">N</th>
											<th class="text-center cell-act26" width="30" height="30">Q</th>
											<th class="text-center cell-act26" width="30" height="30">H</th>
											<th class="text-center cell-act26" width="30" height="30">I</th>
                                        </tr>
										<tr><!-- ROW TEN -->
											<th class="text-center cell-act26" width="30" height="30">X</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-47" onclick="checkCells('act26-47')">M</th>
                                            <th class="text-center cell-act26" width="30" height="30">I</th>
                                            <th class="text-center cell-act26" width="30" height="30">O</th>
                                            <th class="text-center cell-act26" width="30" height="30">F</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-48" onclick="checkCells('act26-48')">W</th>
                                            <th class="text-center cell-act26" width="30" height="30">U</th>
											<th class="text-center cell-act26" width="30" height="30">N</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-49" onclick="checkCells('act26-49')">E</th>
											<th class="text-center cell-act26" width="30" height="30">C</th>
											<th class="text-center cell-act26" width="30" height="30">F</th>
											<th class="text-center cell-act26" width="30" height="30">W</th>
                                        </tr>
										<tr><!-- ROW ELEVEN -->
											<th class="text-center cell-act26" width="30" height="30">P</th>
                                            <th class="text-center cell-act26" width="30" height="30">D</th>
                                            <th class="text-center cell-act26" width="30" height="30">S</th>
                                            <th class="text-center cell-act26" width="30" height="30">I</th>
                                            <th class="text-center cell-act26" width="30" height="30">V</th>
                                            <th class="text-center cell-act26" width="30" height="30">I</th>
                                            <th class="text-center cell-act26" width="30" height="30">X</th>
											<th class="text-center cell-act26" width="30" height="30">Q</th>
											<th class="text-center cell-act26" width="30" height="30">F</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-50" onclick="checkCells('act26-50')">R</th>
											<th class="text-center cell-act26" width="30" height="30">E</th>
											<th class="text-center cell-act26" width="30" height="30">L</th>
                                        </tr>
										<tr><!-- ROW TWELVE -->
											<th class="text-center cell-act26" width="30" height="30" id="act26-51" onclick="checkCells('act26-51')">L</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-52" onclick="checkCells('act26-52')">I</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-53" onclick="checkCells('act26-53')">G</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-54" onclick="checkCells('act26-54')">H</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-55" onclick="checkCells('act26-55')">T</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-56" onclick="checkCells('act26-56')">N</th>
                                            <th class="text-center cell-act26" width="30" height="30" id="act26-57" onclick="checkCells('act26-57')">I</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-58" onclick="checkCells('act26-58')">N</th>
											<th class="text-center cell-act26" width="30" height="30" id="act26-59" onclick="checkCells('act26-59')">G</th>
											<th class="text-center cell-act26" width="30" height="30">F</th>
											<th class="text-center cell-act26" width="30" height="30">C</th>
											<th class="text-center cell-act16" width="30" height="30">V</th>
                                        </tr>
                                    </table>	
									<div class="row justify-content-md-center justify-content-sm-center">
										<div class="col-9">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag91/img91.png"
											style="margin-top: 15px;">															
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

<!-- Página 92  -->
<div id="ModalUnit3Act27" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MONSTERS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyseven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw the monsters</p>
											<input type="text" class="d-none" id="points27" name="points">
											<input type="text" class="d-none" id="idcliente27" name="idcliente">
											<input type="text" class="d-none" id="idlibro27" name="idlibro">
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

										canvas11 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn27 {
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
													<input type="color" id="colorPicker27" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker27">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn27">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas27" style="background: url('../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag92/img92.png')"
											width="390" height="450">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>

								<div class="row justify-content-md-center justify-content-sm-center">		
									
									<div class="col-md-12 col-sm-12 col-xs-12">

										<div class="row justify-content-md-center justify-content-sm-center">
											
											<div class="col-12">
												<p class="fst-normal fw-bold">POLLY</p> 
											</div>	

										</div>	
										
										<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
										
											<div class="col-3">
												<p class="fst-normal text-end">Polly has got two green</p> 
											</div>		
											<div class="col-1">
												<input type="text" id="input-act27-1" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>
											<div class="col-3">
												<p class="fst-normal">, one yellow nose and one blue</p> 
											</div>	
											<div class="col-1">
												<input type="text" id="input-act27-2" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>	
											<div class="col-1">
												<p class="fst-normal">he's got</p> 
											</div>	
											<div class="col-1">
												<input type="text" id="input-act27-3" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>		
											<div class="col-2">
												<p class="fst-normal">brown ears.</p> 
											</div>											
										</div>	

										<div class="row justify-content-md-center justify-content-sm-center">
											
											<div class="col-12">
												<p class="fst-normal fw-bold">FIGGY</p> 
											</div>	

										</div>	

										<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
										
											<div class="col-2">
												<p class="fst-normal text-end">Figgy has got</p> 
											</div>		
											<div class="col-1">
												<input type="text" id="input-act27-4" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>
											<div class="col-2">
												<p class="fst-normal">blue eyes, three red</p> 
											</div>	
											<div class="col-1">
												<input type="text" id="input-act27-5" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>	
											<div class="col-4">
												<p class="fst-normal">, two big yellow mouths and four people</p> 
											</div>																						
										</div>	

										<div class="row justify-content-md-center justify-content-sm-center">
											
											<div class="col-12">
												<p class="fst-normal fw-bold">HENRY</p> 
											</div>	

										</div>	

										<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
										
											<div class="col-2">
												<p class="fst-normal text-end">Henry's got</p> 
											</div>		
											<div class="col-1">
												<input type="text" id="input-act27-6" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>
											<div class="col-3">
												<p class="fst-normal">pink eyes and two orange</p> 
											</div>	
											<div class="col-1">
												<input type="text" id="input-act27-7" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>	
											<div class="col-2">
												<p class="fst-normal">He's got three purple</p> 
											</div>	
											<div class="col-1">
												<input type="text" id="input-act27-8" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 5px;"
													autocomplete="off">
											</div>	
											<div class="col-2">
												<p class="fst-normal">and his hair is brown.</p> 
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

<!-- Página 93  -->
<div id="ModalUnit3Act28" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">IT ALREADY RAINS, IT ALREADY RAINS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentyeight">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points28" name="points">
											<input type="text" class="d-none" id="idcliente28" name="idcliente">
											<input type="text" class="d-none" id="idlibro28" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag93/img93.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													
													<div class="col-1">
														<input type="text" id="input-act28-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">already</p> 
													</div>		
													<div class="col-1">
														<input type="text" id="input-act28-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">, it</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act28-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">rains, it</p> 
													</div>													
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																																							
													<div class="col-2">
														<p class="fst-normal">begins to</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act28-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">and</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act28-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">strong cloudburst</p> 
													</div>																															
												</div>	
									
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>	
													<div class="col-1">
														<input type="text" id="input-act28-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">to</p> 
													</div>		
													<div class="col-1">
														<input type="text" id="input-act28-7" class="form-control"
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
Book_Page::footerTemplate('controladorlibro3_u3.js');
?>