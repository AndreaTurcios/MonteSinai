const API_ACTIVIDADES = "../../app/api/proceso_libro.php?action=";
document.addEventListener("DOMContentLoaded", function () {});
/**************************************************
 ******************** GAME 91 **********************
 **************************************************/
 [
    //'woman',
    //'watermelon',
    //'vegetables',
    'supermarket',
    //'responsibility',
    'quater',
    'money',
    'fruits',
    //'food',
    'bakery',
    'bananas',
    'chicken'
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

document.getElementById('game-91').addEventListener('submit',function(event){
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
      console.log("Total de palabras" + totalPalabras.length);
      totalPunto = encontradas.length * punto;
      console.log("Total de puntos " + totalPunto);
      //console.log("Total de puntos " + punto);
      var notatotal = totalPunto.toFixed(2);
      var libro = 6;
      document.getElementById("idcliente91").value = users.value;
      document.getElementById("points91").value = notatotal;
      document.getElementById("idlibro91").value = libro;
      action = "createact91";
      //console.log("idcliente" + users.value);
      //console.log("idcliente" + notatotal);
      //console.log("libro" + libro);
      //function saveRowActivity(api, action, form, modal) en componente.js helper
      saveRowActivity(API_ACTIVIDADES, action, "game-91", "ModalLibroSeis91");
      sweetAlert(1, "Resultados ingresados", null);
    }
  
    return true;
});

/**************************************************
 ******************** GAME 109 ********************
 **************************************************/
[
    'activities',
    'afternoon',
    'breakfast',
    'daily',
    'expressiones',
    'homework'

].map(word2 => wordfind2Game2.insertWordBefore($('#add-word-36').parent(), word2));

function recreate2() {
    $('#result-message').removeClass();
    var fillBlanks, game;
    try {
        game = new wordfind2Game2('#puzzle-36', {
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
    wordfind2.print(game);
    if (window.game) {
        var emptySquaresCount = wordfind2Game2.emptySquaresCount();
        $('#result-message').text(`😃 ${emptySquaresCount ? 'but there are empty squares' : ''}`).css({
            color: ''
        });
    }
    window.game = game;
}
recreate2();

document.getElementById("game-109").addEventListener("submit", function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    //console.log(event);
    var verificarSummit = event.submitter.dataset.tooltip;
    //console.log(event.submitter.dataset.tooltip);
    //console.log("respuesta ");
    event.preventDefault();
    if (verificarSummit == "Guardar") {
      var encontradas = document.getElementsByClassName("wordFound2");
      var totalPalabras = document.getElementsByClassName("word2");
      let punto = 1 / totalPalabras.length;
      let totalPunto = 0;
  
      //console.log(encontradas.length);
      console.log("Total de palabras" + totalPalabras.length);
      totalPunto = encontradas.length * punto;
      console.log("Total de puntos " + totalPunto);
      console.log("Total de puntos " + punto);
      var notatotal = totalPunto.toFixed(2);
      var libro = 6;
      document.getElementById("idcliente109").value = users.value;
      document.getElementById("points109").value = notatotal;
      document.getElementById("idlibro109").value = libro;
      action = "createact109";
      //console.log("idcliente" + users.value);
      //console.log("idcliente" + notatotal);
      //console.log("libro" + libro);
      //function saveRowActivity(api, action, form, modal) en componente.js helper
      saveRowActivity(API_ACTIVIDADES, action, "game-109", "ModalLibroSeis109");
      sweetAlert(1, "Resultados ingresados", null);
    }
  
    return true;
  });


