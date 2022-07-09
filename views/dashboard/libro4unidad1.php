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
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/21.JPG" width="76" height="100"
							class="page-21">
						<span>20-21</span>
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
				<h5 class="modal-title" id="modal-title" align="center">Crossword of numbers from one to twenty</h5>
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
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-1" onclick="checkCells('act21-1')">O</th><!-- ONE, TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-2" onclick="checkCells('act21-2')">N</th><!-- ONE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-3" onclick="checkCells('act21-3')">E</th><!-- ONE -->
                                            <th class="text-center cell-act21" width="30" height="30">J</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-4" onclick="checkCells('act21-4')">E</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-5" onclick="checkCells('act21-5')">T</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-6" onclick="checkCells('act21-6')">F</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-7" onclick="checkCells('act21-7')">T</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-8" onclick="checkCells('act21-8')">W</th><!-- TWO -->
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-9" onclick="checkCells('act21-9')">L</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">V</th>
                                            <th class="text-center cell-act21" width="30" height="30"  id="act21-10" onclick="checkCells('act21-10')">N</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-11" onclick="checkCells('act21-11')">W</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-12" onclick="checkCells('act21-12')">O</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-13" onclick="checkCells('act21-13')">S</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-14" onclick="checkCells('act21-14')">H</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-15" onclick="checkCells('act21-15')">T</th><!-- THREE, TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-16" onclick="checkCells('act21-16')">H</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-17" onclick="checkCells('act21-17')">R</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-18" onclick="checkCells('act21-18')">E</th><!-- THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-19" onclick="checkCells('act21-19')">E</th><!-- ELEVEN, THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-20" onclick="checkCells('act21-20')">N</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-21" onclick="checkCells('act21-21')">E</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-22" onclick="checkCells('act21-22')">E</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-23" onclick="checkCells('act21-23')">E</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-24" onclick="checkCells('act21-24')">U</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-25" onclick="checkCells('act21-25')">E</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-26" onclick="checkCells('act21-26')">I</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-27" onclick="checkCells('act21-27')">Y</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-28" onclick="checkCells('act21-28')">F</th><!-- FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-29" onclick="checkCells('act21-29')">I</th><!-- FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-30" onclick="checkCells('act21-30')">V</th><!-- ELEVEN, FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-31" onclick="checkCells('act21-31')">E</th><!-- FIVE, EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-32" onclick="checkCells('act21-32')">E</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-33" onclick="checkCells('act21-33')">I</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-34" onclick="checkCells('act21-34')">L</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-35" onclick="checkCells('act21-35')">R</th><!-- FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-36" onclick="checkCells('act21-36')">V</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-37" onclick="checkCells('act21-37')">R</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-38" onclick="checkCells('act21-38')">T</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-39" onclick="checkCells('act21-39')">E</th><!-- ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-40" onclick="checkCells('act21-40')">E</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-41" onclick="checkCells('act21-41')">T</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-42" onclick="checkCells('act21-42')">G</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-43" onclick="checkCells('act21-43')">V</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-44" onclick="checkCells('act21-44')">E</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-45" onclick="checkCells('act21-45')">T</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-46" onclick="checkCells('act21-46')">N</th><!-- NINE, TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-47" onclick="checkCells('act21-47')">I</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-48" onclick="checkCells('act21-48')">N</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-49" onclick="checkCells('act21-49')">E</th><!-- NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-50" onclick="checkCells('act21-50')">N</th><!-- ELEVEN, SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-51" onclick="checkCells('act21-51')">T</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-52" onclick="checkCells('act21-52')">F</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-53" onclick="checkCells('act21-53')">H</th><!-- EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-54" onclick="checkCells('act21-54')">E</th><!-- TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-55" onclick="checkCells('act21-55')">N</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-56" onclick="checkCells('act21-56')">E</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-57" onclick="checkCells('act21-57')">E</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-58" onclick="checkCells('act21-58')">E</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">Q</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-59" onclick="checkCells('act21-59')">H</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-60" onclick="checkCells('act21-60')">I</th><!-- FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-61" onclick="checkCells('act21-61')">T</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-62" onclick="checkCells('act21-62')">E</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-63" onclick="checkCells('act21-63')">N</th><!-- TEN -->
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-64" onclick="checkCells('act21-64')">T</th><!-- SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-65" onclick="checkCells('act21-65')">E</th><!-- THIRTEEN -->
                                        </tr>
										<tr><!-- ROW EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-66" onclick="checkCells('act21-66')">W</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-67" onclick="checkCells('act21-67')">V</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-68" onclick="checkCells('act21-68')">X</th><!-- SIX -->
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-69" onclick="checkCells('act21-69')">G</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-70" onclick="checkCells('act21-70')">F</th><!-- FIFTEEN, FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-71" onclick="checkCells('act21-71')">O</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-72" onclick="checkCells('act21-72')">U</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-73" onclick="checkCells('act21-73')">R</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-74" onclick="checkCells('act21-74')">T</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-75" onclick="checkCells('act21-75')">E</th><!-- FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-76" onclick="checkCells('act21-76')">E</th><!-- FOURTEEN, SEVENTEEN-->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-77" onclick="checkCells('act21-77')">N</th><!-- THIRTEEN, FOURTEEN -->
                                        </tr>
										<tr><!-- ROW NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-78" onclick="checkCells('act21-78')">T</th><!-- TWENTY -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-79" onclick="checkCells('act21-79')">E</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-80" onclick="checkCells('act21-80')">I</th><!-- SIX -->
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-81" onclick="checkCells('act21-81')">I</th><!-- EIGHTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-82" onclick="checkCells('act21-82')">N</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-83" onclick="checkCells('act21-83')">I</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-84" onclick="checkCells('act21-84')">N</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-85" onclick="checkCells('act21-85')">E</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-86" onclick="checkCells('act21-86')">T</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-87" onclick="checkCells('act21-87')">E</th><!-- NINETEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-88" onclick="checkCells('act21-88')">E</th><!-- NINETEEN, SEVENTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-89" onclick="checkCells('act21-89')">N</th><!-- NINETEEN -->
                                        </tr>
										<tr><!-- ROW TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-90" onclick="checkCells('act21-90')">S</th><!-- SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-91" onclick="checkCells('act21-91')">S</th><!-- SIXTEEN, SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-92" onclick="checkCells('act21-92')">I</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-93" onclick="checkCells('act21-93')">X</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-94" onclick="checkCells('act21-94')">T</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-95" onclick="checkCells('act21-95')">E</th><!-- SIXTEEN, eight -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-96" onclick="checkCells('act21-96')">E</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-97" onclick="checkCells('act21-97')">N</th><!-- SIXTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">U</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act21-98" onclick="checkCells('act21-98')">N</th><!-- SEVENTEEN -->
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

