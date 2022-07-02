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
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/17-1.jpg" alt="HouseA" class="img-fluid">
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">Is there a sofa in the living room?</p>
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

<div class="modal fade" id="ModalUnit1Act5" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col align-items-center">
											<p class="fs-3 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/17-2.jpg" alt="HouseB" class="img-fluid">
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a white kitchen.</p>
											<select id="select-act5-1" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there a kitchen in the house?</option>
												<option value="2">Are there a kitchen in the house?</option>
												<option value="3">There is a kitchen in the house?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a pink living room.</p>
											<select id="select-act5-2" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There are a living room in the house?</option>
												<option value="2">Is there a pink living room in the house?</option>
												<option value="3">Are there a pink living room in the house?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a blue bedroom.</p>
											<select id="select-act5-3" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there a blue bedroom in the house?</option>
												<option value="2">Are there a blue bedroom in the house?</option>
												<option value="3">There is a blue bedroom in the house?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a small yard.</p>
											<select id="select-act5-4" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There a yard in the house?</option>
												<option value="2">Are there a yard in the house?</option>
												<option value="3">Is there a yard in the house?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a green sofa.</p>
											<select id="select-act5-5" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there a green sofa in the living room?</option>
												<option value="2">Are there a green sofa in the living room?</option>
												<option value="3">There is a sofa in the living room?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a broadcasting station.</p>
											<select id="select-act5-6" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there a broadcasting station?</option>
												<option value="2">There are a broadcasting station</option>
												<option value="3">Are there a broadcasting station?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a blue dress.</p>
											<select id="select-act5-7" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There are a blue dress in the house?</option>
												<option value="2">Are there a blue dress in the house?</option>
												<option value="3">Is there a blue dress in the house?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There are brown pants.</p>
											<select id="select-act5-8" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there brown pants?</option>
												<option value="2">Are there brown pants?</option>
												<option value="3">There are brown pants?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a white shirt.</p>
											<select id="select-act5-9" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">Is there a white shirt?</option>
												<option value="2">Are there a white shirt?</option>
												<option value="3">There is a white shirt?</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p style="display: inline;">There is a daughter in the living room.</p>
											<select id="select-act5-10" class="form-select" style="width:auto; display: inline-block;" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There are someone in the living room?</option>
												<option value="2">Are there someone in the living room?</option>
												<option value="3">Is there someone in the living room?</option>
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

<div class="modal fade" id="ModalUnit1Act6" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col align-items-center">
											<p class="fs-3 fw-bold">Answer the questions</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/19.jpg" alt="Family members" class="img-fluid">
									</div>
									<div class="row row-cols-2 mb-3">
										<div class="col">
											<div class="row">
												<p>Where is René?</p>
											</div>
											<div class="row pe-5">
												<input type="text" disabled class="form-control" value="He is at the garage.">
											</div>
										</div>
										<div class="col">
											<div class="row">
												<p>Where is Katherine?</p>
											</div>
											<div class="row pe-5">
												<input type="text" class="form-control" id="input-act6-1" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row row-cols-2 mb-3">
										<div class="col">
											<div class="row">
												<p>Where is Yaely?</p>
											</div>
											<div class="row pe-5">
												<input type="text" class="form-control" id="input-act6-2" autocomplete="off">
											</div>
										</div>
										<div class="col">
											<div class="row">
												<p>Where is the friend?</p>
											</div>
											<div class="row pe-5">
												<input type="text" class="form-control" id="input-act6-3" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row row-cols-2 mb-3">
										<div class="col">
											<div class="row">
												<p>Where is mommy?</p>
											</div>
											<div class="row pe-5">
												<input type="text" class="form-control" id="input-act6-4" autocomplete="off">
											</div>
										</div>
										<div class="col">
											<div class="row">
												<p>Where is Francisco?</p>
											</div>
											<div class="row pe-5">
												<input type="text" class="form-control" id="input-act6-5" autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act7" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write questions and an answer using: What can I do ...? - I can...</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>What can I do in the garden?</p>
										</div>
										<div class="col">
											<p>I can play in the garden</p>
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-1" placeholder="Write a question">
										</div>
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-2" placeholder="Write an answer">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-3" placeholder="Write a question">
										</div>
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-4" placeholder="Write an answer">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-5" placeholder="Write a question">
										</div>
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-6" placeholder="Write an answer">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-7" placeholder="Write a question">
										</div>
										<div class="col">
											<input type="text" autocomplete="off" class="form-control" id="input-act7-8" placeholder="Write an answer">
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

