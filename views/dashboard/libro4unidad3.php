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

			pages: 31,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadtrescuartogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>


<div id="ModalUnit3Act1" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Draw and color</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
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
										padding-top: 15px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 50%;
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

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton1 {
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
										<div class="row mb-4">
											<div class="color col-4">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker1" value="#55D0ED">
												</div>
											</div>
											<div class="stroke col-4">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker1">
												</div>
											</div>
											<div class="clear col-4">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton1">Clear canvas</a>
												</div>
											</div>
										</div>
									</header>
									<br>
									<br>
									<div class="container-fluid row mb-4">
										<div class="col mb-3 " style="border: 2px solid #fee156; border-radius: 0.75rem; padding: 10px">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<div class="row mb-2">
												<h5><b>Summer</b></h5>
											</div>
											<div class="row d-flex justify-content-center mb-2">
												<canvas id="canvas1-1" style="background-color: #f9fcf5; width: 300px !important; height: 300px !important" width="300" height="300">
												</canvas>
											</div>
											<div class="row">
												<p>How is the weather?</p>
											</div>
											<br>
											<div class="row">
												<div class="col-3">
													<p>Is it cold?</p>
												</div>
												<div class="col">
													<select id="select-act1-1" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it hot?</p>
												</div>
												<div class="col">
													<select id="select-act1-2" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it cloudy?</p>
												</div>
												<div class="col">
													<select id="select-act1-3" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>	
											<div class="row">
												<div class="col-3">
													<p>Is it rainy?</p>
												</div>
												<div class="col">
													<select id="select-act1-4" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
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
						<!-- Librerias para el Canvas -->
						<script src="https://s.cdpn.io/6859/paper.js"></script>
						<script src="https://s.cdpn.io/6859/tween.min.js"></script>
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

<div id="ModalUnit3Act1-2" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act1-2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Draw and color</p>
											<input type="text" class="d-none" id="points1-2" name="points">
											<input type="text" class="d-none" id="idcliente1-2" name="idcliente">
											<input type="text" class="d-none" id="idlibro1-2" name="idlibro">
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
										padding-top: 15px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 50%;
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

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton1-2 {
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
										<div class="row mb-4">
											<div class="color col-4">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker1-2" value="#55D0ED">
												</div>
											</div>
											<div class="stroke col-4">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker1-2">
												</div>
											</div>
											<div class="clear col-4">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton1-2">Clear canvas</a>
												</div>
											</div>
										</div>
									</header>
									<br>
									<br>
									<div class="container-fluid row mb-4">
										<div class="col mb-3" style="border: 2px solid #e88dc2; border-radius: 0.75rem; padding: 10px">
											<input type="number" value="0" id="verify-canvas-2" class="d-none">
											<div class="row mb-2">
												<h5><b>Spring</b></h5>
											</div>
											<div class="row d-flex justify-content-center mb-2">
												<canvas id="canvas1-2" style="background-color: #f9fcf5; width: 300px !important; height: 300px !important" width="300" height="300">
												</canvas>
											</div>
											<div class="row">
												<p>How is the weather?</p>
											</div>
											<br>
											<div class="row">
												<div class="col-3">
													<p>Is it cold?</p>
												</div>
												<div class="col">
													<select id="select-act1-2-1" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it hot?</p>
												</div>
												<div class="col">
													<select id="select-act1-2-2" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it cloudy?</p>
												</div>
												<div class="col">
													<select id="select-act1-2-3" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>	
											<div class="row">
												<div class="col-3">
													<p>Is it rainy?</p>
												</div>
												<div class="col">
													<select id="select-act1-2-4" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
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
						<!-- Librerias para el Canvas -->
						<script src="https://s.cdpn.io/6859/paper.js"></script>
						<script src="https://s.cdpn.io/6859/tween.min.js"></script>
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

<div id="ModalUnit3Act1-3" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act1-3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Draw and color</p>
											<input type="text" class="d-none" id="points1-3" name="points">
											<input type="text" class="d-none" id="idcliente1-3" name="idcliente">
											<input type="text" class="d-none" id="idlibro1-3" name="idlibro">
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
										padding-top: 15px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 50%;
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

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton1-3 {
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
										<div class="row mb-4">
											<div class="color col-4">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker1-3" value="#55D0ED">
												</div>
											</div>
											<div class="stroke col-4">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker1-3">
												</div>
											</div>
											<div class="clear col-4">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton1-3">Clear canvas</a>
												</div>
											</div>
										</div>
									</header>
									<br>
									<br>
									<div class="container-fluid row mb-4">
										<div class="col mb-3 " style="border: 2px solid #e9966a; border-radius: 0.75rem; padding: 10px">
											<div class="row mb-2">
												<h5><b>Fall</b></h5>
											</div>
											<div class="row d-flex justify-content-center mb-2">
												<canvas id="canvas1-3" style="background-color: #f9fcf5; width: 300px !important; height: 300px !important" width="300" height="300">
												</canvas>
											</div>
											<div class="row">
												<p>How is the weather?</p>
											</div>
											<br>
											<div class="row">
												<div class="col-3">
													<p>Is it cold?</p>
												</div>
												<div class="col">
													<select id="select-act1-3-1" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it hot?</p>
												</div>
												<div class="col">
													<select id="select-act1-3-2" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it cloudy?</p>
												</div>
												<div class="col">
													<select id="select-act1-3-3" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>	
											<div class="row">
												<div class="col-3">
													<p>Is it rainy?</p>
												</div>
												<div class="col">
													<select id="select-act1-3-4" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
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
						<!-- Librerias para el Canvas -->
						<script src="https://s.cdpn.io/6859/paper.js"></script>
						<script src="https://s.cdpn.io/6859/tween.min.js"></script>
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

<div id="ModalUnit3Act1-4" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act1-4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Draw and color</p>
											<input type="text" class="d-none" id="points1-4" name="points">
											<input type="text" class="d-none" id="idcliente1-4" name="idcliente">
											<input type="text" class="d-none" id="idlibro1-4" name="idlibro">
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
										padding-top: 15px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 50%;
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

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton1-4 {
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
										<div class="row mb-4">
											<div class="color col-4">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker1-4" value="#55D0ED">
												</div>
											</div>
											<div class="stroke col-4">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker1-4">
												</div>
											</div>
											<div class="clear col-4">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton1-4">Clear canvas</a>
												</div>
											</div>
										</div>
									</header>
									<br>
									<br>
									<div class="container-fluid row mb-4">
										<div class="col mb-3" style="border: 2px solid #bee1f3; border-radius: 0.75rem; padding: 10px">
											<input type="number" value="0" id="verify-canvas-2" class="d-none">
											<div class="row mb-2">
												<h5><b>Winter</b></h5>
											</div>
											<div class="row d-flex justify-content-center mb-2">
												<canvas id="canvas1-4" style="background-color: #f9fcf5; width: 300px !important; height: 300px !important" width="300" height="300">
												</canvas>
											</div>
											<div class="row">
												<p>How is the weather?</p>
											</div>
											<br>
											<div class="row">
												<div class="col-3">
													<p>Is it cold?</p>
												</div>
												<div class="col">
													<select id="select-act1-4-1" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it hot?</p>
												</div>
												<div class="col">
													<select id="select-act1-4-2" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="col-3">
													<p>Is it cloudy?</p>
												</div>
												<div class="col">
													<select id="select-act1-4-3" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
													</select>
												</div>
											</div>	
											<div class="row">
												<div class="col-3">
													<p>Is it rainy?</p>
												</div>
												<div class="col">
													<select id="select-act1-4-4" class="form-select" style="width:auto;">
														<option value="0" selected disabled></option>
														<option value="1">Yes, it is</option>
														<option value="2">No, it isn't</option>
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
						<!-- Librerias para el Canvas -->
						<script src="https://s.cdpn.io/6859/paper.js"></script>
						<script src="https://s.cdpn.io/6859/tween.min.js"></script>
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

<div id="ModalUnit3Act2" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">How do you prefer?</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table table-bordered" style="border: 1px solid #d462a9">
										<tr>
											<td width="30%">
												<p>When it is <b>warm</b>?</p>
												<p>When it is <b>sunny</b>?</p>
												<br>
												<p class="d-inline">I prefer </p>
													<select id="select-act2-1" class="form-select d-inline-block" style="width: auto;">
														<option value="0" disabled selected></option>
														<option value="1">when it is warm</option>
														<option value="2">when it is sunny</option>
													</select>
											</td>
											<td width="70%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/6-1.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<p>When it is <b>windy</b>?</p>
												<p>When it is <b>rainy</b>?</p>
												<br>
												<p class="d-inline">I prefer </p>
													<select id="select-act2-2" class="form-select d-inline-block" style="width: auto;">
														<option value="0" disabled selected></option>
														<option value="1">when it is windy</option>
														<option value="2">when it is rainy</option>
													</select>
											</td>
											<td width="70%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/6-2.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<p>When it is <b>dark</b>?</p>
												<p>When it is <b>clear</b>?</p>
												<br>
												<p class="d-inline">I prefer </p>
													<select id="select-act2-3" class="form-select d-inline-block" style="width: auto;">
														<option value="0" disabled selected></option>
														<option value="1">when it is dark</option>
														<option value="2">when it is clear</option>
													</select>
											</td>
											<td width="70%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/6-3.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<p>When it is <b>cold</b>?</p>
												<p>When it is <b>cloudy</b>?</p>
												<br>
												<p class="d-inline">I prefer </p>
													<select id="select-act2-4" class="form-select d-inline-block" style="width: auto;">
														<option value="0" disabled selected></option>
														<option value="1">when it is cold</option>
														<option value="2">when it is cloudy</option>
													</select>
											</td>
											<td width="70%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/6-4.jpg" class="img-fluid">
											</td>
										</tr>
									</table>
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

<div id="ModalUnit3Act3" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the sentences according to the images</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-3 mb-5">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-1.jpg" class="img-fluid">
										<select id="select-act3-1" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">These shirts are 20% off.</option>
											<option value="2">These shoes are 20% off.</option>
											<option value="3">These shirts are 50% off.</option>
										</select>
									</div>
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-2.jpg" class="img-fluid">
										<select id="select-act3-2" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">Those jeans are 20% off.</option>
											<option value="2">Those shoes are 10% off.</option>
											<option value="3">These shoes are 50% off.</option>
										</select>
									</div>
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-3.jpg" class="img-fluid">
										<select id="select-act3-3" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">The jeans are in sale.</option>
											<option value="2">The jeans are 10% off.</option>
											<option value="3">The shirts are on sale.</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3 mb-5">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-4.jpg" class="img-fluid">
										<select id="select-act3-4" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">She is at the men's department.</option>
											<option value="2">My mother is in the dressing room.</option>
											<option value="3">My mother is at the women's department.</option>
										</select>
									</div>
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-5.jpg" class="img-fluid">
										<select id="select-act3-5" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">She is at the men's department.</option>
											<option value="2">Your father is at the men's department.</option>
											<option value="3">Your father is in the dressing room.</option>
										</select>
									</div>
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-6.jpg" class="img-fluid">
										<select id="select-act3-6" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">Frank is at the women's department.</option>
											<option value="2">Frank is at the men's department.</option>
											<option value="3">Frank is at the children's department.</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-3 mb-2">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-7.jpg" class="img-fluid">
										<select id="select-act3-7" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">My aunt is at the infant's department.</option>
											<option value="2">My aunt is in the dressing room.</option>
											<option value="3">My aunt is at the children's department.</option>
										</select>
									</div>
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/7-8.jpg" class="img-fluid">
										<select id="select-act3-8" class="form-select">
											<option value="0" disabled selected></option>
											<option value="1">He is in the dressing room.</option>
											<option value="2">He is at the men's department.</option>
											<option value="3">He is at the infant's department.</option>
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

<div id="ModalUnit3Act4" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the sentences according to the images</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row">
									<table class="table table-bordered">
										<tr>
											<td>
												<p>How is the weather in La Palma, Manuel?</p>
												<select id="select-act4-1" class="form-select">
													<option value="0" selected disabled></option>
													<option value="1">In La Palma, the weather is cool, I love it.</option>
													<option value="2">In La Palma, the weather is sunny, I love it.</option>
													<option value="3">In La Palma, the weather is warm, I love it.</option>
												</select>
											</td>
											<td>
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/8-1.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td>
												<p>How is the weather in Soyapongo, Napoleón?</p>
												<select id="select-act4-2" class="form-select">
													<option value="0" selected disabled></option>
													<option value="1">In the city of Soyapango we have a sunny weather.</option>
													<option value="2">In the city of Soyapango we have a foggy weather.</option>
													<option value="3">In the city of Soyapango we have a snowy weather.</option>
												</select>
											</td>
											<td>
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/8-2.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td>
												<p>How is the weather in New York, Rafael?</p>
												<select id="select-act4-3" class="form-select">
													<option value="0" selected disabled></option>
													<option value="1">Here in New York, is cloudy today.</option>
													<option value="2">Here in New York, is sunny today.</option>
													<option value="3">Here in New York, is snowy today.</option>
												</select>
											</td>
											<td>
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/8-3.jpg" class="img-fluid">
											</td>
										</tr>
										<tr>
											<td>
												<p>How is the weather in Santa Ana, Miguel?</p>
												<select id="select-act4-4" class="form-select">
													<option value="0" selected disabled></option>
													<option value="1">At the moment, it's sunny in Santa Ana.</option>
													<option value="2">At the moment, it's rainy in Santa Ana.</option>
													<option value="3">At the moment, it's hot in Santa Ana.</option>
												</select>
											</td>
											<td>
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/8-4.jpg" class="img-fluid">
											</td>
										</tr>
									</table>
								</div>
								<br>
								<div class="row">
									<p style="color: #637ab9;">Ask your classmate how is the weather and write it:</p>
									<input type="text" autocomplete="off" class="form-control mb-3" id="input-act4-1">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-2">
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

<div id="ModalUnit3Act5" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the names of the months of the year</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-4 mb-4">
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-1">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-2">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-3">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-4">
									</div>
								</div>
								<div class="row row-cols-4 mb-4">
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-5">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-6">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-7">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-8">
									</div>
								</div>
								<div class="row row-cols-4 mb-4">
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-9">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-10">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-11">
									</div>
									<div class="col">
										<input type="text" class="form-control" maxlength="9" id="input-act5-12">
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

<div id="ModalUnit3Act6" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Look at the picture and select the correct answer</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/10.jpg" class="img-fluid">
									</div>
									<div class="col d-flex align-items-center">
										<select id="select-act6" class="form-select">
											<option value="0" selected disabled></option>
											<option value="1">It is hot and sunny.</option>
											<option value="2">It is cold and rainy.</option>
											<option value="3">It is windy and sunny.</option>
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

<div id="ModalUnit3Act7" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the sentences:</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-center mb-5">
									<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/11.jpg" class="img-fluid">
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p class="d-inline">Where are you </p>
											<input type="text" autocomplete="off" id="input-act7-1" maxlength="25" style="width: auto;" class="form-control d-inline-block">
										<p class="d-inline">?</p>
									</div>
									<div class="col">
										<p class="d-inline">I'm going </p>
											<input type="text" autocomplete="off" id="input-act7-2" maxlength="20" style="width: auto;" class="form-control d-inline-block">
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p class="d-inline">When are you </p>
											<input type="text" autocomplete="off" id="input-act7-3" maxlength="25" style="width: auto;" class="form-control d-inline-block">
										<p class="d-inline">?</p>
									</div>
									<div class="col">
										<p class="d-inline">I'm going </p>
											<input type="text" autocomplete="off" id="input-act7-4" maxlength="20" style="width: auto;" class="form-control d-inline-block">
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<p class="d-inline">Is it </p>
											<input type="text" autocomplete="off" id="input-act7-5" maxlength="8" style="width: auto;" class="form-control d-inline-block">
										<p class="d-inline">rain </p>
											<input type="text" autocomplete="off" id="input-act7-6" maxlength="15" style="width: auto;" class="form-control d-inline-block">
										<p class="d-inline">?</p>
									</div>
									<div class="col">
										<p class="d-inline">No, it </p>
											<input type="text" autocomplete="off" id="input-act7-7" maxlength="20" style="width: auto;" class="form-control d-inline-block">
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
Book_Page::footerTemplate('controladorlibro4_u3.js');
?>