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

<div id="ModalUnit3Act9" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the words</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-center mb-5">
									<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/13.jpg" class="img-fluid">
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p class="d-inline">Why do you like </p>
											<input type="text" autocomplete="off" id="input-act9-1" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">to the beach. </p>
									</div>
									<div class="col">
										<p class="d-inline">Because </p>
											<input type="text" autocomplete="off" id="input-act9-2" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">to go swimming. </p>
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
											<input type="text" autocomplete="off" id="input-act9-3" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">he going </p>
											<input type="text" autocomplete="off" id="input-act9-4" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">his friends? </p>
									</div>
									<div class="col">
										<p class="d-inline">Yes. He's going  </p>
											<input type="text" autocomplete="off" id="input-act9-5" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">them in summer. </p>
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
											<input type="text" autocomplete="off" id="input-act9-6" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">you think the weather will </p>
											<input type="text" autocomplete="off" id="input-act9-7" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">in November? </p>
									</div>
									<div class="col">
										<p class="d-inline">Yes. The weather will  </p>
											<input type="text" autocomplete="off" id="input-act9-8" maxlength="20" style="width: 100px;" class="form-control d-inline-block">
										<p class="d-inline">to windy and cool. </p>
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

<div id="ModalUnit3Act8" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the questions below</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row d-flex justify-content-center mb-5">
									<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/12.jpg" class="img-fluid">
								</div>
								<div class="row mb-5">
									<div class="col">
										<p class="d-inline">What was the weather like on Wednesday? </p>
											<input type="text" autocomplete="off" id="input-act8-1" maxlength="40" style="width: 350px;" class="form-control d-inline-block">
									</div>
								</div>
								<div class="row mb-5">
									<div class="col">
										<p class="d-inline">What was the weather like in Canada yesterday? </p>
											<input type="text" autocomplete="off" id="input-act8-2" maxlength="40" style="width: 350px;" class="form-control d-inline-block">
									</div>
								</div>
								<div class="row mb-5">
									<div class="col">
										<p class="d-inline">Were your friends in Alaska in hot weather?</p>
											<input type="text" autocomplete="off" id="input-act8-3" maxlength="40" style="width: 350px;" class="form-control d-inline-block">
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

<div id="ModalUnit3Act10" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the pets</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row">
									<table>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-1.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-1" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-2.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-2" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-3.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-3" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-4.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-4" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-5.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-5" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-6.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-6" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-7.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-7" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-8.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-8" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-9.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-9" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-10.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-10" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-11.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-11" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-12.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-12" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-13.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-13" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-14.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-14" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-15.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-15" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-16.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-16" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-17.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-17" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-18.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-18" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-19.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-19" class="form-control">
											</td>
										</tr>
										<tr>
											<td width="30%">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/20-20.jpg" class="img-fluid">
											</td>
											<td width="70%">
												<input type="text" autocomplete="off" id="input-act10-20" class="form-control">
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

<div id="ModalUnit3Act11" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act11">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the question and the answer</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/22.jpg" class="img-fluid">
										</div>
										<div class="col">
											<select id="select-act11-1" class="form-select mb-3">
												<option value="0" disabled selected></option>
												<option value="1">How is the dog?</option>
												<option value="2">How is the cat?</option>
												<option value="3">How is the parrot?</option>
											</select>
											<select id="select-act11-2" class="form-select">
												<option value="0" disabled selected></option>
												<option value="1">It's an ugly animal, its color is green.</option>
												<option value="2">It's a noisy animal, its color is black.</option>
												<option value="3">It's a beautiful animal, its color is light brown.</option>
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

