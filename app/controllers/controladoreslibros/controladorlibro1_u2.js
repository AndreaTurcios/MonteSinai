const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

document.getElementById('game-one').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["GRANDFATHER",  "MANGO", "SISTER", "RICE", "FRUITS", "MOTHER", "MY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act1-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;
            document.getElementById('idcliente1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalUnit2Act1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalUnit2Act1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act2

for (let i = 0; i < 3; i++) {
    document.getElementById('img-act2-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act2

for (let i = 0; i < 3; i++) {
    document.getElementById('box-act2-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src",  draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt",  draggedAlt);
        
    });

    document.getElementById('box-act2-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-two').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["BREAKFAST", "LUNCH", "DINNER"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 3; i++) {
        imgs[i] = $("#img-act2-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 1;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = valorActividad;
        document.getElementById('idlibro2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit2Act2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 1;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = points;
        document.getElementById('idlibro2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit2Act2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act2').modal('hide');
        return true;
    }    

});

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas1');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker = document.getElementById("colorPicker");
    var widthStrokePicker = document.getElementById("strokeWidthPicker");
    var clearButton = document.getElementById("clearBtn");

    // Clear event listener
    clear2Btn.addEventListener("click", function () {
        // Clear canvas
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker.value;
        widthStroke = widthStrokePicker.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);

    // Define a mousedown and mousedrag handler
    tool.onMouseDown = function (event) {
        path = new Path();
        path.strokeWidth = widthStroke;
        path.strokeColor = colorStroke;
        // Draw
        path.add(event.point);
    }

    tool.onMouseDrag = function (event) {
        // Draw
        path.add(event.point);
        document.getElementById("verify-canvas").value = 1;
    }
}

$('#ModalUnit2Act3').on('shown.bs.modal', function (e) {
    // Set it up
    paper.setup('canvas1');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker = document.getElementById("colorPicker");
    var widthStrokePicker = document.getElementById("strokeWidthPicker");
    var clearButton = document.getElementById("clearBtn");

    // Clear event listener
    clearBtn.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker.value;
        widthStroke = widthStrokePicker.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-three').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
        promedio = 1;
        var libro = 1;
        document.getElementById('idcliente3').value = users.value;
        document.getElementById('points3').value = promedio;
        document.getElementById('idlibro3').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalUnit2Act3');
        sweetAlert(1, 'Good job', null);
        $('#ModalUnit2Act3').modal('hide');
        return true;
    }

});

document.getElementById('game-four').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["She is eating pupusas", "She is eating cookies", "He is drinking a coke"];   
    let inputsCmb = [];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value;
        inputsCmb[i] = document.getElementById('select-act4-' + (i + 1)).value;
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputsCmb[i].toUpperCase()) {
                conteo++;
            }            
        }

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == 6) {
            var libro = 1;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;
            document.getElementById('idcliente4').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit2Act4');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act4').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 6;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            document.getElementById('idcliente4').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit2Act4');
            sweetAlert(4, conteo + '/' + 6 + ' answers right', null);
            $('#ModalUnit2Act4').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-five').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    //let respuestas = ["Water", "Milk shake", "Orange juice", "Horchata", "Coffee", "Chocolate", "Tea"];   
    let inputsCmb = [];

    //Variable para obtener la cantidad de respuestas correctas
    var conteo = 0;

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputsCmb[i] = document.getElementById('select-act5-' + (i + 1)).value;
        if (inputsCmb[i].includes('Water') || inputsCmb[i].includes('Milk shake') || inputsCmb[i].includes('Orange juice') || inputsCmb[i].includes('Horchata') 
        || inputsCmb[i].includes('Coffee') || inputsCmb[i].includes('Chocolate') || inputsCmb[i].includes('Tea')
        || inputsCmb[i].includes('Mother') || inputsCmb[i].includes('Sister') || inputsCmb[i].includes('Father')
        || inputsCmb[i].includes('Grandmother') || inputsCmb[i].includes('Grandfather') || inputsCmb[i].includes('Drink')) {
            conteo++;
        }
    }
    
    if (inputsCmb[2].value == "Eat" || inputsCmb[3].includes('Coffee')
        || inputsCmb[3].includes('Chocolate') || inputsCmb[3].includes('Tea')) {
        conteo--;
    }

  

    if (inputsCmb[1].includes("") || inputsCmb[2].includes("") || inputsCmb[3].includes("") || inputsCmb[4].includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        
        //Se revisa si todas las respuestas son correctas
        if (conteo == 4) {
            var libro = 1;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;
            document.getElementById('idcliente5').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit2Act5');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act5').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / 4;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            document.getElementById('idcliente5').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit2Act5');
            sweetAlert(4, conteo + '/' + 4 + ' answers right', null);
            $('#ModalUnit2Act5').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-six').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["DO",  "DRINK COKE", "PREFER", "WANT", "PREFER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act6-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;
            document.getElementById('idcliente6').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit2Act6');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act6').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit2Act6');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act6').modal('hide');
            return true;
        }
    }
    
});

