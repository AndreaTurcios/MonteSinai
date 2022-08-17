<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 1');
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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitOne/21.JPG" width="76" height="100"
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunoseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

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
											<p class="fs-5 fw-bold">Complete the introductions and answers</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <label for="select-act1-1">How</label>
                                        <select id="select-act1-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">do you do?</option>
                                            <option value="2">is your name?</option>
                                            <option value="3">is you?</option>
                                        </select>
                                        <label> I'm George.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <label for="select-act1-2">Nice </label>
                                        <select id="select-act1-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">to you.</option>
                                            <option value="2">to meet you.</option>
                                            <option value="3">do you do?</option>
                                        </select>
                                        <label> I'm Jessica.</label>
									</div>
								</div>
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <label for="select-act1-3">How</label>
                                        <select id="select-act1-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">is you?</option>
                                            <option value="2">are you?</option>
                                            <option value="3">am you?</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act1-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I'm fine</option>
                                            <option value="2">Thanks</option>
                                            <option value="3">How are you?</option>
                                        </select>
                                        <label>, thanks.</label>
									</div>
								</div>
								<div class="row row-cols-2 mb-3 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act1-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Why are you</option>
                                            <option value="2">How is you</option>
                                            <option value="3">How are you</option>
                                        </select>
                                        <label> doing?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <label for="select-act1-6">Not bad, </label>
                                        <select id="select-act1-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">do you do?</option>
                                            <option value="2">to meet you.</option>
                                            <option value="3">thank you.</option>
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

<div id="ModalUnit1Act2" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct use of the verb "to be"</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
								<div class="row row-cols-2  p-3">
									<div class="col d-flex align-items-center">
                                        <label for="select-act2-1">I </label>
                                        <select id="select-act2-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label> George.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <label for="select-act2-2">They </label>
                                        <select id="select-act2-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label> my friends.</label>
									</div>
								</div>
								<div class="row row-cols-2 p-3">
									<div class="col d-flex align-items-center">
                                        <label for="select-act2-3">You </label>
                                        <select id="select-act2-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label>Mr. Rivera.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <label for="select-act2-4">She </label>
                                        <select id="select-act2-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label> your sister.</label>
									</div>
								</div>
								<div class="row row-cols-2 mb-3 p-3">
									<div class="col d-flex align-items-center">
                                    <label for="select-act2-5">He </label>
                                        <select id="select-act2-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label> my father.</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <label for="select-act2-6">It </label>
                                        <select id="select-act2-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">am</option>
                                            <option value="2">is</option>
                                            <option value="3">are</option>
                                        </select>
                                        <label> a robot.</label>
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

<div id="ModalUnit1Act3" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct introductions and answers</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
								
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Hi, nice to meet you. I'm Mario.</option>
                                            <option value="2">This is my new car.</option>
                                            <option value="3">Thank you.</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-2" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Thanks.</option>
                                            <option value="2">Nice to meet you too. I'm Jessica.</option>
                                            <option value="3">Yes, I am.</option>
                                        </select>
									</div>
								</div>
								<div class="row row-cols-2 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Not bad, thanks.</option>
                                            <option value="2">Nice to meet you too.</option>
                                            <option value="3">This is my friend, Melvin.</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">I'm fine</option>
                                            <option value="2">Hi, Melvin, I am Steve.</option>
                                            <option value="3">My house is white.</option>
                                        </select>
									</div>
								</div>
								<div class="row row-cols-2 mb-3 border p-3">
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-5" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">How are you, Vanessa?</option>
                                            <option value="2">Thanks, you too.</option>
                                            <option value="3">It is a robot.</option>
                                        </select>
									</div>
									<div class="col d-flex align-items-center">
                                        <select id="select-act3-6" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">You are my parents.</option>
                                            <option value="2">Thank you.</option>
                                            <option value="3">Not bad, thanks</option>
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

<div id="ModalUnit1Act7" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit1-act7">
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
									<input type="text" autocomplete="off" class="form-control" id="input-act7-1" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-2" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-3" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-4" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-5" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-6" placeholder="...">
								</div>
								<div class="row p-2">
									<input type="text" autocomplete="off" class="form-control" id="input-act7-7" placeholder="...">
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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u1.js');
?>