<div id="ModalUnit3Act12" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select three adjectives for each pet</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col">
										1. Horse
									</div>
									<div class="col">
										<select id="select-act12-1" class="form-select select-act12-1">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-2" class="form-select select-act12-1">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-3" class="form-select select-act12-1">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col">
										2. Cat
									</div>
									<div class="col">
										<select id="select-act12-4" class="form-select select-act12-2">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-5" class="form-select select-act12-2">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-6" class="form-select select-act12-2">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col">
										3. Parrot
									</div>
									<div class="col">
										<select id="select-act12-7" class="form-select select-act12-3">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-8" class="form-select select-act12-3">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-9" class="form-select select-act12-3">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col">
										4. Dog
									</div>
									<div class="col">
										<select id="select-act12-10" class="form-select select-act12-4">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-11" class="form-select select-act12-4">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-12" class="form-select select-act12-4">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col">
										5. Mouse
									</div>
									<div class="col">
										<select id="select-act12-13" class="form-select select-act12-5">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-14" class="form-select select-act12-5">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
										</select>
										<select id="select-act12-15" class="form-select select-act12-5">
											<option value="0" selected disabled></option>
											<option value="1">noisy</option>
											<option value="2">little</option>
											<option value="3">black</option>
											<option value="4">ugly</option>
											<option value="5">white</option>
											<option value="6">brown</option>
											<option value="7">green</option>
											<option value="8">orange</option>
											<option value="9">big</option>
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

<div id="ModalUnit3Act13" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write a sentence for each pet</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row">
									<input type="text" id="input-act13-1" class="form-control mb-3" autocomplete="off" placeholder="1..">
									<input type="text" id="input-act13-2" class="form-control mb-3" autocomplete="off" placeholder="2..">
									<input type="text" id="input-act13-3" class="form-control mb-3" autocomplete="off" placeholder="3..">
									<input type="text" id="input-act13-4" class="form-control mb-3" autocomplete="off" placeholder="4..">
									<input type="text" id="input-act13-5" class="form-control mb-3" autocomplete="off" placeholder="5..">
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

