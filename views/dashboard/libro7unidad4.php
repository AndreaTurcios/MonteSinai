<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 4');
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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/21.JPG" width="76" height="100"
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

			pages: 27,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadcuatroseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit4Act1" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the next numbers</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">200.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="..." max-length="30" style="width:300px;"> 
								    </div>
									<div class="col d-flex align-items-center">
                                    	<label class="me-2">300.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								</div>
								<div class=" row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">415. </label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								    <div class="col d-flex align-items-center">
										<label class="me-2">500. </label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">608</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-5" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								    <div class="col d-flex align-items-center">
										<label class="me-2">700.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-6" placeholder="..." max-length="30" style="width:300px;"> 
									</div>										
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">820.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-7" placeholder="..." max-length="30" style="width:300px;"> 
									</div>                                    
									<div class="col d-flex align-items-center">
										<label class="me-2">900.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-8" placeholder="..." max-length="30" style="width:300px;"> 
									</div>                                    
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">901.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-9" placeholder="..." max-length="30" style="width:300px;"> 
									</div>                                    
									<div class="col d-flex align-items-center">
										<label class="me-2">1000.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act1-10" placeholder="..." max-length="30" style="width:300px;"> 
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

<div id="ModalUnit4Act2" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the money denominations you hear</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK44.mp3" type="audio/mp3">
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
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-9" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act2-10" placeholder="...">
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

<div id="ModalUnit4Act3" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the clothes and accesories and select the price</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_1.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-1" placeholder="..."></td>
										<td>
											<select id="select-act3-1" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ninety-five dollars</option>
												<option value="2">Thirty dollars</option>
												<option value="3">Fifty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_2.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-2" placeholder="..."></td>
										<td>
											<select id="select-act3-2" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ninety-five dollars</option>
												<option value="2">Thirty dollars</option>
												<option value="3">Fifty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_3.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-3" placeholder="..."></td>
										<td>
											<select id="select-act3-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ninety-five dollars</option>
												<option value="2">Thirty dollars</option>
												<option value="3">Fifty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_4.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-4" placeholder="..."></td>
										<td>
											<select id="select-act3-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Three hundred dollars</option>
												<option value="2">One hundred and fifty</option>
												<option value="3">Eighty dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_5.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-5" placeholder="..."></td>
										<td>
											<select id="select-act3-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Three hundred dollars</option>
												<option value="2">One hundred and fifty</option>
												<option value="3">Eighty dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_6.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-6" placeholder="..."></td>
										<td>
											<select id="select-act3-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Three hundred dollars</option>
												<option value="2">One hundred and fifty dollars</option>
												<option value="3">Eighty dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_7.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-7" placeholder="..."></td>
										<td>
											<select id="select-act3-7" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Fifty dollars</option>
												<option value="2">Five hundred dollars</option>
												<option value="3">One hundred dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/4_8.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act3-8" placeholder="..."></td>
										<td>
											<select id="select-act3-8" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Fifty dollars</option>
												<option value="2">Five hundred dollars</option>
												<option value="3">One hundred dollars</option>
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

<div id="ModalUnit4Act4" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the goods and select the price you hear</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK46.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
								<table class="table">
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_1.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-1" placeholder="..."></td>
										<td>
											<select id="select-act4-1" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Thirty-five dollars</option>
												<option value="2">Fifty dollars</option>
												<option value="3">Four hundred seventy-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_2.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-2" placeholder="..."></td>
										<td>
											<select id="select-act4-2" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Thirty-five dollars</option>
												<option value="2">Fifty dollars</option>
												<option value="3">Four hundred seventy-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_3.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-3" placeholder="..."></td>
										<td>
											<select id="select-act4-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Thirty-five dollars</option>
												<option value="2">Fifty dollars</option>
												<option value="3">Four hundred seventy-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_4.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-4" placeholder="..."></td>
										<td>
											<select id="select-act4-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ten dollars</option>
												<option value="2">Three hundred and twenty-five dollars</option>
												<option value="3">One hundred and twenty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_5.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-5" placeholder="..."></td>
										<td>
											<select id="select-act4-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ten dollars</option>
												<option value="2">Three hundred and twenty-five dollars</option>
												<option value="3">One hundred and twenty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_6.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-6" placeholder="..."></td>
										<td>
											<select id="select-act4-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ten dollars</option>
												<option value="2">Three hundred and twenty-five dollars</option>
												<option value="3">One hundred and twenty-five dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_7.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-7" placeholder="..."></td>
										<td>
											<select id="select-act4-7" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ninety dollars</option>
												<option value="2">Five hundred dollars</option>
												<option value="3">Forty dollars</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/5_8.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-8" placeholder="..."></td>
										<td>
											<select id="select-act4-8" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Ninety dollars</option>
												<option value="2">Five hundred dollars</option>
												<option value="3">Forty dollars</option>
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

