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

						<div class="row">
							<!-- pregunta1 -->
                            <div class="col-6">
								<div class="col-12">
									<strong>I-What is a quantifier?</strong>
								</div>

								<div class="col-md-12">
									<select id="act6-s1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Is used to discover required information to complete a given task</option>
										<option value="2">Is a word that indicates the range of individuals or items referred to</option><!-- correcto -->
										<option value="3">Are appliances which accomplish some household functions</option>
									</select>
								</div>
							</div>
							<!-- pregunta2 -->
							<div class="col-6">
								<div class="col-12">
									<strong>II-What are home appliances?</strong>
								</div>

								<div class="col-md-12">
									<select id="act6-s2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Is used to discover required information to complete a given task</option>
										<option value="2">Is a word that indicates the range of individuals or items referred to</option>
										<option value="3">Are appliances which accomplish some household functions</option><!-- correcto -->
									</select>
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta3 -->
							<div class="col-6">
								<div class="col-12">
									<strong>III-Select sentences using quantifiers with groceries or food</strong>
								</div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox1" value="second_checkbox"><label for="cbox1">&nbsp;How much is it?</label>
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox2" value="second_checkbox"><label for="cbox2">&nbsp;There is some juice in the refrigerator</label><!-- correcto -->
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox3" value="second_checkbox"><label for="cbox3">&nbsp;A few cookies are on the oven</label><!-- correcto -->
                                </div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox4" value="second_checkbox"><label for="cbox4">&nbsp;I need a pair of sandals</label>
                                </div>
							</div>
							<!-- pregunta4 -->
							<div class="col-6">
								<div class="col-12">
									<strong>IV-Select questions and answers about clothing and personal items</strong>
								</div>
								
								<div class="col-md-12">
									<label for="act6-s3">Hi! Sara, are your bag new?</label>
									<select id="act6-s3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Hi, how are you?</option>
										<option value="2">Yes, I bought it las week.</option><!-- correcto -->
										<option value="3">I think I'm medium.</option>
									</select>
								</div>
								
								<div class="col-md-12">
									<select id="act6-s4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">What material is it?</option><!-- correcto -->
										<option value="2">What color would you like?</option>
										<option value="3">May I help you?</option>
									</select>
									<label for="act6-s4">It's wool.</label>
								</div>

								<div class="col-md-12">
									<label for="act6-s5">What size are you?</label>
									<select id="act6-s5">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's wool.</option>
										<option value="2">I'm small.</option><!-- correcto -->
										<option value="3">I'm looking for a red one.</option>
									</select>
								</div>

								<div class="col-md-12">
									<select id="act6-s6">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Can i try it on?</option><!-- correcto -->
										<option value="2">Do you need those?</option>
										<option value="3">Anything else?</option>
									</select>
									<label for="act6-s6">Of course, try it.</label>
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta5 -->
							<div class="col-6">
								<div class="col-12">
									<strong>V-How can you explain the importance of dressing appropriately at and out of school?</strong>
								</div>
								
								<div class="col-md-12">
									<select id="act6-s7">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's not important to do it</option>
										<option value="2">It's important because the students represent the school and her values</option><!-- correcto -->
										<option value="3">It's important to dress correctly everywhere</option>
									</select>
								</div>
							</div>
							<!-- pregunta6 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VI-Why do you think that you must dress yourself appropriately both while in and out of school?</strong>
								</div>
								
								<div class="col-md-12">
									<select id="act6-s8">
										<option value="0" selected disabled>Choose</option>
										<option value="1">If I don't, I won't be able to get good grades</option>
										<option value="2">The way I dress compliments my academic training</option>
										<option value="3">I'm a representative of my school and I should wear my uniform correctly </option><!-- correcto -->
									</select>
								</div>
							</div>

							<div class="col-12"><br></div> <!-- espacio -->

							<!-- pregunta7 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VII-How can you verify if your home appliances satisfy your everyday needs?</strong>
								</div>
								
								<div class="col-md-12">
									<select id="act6-s9">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Because my home appliances are expensive</option>
										<option value="2">Because they help me to do my housework</option><!-- correcto -->
										<option value="3">Because they are from my favorite brand</option>
									</select>
								</div>
							</div>

							<!-- pregunta8 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VIII-What are some of the struggles identifying opportunities and create a new home appliance? (More than one option is possible)</strong>
								</div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox5" value="second_checkbox"><label for="cbox5">&nbsp;Color</label>
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox6" value="second_checkbox"><label for="cbox6">&nbsp;Size and space</label><!-- correcto -->
                                </div>
                                <div class = oracion>
                                    <input type="checkbox" id="cbox7" value="second_checkbox"><label for="cbox7">&nbsp;Energy efficiency</label><!-- correcto -->
                                </div>
								<div class = oracion>
                                    <input type="checkbox" id="cbox8" value="second_checkbox"><label for="cbox8">&nbsp;Lifestyle</label><!-- correcto -->
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

