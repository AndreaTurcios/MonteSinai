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
                <h5 class="modal-title" id="modal-title">Complete the activity - Write questions and answers about the
                    biography</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-one">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsL11" name="pointsL11">
                                <input type="text" class="d-none" id="idlibroL11" name="idlibroL11">
                                <input type="text" class="d-none" id="idclienteL11" name="idclienteL11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="pregunta">
                                    <h5>Question 1</h5>
                                    <input id="q1" type="text" style="width:450px">
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
                <h5 class="modal-title" id="modal-title">Complete the activity - Write question and answers expressing
                    thoughts about famous people.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-two">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA2U1L11" name="pointsA2U1L11">
                                <input type="text" class="d-none" id="idlibroA2U1L11" name="idlibroA2U1L11">
                                <input type="text" class="d-none" id="idclienteA2U1L11" name="idclienteA2U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="pregunta">
                                    <h5>Question 1</h5>
                                    <input id="p1" type="text" style="width:60%">
                                </div>
                                <div class="pregunta">
                                    <h5>Question 2</h5>
                                    <input id="p2" type="text" style="width:60%">
                                </div>
                                <div class="pregunta">
                                    <h5>Question 3</h5>
                                    <input id="p3" type="text" style="width:60%">
                                </div>
                                <div class="pregunta">
                                    <h5>Question 4</h5>
                                    <input id="p4" type="text" style="width:60%">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="respuesta">
                                    <h5>Answer 1</h5>
                                    <input id="r1" type="text" style="width:60%">
                                </div>
                                <div class="respuesta">
                                    <h5>Answer 2</h5>
                                    <input id="r2" type="text" style="width:60%">
                                </div>
                                <div class="respuesta">
                                    <h5>Answer 3</h5>
                                    <input id="r3" type="text" style="width:60%">
                                </div>
                                <div class="respuesta">
                                    <h5>Answer 4</h5>
                                    <input id="r4" type="text" style="width:60%">
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

<div id="ModalLibroTres" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Select the correct sentences using
                    clauses in the past (Only choose four)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-three">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA3U1L11" name="pointsA3U1L11">
                                <input type="text" class="d-none" id="idlibroA3U1L11" name="idlibroA3U1L11">
                                <input type="text" class="d-none" id="idclienteA3U1L11" name="idclienteA3U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class=oracion>
                                    <input type="checkbox" id="cbox1" value="second_checkbox"><label for="cbox1"> While
                                        I was reading, he was watching tv</label>
                                </div>
                                <div class=oracion>
                                    <input type="checkbox" id="cbox2" value="second_checkbox"><label for="cbox2"> Before
                                        I was singing, he was cleaning the house</label>
                                </div>
                                <div class=oracion>
                                    <input type="checkbox" id="cbox3" value="second_checkbox"><label for="cbox3"> He
                                        could get a new job if he really tried</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=oracion>
                                    <input type="checkbox" id="cbox4" value="second_checkbox"><label for="cbox4"> If I
                                        had got the job, we might be living in Paris now</label>
                                </div>
                                <div class=oracion>
                                    <input type="checkbox" id="cbox5" value="second_checkbox"><label for="cbox5"> Right
                                        after his death, she learned Spanish</label>
                                </div>
                                <div class=oracion>
                                    <input type="checkbox" id="cbox6" value="second_checkbox"><label for="cbox6"> Daniel
                                        has created a book of history</label>
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

<div id="ModalLibroCuatro" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Select the sentence related to the
                    paragraph</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-four">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA4U1L11" name="pointsA4U1L11">
                                <input type="text" class="d-none" id="idlibroA4U1L11" name="idlibroA4U1L11">
                                <input type="text" class="d-none" id="idclienteA4U1L11" name="idclienteA4U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="sentences">Choose an option:</label>
                                <select name="sentences" id="sentences">
                                    <option value="1">There are still people missing, and as night fell, family members gathered at a hotel over the road</option>
                                    <option value="2">The central-eastern city of Kremenchuk is located about 130km (81 miles) from Russian areas of control.</option>
                                    <option value="3">Technology has significantly transformed education at several major turning points in our history</option>
                                    <option value="4">The missile strike took place as the leaders of Canada</option>
                                </select>
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

<div id="ModalLibroSeis" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Solve doubts about the content of the page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-six">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA6U1L11" name="pointsA6U1L11">
                                <input type="text" class="d-none" id="idlibroA6U1L11" name="idlibroA6U1L11">
                                <input type="text" class="d-none" id="idclienteA6U1L11" name="idclienteA6U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>Where did Christopher Columbus land in the Americas</h5>
                                <select name="sentences" id="sent1">
                                    <option value="1">In the Caribbean</option>
                                    <option value="2">In Central America</option>
                                    <option value="3">In the Bahamas</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>In which year was Cristopher Columbus born?</h5>
                                <select name="sentences" id="sent2">
                                    <option value="1">1456</option>
                                    <option value="2">1451</option>
                                    <option value="3">1444</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>The following are examples of famous peoples's lives and accomplishments:</h5>
                                <select name="sentences" id="sent3">
                                    <option value="1">Good personality and respectful</option>
                                    <option value="2">Comfortable life and worldwide recognition</option>
                                    <option value="3">Cars, big house, and a lot of money</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>Achieved celebrity refers to:</h5>
                                <select name="sentences" id="sent4">
                                    <option value="1">People who attain intense bursts of fame</option>
                                    <option value="2">Social impact that derives from recognized talents and accomplishments</option>
                                    <option value="3">Anybody that has reached the top of fame</option>
                                </select>
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

