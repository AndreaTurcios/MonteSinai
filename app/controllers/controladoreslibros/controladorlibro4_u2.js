const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

var colorStroke, widthStroke, intervalo;

$(document).ready(function () {

    function intializeSelect() {
        //Se inicializan los select
        $('.select-act3').each(function (box) {
            var value = $('.select-act3')[box].value;
            if (value) {
                $('.select-act3').not(this).find('option[value="' + value + '"]').hide();
            }
        });

        $('.time-b4').timepicker({
            'minTime': '5:00am',
            'maxTime': '5:00pm'
        });
    };

    intializeSelect();

    //Se llama cada vez que se selecciona un select
    $('.select-act3').on('change', function (event) {
        $('.select-act3').find('option').show();
        intializeSelect();
    });
});

document.getElementById('unit2-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["MACARONI", "SPAGUETTI", "SALAD", "SANDWICH", "FRENCH FRIES", "COOKIES", "POP CORN", "PANCAKES", "BUTTER", "BACON", "SAUSAGES", "HAM", "FISH", "EGGS", "CHEESE", "CEREAL", "CHICKEN", "BEANS", "RICE", "MEAT", "BREAD", "PIZZA", "HAMBURGER", "HOT DOG"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 24; i++) {
        inputs[i] = document.getElementById('input-act1-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 24; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = valorActividad;
            document.getElementById('idlibro').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act1', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act1').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = points;
            document.getElementById('idlibro').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act1').modal('hide');
            return true;
        }
    }
});

document.getElementById("unit2-act2").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    let conteo = 0, verifyChecks = 0;
    //Llenar arreglo de inputs y se verifica que haya seleccionado al menos una de cada línea
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('radio-act2-' + (i + 1)).checked;
        if (inputs[i]) {
            verifyChecks++;
        }
    }
    if (verifyChecks == 10) {
        var libro = 4;
        document.getElementById('idcliente2').value = users.value;
        document.getElementById('points2').value = valorActividad;
        document.getElementById('idlibro2').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit2-act2', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act2').modal('hide');
        return true;
    } else {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }


});
document.getElementById("unit2-act3").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    //Llenar arreglo de inputs y se verifica que haya seleccionado al menos una de cada línea
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('select-act3-' + (i + 1)).value;
        console.log(inputs[i])
    }
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;

    } else {
        var libro = 4;
        document.getElementById('idcliente3').value = users.value;
        document.getElementById('points3').value = valorActividad;
        document.getElementById('idlibro3').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit2-act3', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act3').modal('hide');
        return true;
    }


});

document.getElementById('unit2-act4').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["ORANGE JUICE", "GLASS OF WATER", "GLASS OF MILK", "SODA", "CUP OF TEA", "MILK SHAKE", "TOMATO JUICE", "CUP OF COFFEE", "HOT CHOCOLATE", "LEMONADE"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('input-act4-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 10; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act4', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act4').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act4', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act4').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act5').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["PINEAPPLE", "COCONUT", "BANANA", "APPLE", "MELON", "ORANGE", "STRAWBERRY", "ZAPOTE", "GRAPE", "PEAR", "LEMON", "JOCOTE", "MANGO"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 13; i++) {
        inputs[i] = document.getElementById('input-act5-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 13; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act5', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act5').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act5', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act5').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act6').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["CARROT", "CUCUMBER", "CAULIFLOWER", "CABBAGE", "CORN", "POTATO", "TOMATO", "LETTUCE", "RADISH", "ONION"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 10; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act6', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act6').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act6', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act6').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act7').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["1", "1", "1", "1", "2", "2", "2", "2", "2", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 10; i++) {
        inputs[i] = document.getElementById('select-act7-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 10; i++) {
            if (inputs[i] == respuestas[i]) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = valorActividad;
            document.getElementById('idlibro7').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act7', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act7').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente7').value = users.value;
            document.getElementById('points7').value = points;
            document.getElementById('idlibro7').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act7', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act7').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act8').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('box-act8-' + (i + 1));
        if (inputs[i].querySelector('#option-act8-' + (i + 1)) !== null) {
            conteo++;
        }

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = valorActividad;
            document.getElementById('idlibro8').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act8', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act8').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente8').value = users.value;
            document.getElementById('points8').value = points;
            document.getElementById('idlibro8').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act8', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit2Act8').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act8

