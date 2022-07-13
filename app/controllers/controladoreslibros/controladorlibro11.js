const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //Se declaran las variables segun el numero de campos, a evaluar.
    let q1, q2, q3, a1, a2, a3;
    //Se igualan las variables a el campo de texto de la vista mediante el id.
    q1 = document.getElementById('q1').value;
    q2 = document.getElementById('q2').value;
    q3 = document.getElementById('q3').value;
    a1 = document.getElementById('a1').value;
    a2 = document.getElementById('a2').value;
    a3 = document.getElementById('a3').value;

    //Se crea un array con las posibles respuestas en base al texto del libro (Palabras clave)
    let respuestas = ["born", "Germany", "Nobel", "Zurich",
        "General", "1879", "Prize", "mathematics", "1915", "1921", "1894"];

    //Se verifica que todos los campos esten llenos
    if (q1 === "" || q2 === "" || q3 === "" || a1 === "" || a2 === "" || a3 === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }

    //Se convierten los campos a arrays para poder evaluar palabra por palabra.
    let arrayq0 = q1.split(' ')
    let arrayq1 = q2.split(' ')
    let arrayq2 = q3.split(' ')
    let arrayq3 = a1.split(' ')
    let arrayq4 = a2.split(' ')
    let arrayq5 = a3.split(' ')
    //Se crea un array que contenga otros arrays.
    let arraytotal = [arrayq0, arrayq1, arrayq2, arrayq3, arrayq4, arrayq5];

    //Se hace un for dentro de otro for, el primero hace bucles segun el numero de campos a revisar
    //El segundo recorre cada array del array total en busca de una palabra de las posibles.

    let notatotal = 0;

    for (var j = 0; j < 6; j++) {
        for (var i = 0; i < respuestas.length; i++) {
            indice = arraytotal[j].indexOf(respuestas[i])
            if (arraytotal[j][indice] === respuestas[i]) {
                nota = 0.17;
                notatotal = notatotal + nota;
            } else {
                nota = 0;
                notatotal = notatotal + nota;
            }
        }
    }

    if (notatotal === 1.02) {
        notatotal = 1.0;
    }

    var libro = 11;
    document.getElementById('idclienteL11').value = users.value;
    document.getElementById('pointsL11').value = notatotal;
    document.getElementById('idlibroL11').value = libro;
    action = 'createactA1U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroUno')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-two').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //Se declaran las variables segun el numero de campos, a evaluar.
    let q1, q2, q3, q4, a1, a2, a3, a4;
    //Se igualan las variables a el campo de texto de la vista mediante el id.
    q1 = document.getElementById('p1').value;
    q2 = document.getElementById('p2').value;
    q3 = document.getElementById('p3').value;
    q4 = document.getElementById('p4').value;
    a1 = document.getElementById('r1').value;
    a2 = document.getElementById('r2').value;
    a3 = document.getElementById('r3').value;
    a4 = document.getElementById('r4').value;

    console.log(document.getElementById('p1').value);
    console.log(document.getElementById('p2').value);
    console.log(document.getElementById('p3').value);
    console.log(document.getElementById('p4').value);
    console.log(document.getElementById('r1').value);
    console.log(document.getElementById('r2').value);
    console.log(document.getElementById('r3').value);
    console.log(document.getElementById('r4').value);

    //Se crea un array con las posibles respuestas en base al texto del libro (Palabras clave)
    let respuestas = ["achievement", "greatness", "disciplined", "perseverant", "Pablo Picasso", "1973",
        "creative", "artist", "passion", "Pablo", "enduring", "work", "great", "achievers", "personality", "traits", "strong", "determination"];

    //Se verifica que todos los campos esten llenos
    if (q1 === "" || q2 === "" || q3 === "" || q4 === "" || a1 === "" || a2 === "" || a3 === "" || a4 === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }

    //Se convierten los campos a arrays para poder evaluar palabra por palabra.
    let arrayq0 = q1.split(' ')
    let arrayq1 = q2.split(' ')
    let arrayq2 = q3.split(' ')
    let arrayq3 = q4.split(' ')
    let arrayq4 = a1.split(' ')
    let arrayq5 = a2.split(' ')
    let arrayq6 = a3.split(' ')
    let arrayq7 = a4.split(' ')
    //Se crea un array que contenga otros arrays.
    let arraytotal = [arrayq0, arrayq1, arrayq2, arrayq3, arrayq4, arrayq5, arrayq6, arrayq7];

    //Se hace un for dentro de otro for, el primero hace bucles segun el numero de campos a revisar
    //El segundo recorre cada array del array total en busca de una palabra de las posibles.

    let notatotal = 0;

    for (var j = 0; j < 8; j++) {
        for (var i = 0; i < respuestas.length; i++) {
            indice = arraytotal[j].indexOf(respuestas[i])
            if (arraytotal[j][indice] === respuestas[i]) {
                nota = 0.125;
                notatotal = notatotal + nota;
            } else {
                nota = 0;
                notatotal = notatotal + nota;
            }
        }
    }

    var libro = 11;
    document.getElementById('idclienteA2U1L11').value = users.value;
    document.getElementById('pointsA2U1L11').value = notatotal;
    document.getElementById('idlibroA2U1L11').value = libro;
    action = 'createactA2U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalLibroDos')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-three').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;

    if (document.getElementById('cbox1').checked || document.getElementById('cbox2').checked || document.getElementById('cbox3').checked ||
        document.getElementById('cbox4').checked || document.getElementById('cbox5').checked || document.getElementById('cbox6').checked) {

        if (document.getElementById('cbox1').checked && document.getElementById('cbox2').checked && document.getElementById('cbox3').checked
            && document.getElementById('cbox4').checked && document.getElementById('cbox5').checked && document.getElementById('cbox6').checked) {
            sweetAlert(2, 'It is not valid to select all answers', null);
        } else {
            for (i = 1; i < 7; i++) {
                switch (i) {
                    case 1:
                        if (document.getElementById('cbox1').checked) {
                            notatotal = notatotal + 0.25;
                        }
                        break;
                    case 2:
                        if (document.getElementById('cbox2').checked) {
                            notatotal = notatotal + 0.25;
                        }
                        break;
                    case 4:
                        if (document.getElementById('cbox4').checked) {
                            notatotal = notatotal + 0.25;
                        }
                        break;
                    case 5:
                        if (document.getElementById('cbox5').checked) {
                            notatotal = notatotal + 0.25;
                        }
                        break;
                    default:
                }
            }

            var libro = 11;
            document.getElementById('idclienteA3U1L11').value = users.value;
            document.getElementById('pointsA3U1L11').value = notatotal;
            document.getElementById('idlibroA3U1L11').value = libro;
            action = 'createactA3U1L11';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalLibroTres')
            sweetAlert(1, 'Resultados ingresados', null);
            return true;
        }
    } else {
        sweetAlert(2, 'Select the sentences', null);
    }

});

