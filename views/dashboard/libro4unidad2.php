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
											<input autocomplete="off" type="text" id="input-act1-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-11" placeholder="11..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-12" placeholder="12..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-13" placeholder="13..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-14" placeholder="14..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-15" placeholder="15..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-16" placeholder="16..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-17" placeholder="17..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-18" placeholder="18..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-19" placeholder="19..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-20" placeholder="20..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-21" placeholder="21..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-22" placeholder="22..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-23" placeholder="23..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act1-24" placeholder="24..." class="form-control">
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
											<input autocomplete="off" type="text" id="input-act4-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act4-10" placeholder="10..." class="form-control">
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
											<input autocomplete="off" type="text" id="input-act5-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-10" placeholder="10..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-11" placeholder="11..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-12" placeholder="12..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act5-13" placeholder="13..." class="form-control">
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
											<input autocomplete="off" type="text" id="input-act6-1" placeholder="1..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-2" placeholder="2..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-3" placeholder="3..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-4" placeholder="4..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-5" placeholder="5..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-6" placeholder="6..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-7" placeholder="7..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-8" placeholder="8..." class="form-control">
										</div>
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-9" placeholder="9..." class="form-control">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-4 pe-3">
											<input autocomplete="off" type="text" id="input-act6-10" placeholder="10..." class="form-control">
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
														<input autocomplete="off" type="text" class="form-control" id="input-act9-1" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">42</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-2" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">43</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-3" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">44</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-4" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">45</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-5" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">46</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-6" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">47</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-7" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">48</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-8" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">49</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-9" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">50</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-10" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">51</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-11" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">52</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-12" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">53</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-13" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">54</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-14" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">55</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-15" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">56</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-16" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">57</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-17" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">58</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-18" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">59</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-19" placeholder="Write the number..." maxlength="11">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">60</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act9-20" placeholder="Write the number..." maxlength="11">
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
													<input type="number" class="form-control" id="input-act11-1" min="1" max="20" autocomplete="off">
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
													<input type="number" class="form-control" id="input-act11-2" min="1" max="20" autocomplete="off">
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
													<input type="number" class="form-control" id="input-act11-3" min="1" max="20" autocomplete="off">
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
													<input type="number" class="form-control" id="input-act11-4" min="1" max="20" autocomplete="off">
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
											<input type="text" id="input-act12-1" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you get up?</b></p>
											<p style="display: inline;">I get up at</p>
											<input type="text" id="input-act12-2" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take a shower?</b></p>
											<p style="display: inline;">I take a shower at</p>
											<input type="text" id="input-act12-3" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you get dressed?</b></p>
											<p style="display: inline;">I get dressed at</p>
											<input type="text" id="input-act12-4" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you eat breakfast?</b></p>
											<p style="display: inline;">I eat breakfast at</p>
											<input type="text" id="input-act12-5" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you go to school?</b></p>
											<p style="display: inline;">I go to school at</p>
											<input type="text" id="input-act12-6" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you eat lunch?</b></p>
											<p style="display: inline;">I eat lunch at</p>
											<input type="text" id="input-act12-7" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you wash your dishes?</b></p>
											<p style="display: inline;">I wash my dishes at</p>
											<input type="text" id="input-act12-8" class="time-b4" style="display: inline-block;" autocomplete="off">
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
											<input type="text" id="input-act13-1" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you eat breakfast?</b></p>
											<p style="display: inline;">I eat breakfast at </p>
											<input type="text" id="input-act13-2" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you go to school?</b></p>
											<p style="display: inline;">I go to school at </p>
											<input type="text" id="input-act13-3" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you give your homework?</b></p>
											<p style="display: inline;">I give my homework at</p>
											<input type="text" id="input-act13-4" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take your english class?</b></p>
											<p style="display: inline;">I take my english class at</p>
											<input type="text" id="input-act13-5" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you listen your english class?</b></p>
											<p style="display: inline;">I listen my english class at</p>
											<input type="text" id="input-act13-6" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
									</div>
									<div class="row row-cols-2 mb-5">
										<div class="col">
											<p><b>What time do you take your recess?</b></p>
											<p style="display: inline;">I take my recess at</p>
											<input type="text" id="input-act13-7" class="time-b4" style="display: inline-block;" autocomplete="off">
										</div>
										<div class="col">
											<p><b>What time do you walk to your house?</b></p>
											<p style="display: inline;">I walk to my house at</p>
											<input type="text" id="input-act13-8" class="time-b4" style="display: inline-block;" autocomplete="off">
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

<div id="ModalUnit2Act14" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose your menu and draw what you prefer to eat at</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
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

										#canvas14 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton14 {
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
										<div class="d-flex justify-content-center">
											<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/15-1.jpg" width="75%" class="img-fluid" alt="Foods">	
										</div>
										<div class="grid mb-4">
											<div class="color">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker14" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker14">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton14">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container-fluid d-flex justify-content-center">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas14" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/15.jpg')"
											width="381" height="802">
											</canvas>
										</div>
									</header>
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
			</form>
		</div>
	</div>
