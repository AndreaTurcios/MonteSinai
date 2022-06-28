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
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/1.jpg" width="76" height="100"
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

			pages: 60,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunocuartogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!--inicio modales -->


<div id="ModalUnit1Act1" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the words:</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-3">
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- garage -->
													<div class="col">G</div>
													<div>
														<input type="text" id="input-act1-1"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-2"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-3"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-4"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">e</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Garden -->
													<div class="col">G</div>
													<div class="col">
														<input type="text" id="input-act1-5"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">r</div>
													<div>
														<input type="text" id="input-act1-6"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-7"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-8"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Bedroom -->
													<div class="col">B</div>
													<div class="col">
														<input type="text" id="input-act1-9"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-10"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-11"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-12"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">o</div>
													<div class="col">m</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Living room -->
													<div class="col">L</div>
													<div class="col">
														<input type="text" id="input-act1-13"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-14"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-15"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-16"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-17"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-18"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-19"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-20"
															class="form-control"
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
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Bathroom -->
													<div class="col">B</div>
													<div class="col">
														<input type="text" id="input-act1-21"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-22"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-23"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">r</div>
													<div class="col">
														<input type="text" id="input-act1-24"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-25"
															class="form-control"
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
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Yard -->
													<div class="col">Y</div>
													<div class="col">
														<input type="text" id="input-act1-26"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-27"
															class="form-control"
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
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Hall -->
													<div class="col">H</div>
													<div class="col">
														<input type="text" id="input-act1-28"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">l</div>
													<div class="col">
														<input type="text" id="input-act1-29"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Dining room -->
													<div class="col">D</div>
													<div class="col">
														<input type="text" id="input-act1-30"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-31"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-32"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-33"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-34"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div>r</div>
													<div class="col">
														<input type="text" id="input-act1-35"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-36"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div>m</div>
												</div>
											</div>
											<!-- fin group -->
										</div>
										<div class="col border border-dark">
											<!-- inicio group -->
											<div class="input-group d-flex mb-3">
												<div class="row row-cols-6">
													<!-- Kitchen -->
													<div class="col">K</div>
													<div class="col">
														<input type="text" id="input-act1-37"
															class=" form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-38"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-39"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div class="col">
														<input type="text" id="input-act1-40"
															class="form-control"
															aria-label="Sizing example input"
															aria-describedby="inputGroup-sizing-sm" maxlength="1"
															autocomplete="off">
													</div>
													<div>e</div>
													<div>n</div>
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

