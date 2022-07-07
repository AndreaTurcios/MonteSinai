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

//Unidad 4 Actividad 4
document.getElementById('unit4-act4').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "1", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act4-q' + (i+1)).value;
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
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act4', 'ModalLibroOcho14');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho14 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho14'));
            ModalLibroOcho14.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act4', 'ModalLibroOcho14');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho14 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho14'));
            ModalLibroOcho14.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 5
document.getElementById('unit4-act5').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act5-q' + (i+1)).value;
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
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'ModalLibroOcho15');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho15 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho15'));
            ModalLibroOcho15.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'ModalLibroOcho15');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho15 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho15'));
            ModalLibroOcho15.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 6 (pendiente)
document.getElementById('unit4-act6').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "2", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act5-q' + (i+1)).value;
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
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'ModalLibroOcho15');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho15 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho15'));
            ModalLibroOcho15.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act5', 'ModalLibroOcho15');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho15 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho15'));
            ModalLibroOcho15.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 7
document.getElementById('unit4-act7').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "3", "2", "3", "1", "3", "3", "3", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act7-q' + (i+1)).value;
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
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = valorActividad;
            document.getElementById('idlibro7').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act7', 'ModalLibroOcho17');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho17 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho17'));
            ModalLibroOcho17.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = points;
            document.getElementById('idlibro7').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act7', 'ModalLibroOcho17');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho17 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho17'));
            ModalLibroOcho17.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 8
document.getElementById('unit4-act8').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1","1", "2", "3", "2", "3", "1", "3", "1", "3", "3", "3", "2", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act8-q' + (i+1)).value;
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
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act8', 'ModalLibroOcho18');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho18 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho18'));
            ModalLibroOcho18.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act8', 'ModalLibroOcho18');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho18 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho18'));
            ModalLibroOcho18.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 9
document.getElementById('unit4-act9').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "1", "1", "2", "2", "1", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act9-q' + (i+1)).value;
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
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = valorActividad;
            document.getElementById('idlibro9').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act9', 'ModalLibroOcho19');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho19 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho19'));
            ModalLibroOcho19.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = points;
            document.getElementById('idlibro9').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act9', 'ModalLibroOcho19');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho19 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho19'));
            ModalLibroOcho19.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 10
document.getElementById('unit4-act10').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "1", "2", "1", "2", "2", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act10-q' + (i+1)).value;
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
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act10', 'ModalLibroOcho20');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho20 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho20'));
            ModalLibroOcho20.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act10', 'ModalLibroOcho20');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho20 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho20'));
            ModalLibroOcho20.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 11
document.getElementById('unit4-act11').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "3", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act11-q' + (i+1)).value;
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
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act11', 'ModalLibroOcho21');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho21 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho21'));
            ModalLibroOcho21.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act11', 'ModalLibroOcho21');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho21 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho21'));
            ModalLibroOcho21.hide();
            return true;
        }
    }    
});