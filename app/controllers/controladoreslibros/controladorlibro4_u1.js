const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var color2Stroke, widthStroke, intervalo;

document.getElementById('unit1-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;

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
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("color2Picker");
    var widthStrokePicker = document.getElementById("stroke2WidthPicker");
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
    intervalo = setInterval(update, 1000);

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

$('#ModalUnit1Act3').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas2');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("color2Picker");
    var widthStrokePicker = document.getElementById("stroke2WidthPicker");
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
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit1-act3').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["3", "2", "1", "3", "1"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('select-act6-' + (i + 1)).value;

    }

    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i] == respuestas[i]) {
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;

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
    if (intervalo) {
        clearInterval(intervalo);
    }
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas20');

    // Get elements from DOM and define properties
    var color20Picker = document.getElementById("color20Picker");
    var width20StrokePicker = document.getElementById("stroke20WidthPicker");
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
        color2Stroke = color20Picker.value;
        widthStroke = width20StrokePicker.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit1-act20').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
    let respuestas = ["1", "5", "9", "18", "13", "3", "15", "11", "19", "8", "10", "17", "6", "14", "4", "2", "12", "20", "7", "16"];
    let inputs = [];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('box-act23-' + (i + 1)).innerHTML;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;

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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
    let valorActividad = 0.19;
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
        let puntaje = valorActividad / imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 4;
        document.getElementById('idcliente28').value = users.value;
        document.getElementById('points28').value = points;
        document.getElementById('idlibro28').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act28', 'modal');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
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
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["A", "B", "L", "I", "C", "T", "U", "R", "A", "L", "A", "O", "W", "I", "T", "C", "H", "E", "B", "L", "E", "C", "L", "O", "A", "N", "D", "L", "L", "E", "S", "T", "I", "H", "A", "K", "E", "F", "F", "E", "E", "P", "P", "P", "E", "H", "A", "K", "E", "U", "G", "A", "R", "B", "O", "L", "I", "N", "A", "C", "A", "B", "I", "N"]

    //Llenar arreglo de inputs
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

document.getElementById('unit1-act30').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Arreglo para guardar los datos ingresados
    let inputs = [];

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act30-' + (i + 1)).value;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente13').value = users.value;
        document.getElementById('points13').value = valorActividad;
        document.getElementById('idlibro13').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act13', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act13').modal('hide');
        return true;
    }

});

document.getElementById('unit1-act31').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let answers = ["C", "H", "A", "I", "R", "C", "T", "A", "O", "C", "A", "B", "F", "A", "B", "I", "F", "N", "L", "N", "P", "E", "D", "E", "E", "I", "E", "L", "C", "T", "T", "P", "E", "L", "C", "O", "O", "H", "T", "A", "B", "L", "E", "T", "E", "H", "S", "U", "G", "A", "R", "S", "A", "L", "T", "S", "H", "A", "K", "E", "R", "S", "A", "L", "A", "D", "B", "O", "W", "L"];
    //Llenar arreglo de inputs
    for (let i = 0; i < 70; i++) {
        inputs[i] = document.getElementById('input-act31-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(answers[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == answers.length) {
            var libro = 4;
            document.getElementById('idcliente31').value = users.value;
            document.getElementById('points31').value = valorActividad;
            document.getElementById('idlibro31').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act31', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act31').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente31').value = users.value;
            document.getElementById('points31').value = points;
            document.getElementById('idlibro31').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act31', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act31').modal('hide');
            return true;
        }

    }

});

//Funciones para el crossword
let across = true;
const table = document.querySelector('.table-crossl4');
table.addEventListener('keydown', handleKeyDown);

