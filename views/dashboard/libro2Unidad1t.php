<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('UNIT ONE "MY BODY"');
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
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/1.PNG" width="76" height="100" class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/2.PNG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/3.PNG" width="76" height="100" class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/4.PNG" width="76" height="100" class="page-4">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/5.PNG" width="76" height="100" class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
                        <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/6.PNG" width="76" height="100" class="page-6">
                        <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/7.PNG" width="76" height="100" class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
                        <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/8.PNG" width="76" height="100" class="page-8">
                        <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/9.PNG" width="76" height="100" class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
                        <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/10.PNG" width="76" height="100" class="page-10">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/11.PNG" width="76" height="100" class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/12.PNG" width="76" height="100" class="page-12">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/13.PNG" width="76" height="100" class="page-13">
						<span>12-13</span>
					</li>
					<li class="i">
						<img src="../../resources/img/BOOKS/SecondGrade/UnitOne/14.PNG" width="76" height="100" class="page-14">
						<span>14<span>
					</li>
					<ul>
						<div>
						</div>
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunosegundogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!--inicio modales -->

<!--zona de modales-->
<!-- Portada -->
<!-- Region 1 -->
<div id="ModalLibroDosPortada" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio1">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<!-- Region 9 -->
<div id="ModalLibroDosUnidad1" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio2">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<!-- Region 11 -->
<div id="ModalLibroDos3" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio3">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<!-- Region 12 -->
<div id="ModalLibroDos4" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio4">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>
<!-- Region 13 -->

<div id="ModalLibroDos5" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
        <div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio5">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CLOTHES HE WEARS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center" align="center">
											<p class="fs-1 fw-bold">   Complete the sentences:</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div>
                                    <div align="center"> <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/img pag 5.png"> </div> 
                                    <br>
                                    <table style="width:95%;">
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    
                                                    His <input type="text" id="input-one" size="5" maxlength="5"> is yellow.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-two" size="5" maxlength="3"> is white.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-three" size="5"  maxlength="5"> are brown.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        His <input type="text" id="input-four" size="5" maxlength="7"> is blue.
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    
                                                    His <input type="text" id="input-five" size="5" maxlength="5"> are brown.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-six" size="5" maxlength="6"> are white.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-seven" size="5"  maxlength="4"> is black.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        His <input type="text" id="input-eight" size="8" maxlength="12"> are black.
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                    </table>
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

<!-- Region 14 -->
<div id="ModalLibroDos6" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
    <div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio6">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
    </div>
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CLOTHES SHE WEARS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">   Complete the sentences:</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div>
                                    <div align="center"> <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/img pag 6.png"> </div> 
                                    <br>
                                    <table style="width:95%;">
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    Her <input type="text" id="input-one6" size="5" maxlength="6"> is red.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    Her <input type="text" id="input-two6" size="5" maxlength="4"> is black.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    Her <input type="text" id="input-three6" size="5"  maxlength="9"> are blue.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        Her <input type="text" id="input-four6" size="5" maxlength="6"> are white.
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    
                                                    Her <input type="text" id="input-five6" size="5" maxlength="5"> is blue.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    Her <input type="text" id="input-six6" size="5" maxlength="7"> is blue.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    Her <input type="text" id="input-seven6" size="5"  maxlength="5"> are black.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        Her <input type="text" id="input-eight6" size="5" maxlength="6"> is pink.
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                    </table>
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

