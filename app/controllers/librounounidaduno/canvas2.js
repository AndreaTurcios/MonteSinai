// Check out PaperJs' Docs: http://paperjs.org/tutorials/

paper.install(window);

	window.onload = function() {
    // Set it up
		paper.setup('canvas2');
    
    var canvas2 = document.getElementById("canvas2");
    
    const context = canvas2.getContext('2d');
    
		// Create a simple drawing tool:
		var tool = new Tool();
		var path2;
    
    // Get elements from DOM and define properties
    var colorPicker2 = document.getElementById("colorPicker2");
    var colorStroke2;
    var widthStrokePicker2 = document.getElementById("strokeWidthPicker2");
    var widthStroke2;
    var clearButton2 = document.getElementById("clearBtn2");
    
    // Clear event listener
    clearBtn2.addEventListener("click", function() {
      // Clear canvas2
      paper.project.activeLayer.removeChildren();
      paper.view.draw();
      document.getElementById("verify-canvas-2").value = 0;
    });
    
    // Update 
    function update() {
      colorStroke2 = colorPicker2.value;
      widthStroke2 = widthStrokePicker2.value;
    }
    
    // Check for new color2 value each second
    setInterval(update, 1000);
    
		// Define a mousedown and mousedrag handler
		tool.onMouseDown = function(event) {
			path2 = new Path();
      path2.strokeWidth2 = widthStroke2;
			path2.strokeColor2 = colorStroke2;
      // Draw
			path2.add(event.point);
		}

		tool.onMouseDrag = function(event) {
      // Draw
			path2.add(event.point);
      document.getElementById("verify-canvas-2").value = 1;
		}
	}