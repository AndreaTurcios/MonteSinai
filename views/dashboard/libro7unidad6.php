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
											<p class="fs-5 fw-bold">Select the correct wh- questions and answers</p>
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
                                                <option value="1">Who</option>
                                                <option value="2">Where</option>
                                                <option value="3">When</option>
                                            </select>
                                            <label>are we going to the park?</label>
                                        </td>
										<td>
                                            <select id="select-act9-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">We are going next tuesday.</option>
                                                <option value="2">Pablo and Katherine.</option>
                                                <option value="3">To the park.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">How</option>
                                                <option value="2">What</option>
                                                <option value="3">Who</option>
                                            </select>
                                            <label>did you make this cake?</label>
                                        </td>
										<td>
                                            <select id="select-act9-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Chocolate cake.</option>
                                                <option value="2">I followed my mom's recipe.</option>
                                                <option value="3">I made it.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Where</option>
                                                <option value="2">What</option>
                                                <option value="3">Who</option>
                                            </select>
                                            <label>is my notebook?</label>
                                        </td>
										<td>
                                            <select id="select-act9-6" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Yours.</option>
                                                <option value="2">It is your notebook.</option>
                                                <option value="3">It is in your backpack.</option>
                                            </select>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
                                            <select id="select-act9-7" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">When</option>
                                                <option value="2">What</option>
                                                <option value="3">How</option>
                                            </select>
                                            <label>is your mother?</label>
                                        </td>
										<td>
                                            <select id="select-act9-8" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">My mother.</option>
                                                <option value="2">She is fine.</option>
                                                <option value="3">Tomorrow.</option>
                                            </select>
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
											<p class="fs-5 fw-bold">Complete the text</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									<audio controls style="margin-top: 10px; margin-bottom: 10px;">
										<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK70.mp3" type="audio/mp3">
										Tu navegador no soporta audio HTML5.
									</audio>
									<div>
											<p class="text-justify" style="display: inline;">The principal attraction is the traditional "bajada" (descent) or procession of the Patron Saint, the </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-1" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">that parades the principal streets of </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-2" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;"><b>San Salvador</b> representing the Transfiguration of Jesus Christ. </p>
											<br>
											<br>
											<p class="text-justify" style="display: inline;">Almost every town in El Salvador celebrates a</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-3" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">in honor of its Patron Saint. These religious feasts are also a time for </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-4" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">and for the organization of</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-5" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">that many people from the rest of the country attend. They are the most </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act10-6" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">of these traditional feasts.</p>
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
                                        <p><b>I. What is Christmas?</b></p>
                                        <select id="select-act11-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Is a season of traditions and the evening before it can be as meaninful as itself.</option>
                                            <option value="2">Movable articles in a room or an establishment that make it fit for living or working.</option>
                                            <option value="3">Is the anniversary of a person's birth or of the date of origin of something.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a birthday?</b></p>
                                        <select id="select-act11-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">Is a season of traditions and the evening before it can be as meaninful as itself.</option>
                                            <option value="2">Movable articles in a room or an establishment that make it fit for living or working.</option>
                                            <option value="3">Is the anniversary of a person's birth or of the date of origin of something.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Complete the wh- questions and select the correct answer</b></p>
										<table class="table">
											<tr>
												<td class="d-flex align-items-center">
													<select id="select-act11-3" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Who</option>
														<option value="2">Where</option>
														<option value="3">When</option>
													</select>
													<label>are we going tomorrow?</label>
												</td>
												<td>
													<select id="select-act11-4" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">To the park.</option>
														<option value="2">Pablo and Katherine.</option>
														<option value="3">We are going next tuesday.</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="d-flex align-items-center">
													<select id="select-act11-5" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">How</option>
														<option value="2">What</option>
														<option value="3">Who</option>
													</select>
													<label>did you do yesterday</label>
												</td>
												<td>
													<select id="select-act11-6" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">With Katherine.</option>
														<option value="2">To the movies.</option>
														<option value="3">I was baking a cake.</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="d-flex align-items-center">
													<select id="select-act11-7" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Where</option>
														<option value="2">What</option>
														<option value="3">Who</option>
													</select>
													<label>are you working with?</label>
												</td>
												<td>
													<select id="select-act11-8" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">I'm working tomorrow.</option>
														<option value="2">I'm working with you.</option>
														<option value="3">I'm doing my homework.</option>
													</select>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the correct holiday based on the description </b></p>
										<table class="table">
											<tr>
												<td>On May 10th, some people give them gifts.</td>
												<td>
													<select id="select-act11-9" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Mother's day</option>
														<option value="2">Father's day</option>
														<option value="3">Independence day</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>On May 1st, demonstrations on the streets.</td>
												<td>
													<select id="select-act11-10" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Labor day</option>
														<option value="2">Easter</option>
														<option value="3">Children's day</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>On December 24th, birth of Christ.</td>
												<td>
													<select id="select-act11-11" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">All souls' dayAll souls' day</option>
														<option value="2">Valentine's day</option>
														<option value="3">Christmas Eve</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>On September 15th, parades on the streets.</td>
												<td>
													<select id="select-act11-12" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Labor day</option>
														<option value="2">Valentine's day</option>
														<option value="3">Independence day</option>
													</select>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you help being interested in classmates' participation?</b></p>
                                        <select id="select-act11-13" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Saying thanks to them.</option>
                                            <option value="2">By asking questions.</option>
                                            <option value="3">Trying to help them when being in the classroom.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you help being interested in helping classmates?</b></p>
                                        <select id="select-act11-14" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">Saying thanks to them.</option>
                                            <option value="2">By asking questions</option>
                                            <option value="3">Trying to help them when being in the classroom.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Could you use your inspiration in order to prepare an unforgetable birthday</b></p>
										<input type="text" autocomplete="off" class="form-control" id="input-act11-1">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How would you use your teamwork and create the unforgetable birthday?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act11-2">
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
									<table class="table" style="width: 70%;">
										<tr>
											<th>Holiday</th>
											<th>Date</th>
										</tr>
										<tr>
											<td>All souls' day</td>
											<td>
												<select id="select-act12-1" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">May 10th</option>
													<option value="2">November 2nd</option>
													<option value="3">September 15th</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Easter</td>
											<td>
												<select id="select-act12-2" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">In March or April</option>
													<option value="2">June 22nd</option>
													<option value="3">February 14th</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<select id="select-act12-3" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Mother's day</option>
													<option value="2">Christmas eve</option>
													<option value="3">Independence day</option>
												</select>
											</td>
											<td>September 15th</td>
										</tr>
										<tr>
											<td>
												<select id="select-act12-4" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">August festivals</option>
													<option value="2">Teacher's day</option>
													<option value="3">Valentine's day</option>
												</select>
											</td>
											<td>February 14th</td>
										</tr>
										<tr>
											<td>December 24th</td>
											<td>
												<select id="select-act12-5" class="ms-1 me-1 form-select" style="width: auto;">
													<option value="0" selected disabled></option>
													<option value="1">Labor day</option>
													<option value="2">Christmas Eve</option>
													<option value="3">All souls' day</option>
												</select>
											</td>
										</tr>
									</table>
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
											<p class="fs-5 fw-bold">Write a 5-line paragraph describing what your family does in holidays</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<textarea class="form-control" rows="5" id="input-act13-1"></textarea>
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
											<p class="fs-5 fw-bold">Select the correct preposition</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="d-flex align-items-center mb-3">
										<label>I go to soccer practice  </label>
										<select id="select-act14-1" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label>Sundays.</label>
									</div>
									<div class="d-flex align-items-center mb-3">
										<label>I go on vacations </label>
										<select id="select-act14-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label>November.</label>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="d-flex align-items-center mb-3">
										<label>Mother's day is</label>
										<select id="select-act14-3" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label>May.</label>
									</div>
									<div class="d-flex align-items-center mb-3">
										<label>Her birthday is </label>
										<select id="select-act14-4" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label>August 29th.</label>
									</div>
								</div>
								<div class="row row-cols-2">
									<div class="d-flex align-items-center mb-3">
										<label>I visit my grandparents</label>
										<select id="select-act14-5" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label>Thursdays.</label>
									</div>
									<div class="d-flex align-items-center mb-3">
										<label>The game is realeased  </label>
										<select id="select-act14-6" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
											<option value="1">on</option>
											<option value="2">in</option>
										</select>
										<label> August.</label>
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
											<p class="fs-5 fw-bold">Check the activities done on independence day</p>
											<input type="text" class="d-none" id="points15" name="points">
											<input type="text" class="d-none" id="idcliente15" name="idcliente">
											<input type="text" class="d-none" id="idlibro15" name="idlibro">
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-1"><label for="cb3-1">&nbsp;Cheerleaders get ready to dance</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-5"><label for="cb3-5">&nbsp;People go to church processions</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-2"><label for="cb3-2">&nbsp;People prepare turkey for dinner</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-6"><label for="cb3-6">&nbsp;There are parades on the streets</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-3"><label for="cb3-3">&nbsp;Couple exchange gifts</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-7"><label for="cb3-7">&nbsp;Students give presents to their teachers</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-4"><label for="cb3-4">&nbsp;Students and bands get ready to march</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb3-8"><label for="cb3-8">&nbsp;People put flowers on graves</label>
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
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write a 5-line paragraph describing what you do in Mother's day</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<textarea class="form-control" rows="5" id="input-act16-1"></textarea>
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
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points17" name="points">
											<input type="text" class="d-none" id="idcliente17" name="idcliente">
											<input type="text" class="d-none" id="idlibro17" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is a preposition?</b></p>
                                        <select id="select-act17-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A very important holiday in El Salvador, celebrated on September 15th.</option>
                                            <option value="2">It describes a relationship between other words in a sentence.</option>
                                            <option value="3">A day set apart in honor of some person or in commemoration of some event.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a holiday?</b></p>
                                        <select id="select-act17-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">A very important holiday in El Salvador, celebrated on September 15th.</option>
                                            <option value="2">It describes a relationship between other words in a sentence.</option>
                                            <option value="3">A day set apart in honor of some person or in commemoration of some event.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write a paragraph describing what you do in Mother's Day:</b></p>
										<div class="d-flex align-items-center mb-3">
											<textarea class="form-control" rows="5" id="input-act17-1"></textarea>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the correct holiday and dates</b></p>
										<table class="table">
											<tr>
												<th>Holiday</th>
												<th>Date</th>
											</tr>
											<tr>
												<td>Independence day</td>
												<td>
													<select id="select-act17-3" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">May 10th</option>
														<option value="2">November 2nd</option>
														<option value="3">September 15th</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>Teacher's day</td>
												<td>
													<select id="select-act17-4" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">In March or April</option>
														<option value="2">June 22nd</option>
														<option value="3">February 14th</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>
													<select id="select-act17-5" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">Mother's day</option>
														<option value="2">Christmas eve</option>
														<option value="3">Independence day</option>
													</select>
												</td>
												<td>December 24th</td>
											</tr>
											<tr>
												<td>
													<select id="select-act17-6" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">August festivals</option>
														<option value="2">Teacher's day</option>
														<option value="3">Valentine's day</option>
													</select>
												</td>
												<td>February 14th</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show respect when greeting people?</b></p>
                                        <select id="select-act17-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Saying sentences like "please", "thank you".</option>
                                            <option value="2">Holding the door open for someone who needs help.</option>
                                            <option value="3">Greeting them in a proper and friendly manner.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you show respect with nice phrases to people?</b></p>
                                        <select id="select-act17-8" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">Saying sentences like "please", "thank you".</option>
                                            <option value="2">Holding the door open for someone who needs help.</option>
                                            <option value="3">Greeting them in a proper and friendly manner.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Are you able to use your inspiration and express positive thoughts about your mother?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act17-2">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How would you apply proactivity and show your mother how much you love her?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act17-3">
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
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td class="d-flex align-items-center">
											<label>What </label>
                                            <select id="select-act18-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">does</option>
                                                <option value="2">do</option>
                                            </select>
                                            <label>Katherine do on weekends?</label>
                                        </td>
										<td>
                                            She goes to the library.
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Where </label>
                                            <select id="select-act18-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">does</option>
                                                <option value="2">do</option>
                                            </select>
                                            <label>they live?</label>
                                        </td>
										<td>
                                            <label>They live in Mexico.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Why</label>
                                            <select id="select-act18-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">does</option>
                                                <option value="2">do</option>
                                            </select>
                                            <label>your brother study german?</label>
                                        </td>
										<td>
                                            <label>Because he wants to travel to Germany.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>When </label>
                                            <select id="select-act18-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">does</option>
                                                <option value="2">do</option>
                                            </select>
                                            <label>this class end?</label>
                                        </td>
										<td>
											<label>It ends at 11 o'clock.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>How many siblings </label>
                                            <select id="select-act18-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">does</option>
                                                <option value="2">do</option>
                                            </select>
                                            <label>you have?</label>
                                        </td>
										<td>
											<label>I have two siblings, a brother and a sister.</label>
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
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-1"><label for="cb19-1">&nbsp;People put flowes on graves</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-5"><label for="cb19-5">&nbsp;People go to church processions</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-2"><label for="cb19-2">&nbsp;Workers march on the streets</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-6"><label for="cb19-6">&nbsp;Cheerleaders get ready to dance</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2 mb-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-3"><label for="cb19-3">&nbsp;Students get ready to march</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-7"><label for="cb19-7">Trade unions make a parade </label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-4"><label for="cb19-4">&nbsp;Couple exchange gifts</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb19-8"><label for="cb19-8">&nbsp;Suspension of bussines</label>
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
											<p class="fs-5 fw-bold">Complete the text</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									<audio controls style="margin-top: 10px; margin-bottom: 10px;">
										<source src="../../resources/audio/ingles_septimo/UnitSix/TRACK78.mp3" type="audio/mp3">
										Tu navegador no soporta audio HTML5.
									</audio>
									<div>
											<p class="text-justify" style="display: inline;">We celebrate </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-1" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">on December 24th. Our tradition is to eat </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-2" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">, delicious food like beef, or chicken. Our desserts are delicious. But the most important is the birth of Jesus at </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-3" placeholder="..." style="width:200px; display: inline-block;"> 
											<br>
											<br>
											<p class="text-justify" style="display: inline;">On October 31 is </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-4" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">, some teenagers wear different clothes and scare many people. On</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-5" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">in the U.S., people enjoy reading the messages found on tiny pastel-colored</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-6" placeholder="..." style="width:200px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. These candies have been popular for a hundred years for a hundred years. Traditional messages such as "be mine"
												or "thank you" are printed on the candies.</p>
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
											<p class="fs-5 fw-bold">Select the correct verb in present tense</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
								</div>
								
								<table class="table">
									<tr>
										<td class="d-flex align-items-center">
											<label>My father </label>
                                            <select id="select-act21-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">eat</option>
                                                <option value="2">eats</option>
                                            </select>
                                            <label>meat.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>They </label>
                                            <select id="select-act21-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">play</option>
                                                <option value="2">plays</option>
                                            </select>
                                            <label>basketball on sundays.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>Mario</label>
                                            <select id="select-act21-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">take</option>
                                                <option value="2">takes</option>
                                            </select>
                                            <label>the bus every morning.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>She never </label>
                                            <select id="select-act21-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">wear</option>
                                                <option value="2">wears</option>
                                            </select>
                                            <label>earrings.</label>
                                        </td>
									</tr>
									<tr>
										<td class="d-flex align-items-center">
											<label>You  </label>
                                            <select id="select-act21-5" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">has</option>
                                                <option value="2">have</option>
                                            </select>
                                            <label>to play this new game.</label>
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

