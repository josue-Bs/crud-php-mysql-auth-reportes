<?php

require_once 'config/Database.php'; 
require_once 'models/entities/Cliente.php';    

class ClienteDAO {
    private $conexion;
    private $table_name = "clientes"; 

    public function __construct($db) {
        $this->conexion = $db; 
    }

    // LISTAR
    public function listarTodos() {
        try {
            $sql = "SELECT codCliente, nombre, ruc, telefono FROM " . $this->table_name; 
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Error al listar clientes: " . $e->getMessage());
        }
    }

    // BUSCAR UNO SOLO
    public function obtenerPorCodigo($codigo) {
        try {
            $sql = "SELECT codCliente, nombre, ruc, telefono FROM " . $this->table_name . " WHERE codCliente = :codCliente LIMIT 1";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":codCliente", $codigo);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die("Error al buscar cliente: " . $e->getMessage());
        }
    }

    // CREAR
    public function crear($nombre, $codCliente, $ruc, $telefono) {
        try {
            $sql = "INSERT INTO " . $this->table_name . " (codCliente, nombre, ruc, telefono) VALUES (:codCliente, :nombre, :ruc, :telefono)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":codCliente", $codCliente);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":ruc", $ruc);
            $stmt->bindParam(":telefono", $telefono);
            return $stmt->execute();
        } catch (Exception $e) {
            die("Error al crear cliente: " . $e->getMessage());
        }
    }

    // ACTUALIZAR
    public function actualizar($codigo, $nombre, $ruc, $telefono) {
        try {
            $sql = "UPDATE " . $this->table_name . " SET nombre = :nombre, ruc = :ruc, telefono = :telefono WHERE codCliente = :codCliente" ; 
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":ruc", $ruc);
            $stmt->bindParam(":telefono", $telefono);
            $stmt->bindParam(":codCliente", $codigo);
            return $stmt->execute();
        } catch (Exception $e) {
            die("Error al actualizar cliente: " . $e->getMessage());
        }
    }

    // ELIMINAR
    public function eliminar($codigo) {
        try {
            $sql = "DELETE FROM " . $this->table_name . " WHERE codCliente = :codCliente";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(":codCliente", $codigo);
            return $stmt->execute();
        } catch (Exception $e) {
            
            die("Error al eliminar (Verifique que ningún empleado use este cliente): " . $e->getMessage());
        }
    }
}