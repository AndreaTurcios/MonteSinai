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

			pages: 53,

			// Events

			when: {
				turning: function(event, page, view) {

					var book = $(this),
						currentPage = book.turn('page'),
						pages = book.turn('pages');

					// Update the current URI

					Hash.go('../../resources/js/turnjs4/samples/magazine/pages/' + page).update();

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunoquintogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!--Espacio para modal -->
<!-- Pagina 5 -->
<!-- Region 12-->
<!--Funcionando-->
<div id="ModalLibroCinco1" class="modal fade" tabindex="-1">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">The Alphabet</h5>
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
											<p class="fw-bold">Write the missing letters of the alphabet</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-6">
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-a" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-b" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														C
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-d" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-e" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-f" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">G</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-h" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-i" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-j" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														K
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-l" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														M
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-n" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-o" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">P</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-q" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-r" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>

										<!-- espacio -->
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>
										<div class="col"></div>

										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">S</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-t" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-u" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">V</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-w" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-x" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col"> Y</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">
													<div class="col">
														<input type="text" id="input-abc-z" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">

												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-2">
												<div class="row row-cols-10">

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
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina  6-->
<!-- Region  13-->
<!--Funcionando-->
<div id="ModalLibroCinco6" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Greetings And Leave-Takings</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-6">
				<div class="modal-body">
					<div class="container-fluid">
						<!-- Container-fluid-->
						<!-- Indicaciones -->
						<div class="row">
							<div class="col-md-12 align-items-center">
								<p class="fw-bold">Select the correct sentence</p>
								<!-- class="d-none" -->
								<input type="text" class="d-none" id="points6" name="points6">
								<input type="text" class="d-none" id="idcliente6" name="idcliente6">
								<input type="text" class="d-none" id="idlibro6" name="idlibro6">
							</div>
						</div>

						<div class="row border box-select-5 ">
							<div class="col-md-12">
								<label for="pag6-req1">Hi! Maritza, what´s new?</label>
								<select name="pag6-req1" id="pag6-req1">
									<option value="1">I´m fine thank you</option>
									<option value="2">Good afternoon, Napoleón!</option>
									<option value="3">Not much, Fabricio</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req2">Good morning Mr. Meléndez!</label>
								<select name="pag6-req2" id="pag6-req2">
									<option value="1">I´m fine thank you</option>
									<option value="2">Good afternoon, Napoleón!</option>
									<option value="3">Not much, Fabricio</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
									<option value="5">Good morning Elsa Miriam!</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req3">Good afternoon, Napoleón!</label>
								<select name="pag6-req3" id="pag6-req3">
									<option value="1">I´m fine thank you</option>
									<option value="2">Good afternoon, Rosa María!</option>
									<option value="3">Not much, Fabricio</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
									<option value="5">Good morning Elsa Miriam!</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req4">Good evening, Roberto! How are you?</label>
								<select name="pag6-req4" id="pag6-req4">
									<option value="1">I´m fine thank you</option>
									<option value="2">Good afternoon, Rosa María!</option>
									<option value="3">Not much, Fabricio</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
									<option value="5">Good evening, Rolando! I´m fine.</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req5">How are you Ana Maria?</label>
								<select name="pag6-req5" id="pag6-req5">
									<option value="1">I´m fine thank you</option>
									<option value="2">Good afternoon, Rosa María!</option>
									<option value="3">Fine thank you, and you?</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
									<option value="5">Good evening, Rolando! I´m fine.</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pag6-req6">I´m fine thank you.</label>
								<select name="pag6-req6" id="pag6-req6">
									<option value="1">See you later, Ana Maria.</option>
									<option value="2">Good afternoon, Rosa María!</option>
									<option value="3">Fine thank you, and you?</option>
									<option value="4">Not too bad Melissa. I havve to go. See you</option>
									<option value="5">Good evening, Rolando! I´m fine.</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req7">Hello, Mr. Velásquez. How do you do today?</label>
								<select name="pag6-req7" id="pag6-req7">
									<option value="1">See you later, Ana Maria.</option>
									<option value="2">Good afternoon, Rosa María!</option>
									<option value="3">Fine thank you, and you?</option>
									<option value="4">I´m fine Mrs. Rodríguez. I´m glad to see you! </option>
									<option value="5">Good evening, Rolando! I´m fine.</option>
								</select>
							</div>
						</div>


						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pag6-req8">Hi! Douglas. How are you today my friend?</label>
								<select name="pag6-req8" id="pag6-req8">
									<option value="1">See you later, Ana Maria.</option>
									<option value="2">Not too bad Melissa. I have to go. See you.</option>
									<option value="3">Fine thank you, and you?</option>
									<option value="4">I´m fine Mrs. Rodríguez. I´m glad to see you! </option>
									<option value="5">Good evening, Rolando! I´m fine.</option>
								</select>
							</div>
						</div>
						<!-- Fin Container-fluid-->
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina  7-->
<!-- Region  14-->
<div id="ModalLibroCinco7" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Greetings And Leave-Takings</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-7">
				<div class="modal-body">
					<div class="container-fluid">
						<!-- Container-fluid-->
						<!-- Indicaciones -->

						<div class="row">
							<div class="col-md-12 align-items-center">
								<p class="fw-bold">Select the correct sentence</p>
								<!-- class="d-none" -->
								<input type="text" class="d-none" id="points7" name="points7">
								<input type="text" class="d-none" id="idcliente7" name="idcliente7">
								<input type="text" class="d-none" id="idlibro7" name="idlibro7">
							</div>
						</div>


						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="pregutna71">1-</label>
								<select name="pregutna71" id="pag7-req1">
									<option value="respuesta1">Good morning, Miss Diana</option>
									<option value="respuesta2">Good mornig, Miss Diana</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna72">2-.</label>
								<select name="pregutna72" id="pag7-req2">
									<option value="respuesta1">Hi Bryan! How is you?</option>
									<option value="respuesta2">Hi Bryan! How are you?</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna73">3-</label>
								<select name="pregutna73" id="pag7-req3">
									<option value="respuesta1">Hi James! I’m fine. And you?</option>
									<option value="respuesta2"> Hi James! Im fine. And you?</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna74">4-.</label>
								<select name="pregutna74" id="pag7-req4">
									<option value="respuesta1">How are you doing? Fine. How about you?</option>
									<option value="respuesta2">How is you doing? Fine. How about you?</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna75">5-.</label>
								<select name="pregutna75" id="pag7-req5">
									<option value="respuesta1">Nice to met you.</option>
									<option value="respuesta2">Nice to meet you</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna76">6-.</label>
								<select name="pregutna76" id="pag7-req6">
									<option value="respuesta1">I’m fine. Thank you!</option>
									<option value="respuesta2">Im fine. Thank you!</option>
								</select>
							</div>

							<div class="col-md-12 ">
								<label for="pregutna77">7-</label>
								<select name="pregutna77" id="pag7-req7">
									<option value="respuesta1"> Good night, Sir. Seen you tomorrow?</option>
									<option value="respuesta2">Good night, Sir. See you tomorrow.</option>
								</select>
							</div>

						</div>

						<!-- Fin Container-fluid-->
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina  8-->
<!-- Region  15-->
<!--Funcionando -->
<div id="ModalLibroCinco3" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">My School and I</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three">
				<div class="modal-body">
					<div class="container-fluid">
						<!-- Container-fluid-->
						<!-- Indicaciones -->

						<div class="row">
							<div class="col-md-12 align-items-center">
								<p class="fw-bold">Write the names that you read</p>
								<!-- class="d-none" -->
								<input type="text" class="d-none" id="points3" name="points3">
								<input type="text" class="d-none" id="idcliente3" name="idcliente3">
								<input type="text" class="d-none" id="idlibro3" name="idlibro3">
							</div>
						</div>

						<div class="row justify-content-md-center">
							<div class="col-md-8  ">
								<img class="img-fluid img-thumbnail" src="../../resources/img/BOOKS/FifthGradeModal/imgModalLibroCinco3.png" alt="">
							</div>
						</div>

						<div class="row" style="margin-top:5px">
							<?php
							for ($i = 1; $i <= 26; $i++) {
								echo "<div class=\"col-6 col-lg-3 flex-container-5\">";
								echo "<div class=\"num\"><span>" . $i . "</span></div>";
								echo "<div class =\"req\"><input type=\"text\" id=\"pag8-req" . $i . "\">  </div>";
								echo "</div>";
							}
							?>
						</div>
						<!-- Fin Container-fluid-->
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina  -->
<!-- Region  16-->
<div id="ModalLibroCinco4" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">School Locattions</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-cuatro">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 10 -->
<div id="ModalLibroCinco5" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Common Commands</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-cinco">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 11 -->
<div id="ModalLibroCinco11" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Days of The Week</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-11">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 12 -->
<!-- Region 19 -->
<div id="ModalLibroCinco12" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">School Subjects</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-12">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 13 -->
<!-- Region 20 -->
<div id="ModalLibroCinco13" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Class Schedule</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-13">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 14 -->
<!-- Region 21 -->
<div id="ModalLibroCinco14" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Let's Count From One to Forty</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-14">
				<div class="modal-body">
					<div class="container-fluid">
						<!--inidio de container-fluid-->
						<div class="row" style="margin-top:5px">
							<?php
							for ($i = 1; $i <= 40; $i++) {
								echo "<div class=\"col-6 col-lg-3 flex-container-5\">";
								echo "<div class=\"num\"><span>" . $i . "</span></div>";
								echo "<div class =\"req\"><input type=\"text\" id=\"pag14-req" . $i . "\">  </div>";
								echo "</div>";
							}
							?>
						</div>

						<!-- Fin Container-fluid-->
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 15 -->
<!-- Region 22 -->
<div id="ModalLibroCinco15" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Let's Count From Forty - One to Eighty</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-15">
				<div class="modal-body">
					<div class="container-fluid">
						<!--inidio de container-fluid-->
						<div class="row" style="margin-top:5px">
							<?php
							for ($i = 41; $i <= 80; $i++) {
								echo "<div class=\"col-6 col-lg-3 flex-container-5\">";
								echo "<div class=\"num\"><span>" . $i . "</span></div>";
								echo "<div class =\"req\"><input type=\"text\" id=\"pag14-req" . $i . "\">  </div>";
								echo "</div>";
							}
							?>
						</div>

						<!-- Fin Container-fluid-->
					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 16 -->
<!-- Region 23 -->
<div id="ModalLibroCinco16" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Prepositions: IN, ON</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-16">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 17 -->
<!-- Region 24 -->
<div id="ModalLibroCinco17" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Expressions: Hello!, Hi!</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-17">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 18 -->
<!-- Region 25 -->
<div id="ModalLibroCinco18" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">What's This?, What's That?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-18">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 19 -->
<!-- Region 26 -->
<div id="ModalLibroCinco19" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Where's Martha?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-19">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 20 -->
<!-- Region 27 -->
<div id="ModalLibroCinco20" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Introduce a Boy and a Girl</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-20">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 21 -->
<!-- Region 28 -->
<div id="ModalLibroCinco21" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Classroom Expressions</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-21">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 22 -->
<!-- Region 29 -->
<div id="ModalLibroCinco22" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Match Words And Phrases</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-22">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 23 -->
<!-- Region 30 -->
<div id="ModalLibroCinco23" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Can You Find These Words?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-23">
                    <div class="modal-body">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="libro6-indicaciones">Find the words</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points23" name="points23">
                                <input type="text" class="d-none" id="idcliente23" name="idcliente23">
                                <input type="text" class="d-none" id="idlibro23" name="idlibro23">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 align-items-center">
                                <div class="crucigrama-juego">
                                    <div id="words" class=""></div>
                                    <div id="puzzle" class="crucigrama-pag23"></div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 align-items-center" align="letf">
                                <div class="crucigrama-palabras crucigrama-color-pag23">
                                    <ul>
                                        <ul id="words">
                                            <li id="add-word">
                                                <div id="add-word"></div>
                                            </li>
                                        </ul>
                                    </ul>
                                </div>
                                <div>

                                </div>

                            </div>
                        </div>
                        <!--Modal Body -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-tooltip="Guardar">Submit</button>
                    </div>
                </form>
		</div>
	</div>
</div>

<!-- Pagina 24 -->
<!-- Region 31 -->
<div id="ModalLibroCinco24" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Riddles</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-24">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 27 -->
<!-- Region 34 -->
<div id="ModalLibroCinco27" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Birthday Celebrations</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-27">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 28 -->
<!-- Region 35 -->
<div id="ModalLibroCinco28" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Happy Birthday! Song</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-28">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 29 -->
<!-- Region 36 -->
<div id="ModalLibroCinco29" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Months of the Year</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-29">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 30 -->
<!-- Region 37 -->
<div id="ModalLibroCinco30" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Frequency Adverbs</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-30">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 32 -->
<!-- Region 39 -->
<div id="ModalLibroCinco32" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Let's Count From Eighty - One To One Hundred</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-32">
				<div class="modal-body">
					<div class="container-fluid">
						<!--inidio de container-fluid-->
						<div class="row" style="margin-top:5px">
							<?php
							for ($i = 81; $i <= 100; $i++) {
								echo "<div class=\"col-6 col-lg-3 flex-container-5\">";
								echo "<div class=\"num\"><span>" . $i . "</span></div>";
								echo "<div class =\"req\"><input type=\"text\" id=\"pag14-req" . $i . "\">  </div>";
								echo "</div>";
							}
							?>
						</div>

						<!-- Fin Container-fluid-->

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Pagina 33 -->
<!-- Region 40 -->
<div id="ModalLibroCinco33" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Possessive Adjectives</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-33">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 34 -->
<!-- Region 41 -->
<div id="ModalLibroCinco34" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Possessive: 's</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-34">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 35 -->
<!-- Region 42 -->
<div id="ModalLibroCinco35" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Talking About Ages</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-35">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 36 -->
<!-- Region 43 -->
<div id="ModalLibroCinco36" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">When is Your Birthday?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-36">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 37 -->
<!-- Region 44 -->
<div id="ModalLibroCinco37" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">All About My Holiday</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-37">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 42 -->
<!-- Region 49 -->
<div id="ModalLibroCinco42" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">How Many Sentences Can You Make???</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-42">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Pagina 43 -->
<!-- Region 50 -->
<div id="ModalLibroCinco43" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Crossword Using The Months of The Year</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-43">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- Pagina 44 -->
<!-- Region 51 -->
<div id="ModalLibroCinco44" class="modal fade" tabindex="-2">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Find And Write Words About</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-44">
				<div class="modal-body">
					<div class="container-fluid">

					</div>
					<br>
					<!-- Botones de Control -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
						<br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="" ModalLibroDos" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Rewrite the Sentences</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points10" name="points10">
											<input type="text" class="d-none" id="idcliente10" name="idcliente10">
											<input type="text" class="d-none" id="idlibro10" name="idlibro10">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="col">
												<input type="text" id="word-actyo10-21" class="form-control" aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="word-actyo10-22" class="form-control" aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="word-actyo10-23" class="form-control" aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="word-actyo10-24" class="form-control" aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<!-- fin cols  -->
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
						<button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
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
Book_Page::footerTemplate6('controladorlibro5.js');
?>