<div id="ModalUnit4Act5" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act5">
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
                                        <p><b>I. What is a good?</b></p>
                                        <select id="select-act5-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A tense that describes something that happened in the past.</option>
                                            <option value="2">A product that satisfies a markeet need.</option>
                                            <option value="3">A coin or note used in a country.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is money denomination?</b></p>
                                        <select id="select-act5-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">A tense that describes something that happened in the past.</option>
                                            <option value="2">Products that satisfy a markeet need.</option>
                                            <option value="3">Coins and notes used in a country.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write the following money denominations</b></p>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">$1</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-1" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">$5</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-2" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">$10 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-3" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">$100 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-4" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">1 cent </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-5" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">5 cents</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-6" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">10 cents</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-7" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col d-flex align-items-center">
												<label class="me-2">25 cents</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-8" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the following number in English</b></p>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">200</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-9" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">400</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-10" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">500</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-11" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">600 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-12" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">700</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-13" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">800</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-14" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">900</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-15" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col d-flex align-items-center">
												<label class="me-2">1000</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act5-16" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you develop awareness of the value of money?</b></p>
                                        <select id="select-act5-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">By saving money knowing that it is very important.</option>
                                            <option value="2">Maintaining eye contact and smiling.</option>
                                            <option value="3">Buying things we don't need.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you demonstrate empathy to others?</b></p>
                                        <select id="select-act5-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Considering the value of money.</option>
                                            <option value="2">Helping them and understanding their point of view.</option>
                                            <option value="3">Using pejorative language when talking to them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How could you use brainstorming to generate lots of ideas on how to save money?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act5-17">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you apply proactivity and use your best idea to save money?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act5-18">
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

<div id="ModalUnit4Act6" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the clothing items and accessories you hear</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK47.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-1" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-2" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-3" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-4" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-5" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-6" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-7" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-8" placeholder="...">
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

<div id="ModalUnit4Act7" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the name of the furniture</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_1.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-1" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_2.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-2" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_3.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-3" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_4.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-4" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_5.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-5" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_6.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-6" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_7.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-7" placeholder="..."></td>
									</tr>
									<tr>
										<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/8_8.jpg" ></td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act7-8" placeholder="..."></td>
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

<div id="ModalUnit4Act8" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label>those oranges?</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label>these shoes?</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label> that shirt?</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-4" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label> the tomatoes?</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-5" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label>this bracelet?</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act8-6" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How much is</option>
                                        <option value="2">How much are</option>
                                    </select>
									<label>the chair?</label>
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

<div id="ModalUnit4Act9" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act9">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the words related to clothing you hear</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK50.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
								<br>
								<div class="row row-cols-2">
									<div class="col">
										<div>
											<input type="checkbox" id="cb9-1"><label for="cb9-1">&nbsp;Shoes</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-2"><label for="cb9-2">&nbsp;Styles</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-3"><label for="cb9-3">&nbsp;Sunglasses</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-4"><label for="cb9-4">&nbsp;Fabrics</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb9-5"><label for="cb9-5">&nbsp;Clothes</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-6"><label for="cb9-6">&nbsp;Jacket</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-7"><label for="cb9-7">&nbsp;Fashions</label>
										</div>
										<div>
											<input type="checkbox" id="cb9-8"><label for="cb9-8">&nbsp;Trends</label>
										</div>
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

<div id="ModalUnit4Act10" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act10">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose and drag</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Rainy</th>
												<tr>
													<td id="box-act10-1"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Cloudy</th>
												<tr>
													<td id="box-act10-2" ></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act10-1" class="col d-table" draggable="true">Umbrella</div>
												<div id="option-act10-2" class="col d-table" draggable="true">Dress</div>
												<div id="option-act10-3" class="col d-table" draggable="true">Jacket</div>
												<div id="option-act10-4" class="col d-table" draggable="true">Tie</div>
												<div id="option-act10-5" class="col d-table" draggable="true">Shirt</div>
												<div id="option-act10-6" class="col d-table" draggable="true">Ring</div>
												<div id="option-act10-7" class="col d-table" draggable="true">Earrings</div>
												<div id="option-act10-8" class="col d-table" draggable="true">Belt</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Windy</th>
												<tr>
													<td id="box-act10-3"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center ">Snowy</th>
												<tr>
													<td id="box-act10-4"></td>
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

