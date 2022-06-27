const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var one, five, nine, thirdteen, two, six,
        ten, fourteen, three, seven, eleven, fifteen,
        four, eight, twelve, sixteen;
    //definición de variables 
    one = document.getElementById('input-oneh').value;//a
    five = document.getElementById('input-fivec').value;//r
    nine = document.getElementById('input-niner').value;//a
    thirdteen = document.getElementById('input-thirdteenu').value;//o
    two = document.getElementById('input-twoe').value;//c
    six = document.getElementById('input-sixn').value;//o
    ten = document.getElementById('input-tend').value;//d
    fourteen = document.getElementById('input-fourteenl').value;//l
    three = document.getElementById('input-threef').value;//o
    seven = document.getElementById('input-sevenh').value;//h
    eleven = document.getElementById('input-elevench').value;//o
    fifteen = document.getElementById('input-fifteenf').value;//g
    four = document.getElementById('input-fourc').value;//f
    eight = document.getElementById('input-eightt').value;//t
    twelve = document.getElementById('input-twelvey').value;//e
    sixteen = document.getElementById('input-sixteenk').value;//e
    // declacración de variables de puntajes 
    let promedio, promedios;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10, pt11, pt12, pt13, pt14, pt15, pt16, pt17;
    // declaración de condicionales 
    if (one === "" && five === "" && nine === "" && thirdteen === "" && two === "" && six === "" && ten === "" &&
        fourteen === "" && three === "" && seven === "" && eleven === "" && fifteen === "" && four === ""
        || eight === "" && twelve === "" && sixteen === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (one === "a" && five === "r" && nine === "a" && thirdteen === "o" && two === "c" && six === "o"
        && ten === "d" && fourteen === "l" && three === "o" && seven === "h" && eleven === "o"
        && fifteen === "g" && four === "f" && eight === "t"
        && twelve === "e" && sixteen === "e") {

        if (one = "a") {
            pt1 = 0.0625;
            console.log('0.63');
        }
        if (five = "r") {
            pt2 = 0.0625;
            console.log('0.63');
        }
        if (nine = "a") {
            pt3 = 0.0625;
            console.log('0.63');
        }
        if (thirdteen = "o") {
            pt4 = 0.0625;
            console.log('0.63');
        }
        if (two = "c") {
            pt5 = 0.0625;
            console.log('0.63');
        }
        if (six = "o") {
            pt6 = 0.0625;
            console.log('0.63');
        }
        if (ten = "d") {
            pt7 = 0.0625;
            console.log('0.63');
        }
        if (fourteen = "l") {
            pt8 = 0.0625;
            console.log('0.63');
        }
        if (three = "o") {
            pt9 = 0.0625;
            console.log('0.63');
        }
        if (seven = "h") {
            pt10 = 0.0625;
            console.log('0.63');
        }
        if (eleven = "o") {
            pt11 = 0.0625;
            console.log('0.63');
        }
        if (twelve = "e") {
            pt12 = 0.063;
            console.log('0.63');
        }
        if (sixteen = "o") {
            pt13 = 0.063;
            console.log('0.63');
        }
        if (fifteen = "g") {
            pt14 = 0.063;
            console.log('0.63');
        }
        if (four = "f") {
            pt15 = 0.0625;
            console.log('0.63');
        }
        if (eight = "t") {
            pt16 = 0.0625;
            console.log('0.63');
        }

        promedio = Math.round(parseFloat(pt1 + pt2 + pt3 + pt4 + pt5 + pt6 + pt7 + pt8 + pt9 + pt10 + pt11 + pt12 + pt13 + pt14 + pt15 + pt16));

        promedios = 1.11;
        var libro = 4;
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = promedio;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroUno');
        sweetAlert(1, 'good job', null);
        return true;

    } else if (one !== "a" || five !== "r" || nine !== "a" || thirdteen !== "o" || two !== "c" || six !== "o"
        || ten !== "d" || fourteen !== "l" || three !== "o" || seven !== "h" || eleven !== "o"
        || fifteen !== "g" || four !== "f" || eight !== "t"
        || twelve !== "e" || sixteen !== "e") {

        promedios = 1;
        var libro = 4;
        var puntosact1 = 16;
        ///
        if (one != "a") {
            puntosact1--
            console.log('0.63');
        }
        if (five != "r") {
            puntosact1--
            console.log('0.63');
        }
        if (nine != "a") {
            puntosact1--
            console.log('0.63');
        }
        if (thirdteen != "o") {
            puntosact1--
            console.log('0.63');
        }
        if (two != "c") {
            puntosact1--
            console.log('0.63');
        }
        if (six != "o") {
            puntosact1--
            console.log('0.63');
        }
        if (ten != "d") {
            puntosact1--
            console.log('0.63');
        }
        if (fourteen != "l") {
            puntosact1--
            console.log('0.63');
        }
        if (three != "o") {
            puntosact1--
            console.log('0.63');
        }
        if (seven != "h") {
            puntosact1--
            console.log('0.63');
        }
        if (eleven != "o") {
            puntosact1--
            console.log('0.63');
        }
        if (twelve != "e") {
            puntosact1--
            console.log('0.63');
        }
        if (sixteen != "o") {
            puntosact1--
            console.log('0.63');
        }
        if (fifteen != "g") {
            puntosact1--
            console.log('0.63');
        }
        if (four != "f") {
            puntosact1--
            console.log('0.63');
        }
        if (eight != "t") {
            puntosact1--
            console.log('0.63');
        }

        var conteos1 = puntosact1 / 16;
        var conteofinal1 = conteos1.toFixed(2);
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = conteofinal1;
        document.getElementById('idlibro').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroUno');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        //return false;
        // --- era esta linea, porque esto lo que indica es que trunca el resto de acciones 
    }


});

