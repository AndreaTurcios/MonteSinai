<?php 

class Procesos_libros extends Validator{

    private $id = null;
    private $promedio = null;
    private $libro = null;
    private $condicionlibro = null;
    

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setPromedio($value)
    {
        if ($this->validateMoney($value)) {
            $this->promedio = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setLibro($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->libro = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setLibroCondicion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->condicionlibro = $value;
            return true;
        } else {
            return false;
        }
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getPromedio()
    {
        return $this->promedio;
    }

    
    public function getLibro()
    {
        return $this->libro;
    }


    public function getLibroCondicion()
    {
        return $this->condicionlibro;
    }


 //----------------------------  /// ---------------------------------------------------------------------------------------

    
    public function createRow()
    {
        $sql = 'INSERT INTO control_libro  (numero_actividades_trabajadas, id_asignatura, id_libro, id_cliente, id_estado_libro) 
                VALUES (?,1,?,?,(select id_estado_libro from libro where id_libro = ? ))';
        $params = array($this->promedio,$this->libro,$this->id,$this->libro);
        return Database::executeRow($sql, $params);
    }

    

}