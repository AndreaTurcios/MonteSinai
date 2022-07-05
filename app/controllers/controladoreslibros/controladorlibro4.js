const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.getElementById('unit1-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["a", "r", "a", "g", "a", "d", "e", "n", "e", "d", "r", "o", "i", "v", "i", "n", "g", "r", "o", "o", "a", "t", "h", "o", "o", "a", "r", "a", "l", "i", "n", "i", "n", "g", "o", "o", "i", "t", "c", "h"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 40; i++) {
        inputs[i] = document.getElementById('input-act1-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = valorActividad;
            document.getElementById('idlibro').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act1').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = points;
            document.getElementById('idlibro').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act2').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "2", "3", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act2-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act2', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act2').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act2', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act2').modal('hide');
            return true;
        }
    }

});

paper.install(window);

window.onload = function () {
    for (let i = 0; i < 98; i++) {
        document.getElementById('act21-' + (i + 1)).style.color = '#212529'

    }

    // Set it up
    paper.setup('canvas2');

    var canvas2 = document.getElementById("canvas2");

    const context = canvas2.getContext('2d');

    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("color2Picker");
    var color2Stroke;
    var widthStrokePicker = document.getElementById("stroke2WidthPicker");
    var widthStroke;
    var clear2Button = document.getElementById("clear2Btn");

    // Clear event listener
    clear2Btn.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        color2Stroke = color2Picker.value;
        widthStroke = widthStrokePicker.value;
    }

    // Check for new color2 value each second
    setInterval(update, 1000);

    // Define a mousedown and mousedrag handler
    tool.onMouseDown = function (event) {
        path = new Path();
        path.strokeWidth = widthStroke;
        path.strokeColor = color2Stroke;
        // Draw
        path.add(event.point);
    }

    tool.onMouseDrag = function (event) {
        // Draw
        path.add(event.point);
        document.getElementById("verify-canvas").value = 1;
    }
}

document.getElementById('unit1-act3').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 1;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    //arreglo para guardar los inputs
    let inputs = [];
    //Llenar los inputs
    for (let i = 0; i < 12; i++) {
        inputs[i] = document.getElementById('input-act3-' + (i + 1)).value;
    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw your house', null);
        return false;
    }
    else {
        //verificar si escribió algo
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        } else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act3', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act3').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act4').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "4", "4", "4"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act4-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act4').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act4', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act4').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "1", "3", "1", "1", "3", "2", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act5-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act5').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act5', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act5').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act6').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = [["KATHERINE IS IN THE BEDROOM", "YAELY IS AT THE KITCHEN", "THE FRIEND IS IN THE BATHROOM", "MOMMY IS IN THE LIVING ROOM", "FRANCISCO IS AT THE DINING ROOM"], ["SHE IS IN THE BEDROOM", "SHE IS AT THE KITCHEN", "HE IS IN THE BATHROOM", "SHE IS IN THE LIVING ROOM", "HE IS AT THE DINING ROOM"]]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (respuestas[0][i].trim() == inputs[i].toUpperCase().trim() || respuestas[0][i].trim() + "." == inputs[i].toUpperCase().trim() ||
                respuestas[1][i].trim() == inputs[i].toUpperCase().trim() || respuestas[1][i].trim() + "." == inputs[i].toUpperCase().trim()) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act6', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act6').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act6', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act6').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act7').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["WHAT CAN I", "I CAN"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act7-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All questions and answers must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if ((i + 1) % 2 == 1) {
                    if (inputs[i].trim().includes(respuestas[0]) && inputs[i].trim().includes("?")) {
                        conteo++;
                    }
                } else {
                    if (inputs[i].trim().includes(respuestas[1])) {
                        conteo++;
                    }
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act7', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act7').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use "What can I...?" for the questions and "I can..." for the answers', null);
                return true;
            }
        }

    }

});

document.getElementById("unit1-act8").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    //Llenar arreglo de inputs
    for (let i = 0; i < 13; i++) {
        inputs[i] = document.getElementById('text-act8-' + (i + 1)).innerHTML;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente8').value = users.value;
        document.getElementById('points8').value = valorActividad;
        document.getElementById('idlibro8').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act8', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act8').modal('hide');
        return true;

    }

});



//Elementos arrastrables act8

