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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunoprimergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!--inicio modales -->
<div id="ModalLibroDos" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalLibroTrest" tabindex="-3" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="ModalLibrotest" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

			</div>
		</div>
	</div>
</div>
<!-- Modales Audios -->
<div id="ModalLibroUnoAudioPag1" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio1">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit1/pag1.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag3" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio3">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag3.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag4" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio4">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag4.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag5" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio5">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag5.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag6" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio6">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag6.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag7" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio7">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag7.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag8" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio8">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag8.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag9" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio9">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag9.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag10" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio10">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag10.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag11" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio11">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag11.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag12" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio12">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag12.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag13" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio13">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag13.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag14" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio14">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag14.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag23" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio23">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag23.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag24" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio24">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag24.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag26" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio26">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag26.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag27" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio27">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag27.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag28" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio28">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag28.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag29" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio29">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag29.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag30" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio30">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag30.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag33" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio33">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag33.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag34" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio34">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag34.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag35" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio35">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag35.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUnoAudioPag36" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio36">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag36.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<div id="ModalLibroUno" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-4">
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Head -->
													<div class="col">H</div>
													<div class="col">e</div>
													<div class="col">
														<input type="text" id="input-oneh"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">d</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Arm -->
													<div class="col">A</div>
													<div class="col">
														<input type="text" id="input-fivec"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">m</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Ear -->
													<div class="col">E</div>
													<div class="col">
														<input type="text" id="input-niner"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">r</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Mouth -->
													<div class="col">M</div>
													<div class="col">
														<input type="text" id="input-thirdteenu"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">u</div>
													<div class="col">t</div>
													<div class="col">h</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Neck -->
													<div class="col">N</div>
													<div class="col">e</div>
													<div class="col">
														<input type="text" id="input-twoe"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">k</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Nose -->
													<div class="col">N</div>
													<div class="col"><input type="text" id="input-sixn"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"></div>
													<div class="col">s</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Hand -->
													<div class="col">H</div>
													<div class="col">a</div>
													<div class="col">n</div>
													<div class="col">
														<input type="text" id="input-tend"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Leg -->
													<div class="col">
														<input type="text" id="input-fourteenl"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">e</div>
													<div class="col">g</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Foot -->
													<div class="col">F</div>
													<div class="col">o</div>
													<div class="col">
														<input type="text" id="input-threef"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">t</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Hair -->
													<div class="col">
														<input type="text" id="input-sevenh"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">a</div>
													<div class="col">i</div>
													<div class="col">r</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Stomach -->
													<div class="col">S</div>
													<div class="col">t</div>
													<div class="col">
														<input type="text" id="input-elevench" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">m</div>
													<div class="col">a</div>
													<div class="col">c</div>
													<div class="col">h</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Finger -->
													<div class="col">F</div>
													<div class="col">i</div>
													<div class="col">n</div>
													<div class="col">
														<input type="text" id="input-fifteenf"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">e</div>
													<div class="col">r</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<!-- Face -->
												<div class="row row-cols-4">
													<div class="col"> <input type="text" id="input-fourc"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">a</div>
													<div class="col">c</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Toe -->
													<div class="col">
														<input type="text" id="input-eightt"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">o</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Eye -->
													<div class="col">
														<input type="text" id="input-twelvey"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">y</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<!-- Knee -->
													<div class="col">K</div>
													<div class="col">n</div>
													<div class="col"><input type="text" id="input-sixteenk"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
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
<!-- </div> -->

<div class="modal fade" id="ModalLibrotestdos" tabindex="-5" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-zero">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
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
				</div>class
			</form>
		</div>
	</div>
</div>

<!-- Página 4 -->
<div id="ModalLibroTres" class="modal fade" tabindex="-6">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">VERBS: OPEN, CLOSE, WASH, TOUCH</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>



									<div class="col-6">										
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag4/Group1.jpg"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence1" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												style="margin-bottom: 30px; margin-top: 25px;">
										</div>
									</div>



									<div class="col-6">										
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag4/Group2.jpg"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence2" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												style="margin-bottom: 30px; margin-top: 25px;">
										</div>
									</div>

									<!-- <div class="col"></div>
									<div class="col"></div> -->

									<div class="col-6">

										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag4/Group3.jpg"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence3" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												style="margin-top: 25px;">
										</div>
									</div>



									<div class="col-6">

										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag4/Group4.jpg"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence4" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												style="margin-top: 25px;">
										</div>
									</div>
									<!-- fin cols  -->

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

<!-- Pagina 5 -->
<div id="ModalLibroCuatro" class="modal fade" tabindex="-7">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">VERB BE: AM, IS, ARE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>



									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence14" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="I ___ am Maricela"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>



									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence24.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->

										<div class="col">	
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence24.png"
											class="rounded mx-auto d-block">										
											<input type="text" id="sentence24" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="He ___ Boris"
												style="margin-bottom: 30px;  margin-top: 25px;">
										</div>
									</div>

									<!-- <div class="col"></div>
									<div class="col"></div> -->

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence34.png"
										style="margin-left: 110px; margin-bottom: 15px;">-->
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence34.png"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence34" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="They ___ are classmates"
												style="margin-top: 25px;">
										</div>
									</div>



									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence44.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence44.png"
											class="rounded mx-auto d-block">
											<input type="text" id="sentence44" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="She ___ Elsa"
												style="margin-top: 25px;">
										</div>
									</div>
									<!-- fin cols  -->

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

