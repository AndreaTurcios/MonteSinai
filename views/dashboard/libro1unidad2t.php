<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 2');
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
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/1.JPG" width="76" height="100" class="page-1">
						<span>Inicio</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/37.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/38.JPG" width="76" height="100" class="page-3">
						<span>37-38</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/39.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/40.JPG" width="76" height="100" class="page-3">
						<span>39-40</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/41.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/42.JPG" width="76" height="100" class="page-3">
						<span>41-42</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/43.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/44.JPG" width="76" height="100" class="page-3">
						<span>43-44</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/45.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/46.JPG" width="76" height="100" class="page-3">
						<span>45-46</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/47.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/48.JPG" width="76" height="100" class="page-3">
						<span>47-48</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/49.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/50.JPG" width="76" height="100" class="page-3">
						<span>49-50</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/51.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/52.JPG" width="76" height="100" class="page-3">
						<span>51-52</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/53.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/54.JPG" width="76" height="100" class="page-3">
						<span>53-54</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/55.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/56.JPG" width="76" height="100" class="page-3">
						<span>55-56</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/57.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/58.JPG" width="76" height="100" class="page-3">
						<span>57-58</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/59.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/60.JPG" width="76" height="100" class="page-3">
						<span>59-60</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/61.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/62.JPG" width="76" height="100" class="page-3">
						<span>61-62</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/63.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/64.JPG" width="76" height="100" class="page-3">
						<span>63-64</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/65.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/66.JPG" width="76" height="100" class="page-3">
						<span>65-66</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/67.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/68.JPG" width="76" height="100" class="page-3">
						<span>67-68</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/69.JPG" width="76" height="100" class="page-2">
						<span>69</span>
					</li>
                    <li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/44.JPG" width="76" height="100" class="page-14">
						<span>Fin<span>
					</li>
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

			pages: 41,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidaddosprimergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Modales Audios -->
<div id="ModalUnit2AudioPag37" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio37">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/Unit2.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag39" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio39">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag39.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag40" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio40">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag40.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag41" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio41">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag41.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag42" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio42">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag42.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag43" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio43">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag43.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag44" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio44">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag44.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag45" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio45">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag45.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag46" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio46">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag46.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag47" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio47">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag47.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag48" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio48">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag48.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag49" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio49">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag49.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag50" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio50">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag50.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag51" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio51">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag51.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag52" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio52">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag52.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag53" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio53">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag53.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag54" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio54">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag54.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag55" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio55">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag55.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag56" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio56">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag56.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag57" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio57">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag57.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag58" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio58">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag58.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag59" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio59">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag59.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag60" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio60">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag60.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag61" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio61">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag61.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag62" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio62">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag62.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag63" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio63">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag63.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag64" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio64">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag64.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag65" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio65">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag65.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag67" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio67">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag67.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>

<div id="ModalUnit2AudioPag68" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
        <form class="form" autocomplete="off" method="post" novalidate id="audio68">
						
				<audio controls style="margin-right: 100px;">
				<source src="../../resources/audio/ingles_uno/Unit2/pag68.mp3" type="audio/mp3">
				Tu navegador no soporta audio HTML5.
				</audio> 				
			                 
		</form>
        </div>
    </div>
</div>


<!-- Página 39 -->
<div id="ModalUnit2Act1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MY FAMILY</h5>
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
											<p class="fs-1 fw-bold">Complete the sentences</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag39/image39.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">eats</p> 
													</div>
													<div class="col-3">
														<input type="text" id="input-act1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal">Roxanna likes apples</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My grandmothers eats</p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My uncle likes</p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal">eats chicken</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
														
													</div>
													<div class="col-6">
														<p class="fst-normal">fathers work too hard</p> 
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

<!-- Página 40 -->
<div id="ModalUnit2Act2" class="modal fade"  tabindex="-5">
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
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Match the activity with the picture</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">																							
											<div class="col ps-5" id="box-act2-2">				
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/lunch.png" alt="Lunch" id="img-act2-1">
											</div>
											<div class="col ps-5">
												<div id="breakfast" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Breakfast
												</div>
											</div>																					
										</div>	

										<div class="col-md-4 col-sm-6">																																		
											<div class="col ps-5" id="box-act2-3">
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/dinner.png"  alt="Dinner" id="img-act2-2">
											</div>
											<div class="col ps-5">
												<div id="lunch" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Lunch
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-4 col-sm-6">																							
											
											<div class="col ps-5" id="box-act2-1">
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/breakfast.png"  alt="Breakfast" id="img-act2-3">
											</div>
											<div class="col ps-5">
												<div id="dinner" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Dinner
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

