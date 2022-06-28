const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-5').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var one, two, six, three, seven, four, eight;
    //definición de variables 
    one = document.getElementById('input-one').value;//shirt
    two = document.getElementById('input-two').value;//hat
    three = document.getElementById('input-three').value;//pants
    four = document.getElementById('input-four').value;//necktie
    five = document.getElementById('input-five').value;//socks
    six = document.getElementById('input-six').value;//gloves
    seven = document.getElementById('input-seven').value;//belt
    eight = document.getElementById('input-eight').value;//polish shoes
    // declacración de variables de puntajes 
    let promedio, promedios;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8;
    // declaración de condicionales 
    if (one === "" && two === "" && three === "" && four === "" && five === "" && six === "" &&
         seven === "" ||eight === "" ) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (one === "shirt" && two === "hat" && three === "pants" && four === "necktie" && five === "socks"
        && six === "gloves" && seven === "belt" && eight === "polish shoes") {

        if (one = "shirt") {
            pt1 = 0.125;
            console.log('0.125');
        }
        if (two = "hat") {
            pt2 = 0.125;
            console.log('0.125');
        }
        if (three = "pants") {
            pt3 = 0.125;
            console.log('0.125');
        }
        if (four = "necktie") {
            pt4 = 0.125;
            console.log('0.125');
        }
        if (five = "socks") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (six = "gloves") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (seven = "belt") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (eight = "polish shoes") {
            pt5 = 0.125;
            console.log('0.125');
        }
        promedio = Math.round(parseFloat(pt1 + pt2 + pt3 + pt4 + pt5 + pt6 + pt7 + pt8));

        promedios = 1.11;
        var libro = 4;
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = promedio;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-5', 'ModalLibroDos5');
        sweetAlert(1, 'good job', null);
        return true;

    } else if (one !== "shirt" || two !== "gloves" || three !== "pants" || four !== "necktie" || five !== "socks"

        || six !== "gloves" || seven !== "belt" || eight !== "polish shoes") {

        promedios = 1;
        var libro = 4;
        var puntosact1 = 16;
        ///
        if (one != "shirt") {
            puntosact1--
            console.log('0.125');
        }
        if (two != "hat") {
            puntosact1--
            console.log('0.125');
        }
        if (three != "pants") {
            puntosact1--
            console.log('0.125');
        }
        if (four != "necktie") {
            puntosact1--
            console.log('0.125');
        }
        if (five != "socks") {
            puntosact1--
            console.log('0.125');
        }
        if (six != "gloves") {
            puntosact1--
            console.log('0.125');
        }
        if (seven != "belt") {
            puntosact1--
            console.log('0.125');
        }
        if (eight != "polish shoes") {
            puntosact1--
            console.log('0.125');
        }
        var conteos1 = puntosact1 / 16;
        var conteofinal1 = conteos1.toFixed(2);
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = conteofinal1;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-5', 'ModalLibroDos5');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        //return false;
        // --- era esta linea, porque esto lo que indica es que trunca el resto de acciones 
    }


});

document.getElementById('game-6').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var one, two, six, three, four, five, seven, eight;
    //definición de variables 
    one = document.getElementById('input-one6').value;//blouse
    two = document.getElementById('input-two6').value;//belt
    three = document.getElementById('input-three6').value;//stockings
    four = document.getElementById('input-four6').value;//gloves
    five = document.getElementById('input-five6').value;//skirt
    six = document.getElementById('input-six6').value;//necktie
    seven = document.getElementById('input-seven6').value;//shoes
    eight = document.getElementById('input-eight6').value;//diadem
    // declacración de variables de puntajes 
    let promedio, promedios;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8;
    // declaración de condicionales 
    if (one === "" && two === "" && three === "" && four === "" && five === "" && six === "" &&
         seven === "" ||eight === "" ) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (one === "blouse" && two === "belt" && three === "stockings" && four === "gloves" && five === "skirt"
        && six === "necktie" && seven === "shoes" && eight === "diadem") {

        if (one = "blouse") {
            pt1 = 0.125;
            console.log('0.125');
        }
        if (two = "belt") {
            pt2 = 0.125;
            console.log('0.125');
        }
        if (three = "stockings") {
            pt3 = 0.125;
            console.log('0.125');
        }
        if (four = "gloves") {
            pt4 = 0.125;
            console.log('0.125');
        }
        if (five = "skirt") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (six = "necktie") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (seven = "shoes") {
            pt5 = 0.125;
            console.log('0.125');
        }
        if (eight = "diadem") {
            pt5 = 0.125;
            console.log('0.125');
        }
        promedio = Math.round(parseFloat(pt1 + pt2 + pt3 + pt4 + pt5 + pt6 + pt7 + pt8));

        promedios = 1.11;
        var libro = 4;
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = promedio;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-6', 'ModalLibroDos6');
        sweetAlert(1, 'good job', null);
        return true;

    } else if (one !== "blouse" || two !== "belt" || three !== "stockings" || four !== "gloves" || five !== "skirt"

        || six !== "necktie" || seven !== "shoes" || eight !== "diadem") {

        promedios = 1;
        var libro = 4;
        var puntosact1 = 16;
        ///
        if (one != "blouse") {
            puntosact1--
            console.log('0.125');
        }
        if (two != "belt") {
            puntosact1--
            console.log('0.125');
        }
        if (three != "stockings") {
            puntosact1--
            console.log('0.125');
        }
        if (four != "gloves") {
            puntosact1--
            console.log('0.125');
        }
        if (five != "skirt") {
            puntosact1--
            console.log('0.125');
        }
        if (six != "necktie") {
            puntosact1--
            console.log('0.125');
        }
        if (seven != "shoes") {
            puntosact1--
            console.log('0.125');
        }
        if (eight != "diadem") {
            puntosact1--
            console.log('0.125');
        }
        var conteos1 = puntosact1 / 16;
        var conteofinal1 = conteos1.toFixed(2);
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = conteofinal1;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-6', 'ModalLibroDos6');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        //return false;
        // --- era esta linea, porque esto lo que indica es que trunca el resto de acciones 
    }
});

document.getElementById('game-eleven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // 
    var stc1, stc2, stc3;
    let promedio10;
    // 
    stc1 = document.getElementById('word-actyo11-31').value;
    stc2 = document.getElementById('word-actyo11-32').value;
    stc3 = document.getElementById('word-actyo11-33').value;
    // 
    if (stc1 === "" || stc2 === "" || stc3 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (stc1 === "This is your watch" && stc2 === "This is his watch" && stc3 === "This is her watch") {

        // envío de variables a API 
        promedio10 = 1;
        var libro = 4;
        document.getElementById('idcliente11').value = users.value;
        document.getElementById('points11').value = promedio10;
        document.getElementById('idlibro11').value = libro;
        // acciones 
        action = 'createact11';
        saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalLibroOnce');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
});


