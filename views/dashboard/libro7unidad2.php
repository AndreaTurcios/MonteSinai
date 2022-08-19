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

<div id="ModalUnit1Act4" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the verb "to be"</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-3">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-1" placeholder="1...">
								</div>
								<div class="row p-3">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-2" placeholder="2...">
								</div>
								<div class="row p-3">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-3" placeholder="3...">
								</div>
								<div class="row p-3">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-4" placeholder="4...">
								</div>
								<div class="row p-3">
									<input type="text" autocomplete="off" class="form-control" id="input-act4-5" placeholder="5...">
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

<div id="ModalUnit1Act5" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the most aproppiate answer</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p>Select an example of being polite:</p>
                                        <select id="select-act5-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignore my teachers when they ask me a question.</option>
                                            <option value="2">Greeting my teachers and classmates everyday.</option>
                                            <option value="3">Not saying please when asking for a favor.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p>How could we verify that you are respecting people?</p>
                                        <select id="select-act5-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Checking if I treat others the way i'd like to be treated.</option>
                                            <option value="2">Knowing that I dislike and mistreat people.</option>
                                            <option value="3">When I make fun of other people.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p>What is to respect people's dignity?</p>
                                        <select id="select-act5-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">To judge people without knowing them.</option>
                                            <option value="2">To accept people the way they are and treat them equally.</option>
                                            <option value="3">To make fun of and mistreat other people.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p>How could you respect people's rights?</p>
                                        <select id="select-act5-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring and treating them badly.</option>
                                            <option value="2">Making fun of their opinion because it's different from mine.</option>
                                            <option value="3">Listening to what they have to say and tolerating them.</option>
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

<div id="ModalUnit1Act6" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is an introduction?</b></p>
                                        <select id="select-act6-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">It is a presentation of one person to another or others.</option>
                                            <option value="2">It is being gentle, not forceful or insistent.</option>
                                            <option value="3">It is a word used as subject in a sentence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. Select the introduction</b></p>
                                        <select id="select-act6-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Respecting other people's opinions.</option>
                                            <option value="2">Nice to meet you, I'm Mario.</option>
                                            <option value="3">I really appreciate your help.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write the missing questions</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-1">
										<p>I'm fine, thank you.</p>
										<br>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-2">
										<p>Not bad, thank you.</p>
										<br>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-3">
										<p>Nice to meet you, I'm Vanessa.</p>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the correct answer</b></p>
										<p>How is your mother?</p>
                                        <select id="select-act6-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">She is fine.</option>
                                            <option value="2">He is good.</option>
                                            <option value="3">I am OK.</option>
                                        </select>
										<br>
										<p>How are you, my friend?</p>
                                        <select id="select-act6-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">She is fine.</option>
                                            <option value="2">He is good.</option>
                                            <option value="3">I am OK.</option>
                                        </select>
										<br>
										<p>How do you do? I'm Katherine.</p>
                                        <select id="select-act6-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Nice to meet you, I'm Francisco.</option>
                                            <option value="2">Thank you.</option>
                                            <option value="3">How is your Father?</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can we have a real friendship?</b></p>
                                        <select id="select-act6-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Lying and mistreating each other.</option>
                                            <option value="2">Respecting and being polite to each other.</option>
                                            <option value="3">Refusing to help our friends when needed.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. What is to respect people's dignity?</b></p>
                                        <select id="select-act6-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">To judge people without knowing them.</option>
                                            <option value="2">To make fun of and mistreat other people.</option>
                                            <option value="3">To accept people the way they are and treat them equally.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How can you adapt the sounds of Spanish to the ones of English?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-4">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Can you explain if you are proactive?
											Do you anticipate to act with courtesy?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-5">
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

<div id="ModalUnit1Act1" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the greetings you hear</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitOne/TRACK03.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-5" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-6" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-7" placeholder="...">
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