<div class="modal fade" id="ModalUnit1Act23" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act23">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Read and match numbers from one to twenty</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>
									<div class="col">
										<div class="row mb-4">
											<div class="col pb-1 pt-2" style="border: dashed 2px pink;">
												<div class="row">
													<div class="col text-end">
														<p>one</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-1"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>five</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-2"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>nine</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-3"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>eighteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-4"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>thirteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-5"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col pb-1 pt-2" style="border: dashed 2px pink;">
												<div class="row">
													<div class="col text-end">
														<p>three</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-6"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>fifteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-7"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>eleven</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-8"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>nineteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-9"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>eight</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-10"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col">
										<div class="row justify-content-center">
											<div id="option-act23-1" class="box-act23 text-center m-3" draggable="true" data-id="small">
												9
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-2" class="box-act23 text-center m-3" draggable="true" data-id="small">
												10
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-3" class="box-act23 text-center m-3" draggable="true" data-id="small">
												5
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-4" class="box-act23 text-center m-3" draggable="true" data-id="small">
												17
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-5" class="box-act23 text-center m-3" draggable="true" data-id="small">
												1
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-6" class="box-act23 text-center m-3" draggable="true" data-id="small">
												6
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-7" class="box-act23 text-center m-3" draggable="true" data-id="small">
												18
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-8" class="box-act23 text-center m-3" draggable="true" data-id="small">
												14
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-9" class="box-act23 text-center m-3" draggable="true" data-id="small">
												13
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-10" class="box-act23 text-center m-3" draggable="true" data-id="small">
												4
											</div>
										</div>
									</div>
									<div class="col">
										<div class="row justify-content-center">
											<div id="option-act23-11" class="box-act23 text-center m-3" draggable="true" data-id="small">
												3
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-12" class="box-act23 text-center m-3" draggable="true" data-id="small">
												2
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-13" class="box-act23 text-center m-3" draggable="true" data-id="small">
												15
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-14" class="box-act23 text-center m-3" draggable="true" data-id="small">
												12
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-15" class="box-act23 text-center m-3" draggable="true" data-id="small">
												11
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-16" class="box-act23 text-center m-3" draggable="true" data-id="small">
												20
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-17" class="box-act23 text-center m-3" draggable="true" data-id="small">
												19
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-18" class="box-act23 text-center m-3" draggable="true" data-id="small">
												16
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-19" class="box-act23 text-center m-3" draggable="true" data-id="small">
												8
											</div>
										</div>
										<div class="row justify-content-center">
											<div id="option-act23-20" class="box-act23 text-center m-3" draggable="true" data-id="small">
												7
											</div>
										</div>
									</div>
									<div class="col">
										<div class="row mb-4">
											<div class="col pb-1 pt-2" style="border: dashed 2px pink;">
												<div class="row">
													<div class="col text-end">
														<p>ten</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23  text-center" id="box-act23-11"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>seventeen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-12"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>six</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-13"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>fourteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-14"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>four</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-15"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col pb-1 pt-2" style="border: dashed 2px pink;">
												<div class="row">
													<div class="col text-end">
														<p>two</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-16"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>twelve</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-17"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>twenty</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-18"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>seven</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-19"></div>
													</div>
												</div>
												<div class="row">
													<div class="col text-end">
														<p>sixteen</p>
													</div>
													<div class="col align-items-start">
														<div class="box-act23 text-center" id="box-act23-20"></div>
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

<div class="modal fade" id="ModalUnit1Act24" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act24">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing letters</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Lamp -->
													<td class="text-center">L</td>
													<td><input type="text" id="input-act24-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
												</tr>
												<tr>
													<!-- Sofa -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act24-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">a</td>
												</tr>
												<tr>
													<!-- Chair -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act24-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Radio -->
													<td class="text-center">R</td>
													<td><input type="text" id="input-act24-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
												</tr>
												<tr>
													<!-- Clock -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act24-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">k</td>
												</tr>
												<tr>
													<!-- Stereo -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act24-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
												</tr>
												<tr>
													<!-- Window -->
													<td class="text-center">W</td>
													<td><input type="text" id="input-act24-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
												</tr>
												<tr>
													<!-- Telephone -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act24-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
												</tr>
												<tr>
													<!-- Television set -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act24-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">l</td>
													<td><input type="text" id="input-act24-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">v</td>
													<td><input type="text" id="input-act24-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
													<td><input type="text" id="input-act24-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
													<td class="text-center"> &nbsp; </td>
													<td class="text-center">s</td>
													<td><input type="text" id="input-act24-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Fan -->
													<td class="text-center">F</td>
													<td><input type="text" id="input-act24-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
												</tr>
												<tr>
													<!-- Floor -->
													<td class="text-center">F</td>
													<td><input type="text" id="input-act24-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Coffe-table -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act24-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">f</td>
													<td><input type="text" id="input-act24-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
													<td class="text-center">-</td>
													<td class="text-center">t</td>
													<td><input type="text" id="input-act24-42"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-43"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act24-44"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
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

<div class="modal fade" id="ModalUnit1Act25" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act25">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col" style="position: relative;">
											<div style="position: absolute; bottom: 40%;">
												<p>Where is the yellow lamp?</p>
												<select id="select-act25-1" class="form-select" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
													<option value="1">It is on the black coffee table.</option>
													<option value="2">It is under the black coffee table.</option>
													<option value="3">It is behind the black coffee table.</option>
												</select>
											</div>
										</div>
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/35-1.jpg" class="img-fluid" alt="">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/35-2.jpg" class="img-fluid" alt="">
										</div>
										<div class="col" style="position: relative;">
											<div style="position: absolute; bottom: 40%;">
												<p>Where is the blue telephone?</p>
												<select id="select-act25-2" class="form-select" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
													<option value="1">The blue telephone is on the black coffe table</option>
													<option value="2">It is behind the curtains.</option>
													<option value="3">The blue telephone is next to the purple windows.</option>
												</select>
											</div>
										</div>
										
									</div>
									<div class="row mb-3">
										<div class="col-6" style="position: relative;">
											<div style="position: absolute; bottom: 40%;">
												<p>Where's the pink radio?</p>
												<select id="select-act25-3" class="form-select" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
													<option value="1">It is on the window.</option>
													<option value="2">It's under the purple windows.</option>
													<option value="3">It is behind the blue telephone.</option>
												</select>
											</div>
										</div>
										<div class="col-6">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/35-3.jpg" class="img-fluid" alt="">
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/35-4.jpg" class="img-fluid" alt="">
										</div>
										<div class="col-8 justify-content-start" style="position: relative;">
											<div style="position: absolute; bottom: 40%;">
												<p>Where is the grey fan?</p>
												<select id="select-act25-4" class="form-select" >
													<option value="0" selected disabled class="text-muted" style="color: white;">Select your answer</option>
													<option value="1">It is under the purple window.</option>
													<option value="2">It is behind the black coffee table.</option>
													<option value="3">It is next to the pink radio.</option>
												</select>
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