<!-- Pagina 6 -->
<div id="ModalLibroSeis" class="modal fade" tabindex="-9">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">PRONOUNS: I, YOU</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">

									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>																			

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag6/words11.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words11" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="I"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag6/words12.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words12" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="You"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag6/words3.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words2" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ am a student" 	
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag6/words4.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words3" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ are my teacher" 	
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 7 -->
<div id="ModalLibroSiete" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DEMOSTRATIVE ADJECTIVES: THIS, THESE</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-11.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-11" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ is a mouth"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-12.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-22" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ is a nose"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-13.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-33" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ is a head"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-14.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-44" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ are feet"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-15.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-55" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ are hands"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag7/words-act6-16.png"
											class="rounded mx-auto d-block">
											<input type="text" id="words-act6-66" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="______ are eyes"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 8 - Actividad 2 -->
<div id="ModalLibroOcho" class="modal fade" tabindex="-12">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">PRONOUNS: IT, WE, YOU, THEY</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acty7-01.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acty7-01" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ are my friend"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acty7-02.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acty7-02" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ are friends"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acty7-03.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acty7-03" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ are my friends"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acty7-04.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acty7-04" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="___ is his watch"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 8 - Actividad 1 -->
<div id="ModalLibroNueve" class="modal fade" tabindex="-13">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">PRONOUNS: IT, WE, YOU, THEY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nines">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acto8-11.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acto8-11" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="It"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acto8-12.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acto8-12" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="We"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acto8-13.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acto8-13" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="You"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag8/word-acto8-14.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-acto8-14" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="They"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 9 - Actividad 2 -->
<div id="ModalLibroDiez" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">POSSESIVE ADJECTIVES: MY, YOUR, HIS, HER</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-ten">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo10-21.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo10-21" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="My"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo10-22.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo10-22" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="Your"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo10-23.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo10-23" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="His"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo10-24.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo10-24" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="Her"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 9 - Actividad 1 -->
<div id="ModalLibroOnce" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">POSSESIVE ADJECTIVES: MY, YOUR, HIS, HER	</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo11-31.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo11-31" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="This is your watch"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo11-32.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo11-32" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="This is his watch"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag9/word-actyo11-33.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo11-33" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="This is her watch"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 10 -->
<div id="ModalLibroDoce" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES: SHORT, TALL</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twelve">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag10/word-actyo12-41.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo12-41" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="Short"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag10/word-actyo12-42.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo12-42" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="Tall"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag10/word-actyo12-43-44.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo12-43" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="I am ___"
												style="margin-bottom: 25px; margin-top: 25px;">
											<input type="text" id="word-actyo12-44" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="You are ___"
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Pagina 11 -->
<div id="ModalLibroTrece" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">QUESTION WORD: WHAT?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirdteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag11/word-actyo13-51.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo13-51" class="form-control"
												aria-label="Sizing example input" maxlength="100"
												placeholder="What?"
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag11/word-actyo13-52.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo13-52" class="form-control"
												aria-label="Sizing example input" maxlength="100"	
												placeholder="___ is this?"											
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag11/word-actyo13-53.png"
											class="rounded mx-auto d-block">
											<input type="text" id="word-actyo13-53" class="form-control"
												aria-label="Sizing example input" maxlength="100"	
												placeholder="___ is your name?"											
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Página 12 - Actividad 2 -->
<div id="ModalLibroCatorce" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">COLORS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourhteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-61.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-61" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-62.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-62" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-63.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-63" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-64.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-64" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-65.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-65" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/colors-actyo14-66.png"
											class="rounded mx-auto d-block">
											<input type="text" id="colors-actyo14-66" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Página 12 - Actividad 1 (Canvas) -->
<!--
	Notas de inconvenientes con el canvas.
	El input verify-canvas solo acepta el primer input encontrado en orden en el php (si es llamado por medio de <script>) 
	en este caso en el controller. Solo acepta el verify-canvas del ModalLibroQuince.
	
	El colorpicker y strokepicker no funcionan en los canvas posteriores al primer canvas hecho. Ni con id unicos estos 
	funcionan. Es parecido al problema del input verify-canvas. 
	Aparte de todo estos errores, si tratas de abrir el canvas de una actividad posterior a la actividad que tiene creado el
	primer canvas (actividad 15), no se podra pintar en ellas, se debe de abrir la actividad 15 para que estas funcionen. 
	Odio los canvas
 -->
