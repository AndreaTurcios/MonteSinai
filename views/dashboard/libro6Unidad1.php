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

            pages: 48,

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
        both: ['../../resources/js/turnjs4/samples/magazine/css/magazine.css', '../../app/controllers/unidadunosextogrado.js', '../../resources/js/turnjs4/lib/zoom.min.js'],
        complete: loadApp
    });
</script>

<!--Espacio para modal -->
<!-- Pagina Libro 3-->
<!-- Region   12-regions.json-->
<div id="ModalLibroSeis3" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">New Year's Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-3">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points3" name="points3">
                                <input type="text" class="d-none" id="idcliente3" name="idcliente3">
                                <input type="text" class="d-none" id="idlibro3" name="idlibro3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. What do you mean by merriment?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-3-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. What’s the meaning of slate?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-3-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. What’s a resolution?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-3-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. When is celebrated New Year’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-3-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. Do you enjoy making New Year’s resolutions?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-3-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 4-->
<!-- Region   13-regions.json-->
<div id="ModalLibroSeis4" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Valentine's Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-4">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points4" name="points4">
                                <input type="text" class="d-none" id="idcliente4" name="idcliente4">
                                <input type="text" class="d-none" id="idlibro4" name="idlibro4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is Valentine’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-4-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. What do people do on that day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-4-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. Who is Cupid?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-4-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. Can you tell me the common symbols of Valentine’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-4-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What is the Meaning of winged?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-4-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 5-->
<!-- Region   14-regions.json-->
<div id="ModalLibroSeis5" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Holy Week</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-5">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points5" name="points5">
                                <input type="text" class="d-none" id="idcliente5" name="idcliente5">
                                <input type="text" class="d-none" id="idlibro5" name="idlibro5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. What is Holy Week?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-5-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. What is Lent?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-5-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. What do Christians remember on Good Friday?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-5-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. What does Maundy Thursday mean?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-5-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you do on Easter Sunday?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-5-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 6-->
<!-- Region   15-regions.json-->
<div id="ModalLibroSeis6" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Labor Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-6">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points6" name="points6">
                                <input type="text" class="d-none" id="idcliente6" name="idcliente6">
                                <input type="text" class="d-none" id="idlibro6" name="idlibro6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is Labor Day for American workers?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-6-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. When is Labor Day in your country?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-6-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. How is also known May Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-6-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. What is a parade?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-6-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you think about Labor Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-6-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 7-->
<!-- Region   16-regions.json-->
<div id="ModalLibroSeis7" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Day of The Cross</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-7">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points7" name="points7">
                                <input type="text" class="d-none" id="idcliente7" name="idcliente7">
                                <input type="text" class="d-none" id="idlibro7" name="idlibro7">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. What is celebrated on May 3rd?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-7-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. How do Mexicans celebrate that day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-7-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. When is Day of the Cross in El Salvador?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-7-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. Do you enjoy the Day of the Cross?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-7-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. Can you tell me why?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-7-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 8-->
<!-- Region   17-regions.json-->
<div id="ModalLibroSeis8" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Mother's Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-8">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points8" name="points8">
                                <input type="text" class="d-none" id="idcliente8" name="idcliente8">
                                <input type="text" class="d-none" id="idlibro8" name="idlibro8">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is Mother’s Day in your country?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-8-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. When is Mother’s Day in Canada?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-8-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. Can you tell me one way to celebrate it?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-8-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. Do Chinese celebrate Mother’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-8-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you do for Mother’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-8-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 9-->
<!-- Region   18-regions.json-->
<div id="ModalLibroSeis9" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Father's Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-9">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points9" name="points9">
                                <input type="text" class="d-none" id="idcliente9" name="idcliente9">
                                <input type="text" class="d-none" id="idlibro9" name="idlibro9">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is Father’s Day in El Salvador and Guatemala?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-9-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. Who is a Daddy?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-9-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. When was inaugurated Father’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-9-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. What is fatherhood?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-9-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you do for Father’s Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-9-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 10 -->
<!-- Region   19-regions.json-->
<div id="ModalLibroSeis10" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Teacher's Day (Poem)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-10">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 11 -->
<!-- Region   20-regions.json-->
<div id="ModalLibroSeis11" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Independence Day In Central America</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-11">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points11" name="points11">
                                <input type="text" class="d-none" id="idcliente11" name="idcliente11">
                                <input type="text" class="d-none" id="idlibro11" name="idlibro11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When was the independence in Central America?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-11-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. Can you tell me of what consisted the Spanish colony?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-11-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. How many years did Spain rule?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-11-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. What is anthem?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-11-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. Do you enjoy independence time?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-11-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 12-->
<!-- Region   21-regions.json-->
<div id="ModalLibroSeis12" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Columbus Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-12">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points12" name="points12">
                                <input type="text" class="d-none" id="idcliente12" name="idcliente12">
                                <input type="text" class="d-none" id="idlibro12" name="idlibro12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is Columbus Day in your country?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-12-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. What did Columbus and his contemporaries assume?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-12-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. Can you tell me another name for Columbus Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-12-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. When did Columbus land in America?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-12-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you think about Columbus Day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-12-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 13-->
