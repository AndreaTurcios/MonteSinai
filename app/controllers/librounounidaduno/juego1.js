document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('charts').innerHTML = '<canvas id="chart1">sdfddsf</canvas>';
});



document.getElementById('form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    document.getElementById('id_input').value = '';
    
    
    
});