<div id="ModalUnit1Act8" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct pronouns</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I</option>
                                            <option value="2">You</option>
                                            <option value="3">It</option>
                                        </select>
										<label>is a shiny rock.</label>
									</div>
								</div>
								<div class="row p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">She</option>
                                            <option value="2">He</option>
                                            <option value="3">It</option>
                                        </select>
										<label>is my mother.</label>
									</div>
								</div>
								<div class="row p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I</option>
                                            <option value="2">They</option>
                                            <option value="3">It</option>
                                        </select>
										<label>are playing soccer.</label>
									</div>
								</div>
								<div class="row p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I</option>
                                            <option value="2">She</option>
                                            <option value="3">You</option>
                                        </select>
										<label>am studying English.</label>
									</div>
								</div>
								<div class="row p-4">
									<div class="col d-flex align-items-center">
                                        <select id="select-act8-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">He</option>
                                            <option value="2">She</option>
                                            <option value="3">You</option>
                                        </select>
										<label>is my uncle.</label>
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

<div id="ModalUnit1Act9" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct questions and answer to confirm telephone numbers</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Which is your telephone number Boris?</option>
                                            <option value="2">What's your telephone number Boris?</option>
                                            <option value="3">Is your telephone number Boris?</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">My telephone number is 22910347.</option>
                                            <option value="2">Is my telephone number 22910347.</option>
                                            <option value="3">His telephone number is 22910347.</option>
                                        </select>
									</div>
								</div>
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I'm sorry, did you said 22910357?</option>
                                            <option value="2">I'm sorry, do you said 22910357?</option>
                                            <option value="3">I'm sorry, did you say 22910357?</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">No, my telephone number is 22910347.</option>
                                            <option value="2">No, is my telephone number 22910347.</option>
                                            <option value="3">No, his telephone number is 22910347.</option>
                                        </select>
									</div>
								</div>
								<div class="row row-cols-2  border mb-3 p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Is your mom's cell number?</option>
                                            <option value="2">Which is your mom's cell number?</option>
                                            <option value="3">And what's your mom's cell number?</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act9-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">My cell number is 77895289.</option>
                                            <option value="2">His cell number is 77895289.</option>
                                            <option value="3">Her cell number is 77895289.</option>
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

<div id="ModalUnit1Act10" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct option to complete the conversation</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label for="select-act10-1">Good morning, Mario, </label>
                                        <select id="select-act10-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Did you say 22910347</option>
                                            <option value="2">How are you?</option>
                                            <option value="3">What about you?</option>
                                        </select>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <select id="select-act10-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Not bad, thanks.</option>
                                            <option value="2">How are you?</option>
                                            <option value="3">Thank you.</option>
                                        </select>
                                        <label> By the way, who is he?</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label >He is Steve Alexander Pérez.</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label for="select-act10-3">How do you spell his </label>
                                        <select id="select-act10-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">first</option>
                                            <option value="2">last</option>
                                            <option value="3">middle</option>
                                        </select>
                                        <label> name?</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                    <label>A-L-E-X-A-N-D-E-R</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label for="select-act10-4">Could you also spell his </label>
                                        <select id="select-act10-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">first</option>
                                            <option value="2">last</option>
                                            <option value="3">middle</option>
                                        </select>
                                        <label> name?</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                    <label for="select-act2-5">P-E-R-E-Z</label>
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

