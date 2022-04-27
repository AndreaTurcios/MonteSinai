<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Agregamos Bootstrap -->
	<link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<title>Unit 1 - First Grade</title>
	<link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
	<!-- old stylesheet  -->
	<!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
	<!-- turns.js librerias  -->
	<script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
	<script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
	<script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>

</head>

<body style="background-image: url(../../resources/img/BOOKS/back.jpg);">
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
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/1.JPG" width="76" height="100"
								class="page-1">
							<span>1</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/2.JPG" width="76" height="100"
								class="page-2">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/3.JPG" width="76" height="100"
								class="page-3">
							<span>2-3</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/4.JPG" width="76" height="100"
								class="page-4">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/5.JPG" width="76" height="100"
								class="page-5">
							<span>4-5</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/6.JPG" width="76" height="100"
								class="page-6">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/7.JPG" width="76" height="100"
								class="page-7">
							<span>6-7</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/8.JPG" width="76" height="100"
								class="page-8">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/9.JPG" width="76" height="100"
								class="page-9">
							<span>8-9</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/10.JPG" width="76" height="100"
								class="page-10">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/11.JPG" width="76" height="100"
								class="page-11">
							<span>10-11</span>
						</li>
						<li class="d">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/12.JPG" width="76" height="100"
								class="page-12">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/13.JPG" width="76" height="100"
								class="page-13">
							<span>12-13</span>
						</li>
						<li class="i">
							<img src="../../resources/img/BOOKS/FirstGrade/UnitOne/14.JPG" width="76" height="100"
								class="page-14">
							<span>14<span>
						</li>
						<ul>
							<div>
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

						// The number of pages

						pages: 32,

						// Events

						when: {
							turning: function (event, page, view) {

								var book = $(this),
									currentPage = book.turn('page'),
									pages = book.turn('pages');

								// Update the current URI

								Hash.go('../../resources/js/turnjs4/samples/magazine/pages/' + page).update();

								// Show and hide navigation buttons

								disableControls(page);


								$('.thumbnails .page-' + currentPage).
									parent().
									removeClass('current');

								$('.thumbnails .page-' + page).
									parent().
									addClass('current');



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

									$('<div />', { 'class': 'exit-message' }).
										html('<div>Press ESC to exit</div>').
										appendTo($('body')).
										delay(2000).
										animate({ opacity: 0 }, 500, function () {
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

						var previous = 37, next = 39, esc = 27;

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
					both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunoprimergrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
					complete: loadApp
				});

			</script>



			<!--inicio modal -->
			<div class="row">
				<!-- espacio  -->
				<div class="row">
					<nav>
						<div class="col-6 col-xs-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 col-xxl-2 p-3" id="MuestraBTN">
							<div id="ModalAgregarCliente" class="modal fade">
								<div class="container-fluid">
									<form method="post" id="save-form">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modal-title">Agregar nuevo libro</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"
														aria-label="Close"></button>
												</div>

												<div class="modal-body">
													<div class="container">
														<div class="form-group">
															<label for="nombrelibro">Nombre libro:</label>
															<input type="text" class="form-control" id="nombrelibro"
																name="nombrelibro" placeholder="Nombre libro"
																pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1-50}" required
																minlength="3" maxlength="50" autocomplete="off" />
														</div>
														<br>
														<div class="form-group">
															<label for="numpaginas">Número páginas:</label>
															<input type="number" class="form-control" id="numpaginas"
																name="numpaginas" placeholder="Número páginas" required
																minlength="1" maxlength="5" autocomplete="off" />
														</div>
														<br>
														<div class="form-group">
															<label for="asignatura">Asignatura:</label>
															<select id="asignatura" class="form-select"
																name="asignatura">
																<option selected></option>
															</select>
														</div>
														<div class="form-group">
															<label for="estadolibro">Estado libro:</label>
															<select id="estadolibro" class="form-select"
																name="estadolibro">
																<option selected></option>
															</select>
														</div>
													</div>
													<br>
													<!-- Botones de Control -->
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary"
															data-bs-dismiss="modal">Cancelar</button>
														<button type="submit" class="btn waves-effect blue tooltipped"
															data-tooltip="Guardar">Guardar</button><br>
													</div>
									</form>
									</form>
								</div>
							</div>
						</div>
				</div>
				</nav>
				<br>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modal-title">Actualizar libro</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<!-- Formulario -->
							<form id="update-form" method="post" enctype="multipart/form-data">
								<div class="form-group ">
									<label for="formGroupExampleInput" class="d-none">ID</label>
									<input type="text" class="form-control d-none" placeholder=""
										aria-describedby="basic-addon1" id="id_libro2" type="text" name="id_libro2" />
								</div>
								<div class="modal-body">


								</div>
								<br>
								<!-- Botones de Control -->
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary"
										data-bs-dismiss="modal">Cancelar</button>
									<button type="submit" class="btn waves-effect blue tooltipped"
										data-tooltip="Guardar">Guardar</button><br>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div id="ModalLibroUno" class="modal fade">
					<div class="container-fluid">
						<form method="post" id="game-one-form">
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modal-title">Complete the words</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>

									<div class="modal-body">

										<div class="form-group">
											<!-- columna -->
											<div class="container-fluid">
												<div class="row align-items-center">
													<div class="row">
														<div class="col-md-8 align-items-center">
															<p class="fs-1 fw-bold">Complete the activity</p>
														</div>
													</div>
													<div class="row row-cols-4">
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">H</div>
																	<div class="col">e</div>
																	<div class="col">
																		<input type="text" id="input-twohead"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">d</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">a</div>
																	<div class="col">
																		<input type="text" id="input-twoarm"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">m</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">e</div>
																	<div class="col">
																		<input type="text" id="input-twoear"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">r</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-6">
																	<div class="col">m</div>
																	<div class="col">
																		<input type="text" id="input-twomouth"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">o</div>
																	<div class="col">u</div>
																	<div class="col">t</div>
																	<div class="col">h</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<!-- espacio -->
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<!-- espacio -->
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">H</div>
																	<div class="col">e</div>
																	<div class="col">
																		<input type="text" id="input-twoheck"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">k</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">n</div>
																	<div class="col"><input type="text"
																			id="input-twonose"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1"></div>
																	<div class="col">s</div>
																	<div class="col">e</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">h</div>
																	<div class="col">a</div>
																	<div class="col">n</div>
																	<div class="col">
																		<input type="text" id="input-twohand"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">
																		<input type="text" id="input-twoleg"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">e</div>
																	<div class="col">g</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<!-- espacio -->
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<!-- espacio -->
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">F</div>
																	<div class="col">o</div>
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">t</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">a</div>
																	<div class="col">i</div>
																	<div class="col">r</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-7">
																	<div class="col">s</div>
																	<div class="col">t</div>
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">m</div>
																	<div class="col">a</div>
																	<div class="col">c</div>
																	<div class="col">h</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-6">
																	<div class="col">f</div>
																	<div class="col">i</div>
																	<div class="col">n</div>
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">e</div>
																	<div class="col">r</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<!-- espacio -->
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<div class="col"></div>
														<!-- espacio -->
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col"> <input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1"> </div>
																	<div class="col">a</div>
																	<div class="col">c</div>
																	<div class="col">e</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">o</div>
																	<div class="col">e</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">e</div>
																	<div class="col">
																		<input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">e</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
														<div class="col border border-dark">
															<!-- inicio group -->
															<div class="input-group input-group-sm mb-3">
																<div class="row row-cols-4">
																	<div class="col">k</div>
																	<div class="col">n</div>
																	<div class="col"><input type="text"
																			class="col-6 col-md-4 form-control"
																			aria-label="Sizing example input"
																			aria-describedby="inputGroup-sizing-sm"
																			maxlength="1">
																	</div>
																	<div class="col">e</div>
																</div>
															</div>
															<!-- fin group -->
														</div>
													</div>
												</div>
											</div>

										</div>
										<br>

										<br>
										<!-- Botones de Control -->
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary"
												data-bs-dismiss="modal">Cancel</button>
											<button type="submit" class="btn waves-effect blue tooltipped"
												data-tooltip="Guardar">Submit</button><br>
										</div>
									</div>
								</div>
						</form>
						</form>
					</div>
				</div>
			</div>
			<!-- fin modale -->


</body>
<script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
<!-- Script de Bootstrap -->
<script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
	integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
	crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
	integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
	crossorigin="anonymous"></script>
<script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>
<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
<script type="text/javascript" src="../../app/helpers/components.js"></script>
<script type="text/javascript" src="../../app/controllers/account.js"></script>
<script type="text/javascript" src="../../app/controllers/unidadunoprimergrado.js"></script>

</html>