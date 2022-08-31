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

//Unidad 5 Actividad 7
document.getElementById('unit5-act7').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "1", "3", "2",
                      "1", "3", "2", "3",
                      "1", "2", "1", "3"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act7', 'ModalLibroOcho9');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho9 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho9'));
            ModalLibroOcho9.hide();
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
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act7', 'ModalLibroOcho9');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho9 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho9'));
            ModalLibroOcho9.hide();
            return true;
        }
    }    
});

















//Unidad 5 Actividad 12
document.getElementById('unit5-act12').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //INICIO CHECKBOXS (cb3)
    //Se cuentan todos los cbox seleccionados
    notacbox_cb3 = 0; //contador de puntos obtenidos
    cboxname_cb3 = "";
    contadorcbox_cb3 = 0; //contador de cbox seleccionados
    for (let i = 1; i <= 4; i++) {
        cboxname_cb3 = "cb3-" + i;
        if (document.getElementById(cboxname_cb3).checked) {
            contadorcbox_cb3++;
        }
    }
    for (i = 1; i <= 4; i++) {
        switch (i) {
            case 1:
                if (document.getElementById('cb3-1').checked) {
                    notacbox_cb3 = notacbox_cb3 + 1;
                }
                break;
            case 2:
                if (document.getElementById('cb3-4').checked) {
                    notacbox_cb3 = notacbox_cb3 + 1;
                }
                break;
            default:
        }
    }
    //FIN CHECKBOXS (cb3)

    //INICIO CHECKBOXS (cb4)
    //Se cuentan todos los cbox seleccionados
    notacbox_cb8 = 0; //contador de puntos obtenidos
    cboxname_cb8 = "";
    contadorcbox_cb8 = 0; //contador de cbox seleccionados
    for (let i = 1; i <= 4; i++) {
        cboxname_cb8 = "cb4-" + i;
        if (document.getElementById(cboxname_cb8).checked) {
            contadorcbox_cb8++;
        }
    }
    for (i = 1; i <= 4; i++) {
        switch (i) {
            case 1:
                if (document.getElementById('cb4-1').checked) {
                    notacbox_cb8 = notacbox_cb8 + 1;
                }
                break;
            case 2:
                if (document.getElementById('cb4-3').checked) {
                    notacbox_cb8 = notacbox_cb8 + 1;
                }
                break;
            default:
        }
    }
    //FIN CHECKBOXS (cb4)

    //INICIO SELECTS
    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2","1","2","3","2",
                      "3","1","3","2","1",
                      "1","3","2","3","1",
                      "2","1","3","1","3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act12-q' + (i+1)).value;
    }

    //variable para obtener la cantidad de respuestas correctas
    var notaselect = 0;

    //Se comparan las respuestas con los datos ingresados
    for (let i = 0; i < respuestas.length; i++) {
        if (respuestas[i] == inputs[i]) {
            notaselect++; //suma a respuestas correctas
        }
    }
    //FIN SELECTS


    if (contadorcbox_cb3 == 0) {
        sweetAlert(2, 'Select an answer for question three', null);
    } else {
        if (contadorcbox_cb8 == 0) {
            sweetAlert(2, 'Select an answer for question eight', null);
        } else {
            if (contadorcbox_cb3 > 2) {
                sweetAlert(2, 'It is not valid to select all answers for question three, only choose two', null);
            } else {
                if (contadorcbox_cb8 > 2) {
                    sweetAlert(2, 'It is not valid to select all answers for question four, only choose two', null);
                } else {
                    if (inputs.includes("0")) {
                        sweetAlert(2, 'Complete the missing fields', null);
                        return false;
                    } else {

                        // let r_correctas = conteo + notacbox;
                        let r_correctas = notacbox_cb3 + notacbox_cb8 + notaselect;
                        //Se revisa si todas las respuestas son correctas
                        if (r_correctas == 24) {
                            var libro = 8;
                            document.getElementById('idcliente6').value = users.value;
                            document.getElementById('points6').value = valorActividad;
                            document.getElementById('idlibro6').value = libro;
                            console.log(valorActividad);
                            action = 'create';
                            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act6', 'ModalLibroOcho14');
                            sweetAlert(1, 'good job', null);
                            var ModalLibroOcho14 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho14'));
                            ModalLibroOcho14.hide();
                            return true;
                        } else {
                            //Se asigna el puntaje basado en las respuestas correctas
                            let puntaje = valorActividad / 24;
                            let points = (puntaje * r_correctas).toFixed(2);
                            var libro = 8;
                            document.getElementById('idcliente6').value = users.value;
                            document.getElementById('points6').value = points;
                            document.getElementById('idlibro6').value = libro;
                            console.log(points);
                            action = 'create';
                            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act6', 'ModalLibroOcho14');
                            sweetAlert(4, r_correctas + '/' + 24 +' answers right', null);
                            var ModalLibroOcho14 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho14'));
                            ModalLibroOcho14.hide();
                            return true;
                        }
                    }
                }
            }
        }
    }
});