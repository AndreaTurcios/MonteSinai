// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_LIBROS = '../../app/api/libros.php?action=';
const ENDPOINT_ASIGNATURA = '../../app/api/asignatura.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_ASIGNATURA,'asignatura',null)
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
                <td><a href="../dashboard/${row.nombre_libro}.php">${row.nombre_libro}</a></td>
                <td>${row.numero_paginas}</td> 
                <td>${row.asignatura}</td>
                <td>${row.indicador}</td> 
                <td>${row.estado_libro}</td>  
                <td>
                    <a href="../../app/reports/empleado.php?id=${row.id_libro}"class="btn" data-tooltip="Reporte">Reporte</a> /
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
    searchRows(API_EMPLEADOS, 'search-form');
});


// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    saveRow(API_EMPLEADOS, 'create', 'save-form', null);
    document.getElementById('save-form').reset();
});


// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('update-form').reset();
    const data = new FormData();
    data.append('id_empleado', id);
    fetch(API_EMPLEADOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {        
                document.getElementById('id_empleado2').value = response.dataset.id_empleado;
                document.getElementById('nombre_usuario2').value = response.dataset.nombre_usuario;
                document.getElementById('nombre_emp2').value = response.dataset.nombre_emp;
                document.getElementById('apellido_emp2').value = response.dataset.apellido_emp;
                document.getElementById('telefono_emp2').value = response.dataset.telefono_emp;
                fillSelect(ENDPOINT_TIPO,'tipoemp2',value = response.dataset.id_tipo_emp);
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

// Esto es para poder visualizar la contraseña y facilitar al usuario el ingreso de la misma
  document.querySelector('.campo span').addEventListener('click', e => {
    const passwordInput = document.querySelector('#clave_emp');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'Ocultar';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'Mostrar';
        passwordInput.type = 'password';
    }
});


// Se agarra el elemento en base al id y se realiza un update, en el proceso se coloca el event.preventdefault para evitar que recargue la página
document.getElementById('update-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    updateRow(API_EMPLEADOS, 'update', 'update-form', 'update-modal');
});

function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_libro', id);
    // Se confirma que se quiere eliminar un empleado en especifico en base al id
    confirmDelete(API_LIBROS, data);
}


document.querySelector('.campo1 span').addEventListener('click', e => {
    const passwordInput = document.querySelector('#claveconf');
    if (e.target.classList.contains('show')) {
        e.target.classList.remove('show');
        e.target.textContent = 'OCULTAR';
        passwordInput.type = 'text';
    } else {
        e.target.classList.add('show');
        e.target.textContent = 'MOSTRAR';
        passwordInput.type = 'password';
    }
});