document.getElementById('game-three').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // variables declaradas
    var s1, s2, s3, s4
    let promedio, promedios;
    var ptact21, ptact22, ptact23, ptact24;
    // igualación de valores de inputs de form 
    s1 = document.getElementById('sentence1').value;
    s2 = document.getElementById('sentence2').value;
    s3 = document.getElementById('sentence3').value;
    s4 = document.getElementById('sentence4').value;
    // iteraciones 
    if (s1 === "" || s2 === "" || s3 === "" || s4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (s1 === "OPEN your eyes" && s2 === "CLOSE your eyes"
        && s3 === "WASH your face" && s4 === "TOUCH your eyes") {

        if (s1 = "OPEN your eyes") {
            ptact21 = 0.25;
        }
        if (s2 = "CLOSE your eyes") {
            ptact22 = 0.25;
        }
        if (s3 = "WASH your face") {
            ptact23 = 0.25;
        }
        if (s4 = "TOUCH your eyes") {
            ptact24 = 0.25;
        }

        promedio = Math.round(parseFloat(ptact21 + ptact22 + ptact23 + ptact24));
        var libro = 4;
        document.getElementById('idcliente3').value = users.value;
        document.getElementById('points3').value = promedio;
        document.getElementById('idlibro3').value = libro;
        action = 'createact2';
        saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalLibroTres');
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact21 = 4;

        if (s1 != "OPEN your eyes") {
            puntosact21--
        }
        if (s2 != "CLOSE your eyes") {
            puntosact21--
        }
        if (s3 != "WASH your face") {
            puntosact21--
        }
        if (s4 != "TOUCH your eyes") {
            puntosact21--

        }

        //
        var conteos2 = puntosact21 / 4;
        var conteofinal21 = conteos2.toFixed(2);
        document.getElementById('idcliente3').value = users.value;
        document.getElementById('points3').value = conteofinal21;
        document.getElementById('idlibro3').value = libro;
        action = 'createact2';
        saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalLibroTres');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});

document.getElementById('game-four').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // declaración de variables  
    var p1, p2, p3, p4;
    let promedio4, promedios;
    var ptact41, ptact42, ptact43, ptact44;
    // 
    p1 = document.getElementById('sentence14').value;
    p2 = document.getElementById('sentence24').value;
    p3 = document.getElementById('sentence34').value;
    p4 = document.getElementById('sentence44').value;
    // 
    if (p1 === "" || p2 === "" || p3 === "" || p4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (p1 === "I am Maricela" && p2 === "He is Boris" && p3 === "They are Classmates" && p4 === "She is Elsa") {

        if (p1 = "I am Maricela") {
            ptact41 = 0.25;
        }
        if (p2 = "He is Boris") {
            ptact42 = 0.25;
        }
        if (p3 = "They are Classmates") {
            ptact43 = 0.25;
        }
        if (p4 = "She is Elsa") {
            ptact44 = 0.25;
        }

        promedio4 = Math.round(parseFloat(ptact41 + ptact42 + ptact43 + ptact44));
        var libro = 4;
        document.getElementById('idcliente4').value = users.value;
        document.getElementById('points4').value = promedio4;
        document.getElementById('idlibro4').value = libro;
        action = 'createact4';
        saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalLibroCuatro');
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact41 = 4;

        if (p1 != "I am Maricela") {
            puntosact41--
        }
        if (p2 != "He is Boris") {
            puntosact41--
        }
        if (p3 != "They are Classmates") {
            puntosact41--
        }
        if (p4 != "She is Elsa") {
            puntosact41--

        }
        // redondeo de variables
        var conteos4 = puntosact41 / 4;
        var conteofinal41 = conteos4.toFixed(2);
        // Ejecución 
        document.getElementById('idcliente4').value = users.value;
        document.getElementById('points4').value = conteofinal41;
        document.getElementById('idlibro4').value = libro;
        action = 'createact4';
        saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalLibroCuatro');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-six').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    let promedio5, promedios;
    var ptact51, ptact52, ptact53, ptact54;
    // variables de actividad 
    var w1, w2, w3, w4;
    // asignación de valores a variables
    w1 = document.getElementById('words11').value;
    w2 = document.getElementById('words12').value;
    w3 = document.getElementById('words2').value;
    w4 = document.getElementById('words3').value;
    // declaración de condiciones
    if (w1 === "" || w2 === "" || w3 === "" || w4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (w1 === "I" && w2 === "You" && w3 === "I am a student" && w4 === "You are a teacher") {
        // asignación de puntajes
        if (w1 = "I") {
            ptact51 = 0.25;
        }
        if (w2 = "You") {
            ptact52 = 0.25;
        }
        if (w3 = "I am a student") {
            ptact53 = 0.25;
        }
        if (w4 = "You are a teacher") {
            ptact54 = 0.25;
        }
        // ejecución y envío de variables a API 
        promedio5 = Math.round(parseFloat(ptact51 + ptact52 + ptact53 + ptact54));
        var libro = 4;
        document.getElementById('idcliente6').value = users.value;
        document.getElementById('points6').value = promedio5;
        document.getElementById('idlibro6').value = libro;
        action = 'createact6';
        saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalLibroSeis');
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact51 = 4;
        // asignación de puntajes
        if (w1 != "I") {
            puntosact51--
        }
        if (w2 != "You") {
            puntosact51--
        }
        if (w3 != "I am a student") {
            puntosact51--
        }
        if (w4 != "You are a teacher") {
            puntosact51--

        }
        // redondeo de variables
        var conteos5 = puntosact51 / 4;
        var conteofinal51 = conteos5.toFixed(2);
        // ejecución y envío de variables a API 
        document.getElementById('idcliente6').value = users.value;
        document.getElementById('points6').value = conteofinal51;
        document.getElementById('idlibro6').value = libro;
        action = 'createact6';
        saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalLibroSeis');

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-seven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var ss1, ss2, ss3, ss4, ss5, ss6;
    let promedio6, promedios;
    //var ptact61, ptact62, ptact63, ptact64;
    //
    ss1 = document.getElementById('words-act6-11').value;
    ss2 = document.getElementById('words-act6-22').value;
    ss3 = document.getElementById('words-act6-33').value;
    ss4 = document.getElementById('words-act6-44').value;
    ss5 = document.getElementById('words-act6-55').value;
    ss6 = document.getElementById('words-act6-66').value;

    if (ss1 === "" || ss2 === "" || ss3 === "" || ss4 === "" || ss5 === "" || ss6 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (ss1 === "This is a mouth" && ss2 === "This is a nose" && ss3 === "This is a head"
        && ss4 === "These are feet" && ss5 === "These are hands" && ss6 === "These are eyes") {

        // ejecución y envío de variables a API 
        promedio6 = 1;
        var libro = 4;
        document.getElementById('idcliente7').value = users.value;
        document.getElementById('points7').value = promedio6;
        document.getElementById('idlibro7').value = libro;
        action = 'createact7';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven', 'ModalLibroSiete');
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact61 = 6;
        // asignación de puntajes
        if (ss1 != "This is a mouth") {
            puntosact61--
        }
        if (ss2 != "This is a nose") {
            puntosact61--
        }
        if (ss3 != "This is a head") {
            puntosact61--
        }
        if (ss4 != "These are feet") {
            puntosact61--
        }
        if (ss5 != "These are hands") {
            puntosact61--
        }
        if (ss6 != "These are eyes") {
            puntosact61--
        }

        // seteo de valor de puntajes 
        var conteos6 = puntosact61 / 6;
        var conteofinal61 = conteos6.toFixed(2);
        document.getElementById('idcliente7').value = users.value;
        document.getElementById('points7').value = conteofinal61;
        document.getElementById('idlibro7').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact7';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven', 'ModalLibroSiete');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-eight').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // variables 
    var r1, r2, r3, r4;
    let promedio7;
    // 
    r1 = document.getElementById('word-acty7-01').value;
    r2 = document.getElementById('word-acty7-02').value;
    r3 = document.getElementById('word-acty7-03').value;
    r4 = document.getElementById('word-acty7-04').value;
    // 
    if (r1 === "" || r2 === "" || r3 === "" || r4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (r1 === "You are my friend" && r2 === "We are friends"
        && r3 === "They are friends" && r4 === "It is a watch") {

        // envío de variables a API 
        promedio7 = 1;
        var libro = 4;
        document.getElementById('idcliente8').value = users.value;
        document.getElementById('points8').value = promedio7;
        document.getElementById('idlibro8').value = libro;
        // acciones 
        action = 'createact8';
        saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalLibroOcho');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact71 = 4;
        // asignación de puntajes
        if (r1 != "You are my friend") {
            puntosact71--
        }
        if (r2 != "We are friends") {
            puntosact71--
        }
        if (r3 != "They are friends") {
            puntosact71--
        }
        if (r4 != "It is a watch") {
            puntosact71--
        }

        // seteo de valor de puntajes 
        var conteos7 = puntosact71 / 4;
        var conteofinal71 = conteos7.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente8').value = users.value;
        document.getElementById('points8').value = conteofinal71;
        document.getElementById('idlibro8').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact8';
        saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalLibroOcho');
        //alert
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-nines').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var wor1, wor2, wor3, wor4;
    let promedio8;
    // 
    wor1 = document.getElementById('word-acto8-11').value;
    wor2 = document.getElementById('word-acto8-12').value;
    wor3 = document.getElementById('word-acto8-13').value;
    wor4 = document.getElementById('word-acto8-14').value;
    //
    if (wor1 === "" || wor2 === "" || wor3 === "" || wor4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (wor1 === "It" && wor2 === "We" && wor3 === "You" && wor4 === "They") {

        // envío de variables a API 
        promedio8 = 1;
        var libro = 4;
        document.getElementById('idcliente9').value = users.value;
        document.getElementById('points9').value = promedio8;
        document.getElementById('idlibro9').value = libro;
        // acciones 
        action = 'createact9';
        saveRowActivity(API_ACTIVIDADES, action, 'game-nines', 'ModalLibroNueve');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact81 = 4;
        // asignación de puntajes
        if (wor1 != "It") {
            puntosact81--
        }
        if (wor2 != "We") {
            puntosact81--
        }
        if (wor3 != "You") {
            puntosact81--
        }
        if (wor4 != "They") {
            puntosact81--
        }

        // seteo de valor de puntajes 
        var conteos8 = puntosact81 / 4;
        var conteofinal81 = conteos8.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente9').value = users.value;
        document.getElementById('points9').value = conteofinal81;
        document.getElementById('idlibro9').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact9';
        saveRowActivity(API_ACTIVIDADES, action, 'game-nines', 'ModalLibroNueve');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});

document.getElementById('game-ten').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var se1, se2, se4, se5;
    let promedio9;
    // 
    se1 = document.getElementById('word-actyo10-21').value;
    se2 = document.getElementById('word-actyo10-22').value;
    se3 = document.getElementById('word-actyo10-23').value;
    se4 = document.getElementById('word-actyo10-24').value;
    // 
    if (se1 === "" || se2 === "" || se3 === "" || se4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (se1 === "My" && se2 === "Your" && se3 === "His" && se4 === "Her") {

        // envío de variables a API 
        promedio9 = 1;
        var libro = 4;
        document.getElementById('idcliente10').value = users.value;
        document.getElementById('points10').value = promedio9;
        document.getElementById('idlibro10').value = libro;
        // acciones 
        action = 'createact10';
        saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalLibroDiez');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact91 = 4;
        // asignación de puntajes
        if (se1 != "My") {
            puntosact91--
        }
        if (se2 != "Your") {
            puntosact91--
        }
        if (se3 != "His") {
            puntosact91--
        }
        if (se4 != "They") {
            puntosact91--
        }
        // seteo de valor de puntajes 
        var conteos9 = puntosact91 / 4;
        var conteofinal91 = conteos9.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente10').value = users.value;
        document.getElementById('points10').value = conteofinal91;
        document.getElementById('idlibro10').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact10';
        saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalLibroDiez');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
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
    else {

        var libro = 4;
        var puntosact10 = 3;
        // asignación de puntajes
        if (stc1 != "This is your watch") {
            puntosact10--
        }
        if (stc2 != "This is his watch") {
            puntosact10--
        }
        if (stc3 != "This is her watch") {
            puntosact10--
        }
        // seteo de valor de puntajes 
        var conteos10 = puntosact10 / 3;
        var conteofinal10 = conteos10.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente11').value = users.value;
        document.getElementById('points11').value = conteofinal10;
        document.getElementById('idlibro11').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact11';
        saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalLibroOnce');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});

document.getElementById('game-twelve').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var ste1, ste2, ste3, ste4;
    let promedio12;
    // 
    ste1 = document.getElementById('word-actyo12-41').value;
    ste2 = document.getElementById('word-actyo12-42').value;
    ste3 = document.getElementById('word-actyo12-43').value;
    ste4 = document.getElementById('word-actyo12-44').value;
    // 
    if (ste1 === "" || ste2 === "" || ste3 === "" || ste4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (ste1 === "Short" && ste2 === "Tall" && ste3 === "I am short" && ste4 === "You are tall") {

        // envío de variables a API 
        promedio12 = 1;
        var libro = 4;
        document.getElementById('idcliente12').value = users.value;
        document.getElementById('points12').value = promedio12;
        document.getElementById('idlibro12').value = libro;
        // acciones 
        action = 'createact12';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalLibroDoce');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact12 = 4;
        // asignación de puntajes
        if (ste1 != "Short") {
            puntosact12--
        }
        if (ste2 != "Tall") {
            puntosact12--
        }
        if (ste3 != "I am short") {
            puntosact12--
        }
        if (ste4 != "You are tall") {
            puntosact12--
        }
        // seteo de valor de puntajes 
        var conteos12 = puntosact12 / 4;
        var conteofinal12 = conteos12.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente12').value = users.value;
        document.getElementById('points12').value = conteofinal12;
        document.getElementById('idlibro12').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact12';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalLibroDoce');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});

document.getElementById('game-thirdteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var stcn1, stcn2, stcn3;
    let promedio13;
    // 
    stcn1 = document.getElementById('word-actyo13-51').value;
    stcn2 = document.getElementById('word-actyo13-52').value;
    stcn3 = document.getElementById('word-actyo13-53').value;
    //
    if (stcn1 === "" || stcn2 === "" || stcn3 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (stcn1 === "What?" && stcn2 === "What is this?" && stcn3 === "What is your name?") {

        // envío de variables a API 
        promedio13 = 1;
        var libro = 4;
        document.getElementById('idcliente13').value = users.value;
        document.getElementById('points13').value = promedio13;
        document.getElementById('idlibro13').value = libro;
        // acciones 
        action = 'createact13';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirdteen', 'ModalLibroTrece');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact13 = 3;
        // asignación de puntajes
        if (stcn1 != "What?") {
            puntosact13--
        }
        if (stcn2 != "What is this?") {
            puntosact13--
        }
        if (stcn3 != "What is your name?") {
            puntosact13--
        }
        // seteo de valor de puntajes 
        var conteos13 = puntosact13 / 3;
        var conteofinal13 = conteos13.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente13').value = users.value;
        document.getElementById('points13').value = conteofinal13;
        document.getElementById('idlibro13').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact13';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirdteen', 'ModalLibroTrece');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-fourhteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // creación de arrays para comparación
    var arr1 = ['Red', 'Red', 'Red', 'Red', 'Red', 'Red'];
    var comp_arr1 = [];
    var arr2 = ['Green', 'Green', 'Green', 'Green', 'Green', 'Green'];
    var comp_arr2 = [];
    var arr3 = ['Blue', 'Blue', 'Blue', 'Blue', 'Blue', 'Blue'];
    var comp_arr3 = [];
    var arr4 = ['Black', 'Black', 'Black', 'Black', 'Black', 'Black'];
    var comp_arr4 = [];
    var arr4 = ['Brown', 'Brown', 'Brown', 'Brown', 'Brown', 'Brown'];
    var comp_arr5 = [];
    var arr4 = ['Yellow', 'Yellow', 'Yellow', 'Yellow', 'Yellow', 'Yellow'];
    var comp_arr6 = [];
    //
    var stcne1, stcne2, stcne3, stcne4, stcne5, stcne6;
    let promedio14;
    //
    stcne1 = document.getElementById('colors-actyo14-61').value;
    stcne2 = document.getElementById('colors-actyo14-62').value;
    stcne3 = document.getElementById('colors-actyo14-63').value;
    stcne4 = document.getElementById('colors-actyo14-64').value;
    stcne5 = document.getElementById('colors-actyo14-65').value;
    stcne6 = document.getElementById('colors-actyo14-66').value;
    //
    if (stcne1 === "" || stcne2 === "" || stcne3 === ""
        || stcne4 === "" || stcne5 === "" || stcne6 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (stcne1 === "Red" && stcne2 === "Green" && stcne3 === "Blue"
        && stcne4 === "Black" && stcne5 === "Brown" && stcne6 === "Yellow") {

        // envío de variables a API 
        promedio14 = 1;
        var libro = 4;
        document.getElementById('idcliente14').value = users.value;
        document.getElementById('points14').value = promedio14;
        document.getElementById('idlibro14').value = libro;
        // acciones 
        action = 'createact14';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fourhteen', 'ModalLibroCatorce');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact14 = 6;
        // asignación de puntajes
        if (stcne1 != "Red") {
            puntosact14--
        }
        if (stcne2 != "Green") {
            puntosact14--
        }
        if (stcne3 != "Blue") {
            puntosact14--
        }
        if (stcne4 != "Black") {
            puntosact14--
        }
        if (stcne5 != "Brown") {
            puntosact14--
        }
        if (stcne6 != "Yellow") {
            puntosact14--
        }
        // seteo de valor de puntajes 
        var conteos14 = puntosact14 / 6;
        var conteofinal14 = conteos14.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente14').value = users.value;
        document.getElementById('points14').value = conteofinal14;
        document.getElementById('idlibro14').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact14';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fourhteen', 'ModalLibroCatorce');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-twentyfive').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // 
    var choice1, choice2, choice3, choice4, choice5, choice6,
        choice7, choice8, choice9, choice10, choice11, choice12,
        choice13, choice14, choice15;
    let promedio25;
    //
    choice1 = document.getElementById('flexCheckDefault1');
    choice2 = document.getElementById('flexCheckDefault2');
    choice3 = document.getElementById('flexCheckDefault3');
    choice4 = document.getElementById('flexCheckDefault4');
    choice5 = document.getElementById('flexCheckDefault5');
    choice6 = document.getElementById('flexCheckDefault6');
    choice7 = document.getElementById('flexCheckDefault7');
    choice8 = document.getElementById('flexCheckDefault8');
    choice9 = document.getElementById('flexCheckDefault9');
    choice10 = document.getElementById('flexCheckDefault10');
    choice11 = document.getElementById('flexCheckDefault11');
    choice12 = document.getElementById('flexCheckDefault12');
    choice13 = document.getElementById('flexCheckDefault13');
    choice14 = document.getElementById('flexCheckDefault14');
    choice15 = document.getElementById('flexCheckDefault15');
    //

    if (choice3.checked === false && choice5.checked === false && choice7.checked === false && choice12.checked === false && choice14.checked === false) {
        sweetAlert(2, 'Select one choice, none of them are selected', null);
        return false;
    }
    if (choice3.checked === true && choice5.checked === true && choice3.checked === true
        && choice5.checked === true && choice7.checked === true && choice12.checked === true
        && choice14.checked === true) {

        // envío de variables a API 
        promedio25 = 1;
        var libro = 4;
        document.getElementById('idcliente25').value = users.value;
        document.getElementById('points25').value = promedio24;
        document.getElementById('idlibro25').value = libro;
        // acciones
        action = 'createact25';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirdteen', 'ModalLibroTrece');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    }
    else if (choice3.checked === false && choice5.checked === false
        && choice7.checked === false && choice12.checked === false && choice14.checked === false
        || choice1.checked === true || choice2.checked === true || choice4.checked === true
        || choice6.checked === true || choice8.checked === true || choice9.checked === true
        || choice10.checked === true || choice11.checked === true || choice13.checked === true
        || choice15.checked === true) {

        sweetAlert(2, 'Some of the answers are wrong, try it again or select one choice per excercise ', null);
        return true;
    }

});

document.getElementById('game-twentysix').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var nums1, nums2, nums3, nums4, nums5, nums6, nums7, nums8, nums9, nums10;
    let promedio26;
    // 
    nums1 = document.getElementById('numbers-actyo26-261').value;
    nums2 = document.getElementById('numbers-actyo26-262').value;
    nums3 = document.getElementById('numbers-actyo26-263').value;
    nums4 = document.getElementById('numbers-actyo26-264').value;
    nums5 = document.getElementById('numbers-actyo26-265').value;
    nums6 = document.getElementById('numbers-actyo26-266').value;
    nums7 = document.getElementById('numbers-actyo26-267').value;
    nums8 = document.getElementById('numbers-actyo26-268').value;
    nums9 = document.getElementById('numbers-actyo26-269').value;
    nums10 = document.getElementById('numbers-actyo26-2610').value;
    // 
    if (nums1 === "" || nums2 === "" || nums3 === "" || nums4 === "" || nums5 === ""
        || nums6 === "" || nums7 === "" || nums8 === "" || nums9 === "" || nums10 === "") {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (nums1 === "One" && nums2 === "Two" && nums3 === "Three" && nums4 === "Four" && nums5 === "Five"
        && nums6 === "Six" && nums7 === "Seven" && nums8 === "Eight" && nums9 === "Nine" && nums10 === "Ten") {

        // envío de variables a API 
        promedio26 = 1;
        var libro = 4;
        document.getElementById('idcliente26').value = users.value;
        document.getElementById('points26').value = promedio26;
        document.getElementById('idlibro26').value = libro;
        // acciones 
        action = 'createact26';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalLibroVeintiseis');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    } else {

        var libro = 4;
        var puntosact26 = 10;
        // asignación de puntajes
        if (nums1 != "One") {
            puntosact26--
        }
        if (nums2 != "Two") {
            puntosact26--
        }
        if (nums3 != "Three") {
            puntosact26--
        }
        if (nums4 != "Four") {
            puntosact26--
        }
        if (nums5 != "Five") {
            puntosact26--
        }
        if (nums6 != "Six") {
            puntosact26--
        }
        if (nums7 != "Seven") {
            puntosact26--
        }
        if (nums8 != "Eight") {
            puntosact26--
        }
        if (nums9 != "Nine") {
            puntosact26--
        }
        if (nums10 != "Ten") {
            puntosact26--
        }
        // seteo de valor de puntajes 
        var conteos26 = puntosact26 / 10;
        var conteofinal26 = conteos26.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente26').value = users.value;
        document.getElementById('points26').value = conteofinal26;
        document.getElementById('idlibro26').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact26';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalLibroVeintiseis');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-twentynine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var actp1, actp2, actp3, actp4, actp5, actp6, actp7, actp8;
    let promedio29;
    //
    actp1 = document.getElementById('input-actp1').value;
    actp2 = document.getElementById('input-actp2').value;
    actp3 = document.getElementById('input-actp3').value;
    actp4 = document.getElementById('input-actp4').value;
    actp5 = document.getElementById('input-actp5').value;
    actp6 = document.getElementById('input-actp6').value;
    actp7 = document.getElementById('input-actp7').value;
    actp8 = document.getElementById('input-actp8').value;
    //
    if (actp1 === "" || actp2 === "" || actp3 === "" || actp3 === ""
        || actp4 === "" || actp5 === "" || actp5 === "" || actp6 === ""
        || actp7 === "" || actp8 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (actp1 === "e" && actp2 === "you" && actp3 === "Not" && actp4 === "are"
        && actp5 === "Thank you" && actp6 === "and" && actp7 === "Hi" && actp8 === "new") {

        // envío de variables a API 
        promedio29 = 1;
        var libro = 4;
        document.getElementById('idcliente29').value = users.value;
        document.getElementById('points29').value = promedio29;
        document.getElementById('idlibro29').value = libro;
        // acciones 
        action = 'createact29';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine', 'ModalLibroVeintinueve');
        //alert
        sweetAlert(1, 'good job', null);
        return true;
    } else {

        var libro = 4;
        var puntosact29 = 8;
        // asignación de puntajes
        if (actp1 != "e") {
            puntosact29--
        }
        if (actp2 != "you") {
            puntosact29--
        }
        if (actp3 != "Not") {
            puntosact29--
        }
        if (actp4 != "are") {
            puntosact29--
        }
        if (actp5 != "Thank you") {
            puntosact29--
        }
        if (actp6 != "and") {
            puntosact29--
        }
        if (actp7 != "Hi") {
            puntosact29--
        }
        if (actp8 != "new") {
            puntosact29--
        }
        // seteo de valor de puntajes 
        var conteos29 = puntosact29 / 8;
        var conteofinal29 = conteos29.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente29').value = users.value;
        document.getElementById('points29').value = conteofinal29;
        document.getElementById('idlibro29').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact29';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine', 'ModalLibroVeintinueve');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-thirty').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var comp1, comp2, comp3, comp4, comp5, comp6;
    let promedio30;
    // 
    comp1 = document.getElementById('input-actp301').value;
    comp2 = document.getElementById('input-actp302').value;
    comp3 = document.getElementById('input-actp303').value;
    comp4 = document.getElementById('input-actp304').value;
    comp5 = document.getElementById('input-actp305').value;
    comp6 = document.getElementById('input-actp306').value;
    // 
    if (comp1 === "" || comp2 === "" || comp3 === ""
        || comp4 === "" || comp5 === "" || comp6 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (comp1 === "Miss" && comp2 === "Hello" && comp3 === "do"
        && comp4 === "you" && comp5 === "too" && comp6 === "later") {

        // envío de variables a API 
        promedio30 = 1;
        var libro = 4;
        document.getElementById('idcliente30').value = users.value;
        document.getElementById('points30').value = promedio30;
        document.getElementById('idlibro30').value = libro;
        // acciones 
        action = 'createact30';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirty', 'ModalLibroTreinta');
        //alert
        sweetAlert(1, 'Good job', null);
        return true;
    } else {

        var libro = 4;
        var puntosact30 = 6;
        // asignación de puntajes
        if (comp1 != "Miss") {
            puntosact30--
        }
        if (comp2 != "Hello") {
            puntosact30--
        }
        if (comp3 != "do") {
            puntosact30--
        }
        if (comp4 != "you") {
            puntosact30--
        }
        if (comp5 != "too") {
            puntosact30--
        }
        if (comp6 != "later") {
            puntosact30--
        }
        // seteo de valor de puntajes 
        var conteos30 = puntosact30 / 6;
        var conteofinal30 = conteos30.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente30').value = users.value;
        document.getElementById('points30').value = conteofinal30;
        document.getElementById('idlibro30').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact30';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirty', 'ModalLibroTreinta');
        //alert 
        
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        
        return true;
    }

});

document.getElementById('game-thirtyone').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // 
    var fills1, fills2, fills3, fills4, fills5, fills6;
    let promedio31;
    //
    fills1 = document.getElementById('input-actp311').value;
    fills2 = document.getElementById('input-actp312').value;
    fills3 = document.getElementById('input-actp313').value;
    fills4 = document.getElementById('input-actp314').value;
    fills5 = document.getElementById('input-actp315').value;
    fills6 = document.getElementById('input-actp316').value;
    //
    if (fills1 === "" || fills2 === "" || fills3 === ""
        || fills4 === "" || fills4 === "" || fills5 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (fills1 === "ent" && fills2 === "good!" && fills3 === "od"
        && fills4 === "Well" && fills5 === "All" && fills6 === "Good") {

        // envío de variables a API 
        promedio31 = 1;
        var libro = 4;
        document.getElementById('idcliente31').value = users.value;
        document.getElementById('points31').value = promedio31;
        document.getElementById('idlibro31').value = libro;
        // acciones 
        action = 'createact31';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtyone', 'ModalLibroTreintayuno');
        //alert
        sweetAlert(1, 'Good job', null);
        return true;
    } else {

        var libro = 4;
        var puntosact31 = 6;
        // asignación de puntajes
        if (fills1 != "ent") {
            puntosact31--
        }
        if (fills2 != "good!") {
            puntosact31--
        }
        if (fills3 != "od") {
            puntosact31--
        }
        if (fills4 != "Well") {
            puntosact31--
        }
        if (fills5 != "All") {
            puntosact31--
        }
        if (fills6 != "Good") {
            puntosact31--
        }
        // seteo de valor de puntajes 
        var conteos31 = puntosact31 / 6;
        var conteofinal31 = conteos31.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente31').value = users.value;
        document.getElementById('points31').value = conteofinal31;
        document.getElementById('idlibro31').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact31';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtyone', 'ModalLibroTreintayuno');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

// document.getElementById('game').addEventListener('submit', function (event) {
//     // Se evita recargar la página web después de enviar el formulario.
//     event.preventDefault();
// });

document.getElementById('game-thirtytwo').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var f1, f2, f3, f4, f5, f6, f7, f8, f9, f10;
    let promedio32;
    //
    f1 = document.getElementById('food-actyo32-61').value;
    f2 = document.getElementById('food-actyo32-62').value;
    f3 = document.getElementById('food-actyo32-63').value;
    f4 = document.getElementById('food-actyo32-64').value;
    f5 = document.getElementById('food-actyo32-65').value;
    f6 = document.getElementById('food-actyo32-66').value;
    f7 = document.getElementById('food-actyo32-67').value;
    f8 = document.getElementById('food-actyo32-68').value;
    f9 = document.getElementById('food-actyo32-69').value;
    f10 = document.getElementById('food-actyo32-610').value;
    //
    if (f1 === "" || f2 === "" || f3 === "" || f4 === ""
        || f5 === "" || f6 === "" || f7 === "" || f8 === ""
        || f9 === "" || f10 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (f1 === "rice" && f2 === "eggs" && f3 === "chicken" && f4 === "beans" && f5 === "oranges"
        && f6 === "potatoes" && f7 === "fish" && f8 === "meat" && f9 === "bread" && f10 === "shrimps") {

        // envío de variables a API 
        promedio32 = 1;
        var libro = 4;
        document.getElementById('idcliente32').value = users.value;
        document.getElementById('points32').value = promedio32;
        document.getElementById('idlibro32').value = libro;
        // acciones 
        action = 'createact32';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtytwo', 'ModalLibroTreintaydos');
        //alert
        sweetAlert(1, 'good job', null);
        return true;

    } else {

        var libro = 4;
        var puntosact32 = 10;
        // asignación de puntajes
        if (f1 != "rice") {
            puntosact32--
        }
        if (f2 != "eggs") {
            puntosact32--
        }
        if (f3 != "chicken") {
            puntosact32--
        }
        if (f4 != "beans") {
            puntosact32--
        }
        if (f5 != "oranges") {
            puntosact32--
        }
        if (f6 != "potatoes") {
            puntosact32--
        }
        if (f7 != "fish") {
            puntosact32--
        }
        if (f8 != "meat") {
            puntosact32--
        }
        if (f9 != "bread") {
            puntosact32--
        }
        if (f10 != "shrimps") {
            puntosact32--
        }        
        // seteo de valor de puntajes 
        var conteos32 = puntosact32 / 10;
        var conteofinal32 = conteos32.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente32').value = users.value;
        document.getElementById('points32').value = conteofinal32;
        document.getElementById('idlibro32').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact32';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtytwo', 'ModalLibroTreintaydos');
        //alert
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});


document.getElementById('game-thirtythree').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var frt1, frt2, frt3;
    //este he estado modifcando
    frt1 = document.getElementById('food-actyo33-71').value;
    frt2 = document.getElementById('food-actyo33-72').value;
    frt3 = document.getElementById('food-actyo33-73').value;
    //
    if (frt1 === "" || frt2 === "" || frt3 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (frt1 === "Just a minute, please" && frt2 === "I don't understand" && frt3 === "Can I go out?") {
       
        // envío de variables a API 
        promedio33 = 1;
        var libro = 4;
        document.getElementById('idcliente33').value = users.value;
        document.getElementById('points33').value = promedio32;
        document.getElementById('idlibro33').value = libro;
        // acciones 
        action = 'createact33';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtythree', 'ModalLibroTreintaytres');
        sweetAlert(1, 'Good job', null);
        return true;

    } else {

        var libro = 4;
        var puntosact33 = 10;
        // asignación de puntajes
        if (frt1 != "Just a minute, please") {
            puntosact33--
        }
        if (frt2 != "I don't understand") {
            puntosact33--
        }
        if (frt3 != "Can I go out?") {
            puntosact33--
        }

        // seteo de valor de puntajes 
        var conteos33 = puntosact33 / 10;
        var conteofinal33 = conteos33.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente33').value = users.value;
        document.getElementById('points33').value = conteofinal33;
        document.getElementById('idlibro33').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact33';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtythree', 'ModalLibroTreintaytres');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

// no implementado
document.getElementById('game-thirtyfour').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var frt1, frt2, frt3, frt4;
    //
    frt1 = document.getElementById('food-actyo34-81').value;
    frt2 = document.getElementById('food-actyo34-82').value;
    frt3 = document.getElementById('food-actyo34-83').value;
    frt4 = document.getElementById('food-actyo34-84').value;
    //
    if (frt1 === "" || frt2 === "" || frt3 === "" || frt4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (frt1 === "Orange" && frt2 === "Melon" && frt3 === "Coconut" && frt4 === "Tomato") {
       
        // envío de variables a API 
        promedio34 = 1;
        var libro = 4;
        document.getElementById('idcliente34').value = users.value;
        document.getElementById('points34').value = promedio32;
        document.getElementById('idlibro34').value = libro;
        // acciones 
        action = 'createact34';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtyfour', 'ModalLibroTreintaycuatro');
        sweetAlert(1, 'Good job', null);
        return true;

    } else {

        var libro = 4;
        var puntosact34 = 10;
        // asignación de puntajes
        if (frt1 != "Orange") {
            puntosact34--
        }
        if (frt2 != "Melon") {
            puntosact34--
        }
        if (frt3 != "Coconut") {
            puntosact34--
        }
        if (frt4 != "Tomato") {
            puntosact34--
        }
        
        // seteo de valor de puntajes 
        var conteos34 = puntosact34 / 10;
        var conteofinal34 = conteos34.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente34').value = users.value;
        document.getElementById('points34').value = conteofinal32;
        document.getElementById('idlibro34').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact34';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirtyfour', 'ModalLibroTreintaycuatro');
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-five').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (canvasGrid.style.backgroundColor = pickedColor) {
        //alert("color");

        promedio = 1.11;
        var libro = 4;
        document.getElementById('idcliente5').value = users.value;
        document.getElementById('points5').value = promedio;
        document.getElementById('idlibro5').value = libro;

        action = 'createact5';
        saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalLibrotsestdodfdfd');
    }
    if (canvasGrid.style.backgroundColor != pickedColor) {
        //alert("vacio");
    }


});
// coloreo ----------------------------------
// variables
const colorGrid = document.querySelector('.color-grid');
const canvasGrid = document.querySelector('.canvas-grid');
const clear = document.querySelector('#clear');
let pickedColor;
let isDrawing = false;

// colors array
let colors = [
    "#FF6633",
    "#FFB399",
    "#fff81e",
    "#FF33FF",
    "#FFFF99",
    "#E6B333",
    "#3366E6",
    "#99FF99",
    "#B34D4D",
    "#80B300",
    "#E6B3B3",
    "#6680B3",
    "#9bdcff",
    "#FF99E6",
    "#CCFF1A",
    "#FF1A66",
    "#33FFCC",
    "#B366CC",
    "#4D8000",
    "#B33300",
    "#000000"
];

// functions
function createBoxes() {
    for (let i = 0; i < colors.length; i++) {
        let colorBox = document.createElement('div');
        colorBox.classList.add('color-box', 'choose-from');
        colorBox.style.backgroundColor = colors[i];
        colorGrid.append(colorBox);
    };
}

function createCanvas() {
    for (let i = 0; i <= 12900; i++) {
        let canvasBox = document.createElement('div');
        canvasBox.classList.add('canvas-box', 'paint-on');
        canvasGrid.append(canvasBox);
    };
}

function pickAColor() {
    pickedColor = this.style.backgroundColor;
    console.log(pickedColor);
}

function initialise() {
    createBoxes();
    createCanvas();
}

// make a game to start drawing
initialise();

//listeners for colors to draw
const chooseFrom = document.querySelectorAll('.choose-from');
for (let pick of chooseFrom) {
    pick.addEventListener('click', pickAColor);
}

const paintOn = document.querySelectorAll('.paint-on');
for (let cell of paintOn) {
    cell.addEventListener('mousedown', function () {
        isDrawing = true;
        this.style.backgroundColor = pickedColor;
    });
    cell.addEventListener('mouseover', function () {
        if (isDrawing) {
            this.style.backgroundColor = pickedColor;
        }
    });
    cell.addEventListener('mouseup', function () {
        isDrawing = false;
    })
}

// clear listener
clear.addEventListener('click', function () {
    for (let cell of paintOn) {
        cell.style.backgroundColor = 'transparent';
    }
    pickedColor = undefined;
    console.log('all clear, we can start again')
})

//Página 12 - Canvas
document.getElementById('game-five').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var stcne1, stcne2, stcne3, stcne4, stcne5, stcne6;
    let promedio15;
    //
    stcne1 = document.getElementById('colors-actyo14-61').value;
    stcne2 = document.getElementById('colors-actyo14-62').value;
    stcne3 = document.getElementById('colors-actyo14-63').value;
    stcne4 = document.getElementById('colors-actyo14-64').value;
    stcne5 = document.getElementById('colors-actyo14-65').value;
    stcne6 = document.getElementById('colors-actyo14-66').value;

    //Debe de existir una sentencia donde identifique que el canvas esta vacio
    if (stcne1 === "" || stcne2 === "" || stcne3 === ""
        || stcne4 === "" || stcne5 === "" || stcne6 === "") {

        sweetAlert(2, 'You have not draw something', null);
        return false;
    }
    if (stcne1 === "Red" && stcne2 === "Green" && stcne3 === "Blue"
        && stcne4 === "Black" && stcne5 === "Brown" && stcne6 === "Yellow") {

        // envío de variables a API 
        promedio15 = 1;
        var libro = 4;
        document.getElementById('idcliente15').value = users.value;
        document.getElementById('points15').value = promedio15;
        document.getElementById('idlibro15').value = libro;
        // acciones 
        action = 'createact15';
        saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalLibrotsestdodfdfd');
        //alert
        sweetAlert(1, 'Good job', null);
        return true;
    }
    else {

        var libro = 4;
        var puntosact14 = 6;
        // asignación de puntajes
        if (stcne1 != "Red") {
            puntosact14--
        }
        if (stcne2 != "Green") {
            puntosact14--
        }
        if (stcne3 != "Blue") {
            puntosact14--
        }
        if (stcne4 != "Black") {
            puntosact14--
        }
        if (stcne5 != "Brown") {
            puntosact14--
        }
        if (stcne6 != "Yellow") {
            puntosact14--
        }
        // seteo de valor de puntajes 
        var conteos14 = puntosact14 / 6;
        var conteofinal14 = conteos14.toFixed(2);
        //asignación de valores 
        document.getElementById('idcliente15').value = users.value;
        document.getElementById('points15').value = conteofinal14;
        document.getElementById('idlibro15').value = libro;
        // ejecución y envío de variables a API 
        action = 'createact15';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen', 'ModalLibroQuince');
        //alert 
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});