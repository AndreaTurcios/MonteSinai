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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/21.JPG" width="76" height="100"
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

			pages: 32,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidaddosseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit2Act1" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the vocabulary you hear</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitTwo/TRACK13.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-5" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-6" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-7" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-8" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-9" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-10" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-11" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-12" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-13" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-14" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-15" placeholder="...">
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

<div id="ModalUnit2Act2" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the commands you hear</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitTwo/TRACK14.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-1" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-2" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-3" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-4" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-5" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-6" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-7" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-8" placeholder="...">
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the preposition you hear</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitTwo/TRACK15.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>Put your books</label>
                                        <select id="select-act3-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">under</option>
                                            <option value="2">on</option>
                                            <option value="3">in</option>
                                        </select>
										<label>the desk.</label>
                                    </div>
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>Is your pen</label>
                                        <select id="select-act3-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">under</option>
                                            <option value="2">on</option>
                                            <option value="3">in</option>
                                        </select>
										<label>the table?</label>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>She was waiting</label>
                                        <select id="select-act3-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">by</option>
                                            <option value="2">at</option>
                                        </select>
										<label>the corner.</label>
                                    </div>
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>I live</label>
                                        <select id="select-act3-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">under</option>
                                            <option value="2">on</option>
                                            <option value="3">in</option>
                                        </select>
										<label>the big green and white house.</label>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>The cat is</label>
                                        <select id="select-act3-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">under</option>
                                            <option value="2">on</option>
                                            <option value="3">in</option>
                                        </select>
										<label>the bed.</label>
                                    </div>
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>There is an ice cream shop</label>
                                        <select id="select-act3-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">by</option>
                                            <option value="2">at</option>
                                        </select>
										<label>the store.</label>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>Margarita lives</label>
                                        <select id="select-act3-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">near</option>
                                            <option value="2">next to</option>
                                        </select>
										<label>the school.</label>
                                    </div>
                                    <div class="col p-2 d-flex items-align-center">
                                        <label>The church is </label>
                                        <select id="select-act3-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">near</option>
                                            <option value="2">next to </option>
                                        </select>
										<label>my house.</label>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 p-3">
									<div class="col d-flex align-items-center">
										<label>What is </label>
                                        <select id="select-act4-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">this</option>
                                            <option value="2">these</option>
                                        </select>
										<label>?</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>What are </label>
                                        <select id="select-act4-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">this</option>
                                            <option value="2">these</option>
                                        </select>
										<label>?</label>
									</div>
								</div>
								<div class="row row-cols-2 p-3">
									<div class="col d-flex align-items-center">
										<label>What is </label>
                                        <select id="select-act4-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">that</option>
                                            <option value="2">those</option>
                                        </select>
										<label>?</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>What are </label>
                                        <select id="select-act4-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">that</option>
                                            <option value="2">those</option>
                                        </select>
										<label>?</label>
									</div>
								</div>
								<div class="row row-cols-2 p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act4-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">That</option>
                                            <option value="2">Those</option>
                                        </select>
										<label>horse is really big.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act4-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">This</option>
                                            <option value="2">These</option>
                                        </select>
										<label>food is delicious.</label>
									</div>
								</div>
								<div class="row row-cols-2 p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act4-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">That</option>
                                            <option value="2">Those</option>
                                        </select>
										<label>shoes are really nice.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act4-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">These</option>
                                            <option value="2">This</option>
                                        </select>
										<label>are my books.</label>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is a classroom command?</b></p>
                                        <select id="select-act5-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Sentences or expression in the imperative form that are used in the classroom frequently.</option>
                                            <option value="2">Words that indicate which entities a speaker refers to.</option>
                                            <option value="3">Words used to clarify a specific place.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a preposition of place?</b></p>
                                        <select id="select-act5-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Sentences or expression in the imperative form that are used in the classroom frequently.</option>
                                            <option value="2">Words that indicate which entities a speaker refers to.</option>
                                            <option value="3">Words used to clarify a specific place.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the classroom commands</b></p>
                                        <select id="select-act5-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">These are my new shoes.</option>
                                            <option value="2">Take out your book.</option>
                                            <option value="3">The cat is under the bed.</option>
                                        </select>
										<br>
										<select id="select-act5-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">This is my notebook.</option>
                                            <option value="2">Look at the blackboard.</option>
                                            <option value="3">This is my new car.</option>
                                        </select>
										<br>
										<select id="select-act5-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Talk to your partner.</option>
                                            <option value="2">That is my eraser.</option>
                                            <option value="3">Clean your room.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the sentences that use prepositions of place</b></p>
                                        <select id="select-act5-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">My brother is sleeping.</option>
                                            <option value="2">The dog is playing with a ball.</option>
                                            <option value="3">His cat is under the table.</option>
                                        </select>
										<br>
                                        <select id="select-act5-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The ruler is next to the eraser.</option>
                                            <option value="2">The umbrella is wet.</option>
                                            <option value="3">This is my new notebook.</option>
                                        </select>
										<br>
                                        <select id="select-act5-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Nice to meet you, I'm Francisco.</option>
                                            <option value="2">My sister is at the mall.</option>
                                            <option value="3">That horse is really big.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show acceptance of errors?</b></p>
                                        <select id="select-act5-9" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring other people's mistakes.</option>
                                            <option value="2">Helping my partners when they need it.</option>
                                            <option value="3">Laughing at the errors my partners make.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How can we begin a nice friendship?</b></p>
                                        <select id="select-act5-10" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By not cooperating with our peers.</option>
                                            <option value="2">By making fun of and mistreat them.</option>
                                            <option value="3">By being polite and cooperating with out classmates.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. What similarity do you find between a command in English with the one of Spanish?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act5-1">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How could you demonstrate that you are responsible against assumed duties?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act5-2">
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the sentences using the correct personal item</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-1.jpg" alt="Shirt"></td>
										<td>
											<div class="d-flex align-items-center">
												<label>This is Kevin's</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-1" style="width: 100px;">
											</div>
										</td>									
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-2.jpg" alt="Umbrella"></td>
										<td>
											<div class="d-flex align-items-center">
												<label>Did you bring an </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-2" style="width: 100px;">
												<label>? </label>
											</div>
										</td>									
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-3.jpg" alt="Shoes"></td>
										<td>
											<div class="d-flex align-items-center">
												<label>Look at my new </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-3" style="width: 100px;">
											</div>
										</td>									
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-4.jpg" alt="Calculator"></td>
										<td>
											<div class="d-flex align-items-center">
												<label>This is my father's</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-4" style="width: 100px;">
											</div>
										</td>									
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-5.jpg" alt="Keys"></td>
										<td>
											<div class="d-flex align-items-center">
												<label>I can't find my</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-5" style="width: 100px;">
											</div>
										</td>									
									</tr>
								</table>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit2-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct use of possessive adjectives</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
										<label>This is </label>
                                        <select id="select-act7-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">my</option>
                                            <option value="2">me</option>
                                            <option value="3">I</option>
                                        </select>
										<label>brother.</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>Is this </label>
                                        <select id="select-act7-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">they're</option>
                                            <option value="2">their</option>
                                            <option value="3">these</option>
                                        </select>
										<label>pool.</label>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act7-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">This</option>
                                            <option value="2">He's</option>
                                            <option value="3">His</option>
                                        </select>
										<label>cat is small.</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>It is </label>
                                        <select id="select-act7-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">she</option>
                                            <option value="2">her</option>
                                            <option value="3">there</option>
                                        </select>
										<label>dress.</label>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
										<label>He is</label>
                                        <select id="select-act7-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">you're</option>
                                            <option value="2">your</option>
                                            <option value="3">you</option>
                                        </select>
										<label> uncle.</label>
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
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer to complete the questions</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Where</option>
                                            <option value="2">Why</option>
                                            <option value="3">What</option>
                                        </select>
										<label>is your book?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Who</option>
                                            <option value="2">When</option>
                                            <option value="3">How</option>
                                        </select>
										<label>is your birthday?</label>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Who</option>
                                            <option value="2">When</option>
                                            <option value="3">How</option>
                                        </select>
										<label>did you work with?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Where</option>
                                            <option value="2">Why</option>
                                            <option value="3">What</option>
                                        </select>
										<label>is your name?</label>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Why</option>
                                            <option value="2">When</option>
                                            <option value="3">How</option>
                                        </select>
										<label> is your brother?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Are</option>
                                            <option value="2">Is</option>
                                            <option value="3">Am</option>
                                        </select>
										<label> this your eraser?</label>
									</div>
								</div>
								<div class="row row-cols-2 p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Are</option>
                                            <option value="2">Is</option>
                                            <option value="3">Am</option>
                                        </select>
										<label> those shoes new?</label>
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
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the missing vocabulary</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitTwo/TRACK20.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Eraser" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Pen" maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-12" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Map" maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-11" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Ruler" maxlength="16">
									</div>
								</div>
								
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Pencil" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-1" placeholder="..." maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Book" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-2" placeholder="..." maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Table" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Chair" maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Chalk" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-3" placeholder="..." maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-4" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-5" placeholder="..." maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-6" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-7" placeholder="..." maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Liquid paper" maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Notebook" maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-8" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" disabled value="Dictionary" maxlength="16">
									</div>
								</div>
								<div class="row row-cols-2 p-2">
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-9" placeholder="..." maxlength="16">
									</div>
									<div class="col">
										<input type="text" autocomplete="off" class="form-control" id="input-act9-10" placeholder="..." maxlength="16">
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
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is a Wh- Question?</b></p>
                                        <select id="select-act10-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">An object used by students and teachers to interact using this material.</option>
                                            <option value="2">A word used to allow a speaker find out more information about topics.</option>
                                            <option value="3">A part of speech that modifies a noun by attributing possession to someone or something.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a possessive adjective?</b></p>
                                        <select id="select-act10-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">An object used by students and teachers to interact using this material.</option>
                                            <option value="2">A word used to allow a speaker find out more information about topics.</option>
                                            <option value="3">A part of speech that modifies a noun by attributing possession to someone or something.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the correct Wh- question</b></p>
                                        <div class="row row-cols-2 p-4">
											<div class="col d-flex align-items-center">
												<select id="select-act10-3" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Where</option>
													<option value="2">Why</option>
													<option value="3">What</option>
												</select>
												<label>did you close the window?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act10-4" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Who</option>
													<option value="2">What</option>
													<option value="3">How</option>
												</select>
												<label>did you do that?</label>
											</div>
										</div>
										<div class="row row-cols-2 p-4">
											<div class="col d-flex align-items-center">
												<select id="select-act10-5" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">How</option>
													<option value="2">What</option>
													<option value="3">Who</option>
												</select>
												<label>was today's class?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act10-6" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Where</option>
													<option value="2">Why</option>
													<option value="3">What</option>
												</select>
												<label>is your house?</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the name of the personal items</b></p>
										<table class="table">
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-1.jpg" alt="Shirt"></td>
												<td>
													<div class="d-flex align-items-center">
														<input type="text" autocomplete="off" class="form-control" id="input-act10-1">
													</div>
												</td>									
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-2.jpg" alt="Umbrella"></td>
												<td>
													<div class="d-flex align-items-center">
														<input type="text" autocomplete="off" class="form-control" id="input-act10-2" >
													</div>
												</td>									
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-3.jpg" alt="Shoes"></td>
												<td>
													<div class="d-flex align-items-center">
														<input type="text" autocomplete="off" class="form-control" id="input-act10-3" >
													</div>
												</td>									
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-4.jpg" alt="Calculator"></td>
												<td>
													<div class="d-flex align-items-center">
														<input type="text" autocomplete="off" class="form-control" id="input-act10-4">
													</div>
												</td>									
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/7-5.jpg" alt="Keys"></td>
												<td>
													<div class="d-flex align-items-center">
														<input type="text" autocomplete="off" class="form-control" id="input-act10-5">
													</div>
												</td>									
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show respect when talking?</b></p>
                                        <select id="select-act10-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring the other person.</option>
                                            <option value="2">Paying attention to the other person.</option>
                                            <option value="3">Looking away from the person we are talking to.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How can you follow the class behavior code?</b></p>
                                        <select id="select-act10-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Not cooperating with our peers.</option>
                                            <option value="2">Being disrespectful and unpunctual.</option>
                                            <option value="3">Dressing correctly, being punctual, prepared and respectful.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How could you use Wh- question brainstorming to solve problems?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act10-6">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How would you establish mechanisms of verification of results using Wh- Questions?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act10-7">
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
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the colors</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
								</div>
								<img src="../../resources/img/BOOKS/SeventhGrade/UnitTwo/activities/12.jpg" alt="Colors">
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act11-1" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act11-2" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act11-3" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act11-4" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act11-5" placeholder="...">
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
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the expressions of thanks and useful expressions</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
								</div>
								<div>
									<input type="checkbox" id="cb12-1"><label for="cb12-1">&nbsp;Good afternoon.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-2"><label for="cb12-2">&nbsp;Thanks a lot.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-3"><label for="cb12-3">&nbsp;Turn on the computer.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-4"><label for="cb12-4">&nbsp;He is my father.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-5"><label for="cb12-5">&nbsp;You're welcome.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-6"><label for="cb12-6">&nbsp;His umbrella is red.</label>
								</div>
								<div>
									<input type="checkbox" id="cb12-7"><label for="cb12-7">&nbsp;Close the windows.</label>
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
Book_Page::footerTemplate('controladorlibro7_u2.js');
?>