<div class="modal fade" id="ModalUnit1Act26" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act26">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the picture and answer</p>
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>
									<div class="row" style="margin-bottom: 50px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-1.jpg" alt="pink sofa">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-1" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-2" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom: 50px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-2.jpg" alt="yellow chair">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-3" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-4" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom: 50px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-3.jpg" alt="gray fan">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-5" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-6" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom: 50px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-4.jpg" alt="black coffe table">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-7" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this furniture?</p>
												<input type="text" class="form-control" id="input-act26-8" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom: 50px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-5.jpg" alt="purple curtains">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-9" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-10" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-3">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/36-6.jpg" alt="pink radio">
										</div>
										<div class="col-9">
											<div class="row">
												<p>What is the name of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-11" autocomplete="off">
											</div>
											<div class="row">
												<p>What is the color of this appliance?</p>
												<input type="text" class="form-control" id="input-act26-12" autocomplete="off">
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

<div id="ModalUnit1Act27" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Find the names of the living room</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act27">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points27" name="points">
											<input type="text" class="d-none" id="idcliente27" name="idcliente">
											<input type="text" class="d-none" id="idlibro27" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #ffd6d6; " width="">
                                        <tr><!-- ROW ONE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-1" onclick="checkCells('act27-1')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-2" onclick="checkCells('act27-2')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-3" onclick="checkCells('act27-3')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-4" onclick="checkCells('act27-4')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-5" onclick="checkCells('act27-5')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-6" onclick="checkCells('act27-6')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">J</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-7" onclick="checkCells('act27-7')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-8" onclick="checkCells('act27-8')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-9" onclick="checkCells('act27-9')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-10" onclick="checkCells('act27-10')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-11" onclick="checkCells('act27-11')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                        </tr>
										<tr><!-- ROW TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-12" onclick="checkCells('act27-12')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-13" onclick="checkCells('act27-13')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-14" onclick="checkCells('act27-14')">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">V</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-15" onclick="checkCells('act27-15')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">B</th>
                                        </tr>
										<tr><!-- ROW THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-16" onclick="checkCells('act27-16')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-17" onclick="checkCells('act27-17')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-18" onclick="checkCells('act27-18')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-19" onclick="checkCells('act27-19')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-20" onclick="checkCells('act27-20')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-21" onclick="checkCells('act27-21')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-22" onclick="checkCells('act27-22')">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">U</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-23" onclick="checkCells('act27-23')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-24" onclick="checkCells('act27-24')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-25" onclick="checkCells('act27-25')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-26" onclick="checkCells('act27-26')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-27" onclick="checkCells('act27-27')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-28" onclick="checkCells('act27-28')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-29" onclick="checkCells('act27-29')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">V</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
											<th class="text-center cell-act21" width="30" height="30" id="act27-30" onclick="checkCells('act27-30')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-31" onclick="checkCells('act27-31')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-32" onclick="checkCells('act27-32')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-33" onclick="checkCells('act27-33')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-34" onclick="checkCells('act27-34')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-35" onclick="checkCells('act27-35')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                        </tr>
										<tr><!-- ROW SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-36" onclick="checkCells('act27-36')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30">B</th>
                                            <th class="text-center cell-act21" width="30" height="30">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-37" onclick="checkCells('act27-37')">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-38" onclick="checkCells('act27-38')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-39" onclick="checkCells('act27-39')">D</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-40" onclick="checkCells('act27-40')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-41" onclick="checkCells('act27-41')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-42" onclick="checkCells('act27-42')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-43" onclick="checkCells('act27-43')">D</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-44" onclick="checkCells('act27-44')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-45" onclick="checkCells('act27-45')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">V</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-46" onclick="checkCells('act27-46')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-47" onclick="checkCells('act27-47')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-48" onclick="checkCells('act27-48')">M</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-49" onclick="checkCells('act27-49')">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-50" onclick="checkCells('act27-50')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">U</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-51" onclick="checkCells('act27-51')">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                        </tr>
										<tr><!-- ROW NINE -->
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-52" onclick="checkCells('act27-52')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-53" onclick="checkCells('act27-53')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                        </tr>
										<tr><!-- ROW TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-54" onclick="checkCells('act27-54')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-55" onclick="checkCells('act27-55')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-56" onclick="checkCells('act27-56')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-57" onclick="checkCells('act27-57')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-58" onclick="checkCells('act27-58')">V</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-59" onclick="checkCells('act27-59')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-60" onclick="checkCells('act27-60')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-61" onclick="checkCells('act27-61')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-62" onclick="checkCells('act27-62')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-63" onclick="checkCells('act27-63')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-64" onclick="checkCells('act27-64')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-65" onclick="checkCells('act27-65')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act27-66" onclick="checkCells('act27-66')">T</th>
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

<div class="modal fade" id="ModalUnit1Act28" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act28">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Match the images with the words</p>
											<input type="text" class="d-none" id="points28" name="points">
											<input type="text" class="d-none" id="idcliente28" name="idcliente">
											<input type="text" class="d-none" id="idlibro28" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col d-flex justify-content-center">
											<h4>Window</h4>
										</div>
										<div class="col ps-5" id="box-act28-1">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/37-1.jpg" alt="Chair" id="img-act28-1">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col d-flex justify-content-center">
											<h4>Floor</h4>
										</div>
										<div class="col ps-5" id="box-act28-2">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/37-2.jpg" alt="Radio" id="img-act28-2">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col d-flex justify-content-center">
											<h4>Chair</h4>
										</div>
										<div class="col ps-5" id="box-act28-3">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/37-3.jpg" alt="Window" id="img-act28-3">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col d-flex justify-content-center">
											<h4>Television set</h4>
										</div>
										<div class="col ps-5" id="box-act28-4">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/37-4.jpg" alt="Television set" id="img-act28-4">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col d-flex justify-content-center">
											<h4>Radio</h4>
										</div>
										<div class="col ps-5" id="box-act28-5">
											<img draggable="true" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/37-5.jpg" alt="Floor" id="img-act28-5">
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

