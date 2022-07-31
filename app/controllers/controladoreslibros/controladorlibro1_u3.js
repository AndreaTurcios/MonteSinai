const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

document.getElementById('game-one').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["NOTEBOOK",  "ERASER", "PENCIL", "PENCIL SHARPENER", "CHALK", "BOARD", "BOOK", "CHAIR", "DESK", "TABLE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act1-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;
            document.getElementById('idcliente1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalUnit3Act1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalUnit3Act1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-two').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BOARD",  "CLOCK", "MAP", "DESK", "CHAIR", "BOOK", "NOTEBOOK", "PEN", "ERASER", "PENCIL", "PENCIL SHARPENER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;
            document.getElementById('idcliente2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit3Act2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit3Act2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-three').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THE GREEN BOARD IS ON THE WALL",  "THE RULER IS ON THE DESK", "THE WASTEPAPER IS ON THE FLOOR", "MY ENGLISH BOOK IS ON THE DESK"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act3-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points3').value = valorActividad;
            document.getElementById('idlibro3').value = libro;
            document.getElementById('idcliente3').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalUnit3Act3');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act3').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalUnit3Act3');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act3').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-four').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["PLAYING SPINNING TOP",  "PLAYING TRAVELING", "PLAYING PULL UP ONIONS", "PLAYING PINT OF OIL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act4-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;
            document.getElementById('idcliente4').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit3Act4');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act4').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit3Act4');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act4').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-five').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I PLAY MARBLES",  "WE PLAY SEESAW OF SCHOOL", "SHE PLAYS HULA HOOP", "SHE PLAYS JACKS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act5-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;
            document.getElementById('idcliente5').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit3Act5');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit3Act5');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-six').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I LIKE TO PLAY SOFTBALL",  "I DO NOT PLAY SOCCER", "I DO NOT PLAY JUMP ROPE", "I LIKE TO PLAY JUMP ROPE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act6-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;
            document.getElementById('idcliente6').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit3Act6');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act6').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit3Act6');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act6').modal('hide');
            return true;
        }
    }
    
});

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas7');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker7 = document.getElementById("colorPicker7");
    var widthStrokePicker7 = document.getElementById("strokeWidthPicker7");
    var clearButton7 = document.getElementById("clearBtn7");

    // Clear event listener
    clearButton7.addEventListener("click", function () {
        // Clear canvas
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker7.value;
        widthStroke = widthStrokePicker7.value;
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

$('#ModalUnit3Act7').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas7');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker7 = document.getElementById("colorPicker7");
    var widthStrokePicker7 = document.getElementById("strokeWidthPicker7");
    var clearButton7 = document.getElementById("clearBtn7");

    // Clear event listener
    clearButton7.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker7.value;
        widthStroke = widthStrokePicker7.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-seven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
       //Puntos equivalentes de la actividad
        let valorActividad = 1;

        //Se evita recargar la página al enviar el formulario
        event.preventDefault();

        //Arreglos para guardar respuestas y datos ingresados
        let respuestas = ["THE SUN",  "THE MOON", "THE ROSE", "THE CARNATION"];
        let inputs = [];

        //Se obtienen los datos ingresados y se colocan en inputs[]
        for (let i = 0; i < respuestas.length;  i++) {
        inputs[i] = document.getElementById('input-act7-' + (i + 1)).value;        
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, "Complete the missing fields", null);
            return false;
        } else {
            //Variable para obtener la cantidad de respuestas correctas
            var conteo = 0;

            for (let i = 0; i < respuestas.length; i++) {
                if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                    conteo++;
                }            
            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 1;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;
                document.getElementById('idcliente7').value = users.value;                       
                console.log(users.value);
                console.log(valorActividad);
                console.log(libro);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-seven', 'ModalUnit3Act7');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act7').modal('hide');
                return true;
            } else {
                //Se asgina el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas.length;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 1;
                console.log(users.value);
                console.log(valorActividad);
                console.log(libro);
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = promedio;
                document.getElementById('idlibro7').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-seven', 'ModalUnit3Act7');
                sweetAlert(1, 'Good job', null);
                $('#ModalUnit3Act7').modal('hide');
        return true;
            }
        }
    }

});

function checkCells(id) {
    document.getElementById(id).style.backgroundColor = "#c293c7";
}

