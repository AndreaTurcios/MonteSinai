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

document.getElementById('game-nine').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["PLAY", "THE AFTERNOON", "DO", "AT NIGHT", "DO", "EVERY DAY", "O'CLOCK", "THE EVENING", "O'CLOCK", "THE AFTERNOON"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit3Act9');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act9').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine', 'ModalUnit3Act9');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act9').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-ten_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I'LL CATCH THE EARLY TRAIN", "I AWOKE EARLY THIS MORNING", "I'M WATICHING THE LATE FILM", "MY TRAING ARRIVED LATE, AS USUAL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act10_1-' + (i + 1)).value;        
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
            document.getElementById('points10_1').value = valorActividad;
            document.getElementById('idlibro10_1').value = libro;
            document.getElementById('idcliente10_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten_1', 'ModalUnit3Act10_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act10_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente10_1').value = users.value;
            document.getElementById('points10_1').value = points;
            document.getElementById('idlibro10_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten_1', 'ModalUnit3Act10_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act10_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-ten_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["CATCH", "EARLY", "EARLY", "MORNING", "WATCHING", "LATE", "MY", "LATE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act10_2-' + (i + 1)).value;        
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
            document.getElementById('points10_2').value = valorActividad;
            document.getElementById('idlibro10_2').value = libro;
            document.getElementById('idcliente10_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten_2', 'ModalUnit3Act10_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act10_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente10_2').value = users.value;
            document.getElementById('points10_2').value = points;
            document.getElementById('idlibro10_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten_2', 'ModalUnit3Act10_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act10_2').modal('hide');
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
    let respuestas = ["WHAT TIME IS IT?", "EIGHT O'CLOCK", "WHAT TIME DO YOU GO TO BED, PATRICIA?", "I GO TO BED AT NINE O'CLOCK", "WHAT TIME DO YOU WAKE UP IN THE MORNING?", "I WAKE UP AT 5 A.M."];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit3Act11_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act11_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit3Act11_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act11_1').modal('hide');
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
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act11_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        var libro = 3;
            document.getElementById('points11_2').value = valorActividad;
            document.getElementById('idlibro11_2').value = libro;
            document.getElementById('idcliente11_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_2', 'ModalUnit3Act11_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act11_2').modal('hide');
            return true;
    }
    
});

document.getElementById('game-twelve').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < 3; i++) {
       inputs[i] = document.getElementById('input-act12-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
            var libro = 3;
            document.getElementById('points12').value = valorActividad;
            document.getElementById('idlibro12').value = libro;
            document.getElementById('idcliente12').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twelve', 'ModalUnit3Act12');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act12').modal('hide');
            return true;
    }
    
});