//FALTA EL 7

document.getElementById('game-eight').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SIT",  "SIMON SAYS", "THREE", "YOUR", "PLEASE", "SIMON SAYS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act8-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;
            document.getElementById('idcliente8').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalUnit2Act8');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act8').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight', 'ModalUnit2Act8');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act8').modal('hide');
            return true;
        }
    }
    
});

$('#ModalUnit2Act3').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
});

$('#ModalUnit2Act9').on('shown.bs.modal', function (e) {
    if (intervalo) {
        clearInterval(intervalo);
    }
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas2');

    // Get elements from DOM and define properties
    var colorPicker2 = document.getElementById("colorPicker2");
    var widthStrokePicker2 = document.getElementById("strokeWidthPicker2");
    var clearButton2 = document.getElementById("clearBtn2");

    // Clear event listener
    clearButton2.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker2.value;
        widthStroke = widthStrokePicker2.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-nine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
        promedio = 1;
        var libro = 1;
        document.getElementById('idcliente9').value = users.value;
        document.getElementById('points9').value = promedio;
        document.getElementById('idlibro9').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit2Act9');
        sweetAlert(1, 'Good job', null);
        $('#ModalUnit2Act9').modal('hide');
        return true;
    }

});

document.getElementById('game-ten').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    promedio = 1;
    var libro = 1;
    document.getElementById('idcliente10').value = users.value;
    document.getElementById('points10').value = promedio;
    document.getElementById('idlibro10').value = libro;

    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit2Act10');
    sweetAlert(1, 'Good job', null);
    $('#ModalUnit2Act10').modal('hide');
    return true;

});

document.getElementById('game-eleven').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglo para guardar datos ingresados    
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < 6; i++) {
       inputs[i] = document.getElementById('input-act11-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {

        if (!inputs[2].includes("Hello")) {
            sweetAlert(2, "You have to say 'Hello' ", null);
            return false;
        } else {
            var libro = 1;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;
            document.getElementById('idcliente11').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven', 'ModalUnit2Act11');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act11').modal('hide');
            return true;
        }
        
    }
    
});

document.getElementById('game-twelve').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["PLEASE, LISTEN",  "TAKE A PENCIL", "COME BACK TO YOUR SEAT", "OPEN THE WINDOW", "TAKE A PIECE OF CHALK"
                    , "TAKE A PEN", "COME IN", "PLEASE RAISE YOUR HAND", "DON'T MAKE ANY NOICE", "CLOSE YOUR BOOK"
                    , "PAY ATTENTION, PLEASE", "TOUCH YOUR SHOULDERS", "WRITE YOUR NAME", "PLEASE, READ THE SENTENCE", "REPEAT, AFTER ME"
                    , "DRAW A CLOWN", "CLOSE YOUR WINDOW"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act12-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;
            document.getElementById('idcliente12').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalUnit2Act12');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act12').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente12').value = users.value;
            document.getElementById('points12').value = points;
            document.getElementById('idlibro12').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalUnit2Act12');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act12').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act13

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act13-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act13

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act13-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src",  draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt",  draggedAlt);
        
    });

    document.getElementById('box-act13-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-thirteen_1').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["NURSE", "DOCTOR", "SECRETARY", "TEACHER"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act13-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 1;
        document.getElementById('idcliente13_1').value = users.value;
        document.getElementById('points13_1').value = valorActividad;
        document.getElementById('idlibro13_1').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit2Act13_1');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act13_1').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 1;
        document.getElementById('idcliente13_1').value = users.value;
        document.getElementById('points13_1').value = points;
        document.getElementById('idlibro13_1').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit2Act13_1');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act13_1').modal('hide');
        return true;
    }    

});

