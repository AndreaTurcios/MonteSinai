const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';
var colorStroke, widthStroke, intervalo;

$(document).ready(function () {

    function intializeSelect() {
        //Se inicializan los select
        for (let i = 0; i < 5; i++) {
            $('.select-act12-' + (i + 1)).each(function (box) {
                var value = $('.select-act12-' + (i + 1))[box].value;
                if (value) {
                    $('.select-act12-' + (i + 1)).not(this).find('option[value="' + value + '"]').hide();
                }
            });
        }
    };

    intializeSelect();

    //Se llama cada vez que se selecciona un select
    for (let i = 0; i < 5; i++) {
        $('.select-act12-' + (i + 1)).on('change', function (event) {
            $('.select-act12-' + (i + 1)).find('option').show();
            intializeSelect();
        });
    }
});

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas1-1');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker1 = document.getElementById("colorPicker1");
    let widthStrokePicker1 = document.getElementById("strokeWidthPicker1");
    let clearButton1 = document.getElementById("clearButton1");

    // Clear event listener
    clearButton1.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker1.value;
        widthStroke = widthStrokePicker1.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);

    // Define a mousedown and mousedrag handler
    tool.onMouseDown = function (event) {
        path = new Path();
        path.strokeWidth = widthStroke;
        path.strokeColor = colorStroke;
        // Draw
        path.add(event.point);
    }

    tool.onMouseDrag = function (event) {
        // Draw
        path.add(event.point);
        document.getElementById("verify-canvas").value = 1;
    }
}

$('#ModalUnit3Act1').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas1-1');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker1 = document.getElementById("colorPicker1");
    let widthStrokePicker1 = document.getElementById("strokeWidthPicker1");
    let clearButton1 = document.getElementById("clearButton1");

    // Clear event listener
    clearButton1.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker1.value;
        widthStroke = widthStrokePicker1.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit3-act1').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.1375;
    //Arreglo para los selects
    let selects = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    for (let i = 0; i < 4; i++) {
        selects[i] = document.getElementById("select-act1-" + (i + 1)).value;

    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw and color the season', null);
        return false;
    }
    else {
        if (selects.includes("0")) {
            sweetAlert(2, 'Select your answer', null);
            return false;
        } else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit3Act1-2').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas1-2');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker1 = document.getElementById("colorPicker1-2");
    let widthStrokePicker1 = document.getElementById("strokeWidthPicker1-2");
    let clearButton1 = document.getElementById("clearButton1-2");

    // Clear event listener
    clearButton1.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker1.value;
        widthStroke = widthStrokePicker1.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit3-act1-2').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.1375;
    //Arreglo para los selects
    let selects = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    for (let i = 0; i < 4; i++) {
        selects[i] = document.getElementById("select-act1-2-" + (i + 1)).value;

    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw and color the season', null);
        return false;
    }
    else {
        if (selects.includes("0")) {
            sweetAlert(2, 'Select your answer', null);
            return false;
        } else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente1-2').value = users.value;
            document.getElementById('points1-2').value = points;
            document.getElementById('idlibro1-2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1-2', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1-2').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit3Act1-3').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas1-3');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker1 = document.getElementById("colorPicker1-3");
    let widthStrokePicker1 = document.getElementById("strokeWidthPicker1-3");
    let clearButton1 = document.getElementById("clearButton1-3");

    // Clear event listener
    clearButton1.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker1.value;
        widthStroke = widthStrokePicker1.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit3-act1-3').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.1375;
    //Arreglo para los selects
    let selects = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    for (let i = 0; i < 4; i++) {
        selects[i] = document.getElementById("select-act1-3-" + (i + 1)).value;

    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw and color the season', null);
        return false;
    }
    else {
        if (selects.includes("0")) {
            sweetAlert(2, 'Select your answer', null);
            return false;
        } else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente1-3').value = users.value;
            document.getElementById('points1-3').value = points;
            document.getElementById('idlibro1-3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1-3', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1-3').modal('hide');
            return true;
        }
    }

});