<div id="ModalUnit6Act22" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
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
											<p class="fs-5 fw-bold">Write a descriptive paragraph about any holiday</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
									<div class="d-flex align-items-center mb-3">
										<textarea class="form-control" rows="5" id="input-act22-1"></textarea>
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
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points23" name="points">
											<input type="text" class="d-none" id="idcliente23" name="idcliente">
											<input type="text" class="d-none" id="idlibro23" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. What is the present tense?</b></p>
                                        <select id="select-act23-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">It expresses an unchanging, repeated or reocurring action.</option>
                                            <option value="2">Writing the new words we hear and reading new texts.</option>
                                            <option value="3">A word that describes an action that is happening now.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is an action verb?</b></p>
                                        <select id="select-act23-2" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
                                            <option value="1">It expresses an unchanging, repeated or reocurring action.</option>
                                            <option value="2">Writing the new words we hear and reading new texts.</option>
                                            <option value="3">A word that describes an action that is happening now.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the correct action verb in present tense</b></p>
										<table class="table">
											<tr>
												<td class="d-flex align-items-center">
													<label>I </label>
													<select id="select-act23-3" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">listen</option>
														<option value="2">listens</option>
													</select>
													<label>to music.</label>
												</td>
											</tr>
											<tr>
												<td class="d-flex align-items-center">
													<label>The children </label>
													<select id="select-act23-4" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">draw</option>
														<option value="2">draws</option>
													</select>
													<label>on their notebooks.</label>
												</td>
											</tr>
											<tr>
												<td class="d-flex align-items-center">
													<label>Katherine</label>
													<select id="select-act23-5" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">swim</option>
														<option value="2">swims</option>
													</select>
													<label>on Sunday.</label>
												</td>
											</tr>
											<tr>
												<td class="d-flex align-items-center">
													<label>My father </label>
													<select id="select-act23-6" class="ms-1 me-1 form-select" style="width: auto;">
														<option value="0" selected disabled></option>
														<option value="1">runs</option>
														<option value="2">run</option>
													</select>
													<label>on weekends.</label>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Select the activities done during Labor Day</b></p>
										<div class="row row-cols-2 mb-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-1"><label for="cb23-1">&nbsp;People put flowes on graves</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-5"><label for="cb23-5">&nbsp;People go to church processions</label>
												</div>
											</div>
										</div>
										<div class="row row-cols-2 mb-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-2"><label for="cb23-2">&nbsp;Workers march on the streets</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-6"><label for="cb23-6">&nbsp;Cheerleaders get ready to dance</label>
												</div>
											</div>
										</div>
										<div class="row row-cols-2 mb-2">
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-3"><label for="cb23-3">&nbsp;Students get ready to march</label>
												</div>
											</div>
											<div class="col">
												<div>
													<input type="checkbox" id="cb23-4"><label for="cb23-4">Trade unions make a parade</label>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can we tolerate classmates and treat them with respect?</b></p>
                                        <select id="select-act23-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Being true and letting them know that we appreciate their compliments.</option>
                                            <option value="2">Ignoring their remarkes.</option>
                                            <option value="3">Listening when they participate.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. Can you cooperate in a group and smile at the same time?</b></p>
                                        <select id="select-act23-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Yes, and it helps us grow and enjoy being with them.</option>
                                            <option value="2">No, because it is pointless.</option>
                                            <option value="3">Using pejorative language when talking to them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Create a mental map about how Christmas is celebrated in other countries?</b></p>
										<header>
											<div class="grid ">
												<div class="color">
													<p>Pick a color:</p>
													<div class="colorPickerWrapper">
														<input type="color" id="colorPicker2" value="#55D0ED">
													</div>
												</div>
												<div class="stroke">
													<p>Change the stroke's width:</p>
													<div class="strokeWidthPickerWrapper">
														<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker2">
													</div>
												</div>
												<div class="clear">
													<p>clear the canvas:</p>
													<div class="clearBtnWrapper">
														<a href="#" id="clearBtn2">Clear canvas</a>
													</div>
												</div>
											</div>
											<br>
											<br>
											<div class="container">
												<input type="number" value="0" id="verify-canvas" class="d-none">
												<canvas id="canvas3" width="500" height="500">
												</canvas>
											</div>
										</header>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. Can you explore other ways how Christmas is celebrated in other parts of the world?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act23-1">
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