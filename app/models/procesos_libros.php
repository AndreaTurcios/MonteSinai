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
        $sql = 'SELECT * FROM Procesos_control_libros (?,?,?)';
        $params = array($this->id,$this->libro,$this->promedio);
        return Database::executeRow($sql, $params);
    }

    

}