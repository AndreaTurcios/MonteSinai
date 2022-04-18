<?php
/*
*	Clase para definir las plantillas de las páginas web
*/
class Dashboard_Page
{
  /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
  public static function headerTemplate($title)
  {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
    session_start();
    /*	(1, 'Root'),--control total
        (2, 'Administrador'),--control CASI total
        (3, 'Profesor'),--como van las secciones, alumnos
        (4, 'Director'),--como van las secciones, docentes y avance institucional
        (5, 'Padre de familia'),--como va el alumno
        (6, 'Alumno');--visualizar su libro*/
    print('
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Agregamos Bootstrap -->
            <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
            <!-- Agregamos LibroCSS -->
            <link rel="stylesheet" href="../../resources/css/style.css">
            <link rel="stylesheet" href="../../resources/css/vanilla-dataTables.min.css">
            <title>Monte Sinai - ' . $title . '</title>
            <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
        </head>
        <body>  
    ');
    // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
    $filename = basename($_SERVER['PHP_SELF']);
    // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
    if (isset($_SESSION['id_empleado'])) {
      // En este apartado se corrobora que el id de tipo usuario corresponda a uno de la tabla tipo empleados, y muestre la vista respectiva a cada tipo de usuario
      if ($_SESSION['id_tipo_empleado'] == 1) { //Root
        print('
        <nav>
                <div class="menu">
                    <ul>
                         <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
                    </ul>
                    <ul>
                        <li><a href="../dashboard/main.php">Libros</a></li>
                        <li><a href="../dashboard/orders.php">Control</a></li>
                        <li><a href="../dashboard/customers.php">Clientes</a></li>
                        <li><a href="../dashboard/reports.php">Reports</a></li>
                        <li><a href="../dashboard/empleados.php">Empleados</a></li>
                        <li><a href="../dashboard/empleados.php">Criterios</a></li>
                        <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
                    </ul>
                </div>
            </nav>
            <div class="css-xfq28i"></div>
            <br>  
            ');
      } else if ($_SESSION['id_tipo_empleado'] == 2) { //Administrador
        print('

            <nav>
                    <div class="menu">
                        <ul>
                             <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
                        </ul>
                        <ul>
                          <li><a href="../dashboard/main.php">Libros</a></li>
                          <li><a href="../dashboard/orders.php">Control</a></li>
                          <li><a href="../dashboard/customers.php">Clientes</a></li>
                          <li><a href="../dashboard/empleados.php">Empleados</a></li>
                          <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="css-xfq28i"></div>
                <br> '
        );
      } else if ($_SESSION['id_tipo_empleado'] == 3) { //Profesor
        print('
      <nav>
              <div class="menu">
                  <ul>
                       <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
                  </ul>
                  <ul>
                      <li><a href="../dashboard/orders.php">Control</a></li>
                      <li><a href="../dashboard/customers.php">Clientes</a></li>
                      <li><a href="../dashboard/reports.php">Reports</a></li>
                      <li></li><li></li><li></li><li></li><li></li>
                      <li></li><li></li><li></li>
                      <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
                  </ul>
              </div>
          </nav>
          <div class="css-xfq28i"></div>
          <br> '
        );
      } else if ($_SESSION['id_tipo_empleado'] == 4) { //Director
        print('

  <nav>
          <div class="menu">
              <ul>
                   <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
              </ul>
              <ul>
                <li><a href="../dashboard/main.php">Libros</a></li>
                <li><a href="../dashboard/orders.php">Control</a></li>
                <li><a href="../dashboard/customers.php">Clientes</a></li>
                <li><a href="../dashboard/reports.php">Reports</a></li>
              </ul>
          </div>
      </nav>
      <div class="css-xfq28i"></div>
      <br> '
        );
      } else if ($_SESSION['id_tipo_empleado'] == 5) { //Padre de familia
        print('

  <nav>
          <div class="menu">
              <ul>
                   <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
              </ul>
              <ul>
                <li><a href="../dashboard/orders.php">Control</a></li>
                <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
              </ul>
          </div>
      </nav>
      <div class="css-xfq28i"></div>
      <br> '
        );
      } else if ($_SESSION['id_tipo_empleado'] == 6) { //Alumno
        print('
  <nav>
          <div class="menu">
              <ul>
                   <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
              </ul>
              <ul>
                <li><a href="../dashboard/main.php">Libros</a></li>
                <li><a href="../dashboard/orders.php">Control</a></li>
                <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
              </ul>
          </div>
      </nav>
      <div class="css-xfq28i"></div>
      <br> '
        );
      } else {
        print('

    <nav>
            <div class="menu">
                <ul>
                     <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
                </ul>
                <ul>
                <li><a href="../dashboard/main.php">Libros</a></li>
                <li><a href="../dashboard/orders.php">Control</a></li>
                <li><a href="../dashboard/customers.php">Clientes</a></li>
                <li><a href="../dashboard/reports.php">Reports</a></li>
                <li><a href="../dashboard/empleados.php">Empleados</a></li>
                <li><a href="#" onclick="logOut()">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
        <div class="css-xfq28i"></div>
        <br> '
        );
      }
    } else {
      print('
  <nav>
          <div class="menu">
              <ul>
                   <li><a href="../dashboard/principal.php"><img src="../../resources/img/logo_sinai.png" width="200" height="60" class="top-center"></a></li>
              </ul>
              <ul>
                  <li></li><li></li><li></li><li></li><li></li>
                  <li></li><li></li><li></li><li></li><li></li>
                  <li></li><li></li><li></li><li></li><li></li>
                  <li></li><li></li><li></li><li></li><li></li>
                  <li></li><li></li>
                  <li><a href="../dashboard/login.php">Login</a></li>
              </ul>
          </div>
      </nav>
      <div class="css-xfq28i"></div>
      <br> '
      );
    }
  }


  public static function footerTemplate($controller)
  {
    // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
    $scripts = ('
         <!-- Script de Fontawesome -->
         <script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
         <!-- Script de Bootstrap -->
         <script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         <script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>
         <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
         <script type="text/javascript" src="../../app/helpers/components.js"></script>
         <script type="text/javascript" src="../../app/controllers/account.js"></script>
         <script type="text/javascript" src="../../app/controllers/' . $controller . '"></script>
            ');

    print('
        <hr />
        <div class="css-xfq28i"></div>
        <footer class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <h6>Sobre nosotros</h6>
              <p class="text-justify">MonteSinai es una gran ventana a la formacion en todos los sentidos,
              nuestros libros le ayudan en la aventura del saber, del conocer, de convivir y descubrir. 
              Es un recurso didáctico elaborado con la intención de facilitar los procesos de enseñanza y aprendizaje. 
              Contamos con un portafolio de libros de texto curriculares y no curriculares</p>
            </div>

      <div class="col-xs-6 col-md-3">
        <h6>Recursos para docentes: </h6>
        <ul class="footer-links">
          <li><a href="">Inglés</a></li>
          <li><a href="">Moral, urbanidad y civica</a></li>
          <li><a href="">Ciencias Salud y Medio Ambiente</a></li>
          <li><a href="">Lenguaje y Literatura</a></li>
          <li><a href="">Estudios sociales</a></li>
        </ul>
      </div>

      <div class="col-xs-6 col-md-3">
        <h6>CONTACTO</h6>
        <ul class="footer-links">
          <li><a href="">Contactanos</a></li>
        </ul>
      </div>
    </div>
    <hr>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-6 col-xs-12">
        <script type="text/javascript">
          copyright=new Date();
          update=copyright.getFullYear();
          document.write("Todos los derechos reservados "+"© 2022 - " + update + " " + "MonteSinai");
</script>
        </p>
      </div>

      <div class="col-md-4 col-sm-6 col-xs-12">
        <ul class="social-icons">
          <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
        </ul>
      </div>
    </div>
  </div>
</footer>
' . $scripts . '
</form>
</body>
</html>');
  }
}
