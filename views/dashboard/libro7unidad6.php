<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 6');
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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/21.JPG" width="76" height="100"
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

			pages: 39,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadseisseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit6Act1" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the different forms to tell the time you hear</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
                                <audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK81.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
                                <div>
									<p class="text-justify" style="display: inline;">I usually get up at </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">six in the morning. I have breakfast at seven </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">and then take the bus to work at</p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">seven. I usually arrive at work at </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">eight. Sometimes, the bus is late and I arrive </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-5" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">eight. </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-6" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">is usually pretty busy and I like taking a coffee break at.</p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-7" placeholder="..." style="width:200px; display: inline-block;"> 
                                    <p class="text-justify" style="display: inline;">if possible. I then work to lunchtime at noon.</p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-8" placeholder="..." style="width:200px; display: inline-block;"> 
                                    <p class="text-justify" style="display: inline;">, I usually have another break at</p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-9" placeholder="..." style="width:200px; display: inline-block;">
                                    <p class="text-justify" style="display: inline;">three. I usually arrive home around six</p> 
                                        <input type="text" autocomplete="off" class="form-control" id="input-act1-10" placeholder="..." style="width:200px; display: inline-block;"> 
                                    <p class="text-justify" style="display: inline;">. At night, I usually go to bed at eleven o'clock.</p>
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

<div id="ModalUnit6Act2" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the table</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
                                <table class="table">
									<tr>
										<th>&nbsp;</th>
										<th>Telling time</th>
										<th>What time is it?</th>
									</tr>
									<tr>
										<td>11:30</td>
										<td>It's eleven thirty</td>
										<td>
                                            <select id="select-act2-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">It's eleven.</option>
                                                <option value="2">It's half past eleven.</option>
                                                <option value="3">It's half to eleven.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td>
                                            <select id="select-act2-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">6:15</option>
                                                <option value="2">5:15</option>
                                                <option value="3">5:45</option>
                                            </select>
                                        </td>
										<td>It's five forty-five</td>
										<td>It's a quarter to six</td>
									</tr>
									<tr>
										<td>5:00</td>
										<td>
                                            <select id="select-act2-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">It's five o'clock</option>
                                                <option value="2">It's five zero</option>
                                                <option value="3">It's five ten</option>
                                            </select>
                                        </td>
										<td>It's five a.m. / p.m.</td>
									</tr>
									<tr>
										<td>7:15</td>
										<td>It's seven fifteen</td>
										<td>
                                            <select id="select-act2-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">It's seven to fifteen.</option>
                                                <option value="2">It's a quarter past seven.</option>
                                                <option value="3">It's half to eleven.</option>
                                            </select>
                                        </td>
									</tr>
                                    <tr>
										<td>
                                            <select id="select-act2-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">9:10</option>
                                                <option value="2">9:50</option>
                                                <option value="3">8:50</option>
                                            </select>
                                        </td>
										<td>It's eight fifty</td>
										<td>It's ten to nine</td>
									</tr>
                                    <tr>
										<td>
                                            <select id="select-act2-6" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">10:02</option>
                                                <option value="2">2:10</option>
                                                <option value="3">1:50</option>
                                            </select>
                                        </td>
										<td>
                                            <select id="select-act2-7" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">It's two ten</option>
                                                <option value="2">It's one fifty</option>
                                                <option value="3">It's ten two</option>
                                            </select>
                                        </td>
										<td>It's ten past two</td>
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

<div id="ModalUnit6Act3" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the expressions of time</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
                                <div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-1"><label for="cb3-1">&nbsp;In the morning</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-5"><label for="cb3-5">&nbsp;On the table</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-6"><label for="cb3-6">&nbsp;Eleven</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-2"><label for="cb3-2">&nbsp;Last night</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-3"><label for="cb3-3">&nbsp;Wednesday</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-7"><label for="cb3-7">&nbsp;April</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-4"><label for="cb3-4">&nbsp;Yesterday</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-8"><label for="cb3-8">&nbsp;Every day</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-9"><label for="cb3-9">&nbsp;Every year</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb3-10"><label for="cb3-10">&nbsp;Year</label>
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

<div id="ModalUnit6Act4" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the physical activities</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
                                <div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-1"><label for="cb4-1">&nbsp;Looking</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-5"><label for="cb4-5">&nbsp;Walking</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-6"><label for="cb4-6">&nbsp;Running</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-2"><label for="cb4-2">&nbsp;Jumping</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-3"><label for="cb4-3">&nbsp;Talking</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-7"><label for="cb4-7">&nbsp;Excercising</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-4"><label for="cb4-4">&nbsp;Writing</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-8"><label for="cb4-8">&nbsp;Studying</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-9"><label for="cb4-9">&nbsp;Swimming</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb4-10"><label for="cb4-10">&nbsp;Reading</label>
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

