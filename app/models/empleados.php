<?php

/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../libraries/phpmailer/src/Exception.php';
require '../libraries/phpmailer/src/PHPMailer.php';
require '../libraries/phpmailer/src/SMTP.php';

class Empleados extends Validator
{

    // Declaración de atributos (propiedades).
    private $id = null;
    private $idcliente= null;
    private $direccionemp = null;
    private $nombreusuario = null;
    private $nombreusuariocliente = null;
    private $nombreempleado = null;
    private $apellidoempleado = null;
    private $telefonoempleado = null;
    private $claveempleado = null;
    private $idtipoempleado = null;
    private $estado = null;
    private $acceso = null;
    private $correo = null;
    private $correoError = null;
    private $codigo_recu = null;
    private $fechaHoy = null;
    private $intentosC = null;
    private $idlibro = null;

    private $direccion_empleado = null;


    /*
    *   Métodos para asignar valores a los atributos.
    */

    public function setIdLibro($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idlibro = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idcliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDireccion($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->direccion_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigoRecu($value)
    {
        if ($this->validateAlphanumeric($value, 1, 6)) {
            $this->codigo_recu = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFecha($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->fechaHoy = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPasswordAlias($value, $nombreusuario)
    {
        if ($this->validatePasswordAlias($value, $nombreusuario)) {
            return true;
        } else {
            return false;
        }
    }

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombreusuario = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreUsuarioCliente($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombreusuariocliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreEmpleado($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombreempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellidoEmpleado($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellidoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefonoEmpleado($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefonoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClaveEmpleado($value)
    {
        if ($this->validatePassword($value, 1, 50)) {
            $this->claveempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPasswordNombreUsuario($value, $alias)
    {
        if ($this->validatePasswordAlias($value, $alias, 16)) {
            return true;
        } else {
            return false;
        }
    }

    public function setIDTipoEmpleado($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idtipoempleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAcceso($value)
    {
        if ($this->validateBoolean($value)) {
            $this->acceso = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getAcceso()
    {
        return $this->acceso;
    }

    public function getFecha()
    {
        return $this->fechaHoy;
    }

    public function getNombreUsuario()
    {
        return $this->nombreusuario;
    }

    public function getNombreUsuarioCliente()
    {
        return $this->nombreusuariocliente;
    }

    public function getNombreEmpleado()
    {
        return $this->nombreempleado;
    }

    public function getApellidoEmpleado()
    {
        return $this->apellidoempleado;
    }

    public function getTelefonoEmpleado()
    {
        return $this->telefonoempleado;
    }

    public function getClaveEmpleado()
    {
        return $this->claveempleado;
    }

    public function getIDTipoEmpleado()
    {
        return $this->idtipoempleado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getCorreoError()
    {
        return $this->correoError;
    }

    public function getCodigoRecu()
    {
        return $this->codigo_recu;
    }

    public function getIdLibro()
    {
        return $this->idlibro;
    }

    public function getDireccionEmp()
    {
        return $this->direccion_empleado;
    }

    public function getIdCliente()
    {
        return $this->idcliente;
    }
    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */

    public function searchRows($value)
    {
        $sql = 'SELECT em.id_empleado, em.usuario, em.nombre_empleado,em.apellido_empleado,em.telefono_empleado,em.id_estado_empleado,od.id_tipo_empleado 
                FROM empleado em
                INNER JOIN tipo_empleado od on em.id_tipo_empleado = od.id_tipo_empleado
                WHERE em.nombre_empleado ILIKE ? OR em.apellido_empleado  ILIKE ? OR od.tipo_empleado ILIKE ? OR em.usuario ILIKE ? OR em.telefono_empleado ILIKE ?
                ORDER BY apellido_empleado';
        $params = array("%$value%", "%$value%", "%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $acceso = 'true';
        $fechaHoy = date('Y-m-d');
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->claveempleado, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO empleado(nombre_empleado, apellido_empleado,telefono_empleado,direccion_empleado,correo_empleado,usuario,
        clave,id_tipo_empleado,id_estado_empleado,id_libro)
        VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado, $this->direccion_empleado, $this->correo, $this->nombreusuario, $hash, $this->idtipoempleado, $this->estado, $this->idlibro);
        return Database::executeRow($sql, $params);
    }

    public function createRowRegister()
    {
        $estado = 'true';
        $acceso = 'true';
        $idtipoempleado = 1;
        $fechaHoy = date('Y-m-d');
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->claveempleado, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO empleado (nombre_empleado, apellido_empleado,telefono_empleado,direccion_empleado,correo_empleado,usuario,clave,id_tipo_empleado,id_estado_empleado,id_libro)
        VALUES (? ,?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado, $this->direccionemp, $this->correo, $this->nombreusuario, $hash, $this->idtipoempleado, $this->estado, $this->idlibro);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT em.id_empleado, em.usuario, em.correo_empleado, em.direccion_empleado,em.nombre_empleado,em.apellido_empleado,em.telefono_empleado,ee.empleado,te.tipo_empleado, lib.nombre_libro 
        FROM empleado em
        INNER JOIN tipo_empleado te USING(id_tipo_empleado) 
		INNER JOIN estado_empleado ee USING(id_estado_empleado)  
		INNER JOIN libro lib USING(id_libro)  
        ORDER BY id_empleado';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT em.id_empleado, em.usuario, em.correo_empleado, em.direccion_empleado,em.nombre_empleado,em.apellido_empleado,em.telefono_empleado,ee.empleado,te.tipo_empleado, lib.nombre_libro 
        FROM empleado em
        INNER JOIN tipo_empleado te USING(id_tipo_empleado) 
		INNER JOIN estado_empleado ee USING(id_estado_empleado)  
		INNER JOIN libro lib USING(id_libro)  
		WHERE id_empleado = ?
        ORDER BY usuario';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        // Se encripta la clave por medio del algoritmo bcrypt que genera un string de 60 caracteres.
        $hash = password_hash($this->claveempleado, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado 
                SET nombre_empleado= ?, apellido_empleado= ?,telefono_empleado= ?,direccion_empleado= ?,correo_empleado= ?,usuario= ?,id_tipo_empleado= ?,id_estado_empleado= ?,id_libro= ?
                WHERE id_empleado = ?';
        $params = array($this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado, $this->direccion_empleado, $this->correo, $this->nombreusuario, $this->idtipoempleado, $this->estado, $this->idlibro, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM empleado
                WHERE id_empleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function checkUser($nombreusuario)
    {
        $sql = 'SELECT id_tipo_empleado, id_empleado, usuario, correo_empleado FROM empleado WHERE usuario = ?';
        $params = array($nombreusuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->idtipoempleado = $data['id_tipo_empleado'];
            $this->id = $data['id_empleado'];
            $this->nombreusuario = $data['usuario'];
            $this->correo = $data['correo_empleado'];
           // $this->nombreusuario = $nombreusuario;
            return true;
        } else {
            return false;
        }
    }

    public function checkUserCliente($nombreusuariocliente)
    {
        $sql = 'SELECT id_cliente, usuario_cliente FROM cliente WHERE usuario_cliente = ?';
        $params = array($nombreusuariocliente);
        if ($data = Database::getRow($sql, $params)) {
            $this->idcliente = $data['id_cliente'];
            $this->nombreusuariocliente = $data['usuario_cliente'];
            $this->nombreusuariocliente = $nombreusuariocliente;
            return true;
        } else {
            return false;
        }
    }


    /*verificar*/
    public function checkPasswordCliente($passwordcliente)
    {
        $sql = 'SELECT clave_cliente FROM cliente WHERE id_cliente = ?';
        $params = array($this->idcliente);
        $data = Database::getRow($sql, $params);
            if (password_verify($passwordcliente, $data['clave_cliente'])) {
                return true;
            } else {
                return false;
            }
    }
    /* */
    
    public function checkUserCorreo($correo)
    {
        $sql = 'SELECT id_empleado FROM empleado WHERE correo_empleado = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_empleado'];
            $this->correo = $correo;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT clave FROM empleado WHERE id_empleado = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['clave'])) {
            return true;
        } else {
            return false;
        }
    }
    /**/
    public function readProfile()
    {
        $sql = 'SELECT id_empleado, usuario, nombre_empleado, apellido_empleado, telefono_empleado
        FROM empleado
        WHERE id_empleado = ?';
        $params = array($_SESSION['id_empleado']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE empleado 
                SET nombre_usuario=?,nombre_emp=?,apellido_emp=?,telefono_emp=?
                WHERE id_empleado = ?';
        $params = array($this->nombreusuario, $this->nombreempleado, $this->apellidoempleado, $this->telefonoempleado, $_SESSION['id_empleado']);
        return Database::executeRow($sql, $params);
    }

    public function estadoEmpleadoR()
    {
        $sql = 'SELECT estado, COUNT(nombre_emp) as cantidad
        From empleado 
        Group by estado';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readReport()
    {
        $sql = 'SELECT em.nombre_emp,em.apellido_emp,em.nombre_usuario, em.telefono_emp,te.tipoemp
        FROM empleado em  
        INNER JOIN tipoempleado te USING(id_tipo_emp)
        WHERE id_empleado = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }

    /*
    *   Métodos para generar gráficas.
    */
    public function topEmpleados()
    {
        $sql = 'SELECT nombre_usuario, COUNT(id_agenda) cantidad
        FROM empleado INNER JOIN agenda USING(id_empleado)
        WHERE estado = true
        GROUP BY nombre_usuario ORDER BY cantidad DESC
        LIMIT 3';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function changePassword()
    {
        $fechaHoy = date('Y-m-d');
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->claveempleado, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado SET clave_emp = ? WHERE id_empleado = ?';
        $params = array($hash,  $_SESSION['id_empleado']);
        return Database::executeRow($sql, $params);
    }

    public function restorePassword()
    {
        $fechaHoy = date('Y-m-d');
        // Se transforma la contraseña a una cadena de texto de longitud fija mediante el algoritmo por defecto.
        $hash = password_hash($this->claveempleado, PASSWORD_DEFAULT);
        $sql = 'UPDATE empleado SET clave_emp = ?, fechacontra = ? WHERE id_empleado = ?';
        $params = array($hash, $fechaHoy, $this->id);
        return Database::executeRow($sql, $params);
    }


    //Funciones para contraseña


    public function generarCodigoRecu($longitud)
    {
        //creamos la variable codigo
        $codigo = "";
        //caracteres a ser utilizados
        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        //el maximo de caracteres a usar
        $max = strlen($caracteres) - 1;
        //creamos un for para generar el codigo aleatorio utilizando parametros min y max
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, $max)];
        }
        //regresamos codigo como valor
        return $codigo;
    }

    public function enviarCorreo($correo, $codigo)
    {
        // Inicio
        $mail = new PHPMailer(true);

        // Configuracion SMTP
        $mail->SMTPDebug = 0;                      // Mostrar salida (Desactivar en producción)
        $mail->isSMTP();                                               // Activar envio SMTP
        $mail->Host  = 'smtp.gmail.com';                     // Servidor SMTP
        $mail->SMTPAuth  = true;                                       // Identificacion SMTP
        $mail->Username  = 'recuperacion.megafrio@gmail.com';                  // Usuario SMTP
        $mail->Password  = 'megafrio123';                    // Contraseña SMTP
        $mail->SMTPSecure = 'tls';
        $mail->Port  = 587;
        $mail->setFrom("recuperacion.megafrio@gmail.com", "Megafrio");                // Remitente del correo

        // Destinatarios
        $mail->addAddress($correo);  // Email y nombre del destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Megafrio - Codigo de confirmacion ' . $codigo;
        $mail->Body = 'Estimado cliente, ' . $correo . ' gracias por preferirnos. 
                        Por este medio le enviamos el código de verificación.
                        Su código de seguridad es: <h2>' . $codigo . '</h2>' . ' 
            --
            <br><p>
            𝕔 Megafrio - 2021, El Salvador';
        $mail->AltBody = '𝕔 Megafrio - 2021, El Salvador';

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }



    public function updateCodigo()
    {
        $sql = 'UPDATE empleado SET codigo_recu = ? WHERE id_empleado = ?';
        $params = array($this->codigo_recu, $this->id);
        return Database::getRows($sql, $params);
    }

    public function updateCodigo2($codigo_con)
    {
        $sql = 'UPDATE empleado SET codigo_recu = ? WHERE id_empleado = ?';
        $params = array($codigo_con, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function checkCodigo($restauracion)
    {
        $sql = 'SELECT id_empleado, correo FROM empleado WHERE codigo_recu = ?';
        $params = array($restauracion);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_empleado'];
            $this->correo = $data['correo'];
            return true;
        } else {
            return false;
        }
    }

    public function checkCodigo2($restauracion)
    {
        $sql = 'SELECT id_empleado, codigo_recu, nombre_usuario, correo FROM empleado WHERE correo = ?';
        $params = array($_SESSION['correo']);
        $data = Database::getRow($sql, $params);
        if ($restauracion == $data['codigo_recu']) {
            $this->id = $data['id_empleado'];
            $this->alias = $data['nombre_usuario'];
            $sql = 'UPDATE empleado SET codigo_recu = null WHERE id_empleado = ?';
            $params = array($this->id);
            return Database::executeRow($sql, $params);
        } else {
            return false;
        }
    }

    public function obtenerDiff()
    {
        $sql = 'SELECT fechacontra from empleado where id_empleado = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        $fechaHoy = date('Y-m-d');

        $datetime1 = date_create($fechaHoy);
        $datetime2 = date_create($data['fechacontra']);
        $interval = date_diff($datetime1, $datetime2);
        $tiempo = array();

        foreach ($interval as $valor) {
            $tiempo[] = $valor;
        }

        if ($tiempo[11] >= 90) {
            return true;
        } else {
            return false;
        }
    }

    // Funciones para agregar intentos
    public function agregarIntentosEmp()
    {
        $sql = 'SELECT intentos FROM empleado WHERE id_empleado = ?';
        $params = array($this->id);
        if ($data = Database::getRow($sql, $params)) {
            if ($data['intentos'] >= 3) {

                $sql = 'UPDATE empleado SET estado = false where id_empleado = ?';
                $params = array($this->id);
                return Database::executeRow($sql, $params);
            } else {
                $this->intentosC = $data['intentos'];
                $intentos = $this->intentosC + 1;
                $sql = 'UPDATE empleado SET intentos = ? where id_empleado = ?';
                $params = array($intentos, $this->id);
                return Database::executeRow($sql, $params);
            }
        } else {
            return false;
        }
    }

    public function resetearIntentos()
    {
        $sql = 'UPDATE empleado SET intentos = null where id_empleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    public function registrarDispositivos()
    {
        $dispositivo = php_uname();
        $sql = 'INSERT INTO historial_sesion (id_empleado, dispositivo) VALUES(?,?)';
        $params = array($_SESSION['id_empleado'], $dispositivo);
        return Database::executeRow($sql, $params);
    }


    //Verificar si el dispositivo ya existe
    public function checkDevice()
    {
        $sql = 'SELECT dispositivo FROM historial_sesion WHERE dispositivo = ? AND id_empleado = ?';
        $params = array(php_uname(), $_SESSION['id_empleado']);
        return Database::getRow($sql, $params);
    }

    //Obtener las sesiones de un dispositivo
    public function getDevices()
    {
        $sql = 'SELECT dispositivo, fecha FROM historial_sesion WHERE id_empleado = ?';
        $params = array($_SESSION['id_empleado']);
        return Database::getRows($sql, $params);
    }

    public function checkUserCorreoRecu($correo)
    {
        $sql = 'SELECT id_empleado, estado FROM empleado WHERE correo = ?';
        $params = array($correo);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['id_empleado'];
            $this->estado = $data['estado'];
            $this->correo = $correo;
            return true;
        } else {
            return false;
        }
    }
}
