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

document.getElementById('unit3-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["MY NAME IS", "NICE TO MEET YOU", "ARE YOU", "EXCUSE ME"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act2').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = [["NINETY-SIX", "ONE HUNDRED AND FIVE", "ONE HUNDRED AND TWELVE", "ONE HUNDRED AND TWENTY-THREE", "ONE HUNDRED AND FIFTY-SIX", "ONE HUNDRED AND SEVENTY-THREE", "TWO HUNDRED"], ["NINETY-SIX", "ONE HUNDRED FIVE", "ONE HUNDRED TWELVE", "ONE HUNDRED TWENTY-THREE", "ONE HUNDRED FIFTY-SIX", "ONE HUNDRED SEVENTY-THREE", "TWO HUNDRED"]];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('input-act2-' + (i + 1)).value.trim();
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 7; i++) {
            if (inputs[i].toUpperCase().includes(respuestas[0][i]) || inputs[i].toUpperCase().includes(respuestas[1][i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == 7) {
            var libro = 7;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act2', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act2').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 7;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act2', 'modal');
            sweetAlert(4, conteo + '/' + 7 + ' answers right', null);
            $('#ModalUnit3Act2').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act3').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act3-' + (i + 1)).value;
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
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = valorActividad;
            document.getElementById('idlibro3').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act3', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act3').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act3', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act3').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act4').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "1"];
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
            var libro = 7;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act4').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act4', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act4').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["ARE YOU", "ARE YOU", "IS YOUR", "A LAWYER", "HOW OLD IS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act5-' + (i + 1)).value.trim();
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
            var libro = respuestas.length;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act5', 'modal');
            sweetAlert(4, conteo + '/' + 7 + ' answers right', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act6').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "2", "1", "3", "1"];
    let respuestasInputs = ["NINETY-ONE", "ONE HUNDRED AND ONE", "ONE HUNDRED", "ONE HUNDRED AND SIXTY", "TWO HUNDRED", "NINETY-EIGHT", "ONE HUNDRED AND FIFTY", "NINETY-FIVE"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act6-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 2; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value.trim().toUpperCase();

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
                document.getElementById('idcliente6').value = users.value;
                document.getElementById('points6').value = valorActividad;
                document.getElementById('idlibro6').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act6', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act6').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente6').value = users.value;
                document.getElementById('points6').value = points;
                document.getElementById('idlibro6').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act6', 'modal');
                sweetAlert(4, conteo + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
                $('#ModalUnit3Act6').modal('hide');
                return true;
            }
    }

});

$('#ModalUnit3Act7').on('shown.bs.modal', function (e) {
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


document.getElementById('unit3-act7').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["MOTHER", "FATHER", "GRANDFATHER", "GRANDMOTHER", "SON", "SISTER", "BROTHER", "DAUGHTER", "UNCLE", "AUNT"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act7-' + (i + 1)).value.toUpperCase();

    }

    if (inputs.includes("") || document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestas.some(element => inputs[i].includes(element)) && inputs[i].length > 5) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act7', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act7').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences with your family ties', null);
                return true;
            }
        }

    }

});

document.getElementById('unit3-act8').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["MOTHER", "FATHER", "GRANDFATHER", "GRANDMOTHER", "SON", "SISTER", "BROTHER", "DAUGHTER", "UNCLE", "AUNT"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act8-' + (i + 1)).value.toUpperCase();

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
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestas.some(element => inputs[i].includes(element)) && inputs[i].length > 5) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente8').value = users.value;
                document.getElementById('points8').value = valorActividad;
                document.getElementById('idlibro8').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act8', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act8').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences with your family ties', null);
                return true;
            }
        }

    }

});

document.getElementById('unit3-act9').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "4", "6", "7"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 7; i++) {
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
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act9', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act9').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo ).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente9').value = users.value;
                document.getElementById('points9').value = points;
                document.getElementById('idlibro9').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act9', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit3Act9').modal('hide');
                return true;
            }
        }

    }

});


document.getElementById('unit3-act10').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "3", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act10-' + (i + 1)).value;
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
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act10').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act10', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act10').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit3Act11').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas3');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("colorPicker2");
    var widthStrokePicker = document.getElementById("strokeWidthPicker2");
    var clear2Button = document.getElementById("clearBtn2");

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