<!-- Actividad 7-->
<!-- Region 17-->
<div id="ModalLibroOcho17" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Identifiying vocabulary related to groceries and produce</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act7">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<h5>Read and identifiying vocabulary related to groceries and produce</h5>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points7" name="points7">
											<input type="text" class="d-none" id="idcliente7" name="idcliente7">
											<input type="text" class="d-none" id="idlibro7" name="idlibro7">
										</div>
									</div>

									<div class="row">
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej1.png"
												class="rounded mx-auto d-block">
												<select id="act7-q1" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A box of grapes</option>
													<option value="2">A pound of salt</option>
													<option value="3">A few watermelons</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej2.png"
												class="rounded mx-auto d-block">
												<select id="act7-q2" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A pound of sugar</option>
													<option value="2">A pound of salt</option>
													<option value="3">A bottle of orange juice</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej3.png"
												class="rounded mx-auto d-block">
												<select id="act7-q3" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A loaf of bread</option>
													<option value="2">A head of lettuce</option><!--correct-->
													<option value="3">A slice of ham</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej4.png"
												class="rounded mx-auto d-block">
												<select id="act7-q4" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A slice of ham</option>
													<option value="2">A loaf of bread</option>
													<option value="3">A pound of ground beef</option><!--correct-->
												</select>
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej5.png"
												class="rounded mx-auto d-block">
												<select id="act7-q5" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A crate of pineapples</option><!--correct-->
													<option value="2">A few watermelons</option>
													<option value="3">A box of grapes</option>
												</select>
											</div>
										</div>
									
										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej6.png"
												class="rounded mx-auto d-block">
												<select id="act7-q6" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A pound of salt</option>
													<option value="2">A bottle of orange juice</option>
													<option value="3">A pound of sugar</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej7.png"
												class="rounded mx-auto d-block">
												<select id="act7-q7" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A pound of sugar</option>
													<option value="2">A box of grapes</option>
													<option value="3">A pound of salt</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej8.png"
												class="rounded mx-auto d-block">
												<select id="act7-q8" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A crate of pineapples</option>
													<option value="2">A pound of sugar</option>
													<option value="3">A box of grapes</option><!--correct-->
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej9.png"
												class="rounded mx-auto d-block">
												<select id="act7-q9" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A slice of ham</option>
													<option value="2">A loaf of bread</option><!--correct-->
													<option value="3">A pound of ground beef</option>
												</select>
											</div>
										</div>

										<div class="col-3">								
											<div class="col">
												<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag17/act7-ej10.png"
												class="rounded mx-auto d-block">
												<select id="act7-q10" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A slice of ham</option><!--correct-->
													<option value="2">A pound of ground beef</option>
													<option value="3">A loaf of bread</option>
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
<!-- fin Actividad 7-->
<!-- fin Region 17-->