function handleKeyDown(e) {
    const td = e.target.parentElement;

    if (e.key === 'Backspace' && !e.target.value) {
        const ref = getReferences(td);
        const cells = across ? ref.x || ref.y : ref.y || ref.x;
        const index = cells.indexOf(td);

        if (index > 0) {
            cells[index - 1].querySelector('input').focus();
            e.preventDefault();
        }
        return;
    }

    if (e.key === 'Enter') {
        return handleClick(e);
    }

    if (e.key === 'ArrowRight') {
        let cell = td;

        while (cell.nextElementSibling) {
            cell = cell.nextElementSibling;
            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowLeft') {
        let cell = td;

        while (cell.previousElementSibling) {
            cell = cell.previousElementSibling;
            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowUp') {
        const index = td.cellIndex;
        let cell = td;
        let tr = td.parentElement;

        while (tr.previousElementSibling) {
            tr = tr.previousElementSibling;
            cell = tr.children[index];

            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
        return;
    }

    if (e.key === 'ArrowDown') {
        const index = td.cellIndex;
        let cell = td;
        let tr = td.parentElement;

        while (tr.nextElementSibling) {
            tr = tr.nextElementSibling;
            cell = tr.children[index];

            if (!cell.classList.contains('cell-black')) {
                cell.querySelector('input').focus();
                return;
            }
        }
    }
}

/********************
 *  Get references   *
 **********************/

function getReferences(td) {
    const x = getXCells(td);
    const y = getYCells(td);

    return { x, y };
}

function getXCells(td) {
    const cells = [td];
    let curr = td;

    //Get previous
    while (
        curr.previousElementSibling &&
        !curr.previousElementSibling.classList.contains('cell-black')
    ) {
        curr = curr.previousElementSibling;
        cells.unshift(curr);
    }

    //Check if there's a clue
    if (!cells[0].querySelector('label')) {
        return null;
    }

    //Get next
    curr = td;
    while (
        curr.nextElementSibling &&
        !curr.nextElementSibling.classList.contains('cell-black')
    ) {
        curr = curr.nextElementSibling;
        cells.push(curr);
    }

    return cells;
}

function getYCells(td) {
    const cells = [td];
    const index = td.cellIndex;
    let tr = td.parentElement;

    //Get previous
    while (
        tr.previousElementSibling &&
        !tr.previousElementSibling.children[index].classList.contains(
            'cell-black'
        )
    ) {
        tr = tr.previousElementSibling;
        cells.unshift(tr.children[index]);
    }

    //Check if there's a clue
    if (!cells[0].querySelector('label')) {
        return null;
    }

    //Get next
    tr = td.parentElement;
    while (
        tr.nextElementSibling &&
        !tr.nextElementSibling.children[index].classList.contains('cell-black')
    ) {
        tr = tr.nextElementSibling;
        cells.push(tr.children[index]);
    }

    return cells;
};

document.getElementById('unit1-act32').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = [["THERE IS ONE BASKET", "THERE ARE SIX CUPS", "THERE ARE NINETEEN JOCOTES", "THERE ARE SIX DISHES", "THERE ARE TEN ORANGES", "THERE ARE TWELVE SPOONS", "THERE ARE FIVE APPLES", "THERE ARE SIX KNIVES", "THERE ARE SIX GLASSES"],
    ["THERE IS 1 BASKET", "THERE ARE 6 CUPS", "THERE ARE 19 JOCOTES", "THERE ARE 6 DISHES", "THERE ARE 10 ORANGES", "THERE ARE 12 SPOONS", "THERE ARE 5 APPLES", "THERE ARE 6 KNIVES", "THERE ARE 6 GLASSES"]];

    //Llenar arreglo de inputs
    for (let i = 0; i < 9; i++) {
        inputs[i] = document.getElementById('input-act32-' + (i + 1)).value.toUpperCase();

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
                if (inputs[i].trim().includes(respuestas[0][i]) || inputs[i].trim().includes(respuestas[1][i])) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente32').value = users.value;
                document.getElementById('points32').value = valorActividad;
                document.getElementById('idlibro32').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act32', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act32').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, count and write your answer, remember to answer using there are/there is correctly', null);
                return true;
            }
        }

    }

});

document.getElementById('unit1-act33').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];

    //Llenar arreglo de inputs
    for (let i = 0; i < 9; i++) {
        inputs[i] = document.getElementById('input-act33-' + (i + 1)).value.toUpperCase();

    }

    //Se verifica si ha respondido todas 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        var libro = 4;
        document.getElementById('idcliente33').value = users.value;
        document.getElementById('points33').value = valorActividad;
        document.getElementById('idlibro33').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act33', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act33').modal('hide');
        return true;

    }

});

