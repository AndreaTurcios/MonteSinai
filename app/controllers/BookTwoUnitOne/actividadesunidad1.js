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

        promedios = 1;
        var libro = 2;
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
        var libro = 2;
        var puntosact1 = 10;
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
        var conteos1 = puntosact1 / 10;
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

document.getElementById('game-11b').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var one, two, six, three, four, five, seven, eight, nine, ten;
    //definición de variables 
    one = document.getElementById('input-one11').value;//one
    two = document.getElementById('input-two11').value;//two
    three = document.getElementById('input-three11').value;//three
    four = document.getElementById('input-four11').value;//four
    five = document.getElementById('input-five11').value;//fivr
    six = document.getElementById('input-six11').value;//six
    seven = document.getElementById('input-seven11').value;//seven
    eight = document.getElementById('input-eight11').value;//eight
    nine = document.getElementById('input-nine11').value;//nine
    ten = document.getElementById('input-ten11').value;//ten
    // declacración de variables de puntajes 
    let promedio, promedios;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10;
    // declaración de condicionales 
    if (one === "" && two === "" && three === "" && four === "" && five === "" && six === "" &&
        seven === "" && eight === "" && nine === ""||eight === "" ) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (one === "one" && two === "two" && three === "three" && four === "four" && five === "five"
        && six === "six" && seven === "seven" && eight === "eight" && nine === "nine" && ten === "ten") {

        if (one = "one") {
            pt1 = 0.1;
            console.log('0.1');
        }
        if (two = "two") {
            pt2 = 0.1;
            console.log('0.1');
        }
        if (three = "three") {
            pt3 = 0.1;
            console.log('0.1');
        }
        if (four = "four") {
            pt4 = 0.1;
            console.log('0.1');
        }
        if (five = "five") {
            pt5 = 0.1;
            console.log('0.1');
        }
        if (six = "six") {
            pt6 = 0.1;
            console.log('0.1');
        }
        if (seven = "seven") {
            pt7 = 0.1;
            console.log('0.1');
        }
        if (eight = "eight") {
            pt8 = 0.1;
            console.log('0.1');
        }
        if (nine = "nine") {
            pt9 = 0.1;
            console.log('0.1');
        }
        if (ten = "ten") {
            pt10 = 0.1;
            console.log('0.1');
        }
        promedio = Math.round(parseFloat(pt1 + pt2 + pt3 + pt4 + pt5 + pt6 + pt7 + pt8 + pt9 + pt10));

        promedios = 1.;
        var libro = 2;
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = promedio;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-11b', 'ModalLibroDos11AC2');
        sweetAlert(1, 'good job', null);
        return true;

    } else if (one !== "one" || two !== "two" || three !== "three" || four !== "four" || five !== "five"

        || six !== "six" || seven !== "seven" || eight !== "eight" || nine !== "nine" || ten !== "ten") {

        promedios = 1;
        var libro = 2;
        var puntosact1 = 10;
        ///
        if (one != "one") {
            puntosact1--
            console.log('0.1');
        }
        if (two != "two") {
            puntosact1--
            console.log('0.1');
        }
        if (three != "three") {
            puntosact1--
            console.log('0.1');
        }
        if (four != "four") {
            puntosact1--
            console.log('0.1');
        }
        if (five != "five") {
            puntosact1--
            console.log('0.1');
        }
        if (six != "six") {
            puntosact1--
            console.log('0.1');
        }
        if (seven != "seven") {
            puntosact1--
            console.log('0.1');
        }
        if (eight != "eight") {
            puntosact1--
            console.log('0.1');
        }
        if (nine != "nine") {
            puntosact1--
            console.log('0.1');
        }
        if (ten != "ten") {
            puntosact1--
            console.log('0.1');
        }
        var conteos1 = puntosact1 / 10;
        var conteofinal1 = conteos1.toFixed(2);
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = conteofinal1;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-11b', 'ModalLibroDos11AC2');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        //return false;
        // --- era esta linea, porque esto lo que indica es que trunca el resto de acciones 
    }
});

