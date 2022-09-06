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

document.getElementById('unit5-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["SEPTEMBER 1, 1989", "NOVEMBER 23, 2016", "OCTOBER 9, 2010", "MAY 30, 2004", "AUGUST 29, 2002"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit5-act2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('input-act2-' + (i + 1)).value.toUpperCase();

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
                document.getElementById('idcliente2').value = users.value;
                document.getElementById('points2').value = valorActividad;
                document.getElementById('idlibro2').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act2', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act2').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences using the days of the week', null);
                return true;
            }
        }

    }

});

document.getElementById('unit5-act3').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MARCH", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act3-' + (i + 1)).value.toUpperCase();

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
                if (respuestas.some(element => inputs[i].includes(element)) && inputs[i].length > 8) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente3').value = users.value;
                document.getElementById('points3').value = valorActividad;
                document.getElementById('idlibro3').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act3', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act3').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write sentences using the months of the the year', null);
                return true;
            }
        }

    }

});

document.getElementById('unit5-act4').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["FIRST", "SECOND", "THIRD", "FOURTH", "FIFTH", "SIXTH", "SEVENTH", "EIGHTH", "NINTH", "TENTH", "ELEVENTH", "TWELFTH", "THIRTEENTH", "FOURTEENTH", "FIFTEENTH", "SIXTEENTH", "SEVENTEENTH", "EIGHTEENTH", "NINETEENTH", "TWENTIETH", "TWENTY-FIRST", "TWENTY-SECOND", "TWENTY-THIRD", "TWENTY-FOURTH", "TWENTY-FIFTH", "TWENTY-SIXTH", "TWENTY-SEVENTH", "TWENTY-EIGHTH", "TWENTY-NINTH", "THIRTIETH", "THIRTY-FIRST"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act4').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act4', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act4').modal('hide');
            return true;
        }
    }
});

$('#ModalUnit5Act5').on('shown.bs.modal', function (e) {
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

document.getElementById('unit5-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "3"];
    let respuestasInputs = ["MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY", "THIRD", "TWELFTH", "FIFTEENTH", "TWENTY-SECOND", "TWENTY-SIXTH", "THIRTIETH"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act5-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 1; i++) {
        inputs[i] = document.getElementById('input-act5-' + (i + 1)).value.trim().toUpperCase();

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
            if (i < 7) {
                for (let j = 0; j < 7; j++) {
                    if (inputs[i].trim().toUpperCase().includes(respuestasInputs[j])) {
                        conteoInputs++;
                        respuestasInputs[j] = "~";
                    }
                }
            } else {
                if (inputs[i].includes(respuestasInputs[i])) {
                    conteoInputs++;
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act5').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act5', 'modal');
            sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
            $('#ModalUnit5Act5').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act6').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MARCH", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value.toUpperCase();

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
                if (respuestas.some(element => inputs[i].includes(element)) && inputs[i].length > 4) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente6').value = users.value;
                document.getElementById('points6').value = valorActividad;
                document.getElementById('idlibro6').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act6', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act6').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, write your family members\' birthdays', null);
                return true;
            }
        }

    }

});

document.getElementById('unit5-act7').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["FIFTEEN YEARS OLD", "WHEN WAS HE BORN", "HE WAS BORN", "HOW OLD", "ON SEPTEMBER"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act7', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act7').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act7', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act7').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit5-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "3", "2"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act8').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act8', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act8').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act9').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "1", "2", "1", "3", "3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act9-' + (i + 1)).value;
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
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = valorActividad;
            document.getElementById('idlibro9').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act9', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act9').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = points;
            document.getElementById('idlibro9').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act9', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act9').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act10').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["SAVIOR OF THE WORLD", "DOWNTOWN", "TRADITIONAL FEAST", "TRADING", "FAIRS", "POPULAR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act10-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act10').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act10', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act10').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit5-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "2", "1", "2", "3", "3", "2", "1", "1", "3", "3", "2", "3"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act11-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 2; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value.trim().toUpperCase();

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

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act11', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act11').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length);
            let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act11', 'modal');
            sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length) + ' answers right', null);
            $('#ModalUnit5Act11').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act12-' + (i + 1)).value;
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
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act12', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act12').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = points;
            document.getElementById('idlibro12').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act12', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act12').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act13').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let input;
    let respuestas = ["NEW YEAR", "VALENTINE", "EASTER", "LABOR", "MOTHER'S", "TEACHER'S", "AUGUST", "INDEPENDENCE", "ALL SOUL", "CHRISTMAS", "DAY", "JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 1; i++) {
        input = document.getElementById('input-act13-' + (i + 1)).value.trim().toUpperCase();

    }

    if (input == "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
        if (respuestas.some(element => input.includes(element) && input.length > 70)) {
            conteo++;
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo > 0) {
            var libro = 7;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act13').modal('hide');
            return true;
        } else {
            //Notificar que las respuestas no siguen el formato
            sweetAlert(2, 'Try again, write a 5-line paragraph and remember to use holidays', null);
            return true;
        }

    }

});

