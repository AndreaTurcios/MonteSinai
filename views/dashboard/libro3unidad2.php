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
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/1.JPG" width="76" height="100"
							class="page-1">
						<span>1</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/2.JPG" width="76" height="100"
							class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/3.JPG" width="76" height="100"
							class="page-3">
						<span>2-3</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/4.JPG" width="76" height="100"
							class="page-4">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/5.JPG" width="76" height="100"
							class="page-5">
						<span>4-5</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/6.JPG" width="76" height="100"
							class="page-6">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/7.JPG" width="76" height="100"
							class="page-7">
						<span>6-7</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/8.JPG" width="76" height="100"
							class="page-8">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/9.JPG" width="76" height="100"
							class="page-9">
						<span>8-9</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/10.JPG" width="76" height="100"
							class="page-10">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/11.JPG" width="76" height="100"
							class="page-11">
						<span>10-11</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/12.JPG" width="76" height="100"
							class="page-12">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/13.JPG" width="76" height="100"
							class="page-13">
						<span>12-13</span>
					</li>
					<li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/14.JPG" width="76" height="100"
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidaddostercergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Página 35 -->
<div id="ModalUnit2Act1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WHEN IS YOUR BIRTHDAY?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-one">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag35/img35-1.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">When is </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>													
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">It's on </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									
                                                    <div class="col-1">
														<p class="fst-normal">?</p> 
													</div>
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">How old are you, </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
                                                    <div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																							
												</div>

                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I'm </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
                                                    <div class="col-2">
														<p class="fst-normal">years old</p> 
													</div>	
                                                    <div class="col-2">
														<input type="text" id="input-act1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																								
												</div>

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<p class="fst-normal">Will you have </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-6" class="form-control"
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
														<p class="fst-normal">Yes, it will be </p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act1-7" class="form-control"
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

<!-- Página 36 -->
<div id="ModalUnit2Act2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NUMBERS</h5>
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
											<p class="fs-1 fw-bold">Write the numbers as indicated</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">										
										
                                        <div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag36/img36-1.png">
										</div>

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="One"
														autocomplete="off">
											</div>
																					 
										</div>											
										
										<div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Two"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Three"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																													
											<div class="col justify-content-center">
												<input type="text" id="input-act2-4" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Four"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Five"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-6" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Six"
														autocomplete="off">
											</div>
																					 
										</div>	

										<div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-7" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Seven"
														autocomplete="off">
											</div>
																					 
										</div>		

									    <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-8" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Eight"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-9" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Nine"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-10" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Ten"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-11" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Eleven"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-12" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Twelve"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-13" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Thirteen"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-14" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Fourteen"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-4 col-sm-6">
																																														
											<div class="col justify-content-center">
												<input type="text" id="input-act2-15" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Fifteen"
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

<!-- Página 37 -->
<div id="ModalUnit2Act3" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONJUGATION OF THE VERBS: TO MAKE, TO GIVE</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row mb-4">
										<div class="col align-items-center">
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">										
																			
										
										<div class="col-md-12 col-sm-12 col-xs-12">

											<p class="fs-5 fw-bold">Conjugate the verb "to make"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-1" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-2" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-3" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-4" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-5" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-6" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-7" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-8" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-9" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-10" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-11" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-12" class="form-control"
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
																<input type="text" id="input-act3-13" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-14" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-15" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-16" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-17" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-18" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-19" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-20" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-21" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-22" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-23" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-24" class="form-control"
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

											<p class="fs-5 fw-bold" style="margin-top: 35px;">Conjugate the verb "to give"</p>

											<div class="row justify-content-md-center justify-content-sm-center">									

												<div class="col-12">
													<h4 style="text-align: center; margin-top: 15px;">PRESENT</h4>
												</div>

												<table style="border: 2px solid #F8F496; background-color: #E3F1EC;">													
													
													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-25" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-26" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-27" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-28" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-29" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-30" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-31" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-32" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-33" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-34" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-35" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-36" class="form-control"
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
																<input type="text" id="input-act3-37" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-38" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-39" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-40" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-41" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-42" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-43" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-44" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-45" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-46" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>													
													</tr>

													<tr>
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-47" class="form-control"
																	aria-label="Sizing example input" maxlength="100"									
																	style="margin-bottom: 15px; margin-top: 15px;"
																	autocomplete="off">
															</div>
														</td>	
														<td align="center" style="border: 2px solid #F8F496">
															<div class="col-6">
																<input type="text" id="input-act3-48" class="form-control"
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