<div id="ModalUnit4Act11" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act11">
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
                                        <p><b>I. What is furniture?</b></p>
                                        <select id="select-act11-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">An object or device not essential in itself but adding to the beauty, convenience or effectiveness.</option>
                                            <option value="2">Movable articles in a room or an establishment that make it fit for living or working.</option>
                                            <option value="3">Products that satisfy a market need.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is an accesory?</b></p>
                                        <select id="select-act11-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">An object or device not essential in itself but adding to the beauty, convenience or effectiveness.</option>
                                            <option value="2">Movable articles in a room or an establishment that make it fit for living or working.</option>
                                            <option value="3">Products that satisfy a market need.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Complete the questions with the correct answer</b></p>
										<div class="d-flex align-items-center mb-3">
											<label> How much is</label>
											<select id="select-act11-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">this shirt?</option>
												<option value="2">those pants?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label> How much are</label>
											<select id="select-act11-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">this tomato?</option>
												<option value="2">these tomatoes?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>How much is</label>
											<select id="select-act11-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">the microwaves?</option>
												<option value="2">the microwave?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>How much are</label>
											<select id="select-act11-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">those shoes?</option>
												<option value="2">this shoes?</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act11-7" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">How much are</option>
												<option value="2">How much is</option>
											</select>
											<label>the avocados?</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act11-8" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">How much are</option>
												<option value="2">How much is</option>
											</select>
											<label> this table?</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the clothing items and accessories </b></p>
										<table class="table">
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_1.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-1" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_2.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-2" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_3.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-3" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_4.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-4" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_5.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-5" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_6.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-6" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_7.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-7" placeholder="..."></td>
											</tr>
											<tr>
												<td><img src="../../resources/img/BOOKS/SeventhGrade/UnitFour/activities/7_8.jpg" ></td>
												<td><input type="text" autocomplete="off" class="form-control" id="input-act11-8" placeholder="..."></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show confidence when taking compliments?</b></p>
                                        <select id="select-act11-9" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Not thanking them.</option>
                                            <option value="2">Shrinking back and acting timid.</option>
                                            <option value="3">Sitting or standing straight.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you compliment your family's preferences for furniture?</b></p>
                                        <select id="select-act11-10" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
                                            <option value="1">Saying thanks to them.</option>
                                            <option value="2">Saying that the colors look wrong.</option>
                                            <option value="3">Saying they look nice in the room.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Make a mental map about what to use when raining</b></p>
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
                                        <p><b>VIII. How would you apply proactivity and choose what you need when it is snowing?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act11-9">
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

<div id="ModalUnit4Act12" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act12">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Choose and drag</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Drinks</th>
												<tr>
													<td id="box-act12-1"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Foods</th>
												<tr>
													<td id="box-act12-2" ></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act12-2" class="col d-table" draggable="true">Coke</div>
												<div id="option-act12-4" class="col d-table" draggable="true">Bottled water</div>
												<div id="option-act12-18" class="col d-table" draggable="true">Coconut</div>
												<div id="option-act12-6" class="col d-table" draggable="true">Tea</div>
												<div id="option-act12-16" class="col d-table" draggable="true">Papaya</div>
												<div id="option-act12-10" class="col d-table" draggable="true">Hamburger</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act12-7" class="col d-table" draggable="true">Meat</div>
												<div id="option-act12-22" class="col d-table" draggable="true">Cucumber</div>
												<div id="option-act12-8" class="col d-table" draggable="true">Shrimp</div>
												<div id="option-act12-1" class="col d-table" draggable="true">Milk</div>
												<div id="option-act12-19" class="col d-table" draggable="true">Lettuce</div>
												<div id="option-act12-11" class="col d-table" draggable="true">Chicken</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act12-20" class="col d-table" draggable="true">Cabbage</div>
												<div id="option-act12-14" class="col d-table" draggable="true">Pear</div>
												<div id="option-act12-15" class="col d-table" draggable="true">Banana</div>
												<div id="option-act12-9" class="col d-table" draggable="true">Tuna</div>
												<div id="option-act12-3" class="col d-table" draggable="true">Diet soda</div>
												<div id="option-act12-17" class="col d-table" draggable="true">Mango</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act12-21" class="col d-table" draggable="true">Tomato</div>
												<div id="option-act12-12" class="col d-table" draggable="true">Pizza</div>
												<div id="option-act12-23" class="col d-table" draggable="true">Carrot</div>
												<div id="option-act12-5" class="col d-table" draggable="true">Coffee</div>
												<div id="option-act12-13" class="col d-table" draggable="true">Apple</div>
												<div id="option-act12-24" class="col d-table" draggable="true">Radishes</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Fruits</th>
												<tr>
													<td id="box-act12-3"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center ">Vegetables</th>
												<tr>
													<td id="box-act12-4"></td>
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

<div id="ModalUnit4Act13" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act13">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct answer</p>
											<input type="text" class="d-none" id="points13" name="points">
											<input type="text" class="d-none" id="idcliente13" name="idcliente">
											<input type="text" class="d-none" id="idlibro13" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>In </label>
									<select id="select-act13-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">summer</option>
                                        <option value="2">winter</option>
                                        <option value="3">fall</option>
                                        <option value="4">spring</option>
                                    </select>
									<label>the weather is sunny.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>During </label>
									<select id="select-act13-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">summer</option>
                                        <option value="2">winter</option>
                                        <option value="3">fall</option>
                                        <option value="4">spring</option>
                                    </select>
									<label>the leaves fall from the trees.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>The flowers bloom during</label>
									<select id="select-act13-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">summer.</option>
                                        <option value="2">winter.</option>
                                        <option value="3">fall.</option>
                                        <option value="4">spring.</option>
                                    </select>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>When it's </label>
									<select id="select-act13-4" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
                                        <option value="1">summer</option>
                                        <option value="2">winter</option>
                                        <option value="3">fall</option>
                                        <option value="4">spring</option>
                                    </select>
									<label> the weather gets very rainy</label>
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


