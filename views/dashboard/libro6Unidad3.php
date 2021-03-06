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
            '../../app/controllers/unidadtressextogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'
        ],
        complete: loadApp
    });
</script>

<!--Espacio para modal -->

<!-- Pagina Libro 91-->
<!-- Region   18-regions.json-->
<div id="ModalLibroSeis91" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review My City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-91">
                <div class="modal-body">
                    <!-- Inicio de modal body-->
                    <div class="row">
                        <div class="col-md-8 align-items-center" align="letf">
                            <p class="libro6-indicaciones"><b>My City Word Search</b><br> Can you find the words hidden in the box? <br> They may be horizontal, vertical or diagonal <br></p>
                            <!-- class="d-none" -->
                            <input type="text" class="d-none" id="points91" name="points91">
                            <input type="text" class="d-none" id="idcliente91" name="idcliente91">
                            <input type="text" class="d-none" id="idlibro91" name="idlibro91">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 align-items-center">
                            <div class="crucigrama-juego">
                                <div id="words" class=""></div>
                                <div id="puzzle" class="crucigrama-color-pag91"></div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 align-items-center" align="letf">
                            <div class="crucigrama-palabras crucigrama-pag91">
                                <ul>
                                    <ul id="words">
                                        <li id="add-word">
                                            <div id="add-word"></div>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                            <div>

                            </div>

                        </div>
                    </div>
                    <!--Modal Body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-tooltip="Guardar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Pagina Libro 109-->
<!-- Region   109-regions.json-->
<div id="ModalLibroSeis109" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review My City Words</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-109">
                <div class="modal-body">
                    <!-- Inicio de modal body-->
                    <div class="row">
                        <div class="col-md-8 align-items-center" align="letf">
                            <p class="libro6-indicaciones"><b>My City Word Search</b><br>Can you find and circle the words hidden in the box? <br>They may be horizontal, vertical or diagonal. <br></p>
                            <!-- class="d-none" -->
                            <input type="text" class="d-none" id="points109" name="points109">
                            <input type="text" class="d-none" id="idcliente109" name="idcliente109">
                            <input type="text" class="d-none" id="idlibro109" name="idlibro109">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 align-items-center">
                            <div class="crucigrama-juego">
                                <div id="words-36" class=""></div>
                                <div id="puzzle-36" class="crucigrama-color-pag109"></div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 align-items-center" align="letf">
                            <div class="crucigrama-palabras crucigrama-pag109">
                                <ul>
                                    <ul id="words-36">
                                        <li id="add-word-36">
                                            <div id="add-word-36"></div>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                            <div>

                            </div>

                        </div>
                    </div>
                    <!--Modal Body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-tooltip="Guardar">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate6('controladorlibro6_u3.js');
?>