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

<div id="ModalUnit2Act8" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Numbers from forty-one to sixty, drag the words and answer correctly</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">41</th>
													<td width="80%" id="box-act8-1" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">42</th>
													<td width="80%" id="box-act8-2" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">43</th>
													<td width="80%" id="box-act8-3" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">44</th>
													<td width="80%" id="box-act8-4" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">45</th>
													<td width="80%" id="box-act8-5" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">46</th>
													<td width="80%" id="box-act8-6" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">47</th>
													<td width="80%" id="box-act8-7" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">48</th>
													<td width="80%" id="box-act8-8" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">49</th>
													<td width="80%" id="box-act8-9" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">50</th>
													<td width="80%" id="box-act8-10" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act8-1">
												<div id="option-act8-10" class="text-option-act8 col" draggable="true">fifty</div>
												<div id="option-act8-2" class="text-option-act8 col" draggable="true">forty-two</div>
												<div id="option-act8-5" class="text-option-act8 col" draggable="true">forty-five</div>
												<div id="option-act8-4" class="text-option-act8 col" draggable="true">forty-four</div>
												<div id="option-act8-12" class="text-option-act8 col" draggable="true">fifty-two</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act8-2">
												<div id="option-act8-8" class="text-option-act8 col" draggable="true">forty-eight</div>
												<div id="option-act8-18" class="text-option-act8 col" draggable="true">fifty-eight</div>
												<div id="option-act8-7" class="text-option-act8 col" draggable="true">forty-seven</div>
												<div id="option-act8-11" class="text-option-act8 col" draggable="true">fifty-one</div>
												<div id="option-act8-14" class="text-option-act8 col" draggable="true">fifty-four</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act8-3">
												<div id="option-act8-13" class="text-option-act8 col" draggable="true">fifty-three</div>
												<div id="option-act8-6" class="text-option-act8 col" draggable="true">forty-six</div>
												<div id="option-act8-15" class="text-option-act8 col" draggable="true">fifty-five</div>
												<div id="option-act8-17" class="text-option-act8 col" draggable="true">fifty-seven</div>
												<div id="option-act8-1" class="text-option-act8 col" draggable="true">forty-one</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act8-4">
												<div id="option-act8-3" class="text-option-act8 col" draggable="true">forty-three</div>
												<div id="option-act8-20" class="text-option-act8 col" draggable="true">sixty</div>
												<div id="option-act8-9" class="text-option-act8 col" draggable="true">forty-nine</div>
												<div id="option-act8-19" class="text-option-act8 col" draggable="true">fifty-nine</div>
												<div id="option-act8-16" class="text-option-act8 col" draggable="true">fifty-six</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">51</th>
													<td width="80%" id="box-act8-11" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">52</th>
													<td width="80%" id="box-act8-12" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">53</th>
													<td width="80%" id="box-act8-13" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">54</th>
													<td width="80%" id="box-act8-14" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">55</th>
													<td width="80%" id="box-act8-15" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">56</th>
													<td width="80%" id="box-act8-16" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">57</th>
													<td width="80%" id="box-act8-17" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">58</th>
													<td width="80%" id="box-act8-18" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">59</th>
													<td width="80%" id="box-act8-19" class="box-act8-u2"></td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">60</th>
													<td width="80%" id="box-act8-20" class="box-act8-u2"></td>
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

<div id="ModalUnit2Act9" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the numbers from forty-one to sixty</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">41</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-1" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">42</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-2" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">43</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-3" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">44</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-4" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">45</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-5" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">46</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-6" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">47</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-7" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">48</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-8" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">49</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-9" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">50</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-10" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">51</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-11" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">52</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-12" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">53</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-13" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">54</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-14" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">55</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-15" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">56</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-16" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">57</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-17" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">58</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-18" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">59</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-19" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">60</th>
													<td width="80%" class="box-act8-u2">
														<input type="text" class="form-control" id="input-act9-20" placeholder="Write the number..." maxlength="11">
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