document.getElementById('game-four').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod = document.getElementById("sentences").value;
    if(cod == 3){
        notatotal = 1;
    }
    else{
        notatotal = 0;
    }

    var libro = 11;
    document.getElementById('idclienteA4U1L11').value = users.value;
    document.getElementById('pointsA4U1L11').value = notatotal;
    document.getElementById('idlibroA4U1L11').value = libro;
    action = 'createactA4U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalLibroCuatro')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;

});

document.getElementById('game-six').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("sent1").value;
    var cod2 = document.getElementById("sent2").value;
    var cod3 = document.getElementById("sent3").value;
    var cod4 = document.getElementById("sent4").value;
    
    if(cod1 == 3){
        notatotal = 0.25;
    }


    if(cod2 == 2){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 2){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 2){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA6U1L11').value = users.value;
    document.getElementById('pointsA6U1L11').value = notatotal;
    document.getElementById('idlibroA6U1L11').value = libro;
    action = 'createactA7U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalLibroSeis')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-seven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("sentences1").value;
    var cod2 = document.getElementById("sentences2").value;
    var cod3 = document.getElementById("sentences3").value;
    
    if(cod1 == 3){
        notatotal = 0.30;
    }


    if(cod2 == 2){
        notatotal = notatotal + 0.30;
    }


    if(cod3 == 2){
        notatotal = notatotal + 0.40;
    }

    var libro = 11;
    document.getElementById('idclienteA7U1L11').value = users.value;
    document.getElementById('pointsA7U1L11').value = notatotal;
    document.getElementById('idlibroA7U1L11').value = libro;
    action = 'createactA7U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-seven', 'ModalLibroSiete')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;

});

