
function getURL() {
    alert("The URL of this page is: " + window.location.href);
}

function openModal() {

    if (page = 1) {

        let content = '';
        content = `<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
        </div>`
        document.getElementById('ModalLibroUno').innerHTML = content;
    }
    else if (page = 10) {
        let content = '';
        content = ` <div class="container-fluid">
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
                            <div class="row align-items-center">
                            <div class="row">
                                <div class="col-md-8 align-items-center">
                                    <p class="fs-1 fw-bold">Complete the activity</p>
                                </div>
                            </div>
                            <div class="row row-cols-4">
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">H</div>
                                            <div class="col">e</div>
                                            <div class="col">
                                                <input type="text" id="input-twohead" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">d</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">a</div>
                                            <div class="col">
                                                <input type="text" id="input-twoarm" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">m</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">e</div>
                                            <div class="col">
                                                <input type="text" id="input-twoear" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">r</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-6">
                                            <div class="col">m</div>
                                            <div class="col">
                                                <input type="text" id="input-twomouth" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">o</div>
                                            <div class="col">u</div>
                                            <div class="col">t</div>
                                            <div class="col">h</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <!-- espacio -->
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <!-- espacio -->
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">H</div>
                                            <div class="col">e</div>
                                            <div class="col">
                                                <input type="text" id="input-twoheck" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">k</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">n</div>
                                            <div class="col"><input type="text" id="input-twonose" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1"></div>
                                            <div class="col">s</div>
                                            <div class="col">e</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">h</div>
                                            <div class="col">a</div>
                                            <div class="col">n</div>
                                            <div class="col">
                                                <input type="text"  id="input-twohand" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">
                                                <input type="text" id="input-twoleg" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">e</div>
                                            <div class="col">g</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <!-- espacio -->
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <!-- espacio -->
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">F</div>
                                            <div class="col">o</div>
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">t</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">a</div>
                                            <div class="col">i</div>
                                            <div class="col">r</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-7">
                                            <div class="col">s</div>
                                            <div class="col">t</div>
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">m</div>
                                            <div class="col">a</div>
                                            <div class="col">c</div>
                                            <div class="col">h</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-6">
                                            <div class="col">f</div>
                                            <div class="col">i</div>
                                            <div class="col">n</div>
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">e</div>
                                            <div class="col">r</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <!-- espacio -->
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col"></div>
                                <!-- espacio -->
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col"> <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1"> </div>
                                            <div class="col">a</div>
                                            <div class="col">c</div>
                                            <div class="col">e</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">o</div>
                                            <div class="col">e</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">e</div>
                                            <div class="col">
                                                <input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">e</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
                                </div>
                                <div class="col border border-dark">
                                    <!-- inicio group -->
                                    <div class="input-group input-group-sm mb-3">
                                        <div class="row row-cols-4">
                                            <div class="col">k</div>
                                            <div class="col">n</div>
                                            <div class="col"><input type="text" class="col-6 col-md-4 form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" maxlength="1">
                                            </div>
                                            <div class="col">e</div>
                                        </div>
                                    </div>
                                    <!-- fin group -->
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
                        <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar">Submit</button><br>
                    </div>
                </div>
            </div>
    </form>
    </form>
         </div>`
        document.getElementById('ModalLibroUno').innerHTML = content;
    }


}


document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //declaración de variables 
    var one, five, nine, thirdteen, two, six,
        ten, fourteen, three, seven, eleven, fifteen,
        four, eight, twelve, sixteen;
    //definición de variables 
    one = document.getElementById('input-oneh').value;//a
    five = document.getElementById('input-fivec').value;//r
    nine = document.getElementById('input-niner').value;//a
    thirdteen = document.getElementById('input-thirdteenu').value;//o
    two = document.getElementById('input-twoe').value;//c
    six = document.getElementById('input-sixn').value;//o
    ten = document.getElementById('input-tend').value;//d
    fourteen = document.getElementById('input-fourteenl').value;//l
    three = document.getElementById('input-threef').value;//o
    seven = document.getElementById('input-sevenh').value;//h
    eleven = document.getElementById('input-elevench').value;//o
    fifteen = document.getElementById('input-fifteenf').value;//g
    four = document.getElementById('input-fourc').value;//f
    eight = document.getElementById('input-eightt').value;//t
    twelve = document.getElementById('input-twelvey').value;//e
    sixteen = document.getElementById('input-sixteenk').value;//e
    // declacración de variables de puntajes 
    var puntos , promedio; 
    // declaración de condicionales 
    if (one === "" && five === "" && nine === "" && thirdteen === "" && two === "" && six === "" && ten === "" &&
        fourteen === "" && three === "" && seven === "" && eleven === "" && fifteen === "" && four === ""
        || eight === "" && twelve === "" && sixteen === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }

    if(one==="a"){

    }
    if(five === "r"){

    }
    if(nine === "a"){

    }
    if(thirdteen === "o"){

    }
    if(two === "c"){

    }
    if(six === "o"){

    }

    

    if (one === "a" && five === "r" && nine === "a" && thirdteen === "o" && two === "c" && six === "o"
        && ten === "d" && fourteen === "l" && three === "o" && seven === "h" && eleven === "o"
        && fifteen === "g" && four === "f" && eight === "t"
        && twelve === "e" && sixteen === "e") {
        sweetAlert(1, 'good job', null);
        return true;
    } else if (one !== "a" || five !== "r" || nine !== "a" || thirdteen !== "o" || two !== "c" || six !== "o"
        || ten !== "d" || fourteen !== "l" || three !== "o" || seven !== "h" || eleven !== "o"
        || fifteen !== "g" || four !== "f" || eight !== "t"
        || twelve !== "e" || sixteen !== "e") {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return false;
    }

});




document.getElementById('game-two').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //declaración de variables 
    var one, five, nine, thirdteen, two, six,
        ten, fourteen, three, seven, eleven, fifteen,
        four, eight, twelve, sixteen;
    //definición de variables 
    one = document.getElementById('recipient-name').value;//a
    // declaración de condicionales 
    if (one = "  ") {
        sweetAlert(2, 'Todos los campos son obligatorios', null);
        return false;
    }
    
});