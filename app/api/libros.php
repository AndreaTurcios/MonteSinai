<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/libros.php');
// En estos if lo que indicaremos es la acción a realizar, si es search, create, update, etc...
if (isset($_GET['action'])) {
    // Indicamos que iniciará sesión
    session_start();
    $libros = new Libros;
    $result = array('status' => 0, 'message' => null, 'exception' => null);
        switch ($_GET['action']) {
            // Esto se ejecuta en el caso del readall, ya sea al visualizar la tabla o en la accion que se indique que se quieren leer todos los datos de la tabla
            case 'readAll':
                if ($result['dataset'] = $libros->readAll()) {
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
                $_POST = $libros->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $libros->searchRows($_POST['search'])) {
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
                $_POST = $libros->validateForm($_POST);
                if ($libros->validatePasswordAlias($_POST['clave_emp'],$_POST['nombre_usuario'])) {
                   
                                                    if ($libros->createRow()) {
                                                    $result['status'] = 1;
                                                    // Se indica que el empleado se registró existosamente en el caso de que los if se ejecuten automáticamente, caso contrario nos manda los siguientes mensajes
                                                    $result['message'] = 'Empleado registrado exitosamente';                                                        
                                                    } else {
                                                        $result['exception'] = Database::getException();                                                        
                                                    }  
                                                }else {
                                                    $result['exception'] ='Correo incorrecto';
                                                }
                                              
                    
            break;
                // En el caso de que el action detecte que se desea únicamente leer un id en específico nos 
                //ejecuta la siguiente acción, en caso contrario nos indica que el empleado que se intenta 
                //seleccionar no existe
                case 'readOne':
                if ($libros->setId($_POST['id_empleado'])) {
                    if ($result['dataset'] = $libros->readOne()) {
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
                /*case 'update':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setId($_POST['id_empleado2'])) {
                                            if ($libros->updateRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Empleado modificado exitosamente';                                                        
                                            } else {
                                                $result['exception'] = Database::getException();                                                        
                                                    }  
                                                }else {
                                                    $result['exception'] ='Tipo empleado incorrecto';
                    }
                break;
                */
            // Si el action detecta que se desea realizar un delete a un dato se ejecuta lo siguiente
            case 'delete':
                if ($libros->setId($_POST['id_libro'])) {
                    if ($data = $libros->readOne()) {
                        if ($libros->deleteRow()) {
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
    print(json_encode('Recurso no disponible'));
}