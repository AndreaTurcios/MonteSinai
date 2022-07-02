const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';
document.addEventListener('DOMContentLoaded', function () {

});
/**************************************************
 ******************** GAME 107 ********************
 **************************************************/
[
    'mexican',
    'ecuadorian',
    'argentine',
    'venezuelan',
    'american',
    'brazilian',
     'peruvian',
    'bolivian'
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

document.getElementById("game-107").addEventListener("submit", function (event) {
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
      document.getElementById("idcliente107").value = users.value;
      document.getElementById("points107").value = notatotal;
      document.getElementById("idlibro107").value = libro;
      action = "createact107";
      //console.log("idcliente" + users.value);
      //console.log("idcliente" + notatotal);
      //console.log("libro" + libro);
      //function saveRowActivity(api, action, form, modal) en componente.js helper
      saveRowActivity(API_ACTIVIDADES, action, "game-107", "ModalLibroSeis107");
      sweetAlert(1, "Resultados ingresados", null);
    }
  
    return true;
  });