<!-- Actividad 8-->
<!-- Region 18-->
<div id="ModalLibroOcho18" class="modal fade" tabindex="-11">
	<!-- <div class="container-fluid"> -->
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Recognizing vocabulary related to groceries and produce</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form method="post" id="unit4-act8">
				<div class="modal-body">
					<div class="container-fluid">
						<div class="form-group">
							<!-- columna -->
							<div class="container-fluid">
								<div class="row align-items-center">
									<div class="row">
										<div class="col-md-8 align-items-center">
											<h5>Listen and recognize vocabulary related to groceries and produce</h5>
											<!-- class="d-none" -->
											<input type="text" class="d-none" id="points8" name="points8">
											<input type="text" class="d-none" id="idcliente8" name="idcliente8">
											<input type="text" class="d-none" id="idlibro8" name="idlibro8">
										</div>
									</div>

									<div class="row">
										<div class="col-6">								
											<img src="../../resources/img/BOOKS/EightGrade/UnitFour/Pag18/act8-ej8.png">
										</div>
										
										<div class="col-6">								
											<div class="col">
												<label for="act8-q1">1-</label>
												<select id="act8-q1" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A can of tuna</option><!--correct-->
													<option value="2">A bowl of soup</option>
													<option value="3">A gallon of milk</option>
												</select>
											</div>
											<br>
											<div class="col">
												<label for="act8-q2">2-</label>
												<select id="act8-q2" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A bowl of soup</option><!--correct-->
													<option value="2">A gallon of milk</option>
													<option value="3">A bag of rice</option>
												</select>
											</div>
											<br>
											<div class="col">
												<label for="act8-q3">3-</label>
												<select id="act8-q3" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A can of tuna</option>
													<option value="2">A bag of rice</option><!--correct-->
													<option value="3">A bottle of cream</option>
												</select>
											</div>
											<br>
											<div class="col">
												<label for="act8-q4">4-</label>
												<select id="act8-q4" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A gallon of milk</option>
													<option value="2">A bowl of soup</option>
													<option value="3">A bottle of cream</option><!--correct-->
												</select>
											</div>
											<br>
											<div class="col">
												<label for="act8-q5">5-</label>
												<select id="act8-q5" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A gallon of milk</option>
													<option value="2">A little bit of oil</option><!--correct-->
													<option value="3">A can of tuna</option>
												</select>
											</div>
											<br>
											<div class="col">
												<label for="act8-q6">6-</label>
												<select id="act8-q6" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">A bag of rice</option>
													<option value="2">A bowl of soup</option>
													<option value="3">A gallon of milk</option><!--correct-->
												</select>
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-12">
											<h5>Complete the sentences</h5>
											<div>
												I want to buy
												<select id="act8-q7" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a can of tuna</option><!--correct-->
													<option value="2">a gallon of milk</option>
													<option value="3">a bowl of soup</option>
												</select>
												and 
												<select id="act8-q8" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a little bit of oil</option>
													<option value="2">a gallon of milk</option>
													<option value="3">a bag of rice</option><!--correct-->
												</select>
											</div>
											<div>
												Katherine needs
												<select id="act8-q9" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a bowl of soup</option><!--correct-->
													<option value="2">a little bit of oil</option>
													<option value="3">a gallon of milk</option>
												</select>
												and
												<select id="act8-q10" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a bag of rice</option>
													<option value="2">a can of tuna</option>
													<option value="3">a gallon of milk</option><!--correct-->
												</select>
											</div>
											<div>
												My father buys
												<select id="act8-q11" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a can of tuna</option>
													<option value="2">a bag of rice</option>
													<option value="3">a bottle of cream</option><!--correct-->
												</select>
												and
												<select id="act8-q12" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a gallon of milk</option>
													<option value="2">a bag of rice</option>
													<option value="3">a little bit of oil</option><!--correct-->
												</select>
											</div>
											<div>
												My mother prefers to buy
												<select id="act8-q13" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a bowl of soup</option>
													<option value="2">a can of tuna</option><!--correct-->
													<option value="3">a bottle of cream</option>
												</select>
												and
												<select id="act8-q14" class="form-select" style="width:auto; display: inline-block;" >
													<option value="0" selected disabled class="text-muted">Choose</option>
													<option value="1">a little bit of oil</option>
													<option value="2">a gallon of milk</option>
													<option value="3">a bowl of soup</option><!--correct-->
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
<!-- fin Actividad 8-->
<!-- fin Region 18-->

