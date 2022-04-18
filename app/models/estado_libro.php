<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class estado_libro extends Validator{
    // Declaración de atributos (propiedades).
    private $id_estado_libro=null;
    private $estado_libro = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_estado_libro = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setEstadoLibro($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->estado_libro = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id_estado_libro;
    }

    public function getEstadoLibro()
    {
        return $this->estado_libro;
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
        $sql = 'SELECT id_estado_libro, estado_libro
                FROM estado_libro
                ORDER BY id_estado_libro asc';
        $params = null;
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