<div class="modal fade" id="ModalUnit1Act29" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act29">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the names</p>
											<input type="text" class="d-none" id="points29" name="points">
											<input type="text" class="d-none" id="idcliente29" name="idcliente">
											<input type="text" class="d-none" id="idlibro29" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Table -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act29-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
												</tr>
												<tr>
													<!-- Picture -->
													<td class="text-center">P</td>
													<td><input type="text" id="input-act29-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
												</tr>
												<tr>
													<!-- Salad bowl -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act29-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">d</td>
													<td class="text-center"> &nbsp; </td>
													<td class="text-center">b</td>
													<td><input type="text" id="input-act29-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">l</td>
												</tr>
												<tr>
													<!-- Pitcher -->
													<td class="text-center">P</td>
													<td><input type="text" id="input-act29-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Tablecloth -->
													<td class="text-center">T</td>
													<td class="text-center">a</td>
													<td><input type="text" id="input-act29-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>	
													<td class="text-center">h</td>
												</tr>
												<tr>
													<!-- Candle -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act29-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
												</tr>
												<tr>
													<!-- Candlestick -->
													<td class="text-center">C</td>
													<td class="text-center">a</td>
													<td class="text-center">n</td>
													<td class="text-center">d</td>
													<td><input type="text" id="input-act29-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>	
													<td class="text-center">c</td>
													<td class="text-center">k</td>
												</tr>
												<tr>
													<!-- Salt shaker -->
													<td class="text-center">S</td>
													<td class="text-center">a</td>
													<td class="text-center">l</td>
													<td class="text-center">t</td>
													<td class="text-center">&nbsp;</td>
													<td class="text-center">s</td>
													<td><input type="text" id="input-act29-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Coffeepot -->
													<td class="text-center">C</td>
													<td class="text-center">o</td>
													<td><input type="text" id="input-act29-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-42"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Pepper shaker -->
													<td class="text-center">P</td>
													<td class="text-center">e</td>
													<td><input type="text" id="input-act29-43"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-44"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-45"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
													<td class="text-center">&nbsp;</td>
													<td class="text-center">s</td>
													<td><input type="text" id="input-act29-46"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-47"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-48"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-49"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- sugar-bowl -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act29-50"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-51"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-52"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">d</td>
													<td class="text-center"> -</td>
													<td class="text-center">b</td>
													<td><input type="text" id="input-act29-53"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
													<td><input type="text" id="input-act29-54"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- China cabinet -->
													<td class="text-center">C</td>
													<td class="text-center">h</td>
													<td><input type="text" id="input-act29-55"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-56"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-57"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act29-58"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-59"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-60"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-61"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act29-62"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
													<td class="text-center">t</td>
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

<div class="modal fade" id="ModalUnit1Act30" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act30">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Read the questions and answer them according to the picture</p>
											<input type="text" class="d-none" id="points30" name="points">
											<input type="text" class="d-none" id="idcliente30" name="idcliente">
											<input type="text" class="d-none" id="idlibro30" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/39.jpg" class="img-fluid">
									</div>
									<div class="row row-cols-2">
										<div class="col" style="padding-right: 25px; margin-bottom: 25px">
											<p>Where is the salad bowl <b> - 1</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-1">
										</div>
										<div class="col">
											<p>Where is the chair <b> - 4</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-4">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col" style="padding-right: 25px; margin-bottom: 25px">
											<p>Where is the salt shaker and pepper shaker? <b> - 2</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-2">
										</div>
										<div class="col">
											<p>Where is the picture? <b> - 5</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-5">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col" style="padding-right: 25px; margin-bottom: 25px">
											<p>Where is the sugar bowl? <b> - 3</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-3">
										</div>
										<div class="col">
											<p>Where is the pitcher? <b> - 6</b></p>
											<input type="text" class="form-control" placeholder="Your answer..." id="input-act30-6">
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

<div class="modal fade" id="ModalUnit1Act31" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act31">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Crossword about the dining room</p>
											<input type="text" class="d-none" id="points31" name="points">
											<input type="text" class="d-none" id="idcliente31" name="idcliente">
											<input type="text" class="d-none" id="idlibro31" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/40.jpg" class="img-fluid">
									</div>
									<style type="text/css">
										.cell {
											border: 1px solid #f99d52;;
											background-color: white;
										}

										.cell-black {
											background-color:#f99d52;
										}
										.word-number {
											text-align: right;
											font-size: 0.4rem;
											vertical-align: top;
											color: #063477;
											position: absolute;
											padding: 0.1rem 0 0 0.1rem;
										}

										.letter {
											background: none;
											height: 1.8rem;
											width: 1.8rem;
											border: none;
											box-shadow: none;
											text-align: center;
											text-transform: uppercase;
											font-size: 1.4rem;
											color: #063477;
										}
									</style>
									<div class="row justify-content-center">
										<table style="width:75%;" class="table-crossl4">
											<tr>
												<td class="cell">
													<label class="word-number" for="input-act31-1">1, 6</label>
													<input required id="input-act31-1" class="letter" type="text" maxlength="1"pattern="[Cc]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-2" class="letter" type="text" maxlength="1"pattern="[Hh]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-3" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-4" class="letter" type="text" maxlength="1"pattern="[Ii]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-5" class="letter" type="text" maxlength="1"pattern="[Rr]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<label class="word-number" for="input-act31-6">8</label>
													<input required id="input-act31-6" class="letter" type="text" maxlength="1"pattern="[Cc]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black">&nbsp;</td>
												<td class="cell">
													<label class="word-number" for="input-act31-7">10</label>
													<input required id="input-act31-7" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-8" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-9" class="letter" type="text" maxlength="1"pattern="[Oo]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<label class="word-number" for="input-act31-9">9</label>
													<input required id="input-act31-10" class="letter" type="text" maxlength="1"pattern="[Cc]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-11" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-12" class="letter" type="text" maxlength="1"pattern="[Bb]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-13" class="letter" type="text" maxlength="1"pattern="[Ff]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-14" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-15" class="letter" type="text" maxlength="1"pattern="[Bb]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-16" class="letter" type="text" maxlength="1"pattern="[Ii]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-17" class="letter" type="text" maxlength="1"pattern="[Ff]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-18" class="letter" type="text" maxlength="1"pattern="[Nn]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-19" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-20" class="letter" type="text" maxlength="1"pattern="[Nn]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<label class="word-number" for="input-act31-21">7</label>
													<input required id="input-act31-21" class="letter" type="text" maxlength="1"pattern="[Pp]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-22" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-23" class="letter" type="text" maxlength="1"pattern="[Dd]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-24" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-25" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-26" class="letter" type="text" maxlength="1"pattern="[Ii]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-27" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-28" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-29" class="letter" type="text" maxlength="1"pattern="[Cc]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<input required id="input-act31-30" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-31" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-32" class="letter" type="text" maxlength="1"pattern="[Pp]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-33" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-34" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-35" class="letter" type="text" maxlength="1"pattern="[Cc]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-36" class="letter" type="text" maxlength="1"pattern="[Oo]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-37" class="letter" type="text" maxlength="1"pattern="[Oo]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-38" class="letter" type="text" maxlength="1"pattern="[Hh]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<label class="word-number" for="input-act31-39">2</label>
													<input required id="input-act31-39" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-40" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-41" class="letter" type="text" maxlength="1"pattern="[Bb]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-42" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-43" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-44" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-45" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell">
													<input required id="input-act31-46" class="letter" type="text" maxlength="1"pattern="[Hh]" data-down="1"/>
												</td>
											</tr>
											<tr>
												<td class="cell">
													<label class="word-number" for="input-act31-47">3</label>
													<input required id="input-act31-47" class="letter" type="text" maxlength="1"pattern="[Ss]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-48" class="letter" type="text" maxlength="1"pattern="[Uu]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-49" class="letter" type="text" maxlength="1"pattern="[Gg]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-50" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-51" class="letter" type="text" maxlength="1"pattern="[Rr]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
											</tr>
											<tr>
												<td class="cell cell-black"></td>
												<td class="cell">
													<label class="word-number" for="input-act31-52">4</label>
													<input required id="input-act31-52" class="letter" type="text" maxlength="1"pattern="[Ss]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-53" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-54" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-55" class="letter" type="text" maxlength="1"pattern="[Tt]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-56" class="letter" type="text" maxlength="1"pattern="[Ss]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-57" class="letter" type="text" maxlength="1"pattern="[Hh]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-58" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-59" class="letter" type="text" maxlength="1"pattern="[Kk]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-60" class="letter" type="text" maxlength="1"pattern="[Ee]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-61" class="letter" type="text" maxlength="1"pattern="[Rr]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
											</tr>
											<tr>
												<td class="cell">
													<label class="word-number" for="input-act31-52">5</label>
													<input required id="input-act31-62" class="letter" type="text" maxlength="1"pattern="[Ss]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-63" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-64" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-65" class="letter" type="text" maxlength="1"pattern="[Aa]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-66" class="letter" type="text" maxlength="1"pattern="[Dd]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-67" class="letter" type="text" maxlength="1"pattern="[Bb]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-68" class="letter" type="text" maxlength="1"pattern="[Oo]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-69" class="letter" type="text" maxlength="1"pattern="[Ww]" data-down="1"/>
												</td>
												<td class="cell">
													<input required id="input-act31-70" class="letter" type="text" maxlength="1"pattern="[Ll]" data-down="1"/>
												</td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
												<td class="cell cell-black"></td>
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
</div>