<!-- Region 15 -->
<div id="ModalLibroDos7" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
    <div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio5">
            <audio controls>
            <source src="../../resources/audio/goodbye.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CLOTHES HE WEARS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center" align="center">
											<p class="fs-1 fw-bold">   Complete the sentences:</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div>
                                    <div align="center"> <img src="../../resources/img/BOOKS/SecondGrade/UnitOne/img pag 6.png"> </div> 
                                    <br>
                                    <table style="width:95%;">
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    
                                                    His <input type="text" id="input-one" size="5" maxlength="5"> is yellow.
                                                        </div>
                                                    </div>
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-two" size="5" maxlength="3"> is white.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-three" size="5"  maxlength="5"> are brown.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        His <input type="text" id="input-four" size="5" maxlength="7"> is blue.</div>
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                        <Tr>
                                            <Td>
                                                <div class="col border border-dark" class="input-group input-group-sm mb-3">    
                                                    <!-- inicio group -->
                                                    
                                                    His <input type="text" id="input-five" size="5" maxlength="5"> are brown.
                                                        </div>
                                                    </div>
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-six" size="5" maxlength="6"> are white.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <Td>
                                                <div class="col border border-dark">
                                                    <!-- inicio group -->
                                                    His <input type="text" id="input-seven" size="5"  maxlength="4"> is black.
                                                    <!-- fin group -->
                                                </div>
                                            </Td>
                                            <td>
                                                <div class="col border border-dark">
                                                        <!-- inicio group -->
                                                        His <input type="text" id="input-eight" size="8" maxlength="12"> are black.</div>
                                                        <!-- fin group -->
                                                    </div>
                                            </td>
                                        </Tr>
                                    </table>
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