<!-- Página 41  -->
<div id="ModalUnit2Act3" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DRAWING AND COLORING SOME FRUIT</h5>
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
											<p class="fs-1 fw-bold">Draw and color some fruit</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
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
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker3" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker3">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn3">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container-fluid">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas3" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag41/canvas41.png')"
											width="800" height="325">

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

<!-- Página 42  -->
<div id="ModalUnit2Act4" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT IS THE FATHER EATING?</h5>
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
											<p class="fs-1 fw-bold">Match the activities and write them</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/pupusa.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act4-1" name="select-act4-1">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>	
										
										<input type="text" id="input-act4-1" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/cookie.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act4-2" name="select-act4-2">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>

										<input type="text" id="input-act4-2" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">			
									</div>

									<div class="col">
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/coke.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act4-3" name="select-act4-3">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>

										<input type="text" id="input-act4-3" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">								
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

<!-- Página 43 -->
<div id="ModalUnit2Act5" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DRINKS</h5>
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
											<p class="fs-1 fw-bold">Complete the sentences</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag43/drinks.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<p class="fst-normal">Do you like </p> 
													</div>		
													<div class="col-4">
														<select class="form-select form-select-md" id="select-act5-1" name="select-act5-1">

															<option disabled selected>Select an option</option>
															<option value="Water">Water</option>
															<option value="Milk shake">Milk shake</option>
															<option value="Orange juice">Orange juice</option>
															<option value="Horchata">Horchata</option>
															<option value="Coffee">Coffee</option>
															<option value="Chocolate">Chocolate</option>
															<option value="Tea">Tea</option>

														</select>	
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<select class="form-select form-select-md" id="select-act5-2" name="select-act5-2">

															<option disabled selected>Select an option</option>
															<option value="Mother">Mother</option>
															<option value="Sister">Sister</option>
															<option value="Father">Father</option>
															<option value="Grandmother">Grandmother</option>
															<option value="Grandfather">Grandfather</option>														

														</select>	
													</div>
													<div class="col-4">
														<p class="fst-normal">drinks a coke</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>		
													<div class="col-3">
														<select class="form-select form-select-md" id="select-act5-3" name="select-act5-3">

															<option disabled selected>Select an option</option>
															<option value="Drink">Drink</option>
															<option value="Eat">Eat</option>											

														</select>	
													</div>
													<div class="col-4">
														<p class="fst-normal">a cup of coffee</p> 
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">He likes a glass of</p> 
													</div>		
													<div class="col-4">
														<select class="form-select form-select-md" id="select-act5-4" name="select-act5-4">

														<option disabled selected>Select an option</option>
															<option value="Water">Water</option>
															<option value="Milk shake">Milk shake</option>
															<option value="Orange juice">Orange juice</option>
															<option value="Horchata">Horchata</option>
															<option value="Coffee">Coffee</option>
															<option value="Chocolate">Chocolate</option>
															<option value="Tea">Tea</option>										

														</select>	
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

<!-- Página 44 -->
<div id="ModalUnit2Act6" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT DO YOU PREFER?</h5>
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
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-start justify-content-sm-start mb-2">															
													<div class="col-2">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag44/waiter.png"
														class="rounded mx-auto d-block">	
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-6">
														<p class="fst-normal"> you want a coke?</p> 
													</div>														
												</div>
												
												<div class="row justify-content-md-end justify-content-sm-end mb-2">
													<div class="col-3">
														<p class="fst-normal">No, I do not </p> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act6-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-2">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag44/boss.png"
														class="rounded mx-auto d-block">	
													</div>																					
												</div>

												<div class="row justify-content-md-end justify-content-sm-end mb-2">
													<div class="col-1">
														<p class="fst-normal">I </p> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act6-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-3">
														<p class="fst-normal"> water</p> 
													</div>																					
												</div>

												<div class="row justify-content-md-start justify-content-sm-start mb-2">															
													<div class="col-2">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag44/waiter.png"
														class="rounded mx-auto d-block">	
													</div>
													<div class="col-2">
														<p class="fst-normal">Do you </p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act6-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal"> bread or tortilla?</p> 
													</div>														
												</div>

												<div class="row justify-content-md-end justify-content-sm-end mb-2">
													<div class="col-1">
														<p class="fst-normal">I </p> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act6-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fst-normal"> bread</p> 
													</div>		
													<div class="col-2">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag44/woman.png"
														class="rounded mx-auto d-block">	
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

