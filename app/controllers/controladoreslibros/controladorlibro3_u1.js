const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

document.getElementById('game-one_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["STAND UP",  "TOUCH YOUR FACE", "TOUCH YOUR NOSE", "TOUCH YOUR EARS", "TOUCH YOUR EYEBROW", "TOUCH YOUR EYELASHES", "SIT DOWN", "TOUCH YOUR FEET"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act1_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points1_1').value = valorActividad;
            document.getElementById('idlibro1_1').value = libro;
            document.getElementById('idcliente1_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_1', 'ModalUnit1Act1_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act1_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente1_1').value = users.value;
            document.getElementById('points1_1').value = points;
            document.getElementById('idlibro1_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_1', 'ModalUnit1Act1_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act1_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-one_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SIT DOWN",  "TOUCH YOUR EYEBROW", "TOUCH YOUR FEET"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act1_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points1_2').value = valorActividad;
            document.getElementById('idlibro1_2').value = libro;
            document.getElementById('idcliente1_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_2', 'ModalUnit1Act1_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act1_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente1_2').value = users.value;
            document.getElementById('points1_2').value = points;
            document.getElementById('idlibro1_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_2', 'ModalUnit1Act1_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act1_2').modal('hide');
            return true;
        }
    }
    
});

$('#ModalUnit1Act2').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas2');
    if (intervalo) {
        clearInterval(intervalo);
    }
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

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-two').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HEAD", "HAIR", "FACE", "EAR", "NOSE", "EYE", "EYEBROW", "EYELASHES", "MOUTH", "SHOULDER", "ARM", "HAND", "KNEE", "LEG", "FOOT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } 
    else if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else {
        //Variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 3;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;
            document.getElementById('idcliente2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit1Act2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit1Act2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-three_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MEAT",  "BEEFSTEAK", "MACARONI", "SOUP", "ROAST BEEF", "SALAD", "EGGS", "BEANS", "POTATO", "TOMATO", "ONIONS", "RADISHES", "CUCUMBERS", "TOMATOES", "POTATOES"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act3_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points3_1').value = valorActividad;
            document.getElementById('idlibro3_1').value = libro;
            document.getElementById('idcliente3_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_1', 'ModalUnit1Act3_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act3_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente3_1').value = users.value;
            document.getElementById('points3_1').value = points;
            document.getElementById('idlibro3_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_1', 'ModalUnit1Act3_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act3_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-three_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["TOMATOES",  "RADISHES", "CUCUMBERS", "SOUP", "BEANS", "EGGS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act3_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points3_2').value = valorActividad;
            document.getElementById('idlibro3_2').value = libro;
            document.getElementById('idcliente3_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_2', 'ModalUnit1Act3_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act3_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente3_2').value = users.value;
            document.getElementById('points3_2').value = points;
            document.getElementById('idlibro3_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_2', 'ModalUnit1Act3_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act3_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-four_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I WANT A CUP OF COFFEE",  "SHE LIKES A GLASS OF MILK", "HE DRINKS A GLASS OF WATER", "HE PREFERS A ORANGE JUICE", "MY MOTHER DRINKS A TEA", "I DON'T LIKE HOT CHOCOLATE", "MY SISTER DRINKS A LEMONADE", "MY BROTHER DRINKS A COKE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act4_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points4_1').value = valorActividad;
            document.getElementById('idlibro4_1').value = libro;
            document.getElementById('idcliente4_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_1', 'ModalUnit1Act4_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act4_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente4_1').value = users.value;
            document.getElementById('points4_1').value = points;
            document.getElementById('idlibro4_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_1', 'ModalUnit1Act4_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act4_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act4

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act4-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act4

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act4-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act4-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-four_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["ORANGE", "MILK", "GWATER", "COFFEE"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act4-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 3;
        document.getElementById('idcliente4_2').value = users.value;
        document.getElementById('points4_2').value = valorActividad;
        document.getElementById('idlibro4_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-four_2', 'ModalUnit1Act4_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act4_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente4_2').value = users.value;
        document.getElementById('points4_2').value = points;
        document.getElementById('idlibro4_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-four_2', 'ModalUnit1Act4_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit1Act4_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-five').addEventListener('submit', function (event){
    
    //Variables para el orden de nombres
    var name1, name2, name3, name4;
    name1 = document.getElementById('input-act5-1n').value;
    name2 = document.getElementById('input-act5-2n').value;
    name3 = document.getElementById('input-act5-3n').value;
    name4 = document.getElementById('input-act5-4n').value;


    var food1, food2;
    food1 = document.getElementById('input-act5-1f').value;
    food2 = document.getElementById('input-act5-2f').value;

    var free1, free2;
    free1 = document.getElementById('input-act5-1ff').value;
    free1 = document.getElementById('input-act5-2ff').value;

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();
    
    
    if ((name1 == "" || name2 == "" || name3 == "" || name4 == "") || (food1 == "" || food2 == "") || (free1 == "" || free2 == "")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if (
            (name1 != name3)
            || 
            (name2 != name4)) 
    {
        sweetAlert(2, "Please, be aware with the orden of the names");
    } else if (
            (food1 != "Breakfast" && food1 != "Lunch" && food1 != "Dinner") 
            || (food2 != "Breakfast" && food2 != "Lunch" && food2 != "Dinner"))
    {
        sweetAlert(2, "Is it breakfast, lunch or dinner?");
    } else {
        var libro = 3;
        document.getElementById('points5').value = valorActividad;
        document.getElementById('idlibro5').value = libro;
        document.getElementById('idcliente5').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit1Act5');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act5').modal('hide');
        return true;
    }
    
});

document.getElementById('game-six_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I EAT BREAKFAST IN THE MORNING",  "I WASH MY HANDS BEFORE EATING", "AT NOON IS MY LUNCH TIME", "I AM GLAD TO SEE YOU", "DO YOU EAT DINNER?", "YES, I EAT DINNER", "DO YOU EAT MACARONI?", "NO, I DON'T. I EAT EGGS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act6_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points6_1').value = valorActividad;
            document.getElementById('idlibro6_1').value = libro;
            document.getElementById('idcliente6_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six_1', 'ModalUnit1Act6_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act6_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente6_1').value = users.value;
            document.getElementById('points6_1').value = points;
            document.getElementById('idlibro6_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six_1', 'ModalUnit1Act6_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act6_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-six_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BREAKFAST", "MORNING", "HANDS", "EATING", "EAT", "DINNER", "NOON", "LUNCH"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act6_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points6_2').value = valorActividad;
            document.getElementById('idlibro6_2').value = libro;
            document.getElementById('idcliente6_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six_2', 'ModalUnit1Act6_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act6_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente6_2').value = users.value;
            document.getElementById('points6_2').value = points;
            document.getElementById('idlibro6_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six_2', 'ModalUnit1Act6_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act6_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-seven_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["RELAXING",  "INTERESTING", "GREAT FUN", "BORING", "EXCITING", "FRIGHTENING", "IRRITATING", "OK"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act7_1-' + (i + 1)).value.toUpperCase();        
    }
    
    if (inputs.includes("")) {

        sweetAlert(2, "Complete the missing fields", null);
        return false;

    } else if(inputs.includes("RELAXING") || inputs.includes("INTERESTING") || inputs.includes("GREAT FUN") || inputs.includes("BORING") || inputs.includes("EXCITING") || inputs.includes("FRIGHTENING") || inputs.includes("IRRITATING") || inputs.includes("OK"))
    {

        var libro = 3;
        document.getElementById('points7_1').value = valorActividad;
        document.getElementById('idlibro7_1').value = libro;
        document.getElementById('idcliente7_1').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven_1', 'ModalUnit1Act7_1');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act7_1').modal('hide');
        return true;     

    } else {

        sweetAlert(2, "Write the correct adjectives", null);
        return false;

    }
    
});

document.getElementById('game-seven_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SWIMMING", "FISHING", "READING", "SHOPPING", "PLAYING TENNIS", "PLAYING FOOTBALL", "WATCHING TV", "COLLECTING STAMPS", "LISTENING TO MUSIC", "PLAYING THE GUITAR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act7_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points7_2').value = valorActividad;
            document.getElementById('idlibro7_2').value = libro;
            document.getElementById('idcliente7_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_2', 'ModalUnit1Act7_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act7_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente7_2').value = users.value;
            document.getElementById('points7_2').value = points;
            document.getElementById('idlibro7_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_2', 'ModalUnit1Act7_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act7_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eight_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I WEAR EITHER A HAT OR A CAP", "NEITHER SHE NOR HE PLAYS SOCCER", "EITHER MY SON OR YOUR SON WILL GO", "I WILL EAT EITHER CHICKEN OR FISH", "NEITHER SHE NOR HE WILL DANCE", "I EITHER WRITE OR READ", "NEITHER TOM NOR DAVID CAN SING"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act8_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points8_1').value = valorActividad;
            document.getElementById('idlibro8_1').value = libro;
            document.getElementById('idcliente8_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit1Act8_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act8_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente8_1').value = users.value;
            document.getElementById('points8_1').value = points;
            document.getElementById('idlibro8_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit1Act8_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act8_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eight_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["A", "OR", "NOR", "CAN SING", "EITHER", "OR", "NOR", "DANCE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act8_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points8_2').value = valorActividad;
            document.getElementById('idlibro8_2').value = libro;
            document.getElementById('idcliente8_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit1Act8_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act8_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente8_2').value = users.value;
            document.getElementById('points8_2').value = points;
            document.getElementById('idlibro8_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit1Act8_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act8_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nine').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "EAT", "YOU", "EAT", "HE, SHE, IT", "EATS", "WE", "EAT", "YOU", "EAT", "THEY", "EAT",
                    "I", "ATE", "YOU", "ATE", "HE, SHE, IT", "ATE", "WE", "ATE", "YOU", "ATE", "THEY", "ATE",
                    "I", "KEEP", "YOU", "KEEP", "HE, SHE, IT", "KEEPS", "WE", "KEEP", "YOU", "KEEP", "THEY", "KEEP",
                    "I", "KEPT", "YOU", "KEPT", "HE, SHE, IT", "KEPT", "WE", "KEPT", "YOU", "KEPT", "THEY", "KEPT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act9-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points9').value = valorActividad;
            document.getElementById('idlibro9').value = libro;
            document.getElementById('idcliente9').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit1Act9');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act9').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = points;
            document.getElementById('idlibro9').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit1Act9');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act9').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-ten').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "WASH", "YOU", "WASH", "HE, SHE, IT", "WASHES", "WE", "WASH", "YOU", "WASH", "THEY", "WASH",
                    "I", "WASHED", "YOU", "WASHED", "HE, SHE, IT", "WASHED", "WE", "WASHED", "YOU", "WASHED", "THEY", "WASHED",
                    "I", "BUY", "YOU", "BUY", "HE, SHE, IT", "BUYS", "WE", "BUY", "YOU", "BUY", "THEY", "BUY",
                    "I", "BOUGHT", "YOU", "BOUGHT", "HE, SHE, IT", "BOUGHT", "WE", "BOUGHT", "YOU", "BOUGHT", "THEY", "BOUGHT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act10-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;
            document.getElementById('idcliente10').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit1Act10');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act10').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit1Act10');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act10').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eleven_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MY MOTHER EATS BREAKFAST", "MY FATHER DOES EXERCISE AT NOON", "I WASH MY HANDS BEFORE LUNCH", "MY SISTER BUYS TOMATOES", "MY UNCLE KEEPS IN GOOD SHAPE", "YOU TAKE A SHOWER EARLY", "I DRINK A GLASS OF MILK", "SHE LIKES CHICKEN SOUP"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act11_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points11_1').value = valorActividad;
            document.getElementById('idlibro11_1').value = libro;
            document.getElementById('idcliente11_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit1Act11_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act11_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente11_1').value = users.value;
            document.getElementById('points11_1').value = points;
            document.getElementById('idlibro11_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit1Act11_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act11_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eleven_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BUYS", "KEEPS", "DRINK", "CHICKEN SOUP", "MY HANDS", "BREAKFAST"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act11_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points11_2').value = valorActividad;
            document.getElementById('idlibro11_2').value = libro;
            document.getElementById('idcliente11_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_2', 'ModalUnit1Act11_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act11_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente11_2').value = users.value;
            document.getElementById('points11_2').value = points;
            document.getElementById('idlibro11_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_2', 'ModalUnit1Act11_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act11_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twelve_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["GIVE ME A SLICE OF BREAD", "I AM AT HOME NOW", "MY HAT HAS A PRETTY SHAPE", "THIS BOOK IS IMPORTANT", "HER DRESS IS BEAUTIFUL", "THE TABLE IS ROUND", "HIS SHIRT IS YELLOW", "SHE HAS A LONG HAIR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act12_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points12_1').value = valorActividad;
            document.getElementById('idlibro12_1').value = libro;
            document.getElementById('idcliente12_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve_1', 'ModalUnit1Act12_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act12_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points12_1').value = points;
            document.getElementById('idlibro12_1').value = libro;
            document.getElementById('idcliente12_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve_1', 'ModalUnit1Act12_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act12_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act4

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act12-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act4

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act12-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act12-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-twelve_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["DRESS", "TABLE", "BREAD", "BOOK"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act12-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 3;
        document.getElementById('idcliente12_2').value = users.value;
        document.getElementById('points12_2').value = valorActividad;
        document.getElementById('idlibro12_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twelve_2', 'ModalUnit1Act12_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act12_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente12_2').value = users.value;
        document.getElementById('points12_2').value = points;
        document.getElementById('idlibro12_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twelve_2', 'ModalUnit1Act12_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit1Act12_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-thirteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I AM HEALTHY STUDENT", "MY BREAKFAST IS DELICIOUS", "SHE IS A PRETTY WOMAN", "IT IS AN UGLY HOUSE", "YOUR CAT IS THIN", "HIS DOG IS FAT", "THIS SHIRT IS DIRTY", "HER DRESS IS CLEAN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act13_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points13_1').value = valorActividad;
            document.getElementById('idlibro13_1').value = libro;
            document.getElementById('idcliente13_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit1Act13_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act13_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points13_1').value = points;
            document.getElementById('idlibro13_1').value = libro;
            document.getElementById('idcliente13_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit1Act13_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act13_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-thirteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HEALTHY", "DELICIOUS", "IS DIRTY", "SHE IS", "DRESS", "CLEAN", "FAT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act13_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points13_2').value = valorActividad;
            document.getElementById('idlibro13_2').value = libro;
            document.getElementById('idcliente13_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit1Act13_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act13_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points13_2').value = points;
            document.getElementById('idlibro13_2').value = libro;
            document.getElementById('idcliente13_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit1Act13_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act13_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fourteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    var answer1, answer2, answer3, answer4, answer5, answer6;
    answer1 = document.getElementById('input-act14-1').value;
    answer2 = document.getElementById('input-act14-2').value;
    answer3 = document.getElementById('input-act14-3').value;
    answer4 = document.getElementById('input-act14-4').value;
    answer5 = document.getElementById('input-act14-5').value;
    answer6 = document.getElementById('input-act14-6').value;

    if (answer1 == "" || answer2 == "" || answer3 == "" || answer4 == "" || answer5 == "" || answer6 == "") {

        sweetAlert(2, "Complete the missing fields", null);
        return false;

    } else if((answer1.toUpperCase() != "MACARONI" && answer1.toUpperCase() != "EGGS" && answer1.toUpperCase() != "BEANS" && answer1.toUpperCase() != "SALAD" && answer1.toUpperCase() != "BEEFSTEAK" && answer1.toUpperCase() != "ONIONS"
            || answer4.toUpperCase() != "MACARONI" && answer4.toUpperCase() != "EGGS" && answer4.toUpperCase() != "BEANS" && answer4.toUpperCase() != "SALAD" && answer4.toUpperCase() != "BEEFSTEAK" && answer4.toUpperCase() != "ONIONS") 
            || (answer2.toUpperCase() != "HEAD" && answer2.toUpperCase() != "FACE" && answer2.toUpperCase() != "EAR" && answer2.toUpperCase() != "MOUTH" && answer2.toUpperCase() != "HANDS" && answer2.toUpperCase() != "EYE"
            || answer5.toUpperCase() != "HEAD" && answer5.toUpperCase() != "FACE" && answer5.toUpperCase() != "EAR" && answer5.toUpperCase() != "MOUTH" && answer5.toUpperCase() != "HANDS" && answer5.toUpperCase() != "EYE") 
            || (answer3.toUpperCase() != "COFFEE" && answer3.toUpperCase() != "MILK" && answer3.toUpperCase() != "WATER" && answer3.toUpperCase() != "ORANGE JUICE" && answer3.toUpperCase() != "CHOCOLATE" && answer3.toUpperCase() != "LEMONADE"
            || answer6.toUpperCase() != "COFFEE" && answer6.toUpperCase() != "MILK" && answer6.toUpperCase() != "WATER" && answer6.toUpperCase() != "ORANGE JUICE" && answer6.toUpperCase() != "CHOCOLATE" && answer6.toUpperCase() != "LEMONADE"))
    {

        sweetAlert(2, "Write the correct names", null);
        return false;

    } else {        
        
        var libro = 3;
        document.getElementById('points14').value = valorActividad;
        document.getElementById('idlibro14').value = libro;
        document.getElementById('idcliente14').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen', 'ModalUnit1Act14');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act14').modal('hide');
        return true;  

    }
    
});

