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
    let promedio;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10, pt11, pt12, pt13, pt12
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

        if (one === "a") {
            var pt1 = 0.63;
            console.log('0.63');
        }
        if (five === "r") {
            var pt2 = 0.63;
            console.log('0.63');
        }
        if (nine === "a") {
            var pt3 = 0.63;
            console.log('0.63');
        }
        if (thirdteen === "o") {
            var pt4 = 0.63;
            console.log('0.63');
        }
        if (two === "c") {
            var pt5 = 0.63;
            console.log('0.63');
        }
        if (six === "o") {
            var pt6 = 0.63;
            console.log('0.63');
        }
        if (ten === "d") {
            var pt7 = 0.63;
            console.log('0.63');
        }
        if (fourteen === "l") {
            var pt8 = 0.63;
            console.log('0.63');
        }
        if (three === "o") {
            var pt9 = 0.63;
            console.log('0.63');
        }
        if (seven === "h") {
            var pt10 = 0.63;
            console.log('0.63');
        }
        if (eleven === "o") {
            var pt11 = 0.63;
            console.log('0.63');
        }
        if (twelve === "e") {
            var pt12 = 0.63;
            console.log('0.63');
        }
        if (sixteen === "o") {
            var pt13 = 0.63;
            console.log('0.63');
        }
        if (fifteen === "g") {
            var pt14 = 0.63;
            console.log('0.63');
        }
        if (four === "f") {
            var pt15 = 0.63;
            console.log('0.63');
        }
        if (eight === "t") {
            var pt16 = 0.63;
            console.log('0.63');
        }

        let suma = parseFloat(pt1 + pt2 + pt3 + pt4 + pt5 + pt6 + pt7 + pt8 + pt9 + pt10 + pt11 + pt12 + pt13 + pt14 + pt15 + pt16)

        promedio = 1.11;
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

        promedio = 1.11;
        var libro = 4;
        document.getElementById('idcliente').value = users.value;
        document.getElementById('points').value = promedio;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {
        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }
});


document.getElementById('game-four').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // declaración de variables  
    var p1, p2, p3, p4;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-six').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    var w1, w2, w3, w4;

    w1 = document.getElementById('words11').value;
    w2 = document.getElementById('words12').value;
    w3 = document.getElementById('words2').value;
    w4 = document.getElementById('words3').value;

    if (w1 === "" || w2 === "" || w3 === "" || w4 === "") {

        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }
    if (w1 === "I" && w2 === "You" && w3 === "I am a student" && w4 === "You are a teacher") {

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});

document.getElementById('game-seven').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var ss1, ss2, ss3, ss4, ss5, ss6;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }


});

document.getElementById('game-eight').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // variables 
    var r1, r2, r3, r4;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

        sweetAlert(2, 'Some of the answers are wrong, try it again', null);
        return true;
    }

});


document.getElementById('game-nines').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    var wor1, wor2, wor3, wo4;
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

        sweetAlert(1, 'good job', null);
        return true;
    }
    else {

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


// document.getElementById('game').addEventListener('submit', function (event) {
//     // Se evita recargar la página web después de enviar el formulario.
//     event.preventDefault();


// });


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
