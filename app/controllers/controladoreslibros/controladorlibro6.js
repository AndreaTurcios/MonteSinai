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
    if (q1.toUpperCase() == "ACTIVITIES THAT ARE ENJOYABLE OR FUNNY.") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "BLACKBOARD.") {
      totalPunto += punto;
    }
    if (
      q3.toUpperCase() ==
      "A DECISION TO DO SOMETHING OR TO BEHAVE IN A CERTAIN MANNER."
    ) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "ON JANUARY 1ST.") {
      totalPunto += punto;
    }
    if (
      q5.toUpperCase() == "USUALLY WITH THEIR FAMILIES, INVOLVING TRADITIONS."
    ) {
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
    if (q1.toUpperCase() == "IT´S ON FEBRUARY 14TH.") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "THEY GIVE CARDS, LETTERS, FLOWERS, OR PRESENTS.") {
      totalPunto += punto;
    }
    if (
      q3.toUpperCase() ==
      "HE IS THE ROMAN GOD OF LOVE, COMMONLY REPRESENTED AS A WINGED, NAKED INFANT BOY WITH A BOW AND ARROWS."
    ) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "HEARTS, ROSES, AND CUPID.") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "HAVING WINGS LIKE AN ANGEL.") {
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
    if (
      q1.toUpperCase() == "IS THE LAST WEEK OF LENT AND IS THE WEEK BEFORE."
    ) {
      totalPunto += punto;
    }
    if (
      q2.toUpperCase() == "THE 40 WEEKDAYS FROM ASH WEDNESDAY UNTIL EASTER."
    ) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "WE REMEMBER THAT JESUS DIED FOR EVERYONE!") {
      totalPunto += punto;
    }
    if (
      q4.toUpperCase() == "THE DAY THAT THE JEWISH PASSOVER WAS CELEBRATED."
    ) {
      totalPunto += punto;
    }
    if (
      q5.toUpperCase() ==
      "THE THREE DAYS AFTER BEING KILLED, JESUS ROSE FROM THE DEAD."
    ) {
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
    if (q1.toUpperCase() == "THE FIRST MONDAY OF SEPTEMBER.") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "IS ON MAY 1ST.") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "LABOR DAY OR INTERNATIONAL WORKERS’ DAY.") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "TO MARCH OR WALK THROUGH OR AROUND A PLACE.") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "INVOLVING THE ENTIRE WORLD, UNIVERSAL.") {
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
    if (q1.toUpperCase() == "THE DAY OF THE CROSS.") {
      totalPunto += punto;
    }
    if (
      q2.toUpperCase() ==
      "EACH YEAR ON MAY 3RD PROCESSIONS OF SINGING PILGRIMS CARRY FLOWERS TO DECORATE THE CROSSES."
    ) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "IT IS ON MAY 3RD.") {
      totalPunto += punto;
    }
    if (
      q4.toUpperCase() == "YES, THEY DO, LIKE MANY COUNTRIES IN LATIN AMERICA."
    ) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "THE CROSS WHERE JESUS WAS CRUCIFIED.") {
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
    if (q1.toUpperCase() == "IT IS ON MAY 10TH.") {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == "THE SECOND SUNDAY OF MAY.") {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == "GIVING CARDS, FLOWERS, OR CAKES.") {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == "YES, THEY DO") {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == "THE FIRST SUNDAY OF MAY.") {
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

  rq1 = "It is on June 17th.";
  rq2 = "Is a man who cares for a child’s needs";
  rq3 = "It is a celebration honoring father.";
  rq4 = "The state or responsability of being a father.";
  rq5 = "Yes, Father 's Day.";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact9";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
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
 ******************** GAME 10 **********************
 **************************************************/
document.getElementById("game-10").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q10_1 = document.getElementById("game-10-q1").value;
  q10_2 = document.getElementById("game-10-q2").value;
  q10_3 = document.getElementById("game-10-q3").value;
  q10_4 = document.getElementById("game-10-q4").value;
  q10_5 = document.getElementById("game-10-q5").value;
  q10_6 = document.getElementById("game-10-q6").value;
  q10_7 = document.getElementById("game-10-q7").value;
  q10_8 = document.getElementById("game-10-q8").value;
  q10_9 = document.getElementById("game-10-q9").value;

  //q6  = document.getElementById('game-3-q6').value;

  //Verificada el 07/06/2022
  rq10_1 = "we";
  rq10_2 = "We";
  rq10_3 = "our";
  rq10_4 = "they";
  rq10_5 = "We";
  rq10_6 = "we";
  rq10_7 = "our";
  rq10_8 = "We";
  rq10_9 = "our";

  if (
    q10_1 != "" &&
    q10_2 != "" &&
    q10_3 != "" &&
    q10_4 != "" &&
    q10_5 != "" &&
    q10_6 != "" &&
    q10_7 != "" &&
    q10_8 != "" &&
    q10_9 != ""
  ) {
    action = "createact10";
    totalPunto = 0;
    totalPreguntas = 9;
    punto = 1 / totalPreguntas;
    if (q10_1.toUpperCase() == rq10_1.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_2.toUpperCase() == rq10_2.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_3.toUpperCase() == rq10_3.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_4.toUpperCase() == rq10_4.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_5.toUpperCase() == rq10_5.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_6.toUpperCase() == rq10_6.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_7.toUpperCase() == rq10_7.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_8.toUpperCase() == rq10_8.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10_9.toUpperCase() == rq10_9.toUpperCase()) {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente10").value = users.value;
    document.getElementById("points10").value = notatotal;
    document.getElementById("idlibro10").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-10", "ModalLibroSeis10");
    sweetAlert(1, "Nota " + (notatotal*10).toFixed(2), null);
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

  //Verificada el 07/06/2022
  rq1 = "In September 15th, 1821";
  rq2 =
    "Consist of what is now Guatemala, El Salvador, Honduras, Nicaragua y Costa Rica.";
  rq3 = "300 years.";
  rq4 = "A hymn of praise or loyalty to a nation.";
  rq5 = "Paradies.";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact11";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
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

  //Verificado el 07/06/2022
  rq1 = "October 12th.";
  rq2 =
    "That only the Atlantic lay between Europe and the riches of the East Indies.";
  rq3 = "Day of the Race.";
  rq4 = "October 12th, 1492";
  rq5 = "The Niña, the Pinta and the Santa Maria.";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact12";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
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

  //Verificado el 07/06/2022
  rq1 = "It is on November 2nd.";
  rq2 = "It is a day of prayer for the deceased souls.";
  rq3 = "Go to the cementery, pray and place flowers.";
  rq4 = "An excavation in earth or rock for the burial of a corpse; grave.";
  rq5 = "Flowers, cementery, altar, or oftering food.";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact13";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
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
  //q5 = document.getElementById("game-14-q5").value;
  //q6  = document.getElementById('game-3-q6').value;

  //Verificado el 07/06/2022
  rq1 = "December 25th.";
  rq2 = "Attending church, sharing meals with family and presents.";
  rq3 = "Christmas Eve.";
  rq4 = "The birth of Baby Jesus.";
  rq5 = "";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "") {
    action = "createact14";
    totalPunto = 0;
    totalPreguntas = 4;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    /* if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }*/

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
 ******************** GAME 15B **********************
 **************************************************/
 document.getElementById("game-15b").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game15b-req1").value;
  q2 = document.getElementById("game15b-req2").value;
  q3 = document.getElementById("game15b-req3").value;
  q4 = document.getElementById("game15b-req4").value;
  q5 = document.getElementById("game15b-req5").value;
  q6 = document.getElementById("game15b-req6").value;
  q7 = document.getElementById("game15b-req7").value;
  q8 = document.getElementById("game15b-req8").value;
  q9 = document.getElementById("game15b-req9").value;
  q10 = document.getElementById("game15b-req10").value;
  q11 = document.getElementById("game15b-req11").value;
  q12 = document.getElementById("game15b-req12").value;
  q13 = document.getElementById("game15b-req13").value;
  q14 = document.getElementById("game15b-req14").value;
  q15 = document.getElementById("game15b-req15").value;
  q16 = document.getElementById("game15b-req16").value;
  q17 = document.getElementById("game15b-req17").value;
  q18 = document.getElementById("game15b-req18").value;
  q19 = document.getElementById("game15b-req19").value;
  q20 = document.getElementById("game15b-req20").value;
  q21 = document.getElementById("game15b-req21").value;
  q22 = document.getElementById("game15b-req22").value;
  q23 = document.getElementById("game15b-req23").value;
  q24 = document.getElementById("game15b-req24").value;

  //q6  = document.getElementById('game-3-q6').value;

  rq1 = "first";
  rq2 = "second";
  rq3 = "third";
  rq4 = "fourth";
  rq5 = "fifth";
  rq6 = "sixth";
  rq7 = "seventh";
  rq8 = "eighth";
  rq9 = "ninth";
  rq10 = "tenth";
  rq11 = "eleventh";
  rq12 = "twelth";
  rq13 = "thirteenth";
  rq14 = "fourteenth";
  rq15 = "fifteenth";
  rq16 = "sixteenth";
  rq17 = "seventeenth";
  rq18 = "eighteenth";
  rq19 = "nineteenth";
  rq20 = "twentieth";
  rq21 = "twenty-first";
  rq22 = "twenty-second";
  rq23 = "twenty-fourth"
  rq24 = "twenty-fifth"


  if (q1 != "" 
      //&& q10 != "" 
      //&& q15 != "" 
      //&& q20 != "" 
      && q24 != "") {
    action = "createact15b";
    totalPunto = 0;
    totalPreguntas = 24;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }

    if (q6.toUpperCase() == rq6.toUpperCase()) {
      totalPunto += punto;
    }

    if (q7.toUpperCase() == rq7.toUpperCase()) {
      totalPunto += punto;
    }

    if (q8.toUpperCase() == rq8.toUpperCase()) {
      totalPunto += punto;
    }

    if (q9.toUpperCase() == rq9.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10.toUpperCase() == rq10.toUpperCase()) {
      totalPunto += punto;
    }

    if (q11.toUpperCase() == rq11.toUpperCase()) {
      totalPunto += punto;
    }

    if (q12.toUpperCase() == rq12.toUpperCase()) {
      totalPunto += punto;
    }

    if (q13.toUpperCase() == rq13.toUpperCase()) {
      totalPunto += punto;
    }

    if (q14.toUpperCase() == rq14.toUpperCase()) {
      totalPunto += punto;
    }

    if (q15.toUpperCase() == rq15.toUpperCase()) {
      totalPunto += punto;
    }

    if (q16.toUpperCase() == rq16.toUpperCase()) {
      totalPunto += punto;
    }

    if (q17.toUpperCase() == rq17.toUpperCase()) {
      totalPunto += punto;
    }

    if (q18.toUpperCase() == rq18.toUpperCase()) {
      totalPunto += punto;
    }

    if (q19.toUpperCase() == rq19.toUpperCase()) {
      totalPunto += punto;
    }

    if (q20.toUpperCase() == rq20.toUpperCase()) {
      totalPunto += punto;
    }

    if (q21.toUpperCase() == rq21.toUpperCase()) {
      totalPunto += punto;
    }

    if (q22.toUpperCase() == rq22.toUpperCase()) {
      totalPunto += punto;
    }

    if (q23.toUpperCase() == rq23.toUpperCase()) {
      totalPunto += punto;
    }

    if (q24.toUpperCase() == rq24.toUpperCase()) {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente15b").value = users.value;
    document.getElementById("points15b").value = notatotal;
    document.getElementById("idlibro15b").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-15b", "ModalLibroSeis15B");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});
/**************************************************
 ******************** GAME 16 **********************
 **************************************************/
 document.getElementById("game-16").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game16-req1").value;
  q2 = document.getElementById("game16-req2").value;
  q3 = document.getElementById("game16-req3").value;
  q4 = document.getElementById("game16-req4").value;
  q5 = document.getElementById("game16-req5").value;
  q6 = document.getElementById("game16-req6").value;
  q7 = document.getElementById("game16-req7").value;
  q8 = document.getElementById("game16-req8").value;
  q9 = document.getElementById("game16-req9").value;
  q10 = document.getElementById("game16-req10").value;


  //q6  = document.getElementById('game-3-q6').value;

  rq1 = "one hundred and eleven";
  rq2 = "one hundred and three";
  rq3 = "one hundred and four";
  rq4 = "one hundred and nineteen";
  rq5 = "one hundred and seventeen";
  rq6 = "one hundred and twenty-eight";
  rq7 = "one hundred and thirty";
  rq8 = "one hundred and fifty";
  rq9 = "one hundred and forty";
  rq10 = "one hundred and twenty-one";



  if (q1 != "" 
      //&& q10 != "" 
      //&& q15 != "" 
      //&& q20 != "" 
      && q10 != "") {
    action = "createact16";
    totalPunto = 0;
    totalPreguntas = 24;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }

    if (q6.toUpperCase() == rq6.toUpperCase()) {
      totalPunto += punto;
    }

    if (q7.toUpperCase() == rq7.toUpperCase()) {
      totalPunto += punto;
    }

    if (q8.toUpperCase() == rq8.toUpperCase()) {
      totalPunto += punto;
    }

    if (q9.toUpperCase() == rq9.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10.toUpperCase() == rq10.toUpperCase()) {
      totalPunto += punto;
    }


    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente16").value = users.value;
    document.getElementById("points16").value = notatotal;
    document.getElementById("idlibro16").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-16", "ModalLibroSeis16");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
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
  //"cupid",
  "customs",
  //"day",
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
    var encontradas = document.getElementsByClassName("wordFound1");
    var totalPalabras = document.getElementsByClassName("word1");
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
 ******************** GAME 18 **********************
 **************************************************/
 document.getElementById("game-18").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game18-req1").value;
  q2 = document.getElementById("game18-req2").value;
  q3 = document.getElementById("game18-req3").value;
  q4 = document.getElementById("game18-req4").value;
  q5 = document.getElementById("game18-req5").value;
  q6 = document.getElementById("game18-req6").value;
  q7 = document.getElementById("game18-req7").value;
  q8 = document.getElementById("game18-req8").value;
  q9 = document.getElementById("game18-req9").value;
  q10 = document.getElementById("game18-req10").value;
  q11 = document.getElementById("game18-req11").value;
  q12 = document.getElementById("game18-req12").value;
  q13 = document.getElementById("game18-req13").value;
  q14 = document.getElementById("game18-req14").value;


  rq1 = "one hundred and one";
  rq2 = "ane hundred seventeen";
  rq3 = "one hundred thirteen";
  rq4 = "one hundred twenty-eight";
  rq5 = "one hundred eighteen";
  rq6 = "one hundred forty";
  rq7 = "one hundred twenty-one";
  rq8 = "one hundred and six";
  rq9 = "one hundred thirty";
  rq10 = "one hundred ten";
  rq11 = "one hundred fifty";
  rq12 = "one hundred twenty";
  rq13 = "one hundred fifteen";
  rq14 = "one hundred nineteen";



  if (q1 != "" 
      //&& q10 != "" 
      //&& q15 != "" 
      //&& q20 != "" 
      && q14 != "") {
    action = "createact18";
    totalPunto = 0;
    totalPreguntas = 14;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }

    if (q6.toUpperCase() == rq6.toUpperCase()) {
      totalPunto += punto;
    }

    if (q7.toUpperCase() == rq7.toUpperCase()) {
      totalPunto += punto;
    }

    if (q8.toUpperCase() == rq8.toUpperCase()) {
      totalPunto += punto;
    }

    if (q9.toUpperCase() == rq9.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10.toUpperCase() == rq10.toUpperCase()) {
      totalPunto += punto;
    }

    if (q11.toUpperCase() == rq11.toUpperCase()) {
      totalPunto += punto;
    }

    if (q12.toUpperCase() == rq12.toUpperCase()) {
      totalPunto += punto;
    }

    if (q13.toUpperCase() == rq13.toUpperCase()) {
      totalPunto += punto;
    }

    if (q14.toUpperCase() == rq14.toUpperCase()) {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente18").value = users.value;
    document.getElementById("points18").value = notatotal;
    document.getElementById("idlibro18").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-18", "ModalLibroSeis18");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 18b **********************
 **************************************************/
 const contenedor1_game18 = document.getElementById("game18-padre");


 document.getElementById("game-18b").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  console.log("respuesta ");
  event.preventDefault();

  //Variable
  let pnum1 = document.getElementById("game-18b-num1");
  let pnum2 = document.getElementById("game-18b-num2");
  let pnum3 = document.getElementById("game-18b-num3");
  let pnum4 = document.getElementById("game-18b-num4");
  let pnum5 = document.getElementById("game-18b-num5");
  let pnum6 = document.getElementById("game-18b-num6");
  let pnum7 = document.getElementById("game-18b-num7");
  let pnum8 = document.getElementById("game-18b-num8");
  let pnum9 = document.getElementById("game-18b-num9");
  let pnum10 = document.getElementById("game-18b-num10");
  let num1 = document.getElementById("game-18b-num-1");
  let num2 = document.getElementById("game-18b-num-2");
  let num3 = document.getElementById("game-18b-num-3");
  let num4 = document.getElementById("game-18b-num-4");
  let num5 = document.getElementById("game-18b-num-5");
  let num6 = document.getElementById("game-18b-num-6");
  let num7 = document.getElementById("game-18b-num-7");
  let num8 = document.getElementById("game-18b-num-8");
  let num9 = document.getElementById("game-18b-num-9");
  let num10 = document.getElementById("game-18b-num-10");


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
    if (pnum1.childNodes[0].dataset.id == "25th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum2.childNodes[0].dataset.id == "1st") {
      totalPunto = totalPunto + punto;
    }

    if (pnum3.childNodes[0].dataset.id == "12th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum4.childNodes[0].dataset.id == "9th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum5.childNodes[0].dataset.id == "4th") {
      totalPunto = totalPunto + punto;
    }

    if (pnum6.childNodes[0].dataset.id == "5th") {
      totalPunto = totalPunto + punto;
    }
    if (pnum7.childNodes[0].dataset.id == "2nd") {
      totalPunto = totalPunto + punto;
    }
    if (pnum8.childNodes[0].dataset.id == "3rd") {
      totalPunto = totalPunto + punto;
    }
    if (pnum9.childNodes[0].dataset.id == "19th") {
      totalPunto = totalPunto + punto;
    }
    if (pnum10.childNodes[0].dataset.id == "23rd") {
      totalPunto = totalPunto + punto;
    }

    console.log("Total de puntos " + totalPunto);
    var notatotal = totalPunto.toFixed(2);
    console.log("Total de puntos " + notatotal);
    var libro = 6;
    document.getElementById("idcliente18b").value = users.value;
    document.getElementById("points18b").value = notatotal;
    document.getElementById("idlibro18b").value = libro;
    action = "createact18b";
    //console.log("idcliente" + users.value);
    //console.log("idcliente" + notatotal);
    //console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-18b", "ModalLibroSeis18b");
    sweetAlert(1, "Resultados ingresados", null);
  } else {
    console.log("Complete las preguntas");
    sweetAlert(2, "Complete las preguntas", null);
  }

  return true;
});
 /*Contenedor*/
 contenedor1_game18.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

contenedor1_game18.addEventListener("dragover", (e) => {
  e.preventDefault();
});

/**Respuestas */
document.addEventListener("dragstart", (e) => {
  console.log("dragstart document " + e.target.id);
  e.dataTransfer.setData("id", e.target.id);
});

/******* General para mover piezas*/
document.addEventListener("drop", (e) => {
  e.target.classList.remove("hover");
  const id = e.dataTransfer.getData("id");
  console.log(id);
  e.target.appendChild(document.getElementById(id));
});

document.addEventListener("dragover", (e) => {
  e.preventDefault();
  e.target.classList.add("hover");
});

document.addEventListener("dragleave", (e) => {
  e.target.classList.remove("hover");
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

  rq1 = "Rio.";
  rq2 = "It is an artificial Lake.";
  rq3 = "A model of the solar system, sometimes mechanized to show the relative motions of the planets.";
  rq4 = "Yes, It´s cusco.";
  rq5 = "Volcanoes, misty rainforests and a vibrant cuture.";

  if (q1 != "" && q2 != "" && q3 != "" && q4 != "" && q5 != "") {
    action = "createact20";
    totalPunto = 0;
    totalPreguntas = 5;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
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
/**************************************************
 ******************** GAME 21 **********************
 **************************************************/
 document.getElementById("game-21").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-21-q1").value;
  q2 = document.getElementById("game-21-q2").value;
  q3 = document.getElementById("game-21-q3").value;
  q4 = document.getElementById("game-21-q4").value;
  q5 = document.getElementById("game-21-q5").value;
  q6 = document.getElementById("game-21-q6").value;
  q7 = document.getElementById("game-21-q7").value;
  q8 = document.getElementById("game-21-q8").value;
  q9 = document.getElementById("game-21-q9").value;
  q10 = document.getElementById("game-21-q10").value;

  //q6  = document.getElementById('game-3-q6').value;

  rq1 = "I";
  rq2 = "I";
  rq3 = "She";
  rq4 = "It";
  rq5 = "They";
  rq6 = "They";
  rq7 = "She";
  rq8 = "He";
  rq9 = "You";
  rq10 = "He";

  if (q1 != "" && q5 != "") {
    action = "createact21";
    totalPunto = 0;
    totalPreguntas = 10;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente21").value = users.value;
    document.getElementById("points21").value = notatotal;
    document.getElementById("idlibro21").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-21", "ModalLibroSeis21");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});

/**************************************************
 ******************** GAME 30 **********************
 **************************************************/

 document.getElementById("game-30").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  event.preventDefault();
  //Se declaran las variables segun el numero de campos, a evaluar.
  let q1, q2, q3, q4, q5, q6;

  //Se igualan las variables a el campo de texto de la vista mediante el id.
  q1 = document.getElementById("game-30-q1").value;
  q2 = document.getElementById("game-30-q2").value;
  q3 = document.getElementById("game-30-q3").value;
  q4 = document.getElementById("game-30-q4").value;
  q5 = document.getElementById("game-30-q5").value;
  q6 = document.getElementById("game-30-q6").value;
  q7 = document.getElementById("game-30-q7").value;
  q8 = document.getElementById("game-30-q8").value;
  q9 = document.getElementById("game-30-q9").value;
  q10 = document.getElementById("game-30-q10").value;
  q11 = document.getElementById("game-30-q11").value;
  q12 = document.getElementById("game-30-q12").value;


  rq1 = "";
  rq2 = "";
  rq3 = "";
  rq4 = "";
  rq5 = "";
  rq6 = "";
  rq7 = "";
  rq8 = "";
  rq9 = "";
  rq10 = "";
  rq11 = "";
  rq12 = "";



  if (q1 != "" 
      //&& q10 != "" 
      //&& q15 != "" 
      //&& q20 != "" 
      && q14 != "") {
    action = "createact30";
    totalPunto = 0;
    totalPreguntas = 12;
    punto = 1 / totalPreguntas;
    if (q1.toUpperCase() == rq1.toUpperCase()) {
      totalPunto += punto;
    }
    if (q2.toUpperCase() == rq2.toUpperCase()) {
      totalPunto += punto;
    }
    if (q3.toUpperCase() == rq3.toUpperCase()) {
      totalPunto += punto;
    }
    if (q4.toUpperCase() == rq4.toUpperCase()) {
      totalPunto += punto;
    }
    if (q5.toUpperCase() == rq5.toUpperCase()) {
      totalPunto += punto;
    }

    if (q6.toUpperCase() == rq6.toUpperCase()) {
      totalPunto += punto;
    }

    if (q7.toUpperCase() == rq7.toUpperCase()) {
      totalPunto += punto;
    }

    if (q8.toUpperCase() == rq8.toUpperCase()) {
      totalPunto += punto;
    }

    if (q9.toUpperCase() == rq9.toUpperCase()) {
      totalPunto += punto;
    }

    if (q10.toUpperCase() == rq10.toUpperCase()) {
      totalPunto += punto;
    }

    if (q11.toUpperCase() == rq11.toUpperCase()) {
      totalPunto += punto;
    }

    if (q12.toUpperCase() == rq12.toUpperCase()) {
      totalPunto += punto;
    }

   

    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente30").value = users.value;
    document.getElementById("points30").value = notatotal;
    document.getElementById("idlibro30").value = libro;
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-30", "ModalLibroSeis30");
    sweetAlert(1, "Nota " + notatotal * totalPreguntas, null);
  } else {
    sweetAlert(3, "Faltan  respuestas", null);
  }

  return true;
});
/**************************************************
 ******************** GAME 36 **********************
 **************************************************/
/**
 * Tipo:SL
 */
[
  "august",
  "beautiful",
  "cold",
  "december",
  "delicious",
  "february",
  //'friendly',
  //'hot',
  //'january',
  //'july',
  //'march',
  //'may',
  //'november',
  //'october',
  //'rainy',
  //'safe',
  //'september',
  //'sunny',
  //'weather',
  //'windy'
].map((word2) =>
  wordfind2Game2.insertWordBefore($("#add-word-36").parent(), word2)
);

function recreate2() {
  $("#result-message").removeClass();
  var fillBlanks, game;
  try {
    game = new wordfind2Game2("#puzzle-36", {
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
  wordfind2.print(game);
  if (window.game) {
    var emptySquaresCount = wordfind2Game2.emptySquaresCount();
    $("#result-message")
      .text(`😃 ${emptySquaresCount ? "but there are empty squares" : ""}`)
      .css({
        color: "",
      });
  }
  window.game = game;
}
recreate2();

document.getElementById("game-36").addEventListener("submit", function (event) {
  // Se evita recargar la página web después de enviar el formulario.
  //console.log(event);
  var verificarSummit = event.submitter.dataset.tooltip;
  //console.log(event.submitter.dataset.tooltip);
  //console.log("respuesta ");
  event.preventDefault();
  if (verificarSummit == "Guardar") {
    var encontradas = document.getElementsByClassName("wordFound2");
    var totalPalabras = document.getElementsByClassName("word2");
    //var totalPalabras = word2.size;
    let punto = 1 / totalPalabras.length;
    let totalPunto = 0;

    console.log(encontradas.length);
    console.log("Total de palabras" + totalPalabras.length);
    totalPunto = encontradas.length * punto;
    console.log("Total de puntos " + totalPunto);
    console.log("Total de puntos " + punto);
    var notatotal = totalPunto.toFixed(2);
    var libro = 6;
    document.getElementById("idcliente36").value = users.value;
    document.getElementById("points36").value = notatotal;
    document.getElementById("idlibro36").value = libro;
    action = "createact36";
    //console.log("idcliente" + users.value);
    //console.log("idcliente" + notatotal);
    //console.log("libro" + libro);
    //function saveRowActivity(api, action, form, modal) en componente.js helper
    saveRowActivity(API_ACTIVIDADES, action, "game-36", "ModalLibroSeis36");
    sweetAlert(1, "Resultados ingresados", null);
  }

  return true;
});