for (let i = 0; i < 20; i++) {
    document.getElementById('option-act8-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act40
for (let i = 0; i < 20; i++) {
    document.getElementById('box-act8-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act8-' + (i + 1));

        //Se verifica que el espacio que recibe el texto no posee otro texto actualmente.
        if (!(e.target.children.length > 0) && (e.target.id == ('box-act8-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        } else if (box.children.length > 0) {
            //Si el espacio ya tiene algún elemento, se intercambian los lugares del elemento que se arrastró
            let currId = $(box).children("div").attr("id");
            let newId = e.dataTransfer.getData("id");
            let newParent = document.getElementById(newId).parentNode;
            newParent.appendChild(document.getElementById(currId));
            box.appendChild(document.getElementById(newId));

        }

    });

    document.getElementById('box-act8-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit2-act9').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["FORTY-ONE", "FORTY-TWO", "FORTY-THREE", "FORTY-FOUR", "FORTY-FIVE", "FORTY-SIX", "FORTY-SEVEN", "FORTY-EIGHT", "FORTY-NINE", "FIFTY", "FIFTY-ONE", "FIFTY-TWO", "FIFTY-THREE", "FIFTY-FOUR", "FIFTY-FIVE", "FIFTY-SIX", "FIFTY-SEVEN", "FIFTY-EIGHT", "FIFTY-NINE", "SIXTY"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 20; i++) {
        inputs[i] = document.getElementById('input-act9-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 20; i++) {
            if (inputs[i].trim().toUpperCase().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = valorActividad;
            document.getElementById('idlibro9').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act9', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act9').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente9').value = users.value;
            document.getElementById('points9').value = points;
            document.getElementById('idlibro9').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act9', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act9').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act10').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["1", "2", "1", "3", "3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('select-act10-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 6; i++) {
            if (inputs[i] == respuestas[i]) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = valorActividad;
            document.getElementById('idlibro10').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act10', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act10').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente10').value = users.value;
            document.getElementById('points10').value = points;
            document.getElementById('idlibro10').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act10', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act10').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act11').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["10", "5", "3", "7"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('input-act11-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 4; i++) {
            if (inputs[i].trim().includes(respuestas[i])) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = valorActividad;
            document.getElementById('idlibro11').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act11', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act11').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente11').value = users.value;
            document.getElementById('points11').value = points;
            document.getElementById('idlibro11').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act11', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act11').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act12').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act12-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente12').value = users.value;
        document.getElementById('points12').value = valorActividad;
        document.getElementById('idlibro12').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit2-act12', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act12').modal('hide');
        return true;
    }
});

document.getElementById('unit2-act13').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act13-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        var libro = 4;
        document.getElementById('idcliente13').value = users.value;
        document.getElementById('points13').value = valorActividad;
        document.getElementById('idlibro13').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit2-act13', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act13').modal('hide');
        return true;
    }
});

paper.install(window);

window.onload = function () {

    // Set it up
    paper.setup('canvas14');
    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker14 = document.getElementById("colorPicker14");
    let widthStrokePicker14 = document.getElementById("strokeWidthPicker14");
    let clearButton14 = document.getElementById("clearButton14");

    // Clear event listener
    clearButton14.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker14.value;
        widthStroke = widthStrokePicker14.value;
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

$('#ModalUnit2Act14').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas14');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker14 = document.getElementById("colorPicker14");
    let widthStrokePicker14 = document.getElementById("strokeWidthPicker14");
    let clearButton14 = document.getElementById("clearButton14");

    // Clear event listener
    clearButton14.addEventListener("click", function () {
        // Clear canvas2
        paper.project.activeLayer.removeChildren();
        paper.view.draw();
        document.getElementById("verify-canvas").value = 0;
    });

    // Update 
    function update() {
        colorStroke = colorPicker14.value;
        widthStroke = widthStrokePicker14.value;
    }

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit2-act14').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 1;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw your prefered menu', null);
        return false;
    }
    else {
        let points = valorActividad;
        let libro = 4;
        document.getElementById('idcliente14').value = users.value;
        document.getElementById('points14').value = points;
        document.getElementById('idlibro14').value = libro;
        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit2-act14', 'modal');
        sweetAlert(1, 'Good job!', null);
        $('#ModalUnit2Act14').modal('hide');
        return true;
    }

});