<!-- Página 38, actividad 4.1 -->
<div id="ModalUnit2Act4_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">FREQUENCY ADVERBS: ALWAYS, NEVER, OFTEN, SELDOM, USUALLY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four_1">
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
											<input type="text" class="d-none" id="points4_1" name="points">
											<input type="text" class="d-none" id="idcliente4_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro4_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act4_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act4_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act4_1-6" class="form-control"
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

<!-- Página 38, actividad 4.2 -->
<div id="ModalUnit2Act4_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">FREQUENCY ADVERBS: ALWAYS, NEVER, OFTEN, SELDOM, USUALLY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-four_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Complete the dialogue.</p>
											<input type="text" class="d-none" id="points4_2" name="points">
											<input type="text" class="d-none" id="idcliente4_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro4_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag38/img38_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act4_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">go to</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act4_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">early</p> 
													</div>											
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">He</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act4_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">plays</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act4_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																										
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act4_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">usually</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act4_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>															
													<div class="col-2">
														<p class="fst-normal">to the river at noon</p> 
													</div>											
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act4_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">come</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act4_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																										
												</div>
                                                
												<hr>

                                                <div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">She gets</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act4_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">grades very</p> 
													</div>		
													<div class="col-2">
														<input type="text" id="input-act4_2-10" class="form-control"
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

<!-- Página 39 -->
<div id="ModalUnit2Act5" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HAPPY BIRTHDAY TO YOU</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-five">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words.</p>
											<input type="text" class="d-none" id="points5" name="points">
											<input type="text" class="d-none" id="idcliente5" name="idcliente">
											<input type="text" class="d-none" id="idlibro5" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag39/img39.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Happy birthday</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									
												</div>																								

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Happy</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																									
                                                    <div class="col-1">
														<p class="fst-normal">to</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act5-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act5-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">birthday dear</p> 
													</div>																																					
                                                    <div class="col-2">
														<input type="text" id="input-act5n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													
													<div class="col-2">
														<input type="text" id="input-act5-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">to you!</p> 
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

<!-- Página 40 -->
<div id="ModalUnit2Act6" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WRITING AND SAYING SIMPLE SENTENCES</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-six">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words.</p>
											<input type="text" class="d-none" id="points6" name="points">
											<input type="text" class="d-none" id="idcliente6" name="idcliente">
											<input type="text" class="d-none" id="idlibro6" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag40/img40.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">They</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">to</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">soccer</p> 
													</div>																						
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Our</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">the grades</p> 
													</div>																																		
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act6-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<p class="fst-normal">her homework</p> 
													</div>																																														
												</div>

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">you to</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																			
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I will</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">to my</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																			
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">I am</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">to</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act6-10" class="form-control"
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

<!-- Página 41, actividad 7.1 -->
<div id="ModalUnit2Act7_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NOUNS</h5>
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
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_1" name="points">
											<input type="text" class="d-none" id="idcliente7_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_1" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act7-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_1-1.png" alt="Chair" id="img-act7-1">
											</div>
											<div class="col ps-5">
												<div id="Table" class="box-act7 text-center m-3" >
													<p>Table</p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act7-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_1-2.png"  alt="Book" id="img-act7-2">
											</div>
											<div class="col ps-5">
												<div id="Book" class="box-act7 text-center m-3" >
													<p>Book</p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act7-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_1-3.png"  alt="Table" id="img-act7-3">
											</div>
											<div class="col ps-5">
												<div id="Chair" class="box-act7 text-center m-3" >
													<p>Chair</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act7-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_1-4.png"  alt="Friend" id="img-act7-4">
											</div>
											<div class="col ps-5">
												<div id="Friend" class="box-act7 text-center m-3" >
													<p>Friend</p>
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