document.getElementById('game-fifteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SHE LIKES TO DO EXCERCISE IN THE MORNING", "AT HOME WE LIKE TO EAT TOGETHER", "MY CHILDREN DON'T LIKE SALADS", "MY SON, OSCAR, LIKES ICE CREAM AND APPLE PIE", "I EAT SALAD AND FRUIT TO BE HEALTHY. I LIKE IT",
                    "MY MOTHER BUYS TOMATOES, CUCUMBERS, RADISHES AND ONIONS AT A SUPERMARKET TO MAKE DELICIOUS SALADS. I LIKE VEGETABLES"];
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
            var libro = 3;
            document.getElementById('points15_1').value = valorActividad;
            document.getElementById('idlibro15_1').value = libro;
            document.getElementById('idcliente15_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit1Act15_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act15_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points15_1').value = points;
            document.getElementById('idlibro15_1').value = libro;
            document.getElementById('idcliente15_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit1Act15_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act15_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fifteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["SALAD", "FRUIT", "BUYS", "RADISHES", "SUPERMARKET"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act15_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points15_2').value = valorActividad;
            document.getElementById('idlibro15_2').value = libro;
            document.getElementById('idcliente15_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit1Act15_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act15_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points15_2').value = points;
            document.getElementById('idlibro15_2').value = libro;
            document.getElementById('idcliente15_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_2', 'ModalUnit1Act15_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act15_2').modal('hide');
            return true;
        }
    }
    
});

