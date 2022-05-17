var elementoArrastrado;

 
  document.addEventListener("drag", function( event ) {
  //console.log("drag")
  }, false);


  document.addEventListener("dragstart", function( event ) {
    // guarda información acerca del objeto arrastrado
    event.dataTransfer.setData('text/plain',null)
      // guarda una referéncia del elemento arrastrado
      elementoArrastrado = event.target;
      // cambia la opacidad del elemento a medio transparente
      event.target.style.opacity = .5;
  }, false);


  document.addEventListener("dragend", function( event ) {
      // reestablece el valor de la opacidad
      event.target.style.opacity = 1;
  }, false);

 
  document.addEventListener("dragover", function( event ) {
      // previene el comportamiento por defecto del elemento arrastrado
     event.preventDefault();
  }, false);

  document.addEventListener("dragenter", function( event ) {
      // comprueba si el event.target es una zona de soltar  
      if ( event.target.className == "zona-de-soltar" ) {
        // y di lo és cambia el color de fondo
          event.target.style.background = "purple";
      }

  }, false);

  document.addEventListener("dragleave", function( event ) {
      // comprueba si el event.target es una zona de soltar  
      if ( event.target.className == "zona-de-soltar"  ) {
        // y si lo és, reestablece el valor inicial
          event.target.style.background = "";
      }
  }, false);

  document.addEventListener("drop", function( event ) {
      // Si el elemento arrastrado es un link, este se abre en una nueve página.
      // Para que esto no pase hay que utilizar: 
      event.preventDefault();
      // comprueba si el event.target es una zona de soltar
      if ( event.target.className == "zona-de-soltar"  ) {
          // reestablece el valor inicial para el background
          event.target.style.background = "";
          // elimina el elemento arrastrado del del elemento padre
          elementoArrastrado.parentNode.removeChild( elementoArrastrado );
          // y lo agrega al elemento de destino
          event.target.appendChild( elementoArrastrado );
      }
    
  }, false);