<div id="ModalLibroQuince" class="modal fade" tabindex="-10">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Color the image</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifthteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" id="points5" name="points">
											<input type="text" id="idcliente5" name="idcliente">
											<input type="text" id="idlibro5" name="idlibro">
										</div>
									</div>
									<!-- contenido  -->


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
										}

										canvas1 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn {
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
													<input type="color" id="colorPicker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container-fluid">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas1" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/Cuadro.png')"
											width="775" height="400">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>

									<!-- contenido  -->
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

<!-- Página 13 -->
<div id="ModalLibroDieciseis" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
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
											<p class="fs-5 fw-bold">Match the figure with the correct color</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act16-1">
													<img class="mx-auto d-block" draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag13/head.png"  alt="White" id="img-act16-1">
												</div>
												<div class="col ps-5">
													<p class="text-center fst-normal">It has got a </p>			
													<div id="red" class="box-act18 text-center m-3"  style="background-color: #F80000; color: #FFFFFF;">
														Red tail
													</div>														
												</div>
																					
										</div>	

										<div class="col-md-4 col-sm-6" >
																							
											<div class="col ps-5 " id="box-act16-2">												
												<img class="mx-auto d-block" draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag13/leg.png" alt="Black" id="img-act16-2">
											</div>
											<div class="col ps-5">
												<p class="text-center fst-normal">It has got a </p>	
												<div id="blue" class="box-act16 text-center m-3"  style="background-color: #1714D6; color: #FFFFFF;">
													Blue eyes
												</div>
											</div>
																				
										</div>	

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act16-3">																										
													<img class="mx-auto d-block" draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag13/tail.png"  alt="Red" id="img-act16-3">
												</div>
												<div class="col ps-5">
													<p class="text-center fst-normal">It has got a </p>	
													<div id="black" class="box-act18 text-center m-3"  style="background-color: #000000; color: #FFFFFF;">
														Black legs
													</div>
												</div>
																					
										</div>
										
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">
										
										<div class="col-md-6 col-sm-6">
																							
											<div class="col ps-5" id="box-act16-4">												
												<img class="mx-auto d-block" draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag13/body.png" alt="Brown" id="img-act16-4">
											</div>
											<div class="col ps-5">
												<p class="text-center fst-normal">It has got a </p>	
												<div id="blue" class="box-act16 text-center m-3"  style="background-color: #FFFFFF;">
													White head
												</div>
											</div>
																				
										</div>	

										<div class="col-md-6 col-sm-6">
																							
											<div class="col ps-5" id="box-act16-5">																									
												<img class="mx-auto d-block" draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag13/eyes.png"  alt="Blue" id="img-act16-5">
											</div>
											<div class="col ps-5">
												<p class="text-center fst-normal">It has got a </p>	
												<div id="black" class="box-act18 text-center m-3"  style="background-color: #BB4A27; color: #FFFFFF;">
													Brown body
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

<!-- Página 14 -->
<div id="ModalLibroDiecisiete" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
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
											<p class="fs-5 fw-bold">Match the stars with the correct color</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-1">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_lightblue.png"  alt="Light Blue" id="img-act17-1">
												</div>
												<div class="col ps-5">
													<div id="green" class="box-act17 text-center m-3"  style="background-color: #00A650;">
														Green
													</div>
												</div>
																					
										</div>	

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-2">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_green.png"  alt="Green" id="img-act17-2">
												</div>
												<div class="col ps-5">
													<div id="pink" class="box-act17 text-center m-3"  style="background-color: #FCD9EF;">
														Pink
													</div>
												</div>
																					
										</div>	
										
										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-3">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_pink.png" alt="Pink" id="img-act17-3">
												</div>
												<div class="col ps-5">
													<div id="green" class="box-act17 text-center m-3"  style="background-color: #8C359D;">
														Purple
													</div>
												</div>
																					
										</div>	
										
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-4">											
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_blue.png"  alt="Blue" id="img-act17-4">
												</div>
												<div class="col ps-5">
													<div id="lightblue" class="box-act17 text-center m-3"  style="background-color: #34B0E2;">
														Light blue
													</div>
												</div>
																					
										</div>	

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-5">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_orange.png"  alt="Orange" id="img-act17-5">
												</div>
												<div class="col ps-5">
													<div id="red" class="box-act17 text-center m-3"  style="background-color: #F03021;">
														Red
													</div>
												</div>
																					
										</div>	
										
										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-6">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_purple.png"  alt="Purple" id="img-act17-6">
												</div>
												<div class="col ps-5">
													<div id="yellow" class="box-act17 text-center m-3"  style="background-color: #FFF500;">
														Yellow
													</div>
												</div>
																					
										</div>	
										
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-7">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_red.png" alt="Red" id="img-act17-7">
												</div>
												<div class="col ps-5">
													<div id="orange" class="box-act17 text-center m-3"  style="background-color: #F8A60D;">
														Orange
													</div>
												</div>
																					
										</div>	

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-8">

													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_yellow.png"  alt="Yellow" id="img-act17-8">
												</div>
												<div class="col ps-5">
													<div id="white" class="box-act17 text-center m-3"  style="background-color: #FFFFFF;">
														White
													</div>
												</div>
																					
										</div>	
										
										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act17-9">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag14/star_white.png" alt="White" id="img-act17-9">
												</div>
												<div class="col ps-5">
													<div id="blue" class="box-act17 text-center m-3"  style="background-color: #186FBF; color: white;">
														Blue
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

<!-- Página 15 -->
<div id="ModalLibroDieciocho" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
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
											<p class="fs-5 fw-bold">Match the figure with the correct color</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act18-1">
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag15/green.png"  alt="Green" id="img-act18-1">
												</div>
												<div class="col ps-5">
													<div id="red" class="box-act18 text-center m-3"  style="background-color: #F80000;">
														Red
													</div>
												</div>
																					
										</div>	

										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act18-2">													
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag15/blue.png" alt="Blue" id="img-act18-2">
												</div>
												<div class="col ps-5">
													<div id="green" class="box-act18 text-center m-3"  style="background-color: #21C71E;">
														Green
													</div>
												</div>
																					
										</div>	
										
										<div class="col-md-4 col-sm-6">
																							
												<div class="col ps-5" id="box-act18-3">												
													<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag15/red.png"  alt="Red" id="img-act18-3">
												</div>
												<div class="col ps-5">
													<div id="blue" class="box-act18 text-center m-3"  style="background-color: #1714D6;">
														Blue
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

<!-- Pagina 18 -->
<div id="ModalLibroVeinticinco" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">SAYING THE NUMBERS FROM ONE TO FIVE</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
									<style>
										.container-checkboxes ul{
											list-style: none;
											margin: 0;
											padding: 0;
												overflow: auto;
											}

											ul li{
											color: #AAAAAA;
											display: block;
											position: relative;
											float: left;
											width: 100%;
											height: 100px;
												border-bottom: 1px solid #333;
											}

											ul li input[type=radio]{
											position: absolute;
											visibility: hidden;
											}

											ul li label{
											display: block;
											position: relative;
											font-weight: 300;
											font-size: 1.35em;
											padding: 25px 25px 25px 80px;
											margin: 10px auto;
											height: 30px;
											z-index: 9;
											cursor: pointer;
											-webkit-transition: all 0.25s linear;
											}

											ul li:hover label{
												color: #FFFFFF;
											}

											/* Circulo del checkbox */
											ul li .check{
											display: block;
											position: absolute;
											border: 5px solid #AAAAAA;
											border-radius: 100%;
											height: 20px;
											width: 20px;
											top: 30px;
											left: 20px;
											z-index: 5;
											transition: border .25s linear;
											-webkit-transition: border .25s linear;
											}

											ul li:hover .check {
											border: 5px solid #FFFFFF;
											}

											/* Circulo verde de adentro luego de ser check */
											ul li .check::before {
											display: block;
											position: absolute;
											content: '';
											border-radius: 100%;
											height: 2px;
											width: 2px;
											top: 4px;
											left: 4px;
											margin: auto;
											transition: background 0.25s linear;
											-webkit-transition: background 0.25s linear;
											}

											input[type=radio]:checked ~ .check {
											border: 5px solid #0DFF92;
											}

											input[type=radio]:checked ~ .check::before{
											background: #0DFF92;
											}

											input[type=radio]:checked ~ label{
											color: #0DFF92;
											}
									</style>

									<div class="row row-cols-4">
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/seven.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col">
											<div class="container-checkboxes" style="margin-bottom: 60px">	


												<ul>
													<li>
													<input type="radio" id="flexCheckDefault1" name="selector1">
													<label for="flexCheckDefault1">Two</label>

													<div class="check"></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault2" name="selector1">
													<label for="flexCheckDefault2">One</label>

													<div class="check"><div class="inside"></div></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault3" name="selector1">
													<label for="flexCheckDefault3">Seven</label>

													<div class="check"><div class="inside"></div></div>
													</li>
												</ul>


											</div>											
										</div>

										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/one.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col">
											<div class="container-checkboxes" style="margin-bottom: 60px">	


												<ul>
													<li>
													<input type="radio" id="flexCheckDefault4" name="selector2">
													<label for="flexCheckDefault4">Five</label>

													<div class="check"></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault5" name="selector2">
													<label for="flexCheckDefault5">One</label>

													<div class="check"><div class="inside"></div></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault6" name="selector2">
													<label for="flexCheckDefault6">Four</label>

													<div class="check"><div class="inside"></div></div>
													</li>
												</ul>


											</div>											
										</div>



										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/six.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col">
											<div class="container-checkboxes" style="margin-bottom: 60px">	


												<ul>
													<li>
													<input type="radio" id="flexCheckDefault7" name="selector3">
													<label for="flexCheckDefault7">Six</label>

													<div class="check"></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault8" name="selector3">
													<label for="flexCheckDefault8">Three</label>

													<div class="check"><div class="inside"></div></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault9" name="selector3">
													<label for="flexCheckDefault9">Eight</label>

													<div class="check"><div class="inside"></div></div>
													</li>
												</ul>


											</div>											
										</div>


										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/ten.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col">
											<div class="container-checkboxes" style="margin-bottom: 60px">	


												<ul>
													<li>
													<input type="radio" id="flexCheckDefault10" name="selector4">
													<label for="flexCheckDefault10">Nine</label>

													<div class="check"></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault11" name="selector4">
													<label for="flexCheckDefault11">Six</label>

													<div class="check"><div class="inside"></div></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault12" name="selector4">
													<label for="flexCheckDefault12">Ten</label>

													<div class="check"><div class="inside"></div></div>
													</li>
												</ul>


											</div>											
										</div>

										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/two.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col">
											<div class="container-checkboxes" style="margin-bottom: 60px">	


												<ul>
													<li>
													<input type="radio" id="flexCheckDefault13" name="selector5">
													<label for="flexCheckDefault13">Nine</label>

													<div class="check"></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault14" name="selector5">
													<label for="flexCheckDefault14">Two</label>

													<div class="check"><div class="inside"></div></div>
													</li>

													<li>
													<input type="radio" id="flexCheckDefault15" name="selector5">
													<label for="flexCheckDefault15">Five</label>

													<div class="check"><div class="inside"></div></div>
													</li>
												</ul>


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
        <form class="form" autocomplete="off" method="post" novalidate id="audio11">
            <audio controls>
            <source src="../../resources/audio/ingles_uno/Unit1/pag11.mp3" type="audio/mp3">
            Tu navegador no soporta audio HTML5.
            </audio>         
		</form>
        </div>
    </div>
</div>

<!-- Página 19 -->
<div id="ModalLibroVeintiseis" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">LET'S COUNT FROM ONE TO TEN</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-261.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-261" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-262.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-262" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-263.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-263" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-264.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-264" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-265.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-265" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-266.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-266" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-267.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-267" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-268.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-268" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-269.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-269" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
										</div>
									</div>

									<div class="col-6">
										<!--<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag5/Sentence14.png"
										style="margin-left: 140px; margin-bottom: 15px;">-->								
										<div class="col">
											<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag19/numbers-actyo26-2610.png"
											class="rounded mx-auto d-block">
											<input type="text" id="numbers-actyo26-2610" class="form-control"
												aria-label="Sizing example input" maxlength="100"												
												style="margin-bottom: 25px; margin-top: 25px;">
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

<!-- Página 20 -->
<!--
	Notas de inconvenientes con el canvas.
	El input verify-canvas solo acepta el primer input encontrado en orden en el php (si es llamado por medio de <script>) 
	en este caso en el controller. Solo acepta el verify-canvas del ModalLibroQuince.
	
	El colorpicker y strokepicker no funcionan en los canvas posteriores al primer canvas hecho. Ni con id unicos estos 
	funcionan. Es parecido al problema del input verify-canvas. 
	Aparte de todo estos errores, si tratas de abrir el canvas de una actividad posterior a la actividad que tiene creado el
	primer canvas (actividad 15), no se podra pintar en ellas, se debe de abrir la actividad 15 para que estas funcionen. 
	Odio los canvas
 -->
 <div id="ModalLibroVeintisiete" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MATCHING THE NUMBER FROM ONE TO TEN</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" id="points27" name="points">
											<input type="text" id="idcliente27" name="idcliente">
											<input type="text" id="idlibro27" name="idlibro">
										</div>
									</div>
									<!-- contenido  -->


									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');/
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
												<p>Pick a color:</p>
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
												<p>clear2 the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn2">Clear canvas</a>
												</div>
											</div>
										</div>
										</header>

										<div class="container">
											<canvas id="canvas2" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitOne/Pag20/trace.png')"
											width="815" height="550">

											</canvas>
										</div>
									</header>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>

									<!-- contenido  -->
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

<!-- Página 22  -->
<div id="ModalLibroVeintinueve" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HELLO! HOW ARE YOU?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twentynine">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points29" name="points">
											<input type="text" class="d-none" id="idcliente29" name="idcliente">
											<input type="text" class="d-none" id="idlibro29" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-2">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row row-cols-2">
													<div class="col">
														<h4>By</h4>

													</div>

													<div class="col">
														<input type="text" id="input-actp1"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row row-cols-2">
													<div class="col">
														<h4>See</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp2" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row row-cols-2">
													<div class="col">
														<input type="text" id="input-actp3" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>much</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>How</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp4" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>you?</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-11">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row row-cols-5">
													<div class="col">
														<h4>Fine,</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp5" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>,</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp6" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>you?</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<input type="text" id="input-actp7" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Karla !</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>What's</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp8" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
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

<!-- Página 23  -->
<div id="ModalLibroTreinta" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg"> 
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HOW DO YOU DO?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirty">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points30" name="points">
											<input type="text" class="d-none" id="idcliente30" name="idcliente">
											<input type="text" class="d-none" id="idlibro30" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-5">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col-3">
														<h4>Hello</h4>
													</div>
													<div class="col-4">
														<input type="text" id="input-actp301" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Williams</h4>
													</div>

												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-5">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col-5">
														<input type="text" id="input-actp302" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Mrs. Jackson</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col-6">
														<h4>How do you</h4>
													</div>
													<div class="col-3">
														<input type="text" id="input-actp303" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>?</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-3">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>See</h4>
													</div>
													<div class="col-6">
														<input type="text" id="input-actp304" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-5">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>Not</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp305" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>bad</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>See you</h4>
													</div>
													<div class="col-6">
														<input type="text" id="input-actp306" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
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
	
<!-- Página 24  -->
<div id="ModalLibroTreintayuno" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtyone">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points31" name="points">
											<input type="text" class="d-none" id="idcliente31" name="idcliente">
											<input type="text" class="d-none" id="idlibro31" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>Excell</h4>

													</div>

													<div class="col">
														<input type="text" id="input-actp311"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>Very</h4>
													</div>
													<div class="col-6">
														<input type="text" id="input-actp312" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>

												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">
													<div class="col">
														<h4>Go</h4>

													</div>

													<div class="col-6">
														<input type="text" id="input-actp313"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">													
													<div class="col-6">
														<input type="text" id="input-actp314" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>done!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">													
													<div class="col-6">
														<input type="text" id="input-actp315" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>right!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
									</div>

									<div class="row justify-content-md-center mb-3">
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3 mt-3">
												<div class="row">													
													<div class="col-5">
														<input type="text" id="input-actp316" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>job!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
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

<!-- Página 26 --> 
<!--
	Notas de inconvenientes con el canvas.
	El input verify-canvas solo acepta el primer input encontrado en orden en el php (si es llamado por medio de <script>) 
	en este caso en el controller. Solo acepta el verify-canvas del ModalLibroQuince.
	
	El colorpicker y strokepicker no funcionan en los canvas posteriores al primer canvas hecho. Ni con id unicos estos 
	funcionan. Es parecido al problema del input verify-canvas. 
	Aparte de todo estos errores, si tratas de abrir el canvas de una actividad posterior a la actividad que tiene creado el
	primer canvas (actividad 15), no se podra pintar en ellas, se debe de abrir la actividad 15 para que estas funcionen. 
	Odio los canvas
 -->
 <div id="ModalLibroTreintaydos" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Foods</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtytwo">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw, color and name some foods</p>
											<input type="text" class="d-none" id="points32" name="points">
											<input type="text" class="d-none" id="idcliente32" name="idcliente">
											<input type="text" class="d-none" id="idlibro32" name="idlibro">
										</div>
									</div>
									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');/
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
										}

										canvas3 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn3 {
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
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker" value="#000000">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker">
												</div>
											</div>
											<div class="clear">
												<p>Clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn3">Clear canvas</a>
												</div>
											</div>
										</div>
										</header>

										<div class="container">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas3" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitOne/Pag26/canvas26.png')"
											width="815" height="450">

											</canvas>
										</div>
									</header>
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

<!-- Página 27  -->
<div id="ModalLibroTreintaytres" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">VERBS: CLEAN, LIKE, EAT</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtythree">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the sentence with the picture</p>
											<input type="text" class="d-none" id="points33" name="points">
											<input type="text" class="d-none" id="idcliente33" name="idcliente">
											<input type="text" class="d-none" id="idlibro33" name="idlibro">
										</div>
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag27/food-actyo33-71.jpg"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="food-actyo33-71" name="food-actyo33-71">

											<option disabled selected>Select an option</option>
											<option value="Just a minute, please">Just a minute, please</option>
											<option value="I don't understand">I don't understand</option>
											<option value="Can I go out?">Can I go out?</option>

                                        </select>										
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag27/food-actyo33-72.jpg"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="food-actyo33-72" name="food-actyo33-72">

											<option disabled selected>Select an option</option>
											<option value="Just a minute, please">Just a minute, please</option>
											<option value="I don't understand">I don't understand</option>
											<option value="Can I go out?">Can I go out?</option>

                                        </select>										
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag27/food-actyo33-73.jpg"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="food-actyo33-73" name="food-actyo33-73">

											<option disabled selected>Select an option</option>
											<option value="Just a minute, please">Just a minute, please</option>
											<option value="I don't understand">I don't understand</option>
											<option value="Can I go out?">Can I go out?</option>

                                        </select>										
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

<!-- Página 28 -->
<div id="ModalLibroTreintaycuatro" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES: DELICIOUS AND ROUND</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtyfour">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points34" name="points">
											<input type="text" class="d-none" id="idcliente34" name="idcliente">
											<input type="text" class="d-none" id="idlibro34" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag28/food-actyo34-81.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="food-actyo34-81" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Orange">	
												</div>	
											</div>									

										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag28/food-actyo34-82.png"
											class="rounded mx-auto d-block">
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="food-actyo34-82" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Melon">			
												</div>
											</div>							
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag28/food-actyo34-83.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="food-actyo34-83" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Coconut">			
												</div>
											</div>								
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag28/food-actyo34-84.png"
											class="rounded mx-auto d-block">
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="food-actyo34-84" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Tomato">			
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

<!-- Página 29 -->
<div id="ModalLibroTreintaycinco" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">POSSESIVE: MY, HIS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtyfive">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points35" name="points">
											<input type="text" class="d-none" id="idcliente35" name="idcliente">
											<input type="text" class="d-none" id="idlibro35" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag29/possesive-act35-1.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="possesive-act35-1" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="This is ___ book">	
												</div>	
											</div>									

										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag29/possesive-act35-2.png"
											class="rounded mx-auto d-block">
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="possesive-act35-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="This is ___ book">			
												</div>
											</div>							
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag29/possesive-act35-3.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="possesive-act35-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="My">			
												</div>
											</div>								
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag29/possesive-act35-4.png"
											class="rounded mx-auto d-block">
											<div class="row justify-content-md-center justify-content-sm-center">	
												<div class="col-md-8 col-sm-12">									
													<input type="text" id="possesive-act35-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="His">			
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

<!-- Página 30 -->
<div id="ModalLibroTreintayseis" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DEMOSTRATIVE ADJECTIVES: THIS, THAT</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtysix">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points36" name="points">
											<input type="text" class="d-none" id="idcliente36" name="idcliente">
											<input type="text" class="d-none" id="idlibro36" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<div class="col-md-4 col-sm-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-1.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-1" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is an apple">	
												</div>	
											</div>									
										</div>

										<div class="col-md-4 col-sm-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-2.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-2" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is a banana">	
												</div>	
											</div>									
										</div>

										<div class="col-md-4 col-sm-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-3.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-3" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is a strawberry">	
												</div>	
											</div>									
										</div>

										<div class="col-md-4 col-sm-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-4.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-4" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is a pencil">	
												</div>	
											</div>									
										</div>

										<div class="col-md-4 col-sm-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-5.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-5" class="form-control "
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is a bag">	
												</div>	
											</div>									
										</div>

										<div class="col-md-4 col-sm-6 col-xs-12">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag30/demostrative-act36-6.png"
											class="rounded mx-auto d-block">	
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="col-md-8 col-sm-12">
													<input type="text" id="demostrative-act36-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="___ is a dress">	
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

<!-- Página 31 -->
<div id="ModalLibroTreintaysiete" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">I LIKE FRUITS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtyseven">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points37" name="points">
											<input type="text" class="d-none" id="idcliente37" name="idcliente">
											<input type="text" class="d-none" id="idlibro37" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-4">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag31/ai.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-8 col-sm-8 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">
												<p class="fst-normal">Hi! Nice to meet you! My name is Computer-01 </p>												

												<p class="fw-bold">What's your name? </p> 
												<div class="col-4">
													<p class="fst-normal">My name is </p> 
												</div>
												<div class="col-4">
													<input type="text" id="personal-act37-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>

												<p class="fst-normal">I like strawberries </p>
												<p class="fw-bold">What do you like? </p> 

												<div class="col-4">
													<p class="fst-normal">I like </p> 
												</div>
												<div class="col-4">
													<input type="text" id="personal-act37-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>

												<p class="fw-bold">Do you like apples? </p> 
												<div class="col-4">
													<p class="fst-normal">No, I don't like </p> 
												</div>
												<div class="col-4">
													<input type="text" id="personal-act37-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>

												<p class="fw-bold">See you later!</p>
												<div class="col-8">
													<input type="text" id="personal-act37-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px; margin-top: 5px;">
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

<!-- Página 32 -->
<div id="ModalLibroTreintayocho" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">RECOGNIZING THE NAMES OF COLORS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtyeight">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points38" name="points">
											<input type="text" class="d-none" id="idcliente38" name="idcliente">
											<input type="text" class="d-none" id="idlibro38" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-4">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag32/girl.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-8 col-sm-8 col-xs-12">

											<div class="container-act8 mb-2" style="background-color: white;">

												<div id="option-act38-1" class="box-act8 text-center m-3" draggable="true" data-id="Blue" style="background-color: #8ABFEB;">
													Blue
												</div>
												<div id="option-act38-2" class="box-act8 text-center m-3" draggable="true" data-id="White" style="background-color: #FFFFFF;">
													White
												</div>
												<div id="option-act38-3" class="box-act8 text-center m-3" draggable="true" data-id="Black" style="background-color: #454545; color: white;">
													Black
												</div>
												<div id="option-act38-4" class="box-act8 text-center m-3" draggable="true" data-id="Green" style="background-color: #54BB48;">
													Green
												</div>
												<div id="option-act38-5" class="box-act8 text-center m-3" draggable="true" data-id="Pink" style="background-color: #F58BC1;">
													Pink
												</div>

											</div>

											<div class="row row-cols-2 mb-4">

												<div class="col">
													<p>The skirt is color...</p>
													<div id="text-act38-1" class="box-act8 text-center"></div>
												</div>
												<div class="col">
													<p>The Blouse is color...</p>
													<div id="text-act38-2" class="box-act8 text-center"></div>
												</div>

											</div>

											<div class="row row-cols-2 mb-4">

												<div class="col">
													<p>The Shoes is color...</p>
													<div id="text-act38-3" class="box-act8 text-center"></div>
												</div>
												<div class="col">
													<p>The Bag is color...</p>
													<div id="text-act38-4" class="box-act8 text-center"></div>
												</div>

											</div>

											<div class="row row-cols-2 mb-4">

												<div class="col">
													<p>The Socks is color...</p>
													<div id="text-act38-5" class="box-act8 text-center"></div>
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

<!-- Página 33  -->
<div id="ModalLibroTreintaynueve" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">IS IT...?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirtynine">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points39" name="points">
											<input type="text" class="d-none" id="idcliente39" name="idcliente">
											<input type="text" class="d-none" id="idlibro39" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag33/isit-act39-1.png"
											class="rounded mx-auto d-block" style="margin-bottom: 10px; margin-top: 10px;">
											<p class="fw-bold text-center">Is it a mango? </p> 

											<div class="row justify-content-md-center justify-content-sm-center">												
												<div class="col-4">
													<p class="fst-normal">No, it is a</p> 
												</div>
												<div class="col-4">
													<input type="text" id="input-act39-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>	
											</div>									
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag33/isit-act39-2.png"
											class="rounded mx-auto d-block" style="margin-bottom: 10px; margin-top: 10px;">
											<p class="fw-bold text-center">Is it a coconut? </p> 

											<div class="row justify-content-md-center justify-content-sm-center">												
												<div class="col-4">
													<p class="fst-normal">Yes, it is a</p> 
												</div>
												<div class="col-4">
													<input type="text" id="input-act39-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>	
											</div>									
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag33/isit-act39-3.png"
											class="rounded mx-auto d-block" style="margin-bottom: 10px; margin-top: 10px;">
											<p class="fw-bold text-center">Is it a balloon? </p> 

											<div class="row justify-content-md-center justify-content-sm-center">												

												<div class="col-4">
													<input type="text" id="input-act39-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>	
												<div class="col-4">
													<p class="fst-normal">,it is a balloon</p> 
												</div>
											</div>									
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag33/isit-act39-4.png"
											class="rounded mx-auto d-block" style="margin-bottom: 10px; margin-top: 10px;">
											<p class="fw-bold text-center">Is it an apple? </p> 

											<div class="row justify-content-md-center justify-content-sm-center">												

												<div class="col-4">
													<input type="text" id="input-act39-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;">
												</div>	
												<div class="col-4">
													<p class="fst-normal">,it is a mango</p> 
												</div>
											</div>									
										</div>

										<div class="col-6">	
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag33/isit-act39-5.png"
											class="rounded mx-auto d-block" style="margin-bottom: 10px; margin-top: 10px;">
											<p class="fw-bold text-center">Is it an orange? </p> 

											<div class="row justify-content-md-center justify-content-sm-center">												
												<div class="col-4">
													<p class="fst-normal">Yes, it is an</p> 
												</div>
												<div class="col-4">
													<input type="text" id="input-act39-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 5px;"> 
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

<!-- Página 34 -->
<div id="ModalLibroCuarenta" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CLASSROOM EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-forty">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points40" name="points">
											<input type="text" class="d-none" id="idcliente40" name="idcliente">
											<input type="text" class="d-none" id="idlibro40" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag34/classroom-expressions.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<input type="text" id="input-act40-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal"> to the classroom. </p> 
													</div>		
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Be quiet,  </p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act40-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Stand  </p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act40-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<input type="text" id="input-act40-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal"> down.</p> 
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<input type="text" id="input-act40-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal"> at page 5.</p> 
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Work in  </p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act40-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
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

<!-- Página 35 -->
<div id="ModalLibroCuarentayuno" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">FRUITS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fortyone">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points41" name="points">
											<input type="text" class="d-none" id="idcliente41" name="idcliente">
											<input type="text" class="d-none" id="idlibro41" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<link rel="stylesheet" href="../../app/controllers/BookOneUnitOne/style.css" />
										<div class="col-md-12 col-xs-12">
											<script src="../../app/controllers/BookOneUnitOne/assets/polyfill/dialog-polyfill.js"></script>
                        					<!--Se elimino el script main.js aquí ya que tuvo conflicto con el canvas, hizo que dejara de funcionar -->
											<form class="form" autocomplete="off" method="post" novalidate>
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
															<td class="cell">
																<label class="word-number" for="1">1</label>
																<input
																	required
																	id="1"
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
															<td class="cell">
																<label class="word-number" for="2">5</label>
																<input
																	required
																	id="2"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	
															<td class="cell">
																<label class="word-number" for="3">2</label>
																<input
																	required
																	id="3"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Pp]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="4"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Aa]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
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
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="7"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Yy]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<label class="word-number" for="8">8</label>
																<input
																	required
																	id="8"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Aa]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="9"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Pp]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="10"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Pp]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="11"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Ll]"
																	data-down="1"
																/>
															</td>
															<td class="cell">																
																<input
																	required
																	id="12"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell">
																<input
																	required
																	id="13"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Tt]"
																	data-down="1"
																/>
															</td>     
															<td class="cell">
																<label class="word-number" for="14">4</label>
																<input
																	required
																	id="14"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Ll]"
																	data-down="1"
																/>
															</td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell">																
																<input
																	required
																	id="15"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="17"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Uu]"
																	data-down="1"
																/>
															</td>
															<td class="cell cell-black" ></td>    
															<td class="cell cell-black" ></td>	
															<td class="cell">
																<input
																	required
																	id="18"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Gg]"
																	data-down="1"
																/>
															</td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell">
																<label class="word-number" for="14">10</label>
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
															<td class="cell">
																<input
																	required
																	id="20"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Rr]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="21"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Mm]"
																	data-down="1"
																/>
															</td>
															<td class="cell cell-black" ></td>    
															<td class="cell">
																<label class="word-number" for="22">6</label>
																<input
																	required
																	id="22"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Cc]"
																	data-down="1"
																/>
															</td>   
															<td class="cell">
																<input
																	required
																	id="23"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Oo]"
																	data-down="1"
																/>
															</td>  
															<td class="cell">
																<input
																	required
																	id="24"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Cc]"
																	data-down="1"
																/>
															</td>   
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="26"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Nn]"
																	data-down="1"
																/>
															</td>  
															<td class="cell">
																<input
																	required
																	id="27"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Uu]"
																	data-down="1"
																/>
															</td> 
															<td class="cell">
																<input
																	required
																	id="28"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell">
																<input
																	required
																	id="29"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Mm]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="30"
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
															<td class="cell">
																<input
																	required
																	id="31"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="33"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell">
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
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>    
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell">
																<input
																	required
																	id="35"
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
														</tr>

														<tr>
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell">
																<label class="word-number" for="36">3</label>
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
															<td class="cell">
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
															<td class="cell">
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
															<td class="cell">
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
															<td class="cell">
																<label class="word-number" for="40">7</label>
																<input
																	required
																	id="40"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Gg]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
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
															<td class="cell">														
																<input
																	required
																	id="42"
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
															<td class="cell">
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
															<td class="cell">
																<label class="word-number" for="44">9</label>
																<input
																	required
																	id="44"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Bb]"
																	data-down="1"
																/>
															</td>	
															<td class="cell">
																<input
																	required
																	id="45"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Aa]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="46"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Nn]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="48"
																	class="letter"
																	type="text"
																	maxlength="1"
																	pattern="[Nn]"
																	data-down="1"
																/>
															</td>
															<td class="cell">
																<input
																	required
																	id="49"
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
															<td class="cell">
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
															<td class="cell">
																<input
																	required
																	id="51"
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
															<td class="cell cell-black" ></td>	     
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>	
															<td class="cell cell-black" ></td>	
															<td class="cell">
																<input
																	required
																	id="52"
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
													</table>
												</div>
													<div class="row justify-content-md-center justify-content-sm-center">

														<button class="btn btn-success btn-clear" type="reset" style="margin-top: 10px; margin-bottom: 10px;">
															Clean
														</button>

													</div>
											</form>																				
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">1.</p> 
														</div>	
														<div class="col-1">
															<p class="fst-normal">W</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-1" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-3">
															<p class="fst-normal">termelon</p> 
														</div>		
									 				</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">2.</p> 
														</div>	
														<div class="col-1">
															<p class="fst-normal">P</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-2" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">p</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-3" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">y</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-4" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">3.</p> 
														</div>	
														<div class="col-2">
															<p class="fst-normal">Orang</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-5" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>															
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">4.</p> 
														</div>	
														<div class="col-2">
															<p class="fst-normal">Plu</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-6" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">s</p> 
														</div>															
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">5.</p> 
														</div>	
														<div class="col-2">
															<p class="fst-normal">Ma</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-7" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">g</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-8" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>														
													</div>

												</div>

												<div class="col-6">

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">6.</p> 
														</div>	
														<div class="col-1">
															<p class="fst-normal">C</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-9" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">c</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-10" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">n</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-11" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">t</p> 
														</div>
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">7.</p> 
														</div>	
														<div class="col-2">
															<p class="fst-normal">Gr</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-12" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">p</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-13" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>	
														<div class="col-1">
															<p class="fst-normal">s</p> 
														</div>													
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">8.</p> 
														</div>	
														<div class="col-2">
															<p class="fst-normal">Appl</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-14" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>															
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">9.</p> 
														</div>	
														<div class="col-1">
															<p class="fst-normal">B</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-15" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">n</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-16" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">n</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-17" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>														
													</div>

													<div class="row justify-content-md-center justify-content-sm-center mb-2">
														<div class="col-1">
															<p class="fst-normal">10.</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-18" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">n</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-19" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
														</div>
														<div class="col-1">
															<p class="fst-normal">n</p> 
														</div>	
														<div class="col-2">
															<input type="text" id="input-act41-20" class="form-control"
																aria-label="Sizing example input" maxlength="1"												
																style="margin-bottom: 5px;">
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 20 -->
<!--
	Notas de inconvenientes con el canvas.
	El input verify-canvas solo acepta el primer input encontrado en orden en el php (si es llamado por medio de <script>) 
	en este caso en el controller. Solo acepta el verify-canvas del ModalLibroQuince.
	
	El colorpicker y strokepicker no funcionan en los canvas posteriores al primer canvas hecho. Ni con id unicos estos 
	funcionan. Es parecido al problema del input verify-canvas. 
	Aparte de todo estos errores, si tratas de abrir el canvas de una actividad posterior a la actividad que tiene creado el
	primer canvas (actividad 15), no se podra pintar en ellas, se debe de abrir la actividad 15 para que estas funcionen. 
	Odio los canvas
 -->
 <div id="ModalLibroCuarentaydos" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HEAD AND SHOULDERS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fortytwo">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" id="points42" name="points">
											<input type="text" id="idcliente42" name="idcliente">
											<input type="text" id="idlibro42" name="idlibro">
										</div>
									</div>
									<!-- contenido  -->


									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');/
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
										}

										canvas4 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn4 {
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
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker4" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker4">
												</div>
											</div>
											<div class="clear">
												<p>clear2 the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn4">Clear canvas</a>
												</div>
											</div>
										</div>
										</header>

										<div class="container">
											<div class="row"></div>
											<canvas id="canvas4" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitOne/Pag36/canvas36.png')"
											width="670" height="475">

											</canvas>
										</div>
									</header>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>

									<!-- contenido  -->
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
Book_Page::footerTemplate('controladorlibro1_u1.js');
?>