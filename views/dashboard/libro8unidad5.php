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
			pages: 29,
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
					//var estados = page
					//alert(page);
					//alert("CurrentPage"+currentPage+"Página"+page );
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadcincooctavogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Actividad 1-->
<!-- Region 3-->
<div id="ModalLibroOcho3" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Invitations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act1">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points1" name="points1">
                                <input type="text"  class="d-none" id="idlibro1" name="idlibro1">
								<input type="text"  class="d-none" id="idcliente1" name="idcliente1">
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
								I-What is an invitation?
								<div class="col-md-12">
									<select id="act1-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Is to express a desire for; ask for</option>
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation, refreshments, etc</option>
										<option value="3">Is an offer to come or go somewhere, especially one promising pleasure or hospitality</option><!-- correcto -->
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								II-What is party time?
								<div class="col-md-12">
									<select id="act1-q2">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Is to express a desire for; ask for</option>
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation, refreshments, etc</option><!-- correcto -->
										<option value="3">Is an offer to come or go somewhere, especially one promising pleasure or hospitality</option>
									</select>
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
<!-- fin Region 3-->
<!-- fin Actividad 1-->

<!-- Actividad 2-->
<!-- Region 4-->
<div id="ModalLibroOcho4" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Write a question with 'going to' for each situation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act2">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points2" name="points2">
                                <input type="text"  class="d-none" id="idlibro2" name="idlibro2">
								<input type="text"  class="d-none" id="idcliente2" name="idcliente2">
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
								<strong>1. Your friend has won some money.</strong> You ask: (what / do with it?)
								<div class="col-md-12">
									<select id="act2-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What are you going to wear?</option>
										<option value="2">Where are you going to put it?</option>
										<option value="3">Who are you going to invite?</option>
										<option value="4">What are you going to do with it</option><!-- correcto -->
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<strong>2. Your friend is going to a party tonight.</strong> You ask: (what / wear?)
								<div class="col-md-12">
									<select id="act2-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What are you going to wear?</option><!-- correcto -->
										<option value="2">Where are you going to put it?</option>
										<option value="3">Who are you going to invite?</option>
										<option value="4">What are you going to do with it</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<strong>3. Your friend has just bought a new table.</strong> You ask: (where / put it?)
								<div class="col-md-12">
									<select id="act2-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What are you going to wear?</option>
										<option value="2">Where are you going to put it?</option><!-- correcto -->
										<option value="3">Who are you going to invite?</option>
										<option value="4">What are you going to do with it</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<strong>4. Your friend has decided to have a party.</strong> You ask: (who / invite?)
								<div class="col-md-12">
									<select id="act2-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What are you going to wear?</option>
										<option value="2">Where are you going to put it?</option>
										<option value="3">Who are you going to invite?</option><!-- correcto -->
										<option value="4">What are you going to do with it</option>
									</select>
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
<!-- ejemplos-->
<div id="ModalLibroOcho4examples" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="examples4">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									

									<div class="row">
										<div class="col-12">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFive/Pag4/examples.png"
												class="rounded mx-auto d-block col-12">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- fin Region 4-->
<!-- fin Actividad 2-->

<!-- Actividad 3-->
<!-- Region 5-->
<div id="ModalLibroOcho5" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Write questions using 'do you think... will...?' + the following:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act3">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points3" name="points3">
                                <input type="text"  class="d-none" id="idlibro3" name="idlibro3">
								<input type="text"  class="d-none" id="idcliente3" name="idcliente3">
							</div>
						</div>
                        <div class="row">
							<div id="option-act8-1" class="box-l8u5 text-center m-0">
								be back
							</div>
							<div id="option-act8-2" class="box-l8u5 text-center m-0">
								cost
							</div>
							<div id="option-act8-3" class="box-l8u5 text-center m-0">
								end
							</div>
							<div id="option-act8-4" class="box-l8u5-2 text-center m-0">
								get married
							</div>
							<div id="option-act8-4" class="box-l8u5 text-center m-0">
								happen
							</div>
							<div id="option-act8-4" class="box-l8u5 text-center m-0">
								like
							</div>
							<div id="option-act8-4" class="box-l8u5 text-center m-0">
								rain
							</div>
							<br><br>
                            <div class="col-12">
								<div class="col-md-12">
									1. I've bought this picture for Karen.
									<select id="act3-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option><!-- correcto -->
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									2. The weather doesn't look very good.
									<select id="act3-q2">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option><!-- correcto -->
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									3. The meeting is still going on.
									<select id="act3-q3">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option><!-- correcto -->
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									4. My car needs to be repaired.
									<select id="act3-q4">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option><!-- correcto -->
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									5. Sally and David are in love.
									<select id="act3-q5">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option><!-- correcto -->
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									6. I'm going out now. Ok.
									<select id="act3-q6">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option>
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option><!-- correcto -->
										<option value="7">Do you think they will get married?</option>
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								<div class="col-md-12">
									7. The future situation is uncertain.
									<select id="act3-q7">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Do you think it will rain?</option>
										<option value="2">Do you think she will like it?</option>
										<option value="3">When do you think it will end?</option>
										<option value="4">What do you think it will happen?</option><!-- correcto -->
										<option value="5">How much it will cost?</option>
										<option value="6">What time you will be back?</option>
										<option value="7">Do you think they will get married?</option>
									</select>
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
<!-- ejemplos-->
<div id="ModalLibroOcho5examples" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="examples5">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									

									<div class="row">
										<div class="col-12">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFive/Pag5/examples.png"
												class="rounded mx-auto d-block col-12">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- fin Region 5-->
