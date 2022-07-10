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
            case 'createact15':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points15'])) {
                    if ($libros->setLibro($_POST['idlibro15'])) {
                        if ($libros->setId($_POST['idcliente15'])) {
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
            case 'createact17':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points17'])) {
                    if ($libros->setLibro($_POST['idlibro17'])) {
                        if ($libros->setId($_POST['idcliente17'])) {
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
            case 'createact20':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points20'])) {
                    if ($libros->setLibro($_POST['idlibro20'])) {
                        if ($libros->setId($_POST['idcliente20'])) {
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
            case 'createact23':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points23'])) {
                    if ($libros->setLibro($_POST['idlibro23'])) {
                        if ($libros->setId($_POST['idcliente23'])) {
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
            case 'createact33':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points33'])) {
                    if ($libros->setLibro($_POST['idlibro33'])) {
                        if ($libros->setId($_POST['idcliente33'])) {
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
            case 'createact34':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points34'])) {
                    if ($libros->setLibro($_POST['idlibro34'])) {
                        if ($libros->setId($_POST['idcliente34'])) {
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
            case 'createact35':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points35'])) {
                    if ($libros->setLibro($_POST['idlibro35'])) {
                        if ($libros->setId($_POST['idcliente35'])) {
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
            case 'createact36':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points36'])) {
                    if ($libros->setLibro($_POST['idlibro36'])) {
                        if ($libros->setId($_POST['idcliente36'])) {
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
            case 'createact43':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points43'])) {
                    if ($libros->setLibro($_POST['idlibro43'])) {
                        if ($libros->setId($_POST['idcliente43'])) {
                            if ($libros->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'successentra';
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
            case 'createact72':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points72'])) {
                    if ($libros->setLibro($_POST['idlibro72'])) {
                        if ($libros->setId($_POST['idcliente72'])) {
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
            case 'createact91':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points91'])) {
                    if ($libros->setLibro($_POST['idlibro91'])) {
                        if ($libros->setId($_POST['idcliente91'])) {
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
            case 'createact107':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points107'])) {
                    if ($libros->setLibro($_POST['idlibro107'])) {
                        if ($libros->setId($_POST['idcliente107'])) {
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
            case 'createact109':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['points109'])) {
                    if ($libros->setLibro($_POST['idlibro109'])) {
                        if ($libros->setId($_POST['idcliente109'])) {
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
            case 'createactA3U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA3U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA3U1L11'])) {
                        if ($libros->setId($_POST['idclienteA3U1L11'])) {
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
            case 'createactA4U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA4U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA4U1L11'])) {
                        if ($libros->setId($_POST['idclienteA4U1L11'])) {
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
            case 'createactA6U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA6U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA6U1L11'])) {
                        if ($libros->setId($_POST['idclienteA6U1L11'])) {
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
            case 'createactA7U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA7U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA7U1L11'])) {
                        if ($libros->setId($_POST['idclienteA7U1L11'])) {
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
            case 'createactA8U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA8U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA8U1L11'])) {
                        if ($libros->setId($_POST['idclienteA8U1L11'])) {
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
            case 'createactA9U1L11':
                $_POST = $libros->validateForm($_POST);
                if ($libros->setPromedio($_POST['pointsA9U1L11'])) {
                    if ($libros->setLibro($_POST['idlibroA9U1L11'])) {
                        if ($libros->setId($_POST['idclienteA9U1L11'])) {
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
                case 'createactA11U1L11':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['pointsA11U1L11'])) {
                        if ($libros->setLibro($_POST['idlibroA11U1L11'])) {
                            if ($libros->setId($_POST['idclienteA11U1L11'])) {
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
                case 'createactA12U1L11':
                    $_POST = $libros->validateForm($_POST);
                    if ($libros->setPromedio($_POST['pointsA12U1L11'])) {
                        if ($libros->setLibro($_POST['idlibroA12U1L11'])) {
                            if ($libros->setId($_POST['idclienteA12U1L11'])) {
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
