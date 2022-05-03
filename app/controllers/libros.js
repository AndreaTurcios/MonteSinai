// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LIBROS = '../../app/api/libros.php?action=';
const ENDPOINT_ASIGNATURA = '../../app/api/asignatura.php?action=readAll';
const ENDPOINT_ESTADO_LIBRO = '../../app/api/estado_libro.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_ASIGNATURA,'asignatura',null)
    fillSelect(ENDPOINT_ESTADO_LIBRO,'estadolibro',null)
    readRows(API_LIBROS);
    //readRows(ENDPOINT_TIPO);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) { 
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {  
        
        // Se crean y concatenan las filas de la tabla con los datos de cada registro. 
        content += ` 
            <tr>       
                <td>${row.id_libro}</td>
                <td><a href="../dashboard/unidades/${row.nombre_libro}.php">${row.nombre_libro}</a></td>
                <td>${row.numero_paginas}</td> 
                <td>${row.asignatura}</td>
                <td>${row.estado_libro}</td>  
                <td>
                    <a href="../../app/reports/libro.php?id=${row.id_libro}"class="btn" data-tooltip="Reporte">Reporte</a> /
                    <a href="#" onclick="openUpdateDialog(${row.id_libro})"class="btn"  data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</a> /
                    <a href="#" onclick="openDeleteDialog(${row.id_libro})"class="btn">Eliminar</a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

        // Se inicializa la tabla con DataTable.
 let dataTable = new DataTable('#data-table', {
    labels: {

        placeholder: 'Buscar libros...',
        perPage: '{select} Libros por página',
        noRows: 'No se encontraron libros',
        info:'Mostrando {start} a {end} de {rows} libros',
        style: "black"
    }

});
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_LIBROS, 'search-form');
});


// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    saveRow(API_LIBROS, 'create', 'save-form', null);
    document.getElementById('save-form').reset();
});


// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('update-form').reset();
    const data = new FormData();
    data.append('id_libro', id);
    fetch(API_LIBROS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {        
                document.getElementById('id_libro2').value = response.dataset.id_libro;
                document.getElementById('nombrelibro2').value = response.dataset.nombre_libro;
                document.getElementById('numpaginas2').value = response.dataset.numero_paginas;
                fillSelect(ENDPOINT_ESTADO_LIBRO,'estadolibro2',value = response.dataset.id_estado_libro);
                fillSelect(ENDPOINT_ASIGNATURA,'asignatura2',value = response.dataset.id_asignatura);
            } else {
                sweetAlert(2, response.exception, null);
            }
        });
    } else {
        console.log(request.status + ' ' + request.statusText);
    }
}).catch(function (error) {
    console.log(error);
});
}

// Se agarra el elemento en base al id y se realiza un update, en el proceso se coloca el event.preventdefault para evitar que recargue la página
document.getElementById('update-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    updateRow(API_LIBROS, 'update', 'update-form', 'update-modal');
});

function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_libro', id);
    // Se confirma que se quiere eliminar un empleado en especifico en base al id
    confirmDelete(API_LIBROS, data);
}

