<?php
require('../../app/helpers/database.php');
require('../../app/helpers/validator.php');
require('../../app/libraries/fpdf182/fpdf.php');

/**
*   Clase para definir las plantillas de los reportes del sitio privado. Para más información http://www.fpdf.org/
*/
class Report extends FPDF
{
    // Propiedad para guardar el título del reporte.
    private $title = null;
    

    /*
    *   Método para iniciar el reporte con el encabezado del documento.
    *
    *   Parámetros: $title (título del reporte).
    *
    *   Retorno: ninguno.
    */
    public function startReport($title)
    {
        // Se establece la zona horaria a utilizar durante la ejecución del reporte.
        ini_set('date.timezone', 'America/El_Salvador');
       
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en los reportes.
         session_start();
        // Se verifica si un administrador ha iniciado sesión para generar el documento, de lo contrario se direcciona a main.php
            if (isset($_SESSION['id_empleado'])) {
            // Se asigna el título del documento a la propiedad de la clase.
            $this->title = $title;
            // Se establece el título del documento (true = utf-8).
            $this->SetTitle('Dashboard - Reporte', true);
            // Se establecen los margenes del documento (izquierdo, superior y derecho).
            $this->setMargins(9, 15, 15);
            // Se añade una nueva página al documento (orientación vertical y formato carta) y se llama al método Header()
            $this->AddPage('p', 'letter');
            // Se define un alias para el número total de páginas que se muestra en el pie del documento.
            $this->AliasNbPages();
             } else {
               header('location: ../../views/dashboard/principal.php');
          }      
    }


    public function startReports($title)
    {
         session_start();
        // Se establece la zona horaria a utilizar durante la ejecución del reporte.
        ini_set('date.timezone', 'America/El_Salvador');
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en los reportes.
        // Se verifica si un administrador ha iniciado sesión para generar el documento, de lo contrario se direcciona a main.php
            // Se asigna el título del documento a la propiedad de la clase.
            $this->title = $title;
            // Se establece el título del documento (true = utf-8).
            $this->SetTitle('Dashboard - Reporte', true);
            // Se establecen los margenes del documento (izquierdo, superior y derecho).
            $this->setMargins(15, 15, 15);
            // Se añade una nueva página al documento (orientación vertical y formato carta) y se llama al método Header()
            $this->AddPage('l', 'letter');
            // Se define un alias para el número total de páginas que se muestra en el pie del documento.
            $this->AliasNbPages();
            // } else {
            //   header('location: ../../../views/private/index.php');
            //  }      
    }


    /*
    *   Se sobrescribe el método de la librería para establecer la plantilla del encabezado de los reportes.
    *   Se llama automáticamente en el método AddPage()
    */
    public function Header()
    {
        
        // Se verifica si un administrador ha iniciado sesión para generar el documento, de lo contrario se direcciona a main.php
        if (isset($_SESSION['id_empleado'])) {
        // Se establece el logo.
        $this->Image('../../resources/img/logo_sinai.png', 15, 15, 40);
        $this->Ln(10);
        // Se ubica el título.
        $this->Cell(20);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(166, 10, utf8_decode($this->title), 0, 1, 'C');
        // Se ubica la fecha y hora del servidor.
        $this->Cell(20);
        $this->SetFont('Arial', '', 10);
        $this->Cell(166, 10, 'Fecha/Hora: '.date('d-m-Y H:i:s'), 0, 1, 'C');
        // $this->Cell(205, 10, 'Usuario: '.$_SESSION['nombre_usuario'], 0, 1, 'C');
        $this->Ln(10);
    }
}

    /*
    *   Se sobrescribe el método de la librería para establecer la plantilla del pie de los reportes.
    *   Se llama automáticamente en el método Output()
    */
    public function Footer()
    {
        // Se establece la posición para el número de página (a 15 milimetros del final).
        $this->SetY(-15);
        // Se establece la fuente para el número de página.
        $this->SetFont('Arial', 'I', 8);
        // Se imprime una celda con el número de página.
        $this->Cell(0, 10, utf8_decode('Página ').$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
?>