<div id="ModalUnit1Act11" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act11">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is a subject pronoun?</b></p>
                                        <select id="select-act11-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">It is a presentation of one person to another or others.</option>
                                            <option value="2">It is a word used with nouns to show possession or ownership.</option>
                                            <option value="3">It is a word used as subject in a sentence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What are possessive adjectives?</b></p>
                                        <select id="select-act11-2" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
                                            <option value="1">They are presentations of one person to another or others.</option>
                                            <option value="2">They are words used with nouns to show possession or ownership.</option>
                                            <option value="3">They are words used as subject in a sentence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the greetings</b></p>
                                        <div>
											<input type="checkbox" id="cb11-1"><label for="cb11-1">&nbsp;Good afternoon.</label>
										</div>
										<div>
											<input type="checkbox" id="cb11-2"><label for="cb11-2">&nbsp;Not bad, thanks.</label>
										</div>
										<div>
											<input type="checkbox" id="cb11-3"><label for="cb11-3">&nbsp;Excuse me</label>
										</div>
										<div>
											<input type="checkbox" id="cb11-4"><label for="cb11-4">&nbsp;Good night.</label>
										</div>
										<div>
											<input type="checkbox" id="cb11-5"><label for="cb11-5">&nbsp;Hello.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the dialogue</b></p>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act11-3">Good morning, Mario, </label>
											<select id="select-act11-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Did you say 22910347</option>
												<option value="2">How are you?</option>
												<option value="3">What about you?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act11-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Not bad, thanks.</option>
												<option value="2">How are you?</option>
												<option value="3">Thank you.</option>
											</select>
											<label> By the way, who is he?</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label >He is Steve Alexander Pérez.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act11-5">How do you spell his </label>
											<select id="select-act11-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">first</option>
												<option value="2">last</option>
												<option value="3">middle</option>
											</select>
											<label> name?</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>A-L-E-X-A-N-D-E-R</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act11-6">Hi, Steve, </label>
											<select id="select-act11-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">what's your cell number?</option>
												<option value="2">which is your cell number?</option>
												<option value="3">is this his cell number?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>77895289</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can we show respect while conversing?</b></p>
                                        <select id="select-act11-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Not letting the other person speak.</option>
                                            <option value="2">Paying attention and being polite.</option>
                                            <option value="3">Being forceful or not greeting the other person.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. What is to respect people's dignity?</b></p>
                                        <select id="select-act11-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">To accept people the way they are and treat them equally.</option>
                                            <option value="2">To make fun of and mistreat other people.</option>
                                            <option value="3">To judge people without knowing them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How can you use the art of asking questions in a dialogue with friends</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act11-1">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Are you able to explore important information in a dialogue</b></p>
                                        <select id="select-act11-9" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Yes, I am.</option>
                                            <option value="2">No, I am not.</option>
                                            <option value="3">I'm not sure.</option>
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

<div id="ModalUnit1Act12" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct option to complete the dialogue</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label for="select-act12-1">Good morning, </label>
                                        <select id="select-act12-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Give me</option>
                                            <option value="2">May I have</option>
                                            <option value="3">How are you</option>
                                        </select>
										<label> a glass of water?</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <select id="select-act12-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Sorry.</option>
                                            <option value="2">Thank you.</option>
                                            <option value="3">Excuse me.</option>
                                        </select>
                                        <label> I only have coffee and lemonade.</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <select id="select-act12-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Sorry.</option>
                                            <option value="2">Excuse me.</option>
                                            <option value="3">Thank you.</option>
                                        </select>
                                        <label> May I have a lemonade?</label>
									</div>
								</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                        <label for="select-act12-4">Sure, </label>
                                        <select id="select-act12-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">excuse me,</option>
                                            <option value="2">thank you,</option>
                                            <option value="3">good-bye,</option>
                                        </select>
                                        <label> what's your name?</label>
									</div>
								</div>
								<div class="row p-3">
									<div class="d-flex align-items-center">
                                    <label>My name is Francisco.</label>
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

<div id="ModalUnit1Act13" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct option to complete the dialogue</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-3">
									<table class="table table-bordered" style="border: #8076b2">
										<tr>
											<th width="20%" scope="row" class="text-center">0</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-1" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">1</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-2" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">2</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-3" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">3</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-4" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">4</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-5" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">5</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-6" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">6</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-7" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">7</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-8" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">8</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-9" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">9</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-10" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">10</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-11" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">11</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-12" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">12</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-13" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">13</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-14" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">14</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-15" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">15</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-16" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">16</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-17" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">17</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-18" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">18</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-19" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">19</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-20" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">20</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-21" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">21</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-22" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">30</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-23" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">40</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-24" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">50</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-25" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">60</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-26" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">70</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-27" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">80</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-28" placeholder="Write the number..." maxlength="13">
											</td>
										</tr>
										<tr>
											<th width="20%" scope="row" class="text-center">90</th>
											<td width="80%">
												<input autocomplete="off" type="text" class="form-control" id="input-act13-29" placeholder="Write the number..." maxlength="13">
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

<div id="ModalUnit1Act14" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the phone numbers that you hear</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitOne/TRACK09.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act14-1" placeholder="..." maxlength="8">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act14-2" placeholder="..." maxlength="8">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act14-3" placeholder="..." maxlength="8">
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

