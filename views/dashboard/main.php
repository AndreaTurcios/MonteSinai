<?php
//Se incluye la clase con las plantillas del documento
require_once("../../app/helpers/dashboard_page.php");
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libros');
?>
<!--Aquí comenzamos abriendo la sección -->
<section>
  <br>
  <div class="container">
    <div class="row">
      <!--Container con su respectivo título de pestaña, en este caso, proveedores -->
      <div class="col-12 text-center" id="Titulo1">
        <!-- Colocamos el h1 con su respectivo título, este caso la estión de empleados -->
        <h1 class="center">Menu</h1>
      </div>
    </div>
    <br>
    <!-- Aquí colocamos la sección para buscar y agregar -->
    <div class="row">
      <nav class="navbar navbar-light bg-light">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8 p-3">
          <form class="d-flex" method="post" id="search-form">
            <input id="search" class="form-control me-2" type="text" name="search" required />
            <button class="btn btn-outline-success" type="submit">Buscar</button>
          </form>
        </div>

        <!--Aquí en el botón para agregar los datos al modal con el respectivo ícono -->
        <!--El div es por cuestión de estética, antes iba el dropdown con los filtros, pero como el buscador lo hace de manera automática se eliminó -->
        <div class="col-6 col-xs-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 col-xxl-2 p-3 text-center" id="MuestraBTN">
        </div>
        <div class="col-6 col-xs-6 col-sm-6 col-md-2 col-lg-2 col-xl-2 col-xxl-2 p-3 text-center">
          <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalAgregarCliente">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
            Agregar
          </button>
        </div>
    </div>
    </nav>
    <br>
        <div class="row">
            <div class="table-responsive" class="col scroll">
                <table id="data-table" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre libro</th>
                            <th scope="col">N° Páginas</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col">Estado libro</th>
                            <th scope="col">Controlador</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                    </tbody>
                </table>
            </div>

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
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="form-group">
                                                        <label for="nombrelibro">Nombre libro:</label>
                                                        <input type="text" class="form-control" id="nombrelibro" name="nombrelibro" placeholder="Nombre libro" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1-50}" required minlength="3" maxlength="50" autocomplete="off" />
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="numpaginas">Número páginas:</label>
                                                        <input type="number" class="form-control" id="numpaginas" name="numpaginas" placeholder="Número páginas" required minlength="1" maxlength="5" autocomplete="off" />
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <label for="asignatura">Asignatura:</label>
                                                        <select id="asignatura" class="form-select" name="asignatura">
                                                            <option selected></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estadolibro">Estado libro:</label>
                                                        <select id="estadolibro" class="form-select" name="estadolibro">
                                                            <option selected></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <!-- Botones de Control -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Guardar</button><br>
                                                </div>
                                </form>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            </nav>
            <br>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Actualizar libro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Partes del modal para hacer insert -->
                    <form id="update-form" method="post" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="formGroupExampleInput" class="d-none">ID</label>
                            <input type="text" class="form-control d-none" placeholder="" aria-describedby="basic-addon1" id="id_libro2" type="text" name="id_libro2" />
                        </div>
                        <div class="modal-body">
                            <form id="update-form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombrelibro2">Nombre libro:</label>
                                    <input type="text" class="form-control" id="nombrelibro2" name="nombrelibro2" placeholder="Nombre libro" pattern="[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{1,50}" required minlength="3" maxlength="50" autocomplete="off" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="numpaginas2">Numero páginas:</label>
                                    <input type="number" class="form-control" id="numpaginas2" name="numpaginas2" placeholder="Número páginas:" required minlength="1" maxlength="5" autocomplete="off" />
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="asignatura2">Asignatura:</label>
                                    <select id="asignatura2" class="form-select" name="asignatura2">
                                        <option selected></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="estadolibro2">Estado libro:</label>
                                    <select id="estadolibro2" class="form-select" name="estadolibro2">
                                        <option selected></option>
                                    </select>
                                </div>

                        </div>
                        <br>
                        <!-- Botones de Control -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Guardar</button><br>
                        </div>
                    </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('libros.js');
?>