<div id="ModalUnit4Act14" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act14">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the useful expressions you hear</p>
											<input type="text" class="d-none" id="points14" name="points">
											<input type="text" class="d-none" id="idcliente14" name="idcliente">
											<input type="text" class="d-none" id="idlibro14" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK54.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio> 
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-1" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>Yes, I need a belt.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-2" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>Do you have hats.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-3" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>That's expensive.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-4" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>They are cheap.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-5" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>That's OK.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-6" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>That'll be all, thanks.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-7" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>Yes, I do.</p>
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2 d-flex align-items">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act14-8" placeholder="...">
										<label>?</label>
                                    </div>
                                    <div class="col p-2">
                                        <p>Thank you, sir.</p>
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

<div id="ModalUnit4Act15" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act15">
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
												<th class="text-center">Dairy products</th>
												<tr>
													<td id="box-act15-1"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Snacks</th>
												<tr>
													<td id="box-act15-2" ></td>
												</tr>
											</table>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col">
											<div class="row d-flex justify-content-between" id="container-act15-1">
												<div id="option-act15-2" class="col d-table" draggable="true">Chesse</div>
												<div id="option-act15-4" class="col d-table" draggable="true">Yogurt</div>
												<div id="option-act15-6" class="col d-table" draggable="true">Peanuts</div>
												<div id="option-act15-16" class="col d-table" draggable="true">Apple juice</div>
												<div id="option-act15-10" class="col d-table" draggable="true">Pretzels</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-7" class="col d-table" draggable="true">Popcorn</div>
												<div id="option-act15-8" class="col d-table" draggable="true">Nuts</div>
												<div id="option-act15-1" class="col d-table" draggable="true">Milk</div>
												<div id="option-act15-19" class="col d-table" draggable="true">Fruit punch</div>
												<div id="option-act15-11" class="col d-table" draggable="true">Steak</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-20" class="col d-table" draggable="true">Pineapple juice</div>
												<div id="option-act15-14" class="col d-table" draggable="true">Bacon</div>
												<div id="option-act15-15" class="col d-table" draggable="true">Sausages</div>
												<div id="option-act15-3" class="col d-table" draggable="true">Butter</div>
												<div id="option-act15-17" class="col d-table" draggable="true">Tomato juice</div>
											</div>
											<div class="row d-flex justify-content-between" id="container-act10-1">
												<div id="option-act15-12" class="col d-table" draggable="true">Pork</div>
												<div id="option-act15-5" class="col d-table" draggable="true">Cottage cheese</div>
												<div id="option-act15-13" class="col d-table" draggable="true">Ham</div>
												<div id="option-act15-9" class="col d-table" draggable="true">Corn chips</div>
												<div id="option-act15-18" class="col d-table" draggable="true">Grape juice</div>
											</div>
										</div>
									</div>
									<div class="row mb-4 row-cols-2">
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center">Meat</th>
												<tr>
													<td id="box-act15-3"></td>
												</tr>
											</table>
										</div>
										<div class="col">
											<table class="table table-bordered" style="border: #8076b2">
												<th class="text-center ">Juice</th>
												<tr>
													<td id="box-act15-4"></td>
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

<div id="ModalUnit4Act16" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act16">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the vegetables, drinks, fruits and food that you hear</p>
											<input type="text" class="d-none" id="points16" name="points">
											<input type="text" class="d-none" id="idcliente16" name="idcliente">
											<input type="text" class="d-none" id="idlibro16" name="idlibro">
										</div>
									</div>
									<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK56.mp3" type="audio/mp3">
										Tu navegador no soporta audio HTML5.
									</audio>
									<table class="table">
										<tr>
											<th>Vegetables</th>
											<th>Fruits</th>
											<th>Drinks</th>
											<th>Food</th>
										</tr>
										<!--1 al final = vegetables, 2 al final = fruits, 3 al final = drinks, 4 al final = foods-->
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-1-1" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-1-2" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-1-3" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-1-4" placeholder="..."></td>
										</tr>
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-2-1" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-2-2" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-2-3" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-2-4" placeholder="..."></td>
										</tr>
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-3-1" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-3-2" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-3-3" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-3-4" placeholder="..."></td>
										</tr>
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-4-1" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-4-2" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-4-3" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-4-4" placeholder="..."></td>
										</tr>
										<tr>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-5-1" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-5-2" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-5-3" placeholder="..."></td>
											<td><input type="text" autocomplete="off" class="form-control" id="input-act16-5-4" placeholder="..."></td>
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

