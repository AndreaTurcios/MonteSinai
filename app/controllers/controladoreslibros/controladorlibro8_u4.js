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

//Unidad 4 Actividad 6
document.getElementById('unit4-act6').addEventListener('submit', function(event) {
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
                if (document.getElementById('cb3-2').checked) {
                    notacbox_cb3 = notacbox_cb3 + 1;
                }
                break;
            case 2:
                if (document.getElementById('cb3-3').checked) {
                    notacbox_cb3 = notacbox_cb3 + 1;
                }
                break;
            default:
        }
    }
    //FIN CHECKBOXS (cb3)

    //INICIO CHECKBOXS (cb8)
    //Se cuentan todos los cbox seleccionados
    notacbox_cb8 = 0; //contador de puntos obtenidos
    cboxname_cb8 = "";
    contadorcbox_cb8 = 0; //contador de cbox seleccionados
    for (let i = 1; i <= 4; i++) {
        cboxname_cb8 = "cb8-" + i;
        if (document.getElementById(cboxname_cb8).checked) {
            contadorcbox_cb8++;
        }
    }
    for (i = 1; i <= 4; i++) {
        switch (i) {
            case 1:
                if (document.getElementById('cb8-2').checked) {
                    notacbox_cb8 = notacbox_cb8 + 1;
                }
                break;
            case 2:
                if (document.getElementById('cb8-3').checked) {
                    notacbox_cb8 = notacbox_cb8 + 1;
                }
                break;
            case 3:
                if (document.getElementById('cb8-4').checked) {
                    notacbox_cb8 = notacbox_cb8 + 1;
                }
                break;
            default:
        }
    }
    //FIN CHECKBOXS (cb3)

    //INICIO SELECTS
    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2","3","2","1","2","1","2","3","2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act6-s' + (i+1)).value;
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
                if (contadorcbox_cb8 > 3) {
                    sweetAlert(2, 'It is not valid to select all answers for question eight, only choose three', null);
                } else {
                    if (inputs.includes("0")) {
                        sweetAlert(2, 'Complete the missing fields', null);
                        return false;
                    } else {

                        // let r_correctas = conteo + notacbox;
                        let r_correctas = notacbox_cb3 + notacbox_cb8 + notaselect;
                        //Se revisa si todas las respuestas son correctas
                        if (r_correctas == 14) {
                            var libro = 8;
                            document.getElementById('idcliente6').value = users.value;
                            document.getElementById('points6').value = valorActividad;
                            document.getElementById('idlibro6').value = libro;
                            console.log(valorActividad);
                            action = 'create';
                            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act6', 'ModalLibroOcho16');
                            sweetAlert(1, 'good job', null);
                            var ModalLibroOcho16 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho16'));
                            ModalLibroOcho16.hide();
                            return true;
                        } else {
                            //Se asigna el puntaje basado en las respuestas correctas
                            let puntaje = valorActividad / 14;
                            let points = (puntaje * r_correctas).toFixed(2);
                            var libro = 8;
                            document.getElementById('idcliente6').value = users.value;
                            document.getElementById('points6').value = points;
                            document.getElementById('idlibro6').value = libro;
                            console.log(points);
                            action = 'create';
                            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act6', 'ModalLibroOcho16');
                            sweetAlert(4, r_correctas + '/' + 14 +' answers right', null);
                            var ModalLibroOcho16 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho16'));
                            ModalLibroOcho16.hide();
                            return true;
                        }
                    }
                }
            }
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

//Unidad 4 Actividad 12
document.getElementById('unit4-act12').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1","3","3","1","2","2","3","1","2","1","3","3","1","1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act12-q' + (i+1)).value;
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
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act12', 'ModalLibroOcho22');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho22 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho22'));
            ModalLibroOcho22.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = points;
            document.getElementById('idlibro12').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act12', 'ModalLibroOcho22');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho22 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho22'));
            ModalLibroOcho22.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 13
document.getElementById('unit4-act13').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act13-q' + (i+1)).value;
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
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = valorActividad;
            document.getElementById('idlibro13').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act13', 'ModalLibroOcho23');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho23 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho23'));
            ModalLibroOcho23.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente13').value = users.value;
            document.getElementById('points13').value = points;
            document.getElementById('idlibro13').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act13', 'ModalLibroOcho23');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho23 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho23'));
            ModalLibroOcho23.hide();
            return true;
        }
    }    
});