<div id="ModalUnit6Act5" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose and drag</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Movies</th>
												<tr>
													<td id="box-act5-1"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Daily activities</th>
												<tr>
													<td id="box-act5-2"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act15-1">
												<div id="option-act5-2" class="col d-table" draggable="true">Adventure</div>
												<div id="option-act5-4" class="col d-table" draggable="true">Drama</div>
												<div id="option-act5-6" class="col d-table" draggable="true">Romance</div>
												<div id="option-act5-16" class="col d-table" draggable="true">Bird watching</div>
												<div id="option-act5-10" class="col d-table" draggable="true">Wake up</div>
												<div id="option-act5-21" class="col d-table" draggable="true">Gardening</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act5-7" class="col d-table" draggable="true">Science Fiction</div>
												<div id="option-act5-8" class="col d-table" draggable="true">Thriller</div>
												<div id="option-act5-1" class="col d-table" draggable="true">Action</div>
												<div id="option-act5-19" class="col d-table" draggable="true">Dancing</div>
												<div id="option-act5-11" class="col d-table" draggable="true">Get up</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act5-20" class="col d-table" draggable="true">Drawing</div>
												<div id="option-act5-14" class="col d-table" draggable="true">Read the newspaper</div>
												<div id="option-act5-22" class="col d-table" draggable="true">Hiking</div>
												<div id="option-act5-15" class="col d-table" draggable="true">Have lunch</div>
												<div id="option-act5-3" class="col d-table" draggable="true">Animation</div>
												<div id="option-act5-17" class="col d-table" draggable="true">Coin collecting</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act5-12" class="col d-table" draggable="true">Eat breakfast</div>
												<div id="option-act5-5" class="col d-table" draggable="true">Musicals</div>
												<div id="option-act5-23" class="col d-table" draggable="true">Photography</div>
												<div id="option-act5-13" class="col d-table" draggable="true">Drink coffee</div>
												<div id="option-act5-9" class="col d-table" draggable="true">Westerns</div>
												<div id="option-act5-18" class="col d-table" draggable="true">Cooking</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Hobbies</th>
												<tr>
													<td id="box-act5-3"></td>
												</tr>
											</table>
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

<div id="ModalUnit6Act6" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the paragraph with the vocabulary you hear</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
                                <audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK86.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
                                <div>
									<p class="text-justify" style="display: inline;">What makes us </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-1" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">about an exam? It might be that we are less prepared, we have experienced past failures, or we negatively think we might fail. </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-2" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">can come from any situation or thought that makes you feel frustrated, angry or </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-3" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">. What is stressful to one person is not necessarily stressful to another.</p>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-4" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">is a feeling of apprehension or fear. The source of this uneasiness is not always known or recognized, which can add to the distress you feel. Take </p>
										<input type="text" autocomplete="off" class="form-control" id="input-act6-5" placeholder="..." style="width:200px; display: inline-block;"> 
									<p class="text-justify" style="display: inline;">and you might feel better. </p>
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

<div id="ModalUnit6Act7" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the times of the day</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
                                <div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-1"><label for="cb7-1">&nbsp;Afternoon</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-5"><label for="cb7-5">&nbsp;Time</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-6"><label for="cb7-6">&nbsp;April</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-2"><label for="cb7-2">&nbsp;Night</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-3"><label for="cb7-3">&nbsp;Morning</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-7"><label for="cb7-7">&nbsp;Christmas</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-4"><label for="cb7-4">&nbsp;Noon</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-8"><label for="cb7-8">&nbsp;Lunchtime</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-9"><label for="cb7-9">&nbsp;Halloween</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb7-10"><label for="cb7-10">&nbsp;May</label>
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

