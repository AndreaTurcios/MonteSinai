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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete these activities and measure your archievements!</h5>
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
							<!-- pregunta1 -->
                            <div class="col-6">
								<div class="col-12">
									<strong>I-What is predicting?</strong>
								</div>

								<div class="col-md-12">
									<select id="act6-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Is an offer to come or go somewhere, especially one promising pleasure</option>
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation</option>
										<option value="3">Involves thinking ahead and anticipating information and events</option><!-- correcto -->
									</select>
								</div>
							</div>
							<!-- pregunta2 -->
							<div class="col-6">
								<div class="col-12">
									<strong>II-What is an invitation</strong>
								</div>

								<div class="col-md-12">
									<select id="act6-q2">
									<option value="0" selected disabled>Choose</option>
										<option value="1">Is an offer to come or go somewhere, especially one promising pleasure</option><!-- correcto -->
										<option value="2">Is a social gathering, as of invited guests at private home, for conversation</option>
										<option value="3">Involves thinking ahead and anticipating information and events</option>
									</select>
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta3 -->
							<div class="col-6">
								<div class="col-12">
									<strong>III-Complete sentences describing what you are going to do this weekend</strong>
								</div>
								<div class="col-md-12">
									1. Mark
									<select id="act6-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">are going to</option>
										<option value="2">is going to</option><!-- correcto -->
										<option value="3">is not going to</option>
									</select> help his mum later.
								</div>
								<div class="col-md-12">
									2. My friends
									<select id="act6-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">are going to</option><!-- correcto -->
										<option value="2">is going to</option>
										<option value="3">am going to</option>
									</select> play videogames tomorrow afternoon.
								</div>
								<div class="col-md-12">
									3. We are going to
									<select id="act6-q5">
										<option value="0" selected disabled>Choose</option>
										<option value="1">having</option>
										<option value="2">had</option>
										<option value="3">have</option><!-- correcto -->
									</select> an English lesson next weekend.
								</div>
								<div class="col-md-12">
									4. He is going to
									<select id="act6-q6">
										<option value="0" selected disabled>Choose</option>
										<option value="1">to take</option>
										<option value="2">take</option><!-- correcto -->
										<option value="3">took</option>
									</select> photos this evening.
								</div>
							</div>
							<!-- pregunta4 -->
							<div class="col-6">
								<div class="col-12">
									<strong>IV-Complete sentences describing future plans using 'be going to'</strong>
								</div>
								
								<div class="col-md-12">
									1. My little cousin
									<select id="act6-q7">
										<option value="0" selected disabled>Choose</option>
										<option value="1">is going to listen</option><!-- correcto -->
										<option value="2">is going to</option>
										<option value="3">are not going to listen</option>
									</select> to music.
								</div>
								<div class="col-md-12">
									2. He
									<select id="act6-q8">
										<option value="0" selected disabled>Choose</option>
										<option value="1">is going to swim</option>
										<option value="2">are going to swim</option>
										<option value="3">is not going to play soccer</option><!-- correcto -->
									</select>. He is going to go swimming.
								</div>
								<div class="col-md-12">
									3. Louis
									<select id="act6-q9">
										<option value="0" selected disabled>Choose</option>
										<option value="1">is going to</option><!-- correcto -->
										<option value="2">are going to</option>
										<option value="3">is not going to</option>
									</select> go to the beach.
								</div>
								<div class="col-md-12">
									4. My sister
									<select id="act6-q10">
										<option value="0" selected disabled>Choose</option>
										<option value="1">is going to</option><!-- correcto -->
										<option value="2">are going to</option>
										<option value="3">am not going to</option>
									</select> go to summer school
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta5 -->
							<div class="col-6">
								<div class="col-12">
									<strong>V-Why are language learning strategies especially important for language learning?</strong>
								</div>
								
								<div class="col-md-12">
									<select id="act6-q11">
										<option value="0" selected disabled>Choose</option>
										<option value="1">A nice atmosphere where a group of people gathers together for pleasure</option>
										<option value="2">By acting with manners, and to be generous and helpful with others</option>
										<option value="3">They are tools essential for developing communicative competence</option><!-- correcto -->
									</select>
								</div>
							</div>
							<!-- pregunta6 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VI-How can you show courtesy when making and accepting invitations?</strong>
								</div>
								
								<div class="col-md-12">
									<select id="act6-q12">
										<option value="0" selected disabled>Choose</option>
										<option value="1">A nice atmosphere where a group of people gathers together for pleasure</option>
										<option value="2">By acting with manners, and to be generous and helpful with others</option><!-- correcto -->
										<option value="3">They are tools essential for developing communicative competence</option>
									</select>
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta7 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VII-Use the correct from of 'going to' and the verbs in brackets. 
										Use contractions where possible.</strong>
								</div>
								
								<div class="col-md-12">
									1. I 
									<select id="act6-q13">
										<option value="0" selected disabled>Choose</option>
										<option value="1">'m going to take</option><!-- correcto -->
										<option value="2">'re going to order</option>
										<option value="3">isn't going to get</option>
									</select> some photos at the weekend.
								</div>
								<div class="col-md-12">
									2. They
									<select id="act6-q14">
										<option value="0" selected disabled>Choose</option>
										<option value="1">'m going to take</option>
										<option value="2">'re going to order</option><!-- correcto -->
										<option value="3">isn't going to get</option>
									</select> a pizza for dinner.
								</div>
								<div class="col-md-12">
									3. We
									<select id="act6-q15">
										<option value="0" selected disabled>Choose</option>
										<option value="1">'re not going to play</option><!-- correcto -->
										<option value="2">'re going to order</option>
										<option value="3">isn't going to get</option>
									</select> football tomorrow.
								</div>
								<div class="col-md-12">
									4. Paul
									<select id="act6-q16">
										<option value="0" selected disabled>Choose</option>
										<option value="1">'m going to take</option>
										<option value="2">'re not going to play</option>
										<option value="3">isn't going to get</option><!-- correcto -->
									</select> a summer job.
								</div>
							</div>

							<!-- pregunta8 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VIII-Put in the verbs in brackets into the gaps. Use 'will-future'. Watch the punctuation and form sentences or questions</strong>
								</div>
								<div class="col-md-12">
									1. They 
									<select id="act6-q17">
										<option value="0" selected disabled>Choose</option>
										<option value="1">will</option>
										<option value="2">will be</option><!-- correcto -->
										<option value="3">will take</option>
									</select> back by 6:30 pm. <b>(to be)</b>
								</div>
								<div class="col-md-12">
									2.  
									<select id="act6-q18">
										<option value="0" selected disabled>Choose</option>
										<option value="1">will</option><!-- correcto -->
										<option value="2">will be</option>
										<option value="3">will take</option>
									</select> you help me? <b>(to help)</b>
								</div>
								<div class="col-md-12">
									3. When
									<select id="act6-q19">
										<option value="0" selected disabled>Choose</option>
										<option value="1">will</option><!-- correcto -->
										<option value="2">will be</option>
										<option value="3">will see</option>
									</select> i see you again? <b>(to see)</b>
								</div>
								<div class="col-md-12">
									4. His parents
									<select id="act6-q20">
										<option value="0" selected disabled>Choose</option>
										<option value="1">not punish</option>
										<option value="2">will punish</option>
										<option value="3">will not punish</option><!-- correcto -->
									</select> him for being late <b>(not/to punish)</b>
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
<!-- fin Region 8-->
<!-- fin Actividad 6-->

