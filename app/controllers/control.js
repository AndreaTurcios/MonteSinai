// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CONTROL = '../../app/api/notas.php?action=';
const ENDPOINT_TIPO = '../../app/api/tipo_empleado.php?action=readAll';
const ENDPOINT_ESTADO_EMPLEADO = '../../app/api/estado_empleado.php?action=readAll';
const ENDPOINT_LIBRO = '../../app/api/libros.php?action=readAll';

document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    fillSelect(ENDPOINT_TIPO,'tipoemp',null)
    fillSelect(ENDPOINT_ESTADO_EMPLEADO,'estado',null)
    fillSelect(ENDPOINT_LIBRO,'libro',null)
    readRows(API_CONTROL);
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
                <td>${row.id_empleado}</td>
                <td>${row.usuario}</td>  
                <td>${row.nombre_empleado}</td>
                <td>${row.apellido_empleado}</td> 
                <td>${row.telefono_empleado}</td>
                <td>${row.direccion_empleado}</td> 
                <td>${row.correo_empleado}</td>  
                <td>${row.empleado}</td>  
                <td>${row.tipo_empleado}</td>  
                <td>${row.nombre_libro}</td>  
                <td>
                    <a href="../../app/reports/empleado.php?id=${row.id_empleado}"class="btn" data-tooltip="Reporte">Reporte</a> /
                    <a href="#" onclick="openUpdateDialog(${row.id_empleado})"class="btn"  data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</a> /
                    <a href="#" onclick="openDeleteDialog(${row.id_empleado})"class="btn">Eliminar</a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

        // Se inicializa la tabla con DataTable.
 let dataTable = new DataTable('#data-table', {
    labels: {
        placeholder: 'Buscar empleados...',
        perPage: '{select} Empleados por página',
        noRows: 'No se encontraron empleados',
        info:'Mostrando {start} a {end} de {rows} empleados'
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
    event.preventDefault();
    saveRow(API_EMPLEADOS, 'create', 'save-form', 'save-modal');
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
                document.getElementById('nombre_usuario2').value = response.dataset.usuario;
                document.getElementById('nombre_emp2').value = response.dataset.nombre_empleado;
                document.getElementById('apellido_emp2').value = response.dataset.apellido_empleado;
                document.getElementById('telefono_emp2').value = response.dataset.telefono_empleado;
                document.getElementById('direccion_emp2').value = response.dataset.direccion_empleado;
                document.getElementById('correo_emp2').value = response.dataset.correo_empleado;
                fillSelect(ENDPOINT_TIPO,'tipoemp2',value = response.dataset.id_tipo_emp);
                fillSelect(ENDPOINT_ESTADO_EMPLEADO,'estado2',value = response.dataset.id_estado_emp);
                fillSelect(ENDPOINT_LIBRO,'libro2',value = response.dataset.id_tipo_emp);
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
    data.append('id_empleado', id);
    // Se confirma que se quiere eliminar un empleado en especifico en base al id
    confirmDelete(API_EMPLEADOS, data);
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