document.getElementById('unit3-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "2"];
    let respuestasInputs = ["MOTHER", "FATHER", "GRANDFATHER", "GRANDMOTHER", "SON", "SISTER", "BROTHER", "DAUGHTER", "UNCLE", "AUNT"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act11-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //variable para obtener la cantidad de respuestas correctas
            var conteo = 0;
            var conteoInputs = 0;
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < 3; i++) {
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestasInputs.some(element => inputs[i].includes(element)) && inputs[i].length > 5) {
                    conteoInputs++;
                }

            }

            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < respuestas.length; i++) {
                if (respuestas[i] == selects[i]) {
                    conteo++;
                }

            }

            if (conteoInputs == 3) {
                //Se revisa si todas las respuestas son correctas
                if (conteo == respuestas.length && conteoInputs == 3) {
                    var libro = 7;
                    document.getElementById('idcliente11').value = users.value;
                    document.getElementById('points11').value = valorActividad;
                    document.getElementById('idlibro11').value = libro;

                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act11', 'modal');
                    sweetAlert(1, 'Good job!', null);
                    $('#ModalUnit3Act11').modal('hide');
                    return true;
                } else {
                    //Se asigna el puntaje basado en las respuestas correctas
                    let puntaje = valorActividad / (respuestas.length + 3);
                    let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                    var libro = 7;
                    document.getElementById('idcliente11').value = users.value;
                    document.getElementById('points11').value = points;
                    document.getElementById('idlibro11').value = libro;
                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act11', 'modal');
                    sweetAlert(4, conteo + '/' + (respuestas.length ) + ' answers right', null);
                    $('#ModalUnit3Act11').modal('hide');
                    return true;
                }
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences with your family ties', null);
                return true;
            }
        }
    }

});

document.getElementById('unit3-act12').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["2", "3", "5", "7", "8", "10"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 11; i++) {
        inputs[i] = document.getElementById('cb12-' + (i + 1)).checked;
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
        if (conteocb > 6) {
            sweetAlert(2, 'Select only six options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente12').value = users.value;
                document.getElementById('points12').value = valorActividad;
                document.getElementById('idlibro12').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act12', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act12').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo ).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente12').value = users.value;
                document.getElementById('points12').value = points;
                document.getElementById('idlibro12').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act12', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit3Act12').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit3-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "1", "2", "2", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act13').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act13', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act13').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act14').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "2", "1", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act14-' + (i + 1)).value;
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
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = valorActividad;
            document.getElementById('idlibro14').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act14', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act14').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act14', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act14').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act15').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["PRETTY", "SERIOUS", "FAST", "QUIET", "BEAUTIFUL", "RICH", "DELICIOUS"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act15-' + (i + 1)).value.toUpperCase();

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
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestas.some(element => inputs[i].includes(element)) && inputs[i].length > 6 && respuestas.some(element => !inputs[i].startsWith(element))) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = valorActividad;
                document.getElementById('idlibro15').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act15', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act15').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences correctly using the adjectives', null);
                return true;
            }
        }

    }

});

document.getElementById('unit3-act16').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "2", "2", "1", "2", "2", "1"];
    let respuestasInputs = [["MOTHER", "FATHER", "GRANDFATHER", "GRANDMOTHER", "SON", "SISTER", "BROTHER", "DAUGHTER", "UNCLE", "AUNT"], ["PRETTY", "SERIOUS", "FAST", "QUIET", "BEAUTIFUL", "RICH", "DELICIOUS"]];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act16-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('input-act16-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //variable para obtener la cantidad de respuestas correctas
            var conteo = 0;
            var conteoInputs = 0;
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < 3; i++) {
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestasInputs[0].some(element => inputs[i].includes(element)) && respuestasInputs[1].some(element => inputs[i].includes(element)) && inputs[i].length > 5) {
                    conteoInputs++;
                }

            }

            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < respuestas.length; i++) {
                if (respuestas[i] == selects[i]) {
                    conteo++;
                }

            }

            if (conteoInputs == 3) {
                //Se revisa si todas las respuestas son correctas
                if (conteo == respuestas.length && conteoInputs == 3) {
                    var libro = 7;
                    document.getElementById('idcliente16').value = users.value;
                    document.getElementById('points16').value = valorActividad;
                    document.getElementById('idlibro16').value = libro;

                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act16', 'modal');
                    sweetAlert(1, 'Good job!', null);
                    $('#ModalUnit3Act16').modal('hide');
                    return true;
                } else {
                    //Se asigna el puntaje basado en las respuestas correctas
                    let puntaje = valorActividad / (respuestas.length + 3);
                    let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                    var libro = 7;
                    document.getElementById('idcliente16').value = users.value;
                    document.getElementById('points16').value = points;
                    document.getElementById('idlibro16').value = libro;
                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act16', 'modal');
                    sweetAlert(4, conteo + '/' + (respuestas.length) + ' answers right', null);
                    $('#ModalUnit3Act16').modal('hide');
                    return true;
                }
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences with your family members and the adjectives correctly', null);
                return true;
            }
        }
    }

});

document.getElementById('unit3-act17').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["COSTA RICAN", "16", "BRAZIL", "BRAZIL", "ENGLISH"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act17-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = valorActividad;
            document.getElementById('idlibro17').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act17', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act17').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = points;
            document.getElementById('idlibro17').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act17', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act17').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act18').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["MECHANIC", "NURSE", "DOCTOR", "COOK", "TEACHER", "SECRETARY", "LAWYER", "ACCOUNTANT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act18-' + (i + 1)).value;
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
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act18', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act18').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act18', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act18').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act19').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.07;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "4", "5", "7"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('cb19-' + (i + 1)).checked;
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
                document.getElementById('idcliente19').value = users.value;
                document.getElementById('points19').value = valorActividad;
                document.getElementById('idlibro19').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act19', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act19').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo ).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente19').value = users.value;
                document.getElementById('points19').value = points;
                document.getElementById('idlibro19').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act19', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit3Act19').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit3-act20').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act20-' + (i + 1)).value;
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
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act14', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = points;
            document.getElementById('idlibro20').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act20', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act21').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["ENGLAND", "ARGENTINA", "CANADA", "BRAZIL", "PORTUGUESE", "ENGLISH", "FRENCH", "ITALIAN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act21-' + (i + 1)).value;
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
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act21', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act21').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = points;
            document.getElementById('idlibro21').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act21', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act21').modal('hide');
            return true;
        }
    }
});