<!-- Actividad 7 Pendiente agregar ejercicios-->
<!-- Region 9-->
<div id="ModalLibroOcho9" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..7</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act7">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points7" name="points7">
                                <input type="text"  class="d-none" id="idlibro7" name="idlibro7">
								<input type="text"  class="d-none" id="idcliente7" name="idcliente7">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 9-->
<!-- fin Actividad 7-->

<!-- Actividad 8 pendiente agregar ejercicios-->
<!-- Region 10-->
<div id="ModalLibroOcho10" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..8</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act8">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points8" name="points8">
                                <input type="text"  class="d-none" id="idlibro8" name="idlibro8">
								<input type="text"  class="d-none" id="idcliente8" name="idcliente8">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 10-->
<!-- fin Actividad 8-->

<!-- Actividad 9 pendiente agregar ejercicios-->
<!-- Region 11-->
<div id="ModalLibroOcho11" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..9</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act9">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points9" name="points9">
                                <input type="text"  class="d-none" id="idlibro9" name="idlibro9">
								<input type="text"  class="d-none" id="idcliente9" name="idcliente9">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 11-->
<!-- fin Actividad 9-->

<!-- Actividad 10 pendiente agregar ejercicios-->
<!-- Region 12-->
<div id="ModalLibroOcho12" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..10</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act10">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points10" name="points10">
                                <input type="text"  class="d-none" id="idlibro10" name="idlibro10">
								<input type="text"  class="d-none" id="idcliente10" name="idcliente10">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 12-->
<!-- fin Actividad 10-->

<!-- Actividad 11 pendiente agregar ejercicios-->
<!-- Region 13-->
<div id="ModalLibroOcho13" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..11</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act11">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points11" name="points11">
                                <input type="text"  class="d-none" id="idlibro11" name="idlibro11">
								<input type="text"  class="d-none" id="idcliente11" name="idcliente11">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 13-->
<!-- fin Actividad 11-->

<!-- Actividad 12 pendiente agregar ejercicios-->
<!-- Region 14-->
<div id="ModalLibroOcho14" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Act..12</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit5-act12">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<h6>Complete the sentences</h6>
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points11" name="points11">
                                <input type="text"  class="d-none" id="idlibro11" name="idlibro11">
								<input type="text"  class="d-none" id="idcliente11" name="idcliente11">
							</div>
						</div>
                        <div class="row">
							<div class="col-md-12">
							1. example
								<select id="act7-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">is</option>
									<option value="2">are</option>
									<option value="3">am</option><!-- correcto -->
								</select> ...
							</div>
							
							<div class="col-12"><br></div>

							<div class="col-md-12">
							2. example
								<select id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">are not</option>
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							3. example
								<select id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option>
									<option value="2">is not</option>
									<option value="3">is</option><!-- correcto -->
								</select> ...
							</div>

							<div class="col-12"><br></div>

							<div class="col-md-12">
							4. example
								<select id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">are</option><!-- correcto -->
									<option value="2">is</option>
									<option value="3">am</option>
								</select> ...
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
<!-- fin Region 14-->
<!-- fin Actividad 12-->


<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
	// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
	Book_Page::footerTemplate('controladorlibro8_u5.js');
?>