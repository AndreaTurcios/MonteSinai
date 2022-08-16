<?php
//Se incluye la clase con las plantillas del documento
require_once('../../../app/helpers/dashboard_unidad.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 7');
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center" id="Titulo1">
                <h1 class="center">SEVENTH GRADE: <br />Time to learn english</h1>
                <br />
                <h3 class="center">Seventh grade</h3>
            </div>
        </div>
        <div class="row" style="padding: 10px; background-color: #26272b; margin-top: 10px; 
            margin-bottom: 10px; border-radius: 10px;">
            <div class="col-12" style="color: white; font-weight: bold;">UNITS</div>
        </div>

        <div class="row">
            <!--Unidad 1 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 1</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">Nice to meet you</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad1.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 2 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                    <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 2</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">The classroom</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad2.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 3 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 3</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">My family is from El Salvador</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad3.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 4 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 4</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">Goods</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad4.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 5 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 5</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">Holidays</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad5.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 6 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                        <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;">UNIT 6</div>
                    </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">A perfect day</span>
                    <div class="mb-3"></div>
                    <a class="btn btn-primary" href="../libro7unidad6.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('../../resources/js/script.js');
?>