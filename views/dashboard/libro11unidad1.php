<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/book_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Book_Page::headerTemplate('Unidad 1');
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

        pages: 35,

        // Events

        when: {
            turning: function(event, page, view) {

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
    both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css',
        '../../app/controllers/unidadunooncegrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'
    ],
    complete: loadApp
});
</script>

<div id="ModalLibroUno" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Write questions and answers about the biography</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-one">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="pointsL11" name="pointsL11">
                                <input type="text"  class="d-none" id="idlibroL11" name="idlibroL11">
								<input type="text"  class="d-none" id="idclienteL11" name="idclienteL11">
							</div>
						</div>
                        <div class="row">
                            <div class="col-6">
								<div class="pregunta">
									<h5>Question 1</h5>
									<input id="q1"type="text" style="width:450px">
								</div>
								<div class="pregunta">
									<h5>Question 2</h5>
									<input id="q2" type="text" style="width:450px">
								</div>
								<div class="pregunta">
									<h5>Question 3</h5>
									<input id="q3" type="text" style="width:450px">
								</div>
							</div>
							<div class="col-6">
								<div class="respuesta">
									<h5>Answer 1</h5>
									<input id="a1" type="text">
								</div>
								<div class="respuesta">
									<h5>Answer 2</h5>
									<input id="a2" type="text">
								</div>
								<div class="respuesta">
									<h5>Answer 3</h5>
									<input id="a3" type="text">
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

<div id="ModalLibroDos" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Write question and answers expressing thoughts about famous people.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-two">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
							<div class="col-md-8 align-items-center">
								<!-- class="d-none" -->
								<input type="text"  class="d-none" id="pointsA2U1L11" name="pointsA2U1L11">
                                <input type="text"  class="d-none" id="idlibroA2U1L11" name="idlibroA2U1L11">
								<input type="text"  class="d-none" id="idclienteA2U1L11" name="idclienteA2U1L11">
							</div>
						</div>
                        <div class="row">
                            <div class="col-6">
								<div class="pregunta">
									<h5>Question 1</h5>
									<input id="p1"type="text" style = "width:60%">
								</div>
								<div class="pregunta">
									<h5>Question 2</h5>
									<input id="p2" type="text" style = "width:60%">
								</div>
								<div class="pregunta">
									<h5>Question 3</h5>
									<input id="p3" type="text" style = "width:60%">
								</div>
                                <div class="pregunta">
									<h5>Question 4</h5>
									<input id="p4" type="text" style = "width:60%">
								</div>
							</div>
							<div class="col-6">
								<div class="respuesta">
									<h5>Answer 1</h5>
									<input id="r1" type="text" style = "width:60%">
								</div>
								<div class="respuesta">
									<h5>Answer 2</h5>
									<input id="r2" type="text" style = "width:60%">
								</div>
								<div class="respuesta">
									<h5>Answer 3</h5>
									<input id="r3" type="text" style = "width:60%">
								</div>
                                <div class="respuesta">
									<h5>Answer 4</h5>
									<input id="r4" type="text" style = "width:60%">
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


<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate('controladorlibro11.js');
?>