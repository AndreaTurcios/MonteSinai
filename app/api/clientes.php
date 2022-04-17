<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/clientes.php');


if (isset($_GET['action'])) {
    session_start();
    $clientes = new Clientes;
    $result = array('status' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION['id_empleado'])) {
        switch ($_GET['action']) {

            case 'readAll':
                if ($result['dataset'] = $clientes->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay clientes registrados';
                    }
                }
                break;

            case 'readEstadosCliente':
                if ($result['dataset'] = $clientes->readEstadosCliente()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay estados registrados';
                    }
                }
                break;
            case 'readOne':
                if ($clientes->setId($_POST['id_cliente2'])) {
                    if ($result['dataset'] = $clientes->readOne()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Cliente inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;

            case 'search':
                $_POST = $clientes->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $clientes->searchRows($_POST['search'])) {
                        $result['status'] = 1;
                        $rows = count($result['dataset']);
                        if ($rows > 1) {
                            $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                        } else {
                            $result['message'] = 'Solo existe una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Hay campos vacios';
                }
                break;

            case 'create':
                $_POST = $clientes->validateForm($_POST);
                if ($clientes->setNombre($_POST['nombre_cli'])) {
                    if (isset($_POST['estado_pago'])) {
                        if ($clientes->setEstadoCliente($_POST['estado_pago'])) {
                            if ($clientes->setTelefono($_POST['telefono_cli'])) {
                                if ($clientes->setDui($_POST['dui_cli'])) {
                                    if ($clientes->setNIT($_POST['nit_cli'])) {
                                        if ($clientes->setDireccion($_POST['direccion_cli'])) {
                                            if ($clientes->setCorreo($_POST['correo_cli'])) {
                                                if ($clientes->createRow()) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Cliente creado correctamente';
                                                } else {
                                                    $result['exception'] = Database::getException();
                                                }
                                            } else {
                                                $result['message'] = 'Nombre Incorrecto';
                                            }
                                        } else {
                                            $result['message'] = 'Direccion Incorrecta';
                                        }
                                    } else {
                                        $result['message'] = 'NIT Incorrecto';
                                    }
                                } else {
                                    $result['message'] = 'DUI Incorrecto';
                                }
                            } else {
                                $result['message'] = 'Telefono Incorrecto';
                            }
                        } else {
                            $result['message'] = 'Estado de cliente Incorrecto';
                        }
                    } else {
                        $result['message'] = 'Seleccione un estado de cliente';
                    }
                } else {
                    $result['message'] = 'Nombre Incorrecta';
                }
                break;



            case 'update':
                $_POST = $clientes->validateForm($_POST);
                if ($clientes->setId($_POST['id_cliente2'])) {
                    if ($data = $clientes->readOne()) {
                        if ($clientes->setNombre($_POST['nombre_cli2'])) {
                            if (isset($_POST['estado_pago2'])) {
                                if ($clientes->setEstadoCliente($_POST['estado_pago2'])) {
                                    if ($clientes->setTelefono($_POST['telefono_cli2'])) {
                                        if ($clientes->setDui($_POST['dui_cli2'])) {
                                            if ($clientes->setNIT($_POST['nit_cli2'])) {
                                                if ($clientes->setDireccion($_POST['direccion_cli2'])) {
                                                    if ($clientes->setCorreo($_POST['correo_cli2'])) {
                                                        if ($clientes->updateRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Cliente actualizado correctamente';
                                                        } else {
                                                            $result['exception'] = Database::getException();
                                                        }
                                                    } else {
                                                        $result['message'] = 'Nombre Incorrecto';
                                                    }
                                                } else {
                                                    $result['message'] = 'Direccion Incorrecta';
                                                }
                                            } else {
                                                $result['message'] = 'NIT Incorrecto';
                                            }
                                        } else {
                                            $result['message'] = 'DUI Incorrecto';
                                        }
                                    } else {
                                        $result['message'] = 'Telefono Incorrecto';
                                    }
                                } else {
                                    $result['message'] = 'Estado de cliente Incorrecto';
                                }
                            } else {
                                $result['message'] = 'Seleccione un estado de cliente';
                            }
                        } else {
                            $result['message'] = 'Nombre Incorrecta';
                        }
                    } else {
                        $result['exception'] = 'Cliente no encontrado';
                    }
                } else {
                    $result['exception'] = 'Cliente no seleccionado';
                }
                break;

            case 'delete':
                if ($clientes->setId($_POST['id_cliente'])) {
                    if ($data = $clientes->readOne()) {
                        if ($clientes->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Cliente eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                    } else {
                        $result['exception'] = 'Cliente inexistente';
                    }
                } else {
                    $result['exception'] = 'Cliente incorrecto';
                }
                break;
            case 'cantidadClientesPago':
                if ($result['dataset'] = $clientes->cantidadClientesPago()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay datos disponibles';
                    }
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
