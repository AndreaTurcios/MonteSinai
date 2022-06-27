//Canvas

paper.install(window);

$(window).on('load', function() {
// Set it up
    paper.setup('canvas1');

var canvas1 = document.getElementById("canvas1");

const context = canvas1.getContext('2d');

    // Create a simple drawing tool:
    var tool = new Tool();
    var path;

// Get elements from DOM and define properties
var colorPicker = document.getElementById("colorPicker");
var colorStroke;
var widthStrokePicker = document.getElementById("strokeWidthPicker");
var widthStroke;
var clearButton = document.getElementById("clearBtn");

// Clear event listener
clearBtn.addEventListener("click", function() {
// Clear canvas1
paper.project.activeLayer.removeChildren();
paper.view.draw();
});

// Update 
function update() {
colorStroke = colorPicker.value;
widthStroke = widthStrokePicker.value;
}

// Check for new color value each second
setInterval(update, 1000);

    // Define a mousedown and mousedrag handler
    tool.onMouseDown = function(event) {
        path = new Path();
path.strokeWidth = widthStroke;
        path.strokeColor = colorStroke;
// Draw
        path.add(event.point);
    }

    tool.onMouseDrag = function(event) {
// Draw
        path.add(event.point);
    }
});
