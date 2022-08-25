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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitThree/21.JPG" width="76" height="100"
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

			pages: 26,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadtresseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit3Act1" class="modal fade" tabindex="-4">
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
											<p class="fs-5 fw-bold">Complete the conversations</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<label>Hi.</label>
									<input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="..." style="width:300px;"> 
                                    <label>Boris.</label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<label>Hello, I am Maricela. </label>
								</div>
                                <div class="d-flex align-items-center mb-1">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="..." style="width:300px;"> 
                                    <label>, Maricela.</label>
								</div>
                                <div class="d-flex align-items-center mb-5">
									<label>Nice to meet you, too. </label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<label>Excuse me, </label>
									<input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="..." style="width:300px;"> 
                                    <label>Douglas?</label>
								</div>
								<div class="d-flex align-items-center mb-5">
									<label>No, I'm not. I'm Frank. </label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="..." style="width:300px;"> 
                                    <label>, are you Maritza?</label>
								</div>
								<div class="d-flex align-items-center mb-4">
									<label>Yes, I am. </label>
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

<div id="ModalUnit3Act2" class="modal fade" tabindex="-4">
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
											<p class="fs-5 fw-bold">Write the next numbers</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">96.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-1" placeholder="..." max-length="30" style="width:300px;"> 
								    </div>
									<div class="col d-flex align-items-center">
                                    	<label class="me-2">105.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-2" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								</div>
								<div class=" row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">112. </label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-3" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								    <div class="col d-flex align-items-center">
										<label class="me-2">123. </label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-4" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">156.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-5" placeholder="..." max-length="30" style="width:300px;"> 
									</div>
								    <div class="col d-flex align-items-center">
										<label class="me-2">173.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-6" placeholder="..." max-length="30" style="width:300px;"> 
									</div>										
								</div>
								<div class="row row-cols-2 mb-3">
									<div class="col d-flex align-items-center">
										<label class="me-2">200.</label>
										<input type="text" autocomplete="off" class="form-control" id="input-act2-7" placeholder="..." max-length="30" style="width:300px;"> 
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