for (let i = 0; i < 4; i++) {
    document.getElementById('option-act8-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
}

//Elementos que reciben el arrastrable act8

for (let i = 0; i < 13; i++) {
    document.getElementById('text-act8-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;
    });

    document.getElementById('text-act8-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
}

document.getElementById("unit1-act9").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    let respuestas = ["Orange", "Green", "Brown", "Orange"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('text-act9-' + (i + 1)).innerHTML;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if ((respuestas[i] == "Orange" && inputs[i] == "Brown") || (respuestas[i] == "Brown" && inputs[i] == "Orange")) {
                conteo++;
            } else {
                if (respuestas[i].trim() == inputs[i].trim()) {
                    conteo++;
                }
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = valorActividad;
            document.getElementById('idlibro9').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act9', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act9').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = points;
            document.getElementById('idlibro9').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act9', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act9').modal('hide');
            return true;
        }

    }

});



//Elementos arrastrables act9

for (let i = 0; i < 6; i++) {
    document.getElementById('option-act9-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
}

//Elementos que reciben el arrastrable act9

for (let i = 0; i < 4; i++) {
    document.getElementById('text-act9-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;
    });

    document.getElementById('text-act9-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
}

document.getElementById("unit1-act10").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    let respuestas = ["White", "White", "White", "Blue"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('text-act10-' + (i + 1)).innerHTML;
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (respuestas[i] == "White" && inputs[i] == "Brown") {
                conteo++;
            } else {
                if (respuestas[i].trim() == inputs[i].trim()) {
                    conteo++;
                }
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act10').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act10', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act10').modal('hide');
            return true;
        }

    }

});



//Elementos arrastrables act10

for (let i = 0; i < 7; i++) {
    document.getElementById('option-act10-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
}

//Elementos que reciben el arrastrable act10

for (let i = 0; i < 4; i++) {
    document.getElementById('text-act10-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;
    });

    document.getElementById('text-act10-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
}

document.getElementById("unit1-act11").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    let respuestas = ["RED", "ORANGE", "BROWN", "BLUE", "BLACK", "GREEN"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value;
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (respuestas[i].trim() == inputs[i].toUpperCase().trim() || respuestas[i].trim() + "." == inputs[i].toUpperCase().trim()) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act11').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act11', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act11').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act12').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["THIS", "THAT"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act12-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].trim().includes(respuestas[1]) || inputs[i].trim().includes(respuestas[0])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act7', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act12').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use "This" and "That"', null);
                return true;
            }
        }

    }

});

document.getElementById('unit1-act13').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["IN"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act13-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].trim().includes(respuestas[0]) && !inputs[i].trim().startsWith(respuestas[0])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente13').value = users.value;
                document.getElementById('points13').value = valorActividad;
                document.getElementById('idlibro13').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act13', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act13').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use "in" correctly', null);
                return true;
            }
        }

    }

});

document.getElementById('unit1-act14').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["MIRROR", "CHAIR", "WATER"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('input-act14-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(respuestas[i])) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = valorActividad;
            document.getElementById('idlibro14').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act14', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act14').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act14', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act14').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act15').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let imgs = [];
    let respuestasImg = ["BEDROOM", "SOFA", "KITCHEN", "YARD", "LIVING ROOM"]
    let respuestasTxt = ["E", "D", "R", "O", "O", "S", "F", "I", "T", "C", "H", "E", "A", "R", "I", "V", "I", "N", "R", "O", "O"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        imgs[i] = $("#img-act15-" + (i + 1)).attr("alt").toUpperCase();

    }
    for (let i = 0; i < respuestasTxt.length; i++) {
        inputs[i] = document.getElementById('input-act15-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(respuestasTxt[i])) {
                conteo++;
            }
        }
        for (let i = 0; i < imgs.length; i++) {
            if (imgs[i].trim().includes(respuestasImg[i])) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == (respuestasImg.length + respuestasTxt.length)) {
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act15', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act15').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length + imgs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act15', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length + imgs.length) + ' answers right', null);
            $('#ModalUnit1Act15').modal('hide');
            return true;
        }

    }

});


//Elementos arrastrables act15

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act15-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act15

for (let i = 0; i < 5; i++) {
    document.getElementById('box-act15-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src", draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt", draggedAlt);

    });

    document.getElementById('box-act15-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit1-act16').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["EAT", "WASH", "SLEEP", "SIT DOWN", "TAKE A SHOWER", "STUDY", "PLAY", "TALK", "READ", "RUN"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('input-act16-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].trim().includes(respuestas[i])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente16').value = users.value;
                document.getElementById('points16').value = valorActividad;
                document.getElementById('idlibro16').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act16', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act16').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use the indicated verb', null);
                return true;
            }
        }

    }

});

