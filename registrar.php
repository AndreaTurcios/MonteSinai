<?php
session_start();

require_once "vistas/parte_superior.php"

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>SEDE INA APOPA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h4 class="display-4">Registro de Datos</h4>
          <p></p>
          <p></p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
       
  <form action="grabarregistrar.php" method="POST" accept-charset="utf-8">
  <div class="form-group">
    <label for="exampleInputEmail1">No. de Ampo:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Ingresar numero de AMPO" name="ampo">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Fecha:</label>
    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Password" name="fecha">
  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Codigo de Infraestructura:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Ingresar Codigo de Infraestructura" name="infra">
    
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nombre del Centro Educativo:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Nombre del Centro Educativo" name="centroeducativo">
    
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Departamento:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Departamento" name="depto">
    
  </div>
       
   	<div class="form-row">
    <label for="validationCustom02">Municipio:</label>
      <select name="municipio" class="custom-select" >
          <option selected>Seleccionar</option>
          <option value="San Salvador">San Salvador</option>
          <option value="Aguilares">Aguilares</option>
          <option value="Apopa">Apopa</option>
          <option value="Ciudad Delgado">Ciudad Delgado</option>
          <option value="Cuscatancingo">Cuscatancingo</option>
          <option value="El Paisnal">El Paisnal</option>
          <option value="Guazapa">Guazapa</option>
          <option value="Nejapa">Nejapa</option>
          <option value="Tonacatepeque">Tonacatepeque</option>
            
      </select>
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Cantidad:</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="Cantidad." name="cantidad">
    
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


      
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

    <footer class="container">
     
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  <?php require_once 'vistas/parte_inferior.php'; ?>
</html>


