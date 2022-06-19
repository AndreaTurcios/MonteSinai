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

<!-- Página 12 - Actividad 1 (Canvas) -->
<div class="modal fade" id="ModalLibrotsestdodfdfd" tabindex="-10" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Color the image</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<!-- class="d-none" -->
											<input type="text" id="points5" name="points5">
											<input type="text" id="idcliente5" name="idcliente5">
											<input type="text" id="idlibro5" name="idlibro5">
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
										<h1>Dibuja con tu raton</h1>
										<div class="grid">
											<div class="color">
												<p>Escoger un color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Cambiar anchura del lápiz:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker">
												</div>
											</div>
											<div class="clear">
													<p>Limpiar pantalla</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn">Limpiar pantalla</a>
												</div>
											</div>
										</div>
									</header>
									
									<div class="col-12">
										<div class="container-fluid">
											<canvas id="canvas1" style="background: url('../../resources/img/BOOKS/FirstGrade/UnitOne/Pag12/Cuadro.png')"
											width="775" height="400">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									<script>	
										// Check out PaperJs' Docs: http://paperjs.org/tutorials/

										paper.install(window);

										$(window).on('load', function() {
										// Set it up
											paper.setup('canvas1');

										var canvas1 = document.getElementById("canvas1");

										const context = canvas1.getContext('2d');

											// Create a simple drawing tool:
											var tool = new Tool();
											var path;

										// Get elements from DOM and define properties
										var colorPicker = document.getElementById("colorPicker");
										var colorStroke;
										var widthStrokePicker = document.getElementById("strokeWidthPicker");
										var widthStroke;
										var clearButton = document.getElementById("clearBtn");

										// Clear event listener
										clearBtn.addEventListener("click", function() {
										// Clear canvas1
										paper.project.activeLayer.removeChildren();
										paper.view.draw();
										});

										// Update 
										function update() {
										colorStroke = colorPicker.value;
										widthStroke = widthStrokePicker.value;
										}

										// Check for new color value each second
										setInterval(update, 1000);

											// Define a mousedown and mousedrag handler
											tool.onMouseDown = function(event) {
												path = new Path();
										path.strokeWidth = widthStroke;
												path.strokeColor = colorStroke;
										// Draw
												path.add(event.point);
											}

											tool.onMouseDrag = function(event) {
										// Draw
												path.add(event.point);
											}
										});
									</script>
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

<!-- fin modales-->

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
											<input type="text" class="d-none" id="points3" name="points3">
											<input type="text" class="d-none" id="idcliente3" name="idcliente3">
											<input type="text" class="d-none" id="idlibro3" name="idlibro3">
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
											<input type="text" class="d-none" id="points4" name="points4">
											<input type="text" class="d-none" id="idcliente4" name="idcliente4">
											<input type="text" class="d-none" id="idlibro4" name="idlibro4">
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


