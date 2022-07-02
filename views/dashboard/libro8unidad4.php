<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 4');
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
			pages: 37,
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
		both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadcuatrooctavogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
		complete: loadApp
	});
</script>

<!-- Actividad 1-->
<!-- Region 11-->
<div id="ModalLibroOcho11" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct sentences using clothing and personal care items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act1">
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
                            <div class="col-6">
								<div class = oracion>
                                    <input type="checkbox" id="cbox1" value="second_checkbox"><label for="cbox1"> My sister likes her new dress</label>
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox2" value="second_checkbox"><label for="cbox2"> My mother loves to go to the beach</label><!-- incorrecto -->
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox3" value="second_checkbox"><label for="cbox3"> My father wears watch every time</label>
                                </div>
							</div>
                            <div class="col-6">
								<div class = oracion>
                                    <input type="checkbox" id="cbox4" value="second_checkbox"><label for="cbox4"> This hat belongs to my brother</label>
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox5" value="second_checkbox"><label for="cbox5"> That piece of pizza is mine</label><!-- incorrecto -->
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox6" value="second_checkbox"><label for="cbox6"> Her bag is expensive</label>
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
<!-- fin Actividad 1-->
<!-- fin Region 11-->

<!-- Actividad 2-->
<!-- Region 12-->
<div id="ModalLibroOcho12" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers about more clothing and personal items</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act2">
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

                        <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act2-q1">Hi! Maria, are your shoes new?</label>
								<select name="act2-q1" id="act2-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Hi, Fernanda, how are you?</option>
									<option value="2">Yes, I bought them yesterday</option><!-- correcto -->
									<option value="3">I think I'm large</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select name="act2-q2" id="act2-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">What material is it?</option>
									<option value="2">What color would you like?</option>
									<option value="3">Do you have a pair of sneakers for me?</option><!-- correcto -->
								</select>
								<label for="act2-q2">Sure, I have these in your size</label>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act2-q3">What color do you want for your hat?</label>
								<select name="act2-q3" id="act2-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">I think I'm large</option>
									<option value="2">Blue, please</option><!-- correcto -->
									<option value="3">Wool is fine</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select name="act2-q4" id="act2-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">What material is it?</option><!-- correcto -->
									<option value="2">What color is it?</option>
									<option value="3">What size is it?</option>
								</select>
								<label for="act2-q4">It's cotton</label>
							</div>
						</div>

                    </div>
                    <br>
                    <!-- Botones de Control -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin Actividad 2-->
<!-- fin Region 12-->


<!-- Actividad 3-->
<!-- Region 13-->
<div id="ModalLibroOcho13" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Recognize home appliances and prices</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act3">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<h5>Read and recognize home appliances and prices</h5>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points3" name="points3">
											<input type="text" class="d-none" id="idcliente3" name="idcliente3">
											<input type="text" class="d-none" id="idlibro3" name="idlibro3">
										</div>
									</div>

									<div class="row">
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej1.png"
												class="rounded mx-auto d-block">
												<select id="act3-q1" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Microwave</option>
													<option value="2">TV on sale</option><!--correct-->
													<option value="3">Cell phone</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej2.png"
												class="rounded mx-auto d-block">
												<select id="act3-q2" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Refrigerator</option>
													<option value="2">Microwave</option><!--correct-->
													<option value="3">Camcorder</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej3.png"
												class="rounded mx-auto d-block">
												<select id="act3-q3" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Stove</option>
													<option value="2">Oven</option>
													<option value="3">Refrigerator</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej4.png"
												class="rounded mx-auto d-block">
												<select id="act3-q4" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">DVD</option>
													<option value="2">Camcorder</option><!--correct-->
													<option value="3">Cell phone</option>
												</select>
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej5.png"
												class="rounded mx-auto d-block">
												<select id="act3-q5" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Cell phone</option><!--correct-->
													<option value="2">Camcorder</option>
													<option value="3">DVD</option>
												</select>
											</div>
										</div>
									
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej6.png"
												class="rounded mx-auto d-block">
												<select id="act3-q6" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Stereo</option><!--correct-->
													<option value="2">DVD</option>
													<option value="3">Oven</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej7.png"
												class="rounded mx-auto d-block">
												<select id="act3-q7" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Stove</option>
													<option value="2">Microwave</option>
													<option value="3">Oven</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej8.png"
												class="rounded mx-auto d-block">
												<select id="act3-q8" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Cell phone</option>
													<option value="2">Stereo</option>
													<option value="3">DVD</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej9.png"
												class="rounded mx-auto d-block">
												<select id="act3-q9" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Microwave</option>
													<option value="2">Stove</option><!--correct-->
													<option value="3">Oven</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag13/act3-ej10.png"
												class="rounded mx-auto d-block">
												<select id="act3-q10" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">Iron</option><!--correct-->
													<option value="2">Stove</option>
													<option value="3">Oven</option>
												</select>
											</div>
										</div>

									
										<div class="col-6">
											<h5>Fill out the questionnaire</h5>
											<div>
												<label for="act3-q11">How much is the camcorder?</label>
												<select id="act3-q11" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">$450.00</option>
													<option value="2">$200.00</option>
													<option value="3">$400.00</option><!--correct-->
												</select>
											</div>
											<div>
												<label for="act3-q12">How much is the refrigerator?</label>
												<select id="act3-q12" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">$1000.00</option><!--correct-->
													<option value="2">$900.00</option>
													<option value="3">$600.00</option>
												</select>
											</div>
											<div>
												<label for="act3-q13">What can you buy with $125.00?</label>
												<select id="act3-q13" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">An Iron</option>
													<option value="2">A Stove</option>
													<option value="3">An oven</option><!--correct-->
												</select>
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
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                        <br>
                    </div>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- fin Actividad 3-->