document.getElementById('game-eight').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.55;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    //Se verifica que las celdas necesarias se hayan seleccionado
    for (let i = 0; i < 50; i++) {
        if (document.getElementById('act8-' + (i + 1)).style.backgroundColor == 'rgb(194, 147, 199)') {
            conteo++;
        }

    }
    //Llenar arreglo de inputs
    for (let i = 0; i < 12; i++) {
        inputs[i] = document.getElementById('input-act8-' + (i + 1)).value
    }

    if (conteo < 50) {
        sweetAlert(2, 'Find the missing words', null);
        return false;
    } else {
        conteo = 0;
        
        for (let i = 0; i < 12; i++) {
            if ("THE" == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == 12) {
                var libro = 1;
                document.getElementById('idcliente8').value = users.value;
                document.getElementById('points8').value = valorActividad;
                document.getElementById('idlibro8').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalUnit3Act8');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act8').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / 12;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 1;
                document.getElementById('idcliente8').value = users.value;
                document.getElementById('points8').value = points;
                document.getElementById('idlibro8').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalUnit3Act8');
                sweetAlert(4, conteo + '/12 answers right', null);
                $('#ModalUnit3Act8').modal('hide');
                return true;
            }
        }
    }

});

$('#ModalUnit3Act9').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas9');
    if (intervalo) {
        clearInterval(intervalo);
    }

    // Get elements from DOM and define properties
    var colorPicker9 = document.getElementById("colorPicker9");
    var widthStrokePicker9 = document.getElementById("strokeWidthPicker9");
    var clearButton9 = document.getElementById("clearBtn9");

    // Clear event listener
    clearButton9.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker9.value;
        widthStroke = widthStrokePicker9.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-nine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
        promedio = 1;
        var libro = 1;
        document.getElementById('idcliente9').value = users.value;
        document.getElementById('points9').value = promedio;
        document.getElementById('idlibro9').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit3Act9');
        sweetAlert(1, 'Good job', null);
        $('#ModalUnit3Act9').modal('hide');
        return true;
    }

});

document.getElementById('game-ten').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SHE IS JUMPING",  "MY TEETH ARE CLEAN", "HE IS WASHING THE CAR", "I AM WRITING IN MY BOOK"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act10-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;
            document.getElementById('idcliente10').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit3Act10');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act10').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit3Act10');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act10').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eleven').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IT IS A LION",  "IT IS AN ELEPHANT", "IT IS A GIRAFFE", "IT IS A CAT", "IT IS A KANGAROO", "IT IS A COW"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act11-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;
            document.getElementById('idcliente11').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalUnit3Act11');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act11').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalUnit3Act11');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act11').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twelve').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WE ARE BOYS",  "WE ARE GIRLS", "WE ARE GENTLEMEN", "WE ARE LADIES", "WE ARE TEACHERS", "WE ARE FRIENDS", "WE ARE DOCTORS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act12-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;
            document.getElementById('idcliente12').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalUnit3Act12');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act12').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = points;
            document.getElementById('idlibro12').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalUnit3Act12');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act12').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-thirteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IT IS A BIG HOUSE",  "IT IS A SMALL HOUSE", "IT IS AN OLD HOUSE", "IT IS A BIG HOUSE", "IT IS A SMALL BUS", "IT IS AN OLD BUS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act13-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;
            document.getElementById('idcliente13').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen', 'ModalUnit3Act13');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act13').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = points;
            document.getElementById('idlibro13').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen', 'ModalUnit3Act13');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act13').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fourteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THE PLANT IS AT THE CORNER",  "THE TEACHER IS AT THE SCHOOL", "MY MOTHER IS AT THE SUPERMARKET", "MY SISTER IS AT THE OFFICE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act14-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points14').value = valorActividad;
            document.getElementById('idlibro14').value = libro;
            document.getElementById('idcliente14').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalUnit3Act14');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act14').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalUnit3Act14');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act14').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fifteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THE MIRROR IS IN THE BEDROOM",  "THE DOG IS IN THE GARDEN", "THE GLASS IS IN THE BOX", "THE PLATE IS IN THE KITCHEN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act15-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;
            document.getElementById('idcliente15').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen', 'ModalUnit3Act15');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act15').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen', 'ModalUnit3Act15');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act15').modal('hide');
            return true;
        }
    }
    
});