document.getElementById('game-thirteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I GET UP FIVE MINUTES EARLY", "I ALWAYS BRUSH MY TEETH", "AFTER THIS, I TAKE MY SHOWER", "I WALK TO SCHOOL AFTER BREAKFAST", "I HAVE BREAKFAST VERY EARLY", "I GET TO SCHOOL AT SEVEN A.M."];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit3Act13_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act13_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente13_1').value = users.value;
            document.getElementById('points13_1').value = points;
            document.getElementById('idlibro13_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit3Act13_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act13_1').modal('hide');
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
    let respuestas = ["I BRUSH MY TEETH", "I WAKE UP", "I GET UP", "I GO TO BUY TORTILLAS", "I TAKE MY SHOWER", "I HAVE BREAKFAST", "I GET TO SCHOOL", "I WALK TO SCHOOL"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit3Act13_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act13_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente13_2').value = users.value;
            document.getElementById('points13_2').value = points;
            document.getElementById('idlibro13_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit3Act13_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act13_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fourteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHERE DO YOU HAVE LUNCH, MELISSA?", "I HAVE LUNCH AT A GOOD RESTAURANT", "WHEN WILL YOU GO TO EUROPE, BRAYINA?", "I WILL GO TO EUROPE ON AUGUST", "WHY IS FRANCISCO SO HAPPY TODAY", "BECAUSE HE KNEW A PRETTY GIRL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act14_1-' + (i + 1)).value;        
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
            document.getElementById('points14_1').value = valorActividad;
            document.getElementById('idlibro14_1').value = libro;
            document.getElementById('idcliente14_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_1', 'ModalUnit3Act14_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act14_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente14_1').value = users.value;
            document.getElementById('points14_1').value = points;
            document.getElementById('idlibro14_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_1', 'ModalUnit3Act14_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act14_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-fourteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHERE DO", "HAVE", "WHEN WILL", "WILL GO", "WHY IS", "KNEW"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act14_2-' + (i + 1)).value;        
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
            document.getElementById('points14_2').value = valorActividad;
            document.getElementById('idlibro14_2').value = libro;
            document.getElementById('idcliente14_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_2', 'ModalUnit3Act14_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act14_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente14_2').value = users.value;
            document.getElementById('points14_2').value = points;
            document.getElementById('idlibro14_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_2', 'ModalUnit3Act14_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act14_2').modal('hide');
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
    let respuestas = ["I GO TO MY CHURCH ON SUNDAY", "YOU BEGIN TO STUDY ON MONDAY", "SHE GOES TO THE MOVIES ON TUESDAY", "I CLEAN MY BEDROOM ON WEDNESDAY", "WE GO SWIMMING ON THURSDAY", "THEY PLAY BASKETBALL ON FRIDAY", "STUDENTS ENJOY EVERY SATURDAY", "SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit3Act15_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act15_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente15_1').value = users.value;
            document.getElementById('points15_1').value = points;
            document.getElementById('idlibro15_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_1', 'ModalUnit3Act15_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act15_1').modal('hide');
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
    let respuestas = ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_2', 'ModalUnit3Act15_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act15_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente15_2').value = users.value;
            document.getElementById('points15_2').value = points;
            document.getElementById('idlibro15_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen_2', 'ModalUnit3Act15_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act15_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-sixteen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "BRUSH", "YOU", "BRUSH", "HE, SHE, IT", "BRUSHES", "WE", "BRUSH", "YOU", "BRUSH", "THEY", "BRUSH",
                    "I", "BRUSHED", "YOU", "BRUSHED", "HE, SHE, IT", "BRUSHED", "WE", "BRUSHED", "YOU", "BRUSHED", "THEY", "BRUSHED",
                    "I", "WATCH", "YOU", "WATCH", "HE, SHE, IT", "WATCHES", "WE", "WATCH", "YOU", "WATCH", "THEY", "WATCH",
                    "I", "WATCHED", "YOU", "WATCHED", "HE, SHE, IT", "WATCHED", "WE", "WATCHED", "YOU", "WATCHED", "THEY", "WATCHED"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act16-' + (i + 1)).value;        
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
            document.getElementById('points16').value = valorActividad;
            document.getElementById('idlibro16').value = libro;
            document.getElementById('idcliente16').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen', 'ModalUnit3Act16');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act16').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = points;
            document.getElementById('idlibro16').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-sixteen', 'ModalUnit3Act16');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act16').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-seventeen').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "WALK", "YOU", "WALK", "HE, SHE, IT", "WALKS", "WE", "WALK", "YOU", "WALK", "THEY", "WALK",
                    "I", "WALKED", "YOU", "WALKED", "HE, SHE, IT", "WALKED", "WE", "WALKED", "YOU", "WALKED", "THEY", "WALKED",
                    "I", "HELP", "YOU", "HELP", "HE, SHE, IT", "HELPS", "WE", "HELP", "YOU", "HELP", "THEY", "HELP",
                    "I", "HELPED", "YOU", "HELPED", "HE, SHE, IT", "HELPED", "WE", "HELPED", "YOU", "HELPED", "THEY", "HELPED"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act17-' + (i + 1)).value;        
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
            document.getElementById('points17').value = valorActividad;
            document.getElementById('idlibro17').value = libro;
            document.getElementById('idcliente17').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit3Act17');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act17').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = points;
            document.getElementById('idlibro17').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen', 'ModalUnit3Act17');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act17').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eighteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHERE DO YOU HAVE CLASS, MARICELA?", "I HAVE CLASS IN THE SECOND FLOOR", "WHEN WILL YOU HAVE CLASS WITH US?", "I WILL HAVE IT TOMORROW AT 7 P.M.", "THIS CAKE IS FOR ALL THE STUDENTS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act18_1-' + (i + 1)).value;        
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
            document.getElementById('points18_1').value = valorActividad;
            document.getElementById('idlibro18_1').value = libro;
            document.getElementById('idcliente18_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_1', 'ModalUnit3Act18_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act18_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente18_1').value = users.value;
            document.getElementById('points18_1').value = points;
            document.getElementById('idlibro18_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_1', 'ModalUnit3Act18_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act18_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-eighteen_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HAVE CLASS", "HAVE CLASS", "HAVE", "IN", "HAVE IT TOMORROW", "FOR ALL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act18_2-' + (i + 1)).value;        
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
            document.getElementById('points18_2').value = valorActividad;
            document.getElementById('idlibro18_2').value = libro;
            document.getElementById('idcliente18_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_2', 'ModalUnit3Act18_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act18_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente18_2').value = users.value;
            document.getElementById('points18_2').value = points;
            document.getElementById('idlibro18_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_2', 'ModalUnit3Act18_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act18_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nineteen_1').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHAT TIME DO YOU GET UP, JOSÉ?", "I GET UP AT FIVE IN THE MORNING", "DO YOU WALK TO SCHOOL MARICELA", "YES, I GO TO SCHOOL BY FOOT", "DO YOU BUY TORTILLAS FOR LUNCH", "YES, I BUY TWO TORTILLAS", "CAN YOU HELP ME WITH MY HOMEWORK", "YES, I CAN. LET'S DO IT NOW"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_1', 'ModalUnit3Act19_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act19_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente19_1').value = users.value;
            document.getElementById('points19_1').value = points;
            document.getElementById('idlibro19_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_1', 'ModalUnit3Act19_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act19_1').modal('hide');
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
    let respuestas = ["YES, I GO TO SCHOOL BY FOOT", "YES, I BUY TWO TORTILLAS", "I GET UP AT FIVE IN THE MORNING", "YES, I CAN. LET'S DO IT NOW"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_2', 'ModalUnit3Act19_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act19_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente19_2').value = users.value;
            document.getElementById('points19_2').value = points;
            document.getElementById('idlibro19_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nineteen_2', 'ModalUnit3Act19_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act19_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twenty').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["WHEN DO YOU DO YOUR HOMEWORK", "WHAT ABOUT YOUR SISTER", "WHAT DO YOU DO AT RECESS TIME AT SCHOOL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act20-' + (i + 1)).value;        
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
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;
            document.getElementById('idcliente20').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit3Act20');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = points;
            document.getElementById('idlibro20').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty', 'ModalUnit3Act20');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act20').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyone').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["THE AVOCADO", "THE TOMATO", "THE STRING BEAN", "THE CARROT"];
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
            var libro = 3;
            document.getElementById('points21').value = valorActividad;
            document.getElementById('idlibro21').value = libro;
            document.getElementById('idcliente21').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit3Act21');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act21').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = points;
            document.getElementById('idlibro21').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit3Act21');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act21').modal('hide');
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
    let respuestas = ["DONKEY", "THE", "FEEL", "YOU", "SEE", "IT", "YOU"];
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
            var libro = 3;
            document.getElementById('points22').value = valorActividad;
            document.getElementById('idlibro22').value = libro;
            document.getElementById('idcliente22').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit3Act22');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act22').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente22').value = users.value;
            document.getElementById('points22').value = points;
            document.getElementById('idlibro22').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo', 'ModalUnit3Act22');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act22').modal('hide');
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
    let respuestas = ["A", "DAUGHTER", "WHITE", "SNOW", "HER", "HAIR", "BLACK", "SHE", "LITTLE SNOW WHITE"];
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
            var libro = 3;
            document.getElementById('points23').value = valorActividad;
            document.getElementById('idlibro23').value = libro;
            document.getElementById('idcliente23').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit3Act23');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act23').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente23').value = users.value;
            document.getElementById('points23').value = points;
            document.getElementById('idlibro23').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit3Act23');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act23').modal('hide');
            return true;
        }
    }
    
});

