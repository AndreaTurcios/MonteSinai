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
            case 'readOne':
                if ($usuario->setId($_POST['id_empleado'])) {
                    if ($result['dataset'] = $usuario->readOne()) {
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
            case 'update':
                $_POST = $usuario->validateForm($_POST);
                if ($usuario->setId($_POST['id_empleado2'])) {
                if ($usuario->setNombreUsuario($_POST['nombre_usuario2'])) {
                    if ($usuario->setNombreEmpleado($_POST['nombre_emp2'])) {
                        if ($usuario->setApellidoEmpleado($_POST['apellido_emp2'])) {
                            if ($usuario->setTelefonoEmpleado($_POST['telefono_emp2'])) {
                                    if ($usuario->setEstado($_POST['estado2'])) {
                                        if ($usuario->setCorreo($_POST['correo_emp2'])) {
                                        if ($usuario->setDireccion($_POST['direccion_emp2'])) {
                                            if ($usuario->setIdLibro($_POST['libro2'])) {
                                    if ($usuario->setIDTipoEmpleado($_POST['tipoemp2'])) {
                                        if ($usuario->updateRow()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Empleado modificado exitosamente';                                                        
                                        } else {
                                            $result['exception'] = Database::getException();                                                        
                                                }  
                                            }else {
                                                $result['exception'] ='Tipo empleado incorrecto';
                                                  }
                                                }else {
                                                    $result['exception'] ='Libro incorrecto';
                                                      }
                                    }else {
                                        $result['exception'] ='Estado empleado incorrecto';
                                          }
                                        } else {
                                            $result['exception'] = 'Correo incorrecto';
                                                }
                            } else {
                                $result['exception'] = 'Teléfono incorrecto';
                                    }
                        } else {
                            $result['exception'] = 'Claves diferentes';
                                }
                    }else {
                        $result['exception'] ='Nombre de usuario incorrecto';
                          }
                }else {
                    $result['exception'] ='Estado incorrecto';
                      } 
                    }else {
                        $result['exception'] ='Estado incorrecto';
                          } 
                    }else {
                        $result['exception'] ='Empleado incorrecto';
                          }
            break;
            case 'delete':
                if ($usuario->setId($_POST['id_empleado'])) {
                    if ($data = $usuario->readOne()) {
                        if ($usuario->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Empleado eliminado correctamente'; 
                           
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Empleado inexistente';
                    }
                } else {
                    $result['exception'] = 'Proveedor incorrecto';
                }
                break; 
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
                    $result['message'] = 'Se ha cerrado la sesión para el usuario '.$_SESSION['usuario'];          
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
                            case 'create':
                                $_POST = $usuario->validateForm($_POST);
                                if ($usuario->validatePasswordAlias($_POST['clave_emp'],$_POST['nombre_usuario'])) {
                                    if ($usuario->setNombreUsuario($_POST['nombre_usuario'])) {
                                        if ($usuario->setNombreEmpleado($_POST['nombre_emp'])) {
                                            if ($usuario->setApellidoEmpleado($_POST['apellido_emp'])) {
                                                if ($usuario->setTelefonoEmpleado($_POST['telefono_emp'])) {
                                                    if ($usuario->setDireccion($_POST['direccion_emp'])) {
                                                    if ($_POST['clave_emp'] == $_POST['claveconf']) {
                                                        if ($usuario->setClaveEmpleado($_POST['clave_emp'])) {
                                                            if ($usuario->setEstado($_POST['estado'])) {
                                                                if ($usuario->setIDTipoEmpleado($_POST['tipoemp'])) {
                                                                        if ($usuario->setCorreo($_POST['correo_emp'])) {
                                                                            if ($usuario->setIdLibro($_POST['libro'])) {
                                                                    if ($usuario->createRow()) {
                                                                    $result['status'] = 1;
                                                                    // Se indica que el empleado se registró existosamente en el caso de que los if se ejecuten automáticamente, caso contrario nos manda los siguientes mensajes
                                                                    $result['message'] = 'Empleado registrado exitosamente';                                                        
                                                                    } else {
                                                                        $result['exception'] = Database::getException();                                                        
                                                                    }  
                                                                }else {
                                                                    $result['exception'] ='Libro incorrecto';
                                                                }
                                                                }else {
                                                                    $result['exception'] ='Correo incorrecto';
                                                                }
                                                                }else {
                                                                    $result['exception'] ='Tipo empleado incorrecto';
                                                                }
                                                            }else {
                                                                $result['exception'] ='Estado empleado incorrecto';
                                                                }
                                                        }else {
                                                            $result['exception'] ='Clave demasiado corta';
                                                            $result['exception'] = $empleados->getPasswordError();
                                                            }
                                                            }else {
                                                                $result['exception'] ='Contraseñas no coinciden';
                                                                }
                                                    } else {
                                                        $result['exception'] = 'Direccion incorrecta';
                                                            }
                                                        } else {
                                                            $result['exception'] = 'Teléfono incorrecto';
                                                                }
                                                } else {
                                                    $result['exception'] = 'Apellido de empleado incorrecto';
                                                        }
                                            }else {
                                                $result['exception'] ='Nombre de empleado incorrecto';
                                                }
                                        }else {
                                            $result['exception'] ='Nombre de usuario incorrecto';
                                            }
                                    }else {
                                        $result['exception'] ='No utilice su nombre de usuario como contraseña';
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
                case 'create':
                    $_POST = $usuario->validateForm($_POST);
                    if ($usuario->validatePasswordAlias($_POST['clave_emp'],$_POST['nombre_usuario'])) {
                        if ($usuario->setNombreUsuario($_POST['nombre_usuario'])) {
                            if ($usuario->setNombreEmpleado($_POST['nombre_emp'])) {
                                if ($usuario->setApellidoEmpleado($_POST['apellido_emp'])) {
                                    if ($usuario->setTelefonoEmpleado($_POST['telefono_emp'])) {
                                        if ($usuario->setDireccion($_POST['direccion_emp'])) {
                                        if ($_POST['clave_emp'] == $_POST['claveconf']) {
                                            if ($usuario->setClaveEmpleado($_POST['clave_emp'])) {
                                                if ($usuario->setEstado($_POST['estado'])) {
                                                    if ($usuario->setIDTipoEmpleado($_POST['tipoemp'])) {
                                                            if ($usuario->setCorreo($_POST['correo_emp'])) {
                                                                if ($usuario->setIdLibro($_POST['libro'])) {
                                                        if ($usuario->createRow()) {
                                                        $result['status'] = 1;
                                                        // Se indica que el empleado se registró existosamente en el caso de que los if se ejecuten automáticamente, caso contrario nos manda los siguientes mensajes
                                                        $result['message'] = 'Empleado registrado exitosamente';                                                        
                                                        } else {
                                                            $result['exception'] = Database::getException();                                                        
                                                        }  
                                                    }else {
                                                        $result['exception'] ='Libro incorrecto';
                                                    }
                                                    }else {
                                                        $result['exception'] ='Correo incorrecto';
                                                    }
                                                    }else {
                                                        $result['exception'] ='Tipo empleado incorrecto';
                                                    }
                                                }else {
                                                    $result['exception'] ='Estado empleado incorrecto';
                                                    }
                                            }else {
                                                $result['exception'] ='Clave demasiado corta';
                                                $result['exception'] = $empleados->getPasswordError();
                                                }
                                                }else {
                                                    $result['exception'] ='Contraseñas no coinciden';
                                                    }
                                        } else {
                                            $result['exception'] = 'Direccion incorrecta';
                                                }
                                            } else {
                                                $result['exception'] = 'Teléfono incorrecto';
                                                    }
                                    } else {
                                        $result['exception'] = 'Apellido de empleado incorrecto';
                                            }
                                }else {
                                    $result['exception'] ='Nombre de empleado incorrecto';
                                    }
                            }else {
                                $result['exception'] ='Nombre de usuario incorrecto';
                                }
                        }else {
                            $result['exception'] ='No utilice su nombre de usuario como contraseña';
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
                                $_SESSION['id_empleado'] = $usuario->getId();
                                $_SESSION['correo_empleado'] = $usuario->getCorreo();
                                $_SESSION['usuario'] = $usuario->getNombreUsuario();
                                $_SESSION['id_tipo_empleado'] = $usuario->getIDTipoEmpleado();  
                                $result['status'] = 1;
                                $result['message'] = 'Welcome, '.$_SESSION['usuario'];
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