document.getElementById('unit2-act15').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 4; i++) {
        inputs[i] = document.getElementById('box-act15-' + (i + 1));

        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //Verificar foods
    for (let i = 1; i < 18; i++) {
        if (inputs[0].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar fruits
    for (let i = 18; i < 29; i++) {
        if (inputs[1].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar drinks
    for (let i = 29; i < 37; i++) {
        if (inputs[2].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }
    }

    //Verificar vegetables
    for (let i = 37; i < 43; i++) {
        if (inputs[3].querySelector('#option-act15-' + (i)) !== null) {
            conteo++;
        }

    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == 42) {
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = valorActividad;
            document.getElementById('idlibro15').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act15', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act15').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente15').value = users.value;
            document.getElementById('points15').value = points;
            document.getElementById('idlibro15').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act15', 'modal');
            sweetAlert(4, conteo + '/42 answers right', null);
            $('#ModalUnit2Act15').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act8

for (let i = 0; i < 42; i++) {
    document.getElementById('option-act15-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act40
for (let i = 0; i < 4; i++) {
    document.getElementById('box-act15-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act15-' + (i + 1));

        //Se verifica que sea el espacio para el texto.
        if ((e.target.id == ('box-act15-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        }

    });

    document.getElementById('box-act15-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit2-act16').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 7; i++) {
        inputs[i] = document.getElementById('box-act16-' + (i + 1));
        if (inputs[i].querySelector('#option-act16-' + (i + 1)) !== null) {
            conteo++;
        }
        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = valorActividad;
            document.getElementById('idlibro16').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act16', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act16').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente16').value = users.value;
            document.getElementById('points16').value = points;
            document.getElementById('idlibro16').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act16', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit2Act16').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act8

for (let i = 0; i < 7; i++) {
    document.getElementById('option-act16-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act40
for (let i = 0; i < 7; i++) {
    document.getElementById('box-act16-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act16-' + (i + 1));

        //Se verifica que el espacio que recibe el texto no posee otro texto actualmente.
        if (!(e.target.children.length > 0) && (e.target.id == ('box-act16-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        } else if (box.children.length > 0) {
            //Si el espacio ya tiene algún elemento, se intercambian los lugares del elemento que se arrastró
            let currId = $(box).children("div").attr("id");
            let newId = e.dataTransfer.getData("id");
            let newParent = document.getElementById(newId).parentNode;
            newParent.appendChild(document.getElementById(currId));
            box.appendChild(document.getElementById(newId));

        }

    });

    document.getElementById('box-act16-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit2-act17').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('box-act17-' + (i + 1));
        if (inputs[i].querySelector('#option-act17-' + (i + 1)) !== null) {
            conteo++;
        }
        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = valorActividad;
            document.getElementById('idlibro17').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act17', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act17').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente17').value = users.value;
            document.getElementById('points17').value = points;
            document.getElementById('idlibro17').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act17', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit2Act17').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act17

for (let i = 0; i < 6; i++) {
    document.getElementById('option-act17-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act17
for (let i = 0; i < 6; i++) {
    document.getElementById('box-act17-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act17-' + (i + 1));

        //Se verifica que el espacio que recibe el texto no posee otro texto actualmente.
        if (!(e.target.children.length > 0) && (e.target.id == ('box-act17-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        } else if (box.children.length > 0) {
            //Si el espacio ya tiene algún elemento, se intercambian los lugares del elemento que se arrastró
            let currId = $(box).children("div").attr("id");
            let newId = e.dataTransfer.getData("id");
            let newParent = document.getElementById(newId).parentNode;
            newParent.appendChild(document.getElementById(currId));
            box.appendChild(document.getElementById(newId));

        }

    });

    document.getElementById('box-act17-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit2-act18').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["BASEBALL", "BASKETBALL", "SOFTBALL", "FISHING", "SURFING", "VOLLEYBALL"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act18-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 6; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = valorActividad;
            document.getElementById('idlibro18').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act18', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act18').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente18').value = users.value;
            document.getElementById('points18').value = points;
            document.getElementById('idlibro18').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act18', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act18').modal('hide');
            return true;
        }
    }
});

document.getElementById('unit2-act19').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    let conteo = 0;
    let vacio = false;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar los datos ingresados.
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('box-act19-' + (i + 1));
        if (inputs[i].querySelector('#option-act19-' + (i + 1)) !== null) {
            conteo++;
        }
        if (!(inputs[i].children.length > 0)) {
            vacio = true;
        }
    }

    //declaración de condicionales 
    if (vacio == true) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = valorActividad;
            document.getElementById('idlibro19').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act19', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act19').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente19').value = users.value;
            document.getElementById('points19').value = points;
            document.getElementById('idlibro19').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act19', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length + ' answers right', null);
            $('#ModalUnit2Act19').modal('hide');
            return true;
        }
    }
});