<div id="ModalUnit6Act8" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
                                <div class="row p-4">
									<div class="col">
                                        <p><b>I. What is physical activity?</b></p>
                                        <select id="select-act8-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A great way to relax and enjoy your free time.</option>
                                            <option value="2">Any activity that causes your body to work harder than normal.</option>
                                            <option value="3">It can be our drive for excellence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. How can a hobby help people?</b></p>
                                        <select id="select-act8-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">By being a great way to relax and enjoy your free time.</option>
                                            <option value="2">By causing your body to work harder than normal.</option>
                                            <option value="3">By being our drive for excellence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the physical activities</b></p>
                                        <div class="row row-cols-3">
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-1"><label for="cb8-1">&nbsp;Looking</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-5"><label for="cb8-5">&nbsp;Walking</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-6"><label for="cb8-6">&nbsp;Running</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-cols-3">
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-2"><label for="cb8-2">&nbsp;Reading</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-3"><label for="cb8-3">&nbsp;Talking</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <input type="checkbox" id="cb8-4"><label for="cb8-4">&nbsp;Excercising</label>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the sentences with the correct times of the day </b></p>
                                        <div>
                                            <p class="text-justify" style="display: inline;">I eat breakfast in the </p>
										    <input type="text" autocomplete="off" class="form-control" id="input-act8-1" placeholder="..." style="width:200px; display: inline-block;"> 
                                            <p class="text-justify" style="display: inline;">.</p>
                                        </div>
                                        <div>
                                            <p class="text-justify" style="display: inline;">I go to sleep early at</p>
										    <input type="text" autocomplete="off" class="form-control" id="input-act8-2" placeholder="..." style="width:200px; display: inline-block;"> 
                                            <p class="text-justify" style="display: inline;">.</p>
                                        </div>
                                        <div>
                                            <p class="text-justify" style="display: inline;">At 12 o'clock it is </p>
										    <input type="text" autocomplete="off" class="form-control" id="input-act8-3" placeholder="..." style="width:200px; display: inline-block;"> 
                                            <p class="text-justify" style="display: inline;">.</p>
                                        </div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you use your imagination and creativity to create new products?</b></p>
                                        <select id="select-act8-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By imagining people doing specific task and using imaginary tools that could help them.</option>
                                            <option value="2">By imagining people asking questions about new vocabulary.</option>
                                            <option value="3">Imagining people doing physical activities.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How could you exercise regularly your imagination?</b></p>
                                        <select id="select-act8-4" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">By sleeping.</option>
                                            <option value="2">I can't, because it is not part of my body</option>
                                            <option value="3">Reading or imagining innovative ideas.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How could you use your creative solution and use a hobby for your own benefit?</b></p>
										<input type="text" autocomplete="off" class="form-control" id="input-act8-4">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you use your proactivity and choose a good hobby?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act8-5">
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

<div id="ModalUnit6Act9" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">What time do you have breakfast?</option>
                                                <option value="2">Do you brush your teeth after breakfast?</option>
                                                <option value="3">What do you have for breakfast?</option>
                                            </select>
                                            <label>Yes, always.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>What time do you wake up?</label>
                                            <select id="select-act9-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">I wake up at 5:00.</option>
                                                <option value="2">In the afternoon.</option>
                                                <option value="3">Yes, I do.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">What time do you brush your teeth?</option>
                                                <option value="2">Do you brush your teeth every morning? </option>
                                                <option value="3">Are you brushing your teeth?</option>
                                            </select>
                                            <label>Yes, I do.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Do you go to sleep early at night?</label>
                                            <select id="select-act9-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Yes, I am.</option>
                                                <option value="2">Yes, I do, at around 7:00 a.m.</option>
                                                <option value="3">Yes, I do, at around 7:00 p.m.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Do you organize your daily routines?</option>
                                                <option value="2">When do you organize your daily routines?</option>
                                                <option value="3">What time do you organize your daily routines?</option>
                                            </select>
                                            <label>Yes, I do.</label>
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

<div id="ModalUnit6Act10" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the benefits of getting up early</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-1"><label for="cb10-1">&nbsp;Better sleep</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-5"><label for="cb10-5">&nbsp;Unhealthy habits</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-2"><label for="cb10-2">&nbsp;Learning new words</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-6"><label for="cb10-6">&nbsp;More time for breakfast</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-3"><label for="cb10-3">&nbsp;Reduced stress</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-7"><label for="cb10-7">&nbsp;Better mood</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-4"><label for="cb10-4">&nbsp;Peaceful mornings</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb10-8"><label for="cb10-8">&nbsp;Parades in the street</label>
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

<div id="ModalUnit6Act11" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act11">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<head><link rel="stylesheet" href="//cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.css"></head>
								<body><script src="//cdn.jsdelivr.net/npm/timepicker@1.13.18/jquery.timepicker.min.js"></script></body>
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Answer the questions about your daily schedule</p>
											<input type="text" class="d-none" id="points11" name="points">
											<input type="text" class="d-none" id="idcliente11" name="idcliente">
											<input type="text" class="d-none" id="idlibro11" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p><b>What time do you wake up?</b></p>
										<p style="display: inline;">I wake up at</p>
										<input type="text" id="input-act11-1" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
									<div class="col">
										<p><b>What time do you get up?</b></p>
										<p style="display: inline;">I get up at</p>
										<input type="text" id="input-act11-2" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p><b>What time do you take a shower?</b></p>
										<p style="display: inline;">I take a shower at</p>
										<input type="text" id="input-act11-3" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
									<div class="col">
										<p><b>What time do you get dressed?</b></p>
										<p style="display: inline;">I get dressed at</p>
										<input type="text" id="input-act11-4" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p><b>What time do you eat breakfast?</b></p>
										<p style="display: inline;">I eat breakfast at</p>
										<input type="text" id="input-act11-5" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
									<div class="col">
										<p><b>What time do you brush your teeth?</b></p>
										<p style="display: inline;">I brush my teeth at</p>
										<input type="text" id="input-act11-6" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
								</div>
								<div class="row row-cols-2 mb-5">
									<div class="col">
										<p><b>What time do you leave for school?</b></p>
										<p style="display: inline;">I leave for school at</p>
										<input type="text" id="input-act11-7" class="time-b4" style="display: inline-block;" autocomplete="off">
									</div>
									<div class="col">
										<p><b>What time do you arrive at school?</b></p>
										<p style="display: inline;">I arrive at school at</p>
										<input type="text" id="input-act11-8" class="time-b4" style="display: inline-block;" autocomplete="off">
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