$('#ModalUnit3Act16_1').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas16');
    if (intervalo) {
        clearInterval(intervalo);
    }

    // Get elements from DOM and define properties
    var colorPicker16 = document.getElementById("colorPicker16");
    var widthStrokePicker16 = document.getElementById("strokeWidthPicker16");
    var clearButton16 = document.getElementById("clearBtn16");

    // Clear event listener
    clearButton16.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker16.value;
        widthStroke = widthStrokePicker16.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-sixteen_1').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
        //Puntos equivalentes de la actividad
         let valorActividad = 1;
 
         //Se evita recargar la página al enviar el formulario
         event.preventDefault();
 
         //Arreglos para guardar respuestas y datos ingresados
         let respuestas = ["YELLOW SHIRT",  "PURPLE PANTS", "BLUE SHOES", "GREEN SOCKS"];
         let inputs = [];
 
         //Se obtienen los datos ingresados y se colocan en inputs[]
         for (let i = 0; i < respuestas.length;  i++) {
         inputs[i] = document.getElementById('input-act16_1-' + (i + 1)).value;        
         }
         
         if (inputs.includes("")) {
             sweetAlert(2, "Complete the missing fields", null);
             return false;
         } else {
             //Variable para obtener la cantidad de respuestas correctas
             var conteo = 0;
 
             for (let i = 0; i < respuestas.length; i++) {
                 if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                     conteo++;
                 }            
             }
 
             //Se revisa si todas las respuestas son correctas
             if (conteo == respuestas.length) {
                 var libro = 1;
                 document.getElementById('points16_1').value = valorActividad;
                 document.getElementById('idlibro16_1').value = libro;
                 document.getElementById('idcliente16_1').value = users.value;                       
                 console.log(users.value);
                 console.log(valorActividad);
                 console.log(libro);
                 action = 'create';
                 saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_1', 'ModalUnit3Act16_1');
                 sweetAlert(1, 'Good job!', null);
                 $('#ModalUnit3Act16_1').modal('hide');
                 return true;
             } else {
                 //Se asgina el puntaje basado en las respuestas correctas
                 let puntaje = valorActividad / respuestas.length;
                 let points = (puntaje * conteo).toFixed(2);
                 var libro = 1;
                 console.log(users.value);
                 console.log(valorActividad);
                 console.log(libro);
                 document.getElementById('idcliente16_1').value = users.value;
                 document.getElementById('points16_1').value = promedio;
                 document.getElementById('idlibro16_1').value = libro;
                 action = 'create';
                 saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_1', 'ModalUnit3Act16_1');
                 sweetAlert(1, 'Good job', null);
                 $('#ModalUnit3Act16_1').modal('hide');
         return true;
             }
         }
     }

});

document.getElementById('game-sixteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I LIKE YELLOW",  "I DO NOT LIKE PURPLE", "BLUE IS MY FAVORITE COLOR", "GREEN IS BEAUTIFUL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act16_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points16_2').value = valorActividad;
            document.getElementById('idlibro16_2').value = libro;
            document.getElementById('idcliente16_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_2', 'ModalUnit3Act16_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act16_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente16_2').value = users.value;
            document.getElementById('points16_2').value = points;
            document.getElementById('idlibro16_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_2', 'ModalUnit3Act16_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act16_2').modal('hide');
            return true;
        }
    }
    
});

$('#ModalUnit3Act17').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas17');
    if (intervalo) {
        clearInterval(intervalo);
    }

    // Get elements from DOM and define properties
    var colorPicker17 = document.getElementById("colorPicker17");
    var widthStrokePicker17 = document.getElementById("strokeWidthPicker17");
    var clearButton17 = document.getElementById("clearBtn17");

    // Clear event listener
    clearButton17.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker17.value;
        widthStroke = widthStrokePicker17.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-seventeen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
        //Puntos equivalentes de la actividad
         let valorActividad = 1;
 
         //Se evita recargar la página al enviar el formulario
         event.preventDefault();
 
         //Arreglos para guardar respuestas y datos ingresados
         let respuestas = ["BLUE",  "YELLOW", "GREEN", "PURPLE"];
         let inputs = [];
 
         //Se obtienen los datos ingresados y se colocan en inputs[]
         for (let i = 0; i < respuestas.length;  i++) {
         inputs[i] = document.getElementById('input-act17-' + (i + 1)).value;        
         }
         
         if (inputs.includes("")) {
             sweetAlert(2, "Complete the missing fields", null);
             return false;
         } else {
             //Variable para obtener la cantidad de respuestas correctas
             var conteo = 0;
 
             for (let i = 0; i < respuestas.length; i++) {
                 if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                     conteo++;
                 }            
             }
 
             //Se revisa si todas las respuestas son correctas
             if (conteo == respuestas.length) {
                 var libro = 1;
                 document.getElementById('points17').value = valorActividad;
                 document.getElementById('idlibro17').value = libro;
                 document.getElementById('idcliente17').value = users.value;                       
                 console.log(users.value);
                 console.log(valorActividad);
                 console.log(libro);
                 action = 'create';
                 saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit3Act17');
                 sweetAlert(1, 'Good job!', null);
                 $('#ModalUnit3Act17').modal('hide');
                 return true;
             } else {
                 //Se asgina el puntaje basado en las respuestas correctas
                 let puntaje = valorActividad / respuestas.length;
                 let points = (puntaje * conteo).toFixed(2);
                 var libro = 1;
                 console.log(users.value);
                 console.log(valorActividad);
                 console.log(libro);
                 document.getElementById('idcliente17').value = users.value;
                 document.getElementById('points17').value = promedio;
                 document.getElementById('idlibro17').value = libro;
                 action = 'create';
                 saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit3Act17');
                 sweetAlert(1, 'Good job', null);
                 $('#ModalUnit3Act17').modal('hide');
                return true;
             }
         }
     }

});