<div id="ModalLibroSiete" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Interviewing celebrities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-seven">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA7U1L11" name="pointsA7U1L11">
                                <input type="text" class="d-none" id="idlibroA7U1L11" name="idlibroA7U1L11">
                                <input type="text" class="d-none" id="idclienteA7U1L11" name="idclienteA7U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h4>What questions would you ask an actress?</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="sentences1">
                                    <option value="1">Which car is the most difficult to repair?</option>
                                    <option value="2">What is your favorite programming language?</option>
                                    <option value="3">What was your first shoot?</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="sentences2">
                                    <option value="1">What is the most complicated thing about flying?</option>
                                    <option value="2">What has been your best movie?</option>
                                    <option value="3">What inspires you when writing a book?</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="sentences3">
                                    <option value="1">What inspires you to make music?</option>
                                    <option value="2">Is it difficult to learn the script of the movie?</option>
                                    <option value="3">What insecticide do you use on your crops?</option>
                                </select>
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

<div id="ModalLibroOcho" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Solve doubts about the content of the page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-eight">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA8U1L11" name="pointsA8U1L11">
                                <input type="text" class="d-none" id="idlibroA8U1L11" name="idlibroA8U1L11">
                                <input type="text" class="d-none" id="idclienteA8U1L11" name="idclienteA8U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Thomas Edison's greatest invention?</h5>
                                <select name="sentences" id="sen1">
                                    <option value="1">The car</option>
                                    <option value="2">The electric ligthbulb</option>
                                    <option value="3">The gravity</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Louis Braille's greatest invention?</h5>
                                <select name="sentences" id="sen2">
                                    <option value="1">Sign language</option>
                                    <option value="2">Braille system</option>
                                    <option value="3">Wheelchair</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Newton's great discovery?</h5>
                                <select name="sentences" id="sen3">
                                    <option value="1">The combustion</option>
                                    <option value="2">The electricity</option>
                                    <option value="3">The gravity</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Samuel Morse's greatest invention?:</h5>
                                <select name="sentences" id="sen4">
                                    <option value="1">The first telephone</option>
                                    <option value="2">The first computer</option>
                                    <option value="3">The telegram system</option>
                                </select>
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

<div id="ModalLibroNueve" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Solve doubts about the content of the page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-nine">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA9U1L11" name="pointsA9U1L11">
                                <input type="text" class="d-none" id="idlibroA9U1L11" name="idlibroA9U1L11">
                                <input type="text" class="d-none" id="idclienteA9U1L11" name="idclienteA9U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What is something Frank always wanted to do?</h5>
                                <select name="sentences" id="se1">
                                    <option value="1">Be a good doctor</option>
                                    <option value="2">Be a famous soccer player</option>
                                    <option value="3">Be a actor</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What would Katherine like to do in five years?</h5>
                                <select name="sentences" id="se2">
                                    <option value="1">Found a enterprise</option>
                                    <option value="2">Build shes house</option>
                                    <option value="3">Visit Egipt and Israel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>How long have you been saving for that?</h5>
                                <select name="sentences" id="se3">
                                    <option value="1">During six years</option>
                                    <option value="2">During four years</option>
                                    <option value="3">During seven years</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Melvin's childhood like?</h5>
                                <select name="sentences" id="se4">
                                    <option value="1">It was bored</option>
                                    <option value="2">It was fun and full of love</option>
                                    <option value="3">It was painful and sad</option>
                                </select>
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

<div id="ModalLibroOnce" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Solve doubts about the content of the page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-eleven">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA11U1L11" name="pointsA11U1L11">
                                <input type="text" class="d-none" id="idlibroA11U1L11" name="idlibroA11U1L11">
                                <input type="text" class="d-none" id="idclienteA11U1L11" name="idclienteA11U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What was Katherine dreaming?</h5>
                                <select name="sentences" id="s1">
                                    <option value="1">She was in space</option>
                                    <option value="2">She sang in Egypt</option>
                                    <option value="3">She was flying on a flying carpet</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What is Frank's wish</h5>
                                <select name="sentences" id="s2">
                                    <option value="1">Have the opportunity to travel to Europe</option>
                                    <option value="2">Have the opportunity to play football in Europe</option>
                                    <option value="3">Have the opportunity to travel to Germany</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What is Patty's dream?</h5>
                                <select name="sentences" id="s3">
                                    <option value="1">To be happy and rich for the rest of life</option>
                                    <option value="2">Buy a house in Dubai</option>
                                    <option value="3">Go to a concert in Russia</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What is Mario's dream?</h5>
                                <select name="sentences" id="s4">
                                    <option value="1">Buy a house with his girlfriend</option>
                                    <option value="2">Travel to Europe with his girlfriend</option>
                                    <option value="3">Have a happy relationship with his girlfriend</option>
                                </select>
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