<div id="ModalUnit1Act15" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act15">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What's a courtesy expression?</b></p>
                                        <select id="select-act15-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">It is the means or system by which groups of individuals or things are counted.</option>
                                            <option value="2">It is an address, similar to the IP address of a computer or the street address of your home.</option>
                                            <option value="3">It is a polite way to express kindness and show good manners.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is basically the telephone number?</b></p>
                                        <select id="select-act15-2" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
											<option value="0" selected disabled></option>
                                            <option value="1">The means or system by which groups of individuals or things are counted.</option>
                                            <option value="2">An address, similar to the IP address of a computer or the street address of your home.</option>
                                            <option value="3">A polite way to express kindness and show good manners.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Complete the dialogue using courtesy expressions</b></p>
                                        <div class="row p-2">
											<div class="d-flex align-items-center">
												<label for="select-act15-3">Good morning, </label>
												<select id="select-act15-3" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Give me</option>
													<option value="2">May I have</option>
													<option value="3">How are you</option>
												</select>
												<label> a glass of milk?</label>
											</div>
										</div>
										<div class="row p-2">
											<div class="d-flex align-items-center">
												<select id="select-act15-4" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Sorry.</option>
													<option value="2">Thank you.</option>
													<option value="3">Excuse me.</option>
												</select>
												<label> I only have coffee and orange juice.</label>
											</div>
										</div>
										<div class="row p-2">
											<div class="d-flex align-items-center">
												<select id="select-act15-5" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Sorry.</option>
													<option value="2">Excuse me.</option>
													<option value="3">Thank you.</option>
												</select>
												<label> May I have an orange juice?</label>
											</div>
										</div>
										</div>
										<div class="row p-2">
											<div class="d-flex align-items-center">
												<label for="select-act15-6">Sure. </label>
												<select id="select-act15-6" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Excuse me,</option>
													<option value="2">Hey,</option>
													<option value="3">Hello,</option>
												</select>
												<label> what's your name?</label>
											</div>
										</div>
										<div class="row p-2">
											<div class="d-flex align-items-center">
											<label>My name is Francisco.</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the numbers from 0 to 90 accurately</b></p>
										<div class="row row-cols-2 p-3">
											<div class="col">													
												<table class="table table-bordered" style="border: #8076b2">
													<tr>
														<th width="20%" scope="row" class="text-center">0</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-1" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">1</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-2" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">2</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-3" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">3</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-4" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">4</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-5" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">5</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-6" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">6</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-7" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">7</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-8" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">8</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-9" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">9</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-10" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">10</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-11" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">11</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-12" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">12</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-13" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">13</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-14" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">14</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-15" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
												</table>
											</div>
											<div class="col">
												<table class="table col table-bordered" style="border: #8076b2">
													<tr>
														<th width="20%" scope="row" class="text-center">15</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-16" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">16</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-17" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">17</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-18" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">18</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-19" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">19</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-20" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">20</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-21" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">21</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-22" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">30</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-23" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">40</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-24" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">50</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-25" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">60</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-26" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">70</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-27" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">80</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-28" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
													<tr>
														<th width="20%" scope="row" class="text-center">90</th>
														<td width="80%">
															<input autocomplete="off" type="text" class="form-control" id="input-act15-29" placeholder="Write the number..." maxlength="13">
														</td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can we show interest in people?</b></p>
                                        <select id="select-act15-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring their opinion.</option>
                                            <option value="2">Asking about their name and paying attention to them.</option>
                                            <option value="3">Lying and being forceful.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. What is to accept and tolerate people?</b></p>
                                        <select id="select-act15-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">To accept their mistakes and helping each other.</option>
                                            <option value="2">To make fun of their mistakes.</option>
                                            <option value="3">To treat them badly.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How can you use the technique "to create in dreams" to solve problems while you sleep?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act15-1">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Are you able to Identify tendencies in the tastes of people?</b></p>
                                        <select id="select-act15-9" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Yes, I am.</option>
                                            <option value="2">No, I am not.</option>
                                            <option value="3">I'm not sure.</option>
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