<!-- Region   22-regions.json-->
<div id="ModalLibroSeis13" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">All Soul's Day</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-13">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points13" name="points13">
                                <input type="text" class="d-none" id="idcliente13" name="idcliente13">
                                <input type="text" class="d-none" id="idlibro13" name="idlibro13">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. When is All Souls’ Day in your country?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-13-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. How is All Souls’ Day in the United States?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-13-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. What is customary in El Salvador?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-13-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. What is tomb?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-13-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What do you do that day?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-13-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 14-->
<!-- Region   23-regions.json-->
<div id="ModalLibroSeis14" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Christmas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-14">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="modal-body">
                            <!-- Inicio de modal body-->
                            <div class="row">
                                <div class="col-md-8 align-items-center" align="letf">
                                    <p class="fs-1 fw-bold">Answer these questions.</p>
                                    <!-- class="d-none" -->
                                    <input type="text" class="d-none" id="points14" name="points14">
                                    <input type="text" class="d-none" id="idcliente14" name="idcliente14">
                                    <input type="text" class="d-none" id="idlibro14" name="idlibro14">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">1. When is Christmas Day?</label>
                                        <input type="text" class="form-control" placeholder="" id="game-14-q1">
                                    </div>
                                    <div class="form-group">
                                        <label for="">2. How is Christmas celebrated in your country?</label>
                                        <input type="text" class="form-control" placeholder="" id="game-14-q2">
                                    </div>
                                    <div class="form-group">
                                        <label for="">3. What is celebrated in El Salvador on December 24th?</label>
                                        <input type="text" class="form-control" placeholder="" id="game-14-q3">
                                    </div>
                                    <div class="form-group">
                                        <label for="">4. What do you commemorate on Christmas Eve?</label>
                                        <input type="text" class="form-control" placeholder="" id="game-14-q4">
                                    </div>
                                    <div class="form-group">
                                        <label for="">5. Do you enjoy Christmas time?</label>
                                        <input type="text" class="form-control" placeholder="" id="game-14-q5">
                                    </div>
                                </div>
                            </div>
                            <!--Modal Body -->
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

<!-- Pagina Libro 15-->
<!-- Region   24-regions.json-->
<div id="ModalLibroSeis15" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Ordinal Numbers From 1st To 25th</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-15">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 align-items-center" align="letf">
                            <p class="fs-1 fw-bold">Compare the short and the long form. Match the long with the short form of the ordinal numbers.</p>
                            <!-- class="d-none" -->
                            <input type="text" class="d-none" id="points15" name="points15">
                            <input type="text" class="d-none" id="idcliente15" name="idcliente15">
                            <input type="text" class="d-none" id="idlibro15" name="idlibro15">
                        </div>
                    </div>
                    <!-- Inicio de modal body-->
                    <div class="libro6-padre">
                        <div class="libro6-hijo">
                            <div class="text-center">fifth</div>
                            <div id="game-15-num1" class="libro6-placeholder" data-id2="hola"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">tenth</div>
                            <div id="game-15-num2" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">eleventh</div>
                            <div id="game-15-num3" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">nineteenth</div>
                            <div id="game-15-num4" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">ninth</div>
                            <div id="game-15-num5" class="libro6-placeholder"></div>
                        </div>
                    </div>
                    <div id="padre2" class="libro6-padre2">
                        <div id="game-15-num-1" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="10th">
                            10th
                        </div>
                        <div id="game-15-num-2" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="5th">
                            5th
                        </div>
                        <div id="game-15-num-3" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="19th">
                            19th
                        </div>
                        <div id="game-15-num-4" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="9th">
                            9th
                        </div>
                        <div id="game-15-num-5" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="11th">
                            11th
                        </div>

                        <div class="contenedor0 libro6-hijo2">
                        </div>
                    </div>

                    <div class="libro6-padre">
                        <div class="libro6-hijo">
                            <div class="text-center">first</div>
                            <div id="game-15-num6" class="libro6-placeholder" data-id2="hola"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">thirteenth</div>
                            <div id="game-15-num7" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">twenty-fifth</div>
                            <div id="game-15-num8" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">twenty-third</div>
                            <div id="game-15-num9" class="libro6-placeholder"></div>
                        </div>
                        <div class="libro6-hijo">
                            <div class="text-center">seventh</div>
                            <div id="game-15-num10" class="libro6-placeholder"></div>
                        </div>
                    </div>
                    <div id="padre3" class="libro6-padre2">
                        <div id="game-15-num-6" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="25th">
                            25th
                        </div>
                        <div id="game-15-num-7" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="13th">
                            13th
                        </div>
                        <div id="game-15-num-8" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="1st">
                            1st
                        </div>
                        <div id="game-15-num-9" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="7th">
                            7th
                        </div>
                        <div id="game-15-num-10" class="libro6-contenedor libro6-hijo2" draggable="true" data-id="23th">
                            23rd
                        </div>

                        <div class="contenedor0 libro6-hijo2">
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

