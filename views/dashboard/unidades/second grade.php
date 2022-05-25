<?php
//Se incluye la clase con las plantillas del documento
require_once('../../../app/helpers/dashboard_unidad.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 2');
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<section>
    <div class="container-fluid">
        <div class="row" style= "background-color: #26272b;">
            <div class="col-12 text-center" id="Titulo1">
                <h1 class="center">SECOND GRADE: <br />Time to learn english</h1>
                <br />
                <h3 class="center">Second Grade</h3>
            </div>
        </div>
        <div class="row" style="padding: 10px; background-color: #f99d52; margin-top: 10px; 
            margin-bottom: 10px; border-radius: 10px;">
            <div class="col-12" style="color: white; font-weight: bold;">UNITS</div>
        </div>

        <div class="row">
            <!--Unidad 1 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #f99d52;; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 1</div>
                    </div>

                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">
                        My Body
                    </span>
                    <div style="
                        font-size: 18px;">- Clotehes we wear
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- Delicious Foods
                    </div>
                    <a class="btn btn-primary" href="../libro2Unidad1t.php" role="button" style="width: 100%; background-color: #f99d52; border-color: #f99d52; ">Enter</a>
                </div>
            </div>

            <!--Unidad 2 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 2</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">
                        My Family
                    </span>
                    <div style="
                        font-size: 18px;">- My relatives
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- Work Places
                    </div>
                    <a class="btn btn-primary" href="../libro2unidad2t.php" role="button" style="width: 100%; background-color: #f99d52; border-color: #f99d52; ">Enter</a>
                </div>
            </div>

            <!--Unidad 3 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: #f99d52;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 3</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">
                        My School
                    </span>
                    <div style="font-size: 18px;">- I like my classroom
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- Months of year
                    </div>
                    <a class="btn btn-primary" href="../libro2unidad3t.php" role="button" style="width: 100%; background-color: #f99d52; border-color: #f99d52; ">Enter</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('../../resources/js/script.js');
?>