function checkCells(id) {
    document.getElementById(id).style.backgroundColor = "#c293c7";
}

document.getElementById('game-sixteen').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["COFFEE", "BEEFSTEAK", "HANDS", "MACARONI", "EGG", "FEET", "CUCUMBER", "ORANGE", "FOOD", "EARS", "EAT", "CHICKEN", "TEETH", "ARMS", "POTATO", "FACE", "WATER", "FORK", "LEG", "SALAD"];
    //Se verifica que las celdas necesarias se hayan seleccionado
    for (let i = 0; i < 84; i++) {
        if (document.getElementById('act16-' + (i + 1)).style.backgroundColor == 'rgb(194, 147, 199)') {
            conteo++;
        }

    }
    //Llenar arreglo de inputs
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('input-act16-' + (i + 1)).value
    }

    if (conteo < 84) {
        sweetAlert(2, 'Find the missing words', null);
        return false;
    } else {
        conteo = 0;
        
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }            
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        } else {
            //Se revisa si todas las respuestas son correctas
            if (conteo == respuestas.length) {
                var libro = 3;
                document.getElementById('idcliente16').value = users.value;
                document.getElementById('points16').value = valorActividad;
                document.getElementById('idlibro16').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen', 'ModalUnit1Act16');
                sweetAlert(1, 'Good job!', null);
                $('#ModalUnit1Act16').modal('hide');
                return true;
            } else {
                //Se asigna el puntaje basado en las respuestas correctas
                let puntaje = valorActividad / 12;
                let points = (puntaje * conteo).toFixed(2);
                var libro = 3;
                document.getElementById('idcliente16').value = users.value;
                document.getElementById('points16').value = points;
                document.getElementById('idlibro16').value = libro;
                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen', 'ModalUnit1Act16');
                sweetAlert(4, conteo + '/' + respuestas.length, null);
                $('#ModalUnit1Act16').modal('hide');
                return true;
            }
        }
    }

});

