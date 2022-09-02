<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 5');
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
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/1.jpg" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/14.JPG" width="76" height="100"
							class="page-14">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/13.JPG" width="76" height="100"
							class="page-15">
						<span>14-15</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/16.JPG" width="76" height="100"
							class="page-16">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/17.JPG" width="76" height="100"
							class="page-17">
						<span>16-17</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/18.JPG" width="76" height="100"
							class="page-18">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/19.JPG" width="76" height="100"
							class="page-19">
						<span>18-19</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/20.JPG" width="76" height="100"
							class="page-20">
						<img src="../../resources/img/BOOKS/SeventhGrade/UnitFive/21.JPG" width="76" height="100"
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadcincoseptimogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<div id="ModalUnit5Act1" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Rewrite the next dates following the example</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>
								</div>
                                <table class="table">
                                    <tr>
                                        <td>(03/31/06)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" disabled value="March 31, 2006" style="width:300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>(09/01/89)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" id="input-act1-1" placeholder="..." style="width:300px;"> </td>
                                    </tr>
                                    <tr>
                                        <td>(11/23/16)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" id="input-act1-2" placeholder="..." style="width:300px;"> </td>
                                    </tr>
                                    <tr>
                                        <td>(10/09/10)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" id="input-act1-3" placeholder="..." style="width:300px;"> </td>
                                    </tr>
                                    <tr>
                                        <td>(05/30/04)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" id="input-act1-4" placeholder="..." style="width:300px;"> </td>
                                    </tr>
                                    <tr>
                                        <td>(08/29/02)</td>
                                        <td><input type="text" autocomplete="off" class="form-control" id="input-act1-5" placeholder="..." style="width:300px;"> </td>
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

<div id="ModalUnit5Act2" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the days of the week</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
								</div>
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

<div id="ModalUnit5Act3" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write sentences using the months of the year</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
								</div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-1" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-2" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-3" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-4" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-5" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-6" placeholder="...">
                                    </div>
                                </div>
                                <div class="row row-cols-2">
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-7" placeholder="...">
                                    </div>
                                    <div class="col p-2">
                                        <input type="text" autocomplete="off" class="form-control" id="input-act3-8" placeholder="...">
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


<div id="ModalUnit5Act4" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write the ordinal numbers correctly</p>
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
								</div>
								<table class="table">
									<tr>
										<td>1st</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-1" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>2nd</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-2" placeholder="..."></td>
									</tr>
									<tr>
										<td>3rd</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-3" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>4th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-4" placeholder="..."></td>
									</tr>
									<tr>
										<td>5th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-5" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>6th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-6" placeholder="..."></td>
									</tr>
									<tr>
										<td>7th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-7" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>8th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-8" placeholder="..."></td>
									</tr>
									<tr>
										<td>9th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-9" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>10th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-10" placeholder="..."></td>
									</tr>
									<tr>
										<td>11th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-11" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>12th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-12" placeholder="..."></td>
									</tr>
									<tr>
										<td>13th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-13" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>14th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-14" placeholder="..."></td>
									</tr>
									<tr>
										<td>15th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-15" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>16th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-16" placeholder="..."></td>
									</tr>
									<tr>
										<td>17th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-17" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>18th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-18" placeholder="..."></td>
									</tr>
									<tr>
										<td>19th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-19" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>20th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-20" placeholder="..."></td>
									</tr>
									<tr>
										<td>21st</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-21" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>22nd</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-22" placeholder="..."></td>
									</tr>
									<tr>
										<td>23rd</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-23" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>24th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-24" placeholder="..."></td>
									</tr>
									<tr>
										<td>25th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-25" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>26th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-26" placeholder="..."></td>
									</tr>
									<tr>
										<td>27th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-27" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>28th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-28" placeholder="..."></td>
									</tr>
									<tr>
										<td>29th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-29" placeholder="..."></td>
                                        <td>&nbsp;</td>
										<td>30th</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-30" placeholder="..."></td>
									</tr>
									<tr>
										<td>31st</td>
										<td><input type="text" autocomplete="off" class="form-control" id="input-act4-31" placeholder="..."></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
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

