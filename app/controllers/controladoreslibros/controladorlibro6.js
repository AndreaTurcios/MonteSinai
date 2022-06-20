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