<!-- Página 41, actividad 7.2 -->
<div id="ModalUnit2Act7_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">NOUNS</h5>
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
											<p class="fs-1 fw-bold">Rewrite the sentences</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7_2" name="points">
											<input type="text" class="d-none" id="idcliente7_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro7_2" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act7_2-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act7_2-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag41/img41_2-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act7_2-6" class="form-control"
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

<!-- Página 42, actividad 8.1 -->
<div id="ModalUnit2Act8_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ADJECTIVES: PRETTY, NEW, HAPPY, NICE</h5>
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
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-1.png">
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
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-2.png">
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
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-3.png">
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
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-4.png">
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
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-5.png">
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
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_1-6.png">
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

<!-- Página 42, actividad 8.2 -->
<div id="ModalUnit2Act8_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">ADJECTIVES: PRETTY, NEW, HAPPY, NICE</h5>
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
											<p class="fs-1 fw-bold">Write the missing words.</p>
											<input type="text" class="d-none" id="points8_2" name="points">
											<input type="text" class="d-none" id="idcliente8_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro8_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag42/img42_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<input type="text" id="input-act8_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">mother is a</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">woman</p> 
													</div>																																	
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">It</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">a</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">balloon</p> 
													</div>																																	
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Your</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">a beautiful</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																										
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">wears a</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-8" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">dress</p> 
													</div>																																								
												</div>		

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Your</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-9" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">is a</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act8_2-10" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">man</p> 
													</div>																																								
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">She</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-11" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
													<div class="col-1">
														<p class="fst-normal">in a</p> 
													</div>
													<div class="col-1">
														<input type="text" id="input-act8_2-12" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">dish</p> 
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

<!-- Página 43, actividad 9.1 -->
<div id="ModalUnit2Act9_1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HOW OLD ARE YOU?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nine_1">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the dialogue.</p>
											<input type="text" class="d-none" id="points9_1" name="points">
											<input type="text" class="d-none" id="idcliente9_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro9_1" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag43/img43_1.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Teacher:</p> 
													</div>
													<div class="col-11">
														<input type="text" id="input-act9_1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																													
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Teacher:</p> 
													</div>
													<div class="col-11">
														<input type="text" id="input-act9_1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																													
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Melisa:</p> 
													</div>
													<div class="col-11">
														<input type="text" id="input-act9_1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																													
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">Ricardo:</p> 
													</div>
													<div class="col-8">
														<input type="text" id="input-act9_1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_1-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
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

<!-- Página 43, actividad 9.2 -->
<div id="ModalUnit2Act9_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">HOW OLD ARE YOU?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-nine_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the missing words.</p>
											<input type="text" class="d-none" id="points9_2" name="points">
											<input type="text" class="d-none" id="idcliente9_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro9_2" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag43/img43_2.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act9_2-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">: I am</p> 
													</div>	
													<div class="col-2">
														<select class="form-select form-select-md" id="input-act9_2-1y" name="input-act9_2-1y">

															<option disabled selected>Select an option</option>
															<option value="Five">Five</option>
															<option value="Six">Six</option>
															<option value="Seven">Seven</option>

														</select>
													</div>	
													<div class="col-1">
														<p class="fst-normal">years</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																																								
												</div>	
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<p class="fst-normal">How old are</p> 
													</div>		
													<div class="col-1">
														<input type="text" id="input-act9_2-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">,</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																																											
												</div>	

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act9_2-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">:</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">am</p> 
													</div>	
													<div class="col-2">
														<select class="form-select form-select-md" id="input-act9_2-2y" name="input-act9_2-2y">

															<option disabled selected>Select an option</option>
															<option value="Five">Five</option>
															<option value="Six">Six</option>
															<option value="Seven">Seven</option>

														</select>
													</div>	
													<div class="col-1">
														<p class="fst-normal">years</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-1">
														<p class="fst-normal">How</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">are,</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act9_2-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>														
													<div class="col-2">
														<input type="text" id="input-act9_2-Extra" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
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