<div id="ModalLibroDoce" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Solve doubts about the content of the page</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-twelve">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA12U1L11" name="pointsA12U1L11">
                                <input type="text" class="d-none" id="idlibroA12U1L11" name="idlibroA12U1L11">
                                <input type="text" class="d-none" id="idclienteA12U1L11" name="idclienteA12U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="../../resources/img/BOOKS/ElevenGrade/UnitOne/curlyhair.jpg" width="200" height="200">   
                            </div>
                            <div class="col-6">
                                <h5>What does she look like?</h5>
                                <select name="sentences" id="c1">
                                    <option value="1">She has got curly hair</option>
                                    <option value="2">She has got straight hair</option>
                                    <option value="3">She has got blue eyes</option>
                                    <option value="4">She has god blonde hair</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="../../resources/img/BOOKS/ElevenGrade/UnitOne/honestgirl.jpg" width="200" height="200">   
                            </div>
                            <div class="col-6">
                                <h5>My sister is ______. She always tells the truth</h5>
                                <select name="sentences" id="c2">
                                    <option value="1">patient</option>
                                    <option value="2">dishonest</option>
                                    <option value="3">impatient</option>
                                    <option value="4">honest</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="../../resources/img/BOOKS/ElevenGrade/UnitOne/strongman.jpg" width="200" height="200">   
                            </div>
                            <div class="col-6">
                                <h5>What does he looks like?</h5>
                                <select name="sentences" id="c3">
                                    <option value="1">weak</option>
                                    <option value="2">lazy</option>
                                    <option value="3">strong</option>
                                    <option value="4">rude</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <img src="../../resources/img/BOOKS/ElevenGrade/UnitOne/homework.jpg" width="200" height="200">   
                            </div>
                            <div class="col-6">
                                <h5>She is a ____ girl. She always do her homework.</h5>
                                <select name="sentences" id="c4">
                                    <option value="1">lazy</option>
                                    <option value="2">hardworking</option>
                                    <option value="3">honest</option>
                                    <option value="4">polite</option>
                                </select>
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

<div id="ModalLibroTrece" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Select the correct option for the following questions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-thirdteen">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA13U1L11" name="pointsA13U1L11">
                                <input type="text" class="d-none" id="idlibroA13U1L11" name="idlibroA13U1L11">
                                <input type="text" class="d-none" id="idclienteA13U1L11" name="idclienteA13U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>Where would you like to go?</h5>
                                <select name="sentences" id="d1">
                                    <option value="1">I would go to like to Australia</option>
                                    <option value="2">I could like visit my mommy</option>
                                    <option value="3">I would like to go to Costa Rica</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>Would you prefer to go hunting?</h5>
                                <select name="sentences" id="d2">
                                    <option value="1">No, i would</option>
                                    <option value="2">No, i would'nt</option>
                                    <option value="3">No, i wouldn't</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>What would you wish to learn?</h5>
                                <select name="sentences" id="d3">
                                    <option value="1">I'd love to learn another language</option>
                                    <option value="2">Id love to travel another country</option>
                                    <option value="3">I'dnt love eating Pizza</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5>Katherine would not like to travel by ferry</h5>
                                <select name="sentences" id="d4">
                                    <option value="1">She like would to travel by ferry</option>
                                    <option value="2">She would like to travel by car</option>
                                    <option value="3">She'd travel to Helicopter</option>
                                </select>
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

<div id="ModalLibroCatorce" class="modal fade" tabindex="-4">
    <!-- <div class="container-fluid"> -->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Complete the activity - Present perfect</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="game-fourteen">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 align-items-center">
                                <!-- class="d-none" -->
                                <input type="text" class="d-none" id="pointsA14U1L11" name="pointsA14U1L11">
                                <input type="text" class="d-none" id="idlibroA14U1L11" name="idlibroA14U1L11">
                                <input type="text" class="d-none" id="idclienteA14U1L11" name="idclienteA14U1L11">
                            </div>
                        </div>
                        <div class="row">
                            <p><b>Support information:</b></p>
                            <img src="../../resources/img/BOOKS/ElevenGrade/UnitOne/A14help.jpeg" alt="" width="50" height="300">
                        </div>
                        <div class="row">
                            <p><b>Select the sentences that are using Present Perfect:</b></p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="f1">
                                    <option value="1">They've always work in this place.</option>
                                    <option value="2">I have never been to Europa.</option>
                                    <option value="3">She has never eat that type of food before.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="f2">
                                    <option value="1">I have never play the guitar before.</option>
                                    <option value="2">You've read that book several times.</option>
                                    <option value="3">You have seen that serie many times.</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="f3">
                                    <option value="1">Frank has already done this work</option>
                                    <option value="2">I have never sing that song,</option>
                                    <option value="3">I have always love your smile</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <select name="sentences" id="f4">
                                    <option value="1">You have make the project</option>
                                    <option value="2">They have always enjoyed their vacations</option>
                                    <option value="3">I have work in Monte Sinai</option>
                                </select>
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