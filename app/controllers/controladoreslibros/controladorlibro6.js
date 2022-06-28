const API_ACTIVIDADES = "../../app/api/proceso_libro.php?action=";
document.addEventListener("DOMContentLoaded", function () {});

/**************************************************
 ******************** GAME 3 **********************
 **************************************************/
document.getElementById("game-3").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-3-q1").value;
  q2 = document.getElementById("game-3-q2").value;
  q3 = document.getElementById("game-3-q3").value;
  q4 = document.getElementById("game-3-q4").value;
  q5 = document.getElementById("game-3-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "create3";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente3").value = users.value;
    document.getElementById("points3").value = notatotal;
    document.getElementById("idlibro3").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-3", "ModalLibroSeis3");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 4 **********************
 **************************************************/
document.getElementById("game-4").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-4-q1").value;
  q2 = document.getElementById("game-4-q2").value;
  q3 = document.getElementById("game-4-q3").value;
  q4 = document.getElementById("game-4-q4").value;
  q5 = document.getElementById("game-4-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact4";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente4").value = users.value;
    document.getElementById("points4").value = notatotal;
    document.getElementById("idlibro4").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-4", "ModalLibroSeis4");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 5 **********************
 **************************************************/
document.getElementById("game-5").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-5-q1").value;
  q2 = document.getElementById("game-5-q2").value;
  q3 = document.getElementById("game-5-q3").value;
  q4 = document.getElementById("game-5-q4").value;
  q5 = document.getElementById("game-5-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact5";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente5").value = users.value;
    document.getElementById("points5").value = notatotal;
    document.getElementById("idlibro5").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-5", "ModalLibroSeis5");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 6 **********************
 **************************************************/
document.getElementById("game-6").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-6-q1").value;
  q2 = document.getElementById("game-6-q2").value;
  q3 = document.getElementById("game-6-q3").value;
  q4 = document.getElementById("game-6-q4").value;
  q5 = document.getElementById("game-6-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact6";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente6").value = users.value;
    document.getElementById("points6").value = notatotal;
    document.getElementById("idlibro6").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-6", "ModalLibroSeis6");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 7 **********************
 **************************************************/
document.getElementById("game-7").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-7-q1").value;
  q2 = document.getElementById("game-7-q2").value;
  q3 = document.getElementById("game-7-q3").value;
  q4 = document.getElementById("game-7-q4").value;
  q5 = document.getElementById("game-7-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact7";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente7").value = users.value;
    document.getElementById("points7").value = notatotal;
    document.getElementById("idlibro7").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-7", "ModalLibroSeis7");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 8 **********************
 **************************************************/
document.getElementById("game-8").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-8-q1").value;
  q2 = document.getElementById("game-8-q2").value;
  q3 = document.getElementById("game-8-q3").value;
  q4 = document.getElementById("game-8-q4").value;
  q5 = document.getElementById("game-8-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact8";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente8").value = users.value;
    document.getElementById("points8").value = notatotal;
    document.getElementById("idlibro8").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-8", "ModalLibroSeis8");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 9 **********************
 **************************************************/
document.getElementById("game-9").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-9-q1").value;
  q2 = document.getElementById("game-9-q2").value;
  q3 = document.getElementById("game-9-q3").value;
  q4 = document.getElementById("game-9-q4").value;
  q5 = document.getElementById("game-9-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact9";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente9").value = users.value;
    document.getElementById("points9").value = notatotal;
    document.getElementById("idlibro9").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-9", "ModalLibroSeis9");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 11 **********************
 **************************************************/
document.getElementById("game-11").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-11-q1").value;
  q2 = document.getElementById("game-11-q2").value;
  q3 = document.getElementById("game-11-q3").value;
  q4 = document.getElementById("game-11-q4").value;
  q5 = document.getElementById("game-11-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact11";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente11").value = users.value;
    document.getElementById("points11").value = notatotal;
    document.getElementById("idlibro11").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-11", "ModalLibroSeis11");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 12 **********************
 **************************************************/
document.getElementById("game-12").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-12-q1").value;
  q2 = document.getElementById("game-12-q2").value;
  q3 = document.getElementById("game-12-q3").value;
  q4 = document.getElementById("game-12-q4").value;
  q5 = document.getElementById("game-12-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact12";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente12").value = users.value;
    document.getElementById("points12").value = notatotal;
    document.getElementById("idlibro12").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-12", "ModalLibroSeis12");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 13 **********************
 **************************************************/
document.getElementById("game-13").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-13-q1").value;
  q2 = document.getElementById("game-13-q2").value;
  q3 = document.getElementById("game-13-q3").value;
  q4 = document.getElementById("game-13-q4").value;
  q5 = document.getElementById("game-13-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact13";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente13").value = users.value;
    document.getElementById("points13").value = notatotal;
    document.getElementById("idlibro13").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-13", "ModalLibroSeis13");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 14 **********************
 **************************************************/
document.getElementById("game-14").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-14-q1").value;
  q2 = document.getElementById("game-14-q2").value;
  q3 = document.getElementById("game-14-q3").value;
  q4 = document.getElementById("game-14-q4").value;
  q5 = document.getElementById("game-14-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact14";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente14").value = users.value;
    document.getElementById("points14").value = notatotal;
    document.getElementById("idlibro14").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-14", "ModalLibroSeis14");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 15 **********************
 **************************************************/
/**********************DRAG ***********************/
const pnum1 = document.getElementById("game-15-num1");
const pnum2 = document.getElementById("game-15-num2");
const pnum3 = document.getElementById("game-15-num3");
const pnum4 = document.getElementById("game-15-num4");
const pnum5 = document.getElementById("game-15-num5");
const pnum6 = document.getElementById("game-15-num6");
const pnum7 = document.getElementById("game-15-num7");
const pnum8 = document.getElementById("game-15-num8");
const pnum9 = document.getElementById("game-15-num9");
const pnum10 = document.getElementById("game-15-num10");
const num1 = document.getElementById("game-15-num-1");
const num2 = document.getElementById("game-15-num-2");
const num3 = document.getElementById("game-15-num-3");
const num4 = document.getElementById("game-15-num-4");
const num5 = document.getElementById("game-15-num-5");
const num6 = document.getElementById("game-15-num-6");
const num7 = document.getElementById("game-15-num-7");
const num8 = document.getElementById("game-15-num-8");
const num9 = document.getElementById("game-15-num-9");
const num10 = document.getElementById("game-15-num-10");

const contenedor2 = document.getElementById("padre2");
const contenedor3 = document.getElementById("padre3");

document.getElementById("game-15").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  console.log("respuesta ");
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let punto = 1 / 10;
  let totalPunto = 0;

  if (
    pnum1.childNodes.length > 0 &&
    pnum2.childNodes.length > 0 &&
    pnum3.childNodes.length > 0 &&
    pnum4.childNodes.length > 0 &&
    pnum5.childNodes.length > 0 &&
    pnum6.childNodes.length > 0 &&
    pnum7.childNodes.length > 0 &&
    pnum8.childNodes.length > 0 &&
    pnum9.childNodes.length > 0 &&
    pnum10.childNodes.length > 0
  ) {
    if (pnum1.childNodes[0].dataset.id == "5th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum2.childNodes[0].dataset.id == "10th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum3.childNodes[0].dataset.id == "11th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum4.childNodes[0].dataset.id == "19th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum5.childNodes[0].dataset.id == "9th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum6.childNodes[0].dataset.id == "1st") {
      totalPunto = totalPunto + punto;
    }
    if (pnum7.childNodes[0].dataset.id == "13th") {
      totalPunto = totalPunto + punto;
    }
    if (pnum8.childNodes[0].dataset.id == "25th") {
      totalPunto = totalPunto + punto;
    }
    if (pnum9.childNodes[0].dataset.id == "23th") {
      totalPunto = totalPunto + punto;
    }
    if (pnum10.childNodes[0].dataset.id == "7th") {
      totalPunto = totalPunto + punto;
    }

    console.log("Total de puntos " + totalPunto);
    var notatotal = totalPunto.toFixed(2);
    console.log("Total de puntos " + notatotal);
    var libro = 6;
    document.getElementById("idcliente15").value = users.value;
    document.getElementById("points15").value = notatotal;
    document.getElementById("idlibro15").value = libro;
    action = "createact15";
    //console.log("idcliente" + users.value);
    //console.log("idcliente" + notatotal);
    //console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-15", "ModalLibroSeis15");
    sweetAlert(1, "Resultados ingresados", null);
  } else {
    console.log("Complete las preguntas");
    sweetAlert(2, "Complete las preguntas", null);
  }

  return true;
});

/**Respuestas */
num1.addEventListener("dragstart", (e) => {
  console.log("dragstart " + e.target.id);
  e.dataTransfer.setData("id", e.target.id);
});

num2.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num3.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num4.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num5.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});

num6.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num7.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num8.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
num9.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});

num10.addEventListener("dragstart", (e) => {
  e.dataTransfer.setData("id", e.target.id);
});
/*Contenedor*/
contenedor2.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

contenedor2.addEventListener("dragover", (e) => {
  e.preventDefault();
});

/*Contenedor*/
contenedor3.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

contenedor3.addEventListener("dragover", (e) => {
  e.preventDefault();
});

/**Num 1 */

pnum1.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum1.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum1.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num2 */
pnum2.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum2.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum2.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num3 */
pnum3.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum3.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum3.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num4 */
pnum4.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum4.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum4.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num5 */
pnum5.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum5.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum5.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num6 */
pnum6.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum6.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum6.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num7 */
pnum7.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum7.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum7.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num8 */
pnum8.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum8.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum8.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num9 */
pnum9.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum9.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum9.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});

/**num10 */
pnum10.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

pnum10.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

pnum10.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
});
/**************************************************
 ******************** GAME 17 **********************
 **************************************************/
 [
  "america",
  "baby",
  "celebration",
  "christmas",
  "columbus",
  "cupid",
  "customs",
  "day",
].map((word) => WordFindGame.insertWordBefore($("#add-word").parent(), word));