<div id="ModalUnit6Act12" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									<audio controls style="margin-top: 10px; margin-bottom: 10px;">
										<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK91.mp3" type="audio/mp3">
										Tu navegador no soporta audio HTML5.
									</audio>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you always wake up at 5:00 a.m.? Yes, </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-1" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">. </p>
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">What time do you get up? </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-2" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">at 5:15 a.m. </p>
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">What time do you take a shower? </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-3" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;"> 5:30 a.m. </p>
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you play during the day? </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-4" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">. </p> 
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you study every day? I study at 3:00  </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-5" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">. </p> 
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you watch TV at night? I </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-6" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">watch TV at home.</p> 
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you live with your family? Yes, </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-7" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">.</p> 
									</div>
									<div class="mb-2">
										<p class="text-justify" style="display: inline;">Do you help at home? Yes, </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-8" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">.</p> 
									</div>
									<div>
										<p class="text-justify" style="display: inline;">Do you go to bed at 10 p.m.? No, </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act12-9" placeholder="..." style="width:200px; display: inline-block;">
										<p class="text-justify" style="display: inline;">9 p.m.</p> 
									</div>
								</div>
							</div>
						</div>
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

<div id="ModalUnit6Act13" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the hobbies and activities you hear</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK91.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
								<table class="table">
									<tr>
										<th>Hobbies</th>
										<th>Entertainment</th>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-1" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-1" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-2" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-2" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-3" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-3" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-4" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-4" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-5" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-5" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-6" placeholder="..."> </td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-2-6" placeholder="..."> </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-7" placeholder="..."> </td>
										<td>&nbsp; </td>
									</tr>
									<tr>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act13-1-8" placeholder="..."> </td>
										<td>&nbsp; </td>
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

<div id="ModalUnit6Act14" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the vocabulary about hobbies and entertainment</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-1"><label for="cb14-1">&nbsp;Eating</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-5"><label for="cb14-5">&nbsp;Bird watching</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-2"><label for="cb14-2">&nbsp;Cinema</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-6"><label for="cb14-6">&nbsp;Take a shower</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-3"><label for="cb14-3">&nbsp;Theater</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-7"><label for="cb14-7">&nbsp;Gardening</label>
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-4"><label for="cb14-4">&nbsp;Brushing my teeth</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb14-8"><label for="cb14-8">&nbsp;Collecting</label>
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

<div id="ModalUnit6Act15" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act15">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Drag the vocabulary to the correct classification</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Games</th>
												<tr>
													<td id="box-act15-1"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Recreation</th>
												<tr>
													<td id="box-act15-2"></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act15-1">
												<div id="option-act15-2" class="col d-table" draggable="true">Checkers</div>
												<div id="option-act15-4" class="col d-table" draggable="true">Jacks</div>
												<div id="option-act15-6" class="col d-table" draggable="true">Cycling</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-7" class="col d-table" draggable="true">Dancing</div>
												<div id="option-act15-8" class="col d-table" draggable="true">Hunting</div>
												<div id="option-act15-1" class="col d-table" draggable="true">Chess</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-14" class="col d-table" draggable="true">Music</div>
												<div id="option-act15-3" class="col d-table" draggable="true">Marbles</div>
												<div id="option-act15-11" class="col d-table" draggable="true">Gardening</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-12" class="col d-table" draggable="true">Reading</div>
												<div id="option-act15-5" class="col d-table" draggable="true">Cards</div>
												<div id="option-act15-13" class="col d-table" draggable="true">Writing</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-9" class="col d-table" draggable="true">Fishing</div>
												<div id="option-act15-10" class="col d-table" draggable="true">Cook</div>
												<div class="col d-table"></div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Hobbies</th>
												<tr>
													<td id="box-act15-3"></td>
												</tr>
											</table>
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

