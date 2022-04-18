<?php

class Notas extends Validator
{    
    private $id_nota = null;
    private $nota_libro = null;
    private $nota_promedio = null;
    private $id_asignatura = null;
    private $id_cliente = null;

    public function setId($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_nota = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNotaLibro($value){
        if ($this->validateNaturalNumber($value)) {
            $this->nota_libro = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNotaPromedio($value){
        if ($this->validateNaturalNumber($value)) {
            $this->nota_promedio = $value;
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

    public function setIdCliente($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_cliente = $value;
            return true;
        } else {
            return false;
        }
    }


    // GETTERS

    public function getId(){
        return $this->id_nota;
    }

    public function getNotaLibro(){
        return $this->nota_libro;
    }

    public function getNotaPromedio(){
        return $this->nota_promedio;
    }

    public function getIdAsignatura(){
        return $this->id_asignatura;
    }

    public function getIdCliente(){
        return $this->id_cliente;
    }
    

    //Operaciones

    public function searchRows($value)
    {   
        $sql = 'SELECT cli.nombre_cliente, cli.apellido_cliente,cli.usuario_cliente,
		nota.id_nota, nota.nota_libro, nota.nota_promedio, 
		asig.asignatura
        from notas nota
        inner join asignatura asig using (id_asignatura)
        inner join cliente cli using (id_cliente)
        where cli.nombre_cliente ILIKE ? OR cli.apellido_cliente ILIKE ? OR cli.usuario_cliente ILIKE ? 
		OR asig.asignatura ILIKE ? 
        order by cli.id_cliente';
        $params = array("%$value%","%$value%","%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT cli.nombre_cliente, cli.apellido_cliente,cli.usuario_cliente,
		nota.id_nota, nota.nota_libro, nota.nota_promedio, 
		asig.asignatura
        from notas nota
        inner join asignatura asig using (id_asignatura)
        inner join cliente cli using (id_cliente)
        order by cli.id_cliente asc';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readCliente()
    {
        $sql = 'SELECT cli.id_cliente, cli.correo_cliente
		FROM cliente cli';
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
        $sql = 'INSERT INTO insert into notas(nota_libro,nota_promedio,id_asignatura,id_cliente)values 
        VALUES (?,?,?,?)';
        $params = array($this->nota_libro,$this->nota_promedio,$this->id_asignatura,$this->id_cliente);
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
        $sql = 'SELECT lib.id_libro, lib.nombre_libro, lib.numero_paginas, asig.asignatura, estadlib.estado_libro
        from libro lib
        inner join asignatura asig using (id_asignatura)
        inner join estado_libro  estadlib using (id_estado_libro)
        WHERE id_libro=?';
         $params = array($this->id_libro);
         return Database::getRows($sql, $params);
    }
    
    
}