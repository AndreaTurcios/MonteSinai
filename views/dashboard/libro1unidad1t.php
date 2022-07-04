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


<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('juego1.js');
?>