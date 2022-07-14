const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

//Unidad 4 Actividad 1
document.getElementById('unit4-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    conteo = 0; //cuenta la cantidad de respuestas correctas obtenidas
    respuestas = 4; //respuestas correctas
    cantidadcbox = 6; //define la cantidad de cbox

    cboxname = "";
    contadorcbox = 0; //cuenta la cantidad de cbox seleccionados
    for (let i = 1; i <= cantidadcbox; i++) {
        cboxname = "cbox" + i;
        if (document.getElementById(cboxname).checked) {
            contadorcbox++;
            console.log(contadorcbox);
        }
    }
    
    if (contadorcbox != 0) {
              //Se verifica que solo pueda escoger 4
        if (contadorcbox > respuestas) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('cbox1').checked) {
                            conteo++;
                        }
                        break;
                    case 2:
                        if (document.getElementById('cbox3').checked) {
                            conteo++;
                        }
                        break;
                    case 3:
                        if (document.getElementById('cbox4').checked) {
                            conteo++;
                        }
                        break;
                    case 4:
                        if (document.getElementById('cbox6').checked) {
                            conteo++;
                        }
                        break;
                    default:
                }
            }
            
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas) {
                var libro = 8;
                document.getElementById('idcliente1').value = users.value;
                document.getElementById('points1').value = valorActividad;
                document.getElementById('idlibro1').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act1', 'ModalLibroOcho11');
                sweetAlert(1, 'good job', null);
                var ModalLibroOcho11 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho11'));
                ModalLibroOcho11.hide();
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 8;
                document.getElementById('idcliente1').value = users.value;
                document.getElementById('points1').value = points;
                document.getElementById('idlibro1').value = libro;
                console.log(points);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act1', 'ModalLibroOcho11');
                sweetAlert(4, conteo + '/' + respuestas +' answers right', null);
                var ModalLibroOcho11 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho11'));
                ModalLibroOcho11.hide();
                return true;
            }
            
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

//Unidad 4 Actividad 14
document.getElementById('unit4-act14').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    conteo = 0; //cuenta la cantidad de respuestas correctas obtenidas
    respuestas = 4; //respuestas correctas
    cantidadcbox = 6; //define la cantidad de cbox

    cboxname = "";
    contadorcbox = 0; //cuenta la cantidad de cbox seleccionados
    for (let i = 1; i <= cantidadcbox; i++) {
        cboxname = "cb-" + i;
        if (document.getElementById(cboxname).checked) {
            contadorcbox++;
        }
    }
    
    if (contadorcbox != 0) {
              //Se verifica que solo pueda escoger 4
        if (contadorcbox > respuestas) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('cb-1').checked) {
                            conteo++;
                        }
                        break;
                    case 2:
                        if (document.getElementById('cb-4').checked) {
                            conteo++;
                        }
                        break;
                    case 3:
                        if (document.getElementById('cb-5').checked) {
                            conteo++;
                        }
                        break;
                    case 4:
                        if (document.getElementById('cb-6').checked) {
                            conteo++;
                        }
                        break;
                    default:
                }
            }
            
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas) {
                var libro = 8;
                document.getElementById('idcliente14').value = users.value;
                document.getElementById('points14').value = valorActividad;
                document.getElementById('idlibro14').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act14', 'ModalLibroOcho24');
                sweetAlert(1, 'good job', null);
                var ModalLibroOcho24 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho24'));
                ModalLibroOcho24.hide();
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 8;
                document.getElementById('idcliente14').value = users.value;
                document.getElementById('points14').value = points;
                document.getElementById('idlibro14').value = libro;
                console.log(points);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act14', 'ModalLibroOcho24');
                sweetAlert(4, conteo + '/' + respuestas +' answers right', null);
                var ModalLibroOcho24 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho24'));
                ModalLibroOcho24.hide();
                return true;
            }
            
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
});

