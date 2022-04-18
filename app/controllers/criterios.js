// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CRITERIOS = '../../app/api/criterios.php?action=';


document.addEventListener('DOMContentLoaded', function () {
    readRows(API_CRITERIOS);
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
                <td>${row.id_indicador}</td>
                <td>${row.indicador}</td>  
                <td>${row.indicador2}</td>
                <td>${row.indicador3}</td> 
                <td>${row.indicador4}</td>
                <td>${row.indicador5}</td> 
                <td>${row.indicador6}</td>  
                <td>${row.indicador7}</td>  
                <td>${row.indicador8}</td>  
                <td>${row.indicador9}</td>  
                <td>${row.indicador10}</td>  
                <td>
                    <a href="../../app/reports/criterios.php?id=${row.id_empleado}"class="btn" data-tooltip="Reporte">Reporte</a> /
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
        placeholder: 'Buscar criterios...',
        perPage: '{select} Criterios por página',
        noRows: 'No se encontraron criterios',
        info:'Mostrando {start} a {end} de {rows} criterios'
    }
});
}