<!-- Página 44 -->
<div id="ModalUnit2Act10" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">WE ARE VERY HAPPY TODAY</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-ten">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the dialogue.</p>
											<input type="text" class="d-none" id="points10" name="points">
											<input type="text" class="d-none" id="idcliente10" name="idcliente">
											<input type="text" class="d-none" id="idlibro10" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag44/img44_1.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act10-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<input type="text" id="input-act10-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">, I'm</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act10-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>																																											
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act10-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">Why,</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act10-4n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">?</p> 
													</div>																																												
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act10-5n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">Today is my</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act10-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">and my</p> 
													</div>		
													<div class="col-8">
														<input type="text" id="input-act10-3" class="form-control"
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

<!-- Página 45, actividad 11.1 -->
<div id="ModalUnit2Act11_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CLASSROOM EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_1">
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
											<input type="text" class="d-none" id="points11_1" name="points">
											<input type="text" class="d-none" id="idcliente11_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act11_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act11_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act11_1-6" class="form-control"
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

<!-- Página 45, actividad 11.2 -->
<div id="ModalUnit2Act11_2" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">CLASSROOM EXPRESSIONS</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-eleven_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Draw two classroom expressions, then write it</p>
											<input type="text" class="d-none" id="points11_2" name="points">
											<input type="text" class="d-none" id="idcliente11_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro11_2" name="idlibro">
										</div>
									</div>									

									<style type="text/css">
										/*@import url('https://fonts.googleapis.com/css?family=Roboto:400,700');*/

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
										width: 85%;
										margin: auto;
										padding-top: 50px;
										padding-bottom: 50px;
										}

										.grid {
										display: grid;
										grid-template-columns: 25% 25% 25%;
										justify-content: center;	
										margin-top: 30px;
										}

										h1 {
										color: rgba(0, 0, 0, 0.7.5);
										font-size: 56px;
										font-weight: 700;
										letter-spacing: 0.5px;
										text-align: center;
										}

										header p {
										color: rgba(0, 0, 0, 0.6);
										font-size: 22px;
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
										height: 500px;
										text-align: center;
										}

										canvas11 {
										background-color: #F8F8F8;
										}

										.color, .stroke, .clear {
										justify-self: center;
										}

										#clearBtn11 {
										color: white;
										font-size: 20px;
										font-weight: 700;
										letter-spacing: 0.5px;
										padding: 10px 50px;
										background-color: #55D0ED;
										border-radius: 10px;
										text-decoration: none;
										}
									</style>

									<header>
										<h1>Draw with your mouse</h1>
										<div class="grid">
											<div class="color">
												<p>Choose a color:</p>
												<div class="colorPickerWrapper">
													<input type="color" id="colorPicker11" value="#55D0ED">
												</div>
											</div>
											<div class="stroke">
												<p>Change the stroke's width:</p>
												<div class="strokeWidthPickerWrapper">
													<input type="range" min="1" max="20" value="2.5" id="strokeWidthPicker11">
												</div>
											</div>
											<div class="clear">
													<p>Clear the canvas</p>
												<div class="clearBtnWrapper">
													<a href="#" id="clearBtn11">Clear the canvas</a>
												</div>
											</div>
										</div>
									</header>

									<div class="col-12">
										<div class="container mt-3">
											<input type="number" value="0" id="verify-canvas" class="d-none">
											<canvas id="canvas11" style="background: url('../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag45/img45.png')"
											width="835" height="420">

											</canvas>
										</div>
									</div>
									<!-- Librerias para el Canvas -->
									<script src="https://s.cdpn.io/6859/paper.js"></script>
        							<script src="https://s.cdpn.io/6859/tween.min.js"></script>
									
								</div>

								<div class="row justify-content-md-center justify-content-sm-center">		
									
									<div class="col-md-8 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="col-6">
												
													<input type="text" id="input-act11_2-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"
														placeholder="Write the classroom expressions you drew"														
														autocomplete="off">
												</div>
												
												<div class="col-6">
													
													<input type="text" id="input-act11_2-2" class="form-control"
														aria-label="Sizing example input" maxlength="100"												
														style="margin-bottom: 15px; margin-top: 15px;"	
														placeholder="Write the classroom expressions you drew"														
														autocomplete="off">
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