<div id="ModalUnit4Act17" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act17">
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
                                        <p><b>I. What is a supermarket?</b></p>
                                        <select id="select-act17-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">One of the most healthy and natural foods in existence.</option>
                                            <option value="2">The state of the atmosphere with respect to cold or heat.</option>
                                            <option value="3">A large self-service retail store selling food and other goods.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is the weather?</b></p>
                                        <select id="select-act17-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">One of the most healthy and natural foods in existence.</option>
                                            <option value="2">The state of the atmosphere with respect to cold or heat.</option>
                                            <option value="3">A large self-service retail store selling food and other goods.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Identify the fruits, vegetables, drinks and foods:</b></p>
										<div class="row mb-4 row-cols-2">
											<div class="col">
												<table class="table table-bordered" style="border: #8076b2">
													<th class="text-center">Drinks</th>
													<tr>
														<td id="box-act17-1"></td>
													</tr>
												</table>
											</div>
											<div class="col">
												<table class="table table-bordered" style="border: #8076b2">
													<th class="text-center">Foods</th>
													<tr>
														<td id="box-act17-2" ></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="row mb-4">
											<div class="col">
												<div class="row d-flex justify-content-between" id="container-act10-1">
													<div id="option-act17-2" class="col d-table" draggable="true">Coke</div>
													<div id="option-act17-4" class="col d-table" draggable="true">Bottled water</div>
													<div id="option-act17-18" class="col d-table" draggable="true">Coconut</div>
													<div id="option-act17-6" class="col d-table" draggable="true">Tea</div>
													<div id="option-act17-16" class="col d-table" draggable="true">Papaya</div>
													<div id="option-act17-10" class="col d-table" draggable="true">Hamburger</div>
												</div>
												<div class="row d-flex justify-content-between" id="container-act10-1">
													<div id="option-act17-7" class="col d-table" draggable="true">Meat</div>
													<div id="option-act17-22" class="col d-table" draggable="true">Cucumber</div>
													<div id="option-act17-8" class="col d-table" draggable="true">Shrimp</div>
													<div id="option-act17-1" class="col d-table" draggable="true">Milk</div>
													<div id="option-act17-19" class="col d-table" draggable="true">Lettuce</div>
													<div id="option-act17-11" class="col d-table" draggable="true">Chicken</div>
												</div>
												<div class="row d-flex justify-content-between" id="container-act10-1">
													<div id="option-act17-20" class="col d-table" draggable="true">Cabbage</div>
													<div id="option-act17-14" class="col d-table" draggable="true">Pear</div>
													<div id="option-act17-15" class="col d-table" draggable="true">Banana</div>
													<div id="option-act17-9" class="col d-table" draggable="true">Tuna</div>
													<div id="option-act17-3" class="col d-table" draggable="true">Diet soda</div>
													<div id="option-act17-17" class="col d-table" draggable="true">Mango</div>
												</div>
												<div class="row d-flex justify-content-between" id="container-act10-1">
													<div id="option-act17-21" class="col d-table" draggable="true">Tomato</div>
													<div id="option-act17-12" class="col d-table" draggable="true">Pizza</div>
													<div id="option-act17-23" class="col d-table" draggable="true">Carrot</div>
													<div id="option-act17-5" class="col d-table" draggable="true">Coffee</div>
													<div id="option-act17-13" class="col d-table" draggable="true">Apple</div>
													<div id="option-act17-24" class="col d-table" draggable="true">Radishes</div>
												</div>
											</div>
										</div>
										<div class="row mb-4 row-cols-2">
											<div class="col">
												<table class="table table-bordered" style="border: #8076b2">
													<th class="text-center">Fruits</th>
													<tr>
														<td id="box-act17-3"></td>
													</tr>
												</table>
											</div>
											<div class="col">
												<table class="table table-bordered" style="border: #8076b2">
													<th class="text-center ">Vegetables</th>
													<tr>
														<td id="box-act17-4"></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the sentences using the correct season or weather</b></p>
										<div class="d-flex align-items-center mb-3">
											<label>When it's </label>
											<select id="select-act17-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">summer</option>
												<option value="2">winter</option>
												<option value="3">fall</option>
											</select>
											<label>the weather is hot.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>During winter it</label>
											<select id="select-act17-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">sunny</option>
												<option value="2">clear</option>
												<option value="3">rains</option>
											</select>
											<label> a lot.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>It is </label>
											<select id="select-act17-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">sunny</option>
												<option value="2">cloudy</option>
												<option value="3">lightning</option>
											</select>
											<label> everyday during summer.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>During </label>
											<select id="select-act17-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">summer</option>
												<option value="2">winter</option>
												<option value="3">fall</option>
											</select>
											<label> the leaves fall from the trees.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you listen to what your classmates say?</b></p>
                                        <select id="select-act17-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Talking over them.</option>
                                            <option value="2">Paying attention to them.</option>
                                            <option value="3">Giving them compliments.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you be able to add value to a conversation?</b></p>
                                        <select id="select-act17-8" class="ms-1 me-1 form-select" style="width: auto;">
										<option value="0" selected disabled></option>
                                            <option value="1">Sitting or standing up straight and not acting timid.</option>
                                            <option value="2">Adding a piece of information or a question that keeps the topic alive.</option>
                                            <option value="3">Saying they look nice in the room.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Make a mental map about the healthy benefits of fruits</b></p>
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
												<canvas id="canvas3" width="500" height="500">
												</canvas>
											</div>
										</header>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you apply your exploring capacity to find new healthy benefits of fruits?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act17-1">
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