document.getElementById('game-seventeen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    promedio = 1;
    var libro = 3;
    document.getElementById('idcliente17').value = users.value;
    document.getElementById('points17').value = promedio;
    document.getElementById('idlibro17').value = libro;

    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit1Act17');
    sweetAlert(1, 'Good job', null);
    $('#ModalUnit1Act17').modal('hide');
    return true;

});

document.getElementById('game-eighteen').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    promedio = 1;
    var libro = 3;
    document.getElementById('idcliente18').value = users.value;
    document.getElementById('points18').value = promedio;
    document.getElementById('idlibro18').value = libro;

    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen', 'ModalUnit1Act18');
    sweetAlert(1, 'Good job', null);
    $('#ModalUnit1Act18').modal('hide');
    return true;

});

document.getElementById('game-nineteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["GOOD MORNING, FRANCISCO.", "GOOD MORNING, TEACHER!", "GOOD EVENING, DEAR SON!", "GOOD EVENING, FATHER!", "HOW ARE YOU, MANUEL?", "FINE, THANK YOU AND, YOU?", "HELLO! I'M GLAD TO SEE YOU.", "HI! I'M GLAD TO SEE YOU TOO."];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act19_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points19_1').value = valorActividad;
            document.getElementById('idlibro19_1').value = libro;
            document.getElementById('idcliente19_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_1', 'ModalUnit1Act19_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act19_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points19_1').value = points;
            document.getElementById('idlibro19_1').value = libro;
            document.getElementById('idcliente19_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_1', 'ModalUnit1Act19_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act19_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nineteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["EVENING", "MORNING", "GOOD MORNING", "GOOD MORNING", "ARE YOU", "FINE, THANK"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act19_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points19_2').value = valorActividad;
            document.getElementById('idlibro19_2').value = libro;
            document.getElementById('idcliente19_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_2', 'ModalUnit1Act19_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act19_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points19_2').value = points;
            document.getElementById('idlibro19_2').value = libro;
            document.getElementById('idcliente19_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_2', 'ModalUnit1Act19_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act19_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twenty_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HOW ARE YOU, CLAUDIA?",
                    "NOT TO BAD, THANKS.",
                    "HOW DO YOU DO MRS. CHACÓN?",
                    "I’M FINE, THANK YOU.",
                    "WHAT’S NEW, DAVID?",
                    "NOT MUCH, JAMES.",
                    "SEE YOU LATER, HÉCTOR.",
                    "SEE YOU, MY FRIEND."
                    ];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act20_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points20_1').value = valorActividad;
            document.getElementById('idlibro20_1').value = libro;
            document.getElementById('idcliente20_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_1', 'ModalUnit1Act20_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act20_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points20_1').value = points;
            document.getElementById('idlibro20_1').value = libro;
            document.getElementById('idcliente20_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_1', 'ModalUnit1Act20_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act20_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twenty_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["YOU, CLAUDIA", "THANKS", "YOU", "MRS. CHACÓN", "THANK YOU", "DAVID", "JAMES"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act20_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points20_2').value = valorActividad;
            document.getElementById('idlibro20_2').value = libro;
            document.getElementById('idcliente20_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_2', 'ModalUnit1Act20_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act20_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points20_2').value = points;
            document.getElementById('idlibro20_2').value = libro;
            document.getElementById('idcliente20_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_2', 'ModalUnit1Act20_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act20_2').modal('hide');
            return true;
        }
    }
    
});

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas21');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker21 = document.getElementById("colorPicker21");
    var widthStrokePicker21 = document.getElementById("strokeWidthPicker21");
    var clearButton21 = document.getElementById("clearBtn21");

    // Clear event listener
    clearButton21.addEventListener("click", function () {
        // Clear canvas
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker21.value;
        widthStroke = widthStrokePicker21.value;
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

$('#ModalUnit1Act21_1').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas21');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker21 = document.getElementById("colorPicker21");
    var widthStrokePicker21 = document.getElementById("strokeWidthPicker21");
    var clearButton21 = document.getElementById("clearBtn21");

    // Clear event listener
    clearButton21.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker21.value;
        widthStroke = widthStrokePicker21.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-twentyone_1').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
       //Puntos equivalentes de la actividad
        let valorActividad = 1;

        //Se evita recargar la página al enviar el formulario
        event.preventDefault();

        //Arreglos para guardar respuestas y datos ingresados        
        let inputs = [];

        //Se obtienen los datos ingresados y se colocan en inputs[]
        for (let i = 0; i < 6;  i++) {
        inputs[i] = document.getElementById('input-act21_1-' + (i + 1)).value;        
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, "Complete the missing fields", null);
            return false;
        } else {
            
            var libro = 3;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;
            document.getElementById('idcliente21').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone_1', 'ModalUnit1Act21_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act21_1').modal('hide');
            return true;

        }
    }

});