<!-- Actividad 9-->
<!-- Region 19-->
<div id="ModalLibroOcho19" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers about prices using 'how much' and 'how many'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act9">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points9" name="points9">
                                <input type="text"  class="d-none" id="idlibro9" name="idlibro9">
								<input type="text"  class="d-none" id="idcliente9" name="idcliente9">
							</div>
						</div>

                        <div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act9-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option><!-- correcto -->
										<option value="2">How many</option>
									</select>
									are four apples? 
								</div>
								<div class="col-10">
									<select id="act9-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">They are two apples</option>
										<option value="2">You can have two apples</option>
										<option value="3">They are two dollars</option><!-- correcto -->
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act9-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option><!-- correcto -->
										<option value="2">How many</option>
									</select>
									is that hat?
								</div>
								<div class="col-10">
									<select id="act9-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's twenty five dollars</option><!-- correcto -->
										<option value="2">Yes, it is on sale</option>
										<option value="3">They are two dollars</option>
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act9-q5">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option>
										<option value="2">How many</option><!-- correcto -->
									</select>
									bags of rice can I buy with five dollars?
								</div>
								<div class="col-10">
									<select id="act9-q6">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's two dollars</option>
										<option value="2">You can have two bags</option><!-- correcto -->
										<option value="3">You can have two dollars</option>
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act9-q7">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option><!-- correcto -->
										<option value="2">How many</option>
									</select>
									is a bottle of cream?
								</div>
								<div class="col-10">
									<select id="act9-q8">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's a dollar</option><!-- correcto -->
										<option value="2">You can have one bottle</option>
										<option value="3">They are a dollar</option>
									</select>
								</div>
							</div>
							<br>
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
<!-- fin Actividad 9-->
<!-- fin Region 19-->

<!-- Actividad 10-->
<!-- Region 20-->
<div id="ModalLibroOcho20" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers using 'how much' and 'how many'</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act10">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points10" name="points10">
                                <input type="text"  class="d-none" id="idlibro10" name="idlibro10">
								<input type="text"  class="d-none" id="idcliente10" name="idcliente10">
							</div>
						</div>

                        <div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act10-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option><!-- correcto -->
										<option value="2">How many</option>
									</select>
									does a pizza cost?
								</div>
								<div class="col-10">
									<select id="act10-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's five dollars</option><!-- correcto -->
										<option value="2">You can have a pizza</option>
										<option value="3">It's five pizzas</option>
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act10-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option>
										<option value="2">How many</option><!-- correcto -->
									</select>
									soccer balls do you need?
								</div>
								<div class="col-10">
									<select id="act10-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Four balls, please</option><!-- correcto -->
										<option value="2">Two dollars</option>
										<option value="3">It's four dollars</option>
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act10-q5">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option>
										<option value="2">How many</option><!-- correcto -->
									</select>
									bags do you have?
								</div>
								<div class="col-10">
									<select id="act10-q6">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's five dollars</option>
										<option value="2">I have five bags</option><!-- correcto -->
										<option value="3">You can have five dollars</option>
									</select>
								</div>
							</div>
							<br>
						</div>

						<div class="border">
							<br>
							<div class="row justify-content-center">
								<div class="col-10">
									<select id="act10-q7">
										<option value="0" selected disabled>Choose</option>
										<option value="1">How much</option><!-- correcto -->
										<option value="2">How many</option>
									</select>
									pineapple juice is left?
								</div>
								<div class="col-10">
									<select id="act10-q8">
										<option value="0" selected disabled>Choose</option>
										<option value="1">It's two dollars</option>
										<option value="2">You can have two bottle</option>
										<option value="3">Three bottles left</option><!-- correcto -->
									</select>
								</div>
							</div>
							<br>
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
<!-- fin Actividad 10-->
<!-- fin Region 20-->

