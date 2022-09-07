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

document.getElementById('game-nine_2').addEventListener('submit', function (event){

    var name1, name2, name3, years1, years2, extra;
    
    name1 = document.getElementById('input-act9_2-1n').value;
    name2 = document.getElementById('input-act9_2-2n').value;
    name3 = document.getElementById('input-act9_2-3n').value;

    years1 = document.getElementById('input-act9_2-1y').value;
    years2 = document.getElementById('input-act9_2-1y').value;

    extra = document.getElementById('input-act9_2-Extra').value;


    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["OLD", "YOU", "I", "OLD", "OLD", "YOU"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act9_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name1 == "" || name2 == "" || name3 == "" || years1 == "" || years2 == "" || extra == "") {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if(name2 != name3) {
        sweetAlert(2, "Please, be aware with the orden of the names");
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
            document.getElementById('points9_2').value = valorActividad;
            document.getElementById('idlibro9_2').value = libro;
            document.getElementById('idcliente9_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine_2', 'ModalUnit2Act9_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act9_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente9_2').value = users.value;
            document.getElementById('points9_2').value = points;
            document.getElementById('idlibro9_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-nine_2', 'ModalUnit2Act9_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act9_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-ten').addEventListener('submit', function (event){

    var name1, name2, name3, name4, name5;
    
    name1 = document.getElementById('input-act10-1n').value;
    name2 = document.getElementById('input-act10-2n').value;
    name3 = document.getElementById('input-act10-3n').value;
    name4 = document.getElementById('input-act10-4n').value;
    name5 = document.getElementById('input-act10-5n').value;


    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["VERY HAPPY TODAY", "BIRTHDAY", "MOTHER ALWAYS MAKES A NICE PARTY IN THE HOUSE. SHE INVITES HER FRIENDS AND THEY GIVE ME PRETTY PRESENTS- I LOVE MY BIRTHDAY PARTIES"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act10-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name1 == "" || name2 == "" || name3 == "" || name4 == "" || name5 == "") {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if((name1 != name4 
            || name1 != name5
            || name4 != name5)
            || (name2 != name3)) {
        sweetAlert(2, "Please, be aware with the orden of the names");
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit2Act10');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act10').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-ten', 'ModalUnit2Act10');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act10').modal('hide');
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
    let respuestas = ["MAY I GO TO THE BATHROOM NOW?", "TAKE A PENCIL AND DRAW A HEN", "PLEASE LISTEN TO THE TEACHER", "COME BACK TO YOUR SEAT, FRANK", "TAKE A PIECE OF CHALK, MARY", "COME IN AND SIT DOWN, PLEASE"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit2Act11_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act11_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_1', 'ModalUnit2Act11_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act11_1').modal('hide');
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
    var colorPicker11 = document.getElementById("colorPicker11");
    var widthStrokePicker11 = document.getElementById("strokeWidthPicker11");
    var clearButton11 = document.getElementById("clearBtn11");

    // Clear event listener
    clearButton11.addEventListener("click", function () {
        // Clear canvas
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker11.value;
        widthStroke = widthStrokePicker11.value;
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

$('#ModalUnit2Act11_2').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas11');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    var colorPicker11 = document.getElementById("colorPicker11");
    var widthStrokePicker11 = document.getElementById("strokeWidthPicker11");
    var clearButton11 = document.getElementById("clearBtn11");

    // Clear event listener
    clearButton11.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker11.value;
        widthStroke = widthStrokePicker11.value;
    }

    // Check for new color value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('game-eleven_2').addEventListener('submit', function (event) {
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
        for (let i = 0; i < 2;  i++) {
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eleven_2', 'ModalUnit2Act11_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act11_2').modal('hide');
            return true;

        }
    }

});

document.getElementById('game-twelve').addEventListener('submit', function (event){

    var name1, name2, name3, name4, name5, name6;
    
    name1 = document.getElementById('input-act12-1n').value;
    name2 = document.getElementById('input-act12-2n').value;
    name3 = document.getElementById('input-act12-3n').value;
    name4 = document.getElementById('input-act12-4n').value;
    name5 = document.getElementById('input-act12-5n').value;
    name6 = document.getElementById('input-act12-6n').value;


    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["YOUR TEACHER", "A STUDENT", "HI", "I AM"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act12-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name1 == "" || name2 == "" || name3 == "" || name4 == "" || name5 == "" || name6 == "") {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if((name1 != name2)
            || (name3 != name4)
            || (name5 != name6)) {
        sweetAlert(2, "Please, be aware with the orden of the names");
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
            var libro = 3;
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

document.getElementById('game-thirteen_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MY SISTER LOVES HER BIKE", "MY SISTER-IN-LAW TAKES A TAXI", "RODOLFO HAS A MOTORCYCLE", "MY TEACHER DRIVES A PICK UP", "YOUR FATHER DRIVES A TRUCK", "I LIKE THIS BEAUTIFUL CAR"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit2Act13_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act13_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_1', 'ModalUnit2Act13_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act13_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act13

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act13-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act13

for (let i = 0; i < 5; i++) {
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

document.getElementById('game-thirteen_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["TRUCK", "BIKE", "MOTORCYCLE", "CAR", "TRAIN"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
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
        var libro = 3;
        document.getElementById('idcliente13_2').value = users.value;
        document.getElementById('points13_2').value = valorActividad;
        document.getElementById('idlibro13_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit2Act13_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act13_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente13_2').value = users.value;
        document.getElementById('points13_2').value = points;
        document.getElementById('idlibro13_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-thirteen_2', 'ModalUnit2Act13_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act13_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-fourteen_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["MY SISTER USES THE BIKEWAY", "I'LL MEET YOU AT THE BUS STOP", "YOUR FATHER IS AT THE TAXI", "MY UNCLE IS A TRUCK DRIVER", "HIS CAR IS AT THE PARKIN LOT", "YOUR SON IS A MOTORCYCLIST"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_1', 'ModalUnit2Act14_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act14_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_1', 'ModalUnit2Act14_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act14_1').modal('hide');
            return true;
        }
    }
    
});

//Elementos arrastrables act14

for (let i = 0; i < 5; i++) {
    document.getElementById('img-act14-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act14

for (let i = 0; i < 5; i++) {
    document.getElementById('box-act14-' + (i + 1)).addEventListener("drop", (e) => {
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

    document.getElementById('box-act14-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('game-fourteen_2').addEventListener('submit', function (event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let imgs = [];
    let respuestasImg = ["TAXI STAND", "TRAIN STATION", "BUS STOP", "PARKING LOT", "GAS STATION"]
    

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        imgs[i] = $("#img-act14-" + (i + 1)).attr("alt").toUpperCase();
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
        document.getElementById('idcliente14_2').value = users.value;
        document.getElementById('points14_2').value = valorActividad;
        document.getElementById('idlibro14_2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_2', 'ModalUnit2Act14_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act14_2').modal('hide');
        return true;
    } else {
        //Se asigna el puntaje basado en las respuestas correctas
        let puntaje = valorActividad /  imgs.length;
        let points = (puntaje * conteo).toFixed(2);
        var libro = 3;
        document.getElementById('idcliente14_2').value = users.value;
        document.getElementById('points14_2').value = points;
        document.getElementById('idlibro14_2').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-fourteen_2', 'ModalUnit2Act14_2');
        sweetAlert(4, conteo + '/' + imgs.length + ' answers right', null);
        $('#ModalUnit2Act14_2').modal('hide');
        return true;
    }    

});

document.getElementById('game-fifteen').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["2ND", "3RD", "FOURTH", "FIFTH", "6TH", "7TH", "EIGHTH", "NINTH", "10TH"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act15-' + (i + 1)).value;        
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
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;
            document.getElementById('idcliente15').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen', 'ModalUnit2Act15');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act15').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-fifteen', 'ModalUnit2Act15');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act15').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-sixteen_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["IS THERE A PARKING LOT NEAR HERE?", "NO, THERE ISN'T ANY PARKING LOT", "ARE THERE SOME CARS HERE?", "YES, THERE ARE THREE CARS", "ARE THERE SOME BIKES HERE?", "NO, THERE AREN'T ANY BIKES"];
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
            var libro = 3;
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
            var libro = 3;
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
    let respuestas = ["ARE", "HERE", "THERE", "ANY", "THERE", "PARKING", "ISN'T", "ARE", "CARS", "THERE"];
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
            var libro = 3;
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
            var libro = 3;
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

document.getElementById('game-seventeen_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I GO TO SCHOOL BY BUS", "YOU GOT TO CLASS BY FOOT", "MY TEACHER GOES TO SCHOOL BY CAR", "THE PARKING LOT IS OVER THERE", "SHE GOES TO SCHOOL ON FOOT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act17_1-' + (i + 1)).value;        
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
            document.getElementById('points17_1').value = valorActividad;
            document.getElementById('idlibro17_1').value = libro;
            document.getElementById('idcliente17_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen_1', 'ModalUnit2Act17_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act17_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente17_1').value = users.value;
            document.getElementById('points17_1').value = points;
            document.getElementById('idlibro17_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen_1', 'ModalUnit2Act17_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act17_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-seventeen_2').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BY BUS", "BY FOOT", "SCHOOL", "CAR", "SHE", "FOOT", "PARKING", "OVER THERE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act17_2-' + (i + 1)).value;        
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
            document.getElementById('points17_2').value = valorActividad;
            document.getElementById('idlibro17_2').value = libro;
            document.getElementById('idcliente17_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen_2', 'ModalUnit2Act17_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act17_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente17_2').value = users.value;
            document.getElementById('points17_2').value = points;
            document.getElementById('idlibro17_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-seventeen_2', 'ModalUnit2Act17_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act17_2').modal('hide');
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
    let respuestas = ["HOW DO YOU GO TO SCHOOL, FRANK?", "I GO TO SCHOOL BY FOOT", "HOW DOES YOUR GRANMPA COME?", "HE ALWAYS COMES BY TRAIN", "WHERE IS THE BUS STOP, MARY?", "THE BUS STOP IS OVER THERE?"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_1', 'ModalUnit2Act18_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act18_1').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_1', 'ModalUnit2Act18_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act18_1').modal('hide');
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
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < 10; i++) {
       inputs[i] = document.getElementById('input-act18_2-' + (i + 1)).value;        
    }
    
    if (inputs.includes("")) {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else {
        var libro = 3;
        document.getElementById('points18_2').value = valorActividad;
        document.getElementById('idlibro18_2').value = libro;
        document.getElementById('idcliente18_2').value = users.value;                       
        console.log(users.value);
        console.log(valorActividad);
        console.log(libro);
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'game-eighteen_2', 'ModalUnit2Act18_2');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act18_2').modal('hide');
        return true;
    }
    
});

document.getElementById('game-nineteen').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["BUS", "MOTORCYCLE", "BIKE", "TRUCK"];
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
            var libro = 3;
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
            var libro = 3;
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

document.getElementById('game-twenty_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["HOW DO YOU COME TO SCHOOL, TONY?", "I COME TO SCHOOL BY BUS", "HOW DO YOU GO TO CLASS, MELVIN?", "I ALWAYS GO RIDING MY BIKE", "HOW DO YOU GO TO THE UNIVERSITY?", "I GO TO THE UNIVERSITY BY CAR"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_1', 'ModalUnit2Act20_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act20_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente20_1').value = users.value;
            document.getElementById('points20_1').value = points;
            document.getElementById('idlibro20_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_1', 'ModalUnit2Act20_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act20_1').modal('hide');
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
    let respuestas = ["DO", "GO", "SCHOOL", "BUS", "HOW", "UNIVERSITY", "CAR", "YOU", "CLASS", "ALWAYS", "RIDING"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_2', 'ModalUnit2Act20_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act20_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente20_2').value = users.value;
            document.getElementById('points20_2').value = points;
            document.getElementById('idlibro20_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twenty_2', 'ModalUnit2Act20_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act20_2').modal('hide');
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
    let respuestas = ["FABRICIO", "MARITZA", "YOU", "MARITZA", "FINE FABRICIO", "YOU", "FABRICIO", "DO", "BIKE", "MARITZA", "I DO"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit2Act21');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act21').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyone', 'ModalUnit2Act21');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act21').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentytwo_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["I AM IN THIRD GRADE THIS YEAR", "MY SISTER, ALICIA IS IN SEVENTH GRADE", "HE STUDIES TENTH GRADE", "MY BROTHER, RAFAEL IS IN NINTH GRADE"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_1', 'ModalUnit2Act22_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act22_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente22_1').value = users.value;
            document.getElementById('points22_1').value = points;
            document.getElementById('idlibro22_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_1', 'ModalUnit2Act22_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act22_1').modal('hide');
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
    let respuestas = ["THIRD", "SISTER", "SEVENTH", "HE", "TENTH", "MY", "NINTH"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_2', 'ModalUnit2Act22_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act22_2').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente22_2').value = users.value;
            document.getElementById('points22_2').value = points;
            document.getElementById('idlibro22_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentytwo_2', 'ModalUnit2Act22_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act22_2').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentythree').addEventListener('submit', function (event){

    var name1, name2, name3, name4, name5, name5, name6, name7;

    name1 = document.getElementById('input-act23-1n').value;
    name2 = document.getElementById('input-act23-2n').value;
    name3 = document.getElementById('input-act23-3n').value;
    name4 = document.getElementById('input-act23-4n').value;
    name5 = document.getElementById('input-act23-5n').value;
    name6 = document.getElementById('input-act23-6n').value;
    name7 = document.getElementById('input-act23-7n').value;

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["TEACHER", "MEET YOU", "TO MEET YOU", "TO SCHOOL", "TO SCHOOL ON FOOT"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act23-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name1 == "" || name2 == "" || name3 == "" || name4 == "" || name5 == "" || name6 == "" || name7 == "") {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if ((name1 != name3 && name1 != name6 && name3 != name6 ) 
            || (name2 != name4 && name2 != name5 && name2 != name7 && name4 != name5 && name4 != name7 && name5 != name7))
    {
        sweetAlert(2, "Please, be aware with the orden of the names");
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit2Act23');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act23').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentythree', 'ModalUnit2Act23');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act23').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyfour').addEventListener('submit', function (event){

    var name1, name2, name3, name4;

    name1 = document.getElementById('input-act24-1n').value;
    name2 = document.getElementById('input-act24-2n').value;
    name3 = document.getElementById('input-act24-3n').value;
    name4 = document.getElementById('input-act24-4n').value;


    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["TEACHER", "ARE YOU", "FINE", "TEACHER", "TEACHER", "OK", "THANKS", "ARE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act24-' + (i + 1)).value;        
    }
    
    if (inputs.includes("") || name1 == "" || name2 == "" || name3 == "" || name4 == "") {
        sweetAlert(2, "Complete the missing fields", null);
        return false;
    } else if ((name1 != name2 || name1 != name3 || name3 != name2))
    {
        sweetAlert(2, "Please, be aware with the orden of the names");
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit2Act24');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act24').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfour', 'ModalUnit2Act24');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act24').modal('hide');
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
    let respuestas = ["I", "NEED", "YOU", "NEED", "HE, SHE, IT", "NEEDS", "WE", "NEED", "YOU", "NEED", "THEY", "NEED",
                    "I", "NEEDED", "YOU", "NEEDED", "HE, SHE, IT", "NEEDED", "WE", "NEEDED", "YOU", "NEEDED", "THEY", "NEEDED",
                    "I", "DRIVE", "YOU", "DRIVE", "HE, SHE, IT", "DRIVES", "WE", "DRIVE", "YOU", "DRIVE", "THEY", "DRIVE",
                    "I", "DROVE", "YOU", "DROVE", "HE, SHE, IT", "DROVE", "WE", "DROVE", "YOU", "DROVE", "THEY", "DROVE"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit2Act25');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act25').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyfive', 'ModalUnit2Act25');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act25').modal('hide');
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
    let respuestas = ["I", "RIDE", "YOU", "RIDE", "HE, SHE, IT", "RIDES", "WE", "RIDE", "YOU", "RIDE", "THEY", "RIDE",
                    "I", "RODE", "YOU", "RODE", "HE, SHE, IT", "RODE", "WE", "RODE", "YOU", "RODE", "THEY", "RODE",
                    "I", "TAKE", "YOU", "TAKE", "HE, SHE, IT", "TAKES", "WE", "TAKE", "YOU", "TAKE", "THEY", "TAKE",
                    "I", "TOOK", "YOU", "TOOK", "HE, SHE, IT", "TOOK", "WE", "TOOK", "YOU", "TOOK", "THEY", "TOOK"];
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit2Act26');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act26').modal('hide');
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
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentysix', 'ModalUnit2Act26');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act26').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyseven_1').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["ROBERTO NEEDS A NEW PICK UP", "I RIDE MY BIKE TO SCHOOL", "MY FATHER DRIVES A MINIVAN", "I STUDY THIRD GRADE", "RAFAEL STUDIES EVERY DAY", "I WAS IN NICARAGUA YESTERDAY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act27_1-' + (i + 1)).value;        
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
            document.getElementById('points27_1').value = valorActividad;
            document.getElementById('idlibro27_1').value = libro;
            document.getElementById('idcliente27_1').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven_1', 'ModalUnit2Act27_1');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act27_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente27_1').value = users.value;
            document.getElementById('points27_1').value = points;
            document.getElementById('idlibro27_1').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven_1', 'ModalUnit2Act27_1');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act27_1').modal('hide');
            return true;
        }
    }
    
});

document.getElementById('game-twentyseven_2').addEventListener('submit', function (event){

    //Puntos equivalentes de la actividad
    let valorActividad = 1;

    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar respuestas y datos ingresados
    let respuestas = ["NEEDS", "DRIVES", "RIDE", "STUDIES", "STUDY", "WAS"];
    let inputs = [];

    //Se obtienen los datos ingresados y se colocan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
       inputs[i] = document.getElementById('input-act27_2-' + (i + 1)).value;        
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
            document.getElementById('points27_2').value = valorActividad;
            document.getElementById('idlibro27_2').value = libro;
            document.getElementById('idcliente27_2').value = users.value;                       
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven_2', 'ModalUnit2Act27_2');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act27_1').modal('hide');
            return true;
        } else {
            //Se asgina el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 3;
            console.log(users.value);
            console.log(valorActividad);
            console.log(libro);
            document.getElementById('idcliente27_2').value = users.value;
            document.getElementById('points27_2').value = points;
            document.getElementById('idlibro27_2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'game-twentyseven_2', 'ModalUnit2Act27_2');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act27_2').modal('hide');
            return true;
        }
    }
    
});