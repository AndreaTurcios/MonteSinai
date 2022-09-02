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