<!-- Actividad 11-->
<!-- Region 21-->
<div id="ModalLibroOcho21" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers using vocabulary and key words</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act11">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points11" name="points11">
                                <input type="text"  class="d-none" id="idlibro11" name="idlibro11">
								<input type="text"  class="d-none" id="idcliente11" name="idcliente11">
							</div>
						</div>

                        <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act11-q1">Can I help you?</label>
								<select id="act11-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Sure, there is bread</option>
									<option value="2">It's five dollars</option>
									<option value="3">I would like a bottle of orange juice</option><!-- correcto -->
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select id="act11-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Is there any sugar?</option>
									<option value="2">How can I help you?</option>
									<option value="3">Is there any bread?</option><!-- correcto -->
								</select>
								<label for="act11-q2">Sure, there is bread</label>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act11-q3">How many loaf of bread can I buy with five dollars?</label>
								<select id="act11-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">Yes, there are</option>
									<option value="2">Five loaf of bread</option><!-- correcto -->
									<option value="3">Yes, we do</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select id="act11-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">What else do you need?</option><!-- correcto -->
									<option value="2">How much is it?</option>
									<option value="3">Are there any apples?</option>
								</select>
								<label for="act11-q4">That's all. Thank you</label>
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
<!-- fin Actividad 11-->
<!-- fin Region 21-->

<!-- Actividad 12 pendiente de controller y respuestas-->
<!-- Region 22-->
<div id="ModalLibroOcho22" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete these activities and measure your archievements!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act12">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points12" name="points12">
                                <input type="text"  class="d-none" id="idlibro12" name="idlibro12">
								<input type="text"  class="d-none" id="idcliente12" name="idcliente12">
							</div>
						</div>

						<div class="row">
							<!-- pregunta1 -->
                            <div class="col-6">
								<div class="col-12">
									<strong>I-When do we use 'how many'?</strong>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act12-q1" id="act12-r1">
									<label class="form-check-label" for="act12-r1">
										Answer 1
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act12-q1" id="act12-r2"><!-- correcto -->
									<label class="form-check-label" for="act12-r2">
										Answer 2
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act12-q1" id="act12-r3">
									<label class="form-check-label" for="act12-r3">
										Answer 3
									</label>
								</div>
							</div>
							<!-- pregunta2 -->
							<div class="col-6">
								<div class="col-12">
									<strong>II-When do we use 'how much'?</strong>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r4"><!-- correcto -->
									<label class="form-check-label" for="act6-r4">
										Answer 1
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r5">
									<label class="form-check-label" for="act6-r5">
										Answer 2
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="act6-q2" id="act6-r6">
									<label class="form-check-label" for="act6-r6">
										Answer 3
									</label>
								</div>
							</div>
							<!-- pregunta3 -->
							<div class="col-6">
								<div class="col-12">
									<strong>III-Select questions and answers about prices using 'how much' and 'how many'</strong>
								</div>

								<div class="col-md-12">
									<label for="act6-q1">question?</label>
									<select name="act6-q1" id="act6-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer.</option><!-- correcto -->
										<option value="2">Answer.</option>
										<option value="3">Answer.</option>
									</select>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q2" id="act6-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">question?</option><!-- correcto -->
										<option value="2">question?</option>
										<option value="3">question?</option>
									</select>
									<label for="act6-q2">Answer.</label>
								</div>

								<div class="col-md-12">
									<label for="act6-q3">question?</label>
									<select name="act6-q3" id="act6-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer.</option>
										<option value="2">IAnswer.</option><!-- correcto -->
										<option value="3">Answer.</option>
									</select>
								</div>

								<div class="col-md-12">
									<select name="act6-q4" id="act6-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">question?</option><!-- correcto -->
										<option value="2">question?</option>
										<option value="3">question?</option>
									</select>
									<label for="act6-q4">Answer.</label>
								</div>
								
							</div>
							<!-- pregunta4 -->
							<div class="col-6">
								<div class="col-12">
									<strong>IV-Select questions and answers using vocabulary and key words about groceries</strong>
								</div>
								
								<div class="col-md-12">
									<label for="act6-q1">question?</label>
									<select name="act6-q1" id="act6-q1">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer.</option><!-- correcto -->
										<option value="2">Answer.</option>
										<option value="3">Answer.</option>
									</select>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q2" id="act6-q2">
										<option value="0" selected disabled>Choose</option>
										<option value="1">question?</option><!-- correcto -->
										<option value="2">question?</option>
										<option value="3">question?</option>
									</select>
									<label for="act6-q2">Answer.</label>
								</div>

								<div class="col-md-12">
									<label for="act6-q3">question?</label>
									<select name="act6-q3" id="act6-q3">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer.</option>
										<option value="2">IAnswer.</option><!-- correcto -->
										<option value="3">Answer.</option>
									</select>
								</div>

								<div class="col-md-12">
									<select name="act6-q4" id="act6-q4">
										<option value="0" selected disabled>Choose</option>
										<option value="1">question?</option><!-- correcto -->
										<option value="2">question?</option>
										<option value="3">question?</option>
									</select>
									<label for="act6-q4">Answer.</label>
								</div>

							</div>
							<!-- pregunta5 -->
							<div class="col-6">
								<div class="col-12">
									<strong>V-How can you show the health conscious and earth friendly side?</strong>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q5" id="act6-q5">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer</option>
										<option value="2">Answer</option><!-- correcto -->
										<option value="3">Answer</option>
									</select>
								</div>
							</div>
							<!-- pregunta6 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VI-Can you explain why respect is the first positive step in building a relationship?</strong>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q6" id="act6-q6">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer</option>
										<option value="2">Answer</option>
										<option value="3">Answer</option><!-- correcto -->
									</select>
								</div>
							</div>

							<!-- pregunta7 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VII-How can you verify that you purchase healthy and enviroment-friendly foods and items?</strong>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q7" id="act6-q7">
										<option value="0" selected disabled>Choose</option>
										<option value="1">Answer</option>
										<option value="2">Answer</option><!-- correcto -->
										<option value="3">Answer</option>
									</select>
								</div>
							</div>

							<!-- pregunta8 -->
							<div class="col-6">
								<div class="col-12">
									<strong>VIII-Are you able to explore which foods and items are healthy and enviroment-friendly?</strong>
								</div>
								
								<div class="col-md-12">
									<select name="act6-q8" id="act6-q8">
										<option value="0" selected disabled>Choose</option>
										<option value="1">answer1</option>
										<option value="2">answer2</option><!-- correcto -->
										<option value="3">answer3</option>
									</select>
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
<!-- fin Actividad 12-->
<!-- fin Region 22-->

