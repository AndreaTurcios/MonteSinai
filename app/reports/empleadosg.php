<?php
require('../../app/helpers/report.php');
require('../../app/models/tipo_empleado.php');
// Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReport('Reporte de datos de empleado por tipo empleado');
// Se instancia el módelo Categorías para obtener los datos.
$templeados = new tipoEmpleado;
// Se verifica si existen registros (empleados) para mostrar, de lo contrario se imprime un mensaje.
if ($dataEmpleados = $templeados->readAll()) {
    // Se recorren los registros ($dataEmpleados) fila por fila ($rowEmpleados).
    foreach ($dataEmpleados as $rowEmpleados) {
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetFillColor(174, 232, 251);
        // Se imprime una celda con el nombre de la categoría.
        $pdf->Cell(193, 10, utf8_decode('Tipo empleado: '.$rowEmpleados['tipoemp']), 1, 1, 'C', 1);
        // Se establece la categoría para obtener sus empleados, de lo contrario se imprime un mensaje de error.
        if ($templeados->setId($rowEmpleados['id_tipo_emp'])) {
            // Se verifica si existen registros (empleados) para mostrar, de lo contrario se imprime un mensaje.
            if ($dataEmpleados = $templeados->readEmpleado()) {
                // Se establece un color de relleno para los encabezados.
                $pdf->SetFillColor(174, 232, 251);
                // Se establece la fuente para los encabezados.
                $pdf->SetFont('Arial', 'B', 11);
                // Se imprimen las celdas con los encabezados.
                $pdf->Cell(60, 10, utf8_decode('Nombres'), 1, 0, 'C', 1);
                // Se establece la fuente para los datos de los empleados.
                $pdf->Cell(60, 10, utf8_decode('Apellidos'), 1, 0, 'C', 1);
                $pdf->Cell(33, 10, utf8_decode('Usuario'), 1, 0, 'C', 1);
                $pdf->Cell(40, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros ($dataEmpleados) fila por fila ($rowEmpleados).
                foreach ($dataEmpleados as $rowEmpleados) {
                    $pdf->Cell(60, 10, utf8_decode($rowEmpleados['nombre_emp']), 1, 0);
                    $pdf->Cell(60, 10, utf8_decode($rowEmpleados['apellido_emp']), 1, 0);
                    $pdf->Cell(33, 10, utf8_decode($rowEmpleados['nombre_usuario']), 1, 0);
                    $pdf->Cell(40, 10, utf8_decode($rowEmpleados['telefono_emp']), 1, 0);
                    $pdf->Ln();
                    }   
                } else {
                    $pdf->SetFont('Arial', '', 11);
                    $pdf->Cell(193, 20, utf8_decode('                        '.'                            '.' No hay empleados registrados para este rol'), 1, 1);
                }
                }
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No hay empleados para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>