<div class="modal fade" id="ModalUnit1Act32" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act32">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look, count and answer</p>
											<input type="text" class="d-none" id="points32" name="points">
											<input type="text" class="d-none" id="idcliente32" name="idcliente">
											<input type="text" class="d-none" id="idlibro32" name="idlibro">
										</div>
									</div>
									<div class="row">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/41.jpg" alt="">
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>How many baskets are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-1" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>How many cups are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-2" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>How many jocotes are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-3" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>How many dishes are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-4" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>How many oranges are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-5" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>How many spoons are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-6" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>How many apples are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-7" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>How many knives are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-8" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>How many glasses are there?</p>
											<input type="text" class="form-control mb-3" id="input-act32-9" placeholder='Your answer...' autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act33" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act33">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the picture and answer</p>
											<input type="text" class="d-none" id="points33" name="points">
											<input type="text" class="d-none" id="idcliente33" name="idcliente">
											<input type="text" class="d-none" id="idlibro33" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/42.jpg" alt="">
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>What is Francisco doing?</p>
											<input type="text" disabled class="form-control mb-3" value='He is talking to Katherine.' autocomplete="off">
										</div>
										<div class="col">
											<p>What is Katherine doing?</p>
											<input type="text" class="form-control mb-3" id="input-act33-1" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>Is Francisco talking to his dad?</p>
											<input type="text" class="form-control mb-3" id="input-act33-2" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>Is Katherine talking to her mom?</p>
											<input type="text" class="form-control mb-3" id="input-act33-3" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>What is Francisco eating?</p>
											<input type="text" class="form-control mb-3" id="input-act33-4" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>What is Katherine eating?</p>
											<input type="text" class="form-control mb-3" id="input-act33-5" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p>What is dad eating?</p>
											<input type="text" class="form-control mb-3" id="input-act33-6" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>What is mom eating?</p>
											<input type="text" class="form-control mb-3" id="input-act33-7" placeholder='Your answer...' autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<p>Are Katherine and Francisco seated?</p>
											<input type="text" class="form-control mb-3" id="input-act33-8" placeholder='Your answer...' autocomplete="off">
										</div>
										<div class="col">
											<p>Is all the family sitting at the dining room table?</p>
											<input type="text" class="form-control mb-3" id="input-act33-9" placeholder='Your answer...' autocomplete="off">
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

<div class="modal fade" id="ModalUnit1Act34" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act34">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points34" name="points">
											<input type="text" class="d-none" id="idcliente34" name="idcliente">
											<input type="text" class="d-none" id="idlibro34" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table class="table table-striped">
												<tr class="mb-2" >
													<td class=" text-center"> twenty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 20</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-1"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
														<td>&nbsp;</td>
													<td class=" text-center">10</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">thirty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act34-2"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center"> 21 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> nine</td>
													<td>&nbsp;</td>
													<td class=" text-center">9</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">thirty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twenty two </td>
													<td>&nbsp;</td>
													<td class="text-center">22</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-3"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">8</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">thirty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td class=" text-center">twenty three </td>
													<td>&nbsp;</td>
													<td class="text-center"> 23</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">seven</td>
													<td>&nbsp;</td>
													<td class="text-center"> 7 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-4"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twenty four </td>
													<td>&nbsp;</td>
													<td class="text-center"> 27</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-5"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">6</td>
													<td>&nbsp;</td>
													
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> thirty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act34-6"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">25</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> five</td>
													<td>&nbsp;</td>
													<td class=" text-center">5</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> thirty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twenty six </td>
													<td>&nbsp;</td>
													<td class="text-center"> 26</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">four</td>
													<td>&nbsp;</td>
													<td class="text-center"> 4 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-7"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twenty seven </td>
													<td>&nbsp;</td>
													<td class="text-center"> 27</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-8"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">3</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> thirty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act34-9"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">28 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> two</td>
													<td>&nbsp;</td>
													<td class=" text-center">2</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> thirty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">twenty nine </td>
													<td>&nbsp;</td>
													<td class="text-center"> 29</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">one</td>
													<td>&nbsp;</td>
													<td class="text-center"> 1 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act34-10"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act34-11"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">30 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> zero</td>
													<td>&nbsp;</td>
													
													<td class=" text-center">0</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> thirty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
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

<div class="modal fade" id="ModalUnit1Act35" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act35">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the names</p>
											<input type="text" class="d-none" id="points35" name="points">
											<input type="text" class="d-none" id="idcliente35" name="idcliente">
											<input type="text" class="d-none" id="idlibro35" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Stove -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act35-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
												</tr>
												<tr>
													<!-- Cabinet -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act35-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">b</td>
													<td><input type="text" id="input-act35-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
													<td><input type="text" id="input-act35-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Refrigerator -->
													<td class="text-center">R</td>
													<td><input type="text" id="input-act35-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
													<td><input type="text" id="input-act35-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Toaster -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act35-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
													<td class="text-center">t</td>
													<td><input type="text" id="input-act35-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Microwave -->
													<td class="text-center">M</td>
													<td><input type="text" id="input-act35-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">c</td>
													<td class="text-center">r</td>
													<td><input type="text" id="input-act35-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">v</td>
													<td><input type="text" id="input-act35-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Blender -->
													<td class="text-center">B</td>
													<td class="text-center">l</td>
													<td><input type="text" id="input-act35-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
													<td class="text-center">d</td>
													<td><input type="text" id="input-act35-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Fork -->
													<td class="text-center">F</td>
													<td><input type="text" id="input-act35-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">k</td>
												</tr>
												<tr>
													<!-- Coffepot -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act35-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">f</td>
													<td><input type="text" id="input-act35-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
													<td><input type="text" id="input-act35-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Spoon -->
													<td class="text-center">S</td>
													<td class="text-center">p</td>
													<td><input type="text" id="input-act35-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
												</tr>
												<tr>
													<!-- Knife -->
													<td class="text-center">K</td>
													<td class="text-center">n</td>
													<td><input type="text" id="input-act35-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">f</td>
													<td><input type="text" id="input-act35-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Glass -->
													<td class="text-center">G</td>
													<td class="text-center">l</td>
													<td><input type="text" id="input-act35-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act35-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
												</tr>
												<tr>
													<!-- Dish -->
													<td class="text-center">D</td>
													<td><input type="text" id="input-act35-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
													<td><input type="text" id="input-act35-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Cup -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act35-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
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

