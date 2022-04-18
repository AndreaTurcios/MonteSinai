<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class cliente_grado extends Validator{
    // Declaración de atributos (propiedades).
    private $id_grado=null;
    private $grado = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_grado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setGrado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->grado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id_grado;
    }

    public function getGrado()
    {
        return $this->grado;
    }
    public function var()
    {
        $sql = '';
        $params = null;
     return Database::getRows($sql, $params); 
    }

     /*
    *   Método para realizar la operación readall
    */

    public function readAllC()
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente,telefono_cliente, dui_cliente, direccion_cliente, correo_cliente, 
        usuario_cliente, clave_cliente,foto_cliente, ec.estado, lib.nombre_libro, grad.grado
        FROM cliente 
        INNER JOIN estado_cliente ec using(id_estado_cliente) 
        INNER JOIN libro lib using(id_libro) 
        INNER JOIN grado grad using(id_grado) 
        ORDER BY id_cliente  ';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_grado, grado from grado
                ORDER BY id_grado asc';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readCliente()
    {
        $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente,telefono_cliente, dui_cliente, direccion_cliente, correo_cliente, 
        usuario_cliente, clave_cliente,foto_cliente, ec.estado, lib.nombre_libro, grad.grado
        FROM cliente 
        INNER JOIN estado_cliente ec using(id_estado_cliente) 
        INNER JOIN libro lib using(id_libro) 
        INNER JOIN grado grad using(id_grado) 
        WHERE grad.id_grado=?
        ORDER BY grad.id_grado';
        $params = array($this->id_grado);
        return Database::getRows($sql, $params);
    }
    /*public function readEmpleado()
    {
        $sql = 'SELECT od.tipoemp, em.id_empleado, em.nombre_usuario, em.nombre_emp,em.apellido_emp,em.telefono_emp,em.estado
        FROM empleado em
        INNER JOIN tipoempleado od on em.id_tipo_emp = od.id_tipo_emp
        WHERE od.id_tipo_emp = ?
        ORDER BY od.tipoemp';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }*/


}
