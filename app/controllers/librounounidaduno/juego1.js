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

// document.getElementById('game').addEventListener('submit', function (event) {
//     // Se evita recargar la página web después de enviar el formulario.
//     event.preventDefault();


// });

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

document.getElementById('game').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    
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
