document.addEventListener('DOMContentLoaded', function () {
    //

    if (page = 10) {
        let content = '';
        content += ` <div class="container-fluid">
        <form method="post" id="game-one-form">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Complete the words</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <!-- columna -->
                                <div class="container-fluid">
                                    <div class="row row-cols-4">
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <!-- espacio -->
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <!-- espacio -->
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <!-- espacio -->
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <!-- espacio -->
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <!-- espacio -->
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <div class="col"></div>
                                        <!-- espacio -->
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                        <div class="col border border-dark">col</div>
                                    </div>
                                </div>

                            </div>
                            <br>
                        </div>
                        <br>
                        <!-- Botones de Control -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button><br>
                        </div>
                    </div>
                </div>
        </form>
        </form>
    </div>`
        document.getElementById('ModalLibroUno').innerHTML = content;
    }

});


function getURL() {
    alert("The URL of this page is: " + window.location.href);
}


document.getElementById('form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    document.getElementById('id_input').value = '';



});