document.getElementById('game-thirteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SHE IS A TEACHER",  "YOU ARE A STUDENT", "ARELY IS A SECRETARY", "HE IS A DOCTOR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act13-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points13_2').value = valorActividad;
            document.getElementById('idlibro13_2').value = libro;
            document.getElementById('idcliente13_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit2Act13_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act13_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente13_2').value = users.value;
            document.getElementById('points13_2').value = points;
            document.getElementById('idlibro13_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit2Act13_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act13_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fourteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MOMMY",  "DADDY", "BROTHERS", "AUNT", "UNCLE", "WATCHING"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act14-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points14').value = valorActividad;
            document.getElementById('idlibro14').value = libro;
            document.getElementById('idcliente14').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalUnit2Act14');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act14').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente14').value = users.value;
            document.getElementById('points14').value = points;
            document.getElementById('idlibro14').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalUnit2Act14');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act14').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fifteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I LIKE TO PLAY SOCCER",  "I LIKE TO PLAY BASKETBALL", "WE PLAY CARDS", "I LISTEN TO MUSIC"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act15_1-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points15_1').value = valorActividad;
            document.getElementById('idlibro15_1').value = libro;
            document.getElementById('idcliente15_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit2Act15_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act15_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente15_1').value = users.value;
            document.getElementById('points15_1').value = points;
            document.getElementById('idlibro15_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit2Act15_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act15_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act15

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act15-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act15

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act15-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src",  draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt",  draggedAlt);
        
    });

    document.getElementById('box-act15-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-fifteen_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["SOCCER", "JACKS", "MUSIC", "BASKETBALL"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act15-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 1;
        document.getElementById('idcliente15_2').value = users.value;
        document.getElementById('points15_2').value = valorActividad;
        document.getElementById('idlibro15_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_2', 'ModalUnit2Act15_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act15_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 1;
        document.getElementById('idcliente15_2').value = users.value;
        document.getElementById('points15_2').value = points;
        document.getElementById('idlibro15_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_2', 'ModalUnit2Act15_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act15_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-sixteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THIS IS A NEW DRESS",  "THIS IS AN OLD CAR", "SHE IS A PRETTY GIRL", "MY UNCLE IS YOUNG", "YOUR DAUGHTER IS TALL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act16_1-' + (i + 1)).value;
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points16_1').value = valorActividad;
            document.getElementById('idlibro16_1').value = libro;
            document.getElementById('idcliente16_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_1', 'ModalUnit2Act16_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act16_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente16_1').value = users.value;
            document.getElementById('points16_1').value = points;
            document.getElementById('idlibro16_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_1', 'ModalUnit2Act16_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act16_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-sixteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["NEW",  "SHE", "YOUNG", "TALL", "OLD"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act16_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points16_2').value = valorActividad;
            document.getElementById('idlibro16_2').value = libro;
            document.getElementById('idcliente16_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_2', 'ModalUnit2Act16_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act16_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente16_2').value = users.value;
            document.getElementById('points16_2').value = points;
            document.getElementById('idlibro16_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen_2', 'ModalUnit2Act16_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act16_2').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act17

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act17-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act17

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act17-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src",  draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt",  draggedAlt);
        
    });

    document.getElementById('box-act17-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-seventeen').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["WINDOW", "SIT", "STAND", "SOCCER"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act17-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 1;
        document.getElementById('idcliente17').value = users.value;
        document.getElementById('points17').value = valorActividad;
        document.getElementById('idlibro17').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit2Act17');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act17').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 1;
        document.getElementById('idcliente17').value = users.value;
        document.getElementById('points17').value = points;
        document.getElementById('idlibro17').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit2Act17');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act17').modal('hide');
        return true;
    }    

});

document.getElementById('game-eighteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SHE IS MY MOMMY",  "HE IS MY DADDY", "HE IS MY UNCLE", "SHE IS MY AUNT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act18-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;
            document.getElementById('idcliente18').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen', 'ModalUnit2Act18');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act18').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen', 'ModalUnit2Act18');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act18').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nineteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["YOUR",  "KATHY", "WHAT", "IS", "PLAY VIDEO GAMES", "WHAT", "LAWYER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act19-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points19').value = valorActividad;
            document.getElementById('idlibro19').value = libro;
            document.getElementById('idcliente19').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen', 'ModalUnit2Act19');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act19').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen', 'ModalUnit2Act19');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act19').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act20

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act20-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act20

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act20-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        let draggedAlt = document.getElementById(id).alt;
        let currentAlt = e.target.alt;
        let draggedImg = document.getElementById(id).src;
        let currentImg = e.target.src;
        $("#" + id).attr("src", currentImg)
        $(e.target).attr("src",  draggedImg);
        $("#" + id).attr("alt", currentAlt)
        $(e.target).attr("alt",  draggedAlt);
        
    });

    document.getElementById('box-act20-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-twenty').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["FAMILY", "BASKETBALL", "NURSE", "VIDEOGAMES"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act20-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 1;
        document.getElementById('idcliente20').value = users.value;
        document.getElementById('points20').value = valorActividad;
        document.getElementById('idlibro20').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit2Act20');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act20').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 1;
        document.getElementById('idcliente20').value = users.value;
        document.getElementById('points20').value = points;
        document.getElementById('idlibro20').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit2Act20');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act20').modal('hide');
        return true;
    }    

});