<!-- Pagina Libro 16-->
<!-- Region   25-regions.json-->
<div id="ModalLibroSeis16" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Cardinal Numbers From 101 to 150</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-16">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 17-->
<!-- Region   26-regions.json-->
<div id="ModalLibroSeis17" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review Holidays And Celebrations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-17">
                <div class="modal-body">
                    <!-- Inicio de modal body-->
                    <div class="row">
                        <div class="col-md-8 align-items-center" align="letf">
                            <p class="fs-1 fw-bold">Find the words</p>
                            <!-- class="d-none" -->
                            <input type="text" class="d-none" id="points17" name="points17">
                            <input type="text" class="d-none" id="idcliente17" name="idcliente17">
                            <input type="text" class="d-none" id="idlibro17" name="idlibro17">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 align-items-center">
                            <div id="words"></div>
                            <div id="puzzle"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 align-items-center" align="letf">
                            <ul id="words">
                                <li id="add-word">
                                    <div id="add-word"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Modal Body -->
                </div>
                <br>
                <!-- Botones de Control -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="bottom-game-17" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button>
                    <br>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Pagina Libro 18-->
<!-- Region   27-regions.json-->
<div id="ModalLibroSeis18" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review Ordinal And Cardinal Numbers</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-18">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 20-->
<!-- Region   29-regions.json-->
<div id="ModalLibroSeis20" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Places To Visit In Vacataion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-20">
                <div class="modal-body">
                    <div class="container-fluid">
                        <!-- Inicio de modal body-->
                        <div class="row">
                            <div class="col-md-8 align-items-center" align="letf">
                                <p class="fs-1 fw-bold">Answer these questions.</p>
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="points20" name="points20">
                                <input type="text" class="d-none" id="idcliente20" name="idcliente20">
                                <input type="text" class="d-none" id="idlibro20" name="idlibro20">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">1. Where can you have a view of Christ the Redeemer?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-20-q1">
                                </div>
                                <div class="form-group">
                                    <label for="">2. What is the Suchitlan Lake?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-20-q2">
                                </div>
                                <div class="form-group">
                                    <label for="">3. What is Planetarium?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-20-q3">
                                </div>
                                <div class="form-group">
                                    <label for="">4. Can you tell me the former capital of the Inca Empire?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-20-q4">
                                </div>
                                <div class="form-group">
                                    <label for="">5. What can you see in Costa Rica?</label>
                                    <input type="text" class="form-control" placeholder="" id="game-20-q5">
                                </div>
                            </div>
                        </div>
                        <!--Modal Body -->
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

<!-- Pagina Libro 21-->
<!-- Region   30-regions.json-->
<div id="ModalLibroSeis21" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Subject Pronouns</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-21">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 22-->
<!-- Region   31-regions.json-->
<div id="ModalLibroSeis22" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Present Simple</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-22">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 23-->
<!-- Region   32-regions.json-->
<div id="ModalLibroSeis23" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Verb To Be In Present Simple And Past Tense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-23">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 24-->
<!-- Region   33-regions.json-->
<div id="ModalLibroSeis24" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Talking About The Weather</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-24">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 25-->
<!-- Region   34-regions.json-->
<div id="ModalLibroSeis25" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Irregular Verbs In Simple Past</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-25">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 26-->
<!-- Region   35-regions.json-->
<div id="ModalLibroSeis26" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Talking About The Past Tense</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-26">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 27-->
<!-- Region   36-regions.json-->
<div id="ModalLibroSeis27" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Using Adjective</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-27">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 28-->
<!-- Region   37-regions.json-->
<div id="ModalLibroSeis28" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Months of The Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-28">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 29-->
<!-- Region   38-regions.json-->
<div id="ModalLibroSeis29" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Expresing Likes And Dislikes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-29">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 30-->
<!-- Region   39-regions.json-->
<div id="ModalLibroSeis30" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Present Continuous Use</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-30">
                <div class="modal-body">
                    <div class="container-fluid">

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


<!-- Pagina Libro 31-->
<!-- Region   40-regions.json-->
<div id="ModalLibroSeis31" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Imperatives</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-31">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 32-->
<!-- Region   41-regions.json-->
<div id="ModalLibroSeis32" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Present Perfect Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-32">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 33-->
<!-- Region   42-regions.json-->
<div id="ModalLibroSeis33" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Riddles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-33">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 34-->
<!-- Region   43-regions.json-->
<div id="ModalLibroSeis34" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Sing a Song: Bingo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-34">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 35-->
<!-- Region   44-regions.json-->
<div id="ModalLibroSeis35" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review Places, Subject Pronouns And Verbs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-35">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro 36-->
<!-- Region   45-regions.json-->
<div id="ModalLibroSeis36" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Let's Review Adjectives, Weather and the Months</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-36">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- Pagina Libro -->
<!-- Region   -regions.json-->
<div id="ModalLibroSeis" class="modal fade" tabindex="-2">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Aqui</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-">
                <div class="modal-body">
                    <div class="container-fluid">

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

<!-- --------------------------------- inicio plantilla footer  ---------------------------------	 -->
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Book_Page::footerTemplate6('controladorlibro6.js');
?>