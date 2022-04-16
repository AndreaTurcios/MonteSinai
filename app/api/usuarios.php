<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/empleados.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if(isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $usuario = new Empleados;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        switch ($_GET['action']) {
        case 'readProfile':
                if ($result['dataset'] = $usuario->readProfile()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Usuario inexistente';
                    }
                }
                break;    

                case 'logOut':
                    unset($_SESSION['id_empleado']);
                    $result['status'] = 1;
                    $result['message'] = 'Se ha cerrado la sesión';          
                break;
                case 'sessionTime':
                    if((time() - $_SESSION['tiempo_usuario']) < 300){
                        $_SESSION['tiempo_usuario'] = time();
                    } else{
                       unset($_SESSION['id_empleado'], $_SESSION['usuario'], $_SESSION['tiempo_usuario']);
                        $result['status'] = 1;
                        $result['message'] = 'Se ha cerrado la sesión por inactividad'; 
                    }
                break;

                case 'getDevices':
                    if ($result['dataset'] = $usuario->getDevices()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usted no posee sesiónes registradas.';
                        }   
                    }
                    break;

                    case 'readAll':
                        if ($result['dataset'] = $usuario->readAll()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay usuarios registrados';
                            }
                        }
                        break;
           
           

                        case 'changePassword':
                            if ($usuario->setId($_SESSION['id_empleado'])) {
                                $_POST = $usuario->validateForm($_POST);
                                if ($usuario->checkPassword($_POST['clave_actual'])) {
                                    if ($_POST['clave_actual'] != $_POST['clave_nueva_1']) {
                                        if ($_POST['clave_nueva_1'] == $_POST['clave_nueva_2']) {
                                                if ($usuario->setPasswordAlias($_POST['clave_nueva_1'], $_SESSION['nombre_usuario'])) {
                                                    if ($usuario->setClaveEmpleado($_POST['clave_nueva_1'])) {
                                                        if ($usuario->changePassword()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Contraseña cambiada correctamente, ingrese nuevamente al sistema';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['exception'] = $usuario->getPasswordError();
                                                    }
                                                } else {
                                                    $result['exception'] = 'No puede ingresar su nombre de usuario como contraseña';
                                                }
                                                
                                        } else {
                                            $result['exception'] = 'Claves nuevas diferentes';
                                        }
                                    } else {
                                        $result['exception'] = 'Intente ingresar una contraseña que no sea igual a la anterior';
                                    }    
                                } else {
                                   $result['exception'] = 'Clave actual incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Usuario incorrecto';
                            }
                            break;
              
                default:
                    $result['exception'] = 'Acción no disponible dentro de la sesión';
            }    
        }else {
        // Se compara la acción a realizar cuando el administrador no ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($usuario->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Existe al menos un usuario registrado';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen usuarios registrados';
                    }
                }
                break;
                case 'register':
                    if ($usuario->readAll()) {
                        $result['exception'] = 'Existe al menos un usuario registrado';
                    } else {
                        if (Database::getException()) {
                            $result['error'] = 1;
                            $result['exception'] = Database::getException();
                        } else {
                            $_POST = $usuario->validateForm($_POST);
                            if ($usuario->setNombreEmpleado($_POST['nombres'])) {
                                if ($usuario->setApellidoEmpleado($_POST['apellidos'])) {
                                    if ($usuario->setTelefonoEmpleado($_POST['telefono'])) {
                                        if ($usuario->setCorreo($_POST['correo'])) {
                                            if ($usuario->setNombreUsuario($_POST['alias'])) {
                                                if ($_POST['clave1'] == $_POST['clave2']) {
                                                    if ($usuario->validatePasswordAlias($_POST['clave1'], $_POST['alias'])) {
                                                        if ($usuario->setClaveEmpleado($_POST['clave1'])) {
                                                            if ($usuario->createRowRegister()) {
                                                                $result['status'] = 1;
                                                                $result['message'] = 'Usuario registrado correctamente';
                                                            } else {
                                                                $result['exception'] = Database::getException();
                                                            }
                                                        }else {
                                                            $result['exception'] ='Clave demasiado corta';
                                                            $result['exception'] = $usuario->getPasswordError();
                                                        }
                                                    } else {
                                                        $result['exception'] ='No utilice su nombre de usuario como contraseña';
                                                    }
                                                } else {
                                                    $result['exception'] = 'Claves diferentes';
                                                }
                                            } else {
                                                $result['exception'] = 'Alias incorrecto';
                                            }
                                        } else {
                                            $result['exception'] = 'Correo incorrecto';
                                        }
                                    } else {
                                        $result['exception'] = 'Telefono incorrecto';
                                    }    
                                } else {
                                    $result['exception'] = 'Apellidos incorrectos';
                                }
                            } else {
                                $result['exception'] = 'Nombres incorrectos';
                            }
                        }
                    }
                    break;
            case 'logIn':
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->checkUser($_POST['username'])) {
                        if ($usuario->checkPassword($_POST['clave'])) {
                                $result['status'] = 1;
                                $result['message'] = 'Registro exitoso, '/*.$_SESSION['usuario']*/;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Clave incorrecta';
                            }
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                    }
                    break;
                    case 'tiempocontra':
                        $_POST = $usuario->validateForm($_POST);
                        
                        if ($usuario->checkUser($_POST['username'])) {
                            if ($usuario->getEstado() == true) {
                                if ($usuario->checkPassword($_POST['clave'])) {
                                    if($usuario->obtenerDiff()){
                                        $result['exception'] = 'Debe cambiar su contraseña';
                                    }else{
                                        $result['status'] = 1;
                                        $result['message'] = 'Su contraseña es valida';
                                    }

                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $usuario->agregarIntentosEmp();
                                        $result['exception'] = 'Clave incorrecta';
                                    }
                                }
                            } else {
                                $result['exception'] = 'La cuenta ha sido desactivada';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'Usuario incorrecto';
                            }
                        }
                        break;
                       /* case 'comparar':
                            $_POST = $usuario->validateForm($_POST);
                            if($usuario->checkCodigo2($_POST['codigo'])){
                                $usuario->resetearIntentos();
                                $_SESSION['tiempo_usuario'] = time();
                                $_SESSION['id_empleado'] = $usuario->getId();
                                $_SESSION['nombre_usuario'] = $usuario->getNombreUsuario();
                                $_SESSION['estado'] = $usuario->getEstado();
                                $_SESSION['correo'] = $usuario->getCorreo();
                                $result['status'] = 1;
                                $result['message'] = 'Autenticación correcta';
                                if($usuario->registrarDispositivos()){
                                    $result[''] = 'Ya hay dispositivos registrados';
                                } else{
                                    $usuario->checkDevice();
                                }
                            }else {
                                $result['exception'] = 'Código incorrecto, verifique otra vez';
                            }
                            break;*/
                default:
                    $result['exception'] = 'Acción no disponible fuera de la sesión';    
            }
        }    
            // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
            header('content-type: application/json; charset=utf-8');
            // Se imprime el resultado en formato JSON y se retorna al controlador.
            print(json_encode($result));
    } else{
        print(json_encode('Recurso no disponible'));
    }
    ?>