<div class="modal fade" id="ModalUnit1Act8" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the pictures and answer dragging the adjectives</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/21.jpg" alt="Family members" class="img-fluid">
									</div>
									<div class="container-act8">
										<div id="option-act8-1" class="box-act8 text-center m-3" draggable="true" data-id="small">
											small
										</div>
										<div id="option-act8-2" class="box-act8 text-center m-3" draggable="true" data-id="large">
											large
										</div>
										<div id="option-act8-3" class="box-act8 text-center m-3" draggable="true" data-id="big">
											big
										</div>
										<div id="option-act8-4" class="box-act8 text-center m-3" draggable="true" data-id="beautiful">
											beautiful
										</div>
									</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>1. How is the house A?</p>
												<div id="text-act8-1" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>2. How is the house B?</p>
												<div id="text-act8-2" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>3. How is the wall of the house A?</p>
												<div id="text-act8-3" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>4. How is the wall of the house B?</p>
												<div id="text-act8-4" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>5. How is the furniture of the house A?</p>
												<div id="text-act8-5" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>6. How is the furniture of the house B?</p>
												<div id="text-act8-6" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>7. How is the kitchen of the house A?</p>
												<div id="text-act8-7" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>8. How is the kitchen of the house B?</p>
												<div id="text-act8-8" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>9. How is your house?</p>
												<div id="text-act8-9" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>10. How is your living house?</p>
												<div id="text-act8-10" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>11. How is your bedroom?</p>
												<div id="text-act8-11" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>12. How is your furniture?</p>
												<div id="text-act8-12" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>13. How is your garden?</p>
												<div id="text-act8-13" class="box-act8 text-center"></div>
											</div>
											<div class="col"></div>
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

<div class="modal fade" id="ModalUnit1Act9" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the illustration of house A, and answer dragging the color.</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/17-1.jpg" alt="House A" class="img-fluid">
									</div>
									<div class="container-act8 mb-2" style="background-color: white;">
										<div id="option-act9-1" class="box-act8 text-center m-3" draggable="true" data-id="Red" style="background-color: #FF8A8A;">
											Red
										</div>
										<div id="option-act9-2" class="box-act8 text-center m-3" draggable="true" data-id="Brown" style="background-color: #BD8A68;">
											Brown
										</div>
										<div id="option-act9-3" class="box-act8 text-center m-3" draggable="true" data-id="Black" style="background-color: #454545; color: white;">
											Black
										</div>
										<div id="option-act9-4" class="box-act8 text-center m-3" draggable="true" data-id="Orange" style="background-color: #FFB482;">
											Orange
										</div>
										<div id="option-act9-5" class="box-act8 text-center m-3" draggable="true" data-id="Blue" style="background-color: #82A5FF;">
											Blue
										</div>
										<div id="option-act9-6" class="box-act8 text-center m-3" draggable="true" data-id="Green" style="background-color: #A6FF9E;">
											Green
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<p>What color is the living room?</p>
											<div id="text-act9-1" class="box-act8 text-center"></div>
										</div>
										<div class="col">
											<p>What color is the sofa?</p>
											<div id="text-act9-2" class="box-act8 text-center"></div>
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<p>What color is the kitchen?</p>
											<div id="text-act9-3" class="box-act8 text-center"></div>
										</div>
										<div class="col">
											<p>What color are the curtains?</p>
											<div id="text-act9-4" class="box-act8 text-center"></div>
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

