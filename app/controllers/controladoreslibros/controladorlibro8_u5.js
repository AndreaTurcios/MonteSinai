const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

//Unidad 5 Actividad 1
document.getElementById('unit5-act1').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act1-q' + (i+1)).value;
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
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'ModalLibroOcho3');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho3 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho3'));
            ModalLibroOcho3.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'ModalLibroOcho3');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho3 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho3'));
            ModalLibroOcho3.hide();
            return true;
        }
    }    
});

//Unidad 5 Actividad 2
document.getElementById('unit5-act2').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["4", "1", "2", "3"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act2', 'ModalLibroOcho4');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho4 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho4'));
            ModalLibroOcho4.hide();
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act2', 'ModalLibroOcho4');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho4 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho4'));
            ModalLibroOcho4.hide();
            return true;
        }
    }    
});

//Unidad 5 Actividad 3
document.getElementById('unit5-act3').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "5", "7", "6", "4"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act3', 'ModalLibroOcho5');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho5 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho5'));
            ModalLibroOcho5.hide();
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act3', 'ModalLibroOcho5');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho5 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho5'));
            ModalLibroOcho5.hide();
            return true;
        }
    }    
});

//Unidad 5 Actividad 4
document.getElementById('unit5-act4').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "1", "3", "2"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act4', 'ModalLibroOcho6');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho6 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho6'));
            ModalLibroOcho6.hide();
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act4', 'ModalLibroOcho6');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho6 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho6'));
            ModalLibroOcho6.hide();
            return true;
        }
    }    
});

//Unidad 5 Actividad 5
document.getElementById('unit5-act5').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "3", "1"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act5', 'ModalLibroOcho7');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho7 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho7'));
            ModalLibroOcho7.hide();
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act5', 'ModalLibroOcho7');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho7 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho7'));
            ModalLibroOcho7.hide();
            return true;
        }
    }    
});

//Unidad 5 Actividad 6
document.getElementById('unit5-act6').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "2", "1", 
                      "3", "2", "1", "3", 
                      "1", "1", "3", "2",
                      "1", "2", "1", "3",
                      "2", "1", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act6-q' + (i+1)).value;
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
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act6', 'ModalLibroOcho8');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho8 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho8'));
            ModalLibroOcho8.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act6', 'ModalLibroOcho8');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho8 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho8'));
            ModalLibroOcho8.hide();
            return true;
        }
    }    
});