<div id="ModalUnit1Act16" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the letters of the alphabet in order and pronounce them at the time</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-3">
									<table class="table">
										<tr>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-1" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-2" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-3" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-4" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-5" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-6" maxlength="1">
											</td>
										</tr>
										<tr>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-7" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-8" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-9" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-10" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-11" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-12" maxlength="1">
											</td>
										</tr>
										<tr>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-13" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-14" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-15" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-16" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-17" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-18" maxlength="1">
											</td>
										</tr>
										<tr>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-19" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-20" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-21" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-22" maxlength="1">
											</td>
											<td width="16%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-23" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-24" maxlength="1">
											</td>
										</tr>
										<tr>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-25" maxlength="1">
											</td>
											<td width="17%">
												<input autocomplete="off" type="text" class="form-control" id="input-act16-26" maxlength="1">
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

<div id="ModalUnit1Act17" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act17">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the expressions that you hear</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitOne/TRACK11.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act17-1" placeholder="...">
								</div>
								<div class="row p-2">
									<label>My name's Douglas Aguilar.</label>
								</div>
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act17-2" placeholder="...">
								</div>
								<div class="row p-2">
									<label>A-G-U-I-L-A-R.</label>
								</div>
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act17-3" placeholder="...">
								</div>
								<div class="row p-2">
									<label>It's 78598259.</label>
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act17-4" placeholder="...">
								</div>
								<div class="row p-2">
									<label>Yes, it is 22623597</label>
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

<div id="ModalUnit1Act18" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the useful expressions that you hear</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitOne/TRACK12.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act18-1" placeholder="...">
								</div>
								<div class="row p-2">
									<label>F-A-B-R-I-C-I-O</label>
								</div>
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act18-2" placeholder="...">
								</div>
								<div class="row p-2">
									<label>I say book.</label>
								</div>
								<br>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act18-3" placeholder="...">
								</div>
								<div class="row p-2">
									<label>R-O-D-R-I-G-U-E-Z</label>
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act18-4" placeholder="...">
								</div>
								<div class="row p-2">
									<label>No, I said Rogríguez</label>
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

<div id="ModalUnit1Act19" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is the alphabet?</b></p>
                                        <select id="select-act19-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The act of expressing, conveying, or representing in words, a manifestation.</option>
                                            <option value="2">A set of letters used in writing and printing a language.</option>
                                            <option value="3">A simple way of showing interest in the person.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is an expression?</b></p>
                                        <select id="select-act19-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The act of expressing, conveying, or representing in words, a manifestation.</option>
                                            <option value="2">A set of letters used in writing and printing a language.</option>
                                            <option value="3">A simple way of showing interest in the person.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the useful expressions</b></p>
										<div>
											<input type="checkbox" id="cb19-1"><label for="cb19-1">&nbsp;How do you spell your name?</label>
										</div>
										<div>
											<input type="checkbox" id="cb19-2"><label for="cb19-2">&nbsp;Good morning, how are you?</label>
										</div>
										<div>
											<input type="checkbox" id="cb19-3"><label for="cb19-3">&nbsp;They are playing the guitar.</label>
										</div>
										<div>
											<input type="checkbox" id="cb19-4"><label for="cb19-4">&nbsp;How do you say "manzana" in English?</label>
										</div>
										<div>
											<input type="checkbox" id="cb19-5"><label for="cb19-5">&nbsp;I think his phone number is 22620875.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the letters of the alphabet</b></p>
										<table class="table">
											<tr>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-1" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-2" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-3" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-4" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-5" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-6" maxlength="1">
												</td>
											</tr>
											<tr>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-7" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-8" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-9" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-10" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-11" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-12" maxlength="1">
												</td>
											</tr>
											<tr>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-13" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-14" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-15" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-16" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-17" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-18" maxlength="1">
												</td>
											</tr>
											<tr>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-19" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-20" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-21" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-22" maxlength="1">
												</td>
												<td width="16%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-23" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-24" maxlength="1">
												</td>
											</tr>
											<tr>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-25" maxlength="1">
												</td>
												<td width="17%">
													<input autocomplete="off" type="text" class="form-control" id="input-act19-26" maxlength="1">
												</td>
											</tr>
										</table>                                        
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show acceptance of errors?</b></p>
                                        <select id="select-act19-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Making fun of other people's mistakes.</option>
                                            <option value="2">Tolerating them and encouraging my partners.</option>
                                            <option value="3">Refusing to help our friends when needed.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How can we begin a nice friendship?</b></p>
                                        <select id="select-act19-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Avoiding talking to other people.</option>
                                            <option value="2">Being impolite when talking to peers.</option>
                                            <option value="3">Finding out peer's names and last names.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. What similarity do you find between the alphabet in English with the one of Spanish?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act19-27">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Do you try to work in teams in order to learn from the others?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act19-28">
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