//24

//25

//26

//27

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas27');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker27 = document.getElementById("colorPicker27");
    var widthStrokePicker27 = document.getElementById("strokeWidthPicker27");
    var clearButton27 = document.getElementById("clearBtn27");

    // Clear event listener
    clearButton27.addEventListener("click", function () {
        // Clear canvas
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker27.value;
        widthStroke = widthStrokePicker27.value;
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

$('#ModalUnit3Act27').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas27');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker27 = document.getElementById("colorPicker27");
    var widthStrokePicker27 = document.getElementById("strokeWidthPicker27");
    var clearButton27 = document.getElementById("clearBtn27");

    // Clear event listener
    clearButton27.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker27.value;
        widthStroke = widthStrokePicker27.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-twentyseven').addEventListener('submit', function (event) {
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
        for (let i = 0; i < 8;  i++) {
        inputs[i] = document.getElementById('input-act27-' + (i + 1)).value;        
        }
        
        if (inputs.includes("")) {
            sweetAlert(2, "Complete the missing fields", null);
            return false;
        } else {
            
            var libro = 3;
            document.getElementById('points27').value = valorActividad;
            document.getElementById('idlibro27').value = libro;
            document.getElementById('idcliente27').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven', 'ModalUnit3Act27');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act27').modal('hide');
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
    let respuestas = ["IT", "RAINS", "ALREADY", "RAIN", "A", "LOOK", "FALL"];
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
            var libro = 3;
            document.getElementById('points28').value = valorActividad;
            document.getElementById('idlibro28').value = libro;
            document.getElementById('idcliente28').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight', 'ModalUnit3Act28');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit3Act28').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente28').value = users.value;
            document.getElementById('points28').value = points;
            document.getElementById('idlibro28').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyeight', 'ModalUnit3Act28');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit3Act28').modal('hide');
            return true;
        }
    }
    
});