<div class="modal fade" id="ModalUnit1Act36" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act36">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Observe your dining room and clasify in <b>clean</b> or <b>dirty</b></p>
											<input type="text" class="d-none" id="points36" name="points">
											<input type="text" class="d-none" id="idcliente36" name="idcliente">
											<input type="text" class="d-none" id="idlibro36" name="idlibro">
										</div>
									</div>
									<div class="container-act8 justify-content-center">
										<div id="option-act36-1" class="box-act8 text-center m-3" draggable="true" data-id="clean">
											clean
										</div>
										<div id="option-act36-2" class="box-act8 text-center m-3" draggable="true" data-id="dirty">
											dirty
										</div>
									</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>Do you have a stove? How is it?</p>
												<div id="text-act36-1" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>Does your kitchen have a cabinet? How is it?</p>
												<div id="text-act36-2" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>Do you have a refrigerator? How is it?</p>
												<div id="text-act36-3" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>Do you have sinks? How are they?</p>
												<div id="text-act36-4" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>Do you have a microwave? How is it?</p>
												<div id="text-act36-5" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>Do you have a toaster? How is it?</p>
												<div id="text-act36-6" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>Do you have a toaster? How is it?</p>
												<div id="text-act36-7" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>Do you have a Blender? How is it?</p>
												<div id="text-act36-8" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>Do you have a coffeepot? How is it?</p>
												<div id="text-act36-9" class="box-act8 text-center"></div>
											</div>
											<div class="col">
												<p>How many dishes do you have? How are they?</p>
												<div id="text-act36-10" class="box-act8 text-center"></div>
											</div>
										</div>
										<div class="row row-cols-2 mb-4">
											<div class="col">
												<p>How many spoons do you have? How are they?</p>
												<div id="text-act36-11" class="box-act8 text-center"></div>
											</div>
											<div class="col">
											</div>
										</div>
										<hr>
										<div class="row justify-content-center mb-3">
												<p>Draw a glad face if you answered "clean" five or more times, or a sad face if you answered "dirty" five or more times</p>
												<canvas id="canvas36" style="background: #fffcfc; width: 250px; height: 250px; border: 1px solid gray; border-radius: 7px;" width="250" height="250">

												</canvas>
										</div>
										<div class="row justify-content-center">
											<span class="btn btn-info" id="clear-btn36" style="width: 20%; background-color: rgb(230, 252, 255);">Clear canvas</span>
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

<div class="modal fade" id="ModalUnit1Act37" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act37">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the names</p>
											<input type="text" class="d-none" id="points37" name="points">
											<input type="text" class="d-none" id="idcliente37" name="idcliente">
											<input type="text" class="d-none" id="idlibro37" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Alarm clock -->
													<td class="text-center">A</td>
													<td><input type="text" id="input-act37-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">m</td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act37-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">k</td>
												</tr>
												<tr>
													<!-- Lamp -->
													<td class="text-center">L</td>
													<td><input type="text" id="input-act37-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
												</tr>
												<tr>
													<!-- Bed -->
													<td class="text-center">B</td>
													<td><input type="text" id="input-act37-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">d</td>
												</tr>
												<tr>
													<!-- Clock radio -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act37-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">k</td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act37-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
												</tr>
												<tr>
													<!-- Sheet -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act37-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Pillow -->
													<td class="text-center">P</td>
													<td><input type="text" id="input-act37-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
												</tr>
												<tr>
													<!-- Night table -->
													<td class="text-center">N</td>
													<td><input type="text" id="input-act37-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act37-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Window -->
													<td class="text-center">W</td>
													<td><input type="text" id="input-act37-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
												</tr>
												<tr>
													<!-- Dresser -->
													<td class="text-center">D</td>
													<td><input type="text" id="input-act37-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
												</tr>
												<tr>
													<!-- Carpet -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act37-42"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
													<td><input type="text" id="input-act37-43"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-44"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Closet -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act37-45"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
													<td><input type="text" id="input-act37-46"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-47"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
												<tr>
													<!-- Picture -->
													<td class="text-center">P</td>
													<td><input type="text" id="input-act37-48"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-49"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-50"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-51"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act37-52"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
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

<div class="modal fade" id="ModalUnit1Act38" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act38">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Identify what's in the bedroom</p>
											<input type="text" class="d-none" id="points38" name="points">
											<input type="text" class="d-none" id="idcliente38" name="idcliente">
											<input type="text" class="d-none" id="idlibro38" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<div class="col">
											<p>In the bedroom:</p>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-1">
												<label class="form-check-label" for="radio-act38-1">
													There are beds.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-2">
												<label class="form-check-label" for="radio-act38-2">
													There is a lamp.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38--1">
												<label class="form-check-label" for="radio-act38--1">
													There is a fan.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-3">
												<label class="form-check-label" for="radio-act38-3">
													There is a night table.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-4">
												<label class="form-check-label" for="radio-act38-4">
													There are pictures.
												</label>
											</div>
										</div>
										<div class="col">
											<img class="img-fluid" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/47-1.jpg" alt="Bedroom 1">
										</div>
									</div>
									<div class="row mb-5">
										<div class="col">
											<img class="img-fluid" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/47-2.jpg" alt="Bedroom 2">
										</div>
										<div class="col">
											<p>In the bedroom:</p>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-5">
												<label class="form-check-label" for="radio-act38-5">
													There is a bed.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38--2">
												<label class="form-check-label" for="radio-act38--2">
													There is an alarm clock.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-6">
												<label class="form-check-label" for="radio-act38-6">
													There are pillows.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-7">
												<label class="form-check-label" for="radio-act38-7">
													There are lamps.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38--3">
												<label class="form-check-label" for="radio-act38--3">
													There is a window.
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<p>In the bedroom:</p>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38--4">
												<label class="form-check-label" for="radio-act38--4">
													There is a closet.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-8">
												<label class="form-check-label" for="radio-act38-8">
													There is a radio.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-9">
												<label class="form-check-label" for="radio-act38-9">
													There is a window.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38-10">
												<label class="form-check-label" for="radio-act38-10">
													There are pictures.
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="radio-act38--5">
												<label class="form-check-label" for="radio-act38--5">
													There is a fan.
												</label>
											</div>
										</div>
										<div class="col">
											<img class="img-fluid" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/47-3.jpg" alt="Bedroom 3">
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

