<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/notas.php');
// En estos if lo que indicaremos es la acción a realizar, si es search, create, update, etc...
if (isset($_GET['action'])) {
    // Indicamos que iniciará sesión
    session_start();
    $notas = new Notas;
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    if (isset($_SESSION['id_empleado'])) {
        switch ($_GET['action']) {
                // Esto se ejecuta en el caso del readall, ya sea al visualizar la tabla o en la accion que se indique que se quieren leer todos los datos de la tabla
            case 'readAll':
                if ($result['dataset'] = $notas->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        // En caso de que no haya ningún empleado registrado en la base de datos, nos tira este mensaje
                        $result['exception'] = 'No hay ningún empleado ingresado en la base de datos';
                    }
                }
                break;
                // En el caso de que la variable action nos detecte que se quiera buscar, se ejecutará lo siguiente
            case 'search':
                $_POST = $notas->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $notas->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
                        }
                        // Esto ocurrirá en el caso de que no existan coincidencias de la busqueda realizada
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                    // En el caso de que esté vacío
                } else {
                    $result['exception'] = 'Ingrese un valor para buscar';
                }
                break;
                // En el caso de que el action detecte que se desea crear o insertar, se ejecutará lo siguiente
            case 'create':
                $_POST = $notas->validateForm($_POST);
                if ($notas->setNotaLibro($_POST['nombrelibro'])) {
                    
                        if ($notas->setIdAsignatura($_POST['asignatura'])) {
                          
                                if ($notas->createRow()) {
                                    $result['status'] = 1;
                                    // Se indica que el empleado se registró existosamente en el caso de que los if se ejecuten automáticamente, caso contrario nos manda los siguientes mensajes
                                    $result['message'] = 'Libro registrado exitosamente.';
                                
                        } else {
                            $result['exception'] = 'Asignatura incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Número de páginas incorrecto';
                    }
                } else {
                    $result['exception'] = 'Nombre de libro incorrecto';
                }
                break;
            case 'readOne':
                if ($notas->setId($_POST['id_libro'])) {
                    if ($result['dataset'] = $notas->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existe el respectivo empleado';
                        }
                    }
                } else {
                    $result['exception'] = 'Empleado erróneo';
                }
                break;
                // Si el action detecta que se desea realizar un update se ejecuta lo siguiente
            case 'update':
                $_POST = $notas->validateForm($_POST);
               
                        if ($notas->setIdAsignatura($_POST['asignatura2'])) {
                          
                                if ($notas->setId($_POST['id_libro2'])) {
                                    if ($notas->updateRow()) {
                                        $result['status'] = 1;
                                        // Se indica que el empleado se registró existosamente en el caso de que los if se ejecuten automáticamente, caso contrario nos manda los siguientes mensajes
                                        $result['message'] = 'Libro modificado exitosamente.';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Libro incorrecto';
                                }
                            } else {
                                $result['exception'] = 'Estado libro incorrecto';
                            }
                     
                break;

                // Si el action detecta que se desea realizar un delete a un dato se ejecuta lo siguiente
            case 'delete':
                if ($notas->setId($_POST['id_libro'])) {
                    if ($data = $notas->readOne()) {
                        if ($notas->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Libro eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Libro inexistente';
                    }
                } else {
                    $result['exception'] = 'Libro incorrecto';
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