<div id="ModalUnit4Act18" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act18">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct subject pronoun</p>
											<input type="text" class="d-none" id="points18" name="points">
											<input type="text" class="d-none" id="idcliente18" name="idcliente">
											<input type="text" class="d-none" id="idlibro18" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act18-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">I</option>
                                        <option value="2">She</option>
                                        <option value="3">It</option>
                                    </select>
									<label>go to the park every saturday.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>Are</label>
									<select id="select-act18-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">I</option>
                                        <option value="2">he</option>
                                        <option value="3">you</option>
                                    </select>
									<label> washing the dishes? Yes, I am.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act18-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">She</option>
                                        <option value="2">We</option>
                                        <option value="3">I</option>
                                    </select>
									<label> are going to the mall after school.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act18-4" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">You</option>
                                        <option value="2">He</option>
                                        <option value="3">They</option>
                                    </select>
									<label>is studying german.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act18-5" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">She</option>
                                        <option value="2">They</option>
                                        <option value="3">You</option>
                                    </select>
									<label>is the new teacher.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act18-6" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">He</option>
                                        <option value="2">It</option>
                                        <option value="3">I</option>
                                    </select>
									<label>is raining, bring your umbrella.</label>
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

<div id="ModalUnit4Act19" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act19">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct demonstrative pronouns</p>
											<input type="text" class="d-none" id="points19" name="points">
											<input type="text" class="d-none" id="idcliente19" name="idcliente">
											<input type="text" class="d-none" id="idlibro19" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">That</option>
                                        <option value="2">Those</option>
                                    </select>
									<label>oranges are really cheap.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">That</option>
                                        <option value="2">Those</option>
                                    </select>
									<label> car is red.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">This</option>
                                        <option value="2">These</option>
                                    </select>
									<label> is Steve, he is our classmate.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-4" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">This</option>
                                        <option value="2">These</option>
                                    </select>
									<label>are my new socks.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-5" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">That</option>
                                        <option value="2">Those</option>
                                        <option value="3">This</option>
                                    </select>
									<label>backpack over there is mine.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act19-6" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">These</option>
                                        <option value="2">Those</option>
                                        <option value="3">This</option>
                                    </select>
									<label>is my father, he is a lawyer.</label>
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

<div id="ModalUnit4Act20" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act20">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the correct plural of the word in parenthesis</p>
											<input type="text" class="d-none" id="points20" name="points">
											<input type="text" class="d-none" id="idcliente20" name="idcliente">
											<input type="text" class="d-none" id="idlibro20" name="idlibro">
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">I like those </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-1" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. (shoe)</p>
										</div>
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">My brother has two</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-2" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. (cat)</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">My house has three</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-3" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. (room)</p>
										</div>
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">In that store they sell </p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-4" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. (watch)</p>
										</div>
									</div>
									<div class="row mb-4">
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">Katherine has three</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-5" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;">. (dress)</p>
										</div>
										<div class="col-6 pe-3">
											<p class="text-justify" style="display: inline;">Look! There are</p>
												<input type="text" autocomplete="off" class="form-control" id="input-act20-6" placeholder="..." style="width:100px; display: inline-block;"> 
											<p class="text-justify" style="display: inline;"> over there. (horse)</p>
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

<div id="ModalUnit4Act21" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act21">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the vocabulary you hear</p>
											<input type="text" class="d-none" id="points21" name="points">
											<input type="text" class="d-none" id="idcliente21" name="idcliente">
											<input type="text" class="d-none" id="idlibro21" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFour/TRACK60.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
								<br>
								<div class="row row-cols-3">
									<div class="col">
										<div>
											<input type="checkbox" id="cb21-1"><label for="cb21-1">&nbsp;Blouse</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-2"><label for="cb21-2">&nbsp;Earrings</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-3"><label for="cb21-3">&nbsp;T-shirt</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-4"><label for="cb21-4">&nbsp;Skirt</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb21-5"><label for="cb21-5">&nbsp;Cabinet</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-6"><label for="cb21-6">&nbsp;Lamp</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-7"><label for="cb21-7">&nbsp;Cereal</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-8"><label for="cb21-8">&nbsp;Sausages</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb21-9"><label for="cb21-9">&nbsp;Summer</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-10"><label for="cb21-10">&nbsp;Winter</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-11"><label for="cb21-11">&nbsp;Lightning</label>
										</div>
										<div>
											<input type="checkbox" id="cb21-12"><label for="cb21-12">&nbsp;Prefer</label>
										</div>
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

<div id="ModalUnit4Act22" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act22">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write a shopping list with more objects and colors.</p>
											<input type="text" class="d-none" id="points22" name="points">
											<input type="text" class="d-none" id="idcliente22" name="idcliente">
											<input type="text" class="d-none" id="idlibro22" name="idlibro">
										</div>
									</div>
								</div>
								<header>
									<div class="grid ">
										<div class="color">
											<p>Pick a color:</p>
											<div class="colorPickerWrapper">
												<input type="color" id="colorPicker3" value="#55D0ED">
											</div>
										</div>
										<div class="stroke">
											<p>Change the stroke's width:</p>
											<div class="strokeWidthPickerWrapper">
												<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker3">
											</div>
										</div>
										<div class="clear">
											<p>clear the canvas:</p>
											<div class="clearBtnWrapper">
												<a href="#" id="clearBtn3">Clear canvas</a>
											</div>
										</div>
									</div>
									<br>
									<br>
									<div class="container">
										<canvas id="canvas4" width="500" height="500">
										</canvas>
									</div>
								</header>
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