<!-- fin Region 13-->

<!-- Actividad 4-->
<!-- Region 14-->
<div id="ModalLibroOcho14" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers about home appliances prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act4">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points4" name="points4">
                                <input type="text"  class="d-none" id="idlibro4" name="idlibro4">
								<input type="text"  class="d-none" id="idcliente4" name="idcliente4">
							</div>
						</div>

                        <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act4-q1">How much is that TV?</label>
								<select name="act4-q1" id="act4-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">It's $900.00</option><!-- correcto -->
									<option value="2">Yes, you can pay by credit card</option>
									<option value="3">I'll take it</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select name="act4-q2" id="act4-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Can I help you?</option>
									<option value="2">How much is it?</option>
									<option value="3">Can I pay by credit card?</option><!-- correcto -->
								</select>
								<label for="act4-q2">Yes, you can pay with it</label>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act4-q3">Is that refrigerator for sale?</label>
								<select name="act4-q3" id="act4-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Yes, it's also on sale</option><!-- correcto -->
									<option value="2">It's $1000.00</option>
									<option value="3">Yes, you can pay by credit card</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select name="act4-q4" id="act4-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Can I help you?</option><!-- correcto -->
									<option value="2">Can I pay by credit card?</option>
									<option value="3">How much is that TV?</option>
								</select>
								<label for="act4-q4">Yes, I'd like buy a stereo</label>
							</div>
						</div>

                    </div>
                    <br>
                    <!-- Botones de Control -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin Actividad 4-->
<!-- fin Region 14-->

<!-- Actividad 5-->
<!-- Region 15-->
<div id="ModalLibroOcho15" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct sentences using quantifiers with groceries</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act5">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points5" name="points5">
                                <input type="text"  class="d-none" id="idlibro5" name="idlibro5">
								<input type="text"  class="d-none" id="idcliente5" name="idcliente5">
							</div>
						</div>

                        <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q1">1-</label>
								<select name="act5-q1" id="act5-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">I need to use the microwave</option>
									<option value="2">We want a lot of bananas for the smoothie</option><!-- correcto -->
									<option value="3">Where is the refrigerator?</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q2">2-</label>
								<select name="act5-q2" id="act5-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">I have few milk in the refrigerator</option><!-- correcto -->
									<option value="2">We are very happy</option>
									<option value="3">I don't have much time</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q3">3-</label>
								<select name="act5-q3" id="act5-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">We don't have much money</option>
									<option value="2">There are several kinds of cakes on sale</option><!-- correcto -->
									<option value="3">I'm very tired</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q4">4-</label>
								<select name="act5-q4" id="act5-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">I'm very hungry</option>
									<option value="2">Can you give me some more of juice?</option><!-- correcto -->
									<option value="3">It's too late</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q5">5-</label>
								<select name="act5-q5" id="act5-q5">
									<option value="0" selected disabled>Choose</option>
									<option value="1">There are many cookies for your friends</option><!-- correcto -->
									<option value="2">I'm busy all the time</option>
									<option value="3">We need more space</option>
								</select>
							</div>
						</div>

                    </div>
                    <br>
                    <!-- Botones de Control -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin Actividad 5-->
