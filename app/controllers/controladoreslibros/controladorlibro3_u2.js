const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

document.getElementById('game-one').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BIRTHDAY", "OCTOBER 12TH", "SABRINA", "NINE", "LUIS", "CAKE", "BIG CAKE"];
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
            var libro = 3;
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
            var libro = 3;
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

document.getElementById('game-two').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["ONE", "TWO", "THREE", "FOUR", "FIVE", "SIX", "SEVEN", "EIGHT", "NINE", "TEN", "ELEVEN", "TWELVE", "THIRTEEN", "FOURTEEN", "FIFTEEN", "SIXTEEN", "SEVENTEEN", "EIGHTEEN", "NINETEEN", "TWENTY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act2-' + (i + 1)).value;        
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
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;
            document.getElementById('idcliente2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit2Act2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-two', 'ModalUnit2Act2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-three').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I", "MAKE", "YOU", "MAKE", "HE, SHE, IT", "MAKES", "WE", "MAKE", "YOU", "MAKE", "THEY", "MAKE",
                    "I", "MADE", "YOU", "MADE", "HE, SHE, IT", "MADE", "WE", "MADE", "YOU", "MADE", "THEY", "MADE",
                    "I", "GIVE", "YOU", "GIVE", "HE, SHE, IT", "GIVES", "WE", "GIVE", "YOU", "GIVE", "THEY", "GIVE",
                    "I", "GAVE", "YOU", "GAVE", "HE, SHE, IT", "GAVE", "WE", "GAVE", "YOU", "GAVE", "THEY", "GAVE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act3-' + (i + 1)).value;        
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
            document.getElementById('points3').value = valorActividad;
            document.getElementById('idlibro3').value = libro;
            document.getElementById('idcliente3').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalUnit2Act3');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act3').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalUnit2Act3');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act3').modal('hide');
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
    let respuestas = ["I ALWAYS GO TO CLASS EARLY", "I NEVER COME LATE", "SHE GETS GOOD GRADES VERY OFTEN", "HE SELDOM PLAYS BASKTEBALL", "I USUALLY GO TO THE RIVER AT NOON", "STUDENTS NEVER COME LATE"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_1', 'ModalUnit2Act4_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act4_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_1', 'ModalUnit2Act4_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act4_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-four_2').addEventListener('submit', function (event){
    
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["ALWAYS", "CLASS", "SELDOM", "BASKETBALL", "I", "GO", "NEVER", "LATE", "GOOD", "OFTEN"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act4_2-' + (i + 1)).value;        
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
            document.getElementById('points4_2').value = valorActividad;
            document.getElementById('idlibro4_2').value = libro;
            document.getElementById('idcliente4_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_2', 'ModalUnit2Act4_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act4_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente4_2').value = users.value;
            document.getElementById('points4_2').value = points;
            document.getElementById('idlibro4_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-four_2', 'ModalUnit2Act4_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act4_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-five').addEventListener('submit', function (event){
    
    var nombre;
    nombre = document.getElementById('input-act5n').value;

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["TO YOU", "BIRTHDAY", "YOU", "HAPPY", "HAPPY BIRTHDAY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act5-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || nombre =="") {
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit2Act5');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act5').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-five', 'ModalUnit2Act5');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
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
    let respuestas = ["WANT", "PLAY", "TEACHER GIVES", "SHE IS DOING", "WILL INVITE", "A CUP OF COFFEE", "INVITE YOU", "PARTY", "INVITING YOU", "MY PARTY"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit2Act6');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act6').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-six', 'ModalUnit2Act6');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act6').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act7_1

for (let i = 0; i < 4; i++) {
    document.getElementById('img-act7-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act7_1

for (let i = 0; i < 4; i++) {
    document.getElementById('box-act7-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act7-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-seven_1').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["TABLE", "BOOK", "CHAIR", "FRIEND"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 4; i++) {
        imgs[i] = $("#img-act7-" + (i + 1)).attr("alt").toUpperCase();
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
        document.getElementById('idcliente7_1').value = users.value;
        document.getElementById('points7_1').value = valorActividad;
        document.getElementById('idlibro7_1').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven_1', 'ModalUnit2Act7_1');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act7_1').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente7_1').value = users.value;
        document.getElementById('points7_1').value = points;
        document.getElementById('idlibro7_1').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-seven_1', 'ModalUnit2Act7_1');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act7_1').modal('hide');
        return true;
    }    

});

document.getElementById('game-seven_2').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["FERNANDO IS MY BEST FRIEND", "WE HAVE EIGHT CHAIRS", "THIS BOOKS IS INTERESTING", "IT IS A SMALL NOTEBOOK", "OUR TEACHER HAS A BLUE PEN", "YOUR TABLE IS BROWN"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_2', 'ModalUnit2Act7_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act7_2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-seven_2', 'ModalUnit2Act7_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act7_2').modal('hide');
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
    let respuestas = ["MY MOTHER IS A PRETTY WOMAN", "SHE EATS IN A NEW DISH", "MY SISTER WEARS A NICE DRESS", "YOUR FATHER IS A HAPPY MAN", "YOU ARE BEAUTIFUL GIRL", "IT IS A NEW BALLOON"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit2Act8_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act8_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_1', 'ModalUnit2Act8_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act8_1').modal('hide');
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
    let respuestas = ["MY", "PRETTY", "IS", "NEW", "ARE", "GIRL", "SISTER", "NICE", "FATHER", "HAPPY", "EATS", "NEW"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit2Act8_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act8_2').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eight_2', 'ModalUnit2Act8_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act8_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-nine_1').addEventListener('submit', function (event){

    var name;
    
    name = document.getElementById('input-act9_1-1n').value;
    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["LET'S COUNT THE CANDLES ON THE CAKE: ONE, TWO, THREE, FOUR, FIVE, SIX, SEVEN, EIGHT",
                    "SHE IS EIGHT YEARS OLD. HOW OLD ARE YOU, MELISSA?",
                    "I AM NINE YEARS OLD. HOW OLD ARE YOU RICARDO?",
                    "I AM TEN YEARS OLD. HOW OLD ARE YOU,"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act9_1-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name == "") {
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
            document.getElementById('points9_1').value = valorActividad;
            document.getElementById('idlibro9_1').value = libro;
            document.getElementById('idcliente9_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine_1', 'ModalUnit2Act9_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act9_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente9_1').value = users.value;
            document.getElementById('points9_1').value = points;
            document.getElementById('idlibro9_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine_1', 'ModalUnit2Act9_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act9_1').modal('hide');
            return true;
        }
    }
    
});