<div class="modal fade" id="ModalUnit3Act14" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Crossword about pets</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
									<style type="text/css">
										.cell {
											border: 1px solid #404040;;
											background-color: white;
										}

										.cell-black {
											background-color:#404040;
										}
										.word-number {
											text-align: right;
											font-size: 0.6rem;
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
									<div class="row row-cols-2 justify-content-center">
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/23.jpg" class="img-fluid">
										</div>
										<div class="col">
											<table style="width:100%; height:100%;" class="table-cross14l4">
												<tr>
													<!-- 1 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act14-1">1</label>
														<input id="input-act14-1" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act14-2">2</label>
														<input id="input-act14-2" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 2 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act14-3" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act14-4" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 3 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act14-5">3</label>
														<input id="input-act14-5" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-6" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-7" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-8" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-9" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-10" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 4 -->
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act14-11">4</label>
														<input id="input-act14-11" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act14-12" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 5 -->
													<td class="cell">
														<label class="word-number" for="input-act14-13">5</label>
														<input id="input-act14-13" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-14" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-15" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-16" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act14-17" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 6 -->
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act14-18" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
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

<div id="ModalUnit3Act15" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act15">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the sentences</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/24-1.jpg" class="img-fluid">
									</div>
									<div class="col">
										<input type="text" id="input-act15-1" class="form-control mb-3" autocomplete="off">
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/24-2.jpg" class="img-fluid">
									</div>
									<div class="col">
										<input type="text" id="input-act15-2" class="form-control mb-3" autocomplete="off">
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/24-3.jpg" class="img-fluid">
									</div>
									<div class="col">
										<input type="text" id="input-act15-3" class="form-control mb-3" autocomplete="off">
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

<div class="modal fade" id="ModalUnit3Act16" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Solve the crossword using the list of words and the clues</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									<style type="text/css">
										.cell {
											border: 1px solid #d8f3fe;;
											background-color: white;
										}

										.cell-black {
											background-color:#d8f3fe;
										}
										.word-number {
											text-align: right;
											font-size: 0.6rem;
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
									<div class="row justify-content-center mt-2 mb-3">
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/25.jpg" class="img-fluid">
										</div>
									</div>
									<div class="row ">
										<div class="col d-flex justify-content-center">
											<table class="table-cross16l4">
												<tr>
													<!-- 1 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act16-1">1</label>
														<input id="input-act16-1" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 2 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-2" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 3 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act16-3">2</label>
														<input id="input-act16-3" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-4" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 4 -->
													<td class="cell">
														<label class="word-number" for="input-act16-5">3, 8</label>
														<input id="input-act16-5" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-6" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-7" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-8" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<label class="word-number" for="input-act16-9">4</label>
														<input id="input-act16-9" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-10" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 5 -->
													<td class="cell">
														<input id="input-act16-11" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-12" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act16-13">5</label>
														<input id="input-act16-13" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-14" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<label class="word-number" for="input-act16-15">6</label>
														<input id="input-act16-15" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-16" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 6 -->
													<td class="cell">
														<input id="input-act16-17" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-18" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-19" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 7 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-20" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-21" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 8 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act16-22" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 9 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act16-23">7</label>
														<input id="input-act16-23" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-24" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-25" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-26" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act16-27" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
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

<div id="ModalUnit3Act17" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act17">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the missing words</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col-2"></div>
									<div class="col-8">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/27.jpg" class="img-fluid">
									</div>
									<div class="col-2"></div>
								</div>
								<div class="row">
									<div class="col">
										<p class="d-inline">"Oh</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-1">
										<p class="d-inline">. I have</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-2">
										<p class="d-inline">a poem. Great," Jake</p>
											<input type="text" class="form-control d-inline-block" style="width: 150px;" autocomplete="off" id="input-act17-3">
										<p class="d-inline">disgust. "</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-4">
										<p class="d-inline">awful</p>
											<input type="text" class="form-control d-inline-block" style="width: 150px;" autocomplete="off" id="input-act17-5">
										<p class="d-inline">stuff. I</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-6">
										<p class="d-inline"> I didn't</p>
											<input type="text" class="form-control d-inline-block" style="width: 150px;" autocomplete="off" id="input-act17-7">
										<p class="d-inline">it. I'll be lucky</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-8">
										<p class="d-inline">a D on</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-9">
										<p class="d-inline">!"</p>
										<br>
										<br>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-10">
										<p class="d-inline">finished</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-11">
										<p class="d-inline">poem about pets, and</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-12">
										<p class="d-inline">up</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-13">
										<p class="d-inline">. Grace's desk. "Here</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-14">
										<p class="d-inline">,"</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-15">
										<p class="d-inline">said. Then</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-16">
										<p class="d-inline">took off outside</p>
											<input type="text" class="form-control d-inline-block" style="width: 100px;" autocomplete="off" id="input-act17-17">
										<p class="d-inline">see</p>
											<input type="text" class="form-control d-inline-block" style="width: 150px;" autocomplete="off" id="input-act17-18">
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

<div class="modal fade" id="ModalUnit3Act18" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Family pets crossword</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
									<style type="text/css">
										.cell {
											border: 1px solid #d8f3fe;;
											background-color: white;
										}

										.cell-black {
											background-color:#d8f3fe;
										}
										.word-number {
											text-align: right;
											font-size: 0.6rem;
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
									<div class="row row-cols-2 justify-content-center mt-2 mb-3">
										<div class="col">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/28.jpg" class="img-fluid">
										</div>
										<div class="col d-flex justify-content-center">
											<table class="table-cross18l4">
												<tr>
													<!-- 1 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act18-1">1</label>
														<input id="input-act18-1" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act18-2">2</label>
														<input id="input-act18-2" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 2 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act18-3" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act18-4" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 3 -->
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act18-5">3</label>
														<input id="input-act18-5" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-6" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-7" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-8" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-9" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-10" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
												</tr>
												<tr>
													<!-- 4 -->
													<td class="cell cell-black"></td>
													<td class="cell">
														<label class="word-number" for="input-act18-11">4</label>
														<input id="input-act18-11" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act18-12" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 5 -->
													<td class="cell">
														<label class="word-number" for="input-act18-13">5</label>
														<input id="input-act18-13" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-14" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-15" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-16" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell">
														<input id="input-act18-17" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
												</tr>
												<tr>
													<!-- 6 -->
													<td class="cell cell-black"></td>
													<td class="cell">
														<input id="input-act18-18" class="letter" type="text" maxlength="1" data-down="1"/>
													</td>
													<td class="cell cell-black"></td>
													<td class="cell cell-black"></td>
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

<div id="ModalUnit3Act19" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit3-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the missing words</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-8">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitThree/activities/29.jpg" class="img-fluid">
									</div>
									<div class="col-4">
										<textarea class="form-control" id="input-act19" rows="9"></textarea>
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