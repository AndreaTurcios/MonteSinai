const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';
document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-one').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se declaran las variables segun el numero de campos, a evaluar.
    let a, b, d, e, f, h, i, j, l, n, o, q, r, t, u, w, x, z;

    //Se igualan las variables a el campo de texto de la vista mediante el id.
    a  = document.getElementById('input-abc-a').value;
    b  = document.getElementById('input-abc-b').value;
    d  = document.getElementById('input-abc-d').value;
    e  = document.getElementById('input-abc-e').value;
    f  = document.getElementById('input-abc-f').value;
    h  = document.getElementById('input-abc-h').value;
    i  = document.getElementById('input-abc-i').value;
    j  = document.getElementById('input-abc-j').value;
    l  = document.getElementById('input-abc-l').value;
    n  = document.getElementById('input-abc-n').value;
    o  = document.getElementById('input-abc-o').value;
    q  = document.getElementById('input-abc-q').value;
    r  = document.getElementById('input-abc-r').value;
    t  = document.getElementById('input-abc-t').value;
    u  = document.getElementById('input-abc-u').value;
    w  = document.getElementById('input-abc-w').value;
    x  = document.getElementById('input-abc-x').value;
    z  = document.getElementById('input-abc-z').value;

    /**
     * 18 letras del alfabeto 
     * 1 punto
     * Cada letra 1/18 = 0.056
     */
    let puntoLetra = 1/18;
    let totalPunto = 0;

    console.log("entro a la funcion ");
    console.log("entro " + a);
    console.log("entro " + a.toUpperCase());
    console.log("entro " + a.toUpperCase().localeCompare("A"));

    if(a.toUpperCase().localeCompare("A")==0){
            totalPunto =  totalPunto + puntoLetra;
        console.log("Total " + totalPunto );
    }

    if(b.toUpperCase().localeCompare("B")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(d.toUpperCase().localeCompare("D")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(e.toUpperCase().localeCompare("E")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(f.toUpperCase().localeCompare("F")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(h.toUpperCase().localeCompare("H")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(i.toUpperCase().localeCompare("I")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(j.toUpperCase().localeCompare("J")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(l.toUpperCase().localeCompare("L")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(n.toUpperCase().localeCompare("N")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(o.toUpperCase().localeCompare("O")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(q.toUpperCase().localeCompare("Q")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(r.toUpperCase().localeCompare("R")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }
    
    if(t.toUpperCase().localeCompare("T")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(u.toUpperCase().localeCompare("U")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(w.toUpperCase().localeCompare("W")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(x.toUpperCase().localeCompare("X")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    if(z.toUpperCase().localeCompare("Z")==0){
        totalPunto =  totalPunto + puntoLetra;
    console.log("Total " + totalPunto );
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 5;
    document.getElementById('idcliente').value = users.value;
    document.getElementById('points').value = notatotal;
    document.getElementById('idlibro').value = libro;
    action = 'create';
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, 'game-one', 'ModalLibroCinco1');
    sweetAlert(1, 'Resultados ingresados' + users.value + 'sera', null);
    return true;


});

document.getElementById('game-three').addEventListener('submit',function(event){
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se declaran las variables segun el numero de campos, a evaluar.
    let req1, req2, req3, req4, req5, req6, req7, req8, req9, req10,
        req11, req12, req13, req14, req15, req16, req17, req18, req19, req20,
        req21, req22, req23, req24, req25, req26;

    req1  = document.getElementById('pag8-req1').value;
    req2  = document.getElementById('pag8-req2').value;
    req3  = document.getElementById('pag8-req3').value;
    req4  = document.getElementById('pag8-req4').value;
    req5  = document.getElementById('pag8-req5').value;
    req6  = document.getElementById('pag8-req6').value;
    req7  = document.getElementById('pag8-req7').value;
    req8  = document.getElementById('pag8-req8').value;
    req9  = document.getElementById('pag8-req9').value;
    req10  = document.getElementById('pag8-req10').value;

    req11  = document.getElementById('pag8-req11').value;
    req12  = document.getElementById('pag8-req12').value;
    req13  = document.getElementById('pag8-req13').value;
    req14  = document.getElementById('pag8-req14').value;
    req15  = document.getElementById('pag8-req15').value;
    req16  = document.getElementById('pag8-req16').value;
    req17  = document.getElementById('pag8-req17').value;
    req18  = document.getElementById('pag8-req18').value;
    req19  = document.getElementById('pag8-req19').value;
    req20  = document.getElementById('pag8-req20').value;

    req21  = document.getElementById('pag8-req21').value;
    req22  = document.getElementById('pag8-req22').value;
    req23  = document.getElementById('pag8-req23').value;
    req24  = document.getElementById('pag8-req24').value;
    req25  = document.getElementById('pag8-req25').value;
    req26  = document.getElementById('pag8-req26').value;

     //Se crea un array con las posibles respuestas en base al texto del libro (Palabras clave)
     let respuestas = ["WINDOWS", "MAP", "CLOCK", "WHITE BOARD", "PENCIL SHARPENER", "SCISSORS",
     "RULER", "GLUE", "BOOKCASE", "CRAYON", "TABLE", "CHAIR", "BOOK BAG", "STUDENT", "NOTEBOOK",
     "PENCIL", "PAPER", "DESK", "MARKER", "BOOK", "PEN", "DOOR", "ERASER","CHALK", "TEACHER", "BLACKBOARD" ];
    
     let arraytotal =  [req1, req2, req3, req4, req5, req6, req7, req8, req9, req10,
                        req11, req12, req13, req14, req15, req16, req17, req18, req19, req20,
                        req21, req22, req23, req24, req25, req26];
    
    let punto = 1/26;
    let totalPunto = 0;


    for (var j = 0; j < respuestas.length ; j++){
        for (var i = 0; i < arraytotal.length; i++) {
            //console.log("respuesta " + respuestas[j]);
            //console.log("iput " +arraytotal[i]);
            //console.log("iput " +respuestas[j].toUpperCase().localeCompare(arraytotal[i]));
            if (respuestas[j].localeCompare(arraytotal[i].toUpperCase()) == 0) {
            //if (respuestas[j].toUpperCase().localeCompare(arraytotal[i]) == 0) {
                totalPunto = totalPunto + punto;
                i = arraytotal.length;
            }
        } 
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 5;
    document.getElementById('idcliente3').value = users.value;
    document.getElementById('points3').value = notatotal;
    document.getElementById('idlibro3').value = libro;
    action = 'create3';
    console.log("idcliente" + users.value);
    console.log("idcliente" + notatotal);
    console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, 'game-three', 'ModalLibroCinco3');
    sweetAlert(1, 'Resultados ingresados' + users.value + 'TOTAL' + notatotal + 'sera', null);
    return true;

    
});

document.getElementById('game-7').addEventListener('submit', function(event){
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //Se declaran las variables segun el numero de campos, a evaluar.

    let punto = 1/26;
    let totalPunto = 0;

    var notatotal = totalPunto.toFixed(2);
    var libro = 5;
    document.getElementById('idcliente7').value = users.value;
    document.getElementById('points7').value = notatotal;
    document.getElementById('idlibro7').value = libro;
    action = 'create7';
    console.log("idcliente" + users.value);
    console.log("idcliente" + notatotal);
    console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, 'game-7', 'ModalLibroCinco7');
    sweetAlert(1, 'Resultados ingresados' + users.value + 'TOTAL' + notatotal + 'sera', null);
    return true;
});

/**************************************************
 ******************** GAME 23 **********************
 **************************************************/
 [
    'hello',
    'goodbye',
    'morning',
    'midday',
    'afternoon',
    'greeting'
].map(word => WordFindGame.insertWordBefore($('#add-word').parent(), word));

function recreate() {
    $('#result-message').removeClass();
    var fillBlanks, game;
    try {
        game = new WordFindGame('#puzzle', {
            allowedMissingWords: +$('#allowed-missing-words').val(),
            maxGridGrowth: +$('#max-grid-growth').val(),
            fillBlanks: fillBlanks,
            maxAttempts: 100,
        });
    } catch (error) {
        $('#result-message').text(`😞 ${error}, try to specify less ones`).css({
            color: 'red'
        });
        return;
    }
    wordfind.print(game);
    if (window.game) {
        var emptySquaresCount = WordFindGame.emptySquaresCount();
        $('#result-message').text(`😃 ${emptySquaresCount ? 'but there are empty squares' : ''}`).css({
            color: ''
        });
    }
    window.game = game;
}
recreate();

document.getElementById("game-23").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    //console.log(event);
    var verificarSummit = event.submitter.dataset.tooltip;
    //console.log(event.submitter.dataset.tooltip);
    //console.log("respuesta ");
    event.preventDefault();
    if (verificarSummit == "Guardar") {
      var encontradas = document.getElementsByClassName("wordFound1");
      var totalPalabras = document.getElementsByClassName("word1");
      let punto = 1 / totalPalabras.length;
      let totalPunto = 0;
  
      //console.log(encontradas.length);
      //console.log("Total de palabras" + totalPalabras.length);
      totalPunto = encontradas.length * punto;
      //console.log("Total de puntos " + totalPunto);
      //console.log("Total de puntos " + punto);
      var notatotal = totalPunto.toFixed(2);
      var libro = 5;
      document.getElementById("idcliente23").value = users.value;
      document.getElementById("points23").value = notatotal;
      document.getElementById("idlibro23").value = libro;
      action = "createact23";
      //console.log("idcliente" + users.value);
      //console.log("idcliente" + notatotal);
      //console.log("libro" + libro);
      //function saveRowActivity(api, action, form, modal) en componente.js helper
      saveRowActivity(API_ACTIVIDADES, action, "game-23", "ModalLibroSeis23");
      sweetAlert(1, "Resultados ingresados", null);
    }
  
    return true;
  });

  /**************************************************
 ******************** GAME 43 **********************
 **************************************************/
 document.getElementById("game-43").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //console.log(event);
    /* var verificarSummit = event.submitter.dataset.tooltip;
    if (verificarSummit == "Guardar") {
    }*/
    /**Fila 1*/
    let game_43_f1c9 = document.getElementById("game-43-f1c9").value ;
    /**Fila  2*/
    let game_43_f2c9 = document.getElementById("game-43-f2c9").value ;
    /**Fila 3*/
    let game_43_f3c9 = document.getElementById("game-43-f3c9").value ;
    /**Fila 4*/
    let game_43_f4c8 = document.getElementById("game-43-f4c8").value ;
    let game_43_f4c9 = document.getElementById("game-43-f4c9").value ;
    let game_43_f4c10 = document.getElementById("game-43-f4c10").value ;
    let game_43_f4c11 = document.getElementById("game-43-f4c11").value ;
    let game_43_f4c12 = document.getElementById("game-43-f4c12").value ;
    let game_43_f4c13 = document.getElementById("game-43-f4c13").value ;
    let game_43_f4c14 = document.getElementById("game-43-f4c14").value ;
    let game_43_f4c15 = document.getElementById("game-43-f4c15").value ;
    let game_43_f4c16 = document.getElementById("game-43-f4c16").value ;
    /**Fila 5*/
    let game_43_f5c9 = document.getElementById("game-43-f5c9").value ;
    /**Fila 6*/
    let game_43_f6c9 = document.getElementById("game-43-f6c9").value ;
    let game_43_f6c12 = document.getElementById("game-43-f6c12").value ;
    let game_43_f6c13 = document.getElementById("game-43-f6c13").value ;
    let game_43_f6c14 = document.getElementById("game-43-f6c14").value ;
    let game_43_f6c15 = document.getElementById("game-43-f6c15").value ;
    let game_43_f6c16 = document.getElementById("game-43-f6c16").value ;
    /**Fila 7*/
    let game_43_f7c6 = document.getElementById("game-43-f7c6").value ;
    let game_43_f7c9 = document.getElementById("game-43-f7c9").value ;
    /**Fila 8*/
    let game_43_f8c3 = document.getElementById("game-43-f8c3").value ;
    let game_43_f8c4 = document.getElementById("game-43-f8c4").value ;
    let game_43_f8c5 = document.getElementById("game-43-f8c5").value ;
    let game_43_f8c6 = document.getElementById("game-43-f8c6").value ;
    let game_43_f8c7 = document.getElementById("game-43-f8c7").value ;
    let game_43_f8c8 = document.getElementById("game-43-f8c8").value ;
    let game_43_f8c9 = document.getElementById("game-43-f8c9").value ;
    let game_43_f8c12 = document.getElementById("game-43-f8c12").value ;
    let game_43_f8c13 = document.getElementById("game-43-f8c13").value ;
    let game_43_f8c14 = document.getElementById("game-43-f8c14").value ;
    /**Fila 9*/
    let game_43_f9c6 = document.getElementById("game-43-f9c6").value ;
    let game_43_f9c8 = document.getElementById("game-43-f9c8").value ;
    let game_43_f9c13 = document.getElementById("game-43-f9c13").value ;
    /**Fila 10*/
    let game_43_f10c6 = document.getElementById("game-43-f10c6").value ;
    let game_43_f10c8 = document.getElementById("game-43-f10c8").value ;
    let game_43_f10c13 = document.getElementById("game-43-f10c13").value ;
    /**Fila 11*/
    let game_43_f11c6 = document.getElementById("game-43-f11c6").value ;
    let game_43_f11c8 = document.getElementById("game-43-f11c8").value ;
    let game_43_f11c12 = document.getElementById("game-43-f11c12").value ;
    let game_43_f11c13 = document.getElementById("game-43-f11c13").value ;
    let game_43_f11c14 = document.getElementById("game-43-f11c14").value ;
    let game_43_f11c15 = document.getElementById("game-43-f11c15").value ;
    /**Fila 12*/
    let game_43_f12c6 = document.getElementById("game-43-f12c6").value ;
    let game_43_f12c8 = document.getElementById("game-43-f12c8").value ;
    let game_43_f12c13 = document.getElementById("game-43-f12c13").value ;
    /**Fila 13 */
    let game_43_f13c6 = document.getElementById("game-43-f13c6").value ;
    let game_43_f13c8 = document.getElementById("game-43-f13c8").value ;
    let game_43_f13c13 = document.getElementById("game-43-f13c13").value ;
    /**Fila 14*/
    let game_43_f14c1 = document.getElementById("game-43-f14c1").value ;
    let game_43_f14c2 = document.getElementById("game-43-f14c2").value ;
    let game_43_f14c3 = document.getElementById("game-43-f14c3").value ;
    let game_43_f14c4 = document.getElementById("game-43-f14c4").value ;
    let game_43_f14c5 = document.getElementById("game-43-f14c5").value ;
    let game_43_f14c6 = document.getElementById("game-43-f14c6").value ;
    let game_43_f14c7 = document.getElementById("game-43-f14c7").value ;
    let game_43_f14c8 = document.getElementById("game-43-f14c8").value ;
    /**Fila 15*/
    let game_43_f15c1 = document.getElementById("game-43-f15c1").value ;
    let game_43_f15c5 = document.getElementById("game-43-f15c5").value ;
    let game_43_f15c8 = document.getElementById("game-43-f15c8").value ;
    /**Fila 16*/
    let game_43_f16c1 = document.getElementById("game-43-f16c1").value ;
    let game_43_f16c5 = document.getElementById("game-43-f16c5").value ;
    let game_43_f16c8 = document.getElementById("game-43-f16c8").value ;
    /**Fila 17*/
    let game_43_f17c1 = document.getElementById("game-43-f17c1").value ;
    let game_43_f17c5 = document.getElementById("game-43-f17c5").value ;
    /**Fila 18*/
    let game_43_f18c5 = document.getElementById("game-43-f18c5").value ;

    /**Horizontal */
    let palabra1 = game_43_f4c8+ game_43_f4c9 +game_43_f4c10+game_43_f4c11 + game_43_f4c12 +game_43_f4c13 + game_43_f4c14 +game_43_f4c15 + game_43_f4c16;
    let palabra2 = game_43_f8c3 + game_43_f8c4 + game_43_f8c5 + game_43_f8c6 + game_43_f8c7 + game_43_f8c8 + game_43_f8c9;
    let palabra3 = game_43_f6c12 + game_43_f6c13 + game_43_f6c14 + game_43_f6c15 + game_43_f6c16;
    let palabra4 = game_43_f14c1 + game_43_f14c2  + game_43_f14c3 + game_43_f14c4 + game_43_f14c5 + game_43_f14c6+ game_43_f14c7 ;
    let palabra5 = game_43_f8c12 + game_43_f8c13 + game_43_f8c14;
    let palabra6 = game_43_f11c12 + game_43_f11c13 + game_43_f11c14+ game_43_f11c15;

    /**Vertical */
    let palabra7 = game_43_f9c8 + game_43_f10c8 + game_43_f11c8 + game_43_f12c8 + game_43_f13c8 + game_43_f14c8 + game_43_f15c8 + game_43_f16c8;
    let palabra8 = game_43_f1c9 + game_43_f2c9 + game_43_f3c9 + game_43_f4c9 + game_43_f5c9 + game_43_f6c9 + game_43_f7c9 + game_43_f8c9;
    let palabra9 = game_43_f8c13 + game_43_f9c13 + game_43_f10c13 + game_43_f11c13 + game_43_f12c13 + game_43_f13c13;
    let palabra10 = game_43_f7c6 + game_43_f8c6 + game_43_f9c6 + game_43_f10c6+ game_43_f11c6 + game_43_f12c6 + game_43_f13c6 + game_43_f14c6;
    let palabra11 = game_43_f14c1 + game_43_f15c1 + game_43_f16c1 + game_43_f17c1;
    let palabra12 = game_43_f14c5 + game_43_f15c5  + game_43_f16c5  + game_43_f17c5  + game_43_f18c5 ;

      //console.log(event.submitter.dataset.tooltip);
      console.log("PALABRA " + palabra1);
      console.log("PALABRA " + palabra2);
      console.log("PALABRA " + palabra3);
      console.log("PALABRA " + palabra4);
      console.log("PALABRA " + palabra5);
      console.log("PALABRA " + palabra6);
      console.log("PALABRA " + palabra7);
      console.log("PALABRA " + palabra8);
      console.log("PALABRA " + palabra9);
      console.log("PALABRA " + palabra10);
      console.log("PALABRA " + palabra11);
      console.log("PALABRA " + palabra12);
  
    //console.log(event.submitter.dataset.tooltip);
    //console.log("respuesta ");
    let punto = 1 /12 ;
    let totalPunto = 0;

    console.log(palabra1.toUpperCase().localeCompare('SEPTEMBER'))
    console.log(palabra1.toUpperCase());
    if(palabra1.toUpperCase()=='SEPTEMBER'){
        console.log('Entra sep');
        totalPunto = totalPunto +punto;
    }
    if(palabra2.toUpperCase()=='OCTOBER'){
        console.log('Entra oct');
        totalPunto = totalPunto +punto;
    }
    if(palabra3.toUpperCase()=='MARCH'){
        console.log('Entra marc');
        totalPunto = totalPunto +punto;
    }
    if(palabra4.toUpperCase()=='JANUARY'){
        console.log('Entra janya');
        totalPunto = totalPunto +punto;
    }
    if(palabra5.toUpperCase()=='MAY'){
        console.log('Entra may');
        totalPunto = totalPunto +punto;
    }
    if(palabra6.toUpperCase()=='JULY'){
        console.log('Entra july');
        totalPunto = totalPunto +punto;
    }
    if(palabra7.toUpperCase()=='FEBRUARY'){
        console.log('Entra february');
        totalPunto = totalPunto +punto;
    }
    console.log('imprimre' + palabra9);
    if(palabra8.toUpperCase()=='DECEMBER'){
        console.log('Entra december');
        totalPunto = totalPunto +punto;
    }
    if(palabra9.toUpperCase()=='AUGUST'){
        console.log('Entra aug');
        totalPunto = totalPunto +punto;
    }
    if(palabra10.toUpperCase()=='NOVEMBER'){
        console.log('Entra nomvember');
        totalPunto = totalPunto +punto;
    }
    if(palabra11.toUpperCase()=='JUNE'){
        console.log('Entra jun');
        totalPunto = totalPunto +punto;
    }
    if(palabra12.toUpperCase()=='APRIL'){
        console.log('Entra april');
        totalPunto = totalPunto +punto;
    }



    //console.log(encontradas.length);
    //console.log("Total de palabras" + totalPalabras.length);
    console.log("Total de puntos " + totalPunto);
    console.log("Total de puntos " + punto);
    var notatotal = totalPunto.toFixed(2);
    var libro = 5;
    document.getElementById("idcliente43").value = users.value;
    document.getElementById("points43").value = notatotal;
    document.getElementById("idlibro43").value = libro;
    action = "createact43";
    console.log("idcliente" + users.value);
    console.log("idcliente" + notatotal);
    console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-43", "ModalLibroCinco43");
    sweetAlert(1, "Resultados ingresados", null);
  
    return true;
  });