document.getElementById('unit5-act14').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "2", "1", "1", "2"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act14', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act14').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act14', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act14').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act15').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "4", "6"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('cb15-' + (i + 1)).checked;
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
        if (conteocb > 3) {
            sweetAlert(2, 'Select only three options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = valorActividad;
                document.getElementById('idlibro15').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act15', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act15').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = points;
                document.getElementById('idlibro15').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act15', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit5Act15').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit5-act16').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let input;
    let respuestas = ["MOTHER", "DAY", "MAY", "MOM", "FATHER", "DAD", "FAMILY", "SIBLING", "BROTHER", "SISTER", "AUNT", "UNCLE", "GRAND"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 1; i++) {
        input = document.getElementById('input-act16-' + (i + 1)).value.trim().toUpperCase();

    }

    if (input == "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
        if (respuestas.some(element => input.includes(element) && input.length > 70)) {
            conteo++;
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo > 0) {
            var libro = 7;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = valorActividad;
            document.getElementById('idlibro16').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act16', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act16').modal('hide');
            return true;
        } else {
            //Notificar que las respuestas no siguen el formato
            sweetAlert(2, 'Try again, write a 5-line paragraph about what you do in mother\'s day', null);
            return true;
        }

    }

});

document.getElementById('unit5-act17').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "3", "2", "2", "3", "3", "1"];
    let respuestasInputs = ["MOTHER", "DAY", "MAY", "MOM", "FATHER", "DAD", "FAMILY", "SIBLING", "BROTHER", "SISTER", "GRAND", "AUNT", "UNCLE"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act17-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('input-act17-' + (i + 1)).value.trim().toUpperCase();

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
        //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
        if (respuestasInputs.some(element => inputs[0].includes(element) && inputs[0].length > 70)) {
            conteoInputs++;
        }

        if (conteoInputs > 0) {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente17').value = users.value;
                document.getElementById('points17').value = valorActividad;
                document.getElementById('idlibro17').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act17', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act17').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + 1);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente17').value = users.value;
                document.getElementById('points17').value = points;
                document.getElementById('idlibro17').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act17', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + 1) + ' answers right', null);
                $('#ModalUnit5Act17').modal('hide');
                return true;
            }
        } else {
            sweetAlert(2, 'Try again, write a paragraph about what you do in Mother\'s day', null);
            return false;
        }
    }

});