<div class="modal fade" id="ModalUnit1Act10" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the illustration of house B, and answer dragging the color.</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/17-2.jpg" alt="House B" class="img-fluid">
									</div>
									<div class="container-act8 mb-2" style="background-color: white;">
										<div id="option-act10-1" class="box-act8 text-center m-3" draggable="true" data-id="Red" style="background-color: #FF8A8A;">
											Red
										</div>
										<div id="option-act10-2" class="box-act8 text-center m-3" draggable="true" data-id="Brown" style="background-color: #BD8A68;">
											Brown
										</div>
										<div id="option-act10-3" class="box-act8 text-center m-3" draggable="true" data-id="Black" style="background-color: #454545; color: white;">
											Black
										</div>
										<div id="option-act10-4" class="box-act8 text-center m-3" draggable="true" data-id="Orange" style="background-color: #FFB482;">
											Orange
										</div>
										<div id="option-act10-5" class="box-act8 text-center m-3" draggable="true" data-id="Blue" style="background-color: #82A5FF;">
											Blue
										</div>
										<div id="option-act10-6" class="box-act8 text-center m-3" draggable="true" data-id="Green" style="background-color: #A6FF9E;">
											Green
										</div>
										<div id="option-act10-7" class="box-act8 text-center m-3" draggable="true" data-id="Green" style="background-color: white">
											White
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<p>What color is the kitchen?</p>
											<div id="text-act10-1" class="box-act8 text-center"></div>
										</div>
										<div class="col">
											<p>Whar color is the living room?</p>
											<div id="text-act10-2" class="box-act8 text-center"></div>
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<p>What color is the bedroom?</p>
											<div id="text-act10-3" class="box-act8 text-center"></div>
										</div>
										<div class="col">
											<p>What color is the sofa?</p>
											<div id="text-act10-4" class="box-act8 text-center"></div>
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

<div class="modal fade" id="ModalUnit1Act11" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act11">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the color</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2" >
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: red; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-1" placeholder="Write the name of the color">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: orange; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-2" placeholder="Write the name of the color">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2" >
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: brown; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-3" placeholder="Write the name of the color">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: blue; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-4" placeholder="Write the name of the color">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2" >
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: black; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-5" placeholder="Write the name of the color">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2" style="border-radius:100%; background-color: green; height:30px; width: 35px;"></div>
												<div style="display: inline-block;" class="col-10">
													<input  type="text" autocomplete="off" class="form-control" id="input-act11-6" placeholder="Write the name of the color">
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

<div class="modal fade" id="ModalUnit1Act12" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using <b>this</b>, <b>that.</b></p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-1" placeholder="This..." autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-2" placeholder="That..." autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-3" placeholder="This..." autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-4" placeholder="That..." autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-5" placeholder="This..." autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act12-6" placeholder="That..." autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act13" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using <b>this</b>, <b>that.</b></p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act13-1" placeholder="Write a sentence using in...">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act13-2" placeholder="Write a sentence using in...">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act13-3" placeholder="Write a sentence using in...">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act13-4" placeholder="Write a sentence using in...">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<input type="text" class="form-control mb-3" id="input-act13-5" placeholder="Write a sentence using in...">
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

<div class="modal fade" id="ModalUnit1Act14" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the answers to the riddles</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-4" style="position: relative;">
											<div style="position: absolute; bottom: 0;">
												<p> <b>Answer:</b></p>
												<input type="text" class="form-control mb-3 align-bottom" id="input-act14-1" placeholder="Write your answer." autocomplete="off">
											</div>
										</div>
										<div class="col-8">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/25-1.jpg" class="img-fluid" alt="">
										</div>
									</div>
									<div class="row">
										<div class="col-8">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/25-2.jpg" class="img-fluid" alt="">
										</div>
										<div class="col-4" style="position: relative;">
											<div style="position: absolute; bottom: 40%;">
												<p> <b>Answer:</b></p>
												<input type="text" class="form-control mb-3 align-bottom" id="input-act14-2" placeholder="Write your answer." autocomplete="off">
											</div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-4" style="position: relative;">
											<div style="position: absolute; bottom: 0;">
												<p> <b>Answer:</b></p>
												<input type="text" class="form-control mb-3 align-bottom" id="input-act14-3" placeholder="Write your answer." autocomplete="off">
											</div>
										</div>
										<div class="col-8">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/25-3.jpg" class="img-fluid" alt="">
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

