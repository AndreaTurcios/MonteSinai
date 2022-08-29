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

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u4.js');
?>