<div id="ModalUnit6Act16" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
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
									margin: auto;
									padding-top: 15px;
									padding-bottom: 50px;
									}
									.grid {
									display: grid;
									grid-template-columns: 30% 30% 30%;
									justify-content: center;	
									margin-top: 30px;
									}
									h1 {
									color: rgba(0, 0, 0, 0.7.5);
									font-size: 16px;
									font-weight: 700;
									letter-spacing: 0.5px;
									text-align: center;
									}

									header p {
									color: rgba(0, 0, 0, 0.6);
									font-size: 16px;
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
									text-align: center;
									}

									#canvas2, #canvas3, #canvas4, #canvas5, #canvas6 {
									background-color: #F8F8F8;
									}

									.color, .stroke, .clear {
									justify-self: center;
									}

									#clearBtn, #clearBtn2, #clearBtn3, #clearBtn4, #clearBtn5 {
									color: white;
									font-size: 16px;
									font-weight: 700;
									letter-spacing: 0.5px;
									padding: 10px 50px;
									background-color: #55D0ED;
									border-radius: 10px;
									text-decoration: none;
									}
								</style>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is entertainment?</b></p>
                                        <select id="select-act16-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Things we normally do in daily living.</option>
                                            <option value="2">The planning of the day by time and activities.</option>
                                            <option value="3">An activity designed to give people pleasure or relaxation.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a daily schedule?</b></p>
                                        <select id="select-act16-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">Things we normally do in daily living.</option>
                                            <option value="2">The planning of the day by time and activities.</option>
                                            <option value="3">An activity designed to give people pleasure or relaxation.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Answer the next questions about your daily routine:</b></p>
											<div class="row row-cols-2 mb-5">
												<div class="col">
													<p><b>What time do you get up?</b></p>
													<p style="display: inline;">I get up at</p>
													<input type="text" id="input-act16-1" class="time-b4" style="display: inline-block;" autocomplete="off">
												</div>
												<div class="col">
													<p><b>What time do you eat breakfast?</b></p>
													<p style="display: inline;">I eat breakfast at</p>
													<input type="text" id="input-act16-2" class="time-b4" style="display: inline-block;" autocomplete="off">
												</div>
											</div>
											<div class="row row-cols-2 mb-5">
												<div class="col">
													<p><b>What time do you arrive at school?</b></p>
													<p style="display: inline;">I arrive at school at</p>
													<input type="text" id="input-act16-3" class="time-b4" style="display: inline-block;" autocomplete="off">
												</div>
												<div class="col">
													<p><b>What time do you have lunch?</b></p>
													<p style="display: inline;">I have lunch at</p>
													<input type="text" id="input-act16-4" class="time-b4" style="display: inline-block;" autocomplete="off">
												</div>
											</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the vocabulary about hobbies and entertainment</b></p>
										<div class="row row-cols-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-1"><label for="cb16-1">&nbsp;Eating</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-5"><label for="cb16-5">&nbsp;Sleeping</label>
												</div>
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-2"><label for="cb16-2">&nbsp;Cinema</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-6"><label for="cb16-6">&nbsp;Take a shower</label>
												</div>
											</div>
										</div>
										<div class="row row-cols-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-3"><label for="cb16-3">&nbsp;Theater</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb16-4"><label for="cb16-4">&nbsp;Gardening</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you benefit from listening attentively to your teacher?</b></p>
                                        <select id="select-act16-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By showing enthusiasm to our peers.</option>
                                            <option value="2">It helps us avoid misunderstandings.</option>
                                            <option value="3">Watching cartoons and reading comics.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you create a good climate in the classroom?</b></p>
                                        <select id="select-act16-4" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">By showing enthusiasm to our peers.</option>
                                            <option value="2">It helps us avoid misunderstandings.</option>
                                            <option value="3">Watching cartoons and reading comics.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Create a mental map of your ideal daily schedule</b></p>
                                        <header>
											<div class="grid ">
												<div class="color">
													<p>Pick a color:</p>
													<div class="colorPickerWrapper">
														<input type="color" id="colorPicker" value="#55D0ED">
													</div>
												</div>
												<div class="stroke">
													<p>Change the stroke's width:</p>
													<div class="strokeWidthPickerWrapper">
														<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker">
													</div>
												</div>
												<div class="clear">
													<p>clear the canvas:</p>
													<div class="clearBtnWrapper">
														<a href="#" id="clearBtn">Clear canvas</a>
													</div>
												</div>
											</div>
											<br>
											<br>
											<div class="container">
												<input type="number" value="0" id="verify-canvas" class="d-none">
												<canvas id="canvas2" width="500" height="500">
												</canvas>
											</div>
										</header>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How would you use your proactivity and carry out your ideal daily schedule?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act16-5">
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
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