<div class="modal fade" id="ModalUnit1Act39" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act39">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Express yourself about the preferences chores drawing an x:</p>
											<input type="text" class="d-none" id="points39" name="points">
											<input type="text" class="d-none" id="idcliente39" name="idcliente">
											<input type="text" class="d-none" id="idlibro39" name="idlibro">
										</div>
										<div class="row justify-content-center mb-3">
												<canvas id="canvas39" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitOne/activities/48.jpg'); width: 270px; height: 214px;" width="270" height="214">

												</canvas>
										</div>
										<div class="row justify-content-center">
											<span class="btn btn-info" id="clear-btn39" style="width: 20%; background-color: rgb(230, 252, 255);">Clear canvas</span>
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

<div class="modal fade" id="ModalUnit1Act40" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act40">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write and match</p>
											<input type="text" class="d-none" id="points40" name="points">
											<input type="text" class="d-none" id="idcliente40" name="idcliente">
											<input type="text" class="d-none" id="idlibro40" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Radio alarm -->
													<td class="text-center">R</td>
													<td><input type="text" id="input-act40-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td class="text-center">A</td>
													<td><input type="text" id="input-act40-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">m</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-1">
											<img draggable="true" id="img-act40-1" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-1.jpg" alt="6">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Lamp -->
													<td class="text-center">L</td>
													<td><input type="text" id="input-act40-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-2">
											<img draggable="true" id="img-act40-2" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-2.jpg" alt="5">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Blankets -->
													<td class="text-center">B</td>
													<td class="text-center">l</td>
													<td><input type="text" id="input-act40-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-3">
											<img draggable="true" id="img-act40-3" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-3.jpg" alt="2">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Bed -->
													<td class="text-center">B</td>
													<td><input type="text" id="input-act40-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">d</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-4">
											<img draggable="true" id="img-act40-4" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-4.jpg" alt="4">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Pillows -->
													<td class="text-center">P</td>
													<td><input type="text" id="input-act40-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
													<td><input type="text" id="input-act40-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-5">
											<img draggable="true" id="img-act40-5" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-5.jpg" alt="1">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Night table -->
													<td class="text-center">N</td>
													<td><input type="text" id="input-act40-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act40-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-6">
											<img draggable="true" id="img-act40-6" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-6.jpg" alt="3">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Window -->
													<td class="text-center">W</td>
													<td><input type="text" id="input-act40-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">w</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-7">
											<img draggable="true" id="img-act40-7" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-7.jpg" alt="8">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Closet -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act40-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
													<td><input type="text" id="input-act40-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-8">
											<img draggable="true" id="img-act40-8" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-8.jpg" alt="7">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Blanket -->
													<td class="text-center">B</td>
													<td class="text-center">l</td>
													<td><input type="text" id="input-act40-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-9">
											<img draggable="true" id="img-act40-9" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-9.jpg" alt="9">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col-8">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Curtains -->
													<td class="text-center">C</td>
													<td><input type="text" id="input-act40-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
													<td><input type="text" id="input-act40-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-42"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-43"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act40-44"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">s</td>
												</tr>
											</table>
										</div>
										<div class="col-4" id="box-act40-10">
											<img draggable="true" id="img-act40-10" src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/49-10.jpg" alt="10">
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

<div class="modal fade" id="ModalUnit1Act41" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act41">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the words</p>
											<input type="text" class="d-none" id="points41" name="points">
											<input type="text" class="d-none" id="idcliente41" name="idcliente">
											<input type="text" class="d-none" id="idlibro41" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table style="border-collapse: separate; border-spacing: 0 5px;">
												<tr>
													<!-- Towel-->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act41-1"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-2"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-3"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">l</td>
												</tr>
												<tr>
													<!-- Sink -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act41-4"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-5"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">k</td>
												</tr>
												<tr>
													<!-- Soap -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act41-6"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-7"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">p</td>
												</tr>
												<tr>
													<!-- Shampoo -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act41-8"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-9"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-10"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-11"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-12"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">o</td>
												</tr>
												<tr>
													<!-- Toilet paper -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act41-13"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-14"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-15"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-16"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-17"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act41-18"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-19"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-20"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
													<td><input type="text" id="input-act41-21"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Tooth brush -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act41-22"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-23"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-24"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-25"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act41-26"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-27"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-28"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-29"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">h</td>
												</tr>
												<tr>
													<!-- Soap dish -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act41-30"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-31"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-32"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act41-33"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-34"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-35"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">h</td>
												</tr>
												<tr>
													<!-- Shower curtain -->
													<td class="text-center">S</td>
													<td><input type="text" id="input-act41-36"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-37"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-38"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">e</td>
													<td><input type="text" id="input-act41-39"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">&nbsp;</td>
													<td><input type="text" id="input-act41-40"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-41"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-42"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
													<td><input type="text" id="input-act41-43"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-44"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">n</td>
												</tr>
												<tr>
													<!-- Tub -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act41-45"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-46"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Mirror -->
													<td class="text-center">M</td>
													<td><input type="text" id="input-act41-47"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-48"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">r</td>
													<td><input type="text" id="input-act41-49"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-50"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
												</tr>
												<tr>
													<!-- Toilet -->
													<td class="text-center">T</td>
													<td><input type="text" id="input-act41-51"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-52"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-53"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td><input type="text" id="input-act41-54"
														class=" form-control" maxlength="1"
														autocomplete="off" ></td>
													<td class="text-center">t</td>
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

<div class="modal fade" id="ModalUnit1Act42" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act42">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Furniture and appliances at the bathroom of your house</p>
											<input type="text" class="d-none" id="points42" name="points">
											<input type="text" class="d-none" id="idcliente42" name="idcliente">
											<input type="text" class="d-none" id="idlibro42" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-bottom: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<p>Furniture and appliances</p>
									</div>
									<div class="col" style="border-bottom: 2px solid #c72937; border-right:  2px solid #c72937;">
										<p>Describe the color and write it</p>
									</div>
									<div class="col" style="border-bottom: 2px solid #c72937; border-right:  2px solid #c72937;">
										<p>Describe the cleanliness selecting clean or dirty</p>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-1.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-1" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-1">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-2.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-2" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-2">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-3.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-3" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-3">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-4.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-4" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-4">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-5.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-5" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-5">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-6.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-6" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-6">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-7.jpg" alt="">
									</div>
									<div class="col pt-2" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-7" placeholder="Write the color...">
									</div>
									<div class="col pt-2" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-7">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-8.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-8" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-8">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3">
									<div class="col" style="border-bottom: 2px solid #c72937; border-top: 2px solid #c72937; border-right:  2px solid #c72937; border-left: 2px solid #c72937;">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitOne/activities/51-9.jpg" alt="">
									</div>
									<div class="col pt-3" style="border-bottom: 2px solid #c72937; border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<input type="text" class="form-control" autocomplete="off" id="input-act42-9" placeholder="Write the color...">
									</div>
									<div class="col pt-3" style="border-bottom: 2px solid #c72937; border-top: 2px solid #c72937; border-right:  2px solid #c72937;">
										<select class="form-select" id="select-act42-9">
											<option value="0" disabled selected>Choose...</option>
											<option value="1">Clean</option>
											<option value="2">Dirty</option>
										</select>
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

