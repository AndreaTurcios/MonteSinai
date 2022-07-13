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

			pages: 33,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidaddoscuartogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit2Act1" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write in english the name of the foods that you see:</p>
											<input type="text" class="d-none" id="points" name="points">
											<input type="text" class="d-none" id="idcliente" name="idcliente">
											<input type="text" class="d-none" id="idlibro" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 ">
										<div class="col-3">

										</div>
										<div class="col-6">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/4.jpg" alt="Foods" class="img-fluid">
										</div>
										<div class="col-3"></div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-11" placeholder="11..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-12" placeholder="12..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-13" placeholder="13..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-14" placeholder="14..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-15" placeholder="15..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-16" placeholder="16..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-17" placeholder="17..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-18" placeholder="18..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-19" placeholder="19..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-20" placeholder="20..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-21" placeholder="21..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-22" placeholder="22..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-23" placeholder="23..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act1-24" placeholder="24..." class="form-control">
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

<div class="modal fade" id="ModalUnit2Act2" tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Express yourself</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like fish, rice and salad?</p>
										</div>
										<div class="col"  style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line1" type="radio" id="radio-act2-1">
												<label class="form-check-label" for="radio-act2-1">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line1" type="radio" id="radio-act2-2">
												<label class="form-check-label" for="radio-act2-2">I don't like it..</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like cereal and milk for breakfast?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line2" type="radio" id="radio-act2-3">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line2" type="radio" id="radio-act2-4">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like pizza and soda for lunch?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line3" type="radio" id="radio-act2-5">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line3" type="radio" id="radio-act2-6">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like steak, rice and salad for lunch?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line4" type="radio" id="radio-act2-7">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line4" type="radio" id="radio-act2-8">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like pop corn and soda?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line5" type="radio" id="radio-act2-9">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line5" type="radio" id="radio-act2-10">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like pancake and butter for breakfast?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line6" type="radio" id="radio-act2-11">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line6" type="radio" id="radio-act2-12">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like beans and rice for dinner?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line7" type="radio" id="radio-act2-13">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line7" type="radio" id="radio-act2-14">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like french fries and hamburger?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line8" type="radio" id="radio-act2-15">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line8" type="radio" id="radio-act2-16">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like eggs and cheese for dinner?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line9" type="radio" id="radio-act2-17">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line9" type="radio" id="radio-act2-18">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col container-act2">
											<p>Do you like ham and eggs for dinner?</p>
										</div>
										<div class="col" style="border-bottom: solid 1px #ccd7d8;">
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line10" type="radio" id="radio-act2-19">
												<label class="form-check-label" for="radio-act2-3">I like it.</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" name="line10" type="radio" id="radio-act2-20">
												<label class="form-check-label" for="radio-act2-4">I don't like it.</label>
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