<div id="ModalUnit6Act17" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act17">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct preposition of time</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td class="d-flex align-items-center">
											<label>I wake up </label>
                                            <select id="select-act17-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="3">at</option>
                                            </select>
                                            <label>5 o'clock.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>I go to the park </label>
                                            <select id="select-act17-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="2">at</option>
                                            </select>
                                            <label>Sundays.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Christmas is celebrated</label>
                                            <select id="select-act17-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="3">at</option>
                                            </select>
                                            <label>December.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>I go to bed early </label>
                                            <select id="select-act17-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="3">at</option>
                                            </select>
                                            <label>night</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Katherine was born </label>
                                            <select id="select-act17-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="3">at</option>
                                            </select>
                                            <label>September 1ts, 1989.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>I have to visit my grandma </label>
                                            <select id="select-act17-6" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">in</option>
                                                <option value="2">on</option>
                                                <option value="3">at</option>
                                            </select>
                                            <label>Monday.</label>
                                        </td>
									</tr>
								</table>
							</div>
						</div>
						<br>
					</div>
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

<div id="ModalUnit6Act18" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Read the text and select the main idea</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
								</div>
								<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/activities/19.jpg" class="img-fluid">
								<br>
								<br>
								<select id="select-act18-1" class="ms-1 me-1 form-select" style="width: 700px;">
                                    <option value="0" selected disabled></option>
                                    <option value="1">The main idea of the text is defining what is a leasure time activity and giving examples.</option>
                                    <option value="2">The text is about the different jobs people have, and the physical activity in them.</option>
                                    <option value="3">The main idea of the text is describing why people take different aproaches to leisure time activities.</option>
                                </select>
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

<div id="ModalUnit6Act19" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Check the activities done during labor day</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
									<audio controls style="margin-top: 10px; margin-bottom: 10px;">
										<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK97.mp3" type="audio/mp3">
										Tu navegador no soporta audio HTML5.
									</audio>
									<div>
										<p class="text-justify" style="display: inline;">The description of my perfect day is to  </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act19-1" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">, travel far away, cross rivers, and later come back home to stay with my family. Later at night, to watch the </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act19-2" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">, and talk with my family about important stories, inspired by the silent night, just listening to the birds </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act19-3" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">and flying around us. When the sunshine appears again, is going to be the  </p>
											<input type="text" autocomplete="off" class="form-control" id="input-act19-4" placeholder="..." style="width:200px; display: inline-block;"> 
										<p class="text-justify" style="display: inline;">to feed animals on the farm, without any problem. Then, it will be time to go to the movies with my family to enjoy a romantic movie.</p>
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

<div id="ModalUnit6Act20" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act20">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the frequency adverbs</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-1"><label for="cb20-1">&nbsp;Afternoon</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-5"><label for="cb20-5">&nbsp;Hardly ever</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-6"><label for="cb20-6">&nbsp;Sometimes</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-2"><label for="cb20-2">&nbsp;Night</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-3"><label for="cb20-3">&nbsp;Usually</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-7"><label for="cb20-7">&nbsp;Rarely</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-4"><label for="cb20-4">&nbsp;Free time</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-8"><label for="cb20-8">&nbsp;Lunchtime</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-9"><label for="cb20-9">&nbsp;Halloween</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb20-10"><label for="cb20-10">&nbsp;Never</label>
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

<div id="ModalUnit6Act21" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act21">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Associate the words with the definition</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col">
										<div class="row row-cols-2 container-act16">
											<div id="option-act21-10" class="col mb-3" draggable="true">A person's place of employement.</div>
											<div id="option-act21-5" class="col mb-3" draggable="true">The evening meal.</div>
											<div id="option-act21-2" class="col mb-3" draggable="true">A midday meal.</div>
											<div id="option-act21-3" class="col mb-3" draggable="true">The first meal of the day.</div>
											<div id="option-act21-4" class="col mb-3" draggable="true">The main meal of the day.</div>
											<div id="option-act21-9" class="col mb-3" draggable="true">A schedule showing the times to arrive and depart.</div>
											<div id="option-act21-8" class="col mb-3" draggable="true">To take into the mouth and swallow for nourishment.</div>
											<div id="option-act21-7" class="col mb-3" draggable="true">Whatever supplies nourishment to organisms.</div>
											<div id="option-act21-6" class="col mb-3" draggable="true">The time during which a break is taken.</div>
											<div id="option-act21-1" class="col mb-3" draggable="true">An institution where instruction is given.</div>
										</div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col">
										<table class="table table-bordered" style="border: #8076b2">
											<tr>
												<td width="30%">School</td>
												<td width="70%" id="box-act21-1"></td>
											</tr>
											<tr>
												<td width="30%">Lunch</td>
												<td width="70%" id="box-act21-2"></td>
											</tr>
											<tr>
												<td width="30%">Breakfast</td>
												<td width="70%" id="box-act21-3"></td>
											</tr>
											<tr>
												<td width="30%">Dinner</td>
												<td width="70%" id="box-act21-4"></td>
											</tr>
											<tr>
												<td width="30%">Supper</td>
												<td width="70%" id="box-act21-5"></td>
											</tr>
											<tr>
												<td width="30%">Breaktime</td>
												<td width="70%" id="box-act21-6"></td>
											</tr>
											<tr>
												<td width="30%">Food</td>
												<td width="70%" id="box-act21-7"></td>
											</tr>
											<tr>
												<td width="30%">Eat</td>
												<td width="70%" id="box-act21-8"></td>
											</tr>
											<tr>
												<td width="30%">Timetable</td>
												<td width="70%" id="box-act21-9"></td>
											</tr>
											<tr>
												<td width="30%">Workplace</td>
												<td width="70%" id="box-act21-10"></td>
											</tr>
										</table>
									</div>
								</div>
							</div>
						</div>
						<br>
					</div>
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

