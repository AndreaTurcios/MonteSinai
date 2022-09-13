const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

document.getElementById('game-one_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IT IS THREE O'CLOCK", "IT IS ONE O'CLOCK", "IT IS TWELVE THIRTY", "IT IS TWENTY-FIVE TO TWELVE", "IT IS TWELVE TWENTY-FIVE", "IT IS TEN TO TWELVE"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_1', 'ModalUnit3Act1_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act1_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-one_1', 'ModalUnit3Act1_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act1_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act1_2

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act1-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act1_2

for (let i = 0; i < 5; i++) {
    document.getElementById('box-act1-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act1-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-one_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["SIX", "ELEVEN", "THREE", "NINE", "TEN"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        imgs[i] = $("#img-act1-" + (i + 1)).attr("alt").toUpperCase();
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
        document.getElementById('idcliente1_2').value = users.value;
        document.getElementById('points1_2').value = valorActividad;
        document.getElementById('idlibro1_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-one_2', 'ModalUnit3Act1_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit3Act1_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente1_2').value = users.value;
        document.getElementById('points1_2').value = points;
        document.getElementById('idlibro1_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-one_2', 'ModalUnit3Act1_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit3Act1_2').modal('hide');
        return true;
    }    

});

//Elementos arrastrables act2

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act2-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act2

for (let i = 0; i < 5; i++) {
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
    let respuestasImg = ["TWELVE", "NINE", "ELEVEN", "SIX", "SEVEN"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
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
        var libro = 3;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = valorActividad;
        document.getElementById('idlibro2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit3Act2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit3Act2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = points;
        document.getElementById('idlibro2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit3Act2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit3Act2').modal('hide');
        return true;
    }    

});

document.getElementById('game-three_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHAT TIME DO YOU HAVE BREAKFAST?", "I HAVE BREAKFAST AT SEVEN O'CLOCK", "WHAT TIME DO YOU HAVE LUNCH?", "I HAVE LUNCH AT TWELVE THIRTY", "WHAT TIME DO YOU HAVE DINNER", "I HAVE DINNER AT 7 P.M."];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_1', 'ModalUnit3Act3_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act3_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_1', 'ModalUnit3Act3_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act3_1').modal('hide');
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
    let respuestas = ["TIME", "BREAKFAST", "SEVEN O'CLOCK", "WHAT", "HAVE", "LUNCH", "TWELVE THIRTY", "DO YOU", "DINNER", "7 P.M."];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_2', 'ModalUnit3Act3_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act3_2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-three_2', 'ModalUnit3Act3_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act3_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-four').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "WAKE", "YOU", "WAKE", "HE, SHE, IT", "WAKES", "WE", "WAKE", "YOU", "WAKE", "THEY", "WAKE",
                    "I", "WOKE", "YOU", "WOKE", "HE, SHE, IT", "WOKE", "WE", "WOKE", "YOU", "WOKE", "THEY", "WOKE",
                    "I", "GET", "YOU", "GET", "HE, SHE, IT", "GETS", "WE", "GET", "YOU", "GET", "THEY", "GET",
                    "I", "GOT", "YOU", "GOT", "HE, SHE, IT", "GOT", "WE", "GOT", "YOU", "GOT", "THEY", "GOT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act4-' + (i + 1)).value;        
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
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;
            document.getElementById('idcliente4').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit3Act4');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act4').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four', 'ModalUnit3Act4');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act4').modal('hide');
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
    let respuestas = ["I", "HAVE", "YOU", "HAVE", "HE, SHE, IT", "HAS", "WE", "HAVE", "YOU", "HAVE", "THEY", "HAVE",
                    "I", "HAD", "YOU", "HAD", "HE, SHE, IT", "HAD", "WE", "HAD", "YOU", "HAD", "THEY", "HAD",
                    "I", "GO", "YOU", "GO", "HE, SHE, IT", "GOES", "WE", "GO", "YOU", "GO", "THEY", "GO",
                    "I", "WENT", "YOU", "WENT", "HE, SHE, IT", "WENT", "WE", "WENT", "YOU", "WENT", "THEY", "WENT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act5-' + (i + 1)).value;        
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
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;
            document.getElementById('idcliente5').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit3Act5');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act5').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit3Act5');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act5').modal('hide');
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
    let respuestas = ["I", "LIKE", "YOU", "LIKE", "HE, SHE, IT", "LIKES", "WE", "LIKE", "YOU", "LIKE", "THEY", "LIKE",
                    "I", "LIKED", "YOU", "LIKED", "HE, SHE, IT", "LIKED", "WE", "LIKED", "YOU", "LIKED", "THEY", "LIKED",
                    "I", "DO", "YOU", "DO", "HE, SHE, IT", "DOES", "WE", "DO", "YOU", "DO", "THEY", "DO",
                    "I", "DID", "YOU", "DID", "HE, SHE, IT", "DID", "WE", "DID", "YOU", "DID", "THEY", "DID"];
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
            var libro = 3;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;
            document.getElementById('idcliente6').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit3Act6');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act6').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit3Act6');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act6').modal('hide');
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
    let respuestas = ["WHAT TIME DO YOU GO TO BED?", "I GO TO BED AT TEN O'CLOCK", "WHAT TIME DO YOU WAKE UP?", "I USUALLY WAKE UP AT 5 A.M.", "WHAT TIME DO YOU HAVE BREAKFAST", "I ALWAYS HAVE BREAKFAST AT 7 A.M."];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act7_1-' + (i + 1)).value;        
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
            document.getElementById('points7_1').value = valorActividad;
            document.getElementById('idlibro7_1').value = libro;
            document.getElementById('idcliente7_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_1', 'ModalUnit3Act7_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act7_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente7_1').value = users.value;
            document.getElementById('points7_1').value = points;
            document.getElementById('idlibro7_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_1', 'ModalUnit3Act7_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act7_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-seven_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < 2; i++) {
       inputs[i] = document.getElementById('input-act7_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        var libro = 3;
        document.getElementById('points7_2').value = valorActividad;
        document.getElementById('idlibro7_2').value = libro;
        document.getElementById('idcliente7_2').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven_2', 'ModalUnit3Act7_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit3Act7_2').modal('hide');
    }
    
});

document.getElementById('game-eight_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I WAKE UP AT FIVE O'CLOCK", "YOU GO TO SCHOOL AT 7 A.M.", "MY FATHER GETS UP AT FIVE TEN", "I LIKE TO GET UP LATE ON SUNDAYS", "I DO MY HOMEWORK AT NIGHT", "HE DOES HIS HOMEWORK ON TIME"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit3Act8_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act8_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit3Act8_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act8_1').modal('hide');
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
    let respuestas = ["WAKE UP", "O'CLOCK", "GETS UP", "FIVE", "LIKE", "SUNDAY", "DO", "NIGHT", "GO", "DOES"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit3Act8_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act8_2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit3Act8_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act8_2').modal('hide');
            return true;
        }
    }
    
});