$('#ModalUnit3Act1-4').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas1-4');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker1 = document.getElementById("colorPicker1-4");
    let widthStrokePicker1 = document.getElementById("strokeWidthPicker1-4");
    let clearButton1 = document.getElementById("clearButton1-4");

    // Clear event listener
    clearButton1.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker1.value;
        widthStroke = widthStrokePicker1.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit3-act1-4').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.1375;
    //Arreglo para los selects
    let selects = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    for (let i = 0; i < 4; i++) {
        selects[i] = document.getElementById("select-act1-4-" + (i + 1)).value;

    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw and color the season', null);
        return false;
    }
    else {
        if (selects.includes("0")) {
            sweetAlert(2, 'Select your answer', null);
            return false;
        } else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente1-4').value = users.value;
            document.getElementById('points1-4').value = points;
            document.getElementById('idlibro1-4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act1-4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1-4').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit3-act2').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 0.09;
    //Arreglo para los selects
    let selects = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    for (let i = 0; i < 4; i++) {
        selects[i] = document.getElementById("select-act2-" + (i + 1)).value;

    }

    if (selects.includes("0")) {
        sweetAlert(2, 'Select your answer', null);
        return false;
    } else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = points;
        document.getElementById('idlibro2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit3-act2', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit3Act2').modal('hide');
        return true;
    }


});

document.getElementById('unit3-act3').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["1", "2", "1", "3", "2", "3", "1", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('select-act3-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 8; i++) {
            if (inputs[i] == respuestas[i]) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            var libro = 4;
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
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["1", "2", "3", "2"];
    let select = [];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en los arreglos
    for (let i = 0; i < 4; i++) {
        select[i] = document.getElementById('select-act4-' + (i + 1)).value;
    }
    for (let i = 0; i < 2; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value.trim().toUpperCase();
    }

    // declaración de condicionales 
    if (select.includes("0") || inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        if (inputs[0].includes("HOW IS THE WEATHER")) {

            //variable para obtener la cantidad de respuestas correctas
            let conteo = 0;

            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < 4; i++) {
                if (select[i] == respuestas[i]) {
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
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act4', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act4').modal('hide');
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
                saveRowActivity(API_ACTIVIDADES, action, 'unit3-act4', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit3Act4').modal('hide');
                return true;
            }
        } else {
            sweetAlert(2, 'Remember to use "How is the weather...?" when asking the question', null);
            return false;
        }
    }
});

document.getElementById('unit3-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.27;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 12; i++) {
        inputs[i] = document.getElementById('input-act5-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 12; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act5', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act6').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //Variable para guardar el select
    let select;

    select = document.getElementById('select-act6').value;

    // declaración de condicionales 
    if (select.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        if (select == "1") {
            conteo++;
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == 1) {
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act6', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act6').modal('hide');
            return true;
        } else {
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = 0;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act6', 'modal');
            sweetAlert(2, 'Wrong answer', null);
            $('#ModalUnit3Act6').modal('hide')
            return false;
        }
    }
});

document.getElementById('unit3-act7').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["GOING TO GO ON VACATION", "TO THE BEACH", "GOING TO GO TO THE BEACH", "TO GO THIS WEEKEND", "GOING TO", "THIS WEEKEND", "ISN'T GOING TO RAIN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('input-act7-' + (i + 1)).value;
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
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = valorActividad;
            document.getElementById('idlibro7').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act7', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act7').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = points;
            document.getElementById('idlibro7').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act7', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act7').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["IT WAS RAINY AND COLD", "IT WAS SNOWY AND COLD", "NO, THEY WERE IN ALASKA IN SNOWY WEATHER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('input-act8-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 3; i++) {
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act8').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act8', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act8').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act9').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["TO GO", "I LIKE", "IS", "TO VISIT", "TO VISIT", "DO", "CHANGE", "CHANGE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act9-' + (i + 1)).value;
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
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
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
});

document.getElementById('unit3-act10').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["CAT", "PARROT", "BUTTERFLY", "CHICKS", "TORTOISE", "LIZARD", "SPIDER", "BEE", "MOUSE", "FISH", "HEN", "DOG", "SNAKE", "DUCK", "RABBIT", "FROG", "CANARY", "ELEPHANT", "TURTLE", "MONKEY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('input-act10-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 20; i++) {
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            var libro = 4;
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

document.getElementById('unit3-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["1", "3"];
    let select = [];

    //Se obtienen los datos ingresados y se ingresan en los arreglos
    for (let i = 0; i < 2; i++) {
        select[i] = document.getElementById('select-act11-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (select.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 2; i++) {
            if (select[i] == respuestas[i]) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act11', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act11').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let select = [];

    //Se obtienen los datos ingresados y se ingresan en los arreglos
    for (let i = 0; i < 15; i++) {
        select[i] = document.getElementById('select-act12-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (select.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente12').value = users.value;
        document.getElementById('points12').value = valorActividad;
        document.getElementById('idlibro12').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit3-act12', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit3Act12').modal('hide');
        return true;
    }
});

