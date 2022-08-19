const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.getElementById('unit1-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "2", "1", "3", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act1-' + (i + 1)).value;
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
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act1').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act2').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "3", "2", "2", "2"];
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
            var libro = 7;
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
            var libro = 7;
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

document.getElementById('unit1-act3').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "3", "2", "1", "3"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act3', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act3').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act3', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act3').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act4').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["IS", "ARE", "I AM"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value.toUpperCase();

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
                if ((inputs[i].trim().includes(respuestas[0]) || inputs[i].trim().includes(respuestas[1]) || inputs[i].trim().includes(respuestas[2])) && (!inputs[i].trim().startsWith(respuestas[0]) && !inputs[i].trim().startsWith(respuestas[1])) && inputs[i].length > 6) {
                    conteo++;
                }

            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 7;
                document.getElementById('idcliente4').value = users.value;
                document.getElementById('points4').value = valorActividad;
                document.getElementById('idlibro4').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act4', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act4').modal('hide');
                return true;
            } else {
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to write sentences using the verb "to be" correctly', null);
                return true;
            }
        }

    }

});

document.getElementById('unit1-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "3"];
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
            var libro = 7;
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
            var libro = 7;
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
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "1", "3", "1", "2", "3"];
    let respuestasInputs = ["HOW ARE YOU", "HOW DO YOU DO"]
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act6-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value.toUpperCase();

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
        for (let i = 0; i < 3; i++) {
            if ((inputs[i].trim().includes(respuestasInputs[0]) || inputs[i].trim().includes(respuestasInputs[1]))) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteoInputs == 3) {
            if (conteo == respuestas.length) {
                var libro = 7;
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
                let puntaje = valorActividad / respuestas.length;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente6').value = users.value;
                document.getElementById('points6').value = points;
                document.getElementById('idlibro6').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act6', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit1Act6').modal('hide');
                return true;
            }
        } else {
            sweetAlert(2, 'Make sure to write correctly the questions', null);
            return false;
        }
    }

});

document.getElementById('unit1-act7').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["GOOD MORNING", "GOOD AFTERNOON", "GOOD EVENING", "GOOD-BYE", "GOOD NIGHT", "HELLO", "HI"];
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
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = valorActividad;
            document.getElementById('idlibro7').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act7', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act7').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act7', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act7').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "2", "1", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act8').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act8', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act8').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act9').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "1", "3", "3"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act9', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act9').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act9', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act9').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act10').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "2"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act10').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act10', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act10').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "2", "2", "1", "3", "1", "2", "1"];
    let respuestascb = ["1", "4", "5"];
    let inputs = [];
    let selects = [];
    let checks = [];
    //variable para llevar el conteo de checkbox seleccionados
    let conteocb = 0;

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act11-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 1; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value.toUpperCase();

    }
    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 5; i++) {
        checks[i] = document.getElementById('cb11-' + (i + 1)).checked;
        for (let j = 0; j < respuestascb.length; j++) {
            if (respuestascb[j] == (i + 1) && checks[i]) {
                conteocb++;
            }  
        }
    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("") || conteocb < 1) {
        sweetAlert(2, 'Complete the missing fields', null);
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
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act11', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act11').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestascb.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act11', 'modal');
            sweetAlert(4, conteo + '/' + (respuestas.length + respuestascb.length) + ' answers right', null);
            $('#ModalUnit1Act11').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act12', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act12').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act12', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act12').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["ZERO", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY", "TWENTY-ONE", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act13-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act13').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act13', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act13').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act14').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["22958745", "78958675", "22620875"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('input-act14-' + (i + 1)).value;
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
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act14', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act14').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "2", "2", "1", "3", "1", "2", "1"];
    let respuestasInputs = ["ZERO", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY", "TWENTY-ONE", "THIRTY", "FORTY", "FIFTY", "SIXTY", "SEVENTY", "EIGHTY", "NINETY"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length + 1; i++) {
        selects[i] = document.getElementById('select-act15-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length; i++) {
        inputs[i] = document.getElementById('input-act15-' + (i + 1)).value.toUpperCase();

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
            if (inputs[i].trim().includes(respuestasInputs[i])) {
                conteoInputs++;
            }
        }

        //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
                var libro = 7;
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
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = points;
                document.getElementById('idlibro15').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act15', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit1Act15').modal('hide');
                return true;
            }
    }

});

