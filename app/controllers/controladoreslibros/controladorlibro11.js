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

    for (var j = 0; j < 6; j++){
        for (var i = 0; i < respuestas.length; i++) {
            indice = arraytotal[j].indexOf(respuestas[i])
            if (arraytotal[j][indice] === respuestas[i]) {
                nota = 0.17;
                notatotal = notatotal + nota;
            }else{
                nota = 0;
                notatotal = notatotal + nota;
            }
        } 
    }
    
    if(notatotal === 1.02){
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

    for (var j = 0; j < 8; j++){
        for (var i = 0; i < respuestas.length; i++) {
            indice = arraytotal[j].indexOf(respuestas[i])
            if (arraytotal[j][indice] === respuestas[i]) {
                nota = 0.125;
                notatotal = notatotal + nota;
            }else{
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