document.getElementById('unit5-act18').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "1", "1", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act18-' + (i + 1)).value;
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
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act18', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act18').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act18', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act18').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act19').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["2", "7", "8"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 8; i++) {
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
        if (conteocb > 3) {
            sweetAlert(2, 'Select only three options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente19').value = users.value;
                document.getElementById('points19').value = valorActividad;
                document.getElementById('idlibro19').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act19', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act19').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente19').value = users.value;
                document.getElementById('points19').value = points;
                document.getElementById('idlibro19').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act19', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit5Act19').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit5-act20').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["CHRISTMAS EVE", "TYPICAL DISHES", "MIDNIGHT", "HALLOWEEN", "VALENTINE'S DAY", "CANDIES SHAPED LIKE HEARTS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act20-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act20', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act20').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act20', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act20').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit5-act21').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "2", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act21-' + (i + 1)).value;
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
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act21', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act21').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act18', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit5Act21').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit5-act22').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let input;
    let respuestas = ["MOTHER", "DAY", "FATHER", "HOLIDAY", "INDEPENDENCE", "ALL SOUL", "VALENTINE", "LABOR", "TEACHER", "EVE", "EASTER", "NEW YEAR", "AUGUST", "PATRON", "SAINT", "HOLLY", "PARADE", "CHRISTMAS", "HALLOWEEN"];

    //Llenar arreglo de inputs
    for (let i = 0; i < 1; i++) {
        input = document.getElementById('input-act22-' + (i + 1)).value.trim().toUpperCase();

    }

    if (input == "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
        if (respuestas.some(element => input.includes(element) && input.length > 70)) {
            conteo++;
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo > 0) {
            var libro = 7;
            document.getElementById('idcliente22').value = users.value;
            document.getElementById('points22').value = valorActividad;
            document.getElementById('idlibro22').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act22', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act22').modal('hide');
            return true;
        } else {
            //Notificar que las respuestas no siguen el formato
            sweetAlert(2, 'Try again, write a paragraph about a holiday', null);
            return true;
        }

    }

});

document.getElementById('unit5-act23').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "1", "1", "2", "1", "3", "1"];
    let respuestascb = ["2", "4"];
    let inputs = [];
    let selects = [];
    let checks = [];
    //variable para llevar el conteo de checkbox seleccionados
    let conteocb = 0;
    let checked = 0;

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act23-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 1; i++) {
        inputs[i] = document.getElementById('input-act23-' + (i + 1)).value.toUpperCase();

    }
    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 6; i++) {
        checks[i] = document.getElementById('cb23-' + (i + 1)).checked;
        if (checks[i]) {
            checked++;
        }
        for (let j = 0; j < respuestascb.length; j++) {
            if (respuestascb[j] == (i + 1) && checks[i]) {
                conteocb++;
            }
        }
    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("") || checked < 1 || checked > 2 || document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Complete the missing fields, only two answers are correct on part IV', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }

        conteo += conteocb;

        //Se revisa si todas las respuestas son correctas
        if (conteo == (respuestas.length + respuestascb.length)) {
            var libro = 7;
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = valorActividad;
            document.getElementById('idlibro23').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act23', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit5Act23').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestascb.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = points;
            document.getElementById('idlibro23').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act23', 'modal');
            sweetAlert(4, conteo + '/' + (respuestas.length + respuestascb.length) + ' answers right', null);
            $('#ModalUnit5Act23').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit5Act23').on('shown.bs.modal', function (e) {
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


document.getElementById('unit5-act24').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "2", "3"];
    let respuestasInputs = ["MOTHER", "DAY", "MAY", "MOM", "FATHER", "DAD", "FAMILY", "SIBLING", "BROTHER", "SISTER", "DAY", "HOLIDAY", "INDEPENDENCE", "ALL SOUL", "VALENTINE", "LABOR", "TEACHER", "EVE", "EASTER", "NEW YEAR", "AUGUST", "PATRON", "SAINT", "HOLLY", "PARADE", "CHRISTMAS", "HALLOWEEN", "GRAND", "UNCLE", "AUNT"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
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
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        var conteoInputs = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == selects[i]) {
                conteo++;
            }

        }
        //Se verifica si lo ingresado contiene algún elemento del array respuestas[]
        if (respuestasInputs.some(element => inputs[0].includes(element) && inputs[0].length > 50) && respuestasInputs.some(element => inputs[1].includes(element) && inputs[1].length > 50)) {
            conteoInputs++;
        }

        if (conteoInputs > 0) {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente24').value = users.value;
                document.getElementById('points24').value = valorActividad;
                document.getElementById('idlibro24').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act24', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit5Act24').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + 1);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente24').value = users.value;
                document.getElementById('points24').value = points;
                document.getElementById('idlibro24').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit5-act24', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + 1) + ' answers right', null);
                $('#ModalUnit5Act24').modal('hide');
                return true;
            }
        } else {
            sweetAlert(2, 'Try again, write a paragraph about the topic mentioned', null);
            return false;
        }
    }

});