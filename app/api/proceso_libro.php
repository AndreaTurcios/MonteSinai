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
            case 'create3':
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
            case 'createact7':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points7'])) {
                    if ($libros->setLibro($_POST['idlibro7'])) {
                        if ($libros->setId($_POST['idcliente7'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact8':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points8'])) {
                    if ($libros->setLibro($_POST['idlibro8'])) {
                        if ($libros->setId($_POST['idcliente8'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact9':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points9'])) {
                    if ($libros->setLibro($_POST['idlibro9'])) {
                        if ($libros->setId($_POST['idcliente9'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact10':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points10'])) {
                    if ($libros->setLibro($_POST['idlibro10'])) {
                        if ($libros->setId($_POST['idcliente10'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points11'])) {
                    if ($libros->setLibro($_POST['idlibro11'])) {
                        if ($libros->setId($_POST['idcliente11'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact12':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points12'])) {
                    if ($libros->setLibro($_POST['idlibro12'])) {
                        if ($libros->setId($_POST['idcliente12'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact13':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points13'])) {
                    if ($libros->setLibro($_POST['idlibro13'])) {
                        if ($libros->setId($_POST['idcliente13'])) {
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
                    $result['exception'] = 'puntos incorrecto actividad 7';
                }
                break;
            case 'createact14':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points14'])) {
                    if ($libros->setLibro($_POST['idlibro14'])) {
                        if ($libros->setId($_POST['idcliente14'])) {
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
            case 'createact25':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points25'])) {
                    if ($libros->setLibro($_POST['idlibro25'])) {
                        if ($libros->setId($_POST['idcliente25'])) {
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
            case 'createact26':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points26'])) {
                    if ($libros->setLibro($_POST['idlibro26'])) {
                        if ($libros->setId($_POST['idcliente26'])) {
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
            case 'createact29':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points29'])) {
                    if ($libros->setLibro($_POST['idlibro29'])) {
                        if ($libros->setId($_POST['idcliente29'])) {
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
            case 'createact30':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points30'])) {
                    if ($libros->setLibro($_POST['idlibro30'])) {
                        if ($libros->setId($_POST['idcliente30'])) {
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
            case 'createact31':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points31'])) {
                    if ($libros->setLibro($_POST['idlibro31'])) {
                        if ($libros->setId($_POST['idcliente31'])) {
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
                case 'createact32':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['points32'])) {
                        if ($libros->setLibro($_POST['idlibro32'])) {
                            if ($libros->setId($_POST['idcliente32'])) {
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
                case 'createact32':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['points32'])) {
                        if ($libros->setLibro($_POST['idlibro32'])) {
                            if ($libros->setId($_POST['idcliente32'])) {
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
                case 'createactA1U1L11':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['pointsL11'])) {
                        if ($libros->setLibro($_POST['idlibroL11'])) {
                            if ($libros->setId($_POST['idclienteL11'])) {
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
                case 'createactA2U1L11':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['pointsA2U1L11'])) {
                        if ($libros->setLibro($_POST['idlibroA2U1L11'])) {
                            if ($libros->setId($_POST['idclienteA2U1L11'])) {
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