</div>

<div id="ModalUnit2Act15" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act15">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose and drag</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Foods</th>
												<tr>
													<td id="box-act15-1" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Fruits</th>
												<tr>
													<td id="box-act15-2" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act15-1">
												<div id="option-act15-37" class="col d-table" draggable="true">cauliflower</div>
												<div id="option-act15-1" class="col d-table" draggable="true">macaroni</div>
												<div id="option-act15-18" class="col d-table" draggable="true">coconut</div>
												<div id="option-act15-2" class="col d-table" draggable="true">pop corn</div>
												<div id="option-act15-3" class="col d-table" draggable="true">butter</div>
												<div id="option-act15-29" class="col d-table" draggable="true">milk</div>
												<div id="option-act15-4" class="col d-table" draggable="true">eggs</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-2">
												<div id="option-act15-19" class="col d-table" draggable="true">zapote</div>
												<div id="option-act15-20" class="col d-table" draggable="true">strawberries</div>
												<div id="option-act15-21" class="col d-table" draggable="true">grapes</div>
												<div id="option-act15-30" class="col d-table" draggable="true">tea</div>
												<div id="option-act15-5" class="col d-table" draggable="true">fish</div>
												<div id="option-act15-6" class="col d-table" draggable="true">cookies</div>
												<div id="option-act15-7" class="col d-table" draggable="true">meat</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-3">
												<div id="option-act15-38" class="col d-table" draggable="true">potatoes</div>
												<div id="option-act15-31" class="col d-table" draggable="true">hot chocolate</div>
												<div id="option-act15-32" class="col d-table" draggable="true">water</div>
												<div id="option-act15-8" class="col d-table" draggable="true">sour cream</div>
												<div id="option-act15-33" class="col d-table" draggable="true">milk shake</div>
												<div id="option-act15-9" class="col d-table" draggable="true">cereal</div>
												<div id="option-act15-22" class="col d-table" draggable="true">watermelon</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-4">
												<div id="option-act15-10" class="col d-table" draggable="true">hot dog</div>
												<div id="option-act15-34" class="col d-table" draggable="true">orange juice</div>
												<div id="option-act15-39" class="col d-table" draggable="true">cabbage</div>
												<div id="option-act15-35" class="col d-table" draggable="true">coffee</div>
												<div id="option-act15-11" class="col d-table" draggable="true">french fries</div>
												<div id="option-act15-40" class="col d-table" draggable="true">carrot</div>
												<div id="option-act15-23" class="col d-table" draggable="true">pear</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-5">
												<div id="option-act15-24" class="col d-table" draggable="true">banana</div>
												<div id="option-act15-12" class="col d-table" draggable="true">rice</div>
												<div id="option-act15-41" class="col d-table" draggable="true">lettuce</div>
												<div id="option-act15-25" class="col d-table" draggable="true">pineapple</div>
												<div id="option-act15-13" class="col d-table" draggable="true">bread</div>
												<div id="option-act15-14" class="col d-table" draggable="true">pizza</div>
												<div id="option-act15-36" class="col d-table" draggable="true">lemonade</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-6">
												<div id="option-act15-26" class="col d-table" draggable="true">mango</div>
												<div id="option-act15-42" class="col d-table" draggable="true">cucumber</div>
												<div id="option-act15-15" class="col d-table" draggable="true">salad</div>
												<div id="option-act15-27" class="col d-table" draggable="true">orange</div>
												<div id="option-act15-28" class="col d-table" draggable="true">apple</div>
												<div id="option-act15-16" class="col d-table" draggable="true">hamburger</div>
												<div id="option-act15-17" class="col d-table" draggable="true">pancake</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Drinks</th>
												<tr>
													<td id="box-act15-3" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Vegetables</th>
												<tr>
													<td id="box-act15-4" class="box-act8-u2"></td>
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

<div id="ModalUnit2Act16" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Drag and choose a sentence according to the image</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row row-cols-2 container-act16">
												<div id="option-act16-4" class="col mb-3" draggable="true">He is climbing the tree.</div>
												<div id="option-act16-6" class="col mb-3" draggable="true">The lady likes to swim.</div>
												<div id="option-act16-3" class="col mb-3" draggable="true">The boy loves skateboarding every evening.</div>
												<div id="option-act16-1" class="col mb-3" draggable="true">The boy is flying a kite.</div>
												<div id="option-act16-7" class="col mb-3" draggable="true">He likes to ride a horse.</div>
												<div id="option-act16-5" class="col mb-3" draggable="true">The boy is running.</div>
												<div id="option-act16-2" class="col mb-3" draggable="true">He rides a bike every afternoon.</div>
											</div>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-1.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-1"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-2.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-2"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-3.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-3"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-4.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-4"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-5.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-5"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-6.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-6"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/18-7.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act16-7"></td>
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

