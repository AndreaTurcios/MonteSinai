<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Agregamos Bootstrap -->
    <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>Unit 1 - First Grade</title>
    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
    <link rel="stylesheet" href="../../resources/css/bookstyles.css">
</head>

<body>
    <!-- Previous Button -->
    <button id="prev-btn">
        <i class="fas fa-arrow-circle-left"></i>
    </button>


    <!-- Book -->
    <div id="book" class="book">
        <!-- Paper 1 -->
        <div id="p1" class="paper">
            <div class="front">
                <div id="f1" class="front-content">
                    <h1>Front 1</h1>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalLibroJuego">
                        Juego interactivo
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="back">
                <div id="b1" class="back-content">
                    <h1>Back 1</h1>
                </div>
            </div>
        </div>
        <!-- Paper 2 -->
        <div id="p2" class="paper">
            <div class="front">
                <div id="f2" class="front-content">
                    <h1>Front 2</h1>
                </div>
            </div>
            <div class="back">
                <div id="b2" class="back-content">
                    <h1>Back 2</h1>
                </div>
            </div>
        </div>
        <!-- Paper 3 -->
        <div id="p3" class="paper">
            <div class="front">
                <div id="f3" class="front-content">
                    <h1>Front 3</h1>
                </div>
            </div>
            <div class="back">
                <div id="b3" class="back-content">
                    <h1>Back 3</h1>
                </div>
            </div>
        </div>
        <!-- Paper 4 -->
        <div id="p4" class="paper">
            <div class="front">
                <div id="f4" class="front-content">
                    <h1>Front 4</h1>
                </div>
            </div>
            <div class="back">
                <div id="b4" class="back-content">
                    <h1>Back 4</h1>
                </div>
            </div>
        </div>
    </div>



    <!-- Next Button -->
    <button id="next-btn">
        <i class="fas fa-arrow-circle-right"></i>
    </button>
</body>

<div id="ModalLibroJuego" class="modal fade">
    <div class="container-fluid">
        <form method="post" id="save-form">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Juego super genial que te enseña mucho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="nombrejuego">Aquí irá el juego:</label>
                                <input type="text" class="form-control" id="nombrelibro" name="nombrelibro" placeholder="Nombre libro" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1-50}" required minlength="3" maxlength="50" autocomplete="off" />
                            </div>
                            <br>
                        </div>
                        <br>
                        <!-- Botones de Control -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Guardar</button><br>
                        </div>
                    </div>
                </div>
        </form>
        </form>
    </div>
</div>
</div>
<script type="text/javascript" src="../../app/helpers/bookfix.js"></script>
<script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
<!-- Script de Bootstrap -->
<script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>
<script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
<script type="text/javascript" src="../../app/helpers/components.js"></script>
<script type="text/javascript" src="../../app/controllers/account.js"></script>

</html>