<div id="ModalUnit6Act22" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act22">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete the timetable information that is missing</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
									<div class="text-center mb-3">
										<img src="../../resources/img/BOOKS/SeventhGrade/UnitSix/activities/23.jpg" class="img-fluid center" style="width: 40%;">
									</div>
									<table class="table">
										<tr>
											<th colspan="5" class="text-center">Arrivals</th>
										</tr>
										<tr>
											<th>Flight N°</th>
											<th>Gate N°</th>
											<th>From</th>
											<th>Time</th>
											<th>Status</th>
										</tr>
										<tr>
											<td>LC155</td>
											<td>12</td>
											<td>Santiago</td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act22-1" placeholder="..." style="width:200px; display: inline-block;"> </td>
											<td>On time</td>
										</tr>
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act22-2" placeholder="..." style="width:200px; display: inline-block;"> </td>
											<td>15</td>
											<td>Cancún</td>
											<td>6:05PM</td>
											<td>On time</td>
										</tr>
										<tr>
											<td>310/198</td>
											<td>8</td>
											<td>Orlando</td>
											<td>9:15AM</td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act22-3" placeholder="..." style="width:200px; display: inline-block;"> </td>
										</tr>
										<tr>
											<td>UA302</td>
											<td>4</td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act22-4" placeholder="..." style="width:200px; display: inline-block;"> </td>
											<td>5:50PM</td>
											<td>Delayed</td>
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

<div id="ModalUnit6Act23" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act23">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the sentences describing habitual activities</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-1"><label for="cb23-1">&nbsp;My brother always plays the piano at night.</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-5"><label for="cb23-5">&nbsp;I am fourteen years old.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-6"><label for="cb23-6">&nbsp;I sometimes read a book in the afternoon.</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-2"><label for="cb23-2">&nbsp;My uncle always goes to the movies on Sundays.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-3"><label for="cb23-3">&nbsp;The plane arrives at 7 o'clock</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-7"><label for="cb23-7">&nbsp;I got a new notebook.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-4"><label for="cb23-4">&nbsp;Christmas is on December 25th.</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-8"><label for="cb23-8">&nbsp;I always drink water during dinner.</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-9"><label for="cb23-9">&nbsp;My sister usually sleeps six hours.</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb23-10"><label for="cb23-10">&nbsp;I will go to the circus tomorrow.</label>
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

<div id="ModalUnit6Act24" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act24">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points24" name="points">
											<input type="text" class="d-none" id="idcliente24" name="idcliente">
											<input type="text" class="d-none" id="idlibro24" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. Why is Independence Day very important?</b></p>
                                        <select id="select-act24-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Because the students prepare to march.</option>
                                            <option value="2">Because it was the day El Salvador got its freedom from Spain.</option>
                                            <option value="3">Because people eat donuts.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a preposition?</b></p>
                                        <select id="select-act24-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The status of belonging to a particular nation.</option>
                                            <option value="2">A word referring to the person or thing that performs an action.</option>
                                            <option value="3">It describes a relationship between other words in a sentence.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write a paragraph describing what your family does in holidays</b></p>
										<div class="d-flex align-items-center">
											<textarea class="form-control" rows="4" id="input-act24-1"></textarea>
										</div>	
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
										<p><b>IV. Write a paragraph describing what you do in Mother's Day</b></p>
										<div class="d-flex align-items-center">
											<textarea class="form-control" rows="4" id="input-act24-2"></textarea>
										</div>	
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you cooperate with others and feel better inside?</b></p>
                                        <select id="select-act24-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring my classmates when working together.</option>
                                            <option value="2">By talking about a problem and helping them.</option>
                                            <option value="3">Acting like we don't believe in them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you tolerate classmates' language skills weaknesses?</b></p>
                                        <select id="select-act24-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Celebrating holidays together.</option>
                                            <option value="2">Saving money and calculating our resources.</option>
                                            <option value="3">Helping them because they are learning a new language.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Are you able to use your inspiration and say good thoughts about Independence Day?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act24-3">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Would you explore why Independence Day became an important holiday?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act24-4">
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

