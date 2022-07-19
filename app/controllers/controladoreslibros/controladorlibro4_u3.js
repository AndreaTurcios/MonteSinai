const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';
var colorStroke, widthStroke, intervalo;

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
    let valorActividad = 0.25;
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
    let valorActividad = 0.25;
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
    let valorActividad = 0.25;
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
    let valorActividad = 0.25;
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
    let valorActividad = 1;
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
    let valorActividad = 1;
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
    let valorActividad = 1;
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
    let valorActividad = 1;
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
    let valorActividad = 1;
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