<div id="ModalUnit2Act17" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act17">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Drag and choose a sentence according to the image</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row row-cols-2 container-act16">
												<div id="option-act17-4" class="col mb-3" draggable="true">The boy likes to go fishing.</div>
												<div id="option-act17-6" class="col mb-3" draggable="true">We enjoy playing volleyball.</div>
												<div id="option-act17-3" class="col mb-3" draggable="true">They like to play softball.</div>
												<div id="option-act17-1" class="col mb-3" draggable="true">We like to play basketball.</div>
												<div id="option-act17-5" class="col mb-3" draggable="true">On Sunday I play baseball.</div>
												<div id="option-act17-2" class="col mb-3" draggable="true">I love surfing on the waves.</div>
											</div>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-1.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-1"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-2.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-2"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-3.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-3"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-4.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-4"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-5.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-5"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-6.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act17-6"></td>
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

<div id="ModalUnit2Act18" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the different sports</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/19-7.jpg" alt="Sports" class="img-fluid">
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-1" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-2" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-3" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-4" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-5" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act18-6" placeholder="...">
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

<div id="ModalUnit2Act19" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Drag and choose a sentence according to the image</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row row-cols-2 container-act16">
												<div id="option-act19-4" class="col mb-3" draggable="true">They enjoy playing hide and seek.</div>
												<div id="option-act19-6" class="col mb-3" draggable="true">They are playing yo-yo.</div>
												<div id="option-act19-3" class="col mb-3" draggable="true">They prefer to play jump rope.</div>
												<div id="option-act19-1" class="col mb-3" draggable="true">He likes to play spinning top.</div>
												<div id="option-act19-5" class="col mb-3" draggable="true">He likes to play marbles.</div>
												<div id="option-act19-2" class="col mb-3" draggable="true">She likes to play hopscotch.</div>
											</div>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-1.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-1"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-2.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-2"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-3.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-3"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-4.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-4"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-5.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-5"></td>
												</tr>
												<tr>
													<td width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-6.jpg" class="img-fluid"></td>
													<td width="70%" id="box-act19-6"></td>
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

<div id="ModalUnit2Act20" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act20">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the games</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									<div class="row mb-5">
										<img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/20-7.jpg" alt="Sports" class="img-fluid">
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-1" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-2" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-3" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-4" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-5" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act20-6" placeholder="...">
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

<div id="ModalUnit2Act21" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act21">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Expressing likes and dislikes about sports</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
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

										#canvas14 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearButton21 {
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
										<div class="grid mb-4">
											<div class="color">
												<p>Pick a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker21" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker21">
												</div>
											</div>
											<div class="clear">
												<p>clear the canvas:</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearButton21">Clear canvas</a>
												</div>
											</div>
										</div>

										<div class="container-fluid d-flex justify-content-center">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas21" style="background: url('../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/21.jpg')"
											width="731" height="418">
											</canvas>
										</div>
									</header>
									<div class="row row-cols-2">
										<div class="col">
											<label for="input-act21-1">Express why do you like them:</label>
    										<textarea class="form-control" id="input-act21-1" rows="3"></textarea>
										</div>
										<div class="col">
											<label for="input-act21-2">Express why you don't like them:</label>
    										<textarea class="form-control" id="input-act21-2" rows="3"></textarea>
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
			</form>
		</div>
	</div>
</div>

<div id="ModalUnit2Act22" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act22">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the sports</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-1" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-2" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-3" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-4" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-5" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-6" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-7" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-8" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-9" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-10" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-11" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-12" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-13" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-14" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act22-15" placeholder="...">
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

<div id="ModalUnit2Act23" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act23">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Identifying traditional games</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tbody>
													<tr>
														<th rowspan="2" scope="rowgroup" width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/22-1.jpg" class="img-fluid"></th>
														<td><p><b>What is Francisco doing?</b></p></td>
													</tr>
													<tr>
														<td>
															<select id="select-act23-1" class="form-select">
																<option value="0" disabled selected></option>
																<option value="1">He is playing marbles.</option>
																<option value="2">He is playing yo-yo.</option>
																<option value="3">He is playing spinning top.</option>
															</select>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<th rowspan="2" scope="rowgroup" width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/22-2.jpg" class="img-fluid"></th>
														<td><p><b>What is Melvin doing?</b></p></td>
													</tr>
													<tr>
														<td>
															<select id="select-act23-2" class="form-select">
																<option value="0" disabled selected></option>
																<option value="1">Melvin is playing hopscotch.</option>
																<option value="2">He is jumping rope.</option>
																<option value="3">Melvin is playing yo-yo.</option>
															</select>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<th rowspan="2" scope="rowgroup" width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/22-3.jpg" class="img-fluid"></th>
														<td><p><b>What is Katherine doing?</b></p></td>
													</tr>
													<tr>
														<td>
															<select id="select-act23-3" class="form-select">
																<option value="0" disabled selected></option>
																<option value="1">She is playing hopscotch.</option>
																<option value="2">She is playing jacks.</option>
																<option value="3">Katherine is playing marbles.</option>
															</select>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<th rowspan="2" scope="rowgroup" width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/22-4.jpg" class="img-fluid"></th>
														<td><p><b>What is Patty doing?</b></p></td>
													</tr>
													<tr>
														<td>
															<select id="select-act23-4" class="form-select">
																<option value="0" disabled selected></option>
																<option value="1">They are playing hide and seek.</option>
																<option value="2">She is jumping rope.</option>
																<option value="3">She is playing spinning top.</option>
															</select>
														</td>
													</tr>
												</tbody>
												<tbody>
													<tr>
														<th rowspan="2" scope="rowgroup" width="30%"><img src="../../resources/img/BOOKS/FourthGrade/UnitTwo/activities/22-5.jpg" class="img-fluid"></th>
														<td><p><b>What is Douglas doing?</b></p></td>
													</tr>
													<tr>
														<td>
															<select id="select-act23-5" class="form-select">
																<option value="0" disabled selected></option>
																<option value="1">He is playing hopscotch.</option>
																<option value="2">Douglas is playing spinning top.</option>
																<option value="3">Douglas is playing yo-yo.</option>
															</select>
														</td>
													</tr>
												</tbody>
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

