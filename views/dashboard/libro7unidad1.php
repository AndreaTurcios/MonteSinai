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
	<!-- <div class="container-fluid"> -->
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
	<!-- <div class="container-fluid"> -->
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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u1.js');
?>