//Elementos arrastrables act19

for (let i = 0; i < 6; i++) {
    document.getElementById('option-act19-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
};

//Elementos que reciben el arrastrable act19
for (let i = 0; i < 6; i++) {
    document.getElementById('box-act19-' + (i + 1)).addEventListener("drop", (e) => {
        //Id del espacio que recibe el texto
        let box = document.getElementById('box-act19-' + (i + 1));

        //Se verifica que el espacio que recibe el texto no posee otro texto actualmente.
        if (!(e.target.children.length > 0) && (e.target.id == ('box-act19-' + (1 + i)))) {

            e.target.classList.remove("hover");
            const id = e.dataTransfer.getData("id");
            e.target.appendChild(document.getElementById(id));

        } else if (box.children.length > 0) {
            //Si el espacio ya tiene algún elemento, se intercambian los lugares del elemento que se arrastró
            let currId = $(box).children("div").attr("id");
            let newId = e.dataTransfer.getData("id");
            let newParent = document.getElementById(newId).parentNode;
            newParent.appendChild(document.getElementById(currId));
            box.appendChild(document.getElementById(newId));

        }

    });

    document.getElementById('box-act19-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
};

document.getElementById('unit2-act20').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["SPINNING TOP", "HOPSCOTCH", "JUMP ROPE", "MARBLES", "YO-YO", "HIDE AND SEEK"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 6; i++) {
        inputs[i] = document.getElementById('input-act20-' + (i + 1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        let conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < 6; i++) {
            for (let j = 0; j < respuestas.length; j++) {
                if (inputs[i].trim().toUpperCase().includes(respuestas[j])) {
                    conteo++;
                    respuestas[j] = "~";
                }
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = valorActividad;
            document.getElementById('idlibro20').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act20', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act20').modal('hide');
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente20').value = users.value;
            document.getElementById('points20').value = points;
            document.getElementById('idlibro20').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act20', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length + ' answers right', null);
            $('#ModalUnit2Act20').modal('hide');
            return true;
        }
    }
});

$('#ModalUnit2Act21').on('shown.bs.modal', function (e) {
    document.getElementById("verify-canvas").value = 0;
    // Set it up
    paper.setup('canvas21');
    if (intervalo) {
        clearInterval(intervalo);
    }
    // Get elements from DOM and define properties
    let colorPicker21 = document.getElementById("colorPicker21");
    let widthStrokePicker21 = document.getElementById("strokeWidthPicker21");
    let clearButton21 = document.getElementById("clearButton21");

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

    // Check for new color2 value each second
    intervalo = setInterval(update, 1000);
});

document.getElementById('unit2-act21').addEventListener('submit', function (event) {

    //valor de la actividad
    let valorActividad = 1;
    //Arreglo para los datos ingresados
    inputs = [];
    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 2; i++) {
        inputs[i] = document.getElementById('input-act21-' + (i + 1)).value;
    }

    // declaración de condicionales
    
    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw your preferences about sports', null);
        return false;
    }else {
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        }else {
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente21').value = users.value;
            document.getElementById('points21').value = points;
            document.getElementById('idlibro21').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit2-act21', 'modal');
            sweetAlert(1, 'Good job!', null);
            $('#ModalUnit2Act21').modal('hide');
            return true;
        }
    }
});