var canvas = document.getElementById("canvas");
var contexto=canvas.getContext("2d");

contexto.lineWidth=1;

var ruta=false;

function dibujar(evento)
{
    x=evento.clientX-canvas.offsetLeft;
    y=evento.clientY-canvas.offsetTop;

    if(ruta==true){
        contexto.lineTo(x,y);
        console.log("Posicion X:"+x+" Y:"+y)
        contexto.stroke();   
    }

}

canvas.addEventListener('mousemove', dibujar);

canvas.addEventListener('mousedown', function(){
    ruta=true;
    contexto.beginPath();
    contexto.moveTo(x,y);
    console.log("Posicion Inicial X:"+x+" Y:"+y)
    canvas.addEventListener('mousemove', dibujar);
});

canvas.addEventListener('mouseup', function(){
    ruta=false; 
});

function colorLinea(color){
    contexto.strokeStyle=color.value;
}

function anchoLinea(ancho){
    contexto.lineWidth=ancho.value;
    document.getElementById("valor").innerHTML=ancho.value;
}


function limpiar(){
    contexto.clearRect(0,0,canvas.width, canvas.height);
}