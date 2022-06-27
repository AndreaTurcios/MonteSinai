<?php
/*
*	Clase para definir las plantillas de las páginas web
*/
class Book_Page
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
        /*	(6, 'Alumno');--visualizar su libro*/
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['id_empleado'])) {
            // En este apartado se corrobora que el id de tipo usuario corresponda a uno de la tabla tipo empleados, y muestre la vista respectiva a cada tipo de usuario
            if ($_SESSION['id_tipo_empleado'] == 1) { //Root
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
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- new stylesheet  -->
                    <link rel="stylesheet" href="../../resources/css/coloringstyles.css">
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">
                <input class="d-none" id="users" name="users" value="' . $_SESSION['id_empleado'] . '"/>                
            ');
            } else if ($_SESSION['id_tipo_empleado'] == 2) { //Administrador
                print(' <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- Agregamos Bootstrap -->
                    <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">'
                );
            } else if ($_SESSION['id_tipo_empleado'] == 3) { //Profesor
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
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">'
                );
            } else if ($_SESSION['id_tipo_empleado'] == 4) { //Director
                print(' <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- Agregamos Bootstrap -->
                    <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">'
                );
            } else if ($_SESSION['id_tipo_empleado'] == 5) { //Padre de familia
                print(' <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- Agregamos Bootstrap -->
                    <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">'
                );
            } else if ($_SESSION['id_tipo_empleado'] == 6) { //Alumno
                print(' <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- Agregamos Bootstrap -->
                    <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                    <title>Monte Sinai - ' . $title . '</title>
                    <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                    <!-- old stylesheet  -->
                    <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                    <!-- turns.js librerias  -->
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                    <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
                
                </head>
                <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">'
                );
            } else {
                header('location: principal.php');
            }
        } else if (isset($_SESSION['id_cliente'])) {
            print(' <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- Agregamos Bootstrap -->
                <link rel="stylesheet" href="../../resources/css/bootstrap/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
                <title>Monte Sinai - ' . $title . '</title>
                <link rel="shortcut icon" href="../../resources/img/logosinai.png" type="image/x-icon">
                <!-- old stylesheet  -->
                <!-- <link rel="stylesheet" href="../../resources/css/bookstyles.css"> -->
                <!-- turns.js librerias  -->
                <script type="text/javascript" src="../../resources/js/turnjs4/extras/jquery.min.1.7.js"></script>
                <script type="text/javascript" src="../../resources/js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
                <script type="text/javascript" src="../../resources/js/turnjs4/lib/hash.js"></script>
            
            </head>
            <body style="background-image: url(../../resources/img/BOOKS/back.jpg);">
            <input type="hidden"  id="users" name="users" value="' . $_SESSION['id_cliente'] . '"/>
            '

            );
        } else {
            header('location: principal.php');
        }
    }


    public static function footerTemplate($game)
    {
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.

        print('
        </body>
        <script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
        <!-- Script de Bootstrap -->
        <script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>   
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
        <script type="text/javascript" src="../../app/helpers/components.js"></script>
        <script type="text/javascript" src="../../app/controllers/account.js"></script>
        <script type="text/javascript" src="../../app/controllers/controladoreslibros/' . $game . '"></script>
        <!-- <script type="text/javascript" src="../../app/controllers/"></script> -->
        </html>');
    }

    public static function footerTemplate6($game)
    {
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.

        print('
        </body>
        <link rel="stylesheet" href="../../resources/js/wordfind/wordfind.css">
        <script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
        <!-- Script de Bootstrap -->
        <script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>   
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
        <script type="text/javascript" src="../../app/helpers/components.js"></script>
        <script type="text/javascript" src="../../app/controllers/account.js"></script>
        <script type="text/javascript" src="../../resources/js/wordfind/wordfind.js"></script>
        <script type="text/javascript" src="../../resources/js/wordfind/wordfindgame.js"></script>
        <script type="text/javascript" src="../../app/controllers/controladoreslibros/' . $game . '"></script>
        <!-- <script type="text/javascript" src="../../app/controllers/"></script> -->
        </html>');
    }

    public static function footerTemplateBook2($game)
    {
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.

        print('
        </body>
        <script src="https://kit.fontawesome.com/592eb2e9e3.js" crossorigin="anonymous"></script>
        <!-- Script de Bootstrap -->
        <script type="text/javascript" src="../../resources/js/autocomplete.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../resources/js/vanilla-dataTables.min.js"></script>
        <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
        <script type="text/javascript" src="../../app/helpers/components.js"></script>
        <script type="text/javascript" src="../../app/controllers/account.js"></script>
        <script type="text/javascript" src="../../app/controllers/controladoreslibros/BookTwoUnitTwo/' . $game . '"></script>
        <!-- <script type="text/javascript" src="../../app/controllers/"></script> -->
        </html>');
    }
}