<div class="modal fade" id="ModalUnit1Act15" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act15">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing letters and match the images</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<!-- bedroom -->
											<table>
													<tr>
														<td class="col-1 text-center">B</td>
														<td><input type="text" id="input-act15-1"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-2"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-3"
															class=" form-control" maxlength="1"
															autocomplete="off"></td>
														<td><input type="text" id="input-act15-4"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-5"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">m</td>
													</tr>
												</table>
										</div>
										<div class="col ps-5" id="box-act15-1">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/26-1.jpg" alt="Kitchen" id="img-act15-1">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<!-- Sofa -->
											<table>
													<tr>
														<td class="col-1"><input type="text" id="input-act15-6"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">o</td>
														<td class="col-1"><input type="text" id="input-act15-7"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">a</td>
													</tr>
												</table>
										</div>
										<div class="col ps-5" id="box-act15-2">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/26-2.jpg" alt="Yard" id="img-act15-2">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<!-- kitchen -->
											<table>
													<tr>
														<td class="col-1 text-center">K</td>
														<td><input type="text" id="input-act15-8"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-9"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-10"
															class=" form-control" maxlength="1"
															autocomplete="off"></td>
														<td><input type="text" id="input-act15-11"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-12"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">n</td>
													</tr>
												</table>
										</div>
										<div class="col ps-5" id="box-act15-3">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/26-3.jpg" alt="Living room" id="img-act15-3">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<!-- yard -->
											<table>
													<tr>
														<td class="col-1 text-center">Y</td>
														<td class="col-1"><input type="text" id="input-act15-13"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1"><input type="text" id="input-act15-14"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">d</td>
													</tr>
												</table>
										</div>
										<div class="col ps-5" id="box-act15-4">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/26-4.jpg" alt="Sofa" id="img-act15-4">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<!-- Livingroom -->
											<table>
													<tr>
														<td class="col-1 text-center">L</td>
														<td><input type="text" id="input-act15-15"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-16"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-17"
															class=" form-control" maxlength="1"
															autocomplete="off"></td>
														<td><input type="text" id="input-act15-18"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td>g</td>
														<td><input type="text" id="input-act15-19"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td><input type="text" id="input-act15-20"
															class=" form-control" maxlength="1"
															autocomplete="off"></td>
														<td><input type="text" id="input-act15-21"
															class=" form-control" maxlength="1"
															autocomplete="off" ></td>
														<td class="col-1 text-center">m</td>
													</tr>
												</table>
										</div>
										<div class="col ps-5" id="box-act15-5">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/26-5.jpg" alt="Bedroom" id="img-act15-5">
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