<div id="ModalUnit5Act5" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act5">
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
                                        <p><b>I. What is an ordinal number?</b></p>
                                        <select id="select-act5-1" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">A word that expresses the location of an item in an ordered sequence.</option>
                                            <option value="2">A sentence used when referring to holidays or birthdays.</option>
                                            <option value="3">Any part of the twelve parts into which the calendar year is divided.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>II. What is a month of the year?</b></p>
                                        <select id="select-act5-2" class="ms-1 me-1 form-select" style="width: auto;">
											<option value="0" selected disabled></option>
                                            <option value="1">A word that expresses the location of an item in an ordered sequence.</option>
                                            <option value="2">A sentence used when referring to holidays or birthdays.</option>
                                            <option value="3">Any part of the twelve parts into which the calendar year is divided.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>III. Write the days of the week</b></p>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-1" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-2" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class=" row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-3" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-4" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-5" placeholder="..." max-length="30" style="width:300px;"> 
											</div>
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-6" placeholder="..." max-length="30" style="width:300px;"> 
											</div>										
										</div>
										<div class="row row-cols-2 mb-3">
											<div class="col d-flex align-items-center">
												<input type="text" autocomplete="off" class="form-control" id="input-act5-7" placeholder="..." max-length="30" style="width:300px;"> 
											</div>                                    
											<div class="col"></div>                                    
										</div>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>IV. Write the ordinal numbers</b></p>
										<table class="table">
                                            <tr>
                                                <td>3st</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-8" placeholder="..."></td>
                                                <td>&nbsp;</td>
                                                <td>12th</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-9" placeholder="..."></td>
                                            </tr>
                                            <tr>
                                                <td>15th</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-10" placeholder="..."></td>
                                                <td>&nbsp;</td>
                                                <td>22nd</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-11" placeholder="..."></td>
                                            </tr>
                                            <tr>
                                                <td>26th</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-12" placeholder="..."></td>
                                                <td>&nbsp;</td>
                                                <td>30th</td>
                                                <td><input type="text" autocomplete="off" class="form-control" id="input-act5-13" placeholder="..."></td>
                                            </tr>
                                        </table>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>V. How can we be polite when talking to classmates?</b></p>
                                        <select id="select-act5-3" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Learning how to use cardinal numbers correctly.</option>
                                            <option value="2">Using polite expressions and paying attention to them.</option>
                                            <option value="3">Buying things we don't need.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VI. Could you explain how to be polite with others?</b></p>
                                        <select id="select-act5-4" class="ms-1 me-1 form-select" style="width: auto;">
                                            <option value="0" selected disabled></option>
                                            <option value="1">Considering the value of money.</option>
                                            <option value="2">Talking over and ignoring them.</option>
                                            <option value="3">It is about becoming aware of others' feelings.</option>
                                        </select>
									</div>
								</div>
								<div class="row p-4">
									<div class="col">
                                        <p><b>VII. Create a mental map using the days and months of the years</b></p>
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
                                        <p><b>VIII. How can you explore the origins of the days and months of the year?
										</b></p>
                                        <input type="text" autocomplete="off" class="form-control" id="input-act5-14">
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

<div id="ModalUnit5Act6" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Write your family members' birthdays. Include your birthday too</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
								</div>
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

<div id="ModalUnit5Act7" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Listen and complete the sentences</p>
											<input type="text" class="d-none" id="points7" name="points">
											<input type="text" class="d-none" id="idcliente7" name="idcliente">
											<input type="text" class="d-none" id="idlibro7" name="idlibro">
										</div>
									</div>
								</div>
								<audio controls style="margin-top: 10px; margin-bottom: 10px;">
									<source src="../../resources/audio/ingles_septimo/UnitFive/TRACK67.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
								<br>
								<div class="row row-cols-2 mb-4">
									<div class="col d-flex align-items-center">
                                        <label>How old is Boris?</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>He's</label>
                                        <input type="text" autocomplete="off" class="form-control ms-1" id="input-act7-1" placeholder="...">
									</div>
								</div>
                                <hr>
								<div class="row row-cols-2 mb-4">
									<div class="col d-flex align-items-center">
                                        <input type="text" autocomplete="off" class="form-control ms-1" id="input-act7-2" placeholder="...">
                                        <label>?</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>On December 21, 1995</label>
									</div>
								</div>
                                <hr>
								<div class="row row-cols-2 mb-4">
									<div class="col d-flex align-items-center">
										<label>Where was he born?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <input type="text" autocomplete="off" class="form-control ms-1" id="input-act7-3" placeholder="...">
                                        <label>in Santa Ana</label>
									</div>
								</div>
                                <hr>
								<div class="row row-cols-2 mb-4">
									<div class="col d-flex align-items-center">
                                        <input type="text" autocomplete="off" class="form-control ms-1" id="input-act7-4" placeholder="...">
                                        <label>is Katherine?</label>
									</div>
									<div class="col d-flex align-items-center">
										<label>She's fourteen years old.</label>
									</div>
								</div>
                                <hr>
								<div class="row row-cols-2">
									<div class="col d-flex align-items-center">
										<label>When was she born?</label>
									</div>
									<div class="col d-flex align-items-center">
                                        <input type="text" autocomplete="off" class="form-control ms-1" id="input-act7-5" placeholder="...">
                                        <label>17, 1994.</label>
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