<!--modal crusigrama pag14 -->
<div id="ModalLibroDos14" class="modal fade" tabindex="-2">	
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
		<body class="body">
			<div class="modal-header">
				<h1 class="modal-title" id="modal-title">Crossword about numbers <br /> from eleven to twenty</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-14">
				<div class="modal-body">
				<div class="contenido">
				<header class="header wrapper">
           			 <h5 class="text" text-align: center>Write the correct number:</h5>
    			</header>
                    <link
                        rel="stylesheet"
                        type="text/css"
                        href="../../app/controllers/BookTwoUnitOne/assets/polyfill/dialog-polyfill.css"/>
                    <link rel="stylesheet" href="../../app/controllers/BookTwoUnitOne/style.css" />
                    <body class="body">
                        <main class="main">
                            <dialog class="dialog">
                                <h1 class="dialog-title">¡lo lograste, muy bien!<br /></h1>
                            </dialog>
                            <form class="form" autocomplete="off" method="post" novalidate>
                                <div class="timer">
                                    <span class="minutes">00</span>:<span class="seconds"
                                        >00</span
                                    >
                                </div>
                                <link rel="stylesheet" href="../../app/controllers/BookTwoUnitOne/stylecrossword.css"/>
                                <table class="table">
                                    <tr class="row row-1">
                                        <td class="cell cell-black" id="1"></td>
                                        <td class="cell cell-black" id="2"></td>
                                        <td class="cell cell-black" id="3"></td>
                                        <td class="cell cell-black" id="4"></td>
                                        <td class="cell cell-black" id="5"></td>
                                        <td class="cell cell-black" id="6"></td>
                                        <td class="cell cell-black" id="7"></td>
                                        <td class="cell cell-black" id="8"></td>
                                        <td class="cell cell-black" id="9"></td>
                                        <td class="cell">
                                            <label class="word-number" for="10">1</label>
                                            <input
                                                required
                                                id="10"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ff]"
                                                data-down="1"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="11"></td>
                                        <td class="cell cell-black" id="12"></td>
                                        <td class="cell cell-black" id="13"></td>
                                        <td class="cell cell-black" id="14"></td>
                                        <td class="cell cell-black" id="15"></td>
                                        <td class="cell cell-black" id="16"></td>
                                        <td class="cell cell-black" id="17"></td>
                                    </tr>
                                    <tr class="row row-2">
                                        <td class="cell cell-black" id="18"></td>
                                        <td class="cell cell-black" id="19"></td>
                                        <td class="cell cell-black" id="20"></td>
                                        <td class="cell cell-black" id="21"></td>
                                        <td class="cell cell-black" id="22"></td>
                                        <td class="cell cell-black" id="23"></td>
                                        <td class="cell cell-black" id="24"></td>
                                        <td class="cell cell-black" id="25"></td>
                                        <td class="cell cell-black" id="26"></td>
                                        <td class="cell">
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
                                        <td class="cell cell-black" id="28"></td>
                                        <td class="cell cell-black" id="29"></td>
                                        <td class="cell cell-black" id="30"></td>
                                        <td class="cell cell-black" id="31"></td>
                                        <td class="cell cell-black" id="32"></td>
                                        <td class="cell cell-black" id="33"></td>
                                        <td class="cell cell-black" id="34"></td>                       
                                    </tr>
                                    <tr class="row row-3">
                                        <td class="cell cell-black" id="37"></td>
                                        <td class="cell cell-black" id="38"></td>
                                        <td class="cell cell-black" id="39"></td>
                                        <td class="cell cell-black" id="40"></td>
                                        <td class="cell cell-black" id="41"></td>
                                        <td class="cell cell-black" id="42"></td>
                                        <td class="cell cell-black" id="43"></td>
                                        <td class="cell cell-black" id="44"></td>
                                        <td class="cell cell-black" id="45"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="46"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Uu]"
                                                data-down="1"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="47"></td>
                                        <td class="cell cell-black" id="48"></td>
                                        <td class="cell cell-black" id="49"></td>
                                        <td class="cell cell-black" id="50"></td>
                                        <td class="cell cell-black" id="51"></td>
                                        <td class="cell cell-black" id="52"></td>
                                        <td class="cell cell-black" id="53"></td>
                                    </tr>
                                    <tr class="row row-4">
                                        <td class="cell cell-black" id="54"></td>
                                        <td class="cell cell-black" id="55"></td>
                                        <td class="cell cell-black" id="56"></td>
                                        <td class="cell cell-black" id="57"></td>
                                        <td class="cell cell-black" id="58"></td>
                                        <td class="cell cell-black" id="59"></td>
                                        <td class="cell">
                                            <label class="word-number" for="60">2</label>
                                            <input
                                                required
                                                id="60"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="61"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Hh]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="62"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ii]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="63"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Rr]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="64"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="65"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="66"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="67"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="2"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="68"></td>
                                        <td class="cell cell-black" id="69"></td>
                                        <td class="cell cell-black" id="70"></td>
                                    </tr>
                                    <tr class="row row-5">
                                        <td class="cell cell-black" id="71"></td>
                                        <td class="cell cell-black" id="72"></td>
                                        <td class="cell cell-black" id="73"></td>
                                        <td class="cell cell-black" id="74"></td>
                                        <td class="cell cell-black" id="75"></td>
                                        <td class="cell cell-black" id="76"></td>
                                        <td class="cell cell-black" id="77"></td>
                                        <td class="cell cell-black" id="78"></td>
                                        <td class="cell cell-black" id="79"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="80"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-down="1"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="81"></td>
                                        <td class="cell cell-black" id="82"></td>
                                        <td class="cell cell-black" id="83"></td>
                                        <td class="cell cell-black" id="84"></td>
                                        <td class="cell cell-black" id="85"></td>
                                        <td class="cell cell-black" id="86"></td>
                                        <td class="cell cell-black" id="87"></td>
                                    </tr>
                                    <tr class="row row-6">
                                        <td class="cell cell-black" id="88"></td>
                                        <td class="cell cell-black" id="89"></td>
                                        <td class="cell cell-black" id="90"></td>
                                        <td class="cell cell-black" id="91"></td>
                                        <td class="cell">
                                            <label class="word-number" for="92">3</label>
                                            <input
                                                required
                                                id="92"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="93"></td>
                                        <td class="cell cell-black" id="94"></td>
                                        <td class="cell">
                                            <label class="word-number" for="95">4</label>
                                            <input
                                                required
                                                id="95"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ff]"
                                                data-down="4"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="96"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="97"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="1"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="98"></td>
                                        <td class="cell cell-black" id="99"></td>
                                        <td class="cell">
                                            <label class="word-number" for="100">5</label>
                                            <input
                                                required
                                                id="100"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ss]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="101"></td>
                                        <td class="cell cell-black" id="102"></td>
                                        <td class="cell cell-black" id="103"></td>
                                        <td class="cell cell-black" id="104"></td>
                                    </tr>
                                    <tr class="row row-7">
                                        <td class="cell cell-black" id="105"></td>
                                        <td class="cell cell-black" id="106"></td>
                                        <td class="cell">
                                            <label class="word-number" for="107">6</label>
                                            <input
                                                required
                                                id="107"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-down="6"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="108"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="109"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ii]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="110"></td>
                                        <td class="cell">
                                            <label class="word-number" for="111">7</label>
                                            <input
                                                required
                                                id="111"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="112"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ii]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="113"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="114"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="115"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="116"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="117"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="118"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="7"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="119"></td>
                                        <td class="cell cell-black" id="120"></td>
                                        <td class="cell cell-black" id="121"></td>
                                    </tr>
                                    <tr class="row row-8">
                                        <td class="cell cell-black" id="122"></td>
                                        <td class="cell cell-black" id="123"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="124"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ww]"
                                                data-down="6"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="125"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="126"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Gg]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="127"></td>
                                        <td class="cell cell-black" id="128"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="129"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ff]"
                                                data-down="4"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="130"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="131"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="1"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="132"></td>
                                        <td class="cell cell-black" id="133"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="134"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Vv]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="135"></td>
                                        <td class="cell cell-black" id="136"></td>
                                        <td class="cell cell-black" id="137"></td>
                                        <td class="cell cell-black" id="138"></td>
                                        
                                    </tr>
                                    <tr class="row row-9">
                                        <td class="cell cell-black" id="139"></td>
                                        <td class="cell cell-black" id="140"></td>
                                        
                                        <td class="cell">
                                            <input
                                                required
                                                id="141"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="6"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="142"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="143"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Hh]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="144"></td>
                                        <td class="cell cell-black" id="145"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="146"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-down="4"
                                            />
                                        </td>

                                        <td class="cell cell-black" id="147"></td>
                                        <td class="cell cell-black" id="148"></td>
                                        <td class="cell cell-black" id="149"></td>
                                        <td class="cell cell-black" id="150"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="151"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="152"></td>
                                        <td class="cell cell-black" id="153"></td>
                                        <td class="cell cell-black" id="154"></td>
                                        <td class="cell cell-black" id="155"></td>
                                    </tr>
                                    <tr class="row row-10">
                                        <td class="cell cell-black" id="156"></td>
                                        <td class="cell cell-black" id="157"></td>
                                        
                                        <td class="cell">
                                            <input
                                                required
                                                id="158"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="6"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="159"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="160"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="161"></td>
                                        <td class="cell cell-black" id="162"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="163"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="4"
                                            />
                                        </td>

                                        <td class="cell cell-black" id="164"></td>
                                        <td class="cell cell-black" id="165"></td>
                                        <td class="cell cell-black" id="166"></td>
                                        <td class="cell cell-black" id="167"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="168"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="169"></td>
                                        <td class="cell cell-black" id="170"></td>
                                        <td class="cell cell-black" id="171"></td>
                                        <td class="cell cell-black" id="172"></td>
                                    </tr>
                                    <tr class="row row-11">
                                        <td class="cell cell-black" id="173"></td>
                                        <td class="cell cell-black" id="174"></td>
                                        <td class="cell">
                                            <label class="word-number" for="175">8</label>
                                            <input
                                                required
                                                id="175"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                data-across="8"
                                                data-down="6"
                                                pattern="[Tt]"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="176"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ww]"
                                                data-across="8"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="177"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="8"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="178"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ll]"
                                                data-across="8"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="179"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Vv]"
                                                data-across="8"
                                            />
                                        </td>

                                        <td class="cell">
                                            <input
                                                required
                                                id="180"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="8"
                                                data-down="4"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="181"></td>
                                        <td class="cell">
                                            <label class="word-number" for="182">9</label>
                                            <input
                                                required
                                                id="182"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ss]"
                                                data-across="9"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="183"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ii]"
                                                data-across="9"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="184"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Xx]"
                                                data-across="9"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="185"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Tt]"
                                                data-across="9"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="186"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="9"
                                            />
                                        </td><td class="cell">
                                            <input
                                                required
                                                id="187"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="9"
                                            />
                                        </td><td class="cell">
                                            <input
                                                required
                                                id="188"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="9"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="189"></td>
                                    </tr>
                                    <tr class="row row-12">
                                        <td class="cell cell-black" id="191"></td>
                                        <td class="cell cell-black" id="192"></td>
                                        
                                        <td class="cell">
                                            <input
                                                required
                                                id="193"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Yy]"
                                                data-down="6"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="194"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="195"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="196"></td>
                                        <td class="cell cell-black" id="197"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="198"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="4"
                                            />
                                        </td>

                                        <td class="cell cell-black" id="199"></td>
                                        <td class="cell cell-black" id="200"></td>
                                        <td class="cell cell-black" id="201"></td>
                                        <td class="cell cell-black" id="202"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="203"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="204"></td>
                                        <td class="cell cell-black" id="205"></td>
                                        <td class="cell cell-black" id="206"></td>
                                        <td class="cell cell-black" id="207"></td>
                                    </tr>
                                    <tr class="row row-13">
                                        <td class="cell cell-black" id="208"></td>
                                        <td class="cell cell-black" id="209"></td>
                                        <td class="cell cell-black" id="210"></td>
                                        <td class="cell cell-black" id="211"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="212"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="3"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="213"></td>
                                        <td class="cell cell-black" id="214"></td>
                                        <td class="cell cell-black" id="215"></td>
                                        <td class="cell">
                                            <label class="word-number" for="216">10</label>
                                            <input
                                                required
                                                id="217"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="10"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="218"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ll]"
                                                data-across="10"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="219"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="10"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="220"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Vv]"
                                                data-across="10"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="221"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Ee]"
                                                data-across="10"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="222"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-across="10"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="223"></td>
                                        <td class="cell cell-black" id="224"></td>
                                        <td class="cell cell-black" id="190"></td>
                                    </tr>
                                    <tr class="row row-14">
                                        <td class="cell cell-black" id="225"></td>
                                        <td class="cell cell-black" id="226"></td>
                                        <td class="cell cell-black" id="227"></td>
                                        <td class="cell cell-black" id="228"></td>
                                        <td class="cell cell-black" id="229"></td>
                                        <td class="cell cell-black" id="230"></td>
                                        <td class="cell cell-black" id="231"></td>
                                        <td class="cell cell-black" id="232"></td>
                                        <td class="cell cell-black" id="233"></td>
                                        <td class="cell cell-black" id="234"></td>
                                        <td class="cell cell-black" id="235"></td>
                                        <td class="cell cell-black" id="236"></td>
                                        <td class="cell">
                                            <input
                                                required
                                                id="237"
                                                class="letter"
                                                type="text"
                                                maxlength="1"
                                                pattern="[Nn]"
                                                data-down="5"
                                            />
                                        </td>
                                        <td class="cell cell-black" id="238"></td>
                                        <td class="cell cell-black" id="239"></td>
                                        <td class="cell cell-black" id="240"></td>
                                        <td class="cell cell-black" id="241"></td>
                                    </tr>
                                </table>
                                <div class="clue-box-container">
                                    <p class="clue-box"></p>
                                </div>
                               
                                <div class="btn-group wrapper">     
                                    <button class="btn btn-check" type="button">
                                        Mostrar errores
                                    </button>
                                    <button class="btn btn-clear" type="reset">
                                        Borrar todo
                                    </button>
                                </div>
                            </form>
                        </main>
                         <!-- Scripts -->
                        <script src="../../app/controllers/BookTwoUnitOne/assets/polyfill/dialog-polyfill.js"></script>
                        <script type="text/javascript" src="../../app/controllers/BookTwoUnitOne/main.js"></script>
                    </body>
               
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</body>
		</div>
	</div>
</div>



<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('../BookTwoUnitOne/actividadesunidad1.js');
?>