<div id="ModalUnit2Act24" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act24">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the games</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-1" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-2" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-3" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-4" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-5" placeholder="...">
										</div>
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-6" placeholder="...">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col">
											<input type="text" class="form-control" autocomplete="off" id="input-act24-7" placeholder="...">
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

<div id="ModalUnit2Act25" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act25">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the question using can in affirmative and negative form</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2 mb-4">
										<div class="col text-center">
											<b>Question</b>
										</div>
										<div class="col text-center">
											<b>Answer</b>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can the man ride a horse?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-1">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can.</option>
												<option value="2">Yes, she can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-2">
												<option value="0" disabled selected></option>
												<option value="1">No, he can't.</option>
												<option value="2">No, he can.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can the girl fly a kite?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-3">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can.</option>
												<option value="2">Yes, she can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-4">
												<option value="0" disabled selected></option>
												<option value="1">No, he can't.</option>
												<option value="2">No, she can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can the boy climb at the tree?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-5">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can.</option>
												<option value="2">Yes, she can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-6">
												<option value="0" disabled selected></option>
												<option value="1">No, he can't.</option>
												<option value="2">No, she can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can the boy play soccer?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-7">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can't.</option>
												<option value="2">Yes, he can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-8">
												<option value="0" disabled selected></option>
												<option value="1">No, he can't.</option>
												<option value="2">No, she can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can the boy run?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-9">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can not.</option>
												<option value="2">Yes, he can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-10">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can't.</option>
												<option value="2">No, he can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can he ride a bike?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-11">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can.</option>
												<option value="2">Yes, she can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-12">
												<option value="0" disabled selected></option>
												<option value="1">No, he can't.</option>
												<option value="2">No, she can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can you go surfing?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-13">
												<option value="0" disabled selected></option>
												<option value="1">Yes, he can.</option>
												<option value="2">Yes, I can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-14">
												<option value="0" disabled selected></option>
												<option value="1">No, I can't.</option>
												<option value="2">No, she can't.</option>
											</select>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 text-start">
											Can my mother go fishing?
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-15">
												<option value="0" disabled selected></option>
												<option value="1">Yes, she can.</option>
												<option value="2">Yes, he can.</option>
											</select>
										</div>
										<div class="col-3">
											<select class="form-select" id="select-act25-16">
												<option value="0" disabled selected></option>
												<option value="1">No, she can't.</option>
												<option value="2">No, he can't.</option>
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

<div id="ModalUnit2Act26" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act26">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Conjugate</p>
											<input type="text" class="d-none" id="points26" name="points">
											<input type="text" class="d-none" id="idcliente26" name="idcliente">
											<input type="text" class="d-none" id="idlibro26" name="idlibro">
										</div>
									</div>
									<div class="row">
										<table class="table table-bordered">
											<tr>
												<th colspan="3" class="text-center" style="background-color: #ebf7f3;">Present continuous affirmative form verb "to drive"</th>
											</tr>
											<tr>
												<td width="33%" class="text-end">I</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-1" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--1" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">You</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-2" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--2" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">He</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-3" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--3" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">She</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-4" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--4" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">It</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-5" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--5" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">We</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-6" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--6" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">You</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-7" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--7" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="33%" class="text-end">They</td>
												<td width="33%"><input type="text" class="form-control" id="input-act26-8" autocomplete="off"></td>
												<td width="34%"><input type="text" class="form-control" id="input-act26--8" autocomplete="off"></td>
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

<div id="ModalUnit2Act27" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act27">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the question in present continuous in affirmative form</p>
											<input type="text" class="d-none" id="points27" name="points">
											<input type="text" class="d-none" id="idcliente27" name="idcliente">
											<input type="text" class="d-none" id="idlibro27" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>What is Francisco doing?</b> (read)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act27-1">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>What is Katherine doing?</b> (drive)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act27-2">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>What is Maricela doing?</b> (run)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act27-3">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>What is Boris doing?</b> (fly)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act27-4">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>What is Douglas doing?</b> (swim)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act27-5">
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