//Unidad 4 Actividad 15
document.getElementById('unit4-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    conteo = 0; //cuenta la cantidad de respuestas correctas obtenidas
    respuestas = 4; //respuestas correctas
    cantidadcbox = 6; //define la cantidad de cbox

    cboxname = "";
    contadorcbox = 0; //cuenta la cantidad de cbox seleccionados
    for (let i = 1; i <= cantidadcbox; i++) {
        cboxname = "act15-cb" + i;
        if (document.getElementById(cboxname).checked) {
            contadorcbox++;
        }
    }
    
    if (contadorcbox != 0) {
              //Se verifica que solo pueda escoger 4
        if (contadorcbox > respuestas) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('act15-cb1').checked) {
                            conteo++;
                        }
                        break;
                    case 2:
                        if (document.getElementById('act15-cb2').checked) {
                            conteo++;
                        }
                        break;
                    case 3:
                        if (document.getElementById('act15-cb3').checked) {
                            conteo++;
                        }
                        break;
                    case 4:
                        if (document.getElementById('act15-cb6').checked) {
                            conteo++;
                        }
                        break;
                    default:
                }
            }
            
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas) {
                var libro = 8;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = valorActividad;
                document.getElementById('idlibro15').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act15', 'ModalLibroOcho25');
                sweetAlert(1, 'good job', null);
                var ModalLibroOcho25 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho25'));
                ModalLibroOcho25.hide();
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 8;
                document.getElementById('idcliente15').value = users.value;
                document.getElementById('points15').value = points;
                document.getElementById('idlibro15').value = libro;
                console.log(points);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act15', 'ModalLibroOcho25');
                sweetAlert(4, conteo + '/' + respuestas +' answers right', null);
                var ModalLibroOcho25 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho25'));
                ModalLibroOcho25.hide();
                return true;
            }
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
});

//Unidad 4 Actividad 16
document.getElementById('unit4-act16').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    conteo = 0; //cuenta la cantidad de respuestas correctas obtenidas
    respuestas = 4; //respuestas correctas
    cantidadcbox = 6; //define la cantidad de cbox

    cboxname = "";
    contadorcbox = 0; //cuenta la cantidad de cbox seleccionados
    for (let i = 1; i <= cantidadcbox; i++) {
        cboxname = "act16-cb" + i;
        if (document.getElementById(cboxname).checked) {
            contadorcbox++;
        }
    }
    
    if (contadorcbox != 0) {
              //Se verifica que solo pueda escoger 4
        if (contadorcbox > respuestas) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('act16-cb3').checked) {
                            conteo++;
                        }
                        break;
                    case 2:
                        if (document.getElementById('act16-cb4').checked) {
                            conteo++;
                        }
                        break;
                    case 3:
                        if (document.getElementById('act16-cb5').checked) {
                            conteo++;
                        }
                        break;
                    case 4:
                        if (document.getElementById('act16-cb6').checked) {
                            conteo++;
                        }
                        break;
                    default:
                }
            }
            
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas) {
                var libro = 8;
                document.getElementById('idcliente16').value = users.value;
                document.getElementById('points16').value = valorActividad;
                document.getElementById('idlibro16').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act16', 'ModalLibroOcho26');
                sweetAlert(1, 'good job', null);
                var ModalLibroOcho26 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho26'));
                ModalLibroOcho26.hide();
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 8;
                document.getElementById('idcliente16').value = users.value;
                document.getElementById('points16').value = points;
                document.getElementById('idlibro16').value = libro;
                console.log(points);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act16', 'ModalLibroOcho26');
                sweetAlert(4, conteo + '/' + respuestas +' answers right', null);
                var ModalLibroOcho26 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho26'));
                ModalLibroOcho26.hide();
                return true;
            }
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
});

//Unidad 4 Actividad 17
document.getElementById('unit4-act17').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "1", "2", "1", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act17-q' + (i+1)).value;
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
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = valorActividad;
            document.getElementById('idlibro17').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act17', 'ModalLibroOcho27');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho27 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho27'));
            ModalLibroOcho27.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = points;
            document.getElementById('idlibro17').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act17', 'ModalLibroOcho27');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho27 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho27'));
            ModalLibroOcho27.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 18