document.getElementById('unit1-act17').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["MY", "MY", "YOUR", "YOUR", "HIS", "HIS", "HER", "HER"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act17-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].trim().includes(respuestas[i])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente17').value = users.value;
                document.getElementById('points17').value = valorActividad;
                document.getElementById('idlibro17').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act17', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act17').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use the indicated verb', null);
                return true;
            }
        }

    }

});

document.getElementById("unit1-act18").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    let respuestas = ["NINETEEN", "TWO", "TWENTY", "FOUR", "FIFTEEN", "SIX", "TWENTY", "TWENTY", "ELEVEN", "TWENTY", "ELEVEN", "EIGHT", "THIRTEEN", "TWENTY", "FIFTEEN", "FOUR", "SEVENTEEN", "TWO", "NINETEEN", "ZERO"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('input-act18-' + (i + 1)).value;
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (respuestas[i].trim() == inputs[i].toUpperCase().trim()) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act18', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act18').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act18', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act18').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act19').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act19-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = valorActividad;
            document.getElementById('idlibro19').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act19', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act19').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act19', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act19').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit1Act3').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
});

$('#ModalUnit1Act20').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas20');

    // Get elements from DOM and define properties
    var color20Picker = document.getElementById("color20Picker");
    var color20Stroke;
    var width20StrokePicker = document.getElementById("stroke20WidthPicker");
    var width20Stroke;
    var clear20Button = document.getElementById("clear20Btn");

    // Clear event listener
    clear20Button.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        color20Stroke = color20Picker.value;
        width20Stroke = width20StrokePicker.value;
    }

    // Check for new color2 value each second
    setInterval(update, 1000);
});

document.getElementById('unit1-act20').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 1;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw your family', null);
        return false;
    }
    else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente20').value = users.value;
        document.getElementById('points20').value = points;
        document.getElementById('idlibro20').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act20', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act20').modal('hide');
        return true;
    }

});

document.getElementById('unit1-act21').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["FATHER", "MOTHER", "SISTER", "BROTHER", "GRANDFATHER", "GRANDMOTHER", "BABY"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('input-act21-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if (inputs[i].trim().includes(respuestas[i])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente21').value = users.value;
                document.getElementById('points21').value = valorActividad;
                document.getElementById('idlibro21').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act21', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act21').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use the indicated family member', null);
                return true;
            }
        }

    }

});

function checkCells(id) {
    document.getElementById(id).style.backgroundColor = "#c293c7";
}

document.getElementById('unit1-act22').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];

    //Llenar arreglo de inputs
    for (let i = 0; i < 98; i++) {
        if (document.getElementById('act21-' + (i + 1)).style.backgroundColor == 'rgb(194, 147, 199)') {
            conteo++;
        }

    }

    if (conteo < 98) {
        sweetAlert(2, 'Find the missing words', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente22').value = users.value;
        document.getElementById('points22').value = valorActividad;
        document.getElementById('idlibro22').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act22', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act22').modal('hide');
        return true;

    }

});

document.getElementById("unit1-act23").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;
    let respuestas = ["1", "5", "9", "18", "13", "3", "15", "11", "19", "8", "10", "17", "6", "14", "4", "2", "12", "20", "7", "16"];
    let inputs = [];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('box-act23-' + (i + 1)).innerHTML;
        console.log(inputs[i])
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        for (let i = 0; i < respuestas.length; i++) {
            if (inputs[i].includes(respuestas[i])) {
                conteo++;
            }

        }
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = valorActividad;
            document.getElementById('idlibro23').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act23', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act23').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = points;
            document.getElementById('idlibro23').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act23', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act23').modal('hide');
            return true;
        }

    }

});

