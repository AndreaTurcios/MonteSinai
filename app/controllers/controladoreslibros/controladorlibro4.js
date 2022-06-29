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
            $('#ModalUnit1Act1').modal('hide');
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
            $('#ModalUnit1Act1').modal('hide');
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
            $('#ModalUnit1Act2').modal('hide');
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
            $('#ModalUnit1Act2').modal('hide');
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
            $('#ModalUnit1Act3').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act4').addEventListener('submit', function(event) {
    //Se asignan los puntos que vale la actividad
    let valorActividad = 1;
    
    //Se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Arreglos para guardar las respuestas y los datos ingresados
    let respuestas = ["1", "3", "4", "4", "4"];
    let inputs = [];

    //Se obtienen los datos ingresados y se ingresan en inputs[]
    for (let i = 0; i < respuestas.length; i++) {
        inputs[i] = document.getElementById('select-act4-' + (i+1)).value;
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
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = valorActividad;
            document.getElementById('idlibro4').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act4', 'modal');
            sweetAlert(1, 'good job', null);
            $('#ModalUnit1Act4').modal('hide');
            return true;
        }else{
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / respuestas.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente4').value = users.value;
            document.getElementById('points4').value = points;
            document.getElementById('idlibro4').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act4', 'modal');
            sweetAlert(4, conteo + '/' + respuestas.length +' answers right', null);
            $('#ModalUnit1Act4').modal('hide');
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
            $('#ModalUnit1Act5').modal('hide');
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
            $('#ModalUnit1Act5').modal('hide');
            return true;
        }
    }    

});

document.getElementById('unit1-act6').addEventListener('submit', function(event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = [["KATHERINE IS IN THE BEDROOM", "YAELY IS AT THE KITCHEN", "THE FRIEND IS IN THE BATHROOM", "MOMMY IS IN THE LIVING ROOM", "FRANCISCO IS AT THE DINING ROOM"], ["SHE IS IN THE BEDROOM", "SHE IS AT THE KITCHEN", "HE IS IN THE BATHROOM", "SHE IS IN THE LIVING ROOM", "HE IS AT THE DINING ROOM"]]

    //Llenar arreglo de inputs
    for (let i = 0; i < 5; i++) {
        inputs[i] = document.getElementById('input-act6-' + (i+1)).value;
        
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
        //Se comparan las respuestas con los datos ingresados
        for (let i = 0; i < inputs.length; i++) {
            if (respuestas[0][i].trim() == inputs[i].toUpperCase().trim() || respuestas[0][i].trim() + "." == inputs[i].toUpperCase().trim() ||
                    respuestas[1][i].trim() == inputs[i].toUpperCase().trim() || respuestas[1][i].trim() + "." == inputs[i].toUpperCase().trim()) {
                conteo++;
            }
            
        }

        //Se revisa si todas las respuestas son correctas
        if (conteo == inputs.length) {
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = valorActividad;
            document.getElementById('idlibro6').value = libro;

            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act6', 'modal');
            sweetAlert(1, 'good job', null);
            $('#ModalUnit1Act6').modal('hide');
            return true;
        }else{
            //Se asigna el puntaje basado en las respuestas correctas
            let puntaje = valorActividad / inputs.length;
            let points = (puntaje * conteo).toFixed(2);
            var libro = 4;
            document.getElementById('idcliente6').value = users.value;
            document.getElementById('points6').value = points;
            document.getElementById('idlibro6').value = libro;
            action = 'create';
            saveRowActivity(API_ACTIVIDADES, action, 'unit1-act6', 'modal');
            sweetAlert(4, conteo + '/' + inputs.length +' answers right', null);
            $('#ModalUnit1Act6').modal('hide');
            return true;
        }
    }

});

document.getElementById('unit1-act7').addEventListener('submit', function(event) {
    //se evita recargar la página al enviar el formulario
    event.preventDefault();

    //Se asigna el valor de la actividad
    let valorActividad = 1;
    //Variable para mantener las respuestas correctas
    let conteo = 0;
    //Arreglo para guardar los datos ingresados
    let inputs = [];
    let respuestas = ["WHAT CAN I", "I CAN"]

    //Llenar arreglo de inputs
    for (let i = 0; i < 8; i++) {
        inputs[i] = document.getElementById('input-act7-' + (i+1)).value.toUpperCase();
        
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
        if(new Set(inputs).size !== inputs.length){
            sweetAlert(2, 'All questions and answers must be different', null);
            return false;
        }else{
            //Se comparan las respuestas con los datos ingresados
            for (let i = 0; i < inputs.length; i++) {
                if ((i + 1) % 2 == 1) {
                    if (inputs[i].trim().includes(respuestas[0]) && inputs[i].trim().includes("?")) {
                        conteo++;
                    }
                }else{
                    if (inputs[i].trim().includes(respuestas[1])) {
                        conteo++;
                    }
                }
                
            }

            //Se revisa si todas las respuestas son correctas
            if (conteo == inputs.length) {
                var libro = 4;
                document.getElementById('idcliente7').value = users.value;
                document.getElementById('points7').value = valorActividad;
                document.getElementById('idlibro7').value = libro;

                action = 'create';
                saveRowActivity(API_ACTIVIDADES, action, 'unit1-act7', 'modal');
                sweetAlert(1, 'good job', null);
                $('#ModalUnit1Act7').modal('hide');
                return true;
            }else{
                //Notificar que las respuestas no siguen el formato
                sweetAlert(2, 'Try again, remember to use "What can I...?" for the questions and "I can..." for the answers', null);
                return true;
            }
        }
        
    }

});

document.getElementById("unit1-act8").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se asigna el valor de la actividad
    let valorActividad = 1;

    let inputs = [];
    //Llenar arreglo de inputs
    for (let i = 0; i < 13; i++) {
        inputs[i] = document.getElementById('text-act8-' + (i+1)).innerHTML;
        
    }

    if (inputs.includes("")) {
        sweetAlert(2, 'Complete the missing fields', null);
        return false;
    }else{
        var libro = 4;
        document.getElementById('idcliente8').value = users.value;
        document.getElementById('points8').value = valorActividad;
        document.getElementById('idlibro8').value = libro;

        action = 'create';
        saveRowActivity(API_ACTIVIDADES, action, 'unit1-act8', 'modal');
        sweetAlert(1, 'good job', null);
        $('#ModalUnit1Act8').modal('hide');
        return true;
        
    }

  });
  


//Elementos arrastrables act8

for (let i = 0; i < 4; i++) {
    document.getElementById('option-act8-' + (i + 1)).addEventListener("dragstart", (e) => {
        e.dataTransfer.setData("id", e.target.id);
    });
}

//Elementos que reciben el arrastrable act8

for (let i = 0; i < 13; i++) {
    document.getElementById('text-act8-' + (i + 1)).addEventListener("drop", (e) => {
        e.target.classList.remove("hover");
        const id = e.dataTransfer.getData("id");
        e.target.innerHTML = document.getElementById(id).innerHTML;
    });
      
    document.getElementById('text-act8-' + (i + 1)).addEventListener("dragover", (e) => {
        e.preventDefault();
    });
}