<div class="modal fade" id="ModalUnit1Act2" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col align-items-center">
											<p class="fs-3 fw-bold">Select the correct translation</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p class="text-justify">
											This is a pretty house. <br>
											It has a <b>garage</b> for three cars. On outdoor is painted with pink color and has a 
											beautiful <b>garden</b> in the front yard. The <b>backyard</b> is beautiful too in there is another
											garden.
											</p>
										</div>
										<div class="col">
											<p class="text-justify" style="display: inline;">
											Esta es una casa bonita. <br>
											Tiene una </p> 
												<select id="select-act2-1" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">cocina</option>
													<option value="2">cochera</option>
													<option value="3">baño</option>
												</select>
											<p style="display: inline;" class="text-justify"> para tres autos. Por fuera está pintada de color rosado y tiene
											un </p>
												<select id="select-act2-2" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Choose</option>
													<option value="1">baño</option>
													<option value="2">cuarto</option>
													<option value="3">jardín</option>
												</select>
											<p style="display: inline;" class="text-justify"> hermoso en el patio delantero. El </p> 
												<select id="select-act2-3" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Choose</option>
													<option value="1">patio trasero</option>
													<option value="2">sala de estar</option>
													<option value="3">comedor</option>
												</select>
											<p style="display: inline;" class="text-justify">también es hermoso, ahí hay otro jardín.</p>
											<br>
											<br>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p class="text-justify">
												Inside the house there are three <b>bedrooms</b> in each one, there is a bed, windows,
												night table and chair.
											</p>
										</div>
										<div class="col">
											
											<p class="text-justify" style="display: inline;"> Dentro de la casa hay tres </p>
												<select id="select-act2-4" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Choose</option>
													<option value="1">pasillos</option>
													<option value="2">dormitorios</option>
													<option value="3">cocheras</option>
												</select>
											<p class="text-justify" style="display: inline;">, en cada uno hay una cama, ventanas, mesa de noche y una silla.
											</p>
											<br>
											<br>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p class="text-justify">
												The <b>kitchen</b> has, in there a white refrigerator, a brown stove with pots over the 
												burners, there is a table with three chairs around.
											</p>
										</div>
										<div class="col">
											<p class="text-justify" style="display: inline;">La </p>
												<select id="select-act2-5" class="form-select" style="width:auto; display: inline-block;" >
													<option selected disabled class="text-muted" style="color: white;" value="0">Choose</option>
													<option value="1">sala de estar</option>
													<option value="2">habitación</option>
													<option value="3">cocina</option>
												</select>
											<p class="text-justify" style="display: inline;">
												 tiene un refrigerador blanco, una estufa café con ollas sobre los 
												quemadores, hay una mesa con tres sillas alrededor.
											</p>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p class="text-justify">
												The <b>living room</b> is very elegant and has a wonderful chimney, a big window with 
												beautiful curtains the living room color is white, in there, are a arm chair, two sofas and
												a center table over the living room's floor is a white carpet.
											</p>
										</div>
										<div class="col">
											<p class="text-justify" style="display: inline;">La </p>
												<select id="select-act2-6" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Choose</option>
													<option value="1">sala de estar</option>
													<option value="2">cocina</option>
													<option value="3">cochera</option>
												</select> 
											<p class="text-justify" style="display: inline;">es muy elegante y tiene una chimenea maravillosa, una gran ventana con
												cortunas hermosas, el color de la sala es blanco, ahí hay un sillón, dos sofás y
												una mesa de centro, sobre el suelo de la sala de estar hay una alformbra blanca.
											</p>
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
<div id="ModalUnit1Act3" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Describing and drawing your house</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-3 fw-bold">Draw your house and answer the questions</p>
											<!-- class="d-none" -->
											<input type="text" id="points3" name="points" class="d-none">
											<input type="text" id="idcliente3" name="idcliente" class="d-none">
											<input type="text" id="idlibro3" name="idlibro" class="d-none">
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
										padding-top: 15px;
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

										#canvas2 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clear2Btn {
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
										<div class="grid ">
											<div class="color">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="color2Picker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="stroke2WidthPicker">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clear2Btn">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas2" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitOne/activities/16(1).jpg')"
											width="500" height="470">

											</canvas>
										</div>
									</header>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">How is your house?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-1" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">What color are the walls?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-2" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">It has a garden?, How is the garden?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-3" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">How many bedroom has your house?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-4" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">How are the bedrooms?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-5" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">Is there a bed in each bedroom?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-6" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">What color is the bedroom?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-7" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">Are there furniture in the living room? What color?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-8" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">Is there a bathroom in the bedroom?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-9" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">Is there a dining room? how is it?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-10" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">How many cars can you put at the garage?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-11" placeholder="Your answer">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<p class="text-end fs-5">Do you like your house?</p>
											</div>
											<div class="col">
												<input type="text" class="form-control" id="input-act3-12" placeholder="Your answer">
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

<div class="modal fade" id="ModalUnit1Act4" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col align-items-center">
											<p class="fs-3 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/17-1.jpg" alt="HouseA" class="img-fluid">
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Is there a sofa in the living room</p>
											<select id="select-act4-1" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Yes, there is.</option>
												<option value="2">Yes, there are.</option>
												<option value="3">No, there isn't.</option>
												<option value="4">No, there aren't.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Is there a green kitchen in the house?</p>
											<select id="select-act4-2" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Yes, there is.</option>
												<option value="2">Yes, there are.</option>
												<option value="3">No, there isn't.</option>
												<option value="4">No, there aren't.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Are there blue curtains in the house?</p>
											<select id="select-act4-3" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Yes, there is.</option>
												<option value="2">Yes, there are.</option>
												<option value="3">No, there isn't.</option>
												<option value="4">No, there aren't.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Are there brown pants?</p>
											<select id="select-act4-4" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Yes, there is.</option>
												<option value="2">Yes, there are.</option>
												<option value="3">No, there isn't.</option>
												<option value="4">No, there aren't.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Are there green books?</p>
											<select id="select-act4-5" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Yes, there is.</option>
												<option value="2">Yes, there are.</option>
												<option value="3">No, there isn't.</option>
												<option value="4">No, there aren't.</option>
											</select>
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


<!-- fin modales-->

+
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro4.js');
?>
