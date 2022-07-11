const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

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

$('#ModalUnit2Act3').on('shown.bs.modal', function (e){
// Set it up
    paper.setup('canvas1');

    var canvas1 = document.getElementById("canvas1");

    const context = canvas1.getContext('2d');

    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    // Get elements from DOM and define properties
    var colorPicker = document.getElementById("colorPicker");
    var colorStroke;
    var widthStrokePicker = document.getElementById("strokeWidthPicker");
    var widthStroke;
    var clearButton = document.getElementById("clearBtn");

    // Clear event listener
    clearBtn.addEventListener("click", function() {
        // Clear canvas1
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
    setInterval(update, 1000);

    // Define a mousedown and mousedrag handler
    tool.onMouseDown = function(event) {
        path = new Path();
        path.strokeWidth = widthStroke;
        path.strokeColor = colorStroke;
    // Draw
        path.add(event.point);
    }

    tool.onMouseDrag = function(event) {
    // Draw
        path.add(event.point);
        document.getElementById("verify-canvas").value = 1;
    }
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