<div id="ModalUnit2Act28" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act28">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Conjugate</p>
											<input type="text" class="d-none" id="points28" name="points">
											<input type="text" class="d-none" id="idcliente28" name="idcliente">
											<input type="text" class="d-none" id="idlibro28" name="idlibro">
										</div>
									</div>
									<div class="row">
										<table class="table table-bordered">
											<tr>
												<th colspan="4" class="text-center" style="background-color: #ebf7f3;">Present continuous negative form verb "to drive"</th>
											</tr>
											<tr>
												<td width="25%" class="text-end">I</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-1" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--1" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---1" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">You</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-2" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--2" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---2" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">He</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-3" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--3" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---3" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">She</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-4" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--4" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---4" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">It</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-5" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--5" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---5" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">We</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-6" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--6" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---6" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">You</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-7" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--7" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---7" autocomplete="off"></td>
											</tr>
											<tr>
												<td width="25%" class="text-end">They</td>
												<td width="25%"><input type="text" class="form-control" id="input-act28-8" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28--8" autocomplete="off"></td>
												<td width="25%"><input type="text" class="form-control" id="input-act28---8" autocomplete="off"></td>
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

<div id="ModalUnit2Act29" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act29">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the question in present continuous in negative form</p>
											<input type="text" class="d-none" id="points29" name="points">
											<input type="text" class="d-none" id="idcliente29" name="idcliente">
											<input type="text" class="d-none" id="idlibro29" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>Is Francisco reading?</b> (read)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act29-1">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>Is Katherine driving?</b> (drive)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act29-2">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>Is Marcela running?</b> (run)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act29-3">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>Is Boris flying?</b> (fly)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act29-4">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<p><b>Is Douglas swimming?</b> (swim)</p>
										</div>
										<div class="col">
											<input type="text" class="form-control" id="input-act29-5">
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

<div id="ModalUnit2Act30" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act30">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the question using the verb "to do" in affirmative and negative form.</p>
											<input type="text" class="d-none" id="points30" name="points">
											<input type="text" class="d-none" id="idcliente30" name="idcliente">
											<input type="text" class="d-none" id="idlibro30" name="idlibro">
										</div>
									</div>
									<div class="row">
										<table class="table table-bordered">
											<tr style="background-color: #f6dcab;">
												<th class="text-center">Question</th>
												<th class="text-center">Affirmative form</th>
												<th class="text-center">Negative form</th>
											</tr>
											<tr>
												<td>1. Does Francisco read?</td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-1"></td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-2"></td>
											</tr>
											<tr>
												<td>2. Does Katherine drive?</td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-3"></td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-4"></td>
											</tr>
											<tr>
												<td>3. Does Maricela run?</td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-5"></td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-6"></td>
											</tr>
											<tr>
												<td>4. Does Boris fly?</td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-7"></td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-8"></td>
											</tr>
											<tr>
												<td>5. Does Douglas swim?</td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-9"></td>
												<td><input type="text" class="form-control" autocomplete="off" id="input-act30-10"></td>
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

<div id="ModalUnit2Act31" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act31">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write a dialogue using do, does and doesn't</p>
											<input type="text" class="d-none" id="points31" name="points">
											<input type="text" class="d-none" id="idcliente31" name="idcliente">
											<input type="text" class="d-none" id="idlibro31" name="idlibro">
										</div>
									</div>
									<div class="row">
										<table style="border-collapse: separate; border-spacing: 14px 21px;">
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-1"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-2"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-3"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-4"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-5"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-6"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-7"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-8"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-9"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-10"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-11"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-12"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-13"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-14"></td>
											</tr>
											<tr>
												<td width="30%"><input type="text" class="form-control" autocomplete="off" id="input-act31-15"></td>
												<td width="70%"><input type="text" class="form-control" autocomplete="off" id="input-act31-16"></td>
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

<div id="ModalUnit2Act32" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act32">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the days of the week</p>
											<input type="text" class="d-none" id="points32" name="points">
											<input type="text" class="d-none" id="idcliente32" name="idcliente">
											<input type="text" class="d-none" id="idlibro32" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<label for="input-act32-1">1.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-1">
									</div>
									<div class="row mb-4">
										<label for="input-act32-2">2.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-2">
									</div>
									<div class="row mb-4">
										<label for="input-act32-3">3.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-3">
									</div>
									<div class="row mb-4">
										<label for="input-act32-4">4.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-4">
									</div>
									<div class="row mb-4">
										<label for="input-act32-5">5.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-5">
									</div>
									<div class="row mb-4">
										<label for="input-act32-6">6.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-6">
									</div>
									<div class="row mb-4">
										<label for="input-act32-7">7.</label>
										<input type="text" class="form-control" autocomplete="off" id="input-act32-7">
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