<!-- fin Actividad 3-->

<!-- Actividad 4-->
<!-- Region 6-->
<div id="ModalLibroOcho6" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Simple Future: Will / Won't</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act4">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points4" name="points4">
                                <input type="text"  class="d-none" id="idlibro4" name="idlibro4">
								<input type="text"  class="d-none" id="idcliente4" name="idcliente4">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. I'm hungry, but I
								<select id="act4-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">won't eat</option><!-- correcto -->
									<option value="2">will eat</option>
									<option value="3">won't</option>
								</select> anything, because we are having dinner soon.
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. I don't think she
								<select id="act4-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">will invite</option><!-- correcto -->
									<option value="2">won't invite</option>
									<option value="3">invite</option>
								</select> me to her party.
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. I
								<select id="act4-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">reading</option>
									<option value="2">won't read</option>
									<option value="3">will read</option><!-- correcto -->
								</select> it later. I do not have time now.
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. She
								<select id="act4-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">goes</option>
									<option value="2">won't go</option><!-- correcto -->
									<option value="3">will go</option>
								</select> to school. She is ill.
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
<!-- ejemplos-->
<div id="ModalLibroOcho6examples" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="examples6">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									

									<div class="row">
										<div class="col-12">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFive/Pag6/examples.png"
												class="rounded mx-auto d-block col-12">
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<br>
					</div>
					<br>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- fin Region 6-->
<!-- fin Actividad 4-->

<!-- Actividad 5-->
<!-- Region 7-->
<div id="ModalLibroOcho7" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Future Plans: Going to</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act5">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points5" name="points5">
                                <input type="text"  class="d-none" id="idlibro5" name="idlibro5">
								<input type="text"  class="d-none" id="idcliente5" name="idcliente5">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. I
								<select id="act5-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> going to make a cake later.
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. They
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> going to ride their bikes tomorrow.
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. She
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> going to study.
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. We
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> going to go to the cinema next week.
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
<!-- fin Region 7-->
<!-- fin Actividad 5-->

<!-- Actividad 6-->
<!-- Region 8-->
<div id="ModalLibroOcho8" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">act6...</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act6">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points6" name="points6">
                                <input type="text"  class="d-none" id="idlibro6" name="idlibro6">
								<input type="text"  class="d-none" id="idcliente6" name="idcliente6">
							</div>
						</div>
                        <div class="row">
                            <div class="col-12">
								I-...?
								<div class="col-md-12">
									<select id="act6-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Is to express a desire for; ask for</option>
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation, refreshments, etc</option>
										<option value="3">Is an offer to come or go somewhere, especially one promising pleasure or hospitality</option><!-- correcto -->
									</select>
								</div>
							</div>
							<div class="col-12"><br></div>
							<div class="col-12">
								II-...?
								<div class="col-md-12">
									<select id="act6-q2">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Is to express a desire for; ask for</option>
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation, refreshments, etc</option><!-- correcto -->
										<option value="3">Is an offer to come or go somewhere, especially one promising pleasure or hospitality</option>
									</select>
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
<!-- fin Region 7-->
<!-- fin Actividad 5-->
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
	// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
	Book_Page::footerTemplate('controladorlibro8_u5.js');
?>