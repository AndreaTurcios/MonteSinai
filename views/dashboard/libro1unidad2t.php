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
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/1.JPG" width="76" height="100" class="page-1">
						<span>Inicio</span>
					</li>
					<li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/37.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/38.JPG" width="76" height="100" class="page-3">
						<span>37-38</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/39.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/40.JPG" width="76" height="100" class="page-3">
						<span>39-40</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/41.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/42.JPG" width="76" height="100" class="page-3">
						<span>41-42</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/43.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/44.JPG" width="76" height="100" class="page-3">
						<span>43-44</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/45.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/46.JPG" width="76" height="100" class="page-3">
						<span>45-46</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/47.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/48.JPG" width="76" height="100" class="page-3">
						<span>47-48</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/49.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/50.JPG" width="76" height="100" class="page-3">
						<span>49-50</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/51.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/52.JPG" width="76" height="100" class="page-3">
						<span>51-52</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/53.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/54.JPG" width="76" height="100" class="page-3">
						<span>53-54</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/55.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/56.JPG" width="76" height="100" class="page-3">
						<span>55-56</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/57.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/58.JPG" width="76" height="100" class="page-3">
						<span>57-58</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/59.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/60.JPG" width="76" height="100" class="page-3">
						<span>59-60</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/61.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/62.JPG" width="76" height="100" class="page-3">
						<span>61-62</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/63.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/64.JPG" width="76" height="100" class="page-3">
						<span>63-64</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/65.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/66.JPG" width="76" height="100" class="page-3">
						<span>65-66</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/67.JPG" width="76" height="100" class="page-2">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/68.JPG" width="76" height="100" class="page-3">
						<span>67-68</span>
					</li>
                    <li class="d">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitTwo/69.JPG" width="76" height="100" class="page-2">
						<span>69</span>
					</li>
                    <li class="i">
						<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/44.JPG" width="76" height="100" class="page-14">
						<span>Fin<span>
					</li>
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

			pages: 41,

			// Events

			when: {
				turning: function(event, page, view) {

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
				


				},

				turned: function(event, page, view) {

					disableControls(page);

					$(this).turn('center');

					if (page == 1) {
						$(this).turn('peel', 'br');
					}

				},

				missing: function(event, pages) {

					// Add pages that aren't in the magazine

					for (var i = 0; i < pages.length; i++)
						addPage(pages[i], $(this));

				}
			}

		});

		// Zoom.js

		$('.magazine-viewport').zoom({
			flipbook: $('.magazine'),

			max: function() {

				return largeMagazineWidth() / $('.magazine').width();

			},

			when: {

				swipeLeft: function() {

					$(this).zoom('flipbook').turn('next');

				},

				swipeRight: function() {

					$(this).zoom('flipbook').turn('previous');

				},

				resize: function(event, scale, page, pageElement) {

					if (scale == 1)
						loadSmallPage(page, pageElement);
					else
						loadLargePage(page, pageElement);

				},

				zoomIn: function() {

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
						}, 500, function() {
							$(this).remove();
						});
					}
				},

				zoomOut: function() {

					$('.exit-message').hide();
					$('.thumbnails').fadeIn();
					$('.made').fadeIn();
					$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

					setTimeout(function() {
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

		$(document).keydown(function(e) {

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
			yep: function(path, parts) {
				var page = parts[1];

				if (page !== undefined) {
					if ($('.magazine').turn('is'))
						$('.magazine').turn('page', page);
				}

			},
			nop: function(path) {

				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', 1);
			}
		});


		$(window).resize(function() {
			resizeViewport();
		}).bind('orientationchange', function() {
			resizeViewport();
		});

		// Events for thumbnails

		$('.thumbnails').click(function(event) {

			var page;

			if (event.target && (page = /page-([0-9]+)/.exec($(event.target).attr('class')))) {

				$('.magazine').turn('page', page[1]);
			}
		});

		$('.thumbnails li').
		bind($.mouseEvents.over, function() {

			$(this).addClass('thumb-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('thumb-hover');

		});

		if ($.isTouch) {

			$('.thumbnails').
			addClass('thumbanils-touch').
			bind($.mouseEvents.move, function(event) {
				event.preventDefault();
			});

		} else {

			$('.thumbnails ul').mouseover(function() {

				$('.thumbnails').addClass('thumbnails-hover');

			}).mousedown(function() {

				return false;

			}).mouseout(function() {

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

		$('.next-button').bind($.mouseEvents.over, function() {

			$(this).addClass('next-button-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('next-button-hover');

		}).bind($.mouseEvents.down, function() {

			$(this).addClass('next-button-down');

		}).bind($.mouseEvents.up, function() {

			$(this).removeClass('next-button-down');

		}).click(function() {

			$('.magazine').turn('next');

		});

		// Events for the next button

		$('.previous-button').bind($.mouseEvents.over, function() {

			$(this).addClass('previous-button-hover');

		}).bind($.mouseEvents.out, function() {

			$(this).removeClass('previous-button-hover');

		}).bind($.mouseEvents.down, function() {

			$(this).addClass('previous-button-down');

		}).bind($.mouseEvents.up, function() {

			$(this).removeClass('previous-button-down');

		}).click(function() {

			$('.magazine').turn('previous');

		});


		resizeViewport();

		$('.magazine').addClass('animated');

	}

	// Zoom icon

	$('.zoom-icon').bind('mouseover', function() {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).addClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).addClass('zoom-icon-out-hover');

	}).bind('mouseout', function() {

		if ($(this).hasClass('zoom-icon-in'))
			$(this).removeClass('zoom-icon-in-hover');

		if ($(this).hasClass('zoom-icon-out'))
			$(this).removeClass('zoom-icon-out-hover');

	}).bind('click', function() {

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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidaddosprimergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Página 39 -->
<div id="ModalUnit2Act1" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">MY FAMILY</h5>
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
											<p class="fs-1 fw-bold">Complete the sentences</p>
											<input type="text" class="d-none" id="points1" name="points">
											<input type="text" class="d-none" id="idcliente1" name="idcliente">
											<input type="text" class="d-none" id="idlibro1" name="idlibro">
										</div>
									</div>

									<div class="row align-items-center">

										<div class="col-md-6 col-sm-12 col-xs-12">
											<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag39/image39.png"
											class="rounded mx-auto d-block">																				
										</div>

										<div class="col-md-6 col-sm-12 col-xs-12">

											<div class="row justify-content-md-center justify-content-sm-center">

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-1" class="form-control"
															aria-label="Sizing example input" maxlength="100"
															style="margin-bottom: 5px;">
													</div>
													<div class="col-1">
														<p class="fst-normal">eats</p> 
													</div>
													<div class="col-3">
														<input type="text" id="input-act1-2" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>		
												</div>
												
												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-3" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal">Roxanna likes apples</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My grandmothers eats</p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act1-4" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-4">
														<p class="fst-normal">My uncle likes</p> 
													</div>
													<div class="col-4">
														<input type="text" id="input-act1-5" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-1">
														<p class="fst-normal">My</p> 
													</div>		
													<div class="col-3">
														<input type="text" id="input-act1-6" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
													</div>
													<div class="col-4">
														<p class="fst-normal">eats chicken</p> 
													</div>	
												</div>

												<div class="row justify-content-md-center justify-content-sm-center mb-2">
													<div class="col-2">
														<input type="text" id="input-act1-7" class="form-control"
															aria-label="Sizing example input" maxlength="100"												
															style="margin-bottom: 5px;">
														
													</div>
													<div class="col-6">
														<p class="fst-normal">fathers work too hard</p> 
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
<div id="ModalUnit2Act2" class="modal fade"  tabindex="-5">
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
									<div class="row mb-4">
										<div class="col align-items-center">
											<p class="fs-5 fw-bold">Match the activity with the picture</p>
											<input type="text" class="d-none" id="points2" name="points">
											<input type="text" class="d-none" id="idcliente2" name="idcliente">
											<input type="text" class="d-none" id="idlibro2" name="idlibro">
										</div>
									</div>
									
									<div class="row justify-content-md-center justify-content-sm-center">

										<div class="col-md-4 col-sm-6">																							
											<div class="col ps-5" id="box-act2-2">				
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/lunch.png" alt="Lunch" id="img-act2-1">
											</div>
											<div class="col ps-5">
												<div id="breakfast" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Breakfast
												</div>
											</div>																					
										</div>	

										<div class="col-md-4 col-sm-6">																																		
											<div class="col ps-5" id="box-act2-3">
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/dinner.png"  alt="Dinner" id="img-act2-2">
											</div>
											<div class="col ps-5">
												<div id="lunch" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Lunch
												</div>
											</div>																					
										</div>	
										
										<div class="col-md-4 col-sm-6">																							
											
											<div class="col ps-5" id="box-act2-1">
												<img draggable="true" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag40/breakfast.png"  alt="Breakfast" id="img-act2-3">
											</div>
											<div class="col ps-5">
												<div id="dinner" class="box-act18 text-center m-3"  style="background-color: #3CB0E0;">
													Dinner
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

<!-- Página 27  -->
<div id="ModalUnit2Act3" class="modal fade" tabindex="-34">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
	<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">What is the father eating?</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="game-three">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<p class="fs-1 fw-bold">Match the activities and write them</p>
											<input type="text" class="d-none" id="points3" name="points">
											<input type="text" class="d-none" id="idcliente3" name="idcliente">
											<input type="text" class="d-none" id="idlibro3" name="idlibro">
										</div>
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/pupusa.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act3-1" name="select-act3-1">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>	
										
										<input type="text" id="input-act3-1" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">
									</div>

									<div class="col">	
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/cookie.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act3-2" name="select-act3-2">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>

										<input type="text" id="input-act3-2" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">			
									</div>

									<div class="col">
										<img class="img-fluid rounded mx-auto d-block" src="../../resources/img/BOOKS/FirstGrade/UnitTwo/Pag42/coke.png"
										class="rounded mx-auto d-block">										
										<select class="form-select form-select-lg mt-3 mb-3" id="select-act3-3" name="select-act3-3">

											<option disabled selected>Select an option</option>
											<option value="She is eating cookies">She is eating cookies</option>
											<option value="He is drinking a coke">He is drinking a coke</option>
											<option value="She is eating pupusas">She is eating pupusas</option>

                                        </select>

										<input type="text" id="input-act3-3" class="form-control"
											aria-label="Sizing example input" maxlength="100"
											style="margin-bottom: 5px; margin-top: 5px;"
											placeholder = "Rewrite the sentence">								
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
Book_Page::footerTemplate('controladorlibro1_u2.js');
?>