<div id="ModalUnit4Act23" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act23">
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
                                        <p><b>I. How can you expand your vocabulary?</b></p>
                                        <select id="select-act23-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Using the same words we know.</option>
                                            <option value="2">Writing the new words we hear and reading new texts.</option>
                                            <option value="3">Reading the same text over and over.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a subject pronoun?</b></p>
                                        <select id="select-act23-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The status of belonging to a particular nation.</option>
                                            <option value="2">A word referring to the person or thing that performs an action.</option>
                                            <option value="3">A question that can be answered with yes or no.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the correct subject pronoun</b></p>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act23-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">I</option>
												<option value="2">She</option>
												<option value="3">It</option>
											</select>
											<label>works as a teacher on sundays.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act23-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">I</option>
												<option value="2">He</option>
												<option value="3">You</option>
											</select>
											<label> are my best friend.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act23-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">He</option>
												<option value="2">We</option>
												<option value="3">I</option>
											</select>
											<label> is doing his homework.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act23-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">It</option>
												<option value="2">He</option>
												<option value="3">They</option>
											</select>
											<label>are studying italian.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Complete the sentences using the plural of the noun in parenthesis</b></p>
										<div class="row mb-4">
											<div class="col-6 pe-3">
												<p class="text-justify" style="display: inline;">I like these </p>
													<input type="text" autocomplete="off" class="form-control" id="input-act23-1" placeholder="..." style="width:100px; display: inline-block;"> 
												<p class="text-justify" style="display: inline;">. (sock)</p>
											</div>
											<div class="col-6 pe-3">
												<p class="text-justify" style="display: inline;">I made two</p>
													<input type="text" autocomplete="off" class="form-control" id="input-act23-2" placeholder="..." style="width:100px; display: inline-block;"> 
												<p class="text-justify" style="display: inline;">. (cake)</p>
											</div>
										</div>
										<div class="row mb-4">
											<div class="col-6 pe-3">
												<p class="text-justify" style="display: inline;">My mother bought new</p>
													<input type="text" autocomplete="off" class="form-control" id="input-act23-3" placeholder="..." style="width:100px; display: inline-block;"> 
												<p class="text-justify" style="display: inline;">. (cloth)</p>
											</div>
											<div class="col-6 pe-3">
												<p class="text-justify" style="display: inline;">That supermarket sell </p>
													<input type="text" autocomplete="off" class="form-control" id="input-act23-4" placeholder="..." style="width:100px; display: inline-block;"> 
												<p class="text-justify" style="display: inline;">. (peach)</p>
											</div>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show appreciation for your classmates' remarks?</b></p>
                                        <select id="select-act23-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Being true and letting them know that we appreciate their remarks.</option>
                                            <option value="2">Ignoring their remarks.</option>
                                            <option value="3">Saying that their remark was not necessary.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. Can you explain why you have the right to be treated with courtesy and respect?</b></p>
                                        <select id="select-act23-8" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Because I am better than other people.</option>
                                            <option value="2">Because every person deserves to be treated that way.</option>
                                            <option value="3">Using pejorative language when talking to them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Could you produce a list of your clothing and accessories with other colors?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act23-5">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you paint in a creative way your clothing and accessories?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act23-6">
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

<div id="ModalUnit4Act24" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act24">
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
                                        <p><b>I. When do we use "How much" for questions?</b></p>
                                        <select id="select-act24-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">When we want to ask about actions that happened in the past.</option>
                                            <option value="2">To be polite with costumers.</option>
                                            <option value="3">For questions using a non-countable or singular object.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What determines the price of a good?</b></p>
                                        <select id="select-act24-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The status of belonging to a particular nation.</option>
                                            <option value="2">A word referring to the person or thing that performs an action.</option>
                                            <option value="3">The supply and demand model.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write the following money denominations</b></p>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">$10</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-1" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">1 cent</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-2" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">$5 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-3" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">10 cents </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-4" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">$100 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-5" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">5 cents</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-6" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">25 cents</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-7" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col d-flex align-items-center">
												<label class="me-2">$1</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-8" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
										<p><b>IV. Write the following number in English</b></p>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">700</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-9" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">500</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-10" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">800</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-11" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">1000 </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-12" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">600</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-13" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">200</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-14" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">400</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-15" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col d-flex align-items-center">
												<label class="me-2">900</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act24-16" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you show acceptance when receiving compliments?</b></p>
                                        <select id="select-act24-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Ignoring them.</option>
                                            <option value="2">Thanking them.</option>
                                            <option value="3">Acting like we don't believe.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How would you develop awareness of the value money?</b></p>
                                        <select id="select-act24-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Buying things I don't need.</option>
                                            <option value="2">Saving money and calculating our resources.</option>
                                            <option value="3">Using pejorative language when talking to other people.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Create a mental map about money denominations</b></p>
                                        <header>
											<div class="grid ">
												<div class="color">
													<p>Pick a color:</p>
													<div class="colorPickerWrapper">
														<input type="color" id="colorPicker4" value="#55D0ED">
													</div>
												</div>
												<div class="stroke">
													<p>Change the stroke's width:</p>
													<div class="strokeWidthPickerWrapper">
														<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker4">
													</div>
												</div>
												<div class="clear">
													<p>clear the canvas:</p>
													<div class="clearBtnWrapper">
														<a href="#" id="clearBtn4">Clear canvas</a>
													</div>
												</div>
											</div>
											<br>
											<br>
											<div class="container">
												<canvas id="canvas5" width="500" height="500">
												</canvas>
											</div>
										</header>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How would you work with your family to generate ideas on how to save money?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act24-17">
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