document.getElementById('unit4-act18').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //INICIO CHECKBOXS
    //Se cuentan todos los cbox seleccionados
    notacbox_cb4 = 0; //contador de puntos obtenidos
    notacbox_cb4 = "";
    contadorcbox_cb4 = 0; //contador de cbox seleccionados
    for (let i = 1; i <= 4; i++) {
        cboxname_cb4 = "act18-cb" + i;
        if (document.getElementById(cboxname_cb4).checked) {
            contadorcbox_cb4++;
        }
    }
    for (i = 1; i <= 4; i++) {
        switch (i) {
            case 1:
                if (document.getElementById('act18-cb1').checked) {
                    notacbox_cb4++;
                }
                break;
            case 2:
                if (document.getElementById('act18-cb3').checked) {
                    notacbox_cb4++;
                }
                break;
            default:
        }
    }
    //FIN CHECKBOXS (cb3)

    //INICIO SELECTS
    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1","3","1","1","3","2","1","3","3","2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act18-s' + (i+1)).value;
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


    if (contadorcbox_cb4 == 0) {
        sweetAlert(2, 'Select an answer for question three', null);
    } else {
        
        if (contadorcbox_cb4 > 2) {
            sweetAlert(2, 'It is not valid to select all answers for question three, only choose two', null);
        } else {
            
            if (inputs.includes("0")) {
                sweetAlert(2, 'Complete the missing fields', null);
                return false;
            } else {

                let r_correctas = notacbox_cb4 + notaselect;
                //Se revisa si todas las respuestas son correctas
                if (r_correctas == 12) {
                    var libro = 8;
                    document.getElementById('idcliente18').value = users.value;
                    document.getElementById('points18').value = valorActividad;
                    document.getElementById('idlibro18').value = libro;
                    console.log(valorActividad);
                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit4-act18', 'ModalLibroOcho28');
                    sweetAlert(1, 'good job', null);
                    var ModalLibroOcho28 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho28'));
                    ModalLibroOcho28.hide();
                    return true;
                } else {
                    //Se asigna el puntaje basado en las respuestas correctas
                    let puntaje = valorActividad / 12;
                    let points = (puntaje * r_correctas).toFixed(2);
                    var libro = 8;
                    document.getElementById('idcliente18').value = users.value;
                    document.getElementById('points18').value = points;
                    document.getElementById('idlibro18').value = libro;
                    console.log(points);
                    action = 'create';
                    saveRowActivity(API_ACTIVIDADES, action, 'unit4-act18', 'ModalLibroOcho28');
                    sweetAlert(4, r_correctas + '/' + 12 +' answers right', null);
                    var ModalLibroOcho28 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho28'));
                    ModalLibroOcho28.hide();
                    return true;
                }
            }
        }
    }
});

//Unidad 4 Actividad 19
document.getElementById('unit4-act19').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3","1","2","2","1","2","3","1","1","2","1","1","2","1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act19-q' + (i+1)).value;
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
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = valorActividad;
            document.getElementById('idlibro19').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act19', 'ModalLibroOcho29');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho29 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho29'));
            ModalLibroOcho29.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act19', 'ModalLibroOcho29');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho29 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho29'));
            ModalLibroOcho29.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 20
document.getElementById('unit4-act20').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "1", "3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act20-q' + (i+1)).value;
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
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act20', 'ModalLibroOcho30');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho30 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho30'));
            ModalLibroOcho30.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = points;
            document.getElementById('idlibro20').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit4-act20', 'ModalLibroOcho30');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho30 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho30'));
            ModalLibroOcho30.hide();
            return true;
        }
    }    
});

//Unidad 4 Actividad 21
document.getElementById('unit4-act21').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    conteo = 0; //cuenta la cantidad de respuestas correctas obtenidas
    respuestas = 4; //respuestas correctas
    cantidadcbox = 6; //define la cantidad de cbox

    cboxname = "";
    contadorcbox = 0; //cuenta la cantidad de cbox seleccionados
    for (let i = 1; i <= cantidadcbox; i++) {
        cboxname = "act21-cb" + i;
        if (document.getElementById(cboxname).checked) {
            contadorcbox++;
        }
    }
    
    if (contadorcbox != 0) {
              //Se verifica que solo pueda escoger 4
        if (contadorcbox > respuestas) {
            sweetAlert(2, 'It is not valid to select all answers, Only choose four', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('act21-cb1').checked) {
                            conteo++;
                        }
                        break;
                    case 2:
                        if (document.getElementById('act21-cb2').checked) {
                            conteo++;
                        }
                        break;
                    case 3:
                        if (document.getElementById('act21-cb5').checked) {
                            conteo++;
                        }
                        break;
                    case 4:
                        if (document.getElementById('act21-cb6').checked) {
                            conteo++;
                        }
                        break;
                    default:
                }
            }
            
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas) {
                var libro = 8;
                document.getElementById('idcliente21').value = users.value;
                document.getElementById('points21').value = valorActividad;
                document.getElementById('idlibro21').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act21', 'ModalLibroOcho31');
                sweetAlert(1, 'good job', null);
                var ModalLibroOcho31 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho31'));
                ModalLibroOcho31.hide();
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / respuestas;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 8;
                document.getElementById('idcliente21').value = users.value;
                document.getElementById('points21').value = points;
                document.getElementById('idlibro21').value = libro;
                console.log(points);
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit4-act21', 'ModalLibroOcho31');
                sweetAlert(4, conteo + '/' + respuestas +' answers right', null);
                var ModalLibroOcho31 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho31'));
                ModalLibroOcho31.hide();
                return true;
            }
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }
});