<div id="ModalUnit2Act33" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act33">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the possesive adjective</p>
											<input type="text" class="d-none" id="points33" name="points">
											<input type="text" class="d-none" id="idcliente33" name="idcliente">
											<input type="text" class="d-none" id="idlibro33" name="idlibro">
										</div>
									</div>
									<div class="row">
										<table class="table table-bordered">
											<tr>
												<td width="15%" class="text-center">My</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-1" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Your</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-2" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">His</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-3" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Her</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-4" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Its</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-5" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Our</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-6" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Your</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-7" class="form-control"></td>
											</tr>
											<tr>
												<td width="15%" class="text-center">Their</td>
												<td width="85%"><input type="text" autocomplete="off" id="input-act33-8" class="form-control"></td>
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

<div id="ModalUnit2Act34" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act34">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose and drag</p>
											<input type="text" class="d-none" id="points34" name="points">
											<input type="text" class="d-none" id="idcliente34" name="idcliente">
											<input type="text" class="d-none" id="idlibro34" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Days of the week</th>
												<tr>
													<td id="box-act34-1" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Outdoor activities</th>
												<tr>
													<td id="box-act34-2" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act34-1">
												<div id="option-act34-8" class="col d-table" draggable="true">skate boarding</div>
												<div id="option-act34-9" class="col d-table" draggable="true">fly a kite</div>
												<div id="option-act34-18" class="col d-table" draggable="true">jacks</div>
												<div id="option-act34-10" class="col d-table" draggable="true">ride a horse</div>
												<div id="option-act34-26" class="col d-table" draggable="true">my</div>
												<div id="option-act34-1" class="col d-table" draggable="true">Sunday</div>
												<div id="option-act34-11" class="col d-table" draggable="true">jump</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act34-2">
												<div id="option-act34-27" class="col d-table" draggable="true">his</div>
												<div id="option-act34-19" class="col d-table" draggable="true">hopscotch</div>
												<div id="option-act34-12" class="col d-table" draggable="true">roller skate</div>
												<div id="option-act34-13" class="col d-table" draggable="true">swim</div>
												<div id="option-act34-20" class="col d-table" draggable="true">jump rope</div>
												<div id="option-act34-2" class="col d-table" draggable="true">Tuesday</div>
												<div id="option-act34-14" class="col d-table" draggable="true">climb a tree</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act34-3">
												<div id="option-act34-21" class="col d-table" draggable="true">marbles</div>
												<div id="option-act34-22" class="col d-table" draggable="true">hide and seek</div>
												<div id="option-act34-23" class="col d-table" draggable="true">yo-yo</div>
												<div id="option-act34-3" class="col d-table" draggable="true">Thursday</div>
												<div id="option-act34-28" class="col d-table" draggable="true">her</div>
												<div id="option-act34-15" class="col d-table" draggable="true">ride a bike</div>
												<div id="option-act34-4" class="col d-table" draggable="true">Friday</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act34-4">
												<div id="option-act34-29" class="col d-table" draggable="true">our</div>
												<div id="option-act34-5" class="col d-table" draggable="true">Wednesday</div>
												<div id="option-act34-16" class="col d-table" draggable="true">run</div>
												<div id="option-act34-30" class="col d-table" draggable="true">their</div>
												<div id="option-act34-6" class="col d-table" draggable="true">Monday</div>
												<div id="option-act34-24" class="col d-table" draggable="true">spinning top</div>
												<div id="option-act34-31" class="col d-table" draggable="true">its</div>
											</div>
											<br>
											<div class="row d-flex justify-content-between" id="container-act15-5">
												<div id="option-act34-17" class="col d-table" draggable="true">play soccer</div>
												<div id="option-act34-7" class="col d-table" draggable="true">Saturday</div>
												<div id="option-act34-25" class="col d-table" draggable="true">Thieves and policeman</div>
											</div>
											<br>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Traditional games</th>
												<tr>
													<td id="box-act34-3" class="box-act8-u2"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center box-act8-u2">Possesive adjectives</th>
												<tr>
													<td id="box-act34-4" class="box-act8-u2"></td>
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

<div id="ModalUnit2Act35" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act35">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write in letters the numbers</p>
											<input type="text" class="d-none" id="points35" name="points">
											<input type="text" class="d-none" id="idcliente35" name="idcliente">
											<input type="text" class="d-none" id="idlibro35" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">61</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-1" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">62</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-2" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">63</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-3" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">64</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-4" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">65</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-5" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">66</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-6" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">67</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-7" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">68</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-8" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">69</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-9" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">70</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-10" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<tr>
													<th width="20%" scope="row" class="th-act8">71</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-11" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">72</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-12" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">73</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-13" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">74</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-14" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">75</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-15" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">76</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-16" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">77</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-17" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">78</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-18" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">79</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-19" placeholder="Write the number..." maxlength="13">
													</td>
												</tr>
												<tr>
													<th width="20%" scope="row" class="th-act8">80</th>
													<td width="80%" class="box-act8-u2">
														<input autocomplete="off" type="text" class="form-control" id="input-act35-20" placeholder="Write the number..." maxlength="13">
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