<!-- Actividad 13 pendiente de agregar respuestas--> 
<!-- Region 23-->
<div id="ModalLibroOcho23" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Select the correct questions and answers using prices up to $1,000.00</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="unit4-act13">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="points13" name="points13">
                                <input type="text"  class="d-none" id="idlibro13" name="idlibro13">
								<input type="text"  class="d-none" id="idcliente13" name="idcliente13">
							</div>
						</div>

                        <div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act13-q1">question?</label>
								<select id="act13-q1">
									<option value="0" selected disabled>Choose</option>
									<option value="1">answer</option>
									<option value="2">answer correct</option><!-- correcto -->
									<option value="3">answer</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select id="act13-q2">
									<option value="0" selected disabled>Choose</option>
									<option value="1">question? correct</option><!-- correcto -->
									<option value="2">question?</option>
									<option value="3">question?</option>
								</select>
								<label for="act13-q2">answer</label>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<label for="act13-q3">question?</label>
								<select id="act13-q3">
									<option value="0" selected disabled>Choose</option>
									<option value="1">answer</option>
									<option value="2">answer correct</option><!-- correcto -->
									<option value="3">answer</option>
								</select>
							</div>
						</div>

						<div class="row border box-select-5">
							<div class="col-md-12">
								<select id="act13-q4">
									<option value="0" selected disabled>Choose</option>
									<option value="1">question? correct</option><!-- correcto -->
									<option value="2">question?</option>
									<option value="3">question?</option>
								</select>
								<label for="act13-q4">answer</label>
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
<!-- fin Actividad 13-->
<!-- fin Region 23-->


<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
	// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
	Book_Page::footerTemplate('controladorlibro8_u4.js');
?>