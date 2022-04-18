<?php
// Se verifica si existe el parámetro id en la url, de lo contrario se direcciona a la página web de origen.
if (isset($_GET['id'])) {
    require('../../app/helpers/report.php');
    require('../../app/models/empleados.php');
    // Se instancia el modelo en este caso empleados para procesar los datos.
    $empleados = new Empleados;
    if ($empleados->setId($_GET['id'])) {
        // Se verifica si la categoría del parametro existe, de lo contrario se direcciona a la página web de origen.
        if ($rowEmpleado = $empleados->readOne()) {//leer un solo empleado
            // Se instancia la clase para crear el reporte.
            $pdf = new Report;
            // Se inicia el reporte con el encabezado del documento.
            $pdf->startReport('Reporte de datos de empleado');
            $pdf->SetFillColor(0, 188, 209);
            // Se verifica si existen registros (empleados) para mostrar, de lo contrario se imprime un mensaje.
            if ($empleadoss = $empleados->readReport()) {// leer todos los registros
                // Se establece un color de relleno para los encabezados.
                
                // Se establece la fuente para los encabezados.
                $pdf->Ln();  
                $pdf->SetFont('Arial', 'B', 11);
                $pdf->SetFillColor(174, 232, 251);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(193, 10, utf8_decode('Tipo empleado: '.$rowEmpleado['tipoemp']), 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->Cell(60, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
                // Se establece la fuente para los datos de los empleados.
                $pdf->Cell(60, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
                $pdf->Cell(33, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros
                foreach ($empleadoss as $rows) {
                    // Se imprimen las celdas con los datos de los empleados.                    
                    if(isset($rows['nombre_emp'])){
                        $pdf->Cell(60, 10, utf8_decode($rows['nombre_emp']), 1, 0);
                    }
                    if(isset($rows['apellido_emp'])){
                        $pdf->Cell(60, 10, utf8_decode($rows['apellido_emp']), 1, 0);
                    }                    
                    if(isset($rows['nombre_usuario'])){
                        $pdf->Cell(33, 10, utf8_decode($rows['nombre_usuario']), 1, 0);
                    }
                    if(isset($rows['telefono_emp'])){
                        $pdf->Cell(40, 10, utf8_decode($rows['telefono_emp']), 1, 0);
                    }              
                }
            } else {
                $pdf->Cell(0, 10, utf8_decode('No hay empleados asociados'), 1, 1);
            }
            
            // Se envía el documento al navegador y se llama al método Footer()  
            $pdf->Output();
        } else {
            header('location: ../../views/dashboard/gestion_empleados.php');
        }
    } else {
        header('location: ../../views/dashboard/gestion_empleados.php');
    }
} else {
    header('location: ../../views/dashboard/gestion_empleados.php');
}

?>