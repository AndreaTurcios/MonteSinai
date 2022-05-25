<?php
//Se incluye la clase con las plantillas del documento
require_once('../../../app/helpers/dashboard_unidad.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Dashboard_Page::headerTemplate('Libro 3');
?>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center" id="Titulo1">
                <h1 class="center">THIRD BOOK <br />TIME TO LEARN ENGLISH</h1>
                <br />
                <h3 class="center">THIRD GRADE</h3>
            </div>
        </div>
        <div class="row" style="padding: 10px; background-color: #26272b; margin-top: 10px; 
            margin-bottom: 10px; border-radius: 10px;">
            <div class="col-12" style="color: white; font-weight: bold;" align="center">UNITS - Text adapted to the new Education Ministry Program with approach of competences.</div>
        </div>

        <div class="row">
            <!--Unidad 1 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                      <div align="center"><img src="img/mybody.png">
                      </div>
                      <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;" align="center">UNIT ONE</div>
                  </div>

                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">My Body</span>
                    <div style="font-size: 18px;">- I LIKE TO EAT
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- A BUSY FAMILY
                    </div>
                    <a class="btn btn-primary" href="../libro3unidad1.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 2 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                      <div align="center"><img src="img/unit2.png" width="320px" heigth="">
                        </div>
                      <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;" align="center">UNIT TWO</div>
                  </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">My Family</span>
                    <div style="
                        font-size: 18px;">- A HAPPY PARTY
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- MEANS OF TRANSPORTATION
                    </div>
                    <a class="btn btn-primary" href="../libro1unidad2t.php" role="button" style="width: 100%; background-color: #2A262B; border-color: #2A262B; " >Enter</a>
                </div>
            </div>

            <!--Unidad 3 -->
            <div class="col-sm-4" style=" padding: 10px;">
                <div style="background-color: #E4E4E4; border-radius: 10px; padding: 10px;">
                    <div style="border-bottom-color: black;  ">
                      <div align="center"><img src="img/unit3.png" width="336px">
                      </div>
                      <div style="margin-top: 10px; font-weight: bold; 
                        text-transform: uppercase; font-size: 18px;" align="center">UNIT THREE</div>
                  </div>
                    <span style="font-weight: bold;text-transform: uppercase; font-size: 17px;">My School</span>
                    <div style="font-size: 18px;">- TELLING THE TIME
                    </div>
                    <div style="margin-bottom: 25px; 
                        font-size: 18px;">- DAILY ACTIVITIES
                    </div>
                    <div><button type="button" class="btn btn-primary" style="width: 100%; background-color: #2A262B; border-color: #2A262B; ">Enter</button></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('../../resources/js/script.js');
?>