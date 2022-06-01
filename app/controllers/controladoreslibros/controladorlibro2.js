const API_ACTIVIDADES = '../../app/api/proceso_libro.php?action=';

document.addEventListener('DOMContentLoaded', function () {

});

document.getElementById('game-47').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    
    //let nota =document.getElementById('points').value;
    var libro = 2;
    document.getElementById('idcliente').value = users.value;
    document.getElementById('points').value = 0;
    document.getElementById('idlibro').value = libro;
    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-47', 'ModalLibroDos47')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});

document.getElementById('game-48').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    
    //let nota =document.getElementById('points').value;
    var libro = 2;
    document.getElementById('idcliente').value = users.value;
    document.getElementById('points').value = 0;
    document.getElementById('idlibro').value = libro;
    action = 'create';
    saveRowActivity(API_ACTIVIDADES, action, 'game-48', 'ModalLibroDos48')
    sweetAlert(1, 'Resultados ingresados', null);
    return true;
});