<!-- Página 46 -->
<div id="ModalUnit2Act12" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">INTRODUCE YOURSELF</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-twelve">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Write the dialogue.</p>
											<input type="text" class="d-none" id="points12" name="points">
											<input type="text" class="d-none" id="idcliente12" name="idcliente">
											<input type="text" class="d-none" id="idlibro12" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-12 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" style="margin-bottom: 25px;" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag44/img44_1.png">
										</div>

										<div class="col-md-12 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">																										
													<div class="col-2">
														<input type="text" id="input-act12-1n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">: Hello, my name is</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act12-2n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-1">
														<p class="fst-normal">I am</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act12-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="your teacher"
															autocomplete="off">
													</div>																																											
												</div>																								

												<hr>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act12-3n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">: Hi, my name is</p> 
													</div>
													<div class="col-2">
														<input type="text" id="input-act12-4n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<p class="fst-normal">I am</p> 
													</div>	
													<div class="col-2">
														<input type="text" id="input-act12-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															placeholder="a student"
															autocomplete="off">
													</div>																																												
												</div>	

												<hr>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">													
													<div class="col-2">
														<input type="text" id="input-act12-5n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>	
													<div class="col-1">
														<input type="text" id="input-act12-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"												
															autocomplete="off">
													</div>
													<div class="col-2">
														<p class="fst-normal">my name is</p> 
													</div>														
													<div class="col-2">
														<input type="text" id="input-act12-6n" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<input type="text" id="input-act12-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;"
															autocomplete="off">
													</div>		
													<div class="col-2">
														<p class="fst-normal">a student</p> 
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

<!-- Página 48, actividad 13.1 -->
<div id="ModalUnit2Act13_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MEANS OF TRANSPORTATION</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_1">
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
											<input type="text" class="d-none" id="points13_1" name="points">
											<input type="text" class="d-none" id="idcliente13_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act13_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act13_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act13_1-6" class="form-control"
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

<!-- Página 48, actividad 13.2 -->
<div id="ModalUnit2Act13_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">MEANS OF TRANSPORTATION</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-thirteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points13_2" name="points">
											<input type="text" class="d-none" id="idcliente13_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro13_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act13-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_2-1.png" alt="Motorcycle" id="img-act13-1">
											</div>
											<div class="col ps-5">
												<div id="Truck" class="box-act13 text-center m-3" >
													<p>Truck</p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act13-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_2-2.png"  alt="Car" id="img-act13-2">
											</div>
											<div class="col ps-5">
												<div id="Bike" class="box-act13 text-center m-3" >
													<p>Bike</p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act13-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_2-3.png"  alt="Train" id="img-act13-3">
											</div>
											<div class="col ps-5">
												<div id="Motorcycle" class="box-act13 text-center m-3" >
													<p>Motorcycle</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act13-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_2-4.png"  alt="Truck" id="img-act13-4">
											</div>
											<div class="col ps-5">
												<div id="Car" class="box-act13 text-center m-3" >
													<p>Car</p>
												</div>
											</div>																					
										</div>

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act13-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag48/img48_2-5.png"  alt="Bike" id="img-act13-5">
											</div>
											<div class="col ps-5">
												<div id="Train" class="box-act13 text-center m-3" >
													<p>Train</p>
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

