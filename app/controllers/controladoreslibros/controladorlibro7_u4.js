const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var color2Stroke, widthStroke, intervalo;

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas2');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("colorPicker");
    var widthStrokePicker = document.getElementById("strokeWidthPicker");
    var clear2Button = document.getElementById("clearBtn");

    // Clear event listener
    clear2Button.addEventListener("click", function () {
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

document.getElementById('unit4-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["TWO HUNDRED", "THREE HUNDRED", "FOUR HUNDRED AND FIFTEEN", "FIVE HUNDRED", "SIX HUNDRED AND EIGHT", "SEVEN HUNDRED", "EIGHT HUNDRED AND TWENTY", "NINE HUNDRED", "NINE HUNDRED AND ONE", "ONE THOUSAND"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act1-' + (i + 1)).value.trim();
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (inputs[i].toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act1').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act2').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["ONE DOLLAR", "FIVE DOLLARS", "TEN DOLLARS", "FIFTY DOLLARS", "ONE HUNDRED DOLLARS", "PENNY", "NICKEL", "DIME", "QUARTER", "HALF DOLLAR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act2-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act2', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act2').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act2', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act2').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act3').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "3", "3", "1", "2", "2", "1"];
    let respuestasInputs = ["SHIRT", "HAT", "SHOES", "DRESS", "TV", "RADIO", "CAR", "PURSE"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act3-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length; i++) {
        inputs[i] = document.getElementById('input-act3-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        var conteoInputs = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }
        for (let i = 0; i < respuestasInputs.length; i++) {
            if (inputs[i].includes(respuestasInputs[i])) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
            var libro = 7;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = valorActividad;
            document.getElementById('idlibro3').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act3', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act3').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
            let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act3', 'modal');
            sweetAlert(4, conteo + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
            $('#ModalUnit4Act3').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit4-act4').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "2", "1", "3", "3", "1"];
    let respuestasInputs = ["MICROWAVE", "REFRIGERATOR", "OVEN", "STOVE", "UMBRELLA", "GLASSES", "WALLET", "BOOTS"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act4-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        var conteoInputs = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }
        for (let i = 0; i < respuestasInputs.length; i++) {
            if (inputs[i].includes(respuestasInputs[i])) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
            var libro = 7;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act4').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
            let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act4', 'modal');
            sweetAlert(4, conteo + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
            $('#ModalUnit4Act4').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit4-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "2"];
    let respuestasInputs = ["ONE DOLLAR", "FIVE DOLLARS", "TEN DOLLARS", "HUNDRED DOLLARS", "PENNY", "NICKEL", "DIME", "QUARTER", "TWO HUNDRED", "FOUR HUNDRED", "FIVE HUNDRED", "SIX HUNDRED", "SEVEN HUNDRED", "EIGHT HUNDRED", "NINE HUNDRED", "ONE THOUSAND"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act5-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 2; i++) {
        inputs[i] = document.getElementById('input-act5-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        var conteoInputs = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }
        for (let i = 0; i < respuestasInputs.length; i++) {
            if (inputs[i].includes(respuestasInputs[i])) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act5').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
            let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'modal');
            sweetAlert(4, conteo + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
            $('#ModalUnit4Act5').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit4-act6').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["TIE", "EARRINGS", "SHIRT", "BRACELET", "SOCKS", "JACKET", "SUNGLASSES", "WATCH"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act6', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act6').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act6', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act6').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act7').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["TABLE", "CHAIR", "DESK", "CABINET", "BED", "SOFA", "MIRROR", "NIGHT TABLE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act7-' + (i + 1)).value.trim();
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (inputs[i].toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = valorActividad;
            document.getElementById('idlibro7').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act7', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act7').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = points;
            document.getElementById('idlibro7').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act7', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act7').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "2", "1", "2", "1", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act8-' + (i + 1)).value;
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
            var libro = 7;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act8').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act8', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act8').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit4-act9').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "2", "4", "7"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('cb9-' + (i + 1)).checked;
        if (inputs[i]) {
            conteocb++;
        }
        for (let j = 0; j < respuestas.length; j++) {
            if (respuestas[j] == (i + 1) && inputs[i]) {
                conteo++;
            }
        }
    }

    if (conteocb == 0) {
        sweetAlert(2, 'Select at least one option', null);
        return false;
    } else {
        if (conteocb > 4) {
            sweetAlert(2, 'Select only four options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente9').value = users.value;
                document.getElementById('points9').value = valorActividad;
                document.getElementById('idlibro9').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act9', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit4Act9').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente9').value = users.value;
                document.getElementById('points9').value = points;
                document.getElementById('idlibro9').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act9', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit4Act9').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit4-act10').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let boxes = [];

    //Se obtienen las boxes y se guarda en boxes[]
    for (let i = 0; i < 4; i++) {
        boxes[i] = document.getElementById('box-act10-' + (i + 1));
        if (boxes[i].textContent != "") {
            conteo++;
        }
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == 4) {
        var libro = 7;
        document.getElementById('idcliente10').value = users.value;
        document.getElementById('points10').value = valorActividad;
        document.getElementById('idlibro10').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit4-act10', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit4Act10').modal('hide');
        return true;
    } else {
        sweetAlert(2, 'Select at least one item for each weather', null);
        return false;
    }
});

//Elementos arrastrables act10

for (let i = 0; i < 8; i++) {
    document.getElementById('option-act10-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act10
for (let i = 0; i < 4; i++) {
    document.getElementById('box-act10-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act10-' + (i + 1));

        //Se verifica que sea el espacio para el texto.
        if ((e.target.id == ('box-act10-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            //Se obtienen los valores de texto dentro del box y del arrastrable
            let boxText = e.target.textContent;
            let dragText = document.getElementById(id).textContent;

            if (!boxText.includes(dragText)) {
                e.target.textContent = e.target.textContent + (document.getElementById(id).textContent) + "\n";
            }

        }

    });

    document.getElementById('box-act10-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

$('#ModalUnit4Act11').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas2');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("colorPicker");
    var widthStrokePicker = document.getElementById("strokeWidthPicker");
    var clear2Button = document.getElementById("clearBtn");

    // Clear event listener
    clear2Button.addEventListener("click", function () {
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

document.getElementById('unit4-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "1", "2", "2", "1", "1", "2", "3", "3"];
    let respuestasInputs = ["TIE", "EARRING", "SHIRT", "BELT", "SOCK", "JACKET", "GLASSES", "WATCH"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act11-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 1; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("") || document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        var conteoInputs = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }
        for (let i = 0; i < respuestasInputs.length; i++) {
            if (inputs[i].includes(respuestasInputs[i])) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
                var libro = 7;
                document.getElementById('idcliente11').value = users.value;
                document.getElementById('points11').value = valorActividad;
                document.getElementById('idlibro11').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act11', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit4Act11').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente11').value = users.value;
                document.getElementById('points11').value = points;
                document.getElementById('idlibro11').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act11', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
                $('#ModalUnit4Act11').modal('hide');
                return true;
            }
    }

});

document.getElementById('unit4-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('box-act12-' + (i + 1));

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //Verificar drinks
    for (let i = 1; i < 7; i++) {
        if (inputs[0].querySelector('#option-act12-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar foods
    for (let i = 7; i < 13; i++) {
        if (inputs[1].querySelector('#option-act12-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar fruits
    for (let i = 13; i < 19; i++) {
        if (inputs[2].querySelector('#option-act12-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar vegetables
    for (let i = 19; i < 25; i++) {
        if (inputs[3].querySelector('#option-act12-' + (i)) !== null) {
            conteo++;
        }

    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == 24) {
            var libro = 7;
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act12', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act12').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 24
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = points;
            document.getElementById('idlibro12').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act12', 'modal');
            sweetAlert(4, conteo + '/24 answers right', null);
            $('#ModalUnit4Act12').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act12

for (let i = 0; i < 24; i++) {
    document.getElementById('option-act12-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act12
for (let i = 0; i < 4; i++) {
    document.getElementById('box-act12-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act12-' + (i + 1));

        //Se verifica que sea el espacio para el texto.
        if ((e.target.id == ('box-act12-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        }

    });

    document.getElementById('box-act12-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit4-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "4", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act13-' + (i + 1)).value;
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
            var libro = 7;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act13').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = points;
            document.getElementById('idlibro13').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act13', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit4Act13').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act14').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = [["MAY I HELP YOU", "HOW CAN I HELP YOU", "CAN I SEE THAT SHIRT", "CAN I SEE THOSE SHOES", "ANYTHING ELSE", "IS THAT ALL", "DO YOU HAVE CHANGE FOR A TWENTY", "HERE IS YOUR CHANGE"], ["MAY I HELP YOU", "HOW CAN I HELP YOU", "CAN I SEE THAT SHIRT", "CAN I SEE THOSE SHOES", "ANYTHING ELSE", "IS THAT ALL", "DO YOU HAVE CHANGE FOR A TWENTY", "HERE'S YOUR CHANGE"]];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act14-' + (i + 1)).value.trim();
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 8; i++) {
            if (inputs[i].toUpperCase().includes(respuestas[0][i]) || inputs[i].toUpperCase().includes(respuestas[1][i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == 8) {
            var libro = 7;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = valorActividad;
            document.getElementById('idlibro14').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act14', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act14').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 7;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act14', 'modal');
            sweetAlert(4, conteo + '/' + 8 + ' answers right', null);
            $('#ModalUnit4Act14').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit4-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('box-act15-' + (i + 1));

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //Verificar dairy products
    for (let i = 1; i < 6; i++) {
        if (inputs[0].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar foods
    for (let i = 6; i < 11; i++) {
        if (inputs[1].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar fruits
    for (let i = 11; i < 16; i++) {
        if (inputs[2].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar vegetables
    for (let i = 16; i < 21; i++) {
        if (inputs[3].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }

    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == 20) {
            var libro = 7;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act15', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act15').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 20
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act15', 'modal');
            sweetAlert(4, conteo + '/20 answers right', null);
            $('#ModalUnit4Act15').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act15

for (let i = 0; i < 20; i++) {
    document.getElementById('option-act15-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act15
for (let i = 0; i < 4; i++) {
    document.getElementById('box-act15-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act15-' + (i + 1));

        //Se verifica que sea el espacio para el texto.
        if ((e.target.id == ('box-act15-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        }

    });

    document.getElementById('box-act15-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit4-act16').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    let respuestas = [["SPINACH", "CELERY", "ONION", "BEET", "MUSHROOM"], ["ORANGE", "GRAPES", "CHERRIES", "STRAWBERRIES", "LIME"], ["WATER", "PEPSI", "GATORADE", "LEMONADE", "REFRESHMENT"], ["EGGS", "SANDWICH", "TURKEY", "MACARONI", "SEAFOOD"]]
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputsVegetables = [];
    let inputsFruit = [];
    let inputsDrink = [];
    let inputsFood = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 4; i++) {
        for (let j = 0; j < 5 ;j++) {
            let input = document.getElementById('input-act16-' + (j + 1) + "-" + (i + 1)).value.trim();
            switch (i) {
                case 0:
                    inputsVegetables[j] = input;
                    break;
                case 1:
                    inputsFruit[j] = input;
                    break;
                case 2:
                    inputsDrink[j] = input;
                    break;
                case 3:
                    inputsFood[j] = input;
                    break;
                default:
                    break;
            }
        }
    }
    //declaración de condicionales 
    if (inputsVegetables.includes("") || inputsDrink.includes("") || inputsFood.includes("") || inputsFruit.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 5; i++) {
            for (let j = 0; j < 5; j++) {
                if (inputsVegetables[i].trim().toUpperCase().includes(respuestas[0][j])) {
                    conteo++;
                    respuestas[0][j] = "~";
                }
                if (inputsFruit[i].trim().toUpperCase().includes(respuestas[1][j])) {
                    conteo++;
                    respuestas[1][j] = "~";
                }
                if (inputsDrink[i].trim().toUpperCase().includes(respuestas[2][j])) {
                    conteo++;
                    respuestas[2][j] = "~";
                }
                if (inputsFood[i].trim().toUpperCase().includes(respuestas[3][j])) {
                    conteo++;
                    respuestas[3][j] = "~";
                }
            }
        }
        //Se revisa si todas las respuestas son correctas
        if (conteo == 20) {
            var libro = 7;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = valorActividad;
            document.getElementById('idlibro16').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act16', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit4Act16').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 20
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = points;
            document.getElementById('idlibro16').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act16', 'modal');
            sweetAlert(4, conteo + '/20 answers right', null);
            $('#ModalUnit4Act16').modal('hide');
            return true;
        }
    }
});