<div class="modal fade" id="ModalUnit1Act16" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using each verb</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Eat</p>
											<input type="text" class="form-control mb-3" id="input-act16-1" placeholder='Write a setence using "eat"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Wash</p>
											<input type="text" class="form-control mb-3" id="input-act16-2" placeholder='Write a setence using "wash"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Sleep</p>
											<input type="text" class="form-control mb-3" id="input-act16-3" placeholder='Write a setence using "sleep"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Sit down</p>
											<input type="text" class="form-control mb-3" id="input-act16-4" placeholder='Write a setence using "sit down"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Take a shower</p>
											<input type="text" class="form-control mb-3" id="input-act16-5" placeholder='Write a setence using "take a shower"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Study</p>
											<input type="text" class="form-control mb-3" id="input-act16-6" placeholder='Write a setence using "study"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Play</p>
											<input type="text" class="form-control mb-3" id="input-act16-7" placeholder='Write a setence using "play"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Talk</p>
											<input type="text" class="form-control mb-3" id="input-act16-8" placeholder='Write a setence using "talk"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Read</p>
											<input type="text" class="form-control mb-3" id="input-act16-9" placeholder='Write a setence using "read"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Run</p>
											<input type="text" class="form-control mb-3" id="input-act16-10" placeholder='Write a setence using "run"...' autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act17" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act17">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using possessive adjectives</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>my</p>
											<input type="text" class="form-control mb-3" id="input-act17-1" placeholder='Write a setence using "my"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>my</p>
											<input type="text" class="form-control mb-3" id="input-act17-2" placeholder='Write a setence using "my"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>your</p>
											<input type="text" class="form-control mb-3" id="input-act17-3" placeholder='Write a setence using "your"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>your</p>
											<input type="text" class="form-control mb-3" id="input-act17-4" placeholder='Write a setence using "your"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>his</p>
											<input type="text" class="form-control mb-3" id="input-act17-5" placeholder='Write a setence using "his"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>his</p>
											<input type="text" class="form-control mb-3" id="input-act17-6" placeholder='Write a setence using "his"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>her</p>
											<input type="text" class="form-control mb-3" id="input-act17-7" placeholder='Write a setence using "her"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>her</p>
											<input type="text" class="form-control mb-3" id="input-act17-8" placeholder='Write a setence using "her"...' autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act18" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table class="table table-striped">
												<tr class="mb-2" >
													<td class=" text-center"> one </td>
													<td>&nbsp;</td>
													<td class="text-center"> 1</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-1"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
														<td>&nbsp;</td>
													<td class=" text-center">19</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">twenty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-2"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center"> 2 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> eighteen</td>
													<td>&nbsp;</td>
													<td class=" text-center">18</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">twenty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">three </td>
													<td>&nbsp;</td>
													<td class="text-center"> 3</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">seventeen</td>
													<td>&nbsp;</td>
													<td class="text-center"> 17 </td>
													<td>&nbsp;</td>
													<td class="text-center">=</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-3"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-4"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">4 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> sixteen</td>
													<td>&nbsp;</td>
													<td class=" text-center">16</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">five </td>
													<td>&nbsp;</td>
													<td class="text-center"> 5</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-5"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">15</td>
													<td>&nbsp;</td>
													
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-6"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">6 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> fourteen</td>
													<td>&nbsp;</td>
													<td class=" text-center">14</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">seven </td>
													<td>&nbsp;</td>
													<td class="text-center"> 7</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">thirteen</td>
													<td>&nbsp;</td>
													<td class="text-center"> 13 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-7"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">eight </td>
													<td>&nbsp;</td>
													<td class="text-center"> 8</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">twelve</td>
													<td>&nbsp;</td>
													<td class="text-center"> 12 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-8"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">nine </td>
													<td>&nbsp;</td>
													<td class="text-center"> 9</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-9"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">11</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">ten </td>
													<td>&nbsp;</td>
													<td class="text-center"> 10</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">ten</td>
													<td>&nbsp;</td>
													<td class="text-center"> 10 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-10"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-11"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">11 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> nine</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">9</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twelve </td>
													<td>&nbsp;</td>
													<td class="text-center"> 12</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-12"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">8</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-13"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">13 </td>
													<td>&nbsp;</td>
													<td class="text-center">+</td>
													<td>&nbsp;</td>
													<td class="text-center"> seven</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">7</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">fourteen </td>
													<td>&nbsp;</td>
													<td class="text-center"> 14</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">six</td>
													<td>&nbsp;</td>
													<td class="text-center"> 6 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-14"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-15"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">15 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> five</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">5</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">sixteen </td>
													<td>&nbsp;</td>
													<td class="text-center"> 16</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-16"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">4</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-17"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">17 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> three</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">3</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">eighteen </td>
													<td>&nbsp;</td>
													<td class="text-center"> 18</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-18"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">2</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act18-19"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">19 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> one</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">1</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">nineteen </td>
													<td>&nbsp;</td>
													<td class="text-center"> 19</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act18-20"
														class=" form-control" maxlength="9"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">0</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> twenty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 20</td>
												</tr>
											</table>
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

<div class="modal fade" id="ModalUnit1Act19" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col align-items-center">
											<p class="fs-3 fw-bold">Select the correct use of how much, how many, there is and there are</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<select id="select-act19-1" class="form-select" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">How much water is there?</option>
												<option value="2">How many water is there?</option>
												<option value="3">There is many water.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<select id="select-act19-2" class="form-select" >
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There are many water.</option>
												<option value="2">There is much water.</option>
												<option value="3">There is many water.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<select id="select-act19-3" class="form-select">
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">How many oranges are there?</option>
												<option value="2">How much orange is there?</option>
												<option value="3">There is much orange.</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<select id="select-act19-4" class="form-select">
												<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
												<option value="1">There are much oranges.</option>
												<option value="2">There is three oranges.</option>
												<option value="3">There are three oranges.</option>
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