<div id="ModalUnit5Act8" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Select the correct holiday based on the description</p>
											<input type="text" class="d-none" id="points8" name="points">
											<input type="text" class="d-none" id="idcliente8" name="idcliente">
											<input type="text" class="d-none" id="idlibro8" name="idlibro">
										</div>
									</div>
								</div>
                                <table class="table">
                                    <tr>
                                        <td>On June 17th, some people give them gifts.</td>
                                        <td>
                                            <select id="select-act8-1" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Mother's day</option>
                                                <option value="2">Father's day</option>
                                                <option value="3">Independence day</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>On October 1st, parties and activities for them.</td>
                                        <td>
                                            <select id="select-act8-2" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Labor day</option>
                                                <option value="2">Easter</option>
                                                <option value="3">Children's day</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>On November 2nd, people visit cemetery to put flowers on the graves.</td>
                                        <td>
                                            <select id="select-act8-3" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">All souls' day</option>
                                                <option value="2">Valentine's day</option>
                                                <option value="3">Christmas</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>On September 15th, parades on the streets.</td>
                                        <td>
                                            <select id="select-act8-4" class="ms-1 me-1 form-select" style="width: auto;">
                                                <option value="0" selected disabled></option>
                                                <option value="1">Labor day</option>
                                                <option value="2">Valentine's day</option>
                                                <option value="3">Independence day</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>On February 14th, couples exchange gifts.</td>
                                        <td>
                                            <select id="select-act8-5" class="ms-1 me-1 form-select" style="width: auto;">
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

<div id="ModalUnit5Act9" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act9">
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

<div id="ModalUnit5Act10" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act10">
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
										<source src="../../resources/audio/ingles_septimo/UnitFive/TRACK70.mp3" type="audio/mp3">
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

<div id="ModalUnit5Act11" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act11">
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

<div id="ModalUnit5Act12" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act12">
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

<div id="ModalUnit5Act13" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act13">
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


<div id="ModalUnit5Act14" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act14">
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

<div id="ModalUnit5Act15" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act15">
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
												<input type="checkbox" id="cb15-1"><label for="cb15-1">&nbsp;Cheerleaders get ready to dance</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-5"><label for="cb15-5">&nbsp;People go to church processions</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-2"><label for="cb15-2">&nbsp;People prepare turkey for dinner</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-6"><label for="cb15-6">&nbsp;There are parades on the streets</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-3"><label for="cb15-3">&nbsp;Couple exchange gifts</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-7"><label for="cb15-7">&nbsp;Students give presents to their teachers</label>
											</div>
										</div>
									</div>
									<div class="row row-cols-2">
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-4"><label for="cb15-4">&nbsp;Students and bands get ready to march</label>
											</div>
										</div>
										<div class="col">
											<div>
												<input type="checkbox" id="cb15-8"><label for="cb15-8">&nbsp;People put flowers on graves</label>
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

<div id="ModalUnit5Act16" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act16">
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

<div id="ModalUnit5Act17" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act17">
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

<div id="ModalUnit5Act18" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act18">
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

<div id="ModalUnit5Act19" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act19">
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

<div id="ModalUnit5Act20" class="modal fade" tabindex="-4">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act20">
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

<div id="ModalUnit5Act21" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act21">
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
									<source src="../../resources/audio/ingles_septimo/UnitFive/TRACK60.mp3" type="audio/mp3">
									Tu navegador no soporta audio HTML5.
								</audio>
								<br>
								<div class="row row-cols-3">
									<div class="col">
										<div>
											<input type="checkbox" id="cb15-1"><label for="cb15-1">&nbsp;Blouse</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-2"><label for="cb15-2">&nbsp;Earrings</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-3"><label for="cb15-3">&nbsp;T-shirt</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-4"><label for="cb15-4">&nbsp;Skirt</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb15-5"><label for="cb15-5">&nbsp;Cabinet</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-6"><label for="cb15-6">&nbsp;Lamp</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-7"><label for="cb15-7">&nbsp;Cereal</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-8"><label for="cb15-8">&nbsp;Sausages</label>
										</div>
									</div>
									<div class="col">
										<div>
											<input type="checkbox" id="cb15-9"><label for="cb15-9">&nbsp;Summer</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-10"><label for="cb15-10">&nbsp;Winter</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-11"><label for="cb15-11">&nbsp;Lightning</label>
										</div>
										<div>
											<input type="checkbox" id="cb15-12"><label for="cb15-12">&nbsp;Prefer</label>
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

<div id="ModalUnit5Act22" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act22">
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

<div id="ModalUnit5Act23" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act23">
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
                                            <option value="2">Ignoring their remarkes.</option>
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

<div id="ModalUnit5Act24" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act24">
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

<div id="ModalUnit5Act25" class="modal fade" tabindex="-4">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Complete the Activity</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit5-act25">
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

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro7_u5.js');
?>