const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.getElementById('unit1-act1').addEventListener('submit', function (event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();

    //arreglos para guardar las respuestas y los datos ingresados.
    let respuestas = ["a", "r", "a", "g", "a", "d", "e", "n", "e", "d", "r", "o", "i", "v", "i", "n", "g", "r", "o", "o", "a", "t", "h", "o", "o", "a", "r", "a", "l", "i", "n", "i", "n", "g", "o", "o", "i", "t", "c", "h"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < 40; i++) {
        inputs[i] = document.getElementById('input-act1-' + (i+1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
        //variable para obtener la cantidad de respuestas correctas
        var conteo = 0;

        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < respuestas.length; i++) {
            if (respuestas[i].toUpperCase() == inputs[i].toUpperCase()) {
                conteo++;
            }
            
        }

        //Se revisa si todas las respuestas son correctas
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
            //Se asigna el puntaje basado en las respuestas correctas
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

document.getElementById('unit1-act2').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["2", "3", "1", "2", "3", "1"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act2-' + (i+1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
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
            var libro = 4;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = valorActividad;
            document.getElementById('idlibro2').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act2', 'modal');
            sweetAlert(1, 'good job', null);
            return true;
        }else{
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente2').value = users.value;
            document.getElementById('points2').value = points;
            document.getElementById('idlibro2').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act2', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            return true;
        }
    }    

});

paper.install(window);

window.onload = function() {
   // Set it up
 	paper.setup('canvas2');
   
    var canvas2 = document.getElementById("canvas2");
   
    const context = canvas2.getContext('2d');
   
		// Create a simple drawing tool:
		var tool = new Tool();
		var path;
    
    // Get elements from DOM and define properties
    var color2Picker = document.getElementById("color2Picker");
    var color2Stroke;
    var widthStrokePicker = document.getElementById("stroke2WidthPicker");
    var widthStroke;
    var clear2Button = document.getElementById("clear2Btn");
    
    // Clear event listener
    clear2Btn.addEventListener("click", function() {
      // Clear canvas2
      paper.project.activeLayer.removeChildren();
      paper.view.draw();
      document.getElementById("verify-canvas").value = 0;
    });
    
    // Update 
    function update() {
      color2Stroke = color2Picker.value;
      widthStroke = widthStrokePicker.value;
    }
    
    // Check for new color2 value each second
    setInterval(update, 1000);
    
	// Define a mousedown and mousedrag handler
	tool.onMouseDown = function(event) {
		path = new Path();
    path.strokeWidth = widthStroke;
    	path.strokeColor = color2Stroke;
  // Draw
		path.add(event.point);
	}

	tool.onMouseDrag = function(event) {
    // Draw
		path.add(event.point);
        document.getElementById("verify-canvas").value = 1;
	}
}

document.getElementById('unit1-act3').addEventListener('submit', function(event) {

    //valor de la actividad
    let valorActividad = 1;

    //Se evita que se recargue la página al enviar el formulario
    event.preventDefault();

    //arreglo para guardar los inputs
    let inputs = [];
    //Llenar los inputs
    for (let i = 0; i < 12; i++) {
        inputs[i] = document.getElementById('input-act3-' + (i + 1)).value;
    }

    if (document.getElementById("verify-canvas").value == 0) {
        sweetAlert(2, 'Draw your house', null);
        return false;
    }
    else{
        //verificar si escribió algo
        if (inputs.includes("")) {
            sweetAlert(2, 'Complete the missing fields', null);
            return false;
        }else{
            let points = valorActividad;
            let libro = 4;
            document.getElementById('idcliente3').value = users.value;
            document.getElementById('points3').value = points;
            document.getElementById('idlibro3').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act3', 'modal');
            sweetAlert(1, 'Good job', null);
            return true;
        }
    }

});

document.getElementById('unit1-act5').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "2", "1", "3", "1", "1", "3", "2", "1", "3"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act5-' + (i+1)).value;
    }

    // declaración de condicionales 
    if (inputs.includes("0")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
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
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = valorActividad;
            document.getElementById('idlibro5').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act5', 'modal');
            sweetAlert(1, 'good job', null);
            return true;
        }else{
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente5').value = users.value;
            document.getElementById('points5').value = points;
            document.getElementById('idlibro5').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act5', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            return true;
        }
    }    

});