<div id="ModalUnit2Act10" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the time looking at the clock</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-3 mb-4">
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-1.jpg" alt="6:15">
											</div>
											<div class="row">
												<select id="select-act10-1" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">A quarter past six.</option>
													<option value="2">Six o'clock.</option>
													<option value="3">Six thirty.</option>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-2.jpg" alt="1:55">
											</div>
											<div class="row">
												<select id="select-act10-2" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">A quarter to two.</option>
													<option value="2">Five to two.</option>
													<option value="3">Five past two.</option>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-3.jpg" alt="8:25">
											</div>
											<div class="row">
												<select id="select-act10-3" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">Twenty-five past eight.</option>
													<option value="2">Eight o'clock.</option>
													<option value="3">A quarter past eight.</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row row-cols-3">
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-4.jpg" alt="11:55">
											</div>
											<div class="row">
												<select id="select-act10-4" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">Eleven o'clock.</option>
													<option value="2">Twelve past eleven.</option>
													<option value="3">Five to twelve.</option>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-5.jpg" alt="3:40">
											</div>
											<div class="row">
												<select id="select-act10-5" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">A quarter to four.</option>
													<option value="2">A quarter past eight.</option>
													<option value="3">Twenty to four.</option>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="row">
												<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/11-6.jpg" alt="12:10">
											</div>
											<div class="row">
												<select id="select-act10-6" class="form-select">
													<option selected disabled value="0"></option>
													<option value="1">Two o'clock.</option>
													<option value="2">Ten past twelve.</option>
													<option value="3">Two past twelve.</option>
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

<div id="ModalUnit2Act11" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act11">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Count the fruits and answer</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<div class="row row-cols-2">
												<div class="col">
													<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/12-1.jpg" alt="Grapes">
												</div>
												<div class="col">
													<p>How many grapes do you see?</p>
													<input type="number" class="form-control" id="input-act11-1" min="1" max="20">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row row-cols-2">
												<div class="col">
													<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/12-2.jpg" alt="Pears">
												</div>
												<div class="col">
													<p>How many pears do you see?</p>
													<input type="number" class="form-control" id="input-act11-2" min="1" max="20">
												</div>
											</div>
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<div class="row row-cols-2">
												<div class="col">
													<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/12-3.jpg" alt="Melons">
												</div>
												<div class="col">
													<p>How many melons do you see?</p>
													<input type="number" class="form-control" id="input-act11-3" min="1" max="20">
												</div>
											</div>
										</div>
										<div class="col">
											<div class="row row-cols-2">
												<div class="col">
													<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/12-4.jpg" alt="Oranges">
												</div>
												<div class="col">
													<p>How many oranges do you see?</p>
													<input type="number" class="form-control" id="input-act11-4" min="1" max="20">
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

<div id="ModalUnit2Act12" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<head><link rel="stylesheet" href="//cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.css"></head>
								<body><script src="//cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script></body>
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer about your itinery</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you wake up?</b></p>
											<p style="display: inline;">I wake up at</p>
											<input type="text" id="input-act12-1" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you get up?</b></p>
											<p style="display: inline;">I get up at</p>
											<input type="text" id="input-act12-2" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take a shower?</b></p>
											<p style="display: inline;">I take a shower at</p>
											<input type="text" id="input-act12-3" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you get dressed?</b></p>
											<p style="display: inline;">I get dressed at</p>
											<input type="text" id="input-act12-4" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you eat breakfast?</b></p>
											<p style="display: inline;">I eat breakfast at</p>
											<input type="text" id="input-act12-5" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you go to school?</b></p>
											<p style="display: inline;">I go to school at</p>
											<input type="text" id="input-act12-6" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you eat lunch?</b></p>
											<p style="display: inline;">I eat lunch at</p>
											<input type="text" id="input-act12-7" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you wash your dishes?</b></p>
											<p style="display: inline;">I wash my dishes at</p>
											<input type="text" id="input-act12-8" class="time-b4" style="display: inline-block;">
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

<div id="ModalUnit2Act13" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer about the time that you do everything</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you wash your body?</b></p>
											<p style="display: inline;">I wash my body at </p>
											<input type="text" id="input-act13-1" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you eat breakfast?</b></p>
											<p style="display: inline;">I eat breakfast at </p>
											<input type="text" id="input-act13-2" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you go to school?</b></p>
											<p style="display: inline;">I go to school at </p>
											<input type="text" id="input-act13-3" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you give your homework?</b></p>
											<p style="display: inline;">I give my homework at</p>
											<input type="text" id="input-act13-4" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take your english class?</b></p>
											<p style="display: inline;">I take my english class at</p>
											<input type="text" id="input-act13-5" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you listen your english class?</b></p>
											<p style="display: inline;">I listen my english class at</p>
											<input type="text" id="input-act13-6" class="time-b4" style="display: inline-block;">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take your recess?</b></p>
											<p style="display: inline;">I take my recess at</p>
											<input type="text" id="input-act13-7" class="time-b4" style="display: inline-block;">
										</div>
										<div class="col">
											<p><b>What time do you walk to your house?</b></p>
											<p style="display: inline;">I walk to my house at</p>
											<input type="text" id="input-act13-8" class="time-b4" style="display: inline-block;">
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