<div id="ModalUnit1Act20" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Identifying the family members</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act20">
				<div class="modal-body">
					<div class="" style="overflow-y:auto;">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-3 fw-bold">Draw each one of your family members</p>
											<!-- class="d-none" -->
											<input type="text" id="points20" name="points" class="d-none">
											<input type="text" id="idcliente20" name="idcliente" class="d-none">
											<input type="text" id="idlibro20" name="idlibro" class="d-none">
											<input type="number" value="0" id="verify-canvas20" class="d-none">
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

										.canvas-act20 {
										background-color: #F8F8F8;
										border: 1px solid black;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clear20Btn {
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
													<input type="color" id="color20Picker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="stroke20WidthPicker">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clear20Btn">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas20" class="d-none">
											<canvas id="canvas20" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitOne/activities/31.jpg')"
											width="361" height="621" >

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

<div class="modal fade" id="ModalUnit1Act21" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act21">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using each member of your family</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Father</p>
											<input type="text" class="form-control mb-3" id="input-act21-1" placeholder='Write a setence using "father"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Mother</p>
											<input type="text" class="form-control mb-3" id="input-act21-2" placeholder='Write a setence using "mother"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Sister</p>
											<input type="text" class="form-control mb-3" id="input-act21-3" placeholder='Write a setence using "sister"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Brother</p>
											<input type="text" class="form-control mb-3" id="input-act21-4" placeholder='Write a setence using "brother"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Grandfather</p>
											<input type="text" class="form-control mb-3" id="input-act21-5" placeholder='Write a setence using "grandfather"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Grandmother</p>
											<input type="text" class="form-control mb-3" id="input-act21-6" placeholder='Write a setence using "grandmother"...' autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>Baby</p>
											<input type="text" class="form-control mb-3" id="input-act21-7" placeholder='Write a setence using "baby"...' autocomplete="off">
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

<div id="ModalUnit1Act22" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">FIND THE WORDS ABOUT OUR BODY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act22">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-1" onclick="checkCells('act21-1', 'red')">O</th><!-- ONE, TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-2" onclick="checkCells('act21-2', 'red')">N</th><!-- ONE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-3" onclick="checkCells('act21-3', 'red')">E</th><!-- ONE -->
                                            <th class="text-center cell-act21" width="30" height="30">J</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-4" onclick="checkCells('act21-4', 'green')">E</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-5" onclick="checkCells('act21-5', 'darkblue')">T</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-6" onclick="checkCells('act21-6', 'fuchsia')">F</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-7" onclick="checkCells('act21-7', 'olive')">T</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-8" onclick="checkCells('act21-8', 'blue')">W</th><!-- TWO -->
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-9" onclick="checkCells('act21-9', 'green')">L</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">V</th>
                                            <th class="text-center cell-act21" width="30" height="30"  id="act21-10" onclick="checkCells('act21-10', 'silver')">N</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-11" onclick="checkCells('act21-11', 'darkblue')">W</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-12" onclick="checkCells('act21-12', 'fuchsia')">O</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-13" onclick="checkCells('act21-13', 'blue')">S</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-14" onclick="checkCells('act21-14', 'olive')">H</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-15" onclick="checkCells('act21-15', 'teal')">T</th><!-- THREE, TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-16" onclick="checkCells('act21-16', 'teal')">H</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-17" onclick="checkCells('act21-17', 'teal')">R</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-18" onclick="checkCells('act21-18', 'teal')">E</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-19" onclick="checkCells('act21-19', 'green')">E</th><!-- ELEVEN, THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-20" onclick="checkCells('act21-20', 'maroon')">N</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-21" onclick="checkCells('act21-21', 'silver')">E</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-22" onclick="checkCells('act21-22', 'indigo')">E</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-23" onclick="checkCells('act21-23', 'darkblue')">E</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-24" onclick="checkCells('act21-24', 'fuchsia')">U</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-25" onclick="checkCells('act21-25', 'blue')">E</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-26" onclick="checkCells('act21-26', 'olive')">I</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-27" onclick="checkCells('act21-27', 'yellowGreen')">Y</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-28" onclick="checkCells('act21-28', 'red')">F</th><!-- FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-29" onclick="checkCells('act21-29', 'red')">I</th><!-- FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-30" onclick="checkCells('act21-30', 'green')">V</th><!-- ELEVEN, FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-31" onclick="checkCells('act21-31', 'red')">E</th><!-- FIVE, EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-32" onclick="checkCells('act21-32', 'silver')">E</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-33" onclick="checkCells('act21-33', 'indigo')">I</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-34" onclick="checkCells('act21-34', 'darkblue')">L</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-35" onclick="checkCells('act21-35', 'fuchsia')">R</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-36" onclick="checkCells('act21-36', 'blue')">V</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-37" onclick="checkCells('act21-37', 'olive')">R</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-38" onclick="checkCells('act21-38', 'yellowGreen')">T</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-39" onclick="checkCells('act21-39', 'green')">E</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-40" onclick="checkCells('act21-40', 'maroon')">E</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-41" onclick="checkCells('act21-41', 'silver')">T</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-42" onclick="checkCells('act21-42', 'indigo')">G</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-43" onclick="checkCells('act21-43', 'darkblue')">V</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-44" onclick="checkCells('act21-44', 'blue')">E</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-45" onclick="checkCells('act21-45', 'olive')">T</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-46" onclick="checkCells('act21-46', 'cadetBlue')">N</th><!-- NINE, TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-47" onclick="checkCells('act21-47', 'cadetBlue')">I</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-48" onclick="checkCells('act21-48', 'cadetBlue')">N</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-49" onclick="checkCells('act21-49', 'cadetBlue')">E</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-50" onclick="checkCells('act21-50', 'green')">N</th><!-- ELEVEN, SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-51" onclick="checkCells('act21-51', 'maroon')">T</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-52" onclick="checkCells('act21-52', 'silver')">F</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-53" onclick="checkCells('act21-53', 'indigo')">H</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-54" onclick="checkCells('act21-54', 'darkblue')">E</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-55" onclick="checkCells('act21-55', 'blue')">N</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-56" onclick="checkCells('act21-56', 'olive')">E</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-57" onclick="checkCells('act21-57', 'yellowGreen')">E</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-58" onclick="checkCells('act21-58', 'darkGray')">E</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">Q</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-59" onclick="checkCells('act21-59', 'maroon')">H</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-60" onclick="checkCells('act21-60', 'silver')">I</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-61" onclick="checkCells('act21-61', 'blue')">T</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-62" onclick="checkCells('act21-62', 'blue')">E</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-63" onclick="checkCells('act21-63', 'blue')">N</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-64" onclick="checkCells('act21-64', 'blue')">T</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-65" onclick="checkCells('act21-65', 'olive')">E</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-66" onclick="checkCells('act21-66', 'yellowGreen')">W</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-67" onclick="checkCells('act21-67', 'darkGray')">V</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-68" onclick="checkCells('act21-68', 'turquoise')">X</th><!-- SIX -->
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-69" onclick="checkCells('act21-69', 'maroon')">G</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-70" onclick="checkCells('act21-70', 'fuchsia')">F</th><!-- FIFTEEN, FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-71" onclick="checkCells('act21-71', 'fuchsia')">O</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-72" onclick="checkCells('act21-72', 'fuchsia')">U</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-73" onclick="checkCells('act21-73', 'fuchsia')">R</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-74" onclick="checkCells('act21-74', 'fuchsia')">T</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-75" onclick="checkCells('act21-75', 'fuchsia')">E</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-76" onclick="checkCells('act21-76', 'blue')">E</th><!-- FOURTEEN, SEVENTEEN-->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-77" onclick="checkCells('act21-77', 'olive')">N</th><!-- THIRTEEN, FOURTEEN -->
                                        </tr>
										<tr><!-- ROW NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-78" onclick="checkCells('act21-78', 'yellowGreen')">T</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-79" onclick="checkCells('act21-79', 'darkGray')">E</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-80" onclick="checkCells('act21-80', 'turquoise')">I</th><!-- SIX -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-81" onclick="checkCells('act21-81', 'maroon')">I</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-82" onclick="checkCells('act21-82', 'green')">N</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-83" onclick="checkCells('act21-83', 'green')">I</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-84" onclick="checkCells('act21-84', 'green')">N</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-85" onclick="checkCells('act21-85', 'green')">E</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-86" onclick="checkCells('act21-86', 'green')">T</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-87" onclick="checkCells('act21-87', 'green')">E</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-88" onclick="checkCells('act21-88', 'olive')">E</th><!-- NINETEEN, SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-89" onclick="checkCells('act21-89', 'green')">N</th><!-- NINETEEN -->
                                        </tr>
										<tr><!-- ROW TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-90" onclick="checkCells('act21-90', 'darkGray')">S</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-91" onclick="checkCells('act21-91', 'turquoise')">S</th><!-- SIXTEEN, SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-92" onclick="checkCells('act21-92', 'red')">I</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-93" onclick="checkCells('act21-93', 'red')">X</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-94" onclick="checkCells('act21-94', 'red')">T</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-95" onclick="checkCells('act21-95', 'indigo')">E</th><!-- SIXTEEN, eight -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-96" onclick="checkCells('act21-96', 'red')">E</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-97" onclick="checkCells('act21-97', 'red')">N</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">U</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-98" onclick="checkCells('act21-98', 'blue')">N</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                        </tr>
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
	<script  src="../../app/controllers/BookTwoUnitOne/wordfindpage7.js"></script>
</div>
<!-- fin modales-->

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro4.js');
?>
