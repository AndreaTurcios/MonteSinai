<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/empleados.php');
    $usuario = new Empleados;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        switch ($_GET['action']) {
            
            case 'logIn':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->checkUser($_POST['username'])) {
                    if ($usuario->checkPassword($_POST['clave'])) {
                        $_SESSION['id_empleado'] = $usuario->getId();
                        $_SESSION['correo_empleado'] = $usuario->getCorreo();
                        $_SESSION['usuario'] = $usuario->getNombreUsuario();
                        $_SESSION['id_tipo_empleado'] = $usuario->getIDTipoEmpleado();
                        $result['status'] = 1;
                        $result['message'] = 'Welcome, ' . $_SESSION['usuario'];
                    }
                    else if ($usuario->checkPassword($_POST['clave'])) {
                        $result['status'] = 1;
                        $_SESSION['id_cliente'] = $usuario->getIdCliente();
                        $_SESSION['usuario_cliente'] = $usuario->getNombreUsuarioCliente();
                        $result['message'] = 'Welcome, ' . $_SESSION['usuario_cliente'];
                    }
                    else{
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Clave incorrecta';
                        }
                    }
                } else {
                        if (/*$usuario->checkPasswordCliente($_POST['clave']) && */$usuario->checkUserCliente($_POST['username'])) {
                            $result['status'] = 1;
                            $_SESSION['id_cliente'] = $usuario->getIdCliente();
                            $_SESSION['usuario_cliente'] = $usuario->getNombreUsuarioCliente();
                           
                        } else {
                            $result['exception'] = 'Usuario y contraseña erróneos.';
                        }
                        if (Database::getException()) {
                            $result['exception'] = Database::getException(); 
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible fuera de la sesión';
        
    }
    // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
    header('content-type: application/json; charset=utf-8');
    // Se imprime el resultado en formato JSON y se retorna al controlador.
    print(json_encode($result));
} else {
    print(json_encode('Recurso no disponible'));
}
