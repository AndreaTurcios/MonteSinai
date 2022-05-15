<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/procesos_libros.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente. 
    $libros = new Procesos_libros;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API. 
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'create':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points'])) {
                    if ($libros->setLibro($_POST['idlibro'])) {
                        if ($libros->setId($_POST['idcliente'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'success';
                            } else {
                                $result['exception'] = Database::getException();;
                            }
                        } else {
                            $result['exception'] = 'cliente incorrecto';
                        }
                    } else {
                        $result['exception'] = 'libro incorrecto';
                    }
                } else {
                    $result['exception'] = 'puntos incorrecto';
                }
                break;
            case 'createact5':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points5'])) {
                    if ($libros->setLibro($_POST['idlibro5'])) {
                        if ($libros->setId($_POST['idcliente5'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'success';
                            } else {
                                $result['exception'] = Database::getException();;
                            }
                        } else {
                            $result['exception'] = 'cliente incorrecto';
                        }
                    } else {
                        $result['exception'] = 'libro incorrecto';
                    }
                } else {
                    $result['exception'] = 'puntos incorrecto';
                }
                break;
            case 'createact2':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points3'])) {
                    if ($libros->setLibro($_POST['idlibro3'])) {
                        if ($libros->setId($_POST['idcliente3'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'success';
                            } else {
                                $result['exception'] = Database::getException();;
                            }
                        } else {
                            $result['exception'] = 'cliente incorrecto';
                        }
                    } else {
                        $result['exception'] = 'libro incorrecto';
                    }
                } else {
                    $result['exception'] = 'puntos incorrecto';
                }
                break;
            case 'createact4':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points4'])) {
                    if ($libros->setLibro($_POST['idlibro4'])) {
                        if ($libros->setId($_POST['idcliente4'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'success';
                            } else {
                                $result['exception'] = Database::getException();;
                            }
                        } else {
                            $result['exception'] = 'cliente incorrecto';
                        }
                    } else {
                        $result['exception'] = 'libro incorrecto';
                    }
                } else {
                    $result['exception'] = 'puntos incorrecto';
                }
                break;
            case 'createact6':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points6'])) {
                    if ($libros->setLibro($_POST['idlibro6'])) {
                        if ($libros->setId($_POST['idcliente6'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'success';
                            } else {
                                $result['exception'] = Database::getException();;
                            }
                        } else {
                            $result['exception'] = 'cliente incorrecto';
                        }
                    } else {
                        $result['exception'] = 'libro incorrecto';
                    }
                } else {
                    $result['exception'] = 'puntos incorrecto';
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
