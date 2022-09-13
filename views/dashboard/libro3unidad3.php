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
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/1.JPG" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitThree/14.JPG" width="76" height="100"
							class="page-14">
						<span>14</span>
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

			pages: 44,

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadtrestercergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Página 65, actividad 1.1 -->
<div id="ModalUnit3Act1_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN CLOCK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_1" name="points">
											<input type="text" class="d-none" id="idcliente1_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act1_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act1_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act1_1-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
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

<!-- Página 65, actividad 1.2 -->
<div id="ModalUnit3Act1_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN THE CLOCK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the hour with the clock</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points1_2" name="points">
											<input type="text" class="d-none" id="idcliente1_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro1_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act1-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-1.png" alt="Six" id="img-act1-1">
											</div>
											<div class="col ps-5">
												<div id="Six" class="box-act1 text-center m-3" >
													<p>6:30</p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-2.png"  alt="Nine" id="img-act1-2">
											</div>
											<div class="col ps-5">
												<div id="Eleven" class="box-act1 text-center m-3" >
													<p>11:45</p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-3.png"  alt="Ten" id="img-act1-3">
											</div>
											<div class="col ps-5">
												<div id="Three" class="box-act1 text-center m-3" >
													<p>3:50</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-4.png"  alt="Eleven" id="img-act1-4">
											</div>
											<div class="col ps-5">
												<div id="Nine" class="box-act1 text-center m-3" >
													<p>9:55</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act1-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag65/img65_2-5.png"  alt="Three" id="img-act1-5">
											</div>
											<div class="col ps-5">
												<div id="Ten" class="box-act1 text-center m-3" >
													<p>10:15</p>
												</div>
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

<!-- Página 66 -->
<div id="ModalUnit3Act2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MEALS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-two">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the activity with the clock</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act2-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-1.png" alt="Seven" id="img-act2-1">
											</div>
											<div class="col ps-5">
												<div id="Twelve" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img661.png">
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-2.png"  alt="Six" id="img-act2-2">
											</div>
											<div class="col ps-5">
												<div id="Nine" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img662.png">
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-3.png"  alt="Eleven" id="img-act2-3">
											</div>
											<div class="col ps-5">
												<div id="Eleven" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img663.png">
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-4.png"  alt="Nine" id="img-act2-4">
											</div>
											<div class="col ps-5">
												<div id="Six" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img664.png">
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act2-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img66-5.png"  alt="Twelve" id="img-act2-5">
											</div>
											<div class="col ps-5">
												<div id="Seven" class="box-act2 text-center m-3" >
													<img src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag66/img665.png">
												</div>
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

<!-- Página 67, actividad 3.1 -->
<div id="ModalUnit3Act3_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">THE TIME IN CLOCK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3_1" name="points">
											<input type="text" class="d-none" id="idcliente3_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-12 col-sm-12">
												
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-1.png">
												</div>

												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>
											</div>												
																					 
										</div>											
										
                                        <div class="col-md-12 col-sm-12">
													                                        
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-2.png">
												</div>
												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>
											</div>
                                           
                                                                                        
                                        </div>	

									    <div class="col-md-12 col-sm-12">
													
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_1-3.png">
												</div>

												<div class="col-8 justify-content-center">
													<input type="text" id="input-act3_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act3_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>
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

<!-- Página 67, actividad 3.2 -->
<div id="ModalUnit3Act3_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">THE TIME IN CLOCK</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points3_2" name="points">
											<input type="text" class="d-none" id="idcliente3_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro3_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag67/img67_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">What</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">do you have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>													
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">I have breakfast at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act3_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">time do you</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
                                                    <div class="col-1">
														<p class="fst-normal">lunch?</p> 
													</div>																							
												</div>

                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
                                                    <div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
                                                    <div class="col-2">
														<input type="text" id="input-act3_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																								
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">What time</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									
                                                    <div class="col-1">
														<p class="fst-normal">have dinner?</p> 
													</div>
												</div>	
                                                
                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I have</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act3_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
                                                    <div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
                                                    <div class="col-2">
														<input type="text" id="input-act3_2-10" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									                                                   
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
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Página 68 -->
<div id="ModalUnit3Act4" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO WAKE, TO GET</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points4" name="points">
											<input type="text" class="d-none" id="idcliente4" name="idcliente">
											<input type="text" class="d-none" id="idlibro4" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to wake"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact49-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to get"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act4-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 69 -->
<div id="ModalUnit3Act5" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO HAVE, TO GO</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-five">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to have"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact59-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to go"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act5-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 70 -->
<div id="ModalUnit3Act6" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO LIKE, TO DO</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to like"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-actact69-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-12" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-24" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
											</div>								

										</div>	
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to do"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-36" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>
												
												<div class="col-12">
													<h4 style="text-align: center; margin-top: 25px;">PAST</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act6-48" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

												</table>																																	
										
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

<!-- Página 71, actividad 19.1 -->
<div id="ModalUnit3Act7_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING VOCABULARY RELATED TO THE TIME</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seven_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_1" name="points">
											<input type="text" class="d-none" id="idcliente7_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-1.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-2.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
											</div>
																																										 
										</div>		

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">
												<div class="col-12">
													<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag71/img71_1-3.png">
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the question"
															autocomplete="off">
													<input type="text" id="input-act7_1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Rewrite the answer"
															autocomplete="off">
												</div>	
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

<!-- Página 71, actividad 19.2 -->
<div id="ModalUnit3Act7_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">EXPRESSING VOCABULARY RELATED TO THE TIME</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-seven_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Answer the questions</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_2" name="points">
											<input type="text" class="d-none" id="idcliente7_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										

										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">	
												<div class="col-12">
													<p>What time do you go to bed?</p>
												</div>										
												<div class="col-8">
													<input type="text" id="input-act7_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Answer the question"
															autocomplete="off">													
												</div>	
											</div>																					
																					 
										</div>											
										
										<div class="col-md-12 col-sm-6">
															
											<div class="row justify-content-center">											
												<div class="col-12">
													<p>What time do you have breakfast?</p>
												</div>
												<div class="col-8">
													<input type="text" id="input-act7_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 25px; margin-top: 25px;"
															placeholder="Answer the question"
															autocomplete="off">											
												</div>	
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

<!-- Página 72, actividad 20.1 -->
<div id="ModalUnit3Act8_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTENCES USING THE VERBS: WAKE UP, GET UP, DO, GO</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eight_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points8_1" name="points">
											<input type="text" class="d-none" id="idcliente8_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act8_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	
									
										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-5.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-5" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_1-6.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act8_1-6" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
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
<!-- Página 67, actividad 3.2 -->
<div id="ModalUnit3Act8_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES USING THE VERBS: WAKE UP, GET UP, DO, GO</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eight_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points8_2" name="points">
											<input type="text" class="d-none" id="idcliente8_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitThree/Pag72/img72_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">at five</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																							
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">My father</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">ten</p> 
													</div>																							                                                   
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">to get up late on</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		                                                   																							
												</div>

												<hr>

                                               	<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">my homework at</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		                                                   																							
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">You</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">to school at 7 a.m.</p> 
													</div>												                                                   																							
												</div>
												
												<hr>
                                                
                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">He</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-10" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	                                                  
													<div class="col-3">
														<p class="fst-normal">his homework on time</p> 
													</div>																								                                                   
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
				</div>
			</form>
		</div>
	</div>
</div>
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro3_u3.js');
?>