<div id="ModalUnit2Act36" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content" align="center">
			<div class="modal-header" align="center">
				<h5 class="modal-title" id="modal-title" align="center">Find 18 hidden sports</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act36">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points36" name="points">
											<input type="text" class="d-none" id="idcliente36" name="idcliente">
											<input type="text" class="d-none" id="idlibro36" name="idlibro">
										</div>
									</div>
                                    <br>
                                    <table style="border: 2px solid #f99d52; background-color: #fbebc9; " width="">
                                        <tr><!-- ROW ONE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-1" onclick="checkCells('act36-1')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-2" onclick="checkCells('act36-2')">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-3" onclick="checkCells('act36-3')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-4" onclick="checkCells('act36-4')">M</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-5" onclick="checkCells('act36-5')">M</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-6" onclick="checkCells('act36-6')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-7" onclick="checkCells('act36-7')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-8" onclick="checkCells('act36-8')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">B</th>
                                            <th class="text-center cell-act21" width="30" height="30">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                        </tr>
										<tr><!-- ROW TWO -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-9" onclick="checkCells('act36-9')">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">M</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-10" onclick="checkCells('act36-10')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-11" onclick="checkCells('act36-11')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-12" onclick="checkCells('act36-12')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-13" onclick="checkCells('act36-13')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-14" onclick="checkCells('act36-14')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-15" onclick="checkCells('act36-15')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-16" onclick="checkCells('act36-16')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-17" onclick="checkCells('act36-17')">L</th>
                                        </tr>
										<tr><!-- ROW THREE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-18" onclick="checkCells('act36-18')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-19" onclick="checkCells('act36-19')">V</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-20" onclick="checkCells('act36-20')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-21" onclick="checkCells('act36-21')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-22" onclick="checkCells('act36-22')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-23" onclick="checkCells('act36-23')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-24" onclick="checkCells('act36-24')">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-25" onclick="checkCells('act36-25')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-26" onclick="checkCells('act36-26')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-27" onclick="checkCells('act36-27')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-28" onclick="checkCells('act36-28')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                        </tr>
										<tr><!-- ROW FOUR -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-29" onclick="checkCells('act36-29')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-30" onclick="checkCells('act36-30')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-31" onclick="checkCells('act36-31')">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-32" onclick="checkCells('act36-32')">M</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-33" onclick="checkCells('act36-33')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-34" onclick="checkCells('act36-34')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-35" onclick="checkCells('act36-35')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-36" onclick="checkCells('act36-36')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-37" onclick="checkCells('act36-37')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-38" onclick="checkCells('act36-38')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-39" onclick="checkCells('act36-39')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30">Q</th>
                                            <th class="text-center cell-act21" width="30" height="30">F</th>
                                        </tr>
										<tr><!-- ROW FIVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-40" onclick="checkCells('act36-40')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30">J</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-41" onclick="checkCells('act36-41')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">D</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-42" onclick="checkCells('act36-42')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-43" onclick="checkCells('act36-43')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-44" onclick="checkCells('act36-44')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-45" onclick="checkCells('act36-45')">K</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-46" onclick="checkCells('act36-46')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-47" onclick="checkCells('act36-47')">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                        </tr>
										<tr><!-- ROW SIX -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-48" onclick="checkCells('act36-48')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-49" onclick="checkCells('act36-49')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-50" onclick="checkCells('act36-50')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-51" onclick="checkCells('act36-51')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-52" onclick="checkCells('act36-52')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-53" onclick="checkCells('act36-53')">X</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-54" onclick="checkCells('act36-54')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-55" onclick="checkCells('act36-55')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-56" onclick="checkCells('act36-56')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-57" onclick="checkCells('act36-57')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                        </tr>
										<tr><!-- ROW SEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-58" onclick="checkCells('act36-58')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-59" onclick="checkCells('act36-59')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-60" onclick="checkCells('act36-60')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-61" onclick="checkCells('act36-61')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">M</th>
                                            <th class="text-center cell-act21" width="30" height="30">P</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-62" onclick="checkCells('act36-62')">D</th>
                                        </tr>
										<tr><!-- ROW EIGHT -->
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-63" onclick="checkCells('act36-63')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-64" onclick="checkCells('act36-64')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-65" onclick="checkCells('act36-65')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-66" onclick="checkCells('act36-66')">U</th>
                                            <th class="text-center cell-act21" width="30" height="30">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-67" onclick="checkCells('act36-67')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-68" onclick="checkCells('act36-68')">U</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-69" onclick="checkCells('act36-69')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-70" onclick="checkCells('act36-70')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-71" onclick="checkCells('act36-71')">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-72" onclick="checkCells('act36-72')">I</th>
                                        </tr>
										<tr><!-- ROW NINE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-73" onclick="checkCells('act36-73')">K</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-74" onclick="checkCells('act36-74')">D</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-75" onclick="checkCells('act36-75')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-76" onclick="checkCells('act36-76')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-77" onclick="checkCells('act36-77')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">D</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">M</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-78" onclick="checkCells('act36-78')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-79" onclick="checkCells('act36-79')">V</th>
                                        </tr>
										<tr><!-- ROW TEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-80" onclick="checkCells('act36-80')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-81" onclick="checkCells('act36-81')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-82" onclick="checkCells('act36-82')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">D</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-83" onclick="checkCells('act36-83')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-84" onclick="checkCells('act36-84')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30">U</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-85" onclick="checkCells('act36-85')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">Y</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-86" onclick="checkCells('act36-86')">I</th>
                                        </tr>
										<tr><!-- ROW ELEVEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-87" onclick="checkCells('act36-87')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-88" onclick="checkCells('act36-88')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-89" onclick="checkCells('act36-89')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-90" onclick="checkCells('act36-90')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-91" onclick="checkCells('act36-91')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">J</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-92" onclick="checkCells('act36-92')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-93" onclick="checkCells('act36-93')">N</th>
                                        </tr>
										<tr><!-- ROW TWELVE -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-94" onclick="checkCells('act36-94')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-95" onclick="checkCells('act36-95')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-96" onclick="checkCells('act36-96')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-97" onclick="checkCells('act36-97')">W</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-98" onclick="checkCells('act36-98')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-99" onclick="checkCells('act36-99')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-100" onclick="checkCells('act36-100')">D</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-101" onclick="checkCells('act36-101')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-102" onclick="checkCells('act36-102')">U</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-103" onclick="checkCells('act36-103')">R</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-104" onclick="checkCells('act36-104')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-105" onclick="checkCells('act36-105')">I</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-106" onclick="checkCells('act36-106')">N</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-107" onclick="checkCells('act36-107')">G</th>
                                        </tr>
										<tr><!-- ROW THIRTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-108" onclick="checkCells('act36-108')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-109" onclick="checkCells('act36-109')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-110" onclick="checkCells('act36-110')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-111">U</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-112" onclick="checkCells('act36-112')">S</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-113" onclick="checkCells('act36-113')">G</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-114" onclick="checkCells('act36-114')">F</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-115" onclick="checkCells('act36-115')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-116" onclick="checkCells('act36-116')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-117" onclick="checkCells('act36-117')">T</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-118" onclick="checkCells('act36-118')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-119" onclick="checkCells('act36-119')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-120" onclick="checkCells('act36-120')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-121" onclick="checkCells('act36-121')">L</th>
                                        </tr>
										<tr><!-- ROW FOURTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-122" onclick="checkCells('act36-122')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">R</th>
                                            <th class="text-center cell-act21" width="30" height="30">C</th>
                                            <th class="text-center cell-act21" width="30" height="30">I</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">D</th>
                                            <th class="text-center cell-act21" width="30" height="30">G</th>
                                            <th class="text-center cell-act21" width="30" height="30">S</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">T</th>
                                            <th class="text-center cell-act21" width="30" height="30">E</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30">K</th>
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                        </tr>
										<tr><!-- ROW FIFTEEN -->
                                            <th class="text-center cell-act21" width="30" height="30">A</th>
                                            <th class="text-center cell-act21" width="30" height="30">D</th>
                                            <th class="text-center cell-act21" width="30" height="30">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-123" onclick="checkCells('act36-123')">B</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-124" onclick="checkCells('act36-124')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-125" onclick="checkCells('act36-125')">A</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-126" onclick="checkCells('act36-126')">C</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-127" onclick="checkCells('act36-127')">H</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-128" onclick="checkCells('act36-128')">V</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-129" onclick="checkCells('act36-129')">O</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-130" onclick="checkCells('act36-130')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-131" onclick="checkCells('act36-131')">L</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-132" onclick="checkCells('act36-132')">E</th>
                                            <th class="text-center cell-act21" width="30" height="30" id="act36-133" onclick="checkCells('act36-133')">Y</th>
                                        </tr>
                                    </table>
									<div class="row pt-4">
										<p class="text-center">Write the words</p>
									</div>
									<div class="row">
										<div class="col-6">
											<p class="text-center">Down</p>
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-1">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-2">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-3">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-4">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-5">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-6">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-7">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-8">
										</div>
										<div class="col-6">
											<p class="text-center">Across</p>
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-9">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-10">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-11">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-12">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-13">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-14">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-15">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-16">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-17">
											<input autocomplete="off" type="text" class="form-control mb-3" id="input-act36-18">
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
	<script  src="../../app/controllers/BookTwoUnitOne/wordfindpage7.js"></script>
</div>

<div id="ModalUnit2Audio1" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio1">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track01.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio2" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio2">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track26.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio3" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio3">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track27.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio4" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio4">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track28.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio5" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio5">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track29.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio6" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio6">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track30.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio7" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio7">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track31.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio8" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio8">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track32.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio9" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio9">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track33.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio10" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio10">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track34.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio11" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio11">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track35.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio12" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio12">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track36.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio13" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio13">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track37.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit2Audio14" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit2-audio14">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_cuarto/UnitTwo/Track38.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro4_u2.js');
?>