<div id="ModalUnit4Act25" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act25">
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
                                        <p><b>I. What is a demonstrative pronoun?</b></p>
                                        <select id="select-act25-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A word indicating a person or thing referred to or already known.</option>
                                            <option value="2">A word referring to the person or thing that performs an action.</option>
                                            <option value="3">A question that can be answered with yes or no.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a season?</b></p>
                                        <select id="select-act25-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">The status of belonging to a particular nation.</option>
                                            <option value="2">A word referring to the person or thing that performs an action.</option>
                                            <option value="3">A period of the year characterized by or associated with a particular phenomenon.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the correct demonstrative pronoun</b></p>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">That</option>
												<option value="2">Those</option>
											</select>
											<label>oranges are really cheap.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">That</option>
												<option value="2">Those</option>
											</select>
											<label> car is red.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">This</option>
												<option value="2">These</option>
											</select>
											<label> is Steve, he is our classmate.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-6" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">This</option>
												<option value="2">These</option>
											</select>
											<label>are my new socks.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
										<p><b>IV. Complete the sentences using the correct food you can find in a supermarket</b></p>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act25-7" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">Meat</option>
												<option value="2">Cheese</option>
												<option value="3">Apple</option>
											</select>
											<label>Is a dairy product.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>I like to drink </label>
											<select id="select-act25-8" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">bacon.</option>
												<option value="2">sausages.</option>
												<option value="3">pinneaple juice.</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>My favorite snack is </label>
											<select id="select-act25-9" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">grape juice.</option>
												<option value="2">butter.</option>
												<option value="3">popcorn.</option>
											</select>
										</div>
										<div class="d-flex align-items-center mb-3">
											<label>I don't like vegetables, specially </label>
											<select id="select-act25-10" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">spinach.</option>
												<option value="2">eggs.</option>
												<option value="3">grapes.</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you be aware of consumers' rights?</b></p>
                                        <select id="select-act25-11" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Knowing that is common perception that color influence your mood.</option>
                                            <option value="2">Knowing that the consumer has the right to put a complaint when something is wrong.</option>
                                            <option value="3">Reading new texts to learn new vocabulary.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How can you participate in a creative way in a conversation?</b></p>
                                        <select id="select-act25-12" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Finding my own style to participate.</option>
                                            <option value="2">Talking the same way everyone else does.</option>
                                            <option value="3">Listening to what my classmates have to say.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Create a mental map about the food in a supermarket?</b></p>
                                        <header>
											<div class="grid ">
												<div class="color">
													<p>Pick a color:</p>
													<div class="colorPickerWrapper">
														<input type="color" id="colorPicker5" value="#55D0ED">
													</div>
												</div>
												<div class="stroke">
													<p>Change the stroke's width:</p>
													<div class="strokeWidthPickerWrapper">
														<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker5">
													</div>
												</div>
												<div class="clear">
													<p>clear the canvas:</p>
													<div class="clearBtnWrapper">
														<a href="#" id="clearBtn5">Clear canvas</a>
													</div>
												</div>
											</div>
											<br>
											<br>
											<div class="container">
												<canvas id="canvas6" width="500" height="500">
												</canvas>
											</div>
										</header>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you explore all the items that you can find in a supermarket?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act25-1">
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

<!-- Audios -->

<div id="ModalUnit4Audio1" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio1">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track43.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio2" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio2">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track44.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio3" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio3">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track45.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio4" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio4">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track46.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio5" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio5">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track47.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio6" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio6">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track48.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio7" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio7">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track49.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio8" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio8">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track50.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio9" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio9">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track51.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio10" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio10">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track52.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio11" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio11">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track53.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio12" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio12">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track54.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio13" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio13">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track55.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio14" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio14">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track56.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio15" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio15">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track57.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio16" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio16">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track58.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio17" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio17">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track59.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio18" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio18">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track60.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<div id="ModalUnit4Audio19" class="modal fade" tabindex="-2">	
    <div class="modal-dialog modal-md">
		<div class="modal-content">
			<form class="form d-flex justify-content-center" autocomplete="off" method="post" novalidate id="unit4-audio19">			
				<audio controls style="margin-top: 10px; margin-bottom: 10px;">
					<source src="../../resources/audio/ingles_septimo/UnitFour/Track61.mp3" type="audio/mp3">
					Tu navegador no soporta audio HTML5.
				</audio> 								
			</form>
        </div>
    </div>
</div>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u4.js');
?>