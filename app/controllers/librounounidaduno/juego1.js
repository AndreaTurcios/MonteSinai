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
        saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalLibroNueve');
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
        saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalLibroOcho');
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});


document.getElementById('game-eleven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // 
    var stc1, stc2, stc3;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});


document.getElementById('game-twelve').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var ste1, ste2, ste3, ste4;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});


document.getElementById('game-thirdteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var stcn1, stcn2, stcn3;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

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
    // if (choice1.checked === true || choice2.checked === true || choice4.checked === true
    //     || choice6.checked === true || choice8.checked === true || choice9.checked === true
    //     || choice10.checked === true || choice11.checked === true || choice13.checked === true || choice15.checked === true) {
    //     sweetAlert(2, 'Select one choice per excercise', null);
    //     return false;
    // }
    if (choice3.checked === true && choice5.checked === true && choice3.checked === true
        && choice5.checked === true && choice7.checked === true && choice12.checked === true
        && choice14.checked === true) {

        sweetAlert(1, 'good job', null);
        return true;
    }
    else if (choice3.checked === false && choice5.checked === false
        && choice7.checked === false && choice12.checked === false && choice14.checked === false || choice1.checked === true || choice2.checked === true || choice4.checked === true
        || choice6.checked === true || choice8.checked === true || choice9.checked === true
        || choice10.checked === true || choice11.checked === true || choice13.checked === true || choice15.checked === true) {

        sweetAlert(2, 'Some of the answers are wrong, try it again or select one choice per excercise ', null);
        return true;
    }

});


document.getElementById('game-twentysix').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var nums1, nums2, nums3, nums4, nums5, nums6, nums7, nums8, nums9, nums10;
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
        sweetAlert(1, 'good job', null);
        return true;
    } else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});


document.getElementById('game-twentynine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var actp1, actp2, actp3, actp4, actp5, actp6, actp7, actp8
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

        sweetAlert(1, 'good job', null);
        return true;
    } else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});


document.getElementById('game-thirty').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var comp1, comp2, comp3, comp4, comp5, comp6;
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
        && comp4 === "you" && comp5 === "bad" && comp6 === "later") {

        sweetAlert(1, 'good job', null);
        return true;
    } else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});


document.getElementById('game-thirtyone').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // 
    var fills1, fills2, fills3, fills4, fills5, fills6;
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

        sweetAlert(1, 'good job', null);
        return true;
    } else {

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


// document.getElementById('game').addEventListener('submit', function (event) {
//     // Se evita recargar la página web después de enviar el formulario.
//     event.preventDefault();
// });

document.getElementById('game-thirtytwo').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var f1, f2, f3, f4, f5, f6, f7, f8, f9, f10;
    //
    f1 = document.getElementById('food-actyo32-61').value;
    f2 = document.getElementById('food-actyo32-62').value;
    f3 = document.getElementById('food-actyo32-63').value;
    f4 = document.getElementById('food-actyo32-64').value;
    f5 = document.getElementById('food-actyo32-65').value;
    f6 = document.getElementById('food-actyo32-66').value;
    f7 = document.getElementById('food-actyo32-67').value;
    f8 = document.getElementById('food-actyo32-68"').value;
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

        sweetAlert(1, 'good job', null);
        return true;
    } else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});


document.getElementById('game-thirtythree').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var frt1, frt2, frt3, frt4;
    //
    frt1 = document.getElementById('food-actyo33-71').value;
    frt2 = document.getElementById('food-actyo33-72').value;
    frt3 = document.getElementById('food-actyo33-73').value;
    frt4 = document.getElementById('food-actyo33-74').value;
    //
    if (frt1 === "" || frt2 === "" || frt3 === "" || frt4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (frt1 === "Orange" && frt2 === "Melon" && frt3 === "Coconut" && frt4 === "Tomato") {

        sweetAlert(1, 'good job', null);
        return true;
    } else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
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