<div id="ModalUnit1Act21" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act21">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. Select the courtesy expression</b></p>
                                        <select id="select-act21-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Give me a cup of coffee.</option>
                                            <option value="2">May I have a cup of coffee?</option>
                                            <option value="3">How do you do? I'm Elizabeth.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. Could you write the possessive adjectives?</b></p>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-1" maxlength="5">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-2" maxlength="5">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-3" maxlength="5">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-4" maxlength="5">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-5" maxlength="5">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-6" maxlength="5">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act21-7" maxlength="5">
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write 8 numbers from 0 to 90 correctly</b></p>
										<input autocomplete="off" type="text" class="form-control" id="input-act21-8" maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-9"  maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-10"  maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-11" maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-12" maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-13" maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-14" maxlength="13">
										<input autocomplete="off" type="text" class="form-control" id="input-act21-15" maxlength="13">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the dialogue using personal information</b></p>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act21-2">Good morning, Mario, </label>
											<select id="select-act21-2" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Did you say 22910347</option>
												<option value="2">How are you?</option>
												<option value="3">What about you?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act21-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Not bad, thanks.</option>
												<option value="2">How are you?</option>
												<option value="3">Thank you.</option>
											</select>
											<label> By the way, who is he?</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label >He is Steve Alexander Pérez.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act21-4">How do you spell his </label>
											<select id="select-act21-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">first</option>
												<option value="2">last</option>
												<option value="3">middle</option>
											</select>
											<label> name?</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>A-L-E-X-A-N-D-E-R</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label for="select-act21-5">Hi, Steve, </label>
											<select id="select-act21-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">what's your cell number?</option>
												<option value="2">which is your cell number?</option>
												<option value="3">is this his cell number?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>77895289</label>
										</div>                                  
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show acceptance of errors?</b></p>
										<select id="select-act21-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Making fun of other people's mistakes.</option>
                                            <option value="2">Refusing to help my friends.</option>
                                            <option value="3">Helping my friends when needed.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How can you show politeness and respect?</b></p>
                                        <select id="select-act21-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Greeting and paying attention other people.</option>
                                            <option value="2">Ignoring other people.</option>
                                            <option value="3">Being forceful and insistent.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. What could inspire you to use courtesy expressions?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act21-16">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How could you keep good relations with other people?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act21-17">
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