document.getElementById('unit1-act16').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act16-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = valorActividad;
            document.getElementById('idlibro16').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act16', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act16').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = points;
            document.getElementById('idlibro16').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act16', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act16').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act17').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["WHAT'S YOUR NAME", "COULD YOU SPELL YOUR LAST NAME", "WHAT'S YOUR CELLPHONE", "DO YOU KNOW YOUR SISTER'S TELEPHONE NUMBER"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act17', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act17').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act17', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act17').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act18').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["HOW DO YOU SPELL YOUR NAME", "HOW DO YOU SAY", "COULD YOU SPELL YOUR LAST NAME", "DID YOU SAY RODRIGO"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act18-' + (i + 1)).value.trim();
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
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act18', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act18').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit1-act19').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "3"];
    let respuestascb = ["1", "4"];
    let respuestasInputs = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    let inputs = [];
    let selects = [];
    let checks = [];
    //variable para llevar el conteo de checkbox seleccionados
    let conteocb = 0;

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act19-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < 28; i++) {
        inputs[i] = document.getElementById('input-act19-' + (i + 1)).value.toUpperCase();

    }
    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 5; i++) {
        checks[i] = document.getElementById('cb19-' + (i + 1)).checked;
        for (let j = 0; j < respuestascb.length; j++) {
            if (respuestascb[j] == (i + 1) && checks[i]) {
                conteocb++;
            }  
        }
    }

    // declaración de condicionales 
    if (selects.includes("0") || inputs.includes("") || conteocb < 1) {
        sweetAlert(2, 'Complete the missing fields', null);
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
        for (let i = 0; i < respuestasInputs.length; i++) {
            if (inputs[i] == respuestasInputs[i]) {
                conteo++;
            }
            
        }

        conteo += conteocb;

        //Se revisa si todas las respuestas son correctas
        if (conteo == (respuestas.length + respuestascb.length + respuestasInputs.length)) {
            var libro = 7;
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
            let puntaje = valorActividad / (respuestas.length + respuestascb.length  + respuestasInputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act19', 'modal');
            sweetAlert(4,'Some answers were wrong', null);
            $('#ModalUnit1Act19').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act20').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "3", "2", "1", "2", "1", "3", "3", "1", "2", "1", "1", "3", "2", "2", "1", "3", "1", "2", "1", "3", "2", "3", "2", "3"];
    let respuestasInputs = ["HE", "SHE", "IT", "THEY", "WE", "YOU", "I"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act20-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < (respuestasInputs.length + 2); i++) {
        inputs[i] = document.getElementById('input-act20-' + (i + 1)).value.toUpperCase();

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
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 7; i++) {
            for (let j = 0; j < respuestasInputs.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestasInputs[j])) {
                    conteoInputs++;
                    respuestasInputs[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length && conteoInputs == respuestasInputs.length) {
                var libro = 7;
                document.getElementById('idcliente20').value = users.value;
                document.getElementById('points20').value = valorActividad;
                document.getElementById('idlibro20').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act20', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act20').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente20').value = users.value;
                document.getElementById('points20').value = points;
                document.getElementById('idlibro20').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act20', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + respuestasInputs.length) + ' answers right', null);
                $('#ModalUnit1Act20').modal('hide');
                return true;
            }
    }

});

document.getElementById('unit1-act21').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "2", "1", "3", "1", "3", "1"];
    let respuestasInputs = ["HIS", "HER", "MY", "YOUR", "THEIR", "OUR", "ITS"];
    let numbers = ["ZERO", "ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY", "TWENTY-ONE", "TWENTY-TWO", "TWENTY-THREE", "TWENTY-FOUR", "TWENTY-FIVE", "TWENTY-SIX", "TWENTY-SEVEN",	"TWENTY-EIGHT", "TWENTY-NINE", "THIRTY", "THIRTY-ONE", "THIRTY-TWO", "THIRTY-THREE", "THIRTY-FOUR", "THIRTY-FIVE", "THIRTY-SIX", "THIRTY-SEVEN", "THIRTY-EIGHT", "THIRTY-NINE", "FORTY", "FORTY-ONE", "FORTY-TWO", "FORTY-THREE", "FORTY-FOUR", "FORTY-FIVE", "FORTY-SIX", "FORTY-SEVEN", "FORTY-EIGHT", "FORTY-NINE", "FIFTY", "FIFTY-ONE", "FIFTY-TWO", "FIFTY-THREE", "FIFTY-FOUR", "FIFTY-FIVE", "FIFTY-SIX", "FIFTY-SEVEN", "FIFTY-EIGHT", "FIFTY-NINE", "SIXTY", "SIXTY-ONE", "SIXTY-TWO", "SIXTY-THREE", "SIXTY-FOUR", "SIXTY-FIVE", "SIXTY-SIX", "SIXTY-SEVEN", "SIXTY-EIGHT", "SIXTY-NINE", "SEVENTY", "SEVENTY-ONE", "SEVENTY-TWO", "SEVENTY-THREE", "SEVENTY-FOUR", "SEVENTY-FIVE", "SEVENTY-SIX", "SEVENTY-SEVEN", "SEVENTY-EIGHT", "SEVENTY-NINE", "EIGHTY", "EIGHTY-ONE", "EIGHTY-TWO", "EIGHTY-THREE", "EIGHTY-FOUR", "EIGHTY-FIVE", "EIGHTY-SIX", "EIGHTY-SEVEN", "EIGHTY-EIGHT", "EIGHTY-NINE", "NINETY"];
    let inputs = [];
    let selects = [];

    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act21-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < (respuestasInputs.length + 8); i++) {
        inputs[i] = document.getElementById('input-act21-' + (i + 1)).value.toUpperCase();

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
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 7; i++) {
            for (let j = 0; j < respuestasInputs.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestasInputs[j])) {
                    conteoInputs++;
                    respuestasInputs[j] = "~";
                }
            }
        }
        //Se comparan las respuestas con los datos ingresados
        for (let i = 7; i < 15; i++) {
                if (numbers.includes(inputs[i].trim().toUpperCase())) {
                    conteoInputs++;
                }
        }

        //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length && conteoInputs == (respuestasInputs.length + 8)) {
                var libro = 7;
                document.getElementById('idcliente21').value = users.value;
                document.getElementById('points21').value = valorActividad;
                document.getElementById('idlibro21').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act21', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act21').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length + respuestasInputs.length + 8);
                let points = (puntaje * (conteo + conteoInputs)).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente21').value = users.value;
                document.getElementById('points21').value = points;
                document.getElementById('idlibro21').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act21', 'modal');
                sweetAlert(4, (conteo + conteoInputs) + '/' + (respuestas.length + respuestasInputs.length + 8) + ' answers right', null);
                $('#ModalUnit1Act21').modal('hide');
                return true;
            }
    }

});