document.getElementById("unit1-act34").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 0.19;

    let inputs = [];
    let respuestas = ["TEN", "TWENTY ONE", "EIGHT", "THIRTY", "SIX", "TWENTY FIVE", "THIRTY", "THREE", "TWENTY EIGHT", "THIRTY", "THIRTY"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('input-act34-' + (i + 1)).value;
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
            document.getElementById('idcliente34').value = users.value;
            document.getElementById('points34').value = valorActividad;
            document.getElementById('idlibro34').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act34', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act34').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente34').value = users.value;
            document.getElementById('points34').value = points;
            document.getElementById('idlibro34').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act34', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act34').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act35').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["T", "O", "V", "A", "I", "E", "E", "F", "R", "I", "G", "E", "A", "T", "O", "O", "A", "E", "I", "O", "W", "A", "E", "E", "E", "O", "R", "O", "F", "E", "E", "O", "O", "O", "I", "E", "A", "S", "I", "H", "U"]

    //Llenar arreglo de inputs
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act35-' + (i + 1)).value.toUpperCase();

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
            document.getElementById('idcliente35').value = users.value;
            document.getElementById('points35').value = valorActividad;
            document.getElementById('idlibro35').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act35', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act35').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente35').value = users.value;
            document.getElementById('points35').value = points;
            document.getElementById('idlibro35').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act35', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act35').modal('hide');
            return true;
        }

    }

});

document.getElementById("unit1-act36").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    let inputs = [];
    //Llenar arreglo de inputs
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('text-act36-' + (i + 1)).innerHTML;
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (document.getElementById("verify-canvas").value == 0) {
            sweetAlert(2, 'Draw a face based on your answers', null);
            return false;
        } else {
            var libro = 4;
            document.getElementById('idcliente36').value = users.value;
            document.getElementById('points36').value = valorActividad;
            document.getElementById('idlibro36').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act36', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act36').modal('hide');
            return true;
        }
    }

});

//Elementos arrastrables act36
for (let i = 0; i < 2; i++) {
    document.getElementById('option-act36-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act36
for (let i = 0; i < 11; i++) {
    document.getElementById('text-act36-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;

    });

    document.getElementById('text-act36-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

$('#ModalUnit1Act36').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas36');
    // Clear event listener
    document.getElementById("clear-btn36").addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });
});

document.getElementById('unit1-act37').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["L", "A", "R", "C", "L", "O", "C", "A", "M", "E", "L", "O", "C", "R", "A", "D", "I", "H", "E", "E", "I", "L", "L", "O", "I", "G", "H", "T", "A", "B", "L", "E", "I", "N", "D", "O", "R", "E", "S", "S", "E", "A", "P", "E", "L", "S", "E", "I", "C", "T", "U", "R"]

    //Llenar arreglo de inputs
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act37-' + (i + 1)).value.toUpperCase();

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
            document.getElementById('idcliente37').value = users.value;
            document.getElementById('points37').value = valorActividad;
            document.getElementById('idlibro37').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act37', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act37').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente37').value = users.value;
            document.getElementById('points37').value = points;
            document.getElementById('idlibro37').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act37', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act37').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act38').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let wrongInputs = [];

    //Llenar arreglo de inputs
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('radio-act38-' + (i + 1)).checked;
        if (inputs[i]) {
            conteo++;
        }

    }
    for (let i = 0; i < 5; i++) {
        wrongInputs[i] = document.getElementById('radio-act38--' + (i + 1)).checked;
        if (wrongInputs[i]) {
            conteo--;
        }
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == 10) {
        var libro = 4;
        document.getElementById('idcliente38').value = users.value;
        document.getElementById('points38').value = valorActividad;
        document.getElementById('idlibro38').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act38', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act38').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad / (inputs.length);
        let points = (puntaje * conteo).toFixed(2);
        var libro = 4;
        document.getElementById('idcliente38').value = users.value;
        document.getElementById('points38').value = points;
        document.getElementById('idlibro38').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act38', 'modal');
        sweetAlert(4, 'Some answers are wrong', null);
        $('#ModalUnit1Act38').modal('hide');
        return true;
    }


});

$('#ModalUnit1Act39').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas39');
    // Clear event listener
    document.getElementById("clear-btn39").addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });
});

document.getElementById('unit1-act39').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.19;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw an x on your preference', null);
        return false;
    }
    else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente39').value = users.value;
        document.getElementById('points39').value = points;
        document.getElementById('idlibro39').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act39', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act39').modal('hide');
        return true;
    }

});