$('#ModalUnit3Act22').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas4');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("colorPicker3");
    var widthStrokePicker = document.getElementById("strokeWidthPicker3");
    var clear2Button = document.getElementById("clearBtn3");

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

document.getElementById('unit3-act22').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "1", "2", "1", "3", "2"];
    let respuestasInputs = ["FRENCH", "SPANISH", "MEXICO", "ENGLISH", "EGYPT", "JAPANESE", "EL SALVADOR"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act22-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 1; i++) {
        inputs[i] = document.getElementById('input-act22-' + (i + 1)).value.trim().toUpperCase();

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
                document.getElementById('idcliente22').value = users.value;
                document.getElementById('points22').value = valorActividad;
                document.getElementById('idlibro22').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act22', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act22').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente22').value = users.value;
                document.getElementById('points22').value = points;
                document.getElementById('idlibro22').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act22', 'modal');
                sweetAlert(4, conteo + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
                $('#ModalUnit3Act22').modal('hide');
                return true;
            }
    }

});

$('#ModalUnit3Act23').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas5');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("colorPicker4");
    var widthStrokePicker = document.getElementById("strokeWidthPicker4");
    var clear2Button = document.getElementById("clearBtn4");

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

document.getElementById('unit3-act23').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "3", "1"];
    let respuestasInputs = ["NINETY-THREE", "ONE HUNDRED AND TWO", "ONE HUNDRED AND FIVE", "ONE HUNDRED AND SEVENTY", "TWO HUNDRED", "NINETY-SEVEN", "ONE HUNDRED AND EIGHTY", "ONE HUNDRED AND SEVENTY-FIVE"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act23-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 2; i++) {
        inputs[i] = document.getElementById('input-act23-' + (i + 1)).value.trim().toUpperCase();

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
                document.getElementById('idcliente23').value = users.value;
                document.getElementById('points23').value = valorActividad;
                document.getElementById('idlibro23').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act23', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act23').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente23').value = users.value;
                document.getElementById('points23').value = points;
                document.getElementById('idlibro23').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act23', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
                $('#ModalUnit3Act23').modal('hide');
                return true;
            }
    }

});

document.getElementById('unit3-act24').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.07;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "1", "1", "2", "2", "3"];
    let respuestasInputs = [["MOTHER", "FATHER", "GRANDFATHER", "GRANDMOTHER", "SON", "SISTER", "BROTHER", "DAUGHTER", "UNCLE", "AUNT"], ["PRETTY", "SERIOUS", "FAST", "QUIET", "BEAUTIFUL", "RICH", "DELICIOUS"]];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length ; i++) {
        selects[i] = document.getElementById('select-act24-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('input-act24-' + (i + 1)).value.trim().toUpperCase();

    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (new Set(inputs).size !== inputs.length) {
            sweetAlert(2, 'All sentences must be different', null);
            return false;
        } else {
            //variable para obtener la cantidad de respuestas correctas
            var conteo = 0;
            var conteoInputs = 0;
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < 3; i++) {
                //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
                if (respuestasInputs[0].some(element => inputs[i].includes(element)) && respuestasInputs[1].some(element => inputs[i].includes(element)) && inputs[i].length > 5) {
                    conteoInputs++;
                }

            }

            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < respuestas.length; i++) {
                if (respuestas[i] == selects[i]) {
                    conteo++;
                }

            }

            if (conteoInputs == 3) {
                //Se revisa si todas las respuestas son correctas
                if (conteo == respuestas.length && conteoInputs == 3) {
                    var libro = 7;
                    document.getElementById('idcliente24').value = users.value;
                    document.getElementById('points24').value = valorActividad;
                    document.getElementById('idlibro24').value = libro;

                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act24', 'modal');
                    sweetAlert(1, 'Good job!', null);
                    $('#ModalUnit3Act24').modal('hide');
                    return true;
                } else {
                    //Se asigna el puntaje basado en las respuestas correctas
                    let puntaje = valorActividad / (respuestas.length + 3);
                    let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                    var libro = 7;
                    document.getElementById('idcliente24').value = users.value;
                    document.getElementById('points24').value = points;
                    document.getElementById('idlibro24').value = libro;
                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit3-act24', 'modal');
                    sweetAlert(4, conteo + '/' + (respuestas.length) + ' answers right', null);
                    $('#ModalUnit3Act24').modal('hide');
                    return true;
                }
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences with your family members and the adjectives correctly', null);
                return true;
            }
        }
    }

});