document.getElementById('unit3-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.27;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["HORSE", "CAT", "PARROT", "DOG", "MOUSE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act13-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 5; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act13').modal('hide');
            return true;
        } else {
            sweetAlert(2, 'Write a sentence for each pet', null);
            return false;
        }
    }
});

const table14 = document.querySelector('.table-cross14l4');
table14.addEventListener('keydown', handleKeyDown);

//Funciones para el crossword
let across = true;
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

document.getElementById('unit3-act14').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let answers = [ "H", "C", "O", "A", "P", "A", "R", "R", "O", "T", "D", "S", "M", "O", "U", "S", "E", "G"];
    //Llenar arreglo de inputs
    for (let i = 0; i < 18; i++) {
        inputs[i] = document.getElementById('input-act14-' + (i + 1)).value.toUpperCase();

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
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act14', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit3Act14').modal('hide');
            return true;
        }

    }

});

document.getElementById('unit3-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["I LIKE PARROTS, BUT MY MOTHER LOVES THE CATS", "THE CHICKENS ARE BEAUTIFUL, I FEED THEM WITH RICE", "HE CARESSES HIS RABBIT, BUT HE HATES SNAKES"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('input-act15-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 3; i++) {
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act15', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act15').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act15', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act15').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit3-act16').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let answers = [ "Q", "U", "B", "A", "M", "I", "A", "O", "W", "C", "O", "A", "O", "I", "N", "K", "O", "O", "E", "F", "I", "G", "C", "H", "E", "E", "P"];
    //Llenar arreglo de inputs
    for (let i = 0; i < 27; i++) {
        inputs[i] = document.getElementById('input-act16-' + (i + 1)).value.toUpperCase();

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
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = points;
            document.getElementById('idlibro16').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act16', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit3Act16').modal('hide');
            return true;
        }

    }
});

const table16 = document.querySelector('.table-cross16l4');
table16.addEventListener('keydown', handleKeyDown);

document.getElementById('unit3-act17').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["BOY", "TO WRITE", "THOUGHT WITH", "I AM", "AT WRITING", "WISH", "HAVE TO DO", "IF I GET", "THIS", "HE", "THE", "WALKED", "TO MRS", "YOU GO", "HE", "HE", "TO", "HIS FRIENDS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 18; i++) {
        inputs[i] = document.getElementById('input-act17-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 18; i++) {
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
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
            var libro = 4;
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
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let answers = [ "H", "C", "O", "A", "P", "A", "R", "R", "O", "T", "D", "S", "M", "O", "U", "S", "E", "G"];
    //Llenar arreglo de inputs
    for (let i = 0; i < 18; i++) {
        inputs[i] = document.getElementById('input-act18-' + (i + 1)).value.toUpperCase();

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
            let puntaje = valorActividad / (inputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act18', 'modal');
            sweetAlert(4, conteo + '/' + (inputs.length) + ' answers right', null);
            $('#ModalUnit3Act18').modal('hide');
            return true;
        }

    }
});

const table18 = document.querySelector('.table-cross18l4');
table18.addEventListener('keydown', handleKeyDown);

document.getElementById('unit3-act19').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["BAA, BAA, BLACK SHEEP", "HAVE YOU ANY WOOL", "YES, SIR, YES SIR", "THREE BAGS FULL", "ONE FOR THE MASTER", "ONE FOR THE DAME", "AND ONE FOR THE LITTLE BOY", "WHO LIVES DOWN THE LANE"];
    let input;

    //Se obtienen los datos ingresados y se ingresan en input
        input = document.getElementById('input-act19').value;

    // declaración de condicionales 
    if (input == "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (input.trim().toUpperCase().includes(respuestas[i])) {
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit3-act19', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act19').modal('hide');
            return true;
        } else {
            sweetAlert(2, 'Make sure to rewrite the rhyme correctly', null);
            return false;
        }
    }
});