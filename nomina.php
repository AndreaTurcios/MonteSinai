<?php


include 'conexion/conexion.php';

session_start();


$pagina = (isset($_GET['pagina']) ? $_GET['pagina'] : 1);
$por_pagina = (isset($_GET['por_pagina']) && ($_GET['por_pagina']) <=50 ? $_GET['por_pagina'] : 30);
$total_paginas = ($pagina > 1 ) ? ($pagina * $por_pagina) - $por_pagina : 0; 

$query="SELECT * FROM ampo limit ".$total_paginas.",".$por_pagina." ";
$total = $conexion->query("SELECT * from ampo")-> num_rows;
$total_paginas = ceil($total / $por_pagina);

$resultado=$conexion->query($query);

?>

<?php require_once "vistas/parte_superior.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>SEDE INA, APOPA</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <link href="css/estilos.css" rel="stylesheet">
   <link href="css2/bootstrap.min.css" rel="stylesheet">
   <link href="css3/estilos.css" rel="stylesheet">



    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">SEDE INA APOPA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="admin.php"> INICIO<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="buscarResponsable.php"> <span class="sr-only">(current)</span></a>
          </li>
         
        </ul>
        <form class="form-inline my-2 my-lg-0" action="logout.php">
          
        </form>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
    
          <p align="left">
      <?php
    if (isset($_SESSION['nombre'])) {
        echo "Bienvenido(a): " . $_SESSION['nombre'];
        
    } else {
        echo "No tiene permitido visitar esta página.";
    }

    ?> 
  </p>
          <h1 class="display-3">Registro de Datos</h1>
          <p><h3>Sede Instituto Nacional de Apopa</h3></p>
         
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
     
  <div class="table-responsive">
 <table  class="table table-bordered">
    <tr>
      <th width="6%" style=""><div align="center">No. Ampo</div></th>
      <th width="14%" style="" scope="col"><div align="center">Fecha</div></th>
      <th width="10%" scope="col"><div align="center">Cod. Infra</div></th>
      <th width="15%" scope="col"><div align="center">Centro Educativo</div></th>
      <th width="13%" scope="col"><div align="center">Departamento</div></th>
      <th width="17%" scope="col"><div align="center">Municipio</div></th>
      <th width="10%" scope="col"><div align="center">Cantidad Laptop entregadas</div></th>
      <th width="8%" scope="col"></th>
      <th width="7%" scope="col"></th>
    </tr>
  
  
    <?php 


       if(isset($_GET['busqueda']))
              {
                $busqueda = $_GET['busqueda'];

                $resultado = $conexion->query("SELECT * from  ampo where dui like '%$busqueda%'");



              }



    while($row=$resultado->fetch_assoc()){ ?>
    <tr> 
      <td><?php echo $row['ampo'];?></td>
      <td><?php echo $row['fecha'];?></td>
      <td><?php echo $row['infra'];?></td>
      <td><?php echo $row['centroeducativo'];?></td>
      <td><?php echo $row['depto'];?></td>
      <td><?php echo $row['municipio'];?></td>
      <td><?php echo $row['cantidad'];?></td>

      <td><a href="modificar.php?id=<?php echo $row['id'];?>">Modificar</a></td>
      <td><a href="eliminar.php?id=<?php echo $row['id'];?>">Eliminar</a></td>
    </tr>

    <?php } ?>
  </tbody>
</table>
  <center>
  <div class="paginador">
  <ul>
    <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
    <li><a href="?pagina=<?php echo $pagina-1 ?>"><<</a></li>
    <?php
    for ($i = 1; $i <= $total_paginas; $i++) {


      if($i == $pagina)
      {
        echo '<li class="pageSelected">'.$i.'</li>';
      }else
      {
        echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
      }
     } 

    ?>
    <li><a href="?pagina=<?php echo $pagina + 1 ?>">>></a></li>
    <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
  </ul>
</div>

      </center>
       </div>
      </div> <!-- /container -->


     



    </main>

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