function recreate() {
  $("#result-message").removeClass();
  var fillBlanks, game;
  try {
    game = new WordFindGame("#puzzle", {
      allowedMissingWords: +$("#allowed-missing-words").val(),
      maxGridGrowth: +$("#max-grid-growth").val(),
      fillBlanks: fillBlanks,
      maxAttempts: 100,
    });
  } catch (error) {
    $("#result-message").text(`😞 ${error}, try to specify less ones`).css({
      color: "red",
    });
    return;
  }
  wordfind.print(game);
  if (window.game) {
    var emptySquaresCount = WordFindGame.emptySquaresCount();
    $("#result-message")
      .text(`😃 ${emptySquaresCount ? "but there are empty squares" : ""}`)
      .css({
        color: "",
      });
  }
  window.game = game;
}
recreate();

document.getElementById("game-17").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  console.log(event);
  var verificarSummit = event.submitter.dataset.tooltip;
  console.log(event.submitter.dataset.tooltip);
  console.log("respuesta ");
  event.preventDefault();
  if (verificarSummit == "Guardar") {
    var encontradas = document.getElementsByClassName("wordFound");
    var totalPalabras = document.getElementsByClassName("word");
    let punto = 1 / totalPalabras.length;
    let totalPunto = 0;

    console.log(encontradas.length);
    console.log("Total de palabras" + totalPalabras.length);
    totalPunto = encontradas.length * punto;
    console.log("Total de puntos " + totalPunto);
    console.log("Total de puntos " + punto);
    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente17").value = users.value;
    document.getElementById("points17").value = notatotal;
    document.getElementById("idlibro17").value = libro;
    action = "createact17";
    //console.log("idcliente" + users.value);
    //console.log("idcliente" + notatotal);
    //console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-17", "ModalLibroSeis17");
    sweetAlert(1, "Resultados ingresados", null);
  }

  return true;
});


/**************************************************
 ******************** GAME 20 **********************
 **************************************************/
document.getElementById("game-20").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-20-q1").value;
  q2 = document.getElementById("game-20-q2").value;
  q3 = document.getElementById("game-20-q3").value;
  q4 = document.getElementById("game-20-q4").value;
  q5 = document.getElementById("game-20-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact20";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "ANSWER") {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente20").value = users.value;
    document.getElementById("points20").value = notatotal;
    document.getElementById("idlibro20").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-20", "ModalLibroSeis20");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});