$('#ModalUnit1Act21_2').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas21_2');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker21_2 = document.getElementById("colorPicker21_2");
    var widthStrokePicker21_2 = document.getElementById("strokeWidthPicker21_2");
    var clearButton21_2 = document.getElementById("clearBtn21_2");

    // Clear event listener
    clearButton21_2.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker21_2.value;
        widthStroke = widthStrokePicker21_2.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-twentyone_2').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();


    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'The canvas is empty', null);
        return false;
    }
    else
    {
       //Puntos equivalentes de la actividad
        let valorActividad = 1;

        //Se evita recargar la página al enviar el formulario
        event.preventDefault();

        var libro = 3;
        document.getElementById('points21_2').value = valorActividad;
        document.getElementById('idlibro21_2').value = libro;
        document.getElementById('idcliente21_2').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone_2', 'ModalUnit1Act21_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act21_2').modal('hide');
        return true;
    }

});

document.getElementById('game-twentytwo_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["GLORIA IS MY SISTER-IN-LAW", "LUIS IS MY NEPHEW", "BENJAMIN IS MY BROTHER-IN-LAW", "PACITA IS MY GRANDMA", "MY NIECE IS MARITZA", "MY GRANDPA IS FRANSCICO", "WE ARE HIS GRANDCHILDREN", "MY DAD IS ALWAYS BUSY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act22_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points22_1').value = valorActividad;
            document.getElementById('idlibro22_1').value = libro;
            document.getElementById('idcliente22_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_1', 'ModalUnit1Act22_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act22_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points22_1').value = points;
            document.getElementById('idlibro22_1').value = libro;
            document.getElementById('idcliente22_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_1', 'ModalUnit1Act22_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act22_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentytwo_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["DAD", "BUSY", "SISTER-IN-LAW", "IS", "GRANDMA", "BROTHER-IN-LAW", "GRANDCHILDREN", "GRANDPA"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act22_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points22_2').value = valorActividad;
            document.getElementById('idlibro22_2').value = libro;
            document.getElementById('idcliente22_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_2', 'ModalUnit1Act22_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act22_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points22_2').value = points;
            document.getElementById('idlibro22_2').value = libro;
            document.getElementById('idcliente22_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_2', 'ModalUnit1Act22_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act22_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentythree_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HE IS A GOOD POLICE OFFICER", "MY FATHER IS A FIRE FIGHTER", "MANUEL IS THE NEW TAILOR", "MY SISTER-IN-LAW IS A LAWYER", "MY GRANDMA IS A SALESPERSON", "HIS NIECE IS A GOOD MODEL", "YOUR BROTHER-IN-LAW IS A MECHANIC", "I AM A COMPUTER OPERATOR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act23_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points23_1').value = valorActividad;
            document.getElementById('idlibro23_1').value = libro;
            document.getElementById('idcliente23_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree_1', 'ModalUnit1Act23_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act23_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points23_1').value = points;
            document.getElementById('idlibro23_1').value = libro;
            document.getElementById('idcliente23_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree_1', 'ModalUnit1Act23_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act23_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentythree_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IS", "LAWYER", "MODEL", "MY", "SALESPERSON", "COMPUTER OPERATOR", "MY", "MECHANIC", "TAILOR"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act23_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points23_2').value = valorActividad;
            document.getElementById('idlibro23_2').value = libro;
            document.getElementById('idcliente23_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree_2', 'ModalUnit1Act23_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act23_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points23_2').value = points;
            document.getElementById('idlibro23_2').value = libro;
            document.getElementById('idcliente23_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree_2', 'ModalUnit1Act23_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act23_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfour').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "WANT", "YOU", "WANT", "HE, SHE, IT", "WANTS", "WE", "WANT", "YOU", "WANT", "THEY", "WANT",
                    "I", "WANTED", "YOU", "WANTED", "HE, SHE, IT", "WANTED", "WE", "WANTED", "YOU", "WANTED", "THEY", "WANTED",
                    "I", "TYPE", "YOU", "TYPE", "HE, SHE, IT", "TYPES", "WE", "TYPE", "YOU", "TYPE", "THEY", "TYPE",
                    "I", "TYPED", "YOU", "TYPED", "HE, SHE, IT", "TYPED", "WE", "TYPED", "YOU", "TYPED", "THEY", "TYPED"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act24-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points24').value = valorActividad;
            document.getElementById('idlibro24').value = libro;
            document.getElementById('idcliente24').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit1Act24');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act24').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente24').value = users.value;
            document.getElementById('points24').value = points;
            document.getElementById('idlibro24').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit1Act24');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act24').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfive').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "DRIVE", "YOU", "DRIVE", "HE, SHE, IT", "DRIVES", "WE", "DRIVE", "YOU", "DRIVE", "THEY", "DRIVE",
                    "I", "DRAVE", "YOU", "DRAVE", "HE, SHE, IT", "DRAVE", "WE", "DRAVE", "YOU", "DRAVE", "THEY", "DRAVE",
                    "I", "FIX", "YOU", "FIX", "HE, SHE, IT", "FIXES", "WE", "FIX", "YOU", "FIX", "THEY", "FIX",
                    "I", "FIXED", "YOU", "FIXED", "HE, SHE, IT", "FIXED", "WE", "FIXED", "YOU", "FIXED", "THEY", "FIXED"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act25-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points25').value = valorActividad;
            document.getElementById('idlibro25').value = libro;
            document.getElementById('idcliente25').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit1Act25');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act25').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente25').value = users.value;
            document.getElementById('points25').value = points;
            document.getElementById('idlibro25').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit1Act25');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act25').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentysix').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "AM", "YOU", "ARE", "HE, SHE, IT", "IS", "WE", "ARE", "YOU", "ARE", "THEY", "ARE",
                    "I", "WAS", "YOU", "WERE", "HE, SHE, IT", "WAS", "WE", "WERE", "YOU", "WERE", "THEY", "WERE",
                    "I", "STUDY", "YOU", "STUDY", "HE, SHE, IT", "STUDIES", "WE", "STUDY", "YOU", "STUDY", "THEY", "STUDY",
                    "I", "STUDIED", "YOU", "STUDIED", "HE, SHE, IT", "STUDIED", "WE", "STUDIED", "YOU", "STUDIED", "THEY", "STUDIED"];
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
            var libro = 3;
            document.getElementById('points26').value = valorActividad;
            document.getElementById('idlibro26').value = libro;
            document.getElementById('idcliente26').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit1Act26');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act26').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente26').value = users.value;
            document.getElementById('points26').value = points;
            document.getElementById('idlibro26').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit1Act26');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act26').modal('hide');
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
    let respuestas = ["I", "PROTECT", "YOU", "PROTECT", "HE, SHE, IT", "PROTECTS", "WE", "PROTECT", "YOU", "PROTECT", "THEY", "PROTECT",
                    "I", "PROTECTED", "YOU", "PROTECTED", "HE, SHE, IT", "PROTECTED", "WE", "PROTECTED", "YOU", "PROTECTED", "THEY", "PROTECTED",
                    "I", "LOVE", "YOU", "LOVE", "HE, SHE, IT", "LOVES", "WE", "LOVE", "YOU", "LOVE", "THEY", "LOVE",
                    "I", "LOVED", "YOU", "LOVED", "HE, SHE, IT", "LOVED", "WE", "LOVED", "YOU", "LOVED", "THEY", "LOVED"];
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
            var libro = 3;
            document.getElementById('points27').value = valorActividad;
            document.getElementById('idlibro27').value = libro;
            document.getElementById('idcliente27').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven', 'ModalUnit1Act27');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act27').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente27').value = users.value;
            document.getElementById('points27').value = points;
            document.getElementById('idlibro27').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven', 'ModalUnit1Act27');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act27').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyeight_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IT'S A SMALL TAILOR SHOP", "I LIKE THIS BARBER SHOP", "MY SISTER IS AT THE SHOPPING CENTER", "MY MOTHER IS AT THE MARKET", "MY SISTER-IN-LAW IS IN A RESTAURANT", "MY SON IS IN THE CITY HALL", "MY BROTHER-IN-LAW IS IN A CLINIC", "I WORK AT A FACTORY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act28_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points28_1').value = valorActividad;
            document.getElementById('idlibro28_1').value = libro;
            document.getElementById('idcliente28_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight_1', 'ModalUnit1Act28_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act28_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points28_1').value = points;
            document.getElementById('idlibro28_1').value = libro;
            document.getElementById('idcliente28_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight_1', 'ModalUnit1Act28_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act28_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act28

for (let i = 0; i < 3; i++) {
    document.getElementById('img-act28-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act28

for (let i = 0; i < 3; i++) {
    document.getElementById('box-act28-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act28-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-twentyeight_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["CITYHALL", "BARBERSHOP", "SHOPPINGCENTER"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 3; i++) {
        imgs[i] = $("#img-act28-" + (i + 1)).attr("alt").toUpperCase();
    }

    
    //Se comparan las respuestas con los datos ingresados        
    for (let i = 0; i < imgs.length; i++) {
        if(imgs[i].trim().includes(respuestasImg[i])){
            conteo++;
        }
        
    }

    //Se revisa si todas las respuestas son correctas
    if (conteo == respuestasImg.length) {
        var libro = 3;
        document.getElementById('idcliente28_2').value = users.value;
        document.getElementById('points28_2').value = valorActividad;
        document.getElementById('idlibro28_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight_2', 'ModalUnit1Act28_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit1Act28_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente28_2').value = users.value;
        document.getElementById('points28_2').value = points;
        document.getElementById('idlibro28_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight_2', 'ModalUnit1Act28_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit1Act28_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-twentynine_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MY NEPHEW WANTS TO BE A LAWYER", "THIS POLICE OFFICER PROTECTS PEOPLE", "THE SECRETARY TYPES LETTERS", "MY GRANDPA DRIVES A BUS", "I LOVE MY GRANDCHILDREN", "ARMANDO FIXES AN OLD CAR", "I AM THE NEW TEACHER", "YOU ARE BERY INTELLIGENT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act29_1-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points29_1').value = valorActividad;
            document.getElementById('idlibro29_1').value = libro;
            document.getElementById('idcliente29_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine_1', 'ModalUnit1Act29_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act29_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points29_1').value = points;
            document.getElementById('idlibro29_1').value = libro;
            document.getElementById('idcliente29_1').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine_1', 'ModalUnit1Act29_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act29_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentynine_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["DRIVES", "LOVE", "AM", "TEACHER", "FIXES", "CAR", "ARE", "WANTS", "LAWYER"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act29_2-' + (i + 1)).value;        
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
            var libro = 3;
            document.getElementById('points29_2').value = valorActividad;
            document.getElementById('idlibro29_2').value = libro;
            document.getElementById('idcliente29_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine_2', 'ModalUnit1Act29_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit1Act29_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;                      
            document.getElementById('points29_2').value = points;
            document.getElementById('idlibro29_2').value = libro;
            document.getElementById('idcliente29_2').value = users.value;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);  
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentynine_2', 'ModalUnit1Act29_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit1Act29_2').modal('hide');
            return true;
        }
    }
    
});