<!-- Página 45 -->
<div id="ModalUnit2Act7" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT DO YOU LIKE?</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue. Use your personal information.</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag45/img45.png">	
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act7-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-2">
														<p class="fst-normal">Do you like, </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-1f" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													
													<div class="col-2">
														<input type="text" id="input-act7-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act7-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-2">
														<p class="fst-normal">: Yes, I do. I like</p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-2f" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>																									
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act7-4n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-2">
														<p class="fst-normal">: Do you like </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-3f" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-5n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fst-normal"> ? </p>
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act7-6n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>												
													<div class="col-1">
														<p class="fst-normal">: No, I </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">. I like </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act7-1ff" class="form-control"
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

<!-- Página 46 -->
<div id="ModalUnit2Act8" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">SIMON SAYS</h5>
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
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag46/pag46.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Simon says: </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act8-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">down</p> 
													</div>	
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<input type="text" id="input-act8-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>														
													
													<div class="col-4">
														<p class="fst-normal">: Stand up</p> 
													</div>																
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Simon says: </p> 
													</div>	
													<div class="col-1">
														<p class="fst-normal">Jump</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act8-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px; margin-left: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">times</p> 
													</div>														
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">Simon says: </p> 
													</div>	
													<div class="col-1">
														<p class="fst-normal">Touch</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act8-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px; margin-left: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">head</p> 
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-5">
														<p class="fst-normal">Simon says: Be quiet,</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act8-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>													
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<input type="text" id="input-act8-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>														
													
													<div class="col-4">
														<p class="fst-normal">: Touch your nose</p> 
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

