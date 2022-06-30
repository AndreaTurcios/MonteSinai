const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

//Unidad 4 Actividad 1
document.getElementById('unit4-act1').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;

    if (document.getElementById('cbox1').checked || document.getElementById('cbox2').checked || document.getElementById('cbox3').checked ||
        document.getElementById('cbox4').checked || document.getElementById('cbox5').checked || document.getElementById('cbox6').checked) {

        //Se verifica que solo pueda escoger 4
        cboxname = "";
        contadorcbox = 0;
        for (let i = 1; i <= 6; i++) {
            cboxname = "cbox" + i;
            if (document.getElementById(cboxname).checked) {
                contadorcbox++;
            }
        }
              
        if (contadorcbox > 4) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('cbox1').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 2:
                        if (document.getElementById('cbox3').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 3:
                        if (document.getElementById('cbox4').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    case 4:
                        if (document.getElementById('cbox6').checked) {
                            notatotal = notatotal + 2.5;
                        }
                        break;
                    default:
                }
            }

            var libro = 8;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = notatotal;
            document.getElementById('idlibro1').value = libro;
            console.log(notatotal);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act1', 'ModalLibroOcho11')
            sweetAlert(1, 'Good job', null);
            var ModalLibroOcho11 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho11'));
            ModalLibroOcho11.hide();
            return true;
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
    
});

//Unidad 4 Actividad 2
document.getElementById('unit4-act2').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act2-q' + (i+1)).value;
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
            var libro = 8;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act2', 'ModalLibroOcho12');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho12 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho12'));
            ModalLibroOcho12.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act2', 'ModalLibroOcho12');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho12 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho12'));
            ModalLibroOcho12.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 3
document.getElementById('unit4-act3').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "2", "3", "2", "1", "1", "3", "3", "2", "1", "3", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act3-q' + (i+1)).value;
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
            var libro = 8;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = valorActividad;
            document.getElementById('idlibro3').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act3', 'ModalLibroOcho13');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho13 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho13'));
            ModalLibroOcho13.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act3', 'ModalLibroOcho13');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho13 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho13'));
            ModalLibroOcho13.hide();
            return true;
        }
    }    
});