<div id="ModalUnit2Act3" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Make a list expressing likes and dislikes for different foods:</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 ">
										<div class="col-3">

										</div>
										<div class="col-6 mb-4">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/4.jpg" alt="Foods" class="img-fluid">
										</div>
										<div class="col-3"></div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div class="row title-act3 pt-2">
												<p>I like it.</p>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-1">1.</label>
													<select id="select-act3-1" class="form-select select-act3" >
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-2">2.</label>
													<select id="select-act3-2" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-3">3.</label>
													<select id="select-act3-3" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-4">4.</label>
													<select id="select-act3-4" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-5">5.</label>
													<select id="select-act3-5" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-6">6.</label>
													<select id="select-act3-6" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-7">7.</label>
													<select id="select-act3-7" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-8">8.</label>
													<select id="select-act3-8" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2" style="border-bottom: solid 1px #ccd7d8;">
												<div class="col mb-4">
													<label for="select-act3-9">9.</label>
													<select id="select-act3-9" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-10">10.</label>
													<select id="select-act3-10" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row title-act3 pt-2">
												<p>I don't like it.</p>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-11">1.</label>
													<select id="select-act3-11" class="form-select select-act3" >
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-12">2.</label>
													<select id="select-act3-12" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-13">3.</label>
													<select id="select-act3-13" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-14">4.</label>
													<select id="select-act3-14" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-15">5.</label>
													<select id="select-act3-15" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-16">6.</label>
													<select id="select-act3-16" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2">
												<div class="col mb-4">
													<label for="select-act3-17">7.</label>
													<select id="select-act3-17" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-18">8.</label>
													<select id="select-act3-18" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
											</div>
											<div class="row row-cols-2 box-act2" style="border-bottom: solid 1px #ccd7d8;">
												<div class="col mb-4">
													<label for="select-act3-19">9.</label>
													<select id="select-act3-19" class="form-select select-act3">
														<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
													</select>
												</div>
												<div class="col mb-4">
													<label for="select-act3-20">10.</label>
													<select id="select-act3-20" class="form-select select-act3">
													<option value="0" selected disabled class="text-muted">Choose</option>
														<option value="1">Bacon</option>
														<option value="2">Beans</option>
														<option value="3">Bread</option>
														<option value="4">Butter</option>
														<option value="5">Cereal</option>
														<option value="6">Cheese</option>
														<option value="7">Chicken</option>
														<option value="8">Cookies</option>
														<option value="9">Eggs</option>
														<option value="10">Fish</option>
														<option value="11">French fries</option>
														<option value="12">Ham</option>
														<option value="13">Hamburger</option>
														<option value="14">Hot dog</option>
														<option value="15">Macaroni</option>
														<option value="16">Meat</option>
														<option value="17">Pancakes</option>
														<option value="18">Pizza</option>
														<option value="19">Pop corn</option>
														<option value="20">Rice</option>
														<option value="21">Salad</option>
														<option value="22">Sandwich</option>
														<option value="23">Sausages</option>
														<option value="24">Spaguetti</option>
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
			</form>
		</div>
	</div>
</div>

<div id="ModalUnit2Act4" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write in english the name of the foods that you see:</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 ">
										<div class="col-1">

										</div>
										<div class="col-10">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/6.jpg" alt="Foods" class="img-fluid">
										</div>
										<div class="col-1"></div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act4-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											
										</div>
										<div class="col-4 pe-3">
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

<div id="ModalUnit2Act5" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of each fruit that you see</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 ">
										<div class="col-1">

										</div>
										<div class="col-10">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/7.jpg" alt="Fruits" class="img-fluid">
										</div>
										<div class="col-1"></div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-11" placeholder="11..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-12" placeholder="12..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act5-13" placeholder="13..." class="form-control">
										</div>
										<div class="col-4 pe-3">
										</div>
										<div class="col-4 pe-3">
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

<div id="ModalUnit2Act6" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the vegetables that you see</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 ">
										<div class="col-1">

										</div>
										<div class="col-10">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/8.jpg" alt="Fruits" class="img-fluid">
										</div>
										<div class="col-1"></div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input type="text" id="input-act6-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
										</div>
										<div class="col-4 pe-3">
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

<div id="ModalUnit2Act7" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog ">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the indefinite articles: A, An</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
												<select id="select-act7-1" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> boy</p>
										</div>
										<div class="col-6 pe-3">
												<select id="select-act7-2" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> carrot</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
												<select id="select-act7-3" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> girl</p>
										</div>
										<div class="col-6 pe-3">
												<select id="select-act7-4" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> tomato</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
												<select id="select-act7-5" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> orange</p>
										</div>
										<div class="col-6 pe-3">
												<select id="select-act7-6" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> onion</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
												<select id="select-act7-7" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> envelope</p>
										</div>
										<div class="col-6 pe-3">
												<select id="select-act7-8" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> orange</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
												<select id="select-act7-9" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> umbrella</p>
										</div>
										<div class="col-6 pe-3">
												<select id="select-act7-10" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted" style="color: white;"></option>
													<option value="1">A</option>
													<option value="2">An</option>
												</select> 
											<p class="text-justify" style="display: inline;"> radish</p>
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
Book_Page::footerTemplate('controladorlibro4_u2.js');
?>