const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

//Unidad 5 Actividad 1
document.getElementById('unit5-act1').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["3", "2"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('act1-q' + (i+1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    } else {
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i] == inputs[i]) {
                conteo++;
            }
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == respuestas.length) {
            var libro = 8;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = valorActividad;
            document.getElementById('idlibro1').value = libro;
            console.log(valorActividad);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'ModalLibroOcho3');
            sweetAlert(1, 'good job', null);
            var ModalLibroOcho3 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho3'));
            ModalLibroOcho3.hide();
            return true;
        } else {
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 8;
            document.getElementById('idcliente1').value = users.value;
            document.getElementById('points1').value = points;
            document.getElementById('idlibro1').value = libro;
            console.log(points);
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit5-act1', 'ModalLibroOcho3');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            var ModalLibroOcho3 = bootstrap.Modal.getInstance(document.getElementById('ModalLibroOcho3'));
            ModalLibroOcho3.hide();
            return true;
        }
    }    
});
