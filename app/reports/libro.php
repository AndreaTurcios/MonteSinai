<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../app/helpers/report.php');
    require('../../app/models/libros.php');
    // Se instancia el modelo en este caso empleados para procesar los datos.
    $libro = new Libros;
    if ($libro->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowLibros = $libro->readOne()) {//leer un solo dato
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Reporte de datos de libro');
            $pdf->SetFillColor(0, 188, 209);
            // Se verifica si existen registros (empleados) para mostrar, de lo contrario se imprime un mensaje.
            if ($libroo = $libro->readReport()) {// leer todos los registros
                // Se establece un color de relleno para los encabezados.
                
                // Se establece la fuente para los encabezados.
                $pdf->Ln();  
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->SetFillColor(174, 232, 251);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(193, 10, utf8_decode('Asignatura: '.$rowLibros['asignatura']), 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->Cell(60, 10, utf8_decode('Nombre libro'), 1, 0, 'C', 1);
                $pdf->Cell(60, 10, utf8_decode('Número páginas'), 1, 0, 'C', 1);
                $pdf->Cell(33, 10, utf8_decode('Asignatura'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Estado libro'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros
                foreach ($libroo as $rows) {
                    // Se imprimen las celdas con los datos de los empleados.                    
                    if(isset($rows['nombre_libro'])){
                        $pdf->Cell(60, 10, utf8_decode($rows['nombre_libro']), 1, 0);
                    }    
                    if(isset($rows['numero_paginas'])){
                        $pdf->Cell(60, 10, utf8_decode($rows['numero_paginas']), 1, 0);
                    }                    
                    if(isset($rows['asignatura'])){
                        $pdf->Cell(33, 10, utf8_decode($rows['asignatura']), 1, 0);
                    }
                    if(isset($rows['estado_libro'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['estado_libro']), 1, 0);
                    }   
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay libros asociados'), 1, 1);
            }
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {
            header('location: ../../views/dashboard/main.php');
        }
    } else {
        header('location: ../../views/dashboard/main.php');
    }
} else {
    header('location: ../../views/dashboard/main.php');
}

?>