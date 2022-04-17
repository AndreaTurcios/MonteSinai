<?php

class Clientes extends Validator
{   

    //Variables de Cliente

    private $id_cliente = null;
    private $nombre_cli = null;
    private $telefono_cli = null;
    private $dui_cli = null;
    private $nit_cli = null;
    private $direccion_cli = null;
    private $correo_cli = null;
    private $id_estado_pago = null;

    public function setId($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value){
        if ($this->validateAlphabetic($value, 1 , 140)) {
            $this->nombre_cli= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTelefono($value){
        if ($this->validatePhone($value)) {
            $this->telefono_cli = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDui($value){
        if ($this->validateDUI($value)) {
            $this->dui_cli = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNIT($value){
        if ($this->validateNIT($value)) {
            $this->nit_cli = $value;
            return true;
        } else {
            return false;
        }
    }


    public function setDireccion($value){
        if ($this->validateAlphanumeric($value, 1, 200)) {
            $this->direccion_cli= $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value){
        if ($this->validateEmail($value)) {
            $this->correo_cli = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setEstado($value){
        if ($this->validateNaturalNumber($value)) {
            $this->id_estado_pago = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId(){
        return $this->id_cliente;
    }

    public function getNombre(){
        return $this->nombre_cli;
    }

    public function getTelefono(){
        return $this->telefono_cli;
    }

    public function getDui(){
        return $this->dui_cli;
    }

    public function getNit(){
        return $this->nit_cli;
    }

    public function getDireccion(){
        return $this->direccion_cli;
    }

    public function getCorreo(){
        return $this->correo_cli;
    }

    public function getEstado(){
        return $this->id_estado_pago;
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_cliente, nombre_cli, telefono_cli, dui_cli, nit_cli, direccion_cli, correo_cli, estado_pago  
        FROM clientes INNER JOIN estado_pago using(id_estado_pago) WHERE nombre_cli ILIKE ?';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function readAll()
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

    public function readCliente()
    {
        $sql = 'SELECT cli.id_cliente, cli.nombre_cli, cli.telefono_cli, cli.dui_cli, cli.nit_cli, cli.direccion_cli, cli.correo_cli, ep.estado_pago  
        FROM clientes cli
        INNER JOIN estado_pago ep on cli.id_estado_pago = ep.id_estado_pago
        WHERE ep.id_estado_pago = ?';
        $params = array($this->id_estado_pago);
        return Database::getRows($sql, $params);
    }
    public function readEstados()
    {
        $sql = 'SELECT id_estado_pago, estado_pago FROM estado_pago';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE clientes 
        SET nombre_cli = ?, telefono_cli = ?, dui_cli = ?, nit_cli = ?, 
        direccion_cli = ?, correo_cli = ?, id_estado_pago = ? WHERE id_cliente = ?';
        $params = array($this->nombre_cli,$this->telefono_cli, $this->dui_cli, $this->nit_cli, $this->direccion_cli, $this->correo_cli, $this->id_estado_pago, $this->id_cliente);
        return Database::executeRow($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO clientes(nombre_cli, telefono_cli, dui_cli, nit_cli, direccion_cli, correo_cli, id_estado_pago) 
        values (?,?,?,?,?,?,?)';
        $params = array($this->nombre_cli,$this->telefono_cli, $this->dui_cli, $this->nit_cli, $this->direccion_cli, $this->correo_cli, $this->id_estado_pago);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM clientes
                WHERE id_cliente = ?';
        $params = array($this->id_cliente);
        return Database::executeRow($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT cli.id_cliente, cli.nombre_cli, cli.telefono_cli, cli.dui_cli, cli.nit_cli, cli.direccion_cli, cli.correo_cli, ep.estado_pago, cli.id_estado_pago  
        FROM clientes cli
        INNER JOIN estado_pago ep on cli.id_estado_pago = ep.id_estado_pago
        WHERE cli.id_cliente = ?';
        $params = array($this->id_cliente);
        return Database::getRow($sql, $params);
    }

    public function readReport()
    {
        $sql = 'SELECT nombre_cli, telefono_cli, dui_cli, nit_cli, direccion_cli, correo_cli, estado_pago  
        FROM clientes INNER JOIN estado_pago using(id_estado_pago)
        WHERE id_cliente=?';
        $params = array($this->id_cliente);
        return Database::getRows($sql, $params);
    }

    /*
    *   Métodos para generar gráficas.
    */
    public function cantidadClientesPago()
    {
        $sql = 'SELECT estado_pago, COUNT(id_cliente) cantidad
                FROM estado_pago INNER JOIN clientes USING(id_estado_pago)
                GROUP BY estado_pago ORDER BY cantidad DESC
                LIMIT 3';
        $params = null;
        return Database::getRows($sql, $params);
    }
}