//Elementos arrastrables act23
for (let i = 0; i < 20; i++) {
    document.getElementById('option-act23-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act23
for (let i = 0; i < 20; i++) {
    document.getElementById('box-act23-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;

    });

    document.getElementById('box-act23-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit1-act24').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["A", "M", "O", "F", "H", "A", "I", "A", "D", "I", "L", "O", "C", "T", "E", "R", "E", "I", "N", "D", "O", "E", "L", "E", "P", "H", "O", "N", "E", "E", "I", "I", "O", "E", "A", "L", "O", "O", "O", "F", "E", "A", "B", "L"]

    //Llenar arreglo de inputs}
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act24-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente24').value = users.value;
            document.getElementById('points24').value = valorActividad;
            document.getElementById('idlibro24').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act24', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act24').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente24').value = users.value;
            document.getElementById('points24').value = points;
            document.getElementById('idlibro24').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act24', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act24').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act25').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act25-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente25').value = users.value;
            document.getElementById('points25').value = valorActividad;
            document.getElementById('idlibro25').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act25', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act25').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente25').value = users.value;
            document.getElementById('points25').value = points;
            document.getElementById('idlibro25').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act25', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act25').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act26').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = [["SOFA", "PINK", "CHAIR", "YELLOW", "FAN", "GRAY", "COFFEE TABLE", "BLACK", "WINDOW", "PURPLE", "RADIO", "PINK"], ["SOFA", "PINK", "CHAIR", "YELLOW", "FAN", "GREY", "COFFEE-TABLE", "BLACK", "CURTAIN", "PURPLE", "RADIO", "PINK"]]

    //Llenar arreglo de inputs
    for (let i = 0; i < 12; i++) {
        inputs[i] = document.getElementById('input-act26-' + (i + 1)).value;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].toUpperCase().trim().includes(respuestas[0][i]) || inputs[i].toUpperCase().trim().includes(respuestas[1][i])) {
                conteo++;
            }

        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente26').value = users.value;
            document.getElementById('points26').value = valorActividad;
            document.getElementById('idlibro26').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act26', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act26').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente26').value = users.value;
            document.getElementById('points26').value = points;
            document.getElementById('idlibro26').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act26', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act26').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act27').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;

    //Llenar arreglo de inputs
    for (let i = 0; i < 66; i++) {
        if (document.getElementById('act27-' + (i + 1)).style.backgroundColor == 'rgb(194, 147, 199)') {
            conteo++;
        }

    }

    //Se verifica que todas las letras hayan sido encontradas
    if (conteo < 66) {
        sweetAlert(2, 'Find the missing words', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente27').value = users.value;
        document.getElementById('points27').value = valorActividad;
        document.getElementById('idlibro27').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act27', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act27').modal('hide');
        return true;

    }

});


document.getElementById('unit1-act28').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let imgs = [];
    let respuestasImg = ["WINDOW", "FLOOR", "CHAIR", "TELEVISION SET", "RADIO"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        imgs[i] = $("#img-act28-" + (i + 1)).attr("alt").toUpperCase();

    }

    for (let i = 0; i < imgs.length; i++) {
        if (imgs[i].trim().includes(respuestasImg[i])) {
            conteo++;
        }

    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 4;
        document.getElementById('idcliente28').value = users.value;
        document.getElementById('points28').value = valorActividad;
        document.getElementById('idlibro28').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act28', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act28').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad / (inputs.length + imgs.length);
        let points = (puntaje * conteo).toFixed(2);
        var libro = 4;
        document.getElementById('idcliente28').value = users.value;
        document.getElementById('points28').value = points;
        document.getElementById('idlibro28').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act28', 'modal');
        sweetAlert(4, conteo + '/' + (inputs.length + imgs.length) + ' answers right', null);
        $('#ModalUnit1Act28').modal('hide');
        return true;
    }


});


//Elementos arrastrables act28

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act28-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act28

for (let i = 0; i < 5; i++) {
    document.getElementById('box-act28-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src", draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt", draggedAlt);

    });

    document.getElementById('box-act28-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit1-act29').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["A", "B", "L", "I", "C", "T", "U", "R", "A", "L", "A", "O", "W", "I", "T", "C", "H", "E", "B", "L", "E", "C", "L", "O", "A", "N", "D", "L", "L", "E", "S", "T", "I", "H", "A", "K", "E", "F", "F", "E", "E", "P", "P", "P", "E", "H", "A", "K", "E", "I", "N", "A", "C", "A", "B", "I", "N"]

    //Llenar arreglo de inputs}
    console.log(respuestas.length)
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act29-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente29').value = users.value;
            document.getElementById('points29').value = valorActividad;
            document.getElementById('idlibro29').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act29', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act29').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente29').value = users.value;
            document.getElementById('points29').value = points;
            document.getElementById('idlibro29').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act29', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act29').modal('hide');
            return true;
        }

    }

});
