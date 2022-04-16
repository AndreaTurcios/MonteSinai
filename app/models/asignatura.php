<?php
/*
*	Clase para manejar la tabla productos de la base de datos. Es clase hija de Validator.
*/
class asignatura extends Validator{
    // Declaración de atributos (propiedades).
    private $id_asignatura=null;
    private $asignatura = null;

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_asignatura = $value;
            return true;
        } else {
            return false;
        }
    }
    public function setAsignatura($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->asignatura = $value;
            return true;
        } else {
            return false;
        }
    }
    public function getId()
    {
        return $this->id_asignatura;
    }

    public function getAsignatura()
    {
        return $this->asignatura;
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
        $sql = 'SELECT id_asignatura, asignatura
                FROM asignatura
                ORDER BY id_asignatura asc';
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