<div id="ModalUnit1Act20" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act20">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. Select the introduction</b></p>
                                        <select id="select-act20-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">He is playing guitar.</option>
                                            <option value="2">I really appreciate your help.</option>
                                            <option value="3">How do you do? I'm Elizabeth.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. Could you write the subject pronouns?</b></p>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-1" maxlength="4">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-2" maxlength="4">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-3" maxlength="4">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-4" maxlength="4">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-5" maxlength="4">
											</div>
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-6" maxlength="4">
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<input autocomplete="off" type="text" class="form-control" id="input-act20-7" maxlength="4">
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Complete the questions and answers</b></p>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<select id="select-act20-2" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Hi, How</option>
													<option value="2">Hi, why</option>
													<option value="3">Hi, where</option>
												</select>
												<label> are you?</label>
											</div>
											<div class="col d-flex align-items-center">
												<label for="select-act20-3">I'm </label>
												<select id="select-act20-3" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">my name is</option>
													<option value="2">hello</option>
													<option value="3">fine</option>
												</select>
												<label>, thanks.</label>
											</div>
										</div>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<label>How</label>
												<select id="select-act20-4" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">is it</option>
													<option value="2">are you</option>
													<option value="3">is she</option>
												</select>
												<label>doing?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act20-5" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Not bad</option>
													<option value="2">Good afternoon</option>
													<option value="3">What's your name?</option>
												</select>
												<label>, thank you.</label>
											</div>
										</div>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<label>How is your</label>
												<select id="select-act20-6" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> name</option>
													<option value="2"> mother</option>
													<option value="3"> phone number</option>
												</select>
												<label>?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act20-7" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Good.</option>
													<option value="2">Good afternoon.</option>
													<option value="3">She is.</option>
												</select>
											</div>
										</div>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<label>How is</label>
												<select id="select-act20-8" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> you doing</option>
													<option value="2"> his name</option>
													<option value="3"> Mario</option>
												</select>
												<label>?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act20-9" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">The alphabet.</option>
													<option value="2">Good-bye.</option>
													<option value="3">OK.</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the conversations</b></p>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<label>What's your telephone</label>
												<select id="select-act20-10" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">number</option>
													<option value="2">letter</option>
													<option value="3">greeting</option>
												</select>
												<label>?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act20-11" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">His</option>
													<option value="2">My</option>
													<option value="3">Your</option>
												</select>
												<label>telephone</label>
												<select id="select-act20-12" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">number is 22623597</option>
													<option value="2">number are 22623597</option>
													<option value="3">number am 22623597</option>
												</select>
											</div>
										</div>
										<div class="row row-cols-2 border p-3">
											<div class="col d-flex align-items-center">
												<label>Did you</label>
												<select id="select-act20-13" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">say Rodríguez</option>
													<option value="2">said 22623596</option>
													<option value="3">speak good-bye</option>
												</select>
												<label>?</label>
											</div>
											<div class="col d-flex align-items-center">
												<select id="select-act20-14" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Yes</option>
													<option value="2">Fine</option>
													<option value="3">No</option>
												</select>
												<label>, but I said</label>
												<select id="select-act20-15" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">22623597.</option>
													<option value="2">Rodrigo.</option>
													<option value="3">I'm fine.</option>
												</select>
											</div>
										</div>
										<div class="row border p-3">
											<div class=" d-flex align-items-center">
												<label>What's your</label>
												<select id="select-act20-16" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> name</option>
													<option value="2"> last</option>
													<option value="3"> initial</option>
												</select>
												<label>name?</label>
											</div>
											<br>
											<br>
											<br>
											<div class=" d-flex align-items-center">
												<select id="select-act20-17" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">My last</option>
													<option value="2">His last</option>
													<option value="3">His middle</option>
												</select>
												<label>name is</label>
												<select id="select-act20-18" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">is my name.</option>
													<option value="2">it's Pérez. </option>
													<option value="3">Pérez.</option>
												</select>
											</div>
										</div>
										<div class="row border p-3">
											<div class="col d-flex align-items-center">
												<select id="select-act20-19" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> Do</option>
													<option value="2"> Does</option>
													<option value="3"> Have</option>
												</select>
												<label>you know</label>
												<select id="select-act20-20" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> you sister's</option>
													<option value="2"> your sister's</option>
													<option value="3"> her sister is</option>
												</select>
												<label>cell</label>
												<select id="select-act20-21" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> number?</option>
													<option value="2"> name?</option>
													<option value="3"> telephone</option>
												</select>
											</div>
											<br>
											<br>
											<br>
											<div class="col d-flex align-items-center">
												<select id="select-act20-22" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Your</option>
													<option value="2">His</option>
													<option value="3">Her</option>
												</select>
												<label>cell</label>
												<select id="select-act20-23" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">name</option>
													<option value="2">number</option>
													<option value="3">telephone</option>
												</select>
												<label>is</label>
												<select id="select-act20-24" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1"> thanks.</option>
													<option value="2"> Elizabeth.</option>
													<option value="3"> 78958745.</option>
												</select>
											</div>
										</div>                                      
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. What is to respect people's dignity?</b></p>
										<select id="select-act20-25" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">To judge people without knowing them.</option>
                                            <option value="2">To accept people the way they are and treat them equally.</option>
                                            <option value="3">To make fun of and mistreat other people.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How could you respect people's rights?</b></p>
                                        <select id="select-act20-26" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring and treating them badly.</option>
                                            <option value="2">Making fun of their opinion because it's different from mine.</option>
                                            <option value="3">Listening to what they have to say and tolerating them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How can you verify that you respect the rights of people?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act20-8">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How could you generate cooperation and commitment in the others?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act20-9">
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
Book_Page::footerTemplate('controladorlibro7_u2.js');
?>