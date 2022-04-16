<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class estadoEmpleado extends Validator{
    // Declaración de atributos (propiedades).
    private $id=null;
    private $estadoempleado = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstadoEmpleado($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->estadoempleado = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id;
    }

    public function getEstadoEmpleado()
    {
        return $this->estadoempleado;
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

    public function readAll()
    {
        $sql = 'SELECT id_estado_empleado, estado_empleado
                FROM estado_empleado
                ORDER BY id_estado_empleado asc';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readEmpleado()
    {
        $sql = 'SELECT od.tipoemp, em.id_empleado, em.nombre_usuario, em.nombre_emp,em.apellido_emp,em.telefono_emp,em.estado
        FROM empleado em
        INNER JOIN tipoempleado od on em.id_tipo_emp = od.id_tipo_emp
        WHERE od.id_tipo_emp = ?
        ORDER BY od.tipoemp';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }


}
