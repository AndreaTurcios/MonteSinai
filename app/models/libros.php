<?php

class Libros extends Validator
{    
    private $id_libro = null;
    private $nombre_libro = null;
    private $numero_paginas = null;
    private $id_asignatura = null;
    private $id_indicador = null;
    private $id_estado_libro = null;
    private $direccion_libro = '../../resources/docs/bitacora/';

    public function setId($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_libro = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombreLibro($value){
        if ($this->validateString($value,1,35)) {
            $this->nombre_libro = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNumeroPaginas($value){
        if ($this->validateNaturalNumber($value)) {
            $this->numero_paginas = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdAsignatura($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_asignatura = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdIndicador($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_indicador = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdEstadoLibro($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_estado_libro = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setArchivo($file)
    {
        if ($this->validatePDFFile($file)) {
            $this->archivo = $this->getFileName();
            return true;
        } else {
            return false;
        }
    }

    // GETTERS

    public function getId(){
        return $this->id_libro;
    }

    public function getNombreLibro(){
        return $this->nombre_libro;
    }

    public function getNumeroPaginas(){
        return $this->numero_paginas;
    }

    public function getIdAsignatura(){
        return $this->id_asignatura;
    }

    public function getIdIndicador(){
        return $this->id_indicador;
    }

    public function getIdEstadoLibro(){
        return $this->id_estado_libro;
    }

    public function getDireccionLibro(){
        return $this->direccion_libro;
    }
    

    //Operaciones

    public function searchRows($value)
    {   
        $sql = 'SELECT lib.id_libro, lib.nombre_libro, lib.numero_paginas, asig.asignatura, estadlib.estado_libro
        from libro lib
        inner join asignatura asig using (id_asignatura)
        inner join estado_libro  estadlib using (id_estado_libro)
        where lib.nombre_libro ILIKE ? OR asig.asignatura ILIKE ? 
        order by lib.id_libro';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT lib.id_libro, lib.nombre_libro, lib.numero_paginas, asig.asignatura, estadlib.estado_libro
        from libro lib
        inner join asignatura asig using (id_asignatura)
        inner join estado_libro  estadlib using (id_estado_libro)
        order by lib.id_libro asc';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readLibros()
    {
        $sql = 'SELECT id_libro, nombre_libro FROM libro';
        $params = null;
        return Database::getRows($sql, $params);
    }


    public function readEstadoLibro()
    {
        $sql = 'SELECT id_estado_libro, estado_libro FROM estado_libro';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readIndicadorLogro()
    {
        $sql = 'SELECT id_indicador, indicador,indicador2,indicador3,indicador4,indicador5,indicador6,indicador7,indicador8,indicador9,indicador10 FROM indicador_logro';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readAsignatura()
    {
        $sql = 'SELECT id_asignatura, asignatura FROM asignatura';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO libro(nombre_libro, numero_paginas,id_asignatura,id_estado_libro) 
        VALUES (?,?,?,?)';
        $params = array($this->nombre_libro,$this->numero_paginas,$this->id_asignatura,$this->id_estado_libro);
        return Database::executeRow($sql, $params);
    }

    public function updateRow()
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        //($this->archivo) ? $this->deleteFile($this->getDireccionLibro(), $current_archivo) : $this->archivo = $current_archivo;

        $sql = 'UPDATE libro 
        SET nombre_libro=?,numero_paginas = ?, id_asignatura = ?, id_indicador = ?, 
        id_estado_libro = ? WHERE id_libro = ?';
        $params = array($this->nombre_libro,$this->numero_paginas,$this->id_asignatura,$this->id_indicador,$this->id_estado_libro,$this->id_libro);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM libro
                WHERE id_libro = ?';
        $params = array($this->id_libro);
        return Database::executeRow($sql, $params);
    }

    public function readOne()
    {  
        $sql = 'SELECT lib.id_libro, lib.nombre_libro, lib.numero_paginas, asig.asignatura, estadlib.estado_libro
        from libro lib
        inner join asignatura asig using (id_asignatura)
        inner join estado_libro  estadlib using (id_estado_libro)
        WHERE lib.id_libro = ?';
        $params = array($this->id_libro);
        return Database::getRow($sql, $params);
    }

    public function readReport()
    {
        $sql = 'SELECT nombre_cli, nombre_emp, fecha, hora, tiposervicio,
        nombre_equipo, estado_equipo, tipo_pago, archivo, ubicacion from bitacora
        INNER JOIN equipo using(id_equipo) 
        INNER JOIN estado_equipo using(id_estado_equipo)
        INNER JOIN clientes using(id_cliente)
        INNER JOIN empleado using(id_empleado)
        INNER JOIN tiposervicio using(id_tipo_servicio)
        INNER JOIN tipo_pago using(id_tipo_pago)  
        WHERE id_bitacora = ?';
         $params = array($this->id_bitacora);
         return Database::getRows($sql, $params);
    }
    
    
}