document.getElementById('unit1-act41').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["O", "W", "E", "I", "N", "O", "A", "H", "A", "M", "P", "O", "O", "I", "L", "E", "T", "P", "A", "P", "R", "O", "O", "T", "H", "B", "R", "U", "S", "O", "A", "P", "D", "I", "S", "H", "O", "W", "R", "C", "U", "R", "A", "I", "U", "B", "I", "R", "O", "R", "O", "I", "L", "E"];

    //Llenar arreglo de inputs
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act41-' + (i + 1)).value.toUpperCase();

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
            document.getElementById('idcliente41').value = users.value;
            document.getElementById('points41').value = valorActividad;
            document.getElementById('idlibro41').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act41', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act41').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente41').value = users.value;
            document.getElementById('points41').value = points;
            document.getElementById('idlibro41').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act41', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act41').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit1-act42').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let selects = [];

    //Llenar arreglo de inputs
    for (let i = 0; i < 9; i++) {
        selects[i] = document.getElementById('select-act42-' + (i + 1)).value;
        inputs[i] = document.getElementById('input-act42-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("") || selects.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente42').value = users.value;
        document.getElementById('points42').value = valorActividad;
        document.getElementById('idlibro42').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act42', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act42').modal('hide');
        return true;

    }

});

$('#ModalUnit1Act43').on('shown.bs.modal', function (e) {
    if (intervalo) {
        clearInterval(intervalo);
    }
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas43');

    // Get elements from DOM and define properties
    var color43Picker = document.getElementById("color43Picker");
    var width43StrokePicker = document.getElementById("stroke43WidthPicker");
    var clear43Button = document.getElementById("clear43Btn");

    // Clear event listener
    clear43Button.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        color2Stroke = color43Picker.value;
        widthStroke = width43StrokePicker.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit1-act43').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.19;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Color the indicated parts', null);
        return false;
    }
    else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente43').value = users.value;
        document.getElementById('points43').value = points;
        document.getElementById('idlibro43').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act43', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act43').modal('hide');
        return true;
    }

});

$('#ModalUnit1Act44').on('shown.bs.modal', function (e) {
    if (intervalo) {
        clearInterval(intervalo);
    }
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas44');

    // Get elements from DOM and define properties
    var color43Picker = document.getElementById("color44Picker");
    var width43StrokePicker = document.getElementById("stroke44WidthPicker");
    var clear43Button = document.getElementById("clear44Btn");

    // Clear event listener
    clear43Button.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        color2Stroke = color44Picker.value;
        widthStroke = width44StrokePicker.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit1-act44').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.252;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw and color', null);
        return false;
    }
    else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente44').value = users.value;
        document.getElementById('points44').value = points;
        document.getElementById('idlibro44').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act44', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act44').modal('hide');
        return true;
    }

});

document.getElementById('unit1-act40').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let imgs = [];
    let respuestasTxt = ["A", "D", "I", "O", "L", "A", "R", "A", "M", "A", "N", "K", "E", "T", "E", "I", "L", "L", "O", "S", "I", "G", "H", "T", "A", "B", "L", "E", "I", "N", "D", "O", "L", "S", "E", "A", "N", "K", "E", "U", "T", "A", "I", "N"];
    let respuestasImg = [["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"], ["1", "2", "3", "8", "5", "6", "10", "4", "9", "7"], ["1", "2", "3", "9", "5", "6", "10", "8", "4", "7"]]

    //Llenar arreglo de inputs
    for (let i = 0; i < 44; i++) {
        inputs[i] = document.getElementById("input-act40-" + (i + 1)).value.toUpperCase();

    }
    for (let i = 0; i < 10; i++) {
        imgs[i] = $("#img-act40-" + (i + 1)).attr("alt").toUpperCase();

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        for (let i = 0; i < 10; i++) {
            if (imgs[i].trim().includes(respuestasImg[0][i]) || imgs[i].trim().includes(respuestasImg[1][i]) || imgs[i].trim().includes(respuestasImg[2][i])) {
                conteo++;
            }

        }

        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i] == respuestasTxt[i]) {
                conteo++;
            }

        }
        //Se revisa si todas las respuestas son correctas
        if (conteo == 54) {
            var libro = 4;
            document.getElementById('idcliente40').value = users.value;
            document.getElementById('points40').value = valorActividad;
            document.getElementById('idlibro40').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act40', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act40').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 54;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente40').value = users.value;
            document.getElementById('points40').value = points;
            document.getElementById('idlibro40').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act40', 'modal');
            sweetAlert(4, conteo + '/' + 54 + ' answers right', null);
            $('#ModalUnit1Act40').modal('hide');
            return true;
        }
    }

});


//Elementos arrastrables act40