<!-- No está siendo ocupado este modal en ninguna pagina -->
<div id="ModalLibroFive" class="modal fade" tabindex="-8">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Rewrite the Sentences</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fives">
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
											<input type="text" id="points5" name="points5">
											<input type="text" id="idcliente5" name="idcliente5">
											<input type="text" id="idlibro5" name="idlibro5">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="col">
												<input type="text" id="sentences1" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>

										<div class="col"></div>
										<div class="col"></div>

										<div class="col">
											<div class="col">
												<input type="text" id="sentences2" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>

										<!-- <div class="col"></div>
										<div class="col"></div> -->

										<div class="col">
											<div class="col">
												<input type="text" id="sentences3" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>

										<div class="col"></div>
										<div class="col"></div>

										<div class="col">
											<div class="col">
												<input type="text" id="sentences4" class="form-control"
													aria-label="Sizing example input" maxlength="100">
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
											<input type="text" class="d-none" id="points6" name="points6">
											<input type="text" class="d-none" id="idcliente6" name="idcliente6">
											<input type="text" class="d-none" id="idlibro6" name="idlibro6">
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
											<input type="text" id="words3" class="form-control"
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
											<input type="text" id="words4" class="form-control"
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
											<input type="text" class="d-none" id="points7" name="points7">
											<input type="text" class="d-none" id="idcliente7" name="idcliente7">
											<input type="text" class="d-none" id="idlibro7" name="idlibro7">
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
											<input type="text" class="d-none" id="points8" name="points8">
											<input type="text" class="d-none" id="idcliente8" name="idcliente8">
											<input type="text" class="d-none" id="idlibro8" name="idlibro8">
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
											<input type="text" class="d-none" id="points9" name="points9">
											<input type="text" class="d-none" id="idcliente9" name="idcliente9">
											<input type="text" class="d-none" id="idlibro9" name="idlibro9">
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
											<input type="text" class="d-none" id="points10" name="points10">
											<input type="text" class="d-none" id="idcliente10" name="idcliente10">
											<input type="text" class="d-none" id="idlibro10" name="idlibro10">
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
											<input type="text" class="d-none" id="points11" name="points11">
											<input type="text" class="d-none" id="idcliente11" name="idcliente11">
											<input type="text" class="d-none" id="idlibro11" name="idlibro11">
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
											<input type="text" id="word-actyo11-31" class="form-control"
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
											<input type="text" class="d-none" id="points12" name="points12">
											<input type="text" class="d-none" id="idcliente12" name="idcliente12">
											<input type="text" class="d-none" id="idlibro12" name="idlibro12">
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
											<input type="text" class="d-none" id="points13" name="points13">
											<input type="text" class="d-none" id="idcliente13" name="idcliente13">
											<input type="text" class="d-none" id="idlibro13" name="idlibro13">
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
											<input type="text" class="d-none" id="points25" name="points25">
											<input type="text" class="d-none" id="idcliente25" name="idcliente25">
											<input type="text" class="d-none" id="idlibro25" name="idlibro25">
										</div>
									</div>
									<div class="row row-cols-4">
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/seven.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault1">
														<label class="form-check-label" for="flexCheckDefault1">
															TWO
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault2">
														<label class="form-check-label" for="flexCheckDefault2">
															ONE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault3">
														<label class="form-check-label" for="flexCheckDefault3">
															SEVEN
														</label>
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
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/one.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault4">
														<label class="form-check-label" for="flexCheckDefault4">
															FIVE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault5">
														<label class="form-check-label" for="flexCheckDefault5">
															ONE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault6">
														<label class="form-check-label" for="flexCheckDefault6">
															FOUR
														</label>
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
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/six.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault7">
														<label class="form-check-label" for="flexCheckDefault7">
															SIX
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault8">
														<label class="form-check-label" for="flexCheckDefault8">
															THREE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault9">
														<label class="form-check-label" for="flexCheckDefault9">
															EIGHT
														</label>
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
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/ten.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault10">
														<label class="form-check-label" for="flexCheckDefault10">
															NINE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault11">
														<label class="form-check-label" for="flexCheckDefault11">
															SIX
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault12">
														<label class="form-check-label" for="flexCheckDefault12">
															TEN
														</label>
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
										<!-- espacio -->
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="row">
												<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/Pag18/two.png">
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault13">
														<label class="form-check-label" for="flexCheckDefault13">
															NINE
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault14">
														<label class="form-check-label" for="flexCheckDefault14">
															TWO
														</label>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="form-check">
												<div class="row">
													<div class="col">
														<input class="form-check-input" type="checkbox" value=""
															id="flexCheckDefault15">
														<label class="form-check-label" for="flexCheckDefault15">
															FIVE
														</label>
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
											<input type="text" class="d-none" id="points14" name="points14">
											<input type="text" class="d-none" id="idcliente14" name="idcliente14">
											<input type="text" class="d-none" id="idlibro14" name="idlibro14">
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

<!-- Página 19 -->
<div id="ModalLibroVeintiseis" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
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
											<input type="text" class="d-none" id="points26" name="points26">
											<input type="text" class="d-none" id="idcliente26" name="idcliente26">
											<input type="text" class="d-none" id="idlibro26" name="idlibro26">
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