document.getElementById('game-eight').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("sen1").value;
    var cod2 = document.getElementById("sen2").value;
    var cod3 = document.getElementById("sen3").value;
    var cod4 = document.getElementById("sen4").value;
    
    if(cod1 == 2){
        notatotal = 0.25;
    }


    if(cod2 == 2){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 3){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 3){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA8U1L11').value = users.value;
    document.getElementById('pointsA8U1L11').value = notatotal;
    document.getElementById('idlibroA8U1L11').value = libro;
    action = 'createactA8U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalLibroOcho')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-nine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("se1").value;
    var cod2 = document.getElementById("se2").value;
    var cod3 = document.getElementById("se3").value;
    var cod4 = document.getElementById("se4").value;
    
    if(cod1 == 2){
        notatotal = 0.25;
    }


    if(cod2 == 3){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 1){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 2){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA9U1L11').value = users.value;
    document.getElementById('pointsA9U1L11').value = notatotal;
    document.getElementById('idlibroA9U1L11').value = libro;
    action = 'createactA9U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalLibroNueve')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-eleven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("s1").value;
    var cod2 = document.getElementById("s2").value;
    var cod3 = document.getElementById("s3").value;
    var cod4 = document.getElementById("s4").value;
    
    if(cod1 == 3){
        notatotal = 0.25;
    }


    if(cod2 == 2){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 1){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 3){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA11U1L11').value = users.value;
    document.getElementById('pointsA11U1L11').value = notatotal;
    document.getElementById('idlibroA11U1L11').value = libro;
    action = 'createactA11U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalLibroOnce')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-twelve').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("c1").value;
    var cod2 = document.getElementById("c2").value;
    var cod3 = document.getElementById("c3").value;
    var cod4 = document.getElementById("c4").value;
    
    if(cod1 == 1){
        notatotal = 0.25;
    }


    if(cod2 == 4){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 3){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 2){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA12U1L11').value = users.value;
    document.getElementById('pointsA12U1L11').value = notatotal;
    document.getElementById('idlibroA12U1L11').value = libro;
    action = 'createactA12U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalLibroDoce')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-thirdteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("d1").value;
    var cod2 = document.getElementById("d2").value;
    var cod3 = document.getElementById("d3").value;
    var cod4 = document.getElementById("d4").value;
    
    if(cod1 == 3){
        notatotal = 0.25;
    }


    if(cod2 == 3){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 1){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 2){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA13U1L11').value = users.value;
    document.getElementById('pointsA13U1L11').value = notatotal;
    document.getElementById('idlibroA13U1L11').value = libro;
    action = 'createactA13U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-thirdteen', 'ModalLibroTrece')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-fourteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    notatotal = 0;
    var cod1 = document.getElementById("f1").value;
    var cod2 = document.getElementById("f2").value;
    var cod3 = document.getElementById("f3").value;
    var cod4 = document.getElementById("f4").value;
    
    if(cod1 == 2){
        notatotal = 0.25;
    }


    if(cod2 == 3){
        notatotal = notatotal + 0.25;
    }


    if(cod3 == 1){
        notatotal = notatotal + 0.25;
    }

    if(cod4 == 2){
        notatotal = notatotal + 0.25;
    }

    var libro = 11;
    document.getElementById('idclienteA14U1L11').value = users.value;
    document.getElementById('pointsA14U1L11').value = notatotal;
    document.getElementById('idlibroA14U1L11').value = libro;
    action = 'createactA13U1L11';
    saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalLibroCatorce')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});


