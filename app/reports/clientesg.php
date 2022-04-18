<?php
    require('../../app/helpers/report.php');
    require('../../app/models/cliente_grado.php');
 // Se instancia la clase para crear el reporte.
$pdf = new Report;
// Se inicia el reporte con el encabezado del documento.
$pdf->startReports('Reporte de datos de estudiantes por grado');
// Se instancia el módelo Categorías para obtener los datos.
    $clientes = new cliente_grado;
    if ($dataClientes = $clientes->readAll()) {// leer todos los registros de estado pago
        foreach ($dataClientes as $rowClientes) {
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetFillColor(239, 155, 133);
            $pdf->Cell(253, 10, utf8_decode($rowClientes['grado']), 1, 1, 'C', 1);
            if ($clientes->setId($rowClientes['id_grado'])) {
                // Se dataClientes si existen registros (productos) para mostrar, de lo contrario se imprime un mensaje.
                if ($dataClientes = $clientes->readCliente()) {
                    $pdf->SetFont('Arial', 'B', 11);
                    $pdf->SetFillColor(239, 155, 133);
                // Se imprimen las celdas con los encabezados, en este caso del reporte de clientes
                $pdf->Cell(60, 10, utf8_decode('Nombre cliente'), 1, 0, 'C', 1);
                $pdf->Cell(30, 10, utf8_decode('Teléfono'), 1, 0, 'C', 1);
                $pdf->Cell(45, 10, utf8_decode('Dirección'), 1, 0, 'C', 1);
                $pdf->Cell(55, 10, utf8_decode('Correo'), 1, 0, 'C', 1);
                $pdf->Cell(63, 10, utf8_decode('Grado'), 1, 0, 'C', 1);
                // Se establece la fuente para los datos de agenda
                $pdf->SetFont('Arial', '', 11);
                $pdf->Ln();
                // Se recorren los registros
                foreach ($dataClientes as $rowClientes) {
                    $pdf->Cell(60, 10, utf8_decode($rowClientes['nombre_cliente'].' '.$rowClientes['apellido_cliente']), 1, 0);
                    $pdf->Cell(30, 10, utf8_decode($rowClientes['telefono_cliente']), 1, 0);
                    $pdf->Cell(45, 10, utf8_decode($rowClientes['direccion_cliente']), 1, 0);
                    $pdf->Cell(55, 10, utf8_decode($rowClientes['correo_cliente']), 1, 0);
                    $pdf->Cell(63, 10, utf8_decode($rowClientes['grado']), 1, 0);
                    $pdf->Ln();        
                }   
            } else {
                $pdf->SetFont('Arial', '', 11);
                $pdf->Cell(253, 20, utf8_decode('                                    '.'                                     '.' No hay clientes registrados para este estado'), 1, 1);
            }
            }
}
} else {
$pdf->Cell(0, 10, utf8_decode('No hay clientes para mostrar'), 1, 1);
}

// Se envía el documento al navegador y se llama al método Footer()
$pdf->Output();
?>