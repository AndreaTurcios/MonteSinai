const API_CLIENTE = '../../app/api/clientes.php?action=';
const ENDPOINT_ESTADO = '../../app/api/clientes.php?action=readEstadosCliente';
const ENDPOINT_LIBRO = '../../app/api/clientes.php?action=readLibroCliente';
const ENDPOINT_GRADO = '../../app/api/clientes.php?action=readGradoCliente';

document.addEventListener('DOMContentLoaded', function () {
    fillSelect(ENDPOINT_ESTADO,'estado_cliente',null)
    fillSelect(ENDPOINT_LIBRO,'libro',null)
    fillSelect(ENDPOINT_GRADO,'grado',null)
    readRows(API_CLIENTE);
}); 


function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.id_cliente}</td>
                <td>${row.usuario_cliente}</td>
                <td>${row.nombre_cliente}</td>
                <td>${row.apellido_cliente}</td>
                <td>${row.telefono_cliente}</td>
                <td>${row.dui_cliente}</td>
                <td>${row.direccion_cliente}</td>
                <td>${row.correo_cliente}</td>
                <td>${row.foto_cliente}</td>
                <td>${row.estado}</td>
                <td>${row.nombre_libro}</td>
                <td>${row.grado}</td>
                <td>
                <a href="../../app/reports/clientes.php?id=${row.id_cliente}"class="btn" data-tooltip="Reporte">Reporte</a> /
                <a href="#" onclick="openUpdateDialog(${row.id_cliente})" class="btn"  data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</a>/
                <a href="#" onclick="openDeleteDialog(${row.id_cliente})" class="btn waves-effect red tooltipped" data-tooltip="Eliminar">Eliminar</a>
                </td>
            </tr>
        `;
    });
 // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
 document.getElementById('tbody-rows').innerHTML = content;

 // Se inicializa la tabla con DataTable.
 let dataTable = new DataTable('#data-table', {
    labels: {
        placeholder: 'Buscar clientes...',
        perPage: '{select} clientes por página',
        noRows: 'No se encontraron clientes',
        info:'Mostrando {start} a {end} de {rows} clientes'
    }
});


}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_CLIENTE, 'search-form');
});

function openUpdateDialog(id) {
    document.getElementById('update-form').reset();

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente2', id);
    fetch(API_CLIENTE + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id_cliente2').value = response.dataset.id_cliente;
                    document.getElementById('nombre_cli2').value = response.dataset.nombre_cli;
                    document.getElementById('telefono_cli2').value = response.dataset.telefono_cli;
                    document.getElementById('nit_cli2').value = response.dataset.nit_cli;
                    document.getElementById('dui_cli2').value = response.dataset.dui_cli;
                    document.getElementById('direccion_cli2').value = response.dataset.direccion_cli;
                    document.getElementById('correo_cli2').value = response.dataset.correo_cli;
                    fillSelect(ENDPOINT_CLIENTE, 'estado_pago2', response.dataset.id_estado_pago);      
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


// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    //
    saveRow(API_CLIENTE, 'create', 'save-form', 'save-modal');
});

document.getElementById('update-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    updateRow(API_CLIENTE, 'update','update-form','update-modal');
});

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cliente', id);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_CLIENTE, data);
}