<div id="ModalLibroVeintinueve" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
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
											<input type="text" class="d-none" id="points29" name="points29">
											<input type="text" class="d-none" id="idcliente29" name="idcliente29">
											<input type="text" class="d-none" id="idlibro29" name="idlibro29">
										</div>
									</div>
									<div class="row row-cols-2 row-cols-lg-3">
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-3">
													<div class="col">
														<h4>B</h4>
													</div>
													<div class="col">
														<h4>y</h4>
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
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group">
												<div class="row row-cols-2">
													<div class="col">
														<h4>see</h4>
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
										<div class="col border border-dark col-4">
											<!-- inicio group -->
											<div class="input-group">
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
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
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
														<h4>you ?</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
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
														<h4>you ?</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
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
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
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

<div id="ModalLibroTreinta" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
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
											<input type="text" class="d-none" id="points30" name="points30">
											<input type="text" class="d-none" id="idcliente30" name="idcliente30">
											<input type="text" class="d-none" id="idlibro30" name="idlibro30">
										</div>
									</div>
									<div class="row row-cols-2 row-cols-lg-3">
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-3">
													<div class="col">
														<h4>Hello</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp301"
															class="col-6 col-md-4 form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Williams!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-2">
													<div class="col">
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
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row rows-cols-4">
													<div class="col">
														<h4>How do you</h4>
													</div>
													<div class="col">
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
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-3">
													<div class="col">
														<h4>See</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp304" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row">
													<div class="col">
														<h4>Not</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp305" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row">
													<div class="col">
														<h4>See you</h4>
													</div>
													<div class="col">
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

<div id="ModalLibroTreintayuno" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
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
											<input type="text" class="d-none" id="points31" name="points31">
											<input type="text" class="d-none" id="idcliente31" name="idcliente31">
											<input type="text" class="d-none" id="idlibro31" name="idlibro31">
										</div>
									</div>
									<div class="row row-cols-2 row-cols-lg-3">
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-10">
													<div class="col">
														<h4>E</h4>
													</div>
													<div class="col">
														<h4>x</h4>
													</div>
													<div class="col">
														<h4>c</h4>
													</div>
													<div class="col">
														<h4>e</h4>
													</div>
													<div class="col">
														<h4>l</h4>
													</div>
													<div class="col">
														<h4>l</h4>
													</div>
													<div class="col col-4">
														<input type="text" id="input-actp311" class="form-control">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row rows-cols-4">
													<div class="col">
														<h4>Very</h4>
													</div>
													<div class="col">
														<input type="text" id="input-actp312" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-5">
													<div class="col">
														<h4>G</h4>
													</div>
													<div class="col">
														<h4>o</h4>
													</div>
													<div class="col ">
														<input type="text" id="input-actp313" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col col-4">
														<h4>!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row row-cols-4">
													<div class="col">
														<input type="text" id="input-actp314" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>done</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-lg-8">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row">
													<div class="col">
														<input type="text" id="input-actp315" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Right!</h4>
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark col-6">
											<!-- inicio group -->
											<div class="input-group input-group-sm mb-3">
												<div class="row">
													<div class="col">
														<input type="text" id="input-actp316" class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm">
													</div>
													<div class="col">
														<h4>Job!</h4>
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

<div id="ModalLibroTreintaydos" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points32" name="points32">
											<input type="text" class="d-none" id="idcliente32" name="idcliente32">
											<input type="text" class="d-none" id="idlibro32" name="idlibro32">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-61" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-62" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-63" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-64" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-65" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-66" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-67" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-68" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-69" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo32-610" class="form-control"
													aria-label="Sizing example input" maxlength="100">
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
							<button type="submit" class="btn waves-effect blue tooltipped"
								data-tooltip="Guardar">Submit</button>
							<br>
						</div>
					</div>
			</form>
		</div>
	</div>
</div>
</div>

<div id="ModalLibroTreintaytres" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the words</h5>
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
											<p class="fs-1 fw-bold">Complete the activity</p>
											<input type="text" class="d-none" id="points33" name="points33">
											<input type="text" class="d-none" id="idcliente33" name="idcliente33">
											<input type="text" class="d-none" id="idlibro33" name="idlibro33">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo33-71" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo33-72" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo33-73" class="form-control"
													aria-label="Sizing example input" maxlength="100">
											</div>
										</div>
										<div class="col">
											<div class="col">
												<input type="text" id="food-actyo33-74" class="form-control"
													aria-label="Sizing example input" maxlength="100">
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
Book_Page::footerTemplate('juego1.js');
?>