<!-- Página 47  -->
<div id="ModalUnit2Act9" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">DRAWING AND COLORING SOME FRUIT</h5>
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
											<p class="fs-1 fw-bold">Draw and color some fruit and drinks</p>
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
										}

										canvas9 {
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
										<div class="container-fluid">
											<input type="number" value="0" id="verify-canvas">
											<canvas id="canvas9" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag47/canvas47.png')"
											width="775" height="400">

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

<!-- Página 48  -->
<div id="ModalUnit2Act10" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MEALS, DRINKS, FRUITS, FOODS</h5>
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
											<p class="fs-1 fw-bold">Answer this crosswords puzzle, using the name of the images</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">
										<link rel="stylesheet" href="../../app/controllers/BookOneUnitTwo/style.css" />
										<div class="col-md-12 col-xs-12">
											<script src="../../app/controllers/BookOneUnitTwo/polyfill/dialog-polyfill.js"></script>
                        					<!--Se elimino el script main.js aquí ya que tuvo conflicto con el canvas, hizo que dejara de funcionar -->
											<form class="form" autocomplete="off" method="post" novalidate>
												
												<div class="row justify-content-md-center justify-content-sm-center">
													<div class="col-4">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag48/image48.png"
														class="rounded mx-auto d-block">	
													</div>
													<div class="col-8">
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
																	<td class="cell">
																		<label class="word-number" for="1">1  5</label>
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
																			id="2"
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
																			id="3"
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
																			id="4"
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
																			id="5"
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
																			id="6"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="2">2</label>
																		<input
																			required
																			id="7"
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
																			id="8"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
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
																			id="14"
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
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
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
																			id="15"
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
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>	     
																	<td class="cell cell-black" ></td>	              
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >
																		<label class="word-number" for="3">3</label>
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
																			pattern="[Gg]"
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
																			pattern="[Gg]"
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
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
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
																		<label class="word-number" for="3">4</label>
																		<input
																			required
																			id="20"
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
																			id="21"
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
																			id="22"
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
																			id="23"
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
																	<td class="cell cell-black"></td>
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

<!-- Página 49 -->
<div id="ModalUnit2Act11" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HELLO, MY NAME IS KATHY</h5>
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
											<p class="fs-1 fw-bold">Complete the sentences. Use your personal information</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">										

										<div class="col-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<p class="fst-normal">Hello, my name is </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act11-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-3">
														<p class="fst-normal">. I am your teacher.</p> 
													</div>													
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<p class="fst-normal">Hello, my name is </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act11-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-3">
														<p class="fst-normal">. I am a student.</p> 
													</div>													
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act11-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fst-normal">, my name is </p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act11-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-3">
														<p class="fst-normal">. I am a student.</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-3">
														<p class="fst-normal">Hello, my name is </p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act11-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fst-normal">. I am a </p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act11-6" class="form-control"
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

<!-- Página 50 -->
<div id="ModalUnit2Act12" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">SAYING SOME CLASSROOM EXPRESSIONS</h5>
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
											<p class="fs-1 fw-bold">Write the classroom expressions</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag50/image50.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											
											<div class="row justify-content-md-center justify-content-sm-center mb-2">
													
												<div class="col-12">
													<input type="text" id="input-act12-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Please, listen">
												</div>
												
												<div class="col-12">
													<input type="text" id="input-act12-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Take a pencil">
												</div>
												
												<div class="col-12">
													<input type="text" id="input-act12-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Come back to your seat">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Open the window">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Take a piece of chalk">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Take a pen">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Come in">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Please raise your hand">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Don't make any noice">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Close your book">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Pay attention, please">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Touch your shoulders">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Write your name">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Please, read the sentence">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-15" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Repeat, after me">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-16" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Draw a clown">
												</div>

												<div class="col-12">
													<input type="text" id="input-act12-17" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 5px;"
														placeholder="Close your window">
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

<!-- Página 52, actividad 13.1 -->
<div id="ModalUnit2Act13_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PROFFESIONS/OCCUPATIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Match the image with the sentence</p>
											<input type="text" class="d-none" id="points13_1" name="points">
											<input type="text" class="d-none" id="idcliente13_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																						
												
											<div class="col" id="box-act13-1">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img3-52.png"  alt="Secretary" id="img-act13-1">
											</div>
											<div class="col justify-content-center">
												<div id="nurse" class="box-act13 text-center m-3"  style="background-color: #FFFFFF;">
													She is a nurse
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act13-2">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img4-52.png"  alt="Teacher" id="img-act13-2">
											</div>
											<div class="col justify-content-center">
												<div id="doctor" class="box-act13 text-center m-3"  style="background-color: #FFFFFF;">
													He is a doctor
												</div>
											</div>
																					
										</div>	
										
										<div class="col-md-6 col-sm-6">
																							
											<div class="col" id="box-act13-3">													
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img2-52.png" alt="Doctor" id="img-act13-3">
											</div>
											<div class="col justify-content-center">
												<div id="secretary" class="box-act13 text-center m-3"  style="background-color: #FFFFFF;">
													Arely is a secretary
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act13-4">
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img1-52.png"  alt="Nurse" id="img-act13-4">
											</div>
											<div class="col justify-content-center">
												<div id="teacher" class="box-act13 text-center m-3"  style="background-color: #FFFFFF;">
													She is a teacher
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

<!-- Página 52, actividad 13.2  -->
<div id="ModalUnit2Act13_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PROFFESIONS/OCCUPATIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points13_2" name="points">
											<input type="text" class="d-none" id="idcliente13_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img1-52_2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img2-52_2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentence">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img3-52_2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;" 
														placeholder="Rewrite the sentence">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag52/img4-52_2.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act13-4" class="form-control"
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

<!-- Página 53 -->
<div id="ModalUnit2Act14" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">RELATIVES: AUNT, UNCLE, DADDY AND MOMMY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag53/image53.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act14-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">and</p> 
													</div>
													<div class="col-3">
														<input type="text" id="input-act14-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-5">
														<p class="fst-normal">are playing with my </p> 
													</div>
													<div class="col-3">
														<input type="text" id="input-act14-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act14-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">and</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act14-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal">are </p> 
													</div>
													<div class="col-3">
														<input type="text" id="input-act14-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal">TV</p> 
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

<!-- Página 54, actividad 15.1  -->
<div id="ModalUnit2Act15_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WHAT'S YOUR FAVORITE HOBBY?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points15_1" name="points">
											<input type="text" class="d-none" id="idcliente15_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img1-54_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-1" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img2-54_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-2" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img3-54_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-3" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img4-54_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act15_1-4" class="form-control"
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

<!-- Página 54, actividad 15.2 -->
<div id="ModalUnit2Act15_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">PROFFESIONS/OCCUPATIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fifteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Match the image with the sentence</p>
											<input type="text" class="d-none" id="points15_2" name="points">
											<input type="text" class="d-none" id="idcliente15_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro15_2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																																													
											<div class="col justify-content-center">
												<div id="soccer" class="box-act15 text-center m-3"  style="background-color: #FFFFFF;">
													<h4> I like to play soccer </h4>
												</div>
											</div>																					
										</div>	
										<div class="col-md-6 col-sm-6">
											<div class="col" id="box-act15-1">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img1-54_2.png"  alt="Music" id="img-act15-1" style="margin-bottom: 10px;">
											</div>
										</div>

										<div class="col-md-6 col-sm-6">																																														
											<div class="col justify-content-center">
												<div id="jacks" class="box-act15 text-center m-3"  style="background-color: #FFFFFF;">
													<h4> I only play jacks </h4>
												</div>
											</div>																					
										</div>	
										<div class="col-md-6 col-sm-6">
											<div class="col" id="box-act15-2">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img2-54_2.png"  alt="Basketball" id="img-act15-2" style="margin-bottom: 10px;">
											</div>
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col justify-content-center">
												<div id="music" class="box-act15 text-center m-3"  style="background-color: #FFFFFF;">
													<h4> I listen to music </h4>
												</div>
											</div>																					
										</div>	
										<div class="col-md-6 col-sm-6">
											<div class="col" id="box-act15-3">													
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img3-54_2.png" alt="Soccer" id="img-act15-3" style="margin-bottom: 10px;">
											</div>
										</div>	

										<div class="col-md-6 col-sm-6">																																														
											<div class="col justify-content-center">
												<div id="basketball" class="box-act15 text-center m-3"  style="background-color: #FFFFFF;">
													<h4> I like to play basketball </h4>
												</div>
											</div>																					
										</div>	
										<div class="col-md-6 col-sm-6">
											<div class="col" id="box-act15-4">
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag54/img4-54_2.png"  alt="Jacks" id="img-act15-4" style="margin-bottom: 10px;">
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

<!-- Página 55, actividad 16.1  -->
<div id="ModalUnit2Act16_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ADJECTIVES: NEW, PRETTY, YOUNG</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentence from the picture</p>
											<input type="text" class="d-none" id="points16_1" name="points">
											<input type="text" class="d-none" id="idcliente16_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro16_1" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag55/img1-55_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act16_1-1" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					 
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag55/img2-55_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act16_1-2" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					
										</div>
										
										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag55/img3-55_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act16_1-3" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					
										</div>

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag55/img4-55_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act16_1-4" class="form-control"
													aria-label="Sizing example input" maxlength="100"
													style="margin-bottom: 25px; margin-top: 25px;"
													placeholder="Rewrite the sentence">
											</div>
																					
										</div>

										<div class="col-md-12 col-sm-12">
																																			
											<div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag55/img5-55_1.png">
											</div>
											<div class="col justify-content-center">
												<input type="text" id="input-act16_1-5" class="form-control"
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

<!-- Página 55, actividad 16.2 -->
<div id="ModalUnit2Act16_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES: NEW, PRETTY, YOUNG</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-sixteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points16_2" name="points">
											<input type="text" class="d-none" id="idcliente16_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro16_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12 justify-content-center">

											<div class="row justify-content-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<p class="fst-normal">This is a </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act16_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal"> dress.</p> 
													</div>													
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<input type="text" id="input-act16_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-4">
														<p class="fst-normal"> is a pretty girl.</p> 
													</div>																											
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My uncle is </p> 
													</div>			
													<div class="col-3">
														<input type="text" id="input-act16_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																							
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-5">
														<p class="fst-normal">Your daughter is </p> 
													</div>			
													<div class="col-3">
														<input type="text" id="input-act16_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																							
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">This is an </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act16_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal"> car.</p> 
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

<!-- Página 56 -->
<div id="ModalUnit2Act17" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">VERBS: PLAY AND DO</h5>
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
											<p class="fs-5 fw-bold">Match the image with the sentence</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																						
												
											<div class="col" id="box-act17-1">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag56/img1-56.png"  alt="Stand" id="img-act17-1">
											</div>
											<div class="col justify-content-center">
												<div id="window" class="box-act17 text-center m-3"  style="background-color: #FFFFFF;">
													Please, close the window
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act17-2">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag56/img2-56.png"  alt="Soccer" id="img-act17-2">
											</div>
											<div class="col justify-content-center">
												<div id="doctor" class="box-act17 text-center m-3"  style="background-color: #FFFFFF;">
													Sit down, please
												</div>
											</div>
																					
										</div>	
										
										<div class="col-md-6 col-sm-6">
																							
											<div class="col" id="box-act17-3">													
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag56/img3-56.png" alt="Window" id="img-act17-3">
											</div>
											<div class="col justify-content-center">
												<div id="stand" class="box-act17 text-center m-3"  style="background-color: #FFFFFF;">
													Please, stand up
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act17-4">
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag56/img4-56.png"  alt="Sit" id="img-act17-4">
											</div>
											<div class="col justify-content-center">
												<div id="teacher" class="box-act17 text-center m-3"  style="background-color: #FFFFFF;">
													My sister plays soccer
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

<!-- Página 57 -->
<div id="ModalUnit2Act18" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">PRONOUNS HE AND SHE</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences in order</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag57/img57.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
															
													<div class="col-12">
														<input type="text" id="input-act18-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 15px;"
															placeholder="Rewrite the sentece">
													</div>
													<div class="col-12">
														<input type="text" id="input-act18-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 15px;"
															placeholder="Rewrite the sentece">
													</div>
													<div class="col-12">
														<input type="text" id="input-act18-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 15px;"
															placeholder="Rewrite the sentece">
													</div>
													<div class="col-12">
														<input type="text" id="input-act18-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 15px;"
															placeholder="Rewrite the sentece">
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

<!-- Página 58 -->
<div id="ModalUnit2Act19" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">QUESTIONS ABOUT RELATIVES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nineteen">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag58/img1-58.png">						
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-2">
															<p class="fst-normal">What's </p> 
														</div>
														<div class="col-3">
															<input type="text" id="input-act19-1" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>
														<div class="col-2">
															<p class="fst-normal"> name</p> 
														</div>													
													</div>	
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-3">
															<p class="fst-normal">My name is </p> 
														</div>
														<div class="col-3">
															<input type="text" id="input-act19-2" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>	
													</div>																										
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag58/img2-58.png">						
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-3">
															<input type="text" id="input-act19-3" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>	
														<div class="col-2">
															<p class="fst-normal"> is it? </p> 
														</div>																																							
													</div>	
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-1">
															<p class="fst-normal">It</p> 
														</div>
														<div class="col-2">
															<input type="text" id="input-act19-4" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>
														<div class="col-3">
															<p class="fst-normal"> the board</p> 
														</div>	
													</div>																										
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag58/img3-58.png">						
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-5">
															<p class="fst-normal"> What's your hobby? </p> 
														</div>																																							
													</div>	
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-3">
															<p class="fst-normal">My hobby is</p> 
														</div>
														<div class="col-5">
															<input type="text" id="input-act19-5" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>											
													</div>																										
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag58/img4-58.png">						
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-3">
															<input type="text" id="input-act19-6" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>	
														<div class="col-3">
															<p class="fst-normal"> is your father? </p> 
														</div>																																							
													</div>	
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">
														<div class="col-3">
															<p class="fst-normal">My father is a</p> 
														</div>
														<div class="col-3">
															<input type="text" id="input-act19-7" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
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

<!-- Página 59 -->
<div id="ModalUnit2Act20" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MY DADDY IS A DOCTOR</h5>
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
											<p class="fs-5 fw-bold">Match the image with the sentence</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																						
												
											<div class="col" id="box-act20-1">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag59/img1-59.png"  alt="Nurse" id="img-act20-1">
											</div>
											<div class="col justify-content-center">
												<div id="Family" class="box-act20 text-center m-3"  style="background-color: #FFFFFF;">
													Family
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act20-2">												
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag59/img2-59.png"  alt="Videogames" id="img-act20-2">
											</div>
											<div class="col justify-content-center">
												<div id="Basketball" class="box-act20 text-center m-3"  style="background-color: #FFFFFF;">
													Basketball
												</div>
											</div>
																					
										</div>	
										
										<div class="col-md-6 col-sm-6">
																							
											<div class="col" id="box-act20-3">													
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag59/img3-59.png" alt="Family" id="img-act20-3">
											</div>
											<div class="col justify-content-center">
												<div id="Nurse" class="box-act20 text-center m-3"  style="background-color: #FFFFFF;">
													Nurse
												</div>
											</div>
																					
										</div>	

										<div class="col-md-6 col-sm-6">
																																			
											<div class="col" id="box-act20-4">
												<img draggable="true" class="rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag59/img4-59.png"  alt="Basketball" id="img-act20-4">
											</div>
											<div class="col justify-content-center">
												<div id="Videogames" class="box-act20 text-center m-3"  style="background-color: #FFFFFF;">
													Videogames
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

<!-- Página 60 -->
<div id="ModalUnit2Act21" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT'S YOUR FATHER'S OCUPPATION?</h5>
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
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12 justify-content-center">

											<div class="row justify-content-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<p class="fst-normal">What's </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act21-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-3">
														<p class="fst-normal"> father's occupation?</p> 
													</div>													
												</div>												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<input type="text" id="input-act21-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-4">
														<p class="fst-normal"> is a barber.</p> 
													</div>																											
												</div>
												
												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">What's your mother's </p> 
													</div>			
													<div class="col-5">
														<input type="text" id="input-act21-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal"> ?</p> 
													</div>																																						
												</div>												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-3">
														<p class="fst-normal">She is a </p> 
													</div>	
													<div class="col-3">
														<input type="text" id="input-act21-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																																						
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<input type="text" id="input-act21-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-5">
														<p class="fst-normal"> your uncle's job? </p> 
													</div>																																																						
												</div>
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">He </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act21-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal"> a mechanic.</p> 
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

<!-- Página 61 -->
<div id="ModalUnit2Act22" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT IS YOUR NAME?</h5>
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
											<p class="fs-1 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12 justify-content-center">

											<div class="row justify-content-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">What's your </p> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act22-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																									
												</div>												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My name is </p> 
													</div>			
													<div class="col-4">
														<input type="text" id="input-act22-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
																																						
												</div>
												
												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-5">
														<p class="fst-normal">Do you have a </p> 
													</div>			
													<div class="col-4">
														<input type="text" id="input-act22-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal"> ?</p> 
													</div>																																						
												</div>												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-2">
														<p class="fst-normal">Yes, </p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act22-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>			
													<div class="col-2">
														<p class="fst-normal"> do </p> 
													</div>																																																				
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<input type="text" id="input-act22-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-2">
														<p class="fst-normal"> is it?</p> 
													</div>																																																						
												</div>
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<p class="fst-normal">I play </p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act22-6" class="form-control"
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

<!-- Página 62 -->
<div id="ModalUnit2Act23" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHAT IS YOUR NAME?</h5>
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

										<div class="col-md-12 col-sm-12 col-xs-12 justify-content-center">

											<div class="row justify-content-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<h3> beishbo </h3> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act23-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																									
												</div>	
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<h3> vidoe </h3> 
													</div>			
													<div class="col-4">
														<input type="text" id="input-act23-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>	
																																						
												</div>
												
												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<h3> yuo </h3> 
													</div>			
													<div class="col-4">
														<input type="text" id="input-act23-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																																			
												</div>		
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">														
													<div class="col-4">
														<h3> socecr </h3> 
													</div>	
													<div class="col-4">
														<input type="text" id="input-act23-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																																																			
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<h3> liek </h3> 
													</div>	
													<div class="col-4">
														<input type="text" id="input-act23-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>																																																																				
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<h3> gasme </h3> 
													</div>		
													<div class="col-4">
														<input type="text" id="input-act23-6" class="form-control"
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

<!-- Página 63 -->
<div id="ModalUnit2Act24" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MY FAMILY</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue. Use your personal information.</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag63/img63.png">																				
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">Teacher: </p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act24-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">this is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act24-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act24-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-2">
														<p class="fst-normal">: It's nice to meet you, </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act24-4n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act24-5n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<input type="text" id="input-act24-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fst-normal"> to meet you, too</p>
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act24-6n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<input type="text" id="input-act24-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal"> do</p>
													</div>
													<div class="col-1">
														<input type="text" id="input-act24-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal"> do?</p>
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act24-7n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal">Not </p> 
													</div>	
													<div class="col-3">
														<input type="text" id="input-act24-4" class="form-control"
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

<!-- Página 64 -->
<div id="ModalUnit2Act25" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HELLO! HOW ARE YOU?</h5>
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
											<p class="fs-1 fw-bold">Complete the dialogue. Use your personal information.</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag64/img64.png">	
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">Teacher: </p> 
													</div>		
													<div class="col-1">
														<p class="fst-normal"> Hello, </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act25-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													
													<div class="col-1">
														<input type="text" id="input-act25-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-1">
														<p class="fst-normal"> are you? </p> 
													</div>
												</div>
												
												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act25-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
													<div class="col-1">
														<p class="fst-normal">: I'm</p>
													</div>
													<div class="col-1">
														<input type="text" id="input-act25-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-2">
														<p class="fst-normal">. And you</p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act25-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p>
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">Teacher: I'm OK </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act25-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act25-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>												
													<div class="col-1">
														<p class="fst-normal">: Do you have a </p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act25-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p>
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act25-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>	
													<div class="col-1">
														<p class="fst-normal">: Yes, I </p> 
													</div>	
													<div class="col-3">
														<input type="text" id="input-act25-1l" class="form-control"
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

<!-- Página 65 -->
<div id="ModalUnit2Act26" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">UNCLE FRANCISCO'S HAT</h5>
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
											<p class="fs-1 fw-bold">Complete the sentences</p>
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag65/img65_2.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-3">
														<p class="fw-normal">Every day </p> 	
													</div>	
													<div class="col-3">
														<input type="text" id="input-act26-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fw-normal"> Francisco woke up </p>
													</div>
													<div class="col-3">
														<input type="text" id="input-act26-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"> 
													</div>
													<div class="col-5">
														<p class="fw-normal"> the sun. He said "</p>
													</div>
													<div class="col-5">
														<input type="text" id="input-act26-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"> 
													</div>
													<div class="col-5">
														<p class="fw-normal"> " to his cat and </p>
													</div>
													<div class="col-5">
														<input type="text" id="input-act26-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"> 
													</div>
													<div class="col-1">
														<p class="fw-normal"> dog.</p>
													</div>
													<div class="col-2">
														<input type="text" id="input-act26-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-5">
														<p class="fw-normal"> said "Good Morning" to </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act26-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-2">
														<p class="fw-normal"> parrot...</p> 	
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

<!-- Página 66 -->
<div id="ModalUnit2Act27" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">RIDDLES</h5>
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
											<p class="fs-1 fw-bold">The answers are upside down</p>
											<input type="text" class="d-none" id="points27" name="points">
											<input type="text" class="d-none" id="idcliente27" name="idcliente">
											<input type="text" class="d-none" id="idlibro27" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag66/img1-66.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act27-1" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;"
																placeholder="1. _________________">
														</div>																										
													</div>																																							
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag66/img2-66.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act27-2" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;"
																placeholder="2. _________________">
														</div>																										
													</div>																																							
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag66/img3-66.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act27-3" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;"
																placeholder="3. _________________">
														</div>																										
													</div>																																							
												</div>																									
											</div>	
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag66/img4-66.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act27-4" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;"
																placeholder="4. _________________">
														</div>																										
													</div>																																							
												</div>																									
											</div>	
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag66/answers66.png">																				
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

<!-- Página 67 -->
<div id="ModalUnit2Act28" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">POEMS</h5>
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
											<p class="fs-1 fw-bold">Write the name of the poems</p>
											<input type="text" class="d-none" id="points28" name="points">
											<input type="text" class="d-none" id="idcliente28" name="idcliente">
											<input type="text" class="d-none" id="idlibro28" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag67/img1-67.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act28-1" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
														</div>																										
													</div>																																							
												</div>																									
											</div>	
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag67/img2-67.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-8">
															<input type="text" id="input-act28-2" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
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

<!-- Página 68  -->
<div id="ModalUnit2Act29" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ANIMAL CROSSWORD</h5>
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
											<p class="fs-1 fw-bold">Read the words below and answer the crossword</p>
											<input type="text" class="d-none" id="points29" name="points">
											<input type="text" class="d-none" id="idcliente29" name="idcliente">
											<input type="text" class="d-none" id="idlibro29" name="idlibro">
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
																			id="3"
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
																			id="4"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
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
																			pattern="[Rr]"
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
																			id="6"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
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
																			pattern="[Kk]"
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
																			pattern="[Nn]"
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
																			pattern="[Gg]"
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
																			pattern="[Rr]"
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
																			pattern="[Oo]"
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
																</tr>

																<tr>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell cell-black" ></td>
																	<td class="cell" >																	
																		<input
																			required
																			id="14"
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
																			id="15"
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
																</tr>

																<tr>
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
																			pattern="[Ll]"
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
																			pattern="[Ee]"
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
																			pattern="[Pp]"
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
																			pattern="[Hh]"
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
																			pattern="[Aa]"
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
																			pattern="[Nn]"
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
																			id="24"
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
																	<td class="cell" >																	
																		<input
																			required
																			id="26"
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
																		<input
																			required
																			id="27"
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
																			id="28"
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
																			id="29"
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
																			id="30"
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
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag68/image68.png"
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

<!-- Página 69 -->
<div id="ModalUnit2Act30" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CORPORAL SOUNDS</h5>
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
											<p class="fs-1 fw-bold">What's the name of the song?</p>
											<input type="text" class="d-none" id="points30" name="points">
											<input type="text" class="d-none" id="idcliente30" name="idcliente">
											<input type="text" class="d-none" id="idlibro30" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="row justify-content-md-center justify-content-sm-center">
												<div class="row justify-content-md-center justify-content-sm-center mb-2">	
													<div class="col-12">
														<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag69/image69.png">
													</div>
													<div class="row justify-content-md-center justify-content-sm-center" style="margin-top: 15px;">														
														<div class="col-6">
															<input type="text" id="input-act30-1" class="form-control"
																aria-label="Sizing example input" maxlength="100"
																style="margin-bottom: 15px;">
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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro1_u2.js');
?>