<div id="ModalUnit6Act25" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit6-act25">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points25" name="points">
											<input type="text" class="d-none" id="idcliente25" name="idcliente">
											<input type="text" class="d-none" id="idlibro25" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is a month of the year?</b></p>
                                        <select id="select-act25-1" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">A word that expresses the location of an item in an ordered sequence.</option>
                                            <option value="2">A sentence used when referring to holidays or birthdays.</option>
                                            <option value="3">Any part of the twelve parts into which the calendar year is divided.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is an ordinal number?</b></p>
                                        <select id="select-act25-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A word that expresses the location of an item in an ordered sequence.</option>
                                            <option value="2">A sentence used when referring to holidays or birthdays.</option>
                                            <option value="3">Any part of the twelve parts into which the calendar year is divided.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the correct answer about people's age, date and place of birth</b></p>
										<div class="d-flex align-items-center mb-3">
											<label>How old is boris?</label>
											<select id="select-act25-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">He's sixteen year old.</option>
												<option value="2">On December 14th, 2006.</option>
												<option value="3">He was born in Mexico.</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">When was he born?</option>
												<option value="2">How old is Mario?</option>
												<option value="3">Is his birthday coming?</option>
											</select>
											<label>On September 28th, 2002.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label> Where was Elizabeth born?.</label>
											<select id="select-act25-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">On June 26th, 2005.</option>
												<option value="2">She is seventeen years old</option>
												<option value="3">She was born in Germany</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">How old is Jessica?</option>
												<option value="2">When was Jessica born?</option>
												<option value="3">When was Oscar born</option>
											</select>
											<label>She was born on October 30th.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
										<p><b>IV. Write the ordinal numbers from 1st to 31st</b></p>
										<table class="table">
											<tr>
												<td>1st</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-1" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>2nd</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-2" placeholder="..."></td>
											</tr>
											<tr>
												<td>3rd</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-3" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>4th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-4" placeholder="..."></td>
											</tr>
											<tr>
												<td>5th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-5" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>6th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-6" placeholder="..."></td>
											</tr>
											<tr>
												<td>7th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-7" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>8th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-8" placeholder="..."></td>
											</tr>
											<tr>
												<td>9th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-9" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>10th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-10" placeholder="..."></td>
											</tr>
											<tr>
												<td>11th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-11" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>12th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-12" placeholder="..."></td>
											</tr>
											<tr>
												<td>13th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-13" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>14th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-14" placeholder="..."></td>
											</tr>
											<tr>
												<td>15th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-15" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>16th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-16" placeholder="..."></td>
											</tr>
											<tr>
												<td>17th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-17" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>18th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-18" placeholder="..."></td>
											</tr>
											<tr>
												<td>19th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-19" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>20th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-20" placeholder="..."></td>
											</tr>
											<tr>
												<td>21st</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-21" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>22nd</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-22" placeholder="..."></td>
											</tr>
											<tr>
												<td>23rd</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-23" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>24th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-24" placeholder="..."></td>
											</tr>
											<tr>
												<td>25th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-25" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>26th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-26" placeholder="..."></td>
											</tr>
											<tr>
												<td>27th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-27" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>28th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-28" placeholder="..."></td>
											</tr>
											<tr>
												<td>29th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-29" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>30th</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-30" placeholder="..."></td>
											</tr>
											<tr>
												<td>31st</td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act25-31" placeholder="..."></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you be interested in helping your partners?</b></p>
                                        <select id="select-act25-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By using polite words and showing respect.</option>
                                            <option value="2">By not bringing my personal problems to the classroom.</option>
                                            <option value="3">By reading new texts to learn new vocabulary.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How could you be polite when talking to classmates?</b></p>
                                        <select id="select-act25-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By using polite words and showing respect.</option>
                                            <option value="2">By not bringing my personal problems to the classroom.</option>
                                            <option value="3">By reading new texts to learn new vocabulary.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How could you use brainstorming with your family and get ideas to celebrate Christmas?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act25-32">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you use your leadership and carry out a Christmas celebration with your family?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act25-33">
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

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u6.js');
?>