document.getElementById('game-eighteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["ON MONDAY MY SHIRT IS PINK",  "ON TUESDAY MY SHIRT IS GREEN", "ON WEDNESDAY MY SHIRT IS YELLOW", "ON THURSDAY MY SHIRT IS BLUE", "ON FRIDAY MY SHIRT IS RED", "ON SATURDAY MY SHIRT IS PURPLE", "ON SUNDAY MY SHIRT IS BROWN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act18-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;
            document.getElementById('idcliente18').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen', 'ModalUnit3Act18');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act18').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen', 'ModalUnit3Act18');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act18').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nineteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BORIS IS A BOY",  "SUSAN IS A GIRL", "THE BOY IS A MASCULINE", "THE GIRL IS A FEMININE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act19-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points19').value = valorActividad;
            document.getElementById('idlibro19').value = libro;
            document.getElementById('idcliente19').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen', 'ModalUnit3Act19');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act19').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen', 'ModalUnit3Act19');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act19').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twenty').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act20-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;
            document.getElementById('idcliente20').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit3Act20');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = points;
            document.getElementById('idlibro20').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit3Act20');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyone').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WE GO TO SCHOOL AND DRAW MANY THINGS", "I GO TO CLASS AND DRAW THE MAPS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act21-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;
            document.getElementById('idcliente21').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit3Act21');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act21').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = points;
            document.getElementById('idlibro21').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit3Act21');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act21').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentytwo').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THIS IS HER BOOK", "THIS IS HIS BOOK", "THIS IS HER PENCIL", "THIS IS HIS PENCIL", "THAT IS HER TOY", "THIS IS HIS TOY", "THAT IS HER UMBRELLA", "THAT IS HIS UMBRELLA", "THIS IS HER WATCH", "THIS IS HIS WATCH", "THAT IS HER FLOWER", "THAT IS HIS FLOWER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act22-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points22').value = valorActividad;
            document.getElementById('idlibro22').value = libro;
            document.getElementById('idcliente22').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit3Act22');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act22').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente22').value = users.value;
            document.getElementById('points22').value = points;
            document.getElementById('idlibro22').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit3Act22');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act22').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentythree').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WE GO TO SCHOOL WITH SUCH ENERGY", "MY TEACHER GOES TO SCHOOL WITH HER DAUGHTER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act23-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points23').value = valorActividad;
            document.getElementById('idlibro23').value = libro;
            document.getElementById('idcliente23').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit3Act23');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act23').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = points;
            document.getElementById('idlibro23').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit3Act23');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act23').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfour').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["TODAY IS MONDAY. ON MONDAY WE HAVE ENGLISH CLASS", "TODAY IS CHRISTMAS DAY. ON CHRISTMAS DAY WE EAT TURKEY", "TODAY IS MY BIRTHDAY. ON MY BIRTHDAY WE CELEBRATE ALL DAY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act24-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points24').value = valorActividad;
            document.getElementById('idlibro24').value = libro;
            document.getElementById('idcliente24').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit3Act24');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act24').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente24').value = users.value;
            document.getElementById('points24').value = points;
            document.getElementById('idlibro24').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit3Act24');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act24').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfive').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.55;
    //Variable para mantener las respuestas correctas
    let conteo = 0;

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HAM", "YAM", "PIE", "TURKEY", "FOOD", "THANKS"];
    let inputs = [];
    
    //Se verifica que las celdas necesarias se hayan seleccionado
    for (let i = 0; i < 25; i++) {
        if (document.getElementById('act25-' + (i + 1)).style.backgroundColor == 'rgb(194, 147, 199)') {
            conteo++;
        }

    }
    //Llenar arreglo de inputs
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act25-' + (i + 1)).value
    }

    if (conteo < 25) {
        sweetAlert(2, 'Find the missing words', null);
        return false;
    } else {
        conteo = 0;
        
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 1;
                document.getElementById('idcliente25').value = users.value;
                document.getElementById('points25').value = valorActividad;
                document.getElementById('idlibro25').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit3Act25');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit3Act25').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas.length;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 1;
                document.getElementById('idcliente25').value = users.value;
                document.getElementById('points25').value = points;
                document.getElementById('idlibro25').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit3Act25');
                sweetAlert(4, conteo + '/6 answers right', null);
                $('#ModalUnit3Act25').modal('hide');
                return true;
            }
        }
    }

});

document.getElementById('game-twentysix').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["AUTUMN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length;  i++) {
       inputs[i] = document.getElementById('input-act26-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points26').value = valorActividad;
            document.getElementById('idlibro26').value = libro;
            document.getElementById('idcliente26').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit3Act26');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act26').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente26').value = users.value;
            document.getElementById('points26').value = points;
            document.getElementById('idlibro26').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit3Act26');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act26').modal('hide');
            return true;
        }
    }
    
});