for (let i = 0; i < 10; i++) {
    document.getElementById('img-act40-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act40

for (let i = 0; i < 10; i++) {
    document.getElementById('box-act40-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act40-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById("unit1-act45").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 0.252;

    let inputs = [];
    let respuestas = ["TEN", "FORTY", "THIRTY TWO", "SEVEN", "FORTY", "THIRTY FIVE", "FOUR", "FORTY", "THIRTY EIGHT", "ONE", "ZERO"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('input-act45-' + (i + 1)).value;
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
            document.getElementById('idcliente45').value = users.value;
            document.getElementById('points45').value = valorActividad;
            document.getElementById('idlibro45').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act45', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act45').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente45').value = users.value;
            document.getElementById('points45').value = points;
            document.getElementById('idlibro45').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act45', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act45').modal('hide');
            return true;
        }

    }

});

document.getElementById("unit1-act46").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 0.252;

    let inputs = [];
    let respuestas = ["THIRTY", "THIRTY SIX", "THIRTY ONE", "THIRTY SEVEN", "THIRTY TWO", "THIRTY EIGHT", "THIRTY THREE", "THIRTY NINE", "THIRTY FOUR", "FORTY", "THIRTY FIVE"];
    let conteo = 0;
    //Llenar arreglo de inputs
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('input-act46-' + (i + 1)).value;
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
            document.getElementById('idcliente46').value = users.value;
            document.getElementById('points46').value = valorActividad;
            document.getElementById('idlibro46').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act46', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act46').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente46').value = users.value;
            document.getElementById('points46').value = points;
            document.getElementById('idlibro46').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act46', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act46').modal('hide');
            return true;
        }

    }

});

document.getElementById("unit1-act47").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 0.19;

    let inputs = [];
    let conteo = 0, verifyChecks = 0;
    //Llenar arreglo de inputs y se verifica que haya seleccionado al menos una de cada línea
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('radio-act47-' + (i + 1)).checked;
        if (inputs[i]) {
            verifyChecks++;
        }
    }
    console.log(verifyChecks)
    //Se verifican las opciones seleccionadas
    if (inputs[0] || inputs[1]) {
        conteo++;
    }
    if (inputs[3]) {
        conteo++;
    }
    if (inputs[4] || inputs[5]) {
        conteo++;
    }
    if (inputs[6] || inputs[7]) {
        conteo++;
    }
    if (inputs[8] || inputs[9]) {
        conteo++;
    }
    if (inputs[11]) {
        conteo++;
    }
    if (inputs[13]) {
        conteo++;
    }
    if (inputs[14] || inputs[15]) {
        conteo++;
    }
    if (inputs[16]) {
        conteo++;
    }
    if (inputs[18]) {
        conteo++;
    }
    if (verifyChecks == 10) {
        //Se revisa si todas las respuestas son correctas
        if (conteo == 10) {
            var libro = 4;
            document.getElementById('idcliente47').value = users.value;
            document.getElementById('points47').value = valorActividad;
            document.getElementById('idlibro47').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act47', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act47').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 10;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente47').value = users.value;
            document.getElementById('points47').value = points;
            document.getElementById('idlibro47').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act47', 'modal');
            sweetAlert(4, conteo + '/' + '10' + ' answers right', null);
            $('#ModalUnit1Act46').modal('hide');
            return true;
        }
    } else {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }


});

document.getElementById('unit1-act48').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let imgs = [];
    let respuestasImg = ["STUDYING", "READING", "RUNNING", "EATING", "TALKING", "SHOWER", "WALKING", "WASHING", "SLEEPING", "JUMPING"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 10; i++) {
        imgs[i] = $("#img-act48-" + (i + 1)).attr("alt").toUpperCase();

    }

    for (let i = 0; i < imgs.length; i++) {
        if (imgs[i].trim().includes(respuestasImg[i])) {
            conteo++;
        }

    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 4;
        document.getElementById('idcliente48').value = users.value;
        document.getElementById('points48').value = valorActividad;
        document.getElementById('idlibro48').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act48', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act48').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad / imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 4;
        document.getElementById('idcliente48').value = users.value;
        document.getElementById('points48').value = points;
        document.getElementById('idlibro48').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act48', 'modal');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit1Act48').modal('hide');
        return true;
    }


});
//Elementos arrastrables act48