<div id="ModalUnit3Act3" class="modal fade" tabindex="-4">
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
											<p class="fs-5 fw-bold">Select the appropiate answer</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<label>He is very</label>
									<select id="select-act3-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">quiet</option>
                                        <option value="2">Mexican</option>
                                        <option value="3">lawyer</option>
                                    </select>
									<label>. He doesn't talk to much</label>
								</div>
								<div class="d-flex align-items-center mb-3">
                                    <label>Kath is</label>
									<select id="select-act3-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">American</option>
                                        <option value="2">angry</option>
                                        <option value="3">short</option>
                                    </select>
									<label>. She can't reach the cabinet.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
                                    <label>She is my math</label>
									<select id="select-act3-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">outgoing</option>
                                        <option value="2">teacher</option>
                                        <option value="3">doctor</option>
                                    </select>
									<label>.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
                                    <label>Robert is my</label>
									<select id="select-act3-4" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">brother</option>
                                        <option value="2">cousin</option>
                                        <option value="3">plumber</option>
                                    </select>
									<label>. He is my uncle's son.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
                                    <label>She is </label>
									<select id="select-act3-5" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">American</option>
                                        <option value="2">Guatemalan</option>
                                        <option value="3">Costa Rican</option>
                                    </select>
									<label> because she is from the United States.</label>
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
											<p class="fs-5 fw-bold">Select the correct useful expressions</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act4-1" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">What's he like?</option>
                                        <option value="2">How old are you?</option>
                                        <option value="3">What's she like?</option>
                                    </select>
									<label> He is polite.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act4-2" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How old are you?</option>
                                        <option value="2">What's your nationality?</option>
                                        <option value="3">Tell me about yourself.</option>
                                    </select>
									<label> I am thin.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act4-3" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">What's he like?</option>
                                        <option value="2">What's she like?</option>
                                        <option value="3">What are you like?</option>
                                    </select>
									<label>She is very polite.</label>
								</div>
								<div class="d-flex align-items-center mb-3">
									<select id="select-act4-4" class="ms-1 me-1 form-select" style="width: auto;">
                                        <option value="0" selected disabled></option>
                                        <option value="1">How many people are there in your family?</option>
                                        <option value="2">What's your nationality.</option>
                                        <option value="3">How old are you?</option>
                                    </select>
									<label> We are five.</label>
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
											<p class="fs-5 fw-bold">Complete the dialogues</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
								</div>
								<div class="d-flex align-items-center mb-1">
									<label class="me-1">Excuse me,</label>
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act5-1" placeholder="..." max-length="50" style="width:150px;">
									<label>Melvin?</label>
								</div>
								<div class="row mb-4">
									<label> No, I'm Oscar.</label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act5-2" placeholder="..." max-length="50" style="width:150px;">
									<label> Honduran?</label>
								</div>
								<div class="row mb-4">
									<label> No, I'm Salvadoran.</label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act5-3" placeholder="..." max-length="50" style="width:150px;">
									<label class="me-1">father</label>
									<input type="text" autocomplete="off" class="form-control" id="input-act5-4" placeholder="..." max-length="50" style="width:150px;">
								</div>
								<div class="row mb-4">
									<label> Yes, he's a lawyer.</label>
								</div>
								<div class="d-flex align-items-center mb-1">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act5-5" placeholder="..." max-length="50" style="width:150px;">
									<label> your grandmother?</label>
								</div>
								<div class="row mb-4">
									<label> She is ninety-two years old.</label>
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
											<p class="fs-5 fw-bold">Complete these activities and measure your achievements</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>I. How can useful expressions help?</b></p>
                                        <select id="select-act6-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Building new sentences, including lists of items, to write letter, understand what we read.</option>
                                            <option value="2">Finding out other's nationalities, people's age, or any other description.</option>
                                            <option value="3">Identifying something or someone within a series, like telephone numbers.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. How can the English vocabulary help?</b></p>
                                        <select id="select-act6-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Building new sentences, including lists of items, to write letter, understand what we read.</option>
                                            <option value="2">Finding out other's nationalities, people's age, or any other description.</option>
                                            <option value="3">Identifying something or someone within a series, like telephone numbers.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Select the appropiate useful expressions</b></p>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act6-3" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">What's he like?</option>
												<option value="2">How old are you?</option>
												<option value="3">What's she like?</option>
											</select>
											<label> I'm thirteen years old.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act6-4" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">How old are you?</option>
												<option value="2">What's your nationality?</option>
												<option value="3">Tell me about yourself.</option>
											</select>
											<label> I am Costa Rican.</label>
										</div>
										<div class="d-flex align-items-center mb-3">
											<select id="select-act6-5" class="ms-1 me-1 form-select" style="width: auto;">
												<option value="0" selected disabled></option>
												<option value="1">What's he like?</option>
												<option value="2">What's she like?</option>
												<option value="3">What are you like?</option>
											</select>
											<label>He is very outgoing.</label>
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the following numbers in English</b></p>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">91.</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-1" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">101.</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-2" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">100. </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-3" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">160. </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-4" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">200. </label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-5" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<label class="me-2">98.</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-6" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<label class="me-2">150.</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-7" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col d-flex align-items-center">
												<label class="me-2">95.</label>
												<input type="text" autocomplete="off" class="form-control" id="input-act6-8" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can you prevent the use of pejorative language to describe family members?</b></p>
                                        <select id="select-act6-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Finding out other's nationalities.</option>
                                            <option value="2">Saying bad things about them.</option>
                                            <option value="3">Avoiding critizicing them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. How could you demonstrate empathy to others?</b></p>
                                        <select id="select-act6-7" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Helping them and understanding their point of view.</option>
                                            <option value="2">Avoiding critizicing them.</option>
                                            <option value="3">Using pejorative language when talking to them.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. How could you use the art of asking using useful expressions?</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-9">
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VIII. How can you apply justice and empathy to others?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act6-10">
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
											<p class="fs-5 fw-bold">Write sentences using your family ties</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
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

									#canvas2 {
									background-color: #F8F8F8;
									}

									.color, .stroke, .clear {
									justify-self: center;
									}

									#clearBtn {
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

								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-1" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-2" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-3" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-4" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-5" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act7-6" placeholder="...">
								</div>
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

<div id="ModalUnit3Act8" class="modal fade" tabindex="-4">
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
											<p class="fs-5 fw-bold">Write sentences using your family ties</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>

								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-1" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-2" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-3" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-4" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-5" placeholder="...">
								</div>
								<div class="d-flex align-items-center mb-3">
									<input type="text" autocomplete="off" class="form-control me-1" id="input-act8-6" placeholder="...">
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

<div id="ModalUnit3Act9" class="modal fade" tabindex="-4">
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
											<p class="fs-5 fw-bold">Select the correct use of the genetive case 's</p>
											<input type="text" class="d-none" id="points9" name="points">
											<input type="text" class="d-none" id="idcliente9" name="idcliente">
											<input type="text" class="d-none" id="idlibro9" name="idlibro">
										</div>
									</div>
								</div>
								<div>
									<input type="checkbox" id="cb9-1"><label for="cb9-1">&nbsp;This is my sister's backpack.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-2"><label for="cb9-2">&nbsp;He's really tall.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-3"><label for="cb9-3">&nbsp;She's teaching english to me.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-4"><label for="cb9-4">&nbsp;My father's dog is small.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-5"><label for="cb9-5">&nbsp;It's raining today.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-6"><label for="cb9-6">&nbsp;My cat's collar is blue.</label>
								</div>
								<div>
									<input type="checkbox" id="cb9-7"><label for="cb9-7">&nbsp;Melvin's shoes are green.</label>
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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u3.js');
?>