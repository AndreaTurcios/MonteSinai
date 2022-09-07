const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

$(document).ready(function () {

    function intializeSelect() {
        //Se inicializan los select

        $('.time-b4').timepicker({
            'minTime': '5:00am',
            'maxTime': '5:00pm'
        });
    };

    intializeSelect();
});

document.getElementById('unit6-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["A QUARTER AFTER", "O'CLOCK", "HALF PAST", "A QUARTER TO", "AT ABOUT", "MY MORNING", "TWENTY TO TEN", "IN THE AFTERNOON", "A QUARTER AFTER", "IN THE EVENING"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit6-act2').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "2", "3", "2", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act2', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act2', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act2').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit6-act3').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "2", "4", "8", "9"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('cb3-' + (i + 1)).checked;
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
        if (conteocb > 5) {
            sweetAlert(2, 'Select only five options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente3').value = users.value;
                document.getElementById('points3').value = valorActividad;
                document.getElementById('idlibro3').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act3', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit6Act3').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente3').value = users.value;
                document.getElementById('points3').value = points;
                document.getElementById('idlibro3').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act3', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit6Act3').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit6-act4').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["5", "6", "2", "7", "9"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('cb4-' + (i + 1)).checked;
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
        if (conteocb > 5) {
            sweetAlert(2, 'Select only five options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente4').value = users.value;
                document.getElementById('points4').value = valorActividad;
                document.getElementById('idlibro4').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act4', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit6Act4').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente4').value = users.value;
                document.getElementById('points4').value = points;
                document.getElementById('idlibro4').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act4', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit6Act4').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit6-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('box-act5-' + (i + 1));

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //Verificar movies
    for (let i = 1; i < 10; i++) {
        if (inputs[0].querySelector('#option-act5-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar daily activities
    for (let i = 10; i < 16; i++) {
        if (inputs[1].querySelector('#option-act5-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar fruits
    for (let i = 16; i < 24; i++) {
        if (inputs[2].querySelector('#option-act5-' + (i)) !== null) {
            conteo++;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == 23) {
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act5').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 23
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act5', 'modal');
            sweetAlert(4, conteo + '/23 answers right', null);
            $('#ModalUnit6Act5').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act5

for (let i = 0; i < 23; i++) {
    document.getElementById('option-act5-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act5
for (let i = 0; i < 3; i++) {
    document.getElementById('box-act5-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act5-' + (i + 1));

        //Se verifica que sea el espacio para el texto.
        if ((e.target.id == ('box-act5-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        }

    });

    document.getElementById('box-act5-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit6-act6').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["WORRY", "STRESS", "ANXIOUS", "ANXIETY", "SHORT BREAKS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act6', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act6').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act6', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act6').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit6-act7').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "2", "3", "4", "8"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('cb7-' + (i + 1)).checked;
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
        if (conteocb > 5) {
            sweetAlert(2, 'Select only five options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act7', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit6Act7').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = points;
                document.getElementById('idlibro7').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act7', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit6Act7').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit6-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "1", "3"];
    let respuestascb = ["5", "6", "4"];
    let respuestasInputs = ["MORNING", "NIGHT", "NOON"];
    let inputs = [];
    let selects = [];
    let checks = [];
    //variable para llevar el conteo de checkbox seleccionados
    let conteocb = 0;
    let checked = 0;
    //Se obtienen los datos ingresados y se ingresan en selects[]
    for (let i = 0; i < respuestas.length; i++) {
        selects[i] = document.getElementById('select-act8-' + (i + 1)).value;
    }
    //Se obtienen los datos ingresados y se guardan en inputs[]
    for (let i = 0; i < respuestasInputs.length + 2; i++) {
        inputs[i] = document.getElementById('input-act8-' + (i + 1)).value.trim().toUpperCase();

    }
    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 6; i++) {
        checks[i] = document.getElementById('cb8-' + (i + 1)).checked;
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
    if (selects.includes("0") || inputs.includes("") || checked < 1) {
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
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act8').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / (respuestas.length + respuestascb.length  + respuestasInputs.length);
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act8', 'modal');
            sweetAlert(4,'Some answers were wrong', null);
            $('#ModalUnit6Act8').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit6-act9').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "3", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act9', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act9').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act9', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act9').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit6-act10').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["1", "6", "3", "7", "4"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('cb10-' + (i + 1)).checked;
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
        if (conteocb > 5) {
            sweetAlert(2, 'Select only five options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente10').value = users.value;
                document.getElementById('points10').value = valorActividad;
                document.getElementById('idlibro10').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act10', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit6Act10').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente10').value = users.value;
                document.getElementById('points10').value = points;
                document.getElementById('idlibro10').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act10', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit6Act10').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit6-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente11').value = users.value;
        document.getElementById('points11').value = valorActividad;
        document.getElementById('idlibro11').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit6-act11', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit6Act11').modal('hide');
        return true;
    }
});

document.getElementById('unit6-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["EVERY DAY", "I USUALLY GET UP", "ALWAYS AT", "SOMETIMES I PLAY AT NOON", "IN THE AFTERNOON", "RARELY", "I LIVE WITH MY PARENTS", "I HELP THEM WHENEVER I CAN", "I GO TO BED AT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act12-' + (i + 1)).value.trim();
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
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act12', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act12').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act12', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act12').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit6-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["COLLECTING", "GAMES", "GARDENING", "PHOTOGRAPHY", "MUSIC", "HORSES", "BIRD WATCHING", "SPORTS", "ANIMATION", "CARTOONS", "CINEMA", "THEATER", "CIRCUS", "COMICS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 2; i++) {
        for (let j = 0; j < 8; j++) {
            if (i == 1) {
                if (j > 5) {
                    break;
                }
                inputs[(8 + j)] = document.getElementById('input-act13-' + (i + 1) + '-' + (j + 1)).value;
            }else{
                inputs[(j)] = document.getElementById('input-act13-' + (i + 1) + '-' + (j + 1)).value;
            }
        }
    }
    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if ((i < 8 && j < 8) || (i > 7 && j > 7)) {
                    if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                        conteo++;
                        respuestas[j] = "~";
                    } 
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 7;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act13', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act13').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act13', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit6Act13').modal('hide');
            return true;
        }
    }
});


document.getElementById('unit6-act14').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 0.09;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    let conteocb = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["5", "2", "3", "7", "8"];

    //Se obtienen los checkbox y se guardan en checks[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('cb14-' + (i + 1)).checked;
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
        if (conteocb > 5) {
            sweetAlert(2, 'Select only five options', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 7;
                document.getElementById('idcliente14').value = users.value;
                document.getElementById('points14').value = valorActividad;
                document.getElementById('idlibro14').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act14', 'modal');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit6Act14').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / (respuestas.length);
                let points = (puntaje * conteo).toFixed(2);
                var libro = 7;
                document.getElementById('idcliente14').value = users.value;
                document.getElementById('points14').value = points;
                document.getElementById('idlibro14').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit6-act14', 'modal');
                sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
                $('#ModalUnit6Act14').modal('hide');
                return true;
            }
        }

    }

});

document.getElementById('unit6-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 0.09;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 3; i++) {
        inputs[i] = document.getElementById('box-act15-' + (i + 1));

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //Verificar movies
    for (let i = 1; i < 6; i++) {
        if (inputs[0].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar daily activities
    for (let i = 6; i < 10; i++) {
        if (inputs[1].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar fruits
    for (let i = 10; i < 15; i++) {
        if (inputs[2].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == 14) {
            var libro = 7;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act15', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit6Act15').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 14
            let points = (puntaje * conteo).toFixed(2);
            var libro = 7;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit6-act15', 'modal');
            sweetAlert(4, conteo + '/14 answers right', null);
            $('#ModalUnit6Act15').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act15

for (let i = 0; i < 14; i++) {
    document.getElementById('option-act15-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act15
for (let i = 0; i < 3; i++) {
    document.getElementById('box-act15-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act5-' + (i + 1));

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