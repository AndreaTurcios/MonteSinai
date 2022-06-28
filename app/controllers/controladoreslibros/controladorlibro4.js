const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.getElementById('unit1-act1').addEventListener('submit', function (event) {
    var valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    var respuestas = ["a", "r", "a", "g", "a", "d", "e", "n", "e", "d", "r", "o", "i", "v", "i", "n", "g", "r", "o", "o", "a", "t", "h", "o", "o", "a", "r", "a", "l", "i", "n", "i", "n", "g", "o", "o", "i", "t", "c", "h"];
    var inputs = [];
    //definición de variables 
    for (let i = 0; i < 40; i++) {
        inputs[i] = document.getElementById('input-act1-' + (i+1)).value;
        console.log(inputs.length);
    }

    let promedio, promedios;
    var pt1, pt2, pt3, pt4, pt5, pt6, pt7, pt8, pt9, pt10, pt11, pt12, pt13, pt14, pt15, pt16, pt17;
    // declaración de condicionales 
    if (inputs.includes(undefined)) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
        var conteo = 0;
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }
            
        }

        if (conteo == respuestas.length) {
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = valorActividad;
            document.getElementById('idlibro').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(1, 'good job', null);
            return true;
        }else{
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente').value = users.value;
            document.getElementById('points').value = points;
            document.getElementById('idlibro').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act1', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            return true;
        }
    }
});