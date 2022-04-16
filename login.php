<?php

include_once('conexion/conexion.php');

session_start();


if(isset($_GET['cerrar_sesion'])){
session_unset();
session_destroy();

}


if(isset($_SESSION['rol_id'])){
  
  switch($_SESSION['rol_id']){

    case 1:
          header("location:admin.php");
      break;

    case 2:
          header("location:estudiante.php");
      break;

    default:
      
  }
}

if(isset($_POST['username']) && isset($_POST['password'])){

  $username = $_POST['username'];
  $password = $_POST['password'];



  $db = new DB();
  $query = $db->connect()->prepare('select * from usuarios where username = :username and password = :password');

  $query->execute(['username'=>$username,'password'=>$password]);

  $row = $query->fetch(PDO::FETCH_NUM);
  if($row == true){
        //validando el rol.
      $rol = $row[3];
      $_SESSION['rol'] = $rol;

    switch($_SESSION['rol']){

    case 1:
          header("location:admin.php");
    break;

    case 2:
          header("location:estudiante.php");
    break;

    default:
      
  }



  }else{

      //en caso no exista
      echo 'Notice: Username or Password are incorrect!!';

  }







}

?>
<!DOCTYPE html>
<!-- saved from url=(0051)https://getbootstrap.com/docs/4.0/examples/sign-in/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Welcome to Monte Sinai</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="" method="POST">
      <img src="img/logo_sinai.png" alt="" width="296" height="78" class="mb-4">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="username" class="sr-only">Username</label>
      <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
      <br>
      <label for="password" class="sr-only">Password</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">© All rights reserved</p>
    </form>
  

</body></html>