// Check out PaperJs' Docs: http://paperjs.org/tutorials/

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
		}
	}