document.getElementById('game-twentyone').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["YOUR",  "HE", "OCCUPATION", "NURSE", "WHAT", "IS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act21-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;
            document.getElementById('idcliente21').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit2Act21');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act21').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = points;
            document.getElementById('idlibro21').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit2Act21');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act21').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentytwo').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["NAME",  "OSCAR", "HOBBY", "I", "WHAT", "SOCCER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act22-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points22').value = valorActividad;
            document.getElementById('idlibro22').value = libro;
            document.getElementById('idcliente22').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit2Act22');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act22').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente22').value = users.value;
            document.getElementById('points22').value = points;
            document.getElementById('idlibro22').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit2Act22');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act22').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentythree').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HOBBIES",  "VIDEO", "YOU", "SOCCER", "LIKE", "GAMES"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act23-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points23').value = valorActividad;
            document.getElementById('idlibro23').value = libro;
            document.getElementById('idcliente23').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit2Act23');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act23').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = points;
            document.getElementById('idlibro23').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit2Act23');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act23').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfour').addEventListener('submit', function (event){
    
    //Variables para el orden de nombres
    var name1, name2, name3, name4, name5, name6, name7;
    name1 = document.getElementById('input-act24-1n').value;
    name2 = document.getElementById('input-act24-2n').value;
    name3 = document.getElementById('input-act24-3n').value;
    name4 = document.getElementById('input-act24-4n').value;
    name5 = document.getElementById('input-act24-5n').value;
    name6 = document.getElementById('input-act24-6n').value;
    name7 = document.getElementById('input-act24-7n').value;

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["NICE", "HOW", "YOU", "TOO BAD"];
    //Respuestas default de  input-act24-6 input-act24-8, input-act24-9, input-act24-11
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act24-' + (i + 1)).value;        
    }
    
    
    if (inputs.includes("") || (name1 == "" || name2 == "" || name3 == "" || name4 == "" || name5 == "" || name6 == "" || name7 == "")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if ((//name1
            name1 != name3
            || name1 != name6
            || name3 != name6) || 
            (//name2
            name2 != name4
            || name2 != name5
            || name2 != name7
            || name4 != name5
            || name4 != name7
            || name5 != name7)) 
    {
        sweetAlert(2, "Please, be aware with the orden of the names");
    }else{
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points24').value = valorActividad;
            document.getElementById('idlibro24').value = libro;
            document.getElementById('idcliente24').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit2Act24');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act24').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente24').value = users.value;
            document.getElementById('points24').value = points;
            document.getElementById('idlibro24').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit2Act24');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act24').modal('hide');
            return true;
        }
    }
    
});
//FALTA EL 25

document.getElementById('game-twentysix').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["UNCLE",  "WITH", "GOOD MORNING", "HIS", "HE", "HIS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act26-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points26').value = valorActividad;
            document.getElementById('idlibro26').value = libro;
            document.getElementById('idcliente26').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit2Act26');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act26').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente26').value = users.value;
            document.getElementById('points26').value = points;
            document.getElementById('idlibro26').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit2Act26');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act26').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyseven').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THE JICAMA",  "THE COCONUT", "THE BEET", "THE EAR OF CORN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act27-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points27').value = valorActividad;
            document.getElementById('idlibro27').value = libro;
            document.getElementById('idcliente27').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven', 'ModalUnit2Act27');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act27').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente27').value = users.value;
            document.getElementById('points27').value = points;
            document.getElementById('idlibro27').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven', 'ModalUnit2Act27');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act27').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyeight').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IN THE GARDEN",  "IN THE YARD OF MY HOUSE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act28-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points28').value = valorActividad;
            document.getElementById('idlibro28').value = libro;
            document.getElementById('idcliente28').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight', 'ModalUnit2Act28');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act28').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente28').value = users.value;
            document.getElementById('points28').value = points;
            document.getElementById('idlibro28').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight', 'ModalUnit2Act28');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act28').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentynine').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    promedio = 1;
    var libro = 1;
    document.getElementById('idcliente29').value = users.value;
    document.getElementById('points29').value = promedio;
    document.getElementById('idlibro29').value = libro;

    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine', 'ModalUnit2Act29');
    sweetAlert(1, 'Good job', null);
    $('#ModalUnit2Act29').modal('hide');
    return true;

});

document.getElementById('game-thirty').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["CORPORAL SOUNDS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act30-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 1;
            document.getElementById('points30').value = valorActividad;
            document.getElementById('idlibro30').value = libro;
            document.getElementById('idcliente30').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirty', 'ModalUnit2Act30');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act30').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 1;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente30').value = users.value;
            document.getElementById('points30').value = points;
            document.getElementById('idlibro30').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirty', 'ModalUnit2Act30');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act30').modal('hide');
            return true;
        }
    }
    
});