<!-- Página 49, actividad 14.1 -->
<div id="ModalUnit2Act14_1" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTECES ABOUT MEANS OF TRANSPORTATION</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen_1">
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
											<input type="text" class="d-none" id="points14_1" name="points">
											<input type="text" class="d-none" id="idcliente14_1" name="idcliente">
											<input type="text" class="d-none" id="idlibro14_1" name="idlibro">
										</div>
									</div>



									<div class="row justify-content-md-center justify-content-sm-center">															

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-1.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-1" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
														placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>											
										
                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-2.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act14_1-2" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

									    <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-3.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-3" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>	

                                        <div class="col-md-6 col-sm-6">
													
                                            <div class="col">
                                                <img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-4.png">
                                            </div>

                                            <div class="col justify-content-center">
                                                <input type="text" id="input-act14_1-4" class="form-control"
                                                        aria-label="Sizing example input" maxlength="100"
                                                        style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
                                                        autocomplete="off">
                                            </div>
                                                                                        
                                        </div>	

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-5.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-5" class="form-control"
														aria-label="Sizing example input" maxlength="100"
														style="margin-bottom: 25px; margin-top: 25px;"
                                                        placeholder="Rewrite the sentences"
														autocomplete="off">
											</div>
																					 
										</div>		

										<div class="col-md-6 col-sm-6">
													
                                            <div class="col">
												<img class="rounded mx-auto d-block" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_1-6.png">
											</div>

											<div class="col justify-content-center">
												<input type="text" id="input-act14_1-6" class="form-control"
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

<!-- Página 48, actividad 14.2 -->
<div id="ModalUnit2Act14_2" class="modal fade"  tabindex="-5">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">WRITING AND SAYING SIMPLE SENTECES ABOUT MEANS OF TRANSPORTATION</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-fourteen_2">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the picture with the phrase</p>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points14_2" name="points">
											<input type="text" class="d-none" id="idcliente14_2" name="idcliente">
											<input type="text" class="d-none" id="idlibro14_2" name="idlibro">
										</div>
									</div>

									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-6 col-sm-6">																							
											<div class="col" align="center" id="box-act14-1">				
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_2-1.png" alt="Parking lot" id="img-act14-1">
											</div>
											<div class="col ps-5">
												<div id="Taxi stand" class="box-act14 text-center m-3" >
													<p>Taxi stand</p>
												</div>
											</div>																					
										</div>	

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act14-2">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_2-2.png"  alt="Taxi stand" id="img-act14-2">
											</div>
											<div class="col ps-5">
												<div id="Train station" class="box-act14 text-center m-3" >
													<p>Train station</p>
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act14-3">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_2-3.png"  alt="Bus stop" id="img-act14-3">
											</div>
											<div class="col ps-5">
												<div id="Bus stop" class="box-act14 text-center m-3" >
													<p>Bus stop</p>
												</div>
											</div>																					
										</div>
										
										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act14-4">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_2-4.png"  alt="Gas station" id="img-act14-4">
											</div>
											<div class="col ps-5">
												<div id="Parking lot" class="box-act14 text-center m-3" >
													<p>Parking lot</p>
												</div>
											</div>																					
										</div>

										<div class="col-md-6 col-sm-6">																																		
											<div class="col" align="center" id="box-act14-5">
												<img draggable="true" src="../../resources/img/BOOKS/ThirdGrade/UnitTwo/Pag49/img49_2-5.png"  alt="Traom station" id="img-act14-5">
											</div>
											<div class="col ps-5">
												<div id="Gas station" class="box-act14 text-center m-3" >
													<p>Gas station</p>
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
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro3_u2.js');
?>