<!-- fin Region 15-->

<!-- Actividad 6-->
<!-- Region 16-->
<div id="ModalLibroOcho16" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete these activities and measure your archievements!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act6">
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

                        <!-- <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act5-q1">1-What is a quantifier?</label>
								<select name="act5-q1" id="act5-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Is used to discover required information to complete 
										a given task such as making a decision about what to watch on TV, 
										or witch museum to visit while visiting a foreign city</option>
									<option value="2"></option>
									<option value="3">Is a word that indicates the range of individuals or items referred to</option>
								</select>
							</div>
						</div> -->

						<div class="row">

                            <div class="col-6">
								<div class="col-12">
									<strong>I-What is a quantifier?</strong>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q1" id="act6-r1">
									<label class="form-check-label" for="act6-r1">
										Is used to discover required information to complete a given task 
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q1" id="act6-r2"><!-- correcto -->
									<label class="form-check-label" for="act6-r2">
										Is a word that indicates the range of individuals or items referred to
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q1" id="act6-r3">
									<label class="form-check-label" for="act6-r3">
										Are electrical/mechanical appliances which accomplish some household functions,
										such as cooking or cleaning
									</label>
								</div>
							</div>

							<div class="col-6">
								<div class="col-12">
									<strong>II-What are home appliances?</strong>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r4"><!-- correcto -->
									<label class="form-check-label" for="act6-r4">
										Are electrical/mechanical appliances which accomplish some household functions,
										such as cooking or cleaning
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r5">
									<label class="form-check-label" for="act6-r5">
										Is a word that indicates the range of individuals or items referred to
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r6">
									<label class="form-check-label" for="act6-r6">
										Is used for clothes considered as a group; wearing apparel
									</label>
								</div>
							</div>

							<div class="col-6">
								<div class="col-12">
									<strong>III-Select sentences using quantifiers with groceries or food</strong>
								</div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox1" value="second_checkbox"><label for="cbox1">How much is it?</label>
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox2" value="second_checkbox"><label for="cbox2">There is some juice in the refrigerator</label><!-- correcto -->
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox3" value="second_checkbox"><label for="cbox3">A few cookies are on the oven</label><!-- correcto -->
                                </div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox3" value="second_checkbox"><label for="cbox3">I need a pair of sandals</label>
                                </div>
							</div>

							<div class="col-6">
								<div class="col-12">
									<strong>IV-Select questions and answers about clothing and personal items</strong>
								</div>
								
								<div class="col-md-12">
									<label for="act2-q1">Hi! Sara, are your bag new?</label>
									<select name="act2-q1" id="act2-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Hi, how are you?</option>
										<option value="2">Yes, I bought it las week.</option><!-- correcto -->
										<option value="3">I think I'm medium.</option>
									</select>
								</div>
								
								<div class="col-md-12">
									<select name="act2-q2" id="act2-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What material is it?</option><!-- correcto -->
										<option value="2">What color would you like?</option>
										<option value="3">May I help you?</option>
									</select>
									<label for="act2-q2">It's wool.</label>
								</div>

								<div class="col-md-12">
									<label for="act2-q1">What size are you?</label>
									<select name="act2-q1" id="act2-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's wool.</option>
										<option value="2">I'm small.</option><!-- correcto -->
										<option value="3">I'm looking for a red one.</option>
									</select>
								</div>

								<div class="col-md-12">
									<select name="act2-q2" id="act2-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Can i try it on?</option><!-- correcto -->
										<option value="2">Do you need those?</option>
										<option value="3">Anything else?</option>
									</select>
									<label for="act2-q2">Of course, try it.</label>
								</div>
								

								
							</div>



	
                        </div>

						

                    </div>
                    <br>
                    <!-- Botones de Control -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin Actividad 6-->
<!-- fin Region 16-->


<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro8.js');
?>