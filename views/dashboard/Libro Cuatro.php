<?php
//Se incluye la clase con las plantillas del documento
require_once('../../app/helpers/dashboard_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 1');
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center" id="Titulo1">
                <h1 class="center">BOOK<br />TIME TO LEARN ENGLISH</h1>
                <br />
                <h3 class="center">FIRST GRADE</h3>
            </div>
        </div>
        <div class="row" style="padding: 10px; background-color: #26272b; margin-top: 10px; margin-bottom: 10px; border-radius: 10px;">
            <div class="col-12" style="color: white; font-weight: bold;">UNIT</div>
        </div>

        <div class="row">
            <div class="col-4" style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                <div>
                    <div style="border-bottom-color: black; border-bottom-style: solid; border-bottom-width: 1px; ">1</div>
                    <div style="margin-bottom: 20px;">My body</div>
                    <div><button type="button" class="btn btn-primary" style="width: 100%; background-color: #2A262B; border-color: #2A262B;">Primary</button></div>
                </div>
            </div>
            <div class="col-4"></div>
            <div class="col-4"></div>
        </div>
    </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('cont.js');
?>