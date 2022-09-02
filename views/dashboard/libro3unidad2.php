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

<!-- Página 38 -->
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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro3_u2.js');
?>