for (let i = 0; i < 10; i++) {
    document.getElementById('img-act48-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act28

for (let i = 0; i < 10; i++) {
    document.getElementById('box-act48-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act48-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit1-act50').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.252;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["LITTLE BIRD", "MOUNTAIN", "MADE", "HOLE", "TREE", "NEST", "TREE DAWNS", "MUSIC", "CHEST", "HAD", "HEART"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('input-act50-' + (i + 1)).value;

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
            document.getElementById('idcliente50').value = users.value;
            document.getElementById('points50').value = valorActividad;
            document.getElementById('idlibro50').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act50', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act50').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente50').value = users.value;
            document.getElementById('points50').value = points;
            document.getElementById('idlibro50').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act50', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act50').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act51').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.252;
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let answers = [ "D", "I", "N", "N", "E", "R", "B", "I", "U", "N", "C", "L", "E", "D", "A", "N", "A", "M", "E", "B", "K", "R", "T", "I", "B", "E", "N", "G", "L", "I", "S", "H", "F", "E", "H", "A", "I", "I", "N", "P", "R", "G", "A", "R", "A", "U", "F", "R", "K", "O", "O", "R", "T", "V", "T", "E", "L", "S", "R", "O", "O", "H", "E", "I", "G", "H", "T", "T", "M", "O", "E", "F", "I", "S", "H", "S", "M", "R", "H", "O", "U", "S", "E", "F", "O", "U", "R", "Y", "E", "L", "L", "O", "W", "S", "O", "N", "N"];
    //Llenar arreglo de inputs
    for (let i = 0; i < 97; i++) {
        inputs[i] = document.getElementById('input-act51-' + (i + 1)).value.toUpperCase();
        console.log(inputs[i] + answers[i])

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].trim().includes(answers[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == answers.length) {
            var libro = 4;
            document.getElementById('idcliente51').value = users.value;
            document.getElementById('points51').value = valorActividad;
            document.getElementById('idlibro51').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act51', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act51').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente51').value = users.value;
            document.getElementById('points51').value = points;
            document.getElementById('idlibro51').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act51', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit1Act51').modal('hide');
            return true;
        }

    }

});

const table51 = document.querySelector('.table-cross51l4');
table51.addEventListener('keydown', handleKeyDown);

document.getElementById('unit1-act49').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.19;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let bedroom = ["PILLOW", "BED", "LAMP", "SHEET", "CLOSET", "DRESSER", "CURTAIN", "NIGHT TABLE"];
    let living = ["TELEPHONE", "SOFA", "FAN", "STEREO", "TELEVISION", "COFFEE TABLE", "CLOCK"];
    let kitchen = ["CABINET", "MICROWAVE", "REFRIGERATOR", "DISH", "COFFEE MAKER", "STOVE", "BLENDER", "FORK", "KNIFE", "POT", "CUP", "TOASTER", "SPOON", "GLASS"];
    let dining = ["PICTURES", "LAMP", "CHAIR", "TABLE", "CABINET"];
    let bathroom = ["TOOTHPASTE", "TOOTHBRUSH", "SHOWER", "TOWEL", "SINK", "MIRROR", "TOILET PAPER", "SHAMPOO","SOAP"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 42; i++) {
        inputs[i] = document.getElementById('input-act49-' + (i + 1)).value;

    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 8; i++) {
            for (let j = 0; j < bedroom.length; j++) {
                if (inputs[i].toUpperCase() == (bedroom[j])) {
                    conteo++;
                    bedroom[j] = "";
                }
            }
        }
        //Se comparan las respuestas con los datos ingresados
        for (let i = 8; i < 15; i++) {
            for (let j = 0; j < living.length; j++) {
                if (inputs[i].toUpperCase() == (living[j])) {
                    conteo++;
                    living[j] = "";
                }
            }
        }
        //Se comparan las respuestas con los datos ingresados
        for (let i = 15; i < 28; i++) {
            for (let j = 0; j < kitchen.length; j++) {
                if (inputs[i].toUpperCase() == (kitchen[j])) {
                    conteo++;
                    kitchen[j] = "";
                }
            }
        }
        //Se comparan las respuestas con los datos ingresados
        for (let i = 28; i < 33; i++) {
            for (let j = 0; j < dining.length; j++) {
                if (inputs[i].toUpperCase() == dining[j]) {
                    conteo++;
                    dining[j] = "";
                }
            }
        }
        //Se comparan las respuestas con los datos ingresados
        for (let i = 33; i < 42; i++) {
            for (let j = 0; j < bathroom.length; j++) {
                if (inputs[i].toUpperCase() == (bathroom[j])) {
                    conteo++;
                    bathroom[j] = "";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente49').value = users.value;
            document.getElementById('points49').value = valorActividad;
            document.getElementById('idlibro49').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act49', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act49').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente49').value = users.value;
            document.getElementById('points49').value = points;
            document.getElementById('idlibro49').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act49', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit1Act49').modal('hide');
            return true;
        }
    }

});