<div id="ModalUnit1Act43" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act43">
				<div class="modal-body">
					<div class="" style="overflow-y:auto;">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-3 fw-bold">Color the yard, garden and garage</p>
											<!-- class="d-none" -->
											<input type="text" id="points43" name="points" class="d-none">
											<input type="text" id="idcliente43" name="idcliente" class="d-none">
											<input type="text" id="idlibro43" name="idlibro" class="d-none">
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
													<input type="color" id="color43Picker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="stroke43WidthPicker">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clear43Btn">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container mt-3">
											<canvas id="canvas43" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitOne/activities/52-1.jpg')"
											width="721" height="390" >
											
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

<div id="ModalUnit1Act44" class="modal fade" tabindex="-14">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Identifying the family members</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act44">
				<div class="modal-body">
					<div class="" style="overflow-y:auto;">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-3 fw-bold">Draw and color in the house, yard, garden and garage</p>
											<!-- class="d-none" -->
											<input type="text" id="points44" name="points" class="d-none">
											<input type="text" id="idcliente44" name="idcliente" class="d-none">
											<input type="text" id="idlibro44" name="idlibro" class="d-none">
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
													<input type="color" id="color44Picker" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="stroke44WidthPicker">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clear44Btn">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container mt-3">
											<canvas id="canvas44" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitOne/activities/52-2.jpg')"
											width="758" height="352" >

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

<div class="modal fade" id="ModalUnit1Act45" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act45">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points45" name="points">
											<input type="text" class="d-none" id="idcliente45" name="idcliente">
											<input type="text" class="d-none" id="idlibro45" name="idlibro">
										</div>
									</div>
									<div class="row mb-2">
										<div class="col">
											<table class="table table-striped">
												<tr class="mb-2" >
													<td class=" text-center"> thirty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-1"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
														<td>&nbsp;</td>
													<td class=" text-center">10</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">thirty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 30</td>
												</tr>
												<tr class="mb-2">
													<td class=" text-center"> Thirty one </td>
													<td>&nbsp;</td>
													<td class="text-center"> 31</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">nine</td>
													<td>&nbsp;</td>
													<td class="text-center"> 9 </td>
													<td>&nbsp;</td>
													<td class="text-center">=</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-2"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act45-3"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">32 </td>
													<td>&nbsp;</td>
													<td class="text-center">+</td>
													<td>&nbsp;</td>
													<td class="text-center"> eight</td>
													<td>&nbsp;</td>
													<td class=" text-center">8</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center">Forty</td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													<td class=" text-center">thirty three </td>
													<td>&nbsp;</td>
													<td class="text-center"> 33</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-4"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">7</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">thirty four </td>
													<td>&nbsp;</td>
													<td class="text-center"> 34</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">six</td>
													<td>&nbsp;</td>
													<td class="text-center"> 6 </td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-5"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act45-6"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">35</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> five</td>
													<td>&nbsp;</td>
													<td class=" text-center">5</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">thirty six </td>
													<td>&nbsp;</td>
													<td class="text-center"> 36</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-7"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">4</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">thirty seven </td>
													<td>&nbsp;</td>
													<td class="text-center"> 37</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class=" text-center">three</td>
													<td>&nbsp;</td>
													<td class="text-center"> 3 </td>
													<td>&nbsp;</td>
													<td class="text-center"> =</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-8"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													<td><input type="text" id="input-act45-9"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">38 </td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td class="text-center"> two</td>
													<td>&nbsp;</td>
													<td class=" text-center">2</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													
													<td class=" text-center">thirty nine </td>
													<td>&nbsp;</td>
													<td class="text-center"> 39</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-10"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">1</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
												</tr>
												<tr class="mb-2">
													<td class=" text-center">forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
													<td>&nbsp;</td>
													<td class="text-center"> +</td>
													<td>&nbsp;</td>
													<td><input type="text" id="input-act45-11"
														class=" form-control" maxlength="12"
														autocomplete="off" ></td>
													<td>&nbsp;</td>
													<td class=" text-center">0</td>
													<td>&nbsp;</td>
													<td class="text-center"> = </td>
													<td>&nbsp;</td>
													<td class="text-center"> forty </td>
													<td>&nbsp;</td>
													<td class="text-center"> 40</td>
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

<div class="modal fade" id="ModalUnit1Act46" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act46">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points46" name="points">
											<input type="text" class="d-none" id="idcliente46" name="idcliente">
											<input type="text" class="d-none" id="idlibro46" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>30</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-1" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>36</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-2" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>31</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-3" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>37</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-4" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>32</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-5" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>38</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-6" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>33</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-7" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>39</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-8" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>34</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-9" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>40</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-10" autocomplete="off">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row">
												<div class="col-2">
													<p>35</p>
												</div>
												<div class="col-10">
													<input type="text" class="form-control" id="input-act46-11" autocomplete="off">
												</div>
											</div>
										</div>
										<div class="col">
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

<div class="modal fade" id="ModalUnit1Act47" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act47">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing words</p>
											<input type="text" class="d-none" id="points47" name="points">
											<input type="text" class="d-none" id="idcliente47" name="idcliente">
											<input type="text" class="d-none" id="idlibro47" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>1. Do you read the newspaper at breakfast</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-1">
												<label class="form-check-label" for="radio-act47-1">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-2">
												<label class="form-check-label" for="radio-act47-2">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>2. Have you seen someone sleeping and reading?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-3">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-4">
												<label class="form-check-label" for="radio-act47-4">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>3. Does your sister take a shower after party?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-5">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-6">
												<label class="form-check-label" for="radio-act47-4">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>4. Does your mother sleep at the yard?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-7">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-8">
												<label class="form-check-label" for="radio-act47-4">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>5. Does Katherine read at the garage?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-9">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-10">
												<label class="form-check-label" for="radio-act47-4">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>6. Do you see someone sleeping at the kitchen?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-11">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-12">
												<label class="form-check-label" for="radio-act47-4">No</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p>7. Do you ?</p>
										</div>
										<div class="col">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-9">
												<label class="form-check-label" for="radio-act47-3">Yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" id="radio-act47-10">
												<label class="form-check-label" for="radio-act47-4">No</label>
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
<!-- fin modales-->

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro4.js');
?>
